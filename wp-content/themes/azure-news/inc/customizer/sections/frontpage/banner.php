<?php
/**
 * Add Banner section and it's fields inside Frontpage Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_frontpage_banner_options' );

if ( ! function_exists( 'azure_news_register_frontpage_banner_options' ) ) :

    /**
     * Register theme options for Banner section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_frontpage_banner_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Banner Section
         * 
         * Frontpage Settings > Banner
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_frontpage_banner',
                array(
                    'priority'  => 5,
                    'panel'     => 'azure_news_panel_frontpage',
                    'title'     => __( 'Main Banner', 'azure-news' ),
                )
            )
        );

        /**
         * Tabs field for Banner section
         *
         * Frontpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_frontpage_banner_tabs',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_frontpage_banner_tabs' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Tabs(
            $wp_customize, 'azure_news_frontpage_banner_tabs',
                array(
                    'priority'      => 5,
                    'section'       => 'azure_news_section_frontpage_banner',
                    'settings'      => 'azure_news_frontpage_banner_tabs',
                    'choices'       => azure_news_frontpage_banner_tabs_choices()
                )
            )
        );

        /**
         * Heading field for banner block settings
         *
         * Frontpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_block_heading',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Heading(
            $wp_customize, 'azure_news_banner_block_heading',
                array(
                    'priority'          => 10,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_block_heading',
                    'label'             => __( 'Block Settings', 'azure-news' ),
                )
            )
        );

        /**
         * Select option of category for block posts
         *
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_block_category',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_block_category' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Dropdown_Categories(
            $wp_customize, 'azure_news_banner_block_category',
                array(
                    'priority'          => 15,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_block_category',
                    'label'             => __( 'Block Category', 'azure-news' ),
                )
            )
        );

        /**
         * Select option for block posts order by
         *
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_block_order_by',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_block_order_by' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_banner_block_order_by',
            array(
                'priority'          => 20,
                'section'           => 'azure_news_section_frontpage_banner',
                'settings'          => 'azure_news_banner_block_order_by',
                'label'             => __( 'Posts Order By', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_posts_order_by_choices(),
            )
        );

        /**
         * Heading field for banner slider settings
         *
         * Frontpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_slider_heading',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Heading(
            $wp_customize, 'azure_news_banner_slider_heading',
                array(
                    'priority'          => 25,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_slider_heading',
                    'label'             => __( 'Slider Settings', 'azure-news' ),
                )
            )
        );

        /**
         * Select option of category for slider posts
         *
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_slider_category',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_slider_category' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Dropdown_Categories(
            $wp_customize, 'azure_news_banner_slider_category',
                array(
                    'priority'          => 30,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_slider_category',
                    'label'             => __( 'Slider Category', 'azure-news' ),
                )
            )
        );

        /**
         * Select option for slider posts order by
         *
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_slider_order_by',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_slider_order_by' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_banner_slider_order_by',
            array(
                'priority'          => 35,
                'section'           => 'azure_news_section_frontpage_banner',
                'settings'          => 'azure_news_banner_slider_order_by',
                'label'             => __( 'Posts Order By', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_posts_order_by_choices(),
            )
        );

        /**
         * Select option for slider posts date filter
         *
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_slider_date_filter',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_slider_date_filter' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_banner_slider_date_filter',
            array(
                'priority'          => 40,
                'section'           => 'azure_news_section_frontpage_banner',
                'settings'          => 'azure_news_banner_slider_date_filter',
                'label'             => __( 'Posts Date Filter', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_posts_date_filter_choices(),
            )
        );

        /**
         * Heading field for banner tab settings
         *
         * Frontpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_tab_heading',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Heading(
            $wp_customize, 'azure_news_banner_tab_heading',
                array(
                    'priority'          => 60,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_tab_heading',
                    'label'             => __( 'Tab Settings', 'azure-news' )
                )
            )
        );

        /**
         * Text field for latest tab label
         *
         * Frontpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_tab_label_latest',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_tab_label_latest' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( 'azure_news_banner_tab_label_latest',
            array(
                'priority'          => 70,
                'section'           => 'azure_news_section_frontpage_banner',
                'settings'          => 'azure_news_banner_tab_label_latest',
                'label'             => __( 'Latest Tab', 'azure-news' ),
                'type'              => 'text'
            )
        );

        /**
         * Text field for popular tab label
         *
         * Frontpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_tab_label_popular',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_tab_label_popular' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( 'azure_news_banner_tab_label_popular',
            array(
                'priority'          => 75,
                'section'           => 'azure_news_section_frontpage_banner',
                'settings'          => 'azure_news_banner_tab_label_popular',
                'label'             => __( 'Popular Tab', 'azure-news' ),
                'description'       => __( 'Popular posts will be listed by comment count.', 'azure-news' ),
                'type'              => 'text'
            )
        );

        /**
         * Text field for trending tab label
         *
         * Frontpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_tab_label_trending',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_tab_label_trending' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( 'azure_news_banner_tab_label_trending',
            array(
                'priority'          => 80,
                'section'           => 'azure_news_section_frontpage_banner',
                'settings'          => 'azure_news_banner_tab_label_trending',
                'label'             => __( 'Trending Tab', 'azure-news' ),
                'type'              => 'text'
            )
        );

        /**
         * Select option of category for trending tab
         *
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_tab_trending_category',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_tab_trending_category' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Dropdown_Categories(
            $wp_customize, 'azure_news_banner_tab_trending_category',
                array(
                    'priority'          => 85,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_tab_trending_category',
                    'label'             => __( 'Trending Category', 'azure-news' )
                )
            )
        );

        /**
         * Heading field for column reorder settings
         *
         * Frontpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_reorder_heading',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Heading(
            $wp_customize, 'azure_news_banner_reorder_heading',
                array(
                    'priority'          => 100,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_reorder_heading',
                    'label'             => __( 'Column Reorder', 'azure-news' ),
                )
            )
        );

        /**
         * Sortable field for banner column re-order
         *
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_column_reorder',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_column_reorder' ),
                'sanitize_callback' => 'azure_news_sanitize_sortable'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Sortable(
            $wp_customize, 'azure_news_banner_column_reorder',
                array(
                    'priority'          => 105,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_column_reorder',
                    'label'             => __( 'Banner Column Re-order', 'azure-news' ),
                    'choices'           => azure_news_banner_column_reorder_choices()
                )
            )
        );

        /**
         * Select option for banner background option
         *
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_bg_type',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_bg_type' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_banner_bg_type',
            array(
                'priority'          => 150,
                'section'           => 'azure_news_section_frontpage_banner',
                'settings'          => 'azure_news_banner_bg_type',
                'label'             => __( 'Banner Background Type', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_bg_type_choices(),
            )
        );

        /**
         * Color Picker field for banner background color
         * 
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_bg_color',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_bg_color' ),
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize, 'azure_news_banner_bg_color',
                array(
                    'priority'          => 155,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_bg_color',
                    'label'             => __( 'Background Color', 'azure-news' ),
                    'active_callback'   => 'azure_news_cb_has_banner_bg_type_color'
                )
            )
        );

        /**
         * Image field for background image in banner section
         *
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_banner_bg_image',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_banner_bg_image' ),
                'sanitize_callback' => 'absint'
            )
        );
        $wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
            $wp_customize, 'azure_news_banner_bg_image',
                array(
                    'priority'          => 160,
                    'section'           => 'azure_news_section_frontpage_banner',
                    'settings'          => 'azure_news_banner_bg_image',
                    'label'             => __( 'Background Image', 'azure-news' ),
                    'height'            => 600,
                    'width'             => 1920,
                    'flex_width'        =>true,
                    'active_callback'   => 'azure_news_cb_has_banner_bg_type_image'
                )
            )
        );

        /**
         * Upgrade field for main banner
         * 
         * Frongpage Settings > Banner
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_main_banner',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_main_banner',
                array(
                    'priority'      => 200,
                    'section'       => 'azure_news_section_frontpage_banner',
                    'settings'      => 'upgrade_main_banner',
                    'label'         => __( 'More Features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_main_banner' )
                )
            )
        );


    }

endif;