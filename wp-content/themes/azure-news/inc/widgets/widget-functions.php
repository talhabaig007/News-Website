<?php
/**
 * File to handle widget area and related hooks and functions.
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'widgets_init', 'azure_news_widgets_init' );

if ( ! function_exists( 'azure_news_widgets_init' ) ) :

	 /**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function azure_news_widgets_init() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'azure-news' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'azure-news' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Left Sidebar', 'azure-news' ),
				'id'            => 'left-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'azure-news' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Frontpage - Middle Right Sidebar', 'azure-news' ),
				'id'            => 'front-middle-right-sidebar',
				'description' 	=> esc_html__( 'Add "AZURE NEWS:ABC" widget for frontpage middle right sidebar section.', 'azure-news' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		if ( true === azure_news_get_customizer_option_value( 'azure_news_header_sticky_sidebar_toggle_enable' ) ) {

			/**
			 * Register header sticky sidebar
			 *
			 * @since 1.0.0
			 */
			register_sidebar( array(
				'name'          => esc_html__( 'Header Sticky Sidebar', 'azure-news' ),
				'id'            => 'header-sticky-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'azure-news' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );

		}

		/**
		 * Register 4 different footer widget area
		 *
		 * @since 1.0.0
		 */
		register_sidebars( 4 , array(
			'name'          => esc_html__( 'Footer Column %d', 'azure-news' ),
			'id'            => 'footer-sidebar',
			'description'   => esc_html__( 'Added widgets are display at Footer Widget Area.', 'azure-news' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
		) );

		// register widget CV: Trending Posts
    	register_widget( 'Azure_News_Trending_Posts' );

    	// register widget CV: Latest Posts
    	register_widget( 'Azure_News_Latest_Posts' );

    	// register widget CV: Author Profile
    	register_widget( 'Azure_News_Author_Profile' );

	}

endif;

require get_template_directory().'/inc/widgets/azure-news-widgets-helper.php';
require get_template_directory().'/inc/widgets/trending-posts.php';
require get_template_directory().'/inc/widgets/latest-posts.php';
require get_template_directory().'/inc/widgets/author-profile.php';