<?php
$return=[];
$db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");
$consulta=pg_query($db,  "Select  distinct categoria from interfaces.producto");

while ($row = pg_fetch_object($consulta)) {
  //var_dump($row);

  array_push($return,$row);
}



echo json_encode($return, JSON_PRETTY_PRINT);


 ?>
