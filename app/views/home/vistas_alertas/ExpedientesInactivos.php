<?
global $c;
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>

	<div class="row fullheight">
		<div class="col-md-12">
			<ul class="nav nav-pills m-b-30 " role="tablist" id="tab_navegacion_widgets">
				<?

						$itdt = $id;
						$totd = 1;
						$tots = 1;
						$totc = 1;
				
						$menuactivea = "display:block";
						$tabactivea = "active";
						$menuactiveb = "";
						$menuactivec = "";
						$menuactived = "";
						$menuactivee = "";
						$menuactivef = "";

				$sqla = $con->Query("SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' and e.dias > 0 and e.dias <= 5 group by g.id");
				$sqlb = $con->Query("SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' and e.dias > 5 and e.dias <= 15 group by g.id");
				$sqlc = $con->Query("SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' and e.dias > 15 and e.dias <= 30 group by g.id");
				$sqld = $con->Query("SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' and e.dias > 30 and e.dias <= 45 group by g.id");
				$sqle = $con->Query("SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' and e.dias > 45 and e.dias <= 60 group by g.id");
				$sqlf = $con->Query("SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' and e.dias > 60 group by g.id");
					
				$numa = $con->NumRows($sqla);
				$numb = $con->NumRows($sqlb);
				$numc = $con->NumRows($sqlc);
				$numd = $con->NumRows($sqld);
				$nume = $con->NumRows($sqle);
				$numf = $con->NumRows($sqlf);	

				?>
				<li onClick="CargarAlerta2(1, 'Expedientes Inactivos', 'expedientesinactivos', '1' , 'tab1');ActivarTab('tab1', 'buscartab1')"  <?= $c->Ayuda('159', 'tog') ?> id="buscartab1" role="presentation" class="<?= $tabactivea ?>"><a href="#">5 Dias (<?= $numa ?> Exp.)</a></li>
				<li onClick="CargarAlerta2(1, 'Expedientes Inactivos', 'expedientesinactivos', '1' , 'tab2');ActivarTab('tab2', 'buscartab2')"  <?= $c->Ayuda('159', 'tog') ?> id="buscartab2" role="presentation" class="<?= $tabactiveb ?>"><a href="#">15 Dias (<?= $numb ?> Exp.)</a></li>
				<li onClick="CargarAlerta2(1, 'Expedientes Inactivos', 'expedientesinactivos', '1' , 'tab3');ActivarTab('tab3', 'buscartab3')"  <?= $c->Ayuda('159', 'tog') ?> id="buscartab3" role="presentation" class="<?= $tabactivec ?>"><a href="#">30 Dias (<?= $numc ?> Exp.)</a></li>
				<li onClick="CargarAlerta2(1, 'Expedientes Inactivos', 'expedientesinactivos', '1' , 'tab4');ActivarTab('tab4', 'buscartab4')"  <?= $c->Ayuda('159', 'tog') ?> id="buscartab4" role="presentation" class="<?= $tabactived ?>"><a href="#">45 Dias (<?= $numd ?> Exp.)</a></li>
				<li onClick="CargarAlerta2(1, 'Expedientes Inactivos', 'expedientesinactivos', '1' , 'tab5');ActivarTab('tab5', 'buscartab5')"  <?= $c->Ayuda('159', 'tog') ?> id="buscartab5" role="presentation" class="<?= $tabactivee ?>"><a href="#">60 Dias (<?= $nume ?> Exp.)</a></li>
				<li onClick="CargarAlerta2(1, 'Expedientes Inactivos', 'expedientesinactivos', '1' , 'tab6');ActivarTab('tab6', 'buscartab6')"  <?= $c->Ayuda('159', 'tog') ?> id="buscartab6" role="presentation" class="<?= $tabactivef ?>"><a href="#">61+ Dias (<?= $numf ?> Exp.)</a></li>
			</ul>
			<div id="tab1" style="<?= $menuactivea ?>">
				
