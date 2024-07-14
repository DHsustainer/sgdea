<?
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '0');
	date_default_timezone_set("America/Bogota");
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'ContactosM.php');
	include_once(MODELS.DS.'Contactos_direccionM.php');
	include_once(MODELS.DS.'Contactos_emailsM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_attachmentsM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Anexos_carpetaM.php');
	include_once(MODELS.DS.'Folder_ciudadanoM.php');
	include_once(MODELS.DS.'Mailer_loginsM.php');
	include_once(MODELS.DS.'NotificacionesM.php');
	include_once(MODELS.DS.'MemorialesM.php');	
	include_once(MODELS.DS.'Mailer_replysM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'Demandado_procesoM.php');
	include_once(MODELS.DS.'Demandante_proceso_juridicoM.php');
	include_once(MODELS.DS.'Correos_contactosM.php');
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');
	include_once(MODELS.DS.'EventsM.php');
	include_once(MODELS.DS.'Contactos_telefonosM.php');
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	
	include_once(PLUGINS.DS.'parse.php');	
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql_msj.php');
	include_once(PLUGINS.DS.'nusoap/nusoap.php');
	include_once('consultas.php');
	include_once('funciones.php');	
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Gestion_compartirM.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'Dependencias_alertasM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Big_dataM.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Documentos_gestionM.php');
	include_once(MODELS.DS.'Dependencias_documentosM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');
	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'SeccionalM.php');	
	require_once(PLUGINS.DS.'phpqrcode/qrlib.php');
	#include ("lib/ClaseNotificaciones.php");
	#include ("lib/ClaseDemandado.php");
	#include ("lib/ClaseDemandanteJuridico.php");
	date_default_timezone_set('America/Bogota');		
	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	// Llamando al objeto a controlar		
	$ob = new CCorreos;
	$object = new MMailer_message;
	$c = new Consultas;
	$f = new Funciones;
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('proceso_id', 'nombre', 'apellido', 'type');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['proceso_id']), $c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['apellido']), $c->sql_quote($_REQUEST['type']));	
	// DEFINIMOS LOS ESTADOS DE SALIDA
	$output = array('registro actualizado', 'no se pudo actualizar'); 
	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
	$constrain = 'WHERE id = '.$_REQUEST['id'];
		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
		if($c->sql_quote($_REQUEST['action']) == 'inbox' || $c->sql_quote($_REQUEST['action']) == 'sent' || $c->sql_quote($_REQUEST['action']) == 'archived' || $c->sql_quote($_REQUEST['action']) == 'nuevo' || $c->sql_quote($_REQUEST['action']) == 'ver' || $c->sql_quote($_REQUEST['action']) == 'veracuse')
			$ob->VistaListar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['action']));	
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
#		elseif()	
#			$ob->VerMessage($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'enviar'){
			$tar = explode(";", $_POST["to"]);
			for ($i=0; $i < count($tar) ; $i++) { 
				$ob->Insertar($c->sql_quote($_REQUEST["p_id"]), $c->sql_quote($tar[$i]), $c->sql_quote($_REQUEST["subject"]), $c->sql_quote($_POST['descripcion']), $c->sql_quote($_REQUEST["anexos_listado"]), $c->sql_quote($_REQUEST["archivos_anexos_listado"]), $c->sql_quote($_REQUEST["titulos_anexos_listado"]), $c->sql_quote($_REQUEST["deadline"]), $c->sql_quote($_REQUEST["folder_id_search"]));
				# code...
			}
