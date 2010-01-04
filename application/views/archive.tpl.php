<?php if (!defined('FARI')) die(); ?>

<?php $month; $count = 0; foreach($archive as $article): ?>
    <?php if ($month != $articleMonth = date("F Y", $article['published'])): ?>
        <?php if ($count > 0): ?>
            <li><a href="<?php $this->url('/blog/archive/'.Fari_Escape::slug($month)) ?>">
                <?php echo $month; ?></a> (<?php echo $count; ?>)
            </li>
        <?php endif; $count = 1; $month =  $articleMonth; ?>
    <?php else: $count++; ?>
    <?php endif; ?>
<?php endforeach; if ($count > 0): ?>
    <li><a href="<?php $this->url('/blog/archive/'.Fari_Escape::slug($month)) ?>">
        <?php echo $month ?></a> (<?php echo $count; ?>)
    </li>
<?php else: ?>
    <li>No archive</li>
<?php endif; ?>