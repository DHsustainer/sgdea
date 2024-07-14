<div id="form" class="white">
    <h4 class="title">Cargar Expedientes </h4>
    <?php if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1): ?>
    <form id="upload" method="post" action="/caratula/opcion/<?=$_GET[id]?>/subir_anexo/" enctype="multipart/form-data">
        <div id="drop">
            Soltar Aqui

            <a>Buscar</a>
            <input type="file" name="upl" multiple />
        </div>

        <ul>
            <!-- The file uploads will be shown here -->
        </ul>

    </form>    
    <?php endif ?>
    
</div>
<?

        $viewer =       array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,
                              ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,
                              ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,
                              ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,
                              ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,
                              "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,
                              "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,
                              ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video",

                              ".DOC" => "google"                        , "DOCX" => "google"                        , ".ZIP" => "google"                        , ".RAR" => "google"                        ,
                              ".TAR" => "google"                        , ".XLS" => "google"                        , "XLSX" => "google"                        , ".PPT" => "google"                        ,
                              ".PPS" => "google"                        , "PPTX" => "google"                        , "PPSX" => "google"                        , ".PDF" => "google"                        ,
                              ".TXT" => "google"                        , ".JPG" => "image"                         , "JPEG" => "image"                         , ".BMP" => "image"                         ,
                              ".GIF" => "image"                         , ".PNG" => "image"                         , ".DIV" => "image"                         , ".TIF" => "image"                         ,
                              "TIFF" => "image"                         , "MPEG" => "video"                         , ".AVI" => "video"                         , ".MP4" => "video"                         ,
                              "MIDI" => "audio"                         , ".ACC" => "audio"                         , ".WMA" => "audio"                         , ".OGG" => "audio"                         ,
                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video");
?>
<div id="form" class="white">
    <div class="title">
        <div style="float:left; line-height:33px;">
            <b>Expediente <?= $con->Result($querytot, 0, "t"); ?> Documentos Cargados </b>
        </div>
        <div style="float:left; margin-left:20px;">
            <form method="POST" action="<?= HOMEDIR.DS.'anexos'.DS.'buscador'.DS.$_GET['id'].DS ?>" style="margin:0px; padding:0px;">
                <input type="text" name="searchfilter" id="searchfilter" style="width:300px; margin-left:20px; margin-top:2px" placeholder="Buscar anexos aqui">
            </form>
        </div>
        <div style='float:right' class="opc" onclick="DescargarAnexos()">Descargar</div>
        <?
            if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
                if ($_SESSION['folder'] == '') {
                    echo '<div style="float:right" class="opc" onclick="EliminarAnexos()">Eliminar</div>';
                }
            }
        ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <form id="anexosdescargas">
        
<?php 
    while ($col=$con->FetchAssoc($query)) {
        $type=explode('.', strtolower($col[nom_img]));
        $type=array_pop($type);

        $file = $col["nom_img"];
        $ruta = HOMEDIR.DS."app/archivos_uploads/".$_SESSION["usuario"].trim("/anexos/ ").$file."";
        $cadena_nombre = substr($file,0,200);
        $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

        if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
            if ($_SESSION['folder'] == '') {
                $path = "onclick='changetext(this)'";
            }
        }

        echo "  <div class='anexos-div' id='$col[id]'>
                    <input type='checkbox' value='".$file."' name='servicio[]'  class='album_inner_button active_check' />
                    <div style='padding-top:0px; margin-top:-15px;' class='img-icon $type' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nom_palabra"]."\", \"1\", \"".$col["id"]."\")'></div>
                    <div class='clear'></div>
                    <div class='nom_anexo' title='$col[nom_palabra]'>
                        <input title='$col[nom_palabra]' type='text' id='$col[id]' readonly class='no_editable nanexo' value='$col[nom_palabra]' $path>
                    </div>
                </div>";
    }

