<?php
/**
 * Footer main area fields in Footer Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_footer_main_options' );

if ( ! function_exists( 'azure_news_register_footer_main_options' ) ) :

    /**
     * Register theme options for Main Area section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_footer_main_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Main Area Section
         * 
         * Footer Settings > Main Area
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_footer_main',
                array(
                    'priority'  => 10,
                    'panel'     => 'azure_news_panel_footer',
                    'title'     => __( 'Main Area', 'azure-news' ),
                )
            )
        );

        /**
         * Toggle option for footer main area
         *
         * Footer Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_footer_main_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_footer_main_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_footer_main_enable',
                array(
                    'priority'          => 15,
                    'section'           => 'azure_news_section_footer_main',
                    'settings'          => 'azure_news_footer_main_enable',
                    'label'             => __( 'Enable footer main area.', 'azure-news' )
                )
            )
        );

        /**
         * Radio image field for footer widget area layout
         *
         * Footer Settings > Main Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_footer_widget_area_layout',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_footer_widget_area_layout' ),
                'sanitize_callback' => 'azure_news_sanitize_select',
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Radio_Image(
            $wp_customize, 'azure_news_footer_widget_area_layout',
                array(
                    'priority'          => 20,
                    'section'           => 'azure_news_section_footer_main',
                    'settings'          => 'azure_news_footer_widget_area_layout',
                    'label'             => __( 'Widget Area Layout', 'azure-news' ),
                    'choices'           => azure_news_footer_widget_area_layout_choices(),
                    'active_callback'   => 'azure_news_cb_has_enable_footer_main'
                )
            )
        );

    }

endif;