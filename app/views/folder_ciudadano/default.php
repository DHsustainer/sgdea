<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/agenda.css'/>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<div class="icon schedule hight-blue"></div>
		</div>
		<div class="header-agenda">

		</div>
	</div>
</div>
<div id="folders-content">
	<div id="folders-list-content">
		



<div id="form" class="white">
    <h3 class="title">Cargar Documentos en la carpeta "<?= $of->GetTitulo(); ?>" </h3>
    <?php if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1): ?>
    <form id="upload" method="post" action="<?=HOMEDIR.DS.'anexos_carpeta'.DS.'registrar'.DS.$_REQUEST['id'].DS ?>" enctype="multipart/form-data">
        <div id="drop">
            Soltar Aqui

            <a>Buscar</a>
            <input type="file" name="upl" multiple />

        </div>
        <ul>
            <!-- The file uploads will be shown here -->
        </ul>

    </form>    
    <br>    
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
            <b>Expediente </b>
        </div>
        <?
            if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
                if ($_SESSION['folder'] == '') {
                    #echo '<div style="float:right" class="opc" onclick="EliminarAnexos()">Eliminar</div>';
                }
            }
            echo '<div style="float:right; width:150px" class="opc" onClick="window.location.href=\''.HOMEDIR.'/correo/nuevo/*./'.$of->GetUser_2().'/ \'">Enviar Mensaje</div>';
        ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <form id="anexosdescargas" style="text-align:left">
        
<?php 

	$query = $con->Query("select * from anexos_carpeta where folder_id = '".$_REQUEST['id']."'");
    while ($col=$con->FetchAssoc($query)) {
        $type=explode('.', strtolower($col[url]));
        $type=array_pop($type);

        $file = $col["url"];
        $ruta = HOMEDIR.DS."app/archivos_uploads/".$col['user_id'].trim("/folders/ ").$file."";
        $cadena_nombre = substr($file,0,200);
        $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

        if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
            if ($_SESSION['folder'] == '') {
                $path = "onclick='changetext(this)'";
            }
        }

        echo "  <div class='anexos-div' id='$col[id]'>
                    <!--<input type='checkbox' value='".$file."' name='servicio[]'  class='album_inner_button active_check' /> -->
                    <div style='padding-top:0px; margin-top:-15px;' class='img-icon $type' onclick='AbrirDocumentoPublico(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"1\", \"".$col["id"]."\")'></div>
                    <div class='clear'></div>
                    <div class='nom_anexo' title='$col[nombre]'>
                        <input title='$col[nombre]' type='text' id='$col[id]' readonly class='no_editable nanexo' value='$col[nombre]' $path>
                    </div>
                </div>";
    }
/*
#    echo "SELECT count(*) as t from anexos where proceso_id = '$id' and user_id = '$_SESSION[usuario]' and estado = '1'";
        $querypag="SELECT count(*) as t from anexos_carpeta where proceso_id = '$id' and user_id = '$_SESSION[usuario]' and estado = '1'";

        echo '<div class="paginator">';
            $NroRegistros = $con->Result($con->Query($querypag), 0, 't');

            if($NroRegistros == 0){
            echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';
            }

            $PagAnt=$PagAct-1;
            $PagSig=$PagAct+1;
            $PagUlt=$NroRegistros/$RegistrosAMostrar;

            $Res=$NroRegistros%$RegistrosAMostrar;

            if($Res>0) $PagUlt=floor($PagUlt)+1;

            echo "<a class='pag' href= '".HOMEDIR."/caratula/opcion/$_GET[id]/anexos/1/'>Pagina 1</a> ";

            if($PagAct>1) 
                   
            echo "<a class='pag' href= '".HOMEDIR."/caratula/opcion/$_GET[id]/anexos/$PagAnt/'>Pagina Anterior.</a> ";


            echo "<span style='line-height:20px; vertical-align:top; font-size:15px;' class='texto_italic'>Pagina ".$PagAct." de ".$PagUlt."</span>";

            if($PagAct<$PagUlt)  
            echo " <a class='pag' href= '".HOMEDIR."/caratula/opcion/$_GET[id]/anexos/$PagSig/'>Pagina Siguiente.</a> ";

            echo " <a class='pag' href= '".HOMEDIR."/caratula/opcion/$_GET[id]/anexos/$PagUlt/'>Pagina. $PagUlt</a>";
        echo '</div>';  */
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
<!-- <script src="http://cdn.tutorialzine.com/misc/enhance/v1.js" async></script> --
>





	</div>
</div>
