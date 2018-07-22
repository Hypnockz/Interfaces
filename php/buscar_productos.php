<?php
$return=[];
$db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");
$consulta=pg_query($db,  "Select * from interfaces.producto");

while ($row = pg_fetch_object($consulta)) {
  //var_dump($row);

  array_push($return,$row);
}

//echo $consulta;
/*
    for($i=1; $i <= $numberOfCases ; $i++){
      try {
        $query = $con->prepare("SELECT rutafoto FROM foto_caso_emblematico WHERE id_caso = :id_query");
        $query-> bindParam(':id_query',$i,PDO::PARAM_STR);
        $query-> execute();
        $data = $query -> fetchAll(PDO::FETCH_ASSOC);

        $return['infoCaso'][$i-1]['fotos'] = $data;

      } catch (Exception $e) {
              $return['error']['code'] = $e-> getCode();
              $return['error']['status'] = true;
              $return['error']['msj'] = $e;
          }


      }

*/

echo json_encode($return, JSON_PRETTY_PRINT);


 ?>
