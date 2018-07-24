<?php
$return=[];
$db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");
$var = $_POST['eliminar'];
$consulta=pg_query_params($db,  "Delete from interfaces.pertenece_compra where id_producto = $1", array($var));

while ($row = pg_fetch_object($consulta)) {
  //var_dump($row);

  array_push($return,$row);

}



echo json_encode($return, JSON_PRETTY_PRINT);


 ?>
