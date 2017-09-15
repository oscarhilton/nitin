jQuery( document ).ready( function( $ ) {

  $('#fullpage').fullpage({
      lazyLoading: true
  });


  $(window).scroll(function(){
    var $hero = $('.hero-section').find('.background');
    var $header = $('.header');
    var scroll = $(window).scrollTop();
    var height = $hero.height();
    var percent = 1 - (scroll / height);
    $hero.css({
      'opacity': percent,
      'transform': 'translateY(' + percent * scroll + 'px)'
    });
    $header.css('background', 'rgba(16, 17, 19,' + (scroll / height) +')');
    $('.play-btn').css('opacity', percent);
    console.log(percent);
  });

  $('.play-btn').on('click', function(){
    $('.hero-section').addClass('play');
  })

  $('.burger-icon').on('click', function(){
    $('body').toggleClass('menu-open');
  })

  $('#content').on('click', function(){
    $('body').removeClass('menu-open');
  })

});
