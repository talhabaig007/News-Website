/**
 * Files to manage theme scripts.
 *
 * @package Azure News
 */

jQuery(document).ready(function($) {

    var headerSticky = OG_JSObject.header_sticky,
        sidebarSticky = OG_JSObject.sidebar_sticky,
        KEYCODE_TAB = 9;

    var rtl = false;
    var dir = "left";
    if ($('body').hasClass("rtl")) {
        rtl = true;
        dir = "right";
    };

    /**
     * Preloader
     */
    if ($('#azure-news-preloader').length > 0) {
        setTimeout(function() {
            $('#azure-news-preloader').hide();
        }, 600);
    }

    // top header time
    var timeElement = $(".top-header-date-wrap .time")
    if (timeElement.length > 0) {
        setInterval(function() {
            timeElement.html(new Date().toLocaleTimeString())
        }, 1000);
    }

    /**
     * Default widget tabbed
     */
    $("#banner-tabbed").tabs();

    // site mode switcher
    function siteModeToggle(siteModeVal) {
        $.removeCookie('azure-news-site-mode-cookie', {
            path: '/'
        });
        if (siteModeVal === 'light-mode') {
            updateVal = 'dark-mode';
        } else {
            updateVal = 'light-mode';
        }
        $("#mode-switcher").removeClass(siteModeVal);
        $("#mode-switcher").addClass(updateVal);
        $('body').removeClass(siteModeVal);
        $('body').addClass(updateVal);
        var exDate = new Date();
        exDate.setTime(exDate.getTime() + (3600 * 1000)); // expire in 1 hr
        $.cookie('azure-news-site-mode-cookie', updateVal, {
            expires: exDate,
            path: '/'
        });
    }

    $("#mode-switcher").click(function(event) {
        event.preventDefault();
        var siteModeClass = $(this).attr('class');
        siteModeAttr = $(this).data('site-mode');

        if ($(this).hasClass(siteModeAttr)) {
            siteModeToggle(siteModeAttr);
        } else {
            siteModeToggle(siteModeClass);
        }
    });

    /**
     * Scripts for Header Sticky Sidebar
     */
    $('.sidebar-menu-toggle').click(function() {
        $('.sticky-header-sidebar').toggleClass('isActive');
    });

    $('.sticky-sidebar-close,.sticky-header-sidebar-overlay').click(function() {
        $('.sticky-header-sidebar').removeClass('isActive');

    });

    // header news ticker
    $('.ticker-posts').marquee({
        duration: 50000,
        delayBeforeStart: 0,
        gap: 0,
        direction: dir,
        duplicated: true,
        startVisible: true,
        pauseOnHover: true,
    });

    // main banner slider
    var mainSlider = $(".azure-news-banner-wrapper");
    if (mainSlider.length) {
        var secSlider = mainSlider.find(".slider-wrapper");
        // var slideAuto = secSlider.data( "auto" );
        var slideControl = secSlider.data("control");
        secSlider.lightSlider({
            item: 1,
            //auto: true,
            pager: false,
            loop: true,
            slideMargin: 0,
            speed: 1000,
            pause: 6000,
            enableTouch: true,
            rtl: rtl,
            enableDrag: true,
            pauseOnHover: true,
            prevHtml: '<i class="bx bx-chevron-left"></i>',
            nextHtml: '<i class="bx bx-chevron-right"></i>',
            onSliderLoad: function() {
                $('.slider-wrapper').removeClass('cS-hidden');
            }
        });
    }

    // carousel trending posts
    $('.trending-posts-wrapper .trending-posts').lightSlider({
        item: 4,
        auto: true,
        pager: false,
        loop: true,
        slideMargin: 0,
        vertical: true,
        speed: 1000,
        pause: 6000,
        enableTouch: true,
        rtl: false,
        enableDrag: true,
        pauseOnHover: true,
        prevHtml: '<i class="bx bx-chevron-up"></i>',
        nextHtml: '<i class="bx bx-chevron-down"></i>',
        onSliderLoad: function() {
            $('.trending-posts').removeClass('cS-hidden');
        }
    });

    /**
     * Settings of the header sticky menu
     */
    if ('true' === headerSticky) {
        var windowWidth = $(window).width();
        if (windowWidth > 600) {
            var wpAdminBar = $('#wpadminbar');
            if (wpAdminBar.length) {
                $("#masthead .bottom-header-wrapper").sticky({
                    topSpacing: wpAdminBar.height()
                });
            } else {
                $("#masthead .bottom-header-wrapper").sticky({
                    topSpacing: 0
                });
            }
        }
    }

    /**
     * theia sticky sidebar
     */

    if ('true' === sidebarSticky) {
        $('#primary, #secondary').theiaStickySidebar({
            additionalMarginTop: 30
        });

        $('#primary, #left-secondary').theiaStickySidebar({
            additionalMarginTop: 30
        });

        $('.primary-content-wrapper, .secondary-content-wrapper').theiaStickySidebar({
            additionalMarginTop: 30
        });
    }


    /**
     * Scroll To Top
     */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1000) {
            $('#azure-news-scrollup').fadeIn('slow');
        } else {
            $('#azure-news-scrollup').fadeOut('slow');
        }
    });
    $('#azure-news-scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    //Search toggle
    $('.header-search-wrapper .search-icon').click(function() {
        $('.search-form-wrap').toggleClass('active-search');
        $('.search-form-wrap .search-field').focus();
        var element = document.querySelector('.header-search-wrapper');
        if (element) {
            $(document).on('keydown', function(e) {
                if (element.querySelectorAll('.search-form-wrap.active-search').length === 1) {
                    var focusable = element.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                    var firstFocusable = focusable[0];
                    var lastFocusable = focusable[focusable.length - 1];
                    azure_news_focus_trap(firstFocusable, lastFocusable, e);
                }
            })
        }
    });

    $('.header-search-wrapper .search-icon-close').click(function() {
        $('.search-form-wrap').removeClass('active-search');
    });

    //responsive menu toggle
    $('.bottom-header-wrapper .azure-news-menu-toogle').click(function(event) {
        $('#site-navigation .primary-menu-wrap').toggleClass('isActive').slideToggle('slow');
        var element = document.querySelector('.bottom-header-wrapper');
        if (element) {
            $(document).on('keydown', function(e) {
                if (element.querySelectorAll('#site-navigation .primary-menu-wrap.isActive').length === 1) {
                    var focusable = element.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                    var firstFocusable = focusable[0];
                    var lastFocusable = focusable[focusable.length - 1];
                    azure_news_focus_trap(firstFocusable, lastFocusable, e);
                }
            })
        }
    });

    //responsive sub menu toggle
    $('<a class="azure-news-sub-toggle" href="javascript:void(0);"><i class="bx bx-chevron-down"></i></a>').insertAfter('#site-navigation .menu-item-has-children>a, #site-navigation .page_item_has_children>a');

    $('#site-navigation .azure-news-sub-toggle').click(function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
        $(this).children('.bx-chevron-up').first().toggleClass('bx-chevron-down');
    });

    /**
     * focus trap
     *
     * @returns void
     * @since 1.0.0
     */
    function azure_news_focus_trap( firstFocusable, lastFocusable, e ) {
        if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
            if ( e.shiftKey ) /* shift + tab */ {
                if (document.activeElement === firstFocusable) {
                    lastFocusable.focus();
                    e.preventDefault();
                }
            } else /* tab */ {
                if ( document.activeElement === lastFocusable ) {
                    firstFocusable.focus();
                    e.preventDefault();
                }
            }
        }
    }

});

