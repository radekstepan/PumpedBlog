<?php if (!defined('FARI')) die(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo BLOG_TITLE; ?> &raquo; New article</title>
    <link rel="stylesheet" href="<?php $this->url('/public/hemingway.css') ?>" type="text/css" media="screen" />

    <link rel="stylesheet" href="<?php $this->url('/public/toolbar.css') ?>" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php $this->url('public/toolbar.js'); ?>"></script>
    </script>
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

    <div id="primary" class="single-post">
        <div class="inside">
            <form action="<?php $this->url('/blog/create/') ;?>" method="post">
                <div class="primary">
                    <input type="text" class="text title" name="name"
                        value="<?php echo (empty($article['name'])) ? 'Article name' : $article['name']; ?>" />

                    <?php include 'application/views/textarea.tpl.php'; ?>

                    <input type="submit" class="button" value="Save" />
                </div>

                <hr class="hide" />

                <div class="secondary">
                    <h2>Article settings</h2>
                    <div class="featured">
                        <dl>
                            <dt>Visibility:</dt>
                            <dd>
                                <select name="status">
                                    <option value="0" <?php if ($article['status'] == '0') echo 'selected'; ?>>Private</option>
                                    <option value="1" <?php if ($article['status'] == '1') echo 'selected'; ?>>Public</option>
                                    <option value="2" <?php if ($article['status'] == '2') echo 'selected'; ?>>Deleted</option>
                                </select>
                            </dd>
                        </dl>
                    </div>
                </div>
            </form>

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