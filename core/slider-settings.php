<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Slider Settings
*/
trait Hmt_Slider_Settings
{
    protected $fields, $settings, $options;
    
    protected function hmt_set_slider_settings( $post ) {

        $this->fields = $this->hmt_slider_settings_option_fileds();

        $this->options  = $this->hmt_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'hmt_slider_settings', $this->options, $post );

        return update_option( 'hmt_slider_settings', serialize( $this->settings ) );
    }

    protected function hmt_get_slider_settings() {

        $this->fields   = $this->hmt_slider_settings_option_fileds();
		$this->settings = stripslashes_deep( unserialize( get_option('hmt_slider_settings') ) );
        
        return $this->hmt_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function hmt_slider_settings_option_fileds() {

        return [
            [
                'name'      => 'hmt_animation',
                'type'      => 'string',
                'default'   => 'slide',
            ],
            [
                'name'      => 'hmt_direction',
                'type'      => 'string',
                'default'   => 'horizontal',
            ],
            [
                'name'      => 'hmt_autoplay',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'hmt_autoplay_speed',
                'type'      => 'number',
                'default'   => 3000,
            ],
            [
                'name'      => 'hmt_navigation_icon_color',
                'type'      => 'text',
                'default'   => '#5E24DD',
            ],
            [
                'name'      => 'hmt_navigation_hover_bg_color',
                'type'      => 'text',
                'default'   => '#8a6fce',
            ],
            [
                'name'      => 'hmt_pagination_color',
                'type'      => 'text',
                'default'   => '#8a6fce',
            ],
            [
                'name'      => 'hmt_pagination_active_color',
                'type'      => 'text',
                'default'   => '#5E24DD',
            ],
        ];

    }
}