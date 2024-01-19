<?php
/**
 * The template for displaying the maintenance page.
 *
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
$maintenance_notice_options = get_option( 'maintenance_notice_options' );
extract( $maintenance_notice_options );

$body_classes = 'maintenance-mode-active ';
if ( $cvmn_maintenance_page_background_type ) {
    $body_classes .= 'background--' .esc_html( $cvmn_maintenance_page_background_type );
}

if ( $cvmn_background_overlay_type ) {
    $body_classes .= ' background-overlay--' .esc_html( $cvmn_background_overlay_type );
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html( $cvmn_page_title ); ?></title>
    <?php
        /**
         * Load page scripts
         * 
         * @parent_class - Maintenance_Notice()
         * @hooked - load_styles
         * 
         */
        wp_head();
        do_action( 'cvmn_load_styles' );
    ?>
</head>
<body class="<?php echo esc_attr( $body_classes ); ?>">

    <?php
        /**
         * Before page hook
         * 
         * @since 1.0.0
         */
        do_action( 'cvmn_before_page' );

        switch( $cvmn_maintenance_page_background_type ) {
            default: include MAINTENANCE_NOTICE_INCLUDES_PATH . '/layouts/style-one.php';
                    break;
        }

        /**
         * After page hook
         * 
         * @since 1.0.0
         */
        do_action( 'cvmn_before_page' );
        
        wp_footer();
    ?>
    
</body>
</html>