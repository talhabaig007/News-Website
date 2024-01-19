<?php
/**
 * Add Preloader section and it's fields inside General Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_preloader_options' );

if ( ! function_exists( 'azure_news_register_preloader_options' ) ) :

    /**
     * Register theme options for Preloader section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_preloader_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Site Style Section
         * 
         * General Settings > Preloader
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_preloader',
                array(
                    'priority'              => 20,
                    'panel'                 => 'azure_news_panel_general',
                    'title'                 => __( 'Preloader', 'azure-news' ),
                )
            )
        );

        /**
         * Toggle option for preloader.
         *
         * General Settings > Preloader
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_preloader_enable',
            array(
                'default'           => azure_news_get_customizer_default ( 'azure_news_preloader_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_preloader_enable',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_preloader',
                    'settings'      => 'azure_news_preloader_enable',
                    'label'         => __( 'Enable Preloader', 'azure-news' )
                )
            )
        );

        /**
         * Radio image field for preloader styles
         *
         * General Settings > Preloader
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_preloader_style',
            array(
                'default'           => azure_news_get_customizer_default ( 'azure_news_preloader_style' ),
                'sanitize_callback' => 'azure_news_sanitize_select',
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Radio_Image(
            $wp_customize, 'azure_news_preloader_style',
                array(
                    'priority'          => 20,
                    'section'           => 'azure_news_section_preloader',
                    'settings'          => 'azure_news_preloader_style',
                    'label'             => __( 'Preloader Layout', 'azure-news' ),
                    'choices'           => azure_news_preloader_style_choices(),
                    'input_attrs'       => array(
                        'column'    => 4,
                    ),
                    'active_callback'   => 'azure_news_cb_has_enable_preloader'
                )
            )
        );

        /**
         * Upgrade field for preloader section
         * 
         * General Settings > Preloader
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_preloader',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_preloader',
                array(
                    'priority'      => 70,
                    'section'       => 'azure_news_section_preloader',
                    'settings'      => 'upgrade_preloader',
                    'label'         => __( 'More features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_preloader' )
                )
            )
        );

    }

endif;