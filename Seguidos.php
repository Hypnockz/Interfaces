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

            </div>

            <div class="col-md-1">

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

            </div>
          </div>


          <div class="row row-product" v-for="producto in filteredProducto" :key="producto.id" >

            <div class="col-md-1  row-content-product" >
               <span v-if="productoEstaEnDcto(producto.precioOferta,producto.precioAnterior)" class="glyphicon glyphicon-arrow-down indicador" v-bind:class="{'bajo-precio': productoEstaEnDcto(producto.precioOferta,producto.precioAnterior), 'aumento-precio': !productoEstaEnDcto(producto.precioOferta,producto.precioAnterior)}"></span>
               <span v-else class="glyphicon glyphicon-arrow-up indicador" v-bind:class="{'bajo-precio': productoEstaEnDcto(producto.precioOferta,producto.precioAnterior), 'aumento-precio': !productoEstaEnDcto(producto.precioOferta,producto.precioAnterior)}"></span>
            </div>

            <div class="col-md-1  row-content-product">
                <img @click="irADetalleProducto(producto.id)"  class="seguidos-imagen linkProducto" :src="getImagenProducto(producto.id)"/>
            </div>
            <div class="col-md-3 linkProducto" >
                <h3 @click="irADetalleProducto(producto.id)">{{producto.nombre}}</h3>
            </div>


            <div class="col-md-3">
              <p style="font-size:30px" v-bind:class="{'bajo-precio': productoEstaEnDcto(producto.precioOferta,producto.precioAnterior), 'aumento-precio': !productoEstaEnDcto(producto.precioOferta,producto.precioAnterior)}">
               ${{producto.precioOferta}}
              </p>

              <p  v-if="productoEstaEnDcto(producto.precioOferta,producto.precioAnterior)" style="font-size:20px">Anterior: ${{producto.precioAnterior}} <br /><span style="font-size:16px"> Ahorras $ {{producto.precioAnterior - producto.precioOferta}} en {{producto.masBaratoEn}}</span></p>

              <p  v-else style="font-size:20px;color:orange">Anterior: ${{producto.precioAnterior}} <br /><span style="font-size:16px"> $ {{ producto.precioOferta - producto.precioAnterior}} más caro <span style="text-transform:capitalize">{{producto.masBaratoEn}}</span></p>

            </div>

            <div class="col-md-3">

              <table class="table table-condensed">
    <thead>
      <tr>
        <th>Tienda</th>
        <th>Precio Actual</th>
        <th>Precio</th>
        </tr>
    </thead>
    <tbody>
      <tr v-for= "valores in producto.precios" :key="valores.id">
        <td>{{valores.nombre}}</td>
        <td v-bind:class="{'bajo-precio': colorPrecioTabla(valores.precio_oferta,valores.precio), 'aumento-precio': !colorPrecioTabla(valores.precio_oferta,valores.precio)}">${{valores.precio_oferta}}</td>
        <td>${{valores.precio}}</td>

      </tr>
    </tbody>
  </table>
            </div>

            <div class="col-md-1  row-content-product" >
               	<span @click="deleteProductoSeguido(producto.id)" class="glyphicon glyphicon-trash" style="font-size:30px" ></span>
            </div>
          </div>
          </div>



        </div>
      </div>




      <!-- /.col-lg-9 -->


      <!-- Modal -->

      <div class="modal fade" id="ModalEliminar" role="dialog">
         <div class="modal-dialog modal-sm">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Eliminar de la Lista</h4>
             </div>
             <div class="modal-body">
               <p>El producto ya no aparecerá en la lista y ya no recibirá notificaciones de los cambios de precio.</p>
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

  <!--  end modal-->
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
  position: relative;
  display: grid;
display: flex;
  align-items: center;


}

.row-content-product{

/*height:inherit;*/

}

#headers{

text-align: center;
  padding-top: 20px;
  padding-bottom: 20px;
  background-color: #e5e5e5;
  border: solid 1px black;
  font-size: 20px;
}

td {
  text-align: center;
  vertical-align: middle;
  text-transform: capitalize;
}

th {
  text-align: center;
  vertical-align: middle;
}

.seguidos-imagen{
  width: 100px;
  height:100px;
  object-fit: scale-down;
}

.aumento-precio{
  color: red;
}

.bajo-precio{
  color: #2fe331
}

.indicador{
  font-size:40px;
}
#ModalEliminar{
  padding-top: 200px;
}

.linkProducto{
  cursor: pointer;
}
</style>

</html>
