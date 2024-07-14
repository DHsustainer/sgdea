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



    $id_gestion = $_REQUEST['id_gestion'];

    if($id_gestion == ""){

        ?>

        <form id='form' action='' method='POST'> 

        <div class='title right'>Cargar Anexos Carpetas</div>

        <input type='text' class='title_act' placeholder='id gestion' name='id_gestion' id='id_gestion' maxlength='' />

        <input type='submit' value='Cargar Imagenes'  style='margin:10px;'/>

        </form>

        <?php

        exit;

    }



    include_once('../app/basePaths.inc.php');

    include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

    include_once('../app/controller/consultas.php');

    include_once('../app/controller/funciones.php');

    include_once(MODELS.DS.'Gestion_anexosM.php');

    include_once(MODELS.DS.'Events_gestionM.php');

    include_once(MODELS.DS.'Gestion_folderM.php');



    $con = new ConexionBaseDatos;
    $con->Connect($con);



    $c = new Consultas;
    $f = new Funciones;



    $variable = explode(',', $id_gestion);

    foreach ($variable as $key => $value) {

       GetAnexoExpedienteCarpeta($value);

    }

    

   



    function GetAnexoExpedienteCarpeta($id) {

        global $con;



        /*Se verifica que exista el expediente*/

        $ges = $con->FetchAssoc($con->Query("select * from gestion where id = '".$id."'"));

        $id_gestion = $ges['id'];



        if($id_gestion <= 0){

            echo "El expediente ($id) no existe<br>";

            exit;

        }



         $us = $con->FetchAssoc($con->Query("select * from usuarios where user_id = '".$ges['usuario_registra']."'"));



        /**SE CREA LA CARPETA DEL EXPEDIENTE SI NO EXISTE*/

        $filename=UPLOADS.DS.$id_gestion.'/';

        if (!file_exists($filename)) {

            mkdir(UPLOADS.DS . $id_gestion, 0777);

        }

        $filename=UPLOADS.DS.$id_gestion.'/anexos/';

        if (!file_exists($filename)) {

            mkdir(UPLOADS.DS . $id_gestion.'/anexos', 0777);

        }



        $dir = opendir(UPLOADS.DS . $id_gestion.'/anexos');

        $files = array();

        while ($current = readdir($dir)){



            echo "Leyendo ".$current.'<br>';

            if( $current != "." && $current != "..") {

                if(is_dir($path.$current)) {

                    //showFiles($path.$current.'/');

                }

                else {

                  

                    $archi = explode('@@', $current);



                    echo "Insertando ".$current.'<br>';



                    if($archi[1] != ""){/*se maneja con subcarpeta*/

                        /*crear carpeta*/

                        $gfolder = $con->FetchAssoc($con->Query("select * from gestion_folder where gestion_id = '$id_gestion' and nombre = '$archi[0]' "));

                        //$filename=UPLOADS.DS.$id_gestion.'/anexos/'.$archi[0].'/';

                        if ($gfolder['id'] <= 0) {

                            //mkdir(UPLOADS.DS . $id_gestion.'/anexos/'.$archi[0], 0777);

                            $MGestion_folder = new MGestion_folder;

                            // USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA           

                            $create = $MGestion_folder->InsertGestion_folder($archi[0], "0", $id_gestion, $ges['usuario_registra'], date('Y-m-d'), "1", "1");

                        }



                        $gfolder = $con->FetchAssoc($con->Query("select * from gestion_folder where gestion_id = '$id_gestion' and nombre = '$archi[0]' "));

                        $an = new MGestion_anexos;

                        $an->InsertGestion_anexos($id_gestion, $archi[1], $value, $ges['usuario_registra'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", $i, $i);



                        $con->Query("update gestion_anexos set folder_id = '$gfolder[id]' where user_id = '$ges[usuario_registra]' and gestion_id = '$id_gestion' and url = '$value' and  nombre = '$archi[1]' ");





                        //$MEvents_gestion = new MEvents_gestion;

                        //$MEvents_gestion->InsertEvents_gestion($ges['usuario_registra'], $id_gestion, date("Y-m-d"), "Correspondencia Digitalizada", "Se Ha anexado al expediente la guia digitalizada del operador postal", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $ges['oficina'], $ges['dependencia_destino'], $ges['dependencia_destino'], $us['a_i'], "an", $id_gestion);



                    }else{

                        $an = new MGestion_anexos;

                        $an->InsertGestion_anexos($id_gestion, $archi[0], $archi[0], $ges['usuario_registra'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", $i, $i);



                        //$MEvents_gestion = new MEvents_gestion;

                        //$MEvents_gestion->InsertEvents_gestion($ges['usuario_registra'], $id_gestion, date("Y-m-d"), "Correspondencia Digitalizada", "Se Ha anexado al expediente la guia digitalizada del operador postal", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $ges['oficina'], $ges['dependencia_destino'], $ges['dependencia_destino'], $us['a_i'], "an", $id_gestion);

                    }

                }

            }

        }        

    }

    function desencriptar($cadena, $key){

        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

        return $decrypted;  //Devuelve el string desencriptado

    }



?>