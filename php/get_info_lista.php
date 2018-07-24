<?php
$return=[];
$return['productos'] = [];
$return['lista'] =[];
$db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");
if(isset($_GET["id"])){

  $id_lista = $_GET["id"];

  $lista=pg_query_params($db,  "select *
                               from interfaces.lista_de_compra where id=$1
                              ",array($id_lista) );

    $Productos=pg_query_params($db,  "select p.id, p.nombre c.cantidad
                                      from interfaces.producto as p, interfaces.pertenece_compra as c 
                                      where c.id_lista=$1 and c.id_producto=p.id
                                                            " ,array($id_lista));
  /*$supermercados=pg_query_params("select p.id, s.nombre as nombre_super, precio_oferta
                              from pertenece_compra as pc,producto as p, precios as pr, supermercado as s
                              where pc.id_producto=p.id and pr.id_producto=p.id and pr.id_super=s.id
                              ORDER BY p.id, id_super ASC");*/

    while ($row = pg_fetch_object($Productos)) {
      ///var_dump($row);

      array_push($return,$row);
    }
    foreach ($return['productos'] as $producto) {
      # code...
      $producto->supermercados = array();
      $producto->super=array();
      $aidi = $producto->id;
      $consulta=pg_query_params($db,  "s.nombre as nombre, precio_oferta as precio
                              from pertenece_compra as pc,producto as p, precios as pr, supermercado as s
                              where pc.id_producto=p.id and pr.id_producto=p.id and pr.id_super=s.id and p.id=$1
                              ORDER BY p.id, id_super ASC",array($aidi));

       while ($rowP = pg_fetch_object($consulta)) {
        //var_dump($rowP);

          array_push($producto->supermercados,$rowP);
        }
    }



echo json_encode($return, JSON_PRETTY_PRINT);
}
?>
