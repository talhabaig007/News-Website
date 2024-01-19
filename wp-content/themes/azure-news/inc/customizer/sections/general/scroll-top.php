<?php
/**
 * Add Scroll Top section and it's fields inside General Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_scroll_top_options' );

if ( ! function_exists( 'azure_news_register_scroll_top_options' ) ) :

    /**
     * Register theme options for Scroll Top section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_scroll_top_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Scroll Top Section
         * 
         * General Settings > Scroll Top
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_scroll_top',
                array(
                    'priority'  => 45,
                    'panel'     => 'azure_news_panel_general',
                    'title'     => __( 'Scroll Top', 'azure-news' ),
                )
            )
        );

        /**
         * Toggle option for scroll top.
         *
         * General Settings > Scroll Top
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_scroll_top_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_scroll_top_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_scroll_top_enable',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_scroll_top',
                    'settings'      => 'azure_news_scroll_top_enable',
                    'label'         => __( 'Enable Scroll Top', 'azure-news' )
                )
            )
        );

        /**
         * Radio icons field for scroll top arrow
         *
         * General Settings > Scroll Top
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_scroll_top_arrow',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_scroll_top_arrow' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Radio_Icons(
            $wp_customize, 'azure_news_scroll_top_arrow',
                array(
                    'priority'          => 20,
                    'section'           => 'azure_news_section_scroll_top',
                    'settings'          => 'azure_news_scroll_top_arrow',
                    'label'             => __( 'Arrow Icon', 'azure-news' ),
                    'description'       => __( 'Choose required arrow from available lists.', 'azure-news' ),
                    'choices'           => azure_news_scroll_top_arrow_choices(),
                    'active_callback'   => 'azure_news_cb_has_enable_scroll_top'
                )
            )
        );

        /**
         * Upgrade field for scroll top
         * 
         * General Settings > Scroll Top
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_scroll_top',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_scroll_top',
                array(
                    'priority'      => 70,
                    'section'       => 'azure_news_section_scroll_top',
                    'settings'      => 'upgrade_scroll_top',
                    'label'         => __( 'More Features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_scroll_top' )
                )
            )
        );

    }

endif;