<?php

namespace BF_PluginBase;

/**
 * Block class
 */
class Block extends BaseObject {

	/**
	 * Block source directory.
	 *
	 * @var string
	 */
	protected $block_dir;

	/**
	 * Plugin class instance
	 *
	 * @var Plugin
	 */
	protected $plugin;

	/**
	 * Render callback
	 *
	 * @var array|string
	 */
	protected $callback;

	/**
	 * Constructor
	 *
	 * @param Plugin $plugin  Plugin class instance
	 * @param string $block_dir Block source directory
	 */
	public function __construct( Plugin $plugin, $block_dir = null ) {
		$this->plugin    = $plugin;
		$this->block_dir = $block_dir ? $block_dir : __DIR__;
	}

	/**
	 * Initilalize
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Block Register
	 *
	 * @return void
	 */
	public function register() {
		if ( method_exists( $this, 'render' ) ) {
			register_block_type( $this->block_dir, array( 'render_callback' => array( $this, 'render' ) ) );
		} else {
			register_block_type( $this->block_dir );
		}
	}

}
