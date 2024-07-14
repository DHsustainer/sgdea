<div class="row">
    <div class="col-md-12 panel">
        <div class="white-panel">
<?php 
    //base 64
    $bd_base_file = $ga->Getbase_file();
    $base_file = '';
    $data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$ga->GetGestion_id()."/anexos".DS.$ga->GetUrl());

    $base_file = base64_encode($data_base_file);
    $url = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";

    $viewer =   array(".doc" => "google", "docx" => "google", ".zip" => "google", ".rar" => "google",
      ".tar" => "google", ".xls" => "google", "xlsx" => "google", ".ppt" => "google",
      ".pps" => "google", "pptx" => "google", "ppsx" => "google", ".pdf" => "google",
      ".txt" => "google", ".jpg" => "image", "jpeg" => "image", ".bmp" => "image",
      ".gif" => "image", ".png" => "image", ".dib" => "image", ".tif" => "image",
      "tiff" => "image", "mpeg" => "video", ".avi" => "video", ".mp4" => "video",
      "midi" => "audio", ".acc" => "audio", ".wma" => "audio", ".ogg" => "audio",
      ".mp3" => "audio", ".flv" => "video", ".wmv" => "video", ".csv" => "google",
      ".DOC" => "google", "DOCX" => "google", ".ZIP" => "google", ".RAR" => "google",
      ".TAR" => "google", ".XLS" => "google", "XLSX" => "google", ".PPT" => "google",
      ".PPS" => "google", "PPTX" => "google", "PPSX" => "google", ".PDF" => "google",
      ".TXT" => "google", ".JPG" => "image", "JPEG" => "image", ".BMP" => "image",
      ".GIF" => "image", ".PNG" => "image", ".DIV" => "image", ".TIF" => "image",
      "TIFF" => "image", "MPEG" => "video", ".AVI" => "video", ".MP4" => "video",
      "MIDI" => "audio", ".ACC" => "audio", ".WMA" => "audio", ".OGG" => "audio",
      ".MP3" => "audio", ".FLV" => "video", ".WMV" => "video", ".CSV" => "google");

    $cadena_nombre = substr($ga->GetUrl(),0,200);
    $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

    $type = $viewer[$extension];
    $idb    = $ga->GetId();
    $tbl_name = "gestion_anexos";
    $pid = "gestion_id";

    global $con;
    global $c;
    global $f;

    $xurl = strtolower(end(explode(".", $url)));

    $sql = "SELECT user_id, id, fecha, hora, tipologia, ip, folio, folder_id, is_publico, gestion_id, folio_final from $tbl_name where id = '$idb'";
    $co = $con->Query($sql);
    $rs = $con->FetchAssoc($co);
    $pid = $rs["gestion_id"];