<?
			if($tab=='tab1'){

				echo '<input type="button" onClick="ExportarExcel2(\'exportar_tab1\')" value="Exportar Listado a Excel" class="btn btn-primary  m-b-30">';

				$tablat = '<div id="exportar_tab1" style="display:none">
							<table border="1">
								<thead>
									<tr>
										<th>Cod. Interno</th>
										<th>Radicado</th>
										<th>Asunto</th>
										<th>Responsable</th>
										<th>Fecha de Apertura</th>
										<th>Días de Inactividad</th>
									</tr>
								</thead>
								<tbody>';


				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
                $c = new Consultas;
                $comparacion = " and e.dias > 0 and e.dias <= 5 ";

				$sql = "SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' $comparacion group by g.id order by e.dias desc  ";
				$consulta = $sql;
				#$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql);
				$ic=0;
				while($rrt = $con->FetchArray($qwa)){
					$ic++;
					$g = new MGestion;
					$g->CreateGestion("id", $rrt['id']);
					
					$path = '<div class="row">
								<div class="col-md-12 text-center">
									<h4 class="text-danger"><b>'.$rrt['dias'].' Dias de inactividad</b></h4>
								</div>
							</div>';
					$c->GetVistaAmple($g->GetId(), $path, 'min');
				$nombre = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", "");
					$tablat .= '<tr>
									<th align="left">'.$g->GetMin_rad().'</th>
									<th align="left">'.$g->GetRadicado().'</th>
									<th align="left">'.$g->GetObservacion().'</th>
									<th align="left">'.$nombre.'</th>
									<th align="left">'.$g->GetF_recibido().'</th>
									<th align="left">'.$rrt['dias'].'</th>
								</tr>';
				}

				$tablat .= '	</tbody>
							</table>
						</div>';
				echo $tablat;

				if($ic == "0"){
					echo "<li class='list-group-item'>
							<div id='messageExpedientesInactivos'><div  class='alert alert-info'>No tienes Expedientes Inactivos :-)</div><br><br></div>
						</li>";
				}
				echo "</ul>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);
				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
			}
?>
				
			</div>
			<div class="busquedaresultadotab" id="tab2" style="<?= $menuactiveb ?>">
				
<?				
				if($tab=='tab2'){

					echo '<input type="button" onClick="ExportarExcel2(\'exportar_tab2\')" value="Exportar Listado a Excel" class="btn btn-primary  m-b-30">';

				$tablat = '<div id="exportar_tab2" style="display:none">
							<table border="1">
								<thead>
									<tr>
										<th>Cod. Interno</th>
										<th>Radicado</th>
										<th>Asunto</th>
										<th>Responsable</th>
										<th>Fecha de Apertura</th>
										<th>Días de Inactividad</th>
									</tr>
								</thead>
								<tbody>';


				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
                $comparacion = " and e.dias > 5 and e.dias <= 15 ";

				$sql = "SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."'  $comparacion  order by e.dias desc  ";
				$consulta = $sql;
				#$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql);
				$ic=0;
				while($rrt = $con->FetchArray($qwa)){
					$ic++;
					$g = new MGestion;
					$g->CreateGestion("id", $rrt['id']);
					
					$path = '<div class="row">
								<div class="col-md-12 text-center">
									<h4 class="text-danger"><b>'.$rrt['dias'].' Dias de inactividad</b></h4>
								</div>
							</div>';
					$c->GetVistaAmple($g->GetId(), $path, 'min');
				$nombre = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", "");
					$tablat .= '<tr>
									<th align="left">'.$g->GetMin_rad().'</th>
									<th align="left">'.$g->GetRadicado().'</th>
									<th align="left">'.$g->GetObservacion().'</th>
									<th align="left">'.$nombre.'</th>
									<th align="left">'.$g->GetF_recibido().'</th>
									<th align="left">'.$rrt['dias'].'</th>
								</tr>';
				}

				$tablat .= '	</tbody>
							</table>
						</div>';
				echo $tablat;

				if($ic == "0"){
					echo "<li class='list-group-item'>
							<div id='messageExpedientesInactivos'><div  class='alert alert-info'>No tienes Expedientes Inactivos :-)</div><br><br></div>
						</li>";
				}
				echo "</ul>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);
				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab2\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab2\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';

			}
?>
			
			</div>
			<div class="busquedaresultadotab" id="tab3" style="<?= $menuactivec ?>">
