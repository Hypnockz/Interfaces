new Vue({

  el: '#lista-compras',

  components: {
    Multiselect: window.VueMultiselect.default
  },
  computed: {


  },

  data: {
    opcionesOrdernarCot: ['Supermercado Más Barato', 'Menor Precio Total'],
    ordenarCot: ['Personalizado'],
    producto: [
    ]
  },

  methods: {
    reordenarProductos: function(opcion) {
      console.log("Ordenar por " + opcion);

      switch (opcion) {

        case 'Supermercado Más Barato':

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
				data: send_query,
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
	}
});

