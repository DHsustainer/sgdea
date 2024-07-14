<?php
    require_once ("lib/nusoap.php");

    if (!isset($_SESSION['VAR_SESSIONES'])) {

        
        $cliente = new nusoap_client("http://laws.com.co/ws/GetDetailSuscriptorKeys.wsdl", true);

        $error = $cliente->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }

        $array = array("id" => $_SERVER['HTTP_HOST'], "key" => $_SESSION['user_key']);
        $result = $cliente->call("GetDataSesion", $array);
          
        if ($cliente->fault) {
            echo "<h2>Fault</h2><pre>";
            echo "</pre>";
        }else{
            $error = $cliente->getError();

            if ($error) {
                echo "<h2>Error</h2><pre>" . $error . "</pre>";
            }else {
                if ($result == "") {
                    echo "No se creo el WS";

                }else{

                    $x  = explode("|,|", $result);
                    if ($x[0] != 'errno') {
                        $_SESSION["pzhkCSC0XMwpGMT"] = desencriptar($x[0], $_SESSION['user_key']);
                        $_SESSION["kYg8omRSc1EDj3u"] = desencriptar($x[1], $_SESSION['user_key']);
                        $_SESSION["1oKU35BSbQ7CG5Q"] = desencriptar($x[2], $_SESSION['user_key']);
                        $_SESSION["71c029wus3yJWEN"] = desencriptar($x[3], $_SESSION['user_key']);

                        $_SESSION['VAR_SESSIONES'] = true;
                    }else{
                        $_SESSION['VAR_SESSIONES'] = false;
                    }
                }
            }
        }
    }
    
    include_once('../app/basePaths.inc.php');
    include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
    include_once('../app/controller/consultas.php');
    include_once('../app/controller/funciones.php');
    #include_once(ROOT.DS.'models'.DS.'/Events_gestionM.php');
    include_once(MODELS.DS.'Events_gestionM.php');
      
    $con = new ConexionBaseDatos;
    $con->Connect($con);

    $c = new Consultas;
    $f = new Funciones;
    function UpdateNotificacion($id, $guia, $estado, $observacion) {
        global $con;

        $con->Query("update notificaciones set nom_archivo = '".$observacion."',  guia_id = '".$guia."',  is_certificada = '".$estado."' where id = '".$id."'");

        $st = $con->Query("select * from notificaciones where id = '".$id."'");
        $row = $con->FetchAssoc($st);

        $ges = $con->FetchAssoc($con->Query("select * from gestion where id = '".$row['proceso_id']."'"));
        $us = $con->FetchAssoc($con->Query("select * from usuarios where user_id = '".$row['user_id']."'"));

        if ($estado == "1") {
            
            $objecte = new MEvents_gestion;
            $objecte->InsertEvents_gestion($row['user_id'], $row['proceso_id'], date("Y-m-d"), "Correspondencia Validada", "Se ha recibido la correspondencia con el operador postal", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $ges['oficina'], $ges['dependencia_destino'], $ges['dependencia_destino'], $us['a_i'], "rfis", $id);

        }else{

            $objecte = new MEvents_gestion;
            $objecte->InsertEvents_gestion($row['user_id'], $row['proceso_id'], date("Y-m-d"), "Correspondencia Validada", "Se ha recibido la correspondencia con el operador postal", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $ges['oficina'], $ges['dependencia_destino'], $ges['dependencia_destino'], $us['a_i'], "cert", $id);

        }

        return "ok!";
    }
    function desencriptar($plaintext, $key){
/*
        $cipher = "aes-128-gcm";
        
        if (in_array($cipher, openssl_get_cipher_methods()))
        {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = "openssl_rand"; #openssl_random_pseudo_bytes($ivlen);

            $original_plaintext = openssl_decrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
            return $original_plaintext;
        }*/
        return $plaintext;



    }
    #echo UpdateNotificacion("1", "234234", "1", "no comento");
      
    #ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER
    $server = new soap_server();
    $server->configureWSDL("producto", "urn:producto");
    $server->register("UpdateNotificacion",
        array("id" => "xsd:string", "guia" => "xsd:string", "estado" => "xsd:string", "observacion" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:producto",
        "urn:producto#UpdateNotificacion",
        "rpc",
        "encoded",
        "Nos da una lista de productos de cada categoría");
      
    $server->service($HTTP_RAW_POST_DATA);
?>