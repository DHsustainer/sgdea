<?php 

	$stype	= $_POST['stype'];
	$idb	= $_POST['idb'];

	global $con;

	$sql = "SELECT user_id, id, fecha, hora, ip, folio, folder_id from anexos_carpeta where id = '$idb'";
	$co = $con->Query($sql);
	$rs = $con->FetchAssoc($co);
	$pid = $rs['folder_id'];

	$tf = $con->Result($con->Query('select count(*) as t from anexos_carpeta where folder_id = "'.$pid.'"'), 0, 't');

	echo '	<div>Documento Generado el: '.$rs['fecha'].' a las '.$rs['hora'].'</div><div class="clear"></div>';
	echo '	<div>Folio #'.$rs['folio'].' de '.$tf.'</div><div class="clear"></div>';
	#print_r($rs);

	#$string = hash("sha256", $id.$_SESSION["usuario"].date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]); 
	if($type == "google"){

		echo verdoc($url);	

	}elseif($type == "image"){
		$xurl = strtolower(end(explode(".", $url)));
		if ($xurl == "tif" || $xurl == "tiff" ) {
			echo '<br><br><div class="alert alert-info"> Este archivo no puede ser visualizado puede descargarlo haciendo clic <a href="'.$url.'" target="_blank">aquí</a></div>';
		}else{
			echo '<div class="rotation"></div>';
			echo "<br><br><div><img src='".$url."' width='100%' ></div>";

			echo '	<style>
				.rotation{
					background: url('.HOMEDIR.DS.'/app/views/assets/images/anulado.png);
					z-index:9999;
					position:absolute;
					height:600px;
					width:90%;
					opacity: 0.4;
				}
			</style>';
		}	

	}elseif($type == "audio"){

		echo '	<audio controls autoplay>
				  	<source src="'.$url.'">
				  	    <object type="application/x-shockwave-flash" data="player.swf?soundFile='.$url.'">
					        <param name="movie" value="player.swf?soundFile='.$url.'" />
					        <a href="'.$url.'">Descarga el archivo de audio</a>
					    </object>
					Tu navegador no soporta la reproduccion de audio
				</audio>';

	}elseif($type == "video"){
		echo '<br><br><div class="alert alert-info"> Este archivo no puede ser visualizado puede descargarlo haciendo clic <a href="'.$url.'" target="_blank">aquí</a></div>';
		#echo '	<video width="800" height="500" controls><source src="'.$url.'">Your browser does not support the video tag.</video>';	
	}




	function verdoc($u) {
		return '<iframe src="https://docs.google.com/gview?url='.$u .'&embedded=true" style="width:99%; height:99%;" frameborder="0"></iframe>';

	}

?>

<style>
		
		audio{
			width: 500px;
			margin-top: 250px;
		}
		video{
			margin-top: 50px;
		}

		
</style>