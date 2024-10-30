<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once HMT_PATH . 'core/common.php';
include_once HMT_PATH . 'core/general-settings.php';
include_once HMT_PATH . 'core/theme-settings.php';
include_once HMT_PATH . 'core/slider-settings.php';

class HMT_Master {

	protected $hmt_loader;
	protected $hmt_version;

	/**
	 * Class Constructor
	 */
	function __construct() {
		$this->hmt_version = HMT_VERSION;
		$this->hmt_load_dependencies();
		$this->hmt_trigger_admin_hooks();
		$this->hmt_trigger_front_hooks();
	}

	private function hmt_load_dependencies() {
		require_once HMT_PATH . 'admin/' . HMT_CLS_PRFX . 'admin.php';
		require_once HMT_PATH . 'front/' . HMT_CLS_PRFX . 'front.php';
		require_once HMT_PATH . 'inc/' . HMT_CLS_PRFX . 'loader.php';
		$this->hmt_loader = new HMT_Loader();
	}

	private function hmt_trigger_admin_hooks() {
		$hmt_admin = new HMT_Admin($this->hmt_version());
		$this->hmt_loader->add_action('admin_enqueue_scripts', $hmt_admin, HMT_PRFX . 'enqueue_assets');
		$this->hmt_loader->add_action('init', $hmt_admin, HMT_PRFX . 'custom_post_type', 0);
		$this->hmt_loader->add_action('add_meta_boxes', $hmt_admin, HMT_PRFX . 'metaboxes');
		$this->hmt_loader->add_action('save_post', $hmt_admin, HMT_PRFX . 'save_meta_value', 1, 1);
		$this->hmt_loader->add_action('admin_menu', $hmt_admin, HMT_PRFX . 'admin_menu', 0);
		$this->hmt_loader->add_action('admin_init', $hmt_admin, HMT_PRFX . 'flush_rewrite');
		$this->hmt_loader->add_action('init', $hmt_admin, HMT_PRFX . 'taxonomy_for_testimonials', 0);
	}

	function hmt_trigger_front_hooks() {
		$hmt_front = new HMT_Front($this->hmt_version());
		$this->hmt_loader->add_action('wp_enqueue_scripts', $hmt_front, HMT_PRFX . 'front_assets');
		$hmt_front->hmt_load_shortcode();
	}

	function hmt_run() {
		$this->hmt_loader->hmt_run();
	}

	function hmt_version() {
		return $this->hmt_version;
	}
}