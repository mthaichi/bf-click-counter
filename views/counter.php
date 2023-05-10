<div <?php echo $wrapper_attributes; ?>>
<a style="<?php echo $style; ?>" href="javascript:void(0);" class="<?php echo $classnames; ?>" data-id="<?php echo $id; ?>" data-ip-count-prevention="<?php echo $ip_count_prevention; ?>"><?php echo preg_replace('/%count%/', '<span class="count">'. $count . '</span>', $label); ?></a>
</div>
