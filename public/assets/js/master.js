/**
 * @Author: Wendy Guadalupe Magaña Argente <wendylu>
 * @Date:   2017-09-06T04:06:48-05:00
 * @Email:  wendyargente@nube.unadmexico.mx
 * @Project: Turing
 * @Filename: master.js
 * @Last modified by:   wendylu
 * @Last modified time: 2017-09-06T05:42:44-05:00
 * @License: MIT
 */



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
