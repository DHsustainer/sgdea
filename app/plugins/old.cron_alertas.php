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

		//Invocando archivos que seran usados en nuestro controlador generico	
		include_once('../basePaths.inc.php');
		include_once("../models/Events_gestionM.php");
		include_once("../models/Super_adminM.php");
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


		$query = $con->Query("select * from events_gestion where fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = events_gestion.gestion_id) group by grupo");

		echo "<table border='1'>";

		echo "	<tr>	

					<td>Para</td>

					<td>L Eventos</td>

				</tr>";

		while ($row3 = $con->FetchAssoc($query)) {

			$qeventos = $con->Query("select * from events_gestion where grupo = '".$row3['grupo']."' and fecha_realizado = '0000-00-00 00:00:00'");

	/*		
			echo "select * from events_gestion where grupo = '".$row3['grupo']."' and fecha_realizado = '0000-00-00 00:00:00'";


	*/

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

					</tr>";

			$eventos = "";

			while ($rowev = $con->FetchAssoc($qeventos)) {

				$fecha = date("Y-m-d");

				$fecha_c = date_create($rowev['fecha']);//aca le pasas la fecha actual o ala que le queres sumar los dias.

				date_modify($fecha_c, "-".$rowev['avisar_a']." day");//sumas los dias que te hacen falta.

				$paviso = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

				$generar = false;

				$alerta_retraso = false;

				$eventos .= $rowev['id'].", ";

				$id_evento = $rowev['id'];

				$grupo = $rowev['grupo'];

				$seccional = $con->Result($con->Query("select seccional from usuarios where user_id = '".$rowev['user_id']."'"), 0, 'seccional');

				$area = $con->Result($con->Query("select regimen from usuarios where user_id = '".$rowev['user_id']."'"), 0, 'regimen');

				$fecha = date("Y-m-d");

				$gestion_id = $rowev["gestion_id"];

				$id_ext = $rowev['id'];

				$id_evento = $rowev['id'];

				if ($paviso == date("Y-m-d")) {

					$generar = true;

					$elm_type = "avne";

				}

				if ($paviso < date("Y-m-d")) {

					$alerta_retraso = true;

					$elm_type = "";

					$elm_type = "avoe";

				}

	/*			

	*/

				echo "<tr>

						<td>".$rowev['id']."</td>

						<td>".$rowev['fecha']."</td>

						<td>".$paviso."</td>

						<td>".$rowev['avisar_a']."</td>

						<td>".$generar."</td>

						<td>".$alerta_retraso."</td>

				  </tr>";

			}

			echo "</table></td></tr>";

		}

		echo "</table>";

		#echo '<div><b>Asunto: </b>Tareas Para realizar Hoy '.date("M d").'</div>';

		#echo $f->BodyMail($eventos);

	#########################################################################################

	############### FUNCION NUEVA PARA ENVÍO DE NOTIFICACIONES AL CORREO ####################

	#########################################################################################

		$query = $con->Query("select * from events_gestion where fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = events_gestion.gestion_id) group by grupo");

		$vector_usuarios = array();

		$vector_eventos = array();

		while ($row = $con->FetchAssoc($query)) {

			$qeventos = $con->Query("select * from events_gestion where grupo = '".$row['grupo']."' and fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = events_gestion.gestion_id)");

			$eventos = "";

			while ($rowev = $con->FetchAssoc($qeventos)) {

				$fecha = date("Y-m-d");

				$fecha_c = date_create($rowev['fecha']);//aca le pasas la fecha actual o ala que le queres sumar los dias.

				date_modify($fecha_c, "-".$rowev['avisar_a']." day");//sumas los dias que te hacen falta.

				$paviso = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

				$generar = false;

				$alerta_retraso = false;

				$eventos .= $rowev['id'].", ";

				$id_evento = $rowev['id'];

				$grupo = $rowev['grupo'];

				$seccional = $con->Result($con->Query("select seccional from usuarios where user_id = '".$rowev['user_id']."'"), 0, 'seccional');

				$area = $con->Result($con->Query("select regimen from usuarios where user_id = '".$rowev['user_id']."'"), 0, 'regimen');

				$fecha = date("Y-m-d");

				$gestion_id = $rowev["gestion_id"];

				$estadoarchivo = $c->GetDataFromTable("gestion",  "id", $gestion_id, "estado_archivo", "");

				$id_ext = $rowev['id'];

				$id_evento = $rowev['id'];

				if ($paviso == date("Y-m-d")) {

					$generar = true;

					$elm_type = "avne";

				}

				if ($paviso < date("Y-m-d")) {

					$alerta_retraso = true;

					$elm_type = "";

					$elm_type = "avoe";

				}

				if ($rowev['elm_type'] == "vexp") {

					$elm_type = "vexp";

				}

				if ($generar || $alerta_retraso ) {

					# code...

					if ($grupo == "*") {

						$q = $con->Query("Select * from usuarios where seccional = '".$seccional."' and regimen = '".$area."' and estado = '1' ");

						while ($roweval = $con->FetchAssoc($q)) {

							if ($estadoarchivo == "1") {

								# code...

								$con->Query("INSERT INTO alertas (user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".$roweval['user_id']."', '0', '".date("Y-m-d H:i:s")."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");

								if (!in_array($roweval['user_id'], $vector_usuarios)) {

									array_push($vector_usuarios, $roweval['user_id']);

								}

								$buscarid = array_search($roweval['user_id'], $vector_usuarios);
								$vactual = $vector_eventos[$buscarid];
								$vactual .= $id_evento.";";
								$vector_eventos[$buscarid] = $vactual;

							}

						}

					}elseif ($grupo == "areaboss") {

						$q = $con->Query("Select * from usuarios where seccional = '".$seccional."' and regimen = '".$area."' and estado = '1' and IsAdministrador = '1' ");

						while ($roweval = $con->FetchAssoc($q)) {

							if ($estadoarchivo == "1") {

								$con->Query("INSERT INTO alertas (user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".$roweval['user_id']."', '1', '".date("Y-m-d H:i:s")."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");

								if (!in_array($roweval['user_id'], $vector_usuarios)) {

									array_push($vector_usuarios, $roweval['user_id']);

								}

								$buscarid = array_search($roweval['user_id'], $vector_usuarios);

								$vactual = $vector_eventos[$buscarid];

								$vactual .= $id_evento.";";

								$vector_eventos[$buscarid] = $vactual;

							}

						}

					}else{

						$q = $con->Query("Select * from usuarios where a_i = '$grupo' or (seccional = '".$seccional."' and regimen = '".$area."' and IsAdministrador = '1' )");

						while ($roweval = $con->FetchAssoc($q)) {

							if ($estadoarchivo == "1") {

								$con->Query("INSERT INTO alertas (user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".$roweval['user_id']."', '1', '".date("Y-m-d H:i:s")."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");

								if (!in_array($roweval['user_id'], $vector_usuarios)) {

									array_push($vector_usuarios, $roweval['user_id']);

								}

								$buscarid = array_search($roweval['user_id'], $vector_usuarios);

								$vactual = $vector_eventos[$buscarid];

								$vactual .= $id_evento.";";

								$vector_eventos[$buscarid] = $vactual;

							}

						}

					}

				}

			}

		}


		for ($i=0; $i < count($vector_usuarios) ; $i++) { 

			$s = 0;

			$recibo = $c->GetDataFromTable("usuarios", "user_id", $vector_usuarios[$i], "notif_usuario", $separador = " ");

			#echo "Usuario: $vector_usuarios[$i], Estado: $recibo <br>";
			if($recibo == "1") {

				$mensaje = "";

				$mensaje .= "Hola, ".$c->GetDataFromTable("usuarios", "user_id", $vector_usuarios[$i], "p_nombre, p_apellido", $separador = " ")."<br> Estas son sus actividades para realizar el día de hoy";

				$mensaje .= "<div style='font-size:16px;padding-top:38px;font-weight:normal;margin-bottom:20px'>PENDIENTES</div>";

				$mensaje .= "<div style='margin-left:10px;'>";

				$mensaje_alerta_vencimiento = '';

				$query3 = $con->Query("select * from alertas where (extra = 'aveg' or extra = 'aveg' or extra = 'avecm' or extra = 'avehm') and status = 0 and user_id = '".$vector_usuarios[$i]."' group by extra,user_id");

				while ($row3 = $con->FetchAssoc($query3)) {

					$bcolor = "border-left: 7px solid #DF0209;";

					if($row3['extra'] == 'aveg'){

						$title = 'title = "Vencimiento de Expedientes de Archivo Gestión"';

						$title2 = "Vencimiento de Expedientes de Archivo Gestión";

						$archivo = '1';

						$description = 'Expedientes en Archivo Gestión que deben pasar a Archivo Central por vencimiento.';

					}

					if($row3['extra'] == 'avec'){

						$title = 'title = "Vencimiento de Expedientes de Archivo Cental"';

						$title2 = "Vencimiento de Expedientes de Archivo Cental";

						$archivo = '2';

						$description = 'Expedientes en Archivo Central que deben pasar a Archivo Historico por vencimiento.';

					}

					if($row3['extra'] == 'avecm'){

						$title = 'title = "Expedientes por recibir en Archivo Cental"';

						$title2 = "Expedientes por recibir en Archivo Cental";

						$archivo = '11';

						$description = 'Expedientes que debes aceptar o rechazar en el Archivo Cental.';

					}

					if($row3['extra'] == 'avehm'){

						$title = 'title = "Expedientes por recibir en Archivo Historico"';

						$title2 = "Expedientes por recibir en Archivo Historico";

						$archivo = '22';

						$description = 'Expedientes que debes aceptar o rechazar en el Archivo Historico.';

					}

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

				$event = explode(";", $vector_eventos[$i]);

					for ($j=0; $j < count($event) ; $j++) { 
						if ($event[$j] != "") {
							$s++;
							$qevuno = $con->Query("select id, fecha, title, description, grupo, gestion_id, elm_type, time from events_gestion where id = '".$event[$j]."'");
							while ($ev = $con->FetchAssoc($qevuno)) {
								if ($ev['elm_type'] == "vexp") {
									$bcolor = "border-left: 7px solid #DF0209;";
									$title = 'title = "Vencimiento de un Expediente"';
								}else{
									if ($ev['grupo'] == "*") {
										$bcolor = "border-left: 7px solid #009CDE;";
										$title = 'title = "Evento Grupal"';
									}else{
										$bcolor = "border-left: 7px solid #66FF00;";
										$title = 'title = "Evento Primario"';
									}
								}
								if ($ev['fecha'] < date("Y-m-d")) {
									$bcolor = "border-left: 7px solid #FF9900;";
									$title = 'title = "El Evento está Vencido"';
								}
								$hora = date("H:i:s");
								if($ev["time"] != "00:00:00") {
									$hora = $ev["time"];
								}
								$qide = $con->Query("select id from alertas where id_evento = '".$ev['id']."' and extra = '".$ev['elm_type']."' ");
								$idalerta = $con->Result($qide, 0, "id");

								$mensaje .= "	
												<div $title style='".$bcolor."; background-color:#FFF; border-bottom: 1px solid #EEE; padding-left: 10px; padding-right: 10px; margin-bottom:7px; '>
													<div style='line-height:31px;'>
														<div style='float:left'>".ucwords(strtolower($ev['title']))."</div>
														<div style='float:right'><a style='color:#1579C4'  href='".HOMEDIR."/gestion/ver/".$ev['gestion_id']."/anexos/$idalerta/' target='_blank'>Ver</a></div>
														<div style='clear:both'></div>
													</div>
													<div style='font-size:10px; color:#1579C4; line-height:10px; padding-left:10px; padding-right:10px'>Evento Programado Para ".$f->nicetime($ev['fecha']." ".$hora)."</div>
													<div style='font-size:10px; color:#BBB; line-height:14px; padding:10px'>".$ev['description']."</div>
												</div>
											";
							}
						}
					}
				$mensaje .= "<div style='margin-top:20px; '><a style='color:#1579C4' href='".HOMEDIR."/login/' target='_blank'>Ver Todas...</a></div>";
				$mensaje .= "</div>";
				$message =  $mensaje."<br><br>Si ya no deseas recibir estos emails, los puedes desactivar en la configuración de tu perfil en la opción \"Deseo recibir correos de los movimientos generados en mi cuenta.\"";
				$subject = date("M d")." Tienes $s Actividades Programadas";
				$from = CONTACTMAIL;
				$MPlantillas_email = new MPlantillas_email;
				$MPlantillas_email->CreatePlantillas_email('id', '11');
				$contenido_email = $MPlantillas_email->GetContenido();
				$contenido_email = str_replace("###TEXTO AQUI###",      $message,     $contenido_email );
				$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
				
				$emailusuario = $c->GetDataFromTable("usuarios", "user_id", $vector_usuarios[$i], "email", $separador = " ");
				
				$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$subject,$contenido_email,$emailusuario);
				
				echo $message."<hr>";
				

			}else{
				echo "no envio correo<hr>";
			}		
		}
	}else{
		echo "la sesion ya estaba abierta";
	}
	function desencriptar($cadena, $key){
	    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	    return $decrypted;  //Devuelve el string desencriptado
	}
?>