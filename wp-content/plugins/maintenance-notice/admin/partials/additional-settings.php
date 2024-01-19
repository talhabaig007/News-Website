<?php
/**
 * Content for additional settings section in admin area.
 *
 * @package Maintenance Notice
 * @since 1.0.0
 * 
 */
if ( isset( $_POST['cvmn_submit'] ) ) {
    $maintenance_notice_options = get_option( 'maintenance_notice_options' );
    $cvmn_form_values = array(
        'cvmn_social_icons_display' => sanitize_text_field( $_POST['cvmn_social_icons_display'] ),
        'cvmn_social_icons_array' => stripslashes( $_POST['cvmn_social_icons_array'] ),
        'cvmn_login_form_display' => sanitize_text_field( $_POST['cvmn_login_form_display'] ),
        'cvmn_login_form_title' => sanitize_text_field( $_POST['cvmn_login_form_title'] )
    );
    update_option( 'maintenance_notice_options', wp_parse_args( $cvmn_form_values, $maintenance_notice_options ) );
}

$maintenance_notice_options = get_option( 'maintenance_notice_options' );
// check if value set or not
$cvmn_social_icons_display = isset( $maintenance_notice_options['cvmn_social_icons_display'] ) ? esc_html( $maintenance_notice_options['cvmn_social_icons_display'] ) : 'hide';
$cvmn_social_icons_array = isset( $maintenance_notice_options['cvmn_social_icons_array'] ) ? stripslashes( $maintenance_notice_options['cvmn_social_icons_array'] ) : json_encode( array( array( 'cvmn_social_icons_array_icon' => 'fab fa-facebook-f', 'cvmn_social_icons_array_icon_url' => '#' ) ) );
$cvmn_login_form_display = isset( $maintenance_notice_options['cvmn_login_form_display'] ) ? esc_html( $maintenance_notice_options['cvmn_login_form_display'] ) : 'show';
$cvmn_login_form_title = isset( $maintenance_notice_options['cvmn_login_form_title'] ) ? esc_html( $maintenance_notice_options['cvmn_login_form_title'] ) : esc_html__( 'Log In', 'wp-maagazine-modules' );

