<?php
/**
 * Add Site Style section and it's fields inside General Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_site_style_options' );

if ( ! function_exists( 'azure_news_register_site_style_options' ) ) :

    /**
     * Register theme options for Site Style section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_site_style_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Site Style Section
         * 
         * General Settings > Site Style
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_site_style',
                array(
                    'priority'              => 10,
                    'panel'                 => 'azure_news_panel_general',
                    'title'                 => __( 'Site Style', 'azure-news' ),
                )
            )
        );

        /**
         * Radio image field for site layout
         *
         * General Settings > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_site_container_layout',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_site_container_layout' ),
                'sanitize_callback' => 'azure_news_sanitize_select',
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Radio_Image(
            $wp_customize, 'azure_news_site_container_layout',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_site_style',
                    'settings'      => 'azure_news_site_container_layout',
                    'label'         => __( 'Container Layout', 'azure-news' ),
                    'choices'       => azure_news_site_container_layout_choices(),
                )
            )
        );

        /**
         * Divider field
         *
         * General Settings > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'divider_site_style_one',
            array(
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Divider(
            $wp_customize, 'divider_site_style_one',
                array(
                    'priority'      => 15,
                    'section'       => 'azure_news_section_site_style',
                    'settings'      => 'divider_site_style_one',
                )
            )
        );

        /**
         * Range field for main container width
         *
         * General Settings > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_main_container_width',
            array(
                'default'               => azure_news_get_customizer_default( 'azure_news_main_container_width' ),
                'sanitize_callback'     => 'azure_news_sanitize_number'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Range(
            $wp_customize, 'azure_news_main_container_width',
                array(
                    'priority'          => 20,
                    'section'           => 'azure_news_section_site_style',
                    'settings'          => 'azure_news_main_container_width',
                    'label'             => __( 'Main Container Width', 'azure-news' ),
                    'input_attrs'       => array(
                        'min'   => 0,
                        'max'   => 2040,
                        'step'  => 1,
                        'unit'  => 'px'
                    ),
                    'active_callback'   => 'azure_news_cb_hasnt_boxed_layout'
                )
            )
        );

        /**
         * Range field for boxed container width
         *
         * General Settings > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_boxed_container_width',
            array(
                'default'               => azure_news_get_customizer_default( 'azure_news_boxed_container_width' ),
                'sanitize_callback'     => 'azure_news_sanitize_number'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Range(
            $wp_customize, 'azure_news_boxed_container_width',
                array(
                    'priority'          => 25,
                    'section'           => 'azure_news_section_site_style',
                    'settings'          => 'azure_news_boxed_container_width',
                    'label'             => __( 'Boxed Container Width', 'azure-news' ),
                    'input_attrs'       => array(
                        'min'   => 0,
                        'max'   => 2040,
                        'step'  => 1,
                        'unit'  => 'px'
                    ),
                    'active_callback'   => 'azure_news_cb_has_boxed_layout'
                )
            )
        );

        /**
         * Radio buttonset field for site mode
         *
         * General Settings > Site Style
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_site_mode',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_site_mode' ),
                'sanitize_callback' => 'azure_news_sanitize_select',
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Buttonset(
            $wp_customize, 'azure_news_site_mode',
                array(
                    'priority'      => 50,
                    'section'       => 'azure_news_section_site_style',
                    'settings'      => 'azure_news_site_mode',
                    'label'         => __( 'Site Mode', 'azure-news' ),
                    'choices'       => azure_news_site_mode_choices(),
                )
            )
        );

    }

endif;