<?php
namespace BF_ClickCounter;

/**
 * ClickCounterBlock Class
 */
class ClickCounterBlock extends \BF_PluginBase\Block {

	/**
	 * Server side render
	 *
	 * @param array $attributes
	 * @return string Rendering contents.
	 */
	public function render( $attributes ) {
		$attributes = Utils::sanitize_multi_dimensional_array( $attributes );
		$id        = isset( $attributes['counterKey'] ) ? $attributes['counterKey'] : null;
		if ( empty( $id ) ) {
			return '<div style="border:1px solid #777700; background-color:#ffffe0; padding:10px">' . __( 'Please specify the "Counter Key" of the counter.' ) . '</div>';
		}
		$classnames         = array();
		$wrapper_classnames = array();
		$styles             = array();
		$wrapper_styles     = array();

		if ( array_key_exists( 'className', $attributes ) ) {
			$classnames[] = $attributes['className'];
		}

		if ( array_key_exists( 'style', $attributes ) ) {
			if ( array_key_exists( 'color', $attributes['style'] ) ) {
				if ( array_key_exists( 'text', $attributes['style']['color'] ) ) {
					$styles['color'] = $attributes['style']['color']['text'];
				}
				if ( array_key_exists( 'background', $attributes['style']['color'] ) ) {
					$styles['background-color'] = $attributes['style']['color']['background'];
				}
			}
			if ( array_key_exists( 'typography', $attributes['style'] ) ) {
				if ( array_key_exists( 'textDecoration', $attributes['style']['typography'] ) ) {
					$styles['text-decoration'] = $attributes['style']['typography']['textDecoration'];
				}
			}
		}

		if ( array_key_exists( 'borderColor', $attributes ) ) {
			$styles['border-color'] = $attributes['borderColor'];
		}

		if ( array_key_exists( 'borderRadius', $attributes ) ) {
			$styles['border-radius'] = $attributes['borderRadius'] . 'px';
		}

		if ( array_key_exists( 'borderWidth', $attributes ) ) {
			$styles['border-width'] = $attributes['borderWidth'] . 'px';
		}

		if ( array_key_exists( 'buttonAlign', $attributes ) ) {
			   $wrapper_classnames[] = 'bf-click-counter-counter-align-' . $attributes['buttonAlign'];
		}

		if ( array_key_exists( 'textColor', $attributes ) ) {
			$classnames[] = 'has-text-color has-' . $attributes['textColor'] . '-color';
		}

		if ( array_key_exists( 'backgroundColor', $attributes ) ) {
			$classnames[] = 'has-background-color has-' . $attributes['backgroundColor'] . '-background-color';
		}

		if ( array_key_exists( 'paddingValues', $attributes ) ) {
			$styles['padding-top']    = $attributes['paddingValues']['top'];
			$styles['padding-left']   = $attributes['paddingValues']['left'];
			$styles['padding-bottom'] = $attributes['paddingValues']['bottom'];
			$styles['padding-right']  = $attributes['paddingValues']['right'];
		}

		$label = null;
		if ( array_key_exists( 'counterLabel', $attributes ) ) {
			$label = $attributes['counterLabel'];
		}

		$ip_count_prevention = false;
		if ( array_key_exists( 'ipCountPrevention', $attributes ) ) {
			$ip_count_prevention = $attributes['ipCountPrevention'];
		}
		$classnames[] = 'bf-click-counter';

		$model = ClickCounterModel::get_instance();

		$style_str              = Utils::arrayToCSS( $styles );
		$wrapper_style_str      = Utils::arrayToCSS( $wrapper_styles );
		$classnames_str         = Utils::classnames( $classnames );
		$wrapper_classnames_str = Utils::classnames( $wrapper_classnames );
		$wrapper_attributes     = get_block_wrapper_attributes(
			array(
				'class' => $wrapper_classnames_str,
				'style' => $wrapper_style_str,
			)
		);
		$count                  = 0;
		if ( ! is_null( $model->get_counter_data( $id ) ) ) {
			$count = $model->get_count( $id );
		}
		
		return $this->plugin->view->render(
			'counter.php',
			array(
				'wrapper_attributes' => $wrapper_attributes,
				'classnames'         => $classnames_str,
				'style'              => $style_str,
				'wrapper_stype'      => $wrapper_style_str,
				'id'                 => $id,
				'label'              => $label,
				'count'              => $count,
				'ip_count_prevention'=> $ip_count_prevention
			),
			false
		);
	}
}