$maintenance_notice_admin = new Maintenance_Notice_Admin;
$font_awesome_social_icon_array = $maintenance_notice_admin->font_awesome_social_icon_array();
?>
<div id="cvmn-additional-settings">
    <div class="cvmn-admin-content">
        <header id="cvmn-main-header" class="cvmn-tab-block-wrapper">
            <div class="admin-main-menu nav-tab-wrapper cvmn-nav-tab-wrapper">
                <ul>
                <?php
                    $header_titles = array(
                        "login-settings" => array(
                            "desc" => "Manage login form",
                            "icon" => "cvicon-item cvicon-login"
                        ),
                        "social-settings" => array(
                            "desc" => "Manage social icons",
                            "icon" => "cvicon-item cvicon-social"
                        )
                    );
                    foreach( $header_titles as $header_title => $header_title_val ) {
                ?>
                        <li class="nav-tab cvmn-nav-tab <?php echo esc_html( 'cvmn-'.$header_title ); if ( $header_title == 'login-settings' ) { echo esc_html( ' isActive' ); } ?>">
                            <a href="javascript:void(0)" data-tabId="<?php echo '#cvmn-'.$header_title; ?>"><?php echo str_replace( '-', ' ', $header_title ); ?>
                                <span class="cvmn-nav-sub-title"><?php echo esc_html( $header_title_val['desc'] ); ?></span>
                                <i class="<?php echo esc_html( $header_title_val['icon'] ); ?>"></i>
                            </a>
                        </li>
                <?php
                    }
                ?>
                </ul>
            </div>
        </header>

        <div id="cvmn-main-content" class="cvmn-content-block-wrapper">
            <form id="cvmn-maintenance-notice-options-form" method="POST">
                <div class="cvmn-admin-field-options-wrapper">

                    <!----------------- Login Form Settings ------------------------->
                    <div id="cvmn-login-settings" class="cvmn-admin-field-options-wrapper">
                        <div class="cvmn-admin-single-field">
                            <div class="cvmn-admin-field-heading">
                                <?php esc_html_e( "Login Form Setting", 'maintenance-notice' ); ?>
                                </span>
                            </div>
                            <div class="cvmn-admin-single-field cvmn-admin-toggle-field">
                                <label for="cvmn_login_form_display"><?php esc_html_e( 'Show Login Form', 'maintenance-notice' ); ?></label>
                                <input type="hidden" value="<?php echo esc_attr( $cvmn_login_form_display ); ?>" name="cvmn_login_form_display"/>
                                <span class="cvmn-switch <?php if ( $cvmn_login_form_display === 'show' ) echo 'active'; ?>"></span>
                            </div>
                            <div class="cvmn-admin-single-field">
                                <label for="cvmn_login_form_title"><?php esc_html_e( 'Form Title', 'maintenance-notice' ); ?></label>
                                <input type="text" value="<?php echo esc_attr( $cvmn_login_form_title ); ?>" name="cvmn_login_form_title"/>
                            </div>
                        </div>
                    </div><!-- cvmn-admin-field-options-wrapper -->
                    <!----------------- Login Form Settings Ends ------------------------->

                    <!----------------- Social Icons Settings ------------------------->
                    <div id="cvmn-social-settings" class="cvmn-admin-field-options-wrapper" style="display:none">
                        <div class="cvmn-admin-field-heading">
                            <?php esc_html_e( "Social Icons Setting", 'maintenance-notice' ); ?>
                            </span>
                        </div>
                        <div class="cvmn-admin-single-field cvmn-admin-toggle-field">
                            <label for="cvmn_social_icons_display"><?php esc_html_e( 'Show Social Icons', 'maintenance-notice' ); ?></label>
                            <input type="hidden" value="<?php echo esc_attr( $cvmn_social_icons_display ); ?>" name="cvmn_social_icons_display"/>
                            <span class="cvmn-switch <?php if ( $cvmn_social_icons_display === 'show' ) echo 'active'; ?>"></span>
                        </div>
                        <div class="cvmn-admin-single-field cvmn-admin-repeater-field" data-control="cvmn_social_icons_display" data-value="show">
                            <label for=""><?php esc_html_e( 'Social Icons', 'maintenance-notice' ); ?></label>
                            <input class="repeater-value" type="hidden" value="<?php echo esc_html( $cvmn_social_icons_array ); ?>" name="cvmn_social_icons_array"/>
                            <?php
                            $cvmn_social_icons_decoded_array = json_decode( $cvmn_social_icons_array, true );
                                foreach( $cvmn_social_icons_decoded_array as $iconkey => $iconvalue ) {
                            ?>
                                    <div class="cvmn-repeater-single-field">
                                        <div class="cvmn-repeater-row-head">
                                            <h2 class="cvmn-repeater-single-toggleHead"><?php esc_html_e( 'Single Item', 'maintenance-notice' ); ?></h2>
                                            <span class="icon-toggleRow"><i class="fas fa-chevron-down"></i></span>
                                        </div><!-- .cvmn-repeater-row-head -->
                                        <div class="cvmn-cvmn-repeater-single-toggleContent" style="display:none">
                                            <div class="cvmn-repeater-inner-single-item">
                                                <div class="cvmn-item-label">
                                                    <label><?php esc_html_e( 'Select Icon', 'maintenance-notice' ); ?></label>
                                                    <input type="hidden" name="cvmn_social_icons_array_icon" value="<?php echo esc_attr( $iconvalue['cvmn_social_icons_array_icon'] ); ?>"/>
                                                    <div class="cvmn-icon-label">
                                                        <i class="<?php echo esc_attr( $iconvalue['cvmn_social_icons_array_icon'] ); ?>"></i>
                                                        <span class="icon-toggle"><i class="fas fa-chevron-down"></i></span>
                                                    </div>
                                                </div><!-- .cvmn-item-label -->
                                                <div class="cvmn-repeater-single-item-icons-wrap" style="display:none;">
                                                    <?php
                                                        foreach( $font_awesome_social_icon_array as $key => $icon ) {
                                                            if ( $icon == $iconvalue['cvmn_social_icons_array_icon'] ) {
                                                                $is_active = 'isActive';
                                                            } else {
                                                                $is_active = '';
                                                            }
                                                            echo '<span class="cvmn-repeater-single-item-icon '. $is_active .'"><i class="' .esc_attr( $icon ). '"></i></span>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="cvmn-repeater-inner-single-item">
                                                <label><?php esc_html_e( 'Icon Url', '' ); ?></label>
                                                <input type="text" name="cvmn_social_icons_array_icon_url" value="<?php echo esc_url( $iconvalue['cvmn_social_icons_array_icon_url'] ); ?>"/>
                                                <button class="delete-item" data-index="<?php echo esc_attr( $iconkey ); ?>"><?php esc_html_e( 'Delete item', 'maintenance-notice' ); ?></button>
                                            </div>
                                        </div>
                                    </div><!-- .cvmn-repeater-single-field -->
                            <?php
                                }
                            ?>
                            <button class="button cvmn-repeater-add-item"><i class="fas fa-plus"></i><?php esc_html_e( 'Add new', 'maintenance-notice' ); ?></button>
                        </div>
                    </div><!-- cvmn-admin-field-options-wrapper -->
                    <!----------------- Social Icons Settings Ends ------------------------->
                </div><!-- .cvmn-admin-field-options-wrapper -->
                <div class="cvmn-form-button-wrapper">
                    <div class="cvmn-form-button">
                        <input type="submit" name="cvmn_submit" class="button button-primary" data-saving="<?php esc_html_e( 'Saving..', 'maintenance-notice' ); ?>" data-saved="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" data-save="<?php esc_html_e( 'Save Changes', 'maintenance-notice' ); ?>" value="<?php esc_html_e( 'Saved', 'maintenance-notice' ); ?>" disabled="disabled">
                    </div>
                </div>
            </form>
        </div><!-- #cvmn-main-content -->
    </div><!-- .cvmn-admin-content -->
</div><!-- #cvmn-additional-settings -->