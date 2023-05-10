<?php

namespace BF_PluginBase;

/**
 * Utils Class
 */
class Utils extends BaseObject {


	public static function classnames( $classes ) {
		return implode( ' ', array_filter( $classes ) );
	}

	static function arrayToCSS( $style ) {
		$css = '';
		foreach ( $style as $property => $value ) {

			$property = preg_replace( '/([a-z])([A-Z])/', '$1-$2', $property );
			$property = strtolower( $property );
			$css     .= $property . ': ' . $value . '; ';
		}
		return $css;
	}
}
