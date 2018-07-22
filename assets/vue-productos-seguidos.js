new Vue({

el:'#productos-seguidos',

components: {
   Multiselect: window.VueMultiselect.default
 },

 computed:{
     filteredProducto: function(){
       //console.log('Buscar por nombre');
       return this.seguidos.filter(producto=>{
         return producto.nombre.toLowerCase().indexOf(this.queryNombre.toLowerCase()) > -1
       })
     },

 },

data:{

  queryNombre:'',
  opcionesOrdernarPor:['Nombre','Mayor Oferta','Aumento de Precio'
  ],

  ordenarPor:['Nombre'],


  seguidos:[

    {id:1,nombre:'Leche Soprole 1L',
     precioActual:660,
     mejorPrecioAnterior:710,
    listaPrecio:[{supermercado:'Tottus', precio:660},
        {supermercado:'Lider', precio:700},
        {supermercado:'Jumbo', precio:670}
      ]
    },

    {id:2,nombre:'Bebida Coca Cola 2lt',
     precioActual:1990,
     mejorPrecioAnterior:1890,
    listaPrecio:
        [{supermercado:'Lider', precio:2120},
        {supermercado:'Santa Isabel', precio:2000},
        {supermercado:'Jumbo', precio:1990}
        ]

    },

    {id:3,nombre:'Papas Fritas Lays Onduladas 320gr',
     precioActual:1790,
     mejorPrecioAnterior:1790,
    listaPrecio:
        [{supermercado:'Lider', precio:1790},
        {supermercado:'Santa Isabel', precio:2000},
        {supermercado:'Jumbo', precio:1890}
        ]

    }
  ]
},



methods:{

  sortProductsByName:function(){

    this.seguidos.sort(this.compareByName);
  },

  compareByName:function(a,b){
  if (a.nombre < b.nombre)
    return -1;
  if (a.nombre > b.nombre)
    return 1;
  return 0;
},

compareByDiscount:function(a,b){
var temp1= a.precioActual- a.mejorPrecioAnterior;
var temp2= b.precioActual- b.mejorPrecioAnterior;
console.log(temp1);
console.log(temp2);
if (temp1 < temp2)
  return -1;
if (temp1  > temp2)
  return 1;
return 0;
},

reordenarProductos:function(opcion){
  console.log("Ordenar por "+opcion);

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

deleteProductoSeguido(id_producto){
console.log(id_producto);


this.seguidos = this.seguidos.filter(function(item) {
    return item.id !== id_producto;
});
}


},

created(){
  this.sortProductsByName();
}


});
