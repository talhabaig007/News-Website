<?php
/**
 * Partial template for main banner block.
 *
 * @package Azure News
 */


$block_args = $args['block_args'];

?>
<div class="block-wrapper">
    <?php
        $block_query = new WP_Query( $block_args );
        if ( $block_query->have_posts() ) {
            while ( $block_query->have_posts() ) {
                $block_query->the_post();
                if ( has_post_thumbnail() ) {
                    $post_img      = 'has-image';
                } else {
                    $post_img      = 'no-image';
                }
    ?>
                <div class="single-block-post-wrapper <?php echo esc_attr( $post_img ); ?>">
                    <div class="post-thumbnail-wrap">
                        <?php azure_news_post_thumbnail( 'azure-news-block-medium' ); ?>
                    </div>
                    <div class="post-content-wrap">
                        <div class="post-cats-read-wrap">
                            <div class="post-cats-wrap">
                                    <?php
                                    azure_news_the_post_categories_list( get_the_ID(), 1 ); ?>
                            </div><!-- .cat-wrap -->
                        </div>
                        <div class="post-title-wrap">
                            <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </div><!-- .post-title-wrap -->
                    </div><!-- .post-content-wrap -->
                </div><!-- .single-block-post-wrapper -->
    <?php
            }
        }
    ?>
</div><!-- .block-wrapper-->