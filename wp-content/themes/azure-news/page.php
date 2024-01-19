<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Azure News
 */

get_header();

/**
 * hook - azure_news_before_page_post_content
 *
 * @since 1.0.0
 */
do_action( 'azure_news_before_page_post_content' );

?>
<div class="page-content-wrapper">

	<div class="azure-news-container">

		<?php get_sidebar( 'left' ); ?>
	
		<main id="primary" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>

	</div> <!-- azure-news container -->

</div><!-- .page-content-wrapper -->
<?php
	/**
	 * hook - azure_news_after_page_post_content
	 *
	 * @since 1.0.0
	 */
	do_action( 'azure_news_after_page_post_content' );

	get_footer();
