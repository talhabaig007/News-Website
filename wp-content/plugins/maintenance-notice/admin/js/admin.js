/**
 * Handles admin scripts.
 */
jQuery(document).ready(function($) {
    "use strict";

    var Ajaxurl = MaintenanceNoticeObject.ajax_url, _wpnonce = MaintenanceNoticeObject._wpnonce, importingString = MaintenanceNoticeObject.importingString, importedString = MaintenanceNoticeObject.importedString;
    //console.log( tinymce.get('cvmn_page_description') );

    /**
     * Show/Hide content with callback function
     * 
     */
    function handle_callback_control_field() {
        var controlFields = $(document).find( ".cvmn-admin-single-field" );
        controlFields.each(function( index, controlField ) {
            var callbackControlName = $( this ).data( "control" );
            if( typeof callbackControlName !== "undefined" ) {
                var callbackControlValue = $( this ).data( "value" ), currentValue = $( "[name=" + callbackControlName + "]" ).val();
                if( callbackControlValue !== currentValue ) {
                    $( this ).hide( 'toggle' );
                } else {
                    $( this ).show( 'toggle' );
                }
            }
        });
    }
    handle_callback_control_field();

    /**
     * Main tabs trigger
     */
    function admin_page_main_nav_trigger() {
        var last_segment = window.location.hash.substr(1);
        if( last_segment == '' ) {
            return;
        }
        $( ".cvmn-nav-tab-wrapper ul li." + last_segment ).siblings().removeClass( "isActive" );
        $( ".cvmn-nav-tab-wrapper ul li." + last_segment ).addClass( "isActive" );
        $( "#cvmn-main-content #" + last_segment ).siblings().hide();
        $( "#cvmn-main-content #" + last_segment ).show();
    }
    admin_page_main_nav_trigger();

    $( "#cvmn-main-header .cvmn-nav-tab-wrapper ul li" ).on( 'click', function() {
        var dis = $(this);
        dis.siblings().removeClass( "isActive" );
        dis.addClass( "isActive" );
        var content_attr = dis.find("a").attr("data-tabId");
        var main_content = $( "#cvmn-main-content " + content_attr );
        main_content.siblings().hide();
        main_content.show();
    });

    /**
     * Restore save button on input field change
     * 
     */
    $( '#cvmn-maintenance-notice-options-form input, #cvmn-maintenance-notice-options-form select' ).on( 'keyup change paste', function() {
        trigger_submit_button()
        handle_callback_control_field()
    });

    /**
     * On font family select
     * 
     */
    $( '#cvmn-maintenance-notice-options-form .cvmn-admin-font-family-field select' ).on( 'change', function() {
        var _this = $(this), value = _this.val(), container = _this.parent( '.cvmn-admin-font-family-field' ).next().find('select');
        $.ajax({
            url: Ajaxurl,
            method: 'post',
            action: '',
            data: {
                action: 'cvmn_get_font_variant',
                _wpnonce: _wpnonce,
                font_family: value
            },
            success: function( response ) {
                if( response ) {
                    container.html(response);
                }
            }
        });
    });

    /**
     * Embed color control field
     * 
     */
    $( ".cvmn-admin-color-field" ).wpColorPicker({
        change: function() {
            trigger_submit_button()
        },
        clear: function() {
            trigger_submit_button()
        },
        palettes: true
    });


    /**
     * Media upload field
     * 
     */
    function add_remove_image_button() {
        var src, container = $( '.cvmn-meta-upload-field' );
        src = container.find( 'img' ).attr( 'src' );
        if( src == '' ) {
            container.find( '#cvmn-media-remove-btn' ).hide();
        } else {
            container.find( '#cvmn-media-remove-btn' ).show();
        }
    }
    add_remove_image_button();

    function triggerUploadButton() {
        $( '.cvmn-meta-upload-field #cvmn-media-upload-btn' ).on( 'click', function(e) {
            e.preventDefault();
            var button = $(this),
            mt_uploader = wp.media({
                title: 'Image',
                library : {
                    //uploadedTo : wp.media.view.settings.post.id,
                    type : 'image'
                },
                button: {
                    text: 'Use this image'
                },
                multiple: false
            }).on( 'select', function() {
                var attachment = mt_uploader.state().get( 'selection' ).first().toJSON();
                button.closest( '.cvmn-meta-upload-field' ).find( 'input[type="hidden"]' ).val( attachment.url );
                button.closest( '.cvmn-meta-upload-field' ).find( '.placeholder' ).addClass( 'hidden' );
                button.closest( '.cvmn-meta-upload-field' ).find( '.cvmn-thumbnail' ).html('<img src="'+ attachment.url +'" style="width:60px;"/>');
                
                add_remove_image_button();
                trigger_submit_button()
                update_repeater_value( button )
            })
            .open();
        });
    }
    triggerUploadButton();

    $( '.cvmn-meta-upload-field #cvmn-media-remove-btn' ).on( 'click', function(e) {
    	e.preventDefault();
        $(this).closest( '.cvmn-meta-upload-field' ).find( 'input[type="hidden"]' ).val( '' );
        $(this).closest( '.cvmn-meta-upload-field' ).find( '.placeholder' ).removeClass( 'hidden' );
        $(this).closest( '.cvmn-meta-upload-field' ).find( '.cvmn-thumbnail' ).html('');
        trigger_submit_button();
        add_remove_image_button();
    });

    /**
     * Toggle control field
     * 
     * 
     */
    $( ".cvmn-admin-toggle-field .cvmn-switch" ).on( "click", function() {
        var _this = $(this), val = _this.prev( "input" ).val();
        _this.prev( "input" ).val( val === "show" ? "hide" : "show" );
        _this.toggleClass( "active" );
        handle_callback_control_field();
        trigger_submit_button()
    });

    /**
     * Trigger submit button change 
     * 
     * 
     */
    function trigger_submit_button() {
        var formButton = $( '#cvmn-maintenance-notice-options-form input[name="cvmn_submit"]' );
        var saveText = formButton.data( "save" );
        formButton.removeAttr( "disabled" );
        formButton.val( saveText );
    }

    /********************************************************************
                        Repeater control field handler
     *********************************************************************/
    $( ".cvmn-repeater-add-item" ).on( "click", function(e) {
        e.preventDefault();
        var _this = $(this), _prevDiv = _this.prev( ".cvmn-repeater-single-field" ), appendHtml = _prevDiv.clone(), prevIndex;
        _prevDiv.after( appendHtml );
        appendHtml.find( "button.delete-item" ).removeAttr( "style" );
        prevIndex = appendHtml.find( "button.delete-item" ).data( "index" );
        appendHtml.find( "button.delete-item" ).attr( "data-index", prevIndex + 1  );
        triggerUploadButton();
        triggerRepeaterInputFieldChange();
        triggerIconSelect();
        trigger_submit_button();
        if( ! _this.prev().find( ".cvmn-repeater-row-head" ).hasClass( "isActive" ) ) {
            _this.prev().find( ".cvmn-repeater-row-head" ).trigger( "click" );
        }
    });

    /**
     * Toggle icons content on icon toggle button
     * 
     */
    function toggleRepeaterIconContent() {
        $( document ).on( "click", ".icon-toggle", function(e) {
            e.preventDefault()
            var _this = $(this),
            _thisParent = _this.parents( ".cvmn-item-label" );
            _this.find( "i" ).toggleClass( "fas fa-chevron-down" ).toggleClass( "fas fa-chevron-up" )
            _thisParent.next( ".cvmn-repeater-single-item-icons-wrap" ).toggle("slide")
        });
    }
    toggleRepeaterIconContent();

    /**
     * Toggle repeater row content
     * 
     */
    function toggleRepeaterRowContent() {
        $(document).on( "click", ".cvmn-repeater-row-head",  function(e) {
            e.preventDefault();
            var _this = $(this);
            _this.toggleClass( "isActive" );
            _this.find( ".icon-toggleRow i" ).toggleClass( "fas fa-chevron-down" ).toggleClass( "fas fa-chevron-up" )
            _this.next( ".cvmn-cvmn-repeater-single-toggleContent" ).toggle("slide")
        });
    }
    toggleRepeaterRowContent()

    /**
     * Select icon from icon selector and assign active icon
     * 
     */
    function triggerIconSelect() {
        $( '.cvmn-repeater-single-item-icon' ).on( "click", function(e) {
            e.preventDefault();
            var _this = $( this );
            _this.siblings().removeClass( "isActive" );
            _this.addClass( "isActive" );
            var iconClass = _this.find( "i" ).attr( "class" ),
            mainParent = _this.parents( ".cvmn-repeater-single-item-icons-wrap" ),
            ancesterParent = mainParent.parents( ".cvmn-repeater-inner-single-item" );
            $( ancesterParent ).find( ".cvmn-icon-label>i" ).removeClass().addClass( iconClass );
            $( ancesterParent ).find( ".cvmn-item-label input" ).val( iconClass );

            // update repeater field value
            update_repeater_value( _this );

            //trigger submit button
            trigger_submit_button();
        });
    }
    triggerIconSelect()

    function triggerRepeaterInputFieldChange() {
        $( '.cvmn-repeater-inner-single-item input' ).on( "change", function(e) {
            e.preventDefault();
            var _this = $( this );
            // update repeater field value
            update_repeater_value( _this );

            //trigger submit button
            trigger_submit_button();
        });
    }
    triggerRepeaterInputFieldChange();

    /**
     * Update the repeater field input value to before form submit
     * 
     */
    function update_repeater_value( _this ) {
        var mainContainer = _this.parents( ".cvmn-admin-repeater-field" ), singleRow = mainContainer.find( ".cvmn-repeater-single-field" ), valueToAssign = mainContainer.find( "input.repeater-value" ), finalValue = [];
        if( mainContainer.length === 0 ) {
            return;
        }
        singleRow.each( function() {
            var fields = $(this).find( ".cvmn-repeater-inner-single-item" ), singleValue = {};
            fields.each( function() {
                var value = $( this ).find( "input" ).val(), name = $( this ).find( "input" ).attr( "name" );
                singleValue[name] = value;
            });
            finalValue.push( singleValue );
        });
        valueToAssign.val( JSON.stringify( finalValue ) )
    }

    /**
     * Repeater field delete item
     * 
     */
    function delete_repeater_row() {
        $(document).on( "click", ".cvmn-admin-repeater-field .delete-item", function(e) {
            e.preventDefault();
            var _this = $(this),
            index = _this.data( "index" ),
            removeItem = _this.parents( ".cvmn-repeater-single-field" ),
            parentElement = _this.parents( ".cvmn-admin-repeater-field" ),
            prevValue = parentElement.find( "input.repeater-value" ).val(),
            newValue = JSON.parse( prevValue ).splice( index, 1 );
            parentElement.find( "input.repeater-value" ).val( JSON.stringify( newValue ) );
            removeItem.remove();
            trigger_submit_button();
        });
    }
    delete_repeater_row();
    /********************************************************************
                        Repeater control field handler Ends
     *********************************************************************/

    /********************************************************************
                        Radio Image field handler
    *********************************************************************/
    $( ".cvmn-radio-image-field" ).each(function() {
        var __this = $( this ), singleField = __this.find( 'span' );
        singleField.on( "click", "img", function() {
        var singleFieldParent = $( this ).parent( "span" )
        var activeValue = singleFieldParent.data( "value" );
        __this.find( "input" ).val( activeValue );
        singleFieldParent.addClass( "isActive" ).siblings().removeClass( "isActive" );
        trigger_submit_button()
       });
    });
    /********************************************************************
                        Radio Image field handler Ends
    *********************************************************************/

    // Range field
    $( ".cvmn-admin-range-field" ).each(function() {
        var __this = $( this ), singleField = __this.find( 'input' );
        singleField.on( "change", function() {
            var singleFieldNext = $( this ).next( "span" )
            var activeValue = $(this).val();
            singleFieldNext.html( activeValue + 'px' );
            trigger_submit_button();
       });
    });

    /**
     * Repeater Row toggle content
     * 
     */
    $( ".cvmn-typography-row" ).each(function() {
        var this_ = $( this ), clickHeader = this_.find( ".typography-heading" );
        clickHeader.on( "click", function() {
            $(this).find( ".row-toggle" ).toggleClass( "dashicons-arrow-down" ).toggleClass( "dashicons-arrow-up" );
            this_.siblings().find( ".typography-row-content" ).hide();
            $(this).next( ".typography-row-content" ).slideToggle('slow');
        });
    });

    /**
     * Escape html characters
     * 
     */
    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };    
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }


    /********************************************************************
                        Import Template Process Handler
    *********************************************************************/
        /**
         * On click import template button
         * 
         */
        $( ".cvmn-template-import" ).each(function() {
            $(this).on( "click", function(e) {
                e.preventDefault();
                var _importthis = $(this), template = _importthis.data( "template" ), ajaxAction = _importthis.data( "action" );
                $.ajax({
                    method: 'POST',
                    url: Ajaxurl,
                    data: {
                        'action': ajaxAction,
                        '_wpnonce': _wpnonce,
                        'template': template
                    },
                    beforeSend: function() {
                        _importthis.addClass( "updating-message" ).html( importingString );
                    },
                    success: function(response) {
                        _importthis.removeClass( "updating-message" ).html( importedString );
                        console.log( response )
                    }
                });
            });
        });
    /********************************************************************
                        Import Template Process Handler Ends
    *********************************************************************/

    /**
     * Repeater field icons listing search script.
     * 
     */
    $(document).on( 'keyup change paste', '.cvmn-icons-search input', function (e) {
        var _this = $(this), search_term = _this.val().toUpperCase(), 
        container = _this.parent( '.cvmn-icons-search' ).next().find( 'span' );
        container.each(function() {
            search_term = search_term.toUpperCase();
            var icon_title = $(this).find( 'i' ).attr( 'class' ).toUpperCase();

            if ( icon_title.indexOf( search_term ) > -1 ) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

});