<?
				if($tab=='tab3'){

					echo '<input type="button" onClick="ExportarExcel2(\'exportar_tab3\')" value="Exportar Listado a Excel" class="btn btn-primary  m-b-30">';

				$tablat = '<div id="exportar_tab3" style="display:none">
							<table border="1">
								<thead>
									<tr>
										<th>Cod. Interno</th>
										<th>Radicado</th>
										<th>Asunto</th>
										<th>Responsable</th>
										<th>Fecha de Apertura</th>
										<th>Días de Inactividad</th>
									</tr>
								</thead>
								<tbody>';
				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
                $comparacion = " and e.dias > 15 and e.dias <= 30 ";
				$sql = "SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' $comparacion group by g.id order by e.dias desc  ";
				$consulta = $sql;
				#$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql);
				$ic=0;

				while($rrt = $con->FetchArray($qwa)){
					$ic++;
					$g = new MGestion;
					$g->CreateGestion("id", $rrt['id']);
					
					$path = '<div class="row">
								<div class="col-md-12 text-center">
									<h4 class="text-danger"><b>'.$rrt['dias'].' Dias de inactividad</b></h4>
								</div>
							</div>';
					$c->GetVistaAmple($g->GetId(), $path, 'min');
				$nombre = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", "");
					$tablat .= '<tr>
									<th align="left">'.$g->GetMin_rad().'</th>
									<th align="left">'.$g->GetRadicado().'</th>
									<th align="left">'.$g->GetObservacion().'</th>
									<th align="left">'.$nombre.'</th>
									<th align="left">'.$g->GetF_recibido().'</th>
									<th align="left">'.$rrt['dias'].'</th>
								</tr>';
				}

				$tablat .= '	</tbody>
							</table>
						</div>';
				echo $tablat;

				if($ic == "0"){
					echo "<li class='list-group-item'>
							<div id='messageExpedientesInactivos'><div  class='alert alert-info'>No tienes Expedientes Inactivos :-)</div><br><br></div>
						</li>";
				}
				echo "</ul>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);
				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab3\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab3\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
		   	}
?>
			</div>
			<div class="busquedaresultadotab" id="tab4" style="<?= $menuactived ?>">
<?
			if($tab=='tab4'){

				echo '<input type="button" onClick="ExportarExcel2(\'exportar_tab4\')" value="Exportar Listado a Excel" class="btn btn-primary  m-b-30">';

				$tablat = '<div id="exportar_tab4" style="display:none">
							<table border="1">
								<thead>
									<tr>
										<th>Cod. Interno</th>
										<th>Radicado</th>
										<th>Asunto</th>
										<th>Responsable</th>
										<th>Fecha de Apertura</th>
										<th>Días de Inactividad</th>
									</tr>
								</thead>
								<tbody>';

				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
                $comparacion = " and e.dias > 30 and e.dias <= 45 ";

				$sql = "SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' $comparacion group by g.id order by e.dias desc  ";
				$consulta = $sql;
				#$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql);
				$ic=0;
				while($rrt = $con->FetchArray($qwa)){
					$ic++;
					$g = new MGestion;
					$g->CreateGestion("id", $rrt['id']);
					
					$path = '<div class="row">
								<div class="col-md-12 text-center">
									<h4 class="text-danger"><b>'.$rrt['dias'].' Dias de inactividad</b></h4>
								</div>
							</div>';
					$c->GetVistaAmple($g->GetId(), $path, 'min');
				$nombre = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", "");
					$tablat .= '<tr>
									<th align="left">'.$g->GetMin_rad().'</th>
									<th align="left">'.$g->GetRadicado().'</th>
									<th align="left">'.$g->GetObservacion().'</th>
									<th align="left">'.$nombre.'</th>
									<th align="left">'.$g->GetF_recibido().'</th>
									<th align="left">'.$rrt['dias'].'</th>
								</tr>';
				}

				$tablat .= '	</tbody>
							</table>
						</div>';
				echo $tablat;

				if($ic == "0"){
					echo "<li class='list-group-item'>
							<div id='messageExpedientesInactivos'><div  class='alert alert-info'>No tienes Expedientes Inactivos :-)</div><br><br></div>
						</li>";
				}
				echo "</ul>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);
				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab4\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab4\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab4\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab4\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab4\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab4\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab4\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab4\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
			}
?>
			</div>
			<div class="busquedaresultadotab" id="tab5" style="<?= $menuactivee ?>">
<?
			if($tab=='tab5'){

				echo '<input type="button" onClick="ExportarExcel2(\'exportar_tab5\')" value="Exportar Listado a Excel" class="btn btn-primary  m-b-30">';

				$tablat = '<div id="exportar_tab5" style="display:none">
							<table border="1">
								<thead>
									<tr>
										<th>Cod. Interno</th>
										<th>Radicado</th>
										<th>Asunto</th>
										<th>Responsable</th>
										<th>Fecha de Apertura</th>
										<th>Días de Inactividad</th>
									</tr>
								</thead>
								<tbody>';
				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
                $comparacion = " and e.dias > 45 and e.dias <= 60 ";

				$sql = "SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' $comparacion group by g.id order by e.dias desc  ";
				$consulta = $sql;
				#$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql);
				$ic=0;
				while($rrt = $con->FetchArray($qwa)){
					$ic++;
					$g = new MGestion;
					$g->CreateGestion("id", $rrt['id']);
					
					$path = '<div class="row">
								<div class="col-md-12 text-center">
									<h4 class="text-danger"><b>'.$rrt['dias'].' Dias de inactividad</b></h4>
								</div>
							</div>';
					$c->GetVistaAmple($g->GetId(), $path, 'min');
				}

				if($ic == "0"){
					echo "<li class='list-group-item'>
							<div id='messageExpedientesInactivos'><div  class='alert alert-info'>No tienes Expedientes Inactivos :-)</div><br><br></div>
						</li>";
				}
				echo "</ul>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);
				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab5\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab5\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab5\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab5\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab5\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab5\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab5\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab5\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
		   	}
