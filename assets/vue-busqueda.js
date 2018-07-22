var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value; // Display the default slider value

console.log(slider);
// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
    output.innerHTML = this.value;
    console.log(this.value);
}


new Vue({


el:'#vue-result-busq',

components: {
   Multiselect: window.VueMultiselect.default
 },

data:{
  textoBusqueda:'Leche Colún',
  supermercadosSeleccionados:[],
  supermercados:[
  {id:1,nombre:'Santa Isabel'},
  {id:2,nombre:'Tottus'},
  {id:3,nombre:'Lider'},
  {id:4,nombre:'Jumbo'},
  {id:5,nombre:'Unimarc'}
  ],

  paginate:['productos'],

  productosQuery :[
{id:'1', nombre:'Leche1', marca:'Colun', precio:'1100'},
{id:'2', nombre:'Leche2', marca:'Colun', precio:'1100'},
{id:'3', nombre:'Leche3', marca:'Colun', precio:'1100'},
{id:'4', nombre:'Leche4', marca:'Colun', precio:'1100'},
{id:'5', nombre:'Leche5', marca:'Colun', precio:'1100'},
{id:'6', nombre:'Leche6', marca:'Colun', precio:'1100'},
{id:'7', nombre:'Leche7', marca:'Colun', precio:'1100'},
{id:'8', nombre:'Leche8', marca:'Colun', precio:'1100'},
{id:'9', nombre:'Leche9', marca:'Colun', precio:'1100'},
{id:'10', nombre:'Leche10', marca:'Colun', precio:'1100'}


  ]
},

methods:{

  labelSupermercado(option) {
    return `${option.nombre}`
  }

}


});
