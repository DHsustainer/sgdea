<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reparto del Expediente</title>
    <!-- <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/comunes.css'/>
    <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/formularios.css'/> -->
    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/del.mini.css'/>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<link rel='stylesheet' href='https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
    <script language='javascript' type='text/javascript' src='https://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>

    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jscripts.js'></script>
	<link href="<?=ASSETS?>/images/favicon.png" rel='icon' type='image/x-icon'/>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!–[if lt IE 8]>
    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]–>

</head>
<body>
	<div id="header">
		<?
	$me = new MUsuarios;
	$me->CreateUsuarios("user_id", $_SESSION["usuario"]);

	global $c;

 	$nombre_usuario = $me->GetP_nombre()." ".$me->GetP_apellido();

 	if ($_SESSION["suscriptor_id"] != "") {
 		
 		$sus = new MSuscriptores_contactos;
 		$sus->CreateSuscriptores_contactos("id", $_SESSION['suscriptor_id']);

 		$nombre_usuario = $sus->GetNombre();

 	}

	if ($_SESSION['folder'] == "") {
        $u = new MUsuarios;
        $u->CreateUsuarios("user_id", $_SESSION['usuario']);

        if ($u->GetId_empresa() != "0") {
	        $sadmin = new MSuper_admin;
	        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());

	        if ($sadmin->GetFoto_perfil() == "") {
	          	echo '<div id="del-logo"></div>';
	        }else{
	        	#echo '<div id="del-logo"></div>';
	        	echo '<div id="del-logo" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().') no-repeat; background-size: 170px 70px; margin-top:0px; height:60px"></div>';
	        }
        	
        }else{
        	echo '<div id="del-logo"></div>';
        }
    }else{
        $u = new MUsuarios;
        $u->CreateUsuarios("user_id", $_SESSION['usuario']);

        $sadmin = new MSuper_admin;
        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());

        if ($sadmin->GetFoto_perfil() == "") {
          	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'"></div>';
        }else{
        	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().')  no-repeat;  background-size: 170px 70px; margin-top:0px; height:60px"></div>';
        }
    }

    $archivoloc = array("*" => "Todo el archivo", "1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico");


    $pathsearch = " and estado_archivo = '$p1' ";
    if ($p1 == "*") {
    	$pathsearch = "";
    }
?>
		<div id="del-buscar"></div>
		<div id="del-right">
			<div id="del-user">
				<div id="del-user-info">
					<?
						#echo $nombre_usuario
					    if ($_SESSION["usuario"] != ""){

							$cit = new MCity;
							$cit->CreateCity("code", $_SESSION['ciudad']);

							$area = new MAreas;
							$area->CreateAreas("id", $_SESSION['area_principal']);

							$of = new MSeccional;
							$of->CreateSeccional("id", $_SESSION['seccional']);

							#echo $cit->GetName().", <br><b>".$of->GetNombre()." (".$area->GetNombre().")</b>";
							echo $cit->GetName().", <br><b>".$of->GetNombre()."</b>";

						}
					?>
				</div>
			</div>
		</div>
	</div>
	<div id='content' class="app_container">
		<div id="blfile">

<?php 
	$url = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";

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
                          ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");
	
    $cadena_nombre = substr($ga->GetUrl(),0,200);
    $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

	$type = $viewer[$extension];

	$idb	= $ga->GetId();

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

