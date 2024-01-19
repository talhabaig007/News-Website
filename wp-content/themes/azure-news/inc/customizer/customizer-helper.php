<?php
/**
 * Customizer helper where define functions related to customizer panel, sections and settings.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



/*---------------------------------- General Panel Choices ---------------------------------- --*/

    if ( ! function_exists( 'azure_news_site_container_layout_choices' ) ) :

        /**
         * function to return choices of site container layout.
         *
         * @since 1.0.0
         */
        function azure_news_site_container_layout_choices() {

            $site_container_layout = apply_filters( 'azure_news_site_container_layout_choices',
                array(
                    'full-width'    => array(
                        'title'     => __( 'Full Width', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/full-width.png'
                    ),
                    'boxed'         => array(
                        'title'     => __( 'Boxed', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/boxed.png'
                    ),
                    'separate'         => array(
                        'title'     => __( 'Separate', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/seperate.png'
                    )
                )
            );

            return $site_container_layout;

        }

    endif;

    if ( ! function_exists( 'azure_news_preloader_style_choices' ) ) :

        /**
         * function to return choices for preloader styles.
         *
         * @since 1.0.0
         */
        function azure_news_preloader_style_choices() {

            $site_container_layout = apply_filters( 'azure_news_preloader_style_choices',
                array(
                    'three_bounce'    => array(
                        'title'     => __( 'Style 1', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/three-bounce-preloader.gif'
                    ),
                    'wave'         => array(
                        'title'     => __( 'Style 2', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/wave-preloader.gif'
                    ),
                    'folding_cube'         => array(
                        'title'     => __( 'Style 3', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/folding-cube-preloader.gif'
                    )
                )
            );

            return $site_container_layout;

        }

    endif;

    if ( ! function_exists( 'azure_news_sidebar_layout_choices' ) ) :

        /**
         * function to return choices for archive sidebar layouts.
         *
         * @since 1.0.0
         */
        function azure_news_sidebar_layout_choices() {

            $sidebar_layouts = apply_filters( 'azure_news_sidebar_layout_choices',
                array(
                    'right-sidebar'    => array(
                        'title'     => __( 'Right Sidebar', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/right-sidebar.png'
                    ),
                    'left-sidebar'  => array(
                        'title'     => __( 'Left Sidebar', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/left-sidebar.png'
                    ),
                    'both-sidebar'  => array(
                        'title'     => __( 'Both Sidebar', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/both-sidebar.png'
                    ),
                    'no-sidebar'  => array(
                        'title'     => __( 'No Sidebar', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/no-sidebar.png'
                    ),
                    'no-sidebar-center'  => array(
                        'title'     => __( 'No Sidebar Center', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/no-sidebar-center.png'
                    )
                )
            );

            return $sidebar_layouts;

        }

    endif;

    if ( ! function_exists( 'azure_news_scroll_top_arrow_choices' ) ) :

        /**
         * function to return choices of scroll top arrow.
         *
         * @since 1.0.0
         */
        function azure_news_scroll_top_arrow_choices() {

            $scroll_top_arrow = apply_filters( 'azure_news_scroll_top_arrow_choices',
                array(
                    'bx-up-arrow-alt'  => array(
                        'title' => __( 'Arrow 1', 'azure-news' ),
                        'icon'  => 'bx bx-up-arrow-alt'
                    ),
                    'bx-chevron-up'  => array(
                        'title' => __( 'Arrow 2', 'azure-news' ),
                        'icon'  => 'bx bx-chevron-up'
                    ),
                    'bx-chevrons-up'  => array(
                        'title' => __( 'Arrow 3', 'azure-news' ),
                        'icon'  => 'bx bx-chevrons-up'
                    ),
                )
            );

            return $scroll_top_arrow;

        }

    endif;

    if ( ! function_exists( 'azure_news_site_mode_choices' ) ) :

        /**
         * function to return choices for site mode.
         *
         * @since 1.0.0
         */
        function azure_news_site_mode_choices() {

            $site_mode_choices = apply_filters( 'azure_news_site_mode_choices',
                array(
                    'light-mode'    => __( 'Light', 'azure-news' ),
                    'dark-mode'     => __( 'Dark', 'azure-news' ),
                )
            );

            return $site_mode_choices;

        }

    endif;

    if ( ! function_exists( 'azure_news_posts_date_style_choices' ) ) :

        /**
         * function to return choices for posts date style
         *
         * @since 1.0.0
         */
        function azure_news_posts_date_style_choices() {

            $posts_date_style_choices = apply_filters( 'azure_news_posts_date_style_choices',
                array(
                    'publish'   => __( 'Published date', 'azure-news' ),
                    'modify'    => __( 'Updated date', 'azure-news' )
                )
            );

            return $posts_date_style_choices;

        }

    endif;

    if ( ! function_exists( 'azure_news_posts_date_format_choices' ) ) :

        /**
         * function to return choices for posts date format
         *
         * @since 1.0.0
         */
        function azure_news_posts_date_format_choices() {

            $posts_date_format_choices = apply_filters( 'azure_news_posts_date_format_choices',
                array(
                    'default'       => __( 'Default by WordPress', 'azure-news' ),
                    'format_one'    => __( 'Theme Format One', 'azure-news' )
                )
            );

            return $posts_date_format_choices;

        }

    endif;

    if ( ! function_exists( 'azure_news_posts_thumbnail_hover_effect_choices' ) ) :

        /**
         * function to return choices for posts thumbnail hover effect
         *
         * @since 1.0.0
         */
        function azure_news_posts_thumbnail_hover_effect_choices() {

            $posts_thumb_effect_choices = apply_filters( 'azure_news_posts_thumbnail_hover_effect_choices',
                array(
                    'none'              => __( 'None', 'azure-news' ),
                    'hover-effect--one' => __( 'Hover Effect One', 'azure-news' ),
                )
            );

            return $posts_thumb_effect_choices;

        }

    endif;

    if ( ! function_exists( 'azure_news_site_breadcrumb_types_choices' ) ) :

        /**
         * function to return choices for site breadcrumb types
         *
         * @since 1.0.0
         */
        function azure_news_site_breadcrumb_types_choices() {

            $breadcrumb_types_choices = apply_filters( 'azure_news_site_breadcrumb_types_choices',
                array(
                    'default'   => __( 'Default', 'azure-news' ),
                    'navxt'     => __( 'NavXT', 'azure-news' ),
                    'yoast'     => __( 'Yoast SEO', 'azure-news' ),
                    'rankmath'  => __( 'Rank Math', 'azure-news' )
                )
            );

            return $breadcrumb_types_choices;

        }

    endif;

/*---------------------------------- Header Panel Choices --------------------------------------*/

    if ( ! function_exists( 'azure_news_header_top_area_tabs_choices' ) ) :

        /**
         * function to return choices for header top area tab fields.
         *
         * @since 1.0.0
         */
        function azure_news_header_top_area_tabs_choices() {

            $header_top_tab_fields = apply_filters( 'azure_news_header_top_area_tabs_choices',
                array(
                    'general'   => array(
                        'title'     => __( 'General', 'azure-news' ),
                        'fields'    => array(
                            'azure_news_header_top_enable',
                            'azure_news_header_top_date_enable',
                            'azure_news_header_top_date_format',
                            'azure_news_header_top_menu_enable',
                            'azure_news_header_social_enable',
                            'azure_news_header_social_redirect'
                        )
                    ),
                    'design'    => array(
                        'title' => __( 'Design', 'azure-news' ),
                        'fields'    => array(
                            'azure_news_header_top_bg_color',
                        )
                    )
                )
            );

            return $header_top_tab_fields;

        }

    endif;

    if ( ! function_exists( 'azure_news_header_top_date_format_choices' ) ) :

        /**
         * function to return choices for header top date format.
         *
         * @since 1.0.0
         */
        function azure_news_header_top_date_format_choices() {

            $header_top_tab_fields = apply_filters( 'azure_news_header_top_date_format_choices',
                array(
                    'date_format_1' => __( '01 Jan, 2023', 'azure-news' ),
                    'date_format_2' => __( '01 January, 2023', 'azure-news' ),
                )
            );

            return $header_top_tab_fields;

        }

    endif;

    if ( ! function_exists( 'azure_news_header_main_area_tabs_choices' ) ) :

        /**
         * function to return choices for header main area tab fields.
         *
         * @since 1.0.0
         */
        function azure_news_header_main_area_tabs_choices() {

            $header_main_tab_fields = apply_filters( 'azure_news_header_main_area_tabs_choices',
                array(
                    'general'   => array(
                        'title'     => __( 'General', 'azure-news' ),
                        'fields'    => array(
                            'azure_news_header_sticky_enable',
                            'azure_news_divider_main_area_one',
                            'azure_news_header_search_enable',
                            'azure_news_header_site_mode_switch_enable',
                            'azure_news_header_sticky_sidebar_toggle_enable',
                            'azure_news_header_sticky_sidebar_redirect',
                            'azure_news_header_custom_button_heading',
                            'azure_news_header_custom_button_label',
                            'azure_news_header_custom_button_link',
                        )
                    ),
                    'design'    => array(
                        'title' => __( 'Design', 'azure-news' ),
                        'fields'    => array(
                            'azure_news_header_main_bg_type',
                            'azure_news_header_main_bg_color',
                            'azure_news_header_main_bg_image'
                        )
                    )
                )
            );

            return $header_main_tab_fields;

        }

    endif;

    if ( ! function_exists( 'azure_news_bg_type_choices' ) ) :

        /**
         * function to return choices for background type.
         *
         * @since 1.0.0
         */
        function azure_news_bg_type_choices() {

            $bg_types = apply_filters( 'azure_news_bg_type_choices',
                array(
                    'bg-none'   => __( 'None', 'azure-news' ),
                    'bg-color'  => __( 'Color', 'azure-news' ),
                    'bg-image'  => __( 'Image', 'azure-news' ),
                )
            );

            return $bg_types;

        }

    endif;

/*---------------------------------- Frontpage Panel Choices -----------------------------------*/

    if ( ! function_exists( 'azure_news_frontpage_banner_tabs_choices' ) ) :

        /**
         * function to return choices for frontpage banner tab fields.
         *
         * @since 1.0.0
         */
        function azure_news_frontpage_banner_tabs_choices() {

            $frontpage_banner_tab_fields = apply_filters( 'azure_news_frontpage_banner_tabs_choices',
                array(
                    'general'   => array(
                        'title'     => __( 'General', 'azure-news' ),
                        'fields'    => array(
                            'azure_news_banner_slider_heading',
                            'azure_news_banner_slider_category',
                            'azure_news_banner_slider_order_by',
                            'azure_news_banner_slider_date_filter',
                            'azure_news_banner_block_heading',
                            'azure_news_banner_block_category',
                            'azure_news_banner_block_order_by',
                            'azure_news_banner_tab_heading',
                            'azure_news_banner_tab_label_latest',
                            'azure_news_banner_tab_label_popular',
                            'azure_news_banner_tab_label_trending',
                            'azure_news_banner_tab_trending_category',
                            'azure_news_banner_reorder_heading',
                            'azure_news_banner_column_reorder',
                        )
                    ),
                    'design'    => array(
                        'title' => __( 'Design', 'azure-news' ),
                        'fields'    => array(
                            'azure_news_banner_bg_type',
                            'azure_news_banner_bg_color',
                            'azure_news_banner_bg_image'
                        )
                    )
                )
            );

            return $frontpage_banner_tab_fields;

        }

    endif;

    if ( ! function_exists( 'azure_news_posts_order_by_choices' ) ) :

        /**
         * function to return choices of posts order by.
         *
         * @since 1.0.0
         */
        function azure_news_posts_order_by_choices() {

            $posts_order_by = apply_filters( 'azure_news_posts_order_by_choices',
                array(
                    'date-desc'     => __( 'Newest - Oldest', 'azure-news' ),
                    'date-asc'      => __( 'Oldest - Newest', 'azure-news' ),
                    'title-asc'     => __( 'A - Z', 'azure-news' ),
                    'title-desc'    => __( 'Z - A', 'azure-news' ),
                    'rand-desc'     => __( 'Random', 'azure-news' ),
                )
            );

            return $posts_order_by;

        }

    endif;

    if ( ! function_exists( 'azure_news_posts_date_filter_choices' ) ) :

        /**
         * function to return choices of posts date filter.
         *
         * @since 1.0.0
         */
        function azure_news_posts_date_filter_choices() {

            $posts_date_filter = apply_filters( 'azure_news_posts_date_filter_choices',
                array(
                    'all'           => __( 'All', 'azure-news' ),
                    'today'         => __( 'Today', 'azure-news' ),
                    'this-week'     => __( 'This Week', 'azure-news' ),
                    'last-week'     => __( 'Last Week', 'azure-news' ),
                    'this-month'    => __( 'This Month', 'azure-news' ),
                    'last-month'    => __( 'Last Month', 'azure-news' )
                )
            );

            return $posts_date_filter;

        }

    endif;

    if ( ! function_exists( 'azure_news_banner_column_reorder_choices' ) ) :

        /**
         * function to return choices of banner column re-order.
         *
         * @since 1.0.0
         */
        function azure_news_banner_column_reorder_choices() {

            $column_reorder = apply_filters( 'azure_news_banner_column_reorder_choices',
                array(
                    'block'     => __( 'Block', 'azure-news' ),
                    'slider'    => __( 'Slider', 'azure-news' ),
                    'tab'       => __( 'Tab', 'azure-news' )
                )
            );

            return $column_reorder;

        }

    endif;

    if ( ! function_exists( 'azure_news_section_bg_type_choices' ) ) :

        /**
         * function to return choices of section background type.
         *
         * @since 1.0.0
         */
        function azure_news_section_bg_type_choices() {

            $section_bg_type = apply_filters( 'azure_news_section_bg_type_choices',
                array(
                    'color'   => __( 'Background Color', 'azure-news' ),
                    'image'   => __( 'Background Image', 'azure-news' )
                )
            );

            return $section_bg_type;

        }

    endif;

/*---------------------------------- Innerpage Panel Choices -----------------------------------*/

    if ( ! function_exists( 'azure_news_archive_page_style_choices' ) ) :

        /**
         * function to return choices for archive page style.
         *
         * @since 1.0.0
         */
        function azure_news_archive_page_style_choices() {

            $azure_news_archive_page_style = apply_filters( 'azure_news_archive_page_style_choices',
                array(
                    'archive-style--classic'  => __( 'Classic', 'azure-news' ),
                    'archive-style--grid'     => __( 'Grid', 'azure-news' ),
                    'archive-style--list'     => __( 'List', 'azure-news' )
                )
            );

            return $azure_news_archive_page_style;

        }

    endif;

/*---------------------------------- Footer Panel Choices -----------------------------------*/

    if ( ! function_exists( 'azure_news_footer_widget_area_layout_choices' ) ) :

        /**
         * function to return choices of footer widget layout.
         *
         * @since 1.0.0
         */
        function azure_news_footer_widget_area_layout_choices() {

            $posts_layout = apply_filters( 'azure_news_footer_widget_area_layout_choices',
                array(
                    'column-one'  => array(
                        'title'     => __( 'Layout 1', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/footer-1.png'
                    ),
                    'column-two'  => array(
                        'title'     => __( 'Layout 2', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/footer-2.png'
                    ),
                    'column-three'  => array(
                        'title'     => __( 'Layout 3', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/footer-3.png'
                    ),
                    'column-four'  => array(
                        'title'     => __( 'Layout 4', 'azure-news' ),
                        'src'       => get_template_directory_uri() . '/inc/customizer/assets/images/footer-4.png'
                    )
                )
            );

            return $posts_layout;

        }

    endif;

/*---------------------------------- Upgrade Control Choices -----------------------------------*/
    
    if ( ! function_exists( 'azure_news_upgrade_choices' ) ) :

        /**
         * function to return choices for upgrade to pro.
         *
         * @since 1.0.0
         */
        function azure_news_upgrade_choices( $setting_id ) {

            $upgrade_info_lists = array(
                'preloader'     => array( __( "15+ Styles <div class='hover-img' data-src='right-sidebar.png'><span class='hover-icon'><i class='bx bx-info-circle'></i></span></div>", 'azure-news' ), __( 'Color options', 'azure-news' ), __( 'Device visibility', 'azure-news' ) ),
                'social_icon'   => array( __( 'Add unlimited social icons field.', 'azure-news' ), __( 'More icons with official color.', 'azure-news' ), __( 'Device visibility', 'azure-news' ) ),
                'typography'    => array( __( '950+ Google Fonts', 'azure-news' ), __( 'Adjustable font size', 'azure-news' ), __( 'Font Color Option', 'azure-news' ) ),
                'breadcrumb'    => array( __( 'Device visibility', 'azure-news' ), __( 'Typography Option', 'azure-news' ), __( 'Color Option', 'azure-news' ) ),
                'scroll_top'    => array( __( '10+ Arrow Icons', 'azure-news' ), __( 'Alignment Options', 'azure-news' ), __( 'Device visibility', 'azure-news' ), __( 'Color Option', 'azure-news' ) ),
                'header_main'    => array( __( '2 more layouts', 'azure-news' ), __( 'Extra option for Custom Buttom', 'azure-news' ) ),
                'primary_menu'    => array( __( 'Hover Effects', 'azure-news' ), __( 'Typography Options', 'azure-news' ), __( 'Color Options', 'azure-news' ) ),
                'ticker'    => array( __( '2 More Layouts', 'azure-news' ), __( 'Multiple Categories Option', 'azure-news' ),  __( 'Color Options', 'azure-news' ) ),
                'main_banner'    => array( __( "2 More Layouts <div class='hover-img' data-src='news-block-one.png'><span class='hover-icon'><i class='bx bx-info-circle'></i></span></div>", 'azure-news' ), __( 'Multiple Categories Option', 'azure-news' ), __( 'Extra option for slider control.', 'azure-news' ) ),
                'archive' => array( __( '3 More Post Layouts', 'azure-news' ), __( 'Different Pagination Types', 'azure-news' ), __( 'Post Element/Meta Re-Order.', 'azure-news' ) ),
                'single_post' => array( __( '5 More Post Layouts', 'azure-news' ), __( 'Post Element/Meta Re-Order.', 'azure-news' ),  __( '2 More author box layout', 'azure-news' ),  __( 'Extra options for post navigation', 'azure-news' ), __( '3 More Layout for related posts', 'azure-news' ), __( 'Extra options for related posts section', 'azure-news' ) ),
                'error_page' => array( __( '3 More Page Layouts', 'azure-news' ), __( 'Blank Page Option', 'azure-news' ),  __( 'Button Color', 'azure-news' ) ),

            );

           // $get_setting_upgrade_choices = upgrade_info_for_setting_id( $setting_id );

            $setting_id = explode( 'azure_news_', $setting_id );
            $setting_id = $setting_id[1];

            return $upgrade_info_lists[$setting_id];

        }

    endif;