#			print_r($_REQUEST);
		}elseif($c->sql_quote($_REQUEST['action']) == 'enviarp'){
			$exito = $c->fnEnviaEmailGlobal2(CONTACTMAIL,PROJECTNAME,"Prueba concepto envio email","esto es una prueba dle envio del email",'sanderkdna@gmail.com');
			echo $exito; 
		}elseif ($c->sql_quote($_REQUEST['action']) == 'respondermensaje') {
			// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
			$ar2 = array('details', 'subject');
			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
			$ar1 = array($c->sql_quote($_REQUEST["mytextarea"]), $c->sql_quote($_REQUEST["newsubject"]));	
			// DEFINIMOS LOS ESTADOS DE SALIDA
			$output = array('Respuesta Enviada', 'No se pudo enviar la respuesta'); 
			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
			$constrain = 'WHERE receiver_token = "'.$c->sql_quote($_REQUEST["sid"]).'"';
			$r = new MMailer_Replys;
			$rs = $r->UpdateMailer_replys($constrain, $ar2, $ar1, $output);
			echo $rs;
#			$ob->ResponderMensaje(, , );
		}
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		elseif($c->sql_quote($_REQUEST['action']) == 'acuse')
			$ob->AcuseRecibo($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == 'enviaram')
			$ob->EnviarMensajeria($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['dir']));
		elseif ($c->sql_quote($_REQUEST['action']) == 'archivar')
			$ob->Archivar($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == 'archivar_todos')
			$ob->ArchivarTodos($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == "autofillcontats")
			$ob->GetFilterFolders($c->sql_quote($_REQUEST['dtf']));
		elseif ($c->sql_quote($_REQUEST['action']) == 'cambiarip') 
			$ob->cambiarIp($c->sql_quote($_REQUEST['lat']), $c->sql_quote($_REQUEST['lon']), $c->sql_quote($_REQUEST['token']));
		elseif ($c->sql_quote($_REQUEST['action']) == 'alterdata') 
			$ob->AltData( $c->sql_quote($_REQUEST['altdata']) , $c->sql_quote($_REQUEST['token']) );
		elseif ($c->sql_quote($_REQUEST['action']) == 'geolocation') 
			$ob->geolocation( $c->sql_quote($_REQUEST['latitud']) , $c->sql_quote($_REQUEST['longitud']) , $c->sql_quote($_REQUEST['token']) );
		elseif ($c->sql_quote($_REQUEST['action']) == "mini_all")
			$ob->Miniall($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == "mini_sent")
			$ob->Minisent($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == "mini_new")
			$ob->Mininew($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == "mini_read")
			$ob->MiniRead($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == "EnviarDocumentosCorreo")
			$ob->EnviarDocumentosCorreo();
		elseif ($c->sql_quote($_REQUEST['action']) == "EnviarPorQR")
			$ob->EnviarPorQR();
		elseif ($c->sql_quote($_REQUEST['action']) == "exportarcorreo")
			$ob->ExportarCorreo($c->sql_quote($_REQUEST['id']));
		else
			$ob->VistaListar($c->sql_quote($_REQUEST['id']), "inbox");	
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CCorreos extends MainController{
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar($id = "", $action = "inbox"){
			// CREANDO UN NUEVO MODELO			
			global $con;
			global $c;
			
			global $object;
			global $f;
			$idx = $id;
			$arr = explode(".", $id);
			$id = $arr[0];
			$pid = $arr[1];
			
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Bandeja de Correos");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'mailer_message/default.php');	   			
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar(){
			//CARGA EL TEMPLATE
			$pagina = $this->load_template('Crear Contactos');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'contactos/FormInsertContactos.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		function AcuseRecibo($mid){
			//CARGA EL TEMPLATE
			$pagina = $this->load_template_limpia('Lectura Mensaje');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'mailer_message/acuse.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}
		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS		
		function Insertar($pid, $to, $subject, $message, $anexos_listado, $archivos_anexos_listado, $titulos_anexos_listado, $deadline, $folder_id_search){
			// DEFINIENDO EL OBJETO		
		#	echo $to;
			$object = new MMailer_message;
			global $con;
			global $c;
			global $f;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
	#		$create = $object->InsertMailer_message($message_id, $sID, $user_ID, $ip, $date, $size, $from_nom, $subject, $message, $exp_day, $p_id, $name);
			$sID 		= $_SESSION["SID"];
			$user_ID 	= $_SESSION["usuario"];
			$ip 		= $_SERVER['REMOTE_ADDR'];
			$date 		= date("Y-m-d H:i:s");
			$subject_message = $subject;
			$id 	= $pid;
			$tox	= $to;
			$email 	= $tox;
		// INFORMACION DEL USUARIO ///////////////
			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $user_ID);
		//////////////////////////////////////////
			$id_gestion = "0";
			if ($folder_id_search != "") {
				$gestion = new MGestion;
				$gestion->CreateGestion("id", $folder_id_search);
				$id_gestion = $gestion->GetId();
			}
		//////////////////////////////////
			$from = $u->GetEmail();
			$Mid = $c->GetMaxIdTabla("mailer_message", 'id');
			$message_id = $Mid + 1;
			$message_id .= $from.$ip.$date;
			$message_id = md5($message_id);
			$message_id = hash ("sha256", $message_id);
			$subject = "Esto es un mensaje de datos de ".$u->GetP_nombre()." ".$u->GetP_apellido();
			$size = 0;
			$exp_day = $f->CalcularFecha(date("Y-m-d"), $deadline, "+");
			$from_name = $u->GetP_nombre()." ".$u->GetP_apellido();
			  		#  $object->InsertMailer_message($message_id, $sID, $user_ID, $ip, $date, $size, $from_nom, $subject, $message, $exp_day, $p_id, $name);
			$create = $object->InsertMailer_message($message_id, $sID, $user_ID, $ip, $date, $size, $from , $subject_message, $message, $exp_day, $id_gestion, $from_name); 
			
			$reciepments = explode(';', $email);
			for($i = 0; $i < 1; $i++){
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
					$contenido_email = str_replace("[elemento]observacion[/elemento]",      $gestion->GetObservacion(),   $contenido_email );
					$contenido_email = str_replace("[elemento]rad_externo[/elemento]",      $gestion->GetRadicado(),   $contenido_email );


					$contenido_email2 = $MPlantillas_email->GetContenido();
					$contenido_email2 = str_replace("[elemento]Fecha_registro[/elemento]",   date("d-m-Y h:i:s a"),     	   $contenido_email2 );
					$contenido_email2 = str_replace("[elemento]observacion[/elemento]",      $gestion->GetObservacion(),   $contenido_email2 );
					$contenido_email2 = str_replace("[elemento]rad_externo[/elemento]",      $gestion->GetRadicado(),   $contenido_email2 );
					$contenido_email2 = str_replace("[elemento]responsable[/elemento]",      $from_name,   $contenido_email2 );
					#$contenido_email2 = str_replace("[elemento]BOTON_NORECIBIR[/elemento]",      $recibir,   $contenido_email);
					#$contenido_email2 = str_replace("[elemento]BOTON_RECIBIR[/elemento]",      $norecibir,   $contenido_email);
					$contenido_email2 = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );


					$bodymessage = $contenido_email;
					$bodymessage2 = $contenido_email2;

					$sfile= PLUGINS.DS."messages/$token.txt";			
					$fp = fopen($sfile,"w");
					fwrite($fp,$bodymessage);
					fclose($fp);
					$x = stat($sfile);
					$size = $x["size"];
					$dns = $f->GetDNS();
					$name = "";
					$to = new MMailer_from_message;
					$to->InsertMailer_from_message($Mid, $message_id, $sID, $token, $user_ID, $email, $size, $c->sql_quote($bodymessage2), $c->sql_quote($body.$path), "1", $name, $dns);
					$adjuntos = explode(";", $archivos_anexos_listado);
					$anexos = explode(";", $anexos_listado);
					for($i = 0; $i < count($adjuntos); $i++){
						if($adjuntos[$i] != ""){
							$fielan = substr($anexos[$i], 1);
							$ruta = $adjuntos[$i];
							$x = @stat($ruta);
							$size = $x["size"];
							$type_file = "3";
							$fn = $i;
							$imcode = md5($token.$fn);
							$imcode = hash ("sha256", $imcode);
							$totalfiles = count($adjuntos)-1;
							$folio = $i;
							$filename = explode("/", $ruta);
							$img_name = end($filename);
							$gestion_anexo = new MGestion_anexos;
							// LO CREAMOS 			
							$gestion_anexo->CreateGestion_anexos('id', $fielan);
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
						echo 'Mensaje enviado a la direccion de correo: '.$email;
					}else{
						echo 'No se pudo enviar el mensaje a la direccion de correo: '.$email;
					}
					$id_table = $c->GetDataFromTable("mailer_from_message", "token_ID", $token, "id", $separador = "");
					if ($id_gestion != "0") {
						$objecte = new MEvents_gestion;
						// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
						/*
							InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))
						*/
						$objecte->InsertEvents_gestion($_SESSION['usuario'], $id_gestion, date("Y-m-d"), "Nuevo Mensaje de datos", "Se ha enviado un mensaje de datos a $email", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "mejd", $id_table);
					}
					$con->Query("INSERT INTO alertas 
													   (fecha_hora, user_id,      type, log,                               status, extra,    id_gestion,        id_act) 
												VALUES ('".date("Y-m-d H:i:s")."', '".$email."', '1',  '".$c->GetIdLog(date("Y-m-d"))."', '0',    'newmsj', '".$id_gestion."', '".$id_table."')");
				}
			}
		}
		function EnviarDocumentosCorreo(){
			global $con;
			global $f;
			global $c;
			$vcampos_reporte = $_REQUEST["gestion"];
			$campos_reporte = implode(',',$vcampos_reporte);
			$arr_campos = explode(",", $campos_reporte);
			#print_r($arr_campos);
			for ($i=0; $i < count($arr_campos) ; $i++) { 
				$pid = $arr_campos[$i];
				$anexos_listado = ";";
				$archivos_anexos_listado = ";";
				$titulos_anexos_listado = "";
				$deadline = "2";
				$folder_id_search = $arr_campos[$i];
				$qsus = $con->Query("select suscriptor_id from gestion where id = '".$pid."'");
				$arex = $con->Result($qsus, 0, 'suscriptor_id');
				$objectx = new MSuscriptores_contactos;;
				$objectx->CreateSuscriptores_contactos("id", $arex);
				$SSC = new MSuscriptores_contactos_direccion;
				$query = $SSC->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$objectx -> GetId()."'");	    
				$to = $con->Result($query, 0, 'email');
				$subject = "Mensaje de Datos del expediente";
				$message = "Sin mensaje";
				$docle = $con->Query("select * from gestion_anexos where gestion_id = '".$pid."' and (estado = '1' or estado = '3') and is_publico = '1'");
				while ($xt = $con->FetchAssoc($docle)) {
					$anexos_listado = "a".$xt["id"].";";
					$archivos_anexos_listado = HOMEDIR.DS."app/archivos_uploads/gestion/".$pid.DS."anexos".DS.$xt["url"].";";
				}
				$this->Insertar($pid, $to, $subject, $message, $anexos_listado, $archivos_anexos_listado, $titulos_anexos_listado, $deadline, $folder_id_search);
			}
		}
		function EnviarPorQR(){
			global $con;
			global $f;
			global $c;
			$vcampos_reporte = $_REQUEST["gestion"];
			$campos_reporte = implode(',',$vcampos_reporte);
			$arr_campos = explode(",", $campos_reporte);
			#print_r($arr_campos);
			for ($i=0; $i < count($arr_campos) ; $i++) { 
				$pid = $arr_campos[$i];
				$anexos_listado = ";";
				$archivos_anexos_listado = ";";
				$titulos_anexos_listado = "";
				$deadline = "2";
				$folder_id_search = $arr_campos[$i];
				$qsus = $con->Query("select suscriptor_id from gestion where id = '".$pid."'");
				$arex = $con->Result($qsus, 0, 'suscriptor_id');
				$con->Query("insert consultas_varias (suscriptor_id, gestion_id, fecha, ip, type, estado, user_id) VALUES ('".$arex."', '".$pid."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."', 'QR', '0','".$_SESSION['usuario']."')");
				$id_consultas_varias = $c->GetMaxIdTabla("consultas_varias", "id");
				$url = HOMEDIR.DS."gestion/listadodocumentosqr/".$id_consultas_varias."/";
				$codigo_qr = $c->GenerarCodeQr($url);
				$docle = $con->Query("select * from gestion_anexos where gestion_id = '".$pid."' and (estado = '1' or estado = '3') and is_publico = '1'");
				while ($xt = $con->FetchAssoc($docle)) {
					$con->Query("insert consultas_varias_anexo (id_consultas_varias, id_anexo, fecha) VALUES ('".$id_consultas_varias."', '".$xt["id"]."', '".date("Y-m-d H:i:s")."')");
				}
				echo HOMEDIR.DS."gestion/VerCodeQR/".$codigo_qr."/";
				exit;
			}
		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MContactos;
			$create = $object->UpdateContactos($constrain, $fields, $updates, $output);
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						
		}
		function Archivar($id){
			global $con;
			$r = new MMailer_Replys;
			$fields = array("message_status");
			$data = array("3");
			$constrain = "WHERE receiver_token = '".$id."'";
			$output = array("Query Correct","Query Error");
			echo $r->UpdateMailer_replys($constrain, $fields, $data, $output);	
		}
		function ArchivarTodos($id){
			global $con;
			$r = new MMailer_Replys;
			$fields = array("message_status");
			
			$data = array("3");

			$path = "";
			if ($id == "1") {
				$path = '"1", "2"';
			}elseif($id = "2"){
				$path = '"0"';
			}else{
				$path = "-";

			}

			if ($path != "-") {
				$str = 'SELECT message_code, mf.user_ID, message_status FROM mailer_from_message as mf inner join mailer_replys as mr on mr.message_id = mf.message_code where user_ID = "'.$_SESSION['usuario'].'"  and message_status in ('.$path.')';
				$qyer = $con->Query($str);

				while ($row = $con->FetchAssoc($qyer)) {
					$con->Query("UPDATE mailer_replys set message_status = '3' where message_id = '".$row['message_code']."'");
				}
				echo "Correos Archivados";
			}else{
				echo "No se selecciono ningun tipo de query";
			}

		}
		function EnviarMensajeria($id, $dir){
			global $con;
			$user_id = $_SESSION['usuario'];
			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $user_id);
			$nom = $u->GetP_nombre()." ".$u->GetP_apellido();
			$con->Disconnect($con);
			$clid = 5;
			$seccional = "MED_OF. PRINCIPAL";
			$conm = new ConexionBaseDatos_msj;
			$conm->Connect($conm);
			$str = "select id_sub_cliente from sub_cliente where mail = '".$user_id."' and padre = '".$clid."'";
			$query = $conm->Query($str);
			$tquery = $conm->Result($query, 0, "t");
			if($tquery > "0"){
				$nst = "select * from sub_cliente where nombre = '".$user_id."' and padre = '".$clid."'";
				$nquery = $conm->Query($nst);
				$id_sub_cliente = $conm->Result($nquery, 0, "id_sub_cliente");
			}else{
				$qstr = "INSERT INTO sub_cliente 
							(padre, nombre, consecutivo, seccional, consecutivo_guia, usuario_registra, fecha_registro, mail) 
					VALUES  ('$clid','$nom', '0', '".$seccional."', '0', 'ROBOT', '".date("Y-m-d")."', '".$user_id."')";
				$qs = $conm->Query($qstr); 
				$nst = "SELECT MAX(id_sub_cliente) as mx FROM sub_cliente WHERE padre = '".$clid."'";
				$nquery = $conm->Query($nst);
				$id_sub_cliente = $conm->Result($nquery, 0, "mx");
			}
			$fecha = date("Y-m-d");
			$hora = date("H:i:s");
			$dc = explode("@@", $dir);
			$str = "insert into ctp_relation (fecha, hora, estado, user_id, message_id, id_sub_cliente, direccion, rid, type) 
									  VALUES ('$fecha','$hora','0','$user_id', '$id','$id_sub_cliente', '".$dc['0']."', '".$dc['1']."', '".$dc['2']."')";
			$query = $conm->Query($str);
			if($query){
				echo "\nNotificacion Enviada";
			}else{
				echo "\nError! La notificacion ya fue enviada con anterioridad";
			}
		}
		function cambiarIp($lat,$lon,$token){
			global $con;
			$str2 = "select * from mailer_replys where redever_token = '$token' ";
			$query = $con->Query($str2);
			$res = $con->FetchAssoc($query);
			if( ( empty($res['latitude']) && empty($res['longitude']) ) || ( empty($res['It']) && empty($res['Lg']) )  ){
				$str = "update mailer_replys set latitude = '$lat', longitude = '$lon', It = '$lat',Lg = '$lon' where receiver_token = '$token'";
				$con->Query($str);
			}
		}
		function geolocation( $latitud , $longitud , $token){
			global $con;
			$str = "SELECT * FROM mailer_replys 
						WHERE receiver_token = '$token'";
			$query = $con->Query($str);
			$respuesta = $con->FetchAssoc($query);
			if( $respuesta['lt'] == "" && $respuesta['lg'] == "" ){
				$upd = "UPDATE mailer_replys SET latitude = '$latitud', longitude = '$longitud', lt = '$latitud', lg = '$longitud' WHERE receiver_token = '$token'";
				$con->Query($upd);
			}
		}
		function AltData($alt, $token){
			global $con;
			$str = "SELECT * FROM mailer_replys 
						WHERE receiver_token = '$token'";
			$query = $con->Query($str);
			$ary = explode(",", $alt);
			$zip = "";
			$cou = "";
			$alt = "";
			for ($i=0; $i < count($ary) ; $i++) { 
				if ($i == count($ary)-1) {
					$cou = trim($ary[$i]);
				}elseif($i == count($ary)-2){
					$zip = trim($ary[$i]);
				}else{
					$alt .= trim($ary[$i]).", ";
				}
			}
			$respuesta = $con->FetchAssoc($query);
			if( $respuesta['country'] == ""){
					$upd = "UPDATE mailer_replys SET country = '$cou', state = '$zip', city = '$alt' WHERE receiver_token = '$token'";
					$con->Query($upd);
			}
		}
		function GetFilterFolders($x){
			global $con;
			global $c;
			$x = explode(";", $x);
			$x = trim(end($x));
			echo '<ul class="list-group">';
			$i=0;
			if ($x != "") {
					# code...
				$query = $con->Query("SELECT sc.nombre, ds.email  FROM suscriptores_contactos as sc inner join suscriptores_contactos_direccion as ds ON ds.id_contacto = sc.id WHERE sc.nombre like '%".$x."%' or ds.email like '%".$x."%'");
				while ($row = $con->FetchAssoc($query)) {
					$i++;
					echo '<li class="list-group-item" onClick="AddContact(\''.$row['email'].'; \')">'.$row['nombre']."</li>";
				}
				if ($i == 0) {
					echo '<li class="list-group-item">No se encontraron coincidencias</li>';
				}
			}else{
				echo '<li class="list-group-item">Debe escribir algo...<li>';
			}
			echo '</ul>';
		}
		function Miniall($id){
			global $con;
			global $c;
			global $f;
			include(VIEWS.DS."mailer_message".DS."mini_listar.php");
		}
		function Minisent($id){
			echo "Minisent";
		}
		function Mininew($id){
			global $con;
			global $c;
			
			global $object;
			global $f;
			$gestion = new MGestion;
			$gestion->CreateGestion("id", $id);
			$idx = $id;
			$arr = explode(".", $id);
			$pid = $gestion->GetId();
			include(VIEWS.DS."mailer_message".DS."mini_new.php");
		}
		function MiniRead($id){
			global $con;
			global $c;
			
			global $object;
			global $f;
			$idx = $id;
			$arr = explode(".", $id);
			$id = $arr[0];
			$pid = $arr[1];
			include(VIEWS.DS."mailer_message".DS."mini_Read.php");
		}

		function ExportarCorreo($id){
			global $con;
			global $c;
			global $f;

			$alow = true;
			$usuario = new MUsuarios;
			$usuario->CreateUsuarios("user_id", $_SESSION['usuario']);

			$message_id = $id;

			$r = new MMailer_Replys;
			$r->CreateMailer_replys("receiver_token", $message_id);


			$m = new MMailer_message;
			$m->CreateMailer_message("message_id",$r->GetMessage_id());

			$gestion_id = $m->GetP_id();

			$p1 = $c->GetDataFromTable("gestion", "id", $m->GetP_id(), "num_oficio_respuesta", $separador = "");
			$p2 = $c->GetDataFromTable("gestion", "id", $m->GetP_id(), "radicado", $separador = "");

			if ($p2 == "") {
				$p = "<a href='/gestion/ver/".$m->GetP_id()."/'>".$p1."</a>";
			}else{
				$p = "<a href='/gestion/ver/".$m->GetP_id()."/'>".$p2."</a>";
			}

			$fm = new MMailer_from_message;
			$fm->CreateMailer_from_message("token_ID", $message_id);
			
			$at = new MMailer_Attachments;
			$attachments = $at->ListarMailer_attachments("WHERE message_id = '".$r->GetMessage_id()."'");


			$fields = array("readed");
			$constrain = "WHERE receiver_token = '".$message_id."'";
			$data = array("1");
			$output = array("Query Correct","Query Error");
			

			$qup = $r->UpdateMailer_replys($constrain, $fields, $data, $output);	

			$readtime = explode(" ", $r->GetReply_datetime());

			$title = $m->GetSubject();

			if( $r->GetSubject() != "" ){

				$title = $r->GetSubject();

			}
			
			$rstatus = array("1" => "El mensaje fue <strong>Abierto</strong>", "2" => "El mensaje fue <strong>Rehusado</strong>", "0" => "El mensaje <strong>No fue leido</strong>");

			$g = new MGestion;
			$g->CreateGestion("id", $gestion_id);

			$pathp = "Documento Generado por el usuario ".ucwords(strtolower($usuario->GetP_nombre()." ".$usuario->GetP_apellido()))." el día ".$f->ObtenerFecha4(date("Y-m-d H:i:s"));

			#$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
			$name = md5($_SESSION["usuario"].date("Y-m-d"))."x.pdf";
			$urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;

			$string = hash("sha256", $id.$_SESSION["usuario"].date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]); 

			#	include(APP.'plugins/mix_images/index.php');

			$timestamp = "	<div style='clear:both'>	
								<table width='700px' style='font-size:10px; text-style:italic' cellspacing='0' cellpadding='0' border='0'>
									<tr>
										<td><b>Estampado Cronologico:</b> ".date("Y-m-d")." a las ".date("H:i:s")."</td>
										<td><b>IP:</b> ".$_SERVER["REMOTE_ADDR"]."</td>
									</tr>
									<tr>
										<td><b>Firma Digital:</b> $string</td>
									</tr>
									<tr>
										<td>-----<br><br></td>
									</tr>
								</table>
							  </div>"; 

			$timestamp = "";

			$foot = "	<div>
							<div style='font-size:10px; float:left'>";
			$foot .= 			$pathp;
			$foot .= "		</div>
						</div>";

			$fpath = '<html><head></head><body>'.$timestamp;

			$lpath = '<br><br>-----'.$foot.'</body></html>';
			
			$stringactuaciones = "<h2>Detalle del Correo Electrónico $id </h2>";

			$stringactuaciones = "";

			include(VIEWS.DS."mailer_message".DS."body_email_exportar.php");

			$html = utf8_decode($fpath.html_entity_decode($stringactuaciones).$lpath);

			$em = new MSuper_admin;
			$em->CreateSuper_admin("id", $_SESSION['id_empresa']);


			$encabezado = HOMEDIR.DS."app/plugins/thumbnails/".$em->GetFoto_perfil();
			$pie_pagina = "";

			$html2 = '

						<html>

						<head>

						  <style>

						    @page { margin: 120px 100px; }

						    #header { position: fixed; left: -50px; top: -120px; right: 0px; height: 83px; background: url('.$encabezado.') no-repeat; background-size: 170px !important; text-align: center; border-bottom:2px solid #C2E1F1; }

						    #footer { position: fixed; left: 0px; bottom: -120px; right: 0px; height: 110px; background: url('.$pie_pagina.') no-repeat; }

						    #footer .page:after { content: counter(page, upper-roman); }

						    body{ font-family:"Helvetica"; }

						    h2{margin-top:20px !important;}

						  </style>

						<body>

						  <div id="header">&nbsp;</div>

						  <div id="footer"><p class="page">&nbsp;</p></div>

						  <div id="content" style="font-size:12px;">

						   '.$html.'

						  </div>

						</body>

						</html>';


            $html2 = preg_replace('/>\s+</', '><', $html2);
			$dompdf = new DOMPDF();


			$dompdf->set_paper('letter','');
			$dompdf->load_html($html2);
			ini_set("memory_limit","512M"); 
			$dompdf->render();


			/*
				DOCUMENTAR LA SIGUIENTE LINEA AL TERMINAR
				$dompdf->stream('my.pdf',array('Attachment'=>0));
			*/

			$pdf = $dompdf->output();
			if (file_put_contents($urlfile, $pdf)) {
/*
				echo "<a href='$urlfile' target='_blank'> Documento exportado a anexos </a>";
*/
				$car = new MGestion_anexos;
				$tot  = $car->ListarGestion_anexos("WHERE gestion_id = '".$gestion_id."'");

				$fol = $con->NumRows($tot);
				$fol += 1;
				$user_id = $_SESSION['usuario'];

				//base 64
				$base_file = '';
				$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);
				$base_file = base64_encode($data_base_file);			
				
				$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','Acuse de Correo Electrónico enviado a ".$fm->GetEmail()."' ,'".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."')");


				$id = $c->GetMaxIdTabla("gestion_anexos", "id");					

				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"Actuaciones del Expediente Hasta ".date("Y-m-d H:i:s")."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "expdpc", $id);

			
				echo $idretorno."Documento Exportado a Anexos";
			}else{
				echo "Se produjo un error al Exportar";
			}
		}
	}
?>