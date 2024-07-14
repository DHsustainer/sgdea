<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Suscriptores_referenciasM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CSuscriptores_referencias;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('username', 'title', 'col_1', 'col_2', 'col_3', 'col_4', 'col_5', 'col_6', 'col_7', 'col_8', 'col_9', 'col_10', 'col_11', 'col_12', 'col_13', 'col_14', 'col_15', 'col_16', 'col_17', 'col_18', 'col_19', 'col_20', 'col_21', 'col_22', 'col_23', 'col_24', 'col_25', 'col_26', 'col_27', 'col_28', 'col_29', 'col_30', 'type_1', 'type_2', 'type_3', 'type_4', 'type_5', 'type_6', 'type_7', 'type_8', 'type_9', 'type_10', 'type_11', 'type_12', 'type_13', 'type_14', 'type_15', 'type_16', 'type_17', 'type_18', 'type_19', 'type_20', 'type_21', 'type_22', 'type_23', 'type_24', 'type_25', 'type_26', 'type_27', 'type_28', 'type_29', 'type_30');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['title']), $c->sql_quote($_REQUEST['col_1']), $c->sql_quote($_REQUEST['col_2']), $c->sql_quote($_REQUEST['col_3']), $c->sql_quote($_REQUEST['col_4']), $c->sql_quote($_REQUEST['col_5']), $c->sql_quote($_REQUEST['col_6']), $c->sql_quote($_REQUEST['col_7']), $c->sql_quote($_REQUEST['col_8']), $c->sql_quote($_REQUEST['col_9']), $c->sql_quote($_REQUEST['col_10']), $c->sql_quote($_REQUEST['col_11']), $c->sql_quote($_REQUEST['col_12']), $c->sql_quote($_REQUEST['col_13']), $c->sql_quote($_REQUEST['col_14']), $c->sql_quote($_REQUEST['col_15']), $c->sql_quote($_REQUEST['col_16']), $c->sql_quote($_REQUEST['col_17']), $c->sql_quote($_REQUEST['col_18']), $c->sql_quote($_REQUEST['col_19']), $c->sql_quote($_REQUEST['col_20']), $c->sql_quote($_REQUEST['col_21']), $c->sql_quote($_REQUEST['col_22']), $c->sql_quote($_REQUEST['col_23']), $c->sql_quote($_REQUEST['col_24']), $c->sql_quote($_REQUEST['col_25']), $c->sql_quote($_REQUEST['col_26']), $c->sql_quote($_REQUEST['col_27']), $c->sql_quote($_REQUEST['col_28']), $c->sql_quote($_REQUEST['col_29']), $c->sql_quote($_REQUEST['col_30']), $c->sql_quote($_REQUEST['type_1']), $c->sql_quote($_REQUEST['type_2']), $c->sql_quote($_REQUEST['type_3']), $c->sql_quote($_REQUEST['type_4']), $c->sql_quote($_REQUEST['type_5']), $c->sql_quote($_REQUEST['type_6']), $c->sql_quote($_REQUEST['type_7']), $c->sql_quote($_REQUEST['type_8']), $c->sql_quote($_REQUEST['type_9']), $c->sql_quote($_REQUEST['type_10']), $c->sql_quote($_REQUEST['type_11']), $c->sql_quote($_REQUEST['type_12']), $c->sql_quote($_REQUEST['type_13']), $c->sql_quote($_REQUEST['type_14']), $c->sql_quote($_REQUEST['type_15']), $c->sql_quote($_REQUEST['type_16']), $c->sql_quote($_REQUEST['type_17']), $c->sql_quote($_REQUEST['type_18']), $c->sql_quote($_REQUEST['type_19']), $c->sql_quote($_REQUEST['type_20']), $c->sql_quote($_REQUEST['type_21']), $c->sql_quote($_REQUEST['type_22']), $c->sql_quote($_REQUEST['type_23']), $c->sql_quote($_REQUEST['type_24']), $c->sql_quote($_REQUEST['type_25']), $c->sql_quote($_REQUEST['type_26']), $c->sql_quote($_REQUEST['type_27']), $c->sql_quote($_REQUEST['type_28']), $c->sql_quote($_REQUEST['type_29']), $c->sql_quote($_REQUEST['type_30']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["username"]), $c->sql_quote($_REQUEST["title"]), $c->sql_quote($_REQUEST["col_1"]), $c->sql_quote($_REQUEST["col_2"]), $c->sql_quote($_REQUEST["col_3"]), $c->sql_quote($_REQUEST["col_4"]), $c->sql_quote($_REQUEST["col_5"]), $c->sql_quote($_REQUEST["col_6"]), $c->sql_quote($_REQUEST["col_7"]), $c->sql_quote($_REQUEST["col_8"]), $c->sql_quote($_REQUEST["col_9"]), $c->sql_quote($_REQUEST["col_10"]), $c->sql_quote($_REQUEST["col_11"]), $c->sql_quote($_REQUEST["col_12"]), $c->sql_quote($_REQUEST["col_13"]), $c->sql_quote($_REQUEST["col_14"]), $c->sql_quote($_REQUEST["col_15"]), $c->sql_quote($_REQUEST["col_16"]), $c->sql_quote($_REQUEST["col_17"]), $c->sql_quote($_REQUEST["col_18"]), $c->sql_quote($_REQUEST["col_19"]), $c->sql_quote($_REQUEST["col_20"]), $c->sql_quote($_REQUEST["col_21"]), $c->sql_quote($_REQUEST["col_22"]), $c->sql_quote($_REQUEST["col_23"]), $c->sql_quote($_REQUEST["col_24"]), $c->sql_quote($_REQUEST["col_25"]), $c->sql_quote($_REQUEST["col_26"]), $c->sql_quote($_REQUEST["col_27"]), $c->sql_quote($_REQUEST["col_28"]), $c->sql_quote($_REQUEST["col_29"]), $c->sql_quote($_REQUEST["col_30"]), $c->sql_quote($_REQUEST["type_1"]), $c->sql_quote($_REQUEST["type_2"]), $c->sql_quote($_REQUEST["type_3"]), $c->sql_quote($_REQUEST["type_4"]), $c->sql_quote($_REQUEST["type_5"]), $c->sql_quote($_REQUEST["type_6"]), $c->sql_quote($_REQUEST["type_7"]), $c->sql_quote($_REQUEST["type_8"]), $c->sql_quote($_REQUEST["type_9"]), $c->sql_quote($_REQUEST["type_10"]), $c->sql_quote($_REQUEST["type_11"]), $c->sql_quote($_REQUEST["type_12"]), $c->sql_quote($_REQUEST["type_13"]), $c->sql_quote($_REQUEST["type_14"]), $c->sql_quote($_REQUEST["type_15"]), $c->sql_quote($_REQUEST["type_16"]), $c->sql_quote($_REQUEST["type_17"]), $c->sql_quote($_REQUEST["type_18"]), $c->sql_quote($_REQUEST["type_19"]), $c->sql_quote($_REQUEST["type_20"]), $c->sql_quote($_REQUEST["type_21"]), $c->sql_quote($_REQUEST["type_22"]), $c->sql_quote($_REQUEST["type_23"]), $c->sql_quote($_REQUEST["type_24"]), $c->sql_quote($_REQUEST["type_25"]), $c->sql_quote($_REQUEST["type_26"]), $c->sql_quote($_REQUEST["type_27"]), $c->sql_quote($_REQUEST["type_28"]), $c->sql_quote($_REQUEST["type_29"]), $c->sql_quote($_REQUEST["type_30"]));
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
		elseif($c->sql_quote($_REQUEST['action']) == 'GetListado')
			$ob->GetListado($c->sql_quote($_REQUEST['id']));
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CSuscriptores_referencias extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MSuscriptores_referencias;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Suscriptores_referencias');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarSuscriptores_referencias();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'suscriptores_referencias/Listar.php');	   			
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
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$object = new MSuscriptores_Contactos;
	    	#$query = $object->ListarSuscriptores_modulos();
			
			$pagina = $this->load_template_limpia('Crear Tipo de '.SUSCRIPTORDEPENDENCIA);			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

	    	include_once(VIEWS.DS.'suscriptores_referencias/FormInsertSuscriptores_referencias.php');				
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
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template('Editar Suscriptores_referencias');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MSuscriptores_referencias;
			// LO CREAMOS 			
			$object->CreateSuscriptores_referencias('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'suscriptores_referencias/FormUpdateSuscriptores_referencias.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MSuscriptores_referencias;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Suscriptores_referencias');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarSuscriptores_referencias('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'suscriptores_referencias/Listar.php');	   			
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
		function Insertar($username, $title, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15, $col_16, $col_17, $col_18, $col_19, $col_20, $col_21, $col_22, $col_23, $col_24, $col_25, $col_26, $col_27, $col_28, $col_29, $col_30, $type_1, $type_2, $type_3, $type_4, $type_5, $type_6, $type_7, $type_8, $type_9, $type_10, $type_11, $type_12, $type_13, $type_14, $type_15, $type_16, $type_17, $type_18, $type_19, $type_20, $type_21, $type_22, $type_23, $type_24, $type_25, $type_26, $type_27, $type_28, $type_29, $type_30){
			// DEFINIENDO EL OBJETO			
			$object = new MSuscriptores_referencias;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertSuscriptores_referencias($username, $title, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15, $col_16, $col_17, $col_18, $col_19, $col_20, $col_21, $col_22, $col_23, $col_24, $col_25, $col_26, $col_27, $col_28, $col_29, $col_30, $type_1, $type_2, $type_3, $type_4, $type_5, $type_6, $type_7, $type_8, $type_9, $type_10, $type_11, $type_12, $type_13, $type_14, $type_15, $type_16, $type_17, $type_18, $type_19, $type_20, $type_21, $type_22, $type_23, $type_24, $type_25, $type_26, $type_27, $type_28, $type_29, $type_30);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MSuscriptores_referencias;
			$create = $object->UpdateSuscriptores_referencias($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MSuscriptores_referencias;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteSuscriptores_referencias($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}

		function GetListado($id){
			global $con;
			// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MSuscriptores_referencias;
			$object->CreateSuscriptores_referencias('id', $id);

			$arr = array();

			if ($object->GetCol_1()  != "" || $object->GetCol_1()  != "0" ) { $arr['col_1']  = trim($object->GetCol_1()); }
			if ($object->GetCol_2()  != "" || $object->GetCol_2()  != "0" ) { $arr['col_2']  = trim($object->GetCol_2()); }
			if ($object->GetCol_3()  != "" || $object->GetCol_3()  != "0" ) { $arr['col_3']  = trim($object->GetCol_3()); }
			if ($object->GetCol_4()  != "" || $object->GetCol_4()  != "0" ) { $arr['col_4']  = trim($object->GetCol_4()); }
			if ($object->GetCol_5()  != "" || $object->GetCol_5()  != "0" ) { $arr['col_5']  = trim($object->GetCol_5()); }
			if ($object->GetCol_6()  != "" || $object->GetCol_6()  != "0" ) { $arr['col_6']  = trim($object->GetCol_6()); }
			if ($object->GetCol_7()  != "" || $object->GetCol_7()  != "0" ) { $arr['col_7']  = trim($object->GetCol_7()); }
			if ($object->GetCol_8()  != "" || $object->GetCol_8()  != "0" ) { $arr['col_8']  = trim($object->GetCol_8()); }
			if ($object->GetCol_9()  != "" || $object->GetCol_9()  != "0" ) { $arr['col_9']  = trim($object->GetCol_9()); }
			if ($object->GetCol_10() != "" || $object->GetCol_10() != "0" ) { $arr['col_10'] = trim($object->GetCol_10()); }
			if ($object->GetCol_11() != "" || $object->GetCol_11() != "0" ) { $arr['col_11'] = trim($object->GetCol_11()); }
			if ($object->GetCol_12() != "" || $object->GetCol_12() != "0" ) { $arr['col_12'] = trim($object->GetCol_12()); }
			if ($object->GetCol_13() != "" || $object->GetCol_13() != "0" ) { $arr['col_13'] = trim($object->GetCol_13()); }
			if ($object->GetCol_14() != "" || $object->GetCol_14() != "0" ) { $arr['col_14'] = trim($object->GetCol_14()); }
			if ($object->GetCol_15() != "" || $object->GetCol_15() != "0" ) { $arr['col_15'] = trim($object->GetCol_15()); }
			if ($object->GetCol_16() != "" || $object->GetCol_16() != "0" ) { $arr['col_16'] = trim($object->GetCol_16()); }
			if ($object->GetCol_17() != "" || $object->GetCol_17() != "0" ) { $arr['col_17'] = trim($object->GetCol_17()); }
			if ($object->GetCol_18() != "" || $object->GetCol_18() != "0" ) { $arr['col_18'] = trim($object->GetCol_18()); }
			if ($object->GetCol_19() != "" || $object->GetCol_19() != "0" ) { $arr['col_19'] = trim($object->GetCol_19()); }
			if ($object->GetCol_20() != "" || $object->GetCol_20() != "0" ) { $arr['col_20'] = trim($object->GetCol_20()); }
			if ($object->GetCol_21() != "" || $object->GetCol_21() != "0" ) { $arr['col_21'] = trim($object->GetCol_21()); }
			if ($object->GetCol_22() != "" || $object->GetCol_22() != "0" ) { $arr['col_22'] = trim($object->GetCol_22()); }
			if ($object->GetCol_23() != "" || $object->GetCol_23() != "0" ) { $arr['col_23'] = trim($object->GetCol_23()); }
			if ($object->GetCol_24() != "" || $object->GetCol_24() != "0" ) { $arr['col_24'] = trim($object->GetCol_24()); }
			if ($object->GetCol_25() != "" || $object->GetCol_25() != "0" ) { $arr['col_25'] = trim($object->GetCol_25()); }
			if ($object->GetCol_26() != "" || $object->GetCol_26() != "0" ) { $arr['col_26'] = trim($object->GetCol_26()); }
			if ($object->GetCol_27() != "" || $object->GetCol_27() != "0" ) { $arr['col_27'] = trim($object->GetCol_27()); }
			if ($object->GetCol_28() != "" || $object->GetCol_28() != "0" ) { $arr['col_28'] = trim($object->GetCol_28()); }
			if ($object->GetCol_29() != "" || $object->GetCol_29() != "0" ) { $arr['col_29'] = trim($object->GetCol_29()); }
			if ($object->GetCol_30() != "" || $object->GetCol_30() != "0" ) { $arr['col_30'] = trim($object->GetCol_30()); }

			echo json_encode($arr);	
		}
	}
?>