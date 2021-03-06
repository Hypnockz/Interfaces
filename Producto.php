<!doctype html>
<html lang="en">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/grids.css">
<link rel="stylesheet" type="text/css" href="assets/css/Carousel.css">

<script>

function changeImage(id_prod) {
    var image = document.getElementById('like');
    if (image.src.match("assets/img/like2.png")) {
        image.src = "assets/img/like.png";

        jQuery.ajax({
            type: "POST",
            url: 'like_request.php',
            dataType: 'json',
            data: {functionname: 'del_fav', arguments: id_prod },

            success: function (obj, textstatus) {
                          if( !('error' in obj) ) {
                              yourVariable = obj.result;
                          }
                          else {
                              console.log(obj.error);
                          }
                    }
        });


        showBAlert();
    } else {
        image.src = "assets/img/like2.png";


        jQuery.ajax({
            type: "POST",
            url: 'like_request.php',
            dataType: 'json',
            data: {functionname: 'add_fav', arguments: id_prod },

            success: function (obj, textstatus) {
                          if( !('error' in obj) ) {
                              yourVariable = obj.result;
                          }
                          else {
                              console.log(obj.error);
                          }
                    }
        });


        showAlert();

    }
}

function showAlert(){
  if($("#myAlert").find("div#myAlert2").length==0){
    $("#myAlert").append("<div class='alert alert-success alert-dismissable' id='myAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> Agregado a seguidos! Guardado correctamente.</div>");
  }
  $("#myAlert").css("display", "");

  $("#myAlert").fadeTo(2000, 500).slideUp(500, function(){
    $("#myAlert").slideUp(500);
});


}

function showBAlert(){
  if($("#myBAlert").find("div#myBAlert2").length==0){
    $("#myBAlert").append("<div class='alert alert-warning alert-dismissable' id='myBAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> Eliminado de seguidos! Guardado correctamente.</div>");
  }
  $("#myBAlert").css("display", "");

  $("#myBAlert").fadeTo(2000, 500).slideUp(500, function(){
    $("#myBAlert").slideUp(500); });


}

function showCAlert(){
  if($("#myCAlert").find("div#myCAlert2").length==0){
    $("#myCAlert").append("<div class='alert alert-success alert-dismissable' id='myCAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> Lista creada! Guardado correctamente.</div>");
  }
  $("#myCAlert").css("display", "");

  $("#myCAlert").fadeTo(2000, 500).slideUp(500, function(){
    $("#myCAlert").slideUp(500); });


}

function showDAlert(){
  if($("#myDAlert").find("div#myDAlert2").length==0){
    $("#myDAlert").append("<div class='alert alert-success alert-dismissable' id='myDAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> Agregado a tu lista! Guardado correctamente.</div>");
  }
  $("#myDAlert").css("display", "");

  $("#myDAlert").fadeTo(2000, 500).slideUp(500, function(){
    $("#myDAlert").slideUp(500); });


}


function CreateNewList(idprod) {
    var input = document.getElementById('Inputlista'),
        fileName = input.value;


        jQuery.ajax({
            type: "POST",
            url: 'like_request.php',
            dataType: 'json',
            data: {functionname: 'add_list', arguments: fileName },

            success: function (obj) {
                          if( !('error' in obj) ) {
                              var text = "<li><a href=\"#\" id=\"\" onclick=\"AddtoList(" + obj.result + "," + idprod + ")\" >" + fileName + "</a></li>";
                              $(text).insertBefore('#myiddivider');
                              var elementExists = document.getElementById("#myidnavbar");
                              $(elementExists).append(text);
                          }
                          else {
                              console.log(obj.error);
                          }
                    }
        });



showCAlert();

}

function AddtoList(idlist,idprod) {


        jQuery.ajax({
            type: "POST",
            url: 'like_request.php',
            dataType: 'json',
            data: {functionname: 'addto_list', arguments:  [idlist, idprod] },

            success: function (obj, textstatus) {
                          if( !('error' in obj) ) {
                              yourVariable = obj.result;
                          }
                          else {
                              console.log(obj.error);
                          }
                    }
        });

showDAlert();

}

