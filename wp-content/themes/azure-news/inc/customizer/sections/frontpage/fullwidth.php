<?php
/**
 * Add Fullwidth section and it's fields inside Frontpage Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_fullwidth_options' );

if ( ! function_exists( 'azure_news_register_fullwidth_options' ) ) :

    /**
     * Register theme options for Fullwidth section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_fullwidth_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Fullwidth Section
         * 
         * Frontpage Settings > Fullwidth
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_fullwidth',
                array(
                    'priority'  => 15,
                    'panel'     => 'azure_news_panel_frontpage',
                    'title'     => __( 'Fullwidth', 'azure-news' ),
                )
            )
        );

        /**
         * Block Repeater field for Fullwidth
         *
         * Frontpage Settings > Fullwidth
         * 
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_front_fullwidth_blocks',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_front_fullwidth_blocks' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Blocks_Repeater(
            $wp_customize, 'azure_news_front_fullwidth_blocks',
                array(
                    'label'       => esc_html__( 'Full Width Section Blocks', 'azure-news' ),
                    'section'     => 'azure_news_section_fullwidth',
                    'settings'    => 'azure_news_front_fullwidth_blocks',
                    'priority'      => 10
                )
            )
        );
        

    }

endif;