<!doctype html>
<html lang="en">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/Carousel.css">




  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">


    <title>Welcome to DealsWatchers!</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/jumbotron.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  </head>

<?php

$db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");

$Productos=pg_query($db, "SELECT p.id, p.nombre, p.marca, s.nombre, l.m
                            FROM interfaces.producto as p, interfaces.supermercado as s,interfaces.precios as pr, ( SELECT  pr.id_producto, min(pr.precio_oferta) as m
                                                                                                                    FROM interfaces.precios as pr
                                                                                                                    GROUP BY pr.id_producto) l
                            where  p.id = pr.id_producto AND s.id = pr.id_super and pr.precio_oferta= l.m
                            ");

$n_productos = pg_num_rows($Productos);


 ?>


  <body id="pagina-inicio">

  <?php require 'includes/barranavegacion.php' ?>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Bienvenido a nuestro intento de tienda!</h1>
        </div>
      </div>

      <div class="container" id="sales">
      <div class="col-xs-12">

          <div class="page-header">
              <h3>Ofertas Descatadas</h3>
          </div>

          <div class="carousel slide" id="myCarousel">
            <div class="carousel-inner">
                <div class="item active">
                        <ul class="thumbnails">

                          <?php

                          for($i=0;$i<4;$i++){
                            $rand=rand(1,$n_productos)-1;
                            $row = pg_fetch_array ( $Productos,$rand );


                              echo "
                                  <li class=\"col-sm-3\">
                                     <div class=\"fff\">
                                       <div class=\"thumbnail\"  >
                                         <a href=\"Producto.php?id={$row[0]}\"><img class=\"img-responsive\" style=\"max-width:360px; max-height:240px;\" src=\"assets/img/{$row[0]}.png\" alt=\"\"></a>
                                       </div>
                                       <div class=\"caption\">
                                         <h4>{$row[1]} {$row[2]}</h4>
                                         <p>{$row[3]}</p>
                                         <h3   style=\"color: #FE2E2E\">$ {$row[4]}</h4>

                                         <a class=\"btn btn-mini\" href=\"Producto.php?id={$row[0]}\">» Ver detalles</a>
                                       </div>
                                     </div>
                                  </li>
                              ";
                           }
                          ?>



                        </ul>
                  </div><!-- /Slide1 -->
                <div class="item">
                        <ul class="thumbnails">

                          <?php

                          for($i=0;$i<4;$i++){
                            $rand=rand(1,$n_productos)-1;
                            $row = pg_fetch_array ( $Productos,$rand );


                              echo "
                                  <li class=\"col-sm-3\">
                                     <div class=\"fff\">
                                       <div class=\"thumbnail\"  >
                                         <a href=\"Producto.php?id={$row[0]}\"><img class=\"img-responsive\" style=\"max-width:360px; max-height:240px;\" src=\"assets/img/{$row[0]}.png\" alt=\"\"></a>
                                       </div>
                                       <div class=\"caption\">
                                         <h4>{$row[1]} {$row[2]}</h4>
                                         <p>{$row[3]}</p>
                                         <h3   style=\"color: #FE2E2E\">$ {$row[4]}</h4>

                                         <a class=\"btn btn-mini\" href=\"Producto.php?id={$row[0]}\">» Ver detalles</a>
                                       </div>
                                     </div>
                                  </li>
                              ";
                           }
                          ?>

                        </ul>
                  </div><!-- /Slide2 -->
                <div class="item">
                        <ul class="thumbnails">
                          <?php

                          for($i=0;$i<4;$i++){
                            $rand=rand(1,$n_productos)-1;
                            $row = pg_fetch_array ( $Productos,$rand );


                              echo "
                                  <li class=\"col-sm-3\">
                                     <div class=\"fff\">
                                       <div class=\"thumbnail\"  >
                                         <a href=\"Producto.php?id={$row[0]}\"><img class=\"img-responsive\" style=\"max-width:360px; max-height:240px;\" src=\"assets/img/{$row[0]}.png\" alt=\"\"></a>
                                       </div>
                                       <div class=\"caption\">
                                         <h4>{$row[1]} {$row[2]}</h4>
                                         <p>{$row[3]}</p>
                                         <h3   style=\"color: #FE2E2E\">$ {$row[4]}</h4>

                                         <a class=\"btn btn-mini\" href=\"Producto.php?id={$row[0]}\">» Ver detalles</a>
                                       </div>
                                     </div>
                                  </li>
                              ";
                           }
                          ?>

                        </ul>
                  </div><!-- /Slide3 -->
            </div>



      	   <nav>
      			<ul class="control-box pager">
      				<li><a data-slide="prev" href="#myCarousel" class=""><i class="glyphicon glyphicon-chevron-left"></i></a></li>
      				<li><a data-slide="next" href="#myCarousel" class=""><i class="glyphicon glyphicon-chevron-right"></i></li></a>
      			</ul>
      		</nav>
      	   <!-- /.control-box -->

          </div><!-- /#myCarousel -->

      </div><!-- /.col-xs-12 -->

      </div><!-- /.container -->

      <!-- Segundo Slider -->


      <div class="container" id="sales">
      <div class="col-xs-12">

          <div class="page-header">
              <h3>Lo Más Cotizado</h3>
          </div>

          <div class="carousel slide" id="myCarouse2">
              <div class="carousel-inner">
                  <div class="item active">
                    <ul class="thumbnails">

                      <?php

                      for($i=0;$i<4;$i++){
                        $rand=rand(1,$n_productos)-1;
                        $row = pg_fetch_array ( $Productos,$rand );


                          echo "
                              <li class=\"col-sm-3\">
                                 <div class=\"fff\">
                                   <div class=\"thumbnail\"  >
                                     <a href=\"Producto.php?id={$row[0]}\"><img class=\"img-responsive\" style=\"max-width:360px; max-height:240px;\" src=\"assets/img/{$row[0]}.png\" alt=\"\"></a>
                                   </div>
                                   <div class=\"caption\">
                                     <h4>{$row[1]} {$row[2]}</h4>
                                     <p>{$row[3]}</p>
                                     <h3   style=\"color: #FE2E2E\">$ {$row[4]}</h4>

                                     <a class=\"btn btn-mini\" href=\"Producto.php?id={$row[0]}\">» Ver detalles</a>
                                   </div>
                                 </div>
                              </li>
                          ";
                       }
                      ?>



                    </ul>
                    </div><!-- /Slide1 -->
                  <div class="item">
                    <ul class="thumbnails">

                      <?php

                      for($i=0;$i<4;$i++){
                        $rand=rand(1,$n_productos)-1;
                        $row = pg_fetch_array ( $Productos,$rand );


                          echo "
                              <li class=\"col-sm-3\">
                                 <div class=\"fff\">
                                   <div class=\"thumbnail\"  >
                                     <a href=\"Producto.php?id={$row[0]}\"><img class=\"img-responsive\" style=\"max-width:360px; max-height:240px;\" src=\"assets/img/{$row[0]}.png\" alt=\"\"></a>
                                   </div>
                                   <div class=\"caption\">
                                     <h4>{$row[1]} {$row[2]}</h4>
                                     <p>{$row[3]}</p>
                                     <h3   style=\"color: #FE2E2E\">$ {$row[4]}</h4>

                                     <a class=\"btn btn-mini\" href=\"Producto.php?id={$row[0]}\">» Ver detalles</a>
                                   </div>
                                 </div>
                              </li>
                          ";
                       }
                      ?>



                    </ul>
                    </div><!-- /Slide2 -->
                  <div class="item">
                    <ul class="thumbnails">

                      <?php

                      for($i=0;$i<4;$i++){
                        $rand=rand(1,$n_productos)-1;
                        $row = pg_fetch_array ( $Productos,$rand );


                          echo "
                              <li class=\"col-sm-3\">
                                 <div class=\"fff\">
                                   <div class=\"thumbnail\"  >
                                     <a href=\"Producto.php?id={$row[0]}\"><img class=\"img-responsive\" style=\"max-width:360px; max-height:240px;\" src=\"assets/img/{$row[0]}.png\" alt=\"\"></a>
                                   </div>
                                   <div class=\"caption\">
                                     <h4>{$row[1]} {$row[2]}</h4>
                                     <p>{$row[3]}</p>
                                     <h3   style=\"color: #FE2E2E\">$ {$row[4]}</h4>

                                     <a class=\"btn btn-mini\" href=\"Producto.php?id={$row[0]}\">» Ver detalles</a>
                                   </div>
                                 </div>
                              </li>
                          ";
                       }
                      ?>



                    </ul>
                    </div><!-- /Slide3 -->
              </div>


      	   <nav>
      			<ul class="control-box pager">
      				<li><a data-slide="prev" href="#myCarouse2" class=""><i class="glyphicon glyphicon-chevron-left"></i></a></li>
      				<li><a data-slide="next" href="#myCarouse2" class=""><i class="glyphicon glyphicon-chevron-right"></i></li></a>
      			</ul>
      		</nav>
      	   <!-- /.control-box -->

          </div><!-- /#myCarousel -->

      </div><!-- /.col-xs-12 -->

      </div><!-- /.container -->

    </main>

    <footer class="container">
      <p>&copy; Company 2017-2018</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/popper.min.js"></script>
  </body>


<style>

body{
padding-top: 0px;
}

</style>
</html>
