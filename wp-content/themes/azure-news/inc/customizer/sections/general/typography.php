<?php
/**
 * Add Typography section and it's fields inside General Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_typography_options' );

if ( ! function_exists( 'azure_news_register_typography_options' ) ) :

    /**
     * Register theme options for Typography section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_typography_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Typography Section
         * 
         * General Settings > Typography
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_typography',
                array(
                    'priority'  => 30,
                    'panel'     => 'azure_news_panel_general',
                    'title'     => __( 'Typography', 'azure-news' ),
                )
            )
        );

        /**
         * Body Typography Section
         *
         * General Settings > Typography > Body
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section(
            $wp_customize, 'azure_news_section_typography_body',
                array(
                    'priority'      => 10,
                    'panel'         => 'azure_news_panel_general',
                    'section'       => 'azure_news_section_typography',
                    'title'         => __( 'Body', 'azure-news' )
                )
            )
        );

        /**
         * Typography Font filed for body typography
         *
         * General Settings > Typography > Body
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'azure_news_body_font_family',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_body_font_family' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_setting(
            'azure_news_body_font_weight',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_body_font_weight' ),
                'sanitize_callback' => 'sanitize_key',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting(
            'azure_news_body_font_style',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_body_font_style' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting(
            'azure_news_body_font_transform',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_body_font_transform' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                
            )
        );
        $wp_customize->add_setting(
            'azure_news_body_font_decoration',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_body_font_decoration' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                
            )
        );

        $wp_customize->add_control( new Azure_News_Control_Typography (
            $wp_customize,
                'body_typography',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_typography_body',
                    'settings'      => array(
                        'family'        => 'azure_news_body_font_family',
                        'weight'        => 'azure_news_body_font_weight',
                        'style'         => 'azure_news_body_font_style',
                        'transform'     => 'azure_news_body_font_transform',
                        'decoration'    => 'azure_news_body_font_decoration'
                    ),
                    'description'   => __( 'Select how you want your body fonts to appear.', 'azure-news' ),
                    'l10n'          => array() // Pass custom labels. Use the setting key (above) for the specific label.
                )
            )
        );

        /**
         * Heading Typography Section
         *
         * General Settings > Typography > Heading
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section(
            $wp_customize, 'azure_news_section_typography_heading',
                array(
                    'priority'      => 20,
                    'panel'         => 'azure_news_panel_general',
                    'section'       => 'azure_news_section_typography',
                    'title'         => __( 'Heading', 'azure-news' )
                )
            )
        );

        /**
         * Typography Font filed for heading typography
         *
         * General Settings > Typography > Heading
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'azure_news_heading_font_family',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_heading_font_family' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_setting(
            'azure_news_heading_font_weight',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_heading_font_weight' ),
                'sanitize_callback' => 'sanitize_key',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting(
            'azure_news_heading_font_style',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_heading_font_style' ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting(
            'azure_news_heading_font_transform',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_heading_font_transform' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                
            )
        );
        $wp_customize->add_setting(
            'azure_news_heading_font_decoration',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_heading_font_decoration' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                
            )
        );

        $wp_customize->add_control( new Azure_News_Control_Typography (
            $wp_customize,
                'heading_typography',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_typography_heading',
                    'settings'      => array(
                        'family'        => 'azure_news_heading_font_family',
                        'weight'        => 'azure_news_heading_font_weight',
                        'style'         => 'azure_news_heading_font_style',
                        'transform'     => 'azure_news_heading_font_transform',
                        'decoration'    => 'azure_news_heading_font_decoration'
                    ),
                    'description'   => __( 'Select how you want your body fonts to appear.', 'azure-news' ),
                    'l10n'          => array() // Pass custom labels. Use the setting key (above) for the specific label.
                )
            )
        );

        /**
         * Upgrade field for typography section
         * 
         * General Settings > Typography
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_typogrpahy',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_typogrpahy',
                array(
                    'priority'      => 70,
                    'section'       => 'azure_news_section_typography',
                    'settings'      => 'upgrade_typogrpahy',
                    'label'         => __( 'More Options with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_typography' )
                )
            )
        );

    }

endif;