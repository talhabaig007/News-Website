<?php
/**
 * Handles hooks for frontend sections
 * 
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
/*-------------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'cvmn_frontend_header' ) ) :
    /**
     * Page Header Function
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_header() {
        $maintenance_notice_options = get_option( 'maintenance_notice_options' );
        extract( $maintenance_notice_options );
?>
        <header class="page-header">
            <?php
                if ( !empty( $cvmn_logo ) ) {
            ?>
                    <img src="<?php echo esc_url( $cvmn_logo ); ?>" alt="<?php echo esc_html__( 'Maintenance Notice', 'maintenance-notice' ); ?>" class="cvmn-header-logo">
            <?php
                }
            ?>
            <h1 class="page-title"><?php esc_html_e( $cvmn_page_title ); ?></h1>
        </header><!-- .page-header -->
<?php
    }
    
endif;

add_action( 'cvmn_frontend_header_section', 'cvmn_frontend_header' );
/*-------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'cvmn_frontend_content_start' ) ) :
    /**
     * Page content start
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_content_start() {
        echo '<div class="page-content">';
    }

endif;

if ( !function_exists( 'cvmn_frontend_content_page_header' ) ) :
    /**
     * Page content page header
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_content_page_header() {
        $maintenance_notice_options = get_option( 'maintenance_notice_options' );
        extract( $maintenance_notice_options );
?>
        <div class="page-heading">
            <?php esc_html_e( $cvmn_page_heading ); ?>
        </div>
<?php
    }

endif;

if ( !function_exists( 'cvmn_frontend_content_page_description' ) ) :
    /**
     * Page content page description
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_content_page_description() {
        $maintenance_notice_options = get_option( 'maintenance_notice_options' );
        extract( $maintenance_notice_options );
?>
        <div class="page-description">
            <?php echo wp_kses_post( $cvmn_page_description ); ?>
        </div>
<?php
    }

endif;

if ( !function_exists( 'cvmn_frontend_content_page_button_group' ) ) :
    /**
     * Page content page button group
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_content_page_button_group() {
        $maintenance_notice_options = get_option( 'maintenance_notice_options' );
        extract( $maintenance_notice_options );
?>
        <div class="cvmn-button-main-wrap">
            <?php
                if ( !empty( $cvmn_button_one_link ) && !empty( $cvmn_button_one_label ) ) {
                    echo '<div class="cvmn-button cvmn-button-one">';
                        echo '<a href="' .esc_url( $cvmn_button_one_link ). '">' .esc_html( $cvmn_button_one_label ). '</a>';
                    echo '</div>';
                }
            ?>
        </div><!-- .cvmn-button-main-wrap -->
<?php
    }

endif;

if ( !function_exists( 'cvmn_frontend_content_page_countdown_section' ) ) :
    /**
     * Page content page countdown section
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_content_page_countdown_section() {
        $maintenance_notice_options = get_option( 'maintenance_notice_options' );
        extract( $maintenance_notice_options );
            if ( $cvmn_countdown_display === 'show' ) {
                    // countdown section
                    cvmn_countdown_section();
                if ( $cvmn_countdown_end_popup_content ) {
        ?>
                    <div class="cvmn-countdown-content-popup">
                        <?php echo wp_kses_post( $cvmn_countdown_end_popup_content ); ?>
                    </div><!-- .cvmn-countdown-content-popup -->
        <?php
                }
            }
    }

endif;

if ( !function_exists( 'cvmn_frontend_content_page_social_media_lists_section' ) ) :
    /**
     * Page content page social media lists section
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_content_page_social_media_lists_section() {
        $maintenance_notice_options = get_option( 'maintenance_notice_options' );
        extract( $maintenance_notice_options );
        if ( $cvmn_social_icons_display !== 'show' ) {
            return;
        }
    ?>
            <div class="cvmn-frontpage-social-icons-wrapper">
            <?php
                $cvmn_social_icons_array_decoded = json_decode( $cvmn_social_icons_array, true );
                if ( !empty( $cvmn_social_icons_array_decoded ) ) {
                    echo '<ul class="cvmn-social-icons-wrap">';
                        foreach( $cvmn_social_icons_array_decoded as $iconkey => $iconvalue ) {
                            echo '<li><a href="' .esc_url( $iconvalue["cvmn_social_icons_array_icon_url"] ). '" target="_blank"><i class="' .esc_attr( $iconvalue["cvmn_social_icons_array_icon"] ). '"></i></a></li>';        
                        }
                    echo '</ul>';
                }
            ?>
            </div><!-- .cvmn-frontpage-social-icons-wrap -->
    <?php
    }

endif;

if ( !function_exists( 'cvmn_frontend_content_page_login_form_section' ) ) :
    /**
     * Page content page login form content section
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_content_page_login_form_section() {
        $maintenance_notice_options = get_option( 'maintenance_notice_options' );
        extract( $maintenance_notice_options );
        if ( $cvmn_login_form_display !== 'show' ) {
            return;
        }
    ?>
        <div class="cvmn-login-main-wrapper">
            <div id="cvmn-login-trigger"><i class="fas fa-cog"></i></div>
                <div class="cvmn-login-form-wrapper">
                    <?php
                        if ( !empty( $cvmn_login_form_title ) ) {
                            echo '<h2 class="cvmn-login-title">' .esc_html( $cvmn_login_form_title ). '</h2>';
                        }
                        wp_login_form(  array(
                                            'echo'      => true,
                                            'form_id'   => 'cvmn-login-form'
                                        )
                                    );
                    ?>
                </div><!-- .cvmn-login-form-wrapper -->
            </div><!-- .cvmn-login-main-wrapper -->
    <?php
    }

endif;

if ( !function_exists( 'cvmn_frontend_content_end' ) ) :
    /**
     * Page content end
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_content_end() {
        echo '</div><!-- .page-content -->';
    }

endif;
/*-------------------------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'cvmn_frontend_footer_start' ) ) :
    /**
     * Page Footer Start Function
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_footer_start() {
?>
        <footer id="cvmn-footer" class="cvmn-footer">
<?php
    }

endif;

if ( ! function_exists( 'cvmn_frontend_footer_content' ) ) :
    /**
     * Page Footer Function
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_footer_content() {
?>
        <div class="cvmn-footer-content"><?php echo apply_filters( 'cvmn_copyright_text', sprintf( esc_html__( 'copyright %1$s codevibrant %2$s', 'maintenance-notice' ), '&copy;', date( 'Y' ) ) ); ?></div>
<?php
    }

endif;

if ( ! function_exists( 'cvmn_frontend_footer_end' ) ) :
    /**
     * Page Footer End Function
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_footer_end() {
        echo '</footer><!-- #cvmn-footer -->';
    }

endif;

add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_content_start', 10 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_content_page_header', 20 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_content_page_description', 30 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_content_page_button_group', 40 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_content_page_countdown_section', 60 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_content_page_social_media_lists_section', 70 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_content_page_login_form_section', 80 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_footer_start', 90 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_footer_content', 100 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_footer_end', 110 );
add_action( 'cvmn_frontend_main_content_section', 'cvmn_frontend_content_end', 150 );

/*-------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'cvmn_frontend_video_background_element' ) ) :
    /**
     * Video background div
     * 
     * @since 1.0.0
     * 
     */
    function cvmn_frontend_video_background_element() {
        $maintenance_notice_options = get_option( 'maintenance_notice_options' );
        extract( $maintenance_notice_options );
        if ( ( $cvmn_maintenance_page_background_type !== "video-background" ) && empty( $cvmn_background_video_url ) ) {
            return;
        }
?>
        <div id="cvmn-bgVideo" class="cvmn-bgplayer player" data-property="{videoURL:'<?php echo esc_url( $cvmn_background_video_url ); ?>', containment:'body', autoPlay:true, mute:true, loop: true, opacity: 1}"></div>
<?php
    }

