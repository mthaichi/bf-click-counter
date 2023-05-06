<?php
namespace BF_ClickCounter;
/**
 * ClickCounterBlock Class
 */
class ClickCounterBlock extends \BF_PluginBase\Block {

    /**
     * Block Server Side Render
     *
     * @param array $attributes
     * @return string
     */
    public function render( $attributes ) {
        $shortcode = Shortcode::get_instance();
        $id = isset( $attributes['counterKey'] ) ? $attributes['counterKey'] : null;
        if ( is_null( $id ) ) {
            return __( '<span>Please specify the ID of the counter.</span>' );
        }
        $classname = array();

        if ( array_key_exists( 'className', $attributes ) ) {
            $classnames[] = $attributes['className'];
        }

		if ( array_key_exists( 'textColor', $attributes ) ) {
			$classnames[] = 'has-text-color has-' . $attributes['textColor'] . '-color';
		}
		if ( array_key_exists( 'backgroundColor', $attributes ) ) {
			$classnames[] = 'has-background-color has-' . $attributes['backgroundColor'] . '-background-color';
		}
        $classnames_str = Utils::classnames($classnames);

        $shortcode_str = $shortcode->build( array( 'id' => $id, 'classnames' => $classnames_str ) );
        return do_shortcode( $shortcode_str );
    } 

}