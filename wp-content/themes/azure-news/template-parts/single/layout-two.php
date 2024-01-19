<?php
/**
 * Template part for displaying single post layout two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Azure News
 */

if ( has_post_thumbnail() ) {
    $custom_post_class = 'has-thumbnail';
} else {
    $custom_post_class = 'no-thumbnail';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $custom_post_class ); ?>>

	<div class="post-thumbnail-wrap">
        <?php
        	azure_news_post_thumbnail();
        	azure_news_the_estimated_reading_time();
        ?>
        <div class="azure-news-post-title-wrap">
        	<div class="post-cats-wrap">
	        	<?php azure_news_the_post_categories_list( get_the_ID(), 1 ); ?>
	    	</div><!-- .post-cats-wrap -->

			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) :
				?>
					<div class="entry-meta">
						<?php
							azure_news_posted_on();
							azure_news_posted_by();
							azure_news_post_comment();
						 	azure_news_entry_footer();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
        </div> <!-- azure-news-post-title-wrap -->
    </div> <!-- post-thumbnail-wrap -->
	<div class="azure-news-post-content-wrap">
		<?php get_template_part( 'template-parts/partials/post/content' ); ?>
	</div> <!-- post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
