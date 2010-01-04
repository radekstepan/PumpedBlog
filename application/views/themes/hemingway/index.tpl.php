<?php if (!defined('FARI')) die(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo BLOG_TITLE; ?></title>
    <link rel="stylesheet" href="<?php $this->url('/public/hemingway.css') ?>" type="text/css" media="screen" />
</head>
<body>
    <?php include 'application/views/add.tpl.php'; ?>
    <?php include 'application/views/messages.tpl.php'; ?>

    <div id="header">
        <div class="inside">
            <h2><a href="<?php $this->url(); ?>"><?php echo BLOG_TITLE; ?></a></h2>
            <p class="description">A blog that never gets tired</p>
        </div>
    </div>

    <div id="primary" class="twocol-stories">
        <div class="inside">
            <?php $first = TRUE; foreach ($articles as $article): ?>
            <div class="story <?php if ($first) {echo 'first'; $first = FALSE;} else $first = TRUE; ?>">
                <!-- title -->
                <h3><a href="<?php $this->url('/blog/article/'.$article['slug']) ?>"
                       title="Permanent Link to <?php echo $article['name']; ?>">
                       <?php echo $article['name']; ?></a></h3>
               
                <!-- text -->
                <p><?php
                    $article['text'] = Fari_Escape::text(Fari_Textile::toHTML($article['text']));
                
                    echo (strlen($article['text']) <= BLOG_PREVIEW)
                        ? $article['text'] : substr($article['text'], 0, BLOG_PREVIEW).' [...]' ;
                ?></p>

                <!-- details -->
                <div class="details">
                    Posted at <?php echo date("F j, Y, G:i", $article['published']); ?> |
                    <span class="read-on">
                        <a href="<?php $this->url('/blog/article/'.$article['slug']) ?>">read more</a>
                    </span>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div class="clear"></div>
        </div>
    </div>

    <hr class="hide" />
    
    <div id="ancillary">
        <div class="inside">
            <div class="block first">
                <h2>About</h2>
                <p>PumpedBlog is a lite blog app written by <a href="http://radekstepan.com">Radek Stepan</a>
                    running on Fari MVC Framework.</p>
            </div>
            
            <div class="block">
                <h2>Recently</h2>
                <ul class="dates">
                    <?php include 'application/views/recent.tpl.php'; ?>
                </ul>
            </div>
            
            <div class="block">
                <h2>Archive</h2>
                <ul class="dates">
                    <?php include 'application/views/archive.tpl.php'; ?>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <hr class="hide" />
    
    <div id="footer">
        <div class="inside">
            <p class="copyright">
                Powered by <a href="http://www.wordpresslab.com">Hemingway Reloaded</a>
                flavored <a href="http://radekstepan.com">PumpedBlog</a>.
            </p>
            <p class="attributes">
                <a href="<?php $this->url('/blog/rss/'); ?>">Entries RSS</a>
            </p>
        </div>
    </div>

    <div id="live-search">
        <div class="inside">
            <div id="search">
                <form action="<?php $this->url('/blog/search'); ?>" method="post">
                    <img src="<?php $this->url('/public/search.gif'); ?>" alt="Search:" />
                    <input type="text" id="q" value="" name="q" size="15" />
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>