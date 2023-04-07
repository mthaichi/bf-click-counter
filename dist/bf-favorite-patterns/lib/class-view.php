<?php

namespace BF_Plugin_Base;

//use divengine;

class View extends Object {

    protected $base_dir;

    protected $view_file;

    public function __construct( Plugin $plugin, $base_dir = null ) {
        if ( is_null( $base_dir ) ) {
            $this->base_dir = $plugin->base_dir() . '/view/';
        }
    }
    public function render ( $view_file, $vars ) {
        extract($vars);
        include $this->base_dir . $view_file;
    }
}