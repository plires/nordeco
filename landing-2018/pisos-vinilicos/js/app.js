$( document ).ready(function() {

  let citaPrevia = $('#cita_previa');

  setInterval(function(){
    $(citaPrevia).toggleClass('cita_previa');
  }, 1000);


  $(function() {
    $('.boton_showroom').bind('click', function(event) {
        let $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 100
        }, 2000, 'easeInOutExpo');
        event.preventDefault();
    });
  });

  $(function() {
      $('.btn_comprar').bind('click', function(event) {
          var $anchor = $(this);
          $('html, body').stop().animate({
              scrollTop: $($anchor.attr('href')).offset().top - 100
          }, 2000, 'easeInOutExpo');
          event.preventDefault();
      });
    });

  $(function() {
    $('.btn_comprar_mobile').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top + 800
        }, 2000, 'easeInOutExpo');
        event.preventDefault();
    });
  });

  //Efecto Wow cuando se produce el scroll
  wow = new WOW(
    {
      animateClass: 'animated',
      offset:       100,
      callback:     function(box) {
      }
    }
  );
  wow.init();
  
});  