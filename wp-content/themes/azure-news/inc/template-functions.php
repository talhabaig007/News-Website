<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Azure News
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function azure_news_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'left-sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	$azure_news_site_container_layout = azure_news_get_customizer_option_value( 'azure_news_site_container_layout' );
	if ( ! empty( $azure_news_site_container_layout ) ) {
		$classes[] = 'azure-news-site-layout--'.$azure_news_site_container_layout;
	}

	$azure_news_header_main_area_layout = azure_news_get_customizer_option_value( 'azure_news_header_main_area_layout' );
	$classes[] = esc_attr( $azure_news_header_main_area_layout );

    if ( isset( $_COOKIE["azure-news-site-mode-cookie"] ) ) {
        $classes[] = $_COOKIE["azure-news-site-mode-cookie"];
    } else {
    	$classes[] = azure_news_get_customizer_option_value( 'azure_news_site_mode' );
    }

	// archive page style
	if ( !is_page() || !is_singular() || !is_single() ) {
		$azure_news_archive_page_style = azure_news_get_customizer_option_value( 'azure_news_archive_page_style' );
		$classes[] = esc_attr( $azure_news_archive_page_style );
	}

	$global_archive_sidebar = azure_news_get_customizer_option_value( 'azure_news_archive_sidebar_layout' );
	$global_posts_sidebar   = azure_news_get_customizer_option_value( 'azure_news_posts_sidebar_layout' );
	$global_pages_sidebar   = azure_news_get_customizer_option_value( 'azure_news_pages_sidebar_layout' );

	if ( is_page() ) {
	    $classes[] = esc_attr( $global_pages_sidebar );
	} elseif ( is_single() || is_singular() ) {
	    $classes[] = esc_attr( $global_posts_sidebar );
	    $azure_news_single_posts_layout = azure_news_get_customizer_option_value( 'azure_news_single_posts_layout' );
	    $classes[] = 'single-'.esc_attr( $azure_news_single_posts_layout );
	} elseif ( is_archive() || is_search() ) {
	    $classes[] = esc_attr( $global_archive_sidebar );
	} elseif ( is_home() || is_front_page() ) {
		$classes[] = esc_attr( $global_archive_sidebar );
	}

	return $classes;
}
add_filter( 'body_class', 'azure_news_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function azure_news_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'azure_news_pingback_header' );

/*---------------------------- Enqueue style and scripts -------------------------------------------------------------*/

	if ( ! function_exists( 'azure_news_admin_scripts' ) ) :

		/**
		 * Enqueue admin scripts and styles.
		 */
		function azure_news_admin_scripts( $hook ) {

		    // Only needed on these admin screens
		    if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' && 'widgets.php' != $hook ) {
		        return;
		    }

		    wp_enqueue_style( 'azure-news-widget-style', get_template_directory_uri() . '/inc/widgets/assets/css/widget-admin-style.css', array(), AZURE_NEWS_VERSION );

		    wp_enqueue_script( 'azure-news-widget-script', get_template_directory_uri() . '/inc/widgets/assets/js/widget-admin-script.js', array( 'jquery' ), AZURE_NEWS_VERSION, true );
		}

	endif;

	add_action( 'admin_enqueue_scripts', 'azure_news_admin_scripts' );

	if ( ! function_exists( 'azure_news_scripts' ) ) :

		/**
		 * Enqueue scripts and styles.
		 */
		function azure_news_scripts() {

			wp_enqueue_style( 'azure-news-fonts', azure_news_google_font_callback(), array(), null );

			wp_enqueue_style( 'lightslider', get_template_directory_uri() . '/assets/library/lightslider/css/lightslider.min.css', array(), AZURE_NEWS_VERSION );


			wp_enqueue_style( 'box-icons', get_template_directory_uri() . '/assets/library/box-icons/css/boxicons.min.css', null, '2.1.4' );

			wp_enqueue_style( 'azure-news-style', get_stylesheet_uri(), array(), AZURE_NEWS_VERSION );

			wp_enqueue_style( 'azure-news-responsive-style', get_template_directory_uri() . '/assets/css/azure-news-responsive.css', array(), AZURE_NEWS_VERSION );

			$azure_news_preloader_enable = azure_news_get_customizer_option_value( 'azure_news_preloader_enable' );

			if ( false !== $azure_news_preloader_enable ) {
				wp_enqueue_style( 'azure-news-preloader', get_template_directory_uri(). '/assets/css/azure-news-preloader.css', array(), AZURE_NEWS_VERSION );
			}

			wp_enqueue_script( 'jquery-ui-tabs' );

			wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/assets/library/jquery-cookie/jquery.cookie.js', array(), AZURE_NEWS_VERSION, true );

			wp_enqueue_script( 'lightslider', get_template_directory_uri() . '/assets/library/lightslider/js/lightslider.min.js', array(), AZURE_NEWS_VERSION, true );

			wp_enqueue_script( 'jquery-marquee', get_template_directory_uri() . '/assets/library/js-marquee/jquery.marquee.js', array(), AZURE_NEWS_VERSION, true );

			wp_enqueue_script( 'jquery-header-sticky', get_template_directory_uri() . '/assets/library/sticky/jquery.sticky.min.js', array(), AZURE_NEWS_VERSION, true );

			wp_enqueue_script( 'jquery-sticky-sidebar', get_template_directory_uri() . '/assets/library/sticky-sidebar/theia-sticky-sidebar.min.js', array(), AZURE_NEWS_VERSION, true );

			wp_enqueue_script( 'azure-news-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), AZURE_NEWS_VERSION, true );

			wp_enqueue_script( 'azure-news-main-scripts', get_template_directory_uri() . '/assets/js/main-scripts.js', array( 'jquery' ), AZURE_NEWS_VERSION, true );

			wp_enqueue_script( 'azure-news-keyboard-accessibility', get_template_directory_uri() . '/assets/js/keyboard-accessibility.js', array( 'jquery' ), AZURE_NEWS_VERSION, true );

			$azure_news_header_sticky_enable 	= azure_news_get_customizer_option_value( 'azure_news_header_sticky_enable' );
			$azure_news_sidebar_sticky_enable 	= azure_news_get_customizer_option_value( 'azure_news_sidebar_sticky_enable' );
			$header_sticky = $azure_news_header_sticky_enable ? 'true' : 'false';
			$sidebar_sticky = $azure_news_sidebar_sticky_enable ? 'true' : 'false';

			wp_localize_script( 'azure-news-main-scripts', 'OG_JSObject',
				array(
		            'sidebar_sticky'    => $sidebar_sticky,
		            'header_sticky'     => $header_sticky
		        )
		    );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

	endif;

	add_action( 'wp_enqueue_scripts', 'azure_news_scripts' );


if ( ! function_exists( 'azure_news_social_icons_array' ) ) :

    /**
     * List of box icons
     *
     * @return array();
     * @since 1.0.0
     */
    function azure_news_social_icons_array() {
        return array(
            "bx bxl-facebook", "bx bxl-facebook-circle", "bx bxl-facebook-square", "bx bxl-twitter", "bx bxl-google", "bx bxl-google-plus", "bx bxl-google-plus-circle", "bx bxl-google-cloud", "bx bxl-instagram", "bx bxl-instagram-alt", "bx bxl-skype", "bx bxl-whatsapp", "bx bxl-whatsapp-square", "bx bxl-tiktok", "bx bxl-airbnb", "bx bxl-deviantart", "bx bxl-linkedin", "bx bxl-linkedin-square", "bx bxl-pinterest", "bx bxl-pinterest-alt", "bx bxl-adobe", "bx bxl-flickr", "bx bxl-flickr-square", "bx bxl-tumblr", "bx bxl-slack", "bx bxl-reddit", "bx bxl-messenger", "bx bxl-wordpress", "bx bxl-behance", "bx bxl-dribbble", "bx bxl-yahoo", "bx bxl-blogger", "bx bxl-snapchat", "bx bxl-wix", "bx bxl-meta", "bx bxl-baidu", "bx bxl-discord", "bx bxl-twitch", "bx bxl-discord-alt", "bx bxl-vk", "bx bxl-trip-advisor", "bx bxl-telegram", "bx bxl-quora", "bx bxl-ok-ru", "bx bxl-microsoft-teams", "bx bxl-foursquare", "bx bxl-soundcloud", "bx bxl-vimeo", "bx bxl-digg", "bx bxl-periscope", "bx bxl-xing", "bx bxl-youtube", "bx bxl-imdb",
        );
    }

endif;

if ( ! function_exists( 'azure_news_get_date_format_args' ) ) :

	/**
	 * Generate date format array for query arguments
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function azure_news_get_date_format_args( $format ) {

		switch( $format ) {

			case 'today':
				$today_date = getdate();
				$get_args 	= array(
					'year'  => $today_date['year'],
					'month' => $today_date['mon'],
					'day'   => $today_date['mday'],
				);

				return $get_args ;
				break;

			case 'this-week':
				$get_args = array(
					'year'  => date( 'Y' ),
					'week'  => date( 'W' )
				);

				return $get_args;
				break;

			case 'last-week':
				$this_week = date( 'W' );

				if ( $this_week != 1 ) {
					$last_week = $this_week - 1;
				} else {
					$last_week = 52;
				}

				$this_year = date( 'Y' );

				if ( $last_week != 52 ) {
					$this_year = date( 'Y' );
				} else {
					$this_year = date( 'Y' ) -1;
				}

				$get_args = array(
					'year'  => $this_year,
					'week'  => $last_week
				);

				return $get_args;
				break;

			case 'this-month':
				$today_date = getdate();
				$get_args 	= array(
					'month' => $today_date['mon']
				);

				return $get_args;
				break;

			case 'last-month':
				$this_date = getdate();

				if ( $this_date['mon'] != 1 ) {
					$last_month = $this_date['mon'] - 1;
				} else {
					$last_month = 12;
				}

				$this_year = date( 'Y' );
				if ( $last_month != 12 ) {
					$this_year = date('Y');
				} else {
					$this_year = date('Y') - 1;
				}

				$get_args = array(
					'year'  => $this_year,
					'month'  => $last_month
				);

				return $get_args;
				break;

			default: return [];
		}

	}

endif;


if ( ! function_exists( 'azure_news_render_tab_posts' ) ) :

	/**
	 * function to output the tab posts.
	 *
	 * @since 1.0.0
	 */
	function azure_news_render_tab_posts( $azure_news_tab_type ) {

		$azure_news_tab_args = array(
			'posts_per_page'        => apply_filters( 'azure_news_banner_tab_post_count', 3 ),
            'ignore_sticky_posts'   => true
		);

		switch ( $azure_news_tab_type ) {
			case 'popular':
				$azure_news_tab_args['orderby'] = 'comment_count';
				break;

			case 'trending':
				$azure_news_trending_category = azure_news_get_customizer_option_value( 'azure_news_banner_tab_trending_category' );
				if ( 'all' !== $azure_news_trending_category ) {
					$azure_news_tab_args['category_name'] = $azure_news_trending_category;
				}
				break;

			default:
				break;
		}

?>
		<div class="<?php echo esc_attr( $azure_news_tab_type ); ?>-posts-wrapper tab-posts-wrapper">
			<?php
				$azure_news_tab_query = new WP_Query( $azure_news_tab_args );
				if ( $azure_news_tab_query->have_posts() ) {
					while ( $azure_news_tab_query->have_posts() ) {
						$azure_news_tab_query->the_post();
						if ( has_post_thumbnail() ) {
	                        $post_img	= 'has-image';
	                    } else {
	                        $post_img   = 'no-image';
	                    }
	        ?>
	        			<div class="single-post-wrap <?php echo esc_attr( $post_img ); ?>">
	        				<?php azure_news_post_thumbnail( 'azure-news-block-medium' ); ?>
                            <div class="post-content-wrap">

                                <div class="post-title-wrap">
                                    <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                </div><!-- .post-title-wrap -->
								<?php azure_news_posted_on(); ?>
                            </div><!-- .post-content-wrap -->
	        			</div><!-- .single-post-wrap -->
	        <?php
					}
				}
			?>
		</div><!-- .tab-posts-wrapper -->
<?php

	}

endif;

if ( ! function_exists( 'azure_news_site_mode_switcher' ) ) :

	/**
	 * display the site mode switcher icon in header section
	 *
	 * @since 1.0.0
	 */
	function azure_news_site_mode_switcher() {

		$azure_news_header_site_mode_switch_enable = azure_news_get_customizer_option_value( 'azure_news_header_site_mode_switch_enable' );
		if ( false === $azure_news_header_site_mode_switch_enable ) {
			return;
		}

		if ( isset( $_COOKIE["azure-news-site-mode-cookie"] ) ) {
            $site_mode_value = $_COOKIE["azure-news-site-mode-cookie"];
        } else {
            $site_mode_value = azure_news_get_customizer_option_value( 'azure_news_site_mode' );
        }
?>
		<div id="azure-news-site-mode-wrap" class="azure-news-icon-elements">
			<a id="mode-switcher" class="<?php echo esc_attr( $site_mode_value ); ?>" data-site-mode="<?php echo esc_attr( $site_mode_value ); ?>" href="#">
				<span class="site-mode-icon"><?php esc_html_e( 'site mode button', 'azure-news' ); ?></span>
			</a>
		</div><!-- #azure-news-site-mode-wrap -->
<?php
	}

endif;

if ( ! function_exists( 'azure_news_sticky_sidebar_toggle' ) ) :

	/**
	 * display sticky sidebar toggle icon
	 *
	 * @since 1.0.0
	 */
	function azure_news_sticky_sidebar_toggle() {
		$azure_news_header_sticky_sidebar_toggle_enable = azure_news_get_customizer_option_value( 'azure_news_header_sticky_sidebar_toggle_enable' );
		if ( false === $azure_news_header_sticky_sidebar_toggle_enable ) {
			return;
		}
?>
		<div class="sidebar-menu-toggle-wrap azure-news-icon-elements">
            <button class="sidebar-menu-toggle azure-news-modal-toggler" data-popup-content=".sticky-header-sidebar">
                <a href="javascript:void(0)">
                    <div class="sidebar-menu-toggle-nav">
                        <span class="smtn-top"></span>
                        <span class="smtn-mid"></span>
                        <span class="smtn-bot"></span>
                    </div>
                </a>
            </button>
            <div class="sticky-header-sidebar azure-news-modal-popup-content">
                <div class="sticky-header-widget-wrapper">
                    <?php
                        if ( is_active_sidebar( 'header-sticky-sidebar' ) ) {
                            dynamic_sidebar( 'header-sticky-sidebar' );
                        }
                    ?>
                </div>
                <div class="sticky-header-sidebar-overlay"> </div>
                <button class="sticky-sidebar-close azure-news-madal-close" data-focus=".sidebar-menu-toggle.azure-news-modal-toggler"><i class="bx bx-x"></i></button>
            </div><!-- .sticky-header-sidebar -->
        </div><!-- .sidebar-menu-toggle-wrap -->
<?php
	}

endif;

if ( ! function_exists( 'azure_news_minify_css' ) ) {

    /**
     * Minify CSS
     *
     * @since 1.0.1
     */
    function azure_news_minify_css( $css = '' ) {

        // Return if no CSS
        if ( ! $css ) return;

        // Normalize whitespace
        $css = preg_replace( '/\s+/', ' ', $css );

        // Remove ; before }
        $css = preg_replace( '/;(?=\s*})/', '', $css );

        // Remove space after , : ; { } */ >
        $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

        // Remove space before , ; { }
        $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

        // Strips leading 0 on decimal values (converts 0.5px into .5px)
        $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

        // Strips units if value is 0 (converts 0px to 0)
        $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

        // Trim
        $css = trim( $css );

        // Return minified CSS
        return $css;

    }

}

/*----------------------------- Google fonts ---------------------------------------------*/

	if ( ! function_exists( 'azure_news_get_google_font_variants' ) ) :

	    /**
	     * get Google font variants
	     *
	     * @since 1.0.0
	     */
	    function azure_news_get_google_font_variants() {
	        $azure_news_font_list = get_option( 'azure_news_google_font' );

	        $font_family = $_REQUEST['font_family'];

	        $variants_array = $azure_news_font_list[$font_family]['0'];

	        $options_array = '<option value="inherit">'. __( 'Inherit', 'azure-news' ) .'</option>';
	        foreach ( $variants_array as $variant ) {
	            $variant_html = azure_news_convert_font_variants( $variant );
	            $options_array .= '<option value="'.esc_attr( $variant ).'">'. esc_html( $variant_html ).'</option>';
	        }
	        echo $options_array;
	        die();
	    }

	endif;

	add_action( "wp_ajax_get_google_font_variants", "azure_news_get_google_font_variants" );

	if ( ! function_exists( 'azure_news_convert_font_variants' ) ) :

	    /**
	     * function to manage the variant name according to their value.
	     *
	     * @param $value  - string
	     * @return string - variant name
	     * @since 1.0.0
	     */
	    function azure_news_convert_font_variants( $value ) {
	        switch ( $value ) {
	            case '100':
	                return __( 'Thin 100', 'azure-news' );
	                break;

	            case '200':
	                return __( 'Extra-Light 200', 'azure-news' );
	                break;

	            case '300':
	                return __( 'Light 300', 'azure-news' );
	                break;

	            case '400':
	                return __( 'Normal 400', 'azure-news' );
	                break;

	            case '500':
	                return __( 'Medium 500', 'azure-news' );
	                break;

	            case '600':
	                return __( 'Semi-Bold 600', 'azure-news' );
	                break;

	            case '700':
	                return __( 'Bold 700', 'azure-news' );
	                break;

	            case '800':
	                return __( 'Extra-Bold 800', 'azure-news' );
	                break;

	            case '900':
	                return __( 'Ultra-Bold 900', 'azure-news' );
	                break;

	            case 'inherit':
	                return __( 'Inherit', 'azure-news' );
	                break;

	            default:
	                break;
	        }
	    }

	endif;

	if ( ! function_exists( 'azure_news_google_font_callback' ) ) :

		/**
		 * Load google fonts api link
		 *
		 * @since 1.0.0
		 */
		function azure_news_google_font_callback() {

			$azure_news_get_font_list 	= get_option( 'azure_news_google_font' );

		    $azure_news_body_font_family   	= azure_news_get_customizer_option_value( 'azure_news_body_font_family' );
		    $azure_news_body_font_weight   	= implode( ',', $azure_news_get_font_list[$azure_news_body_font_family]['0'] );
		    $body_typo_combo		= $azure_news_body_font_family.":".$azure_news_body_font_weight;

		    $azure_news_heading_font_family 	= azure_news_get_customizer_option_value( 'azure_news_heading_font_family' );
		    $azure_news_heading_font_weight   	= implode( ',', $azure_news_get_font_list[$azure_news_heading_font_family]['0'] );
		    $heading_typo_combo		= $azure_news_heading_font_family.":".$azure_news_heading_font_weight;

		    $get_fonts          = array( $body_typo_combo, $heading_typo_combo );

		    $final_font_string = implode( '|', $get_fonts );

		    $google_fonts_url = '';

		    if ( $final_font_string ) {
		        $query_args = array(
		            'family' => urlencode( $final_font_string ),
		            'subset' => urlencode( 'latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic,khmer,devanagari,arabic,hebrew,telugu' )
		        );

		        $google_fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		    }

		    return $google_fonts_url;
		}

	endif;

/*----------------------------- Schema Markup ---------------------------------------------*/

	if ( ! function_exists( 'azure_news_get_schema_markup' ) ) :

		/**
		 * Return correct schema markup
		 *
		 * @since 1.0.0
		 */
		function azure_news_get_schema_markup( $location ) {

			// Default
			$schema = $itemprop = $itemtype = '';

			// HTML
			if ( 'html' == $location ) {
				if ( is_home() || is_front_page() ) {
					$schema = 'itemscope=itemscope itemtype=https://schema.org/WebPage';
				} elseif ( is_category() || is_tag() || is_singular( 'post') ) {
					$schema = 'itemscope=itemscope itemtype=https://schema.org/Blog';
				} elseif ( is_page() ) {
					$schema = 'itemscope=itemscope itemtype=https://schema.org/WebPage';
				} else {
					$schema = 'itemscope=itemscope itemtype=https://schema.org/WebPage';
				}
			}

			// Creative work
			if ( 'creative_work' == $location ) {
				if ( is_single() ) {
					$schema = 'itemscope=itemscope itemtype=https://schema.org/creative_work';
				} elseif ( is_home() || is_archive() ) {
					$schema = 'itemscope=itemscope itemtype=https://schema.org/creative_work';
				}
			}

			// Header
			if ( 'header' == $location ) {
				$schema = 'itemscope=itemscope itemtype=https://schema.org/WPHeader';
			}

			// Logo
			if ( 'logo' == $location ) {
				$schema = 'itemscope itemtype=https://schema.org/Organization';
			}

			// Navigation
			if ( 'site_navigation' == $location ) {
				$schema = 'itemscope=itemscope itemtype=https://schema.org/SiteNavigationElement';
			}

			// Main
			if ( 'main' == $location ) {
				$itemtype = 'https://schema.org/WebPageElement';
				$itemprop = 'mainContentOfPage';
			}

			// Sidebar
			if ( 'sidebar' == $location ) {
				$schema = 'itemscope=itemscope itemtype=https://schema.org/WPSideBar';
			}

			// Footer widgets
			if ( 'footer' == $location ) {
				$schema = 'itemscope=itemscope itemtype=https://schema.org/WPFooter';
			}

			// Headings
			if ( 'headline' == $location ) {
				$schema = 'itemprop=headline';
			}

			// Posts
			if ( 'entry_content' == $location ) {
				$schema = 'itemprop=text';
			}

			// Publish date
			if ( 'publish_date' == $location ) {
				$schema = 'itemprop=datePublished';
			}

			// Modified date
			if ( 'modified_date' == $location ) {
				$schema = 'itemprop=dateModified';
			}

			// Author name
			if ( 'author_name' == $location ) {
				$schema = 'itemprop=name';
			}

			// Author link
			if ( 'author_link' == $location ) {
				$schema = 'itemprop=author itemscope=itemscope itemtype=https://schema.org/Person';
			}

			// Item
			if ( 'item' == $location ) {
				$schema = 'itemprop=item';
			}

			// Url
			if ( 'url' == $location ) {
				$schema = 'itemprop=url';
			}

			// Position
			if ( 'position' == $location ) {
				$schema = 'itemprop=position';
			}

			// Image
			if ( 'image' == $location ) {
				$schema = 'itemprop=image';
			}

	        // Avatar
	        if ( 'avatar' == $location ) {
	            $schema = 'itemprop=avatar';
	        }

	        // Description
	        if ( 'description' == $location ) {
	            $schema = 'itemprop=description';
	        }

			return ' ' . apply_filters( 'azure_news_schema_markup_items', $schema );

		}

	endif;

	if ( ! function_exists( 'azure_news_schema_markup' ) ) :

		/**
		 * Outputs correct schema markup
		 *
		 * @since 1.0.0
		 */
		function azure_news_schema_markup( $location ) {


			$azure_news_site_schema_enable = azure_news_get_customizer_option_value( 'azure_news_site_schema_enable' );

			if ( false === $azure_news_site_schema_enable ) {
				return;
			}

			echo azure_news_get_schema_markup( $location );

		}

	endif;

/*------------------------ Primary Menu Settings --------------------------*/

	/**
	 *  Menu items - Add "Custom sub-menu" in menu item render output
	 *  if menu item has class "menu-item-target"
	 */
	add_filter( 'walker_nav_menu_start_el', 'azure_news_nav_description', 10, 4 );

	if ( ! function_exists( 'azure_news_nav_description' ) ) :

		function azure_news_nav_description( $item_output, $item, $depth, $args ) {

			$azure_news_primary_menu_description_enable = azure_news_get_customizer_option_value( 'azure_news_primary_menu_description_enable' );

		    if ( ! empty( $item->description ) && false !== $azure_news_primary_menu_description_enable ) {
		        $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
		    }
		    return $item_output;
		}

	endif;

/*------------------------ Generate darker color --------------------------*/

	if ( ! function_exists( 'azure_news_darker_color' ) ) :

		/**
		 * Generate darker color
		 *
		 * @since 1.0.0
		 */
	    function azure_news_darker_color( $hex, $steps ) {
	        // Steps should be between -255 and 255. Negative = darker, positive = lighter
	        $steps = max( -255, min( 255, $steps ) );

	        if ( ! str_contains( $hex, '#' ) ) {
	        	$hex = azure_news_rgba2hex( $hex );
	        }

	        // Normalize into a six character long hex string
	        $hex = str_replace( '#', '', $hex );
	        if ( strlen( $hex ) == 3) {
	            $hex = str_repeat( substr( $hex,0,1 ), 2 ).str_repeat( substr( $hex, 1, 1 ), 2 ).str_repeat( substr( $hex,2,1 ), 2 );
	        }

	        // Split into three parts: R, G and B
	        $color_parts = str_split( $hex, 2 );
	        $return = '#';

	        foreach ( $color_parts as $color ) {
	            $color   = hexdec( $color ); // Convert to decimal
	            $color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
	            $return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	        }

	        return $return;
	    }

	endif;

	if ( ! function_exists( 'azure_news_rgba2hex' ) ) :

		function azure_news_rgba2hex( $string ) {
			$rgba  = array();
			$hex   = '';
			$regex = '#\((([^()]+|(?R))*)\)#';
			if (preg_match_all($regex, $string ,$matches)) {
		    	$rgba = explode(',', implode(' ', $matches[1]));
			} else {
				$rgba = explode(',', $string);
			}

			$rr = dechex($rgba['0']);
			$gg = dechex($rgba['1']);
			$bb = dechex($rgba['2']);
			$aa = '';

			if (array_key_exists('3', $rgba)) {
				$aa = dechex($rgba['3'] * 255);
			}

			return strtoupper("#$aa$rr$gg$bb");
		}

	endif;
