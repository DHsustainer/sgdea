<h2>Correspondencias Enviadas</h2>
<div class="row">
    <div class="col-md-12">
        <div class="list-group">

<?
    $q = $con->Query("select * from notificaciones where proceso_id = '".$g->GetId()."'");
    global $f;

    $viewer =  array(     ".doc" => "google" , "docx" => "google" , ".zip" => "google" , ".rar" => "google" , ".tar" => "google" , ".xls" => "google" , "xlsx" => "google" , ".ppt" => "google" , ".pps" => "google" , "pptx" => "google" , "ppsx" => "google" , ".pdf" => "google" , ".txt" => "google" , ".jpg" => "image"  , "jpeg" => "image"  , ".bmp" => "image"  , ".gif" => "image"  , ".png" => "image"  , ".dib" => "image"  , ".tif" => "image"  , "tiff" => "image"  , "mpeg" => "video"  , ".avi" => "video"  , ".mp4" => "video"  , "midi" => "audio"  , ".acc" => "audio"  , ".wma" => "audio"  , ".ogg" => "audio"  , ".mp3" => "audio"  , ".flv" => "video"  , ".wmv" => "video"  , ".csv" => "google" , ".DOC" => "google" , "DOCX" => "google" , ".ZIP" => "google" , ".RAR" => "google" , ".TAR" => "google" , ".XLS" => "google" , "XLSX" => "google" , ".PPT" => "google" , ".PPS" => "google" , "PPTX" => "google" , "PPSX" => "google" , ".PDF" => "google" , ".TXT" => "google" , ".JPG" => "image"  , "JPEG" => "image"  , ".BMP" => "image"  , ".GIF" => "image"  , ".PNG" => "image"  , ".DIV" => "image"  , ".TIF" => "image"  , "TIFF" => "image"  , "MPEG" => "video"  , ".AVI" => "video"  , ".MP4" => "video"  , "MIDI" => "audio"  , ".ACC" => "audio"  , ".WMA" => "audio"  , ".OGG" => "audio"  , ".MP3" => "audio"  , ".FLV" => "video"  , ".WMV" => "video"  , ".CSV" => "google" );

    $iconfile = array("doc" => "mdi-file-word text-info" , "docx" => "mdi-file-word text-info" , "zip" => "mdi-zip-box text-info" , "rar" => "mdi-zip-box text-info" , "tar" => "mdi-zip-box text-info" , "xls" => "mdi-file-excel text-success" , "xlsx" => "mdi-file-excel text-success" , "ppt" => "mdi-file-powerpoint text-danger" , "pps" => "mdi-file-powerpoint text-danger" , "pptx" => "mdi-file-powerpoint text-danger" , "ppsx" => "mdi-file-powerpoint text-danger" , "pdf" => "mdi-file-pdf text-danger" , "txt" => "mdi-file-document text-muted" , "jpg" => "mdi-file-image text-success"  , "jpeg" => "mdi-file-image text-success"  , "bmp" => "mdi-file-image text-success"  , "gif" => "mdi-file-image text-success"  , "png" => "mdi-file-image text-success"  , "dib" => "mdi-file-image text-success"  , "tif" => "mdi-file-image text-success"  , "tiff" => "mdi-file-image text-success"  , "mpeg" => "mdi-file-video text-warning"  , "avi" => "mdi-file-video text-warning"  , "mp4" => "mdi-file-video text-warning"  , "midi" => "mdi-audiobook mdi-warning"  , "acc" => "mdi-audiobook mdi-warning"  , "wma" => "mdi-audiobook mdi-warning"  , "ogg" => "mdi-audiobook mdi-warning"  , "mp3" => "mdi-audiobook mdi-warning" , "flv" => "mdi-file-video text-warning"  , "wmv" => "mdi-file-video text-warning"  , "csv" => "mdi-file-excel text-success" , "" => "mdi-file-find text-warning" );

    $i = 0;
    while ( $row = $con->FetchAssoc($q)) {
        $i++;
        $responsable = $c->GetDataFromTable("usuarios", "user_id", $row['user_id'], "p_nombre, p_apellido", $separador = " ");

        // $cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);

        // $error = $cliente->getError();
        // if ($error) {
        //     echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        // }

        // $array = array("id" => $row['id_postal']);
          
        // $result = $cliente->call("GetDetalleOperador", $array);
          
        // if ($cliente->fault) {
        //     echo "<h2>Fault</h2><pre>";
        //     echo "</pre>";
        // }else{
        //     $error = $cliente->getError();

        //     if ($error) {
        //         echo "<h2>Error</h2><pre>" . $error . "</pre>";
        //     }else {
        //         if ($result == "") {
        //             echo "No se creo el WS";
        //         }else{
        //             $x  = explode(",", $result);
        //             $postal = $x[0];
        //             $msj = $x[2];
        //         }
        //     }
        // }

        $listanexos = "";
        $listanexos = " <ul role='menu' class='dropdown-menu'>";
                                
        $qan = $con->Query("select * from notificaciones_attachments where id_notificacion = '".$row['id']."'");

            while ($rowan = $con->FetchAssoc($qan)) {
                $ga = new MGestion_anexos;
                $ga->CreateGestion_anexos("id", $rowan['id_anexo']);

                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
                $extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  
                $nom    = "<div class='smallname'>".$c->GetDataFromTable("usuarios", "user_id", $ga->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</div>";
                $link  = "<div class='filename' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".substr($ga->GetNombre(), 0, 60)."</div>";
                $listanexos .= '<li><a href="#">'.$link.$nom.'</a></li>';
            }

            if ($row['is_certificada'] == "0") {
                $listanexos .= " <li style='cursor:pointer' onclick='ShowMailer(\"/notificaciones/mini_edit/".$row['id']."/\", \"mailer_edit\")'>Agregar Más Anexos</li>";
            }

        $listanexos .= "    </ul>";

        $status = array("0" => "<img src='".ASSETS.DS."images/wait.png' title='Correspondencia Pendiente por Validar en Empresa Postal'>", 
                        "1" => "<img src='".ASSETS.DS."images/inwork.png' title='Correspondencia Correspondencia Recibida Y/O en Distribucion'>", 
                        "2" => "<img src='".ASSETS.DS."images/done.png' title='Correspondencia Entregada: \"".$row['nom_archivo']."\"'>",  
                        "3" => "<img src='".ASSETS.DS."images/undone.png' title='Correspondencia No Entregada: ".$row['nom_archivo']."'>",
                        "-1" => "<img src='".ASSETS.DS."images/undone.png' title='Correspondencia Rechazada por el Courrier: ".$row['nom_archivo']."'>"
                        );
        echo '<div class="list-group-item">
                <div class="row bloque_gestion propietario  primera">
                    <div class="col-md-12">
                        <h5><b>Enviado Para: </b><span style="font-size:20px;">'.$row['destinatario'].' / '.$row['direccion'].'</span></h5>
                    </div>
                </div>
                <div class="row bloque_gestion propietario ">
                    <div class="col-md-2"><b>De:</b></div>
                    <div class="col-md-4">'.$responsable.'</div>
                    <div class="col-md-2"><b>F. Envío</b></div>
                    <div class="col-md-4">'.$f->ObtenerFecha($row['f_citacion']).'</div>
                </div>';

        if ($row['tipo_notificacion'] != "SMS") {
            if ($row['nombre_postal'] != "") {
                echo '
                    <div class="row bloque_gestion propietario ultima m-t-30">
                        <div class="col-md-4"><b>Op. Postal:</b><br>'.$postal.'</div>
                        <div class="col-md-4"><b># Guia</b><br>'."<a href='$msj$row[guia_id]' target='_blank'> Ver Seguimiento #".$row['guia_id'].'</a></div>
                        <div class="col-md-4 mainlistanexos">
                            <div class="btn-group m-r-10">
                                <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button"><span class="mdi mdi-paperclip"></span></button>
                                '.$listanexos.'
                            </div>
                            '.$status[$row['is_certificada']];
                /*if ($row['guia_id'] == "" && $row['is_certificada'] == "0") {
                    echo " <img src='".ASSETS.DS."images/remove.png' title='Anular servicio' onClick='AnularServicio(\"".$row['id']."\")'>";
                }*/
            echo '      </div>
                    </div>';
            }else{

                $qmr = $con->Query("select * from mailer_replys where receiver_id = '".$row['id']."'");
                $mr = $con->FetchAssoc($qmr);

                echo '
                    <div class="row bloque_gestion propietario ultima m-t-30">
                        <div class="col-md-6"><b># Seguimiento</b><br>'."<a href='/notificaciones/seguimiento/".$row['id']."/' target='_blank'> Ver Seguimiento #".$row['guia_id'].'</a></div>
                        <div class="col-md-6">
                            <b>Fecha de Apertura:</b><br>'.$f->ObtenerFecha4($mr['abierto_fecha']);
            echo '      </div>
                    </div>';
                
            }
        }

            if ($row['sms_usar'] == "SI") {
                $estadosms = array("0" => "Enviado", "1" => "Abierto", "2" => "No Entregado");
                echo '
                        <div class="row bloque_gestion m-t-10 p-t-10">
                            <div class="col-md-4">
                                <h5><b>SMS Enviado a:</b><br>'.$row['telefono'].'</h5>
                            </div>
                            <div class="col-md-4">
                                <h5><b>Estado:</b><br>'.$estadosms[$row['sms_leido']].'</h5>
                            </div>
                            <div class="col-md-4">
                                <h5><b>Hora de Apertura:</b><br>'.$row['fecha_lectura_sms'].'</h5>
                            </div>
                        </div>';
                
            }
        echo '</div>';
    }
    if ($i == "0") {
        echo "  <div class='row'>
                    <div class='col-md-12'><div class='alert alert-info'>No tienes Correspondencia en este expediente</div></div>
                </div>";
    }
?>
        </div>
    </div>
</div>
<style type="text/css">
.smaplink:hover, a:hover{
    text-decoration: underline;
    cursor: pointer;
}

.smaplink, a{
    color: #1263a1;
    text-decoration: none;
}
.smaplink.mainlistanexos:hover .listanexos{
    display: block;
}
.smaplink .listanexos{
    display: none;
    position: absolute;
    border-radius: 4px;
    z-index: 9999;
    margin: 0px;
    background: #FFF;
    margin-top: -10px;
    width: 350px;
    max-height: 300px;
    cursor: default;
    padding-bottom: 10px;
    text-align: left;
}

.smaplink .listanexos ul, .smaplink .listanexos ul li{
    margin:0px;
    list-style: none;
    text-align: left;
    background: #FFF;
}

.smaplink .listanexos ul li .smallname{
    text-transform: capitalize;
    font-size: 10px;
    color: #222;
    margin-top: 0px;
}
.smaplink .listanexos ul li .filename{
    text-transform: capitalize;
    margin-bottom: 0px;
}

.smaplink .listanexos ul li .filename:hover{
    text-decoration: underline;
    cursor: pointer;
}
.descripcion {
    margin: 10px;
    margin-left: 80px;
    border: 1px dashed #EDEDED;
    padding: 10px;
}
</style>