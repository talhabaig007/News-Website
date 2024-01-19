<?php
/**
 * 404 Error and it's fields inside Innerpage Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_page_error_options' );

if ( ! function_exists( 'azure_news_register_page_error_options' ) ) :

    /**
     * Register theme options for 404 Error section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_page_error_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * 404 Error Section
         * 
         * Innerpage Settings > 404 Error
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_page_error',
                array(
                    'priority'  => 35,
                    'panel'     => 'azure_news_panel_innerpage',
                    'title'     => __( '404 Error', 'azure-news' ),
                )
            )
        );

        /**
         * Toggle option for search form in 404 error page.
         *
         * Innerpage Settings > 404 Error
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_error_page_search_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_error_page_search_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_error_page_search_enable',
                array(
                    'priority'          => 10,
                    'section'           => 'azure_news_section_page_error',
                    'settings'          => 'azure_news_error_page_search_enable',
                    'label'             => __( 'Enable Search box', 'azure-news' )
                )
            )
        );

        /**
         * Toggle option for homepage button.
         *
         * Innerpage Settings > 404 Error
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_error_page_button_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_error_page_button_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_error_page_button_enable',
                array(
                    'priority'          => 20,
                    'section'           => 'azure_news_section_page_error',
                    'settings'          => 'azure_news_error_page_button_enable',
                    'label'             => __( 'Enable homepage button', 'azure-news' )
                )
            )
        );

        /**
         * Text field for homepage button label
         *
         * Innerpage Settings > 404 Error
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_error_page_button_label',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_error_page_button_label' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( 'azure_news_error_page_button_label',
            array(
                'priority'          => 25,
                'section'           => 'azure_news_section_page_error',
                'settings'          => 'azure_news_error_page_button_label',
                'label'             => __( 'Button Label', 'azure-news' ),
                'type'              => 'text',
                'active_callback'   => 'azure_news_cb_has_enable_error_page_button'
            )
        );

        /**
         * Upgrade field for error page
         * 
         * Innerpage Settings > 404 Error
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_error_page',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_error_page',
                array(
                    'priority'      => 100,
                    'section'       => 'azure_news_section_page_error',
                    'settings'      => 'upgrade_error_page',
                    'label'         => __( 'More Features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_error_page' )
                )
            )
        );

    }

endif;