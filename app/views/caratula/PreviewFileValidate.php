<?php 

$viewer = array(".doc" => "google" , "docx" => "google" , ".zip" => "google" , ".rar" => "google" , ".tar" => "google" , 
				".xls" => "google" , "xlsx" => "google" , ".ppt" => "google" , ".pps" => "google" , "pptx" => "google" , 
				"ppsx" => "google" , ".pdf" => "google" , ".txt" => "google" , ".jpg" => "image"  , "jpeg" => "image"  , 
				".bmp" => "image"  , ".gif" => "image"  , ".png" => "image"  , ".dib" => "image"  , ".tif" => "image"  ,
				"tiff" => "image"  , "mpeg" => "video"  , ".avi" => "video"  , ".mp4" => "video"  , "midi" => "audio"  , 
				".acc" => "audio"  , ".wma" => "audio"  , ".ogg" => "audio"  , ".mp3" => "audio"  , ".flv" => "video"  , 
				".wmv" => "video"  , ".csv" => "google" , ".DOC" => "google" , "DOCX" => "google" , ".ZIP" => "google" , 
				".RAR" => "google" , ".TAR" => "google" , ".XLS" => "google" , "XLSX" => "google" , ".PPT" => "google" ,
       			".PPS" => "google" , "PPTX" => "google" , "PPSX" => "google" , ".PDF" => "google" , ".TXT" => "google" , 
       			".JPG" => "image"  , "JPEG" => "image"  , ".BMP" => "image"  , ".GIF" => "image"  , ".PNG" => "image"  , 
       			".DIV" => "image"  , ".TIF" => "image"  , "TIFF" => "image"  , "MPEG" => "video"  , ".AVI" => "video"  , 
       			".MP4" => "video"  , "MIDI" => "audio"  , ".ACC" => "audio"  , ".WMA" => "audio"  , ".OGG" => "audio"  ,
       			".MP3" => "audio"  , ".FLV" => "video"  , ".WMV" => "video"	 , ".CSV" => "google" , ".xml" => "google");

	$sql = "SELECT user_id, id, fecha, hora, tipologia, ip, folio, folder_id, is_publico, gestion_id, folio_final, base_file, url, nombre, observacion, checked from gestion_anexos where id = '$idb'";

	$co = $con->Query($sql);
	$rs = $con->FetchAssoc($co);
	$pid = $ide;

	$ge = new MGestion;
	$ge->CreateGestion("id", $ide);


    $url = HOMEDIR.DS."app/archivos_uploads/gestion/".$ge->GetId().trim("/anexos/ ").$rs['url']."";

    $extension = substr($rs['url'], strlen($rs['url'])-4, strlen($rs['url']));  
    $type = $viewer[$extension] ;

	$c->InsertGestion_anexos_consultas($idb, $ge->GetId(), date("Y-m-d h:i:s"), $_SESSION['usuario'], $_SERVER['REMOTE_ADDR']);

	$al = "";
	if ($rs['checked'] == "-1") {
		$al = "<div class='alert alert-info' style='text-align: center; position: absolute; width: 100%; background: rgba(188,232,241,0.8); color: #FFF;'>El Documento fue Rechazado por ".$rs['observacion']."</div>";
	}
	if ($rs['checked'] == "1") {
		$al = "<div class='alert alert-info' style='text-align: center; position: absolute; width: 100%; background: rgba(188,232,241,0.8); color: #FFF;'>El Documento fue Aprobado por el Usuario por ".$rs['user_id']."</div>";
	}
	

