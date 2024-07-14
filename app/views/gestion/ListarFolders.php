<div class="panel panel-default block1 m-t-30">
	<div class="panel-wrapper collapse in">
		<div class="panel-body">

			<?
			$minfilt = "";
			if ($_SESSION['filtro_estado'] != "Todos") {
				$minfilt .= " AND estado_respuesta = '" . $_SESSION['filtro_estado'] . "'";
			}
			if ($_SESSION['filtro_prioridad'] != "Todos") {
				$minfilt .= " AND prioridad = '" . $_SESSION['filtro_prioridad'] . "'";
			}
			$pathfiltro = " AND f_recibido between '" . $_SESSION['filtro_fi'] . "' and '" . $_SESSION['filtro_ff'] . "' $minfilt";


			$path = '<div class="row">

			<div class="col-md-3" style="margin: 0px;">
				<h3>Versión de los Documentos</h3>
			</div>

			<div class="col-md-7 " style="text-align: left">
				<select name="version_active" id="version_active" ' . $c->Ayuda("71", 'tog') . ' onchange="ChangeVersionConsulta();" class="form-control">';

			$q_strx = "SELECT id_version from super_admin WHERE id='6'";
			$queryx = $con->Query($q_strx);
			$idv = $con->Result($queryx, 0, "id_version");
			$nv = $c->GetDataFromTable("dependencias_version", "id", $idv, "nombre", "");
			$path .= '<option value="' . $idv . '">' . $nv . ' (Activa en la Empresa)</option>';

			$qvs = $con->Query("select version from gestion where version != '" . $idv . "' group by version");
			$i = 0;
			while ($row = $con->FetchAssoc($qvs)) {
				$i++;
				$nver = $c->GetDataFromTable("dependencias_version", "id", $row['version'], "nombre", "");
				$active = "";

				if ($_SESSION['active_vista'] == $row['version']) {
					$active = "selected = 'selected'";
				}
				$path .= "<option value='" . $row['version'] . "' $active>$nver</option>";
			}

			$path .= '		</select>
			</div>
		</div>';

			if ($i > 0) {
				echo $path;
			}
			?>
			<div class="row m-t-20">
				<div class="col-md-12">
					<ol class="breadcrumb default">
						<li class="active">Gestión</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs m-b-30" id="formnavigation">
						<?

						if ($idx == "0") {
							$idx = $_SESSION['area_principal'];
						}

						$_SESSION['area_principal'] = $idx;

						$MAreas = new MAreas;
						$MAreas->CReateAreas("id", $idx);


						$query = $con->Query("select * from usuarios_configurar_accesos where user_id = '" . $_SESSION['usuario'] . "' and tabla = 'area' and id_tabla like '%" . $_SESSION['seccional'] . "'");


						while ($row = $con->FetchAssoc($query)) {

							$xd = explode($_SESSION['seccional'], $row['id_tabla']);

							$idarea = $xd[0];
							$la = $xd[0];

							if ($la != "1") {

								$ase = "";
								if ($idx == $idarea) {
									$ase = "class='active'";
								}
								$nomform = $c->GetDataFromTable("areas", "id", $idarea, "nombre", $separador = " ");

								$tamparea = strlen($nomform);
								if ($tamparea > 30) {
									$nomformmin = substr($nomform, 0, 27) . "...";
								} else {
									$nomformmin = $nomform;
								}

								echo '	<li role="presentation" data-toggle="tooltip" data-placement="top" title="' . $nomform . '" ' . $ase . '>
                			<a href="/gestion/getareas/' . $idarea . '/">' . $nomformmin . '</a>
                		</li>';
							}
						}
						?>
					</ul>



					<?php if ($_SESSION['buscador_global'] == "1") : ?>
						<h3>Carpetas del Sistema</h3>

						<!--<div class="title">Carpetas del Area</div>-->
						<div class="row">


							<?
							if ($_SESSION['MODULES']['correspondencia'] == 1) {
								$cantidad = "*";
								echo $f->DoFolder("CORRESPONDENCIA", "/gestion/correspondencia/", $cantidad, "green");
							}

							if ($_SESSION['sadmin'] == '1' && $_SESSION['typefolder'] == '1') {
								if ($_SESSION['reparto'] == 1) {
									$cantidad = $f->Zerofill($c->GetTotalExpedientesSinAsignar(), 3);
									echo $f->DoFolder("REPARTO", "/gestion/reparto/", $cantidad, "green", "1", $idx);
								}
							}

							$usua = new MUsuarios;
							$usua->CreateUsuarios("user_id", $_SESSION['usuario']);
							$cantidad = $f->Zerofill($c->GetTotalExpedientesUsuario($usua->GetA_i(), $idx), 3);
							echo $f->DoFolder("VER TODOS MIS EXPEDIENTES", "/gestion/myfiles/1/", $cantidad, "green", "", $idx);


							if ($c->GetTotalExpedientesCreadosUsuario($usua->GetA_i(), $idx) >= 1) {
								$xcantidad = $f->Zerofill($c->GetTotalExpedientesCreadosUsuario($usua->GetA_i(), $idx), 3);
								echo $f->DoFolder("EXPEDIENTES CREADOS POR MI", "/dependencias/creados/", $xcantidad, "green", "", $idx);
							}

							if ($c->GetExpedientesCompartidos() >= 1) {
								$cantidad = $f->Zerofill($c->GetExpedientesCompartidos(), 3);
								echo $f->DoFolder("EXPEDIENTES QUE ME HAN COMPARTIDO", "/gestion_compartir/compartidos/1/", $cantidad, "green", "", $idx);
							}

							?>
						</div>
						<hr>
					<?php endif ?>
					<h3>Carpetas del Area <?php echo $MAreas->GetNombre(); ?></h3>
					<div class="row">
						<?

						# SERIES DOCUMENTALES 
						$object = new MAreas_dependencias;
						#$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$_SESSION['area_principal']."' and id_version = '".$_SESSION['active_vista']."' group by id_dependencia_raiz");	    

						$query = $object->ListarAreas_dependencias(" WHERE id_area = '" . $idx . "' and id_version = '" . $_SESSION['active_vista'] . "' group by id_dependencia_raiz");
						while ($row = $con->FetchAssoc($query)) {
							$l = new MAreas_dependencias;
							$l->Createareas_dependencias('id', $row[id]);
							$d = new MDependencias;
							$d->CreateDependencias("id", $l->GetId_dependencia_raiz());

							$nombre = $d->GetNombre();
							$enlace = "/dependencias/childs/" . $d->GetId() . "/" . $idx . "/";



							$str = "SELECT count(*) as t FROM gestion where nombre_destino = '" . $_SESSION['user_ai'] . "' and dependencia_destino = '" . $idx . "' and ciudad = '" . $_SESSION['ciudad'] . "' and oficina = '" . $_SESSION['seccional'] . "' and id_dependencia_raiz = '" . $l->GetId_dependencia_raiz() . "' and version = '" . $_SESSION['active_vista'] . "' and estado_archivo = '" . $_SESSION['typefolder'] . "' $pathfiltro ";

							$qt = $con->Query($str);
							$rqt = $con->Result($qt, '0', "t");

							/*
select count(*) as t from gestion where id_dependencia_raiz = '238' and and and 
*/

							$cantidad = $f->Zerofill($rqt, 3);
							echo $f->DoFolder($nombre, $enlace, $cantidad, "", "", $idx);
						}
						?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>