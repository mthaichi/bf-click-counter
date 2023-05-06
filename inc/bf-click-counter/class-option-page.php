<?php
namespace BF_ClickCounter;
/**
 * Option page class
 */
class OptionPage extends \BF_PluginBase\OptionPage {

	/**
	 * Page title
	 *
	 * @var string
	 */
	protected $page_title         = 'BF GA4 Tag Installer';

	/**
	 * Menu title
	 *
	 * @var string
	 */
	protected $menu_title         = 'BF GA4 Tag Installer';

	/**
	 * Slug
	 *
	 * @var string
	 */
	protected $slug               = 'bf-ga4-tag-installer';

	/**
	 * Setting group name
	 *
	 * @var string
	 */
	protected $setting_group_name = 'bf_ga4_tag_installer_settings';

	/**
	 * default option
	 *
	 * @var array
	 */
	protected $options = array(
		array( 'bfga4_tagm_measurement_id', '' ),
	);
	protected $view    = 'option-page.php';

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
		$this->set_vars( 'title', $this->page_title );
		$this->set_vars( 'setting_group_name', $this->setting_group_name );
		$this->set_vars( 'get_option', array( $this, 'get_option' ) );
		parent::view();
	}
}

