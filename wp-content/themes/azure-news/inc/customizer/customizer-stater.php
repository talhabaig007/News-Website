<?php
/**
 * Includes theme customizer defaults and starter functions.
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'azure_news_get_customizer_option_value' ) ) :

    /**
     * Get the customizer value `get_theme_mod()`
     *
     * @since 1.0.0
     */
    function azure_news_get_customizer_option_value( $setting_id ) {

        return get_theme_mod( $setting_id, azure_news_get_customizer_default( $setting_id ) );

    }

endif;

if ( ! function_exists( 'azure_news_get_customizer_default' ) ) :

    /**
     * Returns an array of the desired default Azure Options
     *
     * @return array
     */
    function azure_news_get_customizer_default( $setting_id ) {

        $default_values = apply_filters( 'azure_news_get_customizer_defaults',
            array(
                //container
                'azure_news_site_container_layout'                 => 'separate',
                'azure_news_main_container_width'                  => 1320,
                'azure_news_boxed_container_width'                 => 1290,
                'azure_news_site_mode'                             => 'light-mode',
                //preloader
                'azure_news_preloader_enable'                      => true,
                'azure_news_preloader_style'                       => 'wave',
                //social icons
                'azure_news_social_icon_link_target'               => false,
                'azure_news_social_icons'                          => json_encode( array( array( 'social_icon' => 'bx bxl-twitter', 'social_url'   => '', 'item_visible'   => 'show' ) ) ),
                //colors
                'azure_news_primary_theme_color'                   => '#04a8d0',
                'azure_news_text_color'                            => '#3b3b3b',
                'azure_news_link_color'                            => '#04a8d0',
                'azure_news_link_hover_color'                      => '#005ca8',
                //breadcrumb
                'azure_news_site_breadcrumb_enable'                => true,
                'azure_news_site_breadcrumb_types'                 => 'default',
                //sidebar layout
                'azure_news_sidebar_sticky_enable'                 => true,
                'azure_news_archive_sidebar_layout'                => 'right-sidebar',
                'azure_news_posts_sidebar_layout'                  => 'right-sidebar',
                'azure_news_pages_sidebar_layout'                  => 'right-sidebar',
                //scroll top
                'azure_news_scroll_top_enable'                     => true,
                'azure_news_scroll_top_arrow'                      => 'bx-up-arrow-alt',
                //site identity
                'site_identity_tabs'                    => 'general',
                //typography
                'azure_news_body_font_family'                      => 'Roboto',
                'azure_news_body_font_weight'                      => '400',
                'azure_news_body_font_style'                       => 'normal',
                'azure_news_body_font_transform'                   => 'inherit',
                'azure_news_body_font_decoration'                  => 'inherit',
                'azure_news_heading_font_family'                   => 'Nunito',
                'azure_news_heading_font_weight'                   => '700',
                'azure_news_heading_font_style'                    => 'normal',
                'azure_news_heading_font_transform'                => 'inherit',
                'azure_news_heading_font_decoration'               => 'inherit',
                //performance
                'azure_news_site_schema_enable'                    => true,
                'azure_news_posts_date_style'                      => 'publish',
                'azure_news_posts_date_format'                     => 'default',
                'azure_news_posts_thumbnail_hover_effect'          => 'hover-effect--one',
                'azure_news_posts_reading_time_enable'             => true,
                //top header
                'azure_news_header_top_area_tabs'                  => 'general',
                'azure_news_header_top_enable'                     => true,
                'azure_news_header_top_bg_color'                   => '#111111',
                'azure_news_header_top_date_enable'                => true,
                'azure_news_header_top_date_format'                => 'date_format_1',
                'azure_news_header_top_menu_enable'                => true,
                'azure_news_header_social_enable'                  => true,
                'azure_news_header_top_placement'                  => 'placement_one',
                //header main area
                'azure_news_header_main_area_tabs'                 => 'general',
                'azure_news_header_sticky_enable'                  => true,
                'azure_news_header_main_area_layout'               => 'header-main-layout--one',
                'azure_news_header_site_mode_switch_enable'        => true,
                'azure_news_header_search_enable'                  => true,
                'azure_news_header_sticky_sidebar_toggle_enable'   => true,
                'azure_news_header_custom_button_label'            => __( 'Subscribe', 'azure-news' ),
                'azure_news_header_custom_button_link'             => '',
                'azure_news_header_main_bg_type'                   => 'bg-none',
                'azure_news_header_main_bg_color'                  => '#E53935',
                'azure_news_header_main_bg_image'                  => '',
                //primary menu
                'azure_news_primary_menu_description_enable'       => true,
                //header ads
                'azure_news_header_ads_image'                      => '',
                'azure_news_header_ads_image_link'                 => '',
                //header ticker
                'azure_news_header_ticker_enable'                  => true,
                'azure_news_header_ticker_label'                   => __( 'Breaking News', 'azure-news' ),
                'azure_news_ticker_posts_date_filter'              => 'all',
                //frontpage banner
                'azure_news_frontpage_banner_tabs'                 => 'general',
                'azure_news_banner_slider_order_by'                => 'date-desc',
                'azure_news_banner_slider_category'                => 'all',
                'azure_news_banner_slider_date_filter'             => 'all',
                'azure_news_banner_block_category'                 => 'all',
                'azure_news_banner_block_order_by'                 => 'date-desc',
                'azure_news_banner_tab_label_latest'               => __( 'Latest', 'azure-news' ),
                'azure_news_banner_tab_label_popular'              => __( 'Popular', 'azure-news' ),
                'azure_news_banner_tab_label_trending'             => __( 'Trending', 'azure-news' ),
                'azure_news_banner_tab_trending_category'          => 'all',
                'azure_news_banner_column_reorder'                 => array( 'block', 'slider', 'tab' ),
                'azure_news_banner_bg_type'                        => 'bg-none',
                'azure_news_banner_bg_color'                       => '#F7F8F9',
                'azure_news_banner_bg_image'                       => '',
                //homepage
                'azure_news_frontpage_blocks_enable'               => true,
                // front middle content
                'azure_news_front_middle_content_blocks'   => json_encode(
                    array(
                        array(
                            'type'              => 'news-block',
                            'option'            => true,
                            'blockTitle'        => __( 'News Block', 'azure-news' ),
                            'category'          => 'all',
                            'postOrderby'       => 'date-desc',
                            'postDatefilter'    => 'all',
                            'postCount'         => 5,
                            'blocklayout'       => 'one',
                            'postCats'          => true,
                            'postAuthor'        => true,
                            'postDate'          => true,
                            'postComment'       => true,
                            'postMore'          => true,
                        )
                    )
                ),
                //front fullwidth
                'azure_news_front_fullwidth_blocks'            => json_encode(
                    array(
                        array(
                            'type'              => 'news-featured',
                            'option'            => true,
                            'blockTitle'        => __( 'Fullwidth Featured', 'azure-news' ),
                            'category'          => 'all',
                            'postOrderby'       => 'date-desc',
                            'postDatefilter'    => 'all',
                            'postCount'         => 3,
                            'blocklayout'       => 'one',
                            'postCats'          => true,
                            'postAuthor'        => true,
                            'postDate'          => true,
                            'postComment'       => true,
                            'postMore'          => true,

                        ),
                        array(
                            'type'          => 'ad-block',
                            'option'        => true,
                            'imgSrc'        => '',
                            'imgUrl'        => '',
                            'newTab'        => true,
                        ),
                    )
                ),
                //archive page
                'azure_news_archive_page_style'                => 'archive-style--classic',
                'azure_news_archive_title_prefix_enable'       => false,
                'azure_news_archive_post_readmore_enable'      => true,
                //single posts
                'azure_news_single_posts_layout'               => 'posts-layout--one',
                'azure_news_single_posts_author_enable'        => true,
                'azure_news_single_posts_related_enable'       => true,
                'azure_news_single_posts_related_label'        => __( 'Related Posts', 'azure-news' ),
                //404 error
                'azure_news_error_page_search_enable'          => true,
                'azure_news_error_page_button_enable'          => true,
                'azure_news_error_page_button_label'           => __( 'Back To Home', 'azure-news' ),
                //footer main area
                'azure_news_footer_main_enable'                => true,
                'azure_news_footer_widget_area_layout'         => 'column-three',
                //footer bottom area
                'azure_news_footer_bottom_enable'              => true,
                'azure_news_footer_copyright_info'             => esc_html__( 'Copyright &copy; azure-news {year}', 'azure-news' )
            )
        );

        return  $default_values[$setting_id];

    }

endif;