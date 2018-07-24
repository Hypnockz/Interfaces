new Vue({

  el: '#productos-seguidos',

  components: {
    Multiselect: window.VueMultiselect.default
  },

  computed: {
    filteredProducto: function() {
      //console.log('Buscar por nombre');
      return this.seguidos.filter(producto => {
        return producto.nombre.toLowerCase().indexOf(this.queryNombre.toLowerCase()) > -1
      })
    }


  },

  data: {
    loadingComplete: false,
    porEliminar:0,
    queryNombre: '',
    opcionesOrdernarPor: ['Nombre', 'Mayor Oferta', 'Aumento de Precio'],

    ordenarPor: ['Nombre'],


    seguidos: []
  },



  methods: {

    getProductosSeguidos: function() {
      $.ajax({
        url: 'php/get_productos_seguidos.php',
        type: 'post',
        dataType: 'json'
      }).done(
        data => {
          console.log(data);
          this.seguidos = data;
          this.sortProductsByName();
          this.analizarPrecios();
          //this.productoEstaEnTiendaSeleccionada();
        }
      ).fail(
        function() {
          //alert("failed");
        }
      ).always(
        function(data) {}
      );

    },

    sortProductsByName: function() {

      this.seguidos.sort(this.compareByName);
    },

    compareByName: function(a, b) {
      if (a.nombre < b.nombre)
        return -1;
      if (a.nombre > b.nombre)
        return 1;
      return 0;
    },

    compareByDiscount: function(a, b) {
      var temp1 = a.precioOferta - a.precioAnterior;
      var temp2 = b.precioOferta - b.precioAnterior;
      console.log(temp1);
      console.log(temp2);
      if (temp1 < temp2)
        return -1;
      if (temp1 > temp2)
        return 1;
      return 0;
    },

    reordenarProductos: function(opcion) {
      console.log("Ordenar por " + opcion);

      switch (opcion) {
        case 'Nombre':
          this.sortProductsByName();
          break;
        case 'Mayor Oferta':
          this.seguidos.sort(this.compareByDiscount);
          break;
        case 'Aumento de Precio':
          this.seguidos.sort(this.compareByDiscount);
          this.seguidos.reverse();
          break;
        default:
          console.log("WOlolo");
      }
    },

    deleteProductoSeguido(id_producto) {
      console.log(id_producto);

      $("#ModalEliminar").modal({
        backdrop: 'static'
      });
      $("#ModalEliminar").on('shown.bs.modal');
      this.porEliminar= id_producto;


    },

    getImagenProducto: function(id) {

      return 'assets/img/' + id + '.png';
    },

    analizarPrecios: function() {
      for (var i = 0; i < this.seguidos.length; i++) {
        var precioMinOferta = 1000000;
        var precioMinNormal = 1000000;
        this.seguidos[i].masBaratoEn = "a";
        for (var j = 0; j < this.seguidos[i].precios.length; j++) {
          if (this.seguidos[i].precios[j].precio_oferta < precioMinOferta) {
            precioMinOferta = this.seguidos[i].precios[j].precio_oferta;
            this.seguidos[i].masBaratoEn = this.seguidos[i].precios[j].nombre;
          }

          if (this.seguidos[i].precios[j].precio < precioMinNormal) {
            precioMinNormal = this.seguidos[i].precios[j].precio;
            //this.seguidos[i].masBaratoEn = this.seguidos[i].precios[j].nombre;
          }

        }
        this.seguidos[i]['precioOferta'] = precioMinOferta ;
        this.seguidos[i]['precioAnterior'] = precioMinNormal ;
      }
    },

    productoEstaEnDcto:function(precioOferta, precioAnterior){
      if(parseInt(precioOferta)- parseInt(precioAnterior) >= 0){
        return false;
      }
      else{return true}
    },

    eliminacionConfirmadaDeLista:function(){
      console.log(this.porEliminar);
      console.log(this.seguidos.filter(function(item) {
        return item.id !== this.porEliminar;
      }));

    this.seguidos = this.seguidos.filter(function(item) {
      console.log(JSON.stringify(item)+ '\n');
      return item.id !== this.porEliminar;
    });
     $('#ModalEliminar').modal('hide');

    }


  },

  created() {
    this.getProductosSeguidos();

  }


});
