
<div class="row">
	<div class="col-md-12 p-20" style="background-color: #FFF; padding:20px;">
<?php 
/*
?>
<?php if (!isset($_POST['fname'])): ?>
<?php  
		echo "No se a definido la variable fname";
		exit;
?>	
<?php endif ?>
<?

	$_SESSION['counter'] = "0";
	$_SESSION['counters'] = "0";
	$_SESSION['countern'] = "0";
	function search_files( $carpeta , $separador = '&nbsp;', $counter, $fecha, $blacklist, $pathlink){
		global $con;
	    if (is_dir($carpeta)) {
			# code...
			$folderCont = scandir($carpeta);

			foreach ($folderCont as $clave => $valor) {


				if ($valor!='.' && $valor!='..') {
					$ext = explode(".", $valor);
					if(is_dir($carpeta.'/'.$valor)){
						$paht = $counter+1;
						$num = "NO";

						#echo "$separador Nivel $paht: ".$valor."<br>";
						if ($paht == "2") {
							$fecha = date("Y-m-d", strtotime($valor));
							$fecha = explode("-", $valor);
							$fecha2 = explode("-", $valor);
							$fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
							#$fecha = $valor;
							$pathlink = $fecha2[2]."/".$fecha2[1]."/".$valor;
						}

						search_files($carpeta.'/'.$valor, $separador.$separador, $counter+1, $fecha, $blacklist, $pathlink);

					}else{
						if (!in_array($valor, $blacklist)) {

							$_SESSION['counter'] += 1;
							$month = explode("-",$fecha);
							$month = $month[1];

							$str = "
							SELECT gestion_anexos_pruebas.id, gestion_id, nombre, url, fecha, restored, MATCH (nombre) AGAINST ('".$valor."' IN NATURAL LANGUAGE MODE) AS score FROM gestion_anexos_pruebas inner join gestion on gestion.id = gestion_anexos_pruebas.gestion_id WHERE  gestion.rweb = '0' and gestion.min_rad != '2017-11-27' and MATCH (nombre) AGAINST ('".$valor."' IN NATURAL LANGUAGE MODE) and fecha = '".$fecha."' and estado = '1'";
							$x = $con->Query($str); 
							$row = $con->FetchAssoc($x);

							$st = "Select gestion_anexos_pruebas.id, gestion_id, nombre, url, fecha, restored from gestion_anexos_pruebas inner join gestion on gestion.id = gestion_anexos_pruebas.gestion_id where gestion.rweb = '0' and gestion.min_rad != '2017-11-27' and nombre like '%".$valor."%' and fecha = '".$fecha."' and estado = '1'";
							$y = $con->Query($st); 
							$ram = $con->FetchAssoc($y);

							if ( $row['id'] == "" && $ram['id'] == "" ) {
								$_SESSION['countern'] += 1;
								$valid = "<span style='color:#F00'>&#x10102;&#x10102;</span>";

							}else{
								if ($ram['id'] == $row['id']) {
									$_SESSION['counters'] += 1;
									if ($row['restored'] == "0") {
										# code...
										$filename=UPLOADS.DS.$row['gestion_id'].'/';
										if (!file_exists($filename)) {
										    mkdir(UPLOADS.DS . $row['gestion_id'], 0777);
										}
										$filename=UPLOADS.DS.$row['gestion_id'].'/anexos/';
										if (!file_exists($filename)) {
										    mkdir(UPLOADS.DS . $row['gestion_id'].'/anexos', 0777);
										}
										$backupname=UPLOADS.DS.$row['gestion_id'].'/backup/';
										if (!file_exists($backupname)) {
										    mkdir(UPLOADS.DS . $row['gestion_id'].'/backup', 0777);
										}

										if (!copy($carpeta.'/'.$valor, $filename.$row['url'])) {
											$valid = "<span style='color:#F00'>&#x10102;</span>";
										}else{
										    $valid = "<span style='color:#0F0'>&#x2713;</span>";
										}

										$con->Query("update gestion_anexos_pruebas set restored = '1' where id = '".$row['id']."'");

									}else{
										$valid = "<span style='color:#0F0'>&#x2713;&#x2713;</span>";
									}
								}else{
									$_SESSION['countern'] += 1;
									if ($row['score'] > 1) {
										$valid = "<span style='color:#0F0'>&#x2713;</span>";
									}else{
										$valid = "<span style='color:#F00'>&#x10102;</span>";
									}
								}
							}
							
							#if ($row['restored'] == "0") {
								
								echo "	<tr>
										<td>".$_SESSION['counter']."</td>
										<td>".$fecha."</td>
										<td>
											<a href='".HOMEDIR.DS."app/archivos_uploads/nuevascargas/$pathlink/$valor' target='_blank'>$valor<a><br>
											<small>$str</small><br>
										</td>
										<td style='color:#F00'>
											<a href='".HOMEDIR."/gestion/ver/".$row['gestion_id']."/' target='_blank'>
												".$row['gestion_id']."
											</a>
										</td>
										<td>
											<a href='".HOMEDIR."/gestion/ver/".$row['gestion_id']."/' target='_blank'>
												".$ram['gestion_id']."
											</a>
										</td>
										<td style='color:#F00'>".$row['id']."</td>
										<td>".$ram['id']."</td>
										<td style='color:#F00'>".$row['url']."<br><small>".$row['nombre']."</small><br><small>Score: ".$row['score']." </small></td>
										<td>".$ram['url']."</td>
										<td>$valid</td>
									</tr>";
							#}
						}
					}
				}

			}

		}else{
			echo "El directorio no se encuentra o no existe";
		}
	}

	$orpath = ROOT.DS."archivos_uploads/nuevascargas/$fname/";
	echo '	<table border="1">
				<tr>
					<td>Con</td>
					<td>Fecha</td>
					<td>Archivo</td>
					<td style="color:#F00">Id Rad</td>
					<td>Id Rad</td>
					<td style="color:#F00">Id Doc</td>
					<td>Id Doc</td>
					<td style="color:#F00">URL Doc</td>
					<td>URL Doc</td>
					<td>V</td>
				</tr>';

	$blacklist = array('.ftpquota');
	search_files($orpath, "-", '0', $fecha, $blacklist, $pathlink);
	echo '</table>';
	echo "<h5>Archivos RECORRIDOS: ".$_SESSION['counter']."</h5>";
	echo "<h5>Archivos ACTUALIZADOS: ".$_SESSION['counters']."</h5>";
	echo "<h5>Archivos SIN ACTUALIZAR: ".$_SESSION['countern']."</h5>";

	$sql = $con->Query("Select * from gestion_anexos_pruebas inner join gestion on gestion.id = gestion_anexos_pruebas.gestion_id where  gestion.rweb = '0' and YEAR(fecha) = '$fname' and estado = '1'");
	$i = 0;
	$j = 0;
	$k = 0;
	while ($row = $con->FetchAssoc($sql)) {
		$i++;
		if ($row['restored'] == "1") {
			$j++;
		}else{
			$k++;
		}
	}
	echo "<hr>";
	echo "<h5>Archivos TOTALES $fname: ".$i."</h5>";
	echo "<h5>Archivos RECUPERADOS $fname: ".$j."</h5>";
	echo "<h5>Archivos SIN RECUPERAR $fname: ".$k."</h5>";

*/


	if ($_SESSION['usuario'] == 'sanderkdna@gmail.com') {
		$sql = $con->Query("SELECT * FROM `gestion` where f_recibido between '2017-01-01' and '2019-02-19' and rweb = '1' and estado_respuesta != 'Cerrado' and estado_archivo = '1' order by suscriptor_id");
	}else{
		$sql = $con->Query("SELECT * FROM `gestion` where f_recibido between '2019-01-01' and '2019-02-19' and rweb = '1' and estado_respuesta != 'Cerrado' and estado_archivo = '1' order by suscriptor_id");
		
	}
	echo '<table border="1" style="font-size:14px;">
				<tr>
					<td style="width:20px">#</td>
					<td style="width:50px">ID</td>
					<td style="width:100px">M. Rad</td>
					<td style="width:200px">Area</td>
					<td style="width:200px">Usuario</td>
					<td style="width:200px">Suscriptor</td>
					<td>Archivos</td>
					<td>CERRAR</td>
					<td>RECHAZAR</td>
				</tr>';
	$i = 0;
	$xpath = "";
	while ($row = $con->FetchAssoc($sql)) {
		$i++;
		$path = "";
		$xpath .= $row['id'].", ";
		$sq = $con->Query("select * from gestion_anexos where gestion_id = '".$row['id']."'");
		while ($rx = $con->FetchAssoc($sq)) {
			$path .= "<small>".$rx['nombre']."<br></small>";
		}
		
		$user = $c->GetDataFromTable("usuarios", "a_i", $row['nombre_destino'], "p_nombre, p_apellido", $separador = " ");
        $area = $c->GetDataFromTable("areas", "id", $row['dependencia_destino'], "nombre", $separador = " ");

        $s = new MSuscriptores_contactos;
		$s->CreateSuscriptores_contactos("id", $row["suscriptor_id"]);
		$sd = new MSuscriptores_contactos_direccion;
		$sd->CreateSuscriptores_contactos_direccion("id_contacto", $row["suscriptor_id"]);

		echo '	<tr id="pp'.$row['id'].'">
					<td>'.$i.'</td>
					<td>'.$row['id'].'</td>
					<td> <a href="/gestion/ver/'.$row['id'].'/" targe="_blank">  '.$row['min_rad'].' </a></td>
					<td><small>'.$area.'</small></td>
					<td><small>'.$user.'</small></td>
					<td><small>'.$s->GetNombre().' <br>Tel: '.$sd->GetTelefonos().'</small></td>
					<td>'.$path.'</td>
					<td align="center">  
						<button class="btn btn-primary fa fa-lock" title="CERRAR SOLICITUD" onClick="CerrarSolicitud(\''.$row['id'].'\')"></button>
					</td>
					<td align="center"> 
						<button class="btn btn-primary fa fa-close" title="RECHAZAR SOLICITUD" onClick="RechazarSolicitud(\''.$row['id'].'\')"></button>
					</td>
				</tr>';
	}
	echo "</table>";


?>
</div>
</div>
<script type="text/javascript">
	
	function RechazarSolicitud(id){
		if(confirm('Esta seguro desea RECHAZAR este expediente')){
			t = prompt("Escriba porque desea rechazar esta solicitud");
			var URL = '/gestion/esperasolicitud/'+id+'/'+t+'/';
			var st = "observacion2="+t
			$.ajax({
				type: 'POST',
				url: URL,
				data: st,
				success: function(msg){
					alert(msg);
					$('#pp'+id).remove();
				}
			});
		}
	}

	function CerrarSolicitud(id){
		if(confirm('Esta seguro desea CERRAR Y ARCHIVAR este expediente')){
			t = prompt("Escriba porque desea rechazar esta solicitud");
			var URL = '/gestion/archivarexpedienteweb/'+id+'/';
			var st = "observacion2="+t
			$.ajax({
				type: 'POST',
				url: URL,
				data: st,
				success: function(msg){
					alert("expediente arcivado");
					$('#pp'+id).remove();
				}
			});
		}
	}

</script>