<?

session_start();

#error_reporting(E_ALL);

#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'Suscriptores_modulos_funcionesM.php');

	include_once(MODELS.DS.'Suscriptores_modulosM.php');

	include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'Suscriptores_contactosM.php');

	include_once(MODELS.DS.'Suscriptores_empresasM.php');

	include_once(MODELS.DS.'Suscriptores_interoperabilidadM.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	



	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	

	// Llamando al objeto a controlar		

	$ob = new CSuscriptores_modulos_funciones;

	$c = new Consultas;

	$f = new Funciones;

	

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('valor');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

	$ar1 = array($c->sql_quote($_REQUEST['cn']));	

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

			$ob->Insertar($c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["id_suscriptores_modulos"]), $c->sql_quote($_REQUEST["valor"]));

		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'editar')

			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')

			$ob->Editar($constrain, $ar2, $ar1, $output);

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')

			$ob->Eliminar($c->sql_quote($_REQUEST['id']));

		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			

		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')

			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar($c->sql_quote($_REQUEST['action']));

	

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CSuscriptores_modulos_funciones extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar($id){

			// CREANDO UN NUEVO MODELO			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template_limpia('Listar Suscriptores_modulos');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA



	    	include(VIEWS.DS."suscriptores_modulos_funciones/index.php");	   			

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

		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)

		function VistaInsertar(){

			//CARGA EL TEMPLATE

			$pagina = $this->load_template('Crear Suscriptores_modulos_funciones');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'suscriptores_modulos_funciones/FormInsertSuscriptores_modulos_funciones.php');				

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

	 		$pagina = $this->load_template('Editar Suscriptores_modulos_funciones');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

	 		// INVOCAMOS UN NUEVO OBJETO

		 	$object = new MSuscriptores_modulos_funciones;

			// LO CREAMOS 			

			$object->CreateSuscriptores_modulos_funciones('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'suscriptores_modulos_funciones/FormUpdateSuscriptores_modulos_funciones.php');		

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											

			$table = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER		

			$this->view_page($pagina);

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MSuscriptores_modulos_funciones;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Suscriptores_modulos_funciones');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarSuscriptores_modulos_funciones('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'suscriptores_modulos_funciones/Listar.php');	   			

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

		function Insertar($user_id, $id_suscriptores_modulos, $valor){

			// DEFINIENDO EL OBJETO			

			$object = new MSuscriptores_modulos_funciones;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertSuscriptores_modulos_funciones($user_id, $id_suscriptores_modulos, $valor);

			

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($create != '1')

				$this->VistaListar('ERROR AL REGISTRAR');

			else

				$this->VistaListar('OK!');	



		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			$object = new MSuscriptores_modulos_funciones;

			$create = $object->UpdateSuscriptores_modulos_funciones($constrain, $fields, $updates, $output);

			

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id){

			// DEFINIMOS UN OBJETO NUEVO						

			$object = new MSuscriptores_modulos_funciones;

			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			

			$delete = $object->DeleteSuscriptores_modulos_funciones($id); 		

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($delete != '1')

				echo 'ERROR AL ELIMINAR';

			else

				echo 'OK!';			

			

		}

	}

?>

		