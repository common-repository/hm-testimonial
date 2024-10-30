<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Master Class: Admin
*/
class HMT_Admin 
{
	use Hmt_Common, Hmt_General_Settings, Hmt_Theme_Settings, Hmt_Slider_Settings;

	private $hmt_version;
	private $hmt_assets_prefix;

	function __construct( $version ) {

		$this->hmt_version = $version;
		$this->hmt_assets_prefix = substr( HMT_PRFX, 0, -1 ) . '-';
	}

	/**
	 *	Flush Rewrite on Plugin initialization
	 */
	function hmt_flush_rewrite() {

		if ( get_option('hmt_plugin_settings_have_changed') == true ) {
			flush_rewrite_rules();
			update_option('hmt_plugin_settings_have_changed', false);
		}

		if ( get_option('hmt_do_activation_redirect', false) ) {
			delete_option('hmt_do_activation_redirect');
			exit( wp_redirect("edit.php?post_type=hm_testimonial&page=hmt-get-help") );
		}
	}

	/**
	 *	Loading admin menu
	 */
	function hmt_admin_menu() {

		$hmt_cpt_menu = 'edit.php?post_type=hm_testimonial';

		add_submenu_page(
			$hmt_cpt_menu,
			__('Manage Views', HMT_TXT_DOMAIN),
			__('Manage Views', HMT_TXT_DOMAIN),
			'manage_options',
			'hmt-manage-views',
			array($this, HMT_PRFX . 'manage_views')
		);

		add_submenu_page(
            $hmt_cpt_menu,
            __( 'Usage & Tutorial', HMT_TXT_DOMAIN ),
            __( 'Usage & Tutorial', HMT_TXT_DOMAIN ),
            'manage_options',
            'hmt-get-help',
            array( $this, HMT_PRFX . 'get_help' )
        );
	}

	/**
	 *	Loading admin panel assets
	 */
	function hmt_enqueue_assets() {

		wp_enqueue_style( 'wp-color-picker');

		wp_enqueue_style(
			$this->hmt_assets_prefix . 'font-awesome', 
			HMT_ASSETS .'css/font-awesome/css/font-awesome.min.css',
			array(),
			$this->hmt_version,
			FALSE
		);

		wp_enqueue_style(
			$this->hmt_assets_prefix . 'admin-style',
			HMT_ASSETS . 'css/' . $this->hmt_assets_prefix . 'admin.css',
			array(),
			$this->hmt_version,
			FALSE
		);

		if ( ! wp_script_is('jquery') ) {
			wp_enqueue_script('jquery');
		}
		
		wp_enqueue_script( 'wp-color-picker');
		
		wp_enqueue_script(
			$this->hmt_assets_prefix . 'admin-script',
			HMT_ASSETS . 'js/' . $this->hmt_assets_prefix . 'admin.js',
			array('jquery'),
			$this->hmt_version,
			TRUE
		);
	}

	function hmt_custom_post_type() {

		$labels = array(
							'name'                => __('All Testimonials', HMT_TXT_DOMAIN),
							'singular_name'       => __('All Testimonial', HMT_TXT_DOMAIN),
							'menu_name'           => __('HM Testimonial', HMT_TXT_DOMAIN),
							'parent_item_colon'   => __('Parent Testimonial', HMT_TXT_DOMAIN),
							'all_items'           => __('All Testimonials', HMT_TXT_DOMAIN),
							'view_item'           => __('View Testimonial', HMT_TXT_DOMAIN),
							'add_new_item'        => __('Add New Testimonial', HMT_TXT_DOMAIN),
							'add_new'             => __('Add New', HMT_TXT_DOMAIN),
							'edit_item'           => __('Edit Testimonial', HMT_TXT_DOMAIN),
							'update_item'         => __('Update Testimonial', HMT_TXT_DOMAIN),
							'search_items'        => __('Search Testimonial', HMT_TXT_DOMAIN),
							'not_found'           => __('Not Found', HMT_TXT_DOMAIN),
							'not_found_in_trash'  => __('Not found in Trash', HMT_TXT_DOMAIN)
						);
		$args = array(
						'label'               => __('hm_testimonial', HMT_TXT_DOMAIN),
						'description'         => __('Description For Testimonial', HMT_TXT_DOMAIN),
						'labels'              => $labels,
						'supports'            => array('title', 'editor', 'thumbnail', 'page-attributes'),
						'public'              => true,
						'hierarchical'        => false,
						'show_ui'             => true,
						'show_in_menu'        => true,
						'show_in_nav_menus'   => true,
						'show_in_admin_bar'   => true,
						'has_archive'         => false,
						'can_export'          => true,
						'exclude_from_search' => false,
						'yarpp_support'       => true,
						//'taxonomies' 	      => array('post_tag'),
						'publicly_queryable'  => true,
						'capability_type'     => 'page',
						'menu_icon'           => 'dashicons-star-filled'
					);

		register_post_type('hm_testimonial', $args);
	}

