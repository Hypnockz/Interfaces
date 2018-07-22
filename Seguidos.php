<!doctype html>






<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="assets/css/shop-homepage.css">



  <!-- Vue includes -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-multiselect@2.0.6"></script>
  <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.6/dist/vue-multiselect.min.css">
  <script src="assets/js/vue-paginate.js"></script>

  <title>Deals Watcher</title>

  <!-- Custom styles for this template -->

</head>

<body>

  <?php require 'includes/barranavegacion.php' ?>


  <div class="container" style="margin-left:5px;margin-right:5px; width:100%" id="productos-seguidos">

    <div class="row"style="padding-bottom:40px">

      <div class="col-md-1">

      </div>
      <div class="col-md-11">
        <h1> Productos en seguimiento</h1>

      </div>
    </div>



    <div class="row">

      <div class="col-md-10 col-md-offset-1">

        <div class="panel panel-default" >

          <div class="row row-content"  >
            <div class="col-md-5"></div>

              <div class="col-md-3" style="margin:auto !important">
                <multiselect
                  v-model="ordenarPor"
                  :options="opcionesOrdernarPor"
                  :multiple="false"


                  :hide-selected="false"
                  :allow-empty="false"
                  :open-direction="'bottom'"
                  select-label="Seleccionar"
                  placeholder="Ordenar Por"
                  @select="reordenarProductos"
                  >
                </multiselect>
              </div>

              <div class="col-md-4">
                <form class="navbar-form" role="search">

                  <div class="input-group" style="width:100%">
                    <input v-model="queryNombre" class="form-control input-md" placeholder="Ingrese nombre del producto" type="text">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                  </div>
                </form>
              </div>



          </div>

          <div class="row row-content" id="headers">

            <div class="col-md-1">
              Boton
            </div>

            <div class="col-md-1">
                Imagen
            </div>
            <div class="col-md-3">
                Producto
            </div>


            <div class="col-md-3">
                Menor Precio
            </div>

            <div class="col-md-3">
                Tabla de Precios
            </div>

            <div class="col-md-1">
                Eliminar
            </div>
          </div>


          <div class="row row-product" v-for="producto in filteredProducto" :key="producto.id" >

            <div class="col-md-1  row-content-product" >
               <span class="glyphicon glyphicon-arrow-down" style="font-size:30px"></span>
            </div>

            <div class="col-md-1  row-content-product">
                Imagen
            </div>
            <div class="col-md-3">
                {{producto.nombre}}
            </div>


            <div class="col-md-3">
              <p >
                {{producto.precioActual}}
              </p>

              <span>{{producto.mejorPrecioAnterior}}</span>

            </div>

            <div class="col-md-3">

              <table class="table table-condensed">
    <thead>
      <tr>
        <th>Tienda</th>
        <th>Precio</th>
        </tr>
    </thead>
    <tbody>
      <tr v-for= "valores in producto.listaPrecio" :key="valores.supermercado">
        <td>{{valores.supermercado}}</td>
        <td>{{valores.precio}}</td>

      </tr>
    </tbody>
  </table>
            </div>

            <div class="col-md-1  row-content-product" >
               	<span @click="deleteProductoSeguido(producto.id)" class="glyphicon glyphicon-trash" style="font-size:30px" ></span>
            </div>
          </div>
          </div>


          <div class="panel-body">Panel Content



          </div>
        </div>
      </div>




      <!-- /.col-lg-9 -->



<!--END Number Navigator-->

    </div>
    <!-- /.row -->

  </div>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

  <script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <script src="assets/vue-productos-seguidos.js"></script>
</body>

<footer class="container">
  <p>&copy; Company 2017-2018</p>
</footer>

<style>

body{

  padding-top: 0px;
}

.multiselect{
  margin-top: 5px;

}

.row-content{
  margin-left: 0px;
  margin-right:  0px;
}

.row-product{
  margin-left: 0px;
  margin-right:  0px;
  padding-top: 20px;
  padding-bottom:20px;
  text-align: center;

}

.row-content-product{
  vertical-align: middle;
}

#headers{

  text-align: center;
  padding-top: 20px;
  padding-bottom: 20px;
  background-color: #e5e5e5;
  border: solid 1px black;
  font-size: 20px;
}

</style>

</html>
