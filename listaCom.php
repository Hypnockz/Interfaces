<!doctype html>


  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  
  <!-- Vue includes -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-multiselect@2.0.6"></script>
  <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.6/dist/vue-multiselect.min.css">
  <script src="assets/js/vue-paginate.js"></script>
  <title>Deals Watcher</title>
  <!-- Custom styles for this template -->
</head>
  <body>

  	<?php
  $db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");

  if(isset($_GET["id"])){
     // echo $_GET["nombre_D"];
      $id_lista = $_GET["id"];
      $lista=pg_query_params($db,  "select *
                                   from interfaces.lista_de_compra where id=$1
                                  ",array($id_lista) );
  }
  $nom_lista=pg_fetch_row($lista);
  
  ?>

  	<?php require 'includes/barranavegacion.php' ?>

  	<main role="main" id="lista-compras">
        <div class="col-md-1"></div>
        <div class="container col-md-10">
  <div class="row">
    <div class="col-xs-8 col-md-12 col-lg-12">
      <div class="panel panel-info">
        <div class="panel-heading" style="background-color: #eaeaea ">
          <div class="panel-title">
            <div class="row">
              <div class="col-xs-6">
                <h5><span class="glyphicon glyphicon-list-alt"></span> Lista de Compras <span>></span> <?php print($nom_lista[1]); ?> </h5>
              </div>
              <div class="col-xs-6">
                <div class="col-xs-6 text-right">¿Te ayudamos?</div>
                <div class="col-xs-6">
                 <div>
                    <multiselect
                  v-model="ordenarCot"
                  :options="opcionesOrdernarCot"
                  :multiple="false"


                  :hide-selected="false"
                  :allow-empty="false"
                  :open-direction="'bottom'"
                  select-label="Seleccionar"
                  placeholder="Personalizado"
                  @select="reordenarProductos"
                  >
                </multiselect>

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
          <tr v-for="producto in producto" :key="producto.id">
            <td>{{producto.nombre}}</td>
            <td><form name="form" action="" method="get">
              <input type="number" name="cantidad" value=1 class="form-control" id="cantidad" min="1" v-model="producto.cantidad" v-on:keyup="CalcularTotal" />
            </form></td>

            <td> <multiselect
                  multiselect v-model="producto.super" id="producto.nombre" deselect-label="Can't remove this value" track-by="nombre" label="nombre" placeholder="Select one" :options="producto.supermercados" :searchable="false" :allow-empty="false"
                  @select="CalcularTotal"
                  >
                </multiselect>  </td>
            <td class="price" align="right">{{producto.super.precio}} </td>
            <td align="right" class="subtotal">{{producto.super.precio * producto.cantidad}}</td>
            <td><a><button class="btn btn-danger" v-on:click="deleteProductoLista(producto.id)"><span>Eliminar </span> </button></a></td>
          </tr>
          <tr>
            <td colspan="4" align="right">Total</td>
            <td class="total" id="total" align="right"> {{total}} </td>
            <td></td>
          </tr>
            
        </table>
      </div>
          <!--       fin de producto           -->
      
          
          
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
<div class="modal fade" id="ModalEliminar" role="dialog">
         <div class="modal-dialog modal-sm">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Eliminar de la Lista</h4>
             </div>
             <div class="modal-body">
               <p>El producto ya no aparecerá en la lista de compras.</p>
               <p style="font-weight: bold">
                 ¿Esta seguro de que quiere realizar esta acción?
               </p>
             </div>
             <div class="modal-footer">
               <button type="button " style="float: left;background-color: rgb(171, 171, 171);color:white" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
               <button v-on:click="eliminacionConfirmadaDeLista" type="button" class="btn btn-default" style="background-color: red;color:white">Si, eliminar</button>
             </div>
           </div>
         </div>
       </div>
     </div>


         </main>
<script>window.jQuery || document.write('<script src="assets/js/jquery-slim.min.js"><\/script>')</script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <?php
  echo '<script>var id_lista = ' . json_encode($_GET['id']) . '; console.log("Query"+id_lista);</script>';
   ?>
  <script src="assets/vue-lista-compra.js"></script>
</body>
</html>
