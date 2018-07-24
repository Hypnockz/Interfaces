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

    irADetalleProducto:function(id){
      window.location.href ="Producto.php?id="+id;
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
          console.log("Min Producto:"+ this.seguidos[i].nombre);
          console.log("Min Producto:"+ this.seguidos[i].precios.length);

          if (parseInt(this.seguidos[i].precios[j].precio_oferta) <= parseInt(precioMinOferta)) {
            console.log("Min "+precioMinOferta);

            precioMinOferta = this.seguidos[i].precios[j].precio_oferta;
            this.seguidos[i].masBaratoEn = this.seguidos[i].precios[j].nombre;
            console.log("MinAhora "+precioMinOferta);
            this.seguidos[i].masBaratoEn = this.seguidos[i].precios[j].nombre;
          }

          if (parseInt(this.seguidos[i].precios[j].precio) <= parseInt(precioMinNormal)) {
            precioMinNormal = this.seguidos[i].precios[j].precio;

          }

        }
        this.seguidos[i]['precioOferta'] = precioMinOferta ;
        this.seguidos[i]['precioAnterior'] = precioMinNormal ;
      }
    },

    productoEstaEnDcto:function(precioOferta, precioAnterior){
      console.log("Precio Oferta: "+ precioOferta +", Precio: "+precioAnterior);
      console.log(parseInt(precioOferta)- parseInt(precioAnterior) >= 0);
      if(parseInt(precioOferta)- parseInt(precioAnterior) >= 0){
        return false;
      }
      else{return true}
    },

    colorPrecioTabla:function(precioOferta, precioAnterior){
      console.log("Color ||| Precio tabla: "+ precioOferta +", Precio: "+precioAnterior);
      console.log(parseInt(precioOferta)- parseInt(precioAnterior) >= 0);
      if(parseInt(precioOferta)- parseInt(precioAnterior) >= 0){
        return false;
      }
      else{return true}
    },


    eliminacionConfirmadaDeLista:function(){
      console.log("Por eliminar "+ this.porEliminar);
      var aux = this.porEliminar;
      console.log("Item eliminar:"+parseInt(aux));
      var aux2 = [];
      for (var i = 0; i < this.seguidos.length; i++) {
        if(parseInt(this.seguidos[i].id) == parseInt(aux)){
          console.log("Eliminar "+ this.seguidos[i].id);
        }
        else{
          aux2.push(this.seguidos[i]);
        }
      }
      console.log(aux2);
      this.seguidos = aux2;
      this.eliminarDeDB(aux);


   },

   eliminarDeDB:function(id){

     var sendData ={
       eliminar: id
     };
     $.ajax({
       url: 'php/eliminar_producto_lista_seguidos.php',
       data: sendData,
       type: 'post',
       dataType: 'json'
     }).done(
       data => {
         this.getProductosSeguidos();
         $('#ModalEliminar').modal('hide');
       }
     ).fail(
       function() {
         //alert("failed");
       }
     ).always(
       function(data) {}
     );

   }


  },

  created() {
    this.getProductosSeguidos();


  }


});
