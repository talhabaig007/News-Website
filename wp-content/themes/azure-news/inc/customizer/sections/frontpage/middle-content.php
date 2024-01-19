<?php
/**
 * Add Middle Content section and it's fields inside Frontpage Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_middle_content_options' );

if ( ! function_exists( 'azure_news_register_middle_content_options' ) ) :

    /**
     * Register theme options for Middle Content section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_middle_content_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Middle Content Section
         * 
         * Frontpage Settings > Middle Content
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_middle_content',
                array(
                    'priority'  => 10,
                    'panel'     => 'azure_news_panel_frontpage',
                    'title'     => __( 'Middle Content', 'azure-news' ),
                )
            )
        );

        /**
         * Redirect field for Middle Right Sidebar.
         *
         * Frontpage Settings > Middle Content
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'middle_content_right_sidebar_redirect',
            array(
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Redirect(
            $wp_customize, 'middle_content_right_sidebar_redirect',
                array(
                    'priority'      => 5,
                    'section'       => 'azure_news_section_middle_content',
                    'settings'      => 'middle_content_right_sidebar_redirect',
                    'choices'       => array(
                        'front-middle-right-sidebar' => array(
                            'type'          => 'section',
                            'type_id'       => 'sidebar-widgets-front-middle-right-sidebar',
                            'type_label'    => __( 'Manage right sidebar', 'azure-news' )
                        )
                    )
                )
            )
        );

        /**
         * Block Repeater field for Middle Content
         *
         * Frontpage Settings > Middle Content
         * 
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_front_middle_content_blocks',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_front_middle_content_blocks' ),
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Blocks_Repeater(
            $wp_customize, 'azure_news_front_middle_content_blocks',
                array(
                    'label'       => esc_html__( 'Middle Content Section Blocks', 'azure-news' ),
                    'section'     => 'azure_news_section_middle_content',
                    'settings'    => 'azure_news_front_middle_content_blocks',
                    'priority'      => 10
                )
            )
        );

    }

endif;