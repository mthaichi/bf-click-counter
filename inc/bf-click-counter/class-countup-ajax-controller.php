<?php
namespace BF_ClickCounter;

/**
 * AjaxController for count up
 */
class CountupAjaxController extends \BF_PluginBase\AjaxController {

	/**
	 * Accept a request via Ajax and output the displayed content.
	 *
	 * @return void
	 */
	function action() {
		$input         = new \BF_PluginBase\Input();
		$counter_model = ClickCounterModel::get_instance();
		echo $counter_model->countup( $input->post( 'id' ), $_SERVER['REMOTE_ADDR'] );
		die();
	}

	/**
	 * Output JavaScript to POST a request via Ajax.
	 *
	 * @return void
	 */
	function view() {
		$plugin = Plugin::get_instance();
		$plugin->view->render( 'counter_ajax.php', array( 'action' => $this->action ) );
	}
}
