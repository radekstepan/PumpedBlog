<?php if (!defined('FARI')) die(); ?>

<?php if (Fari_User::isAuthenticated('realname')): ?>
    <div id="admin">
        <div class="inside">
            <a href="<?php $this->url('/blog/create') ?>">Add new article</a> &nbsp; |
                &nbsp; <a href="<?php $this->url('/blog/logout') ?>">Logout</a>
        </div>
    </div>
<?php endif; ?>