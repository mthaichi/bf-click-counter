<h2><?php _e('Edit Count Number', BFCC_TEXTDOMAIN); ?></h2>
<form method="post">
  <input type="hidden" name="action" value="update_count" />
  <input type="hidden" name="id" value="<?php echo esc_attr($data['id']); ?>" />
  <table class="form-table">
    <tr>
      <th><?php _e('Count Number', BFCC_TEXTDOMAIN); ?></th>
      <td>
      <input type="number" name="count" value="<?php echo esc_attr( $data['count'] ); ?>" />
      </td>
    </tr>
  </table>
  <p class="submit"><input type="submit" class="button-primary" value="更新" /></p>
</form>
