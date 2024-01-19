<?php
/**
 * Add Social Icons section and it's fields inside General Settings panel.
 * 
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'azure_news_register_social_icons_options' );

if ( ! function_exists( 'azure_news_register_social_icons_options' ) ) :

    /**
     * Register theme options for Social Icons section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function azure_news_register_social_icons_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Social Icons Section
         * 
         * General Settings > Social Icons
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new Azure_News_Customize_Section (
            $wp_customize, 'azure_news_section_social_icons',
                array(
                    'priority'  => 25,
                    'panel'     => 'azure_news_panel_general',
                    'title'     => __( 'Social Icons', 'azure-news' ),
                )
            )
        );

        /**
         * Toggle option for social icon target.
         *
         * General Settings > Social Icons
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_social_icon_link_target',
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_social_icon_link_target' ),
                'sanitize_callback' => 'azure_news_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Toggle(
            $wp_customize, 'azure_news_social_icon_link_target',
                array(
                    'priority'      => 10,
                    'section'       => 'azure_news_section_social_icons',
                    'settings'      => 'azure_news_social_icon_link_target',
                    'label'         => __( 'Open links in new tab', 'azure-news' )
                )
            )
        );

        /**
         * Repeater field for Social Icons
         *
         * General Settings > Social Icons
         * 
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'azure_news_social_icons', 
            array(
                'default'           => azure_news_get_customizer_default( 'azure_news_social_icons' ),
                'sanitize_callback' => 'azure_news_sanitize_repeater'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Repeater(
            $wp_customize,  'azure_news_social_icons',
                array(
                    'priority'        => 20,
                    'section'         => 'azure_news_section_social_icons',
                    'settings'        => 'azure_news_social_icons',
                    'label'           => __( 'Social Icons', 'azure-news' ),
                    'azure_news_box_label_text'       => __( 'Social Icons','azure-news' ),
                    'azure_news_box_add_control_text' => __( 'Add New Icon','azure-news' ),
                    'azure_news_field_limit'          => 4
                ),
                array(
                    'social_icon' => array(
                        'type'          => 'social_icon',   
                        'label'         => __( 'Social Icon', 'azure-news' ),
                        'description'   => __( 'Choose social media icon.', 'azure-news' )
                    ),
                    'social_url'  => array(
                        'type'          => 'url',
                        'label'         => __( 'Social Link URL', 'azure-news' ),
                        'description'   => __( 'Enter social media url.', 'azure-news' )
                    ),
                    'item_visible'   => array(
                        'type'  => 'hidden'
                    )
                )
            )
        );

        /**
         * Upgrade field for social icon section
         * 
         * General Settings > Social Icons
         *
         * @since 1.0.0
         */ 
        $wp_customize->add_setting( 'upgrade_social_icons',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new Azure_News_Control_Upgrade(
            $wp_customize, 'upgrade_social_icons',
                array(
                    'priority'      => 70,
                    'section'       => 'azure_news_section_social_icons',
                    'settings'      => 'upgrade_social_icons',
                    'label'         => __( 'More features with Azure Pro', 'azure-news' ),
                    'choices'       => azure_news_upgrade_choices( 'azure_news_social_icon' )
                )
            )
        );

    }

endif;