?>
			</div>
			<div class="busquedaresultadotab" id="tab6" style="<?= $menuactivef ?>">
			
<?
			if($tab=='tab6'){

				echo '<input type="button" onClick="ExportarExcel2(\'exportar_tab6\')" value="Exportar Listado a Excel" class="btn btn-primary  m-b-30">';

				$tablat = '<div id="exportar_tab6" style="display:none">
							<table border="1">
								<thead>
									<tr>
										<th>Cod. Interno</th>
										<th>Radicado</th>
										<th>Asunto</th>
										<th>Responsable</th>
										<th>Fecha de Apertura</th>
										<th>Días de Inactividad</th>
									</tr>
								</thead>
								<tbody>';

				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
                $comparacion = " and e.dias > 61 ";

				$sql = "SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' $comparacion group by g.id order by e.dias desc  ";
				$consulta = $sql;
				#$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql);
				$ic=0;
				while($rrt = $con->FetchArray($qwa)){
					$ic++;
					$g = new MGestion;
					$g->CreateGestion("id", $rrt['id']);
					
					$path = '<div class="row">
								<div class="col-md-12 text-center">
									<h4 class="text-danger"><b>'.$rrt['dias'].' Dias de inactividad</b></h4>
								</div>
							</div>';
					$c->GetVistaAmple($g->GetId(), $path, 'min');


					$nombre = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", "");
					$tablat .= '<tr>
									<th align="left">'.$g->GetMin_rad().'</th>
									<th align="left">'.$g->GetRadicado().'</th>
									<th align="left">'.$g->GetObservacion().'</th>
									<th align="left">'.$nombre.'</th>
									<th align="left">'.$g->GetF_recibido().'</th>
									<th align="left">'.$rrt['dias'].'</th>
								</tr>';
				}

				$tablat .= '	</tbody>
							</table>
						</div>';
				echo $tablat;

				if($ic == "0"){
					echo "<li class='list-group-item'>
							<div id='messageExpedientesInactivos'><div  class='alert alert-info'>No tienes Expedientes Inactivos :-)</div><br><br></div>
						</li>";
				}
				echo "</ul>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);
				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab6\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab6\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab6\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab6\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"1\", \"tab6\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagAnt\", \"tab6\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagSig\", \"tab6\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Expedientes Inactivos\", \"expedientesinactivos\", \"$PagUlt\", \"tab6\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';

			}
?>
			</div>
		</div>
	</div>


<form action="/ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
  <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
	});

	function ActivarTab(tab, selector){

		$("#buscartab1").removeClass('active');
		$("#buscartab2").removeClass('active');
		$("#buscartab3").removeClass('active');
		$("#buscartab4").removeClass('active');
		$("#buscartab5").removeClass('active');
		$("#buscartab6").removeClass('active');

		$("#tab1").css('display', 'none');
		$("#tab2").css('display', 'none');
		$("#tab3").css('display', 'none');
		$("#tab4").css('display', 'none');
		$("#tab5").css('display', 'none');
		$("#tab6").css('display', 'none');

		$("#"+selector).addClass("active");
		$("#"+tab).css("display", 'block');

	}
	ActivarTab('<?php echo $tab; ?>', 'buscar<?php echo $tab; ?>');
	
	function ExportarExcel2(id){
		alert("Exportando Informe...")
	    $("#datos_a_enviar").val( $("<div>").append( $("#"+id).eq(0).clone()).html());
	    $("#FormularioExportacion").submit();

	}

</script>
<style type="text/css">
	
	.busquedaresultadotab{
	    min-height: 400px;
	    border-top: none;
	    margin-top: -1px;
	    display: none;
	}

	#tab_navegacion_widgets.nav>li>a {
	    position: relative;
	    display: block;
	    padding: 10px 15px;
	}

</style>



    
    
    
    
    
    
