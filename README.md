# PumpedBlog (January 2010)

A blog that never gets tired

![image](https://github.com/radekstepan/PumpedBlog/raw/master/example.png)

A lite blog web app in Fari MVC with public **content caching**, **searches**, **RSS** feeds, **sitemap** and easy **theming**. Currently sports a Wordpress theme *Hemingway Reloaded*.

## Getting started

Make sure `/tmp` is writable and that `/db/database.db` exists and is writable too. Database access is configured to use `pdo_sqlite` by default, you can check its existence like so:

```php
<?php
phpinfo();
?>
```

Visit [127.0.0.1/pumped/blog/login](http://127.0.0.1/pumped/blog/login) to authenticate usign `admin:admin` as a username and password.

## Troubleshooting

On PHP 5.4+ you will get "call-time pass-by-reference" error.

Fari Framework automatically understands that you are in development mode, if you call the app from `127.0.0.1`. Do so to see a stacktrace of where an error has happened instead of seeing a placeholder error message.