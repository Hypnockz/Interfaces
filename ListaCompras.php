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
  </head>

  <body>
    <?php
  $db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");

  if(isset($_GET["id"])){
     // echo $_GET["nombre_D"];
      $id_lista = $_GET["id"];
  }
  else echo "ERROR";

  $lista=pg_query_params($db,  "select nombre
                                   from interfaces.lista_de_compra where id=$1
                                  ",array($id_lista) );

  $Productos=pg_query_params($db,  "select *
                                   from interfaces.producto as p, interfaces.pertenece_compra as c where c.id_lista=$1 and c.id_producto=p.id
                                  " ,array($id_lista));
  $n_productos = pg_num_rows($Productos);
  $nom_lista=pg_fetch_row($lista);





  ?>
    <script type="text/javascript">

                  $(document).ready(function() {
                    // scan complete table, find all pricces
                    $('table').find('.price').each(function() {
                       // look for the row
                       var row = $(this).closest('tr');
                       // set the price as a data attribute
                       // to optimize this, set the attribute
                       // when generating the html, so no loop is
                       // required here...
                       row.find("input[type='number']")
                        .attr('data-price', $(this).text());
                    });
                    
                    function updatePrice() {
                        var sum, price = parseFloat($(this).attr('data-price')),
                            num = parseInt($(this).val(),10),
                            row = $(this).closest('tr');
                        if(num) {
                          sum = num * price;
                          row.find('.subtotal').text(sum.toFixed(0));

                        }
                    }
                    
                    $(document).on("change, onload, mouseup, keyup","table input[type='number']", updatePrice);
                    
                });
    </script>
    <script type="text/javascript">
      function updateTotal(){
      $(document).ready(function(e){
        $("input").change(function(){
          var tot=0;
          $("td[class='subtotal']").each(function(){
            tot=tot+ parseInt($(this).val());
          })
            document.getElementById('total').interHTML=tot;
        });


      });
    }
    </script>
  <?php require 'includes/barranavegacion.php' ?>

      <main role="main">
        <div class="col-md-1"></div>
        <div class="container col-md-10">
  <div class="row">
    <div class="col-xs-8 col-md-12 col-lg-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title">
            <div class="row">
              <div class="col-xs-6">
                <h5><span class="glyphicon glyphicon-list-alt"></span> Lista de Compras <span>></span> <?php  print($nom_lista[0]) ?>  </h5>
              </div>
              <div class="col-xs-6">
                <div class="col-xs-6 text-right">¿Te ayudamos?</div>
                <div class="col-xs-6">
                 <div class="form-group">
                    <select class="form-control" id="sel1">
                          <option>Personalizado</option>
                          <option>Supermercado más barato</option>
                          <option>Menor precio total</option>
                          
                    </select>
                  </div> 
                  </div>
              </div>
            </div>
            
          </div>
        </div>
        <div class="panel-body">

          <!--      producto   inicio        -->
          
          <div class="table-responsive">
        <table class="table table-bordered" id="table" >
          <tr class="titlerow">
            <th width="30%">Nombre</th>
            <th width="5%">Cantidad</th>
            <th width="20%">Tienda</th>
            <th width="15%">Precio</th>
            <th width="15%">Total</th>
            <th width="5%"></th>
          </tr>
          <?php
          
          
            $total = 0;
            $i=0;
            while($producto=pg_fetch_row($Productos))
            {

          ?>
          <tr>
            <td><?php print($producto[1]) #nombre ?></td>
            <td><form name="form" action="" method="get">
              <input type="number" name="cantidad" value="1" class="form-control" id="cantidad" min="1" onchange="updateTotal()" />
            </form></td>

            <td><select class="form-control" id="sel1">
                          <option value="1">Lider</option>
                          <option value="2">Jumbo</option>
                          <option value="3">Santa Isabel</option>
                          <option value="4">Tottus</option>
                          <option value="5">Unimarc</option>
                          
                    </select></td>
            <td class="price" align="right"> <?php $precios=pg_query_params($db,"Select * from interfaces.precios where id_producto=$1 and id_super=1",array($producto[0]));
                        $precio=pg_fetch_row($precios);
                        print($precio[3]);  #precio ?></td>
            <td align="right" class="subtotal"></td>
            <td><a><span class="text-danger">Eliminar</span></a></td>
          </tr>
          <?php
              $total = $total ;
              $i++;
            }
          ?>
          <tr>
            <td colspan="4" align="right">Total</td>
            <td class="total" id="total" align="right"> </td>
            <td></td>
          </tr>
          <?php
          
          ?>
            
        </table>
      </div>
          <!--       fin de producto           -->
          <hr>
          
          <div class="row">
            <div class="text-center">
              <div class="col-xs-9">
                <h6 class="text-right">¿Agregó más artículos?</h6>
              </div>
              <div class="col-xs-3">
                <button type="button" class="btn btn-default btn-sm btn-block">
                  <span class="glyphicon glyphicon-repeat"></span>
                  Actualize la lista
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          
          <div class="row">  
            <div class="col-xs-6">
              <button type="button" class="btn btn-info">Exportar</button>
              <button type="button" class="btn btn-info">Generar Captura de Pantalla</button>
              <button type="button" class="btn btn-danger">Eliminar</button>
            </div>
            <div class="col-xs-3">
              
            </div>
            <div class="col-xs-3">
              <button type="button" class="btn btn-success btn-block">
                Guardar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


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
