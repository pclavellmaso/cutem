/* Custom JS */

jQuery(document).ready(function ($) {

  // Menu Interaction Mobil
  $('.navbar-toggler-right').on('click', function (e) {
    e.preventDefault();
    $('body').css('overflow-y', 'hidden');
    $('#navbar_mobile').fadeIn(500, 'swing');
    $('.closed-menu-mobile').fadeIn('fast');
    $(this).fadeOut(1);

  });

  $('.closed-menu-mobile').on('click', function (e) {
    e.preventDefault();
    $('#navbar_mobile').fadeOut(300, 'swing');
    $(this).fadeOut(1);
    $('.navbar-toggler-right').fadeIn('fast');
    $('body').css('overflow-y', 'scroll');
  });



  if ($(window).width() < 1200) {

    //FUNCIONAMIENTO DE MENU MOBILE 

    $(document).on('click', '.dropdown', function (e) {
      e.stopPropagation();
    });

    let Padre = $('#navbar_mobile');

    let Tataranieto = Padre.children('#main-menu-mobile').children('li.menu-item-has-children.dropdown').children('a.dropdown-toggle.nav-link').siblings('ul.dropdown-menu').children('li.menu-item-has-children.dropdown').children('a.dropdown-item');

    Tataranieto.attr('href', '#');
    Tataranieto.addClass('dropdown-toggle');
    Tataranieto.attr('data-toggle', 'dropdown');
    Tataranieto.attr('aria-haspopup', 'true');
    Tataranieto.attr('aria-expanded', 'false');


    Padre.children('#main-menu-mobile').children('li.menu-item-has-children.dropdown').children('a.dropdown-toggle.nav-link').addClass('a-segundo-nivell');

    $('.a-segundo-nivell').on('click', function (e) {
      e.preventDefault();
      $(this).closest('li.menu-item-has-children.dropdown').toggleClass('li-segundo-nivell', 'nada');
      //Padre.children('#main-menu-mobile').children('li.menu-item-has-children.dropdown').addClass('li-segundo-nivell');
      //Padre.children('#main-menu-mobile').children('li.menu-item-has-children.dropdown').toggleClass('li-segundo-nivell', 'nada')

    });


  } else {

    //FUNCIONAMIENTO DE MENU ORDENADOR

    /* $('ul.navbar-nav li.dropdown').not('ul.navbar-nav li.dropdown .dropdown-item').hover(function () {
       $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
      }, function () {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    }); */

    //Variable height before on hover menu
    let locaShit = $('ul.dropdown-menu')
    let noMores = $(locaShit).find('li.dropdown:last')


    $('ul.navbar-nav li.dropdown ul').addClass('heightdelbefore');

    $('ul.navbar-nav li.dropdown').hover(function () {
      $(this).find('.dropdown-menu:first').stop(true, true).delay(100).fadeIn(100);
      $(noMores).hover(function () {
        $('ul.navbar-nav li.dropdown ul').removeClass('heightdelbefore').addClass('heightdelbeforemore')
      }, function(){
        $('ul.navbar-nav li.dropdown ul').removeClass('heightdelbeforemore').addClass('heightdelbefore') 
      });
    }, function () {
      $(this).find('.dropdown-menu:first').stop(true, true).delay(100).fadeOut(100);
      $('ul.navbar-nav li.dropdown ul').removeClass('heightdelbeforemore').addClass('heightdelbefore') 
    });

    

    //This is to stop the Bootstrap menu from closing when a link is clicked. ESTO ES PARA HACER QUE LOS DE SEGUNDO Y TERCER NIVEL TENGAN HOVER
    $(document).on('click', '.dropdown', function (e) {
      e.stopPropagation();
    });
    /* NavBar */
    let padres = document.querySelectorAll('li.menu-item-has-children');
    for (let index = 2; index < padres.length; index++) {
      if ($(padres[index]).hasClass('menu-item-has-children')) {
        $(padres[index]).append('<span class="icon-chevron-down desplegable"></span>');
      }
    }
    let desplegables = document.querySelectorAll('.desplegable');
    for (let index = 0; index < desplegables.length; index++) {
      $(desplegables[index]).on('click', function () {
        $(desplegables[index]).parent().children('ul.dropdown-menu').toggleClass('ocultar');
      })
    }

  }




  $(function ($) {
    // Bootstrap menu magic
    $(window).resize(function () {
      if ($(window).width() < 1200) {
        $(".dropdown-toggle").attr('data-toggle', 'dropdown');
      } else {
        $(".dropdown-toggle").removeAttr('data-toggle dropdown');
      }
    });
  });



  //Abrir modal mini carrito

  $('.padre-minicart #icon-cart').on('click', function (event) {
    event.preventDefault();
    $('.minicart-modal').stop().animate({
      "right": "0"
    });
    $('body').css('overflow-y', 'hidden');
  });

  $('.widgettitle.close-minicart').on('click', function () {
    $('.minicart-modal').stop().animate({
      "right": "-34%"
    });
    $('body').css('overflow-y', 'scroll');
  });

  //cerrar aviso de woocommerce

  $('.cerrar-mensaje').on('click', function () {
    $('.woocommerce-notices-wrapper').fadeOut(300);
    $('.woocommerce-message').fadeOut(300);
  });


  //ABRE EL MODAL OLVIDE CONTRASEÑA Y CUERRA EL LOGIN
  $('.passperdida a').on('click', function (event) {
    event.preventDefault();
    $('#customer_login_header').stop().animate({
      "right": "-100%"
    });
    $('#forgetpassModal').stop().animate({
      "right": "0"
    });
    $('#close-navModal').fadeIn(300, 'swing');
    $('body').css('overflow-y', 'hidden');
  });
  //CIERRA EL MODAL OLVIDE CONTRASEÑA
  $('#forgetpassModal #close-navModal').on('click', function () {
    $('#forgetpassModal').stop().animate({
      "right": "-100%"
    });
    $('#close-minicart').fadeOut(50);
    $('body').css('overflow-y', 'scroll');
  });



  if ($(window).width() < 768) { //Movil
    //Abrir modal Contacto

    $('.modal-contact a.nav-link').on('click', function (event) {
      event.preventDefault();
      $('#navModal').stop().animate({
        "right": "0"
      });
      $('#close-navModal').fadeIn(300, 'swing');
      $('body').css('overflow-y', 'hidden');
    });


    

    $('#navModal #close-navModal').on('click', function () {
      $('#navModal').stop().animate({
        "right": "-100%"
      });
      $('#close-minicart').fadeOut(50);
      $('body').css('overflow-y', 'scroll');
      //$('body').css('overflow-y', 'scroll');
    });


    //Abrir modal Buscador

    $('.open-search').on('click', function (event) {
      event.preventDefault();
      $('#searchModal').stop().animate({
        "top": "0"
      });
    });

    $('#close-buscador').on('click', function () {
      $('#searchModal').stop().animate({
        "top": "-100vh"
      });
    });


      //Abrir modal Escuchar
      $('#opensounsd').on('click', function (event) {
        event.preventDefault();
        $('body').css('overflow-y', 'hidden');
        $('#soundsistemModal').stop().animate({
          "right": "0"
        });
      });
      $('#close-navModalsound').on('click', function () {
        $('body').css('overflow-y', 'scroll');
        $('#soundsistemModal').stop().animate({
          "right": "-100vh"
        });
      });



  } else {

    //Abrir modal Contacto
    $('.modal-contact a.nav-link').on('click', function (event) {
      event.preventDefault();
      $('#navModal').stop().animate({
        "right": "0"
      });
      $('#close-navModal').fadeIn(300, 'swing');
      $('body').css('overflow-y', 'hidden');
    });

    $('#navModal #close-navModal').on('click', function () {
      $('#navModal').stop().animate({
        "right": "-38%"
      });
      $('#close-minicart').fadeOut(50);
      $('body').css('overflow-y', 'scroll');
      //$('body').css('overflow-y', 'scroll');
    });

    
    //Abrir modal Buscador
    $('.open-search').on('click', function (event) {
      event.preventDefault();
      $('#searchModal').stop().animate({
        "top": "0"
      });
      $('input.input-activo').trigger('focus');
    });

    $('#close-buscador').on('click', function () {
      $('#searchModal').stop().animate({
        "top": "-40vh"
      });
    });


    //Abrir modal Escuchar
    $('#opensounsd').on('click', function (event) {
    event.preventDefault();
    $('body').css('overflow-y', 'hidden');
    $('#soundsistemModal').stop().animate({
      "right": "0"
    });
  });
  $('#close-navModalsound').on('click', function () {
    $('body').css('overflow-y', 'scroll');
    $('#soundsistemModal').stop().animate({
      "right": "-100vh"
    });

  });



     //Abrir modal Mi Cuenta

     $('.modal-mycuenta a.nav-link').on('click', function (event) {
      event.preventDefault();
      $('#customer_login_header').stop().animate({
        "right": "0"
      });
      $('body').css('overflow-y', 'hidden');
    });

    $('#customer_login_header #close-login').on('click', function () {
      $('#customer_login_header').stop().animate({
        "right": "-38%"
      });
      $('body').css('overflow-y', 'scroll');
      //$('body').css('overflow-y', 'scroll');
    });

  }





  /* $('.dropdown-toggle').on('click', function () {
      $('#navModal').fadeIn(500, 'swing');
    }); */

  /* Prevent Contact Form double submission */

  /* $('.wpcf7-submit').on('click', function (e) {
      if ( $(this).siblings('.ajax-loader').hasClass('is-active') ) {
          e.preventDefault();
        return false;
      }
  }); */

  /* Fix for scrolling modal Safari Mobile */

  $(function () {
    var $window = $(window),
      $body = $('body'),
      $modal = $('.modal'),
      scrollDistance = 0;

    $modal.on('show.bs.modal', function () {
      scrollDistance = $window.scrollTop();
      $body.css('top', scrollDistance * -1);
    });

    $modal.on('hidden.bs.modal', function () {
      $body.css('top', '');
      $window.scrollTop(scrollDistance);
    });
  });


  /* Header scroll effect */

  // Header scroll effect
  if ($(window).scrollTop() > 0) {
    $('.navbar-transition').addClass('scrolled');
    $('.scrolled-items').addClass('scrolled');
    $('.initial-header').addClass('scrolled');
  }

  $(window).scroll(function () {
    var $nav = $('.navbar-transition');
    var $nav1 = $('.scrolled-items');
    var $nav2 = $('.initial-header');
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    $nav1.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    $nav2.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });



  $('#searchModal').on('shown.bs.modal', function () {
    $('input.input-activo').trigger('focus');
  });
  //.focus();

});

/* OCULTAR HEADER EN SCROLL DOWN */
var lastScrollTop = 0;
window.addEventListener("scroll", function () {
  var st = window.pageYOffset || document.documentElement.scrollTop;
  if (st > lastScrollTop && st > 0) {
    if (screen.width > 768) { //Para desktop
      jQuery("#masthead").css({
        "top": "-85px"
      });
    }
    if (screen.width < 768) { //Para moviles
      jQuery("#masthead").css({
        "top": "0px"
      });

    }
  } else {
    jQuery("#masthead").css({
      "top": "0px"
    });
  }
  ;  
  //Para el stick bar de los productos
  if(lastScrollTop > st && lastScrollTop > 0){
    jQuery("#navbar_filtros-products").css({
      "top": "-75px"
    });
  }else{

    jQuery("#navbar_filtros-products").css({
      "top": "0px"
    });
  }

  lastScrollTop = st
}, false);


