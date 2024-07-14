<br>
<div style="background:#FFF;">
        <div class="title">Editar Correspondencia</div>
        <br>
        <form id="forminsertnotificacion" method="POST"  action="">
    <?
        $notificacion = new MNotificaciones;
        $notificacion->CreateNotificaciones("id", $id);

        $usuario = $notificacion->GetUser_id(); 

        $g = new MGestion;
        $g->CreateGestion("id", $notificacion->GetProceso_id());

        $me = new MUsuarios;
        $me->CreateUsuarios("user_id", $usuario);

        $usuario_nombre = strtolower($me->GetP_nombre()." ".$me->GetP_apellido());


    ?>
    <div class="row">
        <div class="col-md-2"><b>Remite:</b></div>
        <div class="col-md-10"><?= $usuario_nombre ?></div>
    </div>

    <div class="row">
        <div class="col-md-2"><b>Desinatario:</b></div>
        <div class="col-md-4"><?= $notificacion->GetDestinatario() ?></div>
        <div class="col-md-2"><b>Dirección:</b></div>
        <div class="col-md-4"><?= $notificacion->GetDireccion() ?></div>
    </div>
   
    <div class="row">
        <div class="col-md-12">
            <?php 

                $viewer =   array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,
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
                                  ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"                         , ".CSV" => "google");
            ?>  
            <div id="cargar_listas_demandas" class="scrollable">
                <div align="center" style="border:0px solid #333;">
                    <div id="laderdata">
                        <div class="titulo" align="left" style="margin-bottom: 5px;">Adjuntar Documentos</div>
                            <ul id='list-anexos'>
                                <li class='TituloCarpeta'><div id="atacchfiles">Carpeta Externa</div>
                                    <ul id="listfiles">
                            <?php
                                $sql = "SELECT * from gestion_anexos where gestion_id = '".$g->GetId()."' and  folder_id = '0'  and (estado = '1' or estado = '3')  order by orden";
                                $query_sql = $con->Query($sql);

                                $anexo_listado = "";
                                $listado_anexos = "";
                                $archivos_anexos_listado = "";
                                $titulos_anexos_listado = "";

                                for( $i=0;$i<$con->NumRows($query_sql);$i++ ){
                                    $imid = $con->Result($query_sql, $i, 'id');
                                    $file = $con->Result($query_sql, $i, 'url');

                                    $count = $con->Result($con->Query("select count(*) as t from notificaciones_attachments where id_anexo = '".$imid."' and id_notificacion = '".$notificacion->GetId()."'"), 0, 't');
                                    $checked = "";

                                    if ($count >= 1) {
                                        $checked = "checked='checked'";
                                        $anexo_listado .= ";a".$imid;
                                        $listado_anexos .= "<li id='la".$imid."'>".$con->Result($query_sql, $i, 'nombre')."</li>";
                                        $archivos_anexos_listado .= ";".$imid;
                                        $titulos_anexos_listado .= "@@@".$con->Result($query_sql, $i, 'nombre');
                                    }
                                    


                                    if ($file != "") {
                                        $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";
                                        $cadena_nombre = explode(".", $file);
                                        $extension = trim(".".end($cadena_nombre));  

                                        $type=explode('.', strtolower($con->Result($query_sql, $i, 'url')));
                                        $type=array_pop($type);

                                        $URL = "archivos_uploads/".$usuario.trim(" /anexos/ ").$file;
                                        $titulo = $con->Result($query_sql, $i, 'nombre');
                                        $title = $titulo;

                                echo "  <li class='anexos-li' id='$imid'>
                                            <input type='checkbox' alt='".$URL."' ".$checked." id='a".$con->Result($query_sql, $i, 'id')."' value='".$con->Result($query_sql, $i, 'id')."' class='album_inner_button active_check' title='".$titulo."' />
                                            <div style='padding-top:0px;' class='img-icon $type' style='width:30px' ></div>
                                            <div class='nom_anexo' title='$title' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$title."\", \"4\", \"".$imid."\")'>$titulo </div>
                                        </li>";

                                    }
                                }

                                    echo "      </ul>
                                            </li>";
                                $c->GetAnexosFisico($g->GetId(), 0, "-"); 

                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div id="list">
                        <div class="mailer_new_element" style="display: none">
                              <input type="hidden" value="<?= $notificacion->GetId(); ?>" id="id" name="id">
                              <input type="hidden" value="<?= $anexo_listado; ?> "id="anexo_listado" name="anexos_listado">
                              <input type="hidden" value="<?= $archivos_anexos_listado; ?> "id="archivos_anexos_listado" name="archivos_anexos_listado">
                              <input type="hidden" value="<?= $titulos_anexos_listado; ?> "id="titulos_anexos_listado" name="titulos_anexos_listado">
                              <ul id="listado_anexos"><?= $listado_anexos ?></ul>                  
                        </div>
                    <div>
                </div>
            </div>  

            <div class="row">
                <div class="col-md-12">
                    <input type="button" name="guardar" value="Actualizar Correspondencia" onClick="Updatecorrespondencia()">
                </div>
            </div>  
            
        </form>
    </div>    
