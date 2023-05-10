<?php

namespace BF_PluginBase;

/**
 * Plugin class
 */
class Plugin extends BaseObject {

	use Singleton;

	/**
	 * Plugin Version
	 *
	 * @var string
	 */
	protected $version;

	/**
	 * Plugin Base Directory
	 *
	 * @var string
	 */
	protected $base_dir = '';

	/**
	 * Text domain
	 *
	 * @var string
	 */
	protected $textdomain = '';

	/**
	 * Initialize
	 *
	 * @param string $base_dir
	 * @return void
	 */
	public function initialize( $base_dir ) {
		$this->base_dir = $base_dir;
	}

	/**
	 * Base Directory getter
	 *
	 * @return void Base directory.
	 */
	public function base_dir() {
		return $this->base_dir;
	}

	/**
	 * Version getter
	 *
	 * @return string Plugin version.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Text domain getter
	 *
	 * @return string Text domain.
	 */
	public function get_textdomain() {
		return $this->textdomain;
	}
}
