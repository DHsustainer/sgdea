<?php 

	$idb = $id;
	$tbl_name = "gestion_anexos";
	$pid = "gestion_id";

	$ga = new MGestion_anexos;
	$ga->CreateGestion_anexos("id", $idb);

	$xurl = strtolower(end(explode(".", $ga->GetUrl())));



	$sql = "SELECT user_id, id, fecha, hora, tipologia, ip, folio, folder_id, is_publico, gestion_id, folio_final, base_file, url from $tbl_name where id = '$idb'";


	$co = $con->Query($sql);
	$rs = $con->FetchAssoc($co);

	$pid = $rs["gestion_id"];
	$idg = $rs["gestion_id"];
	$idga = $rs["id"];

	$bd_base_file = $rs['base_file'];



	//Archivo igual que la base de datos

	//base 64

	$base_file = '';

	$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$rs['gestion_id']."/anexos".DS.$rs['url']);

	$base_file = base64_encode($data_base_file);


#	$tf = $con->Result($con->Query('select max(folio_final) as t from gestion_anexos where gestion_id = "'.$rs['gestion_id'].'"'), 0, 't');



	$tipo = new MDependencias_tipologias;

	$tipo->CreateDependencias_Tipologias("id", $rs['tipologia']);



	$ge = new MGestion;

	$ge->CreateGestion("id", $rs['gestion_id']);



	$dep = new MDependencias;

	$dep->CreateDependencias("id", $ge->GetTipo_documento());



	$c->InsertGestion_anexos_consultas($idb, $ge->GetId(), date("Y-m-d h:i:s"), $_SESSION['usuario'], $_SERVER['REMOTE_ADDR']);



echo "<div class='row' style='margin:0px'>";
echo "		<div class='col-md-12'>";


	$MGestion_tipologias_big_data = new MGestion_tipologias_big_data;
	$MGestion_tipologias_big_data->CreateGestion_tipologias_big_data("proceso_id", $ga->GetId());

	$serie = $c->GetDataFromTable("dependencias_tipologias", "id", $ga->GetTipologia(), "tipologia", $separador = " ");	
	$asunto = $ga->GetObservacion();


	if ($serie == "") {
		$serie = "Tipología sin Definir";
	}

	if ($asunto == "") {
		$asunto = "-";
	}

	$soporte = array("0" => "Sin Asignar", "1" => "Fisico", "2" => "Digital", "3" => "XML");
	$soporte = $soporte[$ga->GetSoporte()];

	$peso = round($ga->GetPeso() / 1024);


	$responsablea = $c->GetDataFromTable("usuarios", "user_id", $rs['user_id'], "p_nombre, p_apellido", $separador = " ");
	$idarearesponsable = $c->GetDataFromTable("usuarios", "user_id", $rs['user_id'], "regimen", $separador = " ");
	$arearesponsable = $c->GetDataFromTable("areas", "id", $idarearesponsable, "nombre", $separador = " ");


	echo '	<div class="infodocumento">

				<b>Tipo de archivo:</b> '.$ga->GetTypefile().' <b class="m-l-5">Soporte:</b>  '.$soporte.'<br>

				<b>Documento Generado el: </b>'.$f->ObtenerFecha4($rs['fecha']." ".$rs['hora']).'<br>

				<b>Tamaño de archivo:</b> '.$peso.' Kb ';
	echo "<span style=' margin-left:15px; margin-right:15px'> - </span>";			
	echo '		<b>Folios: </b>'.$ga->Getcantidad().'<br>';
	echo '		<b>Huella :</b> <span style="font-size:10px">'.$ga->Gethash().'</span></<br>

				<b>Indice: </b>'.$ge->GetMin_rad()."-".$f->zerofill($ga->GetIndice(), 5);

	echo "<span style=' margin-left:15px;'> Origen: </span>";
			if ($ga->GetOrigen() == "0") {
				echo "<b>Propio</b>";
			}else{
				$doco = new MGestion_anexos;
				$doco->CreateGestion_anexos("id", $ga->GetOrigen());
				$ng = new MGestion;
				$ng->CreateGestion("id", $doco->GetGestion_id());
				echo "<a href='/gestion/ver/".$ng->GetId()."/' target='_blank'>".$ng->GetMin_rad()."</a>";
			}

	echo 	'<br>';

			if ($ga->GetIs_publico() == "0") {
				echo  "<b>El Documento es Público</b>";	
			}else{
				echo  "<b>El Documento es Privado</b>";	
			}


			echo "<span style=' margin-left:15px; margin-right:15px'> - </span>";
			//echo "</div><div style=' margin-left:15px'>Origen del Documento: ";
			if ($ga->GetIn_out() == "0") {
				echo   "<b>El Documento es de Entrada</b>";	
			}else{
				echo   "<b>El Documento es de Salida</b>";	
			}
