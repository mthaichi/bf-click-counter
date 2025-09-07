<script>
    var bf_ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.bf-click-counter').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                
                var self = this;
                var xhr = new XMLHttpRequest();
                
                var formData = new FormData();
                formData.append('id', this.getAttribute('data-id'));
                formData.append('ip_count_prevention', this.getAttribute('data-ip-count-prevention'));
                formData.append('action', '<?php echo $action; ?>');
                
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var countElement = self.querySelector('.count');
                        if (countElement) {
                            countElement.innerHTML = xhr.responseText;
                        }
                    }
                };
                
                xhr.open('POST', bf_ajaxurl, true);
                xhr.send(formData);
                
                return false;
            });
        });
    });
</script>