<nav class="navbar navbar-default" id="barra-nav">
  <div class="container-fluid">
    <div class="navbar-header" style="width:15%">
      <a class="navbar-brand" href="index.php">DealsWatcher</a>
    </div>
    <ul class="nav navbar-nav" style="width:15%">

      <li class="dropdown" style="width:100%;text-align:center">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="width:100%">Categorías
              <span class="caret"></span></a>
        <ul class="dropdown-menu" style="width:100%">
          <li style="text-transform:capitalize" v-for="cat in categorias" :key="cat.categoria"><a @click="irBusquedaCategoria(cat.categoria)" href="#">{{cat.categoria}}</a></li>


      </li>

      </ul>


    </ul>

    <form class="navbar-form navbar-left" action="Busqueda.php" style="width:40%">
      <div class="form-group" style="width:75%">
        <input type="text" name="query" class="form-control" placeholder="¿Qué estás buscando?" style="width:100%">
      </div>
      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
    </form>

    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-list-alt"></span> Mis Listas
      <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="#">Lista 1</a></li>
      </ul>
      </li>
      <li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class=" glyphicon glyphicon-user"></span> Mi Cuenta
      <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="#">Seguidos</a></li>
        <li><a href="#">Cerrar Sesión</a></li>
      </ul>
      </li>
    </ul>
  </div>
</nav>

<script src="assets/vue-lista-categorias.js"></script>
