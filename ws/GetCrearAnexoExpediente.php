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
    include_once('../app/basePaths.inc.php');
    include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
    include_once('../app/controller/consultas.php');
    include_once('../app/controller/funciones.php');
    include_once(MODELS.DS.'Gestion_anexosM.php');
    include_once(MODELS.DS.'Events_gestionM.php');
    $con = new ConexionBaseDatos;
    $con->Connect($con);
    $c = new Consultas;
    $f = new Funciones;
    function GetCrearAnexoExpediente($usuario, $clave, $tipo, $archivo_nombre, $data_archivo, $id_gestion, $cantidad, $tipoarchi) {
        global $con;
        global $c;
        $id_notificacion = $id_gestion;
        if($tipo == 'GUIA'){
            $st = $con->Query("select * from notificaciones where id = '".$id_gestion."'");
            $row = $con->FetchAssoc($st);
            $ges = $con->FetchAssoc($con->Query("select * from gestion where id = '".$row['proceso_id']."'"));
            $id_gestion = $ges['id'];
        }else{
             $ges = $con->FetchAssoc($con->Query("select * from gestion where id = '".$id_gestion."'"));
             $id_gestion = $ges['id'];
        }
        if($id_gestion <= 0){
            return "El expediente no existe";
            exit;
        }
        $us = $con->FetchAssoc($con->Query("select * from usuarios where user_id = '".$ges['user_id']."'"));
        /**SE CREA LA CARPETA DEL EXPEDIENTE SI NO EXISTE*/
        $filename=UPLOADS.DS.$id_gestion.'/';
        if (!file_exists($filename)) {
            mkdir(UPLOADS.DS . $id_gestion, 0777);
        }
        $filename=UPLOADS.DS.$id_gestion.'/anexos/';
        if (!file_exists($filename)) {
            mkdir(UPLOADS.DS . $id_gestion.'/anexos', 0777);
        }
        $rand = md5(date('Y-m-d').rand().$row['user_id']);
        $arrarch = explode(".", $archivo_nombre);
        $ext = end($arrarch);
        $fname = $rand.".".$ext;
        $fh = fopen(UPLOADS.DS . $id_gestion.'/anexos/'.$fname, 'w');
        fwrite($fh, base64_decode($data_archivo));
        fclose($fh);
        $an = new MGestion_anexos;
        $an->InsertGestion_anexos($id_gestion, $archivo_nombre, $fname, $row['user_id'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", $i, $i,$cantidad, $tipoarchi, "1");
        
        $c->SendContabilizadorDocumentos("1", $ges['tipo_documento'], $ge['id'], "AN");
        #$c->SendContabilizadorDocumentos($gestion_anexo->GetCantidad(), $gestion->GetTipo_documento(), $gestion->GetId(), "CE");    
        $MEvents_gestion = new MEvents_gestion;
        $title = "Nuevo Documento";
        $description = "Se ha creado un nuevo documento llamado: \"".$archivo_nombre."\"";
        if($tipo == 'GUIA'){
            $title = "Correspondencia Digitalizada";
            $description = "Se Ha anexado al expediente el documento llamado \"".$archivo_nombre."\"  del operador postal";
        }
        $MEvents_gestion->InsertEvents_gestion($row['user_id'], $id_gestion, date("Y-m-d"), $title, $description, date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $ges['oficina'], $ges['dependencia_destino'], $ges['dependencia_destino'], $us['a_i'], "dfis", $id_notificacion);
        /*
        */
        return "ok!";
    }
    function desencriptar($cadena, $key){
        #$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        #return $decrypted;  //Devuelve el string desencriptado
        return str_replace("|", "", $cadena);
    }
      
    #ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER
    $server = new soap_server();
    $server->configureWSDL("CrearAnexoExpediente", "urn:CrearAnexoExpediente");
    $server->register("GetCrearAnexoExpediente",
        array("usuario" => "xsd:string", "clave" => "xsd:string", "tipo" => "xsd:string", "archivo_nombre" => "xsd:string"
            , "data_archivo" => "xsd:string", "id_gestion" => "xsd:string", "cantidad" => "xsd:string", "tipoarchi" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:CrearAnexoExpediente",
        "urn:CrearAnexoExpediente#GetCrearAnexoExpediente",
        "rpc",
        "encoded",
        "Servicio para crear un Anexo en un expediente");
      
    $server->service($HTTP_RAW_POST_DATA);
?>