echo "	<div class='row' style='margin:0px'>
			<div class='col-md-1'>";
			
			$q = $con->Query("Select * from gestion_anexos where gestion_id = '".$ge->GetId()."' and checked = '-1'");
			$ar = array();
			while ($row = $con->FetchArray($q)) {
				array_push($ar, $row['id']);
				# code...
			}
			for ($i=0; $i < count($ar) ; $i++) { 
				if ($ar[$i] == $idb) {
					$previd = $ar[$i-1];
					$nextid = $ar[$i+1];	
				}
			}
			$prevdis = "";
			$nextdis = "";
			$prevlink = "";
			$nextlink = "";
			if ($previd == "") {
				$prevdis = "disabled";
			}else{
				$qol = $con->Query("Select * from gestion_anexos where id = '".$previd."' ");
				while ($col = $con->FetchAssoc($qol)) {
					$tit = $col["nombre"];
					$idb = $col["id"];
					break;
				}
				$prevlink = "onClick='osxDocumentos(\"".$ge->GetId()."\", \"".$tit."\", \"".$idb."\")';";
				
			}
			if ($nextid == "") {
				$nextdis = "disabled";
			}else{
				$qol = $con->Query("Select * from gestion_anexos where id = '".$nextid."' ");
				while ($col = $con->FetchAssoc($qol)) {
					$tit = $col["nombre"];
					$idb = $col["id"];
					break;
				}
				$nextlink = "onClick='osxDocumentos(\"".$ge->GetId()."\", \"".$tit."\", \"".$idb."\")';";
			}

