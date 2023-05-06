<h1>テスト</h1>
<div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <a href="<?php echo admin_url('admin.php?page=bf_click_counter&action=add'); ?>" class="page-title-action">新規追加</a>
        <?php $table->display(); ?>
</div>