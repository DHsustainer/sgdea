<?
session_start();

	//Invocando archivos que seran usados en nuestro controlador generico	

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'Ws_keysM.php');

	include_once(MODELS.DS.'CityM.php');

	include_once(MODELS.DS.'DependenciasM.php');

	include_once(MODELS.DS.'ProvinceM.php');

	include_once(MODELS.DS.'SeccionalM.php');

	include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'AreasM.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	



	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	

	// Llamando al objeto a controlar		

	$ob = new CWs_keys;

	$c = new Consultas;

	$f = new Funciones;

	

	

		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL

		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos

		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA

		if($c->sql_quote($_REQUEST['action']) == 'listar')

			$ob->VistaListar('');	

		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	

			$ob->VistaInsertar();

		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'xmlservicio')	

			$ob->XmlServicio($c->sql_quote($_REQUEST['id']));

		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')

		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR

			echo $ob->Insertar($f->randomText('11'), "1", date("Y-m-d H:i:s"), $c->sql_quote($_REQUEST["departamento"]), $c->sql_quote($_REQUEST["ciudad"]), $c->sql_quote($_REQUEST["oficina"]), $c->sql_quote($_REQUEST["dependencia_destino"]), $c->sql_quote($_REQUEST["nombre_destino"]), $c->sql_quote($_REQUEST["id_dependencia_raiz"]), $c->sql_quote($_REQUEST["tipo_documento"]), $c->sql_quote($_REQUEST["ip"]), $c->sql_quote($_REQUEST["tipokey"]), $_SESSION['usuario'], $c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["id_formulario"]));

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')

			$ob->Eliminar($c->sql_quote($_REQUEST['id']));

		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			

		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')

			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar('');		

	

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CWs_keys extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){

			// CREANDO UN NUEVO MODELO		

			$object = new MWs_keys;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$query = $object->ListarWs_keys('', " order by tipokey desc,nombre ");	    



			include_once(VIEWS.DS.'ws_keys/Listar.php');	   			



				

		}

		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)

		function XmlServicio($id){

			global $con;
			$object = new MWs_keys;
			$object->CreateWs_keys('id', $id);

			include_once(VIEWS.DS.'ws_keys/XmlServicioWs_keys.php');				



		}


		function VistaInsertar(){

			global $con;

			include_once(VIEWS.DS.'ws_keys/FormInsertWs_keys.php');				



		}

		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO

		function VistaEditar($x){

			// CARGA EL TEMPLATE			

	 		$pagina = $this->load_template('Editar Ws_keys');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

	 		// INVOCAMOS UN NUEVO OBJETO

		 	$object = new MWs_keys;

			// LO CREAMOS 			

			$object->CreateWs_keys('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'ws_keys/FormUpdateWs_keys.php');		

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											

			$table = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER		

			$this->view_page($pagina);

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MWs_keys;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Ws_keys');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarWs_keys('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'ws_keys/Listar.php');	   			

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

		function Insertar($llave, $estado, $fecha, $departemaento, $ciudad, $oficina, $area, $usuario_destino, $serie, $subserie, $ipkey, $tipokey, $usuario, $nombre, $formulario){

			// DEFINIENDO EL OBJETO			

			$object = new MWs_keys;
			if($tipokey == 'SET'){
				$departemaento = '0';
				$ciudad = '0';
				$oficina = '0';
				$area = '0';
				$usuario_destino = '0';
				$serie = '0';
				$subserie = '0';
				$formulario = '0';
			}
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertWs_keys($llave, $estado, $fecha, $departemaento, $ciudad, $oficina, $area, $usuario_destino, $serie, $subserie, $ipkey, $tipokey, $usuario, $nombre, $formulario);

			

			if ($create == "1") {

				return "1";

			}else{

				return "Error ".$create;

			}



		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			$object = new MWs_keys;

			$create = $object->UpdateWs_keys($constrain, $fields, $updates, $output);

			

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($create != '1')

				$this->VistaListar('ERROR AL REGISTRAR');

			else

				$this->VistaListar('OK!');						

			

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id){

			// DEFINIMOS UN OBJETO NUEVO						

			$object = new MWs_keys;

			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			

			$delete = $object->DeleteWs_keys($id); 		

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($delete != '1')

				echo 'ERROR AL ELIMINAR';

			else

				echo 'OK!';			

			

		}

	}

?>