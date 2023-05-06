<?php

namespace BF_PluginBase;

/**
 * Option page class
 */
class OptionPage extends BaseObject {

	/**
	 * Page title
	 *
	 * @var string
	 */
	protected $page_title;

	/**
	 * Menu Title
	 *
	 * @var string
	 */
	protected $menu_title;

	/**
	 * Slug
	 *
	 * @var string
	 */
	protected $slug;

	/**
	 * Setting group name
	 *
	 * @var string
	 */
	protected $setting_group_name;

	/**
	 * Definition of option values (defined in the inheriting class).
	 *
	 * @var array
	 */
	protected $options;

	/**
	 * Plugin class instance
	 *
	 * @var Plugin
	 */
	protected Plugin $plugin;

	/**
	 * Constructor
	 *
	 * @param Plugin $plugin Plugin class instance
	 */
	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Menu title setter.
	 *
	 * @param string $menu_title
	 * @return void
	 */
	public function set_menu_title( $menu_title ) {
		$this->menu_title = $menu_title;
	}

	/**
	 * Page title setter.
	 *
	 * @param string $menu_title
	 * @return void
	 */
	public function set_page_title( $page_title ) {
		$this->page_title = $page_title;
	}

	/**
	 * Initilalize
	 *
	 * @return void
	 */
	public function initialize() {
		add_action(
			'admin_menu',
			function() {
				add_options_page(
					$this->page_title,
					$this->menu_title,
					'manage_options',
					$this->slug,
					array(
						$this,
						'view',
					)
				);
			}
		);
		$this->settings_init();
	}

	/**
	 * Register settings.
	 *
	 * @return void
	 */
	public function settings_init() {
		foreach ( $this->options as $option ) {
			if ( 2 < count( $option ) ) {
				register_setting( $this->setting_group_name, $option[0], $option[2] );
			} else {
				register_setting( $this->setting_group_name, $option[0] );
			}
		}
	}

	/**
	 * Get default option values
	 *
	 * @param string $option_name
	 * @return void
	 */
	function get_default( $option_name ) {
		foreach ( $this->options as $option ) {
			if ( $option[0] === $option_name ) {
				return $option[1];
			}
		}
	}

	/**
	 * Get option value.
	 *
	 * @param string $option_name
	 * @return void
	 */
	function get_option( $option_name ) {
		$value = get_option( $option_name );
		if ( empty( $value ) ) {
			$value = $this->get_default( $option_name );
		}
		return $value;
	}

	/**
	 * Values to embed in an option page.
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @return void
	 */
	public function set_vars( $key, $value ) {
		$this->vars[ $key ] = $value;
	}

	/**
	 * Render option page.
	 *
	 * @return void
	 */
	public function view() {
		echo $this->plugin->view->render( $this->view, $this->vars );
	}

}
