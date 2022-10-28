$(function () {

    $(document).ready(function () {

    });
    $('[href="#"]').attr("href", "javascript:;");
    //*****************************
    // Match Height Functions
    //*****************************
    $('.matchheight').matchHeight();

    //*****************************
    // Request Popup Form
    //*****************************
    $('.tableTabs li').click(function () {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
    });

    // $('#more-content-link').click(function () {
    //     $(this).toggleClass('active');
    //     $('span.more_content').slideToggle('');
    // });

    // $('.overlay-menu').click(function () {
    //     $('.nav-btn').children('span.lines').toggleClass('active');
    //     $('.burgerMenu').slideToggle('');
    //     $('.overlay-menu').fadeOut();
    // });

    $(document).ready(function () {

        /* Hamburger menu animation */
        $('.open-button').click(function () {
            $(this).toggleClass('open');
        });

        /* Menu fade/in out on mobile */
        $(".open-button").click(function (e) {
            e.preventDefault();
            $(".mobile-menu").toggleClass('open');
        });

    });
    //*****************************
    // Tabbing
    //*****************************
    // $('.tabbing-link li').first().addClass('current');
    // $('.tabbing-content .tab-content').first().addClass('current');

    // $('.tabbing-link li').click(function () {
    //     $('.tabbing-link li').removeClass('current');
    //     $('.tabbing-content .tab-content').removeClass('current');
    //     $(this).addClass('current');
    //     var tab_id = $(this).index();
    //     tab_id += 1;
    //     $('.tabbing-content .tab-content:nth-child(' + tab_id + ')').addClass('current');
    // });
    // $(document).ready(function () {

    //     if ($(window).width() < 992) {
    //         $('.single_gallery-slider').removeClass('single_slider-dna');
    //         $('.single_gallery-slider').addClass('dots-n-arrow');
    //     }
    // });

    if ($(window).width() < 786) {
        // mobile nav
        $('.mainnav > li > a').click(function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).parents('li').children('.sub-menu').slideUp();
            } else {
                $('.menu-item-has-children > a').removeAttr("href");
                $(this).addClass('active');
                $(this).parents('li').children('.sub-menu').slideDown();
                $(this).parents('li').siblings('li').children('a').removeClass('active');
                $(this).parents('li').siblings('li').children('.sub-menu').slideUp();
            }
        });

        $('.mainnav > li > ul > li > a').click(function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).siblings('.sub-menu').slideUp();
            } else {
                $(this).addClass('active');
                $(this).parents('li').children('.sub-menu').slideDown();
                $(this).parents('li').siblings('li').children('a').removeClass('active');
                $(this).parents('li').siblings('li').children('.sub-menu').slideUp();
            }
        });

        $('.mainnav > li > ul > li > ul > li > a').click(function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).siblings('.sub-menu').slideUp();
            } else {
                $(this).addClass('active');
                $(this).parents('li').children('.sub-menu').slideDown();
                $(this).parents('li').siblings('li').children('a').removeClass('active');
                $(this).parents('li').siblings('li').children('.sub-menu').slideUp();
            }
        });

    }
    else {

    }
    //*****************************
    // Slick Slider
    //****************************
    
    //*****************************
    // Mobile Navigation
    //*****************************
    $('.overlay-menu').click(function () {
        $('.overlay-menu').fadeToggle();
    });
    $('.mobile-nav-btn').click(function () {
        $('.mobile-nav-btn, .mobile-nav, .app-container, body').toggleClass('active');
        $('.overlay-menu').fadeToggle();

        $(document).mouseup(function (e) {
            var container = $(".mobile-nav, .mobile-nav-btn");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $('.mobile-nav-btn, .mobile-nav, .app-container').removeClass('active');
            }
        });
    });


    //*****************************
    // Responsive Slider
    //*****************************
    var tabrespsliders = {
        1: { slider: '.difference-slider' }
    };

    //*****************************
    // Responsive Slider
    //*****************************
    var respsliders = {
        1: { slider: '.res-slider' }

    };
    //*****************************
    // Function for Responsive Slider 991
    //*****************************

    $.each(tabrespsliders, function () {

        $(this.slider).slick({
            arrows: false,
            dots: true,
            autoplay: true,
            slidesToShow: 2,
            settings: "unslick",
            responsive: [
                {
                    breakpoint: 2000,
                    settings: "unslick"
                },
                {
                    breakpoint: 991,
                    settings: {
                        unslick: true
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        unslick: true
                    }
                }
            ]
        });
    });


    //*****************************
    // Function for Responsive Slider 767
    //*****************************

    $.each(respsliders, function () {

        $(this.slider).slick({
            arrows: false,
            dots: true,
            autoplay: true,
            settings: "unslick",
            responsive: [
                {
                    breakpoint: 2000,
                    settings: "unslick"
                },
                {
                    breakpoint: 767,
                    settings: {
                        unslick: true
                    }
                }
            ]
        });
    });


});