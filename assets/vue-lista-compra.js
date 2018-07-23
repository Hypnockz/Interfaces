new Vue({
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