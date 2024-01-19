<?php
/**
 * The template for displaying archive pages
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

<div class="archive-page page-content-wrapper">

	<div class="azure-news-container">

		<?php get_sidebar( 'left' ); ?>

		<main id="primary" class="site-main">

			<?php
				/**
				 * hook - azure_news_before_archive_loop_content
				 *
				 * @since 1.0.0
				 */
				do_action( 'azure_news_before_archive_loop_content' );

				if ( have_posts() ) :
					if ( ! is_author() ) :
			?>
					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

			<?php
					endif;

					echo '<div class="archive-content-wrapper">';
					
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					the_posts_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				echo '</div><!-- archive-content-wrapper ->';

				endif;

				/**
				 * hook - azure_news_after_archive_loop_content
				 *
				 * @since 1.0.0
				 */
				do_action( 'azure_news_after_archive_loop_content' );
			?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>
		
	</div> <!-- azure-news-container -->

</div><!-- .page-content-wrapper -->

<?php
	/**
	 * hook - azure_news_after_page_post_content
	 *
	 * @since 1.0.0
	 */
	do_action( 'azure_news_after_page_post_content' );

	get_footer();
