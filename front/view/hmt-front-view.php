<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$hmtGeneralSettings = $this->hmt_get_general_settings();

foreach ( $hmtGeneralSettings as $gn_name => $gn_value ) {

	if ( isset( $hmtGeneralSettings[$gn_name] ) ) {

		${"" . $gn_name}  = $gn_value;
	
	}
}

$hmtThemeSettings = $this->hmt_get_theme_settings();

foreach ( $hmtThemeSettings as $ts_name => $ts_value ) {

	if ( isset( $hmtThemeSettings[$ts_name] ) ) {

		${"" . $ts_name}  = $ts_value;
	
	}
}

$hmtSliderSettings = $this->hmt_get_slider_settings();

foreach ( $hmtSliderSettings as $option_name => $option_value ) {

	if ( isset( $hmtSliderSettings[$option_name] ) ) {

		${"" . $option_name}  = $option_value;
	
	}
}

// Shortcoded Options
$hmtCategory = isset( $hmtAttr['category'] ) ? $hmtAttr['category'] : null;

$hmtArr = array(
	'post_type'   => 'hm_testimonial',
	'post_status' => 'publish',
	'orderby'     => $hmt_order_by,
	'order'       => $hmt_order_with,
	'meta_query'  => array(
	  'relation' => 'and',
	  array(
		'key' => 'hmt_status',
		'value' => 'active',
		'compare' => '='
	  ),
	),
);

// If Categor params found in shortcode
if ( $hmtCategory ) {

	$hmtArr['tax_query'] = array(
		array(
		'taxonomy'  => 'hm_testimonial_category',
		'field'     => 'name',
		'terms'     => $hmtCategory
		)
	);
}

$hmtData = new WP_Query( $hmtArr );

include HMT_PATH . 'assets/css/hmt-styles.php';
?>
<div class="flexslider">
	<ul class="slides">
		<?php
		if ( $hmtData->have_posts() ) {

			while ( $hmtData->have_posts() ) {

				$hmtData->the_post();

				$hmt_name		= get_post_meta( $post->ID, 'hmt_name', true );
				$hmt_company	= get_post_meta( $post->ID, 'hmt_company', true );
				$hmt_position	= get_post_meta( $post->ID, 'hmt_position', true );
				$hmt_star 		= get_post_meta( $post->ID, 'hmt_star', true );
				?>
				<li>
					<div class="hmt-content-wrapper <?php esc_attr_e( $hmt_theme ); ?>">
						<div class="hmt-img-container">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail('medium');
							}
							?>
						</div>
						<div class="hmt-content">
							<div class="hmt-content-header">
								<h4 class="testimonials-name">
									<?php esc_html_e( $hmt_name ); ?>
								</h4>
								<span><?php esc_html_e( $hmt_position ); ?> - <?php esc_html_e( $hmt_company ); ?></span>
								<?php
								if ( $hmt_star ) {
									?>
									<div class="hmt-rating">
										<?php for( $rs=1; $rs <= $hmt_star; $rs++ ) : ?>
											<span class="fa fa-star"></span>
										<?php endfor; ?>
										<?php 
										if ( ( 5 - $hmt_star ) > 0 ) {
											for ( $rns=1; $rns <= ( 5 - $hmt_star ); $rns++ ) {
												?>
												<span class="fa fa-star-o"></span>
												<?php 
											}
										} 
										?>
									</div>
									<?php
								}
								?>
								<div class="hmt-border"></div>
							</div>
							<?php the_content(); ?>
						</div>
					</div>
				</li>
				<?php
			}
			wp_reset_postdata();

		}
		?>
	</ul>
</div>