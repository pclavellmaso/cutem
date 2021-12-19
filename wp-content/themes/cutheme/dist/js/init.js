/* Custom JS  */

jQuery(document).ready(function ($) {

    function waitForEl(selector, callback) {
        if ($(selector).length) {
          callback();
        } else {
            setTimeout(function() {
                waitForEl(selector, callback);
            }, 100);
        }
    }

    var height = $(window).height();

   

    if ($(window).width() < 768) {
    } else {
        var heightt = $(window).height();

        $('.vh-100').height(heightt);
    }

  
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

    /* Smooth scrolling */
    $('.smooth-link').on('click', function (e) {
        e.preventDefault();

        $('html, body').animate({
        scrollTop: $($(this).attr('href')).offset().top
        }, 1000, 'swing');
    });


    //$('.select2-selection__arrow').addClass('select2-selection__arrow2');
    $('.select2-selection__arrow').addClass('icon-arrow-right');
    $('ul li:first-child').attr('disabled');



    $('.wpcf7-list-item-label').on('click', function () {
        let inputFalso = $(this);
        inputFalso.toggleClass('click-current');
        inputFalso.siblings().toggleClass('no-click');
        //$('.no-click').attr('checked', 'checked');
        inputFalso.siblings('input').prop('checked', false);
        $('.no-click').prop('checked', true);

    });

    $('.woocommerce-breadcrumb').addClass('wrapper color-grey-light2 fs-08 mt-lg-5 mt-3 pt-lg-5 d-lg-block d-none');



    /* ELIMAR ENLACE */
    /* $('span .url').click(function () {
        return false;
    }); */


    //SCRIPTS PARA WOOCOMMERCE
    $(document.body).trigger('wc_fragments_refreshed');

    $('.zoomImg').click(function () {
        //$('.woocommerce-product-gallery__trigger').trigger('click');
        $('.woo-variation-gallery-trigger').trigger('click');
    });
    $('.wvg-gallery-image').click(function () {
        //$('.woocommerce-product-gallery__trigger').trigger('click');
        $('.woo-variation-gallery-trigger').trigger('click');
    });

    /* PARA REFRESCAR EL CARRITO AL CAMBIAR LAS UNIDADES */
    $('div.woocommerce').on('change', '.qty', function(){
        $("[name='update_cart']").prop("disabled", false);
        $("[name='update_cart']").trigger("click"); 
    });

    

    //Carrusel notas de prensa by Núria

    //For slider press notes
    $('.slider-press-notes').slick({
        infinite: true,
        speed: 300,
        autoplaySpeed: 3500,
        autoplay: false,
        slidesToScroll: 1,
        slidesToShow: 4,
        arrows: false,
        fade: false,
        dots: false,
        variableWidth: true,
        centerMode: false,
        responsive: [
        {
            breakpoint: 992,
            settings: {
            arrows: false,
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptativeHeight: true
            }
        }]
    });

    /* ICONO PARA VER CONTRASEÑA WOOCOMMERCE LOGIN */

    $('span.show-password-input').addClass('fal fa-eye');

    $('span.show-password-input').on('click', function () {

        $(this).toggleClass('fa-eye-slash', 'fa-eye');

    });

    //para moverse entre las tabs con el boton continuar en el checkout
    //boton continuar acceso-datos
    $("#butonnextprofile").on('click', function (event) {
        event.preventDefault()
        $('#myTab a[href="#profile"]').tab('show')
        //Para ocultar la div que debería ir en la tab  1 accediendo como invitado
        $('#oculatarestoalclic').hide()
    });
    //boton continuar acceso-datos logeado
    $("#butonnextprofileloged").on('click', function (event) {
        event.preventDefault()
        $('#myTab a[href="#messages"]').tab('show')
    });

    

    //Para mostrar la div que debería ir en la tab 1
    $('#home-tab').on('click', function(event){
        $('#oculatarestoalclic').show()
    });
    //Para ocultar la div que debería ir en la tab  1  haciendo clic en perfil
    $('#profile-tab').on('click', function(event){
        $('#oculatarestoalclic').hide()
    });


    
 

    //creamos las funciones para mostrar los metodos de pago en tabs
    $('#pymentstab li label').click(function (e) {
        $('#pymentstabcontent .tab-pane').removeClass( "active" )
        let idatt = $(this).attr("data-id-act")
        $('#'+idatt).tab('show')
    })

    //Para eliminar el literal del boton wishlist del
    $('.loop-content-product .yith-wcwl-add-button span').remove()

    

    //Leer más en los textos introductorios
  

    $(".view-more").click(function() {
        $(this).toggle();
        $(".partial-text").toggle();
        $(".full-text").toggle();
        $(".view-less").toggle();
    })

    $(".view-less").click(function() {
        $(".full-text").toggle();
        $(".view-less").toggle();
        $(".partial-text").toggle();
        $(".view-more").toggle();
        $('body').animate({
        scrollTop: $(".section-header").offset().top
        }, 800);

    })


    //Opent/close tabs login on click
    $('#logintab li label').click(function (e) {
        // console.log(e)
        $('#logincontent .tab-pane').removeClass( "active" )
        let idatt = $(this).attr("data-id-act")
        $('#'+idatt).tab('show')
    })


    //Opent/close tabs recambios on click
    $('#select-model-recambios li label').click(function (e) {
        // console.log(e)
        $('#recambios-tancontent .tab-pane').removeClass( "active" )
        let idatt = $(this).attr("data-id-act")
        $('#'+idatt).tab('show')
    })


    // Replace de los textos del menú compartir en páginas single
    // [Sin un timeout no hace el replace, IDKW]
    // setTimeout(() => {
    //     $("a.shareaholic-service-linkedin").append('<p class="mr-1">LinkedIn</p>')
    //     $("a.shareaholic-service-facebook").append('<p class="mr-1">Facebook</p>')
    //     $("a.shareaholic-service-email_this").append('<p class="mr-1">Correo electrónico</p>')
    //     $("a.shareaholic-service-pinterest").append('<p class="mr-1">Pinterest</p>')
    //     $("a.shareaholic-service-whatsapp").append('<p class="mr-1">Whatsapp</p>')
    //     $(".shr-hide").removeClass("shr-hide")
    //     $(".shareaholic-share-buttons-heading-text").css('font-family', 'SuisseIntl')
    // }, 1000)

    //Eliminar la coma en los autores
    $('#sectioautores .mainautor:last').find('.eliminarcoma').remove()

    /*
        Menús stick en pagina de productos de productos
        accordiones single-product.php
    */ 
    $('#especificaiones-product').click(function(e) { 
        e.preventDefault()
        $('.accordion .collapse').removeClass("show")
        $('#collapse-1').addClass("show")
    })
    $('#descargatab-product').click(function(e) { 
        e.preventDefault()
        $('.accordion .collapse').removeClass("show")
        $('#collapse-2').addClass("show")
    })
    $('#recambiostab-product').click(function(e) { 
        e.preventDefault()
        $('.accordion .collapse').removeClass("show")
        $('#collapse-4').addClass("show")
    })
    /*
        LOS SIGUIENTES CODIGOS SON PARA EL FUNCIONAMIETNOS
        DE LA PAGINA content-single-product.php
    */
    //Opent/close tabs model on click
    $('#modeltab li label').click(function(e) {
        $('#modeltancontent .tab-pane').removeClass("active")
        let idatt = $(this).attr("data-id-act")
        $('#' + idatt).addClass("active")
    })
    //Opent/close tabs descargable on click
    $('#modeltabdescargable li label').click(function(e) {
        $('#descargabletancontent .tab-pane').removeClass("active")
        let idatt = $(this).attr("data-id-act")
        $('#' + idatt).addClass("active")
    })





    //seleccion de mercado dentro de las tabs
    $('#mercadoselectcontent-ul-0').addClass('masterhide')
    $('#mercadoselectcontent-ul-1').addClass('masterhide')

    $('#mercadoselect-m1 li label').click(function(e) {
        let idatt = $(this).attr("data-id-act")
        if( idatt == 'mercadoselectcontent-ce-0' ){
            $('#mercadoselectcontent-ce-0').addClass('masterdis').removeClass('masterhide')
            $('#mercadoselectcontent-ul-0').addClass('masterhide').removeClass('masterdis')
        }
        if( idatt == 'mercadoselectcontent-ul-0' ){
            $('#mercadoselectcontent-ce-0').addClass('masterhide').removeClass('masterdis')
            $('#mercadoselectcontent-ul-0').addClass('masterdis').removeClass('masterhide')
        }      
    })

    $('#mercadoselect-m2 li label').click(function(e) {

        let idatt = $(this).attr("data-id-act")
        if( idatt == 'mercadoselectcontent-ce-1' ){
            $('#mercadoselectcontent-ce-1').addClass('masterdis').removeClass('masterhide')
            $('#mercadoselectcontent-ul-1').addClass('masterhide').removeClass('masterdis')
        }
        if( idatt == 'mercadoselectcontent-ul-1' ){
            $('#mercadoselectcontent-ce-1').addClass('masterhide').removeClass('masterdis')
            $('#mercadoselectcontent-ul-1').addClass('masterdis').removeClass('masterhide')
        }      

               

    })


    //Opent/close tabs descargable variable product on click
    $('#mercadoselect-m2').addClass('masterhide')
    $('#modeltabdescargable-simple li label').click(function(e) {
        $('#descargabletancontent .tab-pane').removeClass("active")
        let idatt = $(this).attr("data-id-act")
        if( idatt == 'model-descargable-0-tab-simple' ){
            //M1
            $('#mercadoselect-m1').removeClass('masterhide').addClass('masterdis')
            $('#mercadoselect-m2').removeClass('masterdis').addClass('masterhide')
        }
        if( idatt == 'model-descargable-1-tab-simple' ){
            //M2
            $('#mercadoselect-m1').removeClass('masterdis').addClass('masterhide')
            $('#mercadoselect-m2').removeClass('masterhide').addClass('masterdis')
        }
        $('#' + idatt).addClass("active")
    })






  

    //Funciones para la seccion de Autores
    let coutAutores = $('#autor-container .autor-item').length
    var width = $(window).width();
    if (coutAutores === 1) {
        $('.autor-iamge').addClass("col-md-4 mr-5")
        $('.autor-description').addClass("col-md-5")
        if (width < 900) {
            $('.autor-item').removeClass("d-flex")
        } else {
            $('.autor-item').addClass("d-flex")
        }
    }
    if (coutAutores === 2 || coutAutores === 3) {
        $('.autor-item').removeClass('d-flex').addClass("col-md-4")
        $('.autor-iamge').addClass("col-md-9")
        $('.autor-description').addClass("col-md-12")

        if (width < 700) {
            $('#autor-container').removeClass("d-flex")
        } else {
            $('#autor-container').addClass("d-flex")
        }

    }
    if (coutAutores === 4) {
        $('.autor-item').removeClass('d-flex').addClass("col-md-3")
        $('.autor-iamge').addClass("col-md-12")
        $('.autor-description').addClass("col-md-12")
        $('#autor-container').addClass("d-flex ")
        if (width < 900) {
            $('#autor-container').removeClass("d-flex")
        } else {
            $('#autor-container').addClass("d-flex")
        }
    }


    ////////// ARTE //////////

    let wrap_width = undefined
    let img_width = undefined
    let img_height = undefined
    let factor = undefined
    let width_overflow = undefined
    let height_overflow = undefined
    let new_height = undefined

    function adjust_sizes() {

        wrap_width = $("#delclasFlex").width()

        $("#delclasFlex img").each(function() {
            img_width = $(this).width()
            img_height = $(this).height()

            if (img_width > wrap_width) {

                factor = img_width / img_height
                width_overflow = img_width - wrap_width
                height_overflow = width_overflow / factor
                new_height = img_height - height_overflow

                $(this).css('max-height', `${new_height}px`)
            }
        })
    }
    
    adjust_sizes()

    var width = $(window).width();
    if (width < 900){
        $(".art-item img").addClass("width-50-art")
        $(".art-item ").css("width","auto")
        $(".image-art").css("width","auto")
        $("#delclasFlex").removeClass("d-flex flex-wrap").addClass("masonryratabig")
    }else{        
        $(".art-item img").addClass("height-50-art")
    }
    $(".range").change(function () {

        let itemGet = $(".range").val();
        if ( itemGet < 25 ) {
            $(".range").val(0)
            if (width < 900){
                $(".hideformo").hide()
                $("#delclasFlex").removeClass("d-flex flex-wrap").addClass("masonryratasmall")
                $("#delclasFlex").removeClass("masonryrata")
                $("#delclasFlex").removeClass("masonryratabig")

            }else{
                $(".art-item img").addClass("height-0-art")
                $(".art-item img").removeClass('height-50-art')
                $(".art-item img").removeClass('height-100-art')
                $(".hideformo").hide()
                $("#delclasFlex").addClass("d-flex flex-wrap").removeAttr('style')
                $("#delclasFlex .art-item").removeClass('positionar')
            }
            adjust_sizes()
        }
        if ( itemGet < 50 && itemGet > 25 ||  itemGet > 50 && itemGet < 75 ) {
        $(".range").val(50)

        if (width < 900){
                $("#delclasFlex").removeClass("d-flex flex-wrap").addClass("masonryratabig")
                $("#delclasFlex").removeClass("masonryratasmall")
                $("#delclasFlex").removeClass("masonryrata")
                $(".hideformo").show()
        }else{
            $(".art-item img").addClass("height-50-art")
            $(".art-item img").removeClass('height-0-art')
            $(".art-item img").removeClass('height-100-art')
            $(".hideformo").show()
            $("#delclasFlex").addClass("d-flex flex-wrap").removeAttr('style')
            $("#delclasFlex .art-item").removeClass('positionar')
            }
            adjust_sizes()
        }
        if ( itemGet > 75 ) {
        $(".range").val(100)
        if (width < 900){
                $(".hideformo").hide()
                $("#delclasFlex").removeClass("d-flex flex-wrap").addClass("masonryrata")
                $("#delclasFlex").removeClass("masonryratabig")
                $("#delclasFlex").removeClass("masonryratasmall")
        }else{
            $(".art-item img").addClass("height-100-art")
            $(".art-item img").removeClass('height-0-art')
            $(".art-item img").removeClass('height-50-art')
            $(".hideformo").show()
            $("#delclasFlex").removeClass().css("width","100%")
            $("#delclasFlex .art-item").addClass('positionar')
            }
            adjust_sizes()
        }
    })
    

    //Para llegar a la tab de productos al hacer clic en el nombre de diseñador
    //en la ficha de producto
    $('#sectioautores').click(function(e) {
        window.localStorage.setItem('autor', '1');
    })
    if( window.localStorage.getItem('autor') == '1'){   
        $('#myTabAutores .nav-link').removeClass('active')
        $('#myTabContentAutores #biografia').removeClass('active show')
        $('#myTabAutores #productos-tab').addClass('active')
        $('#myTabContentAutores #productos').addClass('active show')         
    }else{
       
    }


    if ($(window).width() < 769) {
     
        // Abrir modal Pedir muestras
        $(".open-modal-muestras").click(function(event) {
            event.preventDefault();
            $(".modal-muestras").stop().animate( {"right": "0%"} );
            $(".modal-left-arte").stop().animate( {"left": "-100%"} );
            $('body').css('overflow-y', 'hidden');
        })
        $('.modal-muestras .fa-times').on('click', function () {
            $('.modal-muestras').stop().animate({
                "right": "-100%"
            });
            $('body').css('overflow-y', 'scroll');
        });
        // Abrir modal que supone
        $(".open-modal-originales").click(function(event) {
            event.preventDefault();
            $(".modal-origninal").stop().animate( {"left": "0%"} );
            $('body').css('overflow-y', 'hidden');
        })
        $('.modal-origninal .fa-times').on('click', function () {
            $('.modal-origninal').stop().animate({
                "left": "-100%"
            });
            $('body').css('overflow-y', 'scroll');
        });
        

    }else{

        // Abrir modal Pedir muestras
        $(".open-modal-muestras").click(function(event) {
            event.preventDefault();
            $(".modal-muestras").stop().animate( {"right": "0%"} );
            $(".modal-left-arte").stop().animate( {"left": "-38%"} );
            $('body').css('overflow-y', 'hidden');
        })
        $('.modal-muestras .fa-times').on('click', function () {
            $('.modal-muestras').stop().animate({
                "right": "-38%"
            });
            $('body').css('overflow-y', 'scroll');
        });
        // Abrir modal que supone
        $(".open-modal-originales").click(function(event) {
            event.preventDefault();
            $(".modal-origninal").stop().animate( {"left": "0%"} );
            $('body').css('overflow-y', 'hidden');
        })
        $('.modal-origninal .fa-times').on('click', function () {
            $('.modal-origninal').stop().animate({
                "left": "-38%"
            });
            $('body').css('overflow-y', 'scroll');
        });
    }

    // Formulario de contacto additional style (nice-select2)
    waitForEl(".select2-paises", function() {
        $(".select2-paises").next().css('border-bottom', '1px solid #b5b5b5');
    })
  
});

// páginas gracias

document.addEventListener('wpcf7mailsent', function (event) {
  if ('192' == event.detail.contactFormId) {
    location = '#';
  } else if ('302' == event.detail.contactFormId) {
    location = '#';
  }
}, false);

