<?php
/**
 * Add Breadcrumb section and it's fields inside General Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_breadcrumb_options' );

if ( ! function_exists( 'azure_news_register_breadcrumb_options' ) ) :

    /**
     * Register theme options for Breadcrumb section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_breadcrumb_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Breadcrumb Section
         * 
         * General Settings > Breadcrumb
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_breadcrumb',
                array(
                    'priority'  => 35,
                    'panel'     => 'azure_news_panel_general',
                    'title'     => __( 'Breadcrumb', 'azure-news' ),
                )
            )
        );

        /**
         * Toggle option for breadcrumb content
         *
         * General Settings > Breadcrumb
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_site_breadcrumb_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_site_breadcrumb_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_site_breadcrumb_enable',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_breadcrumb',
                    'settings'      => 'azure_news_site_breadcrumb_enable',
                    'label'         => __( 'Enable Breadcrumb Trial', 'azure-news' )
                )
            )
        );

        /**
         * Select field for breadcrumb types
         */
        $wp_customize->add_setting( 'azure_news_site_breadcrumb_types',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_site_breadcrumb_types' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_site_breadcrumb_types',
            array(
                'priority'          => 15,
                'section'           => 'azure_news_section_breadcrumb',
                'settings'          => 'azure_news_site_breadcrumb_types',
                'label'             => __( 'Breadcrumb Types', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_site_breadcrumb_types_choices(),
                'active_callback'   => 'azure_news_has_enable_site_breadcrumb_callback',
            )
        );

        /**
         * Upgrade field for breadcrumb
         * 
         * General Settings > Breadcrumb
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_breadcrumb',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_breadcrumb',
                array(
                    'priority'      => 70,
                    'section'       => 'azure_news_section_breadcrumb',
                    'settings'      => 'upgrade_breadcrumb',
                    'label'         => __( 'More Features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_breadcrumb' )
                )
            )
        );

    }

endif;