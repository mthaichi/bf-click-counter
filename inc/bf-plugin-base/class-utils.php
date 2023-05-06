<?php

namespace BF_PluginBase;

/**
 * View Class
 */
class Utils extends BaseObject {

    static public function classnames( $classes ) {
        return implode(' ', array_filter( $classes ) );
    } 
}