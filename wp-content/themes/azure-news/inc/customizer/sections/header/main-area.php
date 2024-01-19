<?php
/**
 * Add Main Area section and it's fields inside Header Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_main_area_options' );

if ( ! function_exists( 'azure_news_register_main_area_options' ) ) :

    /**
     * Register theme options for Main Area section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_main_area_options( $wp_customize ) {

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
            $wp_customize, 'azure_news_section_header_main_area',
                array(
                    'priority'  => 20,
                    'panel'     => 'azure_news_panel_header',
                    'title'     => __( 'Main Area', 'azure-news' ),
                )
            )
        );

        /**
         * Tabs field for Main Area section
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_main_area_tabs',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_main_area_tabs' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Tabs(
            $wp_customize, 'azure_news_header_main_area_tabs',
                array(
                    'priority'      => 5,
                    'section'       => 'azure_news_section_header_main_area',
                    'settings'      => 'azure_news_header_main_area_tabs',
                    'choices'       => azure_news_header_main_area_tabs_choices()
                )
            )
        );

        /**
         * Toggle option for primary menu sticky.
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_sticky_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_sticky_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_header_sticky_enable',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_header_main_area',
                    'settings'      => 'azure_news_header_sticky_enable',
                    'label'         => __( 'Enable Header Sticky', 'azure-news' )
                )
            )
        );

        /**
         * Toggle option for header site mode switcher.
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_site_mode_switch_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_site_mode_switch_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_header_site_mode_switch_enable',
                array(
                    'priority'      => 15,
                    'section'       => 'azure_news_section_header_main_area',
                    'settings'      => 'azure_news_header_site_mode_switch_enable',
                    'label'         => __( 'Enable site mode switcher', 'azure-news' )
                )
            )
        );

        /**
         * Toggle option for header search icon.
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_search_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_search_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_header_search_enable',
                array(
                    'priority'      => 20,
                    'section'       => 'azure_news_section_header_main_area',
                    'settings'      => 'azure_news_header_search_enable',
                    'label'         => __( 'Enable Search Icon', 'azure-news' )
                )
            )
        );

        /**
         * Toggle option for header sticky sidebar toggle.
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_sticky_sidebar_toggle_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_sticky_sidebar_toggle_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_header_sticky_sidebar_toggle_enable',
                array(
                    'priority'      => 25,
                    'section'       => 'azure_news_section_header_main_area',
                    'settings'      => 'azure_news_header_sticky_sidebar_toggle_enable',
                    'label'         => __( 'Enable sticky sidebar toggle', 'azure-news' )
                )
            )
        );

        /**
         * Redirect field for sticky sidebar widget area.
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_sticky_sidebar_redirect',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Redirect(
            $wp_customize, 'azure_news_header_sticky_sidebar_redirect',
                array(
                    'priority'      => 25,
                    'section'       => 'azure_news_section_header_main_area',
                    'settings'      => 'azure_news_header_sticky_sidebar_redirect',
                    'choices'       => array(
                        'azure_news_header_sticky_sidebar_redirect' => array(
                            'type'          => 'section',
                            'type_id'       => 'sidebar-widgets-header-sticky-sidebar',
                            'type_label'    => __( 'Manage sidebar from here', 'azure-news' )
                        )
                    ),
                    'active_callback'   => 'azure_news_cb_has_sticky_sidebar_toggle_enable'
                )
            )
        );

        /**
         * Heading field for custom button
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_custom_button_heading',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Heading(
            $wp_customize, 'azure_news_header_custom_button_heading',
                array(
                    'priority'          => 30,
                    'section'           => 'azure_news_section_header_main_area',
                    'settings'          => 'azure_news_header_custom_button_heading',
                    'label'             => __( 'Custom Button', 'azure-news' )
                )
            )
        );

        /**
         * Text field for custom button label
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_custom_button_label',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_custom_button_label' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( 'azure_news_header_custom_button_label',
            array(
                'priority'          => 30,
                'section'           => 'azure_news_section_header_main_area',
                'settings'          => 'azure_news_header_custom_button_label',
                'label'             => __( 'Custom Button Label', 'azure-news' ),
                'type'              => 'text',
            )
        );

        /**
         * Url field for custom button link
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_custom_button_link',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_custom_button_link' ),
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_control( 'azure_news_header_custom_button_link',
            array(
                'priority'          => 35,
                'section'           => 'azure_news_section_header_main_area',
                'settings'          => 'azure_news_header_custom_button_link',
                'label'             => __( 'Custom Button Link', 'azure-news' ),
                'type'              => 'url',
            )
        );

        /**
         * Select option for header main background type
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_main_bg_type',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_main_bg_type' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_header_main_bg_type',
            array(
                'priority'          => 60,
                'section'           => 'azure_news_section_header_main_area',
                'settings'          => 'azure_news_header_main_bg_type',
                'label'             => __( 'Background Type', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_bg_type_choices()
            )
        );

        /**
         * Color Picker field for Main Area background color
         * 
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_main_bg_color',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_main_bg_color' ),
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize, 'azure_news_header_main_bg_color',
                array(
                    'priority'          => 65,
                    'section'           => 'azure_news_section_header_main_area',
                    'settings'          => 'azure_news_header_main_bg_color',
                    'label'             => __( 'Background Color', 'azure-news' ),
                    'active_callback'   => 'azure_news_cb_has_bg_type_color',
                )
            )
        );

        /**
         * Cropped Image field for header main area background image
         *
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_main_bg_image',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_main_bg_image' ),
                'sanitize_callback' => 'absint'
            )
        );
        $wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
            $wp_customize, 'azure_news_header_main_bg_image',
                array(
                    'priority'          => 70,
                    'section'           => 'azure_news_section_header_main_area',
                    'settings'          => 'azure_news_header_main_bg_image',
                    'label'             => __( 'Background Image', 'azure-news' ),
                    'height'            => 270,
                    'width'             => 1320,
                    'flex_width'        =>true,
                    'active_callback'   => 'azure_news_cb_has_bg_type_image'
                )
            )
        );

        /**
         * Upgrade field for Header Main
         * 
         * Header Settings > Main Area
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_header_main',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_header_main',
                array(
                    'priority'      => 100,
                    'section'       => 'azure_news_section_header_main_area',
                    'settings'      => 'upgrade_header_main',
                    'label'         => __( 'More Features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_header_main' )
                )
            )
        );

    }

endif;