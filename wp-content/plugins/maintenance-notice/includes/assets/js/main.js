/**
 * Javascript handler for frontend
 * 
 */
 jQuery(document).ready(function($) {

    "use strict"

    /**
     * Login form toggle content
     * 
     */
    $( "#cvmn-login-trigger" ).on( "click", function(e) {
        var _this = $( this );
        _this.find( "i" ).toggleClass( "fas fa-cog" ).toggleClass( "fas fa-times" );
        _this.parent( ".cvmn-login-main-wrapper" ).toggleClass( "isActive" );
    });

    /**
     * Toggle sidebar
     * 
     */
    $( ".cvmn-header-toggle-trigger" ).on( "click", function(e) {
        e.preventDefault();
        var _this = $(this)
        _this.next( ".cvmn-header-toggle-content" ).addClass( "isActive" );
        $(document).find( ".page-content" ).addClass( "side-toggle--active" );
    });

    $( document ).find( ".cvmn-header-toggle-content-close" ).on( "click", function(e) {
        e.preventDefault();
        $( this ).parent( ".cvmn-header-toggle-content" ).removeClass( "isActive" );
        $(document).find( ".page-content" ).removeClass( "side-toggle--active" );
    });

    /**
     * Video background player
     * 
     */
    if( cvmnObject.bgVideo === 'true' ) {
        $("#cvmn-bgVideo").YTPlayer({
            containment: 'body',
            showControls: false,
            ratio: 'auto',
            loop: true,
            mute: true,
            startAt: 0,
            stopAt: 0,
            autoPlay: true,
            optimizeDisplay: true,
            quality: 'auto',
            showYTLogo: false,
            anchor: 'center,top',
            useOnMobile: false,
        });
    }

    /**
     * Countdown js
     * 
     */
    var countDownContainer = $( '.cvmn-countdown-content' );
    if( countDownContainer.length !== 0 ) {
        countDownContainer.each(function() {
            var _this = $( this ), countdownDate = _this.data( 'date' ), countdownTime = _this.data( 'time' );
            if( typeof countdownDate !== "undefined" || typeof countdownTime !== "undefined" ) {
                _this.countdown({
                    date: countdownDate + ' ' + countdownTime
                },function () {
                    $(  '.cvmn-countdown-content-popup' ).show();
                });
            }
        });
    }


    /**
     * Slick slider events
     * 
     */
    var sliderSelector = $( ".cvmn-fullpage-slider" )
    if( sliderSelector.length !== 0 ) {
        var sliderAuto = ( sliderSelector.data( "auto" ) === "show" ),
        sliderLoop = ( sliderSelector.data( "loop" ) === "show" ),
        sliderSpeed = sliderSelector.data( "speed" ),
        sliderPause = sliderSelector.data( "pause" ),
        sliderFade = sliderSelector.data( "slide" );
        sliderFade = ( sliderFade === 'fade' );
        $( ".cvmn-fullpage-slider" ).slick({
            infinite: sliderLoop,
            dots: false,
            fade: sliderFade,
            arrows: false,
            autoplay: sliderAuto,
            autoplaySpeed: sliderPause,
            speed: sliderSpeed,
            adaptiveHeight: true
        });
    }

});