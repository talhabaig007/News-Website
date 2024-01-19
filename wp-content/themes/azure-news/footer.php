<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
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
	</div><!-- #content -->
	<?php
		/**
		 * hook - azure_news_before_colophon
		 *
		 * @since 1.0.0
		 */
		do_action( 'azure_news_before_colophon' );
	?>
	<footer id="colophon" class="site-footer" <?php azure_news_schema_markup( 'footer' ); ?>>
		<?php
			//footer widget  area
			get_template_part( 'template-parts/partials/footer/widget', 'area' );

			//bottom footer
			get_template_part( 'template-parts/footer/bottom', 'area' );
		?>
	</footer><!-- #colophon -->
	<?php
		/**
		 * hook - azure_news_after_colophon
		 *
		 * @since 1.0.0
		 */
		do_action( 'azure_news_after_colophon' );
	?>
</div><!-- #page -->
<?php
	/**
	 * hook - azure_news_after_page
	 *
	 * @since 1.0.0
	 */
	do_action( 'azure_news_after_page' );

	wp_footer();
?>

</body>
</html>
