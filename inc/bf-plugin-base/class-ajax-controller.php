<?php

namespace BF_PluginBase;

/**
 * Ajax Controller class
 */
class AjaxController extends BaseObject {

	use Singleton;

	/**
	 * WP Ajax Action
	 *
	 * @var string
	 */
	protected $action;

	/**
	 * WP Ajax activate
	 *
	 * @param string $action
	 * @return void
	 */
	public function activate( $action ) {
		$this->action = $action;
		add_action( 'wp_ajax_' . $action, array( $this, 'action' ) );
		add_action( 'wp_ajax_nopriv_' . $action, array( $this, 'action' ) );
		add_action( 'wp_head', array( $this, 'view' ) );
	}
}
