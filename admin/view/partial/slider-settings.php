<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//print_r( $hmtSliderSettings );
foreach ( $hmtSliderSettings as $option_name => $option_value ) {
    
    if ( isset( $hmtSliderSettings[$option_name] ) ) {

        ${"" . $option_name}  = $option_value;
    
    }
}
?>
<form name="hmt_slider_settings_form" role="form" class="form-horizontal" method="post" action="" id="hmt-slider-settings-form">
    <table class="hmt-manage-views-table">
        <tr>
            <th scope="row">
                <label><?php _e('Slider Animation', HMT_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input type="radio" name="hmt_animation" id="hmt_animation_slide" value="slide" <?php echo ( 'slide' === $hmt_animation ) ? 'checked' : ''; ?> >
                <label for="hmt_animation_slide"><span></span><?php _e( 'Slide', HMT_TXT_DOMAIN ); ?></label>
                &nbsp;&nbsp;
                <input type="radio" name="hmt_animation" id="hmt_animation_fade" value="fade" <?php echo ( 'fade' === $hmt_animation ) ? 'checked' : ''; ?> >
                <label for="hmt_animation_fade"><span></span><?php _e( 'Fade', HMT_TXT_DOMAIN ); ?></label>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="hmt_autoplay"><?php _e( 'Slider AutoPlay', HMT_TXT_DOMAIN ); ?> ?</label>
            </th>
            <td>
                <input type="checkbox" name="hmt_autoplay" id="hmt_autoplay" value="<?php echo true; ?>" <?php echo $hmt_autoplay ? 'checked' : ''; ?> >
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('AutoPlay Speed', HMT_TXT_DOMAIN); ?> :</label>
            </th>
            <td>
                <input type="number" min="1000" max="7000" step="1000" name="hmt_autoplay_speed" value="<?php esc_attr_e( $hmt_autoplay_speed );?>" >
                <code><?php _e('ms', HMT_TXT_DOMAIN); ?></code>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr><strong><?php _e('Navigation', HMT_TXT_DOMAIN); ?></strong><hr></td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Icon Color', HMT_TXT_DOMAIN); ?> :</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="hmt_navigation_icon_color" id="hmt_navigation_icon_color" value="<?php esc_attr_e( $hmt_navigation_icon_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Hover Background Color', HMT_TXT_DOMAIN); ?> :</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="hmt_navigation_hover_bg_color" id="hmt_navigation_hover_bg_color" value="<?php esc_attr_e( $hmt_navigation_hover_bg_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr><strong><?php _e('Pagination', HMT_TXT_DOMAIN); ?></strong><hr></td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Color', HMT_TXT_DOMAIN); ?> :</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="hmt_pagination_color" id="hmt_pagination_color" value="<?php esc_attr_e( $hmt_pagination_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Active Color', HMT_TXT_DOMAIN); ?> :</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="hmt_pagination_active_color" id="hmt_pagination_active_color" value="<?php esc_attr_e( $hmt_pagination_active_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
    </table>
    <p class="submit"><button id="button-slider-settings" name="btnSliderSettings" class="button button-primary hmt-button"><?php _e('Save Settings', HMT_TXT_DOMAIN); ?></button></p>
</form>