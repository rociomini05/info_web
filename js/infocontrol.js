// =============================== //
//            PARALLAX             //
// =============================== //


$(window).scroll(function(){
    var inicio = $('.servicios').offset();
    if(inicio.top < $(window).scrollTop() && $(window).width() > 768 ){
        var barra = $(window).scrollTop(),
        posicion = (barra * 0.18);
        $('.videos').css({
            'background-position': '0 -' + posicion + 'px'
        });
    }
});

$(window).on('resize', function(){
    if($(window).width() < 768){
        $('.videos').css({
            'background-position': '0 0'
        });
    }
})


// =============================== //
//              VIDEO              //
// =============================== //

var $play = $('.videos .play-container a'),
    $video = $('.modal-video'),
    $cerrar = $video.find('.icon-cross')

$play.on('click', function(){
    $video.css({display: 'flex'})
});

$cerrar.click(function(){
    $video.css({display: 'none'});
    $('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
})

$(document).on('keydown',function(e){
    if ( e.which == 27 ) {
        $video.css({display: 'none'});
        $('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
    }
});



// =============================== //
//          TESTIMONIALES          //
// =============================== //
$('.owl-carousel.testimoniales').owlCarousel({
    loop: true,
    nav: true,
    autoplay: false,
    navText: ['<span class="icon-chevron-left"></span>', '<span class="icon-chevron-right"></span>'],
    smartSpeed: 300,
    items: 1,
    dots: true,
})


// =============================== //
//             CLIENTES            //
// =============================== //
$('.owl-carousel.carousel-clientes').owlCarousel({
    loop: true,
    nav: false,
    autoplay: true,
    navText: ['<span class="icon-chevron-left"></span>', '<span class="icon-chevron-right"></span>'],
    smartSpeed: 800,
    autoplayTimeout: 2000,
    dots: false,
    responsive : {
        0 : {
            items: 2,
            margin: 20
        },
        730 : {
            items: 4,
            margin: 0

        }
    }
})


// =============================== //
//              MENU               //
// =============================== //

$(window).scroll(function(){

    var $menu = $('header nav'),
        $hero = $('.hero'),
        $window = $(window);

    if($window.width() > 769){
        if($window.scrollTop() >= 42){
            $menu.css({
                position: 'fixed'
            })
            $hero.css({
                marginTop: '64px'
            })
        } else {
            $menu.css({
                position: 'static'
            })
            $hero.css({
                marginTop: '0px'
            })
        }
    }
});

var $btnMenu = $('.btn-menu'),
    $menu = $('header nav ul');

$btnMenu.on('click', function(){
    $menu.slideToggle();
})

$(window).on('resize', function(){
    if($(window).width() > 768){
        $menu.show();
    } else {
        $menu.hide();
    }
})








$('nav ul li:not(.login, .idioma) a, .servicios a, .control-de-contratistas a, .beneficios a').on('click', function(e){
    e.preventDefault();

    var target = $(this).attr('href'),
        destino = $('#'+target).offset().top - 60;

    $('html, body').animate({
        scrollTop: destino,
    }, 900);
})