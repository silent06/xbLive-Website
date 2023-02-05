/*================
 Template Name: AgencyCo Digital Agency and Marketing
 Description: AgencyCo is digital agency and marketing template.
 Version: 1.0
 Author: https://themeforest.net/user/themetags
 =======================*/

// TABLE OF CONTENTS
// 1. fixed navbar
// 2. page scrolling feature
// 3. closes the responsive menu on menu item click
// 4. magnify popup video
// 5. client testimonial slider
// 6. custom counter js
// 7. client-testimonial one item carousel
// 8. our clients logo carousel

jQuery(function ($) {

    'use strict';
    // 1. fixed navbar
    $(window).on( 'scroll', function () {
        // checks if window is scrolled more than 500px, adds/removes solid class
        if ($(this).scrollTop() > 60) {
            $('.navbar').addClass('affix');
        } else {
            $('.navbar').removeClass('affix');
        }
    });


    // 2. page scrolling feature - requires jQuery Easing plugin
    $(function() {
        $(document).on('click', 'a.page-scroll', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top-60
            }, 900, 'easeInOutExpo');
            event.preventDefault();
        });
    });

    // 3. closes the responsive menu on menu item click
    $(".navbar-nav li a").on("click", function(event) {
        if (!$(this).parent().hasClass('dropdown'))
            $(".navbar-collapse").collapse('hide');
    });

    // 4. magnify popup video
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // 5. client testimonial slider
    $('.client-testimonial').owlCarousel({
        loop:true,
        margin:30,
        nav: false,
        responsiveClass:true,
        autoplay:true,
        autoplayHoverPause:true,
        lazyLoad:true,
        responsive:{
            0:{
                items:1,
                dot:true,
            },
            600:{
                items:2,
                dot:true,
            },
            1000:{
                items:2,
                dot:true,
            }
        }
    })

   // 6. custom counter js with scrolling
    var isFirstTime = true;
    var interval = null;
    var countSelector = $('.single-counter > span, .single-card > h3');
    if(countSelector.length) {
        var startingTop = countSelector.offset().top - window.innerHeight;
        if(startingTop > 0) {
            $(window).on( 'scroll', function() {
                if (isFirstTime && $(window).scrollTop() > startingTop) {
                    startCounting();
                    isFirstTime = false;
                }
            });
        } else{
            startCounting();
        }
    }

    /**
     * Get the increment value
     * @param value
     * @returns {number}
     */
    function incrementValue(value) {
        var incVal = 0;
        if(Math.ceil(value / 2) <= 5){ // upto 10
            incVal = 1;
        }
        else if(Math.ceil(value / 10) <= 10) { // up to 100
            incVal = 10;
        }
        else if(Math.ceil(value / 100) <= 10) { // up to 1000
            incVal = 30;
        }
        else if(Math.ceil(value / 100) <= 100) { // up to 10000
            incVal = 50;
        }
        else if(Math.ceil(value / 1000) <= 100) { // up to 100000
            incVal = 150;
        } else if (Math.ceil(value / 10000) <= 100) {
            incVal = 5000;
        }
        else {
            incVal = 500;
        }
        return incVal;
    }

    /**
     * To start count
     * @param counters all selectors
     * @param start int
     * @param value int
     * @param id int
     */
    function count(counters, start, value, id) {
        var localStart = start;
        var inc = incrementValue(value);
        interval = setInterval(function() {
            if (localStart < value) {
                localStart = localStart+inc;
                counters[id].innerHTML = localStart;
            }
        }, 40);
    }

    /**
     * Start the count
     */
    function startCounting() {
        // var counters = $(".single-counter > span, .single-card > h3");
        // var countersQuantity = counters.length;
        // var counter = [];

        // // get al counts from HTML count
        // for (var i = 0; i < countersQuantity; i++) {
        //     counter[i] = parseInt(counters[i].innerHTML);
        // }

        // // calling all count function
        // for (var j = 0; j < countersQuantity; j++) {
        //     count(counters, 0, counter[j], j);
        // }
    }

    // 7. client-testimonial one item carousel
    $('.client-testimonial-1').owlCarousel({
        loop:true,
        margin:30,
        nav: false,
        responsiveClass:true,
        autoplay:true,
        autoplayHoverPause:true,
        lazyLoad:true,
        items:1,
    })

    // 8. our clients logo carousel
    $('.clients-carousel').owlCarousel({
        autoplay: true,
        loop: true,
        margin:15,
        dots:true,
        slideTransition:'linear',
        autoplayTimeout:4500,
        autoplayHoverPause:true,
        autoplaySpeed:4500,
        responsive:{
            0:{
                items:2
            },
            500: {
                items:3
            },
            600:{
                items:4
            },
            800:{
                items:5
            },
            1200:{
                items:6
            }

        }
    })


}); // JQuery end