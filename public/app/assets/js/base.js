/**
 * @Author: Wendy Guadalupe Magaña Argente <wendylu>
 * @Date:   2017-09-08T22:44:19-05:00
 * @Email:  wendyargente@nube.unadmexico.mx
 * @Project: Turing
 * @Filename: base.js
 * @Last modified by:   wendylu
 * @Last modified time: 2017-09-10T21:57:44-05:00
 * @License: MIT
 */
$(document).ready(function(){

  var w = window.innerWidth;
  var uri = window.location.href;
  var base_url;

  // Configuración para la página de categorías
  if (uri.includes('categorias')) {
    console.log("Estoy en la página de categorías");
    $('.contenedor__principal').css('width', '100%');
  }


  console.log("Uri es: ");
  if (uri.includes('index.php'))
  {
    console.log(uri);
    console.log("La uri contiene la palabra index.php");
    base_url = "../public/app/"
  }
  else {
    console.log(uri);
    console.log("La uri no contiene index");
    base_url = "public/app/";
  }



  // Configuración para la portada del carrusel
  $(".carrusel").vegas({
    slides: [
      { src: base_url + "/assets/imagenes/libros10.jpg" },
      { src: base_url + "/assets/imagenes/libros3.jpeg" },
      { src: base_url + "/assets/imagenes/libros4.jpeg" },
      { src: base_url + "/assets/imagenes/libros5.jpeg" },
      { src: base_url + "/assets/imagenes/libros6.jpg" },
      { src: base_url + "/assets/imagenes/libros7.jpg" },
      { src: base_url + "/assets/imagenes/libros8.jpg" },
      { src: base_url + "/assets/imagenes/libros9.jpg" },
      { src: base_url + "/assets/imagenes/libros10.jpg" },
    ],
    animation: 'kenburns',
    overlay: base_url + '/assets/js/vegas/overlays/01.png',
  });


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



  // Función para cerrar los mensajes
  $('.close').click(function(){
    console.log("este es un click");
    var data = $(this).data();
    $(data.target).remove();
    console.log("Mensaje: "+ data.target+ " removido");
  });


});


var app = new Vue({
  el: '#app',

  data: {
    valor: true,
    autor_nuevo_nombres: "",
    autor_nuevo_apellidos: "",
    autor_nuevo_pais: "",

    autor_existente: "",
    categoria_nueva: "",
    categoria_existente: ""
  },
  methods: {
    datos_autor: function() {

      this.valor = (this.autor_nuevo_nombres != "") || (this.autor_nuevo_apellidos != "") || (this.autor_nuevo_pais != "")
      return this.valor
    }
  }

});
