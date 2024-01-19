/**
 * Get Started button on dashboard notice.
 *
 * @package Azure News
 */

jQuery(document).ready(function($) {
    var WpAjaxurl = azAdminObject.ajax_url;
    var _wpnonce = azAdminObject._wpnonce;
    var buttonStatus = azAdminObject.buttonStatus;

    /**
     * Popup on click demo import if codevibrant demo importer plugin is not activated.
     */
    if( buttonStatus === 'disable' ) $( '.azure-news-demo-import' ).addClass( 'disabled' );

    switch( buttonStatus ) {
        case 'activate' :
            $( '.azure-news-get-started' ).on( 'click', function() {
                var _this = $( this );
                azure_news_do_plugin( 'azure_news_activate_plugin', _this );
            });
            $( '.azure-news-activate-demo-import-plugin' ).on( 'click', function() {
                var _this = $( this );
                azure_news_do_plugin( 'azure_news_activate_plugin', _this );
            });
            break;
        case 'install' :
            $( '.azure-news-get-started' ).on( 'click', function() {
                var _this = $( this );
                azure_news_do_plugin( 'azure_news_install_plugin', _this );
            });
            $( '.azure-news-install-demo-import-plugin' ).on( 'click', function() {
                var _this = $( this );
                azure_news_do_plugin( 'azure_news_install_plugin', _this );
            });
            break;
        case 'redirect' :
            $( '.azure-news-get-started' ).on( 'click', function() {
                var _this = $( this );
                location.href = _this.data( 'redirect' );
            });
            break;
    }

    azure_news_do_plugin = function ( ajax_action, _this ) {
        $.ajax({
            method : "POST",
            url : WpAjaxurl,
            data : ({
                'action' : ajax_action,
                '_wpnonce' : _wpnonce
            }),
            beforeSend: function() {
                var loadingTxt = _this.data( 'process' );
                _this.addClass( 'updating-message' ).text( loadingTxt );
            },
            success: function( response ) {
                if( response.success ) {
                    var loadedTxt = _this.data( 'done' );
                    _this.removeClass( 'updating-message' ).text( loadedTxt );
                    console.log( response.data.message );
                } else {
                    console.log( response.data.message );
                }
                location.href = _this.data( 'redirect' );
            }
        });
    }

    $('.cv-plugin-action').on('click', function(e){
        e.preventDefault();
        var _this = $( this ), btnAction = $(this).data('action'), pluginSlug = $(this).data('slug');
        switch( btnAction ) {
            case 'activate' :
                azure_news_do_free_plugin( 'azure_news_activate_free_plugin', _this, pluginSlug );
                break;
            case 'install' :
                azure_news_do_free_plugin( 'azure_news_install_free_plugin', _this, pluginSlug );
                break;
        }

    });
    
    azure_news_do_free_plugin = function ( ajax_action, _this, slug ) {
        $.ajax({
            method : "POST",
            url : WpAjaxurl,
            data : ({
                'action'    : ajax_action,
                '_wpnonce'  : _wpnonce,
                'plugin'    : slug,
            }),
            beforeSend: function() {
                var loadingTxt = _this.data( 'process' );
                _this.addClass( 'updating-message' ).text( loadingTxt );
            },
            success: function( response ) {
                if( response.success ) {
                    var loadedTxt = _this.data( 'done' );
                    _this.removeClass( 'updating-message' ).text( loadedTxt );
                    console.log( response.data.message );
                } else {
                    console.log( response.data.message );
                }
                location.href = _this.data( 'redirect' );
            }
        });
    }

    $('.ocdi__gl-item').each(function(){
        var _this = $(this), getName = _this.data('name'), checkStr = 'pro';

        if ( getName.indexOf(checkStr) != -1 ) {
            _this.find('a.ocdi__gl-item-button.button-primary').attr("href", "https://demo.codevibrant.com/azure-demo/");
            _this.find('a.ocdi__gl-item-button.button-primary').attr("target","_blank");
            _this.find('a.ocdi__gl-item-button.button-primary').text('Buy Now');
        }
    });

});