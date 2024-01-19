<?php
/**
 * Function file for importing demo content using OCDI.
 *
 * @package Azure News
 */

if ( ! function_exists( 'azure_news_demo_import_files' ) ):

	/**
	 * Function to define required files for demo import.
	 */
	function azure_news_demo_import_files() {
	return
	array(
		array(
			'import_file_name'             	=> __( 'Azure News', 'azure-news' ),
			'import_file_url'            	=> 'https://codevibrant.com/demo-data/azure-news/azure-news/azure-news.xml',
			'import_widget_file_url'     	=> 'https://codevibrant.com/demo-data/azure-news/azure-news/azure-news-widgets.wie',
			'import_customizer_file_url' 	=> 'https://codevibrant.com/demo-data/azure-news/azure-news/azure-news-export.dat',
			'import_preview_image_url'     	=> esc_url( trailingslashit( get_template_directory_uri() ). 'screenshot.png' ),
			'import_notice'          	   	=> esc_html__( 'After you import this demo, you can customize settings from Appreance >> Customize.', 'azure-news' ),
			'preview_url'                  	=> 'https://demo.codevibrant.com/azure-news/',
		),
		array(
			'import_file_name'             	=> __( 'Azure RTL', 'azure-news' ),
			'import_file_url'            	=> 'https://codevibrant.com/demo-data/azure-news/azure-rtl/azure-rtl.xml',
			'import_widget_file_url'     	=> 'https://codevibrant.com/demo-data/azure-news/azure-rtl/azure-rtl-widgets.wie',
			'import_customizer_file_url' 	=> 'https://codevibrant.com/demo-data/azure-news/azure-rtl/azure-rtl-export.dat',
			'import_preview_image_url'    	=> 'https://codevibrant.com/demo-data/azure-news/azure-rtl/screenshot.jpg',
			'preview_url'               	=> 'https://demo.codevibrant.com/azure-rtl/',
		),
		array(
			'import_file_name'             	=> __( 'Azure Pro', 'azure-news' ),
			'import_file_url'            	=> '',
			'import_widget_file_url'     	=> '',
			'import_customizer_file_url' 	=> '',
			'import_preview_image_url'    	=> 'https://codevibrant.com/demo-data/azure-news/azure-pro/screenshot.jpg',
			'preview_url'               	=> 'https://demo.codevibrant.com/azure-pro/',
		),
		array(
			'import_file_name'             	=> __( 'Azure Pro News', 'azure-news' ),
			'import_file_url'            	=> '',
			'import_widget_file_url'     	=> '',
			'import_customizer_file_url' 	=> '',
			'import_preview_image_url'    	=> 'https://codevibrant.com/demo-data/azure-news/azure-pro-news/screenshot.jpg',
			'preview_url'               	=> 'https://demo.codevibrant.com/azure-pro-news/',
		),
		array(
			'import_file_name'             	=> __( 'Azure Pro RTL', 'azure-news' ),
			'import_file_url'            	=> '',
			'import_widget_file_url'     	=> '',
			'import_customizer_file_url' 	=> '',
			'import_preview_image_url'    	=> 'https://codevibrant.com/demo-data/azure-news/azure-pro-rtl/screenshot.jpg',
			'preview_url'               	=> 'https://demo.codevibrant.com/azure-pro-rtl/',
		),
	);
}

add_filter( 'ocdi/import_files', 'azure_news_demo_import_files' );

endif;

function azure_news_after_import_setup() {
	// Assign menus to their locations.
	$top_menu = get_term_by( 'name', 'top-menu', 'nav_menu' );
	$main_menu = get_term_by( 'name', 'top', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'top_header_menu' => $top_menu->term_id,
			'primary_menu' => $main_menu->term_id,
		)
	);

}
add_action( 'ocdi/after_import', 'azure_news_after_import_setup' );