<?

	$id = $attr;
	$us = $_SESSION["usuario"];


	$car->CreateCaratula("id", $c->sql_quote($_REQUEST['id']));
	
?>
<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/agenda.css'/>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<div class="icon white_contacto search_icon"></div>
			<div class="text-folder">
				Resultados de busqueda: "<?= $attr; ?>" en el proceso <?= $car->GetTit_demanda() ?>
				<?= "<a  href='".HOMEDIR.DS."caratula/opcion/".$car->GetId()."/anexos/#".$imid."'>Regresar a Anexos</a>" ?>
			</div>
		</div>
		<div class="header-agenda">
			
		</div>
	</div>
</div>
<style>
	
	.text-folder a{
		color:#FFF;
		font-weight: bold;
		margin-left: 40px;
	}

</style>

<div id="folders-content">
	<div id="folders-list-content">
		<div class="contact-list_main_2">

<?


		if($id == ""){
			echo "<div class='da-message error'>Resultados: Debe ingresar algo para buscar</div>";
		}else{
			// Anexos

        	$viewer =   array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,
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


			$s1 = "select * from anexos where user_id = '".$us."' and nom_palabra like '%".$id."%' and proceso_id = '".$car->GetProceso_id()."'";
			$q1 = $con->Query($s1);
			
			$pathn  = "";
			$pathm  = "";				
			$type_s = "Anexos";
			$i1 = 0;
			$pathn .= "<div class='search_result'>";	
			$pathn .= "<div class='header_result'><div class='bold'>".$type_s."</div>";
			if($con->NumRows($q1) <= 0){
				$pathn .= "<div class='light'>$i1 $type_s encontrados que contengan \"$id\" </div></div><div class='clear'></div>";
			}else{
				$i1 = 0;
				$pathm = "";
				    while ($col=$con->FetchAssoc($q1)) {
				    	$i1++;
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

				        echo "  <div class='anexos-div' id='$col[id]' style='float:left'>
				                    <div style='padding-top:0px; margin-top:-15px;' class='img-icon $type' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nom_palabra"]."\", \"1\", \"".$col["id"]."\")'></div>
				                    <div class='clear'></div>
				                    <div class='nom_anexo' title='$col[nom_palabra]' style='font-size:12px'>
				                        $col[nom_palabra]
				                    </div>
				                </div>";
				    }
				$pathm .= "<div class='clear'></div>";
				$pathn .= "<div class='light'>&nbsp;$i1 $type_s encontrados que contienen \"$id\" </div></div><div class='clear'></div>";
			}
			echo $pathn.$pathm."</div><div class='clear'></div>";
			
		}
?>

		</div>
	</div>
</div>

