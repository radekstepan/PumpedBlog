<?php if (!defined('FARI')) die(); ?>

<?php foreach ($messages as $message): ?>
    <div id="message" class="<?php echo $message['status']; ?>">
        <div class="inside">
            <center><strong><?php echo $message['message']; ?></strong></center>
        </div>
    </div>
<?php endforeach; ?>