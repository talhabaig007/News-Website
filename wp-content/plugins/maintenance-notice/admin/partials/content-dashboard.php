<?php
/**
 * Content for dashboard section in admin area.
 *
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
if ( isset( $_POST['cvmn_submit'] ) ) {
    $maintenance_notice_options = get_option( 'maintenance_notice_options' );
    $cvmn_form_values = array(
        'cvmn_maintenance_page_display' => sanitize_text_field( $_POST['cvmn_maintenance_page_display'] )
    );
    update_option( 'maintenance_notice_options', wp_parse_args( $cvmn_form_values, $maintenance_notice_options ) );
}

if ( isset( $_POST['cvmn_reset'] ) ) {
    $maintenance_notice_admin = new Maintenance_Notice_Admin();
    $default_values = $maintenance_notice_admin->default_values();
    update_option( 'maintenance_notice_options', $default_values );
}

$maintenance_notice_options = get_option( 'maintenance_notice_options' );
// check if value set or not
$cvmn_maintenance_page_display = isset( $maintenance_notice_options['cvmn_maintenance_page_display'] ) ? esc_html( $maintenance_notice_options['cvmn_maintenance_page_display'] ) : 'hide';
?>
<div id="cvmn-dashboard">
    <h2 class="cvmn-admin-title">
        <?php
            esc_html_e( 'Get Started with Maintenance Notice', 'maintenance-notice' );
        ?>
    </h2><!-- .cvmn-admin-title -->
    <div class="cvmn-admin-desc">
        <?php
            esc_html_e( 'Maintenance Notice is the plugin for all site', 'maintenance-notice' );
        ?>
        <div class="cvmn-admin-content">
            <div class="cvmn-admin-settings-tab">
                <div class="cvmn-admin-group-fields">
                    <form id="cvmn-maintenance-notice-options-form" method="POST">
                        <div class="cvmn-admin-field-options-wrapper">
                            <div class="cvmn-admin-single-field cvmn-admin-toggle-field">
                                <label for="cvmn_maintenance_page_display"><?php esc_html_e( 'Enable maintenance mode', 'maintenance-notice' ); ?></label>
                                <p class="cvmn-admin-description"><?php esc_html_e( 'Display your website as the maintenance mode. Hidding all the other website content', 'maintenance-notice' ); ?></p>
                                <input type="hidden" value="<?php echo esc_attr( $cvmn_maintenance_page_display ); ?>" name="cvmn_maintenance_page_display"/>
                                <span class="cvmn-switch <?php if ( $cvmn_maintenance_page_display === 'show' ) echo 'active'; ?>"></span>
                            </div>
                            <div class="cvmn-admin-single-field cvmn-preview-button">
                                <p class="cvmn-admin-description"><?php esc_html_e( 'Preview the maintenance mode without enabling the mode in your website', 'maintenance-notice' ); ?></p>
                                <a href="<?php echo home_url('/?cvmn-maintenance-preview'); ?>" target="_blank"><?php esc_html_e( 'Preview', 'maintenance-notice' ); ?></a>
                            </div>
                            <div class="cvmn-form-button-wrapper">
                                <div class="cvmn-form-button">
                                    <input type="submit" name="cvmn_submit" class="button button-primary" data-saving="<?php esc_html_e( 'Saving..', 'maintenance-notice' ); ?>" data-saved="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" data-save="<?php esc_html_e( 'Save Changes', 'maintenance-notice' ); ?>" value="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" disabled="disabled">
                                </div>

                                <div class="cvmn-form-button">
                                    <input type="submit" name="cvmn_reset" class="button button-primary" value="<?php esc_html_e( 'Reset settings', 'maintenance-notice' ); ?>">
                                </div>

                            </div>
                        </div><!-- .cvmn-admin-field-options-wrapper -->
                    </form>                    
                </div><!-- .cvmn-admin-group-fields -->
            </div><!-- .cvmn-admin-settings-tab -->
        </div><!-- .cvmn-admin-content -->

    </div><!-- .cvmn-admin-desc -->
</div><!-- .cvmn-dashboard -->