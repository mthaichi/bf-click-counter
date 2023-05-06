<?php

namespace BF_PluginBase;

/**
 * View Class
 */
class View extends BaseObject {

	/**
	 * Directory where view files are located.
	 *
	 * @var string
	 */
	protected $base_dir;

	/**
	 * Plugin class instance
	 *
	 * @var Plugin
	 */
	protected $plugin;

	/**
	 * Constructor
	 *
	 * @param Plugin $plugin Plugin class instance.
	 * @param string $base_dir Directory where view files are located.
	 */
	public function __construct( Plugin $plugin, $base_dir = null ) {
		$this->plugin = $plugin;
		if ( is_null( $base_dir ) ) {
			$this->base_dir = $plugin->base_dir() . '/views/';
		}
	}

	/**
	 * Render
	 *
	 * @param string  $view_file
	 * @param array   $vars Array of values to pass to the view.
	 * @param boolean $is_echo Whether to echo as is or not.
	 * @return void
	 */
	public function render( $view_file, $vars, $is_echo = true ) {
		extract( $vars );
		if ( false === $is_echo ) {
			ob_start();
			include $this->base_dir . $view_file;
			return ob_get_clean();
		}
		include $this->base_dir . $view_file;
	}
}
