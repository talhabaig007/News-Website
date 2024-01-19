<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
<div class="single-post page-content-wrapper">

	<div class="azure-news-container">

		<?php get_sidebar( 'left' ); ?>
		
		<main id="primary" class="site-main">

			<?php
				/**
				 * hook - azure_news_before_single_post_loop_content
				 *
				 * @since 1.0.0
				 */
				do_action( 'azure_news_before_single_post_loop_content' );

				while ( have_posts() ) :
					the_post();

					$azure_news_single_posts_layout = azure_news_get_customizer_option_value( 'azure_news_single_posts_layout' );
					$get_layout = explode( '--', $azure_news_single_posts_layout );

					get_template_part( 'template-parts/single/layout', $get_layout[1] );

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'azure-news' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'azure-news' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.

				/**
				 * hook - azure_news_after_single_post_loop_content
				 *
				 * @hooked - azure_news_post_author_box -10
				 * @hooked - azure_news_single_post_related_posts_section - 20
				 * 
				 * @since 1.0.0
				 */
				do_action( 'azure_news_after_single_post_loop_content' );
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