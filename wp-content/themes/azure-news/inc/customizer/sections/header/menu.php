<?php
/**
 * Add Primary Menu section and it's fields inside Header Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_primary_menu_options' );

if ( ! function_exists( 'azure_news_register_primary_menu_options' ) ) :

    /**
     * Register theme options for Primary Menu section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_primary_menu_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Primary Menu Section
         * 
         * Header Settings > Primary Menu
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_primary_menu',
                array(
                    'priority'  => 25,
                    'panel'     => 'azure_news_panel_header',
                    'title'     => __( 'Primary Menu', 'azure-news' ),
                )
            )
        );

        /**
         * Toggle option for primary menu description
         *
         * Header Settings > Primary Menu
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_primary_menu_description_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_primary_menu_description_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_primary_menu_description_enable',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_primary_menu',
                    'settings'      => 'azure_news_primary_menu_description_enable',
                    'label'         => __( 'Enable Menu Description', 'azure-news' )
                )
            )
        );

        /**
         * Upgrade field for Primary Menu
         * 
         * Header Settings > Primary Menu
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_primary_menu',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_primary_menu',
                array(
                    'priority'      => 100,
                    'section'       => 'azure_news_section_primary_menu',
                    'settings'      => 'upgrade_primary_menu',
                    'label'         => __( 'More options with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_primary_menu' )
                )
            )
        );

    }

endif;