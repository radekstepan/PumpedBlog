<?php if (!defined('FARI')) die(); ?>

<?php if (!empty($list)): foreach($list as $article): ?>
    <li><a href="<?php $this->url('/blog/article/'.$article['slug']) ?>">
        <span class="date">
            <?php echo date("d.m", $article['published']); ?>
        </span>
    <?php echo $article['name']; ?></a></li>
<?php endforeach; else: ?>
    <li>No recent articles</li>
<?php endif; ?>