endif;
add_action( 'cvmn_frontend_content_postfix', 'cvmn_frontend_video_background_element', 10 );
/*-------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'cvmn_countdown_section' ) ) :
    
    /**
     * Countdown section
     * 
     */
    function cvmn_countdown_section() {
        $maintenance_notice_options = get_option( 'maintenance_notice_options' );
        extract( $maintenance_notice_options );
    ?>
        <ul class="cvmn-countdown-content" data-date="<?php echo esc_html( $cvmn_countdown_end_date ); ?>" data-time="<?php echo esc_html( $cvmn_countdown_end_time ); ?>">
            <li><span class="days">00</span><p class="days_text"><?php esc_html_e( 'Days', 'maintenance-notice' ); ?></p></li>
            <li class="seperator">:</li>
            <li><span class="hours">00</span><p class="hours_text"><?php esc_html_e( 'Hours', 'maintenance-notice' ); ?></p></li>
            <li class="seperator">:</li>
            <li><span class="minutes">00</span><p class="minutes_text"><?php esc_html_e( 'Minutes', 'maintenance-notice' ); ?></p></li>
            <li class="seperator">:</li>
            <li><span class="seconds">00</span><p class="seconds_text"><?php esc_html_e( 'Seconds', 'maintenance-notice' ); ?></p></li>
        </ul>
    <?php
    }

endif;