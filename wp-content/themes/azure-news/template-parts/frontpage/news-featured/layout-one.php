<?php
/**
 * News Featured layout one
 * 
 * @package Azure News
 */

extract( $args );

$block_custom_classes[] = 'block-layout--one';

?>

<section class="frontpage-block news-featured-block">
    <div class="azure-news-container">
        <div class="block-wrapper <?php echo esc_attr( implode( ' ', $block_custom_classes ) ); ?>">
            <?php
                if ( isset( $post_options->blockTitle ) && ! empty( $post_options->blockTitle ) ) {
                    echo '<h2 class="block-title">'. esc_html( $post_options->blockTitle ) .'</h2>';
                }
            ?>

            <div class="block-posts-wrapper azure-news-column-wrapper">
                <?php
                    $featured_query = new WP_Query( $post_args );
                    if ( $featured_query->have_posts() ) :
                        
                        while ( $featured_query->have_posts() ) :
                            $featured_query->the_post();
                            if ( has_post_thumbnail() ) {
                                $post_img      = 'has-image';
                            } else {
                                $post_img      = 'no-image';
                            }
                ?>
                            <article class="block-post-wrap azure-news-column-three <?php echo esc_attr( $post_img ); ?>">
                                
                                <div class="post-thumbnail-wrap">
                                    <?php
                                        azure_news_post_thumbnail( 'azure-news-block-medium' );
                                        azure_news_the_estimated_reading_time();
                                    ?>
                                </div>
                                
                                <div class="post-content-wrap">

                                    <?php if ( isset( $post_options->postCats ) && $post_options->postCats ) { ?>
                                        <div class="post-cats-wrap">
                                            <?php azure_news_the_post_categories_list( get_the_ID(), 2 ); ?>
                                        </div><!-- .post-cats-wrap -->
                                    <?php } ?>

                                    <div class="post-title-wrap">
                                        <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                                    </div><!-- .post-title-wrap -->

                                    <div class="post-meta-wrap">
                                        <?php
                                            if ( isset( $post_options->postDate ) && $post_options->postDate ) {
                                                azure_news_posted_on();
                                            }

                                            if ( isset( $post_options->postAuthor ) && $post_options->postAuthor ) {
                                                azure_news_posted_by();
                                            }

                                            if ( isset( $post_options->postComment ) && $post_options->postComment ) {
                                                azure_news_post_comment();
                                            }
                                        ?>
                                    </div><!-- .post-meta-wrap -->

                                    <?php
                                        if ( isset( $post_options->postMore ) && $post_options->postMore ) {
                                            get_template_part( 'template-parts/partials/post/read-more' );
                                        }
                                    ?>

                                </div><!-- .post-content-wrap -->

                            </article><!-- .block-post-wrap -->
                <?php
                        endwhile;

                    endif;
                ?>
            </div><!-- .block-posts-wrapper -->
        </div><!-- .block-wrapper -->
    </div> <!-- azure-news-container -->
</section><!-- .news-featured-block -->