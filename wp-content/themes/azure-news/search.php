<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'azure-news' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<?php
				echo '<div class="archive-content-wrapper">';
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				the_posts_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );
			echo '</div><!-- archive-content-wrapper ->';
			endif;
			?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>

	</div> <!-- .azure-news-container -->

</div><!-- .page-content-wrapper -->

<?php
	/**
	 * hook - azure_news_after_page_post_content
	 *
	 * @since 1.0.0
	 */
	do_action( 'azure_news_after_page_post_content' );

	get_footer();
