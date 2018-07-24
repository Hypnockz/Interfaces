var barraNavJS = new Vue({

el:'#barra-nav',

data:{

categorias:[]

},

methods:{

  getCategorias:function(){

    $.ajax({
      url: 'php/get_categorias.php',
      type: 'post',
      dataType: 'json'
    }).done(
      data => {
        console.log(data);
        this.categorias = data;
      }
    ).fail(
      function() {
        //alert("failed");
      }
    ).always(
      function(data) {}
    );


  },

  irBusquedaCategoria:function(cat){
    console.log(cat);
    window.location.href = 'BusquedaCategoria.php?c='+cat
  }
},


created(){
  this.getCategorias();

}



});