	function hmt_taxonomy_for_testimonials() {

		$labels = array(
			'name' 				=> __('Testimonial Categories', HMT_TXT_DOMAIN),
			'singular_name' 	=> __('Testimonial Category', HMT_TXT_DOMAIN),
			'search_items' 		=> __('Search Testimonial Categories', HMT_TXT_DOMAIN),
			'all_items' 		=> __('All Testimonial Categories', HMT_TXT_DOMAIN),
			'parent_item' 		=> __('Parent Testimonial Category', HMT_TXT_DOMAIN),
			'parent_item_colon'	=> __('Parent Testimonial Category:', HMT_TXT_DOMAIN),
			'edit_item' 		=> __('Edit Testimonial Category', HMT_TXT_DOMAIN),
			'update_item' 		=> __('Update Testimonial Category', HMT_TXT_DOMAIN),
			'add_new_item' 		=> __('Add New Testimonial Category', HMT_TXT_DOMAIN),
			'new_item_name' 	=> __('New Testimonial Category Name', HMT_TXT_DOMAIN),
			'menu_name' 		=> __('Testimonial Categories', HMT_TXT_DOMAIN),
		);

		register_taxonomy('hm_testimonial_category', array('hm_testimonial'), array(
			'hierarchical' 		=> true,
			'labels' 			=> $labels,
			'show_ui' 			=> true,
			'show_admin_column' => true,
			'query_var' 		=> true,
			'rewrite' 			=> array('slug' => 'testimonial-category'),
		));
	}

	function hmt_metaboxes() {

		add_meta_box(
			'hmt-metaboxes',
			__('Reviewer Information:', HMT_TXT_DOMAIN),
			array( $this, HMT_PRFX . 'metabox_content' ),
			'hm_testimonial',
			'normal',
			'high'
		);
	}

	function hmt_metabox_content() {
		
		global $post;

		wp_nonce_field( basename(__FILE__), 'hmt_fields' );

		$hmt_name		= get_post_meta( $post->ID, 'hmt_name', true );
		$hmt_company	= get_post_meta( $post->ID, 'hmt_company', true );
		$hmt_position	= get_post_meta( $post->ID, 'hmt_position', true );
		$hmt_star		= get_post_meta( $post->ID, 'hmt_star', true );
		$hmt_status		= get_post_meta( $post->ID, 'hmt_status', true );
		?>
		<table class="form-table">
			<tr>
				<th scope="row">
					<label><?php _e('Name', HMT_TXT_DOMAIN); ?>:</label>
				</th>
				<td>
					<input type="text" name="hmt_name" value="<?php echo esc_attr( $hmt_name ); ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label><?php _e('Company', HMT_TXT_DOMAIN); ?>:</label>
				</th>
				<td>
					<input type="text" name="hmt_company" value="<?php echo esc_attr( $hmt_company ); ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label><?php _e('Identity/Position', HMT_TXT_DOMAIN); ?>:</label>
				</th>
				<td>
					<input type="text" name="hmt_position" value="<?php echo esc_attr( $hmt_position ); ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label><?php _e('Star', HMT_TXT_DOMAIN); ?>:</label>
				</th>
				<td>
					<select name="hmt_star" class="small-text">
						<option value="5" <?php echo ( '5' == $hmt_star ) ? 'selected' : ''; ?>><?php _e('5 Star', HMT_TXT_DOMAIN); ?></option>
						<option value="4" <?php echo ( '4' == $hmt_star ) ? 'selected' : ''; ?>><?php _e('4 Star', HMT_TXT_DOMAIN); ?></option>
						<option value="3" <?php echo ( '3' == $hmt_star ) ? 'selected' : ''; ?>><?php _e('3 Star', HMT_TXT_DOMAIN); ?></option>
						<option value="2" <?php echo ( '2' == $hmt_star ) ? 'selected' : ''; ?>><?php _e('2 Star', HMT_TXT_DOMAIN); ?></option>
						<option value="1" <?php echo ( '1' == $hmt_star ) ? 'selected' : ''; ?>><?php _e('1 Star', HMT_TXT_DOMAIN); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="hmt_status"><?php _e('Status', HMT_TXT_DOMAIN); ?>:</label>
				</th>
				<td>
					<input type="radio" name="hmt_status" class="hmt_status" id="hmt_status_active" value="active" <?php echo ( 'inactive' !== esc_attr( $hmt_status ) ) ? 'checked' : ''; ?> >
					<label for="hmt_status_active"><span></span><?php _e( 'Active', HMT_TXT_DOMAIN ); ?></label>
					&nbsp;&nbsp;
					<input type="radio" name="hmt_status" class="hmt_status" id="hmt_status_inactive" value="inactive" <?php echo ( 'inactive' === esc_attr( $hmt_status ) ) ? 'checked' : ''; ?> >
					<label for="hmt_status_inactive"><span></span><?php _e( 'Inactive', HMT_TXT_DOMAIN ); ?></label>
				</td>
			</tr>
		</table>
		<?php
	}

