<?php
namespace BF_ClickCounter;

require_once 'functions.php';

/**
 * Plugin main class
 */
class Plugin extends \BF_PluginBase\Plugin {

	/**
	 * Version
	 *
	 * @var string
	 */
	protected $version = '0.0.1';

	/**
	 * Text domain
	 *
	 * @var string
	 */
	protected $textdomain = 'bf-click-counter';

	/**
	 * View class instance
	 *
	 * @var \BF_PluginBase\View
	 */
	public \BF_PluginBase\View $view;

	/**
	 * Input class instance
	 *
	 * @var \BF_PluginBase\Input
	 */
	public \BF_PluginBase\Input $input;

	/**
	 * Initialize
	 *
	 * @param string $base_dir
	 * @return void
	 */
	public function initialize( $base_dir ) {

		parent::initialize( $base_dir );
		$block_dir = $this->base_dir . '/src';

		$this->view  = new \BF_PluginBase\View( $this );
		$this->input = new \BF_PluginBase\Input();

		$this->counter_model = ClickCounterModel::get_instance();

		$this->shortcode = Shortcode::get_instance();
		$this->shortcode->activate();

		$this->countup_controller = CountupAjaxController::get_instance();
		$this->countup_controller->activate( 'bfcc-countup' );

		$this->click_counter_block = new ClickCounterBlock( $this, $block_dir . '/click-counter' );
		$this->click_counter_block->initialize();

		$this->main_page = new MainPage( $this );
		$this->main_page->initialize();

		$this->option_page = new OptionPage( $this );
		$this->option_page->initialize();

	}
}

