jQuery(document).ready(function ($) {

    //Script para manipular core del plugin de COOKIES

    $('.moove-gdpr-info-bar-content').addClass('wrapper');
    //$('.moove-gdpr-infobar-allow-all').addClass('square-btn-black');
    //$('#moove_gdpr_cookie_modal').removeClass('gdpr_lightbox-hide');

    //Script para manipular las columnas footer y transformarlas en acordeones para min-width < 992

    if ($(window).width() < 992) {
    
         //Estilos comunes
        $("span.widgettitle").attr("aria-expanded", "true" );
        $("div.footer-logo").addClass("accordion");
        $("li.widget_nav_menu").addClass("card");
        $("span.widgettitle").attr("data-toggle", "collapse" );
        $(".widgettitle").addClass("card-header");
        
        //Acordeon bloque producto

        $(".footer-logo > #nav_menu-2 > .widgettitle").attr('id', 'headingOne');
        $(".footer-logo > #nav_menu-2 > .widgettitle").attr("data-target", "#collapseOne" );
        $(".footer-logo > #nav_menu-2 > .widgettitle").attr("aria-controls", "collapseOne" );

        $("div.menu-footer-producto-container").attr('id', 'collapseOne');
        $("div.menu-footer-producto-container").addClass("collapse");
        $("div.menu-footer-producto-container").attr("aria-labelledby", "headingOne");

        //Acordeon bloque pedidos y soporte

        $(".footer-pedidos-soporte > #nav_menu-7 > .widgettitle").attr('id', 'headingTwo');
        $(".footer-pedidos-soporte > #nav_menu-7 > .widgettitle").attr("data-target", "#collapseTwo" );
        $(".footer-pedidos-soporte > #nav_menu-7 > .widgettitle").attr("aria-controls", "collapseTwo" );

        $("div.menu-footer-pedidos-y-soporte-container").attr('id', 'collapseTwo');
        $("div.menu-footer-pedidos-y-soporte-container").addClass("collapse");
        $("div.menu-footer-pedidos-y-soporte-container").attr("aria-labelledby", "headingTwo");

        //Acordeon empresa

        $(".footer-nosotros > #nav_menu-4 > .widgettitle").attr('id', 'headingThree');
        $(".footer-nosotros > #nav_menu-4 > .widgettitle").attr("data-target", "#collapseThree" );
        $(".footer-nosotros > #nav_menu-4 > .widgettitle").attr("aria-controls", "collapseThree" );

        $("div.menu-footer-empresa-container").attr('id', 'collapseThree');
        $("div.menu-footer-empresa-container").addClass("collapse");
        $("div.menu-footer-empresa-container").attr("aria-labelledby", "headingThree");
        
        //Acordeon profesionales

        $(".footer-profesionales > #nav_menu-5 > .widgettitle").attr('id', 'headingFour');
        $(".footer-profesionales > #nav_menu-5 > .widgettitle").attr("data-target", "#collapseFour" );
        $(".footer-profesionales > #nav_menu-5 > .widgettitle").attr("aria-controls", "collapseFour" );

        $("div.menu-footer-profesionales-container").attr('id', 'collapseFour');
        $("div.menu-footer-profesionales-container").addClass("collapse");
        $("div.menu-footer-profesionales-container").attr("aria-labelledby", "headingFour");

        $('#close-newsletter').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('#modalNewsletter').stop().animate({
              "right": "-100%"
            });
            $('#close-newsletter').fadeOut(50);
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');
            
        });

        /*$('#close-filtros').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('#modalFiltros').stop().animate({
              "right": "-100%"
            });
            $('#close-filtros').fadeOut(50);
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');
            
        });*/
        

        $('.moove-gdpr-modal-close').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('.moove-gdpr-modal-content').stop().animate({
              "right": "-40.3vw"
            });
            $('.moove-gdpr-modal-close').fadeOut(50);
            //$('.gdpr_lightbox').css('opacity', '1');
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');
            //$('#moove_gdpr_cookie_modal').removeClass('gdpr_lightbox-hide');
            
        });
    
        $('.moove-gdpr-modal-save-settings').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('#modalNewsletter').stop().animate({
              "right": "-100%"
            });
            $('#close-newsletter').fadeOut(50);
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');
            
        });

        $('.moove-gdpr-modal-allow-all').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('#modalNewsletter').stop().animate({
              "right": "-100%"
            });
            $('#close-newsletter').fadeOut(50);
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');
            
        });

        $('.openM').on('click', function () {
            $("#modalFiltros").toggle('slide', {direction: 'right'}, 500 )
            $('body').css('overflow-y', 'hidden');
        });

        $('#close-filtros').on('click', function () {
            $("#modalFiltros").toggle('slide', {direction: 'right'}, 500 )
            $('body').css('overflow-y', 'scroll');
        })
        
    
    } else {

        $('#close-newsletter').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('#modalNewsletter').stop().animate({
            "right": "-45%"
            });
            $('#close-newsletter').fadeOut(50);
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');
        });

        /*$('#close-filtros').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('#modalFiltros').stop().animate({
            "right": "-45%"
            });
            $('#close-filtros').fadeOut(50);
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');  
        });*/
        $('#close-filtros').on('click', function () {
            $("#modalFiltros").toggle('slide', {direction: 'right'}, 500 )
        })

        $('.moove-gdpr-modal-close').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('.moove-gdpr-modal-content').stop().animate({
            "right": "-40.3vw"
            });
            $('.moove-gdpr-modal-close').fadeOut(50);
            //$('.gdpr_lightbox').css('opacity', '1');
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');
            $('#moove_gdpr_cookie_modal').removeClass('gdpr_lightbox-hide');
            //('#moove_gdpr_cookie_modal').addClass('gdpr_lightbox-hide');
            
        });

        $('.moove-gdpr-modal-allow-all').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('.moove-gdpr-modal-content').stop().animate({
            "right": "-40.3vw"
            });
            $('.moove-gdpr-modal-close').fadeOut(50);
            //$('.gdpr_lightbox').css('opacity', '1');
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');
            $('#moove_gdpr_cookie_modal').removeClass('gdpr_lightbox-hide');
            //('#moove_gdpr_cookie_modal').addClass('gdpr_lightbox-hide');
            
        });

        $('.moove-gdpr-modal-save-settings').on('click', function (event) {
            event.preventDefault();
            //alert('hola');
            $('.moove-gdpr-modal-content').stop().animate({
            "right": "-40.3vw"
            });
            $('.moove-gdpr-modal-close').fadeOut(50);
            //$('#myModal2').css('display', 'none');
            $('body').css('overflow-y', 'scroll');
            $('.modal-backdrop.show').css('display', 'none');
            $('#moove_gdpr_cookie_modal').removeClass('gdpr_lightbox-hide');  
        });

        $('.openM').on('click', function () {
            $("#modalFiltros").toggle('slide', {direction: 'right'}, 500 )
        });
  
    }

    // Menu Interaction Mobil

    $('.openNL').on('click', function (event) {
        event.preventDefault();
        //alert('hola');
        $('#modalNewsletter').stop().animate({
            "right": "0",
            "padding-left": "2.5em"
        });
        $('#close-newsletter').fadeIn(300, 'swing');
        $('body').css('overflow-y', 'hidden');
        $('.modal-backdrop.show').css('display', 'none');
    });

    // TODO (DONT WORK)
    $('.avisame-eventos').click(function (event) {
        event.preventDefault();
        $('#modalNewsletter').stop().animate({
          "right": "0"
        });
        if (window.innerWidth < 414) {
            $('body').css('overflow-y', 'hidden');
        }
        $('#close-newsletter').fadeIn(300, 'swing');
        $('.modal-backdrop.show').css('display', 'none');
    });

    $('.change-settings-button').on('click', function (event) {
        //$('#moove_gdpr_cookie_modal').removeClass('gdpr_lightbox-hide');
        event.preventDefault();
        //alert('hola');
        $('.moove-gdpr-modal-content').stop().animate({
            "right": "0"
        });
        $('.moove-gdpr-modal-close').fadeIn(300, 'swing');
        $('body').css('overflow-y', 'hidden');
        $('.modal-backdrop.show').css('display', 'none');
    });

});