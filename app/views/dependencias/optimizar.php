<?
    $MDependencias_version = new MDependencias_version;
	$MDependencias_version->CreateDependencias_version("id", $_SESSION['id_trd']);

	switch ($id) {
		case '0':
			break;
		case '1':
			echo "<div class='bg-primary' style='padding:20px'>ORGANIZANDO ALFABETICAMENTE SERIES Y SUBSERIES DOCUMENTALES</div>";

				$consulta = "select * from dependencias where id_version = '".$_SESSION['id_trd']."'";
				$q = $con->Query($consulta);
				$i = 0;	
				while ($row = $con->FetchAssoc($q)) {
					$nombre = strtoupper(trim($row['nombre']));
					$nombre = $f->Reemplazo3($nombre);

					if ($nombre != $row['nombre']) {
						$i++;
						$con->Query("update dependencias set nombre = '".$nombre."' where id = '".$row['id']."'");
					}
				}
				echo '<p class="bg-success" style="padding:10px">'.$i.' Registro(s) Afectado(s)</p>';
			break;
		case '2':
			echo "<div class='bg-primary' style='padding:20px'>ELIMINANDO SERIES DESVINCULADAS O SIN ASIGNAR A UN AREA</div>";

				$consulta = "select * from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '0'";
				$q = $con->Query($consulta);
				$i = 0;	
				while ($row = $con->FetchAssoc($q)) {
					
					$consulta = $con->Query("select * from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '".$row['id']."'");
					$count = $con->NumRows($consulta);

					if ($count == "0") {
						$i++;
						$con->Query("delete from dependencias where id = '".$row['id']."'");
					}
				}
			echo '<p class="bg-success" style="padding:10px">'.$i.' Registro(s) Afectado(s)</p>';
			break;
		case '3':
			echo "<div class='bg-primary' style='padding:20px'>UNIFICANDO REGISTROS DUPLICADOS</div>";
				$consulta = "select count(*) as t, nombre from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '0' group by nombre";
				$q = $con->Query($consulta);
				$i = 0;	
				$y = 0;
				while ($row = $con->FetchAssoc($q)) {
					if ($row['t'] > "1") {
						$i++;
						# code...
						$cons = $con->Query("select id from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '0' and nombre = '".$row['nombre']."'");
						$idp = 0;
						$unif = "";
						while ($rt = $con->FetchAssoc($cons)) {
							$y++;
							if ($idp == "0") {
								$idp = $rt['id'];
							}else{
								$unif .= $rt['id'].", ";
							}
						}
						$unif = substr($unif, 0, -2);
						$con->Query("update dependencias set dependencia = '$idp' where dependencia in($unif)");
						$con->Query("update areas_dependencias set id_dependencia_raiz = '$idp' where id_dependencia_raiz in($unif)");
						
						#echo "Unificar ($unif) en $idp <br><br>";
					}
				}
			echo '<p class="bg-success" style="padding:10px">'.$y.' Registro(s) Afectado(s) en '.$i.'</p>';
			break;
		case '4':
			echo "<div class='bg-primary' style='padding:20px'>ELIMINANDO SERIES DUPLICADAS</div>";

				$consulta = "select * from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '0'";
				$q = $con->Query($consulta);
				$i = 0;	
				while ($row = $con->FetchAssoc($q)) {
					
					$consulta = $con->Query("select * from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '".$row['id']."'");
					$count = $con->NumRows($consulta);

					if ($count == "0") {
						$i++;
						$con->Query("delete from dependencias where id = '".$row['id']."'");
					}
				}
			echo '<p class="bg-success" style="padding:10px">'.$i.' Registro(s) Afectado(s)</p>';
			break;			
		case '5':
			echo "<div class='bg-primary' style='padding:20px'>CODIFICANDO SERIES DOCUMENTALES</div>";
				$consulta = "select * from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '0' order by nombre asc";
				$q = $con->Query($consulta);
				$i = 0;	
				$y = 0;
				while ($row = $con->FetchAssoc($q)) {
						$i++;
						$id_c = $f->zerofill($i, 3);
						# code...
						$con->Query("update dependencias set id_c = '$id_c' where id = '".$row['id']."'");
				}						
			echo '<p class="bg-success" style="padding:10px">'.$i.' Registro(s) Afectado(s)</p>';
			break;	
		case '6':
			echo "<div class='bg-primary' style='padding:20px'>UNIFICANDO SERIES DUPLICADAS</div>";
			$consulta = "select * from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '0' order by nombre asc";
				$q = $con->Query($consulta);
				$i = 0;	
				$y = 0;
				while ($row = $con->FetchAssoc($q)) {
					
					$qs = $con->Query("select count(*) as t, nombre from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '".$row['id']."' group by nombre");
					
					while ($rod = $con->FetchAssoc($qs)) {
						if ($rod['t'] > "1") {
							#echo "En ".$row['nombre']."<br>";
							$i++;
							#echo "&nbsp;&nbsp;&nbsp;&nbsp;".$rod['nombre']." (".$rod['t'].")<br>"; 

							$cons = $con->Query("select id from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '".$row['id']."' and nombre = '".$rod['nombre']."'");
							
							$idp = 0;
							$unif = "";
							while ($rt = $con->FetchAssoc($cons)) {
								$y++;
								if ($idp == "0") {
									$idp = $rt['id'];
								}else{
									$unif .= $rt['id'].", ";
								}
							}

						$unif = substr($unif, 0, -2);
						#echo "&nbsp;&nbsp;&nbsp;&nbsp;Unificar ($unif) en $idp <br><br>";
						$con->Query("delete from dependencias where id in($unif)");
						$con->Query("update areas_dependencias set id_dependencia = '$idp' where id_dependencia in($unif)");
						$con->Query("update dependencias_tipologias set id_dependencia = '$idp' where id_dependencia in($unif)");
						}
						
					}
				}			
			echo '<p class="bg-success" style="padding:10px">'.$y.' Registro(s) Afectado(s) en '.$i.'</p>';
			break;
		case '7':

			echo "<div class='bg-primary' style='padding:20px'>ELIMINANDO SUBSERIES SIN ASOCIAR A NINGUNA AREA</div>";

			$consulta = "SELECT count(*) as t FROM dependencias left join areas_dependencias on dependencias.id = areas_dependencias.id_dependencia where areas_dependencias.id_dependencia IS NULL and dependencias.dependencia != 0 and dependencias.id_version = '".$_SESSION['id_trd']."'";
			$q = $con->Query($consulta);

			$i = $con->NumRows($q);

			$consulta = "SELECT * FROM dependencias left join areas_dependencias on dependencias.id = areas_dependencias.id_dependencia where areas_dependencias.id_dependencia IS NULL and dependencias.dependencia != 0 and dependencias.id_version = '".$_SESSION['id_trd']."'";
			$q = $con->Query($consulta);
			while ($r = $con->Fetcharray($q)) {
				$con->Query("delete from dependencias where id = '".$r[0]."'");
			}
			
			echo '<p class="bg-success" style="padding:10px">'.$i.' Registro(s) Afectado(s)</p>';

			break;
		case '8':
			echo "<div class='bg-primary' style='padding:20px'>UNIFICANDO TIPOLOGÍAS DOCUMENTALES</div>";

				$consulta = "select dependencias_tipologias.id, dependencias_tipologias.tipologia from dependencias_tipologias inner join dependencias on dependencias.id = dependencias_tipologias.id_dependencia where dependencias.id_version = '".$_SESSION['id_trd']."'";
				$q = $con->Query($consulta);
				$i = 0;	
				while ($row = $con->FetchAssoc($q)) {
					$nombre = strtoupper(trim($row['tipologia']));
					$nombre = $f->Reemplazo3($nombre);

					if ($nombre != $row['tipologia']) {
						$i++;
						$con->Query("update dependencias_tipologias set tipologia = '".$nombre."' where id = '".$row['id']."'");
					}
				}
				echo '<p class="bg-success" style="padding:10px">'.$i.' Registro(s) Actualizado(s)</p>';
				
				$consulta = "select * from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia > '0'";
				$q = $con->Query($consulta);
				$i = 0;	
				$y = 0;
				while ($row = $con->FetchAssoc($q)) {

					$rtop = $con->Query("select count(*) as t, tipologia from dependencias_tipologias where id_dependencia = '".$row['id']."' group by tipologia");

					#echo $row['nombre']."<br>";
					while ($rt = $con->FetchAssoc($rtop)) {
						if ($rt['t'] > "1") {
							
							$cons = $con->Query("select id from dependencias_tipologias where id_dependencia = '".$row['id']."' and tipologia = '".$rt['tipologia']."'");

							$idp = 0;
							$unif = "";
							while ($rt = $con->FetchAssoc($cons)) {
								$y++;
								if ($idp == "0") {
									$idp = $rt['id'];
								}else{
									$unif .= $rt['id'].", ";
								}
							}
							$unif = substr($unif, 0, -2);
							#echo "&nbsp;&nbsp;&nbsp;&nbsp;Unificar ($unif) en $idp <br><br>";
							$con->Query("delete from dependencias_tipologias where id in($unif)");
							#$con->Query("update areas_dependencias set id_dependencia = '$idp' where id_dependencia in($unif)");
							#echo '&nbsp;&nbsp;&nbsp;'.$rt['tipologia'].' - ('.$rt['t'].')<br>';
						}
					}
				}
				echo '<p class="bg-success" style="padding:10px">'.$y.' Registro(s) Unificados(s)</p>';

			break;										
		case '9':
			echo "<div class='bg-primary' style='padding:20px'>CODIFICANDO SUBSERIES DOCUMENTALES</div>";
			$consulta = "select * from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '0' order by nombre asc";
				$q = $con->Query($consulta);
				$y = 0;
				while ($row = $con->FetchAssoc($q)) {
					
					$qs = $con->Query("select * from dependencias where id_version = '".$_SESSION['id_trd']."' and dependencia = '".$row['id']."' order by nombre asc");
					
					$i = 0;	
					while ($rod = $con->FetchAssoc($qs)) {
						
						$i++;
						$y++;
						$id_c = $f->zerofill($i, 3);
						# code...
						$con->Query("update dependencias set id_c = '$id_c' where id = '".$rod['id']."'");
						
					}
				}	
			echo '<p class="bg-success" style="padding:10px">'.$y.' Registro(s) Afectado(s)</p>';
			break;														
		default:
			# code...
			break;
	}
