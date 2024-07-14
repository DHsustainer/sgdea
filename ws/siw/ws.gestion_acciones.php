<?



include('headers.php');



    include_once(MODELS.DS.'UsuariosM.php');



	include_once(MODELS.DS.'GestionM.php');



	include_once(MODELS.DS.'DependenciasM.php');



	include_once(MODELS.DS.'Dependencias_tipologiasM.php');



	include_once(MODELS.DS.'Events_gestionM.php');



	include_once(MODELS.DS.'Gestion_anexosM.php');



	include_once(MODELS.DS.'Mailer_messageM.php');



	include_once(MODELS.DS.'Mailer_attachmentsM.php');



	include_once(MODELS.DS.'Mailer_from_messageM.php');



	include_once(MODELS.DS.'Mailer_loginsM.php');



	include_once(MODELS.DS.'Mailer_replysM.php');



	include_once(MODELS.DS.'Super_adminM.php');



	include_once(MODELS.DS.'Suscriptores_contactosM.php');



	include_once(MODELS.DS.'NotificacionesM.php');



	#include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	



	include_once(CONTROLLERS.DS.'consultas.php');



	class Gestion_Funciones{



		public function RegistrarActuacion($key, $id_externo, $usuario, $fecha, $title, $description) {



			global $con;



			global $c;



			global $f;



			try {



				$checkKey = $c->wscontrol($key);



				$output = array();



				if ($checkKey) {



			        $output['0'] = "logged";



			        #CODE STARTS HERE



			        $g = new MGestion;



			        $g->CreateGestion("id_servicio", $id_externo);



			        $ur = new MUsuarios;



			        $ur->CreateUsuarios('a_i', $g->GetNombre_destino());



			        $u = new MUsuarios;



			        $u->CreateUsuarios("id", $usuario);



			        $id_gestion = $g->GetId();



		        	$object = new MEvents_gestion;



					$id = $c->GetMaxIdTabla("events_gestion", "id");



					$id += 1;



					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			



					$create = $object->InsertEvents_gestion($u->GetUser_id(), $g->GetId(), $fecha, $title, $description, date("Y-m-d"), "0", date('h:i:s'), "0", "0", "0", "", 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $ur->GetUser_id(), "ev",  $id);



					$output['1'] = "1";



					$output['2'] = "Evento Creado!".$create;



					return join(",", $output );



				}else{



					$output[0] = "invalid Key";



					return join(",", $output );



				}



			}catch(Exception $e){



				$output[0] = "some Exception $e";



				return join(",", $output );



			}



	    }



	    public function EnviarCorreo($key, $id_externo, $to, $subject, $message, $attachments){



			global $con;



			global $c;



			global $f;



			try {



				$checkKey = $c->wscontrol($key);



				$output = array();



				if ($checkKey) {



			        $output['0'] = "logged";



			        #CODE STARTS HERE



					$object = new MMailer_message;



			        $g = new MGestion;



			        $g->CreateGestion("id_servicio", $id_externo);



					$u = new MUsuarios;



					$u->CreateUsuarios("a_i", $g->GetNombre_destino());



					$sID = md5($id_externo.date('Y-m-d H:i:s').$_SERVER['REMOTE_ADDR']);



					$user_ID 	= $u->GetUser_id();



					$ip 		= $_SERVER['REMOTE_ADDR'];



					$date 		= date("Y-m-d H:i:s");



					$subject_message = $subject;



					$id 	= $g->GetId();



					$tox	= $to;



					$email 	= $tox;



					$documentos = explode(";", $attachments);



					$anexos_listado = "";



					for ($i=0; $i < count($documentos) ; $i++) { 



						if ($documentos[$i] > 0) {



							$co = $con->Query("select id from gestion_anexos where id_servicio = '".trim($documentos[$i])."' ");



							$var = $con->FetchAssoc($co);



							$anexos_listado .= $var['id'].";";



						}



					}



					$gestion = new MGestion;



					$gestion->CreateGestion("id", $g->GetId());



					$id_gestion = $gestion->GetId();



					$from = $u->GetEmail();



					$Mid = $c->GetMaxIdTabla("mailer_message", 'id');



					$message_id = $Mid + 1;



					$message_id .= $from.$ip.$date;



					$message_id = md5($message_id);



					$message_id = hash ("sha256", $message_id);



					$subject = "Esto es un mensaje de datos de ".$u->GetP_nombre()." ".$u->GetP_apellido();



					$size = 0;



					$exp_day = $f->CalcularFecha(date("Y-m-d"), "2", "+");



					$from_name = $u->GetP_nombre()." ".$u->GetP_apellido();



#/*			        



					$create = $object->InsertMailer_message($message_id, $sID, $user_ID, $ip, $date, $size, $from , $subject_message, $message, $exp_day, $id_gestion, $from_name); 



					$reciepments = explode(';', $email);



					for($i = 0; $i < count($reciepments) +1; $i++){



						$email = trim($reciepments[$i]);



						if ($email != "") {



							# code...



							$token = md5($message_id.$reciepments[$i]);



							$token = hash ("sha256", $token);



							$recibir = $f->MakeButtonMail(HOMEDIR.DS.'correo'.DS.'acuse'.DS.$token.'.1'.DS, "Ver Contenido del mensaje");



							$norecibir = $f->MakeButtonMail(HOMEDIR.DS.'correo'.DS.'acuse'.DS.$token.'.2'.DS, "Rehusarse");



							



							$MPlantillas_email = new MPlantillas_email;



							$MPlantillas_email->CreatePlantillas_email('id', '4');



							$contenido_email = $MPlantillas_email->GetContenido();



							$contenido_email = str_replace("[elemento]Fecha_registro[/elemento]",   date("d-m-Y h:i:s a"),     	   $contenido_email );



							$contenido_email = str_replace("[elemento]ASUNTO[/elemento]",      $subject_message,   $contenido_email );



							$contenido_email = str_replace("[elemento]responsable[/elemento]",      $from_name,   $contenido_email );



							$contenido_email = str_replace("[elemento]BOTON_NORECIBIR[/elemento]",      $recibir,   $contenido_email );



							$contenido_email = str_replace("[elemento]BOTON_RECIBIR[/elemento]",      $norecibir,   $contenido_email );
							$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );






							$bodymessage = $contenido_email;







							$sfile= PLUGINS.DS."messages/$token.txt";			



							$fp = fopen($sfile,"w");



							fwrite($fp,$bodymessage);



							fclose($fp);



							$x = stat($sfile);



							$size = $x["size"];



							$dns = $f->GetDNS();



							$name = "";



							$to = new MMailer_from_message;



							$to->InsertMailer_from_message($Mid, $message_id, $sID, $token, $user_ID, $email, $size, $c->sql_quote($bodymessage), $c->sql_quote($body.$path), "1", $name, $dns);



							$anexos = explode(";", $anexos_listado);



							#return "-->".$anexos_listado;



							for($i = 0; $i < count($anexos); $i++){



								if($anexos[$i] != ""){



									$fielan = substr($anexos[$i], 1);



									$gestion_anexo = new MGestion_anexos;



									$gestion_anexo->CreateGestion_anexos('id', $fielan);



									$ruta = HOMEDOR.DS."app/archivos_uploads/".$gestion_anexo->GetId().DS."anexos".$gestion_anexo->GetUrl();



									$size = $gestion_anexo->GetPeso();



									$type_file = "3";



									$fn = $i;



									$imcode = md5($token.$fn);



									$imcode = hash ("sha256", $imcode);



									$totalfiles = count($anexos)-1;



									$folio = $i;



									$filename = explode("/", $ruta);



									$img_name = end($filename);



									$titles = $gestion_anexo->GetNombre();



									$atachments = new MMailer_attachments;



									$atachments->InsertMailer_attachments($message_id, $ruta, $size, $gestion_anexo->GetId(), $type_file, $titles, $i, $imcode);



									$c->SendContabilizadorDocumentos($gestion_anexo->GetCantidad(), $gestion->GetTipo_documento(), $gestion->GetId(), "CE");	



								}



							}



							$rid = $c->GetMaxIdTabla("mailer_from_message", 'id') ;



							$rp = new MMailer_replys;



							$rp->InsertMailer_replys($rid, $message_id, $token, "SENT", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");







							$exito = $c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$subject,$contenido_email,$email);







							if ($exito) {



								$output['1'] = "1";



								$output['2'] = 'Mensaje enviado a la direccion de correo: '.$email;



							}else{



								$output['1'] = "0";



								$output['2'] = 'Error al enviar el mensaje: '.$email;



							}



							$id_table = $c->GetDataFromTable("mailer_from_message", "token_ID", $token, "id", $separador = "");



							if ($id_gestion != "0") {



								$objecte = new MEvents_gestion;



								$objecte->InsertEvents_gestion($_SESSION['usuario'], $id_gestion, date("Y-m-d"), "Nuevo Mensaje de datos", "Se ha enviado un mensaje de datos a $email", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "mejd", $id_table);



							}



							$con->Query("INSERT INTO alertas (fechahora, user_id,      type, log,                               status, extra,    id_gestion,        id_act) VALUES ('".date("Y-m-d H:i:s")."', '".$email."', '1',  '".$c->GetIdLog(date("Y-m-d"))."', '0',    'newmsj', '".$id_gestion."', '".$id_table."')");



						}



			    	}



#*/



					return join(",", $output );



	    		}else{



					$output[0] = "invalid Key";



					return join(",", $output );



				}



			}catch(Exception $e){



				$output[0] = "some Exception $e";



				return join(",", $output );



			}



		}



		public function EnviarNotificacionFisica($key, $id_externo, $remitente = "", $destinatario, $direccion, $dcontenido, $attachments){



			global $con;



			global $c;



			global $f;



			try {



				$checkKey = $c->wscontrol($key);



				$output = array();



				if ($checkKey) {



			        $output['0'] = "logged";



			        #CODE STARTS HERE



			        $g = new MGestion;



			        $g->CreateGestion("id_servicio", $id_externo);



					$gestion = new MGestion;



					$gestion->CreateGestion("id", $g->GetId());



					$id_gestion = $gestion->GetId();



					$u = new MUsuarios;



					$u->CreateUsuarios("a_i", $g->GetNombre_destino());



					$user_id = $u->GetUser_id();



					$documentos = explode(";", $attachments);



					$anexos_listado = "";



					$destino = new MSuscriptores_contactos;



					$destino->CreateSuscriptores_contactos("identificacion", $destinatario);



					for ($i=0; $i < count($documentos) ; $i++) { 



						if ($documentos[$i] > 0) {



							$co = $con->Query("select id from gestion_anexos where id_servicio = '".trim($documentos[$i])."' ");



							$var = $con->FetchAssoc($co);



							$anexos_listado .= $var['id'].";";



						}



					}



					$urls_archivos = "";



					if ($anexos_listado != "") {



						$urls_archivos = "tiene anexos";



					}



					if ($remitente == "") {



						$remitente = $u->GetP_nombre()." ".$u->GetP_apellido();



					}



					$demandado = $u->GetDireccion()." / ".$u->GetTelefono()." - ".$u->GetCelular();



					$object = new MNotificaciones;



					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			



					$create = $object->InsertNotificaciones($_SESSION['usuario'], $g->GetId(), $destino->GetId(), "CC", 'me6x3P4pjiXKh2ePnnzSJn6CMkqQyPtkdtYL4tz01Kc=', date("Y-m-d"), '0', '', $direccion, "0", '', '', $destino->GetNombre());



					$max = $c->GetMaxIdTabla("notificaciones", "id");



					//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK



					$create = 1;



					if($create == '1'){



						$attachments = explode(";",$anexos_listado);



						for($i = 0; $i < count($attachments); $i++){



							if($attachments[$i] != ""){



								$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado) VALUES ('".$max."','".$attachments[$i]."', '".date("Y-m-d H:i:s")."', '0')");



								$ga = new MGestion_anexos;



								$ga->CreateGestion_anexos("id", $attachments[$i]);



								$c->SendContabilizadorDocumentos($ga->GetCantidad(), $g->GetTipo_documento(), $g->GetId(), "NT");	



							}



						}



						$nom = $remitente;



						$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);



		                $error = $cliente->getError();



		                if ($error) {



		                	$output['1'] = "0";



							$output['2'] = "<h2>Constructor error</h2><pre>" . $error . "</pre>";



		                }



		                $array = array("id" => 'me6x3P4pjiXKh2ePnnzSJn6CMkqQyPtkdtYL4tz01Kc=');



		                $result = $cliente->call("GetDetalleOperador", $array);



		                if ($cliente->fault) {



		                	$output['1'] = "0";



							$output['2'] = "<h2>Fault</h2><pre></pre>";



		                }else{



		                    $error = $cliente->getError();



		                    if ($error) {



		                    	$output['1'] = "0";



								$output['2'] = "<h2>Error</h2><pre>" . $error . "</pre>";



		                    }else {



		                        if ($result == "") {



		                            $output['1'] = "0";



									$output['2'] = "NO SE CREO EL WS";



		                        }else{



		                            $x  = explode(",", $result);



		            				$id_postal = $x[1];



		            				$nomPostal = $x[0];



		                        }



		                    }



		                }



						$con->Query("UPDATE notificaciones set nombre_postal = '".$nomPostal."'  where id = '".$max."'");



						$url = $id_postal;



						$cliente = new nusoap_client($url, true);



					    $error = $cliente->getError();



					    if ($error) {



					        $output['1'] = "0";



							$output['2'] = "<h2>Constructor error</h2><pre>" . $error . "</pre>";



					    }



					    $array = array("user_id" => $u->GetUser_id(), "message_id" => $max, "direccion" => $direccion, "rid" => $g->GetId() , "type" => "CC", "nombre" => $nom, "destinatario" => $destino->GetNombre(), "url" => $urls_archivos, "juzgado" => $entidad, "naturaleza" => $naturalezaproceso, "radicado" => $radicado, "demandado" => $demandado, "remitente" => $remitente, "anexos" => $dcontenido, "keyword" => $_SERVER['HTTP_HOST']);



					    $result = $cliente->call("InsertNotification", $array);



					    if ($cliente->fault) {



					        $output['1'] = "0";



							$output['2'] = "<h2>Fault</h2><pre></pre>";



					    }else{



					        $error = $cliente->getError();



					        if ($error) {



					            $output['1'] = "0";



								$output['2'] = "<h2>Error</h2><pre>" . $error . "</pre>";



					        }else {



								if ($result == "") {



									$output['1'] = "0";



									$output['2'] = "NO SE CREO EL WS";



								}else{



									$output['1'] = "1";



									$output['2'] = "Servicio registrado y enviado a la empresa: ".$nomPostal;



								}



					        }



					    }



					}else{



						$output['1'] = "0";



						$output['2'] = "ERROR AL REGISTRAR";



					}



					return join(",", $output );



	    		}else{



					$output[0] = "invalid Key";



					return join(",", $output );



				}



			}catch(Exception $e){



				$output[0] = "some Exception $e";



				return join(",", $output );



			}



		}



		public function GetListadoTipologias($key, $radicado = "0"){



			global $con;



			global $c;



			global $f;



			try {



				$checkKey = $c->wscontrol($key);



				$output = array();



				if ($checkKey) {



			        $output['0'] = "logged";



			        #CODE STARTS HERE



			        $g = new MGestion;



			        $g->CreateGestion("min_rad", $radicado);



			        if ($g->GetId() != "") {



			        	# code...



				        $dep = new MDependencias;



				        $dep->CreateDependencias("id", $g->GetTipo_documento());



				        $tipo = new MDependencias_tipologias;



						$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$dep->GetId()."'");



						$vector = "";



						while ($rl = $con->FetchAssoc($listado)) {



							$vector .= $rl['id']."::".$rl['tipologia'].";";



						}



						$output[1] = $vector;



					}else{



						$output[1] = "El numero de radicado consultado no existe";



					}



					return join(",", $output );



	    		}else{



					$output[0] = "invalid Key";



					return join(",", $output );



				}



			}catch(Exception $e){



				$output[0] = "some Exception $e";



				return join(",", $output );



			}



		}



}



	#$x = new Gestion;



	#$x->EnviarNotificacionFisica();



	#ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER



    $server = new soap_server();



    $server->configureWSDL("funciones", "urn:funciones");



    $server->register("Gestion_Funciones.RegistrarActuacion",



    			        array("key" => "xsd:string","id_externo" => "xsd:string","usuario" => "xsd:string","fecha" => "xsd:string","title" => "xsd:string","description" => "xsd:string"),



				        array("return" => "xsd:string"),



				        "urn:Siw.Gestion_Funciones", "urn:Siw.Gestion_Funciones#RegistrarActuacion", "rpc", "encoded", "Servicio de prueba");



	$server->register("Gestion_Funciones.EnviarCorreo",



    			        array("key" => "xsd:string","id_externo" => "xsd:string","to" => "xsd:string","subject" => "xsd:string","message" => "xsd:string","attachments" => "xsd:string"),



				        array("return" => "xsd:string"),



				        "urn:Siw.Gestion_Funciones", "urn:Siw.Gestion_Funciones#EnviarCorreo", "rpc", "encoded", "Servicio de prueba");



	$server->register("Gestion_Funciones.EnviarNotificacionFisica",



    			        array("key" => "xsd:string","id_externo" => "xsd:string","remitente" => "xsd:string","destinatario" => "xsd:string","direccion" => "xsd:string", "dcontenido" => "xsd:string", "attachments" => "xsd:string"),



				        array("return" => "xsd:string"),



				        "urn:Siw.Gestion_Funciones", "urn:Siw.Gestion_Funciones#EnviarNotificacionFisica", "rpc", "encoded", "Servicio de prueba");



	$server->register("Gestion_Funciones.GetListadoTipologias",



    			        array("key" => "xsd:string","radicado" => "xsd:string"),



				        array("return" => "xsd:string"),



				        "urn:Siw.Gestion_Funciones", "urn:Siw.Gestion_Funciones#GetListadoTipologias", "rpc", "encoded", "Servicio de prueba");



    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :'';



    $server->service($HTTP_RAW_POST_DATA);



?>