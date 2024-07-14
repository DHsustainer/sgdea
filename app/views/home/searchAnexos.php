<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/agenda.css'/>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<div class="icon white_contacto search_icon"></div>
			<div class="text-folder">Resultados de busqueda: "<?= $attr; ?>"</div>
		</div>
		<div class="header-agenda">
			
		</div>
	</div>
</div>


<div id="folders-content">
	<div id="folders-list-content">
		<div class="contact-list_main_2">

<?

	global $c;	

	$viewer =       array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,
                          ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,
                          ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,
                          ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,
                          ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,
                          "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,
                          "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,
                          ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video"							, ".csv" => "google"                        ,

                          ".DOC" => "google"                        , "DOCX" => "google"                        , ".ZIP" => "google"                        , ".RAR" => "google"                        ,
                          ".TAR" => "google"                        , ".XLS" => "google"                        , "XLSX" => "google"                        , ".PPT" => "google"                        ,
                          ".PPS" => "google"                        , "PPTX" => "google"                        , "PPSX" => "google"                        , ".PDF" => "google"                        ,
                          ".TXT" => "google"                        , ".JPG" => "image"                         , "JPEG" => "image"                         , ".BMP" => "image"                         ,
                          ".GIF" => "image"                         , ".PNG" => "image"                         , ".DIV" => "image"                         , ".TIF" => "image"                         ,
                          "TIFF" => "image"                         , "MPEG" => "video"                         , ".AVI" => "video"                         , ".MP4" => "video"                         ,
                          "MIDI" => "audio"                         , ".ACC" => "audio"                         , ".WMA" => "audio"                         , ".OGG" => "audio"                         ,
                          ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google"						,
                          ".xml" => "google");

	$id = $attr;
	$us = $_SESSION["usuario"];


		if($id == ""){
			echo "<div class='da-message error'>Resultados: Debe ingresar algo para buscar</div>";
		}else{
			// Anexos
				$s2 = "select gestion_id from gestion_anexos where nombre like '%".$id."%' group by gestion_id";
				$q2 = $con->Query($s2);
			
				$type_s = "Anexos";
				$i2 = 0;
				echo "	<div class='search_result'>";	
				echo "		<div class='header_result'>
								<div class='bold'>".$type_s."</div>";
				if($con->NumRows($q2) <= 0){
					echo "			<div class='light'>$i2 $type_s encontrados que contengan \"$id\" </div>
							</div>
							<div class='clear'></div>";
				}else{
					$i2 = 0;
					
					echo "<div class='light'>$i2 $type_s encontrados que contienen \"$id\" </div></div><div class='clear'></div>";
					while($row2 = $con->FetchAssoc($q2)){
						$i2++;
						$s3 = $con->Query("select * from gestion_anexos where nombre like '%".$id."%' and gestion_id = '".$row2['gestion_id']."'");
						$path = "";
						$path = "
								<div class='col-md-2'><h3>Documentos Encontrados</h3></div>
								<div class='col-md-10'>
									<div class='list-group'>";
							while ($rx = $con->FetchAssoc($s3)) {
								
								$file = $rx['url'];
								$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$rx['gestion_id'].trim("/anexos/ ").$file."";
				                $cadena_nombre = substr($file,0,200);
	                			$extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

								$path .= "<a href='#' class='list-group-item' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$rx["nombre"]."\", \"4\", \"".$rx["id"]."\")' >".$rx['nombre']."</a>";


							}

						$path .= "	</div>
								</div>";
						$c->GetVistaExpedienteDefault($row2["gestion_id"], $path);
						echo "<div class='clear'></div>";
					}
				}
				echo "		</div>
						<div class='clear'></div>";
		}

		$tte = $i1 + $i2 + $i3 + $i4;

?>

		</div>
	</div>
</div>

