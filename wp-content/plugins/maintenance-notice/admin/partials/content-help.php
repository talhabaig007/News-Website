<?php
/**
 * Content for help section in admin area.
 *
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
?>
<div id="cvmn-help" style="display:none">
    <h2 class="cvmn-admin-title">
        <?php echo esc_html__( 'Do you need any help related to our plugin ?', 'maintenance-notice' ); ?>
    </h2>
    <?php
        echo '<div class="cvmn-admin-img">';
            echo '<img src="'.esc_url( plugins_url( 'includes/assets/images/support-img.jpg', dirname(__DIR__) ) ).'">';
        echo '</div>';

        echo '<div class="cvmn-admin-box-wrapper">';
            echo '<div class="cvmn-admin-fields">';
                echo esc_html__( 'Our documentation gives all the necessary detailed information to get you started. It provides an elaborated overview on plugin features, how to use those features and how to troubleshoot errors.', 'maintenance-notice' );
                echo '<div class="cvmn-main-btn">';
                    echo '<a class="button-primary" href="'.esc_url( 'https://docs.codevibrant.com/plugins/maintenance-notice/' ).'" target="_blank">';
                        echo esc_html__( 'Documentation', 'maintenance-notice' );
                    echo '</a>';
                echo '</div>';
            echo '</div>';

            echo '<div class="cvmn-admin-fields">';
                echo esc_html__( 'Our TeamSupport specialists are standing by to better understand your customer support needs and solve your problem for you. We aim to provide professional technical support  24/7 to satisfy your need and wish. We also offer support via email and social media.', 'maintenance-notice' );
                echo '<div class="cvmn-main-btn">';
                    echo '<a class="button-primary" href="'.esc_url( 'https://codevibrant.com/contact/' ).'" target="_blank">';
                        echo esc_html__( 'Support', 'maintenance-notice' );
                    echo '</a>';
                echo '</div>';
            echo '</div>';

            echo '<div class="cvmn-admin-fields">';
                echo esc_html__( 'WPAllresources is a completely free online WordPress resources offers genuine and useful content helps to build your WordPress knowledge with us including tutorials, reviews, and many more.', 'maintenance-notice' );
                echo '<div class="cvmn-main-btn">';
                    echo '<a class="button-primary" href="'.esc_url( 'https://wpallresources.com/' ).'" target="_blank">';
                        echo esc_html__( 'Wpallresources', 'maintenance-notice' );
                    echo '</a>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    ?>
</div><!-- .cvmn-help -->