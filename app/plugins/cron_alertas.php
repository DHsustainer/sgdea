<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
require_once('nusoap/nusoap2.php');

	if (!isset($_SESSION['VAR_SESSIONES'])) {
		$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailSuscriptorKeys.wsdl", true);
        $error = $cliente->getError();
        if ($error) {
            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
        }
        $array = array("id" => $_SERVER['HTTP_HOST'], "key" => $_SESSION['user_key']);
        $result = $cliente->call("GetDataSesion", $array);
        if ($cliente->fault) {
            echo "<h2>Fault</h2><pre>";
            echo "</pre>";
        }else{
            $error = $cliente->getError();
            if ($error) {
                echo "<h2>Error</h2><pre>" . $error . "</pre>";
            }else {
                if ($result == "") {
                    echo "No se creo el WS";
                }else{
                    $x  = explode(",", $result);
                    if ($x[0] != 'errno') {
	                    $_SESSION["pzhkCSC0XMwpGMT"] = desencriptar($x[0], $_SESSION['user_key']);
						$_SESSION["kYg8omRSc1EDj3u"] = desencriptar($x[1], $_SESSION['user_key']);
						$_SESSION["1oKU35BSbQ7CG5Q"] = desencriptar($x[2], $_SESSION['user_key']);
						$_SESSION["71c029wus3yJWEN"] = desencriptar($x[3], $_SESSION['user_key']);
						$_SESSION['VAR_SESSIONES'] = true;
                    }else{
                    	$_SESSION['VAR_SESSIONES'] = false;
                    }
                }
            }
        }
    }
	if ($_SESSION['VAR_SESSIONES']) {

#CODIGO A PARTIR DE AQUI
		//Invocando archivos que seran usados en nuestro controlador generico	
		include_once('../basePaths.inc.php');
		include_once("../models/Events_gestionM.php");
		include_once("../models/Super_adminM.php");
		include_once("../models/UsuariosM.php");
		include_once("../DALC/mySql.php");
		include_once('../controller/consultas.php');
		include_once('../controller/funciones.php');	

		#include_once('../plugins/PHPMailer_5.2.4/class.phpmailer.php');	
		// Definiendo variables y conectandonos con la base de datos
		$con = new ConexionBaseDatos;
		$c = new Consultas;
		$f = new Funciones;
		$con->Connect($con);
		$c->crearLog();
		include_once('cron_sub_vencimiento_expedientes.php');

		$query = $con->Query("select * from events_gestion where fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = events_gestion.gestion_id) and grupo != '*' and elm_type not in('trexp', 'texp', 'doc', 'an', 'rad', 'comp')  group by grupo");
		echo "<table border='1'>";
		echo "	<tr>	
					<td>Para</td>
					<td>L Eventos</td>
				</tr>";

		$ausuarios = array();
		$vector_usuarios = array();

		while ($row3 = $con->FetchAssoc($query)) {
			$vector_eventos = array();
			$qeventos = $con->Query("select * from events_gestion inner join gestion on gestion.id = events_gestion.gestion_id where gestion.estado_respuesta = 'Abierto' and gestion.estado_archivo = '1' and gestion.nombre_destino = '".$row3['grupo']."' and grupo = '".$row3['grupo']."' and elm_type not in('trexp', 'texp', 'doc', 'an', 'rad', 'comp') and fecha_realizado = '0000-00-00 00:00:00' group by gestion_id, elm_type");


			echo "	<tr>
						<td>".$row3['grupo']."</td>
						<td>";
			echo "<table border= '1'>
					</tr>
						<td>Id Evento</td>
						<td>Fecha Evento</td>
						<td>Fecha 1 aviso</td>
						<td>Avisar A</td>
						<td>Crear Alerta</td>
						<td>Crear Alerta Retraso</td>
						<td>Type</td>
						<td>Gestion_id</td>
					</tr>";
			while ($rowev = $con->FetchArray($qeventos)) {
				$fecha_c = date_create($rowev['fecha']);//aca le pasas la fecha actual o ala que le queres sumar los dias.
				date_modify($fecha_c, "-".$rowev['avisar_a']." day");//sumas los dias que te hacen falta.
				$paviso = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
				$generar = false;
				$alerta_retraso = false;
				$eventos .= $rowev[0].", ";
				$id_evento = $rowev[0];
				$grupo = $rowev['grupo'];
				$seccional = $con->Result($con->Query("select seccional from usuarios where user_id = '".$rowev['user_id']."'"), 0, 'seccional');
				$area = $con->Result($con->Query("select regimen from usuarios where user_id = '".$rowev['user_id']."'"), 0, 'regimen');
				$fecha = date("Y-m-d");
				$gestion_id = $rowev["gestion_id"];
				$id_ext = $rowev[0];
				$id_evento = $rowev[0];
				if ($paviso == date("Y-m-d")) {
					$generar = true;
					$elm_type = "avne";
				}
				if ($paviso < date("Y-m-d")) {
					$alerta_retraso = true;
					$elm_type = "";
					$elm_type = "avoe";
				}
				echo "<tr>
						<td>".$rowev[0]."</td>
						<td>".$rowev['fecha']."</td>
						<td>".$paviso."</td>
						<td>".$rowev['avisar_a']."</td>
						<td>".$generar."</td>
						<td>".$alerta_retraso."</td>
						<td>".$rowev['elm_type']."</td>
						<td>".$rowev['gestion_id']."</td>
				  	</tr>";

				  	array_push($vector_eventos, $rowev[0]);

				  	$u = new MUsuarios;
				  	$u->CreateUsuarios("a_i", $grupo);

				  	$con->Query("INSERT INTO alertas (user_id, type, fechahora, status, extra, id_gestion, id_act, id_evento) VALUES ('".$u->GetUser_id()."', '1', '".date("Y-m-d H:i:s")."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");				
			}

			$u = new MUsuarios;
			$u->CreateUsuarios("a_i", $row3['grupo']);

		  	if ($u->GetNotif_usuario() == "1") {
		  		$mensaje = "";
				$mensaje .= "<h3>Hola ".$u->GetP_nombre().", <br> Estas son sus actividades para realizar el día de hoy<h3>";
				$mensaje .= "<div style='font-size:16px;padding-top:38px;font-weight:normal;margin-bottom:20px'>PENDIENTES</div>";
				$mensaje .= "<div style='margin-left:10px;'>";
				$mensaje_alerta_vencimiento = '';

				$sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0' and a.user_id = '".$u->GetUser_id()."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra not in('trexp', 'texp', 'doc', 'an', 'rad', 'comp') group by eg.id";
		        $qwa = $con->Query($sql);
		        $contact    = $con->NumRows($qwa);

		      	$sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and  a.type = '1' and a.status = '0'  and a.user_id = '".$u->GetUser_id()."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('rad') group by eg.id";
				$qwa = $con->Query($sql);
		        $contacte    = $con->NumRows($qwa);

		        $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0'  and a.user_id = '".$u->GetUser_id()."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('doc', 'an') group by eg.id";
		        $qwa = $con->Query($sql);
		        $contactd    = $con->NumRows($qwa);


		        $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra inner join gestion gx on gx.id = a.id_gestion where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0'  and a.user_id = '".$u->GetUser_id()."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('comp') group by eg.id";
		        $qwa = $con->Query($sql);
		        $contactc    = $con->NumRows($qwa);

		        $MSolicitudes_documentos = new MSolicitudes_documentos;
		        $qwa = $MSolicitudes_documentos->ListarSolicitudes_documentos("WHERE usuario_destino ='".$u->GetUser_id()."' and estado = '0'");
		        $contvenc = $con->NumRows($qwa);

		        $sql = "SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.nombre_destino = (select a_i from usuarios where user_id = '".$u->GetUser_id()."') and $comparacion e.dias > 0";
		        $qwa = $con->Query($sql);
		        $continact  =  $con->NumRows($qwa);

		        $MGestion_anexos_firmas = new MGestion_anexos_firmas;
		        $qwa = $MGestion_anexos_firmas->ListarGestion_anexos_firmas("where usuario_firma = '".$u->GetUser_id()."' and estado_firma = '0'");
		        $contfirmas   =  $con->NumRows($qwa);

		        $MSolicitudes_documentos = new MSolicitudes_documentos;
		        $qwa = $MSolicitudes_documentos->ListarSolicitudes_documentos("WHERE usuario_destino ='".$u->GetUser_id()."' and estado = '0'");
		        $contsol    = $con->NumRows($qwa);

		        $newemails = $c->GetNewMailsNumber();

		        $MSolicitudes_documentos = new MSolicitudes_documentos;
		        $qws = $MSolicitudes_documentos->ListarSolicitudes_documentos("WHERE usuario_destino ='".$u->GetUser_id()."' and estado = '0'" ,"order by fecha_solicitud","");
		        $consolicitudes = $con->NumRows($qws);


		        $nsp = $con->Query("select count(*) as t from gestion_transferencias where user_transfiere = '".$u->GetUser_id()."' and (estado = '0' or estado = '2')");
		        $nspr = $con->FetchAssoc($nsp); 

		        $nsr = $con->Query("select count(*) as t from gestion_transferencias where user_recibe = '".$u->GetA_i()."' and estado = '0'");
		        $nsrr = $con->FetchAssoc($nsr);

		        $cantidadPendientes = "<span title='Solicitudes de Transferencias: Recibidas - Enviadas'>".$nsrr['t']." - ".$nspr['t']."</span>";


		        $total_exp = 0;
		        $sql = "SELECT count(*) as t FROM gestion g inner join gestion_cambio_ubicacion_archivo gcua on g.id = gcua.id_gestion WHERE gcua.estado_archivo_origen = '1' and gcua.estado = '0' UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) AND nombre_destino = '".$u->GetA_i()."' and estado_archivo = '1' and DATE_ADD(f_recibido, INTERVAL (SELECT t_g FROM dependencias where id = tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) and gestion.dependencia_destino = '".$u->GetRegimen()."' and  nombre_destino <> '".$u->GetA_i()."' and estado_archivo = '1' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_g FROM dependencias where id = gestion.tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion g inner join gestion_cambio_ubicacion_archivo gcua on g.id = gcua.id_gestion WHERE gcua.estado_archivo_origen = '2' and gcua.estado = '0' UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) AND nombre_destino = '".$u->GetA_i()."' and estado_archivo = '2' and DATE_ADD(f_recibido, INTERVAL (SELECT t_c FROM dependencias where id = tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) and gestion.dependencia_destino = '".$u->GetRegimen()."' and  nombre_destino <> '".$u->GetA_i()."' and estado_archivo = '2' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_c FROM dependencias where id = gestion.tipo_documento) DAY) <= DATE(NOW())";

		        $chck = $con->Query($sql);
		        while($row = $con->FetchAssoc($chck)){
		            $total_exp += $row['t'];
		        }

		        $cantidad = $f->Zerofill($total_exp,3);

		        $cantidadvalidar = 0;
		        $myid = $c->GetDataFromTable("usuarios", "user_id", $u->GetUser_id(), "a_i", $separador = " ");

		        $object = new MGestion; 
		        // CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
		        // DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
		        $tipo_d = $con->Query("select id, dependencia from dependencias where es_publico = 1");

		        $tipo_documento = "";
		        $i = 0;
		        while ($row = $con->FetchAssoc($tipo_d)) {
		            $i++;
		            if ($i < $con->NumRows($tipo_d)) {
		                $tipo_documento .= $row['id'].", "; 
		            }else{
		                $tipo_documento .= $row['id'];  
		            }
		            # code...
		        }
		        $queryxr = $object->ListarGestion("WHERE tipo_documento in ($tipo_documento) and estado_archivo = '1' and estado_respuesta = 'Pendiente'");   
		        $cantidadvalidar = $con->NumRows($queryxr);

				$description = "<table width='300px' border='0'>
									<tr>
										<td colspan='2' align='center'><b>Actividades de los Documentos</b></td>
									</tr>
									<tr>
										<td width='260px'>Documentos Nuevos</td>
										<td width='40px'>'.$contactd.'</td>
									</tr>
									<tr>
										<td>Documentos Para Firmar</td>
										<td>'.$contfirmas.'</td>
									</tr>
									<tr>
										<td colspan='2' align='center'><b>Actividades de los Expedientes</b></td>
									</tr>
									<tr>
										<td>Actividades Nuevas</td>
										<td>'.$contact.'</td>
									</tr>
									<tr>
										<td>Expedientes Nuevos</td>
										<td>'.$contacte.'</td>
									</tr>
									<tr>
										<td>Expedientes Compartidos</td>
										<td>'.$contactc.'</td>
									</tr>
									<tr>
										<td>Expedientes Inactivos</td>
										<td>'.$continact.'</td>
									</tr>
									<tr>
										<td>Expedientes Para Archivar</td>
										<td>'.$cantidad.'</td>
									</tr>
									<tr>
										<td>Solicitudes de Expedientes</td>
										<td>'.$consolicitudes.'</td>
									</tr>
									<tr>
										<td>Pendientes Por Validar (WEB)</td>
										<td>'.$cantidadvalidar.'</td>
									</tr>
									<tr>
										<td>Transferencias Pendientes</td>
										<td>'.$cantidadPendientes.'</td>
									</tr>       
								</table>";
				
					$mensaje_alerta_vencimiento .= "	
						<div $title style='".$bcolor."; background-color:#FFF; border-bottom: 1px solid #EEE; padding-left: 10px; padding-right: 10px; margin-bottom:7px; '>
							<div style='line-height:31px;'>
								<div style='float:left'>".ucwords(strtolower($title2))."</div>
								<div style='float:right'><a style='color:#1579C4'  href='".HOMEDIR."/gestion/vencimientoexpedientesarchivo/$archivo/' target='_blank'>Ver</a></div>
								<div style='clear:both'></div>
							</div>
							<div style='font-size:10px; color:#1579C4; line-height:10px; padding-left:10px; padding-right:10px'>Evento para realizar de inmediato.</div>
							<div style='font-size:10px; color:#BBB; line-height:14px; padding:10px'>".$description."</div>
						</div>
					";
				}

				$mensaje .= $mensaje_alerta_vencimiento;

				$mensaje .= "</div>";
				$message =  $mensaje."<br><br>Si ya no deseas recibir estos emails, los puedes desactivar en la configuración de tu perfil en la opción \"Deseo recibir correos de los movimientos generados en mi cuenta.\"";
				$subject = date("M d")." Tienes $s Actividades Programadas";
				$from = CONTACTMAIL;
				$MPlantillas_email = new MPlantillas_email;
				$MPlantillas_email->CreatePlantillas_email('id', '11');
				$contenido_email = $MPlantillas_email->GetContenido();
				$contenido_email = str_replace("###TEXTO AQUI###",      $message,     $contenido_email );
				$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
				

				
				#$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$subject,$contenido_email,$u->GetEmail());
				
				echo $message."<hr>";
		  	}
			echo "</table></td></tr>";
	#	}
		echo "</table>";
		

	#########################################################################################
	############### FUNCION NUEVA PARA ENVÍO DE NOTIFICACIONES AL CORREO ####################
	#########################################################################################
	exit;
		
	}else{
		echo "la sesion ya estaba abierta";
	}

	function desencriptar($cadena, $key){
	    return $cadena;
	}
?>