<?
	session_start();
	date_default_timezone_set("America/Bogota");
	//Invocando archivos que seran usados en nuestro controlador generico	
	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_suscriptorM.php');
	include_once(MODELS.DS.'Ayuda_librosM.php');
	include_once(MODELS.DS.'Ayuda_elementosM.php');
	include_once(MODELS.DS.'Ayuda_etiquetasM.php');
	include_once(MODELS.DS.'Ayuda_etiquetas_elementosM.php');
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
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Solicitudes_documentosM.php');
	include_once(MODELS.DS.'NotificacionesM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'SeccionalM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'Plantillas_emailM.php');
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');
	include_once(PLUGINS.DS.'PHPExcel.php');
	include_once(PLUGINS.DS.'nusoap/nusoap.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');
	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CAyuda;
	$c = new Consultas;
	$f = new Funciones;
	
		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
		if($c->sql_quote($_REQUEST['action']) == 'panel')
			$ob->OpenPanel($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')	
			$ob->Buscar($c->sql_quote($_REQUEST['id_busqueda_elemento']));
		elseif($c->sql_quote($_REQUEST['action']) == 'ver')	
			$ob->ViewDoc($c->sql_quote($_REQUEST['id']));
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->OpenPanel();	
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CAyuda extends MainController{
		
		function OpenPanel(){
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
			include_once(VIEWS.DS.'ayuda_libros'.DS.'index_public.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA			

			ob_start();				
			$table = ob_get_clean();	
			$pagina = $this->replace_content('/\#LOADER_HELP\#/ms', $table , $pagina);
			$this->view_page($pagina);
		}

		function Buscar($termino){
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
			include_once(VIEWS.DS.'ayuda_libros'.DS.'index_public.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA			

			ob_start();			
			include_once(VIEWS.DS.'ayuda_elementos'.DS.'busqueda_resultados.php');
			$table = ob_get_clean();	
			$pagina = $this->replace_content('/\#LOADER_HELP\#/ms', $table , $pagina);
			$this->view_page($pagina);
		}

		function ViewDoc($id){
			global $con;
			global $c;
			global $f;
			include_once(VIEWS.DS.'ayuda_elementos'.DS.'ver.php');
			#echo " <img src='".ASSETS."/manual/inicio/alertas.jpg' />";
			

		}
	}
?>
		