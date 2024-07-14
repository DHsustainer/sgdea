<h4>Crear Correspondencia</h4>
<form id="forminsertnotificacion" method="POST"  action="">
    <?
        $usuario = $_SESSION['usuario']; 

        $me = new MUsuarios;
        $me->CreateUsuarios("user_id", $_SESSION['usuario']);

        $usuario_nombre = strtoupper($me->GetP_nombre()." ".$me->GetP_apellido());
    ?>
    <?php if ($_SESSION['MODULES']['demandas_en_linea'] == "1"): ?>
          
    <div class="row m-t-20 m-b-20 dn">
        <div class="col-md-12">
            <input type="checkbox" name="notif" id="notif">
            <label for="notif" class="model_img">La Correspondencia que Envío es una Notificación Judicial</label>
        </div>
    </div>    
      <?php endif ?>  

     <div class="row">
        <div class="col-md-4">
            <input type="text" id="remitente" value="<?= $usuario_nombre; ?>" placeholder ="Remitente Ej: <?= $usuario_nombre; ?>" name="remitente" class="form-control">
        </div>
        <div class="col-md-4">
            <select name="spostal" id="spostal" class="form-control">
                <?
                   
                    $cliente = new nusoap_client("http://laws.com.co/ws/GetPostalServices.wsdl", true);

                    $error = $cliente->getError();
                    if ($error) {
                        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
                    }

                    $array = array("id" => trim($_SERVER['HTTP_HOST']), "key" => trim($_SESSION['user_key']));
                    $result = $cliente->call("GetListadoOperadoresPostal", $array);
                      
                    if ($cliente->fault) {
                        echo "<h2>Fault</h2><pre>";
                        echo "</pre>";
                    }else{
                        $error = $cliente->getError();

                        if ($error) {
                            echo "<h2>Error</h2><pre>" . $error . "</pre>";
                        }else {
                            if ($result == "") {
                                echo "No se creo el WS para ".trim($_SERVER['HTTP_HOST'])." -> ".trim($_SESSION['user_key']);
                            }else{
                                echo $result;
                            }
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <select name="titulo" id="titulo" class="form-control" onchange="hidethings()">
                <option value="CC">Correo Certificado</option>
                <option value="CE">Correo Electrónico Certificado</option>
                <option value="CC/CE">Correo Certificado y Correo Electrónico Certificado</option>
            </select>
        </div>
    </div>
    <div class="row m-t-10">
        <div class="col-md-4">
            <select name="demandado" id="demandado" onChange="DireccionesContacto()" class="form-control" placeholder="Destinatario">
            <?
                    $object = new MGestion_suscriptores;
                    $query = $object->ListarGestion_suscriptores("WHERE id_gestion = '".$g->GetId()."'");
                    while($row = $con->FetchAssoc($query)){
                        $l = new MGestion_suscriptores;
                        $l->Creategestion_suscriptores('id', $row[id]);
                        $sus = new MSuscriptores_contactos;
                        $sus->CreateSuscriptores_contactos("id", $l -> GetId_suscriptor());
                        echo '<option value="'.$sus->GetId().'" data-target="'.$sus->GetIdentificacion().'">'.$sus->GetNombre().'</option>';
                    }
            ?>
            </select>
        </div>
        <div class="col-md-4">
            <select name="direccion" id="direccion" onchange="SetDestinatario()" disabled="disabled"class="form-control"  placeholder="DirecciónDestinatario">
                <option value="">Seleccione una Direccion</option>
            </select>
        </div>
        <div class="col-md-4">
             <select name="comparecer" id="comparecer" class=" form-control">
                <option>Tipo de Entrega</option>
                <option value="0">Servicio Normal</option>
                <option value="1">Entrega Inmediata (24 Horas)</option>
            </select>
            <input type="hidden" id="nom_destinatario" name="nom_destinatario">
            <input type="hidden" id="lista_destinatarios" name="lista_destinatarios">
            <input type="hidden" id="id_gestion" name="id_gestion" value="<?= $g->GetId(); ?>">
        </div>
    </div>
    <div class="row m-t-10">
        <div class="col-md-12">
            <label class="m-l-0 p-l-0">Listado de Destinatarios:</label>
            <ul id="listado_destinatarios" class="list-group"></ul>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12">
            <div class="mailer_new_element" style="display:none">
                <input type="hidden" id="anexos_listado" name="anexos_listado">
                <input type="hidden" id="archivos_anexos_listado" name="archivos_anexos_listado">
                <input type="hidden" id="titulos_anexos_listado" name="titulos_anexos_listado">
                <ul id="listado_anexos" class="list-group"></ul>                  
            </div>
<?
    $viewer =  array(     ".doc" => "google" , "docx" => "google" , ".zip" => "google" , ".rar" => "google" , ".tar" => "google" , ".xls" => "google" , "xlsx" => "google" , ".ppt" => "google" , ".pps" => "google" , "pptx" => "google" , "ppsx" => "google" , ".pdf" => "google" , ".txt" => "google" , ".jpg" => "image"  , "jpeg" => "image"  , ".bmp" => "image"  , ".gif" => "image"  , ".png" => "image"  , ".dib" => "image"  , ".tif" => "image"  , "tiff" => "image"  , "mpeg" => "video"  , ".avi" => "video"  , ".mp4" => "video"  , "midi" => "audio"  , ".acc" => "audio"  , ".wma" => "audio"  , ".ogg" => "audio"  , ".mp3" => "audio"  , ".flv" => "video"  , ".wmv" => "video"  , ".csv" => "google" , ".DOC" => "google" , "DOCX" => "google" , ".ZIP" => "google" , ".RAR" => "google" , ".TAR" => "google" , ".XLS" => "google" , "XLSX" => "google" , ".PPT" => "google" , ".PPS" => "google" , "PPTX" => "google" , "PPSX" => "google" , ".PDF" => "google" , ".TXT" => "google" , ".JPG" => "image"  , "JPEG" => "image"  , ".BMP" => "image"  , ".GIF" => "image"  , ".PNG" => "image"  , ".DIV" => "image"  , ".TIF" => "image"  , "TIFF" => "image"  , "MPEG" => "video"  , ".AVI" => "video"  , ".MP4" => "video"  , "MIDI" => "audio"  , ".ACC" => "audio"  , ".WMA" => "audio"  , ".OGG" => "audio"  , ".MP3" => "audio"  , ".FLV" => "video"  , ".WMV" => "video"  , ".CSV" => "google" );

    $iconfile = array("doc" => "mdi-file-word text-info" , "docx" => "mdi-file-word text-info" , "zip" => "mdi-zip-box text-info" , "rar" => "mdi-zip-box text-info" , "tar" => "mdi-zip-box text-info" , "xls" => "mdi-file-excel text-success" , "xlsx" => "mdi-file-excel text-success" , "ppt" => "mdi-file-powerpoint text-danger" , "pps" => "mdi-file-powerpoint text-danger" , "pptx" => "mdi-file-powerpoint text-danger" , "ppsx" => "mdi-file-powerpoint text-danger" , "pdf" => "mdi-file-pdf text-danger" , "txt" => "mdi-file-document text-muted" , "jpg" => "mdi-file-image text-success"  , "jpeg" => "mdi-file-image text-success"  , "bmp" => "mdi-file-image text-success"  , "gif" => "mdi-file-image text-success"  , "png" => "mdi-file-image text-success"  , "dib" => "mdi-file-image text-success"  , "tif" => "mdi-file-image text-success"  , "tiff" => "mdi-file-image text-success"  , "mpeg" => "mdi-file-video text-warning"  , "avi" => "mdi-file-video text-warning"  , "mp4" => "mdi-file-video text-warning"  , "midi" => "mdi-audiobook mdi-warning"  , "acc" => "mdi-audiobook mdi-warning"  , "wma" => "mdi-audiobook mdi-warning"  , "ogg" => "mdi-audiobook mdi-warning"  , "mp3" => "mdi-audiobook mdi-warning" , "flv" => "mdi-file-video text-warning"  , "wmv" => "mdi-file-video text-warning"  , "csv" => "mdi-file-excel text-success" , "" => "mdi-file-find text-warning" );
?>
                
            <label class="m-l-0 p-l-0">Adjuntar Documentos</label>
            <div class='list-group' id="listfiles">
            <?php
            $sql = "SELECT * from gestion_anexos where gestion_id = '".$g->GetId()."' and  folder_id = '0'  and (estado = '1' or estado = '3')  order by orden";
            $query_sql = $con->Query($sql);

            for( $i=0;$i<$con->NumRows($query_sql);$i++ ){
                $imid = $con->Result($query_sql, $i, 'id');

                $file = $con->Result($query_sql, $i, 'url');
                if ($file != "") {
                    $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";
                    $cadena_nombre = explode(".", $file);
                    $extension = trim(".".end($cadena_nombre));  

                    $type=explode('.', strtolower($con->Result($query_sql, $i, 'url')));
                    $type=array_pop($type);

                    $URL = "archivos_uploads/".$usuario.trim(" /anexos/ ").$file;
                    $titulo = $con->Result($query_sql, $i, 'nombre');
                    $title = $titulo;

                echo "  
                    <div class='list-group-item' id='$imid'>
                        <div class='row'>
                            <div class='col-md-12 waves-effect'>
                                <input type='checkbox' alt='".$URL."' id='a".$con->Result($query_sql, $i, 'id')."' value='".$con->Result($query_sql, $i, 'id')."' class='album_inner_button active_check' title='".$titulo."' style='float:left; margin-right:5px; margin-top:15px'  />
                                <div class='material-icon-list-demo' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$title."\", \"4\", \"".$imid."\")'>
                                    <div class='icons'>
                                        <div>
                                            <i class='mdi ".$iconfile[$type]."'></i><span> $titulo</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";

                }
            }

                echo "      </ul>
                        </li>";
            $c->GetAnexosFisico($g->GetId(), 0, "-"); 

            ?>
            </div>
        </div>
    </div> 

    <div class="row m-t-10">
        <div class="col-md-12">
            <label class="col-md-12 m-l-0 p-l-0">
                Adjuntar Formulario (No obligatorio)
            </label>
            <select name="id_form" id="id_form" class="form-control">
                <option value="0">Seleccione una Opción</option>
                <?
                        
                    $queryforms = $con->Query("select ref_id, grupo_id from meta_big_data where type_id = '".$g->GetId()."' and tipo_form = '1' group by grupo_id");
                       
                    while ($rowform = $con->FetchAssoc($queryforms)) {
                        $nomform = $c->GetDataFromTable("meta_referencias_titulos", "id", $rowform['ref_id'], "titulo", $separador = " ");

                        echo '<option value="'.$rowform['grupo_id'].'">'.$nomform.'</option>';
                        
                    }
                ?>
            </select>
        </div>
    </div> 
    <div class="row m-t-10">
        <div class="col-md-12">
            <label class="col-md-12 m-l-0 p-l-0">
                Observacion:
            </label>
            <textarea name="dcontenido" id="dcontenido" placeholder="Describa en 140 Caracteres el Contenido de su correspondencia, o escriba alguna obsevación sobre ella" class="form-control height-100"></textarea>
        </div>
    </div>  

    <div class="row m-t-10" id="formnotif" style="display:none">
        <div class="col-md-12">
            <?
                include_once(VIEWS.DS.'notificaciones/FormNotificacionJudicial.php');
            ?>
        </div>
    </div>  
    <div class="row m-t-10 m-b-20">
        <div class="col-md-12">
            <input type="button" name="guardar" value="Enviar Correspondencia" onClick="sentcorrespondencia()" class="btn btn-info">
        </div>
    </div>  
            
</form> 
<script>


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
            hidethings();
        }
    }); 
}

