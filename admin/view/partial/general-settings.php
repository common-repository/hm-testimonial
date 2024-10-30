<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//print_r( $hmtGeneralSettings );
foreach ( $hmtGeneralSettings as $option_name => $option_value ) {
    
    if ( isset( $hmtGeneralSettings[$option_name] ) ) {

        ${"" . $option_name}  = $option_value;
    
    }
}
?>
<form name="hmt_general_settings_form" role="form" class="form-horizontal" method="post" action="" id="hmt-general-settings-form">
    <table class="hmt-manage-views-table">
    <tr>
        <th scope="row">
            <label><?php _e('Orber By', HMT_TXT_DOMAIN); ?>:</label>
        </th>
        <td>
            <select name="hmt_order_by" class="small-text">
                <option value="title" <?php echo ( 'title' === $hmt_order_by ) ? 'selected' : ''; ?>><?php _e('Title', HMT_TXT_DOMAIN); ?></option>
                <option value="date" <?php echo ( 'date' === $hmt_order_by ) ? 'selected' : ''; ?>><?php _e('Date', HMT_TXT_DOMAIN); ?></option>
                <option value="menu_order" <?php echo ( 'menu_order' === $hmt_order_by ) ? 'selected' : ''; ?>><?php _e('Post Order', HMT_TXT_DOMAIN); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Order With', HMT_TXT_DOMAIN); ?>:</label>
        </th>
        <td>
            <input type="radio" name="hmt_order_with" id="hmt_order_with_asc" value="ASC" <?php echo ( 'ASC' === esc_attr( $hmt_order_with ) ) ? 'checked' : ''; ?> >
            <label for="hmt_order_with_asc"><span></span><?php _e( 'ASC', HMT_TXT_DOMAIN ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="hmt_order_with" id="hmt_order_with_desc" value="DESC" <?php echo ( 'DESC' === esc_attr( $hmt_order_with ) ) ? 'checked' : ''; ?> >
            <label for="hmt_order_with_desc"><span></span><?php _e( 'DESC', HMT_TXT_DOMAIN ); ?></label>
        </td>
    </tr>
    </table>
    <p class="submit"><button id="button-general-settings" name="btnGeneralSettings" class="button button-primary hmt-button"><?php _e('Save Settings', HMT_TXT_DOMAIN); ?></button></p>
</form>