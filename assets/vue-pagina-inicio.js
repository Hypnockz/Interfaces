new Vue({

el:'#pagina-inicio',

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


  }
},


created:{

}



});