?>
<div class="row" style="background: #FFF; padding:20px;">
	<div class="col-md-8">
		<h3>Banco de Datos de Series Documentales Versión <?= $MDependencias_version->GetNombre() ?></h3>
		<div class="list-group">
		<?
			$query = $con->Query("Select * from dependencias where dependencia = '0' and id_version = '".$_SESSION['id_trd']."' order by nombre asc");

			while ($row = $con->FetchAssoc($query)) {
				$qta = $con->Query("select * from dependencias where dependencia = '".$row['id']."' and id_version = '".$_SESSION['id_trd']."' order by nombre asc");
				echo '	<div class="list-group-item" id="'.$row['id'].'">
							'.$row['id_c'].' - '.$row['nombre'].'
							<span class="fa fa-pencil icobtn" style="float:right; cursor:pointer" onclick="EditarDependenciaPrincipal(\''.$row['id'].'\')"></span>
						</div>';
				while ($rx = $con->FetchAssoc($qta)) {


					echo '	<div class="list-group-item" style="padding-left:50px">
								<!--('.$rx['id'].') - --> '.$rx['id_c'].' - '.$rx['nombre'].' <span title="Tipologías Documentales Registradas"></span>
								<span class="fa fa-pencil icobtn" style="float:right; cursor:pointer" onclick="EditarDependenciaPrincipal(\''.$rx['id'].'\')"></span>

								<span class="fa fa-gear icobtn" style="float:right; cursor:pointer; color:#0C0" 
									onclick="select_gestSubs(\''.$rx['id'].'\')"></span>
							</div>';
					$rtop = $con->Query("select * from dependencias_tipologias where id_dependencia = '".$rx['id']."' order by tipologia asc");
					while ($rt = $con->FetchAssoc($rtop)) {
						$color = "#000";
						if ($rt['estado'] == 0) {
							$color = "#F00";
						}
						echo '	<div class="list-group-item" style="padding-left:100px; color: '.$color.'" id="tip'.$rt['id'].'">
									<span>'.$rt['tipologia'].'</span>
									<span class="fa fa-trash icobtn" style="float:right; cursor:pointer; color:'.$color.'" 
									onclick="EliminarTipologia(\''.$rt['id'].'\')"></span>
								</div>';
					}

				}
			}
		?>
		</div>
	</div>
	<div class="col-md-4">
		<h3>Actividades Para Realizar</h3>
			<div class="list-group">
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/1/" class="list-group-item <?= ($id >= '1')?'active':'' ?>"">
					Paso 1 - Reordenar - Organizar Alfabeticamente
					<div style="padding-left: 10px; padding-top: 5px; <?= ($id >= '1')?'':'display:none' ?>">
						<span class="fa fa-check"></span> Actividad Realizada
					</div>
				</a>
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/2/" class="list-group-item <?= ($id >= '2')?'active':'' ?>"">
					Paso 2 - Eliminar Series Desvinculadas
					<div style="padding-left: 10px; padding-top: 5px; <?= ($id >= '2')?'':'display:none' ?>">
						<span class="fa fa-check"></span> Actividad Realizada
					</div>
				</a>
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/3/" class="list-group-item <?= ($id >= '3')?'active':'' ?>"">
					Paso 3 - Unificar Series Duplicadas
					<div style="padding-left: 10px; padding-top: 5px; <?= ($id >= '3')?'':'display:none' ?>">
						<span class="fa fa-check"></span> Actividad Realizada
					</div>
				</a>
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/4/" class="list-group-item <?= ($id >= '4')?'active':'' ?>"">
					Paso 4 - Eliminar Series Desvinculadas
					<div style="padding-left: 10px; padding-top: 5px; <?= ($id >= '4')?'':'display:none' ?>">
						<span class="fa fa-check"></span> Actividad Realizada
					</div>
				</a>				
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/5/" class="list-group-item <?= ($id >= '5')?'active':'' ?>"">
					Paso 5 - Re-Codificar Series
					<div style="padding-left: 10px; padding-top: 5px; <?= ($id >= '5')?'':'display:none' ?>">
						<span class="fa fa-check"></span> Actividad Realizada
					</div>
				</a>
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/6/" class="list-group-item <?= ($id >= '6')?'active':'' ?>"">
					Paso 6 - Unificar Sub Series Duplicadas
					<div style="padding-left: 10px; padding-top: 5px; <?= ($id >= '6')?'':'display:none' ?>">
						<span class="fa fa-check"></span> Actividad Realizada
					</div>
				</a>
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/7/" class="list-group-item <?= ($id >= '7')?'active':'' ?>"">
					Paso 7 - Eliminar Subseries que no estén asociadas a ninguna Area
					<div style="padding-left: 10px; padding-top: 5px; <?= ($id >= '7')?'':'display:none' ?>">
						<span class="fa fa-check"></span> Actividad Realizada
					</div>
				</a>
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/8/" class="list-group-item <?= ($id >= '8')?'active':'' ?>"">
					Paso 8 - Unificar Tipologías Documentales
					<div style="padding-left: 10px; padding-top: 5px; <?= ($id >= '8')?'':'display:none' ?>">
						<span class="fa fa-check"></span> Actividad Realizada
					</div>
				</a>
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/9/" class="list-group-item <?= ($id >= '9')?'active':'' ?>"">
					Paso 9 - Re-Codificar Sub-Series
					<div style="padding-left: 10px; padding-top: 5px; <?= ($id >= '9')?'':'display:none' ?>">
						<span class="fa fa-check"></span> Actividad Realizada
					</div>
				</a>
				<a href="<? echo HOMEDIR ?>/dependencias/optimizar/" class="list-group-item">
					Paso 10 - Finalizar
				</a>
			</div>
			<div id="editarelementosubseries"></div>
	</div>
</div>			

<style>	
.icobtn{
	margin-top:3px;
	margin-left: 5px;
	margin-right: 5px;
	font-size: 16px;
}
</style>
<script>
	function select_gestSubs(elm){

		var URL = '/dependencias/configurar/'+elm+'/';
		OpenWindow2(URL);

	}
	function EliminarTipologia(idt){
		if (confirm("Está seguro de eliminar la tipología documental?")){
			$("#tip"+idt).remove();
			var URL = '/dependencias_tipologias/eliminarx/'+idt+'/';   
	        $.ajax({
	            type: 'POST',
	            url: URL,
	            success:function(msg){
	                alert(msg);
	            } 
	        });
		}
	}
</script>