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

  $lista=pg_query($db,  "select nombre
                                   from interfaces.lista_de_compra where id=$id_lista
                                  " );

  $Productos=pg_query($db,  "select *
                                   from interfaces.producto as p, interfaces.pertenece_compra as c where c.id_lista=$id_lista
                                  " );
  $n_productos = pg_num_rows($Productos);
  $nom_lista=pg_fetch_row($lista);





  ?>
    
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
                <button type="button" class="btn btn-primary btn-sm btn-block">
                  <span class="glyphicon glyphicon-arrow-left"></span> Siga Cotizando
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                
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
        <table class="table table-bordered">
          <tr>
            <th width="30%">Nombre</th>
            <th width="5%">Cantidad</th>
            <th width="20%">Tienda</th>
            <th width="15%">Precio</th>
            <th width="15%">Total</th>
            <th width="5%"></th>
          </tr>
          <?php
          
          
            $total = 0;
            for($i=0;$i<$n_productos;$i++)
            {
          ?>
          <tr>
            <td><?php #nombre ?></td>
            <td><input type="text" name="cantidad" value="1" class="form-control" id=$i /></td>
            <td><select class="form-control" id="sel1">
                          <option>Lider</option>
                          <option>Jumbo</option>
                          <option>Santa Isabel</option>
                          <option>Tottus</option>
                          <option>Unimarc</option>
                          
                    </select></td>
            <td>$ <?php #precio ?></td>
            <td>$ <?php #total  ?></td>
            <td><a><span class="text-danger">Remove</span></a></td>
          </tr>
          <?php
              $total = $total ;
            }
          ?>
          <tr>
            <td colspan="3" align="right">Total</td>
            <td align="right">$ <?php echo number_format($total, 2); ?></td>
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
                <h6 class="text-right">¿Agrego más artículos?</h6>
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
