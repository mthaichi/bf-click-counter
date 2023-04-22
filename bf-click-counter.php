<?php
/*
Plugin Name: BF Click Counter
Author: Taichi MARUYAMA
Plugin URI: http://maruyama.breadfish.jp/
Description: シンプルなクリックカウンターです。
Version: 1.0.0
Author URI: http://maruyama.breadfish.jp/
Text Domain: bf-click-counter

@package           bf-click-countert
*/

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

include "vendor/autoload.php";

require_once 'autoload.php';


$plugin = BF_ClickCounter\Plugin::get_instance();
$plugin->initialize(__DIR__);


use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://member.breadfish.jp/wp-update-server/?action=get_metadata&slug=bf-ga4-tag-installer',
	__FILE__, //Full path to the main plugin file or functions.php.
	'bf-click-counter'
);