	/**
	 * Save the metabox data
	 */
	function hmt_save_meta_value( $post_id ) {
		
		global $post;

		if( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if( ! isset( $_POST['hmt_name'] ) || ! wp_verify_nonce( $_POST['hmt_fields'], basename(__FILE__) ) ) {
			return $post_id;
		}

		$hmt_meta['hmt_name'] 		= sanitize_text_field( $_POST['hmt_name'] ) ? sanitize_text_field( $_POST['hmt_name'] ) : '';
		$hmt_meta['hmt_company']	= sanitize_text_field( $_POST['hmt_company'] ) ? sanitize_text_field( $_POST['hmt_company'] ) : '';
		$hmt_meta['hmt_position']	= sanitize_text_field( $_POST['hmt_position'] ) ? sanitize_text_field( $_POST['hmt_position'] ) : '';
		$hmt_meta['hmt_star']		= ( sanitize_text_field( $_POST['hmt_star'] ) != '' ) ? sanitize_text_field( $_POST['hmt_star'] ) : '';
		$hmt_meta['hmt_status']		= ( sanitize_text_field( $_POST['hmt_status'] ) != '' ) ? sanitize_text_field( $_POST['hmt_status'] ) : '';

		foreach( $hmt_meta as $key => $value ) {
			if ('revision' === $post->post_type) {
				return;
			}
			if (get_post_meta($post_id, $key, false)) {
				update_post_meta($post_id, $key, $value);
			} else {
				add_post_meta($post_id, $key, $value);
			}
			if (!$value) {
				delete_post_meta($post_id, $key);
			}
		}
	}

	function hmt_manage_views() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
	
		$hmtTab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null;

		$hmtMessage	= false;

		if ( isset( $_POST['btnGeneralSettings'] ) ) {

			$hmtMessage = $this->hmt_set_general_settings( $_POST );
		}

		$hmtGeneralSettings = $this->hmt_get_general_settings();

		if ( isset( $_POST['btnThemeSettings'] ) ) {

			$hmtMessage = $this->hmt_set_theme_settings( $_POST );
		}

		$hmtThemeSettings = $this->hmt_get_theme_settings();

		if ( isset( $_POST['btnSliderSettings'] ) ) {

			$hmtMessage = $this->hmt_set_slider_settings( $_POST );
		}

		$hmtSliderSettings = $this->hmt_get_slider_settings();

		require_once HMT_PATH . 'admin/view/' . $this->hmt_assets_prefix . 'manage-views.php';
	}

	function hmt_get_help() {
        require_once HMT_PATH . 'admin/view/' . $this->hmt_assets_prefix . 'help-usage.php';
    }

	function hmt_display_notification( $type, $msg ) { 
		?>
		<div class="hmt-alert <?php esc_attr_e( $type ); ?>">
			<span class="hmt-closebtn">&times;</span>
			<strong><?php esc_html_e( ucfirst( $type ) ); ?>!</strong>
			<?php esc_html_e( $msg, HMT_TXT_DOMAIN ); ?>
		</div>
		<?php 
	}
}
?>