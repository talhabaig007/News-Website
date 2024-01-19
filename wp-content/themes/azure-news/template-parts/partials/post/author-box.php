<?php
/**
 * Displays Author bio in single post
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_single_posts_author_enable = azure_news_get_customizer_option_value( 'azure_news_single_posts_author_enable' );

if ( ! is_single() || false === $azure_news_single_posts_author_enable ) {
    return;
}

/**
 * hook - azure_news_before_author_box
 * 
 * @since 1.0.0
 */
do_action( 'azure_news_before_author_box' );

$author_id         = get_the_author_meta( 'ID' );
$author_avatar     = get_avatar( $author_id, 'thumbnail' );
$author_post_link  = get_the_author_posts_link();
$author_bio        = get_the_author_meta( 'description' );
$author_url        = get_the_author_meta( 'user_url' );

?>

<div class="post-author-box-wrapper">

        <?php if ( $author_avatar ) { ?>
            <div class="azure-news-author__avatar">
                <?php echo wp_kses_post( $author_avatar ); ?>
            </div><!-- .azure-news-author-avatar -->
        <?php } ?>

        <div class="azure-news-author-info">
            <?php if ( $author_post_link ) { ?>
                    <h5 class="azure-news-author-name"><?php echo wp_kses_post( $author_post_link ); ?></h5>
            <?php } ?>

            <?php if ( $author_bio ) { ?>
                <div class="azure-news-author-bio">
                    <?php echo wp_kses_post( $author_bio ); ?>
                </div><!-- .azure-news-author-bio -->
            <?php } ?>

            <div class="azure-news-author-meta">
                <?php if ( $author_url ) { ?>
                    <div class="azure-news-author-website">
                        <span><?php esc_html_e( 'Website', 'azure-news' ); ?></span>
                        <a href="<?php echo esc_url( $author_url ); ?>" target="_blank"><?php echo esc_url( $author_url ); ?></a>
                    </div><!-- .azure-news-author-website -->
                <?php } ?>
            </div><!-- .azure-news-author-meta -->
        </div><!-- .azure-news-author-info -->
</div><!-- .post-author-box-wrapper -->

<?php
/**
 * hook - azure_news_after_author_box
 * 
 * @since 1.0.0
 */
do_action( 'azure_news_after_author_box' );