<h2>カウント数を編集</h2>
<form method="post">
  <input type="hidden" name="action" value="update_count" />
  <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
  <table class="form-table">
    <tr>
      <th>カウント数</th>
      <td>
      <input type="number" name="count" value="<?php echo $data['count']; ?>" />
      </td>
    </tr>
  </table>
  <p class="submit"><input type="submit" class="button-primary" value="更新" /></p>
</form>
