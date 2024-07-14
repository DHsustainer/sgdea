<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
	date_default_timezone_set("America/Bogota");
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'SortM.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Big_dataM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'Documentos_gestionM.php');
	include_once(MODELS.DS.'Dependencias_documentosM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');
	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Dependencias_alertasM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Estados_gestionM.php');
	include_once(PLUGINS.DS.'parse.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Solicitudes_documentosM.php');
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_attachmentsM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Mailer_replysM.php');
	include_once(MODELS.DS.'NotificacionesM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');
	include_once(MODELS.DS.'Gestion_compartirM.php');
	include_once(MODELS.DS.'Gestion_folderM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'SeccionalM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Wf_mapasM.php');
	include_once(MODELS.DS.'Wf_mapas_elementosM.php');
	include_once(MODELS.DS.'Wf_gestion_mapasM.php');
	include_once(MODELS.DS.'Wf_gestion_mapas_elementosM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');
	include_once(PLUGINS.DS.'PHPExcel.php');
	include_once(PLUGINS.DS.'nusoap/nusoap.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');
	include_once(MODELS.DS.'Meta_big_dataM.php');
	include_once(MODELS.DS.'Meta_referencias_camposM.php');
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');
	include_once(MODELS.DS.'Meta_listas_valoresM.php');
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);

	

	// Llamando al objeto a controlar		

	$ob = new CNotificaciones;

	$c = new Consultas;

	$f = new Funciones;

	

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('user_id', 'proceso_id', 'id_demandado', 'tipo_notificacion', 'id_postal', 'f_citacion', 'todos', 'nom_archivo', 'direccion', 'num_dias', 'is_certificada', 'guia_id');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

	$ar1 = array($c->sql_quote($_REQUEST['user_id']), $c->sql_quote($_REQUEST['proceso_id']), $c->sql_quote($_REQUEST['id_demandado']), $c->sql_quote($_REQUEST['tipo_notificacion']), $c->sql_quote($_REQUEST['id_postal']), $c->sql_quote($_REQUEST['f_citacion']), $c->sql_quote($_REQUEST['todos']), $c->sql_quote($_REQUEST['nom_archivo']), $c->sql_quote($_REQUEST['direccion']), $c->sql_quote($_REQUEST['num_dias']), $c->sql_quote($_REQUEST['is_certificada']), $c->sql_quote($_REQUEST['guia_id']));	

	// DEFINIMOS LOS ESTADOS DE SALIDA

	$output = array('registro actualizado', 'no se pudo actualizar'); 

	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

	$constrain = 'WHERE id = '.$_REQUEST['id'];

	

		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL

		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos

		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA

		if($c->sql_quote($_REQUEST['action']) == 'listar')

			$ob->VistaListar('');	

		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	

			$ob->VistaInsertar();

		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')

		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		

			$ob->Insertar();

		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'editar')

			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')

			$ob->ActualizarAnexos();

			#$ob->Editar($constrain, $ar2, $ar1, $output);

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')

			$ob->Eliminar($c->sql_quote($_REQUEST['id']));

		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			

		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')

			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	

		elseif ($c->sql_quote($_REQUEST['action']) == "mini_all")

			$ob->Miniall($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == "DireccionesContacto")		

			$ob->DireccionesContacto($c->sql_quote($_REQUEST['id']));

		elseif ($c->sql_quote($_REQUEST['action']) == "mini_new")

			$ob->Mininew($c->sql_quote($_REQUEST['id']));

		elseif ($c->sql_quote($_REQUEST['action']) == "mini_edit")

			$ob->MiniEdit($c->sql_quote($_REQUEST['id']));
		elseif ($c->sql_quote($_REQUEST['action']) == 'alterdata') 
			$ob->AltData( $c->sql_quote($_REQUEST['altdata']) , $c->sql_quote($_REQUEST['token']) );
		elseif ($c->sql_quote($_REQUEST['action']) == 'geolocation') 
			$ob->geolocation( $c->sql_quote($_REQUEST['latitud']) , $c->sql_quote($_REQUEST['longitud']) , $c->sql_quote($_REQUEST['token']) );	
		elseif($c->sql_quote($_REQUEST['action']) == 'generarcertificado')
			$ob->ExportarCorreo($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'listadodenotificaciones')

			$ob->GetNotificaciones($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'a')

			$ob->GetNotificaciones($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'EnviarFisico')

			$ob->EnviarFisico();

		elseif($c->sql_quote($_REQUEST['action']) == 'seguimiento')

			$ob->Seguimiento($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'anular')

			$ob->AnularServicio($c->sql_quote($_REQUEST['id']));
		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar('');		


	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CNotificaciones extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){

			// CREANDO UN NUEVO MODELO			

			$object = new MNotificaciones;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template('Listar Notificaciones');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarNotificaciones();	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

					include_once(VIEWS.DS.'notificaciones/Listar.php');	   			

					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

					$table = ob_get_clean();	

					// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

					if($message != '')

					$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);

					// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

				}else{

					// SI NO SE EJECUTA LA CONSULTA ENTONCES GENERA MENSAJE DE ERROR

		   			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	

				}

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);

		}

		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)

		function VistaInsertar(){

			//CARGA EL TEMPLATE

			$pagina = $this->load_template('Crear Notificaciones');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'notificaciones/FormInsertNotificaciones.php');				

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						

			$path = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER	

			$this->view_page($pagina);		

		}

		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO

		function VistaEditar($x){

			// CARGA EL TEMPLATE			

	 		$pagina = $this->load_template('Editar Notificaciones');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

	 		// INVOCAMOS UN NUEVO OBJETO

		 	$object = new MNotificaciones;

			// LO CREAMOS 			

			$object->CreateNotificaciones('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'notificaciones/FormUpdateNotificaciones.php');		

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											

			$table = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER		

			$this->view_page($pagina);

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MNotificaciones;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Notificaciones');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarNotificaciones('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'notificaciones/Listar.php');	   			

					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.								 								

					$table = ob_get_clean();	

					// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																		

					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

				}else{

						// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																			

			   			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	

				}		

			// CARGAMOS LA PAGINA EN EL BROWSER				

			$this->view_page($pagina);

	 	}		

		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS		

		function Insertar(){

			global $c;

			global $con;

			// DEFINIENDO EL OBJETO			

			# 
			$dcontenido = $_REQUEST['dcontenido'];
			$remitente = $_REQUEST['remitente'];
			$user_id = $_SESSION['usuario'];
			$form_id = $_REQUEST['id_form'];
			$lista_destinatarios = $_REQUEST['lista_destinatarios'];

			$listadodes = explode(";", $lista_destinatarios);

			$datoenvio = [];
			$datoenvio['files'] = [];
			$datoenvio['data'] = $_REQUEST;

			for ($j=0; $j < count($listadodes) -1 ; $j++) { 

				$u = new MUsuarios;
				$u->CreateUsuarios("user_id", $user_id);
				if ($remitente == "") {
					$remitente = $u->GetP_nombre()." ".$u->GetP_apellido();
				}
				$demandado = $u->GetDireccion()." / ".$u->GetTelefono()." - ".$u->GetCelular();
				$object = new MNotificaciones;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
				$ddo = explode("@@", $_REQUEST['demandado']);
				$create = $object->InsertNotificaciones($_SESSION['usuario'], $_REQUEST['id_gestion'], $ddo[0], $_REQUEST['titulo'], $_REQUEST['spostal'], date("Y-m-d"), '0', '', $listadodes[$j], $_REQUEST['comparecer'], '', '', $_REQUEST['nom_destinatario']);
				$anexos_listado .= $_REQUEST['archivos_anexos_listado'];
				$urls_archivos .= $_REQUEST['titulos_anexos_listado'];
				#echo $anexos_listado."<br>";
				#echo $urls_archivos;
				$max = $c->GetMaxIdTabla("notificaciones", "id");
				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

				$objecte->InsertEvents_gestion($_SESSION['usuario'], $_REQUEST['id_gestion'], date("Y-m-d"), "Carga de Documento", "Se ha cargado un documento llamado: \"".$_FILES['upl']['name']."\"", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "nfis", $max);

				$g = new MGestion;
				$g->CreateGestion("id", $_REQUEST['id_gestion']);
				//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
				$create = 1;
				if($create == '1'){
					$attachments = explode(";",$anexos_listado);
					for($i = 0; $i < count($attachments); $i++){
						if($attachments[$i] != ""){
							$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado, type) VALUES ('".$max."','".$attachments[$i]."','".date("Y-m-d H:i:s")."','0','0')");
							$ga = new MGestion_anexos;
							$ga->CreateGestion_anexos("id", $attachments[$i]);

							$c->SendContabilizadorDocumentos($ga->GetCantidad(), $g->GetTipo_documento(), $g->GetId(), "NT");	

							/*OBTENER DATA ARCHIVOS*/
							//$rutaDoc = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";
							$rutaDoc = UPLOADS.DS.$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";
							//$b64Doc = chunk_split(base64_encode(file_get_contents($rutaDoc)));
							$b64Doc = (base64_encode(file_get_contents($rutaDoc)));
							$nombreDoc = $ga->GetNombre();
							$ce = explode('.',$nombreDoc);
							if(count($ce) <= 1){
								$ac = explode('.',$ga->GetUrl());
								$ext = end($ac);
								$nombreDoc = $nombreDoc.'.'.$ext;
							}
							if($b64Doc != ''){
								$datoenvio['files'][] = [$nombreDoc,$b64Doc];
							}else{
								echo "Error al con los archivos ";
								exit;
							}

						}
					}

					if ($form_id != "0") {
						$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado, type) VALUES ('".$max."','".$form_id."', '".date("Y-m-d H:i:s")."','0','1')");
					}else{
						 $rutaDoc = ROOT.DS."archivos_uploads/gestion/".$_REQUEST['id_gestion'].trim("/anexos/").date('YmdHis').'.txt';
						 $form_id = base64_encode(serialize($datoenvio));					
					}
					$nom = $remitente;
				// 	$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);
	               //  $error = $cliente->getError();
	               //  if ($error) {
	               //      echo "Error <h2>Constructor error</h2><pre>" . $error . "</pre>";
	               //  }

	               //  $array = array("id" => $_REQUEST['spostal']);
	               //  $result = $cliente->call("GetDetalleOperador", $array);                 
	               //  if ($cliente->fault) {
	               //      echo "Error <h2>Fault</h2><pre>";
	               //      echo "</pre>";
	               //  }else{
	               //      $error = $cliente->getError();
	               //      if ($error) {
	               //          echo "Error <h2>Error</h2><pre>" . $error . "</pre>";
	               //      }else {
	               //          if ($result == "") {
	               //              echo "Error No se creo el WS";
	               //          }else{
	               //              $x  = explode(",", $result);
	            // 				$id_postal = $x[1];
	            // 				$nomPostal = $x[0];
	               //          }
	               //      }
	               //  }

				// 	$con->Query("UPDATE notificaciones set nombre_postal = '".$nomPostal."'  where id = '".$max."'");
				// 	$url = $id_postal;

				// 	$cliente = new nusoap_client($url, true);
				   //  $error = $cliente->getError();
				   //  if ($error) {
				   //      echo "Error <h2>Constructor error</h2><pre>" . $error . "</pre>";
				   //  }

				   // $array = array("user_id" => $_SESSION['usuario'], "message_id" => $max, "direccion" => $listadodes[$j], "rid" => $_REQUEST['id_gestion'] , "type" => $_REQUEST['titulo'], "nombre" => $nom, "destinatario" => $_REQUEST["nom_destinatario"], "url" => $urls_archivos, "juzgado" => $entidad, "naturaleza" => $naturalezaproceso, "radicado" => $radicado, "demandado" => $demandado, "remitente" => $remitente, "anexos" => $dcontenido, "keyword" => $_SERVER['HTTP_HOST'], "link" => $_SESSION['71c029wus3yJWEN'], "form" => $form_id);			      
				   //  $result = $cliente->call("InsertNotification", $array);	    

				   //  if ($cliente->fault) {
				   //      echo "Error <h2>Fault</h2><pre>";
				   //      echo "</pre>";
				   //  }else{
				   //      $error = $cliente->getError();

				   //      if ($error) {
				   //          echo "Error <h2>Error</h2><pre>" . $error . "</pre>";
				   //      }else {
				// 			if ($result == "") {
				// 				echo "Error No se creo el WS";
				// 			}else{
				// 				echo "Servicio registrado y enviado a la empresa: ".$nomPostal;
				// 			}
				   //      }
				   //  }

				}else{
					echo "Error al Registrar";
				}
			}

		}





		function ActualizarAnexos(){

			global $c;

			global $con;

			// DEFINIENDO EL OBJETO			

			$anexos_listado .= $_REQUEST['archivos_anexos_listado'];

			$urls_archivos .= $_REQUEST['titulos_anexos_listado'];

			$id = $c->sql_quote($_REQUEST['id']);



			$notificacion = new MNotificaciones;

			$notificacion->CreateNotificaciones("id", $id);



			$objecte = new MEvents_gestion;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

			$g = new MGestion;

			$g->CreateGestion("id", $notificacion->GetProceso_id());

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			$con->Query("delete from notificaciones_attachments where id_notificacion = '".$notificacion->GetId()."'");

			$con->Query("delete from contador_inmaterializacion where type_id = ".$notificacion->GetId()."' and type = 'NT'");

			$attachments = explode(";",$anexos_listado);

			for($i = 0; $i < count($attachments); $i++){

				if($attachments[$i] != ""){

					$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado) VALUES ('".$notificacion->GetId()."','".$attachments[$i]."', '".date("Y-m-d H:i:s")."', '0')");

					$ga = new MGestion_anexos;

					$ga->CreateGestion_anexos("id", $attachments[$i]);



					$c->SendContabilizadorDocumentos($ga->GetCantidad(), $g->GetTipo_documento(), $g->GetId(), "NT");	

				}

			}



		// 	$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);



           //  $error = $cliente->getError();

           //  if ($error) {

           //      echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

           //  }



           //  $array = array("id" => $notificacion->GetId_postal());

           //  $result = $cliente->call("GetDetalleOperador", $array);

           //  if ($cliente->fault) {

           //      echo "<h2>Fault</h2><pre>";

           //      echo "</pre>";

           //  }else{

           //      $error = $cliente->getError();



           //      if ($error) {

           //          echo "<h2>Error</h2><pre>" . $error . "</pre>";

           //      }else {

           //          if ($result == "") {

           //              echo "No se creo el WS";

           //          }else{

           //              $x  = explode(",", $result);

        // 				$id_postal = $x[3];

        // 				$nomPostal = $x[0];

           //          }

           //      }

           //  }



		// 	$url = $id_postal;



		// 	$cliente = new nusoap_client($url, true);



		   //  $error = $cliente->getError();

		   //  if ($error) {

		   //      echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

		   //  }





		   //  $array = array("user_id" => $_SESSION['usuario'], "message_id" => $notificacion->GetId(),  "rid" => "1", "keyword" => $_SERVER['HTTP_HOST']);

		   // # print_r($array);

		   //  $result = $cliente->call("UpdateNotificacion", $array);

		      

		   //  if ($cliente->fault) {

		   //      echo "<h2>Fault</h2><pre>";

		   //      echo "</pre>";

		   //  }else{

		   //      $error = $cliente->getError();





		   //      if ($error) {

		   //          echo "<h2>Error</h2><pre>" . $error . "</pre>";

		   //      }else {

		// 			if ($result == "") {

		// 				echo "No se creo el WS";

		// 			}else{

		// 				echo "Servicio Actualizado en: ".$nomPostal." : ";

		// 			}

		   //      }

		   //  }



	

		}







		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			$object = new MNotificaciones;

			$create = $object->UpdateNotificaciones($constrain, $fields, $updates, $output);

			

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($create != '1')

				$this->VistaListar('ERROR AL REGISTRAR');

			else

				$this->VistaListar('OK!');						

			

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id){

			// DEFINIMOS UN OBJETO NUEVO						

			$object = new MNotificaciones;

			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			

			$delete = $object->DeleteNotificaciones($id); 		

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($delete != '1')

				echo 'ERROR AL ELIMINAR';

			else

				echo 'OK!';			

			

		}

		function Miniall($id){

			global $con;

			global $c;

			global $f;



			$g = new MGestion;

			$g->CreateGestion("id", $id);



			include(VIEWS.DS."notificaciones".DS."minisent.php");

		}

		function Mininew($id){

			global $con;
			global $c;
			global $f;

			$g = new MGestion;
			$g->CreateGestion("id", $id);

			include(VIEWS.DS."notificaciones".DS."mininew.php");

		}

		function DireccionesContacto($id){

			global $con;

			$SSC = new MSuscriptores_contactos_direccion;

			$query = $SSC->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$id."'");	    



			while($row = $con->FetchAssoc($query)){
				$l = new MSuscriptores_contactos_direccion;
				$l->Createsuscriptores_contactos_direccion('id', $row[id]);
				echo "<option value='".$l -> GetDireccion()." - ".$l -> GetCiudad()."' data-role='addr' data-email='".$l -> GetEmail()."'>".$l -> GetDireccion()." - ".$l -> GetCiudad()." (".$l -> GetEmail().")</option>";
				//echo "<option value='".$l -> GetEmail()."' data-role='email'>".$l -> GetEmail()."</option>";
			}

		}

		function GetNotificaciones($id){

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $c;
			global $f;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getregistro');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'notificaciones/listadodenotificaciones.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			if($message != '')
			$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);


			

		}



		function EnviarFisico(){

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



				echo $arex."<<".$objectx->GetId();

				

				$SSC = new MSuscriptores_contactos_direccion;

				$SSC->Createsuscriptores_contactos_direccion("id_contacto", $arex);

				#$query = $SSC->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$arex."'");	    





				

				$docle = $con->Query("select * from gestion_anexos where gestion_id = '".$pid."' and (estado = '1' or estado = '3') and is_publico = '1'");



				while ($xt = $con->FetchAssoc($docle)) {

#					$anexos_listado .= "a".$xt["id"].";";

					$titulos_anexos_listado .= "@@@".$xt["url"];

					$archivos_anexos_listado .= ";".$xt["id"];

				}

				

				#echo $archivos_anexos_listado;

				#echo $titulos_anexos_listado;

				$remitente    = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "p_nombre, p_apellido", $separador = " ");

				$destinatario = $objectx->GetNombre();

				#echo  $SSC->GetDireccion()."".$SSC->GetCiudad();

				$this->Insertar2($pid, "Envio de Correspondencia", $remitente, $arex, $SSC->GetDireccion()." <br> ".$SSC->GetCiudad(), $destinatario, $dias = "0", $titulo = "Correo Certificado", $spostal = "me6x3P4pjiXKh2ePnnzSJn6CMkqQyPtkdtYL4tz01Kc=", $archivos_anexos_listado, $titulos_anexos_listado );

				#$this->Insertar($pid, $to, $subject, $message, $anexos_listado, $archivos_anexos_listado, $titulos_anexos_listado, $deadline, $folder_id_search);

			}

		}





		function Insertar2($id_gestion, $descripcion, $remitente, $suscriptor_id, $direccion, $destinatario, $dias = "0", $titulo = "Correo Certificado", $spostal = "me6x3P4pjiXKh2ePnnzSJn6CMkqQyPtkdtYL4tz01Kc=", $archivos_anexos_listado, $titulos_anexos_listado ){

			global $c;

			global $con;

			// DEFINIENDO EL OBJETO			

			# 

			$dcontenido = $descripcion;

			$remitente = $remitente;



			$user_id = $_SESSION['usuario'];

			$u = new MUsuarios;

			$u->CreateUsuarios("user_id", $user_id);



			if ($remitente == "") {



				$remitente = $u->GetP_nombre()." ".$u->GetP_apellido();



			}

			

			$demandado = $u->GetDireccion()." / ".$u->GetTelefono()." - ".$u->GetCelular();



			$object = new MNotificaciones;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertNotificaciones($_SESSION['usuario'], $id_gestion, $suscriptor_id, $titulo, $spostal, date("Y-m-d"), '0', '', $direccion, $dias, '', '', $destinatario);



			

			$anexos_listado .= $archivos_anexos_listado;

			$urls_archivos .= $titulos_anexos_listado;



			#echo $anexos_listado."<br>";

			#echo $urls_archivos;

			

			$max = $c->GetMaxIdTabla("notificaciones", "id");



			$objecte = new MEvents_gestion;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

			/*

				InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto ignorar),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

			*/

			# code...

			#$objecte->InsertEvents_gestion($_SESSION['usuario'], $id_gestion, date("Y-m-d"), "Carga de Documento", "Se ha cargado un documento llamado: \"".$_FILES['upl']['name']."\"", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "nfis", $max);

				

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			$create = 1;

			if($create == '1'){

				$attachments = explode(";",$anexos_listado);

				for($i = 0; $i < count($attachments); $i++){

					if($attachments[$i] != ""){

						$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo) VALUES ('".$max."','".$attachments[$i]."')");

					}

				}

				$nom = $remitente;





			// 	$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);



               //  $error = $cliente->getError();

               //  if ($error) {

               //      echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

               //  }



               //  $array = array("id" => $spostal);

                  

               // # print_r($array);



               //  #print_r($_REQUEST);



               //  $result = $cliente->call("GetDetalleOperador", $array);

                  

               //  if ($cliente->fault) {

               //      echo "<h2>Fault</h2><pre>";

               //      echo "</pre>";

               //  }else{

               //      $error = $cliente->getError();



               //      if ($error) {

               //          echo "<h2>Error</h2><pre>" . $error . "</pre>";

               //      }else {

               //          if ($result == "") {

               //              echo "No se creo el WS";

               //          }else{

               //              $x  = explode(",", $result);

            // 				$id_postal = $x[1];

            // 				$nomPostal = $x[0];

               //          }

               //      }

               //  }





			// 	$con->Query("UPDATE notificaciones set nombre_postal = '".$nomPostal."'  where id = '".$max."'");



			// 	$url = $id_postal;



			// 	$cliente = new nusoap_client($url, true);



			   //  $error = $cliente->getError();

			   //  if ($error) {

			   //      echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

			   //  }





			   //  $array = array("user_id" => $_SESSION['usuario'], "message_id" => $max, "direccion" => $direccion, "rid" => $id_gestion , "type" => $titulo, "nombre" => $nom, "destinatario" => $destinatario, "url" => $urls_archivos, "juzgado" => $entidad, "naturaleza" => $naturalezaproceso, "radicado" => $radicado, "demandado" => $demandado, "remitente" => $remitente, "anexos" => $dcontenido, "keyword" => $_SERVER['HTTP_HOST']);

			      

			   // # print_r($array);



			   //  $result = $cliente->call("InsertNotification", $array);

			      

			   //  if ($cliente->fault) {

			   //      echo "<h2>Fault</h2><pre>";

			   //      echo "</pre>";

			   //  }else{

			   //      $error = $cliente->getError();





			   //      if ($error) {

			   //          echo "<h2>Error</h2><pre>" . $error . "</pre>";

			   //      }else {

			// 			if ($result == "") {

			// 				echo "No se creo el WS";

			// 			}else{

			// 				echo "Servicio registrado y enviado a la empresa: ".$nomPostal."\n";

			// 			}

			   //      }

			   //  }





			}else{

				echo "Error al Registrar";

			}

									



			/*

			// DEFINIENDO EL OBJETO			

			$object = new MNotificaciones;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertNotificaciones($user_id, $proceso_id, $id_demandado, $tipo_notificacion, $id_postal, $f_citacion, $todos, $nom_archivo, $direccion, $num_dias, $is_certificada, $guia_id);

			

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($create != '1')

				$this->VistaListar('ERROR AL REGISTRAR');

			else

				$this->VistaListar('OK!');*/	



		}



		function MiniEdit($id){

			global $con;

			global $c;

			global $f;



			$g = new MGestion;

			$g->CreateGestion("id", $id);



			include(VIEWS.DS."notificaciones".DS."miniEdit.php");	

		}



		function AnularServicio($id){

			global $c;

			global $con;

			// DEFINIENDO EL OBJETO			



			$notificacion = new MNotificaciones;

			$notificacion->CreateNotificaciones("id", $id);



			$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);



            $error = $cliente->getError();

            if ($error) {

                echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

            }



            $array = array("id" => $notificacion->GetId_postal());

            $result = $cliente->call("GetDetalleOperador", $array);

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

        				$id_postal = $x[3];

        				$nomPostal = $x[0];

                    }

                }

            }



			$url = $id_postal;



			$cliente = new nusoap_client($url, true);



		    $error = $cliente->getError();

		    if ($error) {

		        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

		    }





		    $array = array("user_id" => $_SESSION['usuario'], "message_id" => $notificacion->GetId(),  "rid" => "2", "keyword" => $_SERVER['HTTP_HOST']);

		   # print_r($array);

		    $result = $cliente->call("UpdateNotificacion", $array);

		      

		    if ($cliente->fault) {

		        echo "<h2>Fault!b</h2><pre>";

		        echo "</pre>";

		    }else{

		        $error = $cliente->getError();





		        if ($error) {

		            echo "<h2>Error!d</h2><pre>" . $error . "</pre>";

		        }else {

					if ($result == "") {

						echo "No se creo el WS";

					}else{

						echo "Servicio Anulado en: ".$nomPostal." : ".$result;

						$con->Query("UPDATE notificaciones set nom_archivo = 'SERVICIO ANULADO POR EL USUARIO',  is_certificada = '-1' where id = '".$notificacion->GetId()."'");

					}

		        }

		    }



		}

		function geolocation( $latitud , $longitud , $token){
			global $con;
			$str = "SELECT * FROM notificaciones 
						WHERE id = '$token'";
			$query = $con->Query($str);
			$respuesta = $con->FetchAssoc($query);

			if( $respuesta['latitude'] == "" && $respuesta['longitude'] == "" ){
				$ip= $_SERVER['REMOTE_ADDR'];
				$upd = "UPDATE notificaciones SET reply_ip = '$ip', latitude = '$latitud', longitude = '$longitud' WHERE id = '$token'";
				$con->Query($upd);
			}
		}
		function AltData($alt, $token){
			global $con;
			$str = "SELECT * FROM notificaciones 
						WHERE id = '$token'";
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
					$upd = "UPDATE notificaciones SET country = '$cou', state = '$zip', city = '$alt' WHERE id = '$token'";
					$con->Query($upd);
			}

			//$this->ExportarCorreo($token);
		}


		function ExportarCorreo($id){
			global $con;
			global $c;
			global $f;

			$n = new MNotificaciones;
			$n->CreateNotificaciones("id", $id);

			$qsms = $con->Query("select * from notificaciones where id = '$id'");
			$sms = $con->FetchAssoc($qsms);

			$gestion_id = $n->GetProceso_id();

			$g = new MGestion;
			$g->CreateGestion("id", $gestion_id);

			$user = new MUsuarios;
			$user->CreateUsuarios("user_id", $g->GetUsuario_registra());


			$pathp = "Documento Generado automáticamente con autorización del destinatario el día ".$f->ObtenerFecha4(date("Y-m-d H:i:s"));

			#$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
			$name = md5(date("Y-m-d H:i:s"))."x.pdf";
			$urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;

			$string = hash("sha256", $id.date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]); 

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
			
			$stringactuaciones = "<h2>Detalle del Mensaje de Texto ".$id."-".$sms['telefono']." </h2>";

			$stringactuaciones = "";

			include(VIEWS.DS."mailer_message".DS."body_sms_exportar.php");

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
				$user_id = $user->GetUser_id();

				//base 64
				$base_file = '';
				#$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);
				#$base_file = base64_encode($data_base_file);			
				
				$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','Acuse de Correo Electrónico enviado a ".$sms['telefono']." Fecha: ".date("Y-m-d H:i:s")."' ,'".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."')");


				$id = $c->GetMaxIdTabla("gestion_anexos", "id");					

				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				$objecte->InsertEvents_gestion("sanderkdna@gmail.com", $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"Actuaciones del Expediente Hasta ".date("Y-m-d H:i:s")."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, "6", "1", "1", "*", "expdpc", $id);

			
				echo $idretorno."Documento Exportado a Anexos";
			}else{
				echo "Se produjo un error al Exportar";
			}
		}

		function Seguimiento($id){
			global $con;
			global $c;
			global $f;

			$n = new MNotificaciones;
			$n->CreateNotificaciones("id", $id);

			$qsms = $con->Query("select * from notificaciones where id = '$id'");
			$sms = $con->FetchAssoc($qsms);

			$qmr = $con->Query("select * from mailer_replys where receiver_id = '".$id."'");
			$mr = $con->FetchAssoc($qmr);

			$gestion_id = $n->GetProceso_id();

			$g = new MGestion;
			$g->CreateGestion("id", $gestion_id);

			$user = new MUsuarios;
			$user->CreateUsuarios("user_id", $g->GetUsuario_registra());

			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.ST." Sub Series");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				include_once(VIEWS.DS.'notificaciones/VistaSeguimiento.php');
				// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.
				$table = ob_get_clean();
				// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
				// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				// RETORNAME LA PAGINA CARGADA
				$this->view_page($pagina);

		}

	}
?>