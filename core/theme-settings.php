<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Theme Settings
*/
trait Hmt_Theme_Settings
{
    protected $fields, $settings, $options;
    
    protected function hmt_set_theme_settings( $post ) {

        $this->fields = $this->hmt_theme_settings_option_fileds();

        $this->options  = $this->hmt_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'hmt_theme_settings', $this->options, $post );

        return update_option( 'hmt_theme_settings', $this->settings );
    }

    protected function hmt_get_theme_settings() {

        $this->fields   = $this->hmt_theme_settings_option_fileds();
		$this->settings = get_option('hmt_theme_settings');
        
        return $this->hmt_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function hmt_theme_settings_option_fileds() {

        return [
            [
                'name'      => 'hmt_theme',
                'type'      => 'string',
                'default'   => 'theme-1',
            ],
        ];

    }
}