<?php

 header('Content-Type: application/json');

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
            case 'add_list':
            $res = pg_query_params($db, "INSERT into interfaces.lista_de_compra
                                          VALUES (default,$1)",array($_POST["arguments"]));
            $query = pg_query($db,"SELECT max(interfaces.lista_de_compra.id)
                                  FROM interfaces.lista_de_compra");
            $last = pg_fetch_array ( $query,0);
            break;

            case 'addto_list':
            $res = pg_query_params($db, "INSERT into interfaces.pertenece_compra
                                          VALUES ($1,$2,default)",array($_POST["arguments"][0], $_POST["arguments"][1] ));
            break;
        }

    }

    echo $last;
 ?>
