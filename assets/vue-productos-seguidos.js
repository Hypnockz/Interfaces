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
  loadingComplete:false,
  queryNombre:'',
  opcionesOrdernarPor:['Nombre','Mayor Oferta','Aumento de Precio'
  ],

  ordenarPor:['Nombre'],


  seguidos:[]
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
