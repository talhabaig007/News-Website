<?php
/**
 * Template part for displaying a content located in top header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_header_top_enable = azure_news_get_customizer_option_value( 'azure_news_header_top_enable' );

if ( false === $azure_news_header_top_enable ) {
	return;
}

$top_header_classes[] = 'top-header-wrapper';
$azure_news_header_top_placement = apply_filters( 'azure_news_azure_news_header_top_placement', azure_news_get_customizer_option_value( 'azure_news_header_top_placement' ) );
$header_top_placement = explode( '_', $azure_news_header_top_placement );
$top_header_classes[] = 'element-order--'.$header_top_placement[1];

/**
 * hook - azure_news_before_top_header
 *
 * @since 1.0.0
 */
do_action( 'azure_news_before_top_header' );
?>
<div id="top-header" class="<?php echo esc_attr( implode( ' ', $top_header_classes ) ); ?>">
	<div class="azure-news-container top-menu-header azure-news-flex">
		<?php
			switch ( $azure_news_header_top_placement ) {
				case 'placement_one':

					// Date / Social Icon / Top Menu /
					// date
					get_template_part( 'template-parts/partials/header/date' );

					// social icon
					if ( true === azure_news_get_customizer_option_value( 'azure_news_header_social_enable' ) ) {
						get_template_part( 'template-parts/partials/header/social', 'icons' );
					}

					// top menu
					get_template_part( 'template-parts/partials/header/top', 'menu' );

				default:
					break;
			}
		?>

	</div><!-- .azure-news-container -->


</div><!-- .top-header-wrapper -->
<?php
/**
 * hook - azure_news_after_top_header
 *
 * @since 1.0.0
 */
do_action( 'azure_news_after_top_header' );