<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php azure_news_schema_markup( 'html' ); ?>>
<?php
	wp_body_open();

	/**
	 * hook - azure_news_before_page
	 *
	 * @since 1.0.0
	 */
	do_action( 'azure_news_before_page' );
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'azure-news' ); ?></a>

	<?php
		/**
		 * hook - azure_news_header_section
		 *
		 * @hooked - azure_news_custom_header_html - 10
		 * @hooked - azure_news_top_header - 20
		 * @hooked - azure_news_main_header - 30
		 * @hooked - header_news_ticker_section - 40
		 *
		 * @since 1.0.0
		 */
		do_action( 'azure_news_header_section' );
	?>

	<div id="content" class="site-content" <?php azure_news_schema_markup( 'creative_work' ); ?>>

		<?php

			if ( is_home() && is_front_page() ) {

				$azure_news_frontpage_blocks_enable = azure_news_get_customizer_option_value( 'azure_news_frontpage_blocks_enable' );

				if ( true !== $azure_news_frontpage_blocks_enable ) {
					return;
				}

				/**
				 * hook - azure_news_frontpage_section
				 *
				 * @hooked - azure_news_frontpage_main_banner - 10
				 * @hooked - azure_news_frontpage_middle_content - 30
				 * @hooked - azure_news_frontpage_bottom_fullwidth - 40
				 *
				 * @since 1.0.0
				 */
				do_action( 'azure_news_frontpage_section' );

			}

		?>
