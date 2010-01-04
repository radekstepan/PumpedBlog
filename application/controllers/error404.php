<?php if (!defined('FARI')) die();

class Error404_Controller extends Fari_Controller {

	public static function _desc() { return '404 Page Not Found'; }

    public function _init() {
        // a listing of articles in the footer
        $this->view->list = (!Fari_User::isAuthenticated('realname')) ?
        Fari_Db::select('articles', 'name, published, slug', array('status' => 1), 'published DESC', BLOG_LIST) :
        Fari_Db::select('articles', 'name, published, slug', NULL, 'published DESC', BLOG_LIST);

        // articles archive (no limit on number of articles)
        $this->view->archive = (!Fari_User::isAuthenticated('realname')) ?
        Fari_Db::select('articles', 'name, published, slug', array('status' => 1), 'published DESC') :
        Fari_Db::select('articles', 'name, published, slug', NULL, 'published DESC');
    }

	public function index($article) {
        $this->view->display('/themes/'.BLOG_THEME.'/404');
	}
}