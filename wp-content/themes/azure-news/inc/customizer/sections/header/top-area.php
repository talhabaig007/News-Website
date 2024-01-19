<?php
/**
 * Add Top Area section and it's fields inside Header Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_top_area_options' );

if ( ! function_exists( 'azure_news_register_top_area_options' ) ) :

    /**
     * Register theme options for Top Area section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_top_area_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Main Area Section
         * 
         * Header Settings > Main Area
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_header_top_area',
                array(
                    'priority'  => 5,
                    'panel'     => 'azure_news_panel_header',
                    'title'     => __( 'Top Area', 'azure-news' ),
                )
            )
        );

        /**
         * Tabs field for Top Area section
         *
         * Header Settings > Top Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_top_area_tabs',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_top_area_tabs' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Tabs(
            $wp_customize, 'azure_news_header_top_area_tabs',
                array(
                    'priority'      => 5,
                    'section'       => 'azure_news_section_header_top_area',
                    'settings'      => 'azure_news_header_top_area_tabs',
                    'choices'       => azure_news_header_top_area_tabs_choices()
                )
            )
        );

        /**
         * Toggle option for header top area.
         *
         * Header Settings > Top Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_top_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_top_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_header_top_enable',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_header_top_area',
                    'settings'      => 'azure_news_header_top_enable',
                    'label'         => __( 'Enable Top Area', 'azure-news' )
                )
            )
        );

        /**
         * Toggle option for top area date.
         *
         * Header Settings > Top Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_top_date_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_top_date_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_header_top_date_enable',
                array(
                    'priority'          => 15,
                    'section'           => 'azure_news_section_header_top_area',
                    'settings'          => 'azure_news_header_top_date_enable',
                    'label'             => __( 'Enable Date - Time', 'azure-news' ),
                    'active_callback'   => 'azure_news_cb_has_header_top_enable'
                )
            )
        );

        /**
         * Select option for top area date format.
         *
         * Header Settings > Top Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_top_date_format',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_top_date_format' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_header_top_date_format',
            array(
                'priority'          => 20,
                'section'           => 'azure_news_section_header_top_area',
                'settings'          => 'azure_news_header_top_date_format',
                'label'             => __( 'Date Format', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_header_top_date_format_choices(),
                'active_callback'   => 'azure_news_cb_has_header_top_date_enable'
            )
        );

        /**
         * Toggle option for top area menu.
         *
         * Header Settings > Top Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_top_menu_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_top_menu_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_header_top_menu_enable',
                array(
                    'priority'          => 25,
                    'section'           => 'azure_news_section_header_top_area',
                    'settings'          => 'azure_news_header_top_menu_enable',
                    'label'             => __( 'Enable Top Menu', 'azure-news' ),
                    'active_callback'   => 'azure_news_cb_has_header_top_enable'
                )
            )
        );

        /**
         * Toggle option for top header social icons.
         *
         * Header Settings > Top Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_social_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_social_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_header_social_enable',
                array(
                    'priority'          => 30,
                    'section'           => 'azure_news_section_header_top_area',
                    'settings'          => 'azure_news_header_social_enable',
                    'label'             => __( 'Enable Social Icons', 'azure-news' ),
                    'active_callback'   => 'azure_news_cb_has_header_top_enable'
                )
            )
        );

        /**
         * Redirect field for social icons section.
         *
         * Header Settings > Top Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_social_redirect',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Redirect(
            $wp_customize, 'azure_news_header_social_redirect',
                array(
                    'priority'      => 35,
                    'section'       => 'azure_news_section_header_top_area',
                    'settings'      => 'azure_news_header_social_redirect',
                    'choices'       => array(
                        'azure_news_header_social_redirect' => array(
                            'type'          => 'section',
                            'type_id'       => 'azure_news_section_social_icons',
                            'type_label'    => __( 'Manage Social Icons', 'azure-news' )
                        )
                    ),
                    'active_callback'   => 'azure_news_cb_has_header_social_enable'
                )
            )
        );

        /**
         * Color Picker field for Top Area background color
         * 
         * Header Settings > Top Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_top_bg_color',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_top_bg_color' ),
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize, 'azure_news_header_top_bg_color',
                array(
                    'priority'          => 100,
                    'section'           => 'azure_news_section_header_top_area',
                    'settings'          => 'azure_news_header_top_bg_color',
                    'label'             => __( 'Background Color', 'azure-news' ),
                )
            )
        );

    }

endif;
