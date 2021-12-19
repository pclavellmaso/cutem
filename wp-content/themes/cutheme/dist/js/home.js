
jQuery(document).ready(function($) {

    $(".slider-principal-home").slick({
        infinite: true,
        speed: 350,
        autoplaySpeed: 3500,
        autoplay: false,
        slidesToScroll: 1,
        slidesToShow: 3,
        centerMode: true,
        variableWidth: true,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
        nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
        fade: false,
        dots: false,
        responsive: [{
            breakpoint: 992,
            settings: {
            arrows: false,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            variableWidth: true,
            //adaptiveHeight: true,
            }
        }]
    })
})