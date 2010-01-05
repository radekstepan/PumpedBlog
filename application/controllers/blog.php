<?php if (!defined('FARI')) die();

class Blog_Controller extends Fari_Controller {

	public static function _desc() { return 'Main blog controller'; }
	
	public function _init() {
        $isAuthenticated = Fari_User::isAuthenticated('realname');

        // a listing of articles in the footer
        $this->view->list = (!$isAuthenticated) ?
        Fari_Db::select('articles', 'name, published, slug', array('status' => 1), 'published DESC', BLOG_LIST) :
        Fari_Db::select('articles', 'name, published, slug', 'status != 2', 'published DESC', BLOG_LIST);

        // articles archive (no limit on number of articles)
        $this->view->archive = (!$isAuthenticated) ?
        Fari_Db::select('articles', 'name, published, slug', array('status' => 1), 'published DESC') :
        Fari_Db::select('articles', 'name, published, slug', 'status != 2', 'published DESC');
    }
	
	public function index($article) {
        // pickup messages for us
        $this->view->messages = Fari_Message::get();
        
        $isAuthenticated = Fari_User::isAuthenticated('realname');

        if ($article != NULL) {
            // a specific article
            $slug = Fari_Escape::URL($article);
            if (!$isAuthenticated) {
                $article = Fari_Db::selectRow('articles', '*', array('slug' => $slug, 'status' => 1));
                $this->view->cache('/themes/'.BLOG_THEME.'/article', 'text/html', $slug);
            } else {
                $article = Fari_Db::selectRow('articles', '*', array('slug' => $slug));
            }

            if (empty($article)) $this->redirect('/error404');

            $this->view->article = $article;

            $this->view->display('/themes/'.BLOG_THEME.'/article', 'text/html', $slug);
        } else {
            // the latest articles
            if (!$isAuthenticated) {
                $this->view->articles = Fari_Db::select('articles', '*', array('status' => 1),
                    'published DESC', BLOG_FRONT);
                $this->view->cache('index', 'text/html');
            } else {
                $this->view->articles = Fari_Db::select('articles', '*', 'status != 2',
                    'published DESC', BLOG_FRONT);
            }

            $this->view->display('/themes/'.BLOG_THEME.'/index');
        }
	}

    public function archive($month) {
        if ($month != NULL) {
            // only cache public content
            if (!$isAuthenticated = Fari_User::isAuthenticated('realname')) {
                $this->view->cache('/themes/'.BLOG_THEME.'/archive', 'text/html', $month);
            }
            
            $articles = Blog::getArchive($month, $isAuthenticated);
            if (empty($articles)) $this->redirect('/error404');

            $this->view->articles = $articles;
            $this->view->title = Fari_Format::titleize($month);

            $this->view->display('/themes/'.BLOG_THEME.'/archive', 'text/html', $month);
        } else {
            $this->redirect('/error404');
        }
	}

    public function search() {
        if ($_POST['q'] != NULL) {
            $query = Fari_Escape::text($_POST['q']);
            
            // only cache public content
            if (!$isAuthenticated = Fari_User::isAuthenticated('realname')) {
                $this->view->cache('/themes/'.BLOG_THEME.'/search', 'text/html', $query);
                $this->view->articles = Fari_Db::select('articles', '*',
                    "(text LIKE '%$query%' OR name LIKE '%$query%') AND status = 1", 'published DESC');
            } else {
                $this->view->articles = Fari_Db::select('articles', '*',
                    "text LIKE '%$query%' OR name LIKE '%$query%'", 'published DESC');
            }

            $this->view->title = $query;

            $this->view->display('/themes/'.BLOG_THEME.'/search', 'text/html', $query);
        } else {
            $this->redirect('/error404');
        }
	}

