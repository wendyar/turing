$(document).ready(function(){

  var w = window.innerWidth;

  if (w > 768) {
    $(".carrusel").vegas("play");
    console.log("playing...");
  }
  else {
    $(".carrusel").vegas("pause");
    console.log("pause...");
  }

  $(window).resize(function(){
    if ($(window).width() > 768) {
      $(".carrusel").vegas("play");
      console.log("playing...");
    }
    else {
      $(".carrusel").vegas("pause");
      console.log("pause...");
    }
  });

});

$(".carrusel").vegas({
  slides: [
    { src: "assets/imagenes/libros1.jpeg" },
    { src: "assets/imagenes/libros3.jpeg" },
    { src: "assets/imagenes/libros4.jpeg" },
    { src: "assets/imagenes/libros5.jpeg" },
    { src: "assets/imagenes/libros6.jpg" },
    { src: "assets/imagenes/libros7.jpg" },
    { src: "assets/imagenes/libros8.jpg" },
    { src: "assets/imagenes/libros9.jpg" },
    { src: "assets/imagenes/libros10.jpg" },
  ],
  animation: 'kenburns',
  overlay: 'assets/js/vegas/overlays/01.png',
});
