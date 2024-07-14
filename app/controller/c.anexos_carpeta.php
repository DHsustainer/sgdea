<?
	session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Anexos_carpetaM.php');
	include_once(MODELS.DS.'Folder_ciudadanoM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CAnexos_carpeta;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('folder_id', 'nombre', 'url', 'user_id', 'fecha', 'hora', 'ip', 'timest', 'estado', 'folio');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['folder_id']), $c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['url']), $c->sql_quote($_REQUEST['user_id']), $c->sql_quote($_REQUEST['fecha']), $c->sql_quote($_REQUEST['hora']), $c->sql_quote($_REQUEST['ip']), $c->sql_quote($_REQUEST['timest']), $c->sql_quote($_REQUEST['estado']), $c->sql_quote($_REQUEST['folio']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["folder_id"]), $c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["url"]), $c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["hora"]), $c->sql_quote($_REQUEST["ip"]), $c->sql_quote($_REQUEST["timest"]), $c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["folio"]));
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
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CAnexos_carpeta extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MAnexos_carpeta;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Anexos_carpeta');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarAnexos_carpeta();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'anexos_carpeta/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Anexos_carpeta');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'anexos_carpeta/FormInsertAnexos_carpeta.php');				
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
	 		$pagina = $this->load_template('Editar Anexos_carpeta');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MAnexos_carpeta;
			// LO CREAMOS 			
			$object->CreateAnexos_carpeta('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'anexos_carpeta/FormUpdateAnexos_carpeta.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
			global $con;
			global $c;

			$nfc = new MFolder_ciudadano;
			$nfc->CreateFolder_ciudadano("id", $_REQUEST['id']);

			
			$c->InsertarAlerta($nfc->GetUser_id(), "17", $_REQUEST['id']);
			$c->InsertarAlerta($nfc->GetUser_2(), "17", $_REQUEST['id']);



	 	}		
		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS		
		function Insertar($folder_id, $nombre, $url, $user_id, $fecha, $hora, $ip, $timest, $estado, $folio){
			
			global $con;
			global $c;

			$user_id = $_SESSION['usuario'];
			$fol = $con->Result($con->Query("select count (*) as t from anexos_carpeta where folder_id = '".$_REQUEST['id']."'"), 0, 't');
			$fol += 1;
			$filename=UPLOADS.DS.$user_id.'/';
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . $user_id, 0777);
			}
			$filename=UPLOADS.DS.$user_id.DS.'folders'.DS;
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . $user_id.DS.'folders', 0777);
			}

			$archivo = $_FILES["upl"]['name'];
			
			$prefijo = "f".md5($_SESSION['usuario'].date("Y-m-d H:i:s"));
			$extension = end(explode(".", $archivo));
			
			$name = $prefijo.'.'.$extension;


			if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
				if(move_uploaded_file($_FILES['upl']['tmp_name'], UPLOADS.DS.$user_id.DS.'folders'.DS.$name)){
					
					$user_id = $_SESSION['usuario']; 
					$fecha = date("Y-m-d"); 
					$hora = date("H:i:s"); 
					$ip = $_SERVER["REMOTE_ADDR"]; 
					$estado = "1";
					$folio = $fol;
					// DEFINIENDO EL OBJETO			
					$object = new MAnexos_carpeta;
					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
					$create = $object->InsertAnexos_carpeta($_REQUEST['id'], $_FILES['upl']['name'], $name, $user_id, $fecha, $hora, $ip, $timest, $estado, $folio);
					
					$nfc = new MFolder_ciudadano;
					$nfc->CreateFolder_ciudadano("id", $_REQUEST['id']);

					
					$c->Insert_Event(	'0',
										'Carga de Documentos',
										$c->sql_quote("Se ha cargado documentos a su carpeta ".strip_tags($nfc->GetTitulo())."  <a href='".HOMEDIR.DS."folder_ciudadano/ver/".$_REQUEST['id']."/'>Ver Carpeta </a>"),
										'1',
										'1');

					$c->InsertarAlerta($nfc->GetUser_id(), "17", $_REQUEST['id']);

					if($nfc->GetUser_2() != ""){

						$c->Insert_Event(	'0',
											'Carga de Documentos',
											$c->sql_quote("Se ha cargado documentos a su carpeta ".strip_tags($nfc->GetTitulo())."  <a href='".HOMEDIR.DS."folder_ciudadano/ver/".$_REQUEST['id']."/'>Ver Carpeta </a>"),
											'1',
											'1',
											'0', 
											$nfc->GetUser_2()
										);			
							}
						}

						$c->InsertarAlerta($nfc->GetUser_2(), "17", $_REQUEST['id']);
					}


		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MAnexos_carpeta;
			$create = $object->UpdateAnexos_carpeta($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MAnexos_carpeta;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteAnexos_carpeta($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
	}
?>	