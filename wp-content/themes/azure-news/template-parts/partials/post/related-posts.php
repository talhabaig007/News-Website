<?php
/**
 * Partial template to display the single post's related posts section.
 *
 * @package Azure News
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_single_posts_related_enable = azure_news_get_customizer_option_value( 'azure_news_single_posts_related_enable' );

if ( false === $azure_news_single_posts_related_enable ) {
    return;
}

/**
 * hook - azure_news_before_single_post_related_posts_section
 *
 * @since 1.0.0
 */
do_action( 'azure_news_before_single_post_related_posts_section' );

$azure_news_single_posts_related_label = azure_news_get_customizer_option_value( 'azure_news_single_posts_related_label' );
$section_column = apply_filters( 'single_posts_related_column', 3 );

$related_posts_args = array(
    'posts_per_page'        => absint( $section_column ),
    'post__not_in'          => array( get_the_ID() ),
    'ignore_sticky_posts'   => true
);
$current_post_cats = get_the_category( get_the_ID() );

if ( $current_post_cats && is_array( $current_post_cats ) ) {
    foreach ( $current_post_cats as $post_cat ) {
        $post_cats[] = $post_cat->term_id;
    }
    $related_posts_args['category__in'] = $post_cats;
}

$related_posts_query = new WP_Query( $related_posts_args );

if ( $related_posts_query->have_posts() ) :
?>
    <section class="single-related-posts section-column-<?php echo absint( $section_column ); ?>">
        
        <h2 class="related-post-title"><?php echo esc_html( $azure_news_single_posts_related_label ); ?></h2>

        <div class="related-posts-wrapper">
            <?php
                while ( $related_posts_query->have_posts() ) :
                    $related_posts_query->the_post();

                    if ( has_post_thumbnail() ) {
                        $post_class = 'has-thumbnail';
                        $post_img_url  = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                    } else {
                        $post_class = 'no-thumbnail';
                        $post_img_url = '';
                    }
            ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
                        <div class="post-thumbnail-wrap">
                            <?php
                                azure_news_post_thumbnail('azure-news-block-medium');
                                azure_news_the_estimated_reading_time();
                            ?>
                        </div><!-- .post-thumbnail-wrap -->
                        <div class="post-cats-wrap">
                            <?php azure_news_the_post_categories_list( get_the_ID(), 1 ); ?>
                        </div><!-- .post-cats-wrap -->
                        <header class="entry-header">
                            <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                        </header><!-- .entry-header -->
                        <div class="post-meta-wrap">
                            <?php
                                azure_news_posted_on();
                                azure_news_posted_by();
                                azure_news_post_comment();
                            ?>
                        </div><!-- .post-meta-wrap -->
                    </article>
            <?php
                endwhile;
            ?>
        </div><!-- .related-posts-wrapper -->
    </section><!-- .single-related-posts -->
<?php

endif;

wp_reset_postdata();

/**
 * hook - azure_news_after_single_post_related_posts_section
 *
 * @since 1.0.0
 */
do_action( 'azure_news_after_single_post_related_posts_section' );