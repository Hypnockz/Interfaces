<!doctype html>
<html lang="en">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<link rel="stylesheet" type="text/css" href="assets/css/shop-homepage.css">
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

<script src="https://unpkg.com/vue-multiselect@2.0.6"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.6/dist/vue-multiselect.min.css">
<script src="assets/js/vue-paginate.js"></script>



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


  <div class="container" style="margin-left:5px;margin-right:5px; width:100%" id="vue-result-busq">

    <div class="row"style="margin:10px;padding-bottom:40px">

      <h1> Resultados de búsqueda : {{textoBusqueda}}</h1>
    </div>

    <div class="row">

      <div class="col-md-2">

        <div class="panel panel-default">
          <div class="panel-heading"><h3>Filtros</h3></div>
          <div class="panel-body">Panel Content

              <div class="row row-filtro">
                    <h4>Precio Máximo: </h4>

                    <div class="slidecontainer">
                      <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                    </div>

                  <p id="demo">

</p>
              </div>

              <div class="row row-filtro">
                    <h4>Precio Mínimo: </h4>

                    <div class="slidecontainer">
                      <input type="range" min="1" max="100" value="50" class="slider" id="myRange2">
                    </div>
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

      <div class="col-md-10">

        <div class="panel panel-default">
          <div class="panel-body">
            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>

              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

            <div class="row">

              <paginate
                name="productos"
                :list="productosQuery"
                :per="3"
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

              <paginate-links
    for="productos"
    :simple="{
      prev: 'Back',
      next: 'Next'
    }"
  ></paginate-links>

            </div>
            <!-- /.row -->

<!-- End Panel body -->
        </div>
        </div>





      </div>




      <!-- /.col-lg-9 -->

      <!-- Number Navigator-->

      <div class="text-center">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>

          <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </div>

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
  <script src="assets/vue-busqueda.js"></script>
</body>


<style>

body{
  padding-top: 0px;
}


/*Slider style*/
.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 15px;
    border-radius: 5px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}


.row-filtro{
margin: 10px;
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

paginate-links.productos>ul {
  list-style-type: none;
  padding: 0;
}

paginate-links.productos>li {
  display: inline-block;
  margin: 0 10px;
}


</style>
</html>