echo "		<div class='navdocs'>
					<div class='fa fa-angle-left nav-btn $prevdis' $prevlink></div>
				</div>
			</div>
			<div class='col-md-10 scrollable paneldocumento' style='overflow: hidden;overflow-y: auto;'>";
			echo $al;
			if($type == "google"){

				echo verdoc($url);	

			}elseif($type == "image"){

				$xurl = strtolower(end(explode(".", $url)));

				if ($xurl == "tif" || $xurl == "tiff" ) {

					echo verdoc($url);	

				}else{

					echo "<img src='".$url."' width='99%' >";
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

				echo '<br><div class="alert alert-info"> Este archivo no puede ser visualizado puede descargarlo haciendo clic <a href="'.$url.'" target="_blank">aquí</a></div>';

			}else{
				echo "<div class='alert alert-info' style='text-align:center; margin-top:200px'>El Documento '".$rs['nombre']."' No fue cargado</div>";				
			}

echo "		</div>";
echo "		<div class='col-md-1'>
				<div class='navdocs'>
					<div class='fa fa-angle-right nav-btn $nextdis' $nextlink></div>
				</div>
			</div>";
echo "		
		</div>";

	function verdoc($u) {

		return '<iframe src="https://docs.google.com/gview?url='.$u .'&embedded=true" style="width:99%;" frameborder="0" class="paneldocumento"></iframe>';
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
	.par{
		background-color: #f0f0f0;
		border-bottom: 1px solid #FFF;
		border-top: 1px solid #FFF;

	}
	.impar{
		background-color: #FFF;
		border-top: 1px solid #F0F0F0;
		border-bottom: 1px solid #F0F0F0;
	}
	.par, .impar{
		height: 25px;
		line-height: 25px;
		font-size: 12px;
		padding: 5px;
		text-align: left;
	}
	.th_act{
		background-color: #1579C4 !important;
		color: #fff !important;
		padding: 5px;
		padding-left: 25px;
		cursor: pointer;
		text-align: center;
	}
	.th_act2{
		background-color: #1579C4 !important;
		color: #fff !important;
		padding: 5px;
		cursor: pointer;
		font-size: 14px;
		text-align: center;
		height: 30px;
	}
	.tblresult2{
		height: 50px;
		line-height: 50px;
		text-align: center;
		font-size: 16px;
		font-weight: bold;
	}
	.tblresultx{
		cursor: pointer;
	}
	.tblresult4{
		-moz-box-shadow:   inset 0 0 10px #000000;
	   -webkit-box-shadow: inset 0 0 10px #000000;
	   box-shadow:         inset 0 0 10px #000000;
	   padding: 30px; 
	   background-color:#222;
	   top: -17px;
	   position: relative;
	   background: #DDDDDD;
	}
	.cuadro_white{
	    width: 29px;
	    height: 17px;
	    background: url(../images/white_spot_upsdon.png) no-repeat;
	    margin: 0 auto;
	    z-index: 999;
	    position: relative;
	}
	.th_act_inner{
		background-color: #484747 !important;
		font-size: 13px;
		color: #FFF;
		padding: 5px;
		padding-left: 25px;
		cursor: pointer;
		text-align: center;
	}

	.th_act_inner.last{
		-moz-border-radius-topright:  10px;  
		-webkit-border-top-right-radius: 10px;
	    border-top-right-radius: 10px;
	}
	.th_act_inner.first{
		-moz-border-radius-topleft:  10px;  
		-webkit-border-top-left-radius: 10px;
	    border-top-left-radius: 10px;
	}
	.cuadro_white.gray{
		background-position: 0 -23px;
	}
	td{	
		vertical-align: top;
		padding: 5px;
	}
	table{
		padding: 0px 10px 10px 10px;
		background-color: #fff;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	.infodocumento{
		font-size: 13px;
		color:#666 !important;
		line-height: 20px;
		padding: 10px;
	}
	.navdocs{
		text-align: center;
	    vertical-align: middle !important;
	}
	.nav-btn{
		font-size: 100px;
		width: 100%;
	    background-color: #F5F5F5;
	    color:#666;
	}
	.nav-btn:hover{
		background-color: #DeDede;
		cursor: pointer;
	}
	.nav-btn.disabled{
		background-color: #EFEFEF !important;
		cursor:not-allowed;
		color: #f5f5f5;
	}
</style>
<script>
 	$("#modal-data-append").html("");
	//showqanexos2('/gestion/GetAnexos2/<?= $ge->GetId() ?>/0/1/')
 	$("#menu_files").remove();
 	$("#verresumendocumento").remove();

	$("#modal-data-append").prepend('<a href="/app/plugins/descargar.php?f=<?= $url ?>&tf=<?= $_POST['title'] ?>&format=<?= $xurl ?>" target="_blank"><div class="boton fa fa-download" title="Descargar Documento"></div></a>')

	$("#modal-data-append").prepend("<div class='boton fa fa-times-circle-o' style='color: red' data-toggle='tooltip' data-placement='bottom' title='Rechazar Documento' onClick='CheckDocumento(\"<?= $rs['id'] ?>\", \"-1\")'></div>"+
		"<div class='boton fa fa-check-circle-o' style='color: orange' data-toggle='tooltip' data-placement='bottom' title='Aceptar Documento' onClick='CheckDocumento(\"<?= $rs['id'] ?>\", \"1\")'></div>");

	$(document).ready(function () {
		$(function () {
	    	$('[data-toggle="tooltip"]').tooltip()
	  	})
	})
</script>
<style>
/* PANTALLA GIGANTE */
@media screen and (min-width: 991px) and (max-width: 1024px) {
    .paneldocumento{
        height: 630px !important;

    }
    .navdocs{
    	height: 630px !important;
    }
    .nav-btn{
    	line-height: 630px;
    }
}
@media screen and (min-width: 1025px) and (max-width: 1366px) {
    .paneldocumento{
        height: 630px !important;
    }
    .navdocs{
    	height: 630px !important;
    }
    .nav-btn{
    	line-height: 630px;
    }
}
@media screen and (min-width: 1367px) and (max-width: 1680px) {
    .paneldocumento{
        height: 850px !important;
    }
    .navdocs{
    	height: 850px !important;
    }
    .nav-btn{
    	line-height: 850px;
    }
}
@media screen and (min-width: 1681px) and (max-width: 1920px) {
    .paneldocumento{
        height: 860px !important;
    }
    .navdocs{
    	height: 860px !important;
    }
    .nav-btn{
    	line-height: 860px;
    }
}
</style>  