#   $tf = $con->Result($con->Query('select max(folio_final) as t from gestion_anexos where gestion_id = "'.$rs['gestion_id'].'"'), 0, 't');
    $tipo = new MDependencias_tipologias;
    $tipo->CreateDependencias_Tipologias("id", $rs['tipologia']);

    $ge = new MGestion;
    $ge->CreateGestion("id", $rs['gestion_id']);

    $dep = new MDependencias;
    $dep->CreateDependencias("id", $ge->GetTipo_documento());

    $claseif = "prevdoc";
    $clasetb = "mytable";

    if ($_POST['typepaper'] == "LEGAL"){
        $left  = "12px";
        $claseif = "lprevdoc";
        $clasetb = "lmytable";
    }elseif($_POST['typepaper'] == "A4"){
        $left  = "37px";
    }else{
        $left  = "37px";
    }

    echo '
    <div class="row">
        <div class="col-md-6" style="text-align:left">
            <iframe src="https://docs.google.com/gview?url='.$url .'&embedded=true" frameborder="0" class="'.$claseif.'"></iframe>
        </div>';

    if (isset($_POST['typepaper'])) {

        if ($_POST['typepaper'] == "LEGAL") {

            $alto = 20;
            $claseif = "lprevdoc";
            $clasetb = "lmytable";

            if ($_POST['num_pages'] == "one") {

                $postop = "52px";
            }else{

                $postop = "59px";
            }

        }else{
            
            $alto = 7;
            
            if ($_POST['num_pages'] == "one") {

                $postop = "72px";
            }else{

                $postop = "71px";
            }
        }
        $wtable = "550";

?>
        <table border="1"  cellspacing="1px" id="mytable" class="<?= $clasetb ?>" style="position:fixed;top:<?= $postop ?>;left:<?= $left ?>;z-index: 99; border-color:#D9EDF7">
        <?
            for ($i=0; $i < $alto; $i++) { 
                echo "<tr>";
                for ($j=0; $j < 3 ; $j++) { 
                    $py = $i * 30;
                    $px = $j * round($wtable / 3);
                    echo '<td onClick="GetPosition(\''.$i.'\',\''.$j.'\', this)" class="selectable" height="30px" width="33.333%"></td>';
                }
                echo "</tr>";
            }
        ?>
        </table>

        <div class="col-md-4">
            <form id='firma_documento_form' action='/firmas_usuarios/EnviarFirma/<?= $ganf->GetId() ?>/' method="post" enctype="multipart/form-data"> 
                <table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla m-t-30'>
                    <tr>
                        <th colspan="2">
                            Firmar Documento <?= $ga->GetNombre() ?>
                            <input type="hidden" value="4,4" id="posfirma" name="posfirma" >
                            <input type="hidden" value="<?= $_POST['typepaper'] ?>" id="type_paper" name="type_paper" >
                        </th>
                    </tr>
                    <!-- 
                    <tr>
                        <td width="250px" colspan="2">
                            <input type="password" class="form-control input1" name="clave_firma" id="clave_firma" value="" placeholder="Escriba su Clave" style="height:35px">
                            
                            
                            
                        </td>
                    </tr>
                        <td colspan="2">
                            <input type="file" value="Cargar Firma" id="archivo" name="archivo"> 
                        </td>
                    <tr> -->
                    </tr>
                    <tr style="display:none">
                        <td colspan="2">
                            <input type="checkbox" id="showqr" name="showqr">
                            <label for="showqr">Mostrar Codigo QR en cada pagina del documento</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="radio" value="1" name="showurl" id="showurl1"><label for="showurl1">Mostrar URL del documento al final de cada hoja </label><br>
                            <input type="radio" checked value="2" name="showurl" id="showurl2"><label for="showurl2">Mostrar URL del documento en la última hoja</label><br>
                            <input type="radio" checked value="0" name="showurl" id="showurl2"><label for="showurl2">No Mostrar URL del documento</label>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                            <div class="alert alert-danger" role="alert"> 
                            <p><b>Nota:</b> Si el documento es multipagina, ubique el documento en la última hoja para poder identificar la posicion ideal de la firma.</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" class="btn btn-warning" value="Firmar Documento"></td>
                    </tr>
                </table>
            </form>
        </div>
<?
    }else{
?>
        <div class="col-md-4">
            <form id='firma_documento_form' action='#' method="post"> 
                <table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla'>                    
                    <tr>
                        <td colspan="2">
                            <h4>SELECCIONE LA CONFIGURACIÓN DEL DOCUMENTO ANTES DE HABILITAR EL PANEL DE FIRMA</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h4><b>Seleccione el tipo de Papel</b></h4>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" >
                            <label for="typepapercarta" class="waves-effect" style="line-height: 45px">
                            <input type="radio" name="typepaper" id="typepapercarta" checked value="LETTER" class="form-control pull-left" style="width: 30px">PAPEL TIPO CARTA
                            <img src="<?= HOMEDIR.DS.'app/views/assets/images/HOJA_CARTA.png' ?>" width="100%">
                            </label>
                        </td>
                        <td width="50%" valign="top" >
                            <label for="typepaperLEGAL" class="waves-effect" style="line-height: 45px">
                            <input type="radio" name="typepaper" id="typepaperLEGAL" value="LEGAL" class="form-control pull-left" style="width: 30px">PAPEL TIPO OFICIO
                            <img src="<?= HOMEDIR.DS.'app/views/assets/images/HOJA_OFICIO.png' ?>" width="100%">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h4><b>El Documento contiene</b></h4>
                        </td>
                    </tr>

                    <tr>
                        <td valign="top" >
                            <label for="num_pages_a" class="waves-effect" style="line-height: 45px">
                            <input type="radio" name="num_pages" id="num_pages_a" checked value="one" class="form-control pull-left" style="width: 30px">UNA SOLA PAGINA
                    
                            </label>
                        </td>
                        <td width="50%" valign="top" >
                            <label for="num_pages_b" class="waves-effect" style="line-height: 45px">
                            <input type="radio" name="num_pages" id="num_pages_b" value="multi" class="form-control pull-left" style="width: 30px">MÁS DE UNA PAGINA
                        
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" class="btn btn-info" value="Ir a Firmar el Documento"></td>
                    </tr>
                </table>
            </form>
        </div>
<?
    }
