var lms_education_study_btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    lms_education_study_btn.addClass('show');
  } else {
    lms_education_study_btn.removeClass('show');
  }
});

lms_education_study_btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(document).keyup(function(e) {
  if (e.key === "Escape") {
    if (jQuery('#offcanvas-menu').hasClass("offcanvas-menu-active")) {
      jQuery('#offcanvas-menu').removeClass("offcanvas-menu-active")
    }
  }
});

jQuery(document).ready(function() {
    var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
    margin: 0,
    nav:false,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 5000,
    loop: false,
    dots: false,
    navText : ['<i class="fas fa-chevron-up " aria-hidden="true"></i>','<i class="fas fa-chevron-down" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 1
      },
      1000: {
        items: 1
      },
      1200: {
        items: 1
      }
    },
    autoplayHoverPause : false,
    mouseDrag: true
  });
})

window.addEventListener('load', (event) => {
  jQuery(".loading").delay(2000).fadeOut("slow");
  jQuery(".loading2").delay(2000).fadeOut("slow");
});

jQuery('.header-search-wrapper .search-main').click(function(){
  jQuery('.search-form-main').toggleClass('active-search');
  jQuery('.search-form-main .search-field').focus();
});

jQuery("#top-slider .slider-inner-box h3").html(function(){
    var text2 = jQuery(this).text().trim().split(" ");
    var lastWord = text2.pop(); // Remove and store the last word

    if(text2.length > 0) {
        var remainingText = text2.join(" ");
        return `${remainingText} <span class='last_slide_head'>${lastWord}</span>`;
    } else {
        return `<span class='last_slide_head'>${lastWord}</span>`;
    }
});

jQuery(document).ready(function ($) {
// Menu Js
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });
    $('.skip-link-menu-start').focus(function () {
        if (!$("#offcanvas-menu #primary-nav-offcanvas").length == 0) {
            $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();
        }
    });
    // Menu Toggle Js
    $('.navbar-control-offcanvas').click(function () {
        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();
    });
    $('.offcanvas-close .button-offcanvas-close').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
        setTimeout(function () {
            $('.navbar-control-offcanvas').focus();
        }, 300);
    });
    $('#offcanvas-menu').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".offcanvas-wraper").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    $('.skip-link-menu-end').on('focus', function () {
        $('.button-offcanvas-close').focus();
    });
});