<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//print_r( $hmtThemeSettings );
foreach ( $hmtThemeSettings as $option_name => $option_value ) {
    
    if ( isset( $hmtThemeSettings[$option_name] ) ) {

        ${"" . $option_name}  = $option_value;
    
    }
}
?>
<form name="hmt_theme_settings_form" role="form" class="form-horizontal" method="post" action="" id="hmt-theme-settings-form">
    <table class="hmt-manage-views-table">
    <tr>
        <td colspan="2"><hr><strong><?php _e('Select a Theme', HMT_TXT_DOMAIN); ?></strong><hr></td>
    </tr>
    <tr>
        <td>
            <div class="hmt-theme-selector">
                <?php for($i=1; $i<3; $i++): ?>
                    <div class="hmt-theme-item">
                        <input type="radio" name="hmt_theme" id="<?php printf('hmt-theme-%d', $i); ?>" value="<?php printf('theme-%d', $i); ?>" <?php if ( $hmt_theme === "theme-".$i ) { echo 'checked'; } ?>>
                        <label for="<?php printf('hmt-theme-%d', $i);?>" class="hmt-theme-label">
                            <img src="<?php echo esc_url( HMT_ASSETS ) ; ?><?php printf('img/theme-%d', $i); ?>.jpg" alt="<?php printf('Theme %d', $i); ?>">
                        </label>
                    </div>
                <?php endfor; ?>
            </div>
        </td>
    </tr>
    </table>
    <p class="submit"><button id="button-theme-settings" name="btnThemeSettings" class="button button-primary hmt-button"><?php _e('Save Settings', HMT_TXT_DOMAIN); ?></button></p>
</form>