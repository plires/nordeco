$(document).on('ready', function() {

  /* Pop up */
  // Funcion que dispara el popup
  // $("#pop-up, #popup-box").hide();
  // $(document).ready(function() {

  //   $("#pop-up").click(() => {
  //       $("#pop-up, #popup-box").hide();
  //   });

  //   var delay = 100; // milliseconds

  //   $("#pop-up").delay(delay).fadeIn("fast", () => {
  //       $("#popup-box").fadeIn("fast", () => {});
  //   });

  //   $("#popup-close").click(() => {
  //       $("#pop-up, #popup-box").hide();
  //   });

  // });
  /* Pop up end */

  // Plugin Slick (Carrousel Galeria) Funcion
  $('.responsive').slick({
    autoplay: true,
    autoplaySpeed: 1500,
    infinite: true,
    speed: 500,
    arrows: false,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

});