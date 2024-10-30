<?php
/**
 * Plugin Name: 	HM Testimonial
 * Plugin URI:		http://wordpress.org/plugins/hm-testimonial/
 * Description: 	This Testimonial Plugin will display testimonials in your website page or post by using the shortcode: [hm_testimonial]
 * Version: 		1.4
 * Author:		    HM Plugin
 * Author URI:	    https://hmplugin.com
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/*
if ( function_exists( 'hmt_fs' ) ) {

    hmt_fs()->set_basename( true, __FILE__ );

} else {

    if ( ! class_exists('HMT_Master') ) {}
}
*/
define('HMT_PATH', plugin_dir_path(__FILE__));
define('HMT_ASSETS', plugins_url('/assets/', __FILE__));
define('HMT_SLUG', plugin_basename(__FILE__));
define('HMT_PRFX', 'hmt_');
define('HMT_CLS_PRFX', 'cls-hmt-');
define('HMT_TXT_DOMAIN', 'hm-testimonial');
define('HMT_VERSION', '1.4');

//require_once HMT_PATH . '/lib/freemius-integrator.php';
require_once HMT_PATH . 'inc/' . HMT_CLS_PRFX . 'master.php';

$hmt = new HMT_Master();
$hmt->hmt_run();

// Donate link to plugin description
function hmt_display_donation_link( $links, $file ) {

    if ( HMT_SLUG === $file ) {
        $row_meta = array(
        'hmt_donation'  => '<a href="' . esc_url( 'https://www.paypal.me/mhmrajib/' ) . '" target="_blank" aria-label="' . esc_attr__('Donate us', HMT_TXT_DOMAIN) . '" style="color:green; font-weight: bold;">' . esc_html__('Donate us', HMT_TXT_DOMAIN) . '</a>'
        );

        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}
add_filter( 'plugin_row_meta', 'hmt_display_donation_link', 10, 2 );

// Redirect after plugin activated
register_activation_hook(__FILE__, 'hmt_plugin_activate');
function hmt_plugin_activate() {
    add_option('hmt_do_activation_redirect', true);
}

// Add settikngs page afetr deactivate | settings in plugin page
function hmt_show_extra_link( $links ) {

	$links = array_merge( array(
		'<a href="' . esc_url( admin_url( 'edit.php?post_type=hm_testimonial&page=hmt-manage-views' ) ) . '">' . __( 'Manage Views', HMT_TXT_DOMAIN ) . '</a>'
	), $links );

	return $links;

}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'hmt_show_extra_link' );