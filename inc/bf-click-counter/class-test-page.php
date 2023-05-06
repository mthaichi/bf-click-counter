<?php
namespace BF_ClickCounter;
/**
 * Option page class
 */
class TestPage extends \BF_PluginBase\AdminPage {

	/**
	 * Page title
	 *
	 * @var string
	 */
	protected $page_title         = 'setting';

	/**
	 * Menu title
	 *
	 * @var string
	 */
	protected $menu_title         = 'setting';

	/**
	 * Slug
	 *
	 * @var string
	 */
	protected $slug               = 'bf-click-counter-test';


	protected $view    = 'test-page.php';

	/**
	 * Initialize
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();
	}

	/**
	 * Rendering an option page.
	 *
	 * @return void
	 */
	public function view() {
		parent::view();
	}
}

