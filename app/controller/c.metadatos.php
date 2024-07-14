<?

session_start();

date_default_timezone_set("America/Bogota");

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

	include_once(MODELS.DS.'Gestion_suscriptoresM.php');

	include_once(MODELS.DS.'SeccionalM.php');

	include_once(MODELS.DS.'AreasM.php');

	include_once(MODELS.DS.'Seccional_principalM.php');

	include_once(MODELS.DS.'Suscriptores_contactosM.php');

	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');

	include_once(MODELS.DS.'Suscriptores_referenciasM.php');

	include_once(MODELS.DS.'Suscriptores_big_dataM.php');

	include_once(MODELS.DS.'Areas_dependenciasM.php');

	include_once(MODELS.DS.'Alertas_usuariosM.php');

	include_once(MODELS.DS.'DependenciasM.php');

	include_once(MODELS.DS.'Dependencias_tipologiasM.php');

	include_once(MODELS.DS.'FolderM.php');

	include_once(MODELS.DS.'CityM.php');

	include_once(MODELS.DS.'ProvinceM.php');

	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	

	include_once(PLUGINS.DS.'PHPExcel/IOFactory.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	



			// Definiendo variables y conectandonos con la base de datos

		$con = new ConexionBaseDatos;

		$con->Connect($con);



		// Llamando al objeto a controlar		

		$ob = new CMetadatos;

		$c = new Consultas;

		$f = new Funciones;



		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL

		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos

		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA

		if($c->sql_quote($_REQUEST['action']) == 'listar')

			$ob->VistaTemplateMetadatos('');	

			// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	

		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaTemplateMetadatos('');		



	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CMetadatos extends MainController{



		

		function VistaTemplateMetadatos(){



			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$object = new MSuscriptores_Contactos;

	    	#$query = $object->ListarSuscriptores_modulos();

			

			$pagina = $this->load_template_limpiaAmple('Administracion de Metadatos');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA



	    	include(VIEWS.DS."metadatos/index.php");	   			

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