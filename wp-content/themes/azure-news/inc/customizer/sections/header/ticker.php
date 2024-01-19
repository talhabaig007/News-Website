<?php
/**
 * Add News Ticker section and it's fields inside Header Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_ticker_options' );

if ( ! function_exists( 'azure_news_register_ticker_options' ) ) :

    /**
     * Register theme options for News Ticker section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_ticker_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add News Ticker Section
         * 
         * Header Settings > News Ticker
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_header_ticker',
                array(
                    'priority'  => 40,
                    'panel'     => 'azure_news_panel_header',
                    'title'     => __( 'News Ticker', 'azure-news' ),
                )
            )
        );

        /**
         * Toggle option for news ticker.
         *
         * Header Settings > News Ticker
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_ticker_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_ticker_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_header_ticker_enable',
                array(
                    'priority'      => 15,
                    'section'       => 'azure_news_section_header_ticker',
                    'settings'      => 'azure_news_header_ticker_enable',
                    'label'         => __( 'Enable News Ticker', 'azure-news' )
                )
            )
        );

        /**
         * Text field for news ticker label
         *
         * Header Settings > News Ticker
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_header_ticker_label',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_header_ticker_label' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( 'azure_news_header_ticker_label',
            array(
                'priority'          => 20,
                'section'           => 'azure_news_section_header_ticker',
                'settings'          => 'azure_news_header_ticker_label',
                'label'             => __( 'Ticker Label', 'azure-news' ),
                'type'              => 'text',
                'active_callback'   => 'azure_news_cb_has_enable_header_ticker'
            )
        );

        /**
         * Select option for ticker posts date filter
         *
         * Header Settings > News Ticker
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_ticker_posts_date_filter',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_ticker_posts_date_filter' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_ticker_posts_date_filter',
            array(
                'priority'          => 35,
                'section'           => 'azure_news_section_header_ticker',
                'settings'          => 'azure_news_ticker_posts_date_filter',
                'label'             => __( 'Posts Date Filter', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_posts_date_filter_choices(),
                'active_callback'   => 'azure_news_cb_has_enable_header_ticker'
            )
        );

        /**
         * Upgrade field for ticker
         * 
         * Header Settings > News Ticker
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_ticker',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_ticker',
                array(
                    'priority'      => 70,
                    'section'       => 'azure_news_section_header_ticker',
                    'settings'      => 'upgrade_ticker',
                    'label'         => __( 'More Features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_ticker' )
                )
            )
        );

    }

endif;