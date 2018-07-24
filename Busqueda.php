<!doctype html>
<html lang="es">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="assets/css/shop-homepage.css">



<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://unpkg.com/vue-multiselect@2.0.6"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.6/dist/vue-multiselect.min.css">
<script src="assets/js/vue-paginate.js"></script>

<script src="assets/js/vue-spinner.js"></script>
<script>
  var MoonLoader = VueSpinner.MoonLoader
</script>



<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">


  <title>Deals Watcher</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets/css/jumbotron.css" rel="stylesheet">
</head>

<body>

  <?php require 'includes/barranavegacion.php' ?>


  <div class="container" style="margin-left:5px;margin-right:5px; width:100%; min-height:800px" id="vue-result-busq" >

    <div class="row"style="margin:10px;padding-bottom:40px">

      <h1> Buscando : {{textoBusqueda}}</h1>
    </div>

    <div class="row" >

      <div class="col-md-3">

        <div class="panel panel-default">
          <div class="panel-heading"><h3>Filtros</h3></div>
          <div class="panel-body">

              <div class="row row-filtro">
                    <h4>Precio Máximo: </h4>

                    <div class="slidecontainer">
                      <input v-model="precioMaximoSlider" v-on:change="putValueMax" ref="sliderMaximo" type="range" min="1" max="100" value="20"  id="myRange">
                    </div>

                  <p>
                      {{precioMaximoSlider}}
                  </p>
              </div>

              <div class="row row-filtro">
                    <h4>Precio Mínimo: </h4>

                    <div class="slidecontainer">
                      <input v-model="precioMinimoSlider" v-on:change="putValueMin" ref="sliderMinimo" type="range" min="1" max="100" value="50"  id="myRange2">
                    </div>
                    <p>
                        {{precioMinimoSlider}}
                    </p>

              </div>

              <div class="row row-filtro">
                    <h4>Tiendas: </h4>

                    <multiselect
                      v-model="supermercadosSeleccionados"
                      :options="supermercados"
                      :multiple="true"
                      track-by="id"
                      :custom-label="labelSupermercado"
                      :hide-selected="true"
                      :allow-empty="true"
                      :open-direction="'bottom'"
                      select-label="Seleccionar"
                      placeholder="Seleccione las tiendas"
                    >
                    </multiselect>
              </div>

          </div>
        </div>
      </div>

      <div class="col-md-9">

        <div class="panel panel-default">
          <div class="panel-body" v-show="loadingComplete">

            <div class="row">

              <paginate ref="paginatorProductos"
                name="productos"
                :list="filteredProductoPrecio"
                :per="9"
              >

                  <div v-for="product in paginated('productos')" class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                      <a href="#"><img class="card-img-top" src="" alt=""></a>
                      <div class="card-body">
                        <h4 class="card-title">
                          <a href="#">{{product.nombre}}</a>
                        </h4>
                        <h5>{{product.precio}}</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                      </div>
                      <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                      </div>
                    </div>
                  </div>


              </paginate>






            </div>
            <!-- /.row -->

            <div class="row">
                <paginate-links for="productos" :show-step-links="true"></paginate-links>
            </div>

<!-- End Panel body -->
        </div>

        <div v-show="!loadingComplete" class="panel-body">
          <moon-loader></moon-loader>
        </div>


        </div>





      </div>




      <!-- /.col-lg-9 -->



<!--END Number Navigator-->

    </div>


    <!-- /.row -->

  </div>
  <footer class="container">
    <p>&copy; Company 2017-2018</p>
  </footer>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <?php
  echo '<script>var query = ' . json_encode($_GET['query']) . '; console.log("Query"+query);</script>';
   ?>


  <script src="assets/vue-busqueda.js"></script>


</body>


<style>

body{
  padding-top: 0px;
}


/*Slider style*/
/* The slider itself */
.slider {
    -webkit-appearance: none;  /* Override default CSS styles */
    appearance: none;
    width: 100%; /* Full-width */
    height: 25px; /* Specified height */
    background: #d3d3d3; /* Grey background */
    outline: none; /* Remove outline */
    opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
    -webkit-transition: .2s; /* 0.2 seconds transition on hover */
    transition: opacity .2s;
}

/* Mouse-over effects */
.slider:hover {
    opacity: 1; /* Fully shown on mouse-over */
}

/* The slider handle (use -webkit- (Chrome, Opera, Safari, Edge) and -moz- (Firefox) to override default look) */
.slider::-webkit-slider-thumb {
    -webkit-appearance: none; /* Override default look */
    appearance: none;
    width: 25px; /* Set a specific slider handle width */
    height: 25px; /* Slider handle height */
    background: #4CAF50; /* Green background */
    cursor: pointer; /* Cursor on hover */
}

.slider::-moz-range-thumb {
    width: 25px; /* Set a specific slider handle width */
    height: 25px; /* Slider handle height */
    background: #4CAF50; /* Green background */
    cursor: pointer; /* Cursor on hover */
}


.row-filtro{
margin: 10px;
}
ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

.paginate-list {
  width: 159px;
  margin: 0 auto;
  text-align: left;
  li {
    display: block;
    &:before {
      content: '⚬ ';
      font-weight: bold;
      color: slategray;
    }
  }
}

.paginate-links.productos {
  user-select: none;
  a {
    cursor: pointer;
  }
  li.active a {
    font-weight: bold;
  }
  li.next:before {
    content: ' | ';
    margin-right: 13px;
    color: #ddd;
  }
  li.disabled a {
    color: #ccc;
    cursor: no-drop;
  }
}

a {
  color: #42b983;
}


ul.paginate-links> li{
  cursor: pointer !important;
}

ul.paginate-links{
  text-align: center !important;
  padding-top: 100px;
}

.multiselect__content-wrapper{
  max-height: auto;
}

.dropdown-menu > li{
  display:contents;
}

</style>
</html>
