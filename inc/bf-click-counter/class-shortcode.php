<?php
namespace BF_ClickCounter;
/**
 * Shortcode class
 */
class Shortcode extends \BF_PluginBase\BaseObject {

	use \BF_PluginBase\Singleton;

	/**
	 * Shortcode tag
	 *
	 * @var string
	 */
	private $shortcode_tag = 'bfcc';

	/**
	 * View file name
	 *
	 * @var string
	 */
	private $view_file = 'button.php';

	private $args = array(
		'id' => '/^[\w\-_]+$/',
		'ip' => '/^\d+$/',
		'classnames' => '/^[0-9A-Za-z\-_\s]+$/'
	);

	/**
	 * Activate shortcode.
	 *
	 * @return void
	 */
	public function activate() {
		add_shortcode( $this->shortcode_tag, array( $this, 'render' ) );
	}

	/**
	 * Get tagname
	 *
	 * @return string
	 */
	public function get_tagname() {
		return $this->shortcode_tag;
	}


	public function build( $args = array() ) {
		$retargs = array();
		foreach ( $args as $id => $val ) {
			if ( array_key_exists( $id, $this->args ) ) {
				if ( preg_match( $this->args[$id], $val ) ) {
					$retargs[$id] = $val;
				}
			}
		}
		$shortcode = '[' . $this->get_tagname();
		foreach($retargs as $key => $value) {
		  $shortcode .= ' ' . $key . '="' . $value . '"';
		}
		$shortcode .= ']';
		return $shortcode;

	}

	/**
	 * Rendering counter
	 *
	 * @param array $atts Shortcode attributes.
	 * @return void
	 */
	public function render( $atts ) {
		$plugin     = Plugin::get_instance();
		$view       = $plugin->view;
		$textdomain = $plugin->get_textdomain();
		$atts       = shortcode_atts(
			array(
				'id' => '0',
				'classnames' => ''
			),
			$atts,
			'bfcc'
		);

		$classnames = explode(' ', $atts['classnames']);
		$classnames[] = 'bf-click-counter';

		$model = ClickCounterModel::get_instance();

		if ( ! is_null( $model->get_counter_data( $atts['id'] ) ) ) {
			return $view->render(
				$this->view_file,
				array(
					'id'           => $atts['id'],
					'button_label' => __( 'Like!', $textdomain ),
					'count'        => $model->get_count( $atts['id'] ),
					'classnames'        => Utils::classnames( $classnames )
				),
				false
			);
		}

		return $view->render(
			$this->view_file,
			array(
				'id'           => $atts['id'],
				'button_label' => __( 'Like!', $textdomain ),
				'count'        => 0,
				'classnames'   => Utils::classnames( $classnames )
			),
			false
		);
	}

}
