<?php
/**
 * Defines the admin core plugin class.
 * 
 * Handles the admin-specific hooks and functions.
 * 
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
if ( !class_exists( 'Maintenance_Notice_Admin' ) ) :

    class Maintenance_Notice_Admin {
        /**
         * Instance
         *
         * @access private
         * @static
         *
         * @var Maintenance_Notice_Admin The single instance of the class.
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
         * @return Maintenance_Notice_Admin An instance of the class.
         * 
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
         * Load the dependencies, define the locale, and set the hooks for the admin area of the site.
         * 
         * @since 1.0.0
         */
        public function __construct() {
            if ( !is_admin() ) {
                return;
            }

            add_action( 'admin_menu', array( $this, 'add_admin_menu_register' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
            add_action( 'wp_ajax_cvmn_get_font_variant', array( $this, 'get_font_variant' ) );
        }

        /**
         * load scripts.
         * 
         * @since 1.0.0
         */
        public function admin_enqueue_scripts( $hook_suffix ) {
            if ( $hook_suffix !== 'toplevel_page_maintenance-notice' && $hook_suffix !== 'maintenance-notice_page_maintenance-notice-content-settings' && $hook_suffix !== 'maintenance-notice_page_maintenance-notice-background-settings' && $hook_suffix !== 'maintenance-notice_page_maintenance-notice-typography-settings' && $hook_suffix !== 'maintenance-notice_page_maintenance-notice-countdown-settings' && $hook_suffix !== 'maintenance-notice_page_maintenance-notice-additional-settings' ) {
                return;
            }

            wp_enqueue_style( 'wp-color-picker' );

            wp_enqueue_style( 'font-awesome',
                plugins_url( 'assets/library/font-awesome/css/all.min.css', __FILE__ ),
                array(),
                '5.10.2',
                'all'
            );

            wp_enqueue_style( 'maintenance-notice-admin-style',
                plugins_url( 'css/admin.css', __FILE__ ),
                array(),
                MAINTENANCE_NOTICE_VERSION,
                'all'
            );
            
            wp_enqueue_style( 'maintenance-notice-admin-icons-style',
                plugins_url( 'assets/cvmn-icons/style.css', __FILE__ ),
                array(),
                MAINTENANCE_NOTICE_VERSION,
                'all'
            );

            wp_enqueue_media();

            wp_enqueue_script( 'maintenance-notice-admins-script',
                plugins_url( 'js/admin.js', __FILE__ ),
                array( 'jquery', 'wp-color-picker' ),
                MAINTENANCE_NOTICE_VERSION,
                true
            );

            wp_localize_script( 'maintenance-notice-admins-script', 'MaintenanceNoticeObject', array(
                'ajax_url'  => admin_url( 'admin-ajax.php' ),
                '_wpnonce' => wp_create_nonce( 'maintenance_notice_nonce' ),
                'importingString'   => esc_html__( 'Importing', 'maintenance-notice' ),
                'importedString'   => esc_html__( 'Imported', 'maintenance-notice' ),
            ));
        }

        /**
         * Add admin page for the maintenance-notice.
         * 
         * @since 1.0.0
         */
        public function add_admin_menu_register() {
            
            add_menu_page(  
                esc_html__( 'Maintenance Notice', 'maintenance-notice' ),
                esc_html__( 'Maintenance Notice', 'maintenance-notice' ),
                'manage_options',
                'maintenance-notice',
                array( $this, 'admin_menu_callback' ),
                'dashicons-admin-tools',
                20
            );

            add_submenu_page(
                'maintenance-notice',
                esc_html__( 'Dashboard', 'maintenance-notice' ),
                esc_html__( 'Dashboard', 'maintenance-notice' ),
                'manage_options',
                'maintenance-notice',
                array( $this, 'admin_menu_callback' ),
                20
            );

            add_submenu_page(
                'maintenance-notice',
                esc_html__( 'Content Settings', 'maintenance-notice' ),
                esc_html__( 'Content Settings', 'maintenance-notice' ),
                'manage_options',
                'maintenance-notice-content-settings',
                array( $this, 'admin_menu_content_settings_callback' ),
                10
            );

            add_submenu_page(
                'maintenance-notice',
                esc_html__( 'Countdown Settings', 'maintenance-notice' ),
                esc_html__( 'Countdown Settings', 'maintenance-notice' ),
                'manage_options',
                'maintenance-notice-countdown-settings',
                array( $this, 'admin_menu_countdown_settings_callback' ),
                10
            );

            add_submenu_page(
                'maintenance-notice',
                esc_html__( 'Background Settings', 'maintenance-notice' ),
                esc_html__( 'Background Settings', 'maintenance-notice' ),
                'manage_options',
                'maintenance-notice-background-settings',
                array( $this, 'admin_menu_background_settings_callback' ),
                10
            );

            add_submenu_page(
                'maintenance-notice',
                esc_html__( 'Typography Settings', 'maintenance-notice' ),
                esc_html__( 'Typography Settings', 'maintenance-notice' ),
                'manage_options',
                'maintenance-notice-typography-settings',
                array( $this, 'admin_menu_typography_settings_callback' ),
                10
            );

            add_submenu_page(
                'maintenance-notice',
                esc_html__( 'Additional Settings', 'maintenance-notice' ),
                esc_html__( 'Additional Settings', 'maintenance-notice' ),
                'manage_options',
                'maintenance-notice-additional-settings',
                array( $this, 'admin_menu_additional_settings_callback' ),
                10
            );
        }

        /**
         * Callback function for maintenance-notice admin page.
         * 
         * @since 1.0.0
         */
        public function admin_menu_callback() {
        ?>
            <div id="maintenance-notice-admin" class="cvmn-admin-block-wrapper">
                <header id="cvmn-main-header" class="cvmn-tab-block-wrapper">
                    <div class="admin-main-menu nav-tab-wrapper cvmn-nav-tab-wrapper">
                        <ul>
                        <?php
                            $header_titles = array(
                                "dashboard" => array(
                                    "desc" => "Get started!!",
                                    "icon" => "cvicon-item cvicon-dashboard"
                                ),
                                "help"      => array(
                                    "desc" => "Have an issue?",
                                    "icon" => "cvicon-item cvicon-support"
                                ),
                                "review"    => array(
                                    "desc" => "Review our product",
                                    "icon" => "cvicon-item cvicon-review"
                                )
                            );
                            foreach( $header_titles as $header_title => $header_title_val ) {
                        ?>
                                <li class="nav-tab cvmn-nav-tab <?php echo esc_html( 'cvmn-'.$header_title ); if ( $header_title == 'dashboard' ) { echo esc_html( ' isActive' ); } ?>">
                                    <a href="javascript:void(0)" data-tabId="<?php echo '#cvmn-'.$header_title; ?>"><?php echo str_replace( '-', ' ', $header_title ); ?>
                                        <span class="cvmn-nav-sub-title"><?php echo esc_html( $header_title_val['desc'] ); ?></span>
                                        <i class="<?php echo esc_html( $header_title_val['icon'] ); ?>"></i>
                                    </a>
                                </li>
                        <?php
                            }
                        ?>
                        </ul>
                    </div>
                </header>
                <div id="cvmn-main-content" class="cvmn-content-block-wrapper">
                    <?php
                        foreach( $header_titles as $header_title => $header_title_desc ) {
                            include( plugin_dir_path( __FILE__ ) .'partials/content-'.$header_title.'.php' );
                        }
                    ?>
                </div><!-- #cvmn-main-content -->
                <?php
                    // Footer Section
                    $this->admin_menu_footer_section();
                ?>
            </div><!-- #maintenance-notice-admin -->
        <?php
        }

        /**
         * Callback function for maintenance-notice content settings submenu page.
         * 
         * @since 1.0.0
         * 
         */
        function admin_menu_content_settings_callback() {
        ?>
            <div id="maintenance-notice-admin-content-settings" class="cvmn-admin-block-wrapper">
                <h2 class="cvmn-admin-title"><?php esc_html_e( 'Content Settings', 'maintenance-notice' ); ?></h2>
                <?php
                    include( plugin_dir_path( __FILE__ ) .'partials/content-settings.php' );
                    // Footer Section
                    $this->admin_menu_footer_section();
                ?>
            </div><!-- #maintenance-notice-admin-content-settings -->
        <?php
        }

        /**
         * Callback function for maintenance-notice countdown settings submenu page.
         * 
         * @since 1.0.0
         * 
         */
        function admin_menu_countdown_settings_callback() {
        ?>
            <div id="maintenance-notice-admin-countdown-settings" class="cvmn-admin-block-wrapper">
                <h2 class="cvmn-admin-title"><?php esc_html_e( 'Countdown  Settings', 'maintenance-notice' ); ?></h2>
                <?php
                    include( plugin_dir_path( __FILE__ ) .'partials/countdown-settings.php' );
                    // Footer Section
                    $this->admin_menu_footer_section();
                ?>
            </div><!-- #maintenance-notice-admin-countdown-settings -->
        <?php
        }
        
        /**
         * Callback function for maintenance-notice background settings submenu page.
         * 
         * @since 1.0.0
         * 
         */
        function admin_menu_background_settings_callback() {
        ?>
            <div id="maintenance-notice-admin-background-settings" class="cvmn-admin-block-wrapper">
                <h2 class="cvmn-admin-title"><?php esc_html_e( 'Background Settings', 'maintenance-notice' ); ?></h2>
                <?php
                    include( plugin_dir_path( __FILE__ ) .'partials/background-settings.php' );
                    // Footer Section
                    $this->admin_menu_footer_section();
                ?>
            </div><!-- #maintenance-notice-admin-background-settings -->
        <?php
        }

        /**
         * Callback function for maintenance-notice typography settings submenu page.
         * 
         * @since 1.0.0
         * 
         */
        function admin_menu_typography_settings_callback() {
        ?>
            <div id="maintenance-notice-admin-typography-settings" class="cvmn-admin-block-wrapper">
                <h2 class="cvmn-admin-title"><?php esc_html_e( 'Typography Settings', 'maintenance-notice' ); ?></h2>
                <?php
                    include( plugin_dir_path( __FILE__ ) .'partials/typography-settings.php' );
                    // Footer Section
                    $this->admin_menu_footer_section();
                ?>
            </div><!-- #maintenance-notice-admin-typography-settings -->
        <?php
        }

        /**
         * Callback function for maintenance-notice additional settings submenu page.
         * 
         * @since 1.0.0
         * 
         */
        function admin_menu_additional_settings_callback() {
        ?>
            <div id="maintenance-notice-admin-additional-settings" class="cvmn-admin-block-wrapper">
                <h2 class="cvmn-admin-title"><?php esc_html_e( 'Additional Settings', 'maintenance-notice' ); ?></h2>
                <?php 
                    include( plugin_dir_path( __FILE__ ) .'partials/additional-settings.php' );
                    // Footer Section
                    $this->admin_menu_footer_section();
                ?>
            </div><!-- #maintenance-notice-admin-additional-settings -->
        <?php
        }

        /**
         * Callback function for maintenance-notice footer section submenu page.
         * 
         * @since 1.0.0
         * 
         */
        function admin_menu_footer_section() {
            ?>
                <footer id="cvmn-main-footer" class="cvmn-promo-sidebar">
                    <h2><?php esc_html_e( 'WordPress Tutorial & Guides', 'maintenance-notice' ); ?></h2>
                    <ul>
                        <li><a href="https://wpallresources.com/" target="_blank" title="WP All Resources"> <?php echo '<img src="'.esc_url( plugins_url( 'maintenance-notice/includes/assets/images/wpallresources-img.png', dirname(__DIR__) ) ).'">'; ?></a></li>
                    </ul>
                    <h2><?php esc_html_e( 'Other Recommended Plugins', 'maintenance-notice' ); ?></h2>
                    <ul>
                        <li><a href="https://wordpress.org/plugins/wp-blog-post-layouts/" target="_blank" title="WP Blog Post Layouts"><?php echo '<img src="'.esc_url( plugins_url( 'maintenance-notice/includes/assets/images/blog-post-layouts-img.png', dirname(__DIR__) ) ).'">'; ?> </a></li>
                        <li><a href="https://codevibrant.com/wp-plugin/wp-magazine-modules-for-gutenberg-elementor/" target="_blank" title="WP Magazine Modules Lite"><?php echo '<img src="'.esc_url( plugins_url( 'maintenance-notice/includes/assets/images/wp-magazine-module-img.png', dirname(__DIR__) ) ).'">'; ?></a></li>
                    </ul>

                </footer>
            <?php
            }
        
        /**
         * Get google variants from given font family parameter
         * 
         * @since 1.0.0
         */
        function get_font_variant() {
            if ( !wp_verify_nonce( $_POST['_wpnonce'], "maintenance_notice_nonce")) {
                wp_die( "No kiddies!!");
            }

            $font_family = isset( $_POST['font_family'] ) ? sanitize_text_field( $_POST['font_family'] ) : 'Roboto';
            // Get google fonts json
            $cvmn_google_fonts_file = apply_filters( 'maintenance_notice_google_fonts_json_file', MAINTENANCE_NOTICE_PATH . '/admin/assets/google-fonts.json' );
            if ( ! file_exists( MAINTENANCE_NOTICE_PATH . '/admin/assets/google-fonts.json' ) ) {
                $google_fonts = array();
            }
            global $wp_filesystem;
            WP_Filesystem();
            $get_file_content   = $wp_filesystem->get_contents( $cvmn_google_fonts_file );
            $google_fonts   = json_decode( $get_file_content, 1 );
            $variant_array = [];
            foreach( $google_fonts as $key => $values ) {
                foreach( $values as $valueskey => $value ) {
                    if ( $font_family === $valueskey ) {
                        $variant_array = $value['variants'];
                    }
                }
            }
            $variant_option_array = '';
            foreach( $variant_array as $key => $variant ) {
                $variant_selected = ( $key === 0 ) ? 'selected' : '';
                $variant_option_array .= '<option value="' .esc_attr( $variant ). '" ' .esc_html( $variant_selected ). '>' .esc_attr( $variant ). '</option>';
            }
            //return $variant_option_array;
            echo $variant_option_array;
            die();
        }

        /**
         * Default Options
         * 
         * @since 1.0.0
         */
        function default_values() {
            $default_values = array(
                'cvmn_maintenance_page_display'         => esc_html( 'hide' ),
                'cvmn_maintenance_page_background_type' => esc_html( 'none' ),
                'cvmn_page_title'                       => get_bloginfo( 'name' ),
                'cvmn_page_heading'                     => esc_html__( 'Site Maintenance is on', 'maintenance-notice' ),
                'cvmn_page_description'                 => esc_html__( 'We will be available soon. Thank you for your patience!', 'maintenance-notice' ),
                'cvmn_logo'                             => '',
                'cvmn_background_image'                 => '',
                'cvmn_background_video_url'             => '',
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
                'cvmn_button_one_hover_bg_color'        => '#ffffff'
            );
            return $default_values;
        }

        /**
         * Define font awesome social icons
         *
         * @return array;
         * @since 1.0.0
         */
        function font_awesome_social_icon_array() {
    
            $social_icon_array = array( "fab fa-tumblr-square","fab fa-tumblr","fab fa-facebook-square","fab fa-facebook-messenger","fab fa-facebook-f","fab fa-facebook","fab fa-linkedin-in","fab fa-linkedin","fab fa-instagram","fab fa-pinterest-square","fab fa-pinterest-p","fab fa-pinterest","fab fa-whatsapp-square","fab fa-whatsapp","fab fa-twitter-square","fab fa-twitter","fab fa-flickr","fab fa-snapchat-square","fab fa-snapchat-ghost","fab fa-snapchat","fab fa-viber","fab fa-digg","fab fa-yelp","fab fa-scribd","fab fa-stumbleupon-circle","fab fa-stumbleupon","fab fa-reddit-square","fab fa-reddit-alien","fab fa-reddit","fab fa-vine","fab fa-vk","fab fa-xing-square","fab fa-xing", "fab fa-youtube-square","fab fa-youtube","fab fa-mix","fab fa-quora","fab fa-meetup","fab fa-twitch","fab fa-skype","fab fa-soundcloud","fab fa-qq","fab fa-line","fab fa-telegram-plane","fab fa-telegram","fab fa-foursquare","fab fa-ravelry","fab fa-deviantart" );
            return $social_icon_array;
        }
    }

    Maintenance_Notice_Admin::instance();

endif;