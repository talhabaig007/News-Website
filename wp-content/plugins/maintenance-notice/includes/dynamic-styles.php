<?php
/**
 * Plugin dynamic css.
 * 
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
if ( !class_exists( 'Maintenance_Notice_Dynamic_Css' ) ) :
    class Maintenance_Notice_Dynamic_Css {
        /**
         * Instance
         *
         * @access private
         * @static
         *
         * @var Maintenance_Notice_Dynamic_Css The single instance of the class.
         */
        private static $_instance = null;

        /**
         * Ensures only one instance of the class is loaded or can be loaded.
         *
         * @access public
         * @static
         *
         * @return Maintenance_Notice_Dynamic_Css An instance of the class.
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * run class
         * 
         */
        public function __construct() {
            add_action( "wp_enqueue_scripts", array( $this, 'generate_dynamic_css' ), 99 );
        }

        /**
         * Store dynamic css to upload directory
         * 
         */
        public function generate_dynamic_css() {
            $maintenance_notice_options = get_option( 'maintenance_notice_options' );
            $cvmn_background_image = isset( $maintenance_notice_options['cvmn_background_image'] ) ? esc_html( $maintenance_notice_options['cvmn_background_image'] ) : '';
            $cvmn_background_color = isset( $maintenance_notice_options['cvmn_background_color'] ) ? esc_html( $maintenance_notice_options['cvmn_background_color'] ) : '';
          
            // overlay variable
            $cvmn_background_overlay_type = isset( $maintenance_notice_options['cvmn_background_overlay_type'] ) ? esc_html( $maintenance_notice_options['cvmn_background_overlay_type'] ) : 'none';
            $cvmn_background_overlay_opacity = isset( $maintenance_notice_options['cvmn_background_overlay_opacity'] ) ? esc_attr( $maintenance_notice_options['cvmn_background_overlay_opacity'] ) : '0.5';

            $cvmn_page_typography_inherit = isset( $maintenance_notice_options['cvmn_page_typography_inherit'] ) ? esc_html( $maintenance_notice_options['cvmn_page_typography_inherit'] ) : 'show';
            $cvmn_page_title_font_family = isset( $maintenance_notice_options['cvmn_page_title_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_page_title_font_family'] ) : esc_html( 'Roboto' );
            $cvmn_page_title_font_family_variant = isset( $maintenance_notice_options['cvmn_page_title_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_page_title_font_family_variant'] ) : '';
            $cvmn_page_title_text_transform = isset( $maintenance_notice_options['cvmn_page_title_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_page_title_text_transform'] ) : 'none';
            $cvmn_page_title_text_decoration = isset( $maintenance_notice_options['cvmn_page_title_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_page_title_text_decoration'] ) : 'none';
            $cvmn_page_title_font_size = isset( $maintenance_notice_options['cvmn_page_title_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_page_title_font_size'] ) : '14';
            $cvmn_page_title_font_color = isset( $maintenance_notice_options['cvmn_page_title_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_page_title_font_color'] ) : '#000000';

            $cvmn_page_heading_font_family = isset( $maintenance_notice_options['cvmn_page_heading_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_page_heading_font_family'] ) : esc_html( 'Roboto' );
            $cvmn_page_heading_font_family_variant = isset( $maintenance_notice_options['cvmn_page_heading_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_page_heading_font_family_variant'] ) : '';
            $cvmn_page_heading_text_transform = isset( $maintenance_notice_options['cvmn_page_heading_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_page_heading_text_transform'] ) : 'none';
            $cvmn_page_heading_text_decoration = isset( $maintenance_notice_options['cvmn_page_heading_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_page_heading_text_decoration'] ) : 'none';
            $cvmn_page_heading_font_size = isset( $maintenance_notice_options['cvmn_page_heading_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_page_heading_font_size'] ) : '20';
            $cvmn_page_heading_font_color = isset( $maintenance_notice_options['cvmn_page_heading_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_page_heading_font_color'] ) : '#000000';

            $cvmn_page_description_font_family = isset( $maintenance_notice_options['cvmn_page_description_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_page_description_font_family'] ) : esc_html( 'Roboto' );
            $cvmn_page_description_font_family_variant = isset( $maintenance_notice_options['cvmn_page_description_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_page_description_font_family_variant'] ) : '';
            $cvmn_page_description_text_transform = isset( $maintenance_notice_options['cvmn_page_description_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_page_description_text_transform'] ) : 'none';
            $cvmn_page_description_text_decoration = isset( $maintenance_notice_options['cvmn_page_description_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_page_description_text_decoration'] ) : 'none';
            $cvmn_page_description_font_size = isset( $maintenance_notice_options['cvmn_page_description_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_page_description_font_size'] ) : '14';
            $cvmn_page_description_font_color = isset( $maintenance_notice_options['cvmn_page_description_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_page_description_font_color'] ) : '#000000';

            $cvmn_page_countdown_font_family = isset( $maintenance_notice_options['cvmn_page_countdown_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_page_countdown_font_family'] ) : esc_html( 'Roboto' );
            $cvmn_page_countdown_font_family_variant = isset( $maintenance_notice_options['cvmn_page_countdown_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_page_countdown_font_family_variant'] ) : '';
            $cvmn_page_countdown_text_transform = isset( $maintenance_notice_options['cvmn_page_countdown_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_page_countdown_text_transform'] ) : 'none';
            $cvmn_page_countdown_text_decoration = isset( $maintenance_notice_options['cvmn_page_countdown_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_page_countdown_text_decoration'] ) : 'none';
            $cvmn_page_countdown_font_size = isset( $maintenance_notice_options['cvmn_page_countdown_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_page_countdown_font_size'] ) : '14';
            $cvmn_page_countdown_font_color = isset( $maintenance_notice_options['cvmn_page_countdown_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_page_countdown_font_color'] ) : '#000000';

            $cvmn_button_one_font_family = isset( $maintenance_notice_options['cvmn_button_one_font_family'] ) ? esc_html( $maintenance_notice_options['cvmn_button_one_font_family'] ) : esc_html( 'Roboto' );
            $cvmn_button_one_font_family_variant = isset( $maintenance_notice_options['cvmn_button_one_font_family_variant'] ) ? esc_html( $maintenance_notice_options['cvmn_button_one_font_family_variant'] ) : '';
            $cvmn_button_one_text_transform = isset( $maintenance_notice_options['cvmn_button_one_text_transform'] ) ? esc_html( $maintenance_notice_options['cvmn_button_one_text_transform'] ) : 'none';
            $cvmn_button_one_text_decoration = isset( $maintenance_notice_options['cvmn_button_one_text_decoration'] ) ? esc_html( $maintenance_notice_options['cvmn_button_one_text_decoration'] ) : 'none';
            $cvmn_button_one_font_size = isset( $maintenance_notice_options['cvmn_button_one_font_size'] ) ? esc_attr( $maintenance_notice_options['cvmn_button_one_font_size'] ) : '14';
            $cvmn_button_one_font_color = isset( $maintenance_notice_options['cvmn_button_one_font_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_font_color'] ) : '#000000';
            $cvmn_button_one_bg_color = isset( $maintenance_notice_options['cvmn_button_one_bg_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_bg_color'] ) : '#ffffff';
            $cvmn_button_one_border_color = isset( $maintenance_notice_options['cvmn_button_one_border_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_border_color'] ) : '#ffffff';
            $cvmn_button_one_hover_text_color = isset( $maintenance_notice_options['cvmn_button_one_hover_text_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_hover_text_color'] ) : '#ffffff';
            $cvmn_button_one_hover_bg_color = isset( $maintenance_notice_options['cvmn_button_one_hover_bg_color'] ) ? sanitize_hex_color( $maintenance_notice_options['cvmn_button_one_hover_bg_color'] ) : '#ffffff';

            $output_css = '';

            if ( ! empty( $cvmn_background_image ) ) {
                $output_css .= ".background--static-image { background: url(" .esc_url( $cvmn_background_image ). ") }\n";
            }

            $output_css .= ".background--plain-color { background: " . esc_attr( $cvmn_background_color ). " }\n";

            // Background Opacity   
            $output_css .= ".background-overlay--type-one:before, .background-overlay--type-two:before, .background-overlay--type-three:before,
            .background-overlay--type-four:before{ opacity: ". esc_attr( $cvmn_background_overlay_opacity ). "; }\n";
            
            // write dynamic css here
            if ( $cvmn_page_typography_inherit === 'hide' ) {
                // Countdown Content CSS
                $output_css .= ".cvmn-countdown-content li{ color: ". esc_attr( $cvmn_page_countdown_font_color ). " }\n";
                $output_css .= ".cvmn-countdown-content li{ font-family: ". esc_attr( $cvmn_page_countdown_font_family ). "; }\n";
                $output_css .= ".cvmn-countdown-content li{ font-weight: ". esc_attr( $cvmn_page_countdown_font_family_variant ). "; }\n";
                $output_css .= ".cvmn-countdown-content li{ text-transform: ". esc_attr( $cvmn_page_countdown_text_transform ). "; }\n";
                $output_css .= ".cvmn-countdown-content li{ text-decoration: ". esc_attr( $cvmn_page_countdown_text_decoration ). "; }\n";
                $output_css .= ".cvmn-countdown-content li span{ font-size: ". esc_attr( $cvmn_page_countdown_font_size )."px; }\n";

                // Page Title
                $output_css .= ".maintenance-mode-active .page-header .page-title{ font-family: ". esc_attr( $cvmn_page_title_font_family ). "; }\n";
                $output_css .= ".maintenance-mode-active .page-header .page-title{ font-weight: ". esc_attr( $cvmn_page_title_font_family_variant ). "; }\n";
                $output_css .= ".maintenance-mode-active .page-header .page-title{ text-transform: ". esc_attr( $cvmn_page_title_text_transform ). " }\n";
                $output_css .= ".maintenance-mode-active .page-header .page-title{ text-decoration: ". esc_attr( $cvmn_page_title_text_decoration ). " }\n";
                $output_css .= ".maintenance-mode-active .page-header .page-title{ font-size: ". esc_attr( $cvmn_page_title_font_size )."px; }\n";
                $output_css .= ".maintenance-mode-active .page-header .page-title{ color: ". esc_attr( $cvmn_page_title_font_color )." }\n";

                // Page Heading
                $output_css .= ".maintenance-mode-active .page-heading{ font-family: ". esc_attr( $cvmn_page_heading_font_family ). " }\n";
                $output_css .= ".maintenance-mode-active .page-heading{ font-weight: ". esc_attr( $cvmn_page_heading_font_family_variant ). "; }\n";
                $output_css .= ".maintenance-mode-active .page-heading{ text-transform: ". esc_attr( $cvmn_page_heading_text_transform ). " }\n";
                $output_css .= ".maintenance-mode-active .page-heading{ text-decoration: ". esc_attr( $cvmn_page_heading_text_decoration ). " }\n";
                $output_css .= ".maintenance-mode-active .page-heading{ font-size: ". esc_attr( $cvmn_page_heading_font_size )."px; }\n";
                $output_css .= ".maintenance-mode-active .page-heading{ color: ". esc_attr( $cvmn_page_heading_font_color )." }\n";

                // Page Description
                $output_css .= ".maintenance-mode-active .page-description{ font-family: ". esc_attr( $cvmn_page_description_font_family ). "; }\n";
                $output_css .= ".maintenance-mode-active .page-description{ font-weight: ". esc_attr( $cvmn_page_description_font_family_variant ). " }";
                $output_css .= ".maintenance-mode-active .page-description{ text-transform: ". esc_attr( $cvmn_page_description_text_transform ). " }";
                $output_css .= ".maintenance-mode-active .page-description{ text-decoration: ". esc_attr( $cvmn_page_description_text_decoration ). " }";
                $output_css .= ".maintenance-mode-active .page-description{ font-size: ". esc_attr( $cvmn_page_description_font_size )."px }";
                $output_css .= ".maintenance-mode-active .page-description{ color: ". esc_attr( $cvmn_page_description_font_color )." }";

                // Button One
                $output_css .= ".cvmn-button-one a{ font-family: ". esc_attr( $cvmn_button_one_font_family ). " }";
                $output_css .= ".cvmn-button-one a{ font-weight: ". esc_attr( $cvmn_button_one_font_family_variant ). " }";
                $output_css .= ".cvmn-button-one a{ text-transform: ". esc_attr( $cvmn_button_one_text_transform ). " }";
                $output_css .= ".cvmn-button-one a{ text-decoration: ". esc_attr( $cvmn_button_one_text_decoration ). " }";
                $output_css .= ".cvmn-button-one a{ font-size: ". esc_attr( $cvmn_button_one_font_size )."px }";
                $output_css .= ".cvmn-button-one a{ color: ". esc_attr( $cvmn_button_one_font_color )." }";
                $output_css .= ".cvmn-button-one a{ background: ". esc_attr( $cvmn_button_one_bg_color )." }";
                $output_css .= ".cvmn-button-one a{ border-color: ". esc_attr( $cvmn_button_one_border_color )." }";
                $output_css .= ".cvmn-button-one a:hover{ background: ". esc_attr( $cvmn_button_one_hover_bg_color )." }";
                $output_css .= ".cvmn-button-one a:hover{ color: ". esc_attr( $cvmn_button_one_hover_text_color )." }";

            } // Ends typography inherit check

            $refine_output_css = $this->cvmn_css_strip_whitespace( $output_css );

            wp_add_inline_style( 'cvmn-frontpage-style', $refine_output_css );
        }

        /**
         * Get minified css and removed space
         *
         * @since 1.0.0
         */
        public function cvmn_css_strip_whitespace( $css ) {
            $replace = array(
                "#/\*.*?\*/#s" => "",  // Strip C style comments.
                "#\s\s+#"      => " ", // Strip excess whitespace.
            );
            $search = array_keys( $replace );
            $css = preg_replace( $search, $replace, $css );

            $replace = array(
                ": "  => ":",
                "; "  => ";",
                " {"  => "{",
                " }"  => "}",
                ", "  => ",",
                "{ "  => "{",
                ";}"  => "}", // Strip optional semicolons.
                ",\n" => ",", // Don't wrap multiple selectors.
                "\n}" => "}", // Don't wrap closing braces.
                "} "  => "}\n", // Put each rule on it's own line.
            );
            $search = array_keys( $replace );
            $css = str_replace( $search, $replace, $css );

            return trim( $css );
        }
    }
    new Maintenance_Notice_Dynamic_Css();
endif;