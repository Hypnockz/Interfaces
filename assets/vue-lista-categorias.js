var barraNavJS = new Vue({

el:'#barra-nav',

data:{

categorias:[],
listas:[]
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

  getListas:function(){

    $.ajax({
      url: 'php/get_listas.php',
      type: 'post',
      dataType: 'json'
    }).done(
      data => {
        console.log(data);
        this.listas = data;
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
  },
  goLista:function(id){

    window.location.href = 'ListaCom.php?id='+id
  }
},


created(){
  this.getCategorias();
  this.getListas();

}



});
