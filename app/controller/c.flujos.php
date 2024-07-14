<?
session_start();
date_default_timezone_set("America/Bogota");



#error_reporting(E_ALL);
#ini_set('display_errors', '1');



	//Invocando archivos que seran usados en nuestro controlador generico	



	include_once('app/basePaths.inc.php');







	include_once(MODELS.DS.'UsuariosM.php');



	include_once(MODELS.DS.'Super_adminM.php');



	include_once(MODELS.DS.'CityM.php');



	include_once(MODELS.DS.'ProvinceM.php');



	include_once(MODELS.DS.'GestionM.php');







	include_once(MODELS.DS.'Wf_elementosM.php');



	include_once(MODELS.DS.'Wf_elementos_conexionM.php');



	include_once(MODELS.DS.'Wf_logM.php');



	include_once(MODELS.DS.'Wf_mapasM.php');



	include_once(MODELS.DS.'Wf_mapas_elementosM.php');



	include_once(MODELS.DS.'Wf_tipos_elementosM.php');







	include_once(MODELS.DS.'Wf_gestion_mapasM.php');



	include_once(MODELS.DS.'Wf_gestion_mapas_elementosM.php');







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



			$ob->VistaEditor($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));	



		if($c->sql_quote($_REQUEST['action']) == 'mod')



			$ob->VistaEditor($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));	



		if($c->sql_quote($_REQUEST['action']) == 'gestion')



			$ob->VisualizarMapas($c->sql_quote($_REQUEST['id']));	



			// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	




	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ



	class CMetadatos extends MainController{







		



		function VistaEditor($id, $type = "S", $mapa = "0"){







			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			



			global $con;



			//CARGANDO LA PAGINA DE INTERFAZ			



			



			$pagina = $this->load_template_limpia('Gestión de Flujos Documentales');			



			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS



			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.



			ob_start();



			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO



			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA



	    	include(VIEWS.DS."flujos/index.php");	   			



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







		function VisualizarMapas($id, $type = "S", $mapa = "0" ){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			
			$pagina = $this->load_template_limpia('Gestión de Flujos Documentales');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
	    	include(VIEWS.DS."flujos/GetFlujos.php");	   			
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