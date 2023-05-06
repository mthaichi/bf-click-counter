<?php
namespace BF_ClickCounter;
/**
 * Option page class
 */
class MainPage extends \BF_PluginBase\AdminPage {

	/**
	 * Page title
	 *
	 * @var string
	 */
	protected $page_title         = 'BF Click Counter';

	/**
	 * Menu title
	 *
	 * @var string
	 */
	protected $menu_title         = 'BF Click Counter';

	/**
	 * Slug
	 *
	 * @var string
	 */
	protected $slug               = 'bf-click-counter';


	protected $view    = 'main-page.php';

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
		$table = new ClickCounterListTable();
		$table->prepare_items();
		$this->set_vars( 'table', $table );
		parent::view();
	}



	public function action_update_count() {
        global $wpdb;

		$input = $this->plugin->input;

		$model = ClickCounterModel::get_instance();
		$counter_data = $model->get_one( array( 'id' => $input->request('id') ) );

        $table_name = $wpdb->prefix . 'bf_click_counter';

		if ( $input->post( 'count' ) ) {
			$model->update( array( 'count' => $input->post( 'count' ) ), array( 'id' => $input->post( 'id' ) ) );
			add_action( 'admin_notices', function() {
				echo '<div class="updated"><p>更新が完了しました。</p></div>';
			} );
			$counter_data = $model->get_one( array( 'id' => $input->post( 'id' ) ) );
			$this->set_view( 'main-page.php' );
		} else {

			$this->set_vars( 'data', $counter_data ); 	
			$this->set_view( 'update-count.php' );
		}
	}
}

