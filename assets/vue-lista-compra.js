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
    producto: [{
        id: 1,
        nombre: 'Leche Natural Semidescremada',
        cantidad: 1,
        supermercados: [{
          nombre: 'lider',
          precio: 700
        }, {
          nombre: 'jumbo',
          precio: 740
        }, {
          nombre: 'santa isabel',
          precio: 730
        }, {
          nombre: 'tottus',
          precio: 740
        }, {
          nombre: 'unimarc',
          precio: 760
        }],
        super: {
          nombre: 'lider',
          precio: 700
        },
        total: ''
      },
      {
        id: 2,
        nombre: 'Carne Abastero Cat. V',
        cantidad: 1,
        supermercados: [{
          nombre: 'lider',
          precio: 6384
        }, {
          nombre: 'jumbo',
          precio: 7180
        }, {
          nombre: 'santa isabel',
          precio: 6780
        }],
        super: {
          nombre: 'lider',
          precio: 6384
        },
        total: ''
      }
    ]
  },

  methods: {
    reordenarProductos: function(opcion) {
      console.log("Ordenar por " + opcion);

      switch (opcion) {

        case 'Supermercado Más Barato':
              
              for(var i=0 ; i<this.producto.length ; i++){
                var data=[];
                for(var j=0 ; j<this.producto[i].supermercados.length ; j++){
                  data[j] = this.producto[i].supermercados[j];
                }
                console.log(data);

              }
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
	}
});

