<?php
/**
 * Template part for displaying archive posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Azure News
 */

$custom_post_class = '';
if ( ! has_post_thumbnail() ) {
	$custom_post_class = 'no-thumbnail';
}

$azure_news_archive_page_style = azure_news_get_customizer_option_value( 'azure_news_archive_page_style' );

if ( 'archive-style--classic' === $azure_news_archive_page_style ) {
	$thumb_size = 'full';
} else {
	$thumb_size = 'azure-news-block-medium';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $custom_post_class ); ?>>

	<div class="post-thumbnail-wrap">
        <?php
        	azure_news_post_thumbnail( $thumb_size );
        	azure_news_the_estimated_reading_time();
        ?>
    </div>
	
	<div class="azure-news-post-content-wrap"> 
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

		<?php
			get_template_part( 'template-parts/partials/post/content' );

			$azure_news_archive_post_readmore_enable = azure_news_get_customizer_option_value( 'azure_news_archive_post_readmore_enable' );

			if ( false !== $azure_news_archive_post_readmore_enable ) {
				get_template_part( 'template-parts/partials/post/read-more' );
			}
			
		?>
	</div> <!-- post-content-wrapper -->

</article><!-- #post-<?php the_ID(); ?> -->
