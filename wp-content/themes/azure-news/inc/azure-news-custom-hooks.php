<?php
/**
 * Managed the custom functions and hooks for entire theme.
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*------------------------------ Header Section ------------------------------*/

    if ( ! function_exists( 'azure_news_custom_header_html' ) ) :

        /**
         * function to get custom header markup
         * 
         * @since 1.0.0
         */
        function azure_news_custom_header_html() {
            the_custom_header_markup();
        }

    endif;

    add_action( 'azure_news_header_section', 'azure_news_custom_header_html', 10 );

    if ( ! function_exists( 'azure_news_top_header' ) ) :

        /**
         * function to display the top header section at header area.
         * 
         * @since 1.0.0
         */
        function azure_news_top_header() {
            get_template_part( 'template-parts/header/top', 'header' );
        }

    endif;

    add_action( 'azure_news_header_section', 'azure_news_top_header', 20 );

    if ( ! function_exists( 'azure_news_main_header' ) ) :

        /**
         * function to display the main header section at header area.
         * 
         * @since 1.0.0
         */
        function azure_news_main_header() {
            $azure_news_header_main_area_layout = azure_news_get_customizer_option_value( 'azure_news_header_main_area_layout' );
            $layout = explode( '--', $azure_news_header_main_area_layout );
            $layout = 'header-'.$layout[1];
            get_template_part( 'template-parts/header/main', $layout );
        }

    endif;

    add_action( 'azure_news_header_section', 'azure_news_main_header', 30 );

    if ( ! function_exists( 'header_news_ticker_section' ) ) :

        /**
         * function to display news ticker content in header section
         * 
         * @since 1.0.0
         */
        function header_news_ticker_section() {
            if ( ! is_home() && ! is_front_page() ) {
                return;
            }
            get_template_part( 'template-parts/header/news', 'ticker' );
        }

    endif;

    add_action( 'azure_news_header_section', 'header_news_ticker_section', 40 );

    if ( ! function_exists( 'header_sticky_sidebar_content' ) ) :

        /**
         * function to display the content about header sticky sidebar
         * 
         * @since 1.0.0
         */
        function header_sticky_sidebar_content() {

            if ( false === azure_news_get_customizer_option_value( 'azure_news_header_sticky_sidebar_toggle_enable' ) ) {
                return;
            }
    ?>
            <div class="sidebar-header sticky-header-sidebar">
                <div class="sticky-header-widget-wrapper">
                    <?php
                        if ( is_active_sidebar( 'header-sticky-sidebar' ) ) {
                            dynamic_sidebar( 'header-sticky-sidebar' );
                        }
                    ?>
                </div>
                <div class="sticky-header-sidebar-overlay"> </div>
                <span class="sticky-sidebar-close"><i class="bx bx-x"></i></span>
            </div><!-- .sticky-header-sidebar -->
    <?php
        }

    endif;

    //add_action( 'azure_news_before_main_header', 'header_sticky_sidebar_content', 20 );

/*------------------------------ Frontpage Banner Section --------------------*/

    if ( ! function_exists( 'azure_news_frontpage_main_banner' ) ) :

        /**
         * function to display the main banner section at front page.
         * 
         * @since 1.0.0
         */
        function azure_news_frontpage_main_banner() {
            get_template_part( 'template-parts/frontpage/main', 'banner' );
        }

    endif;

    add_action( 'azure_news_frontpage_section', 'azure_news_frontpage_main_banner', 10 );

/*------------------------------ Frontpage Middle Content Section ------------*/
    
    if ( ! function_exists( 'azure_news_frontpage_middle_content' ) ) :

        /**
         * function to display the middle content section at front page.
         * 
         * @since 1.0.0
         */
        function azure_news_frontpage_middle_content() {
            get_template_part( 'template-parts/frontpage/middle', 'content' );
        }

    endif;

    add_action( 'azure_news_frontpage_section', 'azure_news_frontpage_middle_content', 30 );

/*------------------------------ Frontpage Bottom Fullwidth Section ----------*/
    
    if ( ! function_exists( 'azure_news_frontpage_bottom_fullwidth' ) ) :

        /**
         * function to display the fullwidth section at front page.
         * 
         * @since 1.0.0
         */
        function azure_news_frontpage_bottom_fullwidth() {
            get_template_part( 'template-parts/frontpage/fullwidth' );
        }

    endif;

    add_action( 'azure_news_frontpage_section', 'azure_news_frontpage_bottom_fullwidth', 40 );

/*------------------------------ Innerpage breadcrumb ------------------------*/

    if ( ! function_exists( 'azure_news_breadcrumb_trial_content' ) ) :

        /**
         * function to manage the default breadcrumb trial
         * 
         * @since 1.0.0
         */
        function azure_news_breadcrumb_trial_content() {
            if ( is_home() || is_front_page() ) {
                return;
            }
            get_template_part( '/template-parts/header/breadcrumb' );
        }

    endif;

    add_action( 'azure_news_before_page_post_content', 'azure_news_breadcrumb_trial_content', 10 );

/*------------------------------ Innerpage Single Post -----------------------*/
    
    if ( ! function_exists( 'azure_news_post_author_box' ) ) :

        /**
         * function to display the author box section in single post page.
         * 
         * @since 1.0.0
         */
        function azure_news_post_author_box() {
            get_template_part( 'template-parts/partials/post/author', 'box' );
        }

    endif;

    add_action( 'azure_news_after_single_post_loop_content', 'azure_news_post_author_box', 10 );

    if ( ! function_exists( 'azure_news_single_post_related_posts_section' ) ) :

        /**
         * function to display the related posts sections in single post page.
         * 
         * @since 1.0.0
         */
        function azure_news_single_post_related_posts_section() {
            get_template_part( 'template-parts/partials/post/related', 'posts' );
        }

    endif;

    add_action( 'azure_news_after_single_post_loop_content', 'azure_news_single_post_related_posts_section', 20 );

/*------------------------------ Innerpage Archive Pages ---------------------*/

    if ( ! function_exists( 'azure_news_archive_title_prefix' ) ) :
        
        /**
         * Archive title prefix
         *
         * @since 1.0.0
         */
        function azure_news_archive_title_prefix( $title ) {

            $title_prefix_enable = azure_news_get_customizer_option_value( 'azure_news_archive_title_prefix_enable' );

            if ( false === $title_prefix_enable ) {
                return preg_replace( '/^\w+: /', '', $title );
            } else {
                return $title;
            }
            
        }

    endif;

    add_filter( 'get_the_archive_title', 'azure_news_archive_title_prefix' );

/*------------------------------ Footer Section ------------------------------*/

    if ( ! function_exists( 'azure_news_scroll_top_section' ) ) :

        /**
         * function to display the scroll top section in footer.
         * 
         * @since 1.0.0
         */
        function azure_news_scroll_top_section() {
            get_template_part( 'template-parts/footer/scroll', 'top' );
        }

    endif;

    add_action( 'azure_news_after_page', 'azure_news_scroll_top_section', 10 );