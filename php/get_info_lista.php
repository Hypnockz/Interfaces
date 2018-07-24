<?php
$return=[];

$db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");
if(isset($_GET["id"])){

  //$id_lista = $_GET["id"];

}
$id_lista=1;
    $Productos=pg_query_params($db,  "select p.id, p.nombre c.cantidad
                                      from interfaces.producto as p, interfaces.pertenece_compra as c 
                                      where c.id_lista=$1 and c.id_producto=p.id
                                                            " ,array($id_lista));

    while ($row = pg_fetch_object($Productos)) {
      ///var_dump($row);

      array_push($return,$row);
    }
    foreach ($return as $producto) {
      # code...
      $producto->supermercados = array();
      $producto->super=array();
      $aidi = $producto->id;
      $consulta=pg_query_params($db,  "select s.nombre, precio_oferta as precio
                              from precios as pr, supermercado as s
                              where pr.id_producto=$1 and s.id=pr.id_super
                              ORDER BY pr.id_producto, id_super ASC",array($aidi));

       while ($rowP = pg_fetch_object($consulta)) {
        //var_dump($rowP);

          array_push($producto->supermercados,$rowP);
        }
    }



echo json_encode($return, JSON_PRETTY_PRINT);

?>
