<?php
/**
 * Defines the plugin class executes when plugin is activated.
 * 
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
if ( !class_exists( 'Maintenance_Notice_Activator' ) ):
    
    class Maintenance_Notice_Activator {
        /**
         * Called by plugin activation hook.
         * 
         * @access public
         */
        public function activate() {
            // Set the plugin activation time. 
            $maintenance_notice_activated_time = get_option( 'maintenance_notice_activated_time' );
            if ( !$maintenance_notice_activated_time ) {
                update_option( 'maintenance_notice_activated_time', time() );
            }

            /**
             * Set default values
             * 
             */
            $default_values = $this->default_values();
            $maintenance_notice_options = get_option( 'maintenance_notice_options' );
            if ( !$maintenance_notice_options ) {
                update_option( 'maintenance_notice_options', $default_values );
            }
        }

        /**
         * Default Options
         * 
         * @since 1.0.0
         */
        function default_values() {
            $default_values = array(
                'cvmn_maintenance_page_display'    => esc_html( 'hide' ),
                'cvmn_maintenance_page_background_type' => esc_html( 'none' ),
                'cvmn_page_title'                       => get_bloginfo( 'name' ),
                'cvmn_page_heading'                     => esc_html__( 'Site Maintenance is on', 'maintenance-notice' ),
                'cvmn_page_description'                 => esc_html__( 'We will be available soon. Thank you for your patience!', 'maintenance-notice' ),
                'cvmn_logo'                             => '',
                'cvmn_background_image'                 => '',
                'cvmn_background_video_url'             => '',
                'cvmn_button_one_label'                 => esc_html__( 'Subscribe Us', 'maintenance-notice' ),
                'cvmn_button_one_link'                  => '',
                'cvmn_countdown_display'                => 'show',
                'cvmn_countdown_end_date'               => '',
                'cvmn_countdown_end_time'               => '12:00',
                'cvmn_countdown_end_popup_content'      => esc_html__( 'Thank you for your patience! We are here now with site content. Its not so far', 'maintenance-notice' ),
                'cvmn_countdown_font_color'             => '#ffffff',
                'cvmn_countdown_bg_color'               => '#000000',
                'cvmn_social_icons_display'             => 'hide',
                'cvmn_social_icons_array'               => json_encode( array( array( 'cvmn_social_icons_array_icon' => 'fab fa-facebook-f', 'cvmn_social_icons_array_icon_url' => '#' ) ) ),
                'cvmn_background_color'                       => '#ffffff',
                'cvmn_background_overlay_type'          => esc_html( 'none' ),
                'cvmn_background_overlay_opacity'       => '0.5',
                'cvmn_exclude_pages'                    => '',
                'cvmn_login_form_display'               => 'show',
                'cvmn_login_form_title'                 => esc_html__( 'Log In', 'maintenance-notice' ),
                'cvmn_page_typography_inherit'          => 'show',
                'cvmn_page_title_font_family'           => 'Roboto',
                'cvmn_page_title_font_family_variant'   => 'regular',
                'cvmn_page_title_text_transform'        => 'none',
                'cvmn_page_title_text_decoration'       => 'none',
                'cvmn_page_title_font_size'             => '18',
                'cvmn_page_title_font_color'            => '#000000',
                'cvmn_page_heading_font_family'         => 'Roboto',
                'cvmn_page_heading_font_family_variant' => 'regular',
                'cvmn_page_heading_text_transform'      => 'none',
                'cvmn_page_heading_text_decoration'     => 'none',
                'cvmn_page_heading_font_size'           => '18',
                'cvmn_page_heading_font_color'          => '#000000',
                'cvmn_page_description_font_family'           => 'Roboto',
                'cvmn_page_description_font_family_variant'   => 'regular',
                'cvmn_page_description_text_transform'        => 'none',
                'cvmn_page_description_text_decoration'       => 'none',
                'cvmn_page_description_font_size'             => '18',
                'cvmn_page_description_font_color'            => '#000000',
                'cvmn_page_countdown_font_family'           => 'Roboto',
                'cvmn_page_countdown_font_family_variant'   => 'regular',
                'cvmn_page_countdown_text_transform'        => 'none',
                'cvmn_page_countdown_text_decoration'       => 'none',
                'cvmn_page_countdown_font_size'             => '18',
                'cvmn_page_countdown_font_color'            => '#000000',
                'cvmn_button_one_font_family'           => 'Roboto',
                'cvmn_button_one_font_family_variant'   => 'regular',
                'cvmn_button_one_text_transform'        => 'none',
                'cvmn_button_one_text_decoration'       => 'none',
                'cvmn_button_one_font_size'             => '18',
                'cvmn_button_one_font_color'            => '#000000',
                'cvmn_button_one_bg_color'              => '#ffffff',
                'cvmn_button_one_border_color'          => '#ffffff',
                'cvmn_button_one_hover_text_color'      => '#ffffff',
                'cvmn_button_one_hover_bg_color'      => '#ffffff'
            );
            return $default_values;
        }
    }

endif;