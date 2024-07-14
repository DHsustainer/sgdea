<?
session_start();
date_default_timezone_set("America/Bogota");
#if ($_SERVER['REMOTE_ADDR'] == "190.29.205.15") {
#	error_reporting(E_ALL);
#	ini_set('display_errors', '1');
	# code...
#}
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'CaratulaM.php');

	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'NotificacionesM.php');
	include_once(MODELS.DS.'Demandado_procesoM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'FuentesM.php');
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Gestion_compartirM.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'LibrosM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'Gestion_transferenciasM.php');
	include_once(MODELS.DS.'Dependencias_alertasM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Big_dataM.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Documentos_gestionM.php');
	include_once(MODELS.DS.'Dependencias_documentosM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');
	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'SeccionalM.php');	
	include_once(MODELS.DS.'Solicitudes_documentosM.php');	
	include_once(MODELS.DS.'Gestion_tipologias_big_dataM.php');
	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');	
	include_once(MODELS.DS.'Meta_big_dataM.php');	
	include_once(MODELS.DS.'Meta_referencias_camposM.php');	
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');	
	include_once(MODELS.DS.'Meta_listas_valoresM.php');	
	include_once(MODELS.DS.'Meta_listasM.php');	
	include_once(MODELS.DS.'Usuarios_configurar_firma_digitalM.php');	
	include_once(MODELS.DS.'Gestion_anexos_permisos_documentosM.php');	
	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');	
	include_once(MODELS.DS.'Gestion_favoritosM.php');	
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	$ob = new CDashBoard;
	$c = new Consultas;
	$f = new Funciones;
	$car = new MCaratula;
	$user = new MUsuarios;
	$action = $c->sql_quote($_REQUEST["action"]);
