<?php if (!defined('FARI')) die();

/**
 * A config for your application, set db and app settings here.
 * 
 * @author Radek Stepan <radek.stepan@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 * @package Fari
 */

/**
 * Application settings
 */

// app directory; this directory contains your models, views & controllers
if (!defined('APP_DIR')) define('APP_DIR', 'application');
// application version
if (!defined('APP_VERSION')) define('APP_VERSION', 'PumpedBlog');
// default Controller for the application (pages in a CMS)
if (!defined('DEFAULT_CONTROLLER')) define('DEFAULT_CONTROLLER', 'blog');
// set to FALSE on live version of your application
if (!defined('REPORT_ERR')) define('REPORT_ERR', TRUE);

/**
 * Database settings (in use by Fari_Db helper class)
 */

// mysql, pgsql, sqlite
if (!defined('DB_DRIVER')) define('DB_DRIVER', 'sqlite');
// localhost, 127.0.0.1
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
// database name
if (!defined('DB_NAME')) define('DB_NAME', 'db/database.db');
// database username
if (!defined('DB_USER')) define('DB_USER', '');
// database password
if (!defined('DB_PASS')) define('DB_PASS', '');

/**
 * FTP
 */
// ftp server (can be ssl)
if (!defined('FTP_HOST')) define('FTP_HOST', '');
// ftp account username
if (!defined('FTP_USER')) define('FTP_USER', '');
// ftp account password
if (!defined('FTP_PASS')) define('FTP_PASS', '');

/**
 * Timezone
 */

// set a default timezone
date_default_timezone_set('UTC');

/**
 * PumpedBlog related
 */

// the name of the blog
if (!defined('BLOG_TITLE')) define('BLOG_TITLE', 'PumpedBlog');
// the theme for the blog (found in /application/views/themes)
if (!defined('BLOG_THEME')) define('BLOG_THEME', 'hemingway');
// the amount of article previews to display on homepage
if (!defined('BLOG_FRONT')) define('BLOG_FRONT', '2');
// the amount of articles to list in archive/listing/footer
if (!defined('BLOG_LIST')) define('BLOG_LIST', '6');
// the length of an article, in characters, to display in homepage preview
if (!defined('BLOG_PREVIEW')) define('BLOG_PREVIEW', '250');
// how many articles to show in the RSS feed
if (!defined('BLOG_RSS')) define('BLOG_RSS', '10');