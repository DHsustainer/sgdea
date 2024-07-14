<?php
header('Content-Type: application/json'); //mediante header establece que es un archivo json
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
require_once('../nusoap/nusoap2.php');

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
                    $x  = explode(",", $result);
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
    if ($_SESSION['VAR_SESSIONES']) {

#CODIGO A PARTIR DE AQUI
        //Invocando archivos que seran usados en nuestro controlador generico   
        include_once('../basePaths.inc.php');
        include_once("../DALC/mySql.php");

        #include_once('../plugins/PHPMailer_5.2.4/class.phpmailer.php');    
        // Definiendo variables y conectandonos con la base de datos
        $con = new ConexionBaseDatos;
        $con->Connect($con);

        $id=$_REQUEST['id_propietario']; //obtiene la variable id por post o get
     

        $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0'  and a.user_id = '".$id."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('doc', 'an') and leidopop = '0' group by eg.id";

        $verifica = $con->Query($sql);
        $num_msg    = $con->NumRows($qwa);
        if($num_msg > 0){
            while ($mensaje = $con->FetchAssoc($verifica)) {
                $msg[]=array('num_msg'=>$num_msg,'texto'=>$mensaje['mensaje'],'emisor'=> $mensaje['nombre_quien_envia']); //los almacena en un arreglo de arreglos
                $con->Query("UPDATE alertas SET leidopop='1' WHERE  id = '".$mensaje['id']."'");       
            }  
        }else{
            $msg[]=array('num_msg'=>$num_msg,'texto'=>$mensaje['mensaje'],'emisor'=> $mensaje['nombre_quien_envia']);       
        }
        echo json_encode($msg,JSON_PRETTY_PRINT); //lo codifica a json, JSON_PRETTY_PRINT lo hace agradable a la vista
    }
?>