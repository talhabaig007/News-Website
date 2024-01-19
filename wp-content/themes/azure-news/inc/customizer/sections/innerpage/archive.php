<?php
/**
 * Archive Page and it's fields inside Innerpage Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_archive_options' );

if ( ! function_exists( 'azure_news_register_archive_options' ) ) :

    /**
     * Register theme options for Archive section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_archive_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Archive Section
         * 
         * Innerpage Settings > Archive Pages
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_page_archive',
                array(
                    'priority'  => 5,
                    'panel'     => 'azure_news_panel_innerpage',
                    'title'     => __( 'Archive Pages', 'azure-news' ),
                )
            )
        );

        /**
         * Select option for archive page style
         *
         * Innerpage Settings > Archive Pages
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_archive_page_style',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_archive_page_style' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_archive_page_style',
            array(
                'priority'          => 10,
                'section'           => 'azure_news_section_page_archive',
                'settings'          => 'azure_news_archive_page_style',
                'label'             => __( 'Archive Page Style', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_archive_page_style_choices()
            )
        );

        /**
         * Toggle option for archive title prefix.
         *
         * Innerpage Settings > Archive Pages
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_archive_title_prefix_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_archive_title_prefix_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_archive_title_prefix_enable',
                array(
                    'priority'      => 15,
                    'section'       => 'azure_news_section_page_archive',
                    'settings'      => 'azure_news_archive_title_prefix_enable',
                    'label'         => __( 'Enable archive page title prefix.', 'azure-news' )
                )
            )
        );

        /**
         * Toggle option for archive post read more.
         *
         * Innerpage Settings > Archive Pages
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_archive_post_readmore_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_archive_post_readmore_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_archive_post_readmore_enable',
                array(
                    'priority'      => 25,
                    'section'       => 'azure_news_section_page_archive',
                    'settings'      => 'azure_news_archive_post_readmore_enable',
                    'label'         => __( 'Enable read more.', 'azure-news' )
                )
            )
        );

        /**
         * Upgrade field for archive pages
         * 
         * Innerpage Settings > Archive Pages
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_archive',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_archive',
                array(
                    'priority'      => 100,
                    'section'       => 'azure_news_section_page_archive',
                    'settings'      => 'upgrade_archive',
                    'label'         => __( 'More Features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_archive' )
                )
            )
        );

    }

endif;