<script>

    
$(document).ready(function(){

    $('#fecha').datepicker({
        dateFormat: 'yy-mm-dd',
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],        
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday        
    });
}); 

function DireccionesContacto(){

    var URL = '/notificaciones/DireccionesContacto/'+$("#demandado").val()+'/';
    $("#nom_destinatario").val($("#demandado option:selected").text());
    $.ajax({
        type: 'POST',
        url: URL,
        success: function(msg){
            result = msg;
            $("#direccion").attr("disabled",false);
            document.getElementById("direccion").options.length=1;
            $('#direccion').append(result);  

            // Some code here!
        }
    }); 
}
DireccionesContacto();
</script>

<script>
    $("#atacchfiles").click(function(){
        $("#listfiles").slideDown('slow');
    })

    $(".active_check").live("click", function(){
        var date = $(this).attr("checked"); 
        var valor = $(this).attr("value");
        var titulo = $(this).attr("title");
        var idan = $(this).attr("id");

        if (date){

            var strx = "<li id='l"+idan+"'>"+titulo+"</li>";
            $("#listado_anexos").append(strx);

            var x = $("#anexos_listado").val()+";"+idan;
            $("#anexos_listado").val(x);

            var y = $("#archivos_anexos_listado").val()+";"+valor;
            $("#archivos_anexos_listado").val(y);

            var y = $("#titulos_anexos_listado").val()+"@@@"+titulo;
            $("#titulos_anexos_listado").val(y);                  

        }else{
            var strx = "l"+idan;
            $("#"+strx).remove();

            var xl   = $("#anexos_listado").val();
            vector  = xl.split(";");

            var yl   = $("#archivos_anexos_listado").val();
            vectory  = yl.split(";");

            var ml   = $("#titulos_anexos_listado").val();
            vectorm  = ml.split("@@@");

            var xt = "";
            var yt = "";
            var mt = "";

            for (var i = 0 ; i < vector.length ; i++){
                if(vector[i] == idan){

                    vector.slice(i);                        
                    vectory.slice(i);
                    vectorm.slice(i);

                }else{
                    xt += vector[i]+";";
                    yt += vectory[i]+";";
                    mt += vectorm[i]+"@@@";
                }
            }
            $("#anexos_listado").val(xt);
            $("#archivos_anexos_listado").val(yt);
            $("#titulos_anexos_listado").val(mt);
        } 
    });
    

</script>

<style type="text/css">
    .album_inner_button{
        position: relative;
        z-index: 999;
    }
    
    #list-anexos{
        padding-left: 0px;
    }
    #list-anexos li.anexos-li{
        min-height: 45px;
        line-height: 45px;
        border-top:1px solid #CCC;
        width: 100%;
        list-style: none;

    }
    #list-anexos li.anexos-li .album_inner_button{
        float: left;
        width: 20px;
        margin-top: 15px;
    }

    #list-anexos li.anexos-li .nom_anexo{
        float:left;
        line-height: 35px;
        font-size: 12px;
        overflow-y: hidden ; 
        overflow-x: hidden ; 
        padding: 5px;
        padding-right: 9px;
        cursor: normal;
    }
    #list-anexos li.anexos-li .nom_anexo:hover{
        text-decoration: underline;
        cursor: pointer;
    }

    #list-anexos .TituloCarpeta{
        background-color: #1579C4;
        color: #FFF;
        line-height: 30px;
        font-weight: bold;
        font-size: 16px;
        padding-left: 20px;
        margin-bottom: 7px;
    }
    #list-anexos .TituloCarpeta:hover{
        cursor: pointer;
        background-color: #1263A1;
    }
    #list-anexos .TituloCarpeta > ul{
        background-color: #FFF;
        color:#000;
        padding: 0px;
        margin-left:-20px;
        display: none;;
    }

    #list-anexos .TituloCarpeta ul li input[type="checkbox"]{
        margin-top: 17px;
        margin-right: 10px;
        margin-left: 5px;
    }

    #FormUpdategestion .no_editable{
        display: none;
    }
</style>