<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: General Settings
*/
trait Hmt_General_Settings
{
    protected $fields, $settings, $options;
    
    protected function hmt_set_general_settings( $post ) {

        $this->fields = $this->hmt_general_settings_option_fileds();

        $this->options  = $this->hmt_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'hmt_general_settings', $this->options, $post );

        return update_option( 'hmt_general_settings', serialize( $this->settings ) );
    }

    protected function hmt_get_general_settings() {

        $this->fields   = $this->hmt_general_settings_option_fileds();
		$this->settings = stripslashes_deep( unserialize( get_option('hmt_general_settings') ) );
        
        return $this->hmt_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function hmt_general_settings_option_fileds() {

        return [
            [
                'name'      => 'hmt_order_by',
                'type'      => 'string',
                'default'   => 'title',
            ],
            [
                'name'      => 'hmt_order_with',
                'type'      => 'string',
                'default'   => 'ASC',
            ],
            [
                'name'      => 'hmls_play_pause',
                'type'      => 'number',
                'default'   => '',
            ],
            [
                'name'      => 'hmls_slide_interval',
                'type'      => 'number',
                'default'   => 5000,
            ],
            [
                'name'      => 'hmls_slide_focus',
                'type'      => 'number',
                'default'   => 0,
            ],
            [
                'name'      => 'hmls_slide_height',
                'type'      => 'number',
                'default'   => 100,
            ],
            [
                'name'      => 'hmls_slide_gap',
                'type'      => 'number',
                'default'   => 0,
            ],
            [
                'name'      => 'hmls_slide_fixed_width',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'hmls_slide_display_tooltip',
                'type'      => 'boolean',
                'default'   => false,
            ],
        ];

    }
}