function hidethings(){
    /*$( "#direccion option" ).each(function() {
        $(this).css("display", "block");
        if ($("#titulo option:selected").val() == "CC") {
            if($( this ).data( "role" ) == "email"){
                $(this).css("display", "none");
            }
        }else{
            if($( this ).data( "role" ) == "addr"){
                $(this).css("display", "none");
            }
        }
    });*/
}

function SetDestinatario(){

    $("#lista_destinatarios").val($("#lista_destinatarios").val()+$("#direccion option:selected").val()+"; ");
    $("ul#listado_destinatarios").append("<li class='list-group-item'>"+$("#demandado option:selected").html()+" - "+$("#direccion option:selected").val()+"</li>");

    $("#notif_cedula_demandado").val($("#demandado option:selected").attr("data-target"));
    $("#notif_demandado").val($("#demandado option:selected").html());
    $("#notif_nombre").val($("#demandado option:selected").html());
    $("#notif_direccion").val($("#direccion option:selected").val());

    $("#notif_emaildemandado").val($("#direccion option:selected").data('email'));
    
}
DireccionesContacto();


    $("#atacchfiles").click(function(){
        $("#listfiles").slideDown('slow');
    })

    
    $("#notif").change(function(){
        var date = $(this).prop("checked"); 
        if (date) {
            $("#formnotif").slideDown();
        }else{
            $("#formnotif").slideUp();
        }
    })

    $(".active_check").click(function(){
        var date = $(this).prop("checked"); 
        var valor = $(this).attr("value");
        var titulo = $(this).attr("title");
        var idan = $(this).attr("id");

        if (date){

            var strx = "<li id='l"+idan+"' class='list-group-item'>"+titulo+"</li>";
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

