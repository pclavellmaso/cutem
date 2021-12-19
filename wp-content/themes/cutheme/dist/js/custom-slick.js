/* Custom JS to initialize carousels and sliders */

jQuery(document).ready(function ($) {

  // Card's slider
  var $carousel = $('.slider-primary-product');
  //CONTADOR PARA SABER CUANTOS SLIDES HAY EN EL CARRUSEL
  slidess = $('.slider-primary-product a.lightboxxx').toArray().length;
  //slidess = 3;

  if (slidess >= 3) {

    $carousel.slick({
      infinite: true,
      speed: 300,
      autoplaySpeed: 3500,
      autoplay: false,
      slidesToScroll: 1,
      slidesToShow: 3,
      centerMode: false,
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

    });

  } else if (slidess == 2) {
    $carousel.slick({
      infinite: true,
      speed: 300,
      autoplaySpeed: 3500,
      autoplay: false,
      slidesToScroll: 1,
      slidesToShow: 3,
      centerMode: false,
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
        }
      }]

    });
  } else {

    $carousel.slick({
      infinite: true,
      speed: 300,
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
        }
      }]
    });
  }

  var $carouselArte = $('.slider-primary-product-arte');

  $carouselArte.slick({
    infinite: true,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: false,
    slidesToScroll: 1,
    slidesToShow: 1,
    centerMode: false,
    variableWidth: false,
    adaptiveHeight: true,
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
        centerMode: false,
        variableWidth: false,
        adaptiveHeight: true,
      }
    }]

  });
  /* $('#arrow-right2').on('click', function (e) {
    $carousel.slick('slickNext');
  });

  $('#arrow-left2').on('click', function (e) {
    $carousel.slick('slickPrev');
  }); */



  $('.slider-product').slick({
    infinite: false,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: false,
    slidesToScroll: 1,
    slidesToShow: 1,
    arrows: false,
    fade: false,
    dots: false,
    responsive: [{
      breakpoint: 992,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  $('#arrow-right').on('click', function (e) {
    $('.slider-product').slick('slickNext');
  });

  $('#arrow-left').on('click', function (e) {
    $('.slider-product').slick('slickPrev');
  });

  $('.slider-projects').slick({
    infinite: false,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: true,
    slidesToScroll: 1,
    slidesToShow: 3,
    arrows: false,
    fade: false,
    dots: false,
    responsive: [{
      breakpoint: 992,
      settings: {
        arrows: false,
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }]
  });

  $('#slider-right').on('click', function (e) {
    $('.slider-projects').slick('slickNext');
  });

  $('#slider-left').on('click', function (e) {
    $('.slider-projects').slick('slickPrev');
  });


  /*  
    For slider templates destacados
  */
  $('.carrusel-destacado').slick({
    infinite: true,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: false,
    slidesToScroll: 1,
    slidesToShow: 4,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
    nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
    fade: false,
    dots: true,
    customPaging: function (slider, i) {
      if (slider.slideCount > 4) {
        return '<button type="button" role="tab" id="slick-slide-control1' + i + '" aria-controls="slick-slide1' + i + '" aria-label="" tabindex="-1">' + slider + '</button>';
      } else {
        // return  (i + 1) + '/' + slider.slideCount;
        // return '<div style="color:red;" class="pager__item" id=' + i + "> ___"+ slider +" _____ </div>";
      }
    },
    variableWidth: true,
    centerMode: false,
    responsive: [{
      breakpoint: 992,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
      }
    }]
  });

/*  
    For slider related products
  */
    $('.up-sells.upsells.products > ul.products').slick({
      infinite: true,
      speed: 300,
      autoplaySpeed: 3500,
      autoplay: false,
      slidesToScroll: 1,
      slidesToShow: 4,
      arrows: true,
      prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
      nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
      fade: false,
      dots: true,
      customPaging: function (slider, i) {
        if (slider.slideCount > 4) {
          return '<button type="button" role="tab" id="slick-slide-control1' + i + '" aria-controls="slick-slide1' + i + '" aria-label="" tabindex="-1">' + slider + '</button>';
        } else {
          // return  (i + 1) + '/' + slider.slideCount;
          // return '<div style="color:red;" class="pager__item" id=' + i + "> ___"+ slider +" _____ </div>";
        }
      },
      variableWidth: true,
      centerMode: false,
      responsive: [{
        breakpoint: 992,
        settings: {
          arrows: false,
          dots: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          centerMode: true,
          variableWidth: false,
        }
      }]
    });


  /*
    For slider templates videos
  */
  $('.carrusel-videos').slick({
    infinite: true,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: false,
    slidesToScroll: 1,
    slidesToShow: 3,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
    nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
    fade: false,
    dots: true,
    variableWidth: true,
    centerMode: false,
    responsive: [{
      breakpoint: 992,
      settings: {
        variableWidth: false,
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  $('.carrusel-videos_modal').slick({
    infinite: false,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: false,
    slidesToScroll: 1,
    slidesToShow: 1,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
    nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
    fade: false,
    dots: false,
    variableWidth: false,
    centerMode: true,
    responsive: [{
      breakpoint: 992,
      settings: {
        arrows: false,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  /*
    For slider templates lightbox 1 imagen
  */
  $('.carrusel-una-imagen').slick({
    infinite: true,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: false,
    slidesToScroll: 1,
    slidesToShow: 2,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
    nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
    fade: false,
    dots: true,
    variableWidth: true,
    centerMode: false,
    responsive: [{
      breakpoint: 992,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  /*
    For slider templates lightbox 2 imagenes
  */
  $('.carrusel-una-imagen-dos').slick({
    infinite: true,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: false,
    slidesToScroll: 1,
    slidesToShow: 2,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
    nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
    fade: false,
    dots: true,
    variableWidth: true,
    centerMode: false,
    responsive: [{
      breakpoint: 992,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: false,
      }
    }]
  });
  /*
    For slider templates texto
  */
  $('.carrusel-texto').slick({
    infinite: true,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: false,
    slidesToScroll: 1,
    slidesToShow: 2,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
    nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
    fade: false,
    dots: true,
    variableWidth: false,
    centerMode: false,
    responsive: [{
      breakpoint: 992,
      settings: {
        arrows: false,
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });

  /*
    For slider mas obras del artista
  */
    $('.mas-obras').slick({
      infinite: true,
      speed: 300,
      autoplaySpeed: 3500,
      autoplay: false,
      slidesToScroll: 1,
      slidesToShow: 1,
      arrows: true,
      prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
      nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
      fade: false,
      dots: true,
      variableWidth: false,
      centerMode: false,
      adaptiveHeight: true,
      responsive: [{
        breakpoint: 992,
        settings: {
          arrows: false,
          dots: false,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    });

    /*
    For slider DESTACADOS PANTALLA COMPLETA SOLO TEXTO SLIDERS
  */

    $.fn.randomize = function(selector) {
      var $el = selector ? $(this).find(selector) : $(this).children(),
        $pars = $el.parent();
  
      $pars.each(function() {
        $(this).children(selector).sort(function(chA, chB) {
          if ($(chB).index() !== $(this).children(selector).length - 1) {
            return Math.round(Math.random()) - 0.5;
          }
        }.bind(this)).detach().appendTo(this);
      });
      return this;
    };

    $('.destacados-pantallacompleta').randomize().slick({
      infinite: true,
      speed: 300,
      autoplaySpeed: 3500,
      autoplay: false,
      slidesToScroll: 1,
      slidesToShow: 1,
      arrows: true,
      prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
      nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
      fade: false,
      dots: false,
      variableWidth: false,
      centerMode: false,
      adaptiveHeight: false,
      responsive: [{
        breakpoint: 992,
        settings: {
          arrows: false,
          dots: true,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    }).slick('slickGoTo', Math.floor((Math.random() * 3) + 1));

    /*  
    For slider templates productos destacados
  */
  $('.carrusel-productos-destacado').slick({
    infinite: true,
    speed: 300,
    autoplaySpeed: 3500,
    autoplay: false,
    slidesToScroll: 1,
    slidesToShow: 4,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
    nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
    fade: false,
    dots: true,
    customPaging: function (slider, i) {
      if (slider.slideCount > 4) {
        return '<button type="button" role="tab" id="slick-slide-control1' + i + '" aria-controls="slick-slide1' + i + '" aria-label="" tabindex="-1">' + slider + '</button>';
      } else {
        // return  (i + 1) + '/' + slider.slideCount;
        // return '<div style="color:red;" class="pager__item" id=' + i + "> ___"+ slider +" _____ </div>";
      }
    },
    variableWidth: true,
    centerMode: false,
    responsive: [{
      breakpoint: 992,
      settings: {
        arrows: false,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
      }
    }]
  });

  
  let numerodehermanos = $(".item-product-featured").siblings().length;
  if (numerodehermanos >= 4){
    $(".item-product-featured").addClass('hay-cuatro');
  }else if (numerodehermanos == 3) {
    $(".item-product-featured").addClass('hay-tres');
  }else{
    $(".item-product-featured").addClass('nada');
  }
    /* 
      For Milagro slider
      
    */

    slidesMilagro = $('.carrusel-texto-milagro .item-container').toArray().length;
  

    if (slidesMilagro >= 3) {
      $('.carrusel-texto-milagro').slick({
        infinite: true,
        speed: 300,
        autoplaySpeed: 3500,
        autoplay: false,
        slidesToScroll: 1,
        slidesToShow: 2,
        arrows: true,
        prevArrow: "<button type='button' class='slick-prev slick-arrow' aria-label='Previous'></button>",
        nextArrow: "<button type='button' class='slick-next slick-arrow' aria-label='Next'></button>",
        fade: false,
        dots: true,
        variableWidth: false,
        centerMode: true,
        adaptiveHeight: false,
        responsive: [
          {
            breakpoint: 992,
            settings: {
              arrows: false,
              dots: true,
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: false
            }
        }]
      });
    }else {
        $('.carrusel-texto-milagro').slick({
            infinite: true,
            speed: 300,
            autoplaySpeed: 3500,
            autoplay: true,
            slidesToScroll: 1,
            slidesToShow: 2,
            centerMode: true,
            variableWidth: false,
            arrows: false,
            fade: false,
            dots: false,
            responsive: [{
              breakpoint: 992,
              settings: {
                  arrows: false,
                  dots: true,
                  slidesToShow: 1,
                  slidesToScroll: 1
              }
          }]
        });
      }

  /*
    Funciones para los videos
    Abrir lightbox y reproducción automática del item
    Para quitar el class del wrapper
    Se mueve a full width el contenedor
    Mueve la arrow a las posiciones correctas
  */
  $ = jQuery;

  $('.slick-prev').css({'left': '-6%'})
  $('button.slick-prev.slick-arrow, button.slick-next.slick-arrow').on('click', function (event) {



    $(event.currentTarget).closest('div.carrusel-texto-milagro').removeClass('addposition')

    
    $(event.currentTarget).closest('div.container-fluid').addClass("pl-0");
    $(event.currentTarget).closest('div.wrapper-left').removeClass("wrapper-left");
    $(event.currentTarget.closest('div.container-fluid')).find('.slick-list ').css({
      'padding': '0  15vh'
    });
    let currentArrow = $(event.currentTarget).attr('aria-label');
    if (currentArrow == 'Previous') {
      $(event.currentTarget).css({
        'left': '2%'
      });
    } else {
      $(event.currentTarget.closest('div.container-fluid')).find('.slick-prev ').css({
        'left': '2%'
      });
    }

  });
  /*
    Para lanzar el lightbox de los videos
  */
  $('.play-video').on('click', function (e) {
    e.preventDefault();
    var videoURLno = $(e.currentTarget).data('videoid');
    var videoURL = $(e.currentTarget).data('videoid');
    $('#modal_video').fadeIn(500, 'swing');
    $('.close-video').fadeIn(500);
    $('body').css('overflow-y', 'hidden');
    videoURL += "?autoplay=1";
    $('.video-autoplayadd').prop('src', videoURL);
    $('.close-video').attr('data-closeid', videoURLno);
    $('.carrusel-videos_modal').slick('refresh');
  });
  $('.close-video').on('click', function (e) {
    e.preventDefault();
    var videoURL = $(e.currentTarget).data('closeid');
    $('#modal_video').fadeOut(500);
    $('.close-video').fadeOut(500);
    $('body').css('overflow-y', 'scroll');
    $('.video-autoplayadd').prop('src', '');
  });


//elimio span check en privacidad
$('#news_suscription_field .optional').remove();

})