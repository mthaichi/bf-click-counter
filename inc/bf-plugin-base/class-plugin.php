<?php

namespace BF_PluginBase;

class Plugin extends BaseObject {

	use Singleton;

	protected $version;
	protected $base_dir   = '';
	protected $textdomain = '';

	public function initialize( $base_dir ) {
		$this->base_dir = $base_dir;
	}

	public function base_dir() {
		return $this->base_dir;
	}

	public function get_version() {
		return $this->version;
	}

	public function get_textdomain() {
		return $this->textdomain;
	}
}
