
new Vue({


el:'#vue-result-busq',

components: {
   Multiselect: window.VueMultiselect.default
 },

 computed:{
     filteredProductoPrecio: function(){
       //console.log('Buscar por nombre');
       return this.productosQuery.filter(producto=>{
         return parseInt(producto.precio) >= parseInt(this.precioMinimoSlider) &&  parseInt(producto.precio) <= parseInt(this.precioMaximoSlider)
       })
     },

 },

data:{

  /*Sliders Precio*/

  precioMinimoSlider:0,
  precioMaximoSlider:100000,

  infoPrecios : [],
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
{id:'7', nombre:'Leche7', marca:'Colun', precio:'1500'},
{id:'8', nombre:'Leche8', marca:'Colun', precio:'460'},
{id:'9', nombre:'Leche9', marca:'Colun', precio:'500'},
{id:'10', nombre:'Leche10', marca:'Colun', precio:'600'}


  ]
},

methods:{

  labelSupermercado(option) {
    return `${option.nombre}`
  },

  putValueMax:function(){
    console.log(this.$refs.sliderMaximo);
    console.log(this.$refs.sliderMaximo.value);
    this.precioMaximoSlider = this.$refs.sliderMaximo.value;
    this.checkRangoValido();
    this.goToFirstPage();
  },

  putValueMin:function(){
     this.precioMinimoSlider = this.$refs.sliderMinimo.value;
     this.checkRangoValido();
     this.goToFirstPage();
  },

  goToFirstPage:function() {
   if (this.$refs.paginatorProductos) {
     this.$refs.paginatorProductos.goToPage(1);
   }
 },

  checkRangoValido:function(){
    console.log("PrecioMinimo "+this.precioMinimoSlider);
    console.log("PrecioMaximo "+this.precioMaximoSlider);
//console.log( this.precioMinimoSlider > this.precioMaximoSlider);
      if(parseInt(this.precioMinimoSlider) > parseInt(this.precioMaximoSlider)){
          console.log("Enter if");
        var temp = this.precioMinimoSlider;
        this.precioMinimoSlider = this.precioMaximoSlider;
        this.precioMaximoSlider = temp;
      }
  },

  inicialRangoPrecios:function(){

      var precioMinimo= 1000000;
      var precioMax = -1;
      for (var i = 0; i < this.productosQuery.length; i++)  {
        console.log(this.productosQuery[i]);
        console.log(precioMinimo);
        console.log(this.productosQuery[i].precio);
        if (parseInt(this.productosQuery[i].precio) < precioMinimo) {precioMinimo = parseInt(this.productosQuery[i].precio)}
        if (parseInt(this.productosQuery[i].precio) > precioMax) {precioMax = parseInt(this.productosQuery[i].precio)}
        }

        console.log(this.$refs.sliderMinimo);
        this.$refs.sliderMinimo.min= precioMinimo;
        this.$refs.sliderMinimo.max= precioMax;
        this.$refs.sliderMinimo.value= precioMinimo;
        this.precioMinimoSlider= precioMinimo;
        this.$refs.sliderMaximo.min= precioMinimo;
        this.$refs.sliderMaximo.max= precioMax;
        this.$refs.sliderMaximo.value= precioMax;
        this.precioMaximoSlider= precioMax;
      },

      obtenerProductos:function(){


        let send_query ={
          producto: this.capitalizeFirstLetter(query)
        };
        $.ajax({
          url: 'php/buscar_productos.php',
          type: 'get',
          data:send_query,
          dataType: 'json'
        }).done(
          data => {
            console.log("Productos Coincidentes "+data)
            this.productosQuery = data;
            this.setPreciosProductos();
          }
        ).fail(
          function() {
            //alert("failed");
          }
        ).always(
          function(data) {}
        );
      },

      obtenerSupermercados:function(){
        $.ajax({
          url: 'php/buscar_supermercados.php',
          type: 'post',
          dataType: 'json'
        }).done(
          data => {
            console.log(data);
            this.supermercados = data;
            this.supermercadosSeleccionados = data;
          }
        ).fail(
          function() {
            //alert("failed");
          }
        ).always(
          function(data) {}
        );
      },

      setPreciosProductos:function(){
        for (var i = 0; i < this.productosQuery.length; i++) {
          var precioMinimoProducto =1000000;
        //  var precioMaxProducto =-1;
          console.log(i);
          this.productosQuery[i].supermercados=[];
          for (var j =0 ; j <this.productosQuery[i].precios.length; j++) {
            var temp = new Object;
            console.log("T1" + JSON.stringify(temp));
            console.log(" Precio J" +JSON.stringify(this.productosQuery[i].precios[j]));
            temp['id'] = this.productosQuery[i].precios[j].id;
            temp['nombre']= this.productosQuery[i].precios[j].nombre;

            console.log( "T2" +JSON.stringify(temp));
            this.productosQuery[i].supermercados.push(temp);



            if(this.productosQuery[i].precios[j].precio_oferta < precioMinimoProducto){
              precioMinimoProducto = this.productosQuery[i].precios[j].precio_oferta;
            }

          }
          this.productosQuery[i].precio = precioMinimoProducto;
        }
        this.inicialRangoPrecios();
      },

     capitalizeFirstLetter:function(string) {
          string = string.toLowerCase();
          console.log(string);
          return string.charAt(0).toUpperCase() + string.slice(1);
        }




  },



mounted()
{
  this.obtenerProductos();
  this.obtenerSupermercados();

},

created(){
this.textoBusqueda = query;


}

});
