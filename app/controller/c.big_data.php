<?
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Big_dataM.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');
	include_once(PLUGINS.DS.'phpqrcode/qrlib.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CBig_data;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('col_1', 'col_2', 'col_3', 'col_4', 'col_5', 'col_6', 'col_7', 'col_8', 'col_9', 'col_10', 'col_11', 'col_12', 'col_13', 'col_14', 'col_15', 'col_16', 'col_17', 'col_18', 'col_19', 'col_20', 'col_21', 'col_22', 'col_23', 'col_24', 'col_25', 'col_26', 'col_27', 'col_28', 'col_29', 'col_30', 'combinar');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['col_1']), $c->sql_quote($_REQUEST['col_2']), $c->sql_quote($_REQUEST['col_3']), $c->sql_quote($_REQUEST['col_4']), $c->sql_quote($_REQUEST['col_5']), $c->sql_quote($_REQUEST['col_6']), $c->sql_quote($_REQUEST['col_7']), $c->sql_quote($_REQUEST['col_8']), $c->sql_quote($_REQUEST['col_9']), $c->sql_quote($_REQUEST['col_10']), $c->sql_quote($_REQUEST['col_11']), $c->sql_quote($_REQUEST['col_12']), $c->sql_quote($_REQUEST['col_13']), $c->sql_quote($_REQUEST['col_14']), $c->sql_quote($_REQUEST['col_15']), $c->sql_quote($_REQUEST['col_16']), $c->sql_quote($_REQUEST['col_17']), $c->sql_quote($_REQUEST['col_18']), $c->sql_quote($_REQUEST['col_19']), $c->sql_quote($_REQUEST['col_20']), $c->sql_quote($_REQUEST['col_21']), $c->sql_quote($_REQUEST['col_22']), $c->sql_quote($_REQUEST['col_23']), $c->sql_quote($_REQUEST['col_24']), $c->sql_quote($_REQUEST['col_25']), $c->sql_quote($_REQUEST['col_26']), $c->sql_quote($_REQUEST['col_27']), $c->sql_quote($_REQUEST['col_28']), $c->sql_quote($_REQUEST['col_29']), $c->sql_quote($_REQUEST['col_30']), $c->sql_quote($_REQUEST['combinar']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["username"]), $c->sql_quote($_REQUEST["proceso_id"]), $c->sql_quote($_REQUEST["ref_tables_id"]), $c->sql_quote($_REQUEST["col_1"]), $c->sql_quote($_REQUEST["col_2"]), $c->sql_quote($_REQUEST["col_3"]), $c->sql_quote($_REQUEST["col_4"]), $c->sql_quote($_REQUEST["col_5"]), $c->sql_quote($_REQUEST["col_6"]), $c->sql_quote($_REQUEST["col_7"]), $c->sql_quote($_REQUEST["col_8"]), $c->sql_quote($_REQUEST["col_9"]), $c->sql_quote($_REQUEST["col_10"]), $c->sql_quote($_REQUEST["col_11"]), $c->sql_quote($_REQUEST["col_12"]), $c->sql_quote($_REQUEST["col_13"]), $c->sql_quote($_REQUEST["col_14"]), $c->sql_quote($_REQUEST["col_15"]), $c->sql_quote($_REQUEST["col_16"]), $c->sql_quote($_REQUEST["col_17"]), $c->sql_quote($_REQUEST["col_18"]), $c->sql_quote($_REQUEST["col_19"]), $c->sql_quote($_REQUEST["col_20"]), $c->sql_quote($_REQUEST["col_21"]), $c->sql_quote($_REQUEST["col_22"]), $c->sql_quote($_REQUEST["col_23"]), $c->sql_quote($_REQUEST["col_24"]), $c->sql_quote($_REQUEST["col_25"]), $c->sql_quote($_REQUEST["col_26"]), $c->sql_quote($_REQUEST["col_27"]), $c->sql_quote($_REQUEST["col_28"]), $c->sql_quote($_REQUEST["col_29"]), $c->sql_quote($_REQUEST["col_30"]), $c->sql_quote($_REQUEST["combinar"]));
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
		elseif($c->sql_quote($_REQUEST['action']) == 'exportarformulario')
			$ob->Exportar($c->sql_quote($_REQUEST['id']));
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CBig_data extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MBig_data;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Big_data');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarBig_data();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'big_data/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Big_data');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'big_data/FormInsertBig_data.php');				
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
	 		$pagina = $this->load_template('Editar Big_data');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MBig_data;
			// LO CREAMOS 			
			$object->CreateBig_data('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'big_data/FormUpdateBig_data.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MBig_data;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Big_data');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarBig_data('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'big_data/Listar.php');	   			
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
		function Insertar($username, $proceso_id, $ref_tables_id, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15, $col_16, $col_17, $col_18, $col_19, $col_20, $col_21, $col_22, $col_23, $col_24, $col_25, $col_26, $col_27, $col_28, $col_29, $col_30, $combinar){
			// DEFINIENDO EL OBJETO	
			global $con;	
			global $c;	
			$object = new MBig_data;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertBig_data($username, $proceso_id, $ref_tables_id, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15, $col_16, $col_17, $col_18, $col_19, $col_20, $col_21, $col_22, $col_23, $col_24, $col_25, $col_26, $col_27, $col_28, $col_29, $col_30, $combinar);
						
			$id = $c->GetMaxIdTabla("big_data", "id");
			echo $id;


			$ref = new MRef_tables;
			$ref->CreateRef_tables('id', $ref_tables_id);

			$objecte = new MEvents_gestion;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
			/*
				InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))
			*/
			$objecte->InsertEvents_gestion($_SESSION['usuario'], $proceso_id, date("Y-m-d"), "Formulario Creado", "Se ha creado un formulario de tipo: ".$ref->GetTitle(), date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "form", $id);

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			global $con; 
			global $c;
			global $f;

			$object = new MBig_data;
			$object->CreateBig_data("id", $c->sql_quote($_REQUEST['id']));
			
			$create = $object->UpdateBig_data($constrain, $fields, $updates, $output);

			echo "1";

			$ref = new MRef_tables;
			$ref->CreateRef_tables('id', $object->GetRef_tables_id());

			$col_1 = $c->sql_quote($_REQUEST['col_1']);
			$col_2 = $c->sql_quote($_REQUEST['col_2']);
			$col_3 = $c->sql_quote($_REQUEST['col_3']);
			$col_4 = $c->sql_quote($_REQUEST['col_4']);
			$col_5 = $c->sql_quote($_REQUEST['col_5']);
			$col_6 = $c->sql_quote($_REQUEST['col_6']);
			$col_7 = $c->sql_quote($_REQUEST['col_7']);
			$col_8 = $c->sql_quote($_REQUEST['col_8']);
			$col_9 = $c->sql_quote($_REQUEST['col_9']);
			$col_10 = $c->sql_quote($_REQUEST['col_10']);
			$col_11 = $c->sql_quote($_REQUEST['col_11']);
			$col_12 = $c->sql_quote($_REQUEST['col_12']);
			$col_13 = $c->sql_quote($_REQUEST['col_13']);
			$col_14 = $c->sql_quote($_REQUEST['col_14']);
			$col_15 = $c->sql_quote($_REQUEST['col_15']);
			$col_16 = $c->sql_quote($_REQUEST['col_16']);
			$col_17 = $c->sql_quote($_REQUEST['col_17']);
			$col_18 = $c->sql_quote($_REQUEST['col_18']);
			$col_19 = $c->sql_quote($_REQUEST['col_19']);
			$col_20 = $c->sql_quote($_REQUEST['col_20']);
			$col_21 = $c->sql_quote($_REQUEST['col_21']);
			$col_22 = $c->sql_quote($_REQUEST['col_22']);
			$col_23 = $c->sql_quote($_REQUEST['col_23']);
			$col_24 = $c->sql_quote($_REQUEST['col_24']);
			$col_25 = $c->sql_quote($_REQUEST['col_25']);
			$col_26 = $c->sql_quote($_REQUEST['col_26']);
			$col_27 = $c->sql_quote($_REQUEST['col_27']);
			$col_28 = $c->sql_quote($_REQUEST['col_28']);
			$col_29 = $c->sql_quote($_REQUEST['col_29']);
			$col_30 = $c->sql_quote($_REQUEST['col_30']);
			$combinar = $c->sql_quote($_REQUEST['combinar']);
			
			$path = "";
    		$change = false;

    		if($object->GetCol_1() != $col_1){ $path .= "<li>Se edito el campo '".$ref->GetCol_1()."' de '".$object->GetCol_1()."' por '$col_1' </li>"; $change = true; }
    		if($object->GetCol_2() != $col_2){ $path .= "<li>Se edito el campo '".$ref->GetCol_2()."' de '".$object->GetCol_2()."' por '$col_2' </li>"; $change = true; }
    		if($object->GetCol_3() != $col_3){ $path .= "<li>Se edito el campo '".$ref->GetCol_3()."' de '".$object->GetCol_3()."' por '$col_3' </li>"; $change = true; }
    		if($object->GetCol_4() != $col_4){ $path .= "<li>Se edito el campo '".$ref->GetCol_4()."' de '".$object->GetCol_4()."' por '$col_4' </li>"; $change = true; }
    		if($object->GetCol_5() != $col_5){ $path .= "<li>Se edito el campo '".$ref->GetCol_5()."' de '".$object->GetCol_5()."' por '$col_5' </li>"; $change = true; }
    		if($object->GetCol_6() != $col_6){ $path .= "<li>Se edito el campo '".$ref->GetCol_6()."' de '".$object->GetCol_6()."' por '$col_6' </li>"; $change = true; }
    		if($object->GetCol_7() != $col_7){ $path .= "<li>Se edito el campo '".$ref->GetCol_7()."' de '".$object->GetCol_7()."' por '$col_7' </li>"; $change = true; }
    		if($object->GetCol_8() != $col_8){ $path .= "<li>Se edito el campo '".$ref->GetCol_8()."' de '".$object->GetCol_8()."' por '$col_8' </li>"; $change = true; }
    		if($object->GetCol_9() != $col_9){ $path .= "<li>Se edito el campo '".$ref->GetCol_9()."' de '".$object->GetCol_9()."' por '$col_9' </li>"; $change = true; }
    		if($object->GetCol_10() != $col_10){ $path .= "<li>Se edito el campo '".$ref->GetCol_10()."' de '".$object->GetCol_10()."' por '$col_10' </li>"; $change = true; }
    		if($object->GetCol_11() != $col_11){ $path .= "<li>Se edito el campo '".$ref->GetCol_11()."' de '".$object->GetCol_11()."' por '$col_11' </li>"; $change = true; }
    		if($object->GetCol_12() != $col_12){ $path .= "<li>Se edito el campo '".$ref->GetCol_12()."' de '".$object->GetCol_12()."' por '$col_12' </li>"; $change = true; }
    		if($object->GetCol_13() != $col_13){ $path .= "<li>Se edito el campo '".$ref->GetCol_13()."' de '".$object->GetCol_13()."' por '$col_13' </li>"; $change = true; }
    		if($object->GetCol_14() != $col_14){ $path .= "<li>Se edito el campo '".$ref->GetCol_14()."' de '".$object->GetCol_14()."' por '$col_14' </li>"; $change = true; }
    		if($object->GetCol_15() != $col_15){ $path .= "<li>Se edito el campo '".$ref->GetCol_15()."' de '".$object->GetCol_15()."' por '$col_15' </li>"; $change = true; }
    		if($object->GetCol_16() != $col_16){ $path .= "<li>Se edito el campo '".$ref->GetCol_16()."' de '".$object->GetCol_16()."' por '$col_16' </li>"; $change = true; }
    		if($object->GetCol_17() != $col_17){ $path .= "<li>Se edito el campo '".$ref->GetCol_17()."' de '".$object->GetCol_17()."' por '$col_17' </li>"; $change = true; }
    		if($object->GetCol_18() != $col_18){ $path .= "<li>Se edito el campo '".$ref->GetCol_18()."' de '".$object->GetCol_18()."' por '$col_18' </li>"; $change = true; }
    		if($object->GetCol_19() != $col_19){ $path .= "<li>Se edito el campo '".$ref->GetCol_19()."' de '".$object->GetCol_19()."' por '$col_19' </li>"; $change = true; }
    		if($object->GetCol_20() != $col_20){ $path .= "<li>Se edito el campo '".$ref->GetCol_20()."' de '".$object->GetCol_20()."' por '$col_20' </li>"; $change = true; }
    		if($object->GetCol_21() != $col_21){ $path .= "<li>Se edito el campo '".$ref->GetCol_21()."' de '".$object->GetCol_21()."' por '$col_21' </li>"; $change = true; }
    		if($object->GetCol_22() != $col_22){ $path .= "<li>Se edito el campo '".$ref->GetCol_22()."' de '".$object->GetCol_22()."' por '$col_22' </li>"; $change = true; }
    		if($object->GetCol_23() != $col_23){ $path .= "<li>Se edito el campo '".$ref->GetCol_23()."' de '".$object->GetCol_23()."' por '$col_23' </li>"; $change = true; }
    		if($object->GetCol_24() != $col_24){ $path .= "<li>Se edito el campo '".$ref->GetCol_24()."' de '".$object->GetCol_24()."' por '$col_24' </li>"; $change = true; }
    		if($object->GetCol_25() != $col_25){ $path .= "<li>Se edito el campo '".$ref->GetCol_25()."' de '".$object->GetCol_25()."' por '$col_25' </li>"; $change = true; }
    		if($object->GetCol_26() != $col_26){ $path .= "<li>Se edito el campo '".$ref->GetCol_26()."' de '".$object->GetCol_26()."' por '$col_26' </li>"; $change = true; }
    		if($object->GetCol_27() != $col_27){ $path .= "<li>Se edito el campo '".$ref->GetCol_27()."' de '".$object->GetCol_27()."' por '$col_27' </li>"; $change = true; }
    		if($object->GetCol_28() != $col_28){ $path .= "<li>Se edito el campo '".$ref->GetCol_28()."' de '".$object->GetCol_28()."' por '$col_28' </li>"; $change = true; }
    		if($object->GetCol_29() != $col_29){ $path .= "<li>Se edito el campo '".$ref->GetCol_29()."' de '".$object->GetCol_29()."' por '$col_29' </li>"; $change = true; }
    		if($object->GetCol_30() != $col_30){ $path .= "<li>Se edito el campo '".$ref->GetCol_30()."' de '".$object->GetCol_30()."' por '$col_30' </li>"; $change = true; }


			if($change){
				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				/*
					InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))
				*/
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetProceso_id(), date("Y-m-d"), "Formulario ".$ref->GetTitle()." Editado", "Se ha editado la informacion del formulario  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eform", $object->GetId());
			}
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MBig_data;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteBig_data($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}

		function Exportar($id){

			global $con;
			global $c;
			global $f;

			$l = new MBig_data;
			$l->Createbig_data('id', $id);

			$ref = new MRef_tables;
			$ref->CreateRef_tables('id', $l -> GetRef_tables_id());

			$nombredoc = $ref->GetTitle()." (".$l -> GetCol_1().")";

			$gestion_id = $l->GetProceso_id();
			$path = "";
			$path = "<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla'>";
			$path .= '<tr class="tblresult"><td colspan="2" align="left">'.$nombredoc.'</td></tr>';			
			$path .= ($ref->GetCol_1() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_1().':</b></td><td align="left">'.$l->GetCol_1().'</td></tr>' : '';
			$path .= ($ref->GetCol_2() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_2().':</b></td><td align="left">'.$l->GetCol_2().'</td></tr>' : '';
			$path .= ($ref->GetCol_3() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_3().':</b></td><td align="left">'.$l->GetCol_3().'</td></tr>' : '';
			$path .= ($ref->GetCol_4() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_4().':</b></td><td align="left">'.$l->GetCol_4().'</td></tr>' : '';
			$path .= ($ref->GetCol_5() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_5().':</b></td><td align="left">'.$l->GetCol_5().'</td></tr>' : '';
			$path .= ($ref->GetCol_6() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_6().':</b></td><td align="left">'.$l->GetCol_6().'</td></tr>' : '';
			$path .= ($ref->GetCol_7() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_7().':</b></td><td align="left">'.$l->GetCol_7().'</td></tr>' : '';
			$path .= ($ref->GetCol_8() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_8().':</b></td><td align="left">'.$l->GetCol_8().'</td></tr>' : '';
			$path .= ($ref->GetCol_9() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_9().':</b></td><td align="left">'.$l->GetCol_9().'</td></tr>' : '';
			$path .= ($ref->GetCol_10() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_10().':</b></td><td align="left">'.$l->GetCol_10().'</td></tr>' : '';
			$path .= ($ref->GetCol_11() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_11().':</b></td><td align="left">'.$l->GetCol_11().'</td></tr>' : '';
			$path .= ($ref->GetCol_12() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_12().':</b></td><td align="left">'.$l->GetCol_12().'</td></tr>' : '';
			$path .= ($ref->GetCol_13() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_13().':</b></td><td align="left">'.$l->GetCol_13().'</td></tr>' : '';
			$path .= ($ref->GetCol_14() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_14().':</b></td><td align="left">'.$l->GetCol_14().'</td></tr>' : '';
			$path .= ($ref->GetCol_15() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_15().':</b></td><td align="left">'.$l->GetCol_15().'</td></tr>' : '';
			$path .= ($ref->GetCol_16() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_16().':</b></td><td align="left">'.$l->GetCol_16().'</td></tr>' : '';
			$path .= ($ref->GetCol_17() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_17().':</b></td><td align="left">'.$l->GetCol_17().'</td></tr>' : '';
			$path .= ($ref->GetCol_18() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_18().':</b></td><td align="left">'.$l->GetCol_18().'</td></tr>' : '';
			$path .= ($ref->GetCol_19() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_19().':</b></td><td align="left">'.$l->GetCol_19().'</td></tr>' : '';
			$path .= ($ref->GetCol_20() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_20().':</b></td><td align="left">'.$l->GetCol_20().'</td></tr>' : '';
			$path .= ($ref->GetCol_21() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_21().':</b></td><td align="left">'.$l->GetCol_21().'</td></tr>' : '';
			$path .= ($ref->GetCol_22() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_22().':</b></td><td align="left">'.$l->GetCol_22().'</td></tr>' : '';
			$path .= ($ref->GetCol_23() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_23().':</b></td><td align="left">'.$l->GetCol_23().'</td></tr>' : '';
			$path .= ($ref->GetCol_24() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_24().':</b></td><td align="left">'.$l->GetCol_24().'</td></tr>' : '';
			$path .= ($ref->GetCol_25() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_25().':</b></td><td align="left">'.$l->GetCol_25().'</td></tr>' : '';
			$path .= ($ref->GetCol_26() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_26().':</b></td><td align="left">'.$l->GetCol_26().'</td></tr>' : '';
			$path .= ($ref->GetCol_27() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_27().':</b></td><td align="left">'.$l->GetCol_27().'</td></tr>' : '';
			$path .= ($ref->GetCol_28() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_28().':</b></td><td align="left">'.$l->GetCol_28().'</td></tr>' : '';
			$path .= ($ref->GetCol_29() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_29().':</b></td><td align="left">'.$l->GetCol_29().'</td></tr>' : '';
			$path .= ($ref->GetCol_30() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_30().':</b></td><td align="left">'.$l->GetCol_30().'</td></tr>' : '';
			$path .= "</table>";
    			
			$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
			$nameqr = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".png";

			$urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;
			$urlfilqr = FILESAT.DS.$gestion_id.'/anexos/'.$name;
			$urlqr = UPLOADS.DS.'qr/'.$nameqr;

			QRcode::png($urlfilqr, $urlqr); // creates file 

			$string = hash("sha256", $id.$_SESSION["usuario"].date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]); 

			$fpath = '<html><head></head><body>';
			$lpath = '</body></html>';

			$html = utf8_decode($fpath.html_entity_decode($path).$lpath);
			
			$html2 = '
						<html>
						<head>
						<body>
						  <div id="content">
						   '.$html.'
						  </div>
						</body>
						</html>';

			
			$dompdf = new DOMPDF();


			$dompdf->set_paper('legal','');
			$dompdf->load_html($html2);
			ini_set("memory_limit","32M"); 
			$dompdf->render();
			/*
				$dompdf->stream('my.pdf',array('Attachment'=>0));
			*/
			$pdf = $dompdf->output();

			if (file_put_contents($urlfile, $pdf)) {

				$car = new MGestion_anexos;
				$tot  = $car->ListarGestion_anexos("WHERE gestion_id = '".$gestion_id."'");

				$fol = $con->NumRows($tot);
				$fol += 1;
				$user_id = $_SESSION['usuario'];

				//base 64
				$base_file = '';
				$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);
				$base_file = base64_encode($data_base_file);			
				
				$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file) values 
												('".date("Y-m-d H:i:s")."', '".$gestion_id."','".$nombredoc."','".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."')");

				$id = $c->GetMaxIdTabla("gestion_anexos", "id");					
				$objecte = new MEvents_gestion;
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"".$nombredoc."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "expdpc", $id);

				echo "Documento Exportado a Anexos";
			}
		}
	}
?>
		