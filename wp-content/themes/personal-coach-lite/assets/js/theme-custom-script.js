jQuery(document).ready(function() {
    var owl = jQuery('.featured .owl-carousel');
    owl.owlCarousel({
        margin: 20,
        nav: false,
        autoplay: true,
        lazyLoad: true,
        autoplayTimeout: 5000,
        loop: false,
        dots: false,
        navText: [
            '<i class="fas fa-chevron-up" aria-hidden="true"></i>',
            '<i class="fas fa-chevron-down" aria-hidden="true"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 3
            },
            1200: {
                items: 3
            }
        },
        autoplayHoverPause: false,
        mouseDrag: true
    });
});