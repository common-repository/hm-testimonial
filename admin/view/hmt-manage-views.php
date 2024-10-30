<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="wph-wrap-all" class="wrap hmt-manage-views-page">

    <div class="settings-banner">
        <h2 class="hmt-page-title"><i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;<?php _e('Manage Views', HMT_TXT_DOMAIN); ?></h2>
    </div>

    <?php 
        if ( $hmtMessage ) {
            $this->hmt_display_notification('success', 'Your information updated successfully.');
        }
    ?>

    <div class="hmt-wrap">

        <nav class="nav-tab-wrapper">
            <a href="?post_type=hm_testimonial&page=hmt-manage-views&tab=general" class="nav-tab <?php if ( ( 'general' === $hmtTab ) || empty( $hmtTab ) ) { ?>nav-tab-active<?php } ?>">
                <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;<?php _e('General Settings', HMT_TXT_DOMAIN); ?>
            </a>
            <a href="?post_type=hm_testimonial&page=hmt-manage-views&tab=theme" class="nav-tab <?php if ( 'theme' === $hmtTab ) { ?>nav-tab-active<?php } ?>">
                <i class="fa fa-magic" aria-hidden="true"></i>&nbsp;<?php _e('Theme Settings', HMT_TXT_DOMAIN); ?>
            </a>
            <a href="?post_type=hm_testimonial&page=hmt-manage-views&tab=slider" class="nav-tab <?php if ( 'slider' === $hmtTab ) { ?>nav-tab-active<?php } ?>">
                <i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;<?php _e('Slider Control', HMT_TXT_DOMAIN); ?>
            </a>
        </nav>

        <div class="hmt_personal_wrap hmt_personal_help" style="width: 75%; float: left;">
            
            <div class="tab-content">
                <?php 
                switch ( $hmtTab ) {
                    case 'theme':
                        include HMT_PATH . 'admin/view/partial/theme-settings.php';
                        break;
                    case 'slider':
                        include HMT_PATH . 'admin/view/partial/slider-settings.php';
                        break;
                    default:
                        include HMT_PATH . 'admin/view/partial/general-settings.php';
                        break;
                } 
                ?>
            </div>
        
        </div>

        <?php $this->hmt_admin_sidebar(); ?>

    </div>

</div>