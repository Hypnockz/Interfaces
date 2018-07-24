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

		}

  },
  

	created(){
		this.obtenerInfoLista();
    this.CalcularTotal();
	}
});

