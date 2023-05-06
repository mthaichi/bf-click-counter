<h2><?php echo $title; ?></h2>
<form method="post" action="options.php">
<?php settings_fields( $setting_group_name ); ?>
<?php do_settings_sections( $setting_group_name ); ?>
<table>
<tr>
<th>GA4 Measurement ID</th>
<td><input type="text" name="bfga4_tagm_measurement_id" value="<?php echo esc_attr( $get_option('bfga4_tagm_measurement_id') ); ?>"  /></td>
</tr>
</table>
<?php submit_button(); ?>
</form>

