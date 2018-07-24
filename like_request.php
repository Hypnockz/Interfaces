<?php

 header('Content-Type: application/json');
$aResult = array("holi");

$db = pg_connect("host=plop.inf.udec.cl port=5432 dbname=bdi2017d user=bdi2017d password=bdi2017d");

 if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'add_fav':
            $res = pg_query_params($db, "INSERT into interfaces.lista_de_seguidos
                                          VALUES ($1)",array($_POST["arguments"]));
               break;
            case 'del_fav':
            $res = pg_query_params($db, "DELETE FROM interfaces.lista_de_seguidos
                                          WHERE lista_de_seguidos.id_producto=$1 ",array($_POST["arguments"]));
            break;
        }

    }
    echo json_encode($aResult);

 ?>
