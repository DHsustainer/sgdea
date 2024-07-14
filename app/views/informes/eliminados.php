
<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <input id="checkAll4" onclick="checkTodos(this.id,'tipos_campos');" name="checkAll" type="checkbox" />
            <label for="checkAll4" ><strong>Seleccionar / Deseleccionar Todos los campos</strong></label>
        </div>
        <div class="col-md-6" align="right" style="margin-bottom: 4px">
            <span class="fa fa-trash btn btn-primary" onClick="EliminarDocumentosFull()"></span>
        </div>
        <form id="listadoeliminaciondocumentos">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th width="30px"></th>
                        <th>Nombre del Archivo</th>
                        <th>Expediente</th>
                        <th>Eliminado Por</th>
                        <th width="120px">F. Eliminación</th>
                    </tr>
                </thead>
                <tbody id="tipos_campos">
    <?
                $sa = $con->Query("SELECT dias_eliminacion FROM super_admin where id = '6'");
                $sad = $con->FetchAssoc($sa);
                $dias = $sad['dias_eliminacion'];

                $fecha = date('Y-m-j');
                $nuevafecha = strtotime ( '-'.$dias.' day' , strtotime ( $fecha ) ) ;
                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
     
                $q = $con->Query("select * from gestion_anexos where estado = 0");

                while ($row = $con->FetchAssoc($q)) {
                    $g = new MGestion;
                    $g->CreateGestion("id", $row['gestion_id']);

                    $ev = $con->Query("SELECT * FROM events_gestion where id_ext = '".$row['id']."' and elm_type = 'edoc'");
                    $evd = $con->FetchAssoc($ev);

                    $usuario = $c->GetDataFromTable("usuarios", "user_id", $evd['user_id'], "p_nombre, p_apellido", $separador = "");

                    $colorized = "";
                    if ($evd['added'] < $nuevafecha) {
                        $colorized = "style='background-color:#f2dede !important'";
                    }

                    $type=explode('.', strtolower($row[url]));

                    $type=array_pop($type);
                    $file = $row["url"];
                    $propietario_documento = false;
                    $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$row['id'].trim("/anexos/ ").$file."";
                    $cadena_nombre = substr($file,0,200);
                    $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

                    $listadodocumentos = "<span style='cursor:pointer' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$row["nombre"]."\", \"4\", \"".$row["id"]."\")'>".$row['nombre']."</span>";

                    echo '  <tr>
                                <td '.$roworized.'>
                                    <input type="checkbox" name="campos[]" value="'.$row['id'].'" id="col_'.$row['id'].'">
                                </td>
                                <td '.$roworized.'>'.$listadodocumentos.'</td>
                                <td '.$colorized.'>
                                    <a href="/gestion/ver/'.$g->GetId().'/" target="_blank">'.$g->GetMin_rad().'</a>
                                </td>
                                <td '.$colorized.'>'.$usuario.'</td>
                                <td '.$colorized.'>'.$evd['added'].'</td>
                            </tr>';
                }
    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<?
$viewer =       array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,

                          ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,

                          ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,

                          ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,

                          ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,

                          "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,

                          "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,

                          ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video"                         , ".csv" => "google"                        ,

                          ".DOC" => "google"                        , "DOCX" => "google"                        , ".ZIP" => "google"                        , ".RAR" => "google"                        ,

                          ".TAR" => "google"                        , ".XLS" => "google"                        , "XLSX" => "google"                        , ".PPT" => "google"                        ,

                          ".PPS" => "google"                        , "PPTX" => "google"                        , "PPSX" => "google"                        , ".PDF" => "google"                        ,

                          ".TXT" => "google"                        , ".JPG" => "image"                         , "JPEG" => "image"                         , ".BMP" => "image"                         ,

                          ".GIF" => "image"                         , ".PNG" => "image"                         , ".DIV" => "image"                         , ".TIF" => "image"                         ,

                          "TIFF" => "image"                         , "MPEG" => "video"                         , ".AVI" => "video"                         , ".MP4" => "video"                         ,

                          "MIDI" => "audio"                         , ".ACC" => "audio"                         , ".WMA" => "audio"                         , ".OGG" => "audio"                         ,

                          ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"                         , ".CSV" => "google"                        ,

                          ".xml" => "google");
?>