/*
*/
	echo '							
				
				<br>

				<b>Tipo de Documento: </b>'.$serie.'<br>
				<b>Observacion: </b>'.$asunto.'<br>
				<b>Cargado Por: </b>'.$responsablea. ' de '.$arearesponsable.'<br>
				<b>Productor: </b>'.$ga->GetProductor(). '

			</div>';

	echo '<p><a href="'.$url.'" target="_blank" class="btn btn-info">Descargar Documento</a></p>';

	echo '<hr style="margin-top:0px !important; margin-bottom:10px !important;">';

	$qerxyx = $con->Query("Select * from gestion_anexos_firmas where anexo_id = '".$ga->GetId()."' and usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '0' ");
	$r = $con->FetchAssoc($qerxyx);

	if ($r['id'] > 0) {
		global $c;

		$mens = $con->Query("select observacion from gestion_anexos_permisos where id_documento = '".$r['anexo_id']."' and usuario_permiso = '".$_SESSION['usuario']."' and estado = '0'");
		$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  

		$mensaje = $con->FetchAssoc($mens);
		$mensaje = $mensaje['observacion'];

		$NOMUSUARIO    = $c->GetDataFromTable("usuarios", "user_id", $r['usuario_solicita'], "p_nombre, p_apellido", $separador = " ");

		$path = '<div class="row" style="margin:0px">
				<div class="col-md-12" style="padding:10px !important;">
					<b>Observación:</b> <br>
					'.$mensaje.' 
					<br> <b>Fecha de Solicitud:</b> '.$r['fecha_solicitud'].'
				</div>
				<div class="col-md-12">';
	if($_SESSION['firmar_documentos'] == 1){
		if (strtolower($extension) == ".pdf") {
			if($_SESSION['MODULES']['firma_digital'] == "1"){

				$path .= "
						<div class='btn btn-success btn-circle m-r-5' onclick='OpenWindow(\"/firmas_usuarios/firmar/".$r['id']."/\")'>
							<i class='mdi mdi-pencil-lock'></i>
						</div>";
			}
		}
	}
		$path .= "	<div class='btn btn-info btn-circle m-r-5' onclick='EditarGestion_anexos_firmas(\"".$r['id']."\")'>
	                    <i class='fa fa-check'></i>
	                </div>";
		$path .= "	<div class='btn btn-warning btn-circle' onclick='EliminarGestion_anexos_firmas(\"".$r['id']."\")'>
	                    <i class='fa fa-times'></i>
	                </div>
	            </div>
	           </div>";
	           echo $path;
	}

	if($_SESSION['MODULES']['metadatos'] == "1"){
?>
		<div id="blmeta-data">
			<h4>Metadatos del Documento <?= $ga->GetNombre() ?></h4>
			<div style="height:380px !important; overflow: auto; border:1px solid #CCC" class="scrollable">
			<?

			if($ga->GetTipologia() > 0){
				$checki = $con->Query("select id from meta_referencias_titulos where tipo = '2' and id_s = '".$ga->GetTipologia()."'");
				$rot = $con->FetchAssoc($checki);

				if ($rot['id'] >= 1) {

					$mayeditform = false;

					if ($_SESSION['user_ai'] == $ge->GetNombre_destino() || $_SESSION['usuario'] == $ge->GetUsuario_registra()) {
						$mayeditform = true;
					}else{

						$gc = new MGestion_compartir;
				        $qn = $gc->ListarGestion_compartir(" where usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$ge->GetId()."'");
			        	$com = $con->FetchAssoc($qn);
			        	
				        if ($com['type'] >= 1) {
				            $mayeditform = true;
				        }else{
				        	$mayeditform = false;
				        }
					}

					if ($ge->GetEstado_archivo() != "1") {
						$mayeditform = false;
					}

			        if ($_SESSION['suscriptor_id'] != "") {
			        	$mayeditform = false;
			        }
						
					$checkb = $con->Query("select id, grupo_id from meta_big_data where ref_id = '".$rot['id']."' and type_id = '".$ga->GetId()."'");
					$rotb = $con->FetchAssoc($checkb);

					if ($rotb['id'] >= 1) {
						
						$grupo_id = $rotb['grupo_id'];
						include_once(VIEWS.DS."meta_big_data/FormUpdateMeta_big_data.php");
						#echo "<br><br><br>";
					}else{
						
						$checkInsert = $con->Query("select * from meta_referencias_campos where id_referencia = '".$rot['id']."'");
						$smallid = $f->GenerarSmallId();
						while ($rrrx = $con->FetchAssoc($checkInsert)) {
							$con->Query("INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form) VALUES ('".$ga->GetId()."', '".$rot['id']."', '".$rrrx['id']."', '', '".$smallid."', '2')");
						}
						$grupo_id = $smallid;
						include_once(VIEWS.DS."meta_big_data/FormUpdateMeta_big_data.php");
						
					}


				}else{
					echo "<div class='alert alert-info'>No se encuentran Metadatos registrados para esta tipología documental</div>";
				}

				#if($_SESSION['actualizar_metadatos'] == 1){

				#} 
				
				
				#$path .= ($ref->GetCol_2_name() != "")  ? '<div class="row"  style="margin:0px"><div class="col-md-4"><b>'.$ref->GetCol_2_name().':</b></div><div class="col-md-8"><input type="'.$ref->GetCol_2_type().'" name="col_2" class="title_act input1" value="'.$MGestion_tipologias_big_data->Getcol_2().'"></div></div>' : '';
				
			}else{

				echo "<div class='alert alert-info'>Sin Información Adicional</div>";

			}			


?>				
			</div>
		</div>
<?			
	}		

echo "		</div>
		</div>";

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
</style>
<script>
 	$("#modal-data-append").html("");
	$("#modal-data-append").prepend('<a href="/app/plugins/descargar.php?ga=<?= $idga ?>&g=<?= $idg ?>&f=<?= $url ?>&tf=<?= $_POST['title'] ?>&format=<?= $xurl ?>" target="_blank"><div class="boton fa fa-download" title="Descargar Documento"></div></a><span id="cargaranexospreview"></span>')
	showqanexos2('/gestion/GetAnexos2/<?= $ge->GetId() ?>/0/1/')
</script>

<style>
/* PANTALLA GIGANTE */
@media screen and (min-width: 991px) and (max-width: 1024px) {
    .paneldocumento{
        height: 630px !important;
    }
}
@media screen and (min-width: 1025px) and (max-width: 1366px) {
    .paneldocumento{
        height: 630px !important;
    }
}
@media screen and (min-width: 1367px) and (max-width: 1680px) {
    .paneldocumento{
        height: 850px !important;
    }
}
@media screen and (min-width: 1681px) and (max-width: 1920px) {
    .paneldocumento{
        height: 860px !important;
    }
}
</style>