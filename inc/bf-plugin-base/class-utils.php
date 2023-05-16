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

	static function sanitize_multi_dimensional_array( $array ) {
		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) ) {
				$array[ $key ] = self::sanitize_multi_dimensional_array( $value );
			} else {
				$array[ $key ] = sanitize_text_field( $value );
			}
		}
		return $array;
	}
	

}
