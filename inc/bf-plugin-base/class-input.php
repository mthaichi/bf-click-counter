<?php

namespace BF_PluginBase;

/**
 * Input class
 */
class Input extends BaseObject {

	/**
	 * Copy and store the contents of $_GET.
	 */
	private $get;

	/**
	 * Copy and store the contents of $_POST.
	 */
	private $post;

	/**
	 * Copy and store the contents of $_REQUEST.
	 */
	private $request;

	/**
	 * Constructor
	 */
	function __construct() {
		$this->get     = $_GET;
		$this->post    = $_POST;
		$this->request = $_REQUEST;
	}

	/**
	 * Get the value of a GET parameter.
	 *
	 * @param string $key
	 * @return void
	 */
	function get( $key = null ) {
		if ( ! is_null( $key ) && isset( $this->get[ $key ] ) ) {
			return $this->get[ $key ];
		}
		return is_null( $key ) ? $this->get : false;
	}

	/**
	 * Get the value of a POST parameter.
	 *
	 * @param string $key
	 * @return void
	 */
	function post( $key = null ) {
		if ( ! is_null( $key ) && isset( $this->post[ $key ] ) ) {
			return $this->post[ $key ];
		}
		return is_null( $key ) ? $this->post : false;
	}

	/**
	 * Get the value of a REQUEST(GET&POST) parameter.
	 *
	 * @param string $key
	 * @return void
	 */
	function request( $key = null ) {
		if ( ! is_null( $key ) && isset( $this->request[ $key ] ) ) {
			return $this->request[ $key ];
		}
		return is_null( $key ) ? $this->request : false;
	}

}