</script>





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




  $asd=pg_query($db, "SELECT p.id,p.nombre, p.marca,s.nombre , min(pr.precio_oferta)
                              FROM interfaces.precios as pr,interfaces.producto as p, interfaces.supermercado as s
                              where  p.id = pr.id_producto AND s.id = pr.id_super
                              GROUP BY p.id,p.nombre,p.marca,s.nombre,pr.id_producto");


  $listas = pg_query($db, "SELECT *
                            FROM interfaces.lista_de_compra
  ");

  $Productos=pg_query($db, "SELECT p.id, p.nombre, p.marca, s.nombre, l.m
                              FROM interfaces.producto as p, interfaces.supermercado as s,interfaces.precios as pr, ( SELECT  pr.id_producto, min(pr.precio_oferta) as m
                                                                                                                      FROM interfaces.precios as pr
                                                                                                                      GROUP BY pr.id_producto) l
                              where  p.id = pr.id_producto AND s.id = pr.id_super and pr.precio_oferta= l.m
                              ");



  $consulta=pg_query_params($db,  "select *
                                   from interfaces.precios as p , interfaces.supermercado as s, interfaces.producto as pr
                                   where p.id_producto = $1 and s.id = p.id_super and p.id_producto = pr.id ",array($id_producto));

  $n_listas= pg_num_rows($listas);

  $n_supermercados= pg_num_rows($consulta);

  $test= pg_num_rows($Productos);


  $test2 = pg_fetch_array ( $Productos,1);




  $test2 = pg_fetch_array ( $Productos,1 );

  $n_productos = pg_num_rows($Productos);

  $dataPoints_lider = array();
  $dataPoints_jumbo = array();
  $dataPoints_santaisabel = array();
  $dataPoints_tottus = array();
  $dataPoints_unimarc = array();




  ?>


<style >

.modal-backdrop {
z-index: -1;
}

.modal {
  text-align: center;
  padding: 0!important;
}
.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}
.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

</style>



  <body>

  <?php require 'includes/barranavegacion.php' ?>




    <main role="main">


    </main>



    <div class="container" style="display:none;" id="myAlert">
        <div class="alert alert-success alert-dismissable" id="myAlert2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Agregado a seguidos! Guardado correctamente.
        </div>

    </div>

    <div class="container" style="display:none;" id="myBAlert">
        <div class="alert alert-warning alert-dismissable" id="myBAlert2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Eliminado de seguidos! Guardado correctamente.
        </div>

    </div>

    <div class="container" style="display:none;" id="myCAlert">
        <div class="alert alert-success alert-dismissable" id="myCAlert2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Lista creada! Guardado correctamente.
        </div>

    </div>

    <div class="container" style="display:none;" id="myDAlert">
        <div class="alert alert-success alert-dismissable" id="myDAlert2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Agregado a tu lista! Guardado correctamente.
        </div>

    </div>

    <div class="container" id="change">

      <div class="col-md-4">

      <?php
      $title = pg_fetch_array ($consulta,0);
      ?>

        <h1 class="display-4" align="center"><?php echo $title[7] ?></h1>
        <div class="row row-no-margin">
          <img class="img-responsive" src="<?php  echo"assets/img/{$id_producto}.png"; ?> " alt=""></a>
        </div>

        <div class="row row-no-margin">

          <div class="col-xs-6 col-sm-6 col-no-padding">

            <a href="#">
              <img id="like" class="thumbnail img-responsive" onclick="changeImage(<?php echo $id_producto; ?>)" src="assets/img/like.png" style="margin: auto;" />
            </a>

          </div>
          <div class="col-xs-6 col-sm-6 col-no-padding" style="text-align: center;">



            <!-- Single button -->
            <div class="btn-group">
              <img class="btn btn-default dropdown-toggle" data-toggle="dropdown" src="assets/img/add_list.png" aria-haspopup="true" aria-expanded="false" style="padding: 4px 4px;">

              <ul class="dropdown-menu" >
                <?php
                for($i=0;$i<$n_listas;$i++){
                  $row = pg_fetch_array ( $listas,$i );
                  echo "<li><a href=\"#\" id=\"\" onclick=\"AddtoList({$row[0]},{$id_producto})\" >{$row[1]}</a></li>";
                }

                 ?>
                <li role="separator" class="divider" id="myiddivider"></li>
                <li><a href="#myModal" data-toggle="modal">Crear nueva lista</a></li>
              </ul>
            </div>


            <!-- Modal de crear lista -->
            <div id="myModal" class="modal fade" style="" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Confirmation</h4>
                        </div>

                        <div class="form-group">
                          <input type="text" class="form-control" id="Inputlista" aria-describedby="listaHelp" placeholder="Ingresa Nombre">
                          <small id="listaHelp" class="form-text text-muted">Ponle un nombre a tu nueva lista.</small>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="CreateNewList(<?php echo $id_producto; ?>)" data-dismiss="modal">Guardar Nueva Lista</button>
                        </div>
                    </div>
                </div>
            </div>



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
                              else if ($j==30 ){$dataPoints_lider[] = array("y"=> $row[2], "label"=> "Jul {$j}"); continue; }
                              $dataPoints_lider[] = array("y"=> rand($minprice,$maxprice) , "label"=> "Jul {$j}");
                            }
                            break;
                        case 1:
                            for($j=25;$j<=31;$j++) {
                              if ($j==31 ){$dataPoints_jumbo[] = array("y"=> $row[3], "label"=> "Jul {$j}"); continue; }
                              else if ($j==30 ){$dataPoints_jumbo[] = array("y"=> $row[2], "label"=> "Jul {$j}"); continue; }
                              $dataPoints_jumbo[] = array("y"=> rand($minprice,$maxprice) , "label"=> "Jul {$j}");
                            }
                            break;
                        case 2:
                            for($j=25;$j<=31;$j++) {
                              if ($j==31 ){$dataPoints_santaisabel[] = array("y"=> $row[3], "label"=> "Jul {$j}"); continue; }
                              else if ($j==30 ){$dataPoints_santaisabel[] = array("y"=> $row[2], "label"=> "Jul {$j}"); continue; }
                              $dataPoints_santaisabel[] = array("y"=> rand($minprice,$maxprice) , "label"=> "Jul {$j}");
                            }
                            break;
                        case 3:
                            for($j=25;$j<=31;$j++) {
                              if ($j==31 ){$dataPoints_tottus[] = array("y"=> $row[3], "label"=> "Jul {$j}"); continue; }
                              else if ($j==30 ){$dataPoints_tottus[] = array("y"=> $row[2], "label"=> "Jul {$j}"); continue; }
                              $dataPoints_tottus[] = array("y"=> rand($minprice,$maxprice) , "label"=> "Jul {$j}");
                            }
                            break;
                        case 4:
                            for($j=25;$j<=31;$j++) {
                              if ($j==31 ){$dataPoints_unimarc[] = array("y"=> $row[3], "label"=> "Jul {$j}"); continue; }
                              else if ($j==30 ){$dataPoints_unimarc[] = array("y"=> $row[2], "label"=> "Jul {$j}"); continue; }
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
              <?php
              $desc = pg_fetch_array ( $consulta,0 );
              echo $desc[10];
              ?>
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
}

</style>
</html>
