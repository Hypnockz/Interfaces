new Vue({


el:'#vue-result-busq',

components: {
   Multiselect: window.VueMultiselect.default,
   MoonLoader
 },

 computed:{
     filteredProductoPrecio: function(){
       //console.log('Buscar por nombre');
       var r =this.productosQuery.filter(producto=>{
         return parseInt(producto.precio) >= parseInt(this.precioMinimoSlider) &&  parseInt(producto.precio) <= parseInt(this.precioMaximoSlider) && (this.productoEstaEnTiendaSeleccionada(producto));
       });
          this.productosMatch = r.length;
          return r;
       return
     },

 },

data:{

  /*Sliders Precio*/
  loadingComplete:false,
  precioMinimoSlider:0,
  precioMaximoSlider:100000,
  productosMatch:0,
  infoPrecios : [],
  textoBusqueda:'Leche Colún',
  supermercadosSeleccionados:[],
  supermercados:[

  ],

  paginate:['productos'],

  productosQuery :[


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

  productoEstaEnDcto:function(precioOferta, precioAnterior){
    console.log("Precio Oferta: "+ precioOferta +", Precio: "+precioAnterior);
    console.log(parseInt(precioOferta)- parseInt(precioAnterior) >= 0);
    if(parseInt(precioOferta)- parseInt(precioAnterior) >= 0){
      return false;
    }
    else{return true}
  },

  goToFirstPage:function() {

   if (this.$refs.paginatorProductos) {
     console.log("GO "+ this.$refs.paginatorProductos);
    console.log("GOL "+this.$refs.paginatorProductos.lastPage);
    if (this.$refs.paginatorProductos.lastPage==0) {
      //this.$refs.paginatorProductos.goToPage(0);
      //this.$refs.paginatorProductos.goToPage(1);
    }
          else{
            this.$refs.paginatorProductos.goToPage(1);
            this.filte
          }
     console.log("Go First Page");
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
      this.goToFirstPage()
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
          this.loadingComplete = true;
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
            //this.productoEstaEnTiendaSeleccionada();
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
          this.productosQuery[i].masBaratoEn = "a";
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
              this.productosQuery[i].masBaratoEn  = this.productosQuery[i].precios[j].nombre;
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
        },

        productoEstaEnTiendaSeleccionada:function(producto){
          var estaSupermercado= false;
            console.log("PP "+JSON.stringify(producto));
            console.log("PP "+JSON.stringify(producto.supermercados));
            console.log("Producto tienda seleccionada");
            console.log(this.supermercadosSeleccionados.length);

          //  console.log("array "+ arrayS);
            for (var i = 0; i < this.supermercadosSeleccionados.length; i++) {
              console.log("S%B "+this.supermercadosSeleccionados[i].nombre);
              for (var j= 0; j < producto.supermercados.length; j++) {
                console.log("S%A "+producto.supermercados[j].nombre);

                if (producto.supermercados[j].nombre === this.supermercadosSeleccionados[i].nombre) {
                    estaSupermercado = true;
                    console.log("Match");
                    break;
                }

              }

            }
            return estaSupermercado;
        },

        getImagenProducto:function(id){

            return 'assets/img/'+id+'.png';
        },

        irADetalleProducto:function(id){
          window.location.href ="Producto.php?id="+id;
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
