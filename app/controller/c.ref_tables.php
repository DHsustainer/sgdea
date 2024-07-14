<?
	session_start();
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CRef_tables;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('username', 'title', 'col_1', 'col_2', 'col_3', 'col_4', 'col_5', 'col_6', 'col_7', 'col_8', 'col_9', 'col_10', 'col_11', 'col_12', 'col_13', 'col_14', 'col_15', 'col_16', 'col_17', 'col_18', 'col_19', 'col_20', 'col_21', 'col_22', 'col_23', 'col_24', 'col_25', 'col_26', 'col_27', 'col_28', 'col_29', 'col_30', 'fecha','es_generico');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$es_generico = ($c->sql_quote($_REQUEST['es_generico']) == "on")?"1":"0";
	$ar1 = array($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['title']), $c->sql_quote($_REQUEST['col_1']), $c->sql_quote($_REQUEST['col_2']), $c->sql_quote($_REQUEST['col_3']), $c->sql_quote($_REQUEST['col_4']), $c->sql_quote($_REQUEST['col_5']), $c->sql_quote($_REQUEST['col_6']), $c->sql_quote($_REQUEST['col_7']), $c->sql_quote($_REQUEST['col_8']), $c->sql_quote($_REQUEST['col_9']), $c->sql_quote($_REQUEST['col_10']), $c->sql_quote($_REQUEST['col_11']), $c->sql_quote($_REQUEST['col_12']), $c->sql_quote($_REQUEST['col_13']), $c->sql_quote($_REQUEST['col_14']), $c->sql_quote($_REQUEST['col_15']), $c->sql_quote($_REQUEST['col_16']), $c->sql_quote($_REQUEST['col_17']), $c->sql_quote($_REQUEST['col_18']), $c->sql_quote($_REQUEST['col_19']), $c->sql_quote($_REQUEST['col_20']), $c->sql_quote($_REQUEST['col_21']), $c->sql_quote($_REQUEST['col_22']), $c->sql_quote($_REQUEST['col_23']), $c->sql_quote($_REQUEST['col_24']), $c->sql_quote($_REQUEST['col_25']), $c->sql_quote($_REQUEST['col_26']), $c->sql_quote($_REQUEST['col_27']), $c->sql_quote($_REQUEST['col_28']), $c->sql_quote($_REQUEST['col_29']), $c->sql_quote($_REQUEST['col_30']), $c->sql_quote($_REQUEST['fecha']), $es_generico);	
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
			$ob->Insertar($c->sql_quote($_REQUEST["username"]), $c->sql_quote($_REQUEST["dependencia_id"]), $c->sql_quote($_REQUEST["title"]), $c->sql_quote($_REQUEST["col_1"]), $c->sql_quote($_REQUEST["col_2"]), $c->sql_quote($_REQUEST["col_3"]), $c->sql_quote($_REQUEST["col_4"]), $c->sql_quote($_REQUEST["col_5"]), $c->sql_quote($_REQUEST["col_6"]), $c->sql_quote($_REQUEST["col_7"]), $c->sql_quote($_REQUEST["col_8"]), $c->sql_quote($_REQUEST["col_9"]), $c->sql_quote($_REQUEST["col_10"]), $c->sql_quote($_REQUEST["col_11"]), $c->sql_quote($_REQUEST["col_12"]), $c->sql_quote($_REQUEST["col_13"]), $c->sql_quote($_REQUEST["col_14"]), $c->sql_quote($_REQUEST["col_15"]), $c->sql_quote($_REQUEST["col_16"]), $c->sql_quote($_REQUEST["col_17"]), $c->sql_quote($_REQUEST["col_18"]), $c->sql_quote($_REQUEST["col_19"]), $c->sql_quote($_REQUEST["col_20"]), $c->sql_quote($_REQUEST["col_21"]), $c->sql_quote($_REQUEST["col_22"]), $c->sql_quote($_REQUEST["col_23"]), $c->sql_quote($_REQUEST["col_24"]), $c->sql_quote($_REQUEST["col_25"]), $c->sql_quote($_REQUEST["col_26"]), $c->sql_quote($_REQUEST["col_27"]), $c->sql_quote($_REQUEST["col_28"]), $c->sql_quote($_REQUEST["col_29"]), $c->sql_quote($_REQUEST["col_30"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST['es_generico']));
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
	class CRef_tables extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MRef_tables;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Ref_tables');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarRef_tables();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'ref_tables/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Ref_tables');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'ref_tables/FormInsertRef_tables.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			global $con;
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MRef_tables;
			// LO CREAMOS 			
			$object->CreateRef_tables('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'ref_tables/FormUpdateRef_tables.php');		
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MRef_tables;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Ref_tables');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarRef_tables('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'ref_tables/Listar.php');	   			
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
		function Insertar($username, $dependencia_id, $title, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15, $col_16, $col_17, $col_18, $col_19, $col_20, $col_21, $col_22, $col_23, $col_24, $col_25, $col_26, $col_27, $col_28, $col_29, $col_30, $fecha, $es_generico){
			// DEFINIENDO EL OBJETO			
			global $c;
			global $con;

			$es_generico = ($es_generico == "on")?"1":"0";


			$object = new MRef_tables;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertRef_tables($username, $dependencia_id, $title, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15, $col_16, $col_17, $col_18, $col_19, $col_20, $col_21, $col_22, $col_23, $col_24, $col_25, $col_26, $col_27, $col_28, $col_29, $col_30, $fecha, $es_generico);
			
			$id = $c->GetMaxIdTabla("ref_tables", "id");

			echo $id;
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MRef_tables;
			$create = $object->UpdateRef_tables($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MRef_tables;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteRef_tables($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
	}
?>
		