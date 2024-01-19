<?php
/**
 * Template part for Page Style One
 * 
 * @package Maintenance Notice
 * @since 1.0.0
 *  
 */
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="cvmn-frontpage">
            <?php
                /**
                 * hook - cvmn_frontend_header_section
                 * 
                 * hooked - cvmn_frontend_header
                 * 
                 */
                do_action( 'cvmn_frontend_header_section' );

                /**
                 * hook - cvmn_frontend_main_content_section
                 * 
                 * hooked - cvmn_frontend_content_start
                 * hooked - cvmn_frontend_content_page_header
                 * hooked - cvmn_frontend_content_page_description
                 * hooked - cvmn_frontend_content_page_button_group
                 * hooked - cvmn_frontend_content_page_countdown_section
                 * hooked - cvmn_frontend_content_page_social_media_lists_section
                 * hooked - cvmn_frontend_content_page_login_form_section
                 * hooked - cvmn_frontend_content_end
                 * 
                 */
                do_action( 'cvmn_frontend_main_content_section' );

                /**
                 * hook - cvmn_frontend_footer_section
                 * 
                 * hooked - cvmn_frontend_footer_start
                 * hooked - cvmn_frontend_footer_content
                 * hooked - cvmn_frontend_footer_end
                 * 
                 */
                do_action( 'cvmn_frontend_footer_section' );

                /**
                 * hook - cvmn_frontend_content_postfix
                 * 
                 * hooked - cvmn_frontend_video_background_element
                 * 
                 */
                do_action( 'cvmn_frontend_content_postfix' );
            ?>
            
        </section><!-- .cvmn-frontpage -->
    </main><!-- #main -->
</div><!-- #primary -->