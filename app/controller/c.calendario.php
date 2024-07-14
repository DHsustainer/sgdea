<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'CaratulaM.php');
	include_once(VIEWS.DS.'events'.DS.'calendar.php');	
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
	include_once(MODELS.DS.'Documentos_gestionM.php');
	include_once(MODELS.DS.'Dependencias_documentosM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');
	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'SeccionalM.php');	
	include_once(MODELS.DS.'Solicitudes_documentosM.php');	
	include_once(MODELS.DS.'Gestion_tipologias_big_dataM.php');
	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');	
	include_once(MODELS.DS.'Meta_big_dataM.php');	
	include_once(MODELS.DS.'Meta_referencias_camposM.php');	
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');	
	include_once(MODELS.DS.'Meta_listas_valoresM.php');	
	include_once(MODELS.DS.'Usuarios_configurar_firma_digitalM.php');	
	include_once(MODELS.DS.'Gestion_anexos_permisos_documentosM.php');	
	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');	

	#error_reporting(E_ALL);
	#ini_set('display_errors', '1');

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CBuscador;
	$c = new Consultas;
	$f = new Funciones;
		
	// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
	// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
	if($c->sql_quote($_REQUEST['action']) == '')
		$ob->Nulled($_REQUEST['id'], $_REQUEST['cn']);
	else
	// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO	
		$ob->Nulled($_REQUEST['id'], $_REQUEST['cn']);
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CBuscador extends MainController{
		
		function Nulled(){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $car;
			global $c;
			global $f;

			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Tablero de Actividades ".$attr);	
			ob_start();
			include_once(VIEWS.DS.'usuarios'.DS.'Calendar.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER														
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);
		}// DEFINIENDO LA FUNCION LISTAR 		

	}
?>
		