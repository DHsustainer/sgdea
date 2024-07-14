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
        <div class='title right'>Crear Expedientes con Anexos del Expediente #</div>
        <input type='text' class='title_act' placeholder='id gestion' name='id_gestion' id='id_gestion' maxlength='' />
        <input type='submit' value='Crear Expedientes con Anexos'  style='margin:10px;'/>
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
    include_once(MODELS.DS.'GestionM.php');
    $con = new ConexionBaseDatos;
    $con->Connect($con);
    $c = new Consultas;
    $f = new Funciones;
    $variable = explode(',', $id_gestion);
    foreach ($variable as $key => $value) {
       GetAnexoExpedienteCrearExpediente($value);
    }
    
   
    function GetAnexoExpedienteCrearExpediente($id) {
        global $con;
        global $f;
        global $c;
        /*Se verifica que exista el expediente*/
        $ges = $con->FetchAssoc($con->Query("select * from gestion where id = '".$id."'"));
        $id_gestion = $ges['id'];
        if($id_gestion <= 0){
            echo "El expediente ($id) no existe<br>";
            exit;
        }

        $query  = $con->Query("select * from gestion_anexos where gestion_id = '".$id."'");
        while($row = $con->FetchAssoc($query)){

            $num_oficio_respuesta = $ges['ciudad'].'-'.$f->zerofill($ges['oficina'],3).'-001-'.$f->zerofill($ges['dependencia_destino'],3);
            $MGestion = new MGestion;
            $nr = $MGestion->GetNRadicado($num_oficio_respuesta, $ges['ciudad'], $ges['oficina'], $ges['dependencia_destino'], $ges['id_dependencia_raiz'], $ges['tipo_documento']);
            $minr = $MGestion->GetMinRadicado();

            $sus = explode('.',$row['nombre']);
 
            $susc = $con->FetchAssoc($con->Query("select * from suscriptores_contactos where identificacion = '".$sus[0]."'"));
            $id_sus = $susc['id'];
            if($id_sus <= 0){

                $idx = $f->zerofill($ges['nombre_destino'], 4);
                $fid = $c->GetMaxIdTabla("suscriptores_contactos", "id");
                $fid = $fid+1;
                $fid = $f->zerofill($fid, 4);
                $idx .= $fid;
                $password = $f->GenerarSmallId();
                $mdp = md5($password);

                $id_sus = $con->Query("INSERT INTO suscriptores_contactos(identificacion, type, user_id, fecha, cod_ingreso, password, estado, dec_pass) 
                    VALUES ('".$sus[0]."','EMPLEADO','sanderkdna@gmail.com','".date('Y-m-d')."','$fid','$mdp','1','$password')",'insert');

                $con->Query("INSERT INTO suscriptores_contactos_direccion (id_contacto) VALUES ('$id_sus')");
            }

            $id_nuevo = $con->Query("INSERT INTO gestion(ts, radicado, f_recibido, nombre_radica, folio, tipo_documento, dependencia_destino, nombre_destino, fecha_vencimiento, estado_respuesta, num_oficio_respuesta, fecha_respuesta, observacion, prioridad, estado_solicitud, suscriptor_id, ciudad, usuario_registra, estado_archivo, oficina, id_dependencia_raiz, fecha_registro, min_rad, documento_salida)
                SELECT ts, radicado, f_recibido, nombre_radica, folio, tipo_documento, dependencia_destino, nombre_destino, fecha_vencimiento, estado_respuesta, '$nr', fecha_respuesta, observacion, prioridad, estado_solicitud, '".$id_sus."', ciudad, usuario_registra, estado_archivo, oficina, id_dependencia_raiz, fecha_registro, '$minr', documento_salida
                FROM gestion
                WHERE id = '".$id."'",'insert');

            $con->Query("update gestion_anexos set gestion_id = '".$id_nuevo."' where id = '".$row['id']."'");

            $filename=UPLOADS.DS.$id_nuevo.'/';
            if (!file_exists($filename)) {
                mkdir(UPLOADS.DS . $id_nuevo, 0777);
            }
            $filename=UPLOADS.DS.$id_nuevo.'/anexos/';
            if (!file_exists($filename)) {
                mkdir(UPLOADS.DS . $id_nuevo.'/anexos', 0777);
            }

            $filename1=UPLOADS.DS.$id_gestion.'/anexos/'.$row['url'];
            $filename2=UPLOADS.DS.$id_nuevo.'/anexos/'.$row['url'];
            if (!copy($filename1, $filename2)) {
                echo "Error al copiar $filename2...\n";
            }else{
                echo "Creado el expediente $id_nuevo<br>";
            }
        }

        
    }
    function desencriptar($cadena, $key){
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted;  //Devuelve el string desencriptado
    }
?>