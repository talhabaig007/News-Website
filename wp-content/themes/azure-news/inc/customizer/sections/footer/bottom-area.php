<?php
/**
 * Footer bottom area fields in Footer Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_footer_bottom_options' );

if ( ! function_exists( 'azure_news_register_footer_bottom_options' ) ) :

    /**
     * Register theme options for Bottom Area section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_footer_bottom_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Bottom Area Section
         * 
         * Footer Settings > Bottom Area
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_footer_bottom',
                array(
                    'priority'  => 20,
                    'panel'     => 'azure_news_panel_footer',
                    'title'     => __( 'Bottom Area', 'azure-news' ),
                )
            )
        );

        /**
         * Toggle option for footer bottom area
         *
         * Footer Settings > Bottom Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_footer_bottom_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_footer_bottom_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_footer_bottom_enable',
                array(
                    'priority'          => 15,
                    'section'           => 'azure_news_section_footer_bottom',
                    'settings'          => 'azure_news_footer_bottom_enable',
                    'label'             => __( 'Enable footer bottom area.', 'azure-news' )
                )
            )
        );

        /**
         * Textarea field for copyright content
         *
         * Footer Settings > Bottom Area
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_footer_copyright_info',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_footer_copyright_info' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'wp_kses_post'
            )
        );
        $wp_customize->add_control( 'azure_news_footer_copyright_info',
            array(
                'priority'          => 25,
                'section'           => 'azure_news_section_footer_bottom',
                'settings'          => 'azure_news_footer_copyright_info',
                'label'             => __( 'Copyright Content', 'azure-news' ),
                'type'              => 'textarea'
            )
        );

    }

endif;