#    echo "SELECT count(*) as t from anexos where proceso_id = '$id' and user_id = '$_SESSION[usuario]' and estado = '1'";
        $querypag="SELECT count(*) as t from anexos where proceso_id = '$id' and user_id = '$_SESSION[usuario]' and estado = '1'";

        echo '<div class="btn-group m-t-30">';
            $NroRegistros = $con->Result($con->Query($querypag), 0, 't');

            if($NroRegistros == 0){
            echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';
            }

            $PagAnt=$PagAct-1;
            $PagSig=$PagAct+1;
            $PagUlt=$NroRegistros/$RegistrosAMostrar;

            $Res=$NroRegistros%$RegistrosAMostrar;

            if($Res>0) $PagUlt=floor($PagUlt)+1;

            echo "<button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/caratula/opcion/$_GET[id]/anexos/1/'>Pagina 1</a> ";

            if($PagAct>1) 
                   
            echo "<button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/caratula/opcion/$_GET[id]/anexos/$PagAnt/'>Pagina Anterior.</a> ";


            echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

            if($PagAct<$PagUlt)  
            echo " <button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/caratula/opcion/$_GET[id]/anexos/$PagSig/'>Pagina Siguiente.</a> ";

            echo " <button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/caratula/opcion/$_GET[id]/anexos/$PagUlt/'>Pagina. $PagUlt</a>";
        echo '</div>'; 
?>
    </form>
    

    <style>
        .nom_anexo{
            font-size: 12px;
            height: 20px;
            line-height: 20px;
            overflow-y: hidden ; 
            overflow-x: hidden ; 
            padding: 5px;
            padding-right: 9px;
            cursor: normal;
        }

        .nom_anexo input{
            cursor: text;
        }

        .album_inner_button{
            position: relative;
            z-index: 999;
            border: 1px solid #f00;
        }
        
    </style>
</div>
<script src="<?=ASSETS?>/js/jquery.knob.js"></script>

<!-- jQuery File Upload Dependencies -->
<script src="<?=ASSETS?>/js/jquery.ui.widget.js"></script>
<script src="<?=ASSETS?>/js/jquery.iframe-transport.js"></script>
<script src="<?=ASSETS?>/js/jquery.fileupload.js"></script>

<!-- Our main JS file -->
<script src="<?=ASSETS?>/js/script.js"></script>
<script type="text/javascript">
    function changetext(text){
        $('.nanexo').prop('readonly', true);
        $('.nanexo').removeClass('editable');
        $('.nanexo').addClass('no_editable');
        $(text).removeClass('no_editable');
        $(text).addClass('editable');
        $(text).prop('readonly', false);
    }
    $(".nanexo").keypress(function(e) {
        if(e.which == 13) {
            $('.nanexo').prop('readonly', true);
            $('.nanexo').removeClass('editable');
            $('.nanexo').addClass('no_editable');
            $.ajax({
                url:'/caratula/opcion/<?=$_GET[id]?>/nom_anexo/',
                data:{name:$(this).val(),id_anexo:this.id},
                type:'POST',
                success:function(msg){
                    alert('Nombre modificado');
                }
            })
        }
    });
    $(".nanexo").on('blur', function() {
        $(this).prop('readonly', true);
        $(this).removeClass('editable');
        $(this).addClass('no_editable');
        /* Act on the event */
    });

    function DescargarAnexos(){
        var str = $("#anexosdescargas").serialize();
        $.ajax({
            url:'/anexos/descargar/',
            data:str,
            type:'POST',
            success:function(msg){
                window.location.href = msg;
            }
        })
    }

    function EliminarAnexos(){
        var str = $("#anexosdescargas").serialize();
        $.ajax({
            url:'/anexos/eliminar/',
            data:str,
            type:'POST',
            success:function(msg){
                alert("Archivos eliminados");
                window.location.reload();
            }
        })
    }
</script>

<!-- Only used for the demos. Please ignore and remove. --> 
<!-- <script src="http://cdn.tutorialzine.com/misc/enhance/v1.js" async></script> -->