/*
	if(isset($_SESSION["usuario"])){
		header("location: ".HOMEDIR.DS."login".DS);
		echo "location: ".HOMEDIR.DS."login".DS;
	}else{
*/
	if($_SESSION["usuario"]  == '') {
		if ($action == "buscar"){
			$keyword = explode(":", $c->sql_quote($_REQUEST["del-input-buscar"]));
			if ($keyword[0] == "code") {
				$ob->CodesPublicEngine(trim($keyword[1]));
			}elseif ($keyword[0] == "id") {
				$ob->SearchPublicEngineById(trim($keyword[1]));
			}else{
				$ob->SearchPublicRadications($c->sql_quote($_REQUEST["del-input-buscar"]));
			}
		}elseif ($action == "descargar") {
			    $id = $c->sql_quote($_REQUEST['id']);
			    $fileurl = $c->sql_quote($_REQUEST['cn']);    
			    $filename = $c->sql_quote($_REQUEST['p1']);  
/*
			    header("Content-type: application/octet-stream");
			    header("Content-Disposition: attachment; filename=\"$filename\"\n");
			    $fp=fopen("$f", "r");
			    fpassthru($fp);
*/			    

			    $f = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$id.DS.'anexos/'.$fileurl;;
			    header("Content-type: application/octet-stream");
			    header("Content-Disposition: attachment; filename=\"$filename\"\n");
			    $fp=fopen("$f", "r");
			    fpassthru($fp);


		}elseif ($action == "descarganotificacion") {
			    $id = $c->sql_quote($_REQUEST['id']);
			    $fileurl = $c->sql_quote($_REQUEST['cn']);    
			    $filename = $c->sql_quote($_REQUEST['p1']);  
			    $not = $c->sql_quote($_REQUEST['p2']);  
/*
			    header("Content-type: application/octet-stream");
			    header("Content-Disposition: attachment; filename=\"$filename\"\n");
			    $fp=fopen("$f", "r");
			    fpassthru($fp);
*/

			    $query = $con->Query("select * from notificaciones_attachments where id = '$not'");
			    $rs = $con->FetchAssoc($query);

			    $fecha_descarga = date("Y-m-d H:i:s");
			    if ($rs['fecha_descarga'] != "0000-00-00 00:00:00") {
			    	$fecha_descarga = $rs['fecha_descarga'];
			    }

			    $con->Query("update notificaciones_attachments set fecha_descarga = '".$fecha_descarga."', estado = '1', fecha_otra_descarga = '".date("Y-m-d H:i:s")."' where id = '$not'");

			    $f = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$id.DS.'anexos/'.$fileurl;;
			    header("Content-type: application/octet-stream");
			    header("Content-Disposition: attachment; filename=\"$filename\"\n");
			    $fp=fopen("$f", "r");
			    fpassthru($fp);


		}elseif($action == 'viewPublicfile'){
			$ob->PreviewPublicFile($c->sql_quote($_REQUEST['url']), $c->sql_quote($_REQUEST['type']));
		}else{
			echo "<script> window.location.href= '".HOMEDIR.DS."login/'</script>";	
		}
	} else {
		if($action == "xxx"){
		}elseif($action == "dashboard"){
			$ob->GetDashBoard();
		}elseif($action == "anular"){
			$ob->Anular($_REQUEST[id]);
		}elseif($action == "fnactualizarsession"){
			$_SESSION['fnactualizarsession'] = date('YmdHis');
		}elseif($action == "realizar"){
			$ob->Realizar($_REQUEST[id]);
		}elseif($action == "profile"){
			$ob->MyProfile();
		}elseif($action == "profileSuscriptor"){
			$ob->MyProfileSuscriptor();
		}elseif($action == "VistaAlertas"){
			$ob->VistaAlertas();
		}elseif($action == "GeneradorDatosWidgetAlertas"){
			$ob->GeneradorDatosWidgetAlertas($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}elseif($action == "buscar"){
			$valorbusqueda = $c->sql_quote($_REQUEST["del-input-buscar2"]).''.$c->sql_quote($_REQUEST["del-input-buscar"]);
			$keyword = explode(":", $valorbusqueda);
			if ($keyword[0] == "code") {
				$ob->CodesEngine(trim($keyword[1]));
			}elseif ($keyword[0] == "id" || $keyword[0] == "identificacion") {
				$ob->SearchEngineById(trim($keyword[1]),trim($keyword[0]));
			}elseif ($keyword[0] == "buscar") {
				$ob->SearchEngine(trim($keyword[1]));
			}elseif ($keyword[0] == "ayuda") {
				$ob->SearchHelper(trim($keyword[1]));
			}elseif($keyword[0]  == "contacto"){
				$ob->SearchSuscriptor($c->sql_quote($keyword[1]));
			}elseif($keyword[0]  == "documentos"){
				$ob->SearchAnexos($c->sql_quote($keyword[1]));
			}else{
				$ob->SearchRadications($c->sql_quote($_REQUEST["del-input-buscar"]));
			}
		}elseif($action == "buscador"){
			$ob->NuevoBuscador($c->sql_quote($_REQUEST['del-input-buscar']));
		}elseif($action == "BuscarPersonas"){
			$ob->SearchPeople($c->sql_quote($_REQUEST["del-input-buscar"]));
		}elseif($action == 'actualizarperfil'){
			$ob->ActualizarPerfilUsuario();
		}elseif($action == 'actualizarperfilsuscriptor'){
			$ob->ActualizarPerfilUsuarioSuscriptor();
		}elseif($action == 'viewfile'){
			$ob->PreviewFile($c->sql_quote($_REQUEST['url']), $c->sql_quote($_REQUEST['type']));

		}elseif($action == 'viewfilevalidate'){
			$ob->PreviewFileValidate($c->sql_quote($_REQUEST['ide']), $c->sql_quote($_REQUEST['idb']));
		}elseif($action == 'viewPublicfile'){
			$ob->PreviewPublicFile($c->sql_quote($_REQUEST['url']), $c->sql_quote($_REQUEST['type']));
		}elseif($action == 'newevents'){
			if($app == '1'){
				$c->RestartNotification($usuario, 6, consultarlog());
			}
			$me = new MUsuarios;
			$me->CreateUsuarios("user_id", $_SESSION["usuario"]);
			$app += $me->GetCountNotifications();
			
			if ($app > 0) {
				echo "!";
			}else{
				echo "0";
			}

			if ($_SESSION['suscriptor_id'] == "") {
				# code...
				$statussesion = $con->Result($con->Query("select status from logins where sID = '".$_SESSION['SID']."'"), 0, "status");
				if ($statussesion == 0) {
						//echo "<script>alert('Su sesion ha sido cerrada'); window.location.href = '".HOMEDIR.DS."login/kill/'</script>";
				}elseif ($statussesion == 2) {
					if ($_SESSION["usuario_real_cambio"] != $_SESSION["usuario"] && $_SESSION["usuario_real_cambio"] ==  "") {
						if ($_SESSION['keep_alive_sesions'] == "") {
							//echo "<script>OpenedSession();</script>";
						}
					}
				}
			}
		}elseif($action == 'notificaciones'){
			$ob->Notifications();
		}elseif($action == 'updatealerta'){
			$ob->StatAlerta($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}elseif($action == 'updatealertav2'){
			$ob->StatAlertaV2($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	
		}elseif($action == "ListadoProcesosCiudad"){
			$ob->ListadoProcesosCiudad();
		}elseif($action == "ListadoProcesosFiltrado"){
			$ob->ListadoProcesosFiltrado($c->sql_quote($_REQUEST['id']));
		}elseif($action == "ListadoDetalleInactividad"){
			$ob->ListadoDetalleInactividad($c->sql_quote($_REQUEST['id']));
		}elseif($action == "KillActivities"){
			$ob->EliminarActividades($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}elseif ($action == "exportar" ) {
			header("Content-type: application/vnd.ms-excel; name='excel'");
			header("Content-Disposition: filename=detalle_expedientes.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			echo utf8_decode($_REQUEST['datos_a_enviar']);
		}elseif ($action == "descargar") {
		    $id = $c->sql_quote($_REQUEST['id']);
		    $fileurl = $c->sql_quote($_REQUEST['cn']);    
		    $filename = $c->sql_quote($_REQUEST['p1']);  
	    	header("Content-type: application/octet-stream");
		    header("Content-Disposition: attachment; filename=\"$filename\"\n");
		    $f = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$id.DS.'anexos/'.$fileurl;
		    $fp=fopen("$f", "r");
		    fpassthru($fp);
		}elseif ($action == "descarganotificacion") {
			    $id = $c->sql_quote($_REQUEST['id']);
			    $fileurl = $c->sql_quote($_REQUEST['cn']);    
			    $filename = $c->sql_quote($_REQUEST['p1']);  
			    $not = $c->sql_quote($_REQUEST['p2']);  
/*
			    header("Content-type: application/octet-stream");
			    header("Content-Disposition: attachment; filename=\"$filename\"\n");
			    $fp=fopen("$f", "r");
			    fpassthru($fp);
*/

			    $query = $con->Query("select * from notificaciones_attachments where id = '$not'");
			    $rs = $con->FetchAssoc($query);

			    $fecha_descarga = date("Y-m-d H:i:s");
			    if ($rs['fecha_descarga'] != "0000-00-00 00:00:00") {
			    	$fecha_descarga = $rs['fecha_descarga'];
			    }

			    $con->Query("update notificaciones_attachments set fecha_descarga = '".$fecha_descarga."', estado = '1', fecha_otra_descarga = '".date("Y-m-d H:i:s")."' where id = '$not'");

			    $f = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$id.DS.'anexos/'.$fileurl;;
			    header("Content-type: application/octet-stream");
			    header("Content-Disposition: attachment; filename=\"$filename\"\n");
			    $fp=fopen("$f", "r");
			    fpassthru($fp);


		}elseif($action == "ofuscador"){
			$ob->GetOfuscador();
		}elseif($action == "firmacrt"){
			$ob->GetFirmaCrt();
		}elseif($action == 'crearfirmacrt'){
			$ob->CrearFirmaCrt($c->sql_quote($_REQUEST["provincia"]), $c->sql_quote($_REQUEST["ciudad"]), $c->sql_quote($_REQUEST["organizacion"]), $c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["email"]), $c->sql_quote($_REQUEST["clave"]), $c->sql_quote($_REQUEST["organizacion_unidad"]));		
		}elseif($action == "VerCalculodeAhorro"){
			$ob->ResumenAhorro();
		}elseif($action == "XML"){
			echo "hola";
		}elseif($action == "home"){
			if($_SESSION["usuario"]  == '') {
				header("Location: HOMEDIR.DS.login/");
			} else {
				$ob->DashBoard();	
			}
		}
		/* NUEVOS MODULOS DE ALERTAS*/
		elseif($action == "actividadesnuevas"){
			$ob->AlertaActividadesNuevas($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}
		elseif($action == "expedientesnuevos"){
			$ob->ExpedientesNuevos($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}
		elseif($action == "documentosnuevos"){
			$ob->DocumentosNuevos($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}
		elseif($action == "expedientescompartidos"){
			$ob->DocumentosCompartidos($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}
		elseif($action == "correoelectronico"){
			$ob->AlertaCorreoElectronico($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}
		elseif($action == "correspondencia_fisica"){
			$ob->AlertaCorrespondencia_Fisica($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}
		elseif($action == "documentospendientesfirma"){
			$ob->AlertaDocumentosPendientesFirma($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}
		elseif($action == "expedientesinactivos"){
			$ob->AlertaExpedientesInactivos($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}
		elseif($action == "expedientesvencer"){
			$ob->AlertaExpedientesVencer($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}
		elseif($action == "pendientesvalidar"){
			$ob->AlertaPendientesValidar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}
		elseif($action == "solicituddocumentos"){
			$ob->AlertaSolicitudDocumentos($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}

		elseif($action == "transferenciaspendientes"){
			$ob->AlertaTransferenciasPendientes($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}
		elseif($action == "ultimosmovimientosglobales"){
			$ob->AlertaUltimosMovimientosGlobales($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}
		elseif($c->sql_quote($_REQUEST['action']) == 'seguimientoestados')
			$ob->Getseguimientoestados();
		elseif($action == "changethat"){
			$ob->ChangeValorCuota($c->sql_quote($_REQUEST['id']));
		}elseif($action == "e"){
			$ob->CheckDetailAlert($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		}elseif($action == "f"){
			$ob->CheckDetailAlertUser($c->sql_quote($_REQUEST['id'], $c->sql_quote($_REQUEST['cn'])));	
		}elseif($action == "ald"){
			$ob->GetAlertaExpediente($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}elseif($action == "favoritos"){
			$ob->GetFavoritos($c->sql_quote($_REQUEST['id']));
		}elseif($action == "efavoritos"){
			$ob->GeteFavoritos($c->sql_quote($_REQUEST['id']));
		}elseif($action == "pruebacorreos"){
			$ob->PruebaCorreos($c->sql_quote($_REQUEST['id']));
		}elseif($action == "archivados"){
			$ob->GetArchivados($c->sql_quote($_REQUEST['id']));
		}elseif($action == "earchivados"){
			$ob->GeteArchivados($c->sql_quote($_REQUEST['id']));
		}elseif($action == "boletin"){
			$ob->GetBoletin($c->sql_quote($_REQUEST['id']));
		}elseif($action == "ver"){
			$ob->VerCorrespondencia();
		}elseif($action == "tareas"){
			$ob->VerTareas($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));	
		}else{
			if($_SESSION["usuario"]  == '') {
				header("Location: HOMEDIR.DS.login/");
			} else {
				$ob->DashBoard();	
			}
		}
	}
	class CDashBoard extends MainController{
		function DashBoard(){
			$object = new MUsuarios;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f;
			global $c;
			if ($_SESSION['suscriptor_id'] == "") {
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Dashboard");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				if ($_SESSION['ui_correspondencia'] == "1") {
					/*if ($_SESSION['usuario'] == 'info@laws.com.co') {
						include_once(VIEWS.DS.'home'.DS.'index.php');
					}else{
						include_once(VIEWS.DS.'home'.DS.'index_correspondencia.php');
					}*/
					include_once(VIEWS.DS.'home'.DS.'index.php');

				}else{
					include_once(VIEWS.DS.'home'.DS.'index.php');
				}
			}else{
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				$pagina = $this->load_templateAmpleApp(utf8_decode(PROJECTNAME).ST."Dashboard");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				#echo "Contenido Aqui!";
				include_once(VIEWS.DS.'home'.DS.'index_suscriptores.php');
			}
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}
		function GetDashBoard(){
			$object = new MUsuarios;
			global $con;
			$object->CreateUsuarios("username", $_SESSION["usuario"]);
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			include_once(VIEWS.DS.'dashboard'.DS.'dashboard.php');		
		}
		function SearchEngine($attr){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $car;
			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Resultados de busqueda ".$attr);			
			ob_start();
			include_once(VIEWS.DS.'home'.DS.'search.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}
		function SearchRadications($attr){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $car;
			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Resultados de busqueda ".$attr);			
			ob_start();
			#include_once(VIEWS.DS.'home'.DS.'Buscador.php');		
			include_once(VIEWS.DS.'home'.DS.'searchRadicados.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}
		function SearchPublicRadications($attr){
					//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $car;
			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Resultados de busqueda ".$attr);			
			ob_start();
			include_once(VIEWS.DS.'home'.DS.'searchRadicados.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}
		function SearchPeople($attr){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$object = new MUsuarios;
			global $con;
			$object->CreateUsuarios("id", $attr);
			if ($object->GetUser_id() == "") {
				$object->CreateUsuarios("user_id", $attr);
			}
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Informacion del Ciudadano");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'home'.DS.'searchPeople.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		/*
		function GetNewActivity(){
			$object = new MUsuarios;
			global $con;
			$object->CreateUsuarios("username", $_SESSION["usuario"]);
			$m = $object->GetUnreadMessages($_SESSION["usuario"]);
			$p = $object->GetNewComments($_SESSION["usuario"]);
			$arr = array('a' => $p, 'b' => $m);
			echo json_encode($arr);	
		} */
		function MyProfile(){
			$object = new MUsuarios;
			global $con;
			$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
			$MUsuarios_configurar_firma_digital = new MUsuarios_configurar_firma_digital;
			$MUsuarios_configurar_firma_digital->CrearUsuarios_configurar_firma_digitalNoExiste($_SESSION["usuario"]);
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Configurar Cuenta");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'home'.DS.'myprofile.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		function MyProfileSuscriptor(){
			global $con;
			$object = new MSuscriptores_contactos;
			$object->CreateSuscriptores_contactos("id", $_SESSION["suscriptor_id"]);
			$objectd = new MSuscriptores_contactos_direccion;
			$objectd->CreateSuscriptores_contactos_direccion("id_contacto", $_SESSION["suscriptor_id"]);
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Configurar Cuenta");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'home'.DS.'myprofilesuscriptor.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		function Notifications(){
			$object = new MUsuarios;
			global $con;
			$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Notificaciones");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'home'.DS.'notifications.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		function PreviewFile($url, $type){
			global $con;
			global $c;
			#echo $url."--".$type;
			#$type = strtolower($type);
			include(VIEWS.DS."caratula".DS.'PreviewFile.php');
		}
		function PreviewFileValidate($ide, $idb){
			global $con;
			global $c;
			global $f;
			
			include(VIEWS.DS."caratula".DS.'PreviewFileValidate.php');
		}
		function PreviewPublicFile($url, $type){
			global $con;
			global $c;
			#echo $url."--".$type;
			#$type = strtolower($type);
			include(VIEWS.DS."caratula".DS.'PreviewPublicFile.php');
		}
		function Anular($id){
			global $con;
			$con->Query("UPDATE events set echo = 2 where id = '$id'");
			header('location:'.HOMEDIR.'/dashboard/');
		}
		function Realizar($id){
			global $con;
			#echo "UPDATE events set status = '1', echo = '1' where id = '$id'";
			$con->Query("UPDATE events set status = '1', echo = '1' where id = '$id'");
			header('location:'.HOMEDIR.'/dashboard/');
		}
		function StatAlertaV2($id, $status){
			global $con;

			$id_evento = $id;
			$ev = new MEvents_gestion;
			$ev->CreateEvents_gestion("id", $id_evento);
			$gestion = $ev->GetGestion_id();


			if ($ev->Getrealizadopor() == "") {
				$path = ", realizadopor = '".$_SESSION['usuario']."', fecha_realizado = '".date("Y-m-d H:i:s")."'";
			}
			$con->Query("UPDATE alertas set status = '".$status."' where id_evento = '$id_evento'");
			$con->Query("UPDATE events_gestion set status = '".$status."' ".$path." where id = '$id_evento'");

			$usevent = new MUsuarios;
			$usevent->CreateUsuarios("user_id", $ev->GetUser_id());

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $_SESSION['usuario']);

			$eventoe = new MEvents_gestion;
			$desc = "el Usuario ".$u->GetP_nombre()." ".$u->GetP_apellido()." realizó una actividad asignada por usted llamada ".$ev->GetTitle();
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
			$create = $eventoe->InsertEvents_gestion($_SESSION['usuario'], $gestion, date("y-m-d"), "Se realizó una actividad",$desc, date("Y-m-d"), "0", date("H:i:s"), "0", "0", "1", date("Y-m-d"), "0", $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usevent->GetA_i(), 'ev', $gestion);

			if ($ev->Getid_generico() != 0 || $ev->Getid_generico() != "") {
				
				$statustransform = array("0" => "AR", "2" => "AA");
				$aertasau = $con->Query("Select * from dependencias_alertas where dependencia_alerta = '".$ev->Getid_generico()."' and automatica = '".$statustransform[$status]."'");

				while ($rowau = $con->FetchAssoc($aertasau)) {

					$alerta = $rowau['id'];
					$depa = new MDependencias_alertas;
					$depa->CreateDependencias_alertas("id", $alerta);
					$fecha = date("Y-m-d");
					$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
					date_modify($fecha_c, $depa->GetDias_alerta()." day");//sumas los dias que te hacen falta.
					$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
					$eventoe = new MEvents_gestion;
				#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
					$create = $eventoe->InsertEvents_gestion($_SESSION['usuario'], $gestion, $fecha_a, $depa->GetNombre(), $depa->GetDescripcion(), date("Y-m-d"), "1", date("H:i:s"), "1", $depa->GetDias_antes(), "1", $fecha_a, $alerta, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $_SESSION['user_ai'], 'ev', $gestion);

				}
			}
		}
		function StatAlerta($id, $status){
			global $con;
			$chck = $con->Query("SELECT * FROM alertas where id = '".$id."'");
			$t = $con->FetchAssoc($chck);
			$type = $t["type"];
			$id_evento = $t["id_evento"];
			$ev = new MEvents_gestion;
			$ev->CreateEvents_gestion("id", $id_evento);
			if ($ev->Getrealizadopor() == "") {
				$path = ", realizadopor = '".$_SESSION['usuario']."', fecha_realizado = '".date("Y-m-d H:i:s")."'";
			}
			$con->Query("UPDATE alertas set status = '".$status."' where id = '$id'");
			$con->Query("UPDATE alertas set status = '".$status."' where id_evento = '$id_evento'");
			$con->Query("UPDATE events_gestion set status = '".$status."' ".$path." where id = '$id_evento'");
		}
		function ListadoProcesosCiudad(){
			global $con;
			$query = $con->Query("select * from caratula where user_id = '".$_SESSION['usuario']."' and est_proceso not like '%ELIMINAR%' group by ciudad");
    		echo '<label>Seleccione una ciudad: <select id="ciudad_filtro" style="width:150px; margin-right:15px; height:37px;"></label>';
    		while ($row = $con->FetchAssoc($query)) {
    		/*
    		*/
				$cityc = new MCity;
				$cityc->CreateCity("code", $row['ciudad']);
				$nombre = "";
				$nombre = $cityc->GetName();
				if ($nombre == "") {
					$nombre = "SIN ASIGNAR";
				}
    			echo "<option value='".$row['ciudad']."'>".$nombre."</option>";
    		}
    		echo '</select>';
    		echo '<input type="button" value="Buscar" onClick="ListadoProcesosCiudad()">';
    		echo '<hr>';
    		echo '<div id="resultado_filtro"></div>';
		}
		function ListadoProcesosFiltrado($id){
			global $con;
			$data = $con->Query("SELECT * from caratula where user_id = '".$_SESSION['usuario']."' and est_proceso = 'ACTIVO' and ciudad = '$id'");
			$pathn  = "";
			$pathm  = "";				
			$pathn .= "<div class='search_result'>";	
			echo "<link rel='stylesheet' type='text/css' href='".ASSETS."/styles/agenda.css'/>";
			while ($row = $con->FetchAssoc($data)) {
				$tit_demanda = $row["tit_demanda"];
				if (strlen($tit_demanda) >= 80 ) {
					$tit_demanda = substr($tit_demanda, 0, 80)."...";
				}
				$pathm .= "	<div class='result_box'>
								<div class='logo_s'></div>
								<div class='search_text' onClick='window.location.href=\"".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/\"'>
									<div class='link_search'><a href='".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/'>".$tit_demanda."</a></div>
									<div class='tit_demanda'>&nbsp;</div>
								</div>
							</div>";	
			}
			echo $pathn.$pathm."</div><div class='clear'></div>";
		}
		function ListadoDetalleInactividad($id){
	       	global $c;
	       	global $con;
	       	$log = $c->consultarlog();
	       	#$log = 674;
	       	$d1f = $log-15;
	       	$d2f = $log-30;
/*
			if ($id == '0') {
				# code...
			}elseif($id == "15"){
			}else{
			}
*/
			echo "<link rel='stylesheet' type='text/css' href='".ASSETS."/styles/agenda.css'/>";
			$str = $con->Query("SELECT * FROM events 
		       							INNER JOIN caratula ON events.proceso_id = caratula.id AND events.user_id = caratula.user_id
											WHERE events.user_id = '".$_SESSION['usuario']."' AND caratula.est_proceso NOT LIKE  '%ELIMINAR%'
											GROUP BY events.proceso_id ORDER BY events.id DESC");
			$pathn  = "";
			$pathm  = "";				
			$pathn .= "<div class='search_result'>";
	       	$c1 = 0;	$c2 = 0;	$c3 = 0;
	       	while ($row = $con->FetchAssoc($str)) {
	       		$da = $row['added'];
	       		$tit_demanda = $row["tit_demanda"];
				if (strlen($tit_demanda) >= 80 ) {
					$tit_demanda = substr($tit_demanda, 0, 80)."...";
				}
	       		if ($da >= $d1f) {
	       			if ($id == 0) {
	       				# code...
		       			$pathm .= "	<div class='result_box'>
									<div class='logo_s'></div>
									<div class='search_text' onClick='window.location.href=\"".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/\"'>
										<div class='link_search'><a href='".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/'>".$tit_demanda."</a></div>
										<div class='tit_demanda'>&nbsp;</div>
									</div>
								</div>";	
	       			}
	       		}elseif($da < $d1f && $da >= $d2f){
	       			if ($id == 15) {
		       			$pathm .= "	<div class='result_box'>
									<div class='logo_s'></div>
									<div class='search_text' onClick='window.location.href=\"".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/\"'>
										<div class='link_search'><a href='".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/'>".$tit_demanda."</a></div>
										<div class='tit_demanda'>&nbsp;</div>
									</div>
								</div>";	
	       				# code...
	       			}
	       		}else{
	       			if ($id == 30) {
		       			$pathm .= "	<div class='result_box'>
									<div class='logo_s'></div>
									<div class='search_text' onClick='window.location.href=\"".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/\"'>
										<div class='link_search'><a href='".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/'>".$tit_demanda."</a></div>
										<div class='tit_demanda'>&nbsp;</div>
									</div>
								</div>";	
	       				# code...
	       			}
	       		}
/*
	       		$pathm .= "	<div class='result_box'>
								<div class='logo_s'></div>
								<div class='search_text' onClick='window.location.href=\"".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/\"'>
									<div class='link_search'><a href='".HOMEDIR.DS."caratula/opcion/".$row["id"]."/ver/'>".$tit_demanda."</a></div>
									<div class='tit_demanda'>&nbsp;</div>
								</div>
							</div>";	*/
	       	}
	       	echo $pathn.$pathm."</div><div class='clear'></div>";
		}
		function CodesEngine($attr){
			global $con;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$term = $attr;			
			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Resultados de busqueda en Codigos: ".$attr);			
			ob_start();
			include_once(VIEWS.DS.'home'.DS.'searchInCodes.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}
		function SearchHelper($attr){
			global $con;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$term = $attr;			
			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST." Resultados de ayuda relacionados con: ".$attr);			
			ob_start();
			include_once(VIEWS.DS.'home'.DS.'Helper.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}
		function SearchSuscriptor($attr){
			global $con;
			global $c;
			global $f;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$term = $attr;			
			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST." Resultados de ayuda relacionados con: ".$attr);			
			ob_start();
			include_once(VIEWS.DS.'home'.DS.'searchSuscriptor.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);	
		}
		function SearchAnexos($attr){
			global $con;
			global $c;
			global $f;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$term = $attr;			
			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST." Resultados de ayuda relacionados con: ".$attr);			
			ob_start();
			include_once(VIEWS.DS.'home'.DS.'searchAnexos.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);	
		}
		function VistaAlertas($attr){
			global $con;
			global $c;
			global $f;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$cantidad_paginador = 1;
			$pagina_paginador = $_SESSION['paginador_alertas'] * $cantidad_paginador;
			$_SESSION['paginador_alertas']  =$_SESSION['paginador_alertas'] + 1;
			include_once(VIEWS.DS.'home'.DS.'vista_alertas.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
		}
		function SearchEngineById($attr,$idbusqueda){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $car;
			global $c;
			global $f;
			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Resultados de busqueda ".$attr);			
			ob_start();
			include_once(VIEWS.DS.'home'.DS.'searchByid.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}
		function SearchPublicEngineById($attr){
					//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $car;
			global $c;
			global $f;
			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Resultados de busqueda ".$attr);			
			ob_start();
			include_once(VIEWS.DS.'home'.DS.'searchByid.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}	
		function ActualizarPerfilUsuario(){
			global $con;
			global $c;
			global $f;
			$usuario = new MUsuarios;
			$usuario->CreateUsuarios("user_id", $_SESSION['usuario']);
			$path = "";
    		$change = false;
    		$newpassword 	= $c->sql_quote($_REQUEST['newpassword']);
			$p_nombre 		= $c->sql_quote($_REQUEST['p_nombre']);
			$p_apellido 	= $c->sql_quote($_REQUEST['p_apellido']);
			$sexo 			= $c->sql_quote($_REQUEST['sexo']);
			$cedula 		= $c->sql_quote($_REQUEST['cedula']);
			$exp_cedula 	= $c->sql_quote($_REQUEST['exp_cedula']);
			$direccion 		= $c->sql_quote($_REQUEST['direccion']);
			$ciudad 		= $c->sql_quote($_REQUEST['ciudad']);
			$departamento 	= $c->sql_quote($_REQUEST['departamento']);
			$telefono 		= $c->sql_quote($_REQUEST['telefono']);
			$celular 		= $c->sql_quote($_REQUEST['celular']);
			$email 			= $c->sql_quote($_REQUEST['direccion_de_correo']);
			$universidad 	= $c->sql_quote($_REQUEST['universidad']);
			$t_profesional 	= $c->sql_quote($_REQUEST['t_profesional']);
			$oficina 		= $c->sql_quote($_REQUEST['oficina']);
			$area 			= $c->sql_quote($_REQUEST['area']);
			$notif 			= $c->sql_quote($_REQUEST['notif_usuario']);
			$notif_admin	= $c->sql_quote($_REQUEST['notif_admin']);
			$correos		= $c->sql_quote($_REQUEST['correos']);

			if ($notif == "") { $notif = '0'; }else{ $notif = '1'; }
			if ($notif_admin == "") { $notif_admin = '0'; }else{ $notif_admin = '1'; }
			if ($correos == "") { $correos = '0'; }else{ $correos = '1'; }
			if ($newpassword != "") {
				$path .= "<li>Se edito el campo Contraseña de \'".$usuario->GetPassword()."\' por \'$newpassword\' </li>";   
				$change = true;
			}
			if ($p_nombre != $usuario->GetP_nombre()) {
				$path .= "<li>Se edito el campo Primer Nombre de \'".$usuario->GetP_nombre()."\' por \'$p_nombre\' </li>";  
				$change = true;
			}
			if ($p_apellido != $usuario->GetP_apellido()) {
				$path .= "<li>Se edito el campo Primer Apellido de \'".$usuario->GetP_apellido()."\' por \'$p_apellido\' </li>";  
				$change = true;
			}
			if ($sexo != $usuario->GetSexo()) {
				$path .= "<li>Se edito el campo Sexo de \'".$usuario->GetSexo()."\' por \'$sexo\' </li>";  
				$change = true;
			}
			if ($cedula != $usuario->GetCedula()) {
				$path .= "<li>Se edito el campo Identificación de \'".$usuario->GetCedula()."\' por \'$cedula\' </li>";  
				$change = true;
			}
			if ($exp_cedula != $usuario->GetExp_cedula()) {
				$path .= "<li>Se edito el campo Fecha de expedición de \'".$usuario->GetExp_cedula()."\' por \'$exp_cedula\' </li>";  
				$change = true;
			}
			if ($direccion != $usuario->GetDireccion()) {
				$path .= "<li>Se edito el campo Dirección de \'".$usuario->GetDireccion()."\' por \'$direccion\' </li>";  
				$change = true;
			}
			if ($ciudad != $usuario->GetCiudad()) {
				$path .= "<li>Se edito el campo Ciudad de \'".$usuario->GetCiudad()."\' por \'$ciudad\' </li>";  
				$change = true;
			}
			if ($departamento != $usuario->GetDepartamento()) {
				$path .= "<li>Se edito el campo Departamento de \'".$usuario->GetDepartamento()."\' por \'$departamento\' </li>";  
				$change = true;
			}
			if ($telefono != $usuario->GetTelefono()) {
				$path .= "<li>Se edito el campo Teléfono de \'".$usuario->GetTelefono()."\' por \'$telefono\' </li>";  
				$change = true;
			}
			if ($celular != $usuario->GetCelular()) {
				$path .= "<li>Se edito el campo Celular de \'".$usuario->GetCelular()."\' por \'$celular\' </li>";  
				$change = true;
			}
			if ($email != $usuario->GetEmail()) {
				$path .= "<li>Se edito el campo E-mail de \'".$usuario->GetEmail()."\' por \'$email\' </li>";  
				$change = true;
			}
			if ($universidad != $usuario->GetUniversidad()) {
				$path .= "<li>Se edito el campo Universidad de \'".$usuario->GetUniversidad()."\' por \'$universidad\' </li>";  
				$change = true;
			}
			if ($t_profesional != $usuario->GetT_profesional()) {
				$path .= "<li>Se edito el campo Tarjeta Profesional de \'".$usuario->GetT_profesional()."\' por \'$t_profesion\' </li>";  
				$change = true;
			}
			if ($notif != $usuario->Getnotif_usuario()) {
				$path .= "<li>Se edito el campo Recibir Notificaciones por Correo de \'".$usuario->Getnotif_usuario()."\' por \'$notif\' </li>";  
				$change = true;
			}
			if ($notif_admin != $usuario->Getnotif_admin()) {
				$path .= "<li>Se edito el campo Recibir Alertas de Actualiaciones en el Area \'".$usuario->Getnotif_usuario()."\' por \'$notif\' </li>";  
				$change = true;
			}
			if ($correos != $usuario->GetCorreos()) {
				$path .= "<li>Se edito el campo Recibir Correos de nuevos expedientes \'".$usuario->Getnotif_usuario()."\' por \'$notif\' </li>";  
				$change = true;
			}
			if ($change) {
				if($c->sql_quote($_REQUEST['newpassword']) == ""){
					$ar2 = array('p_nombre', 'p_apellido', 'sexo', 'cedula', 'exp_cedula', 'direccion', 'ciudad', 'departamento', 'telefono', 'celular', 'email', 'universidad', 't_profesional', 'notif_usuario', 'auditoria', 'notif_admin', 'correos');
					$ar1 = array($c->sql_quote($_REQUEST['p_nombre']), $c->sql_quote($_REQUEST['p_apellido']), $c->sql_quote($_REQUEST['sexo']), $c->sql_quote($_REQUEST['cedula']), $c->sql_quote($_REQUEST['exp_cedula']), $c->sql_quote($_REQUEST['direccion']), $c->sql_quote($_REQUEST['ciudad']), $c->sql_quote($_REQUEST['departamento']), $c->sql_quote($_REQUEST['telefono']), $c->sql_quote($_REQUEST['celular']), $c->sql_quote($_REQUEST['direccion_de_correo']), $c->sql_quote($_REQUEST['universidad']), $c->sql_quote($_REQUEST['t_profesional']), $notif, $c->sql_quote($path), $notif_admin, $correos);	
				}else{
					$ar2 = array('password', 'p_nombre', 'p_apellido', 'sexo', 'cedula', 'exp_cedula', 'direccion', 'ciudad', 'departamento', 'telefono', 'celular', 'email', 'universidad', 't_profesional', 'notif_usuario', 'auditoria', 'notif_admin', 'correos', 'updatepassword', 'sha2pww', 'fecha_cambio_clave');
					$ar1 = array($f->EncriptarPassword($c->sql_quote($_REQUEST['newpassword'])), $c->sql_quote($_REQUEST['p_nombre']), $c->sql_quote($_REQUEST['p_apellido']), $c->sql_quote($_REQUEST['sexo']), $c->sql_quote($_REQUEST['cedula']), $c->sql_quote($_REQUEST['exp_cedula']), $c->sql_quote($_REQUEST['direccion']), $c->sql_quote($_REQUEST['ciudad']), $c->sql_quote($_REQUEST['departamento']), $c->sql_quote($_REQUEST['telefono']), $c->sql_quote($_REQUEST['celular']), $c->sql_quote($_REQUEST['direccion_de_correo']), $c->sql_quote($_REQUEST['universidad']), $c->sql_quote($_REQUEST['t_profesional']), $notif, $c->sql_quote($path), $notif_admin, $correos, '0', '1', date("Y-m-d"));
				}
				// DEFINIMOS LOS ESTADOS DE SALIDA
				$output = array('Usuario actualizado', 'No se pudo actualizar el usuario'); 
				// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
				$constrain = 'WHERE user_id = "'.$_SESSION['usuario'].'"';	
				echo $act = $usuario->UpdateUsuarios($constrain, $ar2, $ar1, $output);
				#echo "Usuario Actualizado";
			}
		}
		function EliminarActividades($id, $tipo){
			global $con;
			global $f;
			global $c;
			$xpath = "";

			switch ($tipo) {
				case '1':
					$xpath = " and a.extra not in('trexp', 'texp', 'doc', 'an', 'rad', 'comp') ";
					break;
				case '1':
					$xpath = " and a.extra in('rad') ";
					break;	
				case '1':
					$xpath = " and a.extra in('doc', 'an') ";
					break;
				case '1':
					$xpath = " and a.extra in('comp') ";
					break;
				default:
					$xpath = " and a.extra not in('trexp', 'texp', 'doc', 'an', 'rad', 'comp') ";
					break;
			}


			switch ($id) {
				case '1':
					$sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and  a.type = '1'  and a.user_id = '".$_SESSION['usuario']."' and a.status = '0' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) $xpath group by eg.id";
					$qwa = $con->Query($sql);
			
					while($rrt = $con->FetchArray($qwa)){
						$p1  = $rrt[0];
					    $status = 2;
					    
				        $chck = $con->Query("SELECT * FROM alertas where id = '".$p1."'");
				        $t = $con->FetchAssoc($chck);
				        $type = $t["type"];
				        $id_evento = $t["id_evento"];
				        $ev = new MEvents_gestion;
				        $ev->CreateEvents_gestion("id", $id_evento);
				        if ($ev->Getrealizadopor() == "") {
				            $path = ", realizadopor = '".$_SESSION['usuario']."', fecha_realizado = '".date("Y-m-d H:i:s")."'";
				        }
				        $con->Query("UPDATE alertas set status = '".$status."' where id = '$p1'");
				        $con->Query("UPDATE alertas set status = '".$status."' where id_evento = '$id_evento'");
				        $con->Query("UPDATE events_gestion set status = '".$status."' ".$path." where id = '$id_evento'");
				    }
					break;
				case '2':
					$path = "status = '2'";
					$con->Query("UPDATE alertas SET keep_alive = '0', status = '2' where user_id = '".$_SESSION['usuario']."' and $path");
					break;
				case '3':
					$path = "status = '2' and keep_alive = '0' ";
					$con->Query("UPDATE alertas SET keep_alive = '-1', status = '2' where user_id = '".$_SESSION['usuario']."' and $path");
					break;
				default:
					
					break;
			}
			
		}
		function ActualizarPerfilUsuarioSuscriptor(){
			global $con;
			global $c;
			global $f;
			$object = new MSuscriptores_contactos;	
			$object->CreateSuscriptores_contactos('id', $_SESSION['usuario']);
			$SSC = new MSuscriptores_contactos_direccion;
			$query = $SSC->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$object -> GetId()."'");
			$path = "";
    		$change = false;
    		$nombre 	= $c->sql_quote($_REQUEST['nombre']);
			$identificacion 		= $c->sql_quote($_REQUEST['identificacion']);
			$type 	= $c->sql_quote($_REQUEST['type']);
			$direccion 			= $c->sql_quote($_REQUEST['direccion']);
			$ciudad 		= $c->sql_quote($_REQUEST['ciudad']);
			$telefonos 	= $c->sql_quote($_REQUEST['telefonos']);
			$email 	= $c->sql_quote($_REQUEST['email']);
			$password = $c->sql_quote($_REQUEST['password']);
			$newpassword = $c->sql_quote($_REQUEST['newpassword']);
			if ($notif == "") { $notif = '0'; }else{ $notif = '1'; }
			if ($nombre != $object->GetNombre()) {
				$path .= "<li>Se edito el campo Nombre de '".$object->GetNombre()."' por '$nombre' </li>";  
				$change = true;
			}
			if ($identificacion != $object->GetIdentificacion()) {
				$path .= "<li>Se edito el campo Identificacion de '".$object->GetIdentificacion()."' por '$identificacion' </li>";  
				$change = true;
			}
			if ($type != $object->GetType()) {
				$path .= "<li>Se edito el campo Type de '".$object->GetType()."' por '$type' </li>";  
				$change = true;
			}
			if ($direccion != $SSC->GetDireccion()) {
				$path .= "<li>Se edito el campo Direccion de '".$SSC->GetDireccion()."' por '$direccion' </li>";  
				$change = true;
			}
			if ($ciudad != $SSC->GetCiudad()) {
				$path .= "<li>Se edito el campo Ciudad de '".$SSC->GetCiudad()."' por '$ciudad' </li>";  
				$change = true;
			}
			if ($telefonos != $SSC->GetTelefonos()) {
				$path .= "<li>Se edito el campo Teléfono de '".$SSC->GetTelefonos()."' por '$telefonos' </li>";  
				$change = true;
			}
			if ($email != $SSC->GetEmail()) {
				$path .= "<li>Se edito el campo E-mail de '".$SSC->GetEmail()."' por '$email' </li>";  
				$change = true;
			}
			if ($change) {
				$ar2 = array('nombre', 'identificacion', 'type');
				$ar1 = array($nombre, $identificacion, $type);
				if ($password != $newpassword) {
					$password = md5($newpassword);
					array_push($ar2, "dec_pass");
					array_push($ar1, $newpassword);
					array_push($ar2, "password");
					array_push($ar1, $password);
				}
				$output = array('Usuario actualizado', 'No se pudo actualizar el usuario'); 
				$constrain = 'WHERE id = "'.$_SESSION['suscriptor_id'].'"';	
				echo $act = $object->UpdateSuscriptores_contactos($constrain, $ar2, $ar1, $output);
				echo ' ';
				$ar2 = array('direccion', 'ciudad', 'telefonos','email');
				$ar1 = array($direccion, $ciudad, $telefonos, $email);
				$output = array('Usuario actualizado', 'No se pudo actualizar el usuario'); 
				$constrain = 'WHERE id_contacto = "'.$_SESSION['suscriptor_id'].'"';
				echo $act = $SSC->UpdateSuscriptores_contactos_direccion($constrain, $ar2, $ar1, $output);
			}
		}
		function GetOfuscador(){
			global $con;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$pagina = $this->load_template_limpia('Listar Suscriptores_modulos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
	    	include(VIEWS.DS."home/ofuscador.php");	   			
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
		function CrearFirmaCrt($provincia, $ciudad, $organizacion, $nombre, $email, $clave, $organizacion_unidad){
			$REQUEST_C="CO"; /*País*/
			$REQUEST_ST=$provincia; /*Región o provincia*/
			$REQUEST_L=$ciudad; /*Ciudad*/
			$REQUEST_O=$organizacion_unidad; /*Organizacion*/
			$REQUEST_OU=$organizacion; /*Unidad organizacional*/
			$REQUEST_CN=$nombre; /*NOMBRE*/
			$REQUEST_emailAddress=$email; /*EMAIL*/
			$REQUEST_P=$clave; /*CLAVE*/

			$filename=ROOT . DS . 'archivos_uploads'.'/firmascrt/';
			if (!file_exists($filename)) {
			    mkdir(ROOT . DS . 'archivos_uploads'.'/firmascrt/', 0777);
			}

			$nombre_firma = strtolower(str_replace(' ', '', $nombre));

			$archi_crt = $filename.$nombre_firma;

			$SUBJECT="/C=$REQUEST_C/ST=$REQUEST_ST/L=$REQUEST_L/O=$REQUEST_O/OU=$REQUEST_OU/CN=$REQUEST_CN/emailAddress=$REQUEST_emailAddress";
			system('openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout '.$archi_crt.'.crt -out '.$archi_crt.'.crt -subj "'.$SUBJECT.'"');
			system('openssl pkcs12 -export -in '.$archi_crt.'.crt -out '.$archi_crt.'.p12 -passout pass:'.$REQUEST_P.'');

			echo '<script>window.location.href = "'.HOMEDIR.DS."dashboard/firmacrt/".$nombre_firma.'.crt/"</script>';
					
		}
		function GetFirmaCrt(){
			global $con;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$pagina = $this->load_template_limpia('Listar Suscriptores_modulos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
	    	include(VIEWS.DS."home/firmacrt.php");	   			
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
		function ResumenAhorro(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $c;
			global $f;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Suscriptores_modulos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
	    	include(VIEWS.DS."informes/ResumenAhorro.php");	   			
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
		function GeneradorDatosWidgetAlertas($tipo,$ini,$fin){
			global $con;
			global $c;
			global $f;
			$cantidad = 20;

			$arraydatos = array();






			if($tipo == 'Correspondencia_Fisica' || $tipo == 'todos'){
				$datos = "Alerta de Correspondencia_Fisica";
				$arraydatos['Correspondencia_Fisica'][0] = base64_encode($datos);
				$arraydatos['Correspondencia_Fisica'][1] = ($ini+$ic);	
				
			}
			if($tipo == 'PendientesValidar' || $tipo == 'todos'){
				$datos = "Alerta de PendientesValidar";
				$arraydatos['PendientesValidar'][0] = base64_encode($datos);
				$arraydatos['PendientesValidar'][1] = ($ini+$ic);	
				
			}
			if($tipo == 'SolicitudDocumentos' || $tipo == 'todos'){
				$datos = "Alerta de SolicitudDocumentos";
				$arraydatos['SolicitudDocumentos'][0] = base64_encode($datos);
				$arraydatos['SolicitudDocumentos'][1] = ($ini+$ic);	
				
			}
			if($tipo == 'TransferenciasPendientes' || $tipo == 'todos'){
				$datos = "Alerta de TransferenciasPendientes";
				$arraydatos['TransferenciasPendientes'][0] = base64_encode($datos);
				$arraydatos['TransferenciasPendientes'][1] = ($ini+$ic);	
				
			}

			echo json_encode($arraydatos);
		}







		function AlertaActividadesNuevas($tipo, $ini, $tab){
			global $con;
			global $c;
			global $f;
			$cantidad = 50;

			$aar = array( "0" => "azulclaro", "1" => "verde", "2" => "rojo" );
			$aar2 = array( "0" => "gen-act", "1" => "my-act", "2" => "late-act" );
            $datos = '';
            $i = 0; 
		    $j = 0;
		    $ic=0;

			include(VIEWS.DS."home/vistas_alertas/ActividadesNuevas.php");

		}

		function ExpedientesNuevos($tipo, $ini, $tab){
			global $con;
			global $c;
			global $f;
			$cantidad = 50;

			$aar = array( "0" => "azulclaro", "1" => "verde", "2" => "rojo" );
			$aar2 = array( "0" => "gen-act", "1" => "my-act", "2" => "late-act" );
            $datos = '';
            $i = 0; 
		    $j = 0;
		    $ic=0;
			include(VIEWS.DS."home/vistas_alertas/ExpedientesNuevos.php");

		}

		function DocumentosNuevos($tipo, $ini, $tab){
			global $con;
			global $c;
			global $f;
			$cantidad = 50;

			$aar = array( "0" => "azulclaro", "1" => "verde", "2" => "rojo" );
			$aar2 = array( "0" => "gen-act", "1" => "my-act", "2" => "late-act" );
            $datos = '';
            $i = 0; 
		    $j = 0;
		    $ic=0;
			include(VIEWS.DS."home/vistas_alertas/DocumentosNuevos.php");

		}

		function DocumentosCompartidos($tipo, $ini, $tab){
			global $con;
			global $c;
			global $f;
			$cantidad = 50;

			$aar = array( "0" => "azulclaro", "1" => "verde", "2" => "rojo" );
			$aar2 = array( "0" => "gen-act", "1" => "my-act", "2" => "late-act" );
            $datos = '';
            $i = 0; 
		    $j = 0;
		    $ic=0;

			include(VIEWS.DS."home/vistas_alertas/DocumentosCompartidos.php");

		}

		function AlertaCorreoElectronico($tipo, $ini, $tab){
			include_once(MODELS.DS.'Mailer_messageM.php');
			include_once(MODELS.DS.'Mailer_attachmentsM.php');
			include_once(MODELS.DS.'Mailer_from_messageM.php');
			include_once(MODELS.DS.'Mailer_replysM.php');

			global $con;
			global $c;
			global $f;
			$cantidad = 20;

			$datos = "";
			include(VIEWS.DS."home/vistas_alertas/CorreoElectronico.php");
			#include_once(VIEWS.DS.'mailer_message/detailed-alerts.php');

		}
		function AlertaDocumentosPendientesFirma($tipo, $ini, $tab){
			global $con;
			global $c;
			global $f;
			$cantidad = 20;

			include(VIEWS.DS."home/vistas_alertas/DocumentosPendientesFirma.php");

		}
		function AlertaExpedientesInactivos($tipo, $ini, $tab){
			global $con;
			global $c;
			global $f;
			$cantidad = 20;

			include(VIEWS.DS."home/vistas_alertas/ExpedientesInactivos.php");

		}
		function AlertaExpedientesVencer($tipo, $ini){
			global $con;
			global $c;
			global $f;
			$cantidad = 20;


		}
		function AlertaUltimosMovimientosGlobales($tipo, $ini, $tab){
			global $con;
			global $c;
			global $f;
			$cantidad = 20;

			include(VIEWS.DS."home/vistas_alertas/UltimosMovimientos.php");

		}
		function AlertaPendientesValidar($tipo, $ini){
			global $con;
			global $c;
			global $f;
			$cantidad = 20;
			
			$myid = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "a_i", $separador = " ");

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

			

			

			include(VIEWS.DS."gestion/PendientesValidar.php");

		}
		function AlertaCorrespondencia_Fisica($tipo, $ini){
			global $con;
			global $c;
			global $f;
			$cantidad = 20;

			include(VIEWS.DS."home/vistas_alertas/Correspondencia_Fisica.php");

		}
		function AlertaSolicitudDocumentos($tipo, $ini, $tab){
			global $con;
			global $c;
			global $f;
			$cantidad = 20;

			include(VIEWS.DS."home/vistas_alertas/SolicitudDocumentos.php");

		}
		function AlertaTransferenciasPendientes($tipo, $ini){
			global $con;
			global $c;
			global $f;
			$cantidad = 20;

			include(VIEWS.DS."home/vistas_alertas/TransferenciasPendientes.php");

		}

		function NuevoBuscador($id){

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $car;
			global $c;
			global $f;
			if ($_SESSION['suscriptor_id'] == "") {
				$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Resultados de busqueda ".$attr);	
			}else{
				$pagina = $this->load_templateAmpleApp(utf8_decode(PROJECTNAME).ST."Resultados de busqueda ".$attr);
			}		
			ob_start();
			include_once(VIEWS.DS.'home'.DS.'NuevoBuscador.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}
		function ChangeValorCuota($id){
			global $con;

			echo "<script>alert('".$id."')</script>";
			$x = array( 'correoelectronico' => "1", 
						'correspondencia_fisica' => "2", 
						'documentospendientesfirma' => "3", 
						'expedientesinactivos' => "4", 
						'expedientesvencer' => "5", 
						'pendientesvalidar' => "6", 
						'solicituddocumentos' => "7", 
						'transferenciaspendientes' => "8", 
						'ultimosmovimientosglobales' => "9", 
						'actividadesnuevas' => "0",
						'ver' => '10',
						'favoritos' => '11',
						'archivados' => '12'
					); 

			$_SESSION['alerta_activa'] = $x[$id];

			$con->Query("update usuarios set valor_cuota = '".$x[$id]."' where user_id = '".$_SESSION['usuario']."'");
		}
		function CheckDetailAlert($oficina, $tipo_documento, $pagina){
			global $con;
			global $c;
			global $f;

			switch ($type) {
                case 'p':
                    $t = 'sol_nueva';
					$estasog = 'Pendiente';
                    break;
                case 'r':
                    $t = 'sol_rechazo';
					$estasog = 'Rechazado';
                    break;
                case 's':
                    $t = 'sol_pausada';
					$estasog = 'En Espera Correccion';
                    break;
                case 'a':
                    $t = 'sol_aceptada';
					$estasog = 'Abierto';
                    break;      
                default:
                    $t = 'sol_nueva';
                    $estasog = 'Pendiente';
                    break;
            }

            $of = "";
            $doc = "";

            if ($oficina != "*") {
            	$of = " and oficina = '$oficina' " ;
            }
            if ($tipo_documento != "*" ) {
            	$doc = " and tipo_documento = '$tipo_documento' " ;
            }
/*
            $vec = $con->FetchAssoc($qr);
            $expsr = implode(",", $vec);

            $con->Query("update alertas_suscriptor set estado = '1' where type = '$t' and suscriptor_id = '".$_SESSION['suscriptor_id']."' and id_gestion in ($expsr)");
*/
			include(VIEWS.DS."home/vistas_alertas/DetalleCorrecciones.php");

		}

		function CheckDetailAlertUser($oficina, $pagina = "1"){
			global $con;
			global $c;
			global $f;

			switch ($type) {
                case 'p':
                    $t = 'sol_nueva';
					$estasog = 'Pendiente';
                    break;
                case 'r':
                    $t = 'sol_rechazo';
					$estasog = 'Rechazado';
                    break;
                case 's':
                    $t = 'sol_pausada';
					$estasog = 'En Espera Correccion';
                    break;
                case 'a':
                    $t = 'sol_aceptada';
					$estasog = 'Abierto';
                    break;      
                default:
                    $t = 'sol_nueva';
                    $estasog = 'Pendiente';
                    break;
            }

            $of = "";
            $doc = "";

            if ($oficina != "*") {
            	$of = " and suscriptor_id = '$oficina' " ;
            }
/*
            $vec = $con->FetchAssoc($qr);
            $expsr = implode(",", $vec);

            $con->Query("update alertas_suscriptor set estado = '1' where type = '$t' and suscriptor_id = '".$_SESSION['suscriptor_id']."' and id_gestion in ($expsr)");
*/
            $pagina = $c->sql_quote($_REQUEST['cn']);

		    $RegistrosAMostrar = 20;
			if(isset($pagina)){
				$RegistrosAEmpezar=($pagina-1)*$RegistrosAMostrar;
				$PagAct=$pagina;
			}else{
				$RegistrosAEmpezar=0;
				$PagAct=1;
			}	

			if ($_SESSION['suscriptor_id'] == "") {
				$fieldto = 'usuario_leido desc, usuario_updated desc';
			}else{
				$fieldto = 'suscriptor_leido desc, suscriptor_updated desc';
			}

			$qr = $con->Query("select id from gestion where nombre_destino = '".$_SESSION['user_ai']."' and estado_archivo = '1' and estado_respuesta != 'cerrado' $of order by $fieldto , id desc limit $RegistrosAEmpezar, $RegistrosAMostrar");

		    $p = "";

			while ($row = $con->FetchAssoc($qr)) {
				$p .= $c->GetVistaMailExpedienteUser($row['id']);
			}


			$querypag = $con->Query("select count(*) as t  from gestion where nombre_destino = '".$_SESSION['user_ai']."' and estado_archivo = '1' and estado_respuesta != 'cerrado'  $of");

		    $NroRegistros = $con->Result($querypag, 0, 't');
		    if($NroRegistros == 0){
		        $p .= '	<tr>
		                	<td colspan="5">
		                		<div class="row dn">
		                			<div class="col-md-12 text-center">
										<div class="btn btn-info btn-circle btn-xl" >
											<i class="mdi mdi-inbox"></i>
										</div>
		                			</div>
		                		</div>
		                    	<div class="alert alert-info m-t-30">No hay registros de ingresos de este item</div>
		                	</td>
		            	</tr>';
		    }

		    $PagAnt=$PagAct-1;
		    $PagSig=$PagAct+1;

		    $PagUlt=$NroRegistros/$RegistrosAMostrar;
		    $Res=$NroRegistros%$RegistrosAMostrar;

            $arr = array(	'a' => $p, 
            				"pag_oficina" => $oficina,
							"pag_pagina" => $pagina,
							"PagAnt" => $PagAnt,
							"PagSig" => $PagSig,
							"PagUlt" => $PagUlt);

			echo json_encode($arr);
			#include(VIEWS.DS."home/vistas_alertas/DetalleCorrecciones_usuario.php");

		}

		function GetFavoritos($pag = "1"){
			$object = new MUsuarios;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f;
			global $c;
			
			if ($pag == "") {
				$pag = 1;
			}
			
			if ($_SESSION['suscriptor_id'] == "") {
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				include_once(VIEWS.DS.'home'.DS.'favoritos_usuarios_limpia.php');				
			}else{

				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				$pagina = $this->load_templateAmpleApp(utf8_decode(PROJECTNAME).ST."Dashboard");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				#echo "Contenido Aqui!";
				include_once(VIEWS.DS.'home'.DS.'favoritos_suscriptores.php');
				// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
				$path = ob_get_clean();	
				// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
				// CARGAMOS LA PAGINA EN EL BROWSER	
				$this->view_page($pagina);			
			}
		}
		function GetArchivados($pag = "1"){
			$object = new MUsuarios;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f;
			global $c;

			if ($pag == "") {
				$pag = 1;
			}
			echo 'hello world';

			if ($_SESSION['suscriptor_id'] == "") {
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				include_once(VIEWS.DS.'home'.DS.'archivados_usuarios_limpia.php');				
			}else{
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				$pagina = $this->load_templateAmpleApp(utf8_decode(PROJECTNAME).ST."Dashboard");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				#echo "Contenido Aqui!";
				include_once(VIEWS.DS.'home'.DS.'archivados_suscriptores.php');
				// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			}
			
			
			// $path = ob_get_clean();	
			// $pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// // CARGAMOS LA PAGINA EN EL BROWSER	
			// $this->view_page($pagina);

		}
		function GetBoletin($pag = "1"){
			$object = new MUsuarios;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f;
			global $c;

			if ($pag == "") {
				$pag = 1;
			}

			$_SESSION["helper"] = "inicio";
			$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
			$pagina = $this->load_templateAmpleApp(utf8_decode(PROJECTNAME).ST."Dashboard");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			#echo "Contenido Aqui!";
			include_once(VIEWS.DS.'home'.DS.'boletin_suscriptores.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);


		}
		function GetAlertaExpediente($id, $type){
			global $con;
			global $c;
			global $f;

			$g = new MGestion;
			$g->CreateGestion("id", $id);
			$l = $con->Query("select * from alertas_suscriptor where suscriptor_id = '".$_SESSION['usuario']."' and tipo_usuario = '".$type."' and id_gestion = '".$id."' order by id desc");

			$i = 0;
			echo ASUNTO.": <b>".$g->GetObservacion()."</b><br>";
			echo '<a href="/gestion/ver/'.$id.'/" class="btn btn-primary m-t-10 m-b-20">Ir al Expediente</a>';
			echo '<div id="listadoactividadesrow"><ul class="list-group">';
			while ($row = $con->FetchAssoc($l)) {
				$i++;
				if ($row['estado'] == "0" ) {
					$unred = 'class="unread"';
					$new = '<span class="mdi mdi-alert-circle text-warning m-r-5" '.$c->Ayuda('353', 'tog').'></span>';
				}
				echo "<li class='list-group-item p-10'>$new "."<small><i>".$f->ObtenerFecha4($row['fechahora'])."</i></small><br>".$row['alerta'];
					if ($row['id_anexo'] != "" || $row['id_anexo'] != 0 ) {
						$ga = new MGestion_anexos;
						$ga->CreateGestion_anexos("id", $row['id_anexo']);
						$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$ga->GetUrl()."";
						echo '	<ul class="list-group">
									<li><b>Documento Adjunto:</b></li>
									<li><span style="font-size:12px; cursor:pointer" '."onclick='AbrirDocumento(\"".$ruta."\",\"pdf\",\"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'".'>'.$ga->GetNombre().'</span></li>
								</ul>';
					}
				echo "</li>";
				# code...
			}
			echo '</ul></div>';

			$con->Query("update alertas_suscriptor set estado = '1'   where suscriptor_id = '".$_SESSION['usuario']."' and tipo_usuario = '".$type."' and id_gestion = '".$id."'");
		}
		function PruebaCorreos($tm){
			global $con;
			global $f;
			global $c;

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $_SESSION['usuario']);

			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', '5');
			$emailMessage = $MPlantillas_email->GetContenido();

			$subject = "Prueba de Conexion SMTP";

			$exito = $c->fnEnviaEmailGlobal2(CONTACTMAIL,$u->GetP_nombre()." ".$u->GetP_apellido() ,$subject,$emailMessage,$tm, "1", $tm);

			if ($exito) {
				$se_envio_mail = "1";
				echo '<b>Mensaje enviado a la direccion de correo: '.$tm.'<br></b>';

			}else{
				$se_envio_mail = "0";
				echo "<h4>Estado Final</h4>";
				echo '<br><b>No se pudo enviar el mensaje a la direccion de correo: '.$tm.' ('.$exito.')'.'<br></b><br>';
			}
		}

		function VerCorrespondencia(){
			$object = new MUsuarios;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f;
			global $c;
			if ($_SESSION['suscriptor_id'] == "") {
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				include_once(VIEWS.DS.'home'.DS.'index_correspondenciasimple.php');
			}else{
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				$pagina = $this->load_templateAmpleApp(utf8_decode(PROJECTNAME).ST."Dashboard");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				#echo "Contenido Aqui!";
				include_once(VIEWS.DS.'home'.DS.'index_suscriptores.php');
				// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
				$path = ob_get_clean();	
				// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
				// CARGAMOS LA PAGINA EN EL BROWSER	
				$this->view_page($pagina);
			}
			
		}
		function GeteFavoritos($pag = "1"){
			$object = new MUsuarios;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f;
			global $c;
			
			if ($pag == "") {
				$pag = 1;
			}
			
			if ($_SESSION['suscriptor_id'] == "") {
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Dashboard");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				include_once(VIEWS.DS.'home'.DS.'favoritos_usuarios.php');				
			}else{

				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				$pagina = $this->load_templateAmpleApp(utf8_decode(PROJECTNAME).ST."Dashboard");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				#echo "Contenido Aqui!";
				include_once(VIEWS.DS.'home'.DS.'favoritos_suscriptores.php');
			}
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);			
		}
		function GeteArchivados($pag = "1"){
			$object = new MUsuarios;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f;
			global $c;

			if ($pag == "") {
				$pag = 1;
			}

			if ($_SESSION['suscriptor_id'] == "") {
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Dashboard");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				include_once(VIEWS.DS.'home'.DS.'archivados_usuarios.php');				
			}else{
				$_SESSION["helper"] = "inicio";
				$object->CreateUsuarios("user_id", $_SESSION["usuario"]);
				$pagina = $this->load_templateAmpleApp(utf8_decode(PROJECTNAME).ST."Dashboard");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				#echo "Contenido Aqui!";
				include_once(VIEWS.DS.'home'.DS.'archivados_suscriptores.php');
				// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			}
			
			
			$path = ob_get_clean();	
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);

		}
		function VerTareas($tipo, $ini, $tab){
			global $con;
			global $c;
			global $f;
			$cantidad = 50;

			$aar = array( "0" => "azulclaro", "1" => "verde", "2" => "rojo" );
			$aar2 = array( "0" => "gen-act", "1" => "my-act", "2" => "late-act" );
            $datos = '';
            $i = 0; 
		    $j = 0;
		    $ic=0;

			include(VIEWS.DS."home/vistas_alertas/Treas.php");

		}

		function Getseguimientoestados(){


			global $con;
			global $c;
			global $f;

			include(VIEWS.DS."gestion/GetSeguimientoEstados.php");

		}
	}
?>
