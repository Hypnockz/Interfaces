<!doctype html>
<html lang="en">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/grids.css">
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
  </head>


  <?php
  $db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");

  if(isset($_GET["id"])){
     // echo $_GET["nombre_D"];
      $id_producto = $_GET["id"];
  }
  else echo "ERROR";

  $Productos=pg_query($db,  "select *
                                   from interfaces.producto as p, interfaces.precios as pr, interfaces.supermercado as s
                                   where p.id = pr.id_producto AND s.id = pr.id_super AND pr.precio_oferta = (SELECT min(interfaces.precios.precio_oferta)
                                                                                                              FROM interfaces.precios
                                                                                                              )
                                  " );

  $consulta=pg_query_params($db,  "select *
                                   from interfaces.precios as p , interfaces.supermercado as s
                                   where p.id_producto = $1 and s.id = p.id_super",array($id_producto));

  $n_supermercados= pg_num_rows($consulta);

  $n_productos = pg_num_rows($Productos);

  $dataPoints_lider = array();
  $dataPoints_jumbo = array();
  $dataPoints_santaisabel = array();
  $dataPoints_tottus = array();
  $dataPoints_unimarc = array();




  ?>



  <body>

  <?php require 'includes/barranavegacion.php' ?>

    <main role="main">


    </main>

    <div class="container" id="change">

      <div class="col-md-4">
        <div class="row row-no-margin">
          <img class="img-responsive" src="<?php  echo"assets/img/{$id_producto}.png"; ?> " alt=""></a>
        </div>

        <div class="row row-no-margin">

          <div class="col-xs-6 col-sm-6 col-no-padding">
              <img class="thumbnail img-responsive" src="assets/img/like.png" style="margin-top: 10px;">
          </div>
          <div class="col-xs-6 col-sm-6 col-no-padding">
              <img class="thumbnail img-responsive" src="assets/img/add_list.png" style="margin-top: 10px;">
          </div>
        </div>

        <div class="row row-no-margin">

          <img class="center-block" src="assets/img/Redes_Sociales.png">

        </div>

       </div>

      <div class="col-md-8">

        <div class="row row-no-margin">
            <div class="col-md-8">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Supermercado</th>
                      <th scope="col">Precio Oferta</th>
                      <th scope="col">Precio Normal</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  for($i=0;$i<$n_supermercados;$i++){
                    $row = pg_fetch_array ( $consulta,$i );
                    $auxx= $row[1]-1;
                    $maxprice = $row[3] + 200;
                    $minprice = $row [3] - 100;


                    switch ($auxx) {
                        case 0:
                            for($j=25;$j<=31;$j++) {
                              if ($j==31 ){$dataPoints_lider[] = array("y"=> $row[3], "label"=> "Jul {$j}"); continue; }
                              $dataPoints_lider[] = array("y"=> rand($minprice,$maxprice) , "label"=> "Jul {$j}");
                            }
                            break;
                        case 1:
                            for($j=25;$j<=31;$j++) {
                              if ($j==31 ){$dataPoints_jumbo[] = array("y"=> $row[3], "label"=> "Jul {$j}"); continue; }
                              $dataPoints_jumbo[] = array("y"=> rand($minprice,$maxprice) , "label"=> "Jul {$j}");
                            }
                            break;
                        case 2:
                            for($j=25;$j<=31;$j++) {
                              if ($j==31 ){$dataPoints_santaisabel[] = array("y"=> $row[3], "label"=> "Jul {$j}"); continue; }
                              $dataPoints_santaisabel[] = array("y"=> rand($minprice,$maxprice) , "label"=> "Jul {$j}");
                            }
                            break;
                        case 3:
                            for($j=25;$j<=31;$j++) {
                              if ($j==31 ){$dataPoints_tottus[] = array("y"=> $row[3], "label"=> "Jul {$j}"); continue; }
                              $dataPoints_tottus[] = array("y"=> rand($minprice,$maxprice) , "label"=> "Jul {$j}");
                            }
                            break;
                        case 4:
                            for($j=25;$j<=31;$j++) {
                              if ($j==31 ){$dataPoints_unimarc[] = array("y"=> $row[3], "label"=> "Jul {$j}"); continue; }
                              $dataPoints_unimarc[] = array("y"=> rand($minprice,$maxprice) , "label"=> "Jul {$j}");
                            }
                            break;

                    }





                    $aux = $i+1;
                    $text = "
                    <tr>
                      <th scope=\"row\">{$aux}</th>
                      <td>{$row[5]}</td>
                      <td>{$row[3]}</td>
                      <td>{$row[2]}</td>
                    </tr>
                    ";

                    echo $text;

                    }

                  ?>


                  </tbody>
                </table>
            </div>

            <div class="col-md-4">
            <ul>
              <li>Marca : Soprole</li>
              <li>Envase : Caja 1 L</li>
              <li>País de origen : Chile</li>
              <li>Producto : Leche</li>
              <li>Tipo : Entera</li>
              <li>Sabor : Natural</li>
              <li>Duración : 6 meses</li>
              <li>Almacenamiento : Para abrir levante y corte por la línea punteada. Una vez abierto el envase su duración es de 4 días.</li>
              <li>Modo de empleo : Agitar antes de consumir.</li>
              <li>Servicio de atención al cliente 800 200 011</li>
            </ul>
          </div>
        </div>

        <div class="row row-no-margin" style="margin: 0; margin-top: 40px;">

         <!--<img class="img-responsive" src="http://placehold.it/1100x300" alt=""></a>-->




         <?php

           $encode1 = json_encode($dataPoints_lider, JSON_NUMERIC_CHECK);
           $encode2 = json_encode($dataPoints_jumbo, JSON_NUMERIC_CHECK);
           $encode3 = json_encode($dataPoints_santaisabel, JSON_NUMERIC_CHECK);
           $encode4 = json_encode($dataPoints_tottus, JSON_NUMERIC_CHECK);
           $encode5 = json_encode($dataPoints_unimarc, JSON_NUMERIC_CHECK);






         echo"

           <script>
           window.onload = function () {

           var chart = new CanvasJS.Chart(\"chartContainer\", {
             animationEnabled: true,
           	title: {
           		text: \"Precio histórico\"
           	},
           	subtitles: [{
           		text: \"\"
           	}],
           	axisY: {
           		title: \"Precio (Pesos)\",
           		includeZero: false,
              suffix: \" $\"
           	},
            toolTip:{
            		shared: true
            },
           	data: [{
              name : \"Lider\",
           		type: \"spline\",
              showInLegend: true,
           		dataPoints: {$encode1}
           	},
            {
              name : \"Jumbo\",
              type: \"spline\",
              showInLegend: true,
              dataPoints: {$encode2}
            },
            {
              name : \"Santa Isabel\",
              type: \"spline\",
              showInLegend: true,
              dataPoints: {$encode3}
            },
            {
              name : \"Tottus\",
              type: \"spline\",
              showInLegend: true,
              dataPoints: {$encode4}
            },
            {
              name : \"Unimarc\",
              type: \"spline\",
              showInLegend: true,
              dataPoints: {$encode5}
            }
          ]
           });
           chart.render();

           }
           </script>


         ";

         ?>

        <!-- <canvas id="speedChart" width="1100" height="300"></canvas>-->
         <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
       </div>

       <!-- Slider-->

       <div class="container" id="sales">
       <div class="col-xs-12">

           <div class="page-header">
               <h3>Quizas te interese ver</h3>
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
                                      <h4>{$row[1]} {$row[3]}</h4>
                                      <p>{$row[9]}</p>
                                      <h3   style=\"color: #FE2E2E\">$ {$row[6]}</h4>

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
                                      <h4>{$row[1]} {$row[3]}</h4>
                                      <p>{$row[9]}</p>
                                      <h3   style=\"color: #FE2E2E\">$ {$row[6]}</h4>

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
                                      <h4>{$row[1]} {$row[3]}</h4>
                                      <p>{$row[9]}</p>
                                      <h3   style=\"color: #FE2E2E\">$ {$row[6]}</h4>

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



    </div>



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
