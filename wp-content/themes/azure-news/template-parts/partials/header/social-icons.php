<?php
/**
 * Partial template to display social icons
 *
 * @package Azure News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$azure_news_social_icons = azure_news_get_customizer_option_value( 'azure_news_social_icons' );
$azure_news_social_icons = json_decode( $azure_news_social_icons );

if ( empty( $azure_news_social_icons ) ) {
    return;
}

$icon_target = '_self';

$azure_news_social_icon_link_target = azure_news_get_customizer_option_value( 'azure_news_social_icon_link_target' );

if ( false !== $azure_news_social_icon_link_target ) {
    $icon_target = '_blank';
}
?>

<ul class="social-icons-wrapper social-icon-margin">
    <?php
        foreach ( $azure_news_social_icons as $social_icon ) {
            if ( 'show' === $social_icon->item_visible ) {
    ?>
                <li class="social-icon">
                    <a href="<?php echo esc_url( $social_icon->social_url ); ?>" target="<?php echo esc_attr( $icon_target ); ?>">
                        <i class="<?php echo esc_attr( $social_icon->social_icon ); ?>"></i>
                    </a>
                </li><!-- .social-icon -->
    <?php
            }
        }
    ?>
</ul><!-- .social-icons-wrapper -->
