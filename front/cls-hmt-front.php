<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Master Class: Front
*/
class HMT_Front 
{

	use Hmt_Common, Hmt_General_Settings, Hmt_Theme_Settings, Hmt_Slider_Settings;

	private $hmt_version;

	function __construct( $version ) {
		$this->hmt_version = $version;
		$this->hmt_assets_prefix = substr(HMT_PRFX, 0, -1) . '-';
	}
	
	function hmt_front_assets() {
		
		$hmtSliderSettings = $this->hmt_get_slider_settings();

		foreach ( $hmtSliderSettings as $option_name => $option_value ) {
    
			if ( isset( $hmtSliderSettings[$option_name] ) ) {
		
				${"" . $option_name}  = $option_value;
			
			}
		}

		wp_enqueue_style(
			$this->hmt_assets_prefix . 'font-awesome', 
			HMT_ASSETS .'css/font-awesome/css/font-awesome.min.css',
			array(),
			$this->hmt_version,
			FALSE
		);
		
		wp_enqueue_style('flexslider', 
			HMT_ASSETS . 'css/flexslider.css', 
			false, 
			$this->hmt_version, 
			false
		);

		wp_enqueue_style('hmt-front',
			HMT_ASSETS . 'css/' . $this->hmt_assets_prefix . 'front.css',
			array(),
			$this->hmt_version,
			false
		);
		
		if ( ! wp_script_is( 'jquery' ) ) {
			wp_enqueue_script('jquery');
		}

		wp_enqueue_script('flexslider', 
			HMT_ASSETS . 'js/jquery.flexslider-min.js', 
			array('jquery'), 
			$this->hmt_version, 
			true
		);

		wp_enqueue_script('hmt-front',
			HMT_ASSETS . 'js/' . $this->hmt_assets_prefix . 'front.js',
			array('jquery'),
			$this->hmt_version,
			true
		);

		wp_localize_script( 'hmt-front', 'hmtSliderOption', $hmtSliderSettings );
	}

	function hmt_load_shortcode() {
		add_shortcode( 'hm_testimonial', array( $this, 'hmt_load_shortcode_view' ) );
	}

	function hmt_load_shortcode_view( $hmtAttr ) {

		$output = '';
		ob_start();
		include HMT_PATH . 'front/view/' . $this->hmt_assets_prefix . 'front-view.php';
		$output .= ob_get_clean();
		return $output;
	}
}
?>