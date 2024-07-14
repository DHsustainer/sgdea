<?
	session_start();
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CDependencias_tipologias_referencias;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('username', 'dependencia_id', 'title', 'col_1_name', 'col_1_type', 'col_1_size', 'col_2_name', 'col_2_type', 'col_2_size', 'col_3_name', 'col_3_type', 'col_3_size', 'col_4_name', 'col_4_type', 'col_4_size', 'col_5_name', 'col_5_type', 'col_5_size', 'col_6_name', 'col_6_type', 'col_6_size', 'col_7_name', 'col_7_type', 'col_7_size', 'col_8_name', 'col_8_type', 'col_8_size', 'col_9_name', 'col_9_type', 'col_9_size', 'col_10_name', 'col_10_type', 'col_10_size', 'col_11_name', 'col_11_type', 'col_11_size', 'col_12_name', 'col_12_type', 'col_12_size', 'col_13_name', 'col_13_type', 'col_13_size', 'col_14_name', 'col_14_type', 'col_14_size', 'col_15_name', 'col_15_type', 'col_15_size', 'fecha');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['dependencia_id']), $c->sql_quote($_REQUEST['title']), $c->sql_quote($_REQUEST['col_1_name']), $c->sql_quote($_REQUEST['col_1_type']), $c->sql_quote($_REQUEST['col_1_size']), $c->sql_quote($_REQUEST['col_2_name']), $c->sql_quote($_REQUEST['col_2_type']), $c->sql_quote($_REQUEST['col_2_size']), $c->sql_quote($_REQUEST['col_3_name']), $c->sql_quote($_REQUEST['col_3_type']), $c->sql_quote($_REQUEST['col_3_size']), $c->sql_quote($_REQUEST['col_4_name']), $c->sql_quote($_REQUEST['col_4_type']), $c->sql_quote($_REQUEST['col_4_size']), $c->sql_quote($_REQUEST['col_5_name']), $c->sql_quote($_REQUEST['col_5_type']), $c->sql_quote($_REQUEST['col_5_size']), $c->sql_quote($_REQUEST['col_6_name']), $c->sql_quote($_REQUEST['col_6_type']), $c->sql_quote($_REQUEST['col_6_size']), $c->sql_quote($_REQUEST['col_7_name']), $c->sql_quote($_REQUEST['col_7_type']), $c->sql_quote($_REQUEST['col_7_size']), $c->sql_quote($_REQUEST['col_8_name']), $c->sql_quote($_REQUEST['col_8_type']), $c->sql_quote($_REQUEST['col_8_size']), $c->sql_quote($_REQUEST['col_9_name']), $c->sql_quote($_REQUEST['col_9_type']), $c->sql_quote($_REQUEST['col_9_size']), $c->sql_quote($_REQUEST['col_10_name']), $c->sql_quote($_REQUEST['col_10_type']), $c->sql_quote($_REQUEST['col_10_size']), $c->sql_quote($_REQUEST['col_11_name']), $c->sql_quote($_REQUEST['col_11_type']), $c->sql_quote($_REQUEST['col_11_size']), $c->sql_quote($_REQUEST['col_12_name']), $c->sql_quote($_REQUEST['col_12_type']), $c->sql_quote($_REQUEST['col_12_size']), $c->sql_quote($_REQUEST['col_13_name']), $c->sql_quote($_REQUEST['col_13_type']), $c->sql_quote($_REQUEST['col_13_size']), $c->sql_quote($_REQUEST['col_14_name']), $c->sql_quote($_REQUEST['col_14_type']), $c->sql_quote($_REQUEST['col_14_size']), $c->sql_quote($_REQUEST['col_15_name']), $c->sql_quote($_REQUEST['col_15_type']), $c->sql_quote($_REQUEST['col_15_size']), $c->sql_quote($_REQUEST['fecha']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["username"]), $c->sql_quote($_REQUEST["dependencia_id"]), $c->sql_quote($_REQUEST["title"]), $c->sql_quote($_REQUEST["col_1_name"]), $c->sql_quote($_REQUEST["col_1_type"]), $c->sql_quote($_REQUEST["col_1_size"]), $c->sql_quote($_REQUEST["col_2_name"]), $c->sql_quote($_REQUEST["col_2_type"]), $c->sql_quote($_REQUEST["col_2_size"]), $c->sql_quote($_REQUEST["col_3_name"]), $c->sql_quote($_REQUEST["col_3_type"]), $c->sql_quote($_REQUEST["col_3_size"]), $c->sql_quote($_REQUEST["col_4_name"]), $c->sql_quote($_REQUEST["col_4_type"]), $c->sql_quote($_REQUEST["col_4_size"]), $c->sql_quote($_REQUEST["col_5_name"]), $c->sql_quote($_REQUEST["col_5_type"]), $c->sql_quote($_REQUEST["col_5_size"]), $c->sql_quote($_REQUEST["col_6_name"]), $c->sql_quote($_REQUEST["col_6_type"]), $c->sql_quote($_REQUEST["col_6_size"]), $c->sql_quote($_REQUEST["col_7_name"]), $c->sql_quote($_REQUEST["col_7_type"]), $c->sql_quote($_REQUEST["col_7_size"]), $c->sql_quote($_REQUEST["col_8_name"]), $c->sql_quote($_REQUEST["col_8_type"]), $c->sql_quote($_REQUEST["col_8_size"]), $c->sql_quote($_REQUEST["col_9_name"]), $c->sql_quote($_REQUEST["col_9_type"]), $c->sql_quote($_REQUEST["col_9_size"]), $c->sql_quote($_REQUEST["col_10_name"]), $c->sql_quote($_REQUEST["col_10_type"]), $c->sql_quote($_REQUEST["col_10_size"]), $c->sql_quote($_REQUEST["col_11_name"]), $c->sql_quote($_REQUEST["col_11_type"]), $c->sql_quote($_REQUEST["col_11_size"]), $c->sql_quote($_REQUEST["col_12_name"]), $c->sql_quote($_REQUEST["col_12_type"]), $c->sql_quote($_REQUEST["col_12_size"]), $c->sql_quote($_REQUEST["col_13_name"]), $c->sql_quote($_REQUEST["col_13_type"]), $c->sql_quote($_REQUEST["col_13_size"]), $c->sql_quote($_REQUEST["col_14_name"]), $c->sql_quote($_REQUEST["col_14_type"]), $c->sql_quote($_REQUEST["col_14_size"]), $c->sql_quote($_REQUEST["col_15_name"]), $c->sql_quote($_REQUEST["col_15_type"]), $c->sql_quote($_REQUEST["col_15_size"]), $c->sql_quote($_REQUEST["fecha"]));
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
	class CDependencias_tipologias_referencias extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MDependencias_tipologias_referencias;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Dependencias_tipologias_referencias');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarDependencias_tipologias_referencias();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'dependencias_tipologias_referencias/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Dependencias_tipologias_referencias');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'dependencias_tipologias_referencias/FormInsertDependencias_tipologias_referencias.php');				
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
	 		$pagina = $this->load_template('Editar Dependencias_tipologias_referencias');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MDependencias_tipologias_referencias;
			// LO CREAMOS 			
			$object->CreateDependencias_tipologias_referencias('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'dependencias_tipologias_referencias/FormUpdateDependencias_tipologias_referencias.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MDependencias_tipologias_referencias;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Dependencias_tipologias_referencias');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarDependencias_tipologias_referencias('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'dependencias_tipologias_referencias/Listar.php');	   			
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
		function Insertar($username, $dependencia_id, $title, $col_1_name, $col_1_type, $col_1_size, $col_2_name, $col_2_type, $col_2_size, $col_3_name, $col_3_type, $col_3_size, $col_4_name, $col_4_type, $col_4_size, $col_5_name, $col_5_type, $col_5_size, $col_6_name, $col_6_type, $col_6_size, $col_7_name, $col_7_type, $col_7_size, $col_8_name, $col_8_type, $col_8_size, $col_9_name, $col_9_type, $col_9_size, $col_10_name, $col_10_type, $col_10_size, $col_11_name, $col_11_type, $col_11_size, $col_12_name, $col_12_type, $col_12_size, $col_13_name, $col_13_type, $col_13_size, $col_14_name, $col_14_type, $col_14_size, $col_15_name, $col_15_type, $col_15_size, $fecha){
			// DEFINIENDO EL OBJETO			
			$object = new MDependencias_tipologias_referencias;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertDependencias_tipologias_referencias($username, $dependencia_id, $title, $col_1_name, $col_1_type, $col_1_size, $col_2_name, $col_2_type, $col_2_size, $col_3_name, $col_3_type, $col_3_size, $col_4_name, $col_4_type, $col_4_size, $col_5_name, $col_5_type, $col_5_size, $col_6_name, $col_6_type, $col_6_size, $col_7_name, $col_7_type, $col_7_size, $col_8_name, $col_8_type, $col_8_size, $col_9_name, $col_9_type, $col_9_size, $col_10_name, $col_10_type, $col_10_size, $col_11_name, $col_11_type, $col_11_size, $col_12_name, $col_12_type, $col_12_size, $col_13_name, $col_13_type, $col_13_size, $col_14_name, $col_14_type, $col_14_size, $col_15_name, $col_15_type, $col_15_size, $fecha);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MDependencias_tipologias_referencias;
			$create = $object->UpdateDependencias_tipologias_referencias($constrain, $fields, $updates, $output);
			
			echo $create;
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MDependencias_tipologias_referencias;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteDependencias_tipologias_referencias($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
	}
?>
		