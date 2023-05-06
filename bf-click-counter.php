<?php
/*
Plugin Name: BF Click Counter
Author: BREADFISH
Description: This is a simple click counter plugin.
Version: 1.0.0
Text Domain: bf-click-counter
@package bf-click-counter
*/

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

require 'vendor/autoload.php';
require_once 'autoload.php';

$plugin = BF_ClickCounter\Plugin::get_instance();
$plugin->initialize( __DIR__ );

$counter_model = BF_ClickCounter\ClickCounterModel::get_instance();
register_activation_hook( __FILE__, array( $counter_model, 'activate' ) );

/*
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://member.breadfish.jp/wp-update-server/?action=get_metadata&slug=bf-click-counter',
	__FILE__, //Full path to the main plugin file or functions.php.
	'bf-click-counter'
);
*/
