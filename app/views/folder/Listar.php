<div id="tools-content">
	<div class="opc-folder blue">
				<ol class="breadcrumb">
					  <a href="/proceso/1/" class="active"><li class="breadcrumb-item active fa fa-archive"></li></a>
		  		  <li></li>
		  		</ol>
			</div>
		</div>
	<div id="folders-content">
		<div id="folders-list-content">
			<div class="bloque_principal_carpetas">
				<div class="title">Mis Expedientes</div>
		<?

			global $f;
			global $c;
			global $con;

			$usua = new MUsuarios;
			$usua->CreateUsuarios("user_id", $_SESSION['usuario']);

    	    if($_SESSION['MODULES']['interaccion_suscriptores'] == 1){
	    		    	$cantidad = "*";	
		    	echo $f->DoFolder("INTERACCIÓN CON SUSCRIPTORES", "/gestion/InteraccionSuscriptores/", $cantidad, "green");
			}
		    if($_SESSION['MODULES']['corres pondencia'] == 1){
	    		    	$cantidad = "*";
		    	echo $f->DoFolder("CORRESPONDENCIA", "/gestion/correspondencia/", $cantidad, "green");
			}
			if ($_SESSION['sadmin'] == '1' && $_SESSION['typefolder'] == '1') {
					if($_SESSION['reparto'] == 1){
					$cantidad = $f->Zerofill($c->GetTotalExpedientesSinAsignar(), 3);
					echo $f->DoFolder("REPARTO", "/gestion/reparto/", $cantidad, "green", "1");
				}
			}
			$usua = new MUsuarios;
		 	$usua->CreateUsuarios("user_id", $_SESSION['usuario']);
    	    $cantidad = $f->Zerofill($c->GetTotalExpedientesUsuario($usua->GetA_i()), 3);
    	    echo $f->DoFolder("VER TODOS MIS EXPEDIENTES", "/gestion/myfiles/", $cantidad, "green");
    		if ($c->GetExpedientesCompartidos() >= 1) {
				$cantidad = $f->Zerofill($c->GetExpedientesCompartidos(), 3);
				echo $f->DoFolder("EXPEDIENTES QUE ME HAN COMPARTIDO", "/gestion_compartir/compartidos/", $cantidad, "green");
			}
			$cantidad = $f->Zerofill($c->GetTotalFromTable("solicitudes_documentos", "where usuario_destino = '".$_SESSION['usuario']."' and estado = '0' "), 3);
		    echo $f->DoFolder("SOLICITUDES DE EXPEDIENTES", "/solicitudes_documentos/listar/", $cantidad, "green");
    		$total_exp = 0;
  			$sql = "SELECT count(*) as t FROM gestion g inner join gestion_cambio_ubicacion_archivo gcua on g.id = gcua.id_gestion WHERE gcua.estado_archivo_origen = '1' and gcua.estado = '0' UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) AND nombre_destino = '".$usua->GetA_i()."' and estado_archivo = '1' and DATE_ADD(f_recibido, INTERVAL (SELECT t_g FROM dependencias where id = tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) and gestion.dependencia_destino = '".$usua->GetRegimen()."' and  nombre_destino <> '".$usua->GetA_i()."' and estado_archivo = '1' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_g FROM dependencias where id = gestion.tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion g inner join gestion_cambio_ubicacion_archivo gcua on g.id = gcua.id_gestion WHERE gcua.estado_archivo_origen = '2' and gcua.estado = '0' UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) AND nombre_destino = '".$usua->GetA_i()."' and estado_archivo = '2' and DATE_ADD(f_recibido, INTERVAL (SELECT t_c FROM dependencias where id = tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) and gestion.dependencia_destino = '".$usua->GetRegimen()."' and  nombre_destino <> '".$usua->GetA_i()."' and estado_archivo = '2' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_c FROM dependencias where id = gestion.tipo_documento) DAY) <= DATE(NOW())";
			$chck = $con->Query($sql);
			while($row = $con->FetchAssoc($chck)){
			 	$total_exp += $row['t'];
			}
		
			$cantidad = $f->Zerofill($total_exp,3);
		    echo $f->DoFolder("EXPEDIENTES POR VENCER", "/gestion/vencimientoexpedientesarchivo/1/", $cantidad, "green");


			$tipo_d = $con->Query("select id, dependencia from dependencias where es_publico = 1 limit 0, 1");
			$tipo_dq = $con->FetchAssoc($tipo_d);
			$tipo_documento = $tipo_dq['id'];	

			$cantidadvalidar = 0;
			$sqlx = $con->Query("SELECT count(*) as t from gestion where tipo_documento = '$tipo_documento' and estado_archivo = '1'");
			while($row = $con->FetchAssoc($sqlx)){
			 	$cantidadvalidar += $row['t'];
			}

		    if ($_SESSION['ventanilla'] == "1") {
		    	echo $f->DoFolder("EXPEDIENTES POR VALIDAR", "/gestion/ventanilla/", $cantidadvalidar, "green");
		    }

		    $nsp = $con->Query("select count(*) as t from gestion_transferencias where user_transfiere = '".$usua->GetUser_id()."' and (estado = '0' or estado = '2')");
		    $nspr = $con->FetchAssoc($nsp);	

		    $nsr = $con->Query("select count(*) as t from gestion_transferencias where user_recibe = '".$usua->GetA_i()."' and estado = '0'");
			$nsrr = $con->FetchAssoc($nsr);

		    $cantidadPendientes = "<span title='Solicitudes de Transferencias Recibidas'>".$nsrr['t']."</span> - <span title='Solicitudes de Transferencias Enviadas'>".$nspr['t']."</span>";
		    echo $f->DoFolder("TRANSFERENCIAS", "/gestion_transferencias/listar/", $cantidadPendientes, "green");
	    ?>
		</div>

		<div class="bloque_principal_carpetas">
		<?php

			$MAreas = new MAreas;

			$MUsuarios_configurar_accesos = new MUsuarios_configurar_accesos;

			$query2 = $MUsuarios_configurar_accesos->ListarAreasUsuario();

			 while ($row3 = $con->FetchAssoc($query2)) {
				$MAreas->CreateAreas('id', $row3['id']);

				if( $MAreas->GetNombre() != ''){

				?>
			<div style="clear: both"></div>
			<div class="title">Carpetas del Area <b><?php echo $MAreas->GetNombre(); ?></b></div>

	
				<!--<div class="title">Carpetas del Area</div>-->
				<?
					# SERIES DOCUMENTALES 
					$object = new MAreas_dependencias;
					#$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$_SESSION['area_principal']."' and id_version = '".$_SESSION['id_trd_empresa']."' group by id_dependencia_raiz");	    

					$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$row3['id']."' and id_version = '".$_SESSION['id_trd_empresa']."' group by id_dependencia_raiz");	    
					while($row = $con->FetchAssoc($query)){
						$l = new MAreas_dependencias;
						$l->Createareas_dependencias('id', $row[id]);
						$d = new MDependencias;
						$d->CreateDependencias("id", $l->GetId_dependencia_raiz());
						
						$nombre = $d->GetNombre();
						$enlace = "/dependencias/childs/".$d->GetId()."/";
						
						$cantidad = $f->Zerofill($c->GetNocounterAreas("gestion", "id_dependencia_raiz = '".$d->GetId()."'", $row3['id']), 3);
						echo $f->DoFolder($nombre, $enlace, $cantidad);
					}

				}

			}
			?>
		</div>
		<div class="bloque_principal_carpetas">
			<div class="title">CARPETAS DE OTRAS AREAS.</div>
			<?
				# SERIES DOCUMENTALES 


				$query = $con->Query("Select dependencias.id as id 
										from dependencias inner join gestion on 
																	gestion.id_dependencia_raiz = dependencias.id 
																			WHERE 	gestion.dependencia_destino != '".$_SESSION['area_principal']."' 
																						and usuario_registra = '".$_SESSION['usuario']."' 
																								and oficina = '".$_SESSION['seccional']."' and id_version = '".$_SESSION['id_trd_empresa']."'
																									group by gestion.id_dependencia_raiz");	    

				while($row = $con->FetchAssoc($query)){
					$d = new MDependencias;
					$d->CreateDependencias("id", $row[id]);
					$nombre = $d->GetNombre();
					$enlace = "/dependencias/nochilds/".$d->GetId()."/";
					$cantidad = $f->Zerofill($c->GetNocounter("gestion", "id_dependencia_raiz = '".$d->GetId()."'" ), 3);
					echo $f->DoFolder($nombre, $enlace, $cantidad);
				}
			?>			
		</div>
			</div>
		</div>