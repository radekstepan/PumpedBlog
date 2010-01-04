<?php if (!defined('FARI')) die(); ?>

<?php if (!empty($articles)): ?>
    <ul class="dates">
        <?php foreach($articles as $article): ?>
            <li>
                <span class="date"><?php echo date("d.m.y", $article['published']); ?></span>
                <a href="<?php $this->url('/blog/article/'.$article['slug']) ?>">
                    <?php echo $article['name']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No articles were found.</p>
<?php endif; ?>