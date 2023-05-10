
<script type="text/javascript">
function confirmAndDelete(url) {
    if (confirm('<?php echo __("Are you sure you want to delete the counter?", BFCC_TEXTDOMAIN) ?>')) {
        window.location.href = url;
    }
}
</script>

<div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <?php $table->display(); ?>
</div>
