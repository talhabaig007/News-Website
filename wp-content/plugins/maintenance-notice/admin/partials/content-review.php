<?php
/**
 * Content for review section in admin area.
 *
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
?>
<div id="cvmn-review" style="display:none">
    <h2 class="cvmn-admin-title">
        <?php echo esc_html__( 'Give a review & motivate us', 'maintenance-notice' ); ?>
    </h2>
    <?php
    echo '<div class="cvmn-admin-img">';
        echo '<img src="'.esc_url( plugins_url( 'includes/assets/images/review-img.jpg', dirname(__DIR__) ) ).'">';
    echo '</div>';

        echo sprintf( esc_html__( '%1s Send us your Feedback %2s', 'maintenance-notice' ), '<h2>', '</h2>' );
        echo '<div class="cvmn-admin-fields">';
            echo sprintf( esc_html__( "%2sPlease let us know about your experience with Maintenance Notice so far. We love to hear positive things but we're also thankful for the negatives. Your feedback will alert us to problems and help us improve our Maintenance Notice.
            Are you happy with us? Would you mind taking a moment to leave us a rating? It will only take a minute. We look forward to receiving feedback from you to make Maintenance Notice even more useful for you and others. !%2s", 'maintenance-notice' ), '<p>', '</p>' );

            echo sprintf( esc_html__( 'Leave a review %1s here %2s and', 'maintenance-notice' ), '<a href="'.esc_url( 'https://wordpress.org/support/plugin/maintenance-notice/reviews/?filter=5' ).'">', '</a>' ); 

            echo sprintf( esc_html__( '%1s Thanks for choosing Maintenance Notice %2s', 'maintenance-notice' ), '<em class="cvmn-note">', '</em>' );
        echo '</div>';
    ?>
</div><!-- .cvmn-review -->