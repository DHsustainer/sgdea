<?
	session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Suscriptores_modulosM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'Suscriptores_tipos_proyectosM.php');
	include_once(MODELS.DS.'Suscriptores_modulos_funcionesM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CSuscriptores_modulos;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('estado', 'descripcion', 'link', 'tipo', 'icono', 'imagen', 'tipo_elemento');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['estado']), $c->sql_quote($_REQUEST['descripcion']), $c->sql_quote($_REQUEST['link']), $c->sql_quote($_REQUEST['tipo']), $c->sql_quote($_REQUEST['icono']), $c->sql_quote($_REQUEST['imagen']), $c->sql_quote($_REQUEST['tipo_elemento']));	
	// DEFINIMOS LOS ESTADOS DE SALIDA
	$output = array('registro actualizado', 'no se pudo actualizar'); 
	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
	$constrain = 'WHERE id = '.$_REQUEST['id'];
	
		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
		if($c->sql_quote($_REQUEST['action']) == 'listar')
			$ob->VistaListar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	
			$ob->VistaInsertar();
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertar($c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["key_code"]), $c->sql_quote($_REQUEST["descripcion"]), $c->sql_quote($_REQUEST["link"]), $c->sql_quote($_REQUEST["tipo"]), $c->sql_quote($_REQUEST["icono"]), $c->sql_quote($_REQUEST["imagen"]), $_SESSION['usuario'], $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["id_proyecto"]), $c->sql_quote($_REQUEST["tipo_elemento"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	
		elseif($c->sql_quote($_REQUEST['action']) == 'actdesactivar'){
		// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
			$ar2 = array('estado');
			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
			$ar1 = array($c->sql_quote($_REQUEST['cn']));	
			// DEFINIMOS LOS ESTADOS DE SALIDA
			$output = array('registro actualizado', 'no se pudo actualizar'); 
			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
			$constrain = 'WHERE id = '.$_REQUEST['id'];
			$ob->Editar($constrain, $ar2, $ar1, $output, $c->sql_quote($_REQUEST['p1']));
			
		}
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output, $c->sql_quote($_REQUEST['id_proyecto']));
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			header("Location: ".HOMEDIR.DS.'suscriptores_modulos/listar/');
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CSuscriptores_modulos extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar($id){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$object = new MSuscriptores_modulos;
	    	$query = $object->ListarSuscriptores_modulos("WHERE id_proyecto = '".$id."'");
			
			$pagina = $this->load_template_config('Listar Suscriptores_modulos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

	    	include(VIEWS.DS."suscriptores_modulos/index.php");	   			
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
			$pagina = $this->load_template('Crear Suscriptores_modulos');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'suscriptores_modulos/FormInsertSuscriptores_modulos.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x, $idp){
		 	$object = new MSuscriptores_modulos;
			// LO CREAMOS 			
			$object->CreateSuscriptores_modulos('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'suscriptores_modulos/FormUpdateSuscriptores_modulos.php');		
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MSuscriptores_modulos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Suscriptores_modulos');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarSuscriptores_modulos('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'suscriptores_modulos/Listar.php');	   			
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
		function Insertar($estado, $nombre, $key_code, $descripcion, $link, $tipo, $icono, $imagen, $usuario, $fecha, $id_proyecto, $tipo_elemento){
			// DEFINIENDO EL OBJETO
			global $con;
			global $c;

			$object = new MSuscriptores_modulos;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertSuscriptores_modulos($estado, $nombre, $key_code, $descripcion, $link, $tipo, $icono, $imagen, $usuario, $fecha, $id_proyecto, $tipo_elemento);
			
			$id = $c->GetMaxIdTabla("suscriptores_modulos", "id");

			$qx = $con->Query("select * from suscriptores_proyectos where id_proyecto = '".$id_proyecto."'");

			while ($row = $con->FetchAssoc($qx)) {
				$ids = $row['id'];
				$smf = new MSuscriptores_modulos_funciones;
				$create = $smf->InsertSuscriptores_modulos_funciones($ids, $id, "0");
			}

			echo '<script>window.location.href = "'.HOMEDIR.DS."suscriptores_modulos/listar/".$id_proyecto."/".'"</script>';

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output, $id = "0"){
			$object = new MSuscriptores_modulos;
			
			$create = $object->UpdateSuscriptores_modulos($constrain, $fields, $updates, $output);

			echo '<script>window.location.href = "'.HOMEDIR.DS."suscriptores_modulos/listar/".$id."/".'"</script>';
				
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MSuscriptores_modulos;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteSuscriptores_modulos($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			echo '<script>window.location.href = "'.HOMEDIR.DS."suscriptores_modulos/".'"</script>';
			
		}
	}
?>
		