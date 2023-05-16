<?php

namespace BF_PluginBase;

class AdminPage extends BaseObject {

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
	 * Sub Page
	 *
	 * @var AdminMenu[] $menuItems
	 */
	protected $subpages = array();

	protected $is_subpage;

	/**
	 * Constructor
	 *
	 * @param Plugin $plugin Plugin class instance
	 */
	public function __construct( Plugin $plugin, $is_subpage = false ) {
		$this->plugin     = $plugin;
		$this->is_subpage = $is_subpage;
	}

	/**
	 * vars
	 *
	 * @var array
	 */
	protected $vars = array();


	public function initialize() {
		add_action( 'admin_init', array( $this, 'action' ) );

		if ( ! $this->is_subpage ) {
			add_action(
				'admin_menu',
				function() {
					add_menu_page(
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
		}
	}

	public function add_subpage( AdminPage $subpage ) {
		add_action(
			'admin_menu',
			function() use ( $subpage ) {
				add_submenu_page(
					$this->slug,
					$subpage->page_title,
					$subpage->menu_title,
					'manage_options',
					$subpage->slug,
					array(
						$subpage,
						'view',
					)
				);
			}
		);
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

	public function action() {
		$input       = $this->plugin->input;
		$action      = $input->request( 'action' );
		$method_name = 'action_' . $action;
		if ( method_exists( $this, $method_name ) ) {
			$this->$method_name();
		}
	}

	public function set_view( $view_file ) {
		$this->view = $view_file;
	}

	public function view() {
		echo $this->plugin->view->render( $this->view, $this->vars );
	}

}