#	$tf = $con->Result($con->Query('select max(folio_final) as t from gestion_anexos where gestion_id = "'.$rs['gestion_id'].'"'), 0, 't');

	$tipo = new MDependencias_tipologias;
	$tipo->CreateDependencias_Tipologias("id", $rs['tipologia']);

	$ge = new MGestion;
	$ge->CreateGestion("id", $rs['gestion_id']);

	$dep = new MDependencias;
	$dep->CreateDependencias("id", $ge->GetTipo_documento());

	
	if($type == "google"){

		echo verdoc($url);	

	}elseif($type == "image"){
		$xurl = strtolower(end(explode(".", $url)));
		if ($xurl == "tif" || $xurl == "tiff" ) {
			echo '<br><br><div class="alert alert-info"> Este archivo no puede ser visualizado puede descargarlo haciendo clic <a href="'.$url.'" target="_blank">aquí</a></div>';
		}else{
			echo "<img src='".$url."' width='100%' >";
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
		#echo '	<video width="800" height="500" controls><source src="'.$url.'">Your browser does not support the video tag.</video>';	
	}


	function verdoc($u) {
		return '<iframe src="https://docs.google.com/gview?url='.$u .'&embedded=true" style="width:99%; height:580px;" frameborder="0"></iframe>';

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

		</div>
		<div id="blmeta-data">
			
			<form id='FormUpdategestion_tipologias_big_data' action='/gestion_tipologias_big_data/actualizar/' method='POST'> 
					<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
					<input type='hidden' class='form-control input1' placeholder='username' name='username' id='username' maxlength='' value='<? echo $object -> Getusername(); ?>' />
					
					<input type='hidden' class='form-control input1' placeholder='proceso_id' name='proceso_id' id='proceso_id' maxlength='' value='<? echo $object -> Getproceso_id(); ?>' />
					
					<input type='hidden' class='form-control input1' placeholder='tipologia_referencia_id' name='tipologia_referencia_id' id='tipologia_referencia_id' maxlength='' value='<? echo $object -> Gettipologia_referencia_id(); ?>' />
				<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla'>
					<tr>
						<th class="th_act2" colspan="2">
							Metadatos del Documento <?= $ga->GetNombre() ?>
						</th>
					</tr>
					<tr>
						<th class="th_act_inner">
							Tipo de Documento: 
						</th>
						<th class="th_act_inner">
							<?= $serie = $c->GetDataFromTable("dependencias_tipologias", "id", $ga->GetTipologia(), "tipologia", $separador = " "); ?>
						</th>

					</tr>
			<?
				$ref = new MDependencias_tipologias_referencias;
				$ref->CreateDependencias_tipologias_referencias('dependencia_id', $object->GetTipologia_referencia_id());

				$path = "";

				if($_SESSION['actualizar_metadatos'] == 1){

				if ($ref->GetCol_1_name() != "") {
					/*
					*/
					$path .= '	<tr class="tblresult">
									<td style="width:110px" align="left">
										<b>'.$ref->GetCol_1_name().':</b>
									</td>
									<td align="left">';


					if($object->GetCol_1() == "Documento Fisico"){ 
					 	$selecta = "selected = 'selected'";
					}elseif($object->GetCol_1() == "Documento Electronico"){ 
						$selectb = "selected = 'selected'";
					}elseif($object->GetCol_1() == "Documento en Audio"){ 
						$selectc = "selected = 'selected'";
					}elseif($object->GetCol_1() == "Medio Magnetico"){ 
						$selectd = "selected = 'selected'";
					}elseif($object->GetCol_1() == "Microfilmado"){
					 	$selecte = "selected = 'selected'"; 
					}elseif($object->GetCol_1() == "Documento Digitalizado"){
					 	$selecte = "selected = 'selected'"; 
					}elseif($object->GetCol_1() == "Documento Hibrido"){
					 	$selectf = "selected = 'selected'"; 
					}	

					$path .= '			<select name="col_1" class="form-control input1">';
					$path .= '				<option value="">Seleccione una Opción</option>';
					$path .= '				<option '.$selectb.' value="Documento Digitalizado">Documento Digitalizado</option>';
					$path .= '				<option '.$selectb.' value="Documento Electronico">Documento Electronico</option>';
					$path .= '				<option '.$selectc.' value="Documento en Audio">Documento en Audio</option>';
					$path .= '				<option '.$selecta.' value="Documento Fisico">Documento Fisico</option>';
					$path .= '				<option '.$selectd.' value="Medio Magnetico">Medio Magnetico</option>';
					$path .= '				<option '.$selecte.' value="Microfilmado">Microfilmado</option>';
					$path .= '				<option '.$selectf.' value="Documento Hibrido">Documento Hibrido</option>';
					$path .= '			</select>
									</td>
								</tr>';
				}
				
				$path .= ($ref->GetCol_2_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_2_name().':</b></td><td align="left"><input type="'.$ref->GetCol_2_type().'" name="col_2" class="form-control input1" value="'.$object->Getcol_2().'"></td></tr>' : '';
				$path .= ($ref->GetCol_3_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_3_name().':</b></td><td align="left"><input type="'.$ref->GetCol_3_type().'" name="col_3" class="form-control input1" value="'.$object->Getcol_3().'"></td></tr>' : '';
				$path .= ($ref->GetCol_4_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_4_name().':</b></td><td align="left"><input type="'.$ref->GetCol_4_type().'" name="col_4" class="form-control input1" value="'.$object->Getcol_4().'"></td></tr>' : '';
				$path .= ($ref->GetCol_5_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_5_name().':</b></td><td align="left"><input type="'.$ref->GetCol_5_type().'" name="col_5" class="form-control input1" value="'.$object->Getcol_5().'"></td></tr>' : '';
				$path .= ($ref->GetCol_6_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_6_name().':</b></td><td align="left"><input type="'.$ref->GetCol_6_type().'" name="col_6" class="form-control input1" value="'.$object->Getcol_6().'"></td></tr>' : '';
				$path .= ($ref->GetCol_7_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_7_name().':</b></td><td align="left"><input type="'.$ref->GetCol_7_type().'" name="col_7" class="form-control input1" value="'.$object->Getcol_7().'"></td></tr>' : '';
				$path .= ($ref->GetCol_8_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_8_name().':</b></td><td align="left"><input type="'.$ref->GetCol_8_type().'" name="col_8" class="form-control input1" value="'.$object->Getcol_8().'"></td></tr>' : '';
				$path .= ($ref->GetCol_9_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_9_name().':</b></td><td align="left"><input type="'.$ref->GetCol_9_type().'" name="col_9" class="form-control input1" value="'.$object->Getcol_9().'"></td></tr>' : '';
				$path .= ($ref->GetCol_10_name() != "") ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_10_name().':</b></td><td align="left"><input type="'.$ref->GetCol_10_type().'" name="col_10" class="form-control input1" value="'.$object->Getcol_10().'"></td></tr>' : '';
				$path .= ($ref->GetCol_11_name() != "") ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_11_name().':</b></td><td align="left"><input type="'.$ref->GetCol_11_type().'" name="col_11" class="form-control input1" value="'.$object->Getcol_11().'"></td></tr>' : '';
				$path .= ($ref->GetCol_12_name() != "") ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_12_name().':</b></td><td align="left"><input type="'.$ref->GetCol_12_type().'" name="col_12" class="form-control input1" value="'.$object->Getcol_12().'"></td></tr>' : '';
				$path .= ($ref->GetCol_13_name() != "") ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_13_name().':</b></td><td align="left"><input type="'.$ref->GetCol_13_type().'" name="col_13" class="form-control input1" value="'.$object->Getcol_13().'"></td></tr>' : '';
				$path .= ($ref->GetCol_14_name() != "") ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_14_name().':</b></td><td align="left"><input type="'.$ref->GetCol_14_type().'" name="col_14" class="form-control input1" value="'.$object->Getcol_14().'"></td></tr>' : '';
				$path .= ($ref->GetCol_15_name() != "") ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_15_name().':</b></td><td align="left"><input type="'.$ref->GetCol_15_type().'" name="col_15" class="form-control input1" value="'.$object->Getcol_15().'"></td></tr>' : '';

				echo $path;


			?>
				<tr>
					<td colspan="2">
						<input type='submit' value='Actualizar'/>
					</td>
				</tr>
				<?php }else{

					if ($ref->GetCol_1_name() != "") {
						/*
						*/
						$path .= '	<tr class="tblresult">
										<td style="width:110px" align="left">
											<b>'.$ref->GetCol_1_name().':</b>
										</td>
										<td align="left">'.$object->GetCol_1().'</td>
									</tr>';
					}
					
					$path .= ($ref->GetCol_2_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_2_name().':</b></td><td align="left">'.$object->Getcol_2().'</td></tr>' : '';
					$path .= ($ref->GetCol_3_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_3_name().':</b></td><td align="left">'.$object->Getcol_3().'</td></tr>' : '';
					$path .= ($ref->GetCol_4_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_4_name().':</b></td><td align="left">'.$object->Getcol_4().'</td></tr>' : '';
					$path .= ($ref->GetCol_5_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_5_name().':</b></td><td align="left">'.$object->Getcol_5().'</td></tr>' : '';
					$path .= ($ref->GetCol_6_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_6_name().':</b></td><td align="left">'.$object->Getcol_6().'</td></tr>' : '';
					$path .= ($ref->GetCol_7_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_7_name().':</b></td><td align="left">'.$object->Getcol_7().'</td></tr>' : '';
					$path .= ($ref->GetCol_8_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_8_name().':</b></td><td align="left">'.$object->Getcol_8().'</td></tr>' : '';
					$path .= ($ref->GetCol_9_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_9_name().':</b></td><td align="left">'.$object->Getcol_9().'</td></tr>' : '';
					$path .= ($ref->GetCol_10_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_10_name().':</b></td><td align="left">'.$object->Getcol_10().'</td></tr>' : '';
					$path .= ($ref->GetCol_11_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_11_name().':</b></td><td align="left">'.$object->Getcol_11().'</td></tr>' : '';
					$path .= ($ref->GetCol_12_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_12_name().':</b></td><td align="left">'.$object->Getcol_12().'</td></tr>' : '';
					$path .= ($ref->GetCol_13_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_13_name().':</b></td><td align="left">'.$object->Getcol_13().'</td></tr>' : '';
					$path .= ($ref->GetCol_14_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_14_name().':</b></td><td align="left">'.$object->Getcol_14().'</td></tr>' : '';
					$path .= ($ref->GetCol_15_name() != "")  ? '<tr class="tblresult"><td style="width:110px" align="left"><b>'.$ref->GetCol_15_name().':</b></td><td align="left">'.$object->Getcol_15().'</td></tr>' : '';


					echo $path;

				} ?>
			</table>
			</form>
		</div>

</div>


<script language="javascript" type="text/javascript" src="https://siamm.co/a/scripts/DataTables-1.9.4/jquery.dataTables.js"></script>

<style>
	#blfile{
		width:65%;
		float: left;

	}
	#blmeta-data{
		width: 35%;
		float: left;
	}
</style>	
<script>
	

	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');


</script>
</body>
</html>
