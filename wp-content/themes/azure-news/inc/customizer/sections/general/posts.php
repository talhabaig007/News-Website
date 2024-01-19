<?php
/**
 * Add Posts section and it's fields inside General Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_general_posts_options' );

if ( ! function_exists( 'azure_news_register_general_posts_options' ) ) :

    /**
     * Register theme options for Posts section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_general_posts_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Posts Section
         * 
         * General Settings > Posts
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_general_post',
                array(
                    'priority'  => 40,
                    'panel'     => 'azure_news_panel_general',
                    'title'     => __( 'Posts', 'azure-news' ),
                )
            )
        );

        /**
         * Select option for posts date style
         *
         * General Settings > Performance > Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_posts_date_style',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_posts_date_style' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_posts_date_style',
            array(
                'priority'          => 25,
                'section'           => 'azure_news_section_general_post',
                'settings'          => 'azure_news_posts_date_style',
                'label'             => __( 'Posts Date Style', 'azure-news' ),
                'description'       => __( 'Whether to show date published or modified date.', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_posts_date_style_choices()
            )
        );

        /**
         * Select option for posts date format
         *
         * General Settings > Performance > Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_posts_date_format',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_posts_date_format' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_posts_date_format',
            array(
                'priority'          => 30,
                'section'           => 'azure_news_section_general_post',
                'settings'          => 'azure_news_posts_date_format',
                'label'             => __( 'Posts Date Format', 'azure-news' ),
                'description'       => __( 'Posts date format applied to single and archive pages.', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_posts_date_format_choices()
            )
        );

        /**
         * Select option for posts thumbnail hover effect
         *
         * General Settings > Performance > Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_posts_thumbnail_hover_effect',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_posts_thumbnail_hover_effect' ),
                'sanitize_callback' => 'azure_news_sanitize_select'
            )
        );
        $wp_customize->add_control( 'azure_news_posts_thumbnail_hover_effect',
            array(
                'priority'          => 35,
                'section'           => 'azure_news_section_general_post',
                'settings'          => 'azure_news_posts_thumbnail_hover_effect',
                'label'             => __( 'Thumbnail Hover Effect', 'azure-news' ),
                'description'       => __( 'Applied to posts thumbanail listed in archive pages.', 'azure-news' ),
                'type'              => 'select',
                'choices'           => azure_news_posts_thumbnail_hover_effect_choices()
            )
        );

        /**
         * Toggle option for post read time.
         *
         * General Settings > Performance > Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_posts_reading_time_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_posts_reading_time_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_posts_reading_time_enable',
                array(
                    'priority'      => 40,
                    'section'       => 'azure_news_section_general_post',
                    'settings'      => 'azure_news_posts_reading_time_enable',
                    'label'         => __( 'Enable Posts Reading Time.', 'azure-news' )
                )
            )
        );

    }

endif;