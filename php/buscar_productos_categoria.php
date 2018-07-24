<?php
$return=[];

$var = $_GET['categoriaQ'];
$db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");
$consulta = pg_query_params($db, "Select * from interfaces.producto where categoria = $1", array($var));

//echo pg_num_rows($consulta);
//$consulta=pg_query($db,  "Select * from interfaces.producto as p ");

while ($row = pg_fetch_object($consulta)) {
  //var_dump($row);
  array_push($return,$row);

}
    foreach ($return as $producto) {
/*      echo "-----------------";
      echo "\n";
      //var_dump($producto);

      echo "\n";
      echo "-----------------";/*/

      $producto->precios = array();
      $aidi = $producto->id;
      $consulta=pg_query_params($db,  "Select s.id,s.nombre,p.precio,p.precio_oferta from interfaces.precios as p inner join interfaces.supermercado as s on p.id_super = s.id WHERE id_producto = $1",array($aidi));

      while ($rowP = pg_fetch_object($consulta)) {
      //var_dump($rowP);

        array_push($producto->precios,$rowP);
      }

    }

echo json_encode($return, JSON_PRETTY_PRINT);


 ?>
