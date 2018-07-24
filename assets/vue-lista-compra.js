new Vue({

  el: '#lista-compras',

  components: {
    Multiselect: window.VueMultiselect.default
  },
  computed: {
   
  },

  data: {
    opcionesOrdernarCot: ['Supermercado Más Barato', 'Menor Precio Total'],
    ordenarCot: ['Menor Precio Total'],
    producto: [
    ],
    total: 0,
    porEliminar:''
  },


  methods: {
    CalcularTotal: function(){
      var t=0;
      for(var i=0 ; i<this.producto.length ; i++){
        t=t+this.producto[i].cantidad*this.producto[i].super.precio;
      }
      this.total=t;
    },

    reordenarProductos: function(opcion) {
      console.log("Ordenar por " + opcion);

      switch (opcion) {

        case 'Supermercado Más Barato':
              
              /*for(var i=0 ; i<this.producto.length ; i++){
                var data=[];
                for(var j=0 ; j<this.producto[i].supermercados.length ; j++){
                  data[j] = this.producto[i].supermercados[j];
                }
                console.log(data);

              }*/
          break;
        case 'Menor Precio Total':

          break;
        default:
          console.log("WOlolo");
      }
    },

		obtenerInfoLista:function(){
			let send_query ={
				id: id_lista
			};
			$.ajax({
				url: 'php/get_info_lista.php',
				type: 'get',
				data:send_query,
				dataType: 'json'
			}).done(
				data => {
          console.log(data);
          
					this.producto = data;
				}
			).fail(
				function() {
					//alert("failed");
				}
			).always(
				function(data) {}
			);

		},
      deleteProductoLista(id_producto) {
      console.log(id_producto);

      $("#ModalEliminar").modal({
        backdrop: 'static'
      });
      $("#ModalEliminar").on('shown.bs.modal');
      this.porEliminar= id_producto;


    },
    eliminacionConfirmadaDeLista:function(){
      console.log("Por eliminar "+ this.porEliminar);
      var aux = this.porEliminar;
      console.log("Item eliminar:"+parseInt(aux));
      var aux2 = [];
      for (var i = 0; i < this.producto.length; i++) {
        if(parseInt(this.producto[i].id) == parseInt(aux)){
          console.log("Eliminar "+ this.producto[i].id);
        }
        else{
          aux2.push(this.producto[i]);
        }
      }
      console.log(aux2);
      this.producto = aux2;
      this.eliminarDeDB(aux);


   },
   eliminarDeDB:function(id){

     var sendData ={
       eliminar: id
     };
     $.ajax({
       url: 'php/eliminar_producto_lista_compra.php',
       data: sendData,
       type: 'post',
       dataType: 'json'
     }).done(
       data => {
        $('#ModalEliminar').modal('hide');
         this.obtenerInfoLista();
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
  

	created(){
		this.obtenerInfoLista();
    this.CalcularTotal();
	}
});

