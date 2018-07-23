new Vue({
<<<<<<< HEAD
  el: '#lista-compras',

  components: {
    Multiselect: window.VueMultiselect.default
  },
  computed: {


  },

  data: {
    queryNombre: '',
    lista: {
      id: 1,
      nombre: 'lista 1'
    },
		infoLista:[],
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
        super: '',
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
        super: '',
        total: ''
      }
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
				data:send_query,
				dataType: 'json'
			}).done(
				data => {
					this.producto = data.productos;
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
=======
	el:'#lista-compras',

components: {
   Multiselect: window.VueMultiselect.default
 },
  computed:{
     

 },

data:{
	queryNombre:'',
	lista:{id:1,nombre:'lista 1'},
	opcionesOrdernarCot:['Supermercado Más Barato','Menor Precio Total'
  ],
  ordenarCot:['Personalizado'],
  producto:[{id:1,nombre:'Leche Natural Semidescremada',cantidad:1,
  			supermercados:[{nombre:'lider',precio:700},{nombre:'jumbo',precio:740},{nombre:'santa isabel',precio:730},{nombre:'tottus',precio:740},{nombre:'unimarc',precio:760}]
  			,super:'',total:''
  		},
  			{id:2,nombre:'Carne Abastero Cat. V',cantidad:1,
  			supermercados:[{nombre:'lider',precio:6384},{nombre:'jumbo',precio:7180},{nombre:'santa isabel',precio:6780}]
  			,super:'',total:''
  		}
  ]
},

methods:{
	reordenarProductos:function(opcion){
  		console.log("Ordenar por "+opcion);

  		switch (opcion) {
    		
      		case 'Supermercado Más Barato':
        		
        		break;
       		 case 'Menor Precio Total':
				
          		break;
    		default:
      			console.log("WOlolo");
  		}
	},
	
}
});
>>>>>>> dbe34735135d9809cfb23a4576c3a7fda4adc8b2