    public function edit($article) {
        if (!Fari_User::isAuthenticated('realname') or $article == NULL) {
            Fari_Message::fail('You need to authenticate first');
            $this->redirect('/blog/login/');
        } else {
            // are we saving updates?
            if (!empty($_POST['slug'])) {
                Fari_Db::update('articles', array('text' => Fari_Escape::quotes($_POST['text']),
                    'status' => $_POST['status']), array('slug' => $_POST['slug']));
                Fari_Message::success('Changes saved');
            }

            // pickup messages for us
            $this->view->messages = Fari_Message::get();

            // a specific article
            $article = Fari_Escape::URL($article);
            $this->view->article = $article = Fari_Db::selectRow('articles', '*', array('slug' => $article));

            $this->view->display('/themes/'.BLOG_THEME.'/edit');
        }
	}

    public function create() {
        if (!Fari_User::isAuthenticated('realname')) {
            Fari_Message::fail('You need to authenticate first');
            $this->redirect('/blog/login/');
        } else {
            // are we saving updates?
            if (!empty($_POST['name'])) {
                $name = Fari_Escape::text($_POST['name']);
                $text = Fari_Escape::quotes($_POST['text']);
                $slug = Fari_Escape::slug($_POST['name']);

                // check article title uniqueness
                $result = Fari_Db::selectRow('articles', 'id', array('slug' => $slug));
                if (empty($result)) {
                    Fari_Db::insert('articles', array('text' => $text, 'slug' => $slug, 'name' => $name,
                        'status' => $_POST['status'], 'published' => time()));
                    Fari_Message::success('Article \'' . $name . '\' saved.');
                    $this->redirect('/blog/edit/'.$slug);
                } else Fari_Message::fail('Article name \'' . $name . '\' is not unique');
            }
            // pickup messages for us
            $this->view->messages = Fari_Message::get();
            // fill back on fail
            $this->view->article = array('name' => $_POST['name'], 'text' => $_POST['text']);

            $this->view->display('/themes/'.BLOG_THEME.'/new');
        }
	}

    public function rss() {
        if (!Fari_User::isAuthenticated('realname')) {
            // cache public articles
            $this->view->cache('rss', 'application/rss+xml');
            $articles = Fari_Db::select('articles', 'name, text, published, slug',
                array('status' => 1), 'published DESC', BLOG_RSS);
        } else {
            $articles = Fari_Db::select('articles', 'name, text, published, slug',
                'status != 2', 'published DESC', BLOG_RSS);
        }

        // convert Textile to HTML
        foreach ($articles as &$article) {
            $article['text'] = Fari_Textile::toHTML($article['text']);
        }


        $feed = new Fari_RSS('name', 'slug', 'text', 'published');
        $items = 
        $this->view->feed = $feed->create(BLOG_TITLE.' RSS Feed', '/blog/rss/',
            'A feed of all the articles on this blog', $articles);

        $this->view->display('rss', 'application/rss+xml');
    }

    public function sitemap() {
        $sitemap = new Fari_Sitemap('slug', 'published');
        
        $articles = Fari_Db::select('articles', 'slug, published', array('status' => 1));
        
        echo $sitemap->create($articles, '/blog/article/');
    }

    public function login() {
        if (Fari_User::isAuthenticated('realname')) $this->redirect('/');

        // authenticate user if form data POSTed
		if (isset($_POST['username'])) {
            if (Fari_User::authenticate($_POST['username'], $_POST['password'], $_POST['token'], 'realname')) {
                Fari_Message::success('Welcome back \'' . Fari_User::getCredentials() . '\'');
                $this->redirect('/'); die();
            } 
            Fari_Message::fail('Incorrect authentication details');
		}
        // create token & display login form
        $this->view->token = Fari_Token::create();

        // pickup messages for us
        $this->view->messages = Fari_Message::get();

        $this->view->display('/themes/'.BLOG_THEME.'/login');
    }

    public function logout() {
        Fari_User::signOut();
        Fari_Message::success('Goodbye');
		$this->redirect('/blog/login/');
    }
}