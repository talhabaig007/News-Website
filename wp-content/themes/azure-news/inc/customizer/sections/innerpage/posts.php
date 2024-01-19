<?php
/**
 * Single Posts and it's fields inside Innerpage Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_single_posts_options' );

if ( ! function_exists( 'azure_news_register_single_posts_options' ) ) :

    /**
     * Register theme options for Single Posts section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_single_posts_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Single Posts Section
         * 
         * Innerpage Settings > Single Posts
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_post_single',
                array(
                    'priority'  => 15,
                    'panel'     => 'azure_news_panel_innerpage',
                    'title'     => __( 'Single Posts', 'azure-news' ),
                )
            )
        );

        /**
         * Heading field for posts author box
         *
         * Innerpage Settings > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'single_posts_author_heading',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Heading(
            $wp_customize, 'single_posts_author_heading',
                array(
                    'priority'          => 25,
                    'section'           => 'azure_news_section_post_single',
                    'settings'          => 'single_posts_author_heading',
                    'label'             => __( 'Author Box', 'azure-news' )
                )
            )
        );

        /**
         * Toggle option for single posts author box
         *
         * Innerpage Settings > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_single_posts_author_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_single_posts_author_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_single_posts_author_enable',
                array(
                    'priority'          => 25,
                    'section'           => 'azure_news_section_post_single',
                    'settings'          => 'azure_news_single_posts_author_enable',
                    'label'             => __( 'Enable author box', 'azure-news' )
                )
            )
        );

        /**
         * Heading field for related posts
         *
         * Innerpage Settings > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'single_posts_related_heading',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Heading(
            $wp_customize, 'single_posts_related_heading',
                array(
                    'priority'          => 45,
                    'section'           => 'azure_news_section_post_single',
                    'settings'          => 'single_posts_related_heading',
                    'label'             => __( 'Related Posts', 'azure-news' )
                )
            )
        );

        /**
         * Toggle option for single posts related posts
         *
         * Innerpage Settings > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_single_posts_related_enable',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_single_posts_related_enable' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_single_posts_related_enable',
                array(
                    'priority'          => 45,
                    'section'           => 'azure_news_section_post_single',
                    'settings'          => 'azure_news_single_posts_related_enable',
                    'label'             => __( 'Enable related posts', 'azure-news' )
                )
            )
        );

        /**
         * Text field for related posts section title
         *
         * Innerpage Settings > Single Posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_single_posts_related_label',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_single_posts_related_label' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( 'azure_news_single_posts_related_label',
            array(
                'priority'          => 50,
                'section'           => 'azure_news_section_post_single',
                'settings'          => 'azure_news_single_posts_related_label',
                'label'             => __( 'Section Title', 'azure-news' ),
                'type'              => 'text',
                'active_callback'   => 'azure_news_cb_has_enable_single_posts_related'
            )
        );

        /**
         * Upgrade field for single posts
         * 
         * Innerpage Settings > Single Posts
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_single_post',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_single_post',
                array(
                    'priority'      => 100,
                    'section'       => 'azure_news_section_post_single',
                    'settings'      => 'upgrade_single_post',
                    'label'         => __( 'More Features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_single_post' )
                )
            )
        );

    }

endif;