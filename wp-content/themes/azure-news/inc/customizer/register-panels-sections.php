<?php
/**
 * Customizer: Add Panels/Sections
 *
 * Add Panels/Sections to the Customizer.
 * 
 * @package Azure News
 */ 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_customizer_panels_sections' );

if ( ! function_exists( 'azure_news_register_customizer_panels_sections' ) ) :
    
    /**
     * Implement the Theme Customizer for Theme Settings.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    function azure_news_register_customizer_panels_sections( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }
    /*--------------------------- Add Panels -------------------------------------*/
        
        /**
         * Add Panel for General Settings
         * 
         * Customize > General Settings
         * 
         * @uses $wp_customize->add_panel() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
         * @since 1.0.0
         */
        $wp_customize->add_panel(
            'azure_news_panel_general',
            array(
                'priority'          => 5,
                'title'             => __( 'General Settings', 'azure-news' )
            )
        );

        /**
         * Add Panel for Header Settings
         * 
         * Customize > Header Settings
         * 
         * @uses $wp_customize->add_panel() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
         * @since 1.0.0
         */
        $wp_customize->add_panel(
            'azure_news_panel_header',
            array(
                'priority'          => 10,
                'title'             => __( 'Header Settings', 'azure-news' )
            )
        );

        /**
         * Add Panel for Frontpage Settings
         * 
         * Customize > Frontpage Settings
         * 
         * @uses $wp_customize->add_panel() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
         * @since 1.0.0
         */
        $wp_customize->add_panel(
            'azure_news_panel_frontpage',
            array(
                'priority'          => 15,
                'title'             => __( 'Frontpage Settings', 'azure-news' )
            )
        );

        /**
         * Add Panel for Innerpage Settings
         * 
         * Customize > Innerpage Settings
         * 
         * @uses $wp_customize->add_panel() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
         * @since 1.0.0
         */
        $wp_customize->add_panel(
            'azure_news_panel_innerpage',
            array(
                'priority'          => 20,
                'title'             => __( 'Innerpage Settings', 'azure-news' )
            )
        );

        /**
         * Add Panel for Footer Settings
         * 
         * Customize > Footer Settings
         * 
         * @uses $wp_customize->add_panel() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_panel/
         * @since 1.0.0
         */
        $wp_customize->add_panel(
            'azure_news_panel_footer',
            array(
                'priority'          => 25,
                'title'             => __( 'Footer Settings', 'azure-news' )
            )
        );

    }
    
endif;