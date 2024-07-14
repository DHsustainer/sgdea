<?php 
session_start();
date_default_timezone_set("America/Bogota");

#error_reporting(E_ALL);
#ini_set('display_errors', '1');
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'CaratulaM.php');
	include_once(VIEWS.DS.'events'.DS.'calendar.php');	
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'NotificacionesM.php');
	include_once(MODELS.DS.'Demandado_procesoM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');
	include_once(MODELS.DS.'Meta_referencias_camposM.php');
	include_once(MODELS.DS.'Gestion_compartirM.php');
	include_once(MODELS.DS.'Estados_gestionM.php');
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
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');
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


	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CEvents;
	$c = new Consultas;
	$f = new Funciones;


	$_SESSION["helper"] = "ayuda";
	
	if ($_SESSION['informes'] == "0") {
		header("LOCATION: ".HOMEDIR.trim(" /dashboard/"));
	}

	if($c->sql_quote($_REQUEST['action']) == 'infoexpedientes')
		$ob->GetFormExpedientes();
	elseif($c->sql_quote($_REQUEST['action']) == 'resultadoinforme')
		$ob->GetResultadoInforme();

	elseif($c->sql_quote($_REQUEST['action']) == 'metadatos')
		$ob->GetFormMetadatos();
	elseif($c->sql_quote($_REQUEST['action']) == 'GetInformeMetadatos')
		$ob->GetInformeMetadatos();

	elseif($c->sql_quote($_REQUEST['action']) == 'fuid')
		$ob->GetFormFuid();
	elseif($c->sql_quote($_REQUEST['action']) == 'GetFuid')
		$ob->GetFuid();

	elseif($c->sql_quote($_REQUEST['action']) == 'pqrs')
		$ob->GetFormPqrs();
	elseif($c->sql_quote($_REQUEST['action']) == 'getpqr')
		$ob->GetPqr();
	elseif($c->sql_quote($_REQUEST['action']) == 'corregirpqr')
		$ob->corregirpqr($c->sql_quote($_REQUEST['id']));

	elseif($c->sql_quote($_REQUEST['action']) == 'correspondencia')
		$ob->GetFormCorrespondencia();
	elseif($c->sql_quote($_REQUEST['action']) == 'getcorrespondencia')
		$ob->GetCorrespondencia();

	elseif($c->sql_quote($_REQUEST['action']) == 'eliminaciones')
		$ob->GetFormEliminaciones();
	elseif($c->sql_quote($_REQUEST['action']) == 'documentos')
		$ob->GetFormDocumentos();

	elseif($c->sql_quote($_REQUEST['action']) == 'GetDocumentos')
		$ob->GetDocumentos();
	elseif($c->sql_quote($_REQUEST['action']) == 'getgraficas')
		$ob->MyGraph();
	elseif($c->sql_quote($_REQUEST['action']) == 'load_filter')
		$ob->FilterQuery();

	elseif($c->sql_quote($_REQUEST['action']) == 'estadocuentas')
		$ob->GetFormestadocuentas();
	elseif($c->sql_quote($_REQUEST['action']) == 'getestadocuentas')
		$ob->Getestadocuentas();

	elseif($c->sql_quote($_REQUEST['action']) == 'nuevosusuarios')
		$ob->GetFormNuevosUsuarios();
	elseif($c->sql_quote($_REQUEST['action']) == 'getnuevosusuarios')
		$ob->GetNuevosUsuarios();

	elseif($c->sql_quote($_REQUEST['action']) == 'correspondenciaglobal')
		$ob->GetFormCorrespondenciaGlobal();
	elseif($c->sql_quote($_REQUEST['action']) == 'getcorrespondenciaglobal')
		$ob->GetCorrespondenciaGlobal();

	elseif($c->sql_quote($_REQUEST['action']) == 'citas')
		$ob->GetFormcitas();
	elseif($c->sql_quote($_REQUEST['action']) == 'getcitas')
		$ob->GetCitas();

	else
		$ob->GetInformes($c->sql_quote($_REQUEST['id']), 'actuaciones');

	class CEvents extends MainController{

		function GetInformes($id = "", $action){
			global $con;
			global $f;
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Informes del Expediente");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			$object = new MGestion;
			// LO CREAMOS 			
			$object->CreateGestion('id', $id);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'informes/Newdefault.php');				

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA			
			$this->view_page($pagina);
		}

		function GetFormExpedientes(){
			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/default.php');
		}

		function GetResultadoInforme(){
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Expedientes');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$departamento 			= trim($c->sql_quote($_REQUEST['departamento']));
			$ciudad 				= trim($c->sql_quote($_REQUEST['ciudad']));
			$oficina 				= trim($c->sql_quote($_REQUEST['oficina']));
			$dependencia_destino 	= trim($c->sql_quote($_REQUEST['dependencia_destino']));
			$nombre_destino 		= trim($c->sql_quote($_REQUEST['nombre_destino']));
			$id_dependencia_raiz 	= trim($c->sql_quote($_REQUEST['id_dependencia_raiz']));
			$tipo_documento 		= trim($c->sql_quote($_REQUEST['tipo_documento']));
			$prioridad 				= trim($c->sql_quote($_REQUEST['prioridad']));
			$estado_solicitud 		= trim($c->sql_quote($_REQUEST['estado_solicitud']));
			$estado_respuesta 		= trim($c->sql_quote($_REQUEST['estado_respuesta']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));
			$suscriptor_id 			= trim($c->sql_quote($_REQUEST['suscriptor_id']));

			$tipologia 				= trim($c->sql_quote($_REQUEST['tipologia']));
			$metadato 				= trim($c->sql_quote($_REQUEST['metadato']));
			$rweb 				= trim($c->sql_quote($_REQUEST['rweb']));

			include_once(VIEWS.DS.'informes/resumen.php');


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

		function GetPqr(){
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Expedientes');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$departamento 			= trim($c->sql_quote($_REQUEST['departamento']));
			$ciudad 				= trim($c->sql_quote($_REQUEST['ciudad']));
			$oficina 				= trim($c->sql_quote($_REQUEST['oficina']));
			$dependencia_destino 	= trim($c->sql_quote($_REQUEST['dependencia_destino']));
			$nombre_destino 		= trim($c->sql_quote($_REQUEST['nombre_destino']));
			$id_dependencia_raiz 	= trim($c->sql_quote($_REQUEST['id_dependencia_raiz']));
			$tipo_documento 		= trim($c->sql_quote($_REQUEST['tipo_documento']));
			$prioridad 				= trim($c->sql_quote($_REQUEST['prioridad']));
			$estado_solicitud 		= trim($c->sql_quote($_REQUEST['estado_solicitud']));
			$estado_respuesta 		= trim($c->sql_quote($_REQUEST['estado_respuesta']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));

			$tipologia 				= trim($c->sql_quote($_REQUEST['tipologia']));
			$metadato 				= trim($c->sql_quote($_REQUEST['metadato']));
			$rweb 				= trim($c->sql_quote($_REQUEST['rweb']));

			include_once(VIEWS.DS.'informes/resumenPQR.php');


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

		function GetCorrespondencia(){
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Correspondencia');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$departamento 			= trim($c->sql_quote($_REQUEST['departamento']));
			$ciudad 				= trim($c->sql_quote($_REQUEST['ciudad']));
			$oficina 				= trim($c->sql_quote($_REQUEST['oficina']));
			$dependencia_destino 	= trim($c->sql_quote($_REQUEST['dependencia_destino']));
			$nombre_destino 		= trim($c->sql_quote($_REQUEST['nombre_destino']));
			$id_dependencia_raiz 	= trim($c->sql_quote($_REQUEST['id_dependencia_raiz']));
			$tipo_documento 		= trim($c->sql_quote($_REQUEST['tipo_documento']));
			$prioridad 				= trim($c->sql_quote($_REQUEST['prioridad']));
			$estado_solicitud 		= trim($c->sql_quote($_REQUEST['estado_solicitud']));
			$estado_respuesta 		= trim($c->sql_quote($_REQUEST['estado_respuesta']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));
			$tipologia 				= trim($c->sql_quote($_REQUEST['tipologia']));
			$metadato 				= trim($c->sql_quote($_REQUEST['metadato']));
			$rweb 					= trim($c->sql_quote($_REQUEST['rweb']));
			$suscriptor_id 			= trim($c->sql_quote($_REQUEST['suscriptor_id']));
			$estadoc 				= trim($c->sql_quote($_REQUEST['estadoc']));

			include_once(VIEWS.DS.'informes/resumenCorrespondencia.php');


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

		function GetNuevosUsuarios(){
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Correspondencia');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$seccional 			= trim($c->sql_quote($_REQUEST['seccional']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));

			if($f_inicio == "") {
				$f_inicio = "2020-01-01";
			}
			if ($f_corte == "") {
				$f_corte = date("Y-m-d");
			}

			include_once(VIEWS.DS.'informes/resumenNuevosUsuarios.php');


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
		

		function corregirpqr($str){
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Expedientes');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			include_once(VIEWS.DS.'informes/CorregirPQR.php');


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

		function GetFormMetadatos(){
			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/metadatos.php');
		}

		function GetInformeMetadatos(){

			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Expedientes');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$departamento 			= trim($c->sql_quote($_REQUEST['departamento']));
			$ciudad 				= trim($c->sql_quote($_REQUEST['ciudad']));
			$oficina 				= trim($c->sql_quote($_REQUEST['oficina']));
			$dependencia_destino 	= trim($c->sql_quote($_REQUEST['dependencia_destino']));
			$nombre_destino 		= trim($c->sql_quote($_REQUEST['nombre_destino']));
			$id_dependencia_raiz 	= trim($c->sql_quote($_REQUEST['id_dependencia_raiz']));
			$tipo_documento 		= trim($c->sql_quote($_REQUEST['tipo_documento']));
			$prioridad 				= trim($c->sql_quote($_REQUEST['prioridad']));
			$estado_solicitud 		= trim($c->sql_quote($_REQUEST['estado_solicitud']));
			$estado_respuesta 		= trim($c->sql_quote($_REQUEST['estado_respuesta']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));

			$typetipo 				= trim($c->sql_quote($_REQUEST['typetipo']));
			$tipologia 				= trim($c->sql_quote($_REQUEST['tipologia']));
			$metadato 				= trim($c->sql_quote($_REQUEST['metadato']));
			$formulario 			= trim($c->sql_quote($_REQUEST['formulario']));

			include_once(VIEWS.DS.'informes/resumenMetadatos.php');

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
		function GetFormFuid(){
			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/fuid.php');
		}

		function GetFuid(){

			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Expedientes');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$departamento 			= trim($c->sql_quote($_REQUEST['departamento']));
			$ciudad 				= trim($c->sql_quote($_REQUEST['ciudad']));
			$oficina 				= trim($c->sql_quote($_REQUEST['oficina']));
			#area
			$dependencia_destino 	= trim($c->sql_quote($_REQUEST['dependencia_destino']));
			$nombre_destino 		= trim($c->sql_quote($_REQUEST['nombre_destino']));
			#serie
			$id_dependencia_raiz 	= trim($c->sql_quote($_REQUEST['id_dependencia_raiz']));
			#subserie
			$tipo_documento 		= trim($c->sql_quote($_REQUEST['tipo_documento']));

			
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));
			
			include_once(VIEWS.DS.'informes/resumenFuid.php');

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

		function GetFormEliminaciones(){
			global $con;
			global $c;
			global $f;
			
			include_once(VIEWS.DS.'informes/eliminados.php');
		
		}

		function GetFormDocumentos(){
			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/documentos.php');		
		}


		function GetFormPqrs(){
			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/pqr.php');
		}

		function GetFormCorrespondencia(){
			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/correspondencia.php');
		}

		function GetFormNuevosUsuarios(){
			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/nuevosusuarios.php');
		}

		

		function GetDocumentos(){
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Expedientes');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$departamento 			= trim($c->sql_quote($_REQUEST['departamento']));
			$ciudad 				= trim($c->sql_quote($_REQUEST['ciudad']));
			$oficina 				= trim($c->sql_quote($_REQUEST['oficina']));
			#area
			$dependencia_destino 	= trim($c->sql_quote($_REQUEST['dependencia_destino']));
			$nombre_destino 		= trim($c->sql_quote($_REQUEST['nombre_destino']));
			#serie
			$id_dependencia_raiz 	= trim($c->sql_quote($_REQUEST['id_dependencia_raiz']));
			#subserie
			$tipo_documento 		= trim($c->sql_quote($_REQUEST['tipo_documento']));
			$tipologia 				= trim($c->sql_quote($_REQUEST['tipologia']));
			$estado_respuesta 		= trim($c->sql_quote($_REQUEST['estado_respuesta']));
			
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));

			$tenerencuenta 				= trim($c->sql_quote($_REQUEST['tenerencuenta']));
			
			include_once(VIEWS.DS.'informes/resumenDocumentos.php');

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

		function MyGraph(){
			global $con;
			global $c;
			global $f;

			$rx = rand(0, 1000000);

			include_once(VIEWS.DS.'informes/showgraph.php');
		}

		function FilterQuery(){
			global $con;
			global $c;
			global $f;

			$idform 				= trim($c->sql_quote($_REQUEST['idform']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));

			$campo = new MMeta_referencias_campos;
			$campo->CreateMeta_referencias_campos("id", $_REQUEST[$_REQUEST['filter']]);

			

			if ($campo->GetTipo_elemento() == "8") {
				echo "<div class='alert alert-warning'>Como el campo seleccionado contiene valores numéricos, se usará para sumar y agrupar la información del informe</div>";
			}else{

				$str = "select * from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where 
									campo_id = '".$_REQUEST[$_REQUEST['filter']]."' and
	                                ref_id = '".$idform."' and 
	                                gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."' group by valor order by valor ";

	            #echo $str;	
				$q = $con->Query($str);
				echo '<label><input id="checkAll'.$_REQUEST['filter'].'" onclick="checkTodos(this.id,\'sbox'.$_REQUEST['filter'].'\');" name="checkAll" type="checkbox" /><strong> Seleccionar / Deseleccionar Todos</strong></label>
					<hr style="margin-top:5px; margin-bottom:5px">
					<div id="sbox'.$_REQUEST['filter'].'">';
				while ($row = $con->FetchAssoc($q)) {
					if ($row['valor'] == "") {
						echo '	<div>
								<label style="font-size:12px">
									<input type="checkbox" name="'.$_REQUEST['filter'].'_values[]" value="'.$row['valor'].'"> VACÍO
								</label>
							</div>';
					}else{
						echo '	<div>
									<label style="font-size:12px">
										<input type="checkbox" name="'.$_REQUEST['filter'].'_values[]" value="'.$row['valor'].'"> '.$row['valor'].'
									</label>
								</div>';
						
					}
				}
				echo '</div>';
			}
		}
		function GetFormCorrespondenciaGlobal(){

			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/CorrespondenciaGlobal.php');

		}
		function GetCorrespondenciaGlobal(){
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Correspondencia');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$seccional 			= trim($c->sql_quote($_REQUEST['seccional']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));

			if($f_inicio == "") {
				$f_inicio = "2020-01-01";
			}
			if ($f_corte == "") {
				$f_corte = date("Y-m-d");
			}

			include_once(VIEWS.DS.'informes/resumenCorrespondenciaGlobal.php');


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

		function GetFormestadocuentas(){

			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/Estado_cuentas.php');

		}
		function Getestadocuentas(){
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Correspondencia');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$seccional 			= trim($c->sql_quote($_REQUEST['seccional']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));

			if($f_inicio == "") {
				$f_inicio = "2020-01-01";
			}
			if ($f_corte == "") {
				$f_corte = date("Y-m-d");
			}

			if ($_SESSION['MODULES']['configuracion_pagos'] == "1"){
			  	include_once(VIEWS.DS.'informes/resumenCuentas_renovaciones.php');
			}elseif($_SESSION['MODULES']['configuracion_pagos'] == "2"){
				include_once(VIEWS.DS.'informes/resumenCuentas.php');
			}


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

		function GetFormcitas(){

			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'informes/Citas.php');

		}
		function GetCitas(){
			global $con;
			global $c;
			global $f;

			$pagina = $this->load_template_limpia('Informe de Correspondencia');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$seccional 				= trim($c->sql_quote($_REQUEST['seccional']));
			$f_inicio 				= trim($c->sql_quote($_REQUEST['f_inicio']));
			$f_corte 				= trim($c->sql_quote($_REQUEST['f_corte']));
			$ignorar 				= trim($c->sql_quote($_REQUEST['ignorar']));

			if($f_inicio == "") {
				$f_inicio = "2020-01-01";
			}
			if ($f_corte == "") {
				$f_corte = date("Y-m-d");
			}

			include_once(VIEWS.DS.'informes/resumenCitas.php');

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

	}
 ?>