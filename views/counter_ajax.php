<script>
    var bf_ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';

    jQuery(function() {
        jQuery('.bf-click-counter').click(function() {
            var self = this;
            jQuery.ajax({
                type: 'POST',
                url: bf_ajaxurl,
                data: {
                    'id' : jQuery(this).attr('data-id'),
                    'action' : '<?php echo $action; ?>',
                },
                success: function( response ){
                    jQuery(self).find('.count').html(response);   
                }
            });				

            return false;
        });
    })

</script>