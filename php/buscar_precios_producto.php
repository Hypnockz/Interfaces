<?php
$return=[];
$db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");
$consulta=pg_query_params($db,  "Select * from interfaces.precios as p inner join interfaces.supermercado as s on p.id_super = s.id WHERE id_producto = $1",array($_POST['id_producto']));

while ($row = pg_fetch_object($consulta)) {
  //var_dump($row);

  array_push($return,$row);
}



echo json_encode($return, JSON_PRETTY_PRINT);


 ?>