?>        

                </div>
            </div>
        </div>
    </div> <!-- END ROW -->
</div>
<script type="text/javascript">

    

    function GetPosition(y, x, t){

        $("#mytable tr td").removeClass("active");

        $(t).addClass("active");

        $("#posfirma").val(x+","+y);



    }



</script>

<style>

    body{
        overflow: hidden !important;
    }
    audio{

        width: 500px;

        margin-top: 250px;

    }

    video{

        margin-top: 50px;

    }



    #blfile{

        width:65%;

        float: left;



    }

    #blmeta-data{

        width: 35%;

        float: left;

    }



    .selectable{

        background-color: rgba(217,237,247, 0.2);

        cursor:pointer;

        font-size: 7px;

    }

    .selectable:hover, .selectable.active{

        background-color: rgba(217,237,247, 1);

    }

/* PANTALLA GIGANTE */
@media screen and (min-width: 991px) and (max-width: 1024px) {
    .prevdoc{
        width: 497px !important; 
        height: 700px !important;
    }
    .mytable{
        width: 473px !important; 
        height: 570px !important;
    }
    .lprevdoc{
        width: 430px !important; 
        height: 700px !important;
    }
    .lmytable{
        width: 407px !important; 
        height: 670px !important;
    }
}
@media screen and (min-width: 1025px) and (max-width: 1366px) {
   .prevdoc{
        width: 540px !important; 
        height: 680px !important;
    }
    .mytable{
        width:  516px !important; 
    /*  height: 660px !important; */
        height: 580px !important;
        
    }
    .lprevdoc{
        width: 428px !important; 
        height: 690px !important;
    }
    .lmytable{
        width: 402px !important; 
        height: 667px !important;
        
    }
}
@media screen and (min-width: 1367px) and (max-width: 1680px) {
    .prevdoc{
        width: 547px !important; 
        height: 700px !important;
    }
    .mytable{
        width: 523px !important; 
        height: 600px !important;
        
    }
    .lprevdoc{
        width: 547px !important; 
        height: 894px !important;
    }
    .lmytable{
        width: 523px !important; 
        height: 863px !important;
        
    }
}
@media screen and (min-width: 1681px) and (max-width: 1920px) {
    .prevdoc{
        width: 730px !important; 
        height: 940px !important;
    }
    .mytable{
        width: 707px !important; 
        height: 840px !important;
        
    }
    .lprevdoc{
        width: 576px !important; 
        height: 940px !important;
    }
    .lmytable{
        width: 552px !important; 
        height: 914px !important;
        
    }
}
</style>    
