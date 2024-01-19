<?php
/**
 * Defines the core plugin class
 * 
 * Handles the internationalization, admin-specific hooks, and
 * public-facing site hooks.
 * 
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
if ( !class_exists( 'Maintenance_Notice' ) ):
    
    class Maintenance_Notice {
        /**
         * The unique identifier of this plugin.
         * @access   protected
         * 
         * @since 1.0.0
         */
        protected $plugin_name;

        /**
         * The current version of the plugin.
         * @access   protected
         * 
         * @since 1.0.0
         */
        protected $version;

        /**
         * Instance
         *
         * @access private
         * @static
         *
         * @var Maintenance_Notice The single instance of the class.
         * 
         * @since 1.0.0
         */
        private static $_instance = null;

        /**
         * Ensures only one instance of the class is loaded or can be loaded.
         *
         * @access public
         * @static
         *
         * @return Maintenance_Notice An instance of the class.
         * @since 1.0.0
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Set the plugin name and the plugin version that can be used throughout the plugin.
         * Load the dependencies, define the locale, and set the hooks for the admin area and
         * the public-facing side of the site.
         * 
         * @since 1.0.0
         */
        public function __construct() {
            if ( defined( 'MAINTENANCE_NOTICE_VERSION' ) ) {
                $this->version = MAINTENANCE_NOTICE_VERSION;
            } else {
                $this->version = '1.0.0';
            }

            $this->plugin_name = 'maintenance-notice';
            $maintenance_notice_options = get_option( 'maintenance_notice_options' );
            $cvmn_maintenance_page_display = isset( $maintenance_notice_options['cvmn_maintenance_page_display'] ) ? esc_html( $maintenance_notice_options['cvmn_maintenance_page_display'] ) : 'hide';
            if ( $maintenance_notice_options['cvmn_maintenance_page_display'] !== 'show' && ! isset( $_GET['cvmn-maintenance-preview'] ) ) {
                return;
            }

            if ( ! isset( $_GET['cvmn-maintenance-preview'] ) ) {
                $user = wp_get_current_user();
                $allowed_roles = array( 'editor', 'administrator', 'author' );
                if ( is_user_logged_in() && array_intersect( $allowed_roles, $user->roles ) ) {
                    return;
                }
            }
            add_action( 'template_include', array( $this, 'template_file' ), 9999999 );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
            $this->load_dependencies();
        }

        /**
         * Dequeue current theme assets manage plugin assets
         * 
         * @since 1.0.0
         * 
         */
        function dequeue_current_theme_assets() {
            global $wp_styles;
            global $wp_scripts;
    
            $wp_get_theme = wp_get_theme();
            
            $child_theme  = $wp_get_theme->get_stylesheet();
            $parent_theme = $wp_get_theme->get_template();
    
            foreach ( $wp_styles->registered as $key => $value ) {
                $src = $value->src;
                if ( strpos( $src, "themes/$child_theme/") !== false || strpos( $src, "themes/$parent_theme/" ) !== false ) {
                    unset( $wp_styles->registered[$key] );
                }
    
                if ( strpos( $src, "/uploads/$child_theme/" ) !== false || strpos( $src, "/uploads/$parent_theme/" ) !== false ) {
                    unset( $wp_styles->registered[$key] );
                }
            }
            
            foreach ( $wp_scripts->registered as $key => $value ) {
                $src = $value->src;
                if ( strpos( $src, "themes/$child_theme/") !== false || strpos( $src, "themes/$parent_theme/" ) !== false ) {
                    unset( $wp_scripts->registered[$key] );
                }
    
                if ( strpos( $src, "/uploads/$child_theme/" ) !== false || strpos( $src, "/uploads/$parent_theme/" ) !== false ) {
                    unset( $wp_scripts->registered[$key] );
                }
            }
        }

        /**
         *  Enqueue scripts and styles
         * @since 1.0.0
         */
        function enqueue_scripts() {
            $font_url = $this->frontend_fonts_url();
            wp_enqueue_style( 'cvmn-google-fonts', $font_url, array(), null );
            wp_enqueue_style( 'jquery-YTPlayer', 
                esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/library/jquery.mb.YTPlayer/jquery.mb.YTPlayer.min.css' ), 
                array(),
                MAINTENANCE_NOTICE_VERSION,
                'all'
            );
            
            wp_enqueue_style( 'slick-slider', 
                esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/library/slick/slick.css' ), 
                array(),
                '1.8.0',
                'all'
            );

            wp_enqueue_style( 'fontawesome', 
                esc_url( MAINTENANCE_NOTICE_URL . '/admin/assets/library/font-awesome/css/all.min.css' ), 
                array(),
                '5.10.2',
                'all'
            );

            wp_enqueue_style( 'crossfade', 
                esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/library/crossfadeimage/main.css' ), 
                array(),
                MAINTENANCE_NOTICE_VERSION,
                'all'
            );

            wp_enqueue_style( 'cvmn-frontpage-style', 
                esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/css/style.css' ), 
                array(),
                MAINTENANCE_NOTICE_VERSION,
                'all'
            );

            wp_enqueue_script( 'jquery-countdown',
                esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/library/Minimal-jQuery-Countdown/jquery.countdown.min.js' ),
                array(),
                '1.0.2',
                true
            );

            wp_enqueue_script( 'slick-slider',
                esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/library/slick/slick.js' ),
                array(),
                '1.8.0',
                true
            );

            wp_enqueue_script( 'cvmn-frontpage-script',
                esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/js/main.js' ),
                array( 'jquery' ),
                MAINTENANCE_NOTICE_VERSION,
                true
            );

            $maintenance_notice_options = get_option( 'maintenance_notice_options' );
            $bgVideo = 'false';

            if ( isset( $maintenance_notice_options["cvmn_maintenance_page_background_type"] ) ) {
                if ( $maintenance_notice_options["cvmn_maintenance_page_background_type"] === 'video-background' ) {
                    $bgVideo = 'true';
                    wp_enqueue_script( 'jquery-YTPlayer',
                        esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/library/jquery.mb.YTPlayer/jquery.mb.YTPlayer.min.js' ),
                        array(),
                        MAINTENANCE_NOTICE_VERSION,
                        true
                    );
                }
            }

            wp_localize_script( 'cvmn-frontpage-script', 'cvmnObject', array(
                'bgVideo'       => $bgVideo
            ));
        }

        /**
         * Styles html for front page
         * 
         */
        function load_styles() {
    ?>
            <link href="<?php echo esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/library/jquery.mb.YTPlayer/jquery.mb.YTPlayer.min.css' ); ?>" media="all" rel="stylesheet" type="text/css">
            <link href="<?php echo esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/library/slick/slick.css' ); ?>" media="all" rel="stylesheet" type="text/css">
            <link href="<?php echo esc_url( MAINTENANCE_NOTICE_URL . '/admin/assets/library/font-awesome/css/all.min.css' ); ?>" media="all" rel="stylesheet" type="text/css">
            <link href="<?php echo esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/library/Minimal-jQuery-Countdown/jquery.countdown.css' ); ?>" media="all" rel="stylesheet" type="text/css">
            <link id="cvmn-frontpage-style" rel="stylesheet" href="<?php echo esc_url( MAINTENANCE_NOTICE_INCLUDES_URL . '/assets/css/style.css' ); ?>"></link>
            <style id="cvmn-frontpage-inline-style">
                <?php
                    $maintenance_notice_dynamic_css = new Maintenance_Notice_Dynamic_Css();
                    echo $maintenance_notice_dynamic_css->generate_dynamic_css();
                ?>
            </style>
    <?php
        }

        /**
         * @since 1.0.0
         */
        function load_dependencies() {
            require_once plugin_dir_path( __FILE__ ) . '/dynamic-styles.php';
            require_once plugin_dir_path( __FILE__ ) . '/hooks/section-hooks.php';
        }

        /**
         * Function to attach the template file for displaying the maintenance page
         * 
         * 
         * @since 1.0.0
         */
        function template_file() {
            include MAINTENANCE_NOTICE_INCLUDES_PATH . '/index.php';
        }

        /**
         * Enqueue fonts.
         */
        function frontend_fonts_url() {
            $maintenance_notice_options = get_option( 'maintenance_notice_options' );
            $cvmn_page_title_font_family = $maintenance_notice_options['cvmn_page_title_font_family'];
            $cvmn_page_title_font_family_variant = $maintenance_notice_options['cvmn_page_title_font_family_variant'];
            $cvmn_page_title_typo = $cvmn_page_title_font_family.":".$cvmn_page_title_font_family_variant;

            $cvmn_page_heading_font_family = $maintenance_notice_options['cvmn_page_heading_font_family'];
            $cvmn_page_heading_font_family_variant = $maintenance_notice_options['cvmn_page_heading_font_family_variant'];
            $cvmn_page_heading_typo = $cvmn_page_heading_font_family.":".$cvmn_page_heading_font_family_variant;

            $cvmn_page_description_font_family = $maintenance_notice_options['cvmn_page_description_font_family'];
            $cvmn_page_description_font_family_variant = $maintenance_notice_options['cvmn_page_description_font_family_variant'];
            $cvmn_page_description_typo = $cvmn_page_description_font_family.":".$cvmn_page_description_font_family_variant;

            $cvmn_page_countdown_font_family = $maintenance_notice_options['cvmn_page_countdown_font_family'];
            $cvmn_page_countdown_font_family_variant = $maintenance_notice_options['cvmn_page_countdown_font_family_variant'];
            $cvmn_page_countdown_typo = $cvmn_page_countdown_font_family.":".$cvmn_page_countdown_font_family_variant;

            $cvmn_button_one_font_family = $maintenance_notice_options['cvmn_button_one_font_family'];
            $cvmn_button_one_font_family_variant = $maintenance_notice_options['cvmn_button_one_font_family_variant'];
            $cvmn_button_one_typo = $cvmn_button_one_font_family.":".$cvmn_button_one_font_family_variant;

            $fonts_url = '';

            $get_fonts = array( $cvmn_page_title_typo, $cvmn_page_heading_typo, $cvmn_page_description_typo, $cvmn_page_countdown_typo, $cvmn_button_one_typo );

            $font_weight_array = array();

            foreach ( $get_fonts as $fonts ) {
                $each_font = explode( ':', $fonts );
                if ( ! isset ( $font_weight_array[$each_font[0]] ) ) {
                    $font_weight_array[$each_font[0]][] = $each_font[1];
                } else {
                    if ( ! in_array( $each_font[1], $font_weight_array[$each_font[0]] ) ) {
                        $font_weight_array[$each_font[0]][] = $each_font[1];
                    }
                }
            }
    
            $final_font_array = array();
            
            foreach ( $font_weight_array as $font => $font_weight ) {
                $each_font_string = $font.':'.implode( ',', $font_weight );
                $final_font_array[] = $each_font_string;
            }

            $final_font_string = implode( '|', $final_font_array );

            $fonts_url = '';

            if ( $final_font_string ) {
                $query_args = array(
                    'family' => urlencode( $final_font_string ),
                    'subset' => urlencode( 'latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic,khmer,devanagari,arabic,hebrew,telugu' )
                );

                $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
            }
            return esc_url_raw( $fonts_url );
        }
    }

endif;