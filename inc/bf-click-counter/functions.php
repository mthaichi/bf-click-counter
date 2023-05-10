<?php
/**
 * Functions
 *
 * @package bf-click-counter
 */

namespace BF_ClickCounter;

/**
 * Get local option
 *
 * @param string $key option key.
 * @return string option value.
 */
function get_option( $key ) {
	$plugin = Plugin::get_instance();
	return $plugin->option_page->get_option( $key );
}
