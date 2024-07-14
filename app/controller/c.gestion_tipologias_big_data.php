<?
	session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Gestion_tipologias_big_dataM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Events_gestionM.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CGestion_tipologias_big_data;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('username', 'proceso_id', 'tipologia_referencia_id', 'col_1', 'col_2', 'col_3', 'col_4', 'col_5', 'col_6', 'col_7', 'col_8', 'col_9', 'col_10', 'col_11', 'col_12', 'col_13', 'col_14', 'col_15');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['proceso_id']), $c->sql_quote($_REQUEST['tipologia_referencia_id']), $c->sql_quote($_REQUEST['col_1']), $c->sql_quote($_REQUEST['col_2']), $c->sql_quote($_REQUEST['col_3']), $c->sql_quote($_REQUEST['col_4']), $c->sql_quote($_REQUEST['col_5']), $c->sql_quote($_REQUEST['col_6']), $c->sql_quote($_REQUEST['col_7']), $c->sql_quote($_REQUEST['col_8']), $c->sql_quote($_REQUEST['col_9']), $c->sql_quote($_REQUEST['col_10']), $c->sql_quote($_REQUEST['col_11']), $c->sql_quote($_REQUEST['col_12']), $c->sql_quote($_REQUEST['col_13']), $c->sql_quote($_REQUEST['col_14']), $c->sql_quote($_REQUEST['col_15']));	
	// DEFINIMOS LOS ESTADOS DE SALIDA
	$output = array('registro actualizado', 'no se pudo actualizar'); 
	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
	$constrain = 'WHERE id = '.$c->sql_quote($_REQUEST['id']);
	
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
			$ob->Insertar($c->sql_quote($_REQUEST["username"]), $c->sql_quote($_REQUEST["proceso_id"]), $c->sql_quote($_REQUEST["tipologia_referencia_id"]), $c->sql_quote($_REQUEST["col_1"]), $c->sql_quote($_REQUEST["col_2"]), $c->sql_quote($_REQUEST["col_3"]), $c->sql_quote($_REQUEST["col_4"]), $c->sql_quote($_REQUEST["col_5"]), $c->sql_quote($_REQUEST["col_6"]), $c->sql_quote($_REQUEST["col_7"]), $c->sql_quote($_REQUEST["col_8"]), $c->sql_quote($_REQUEST["col_9"]), $c->sql_quote($_REQUEST["col_10"]), $c->sql_quote($_REQUEST["col_11"]), $c->sql_quote($_REQUEST["col_12"]), $c->sql_quote($_REQUEST["col_13"]), $c->sql_quote($_REQUEST["col_14"]), $c->sql_quote($_REQUEST["col_15"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->ActualizarMetadatos($constrain, $ar2, $ar1, $output, $c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['proceso_id']));
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
	class CGestion_tipologias_big_data extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MGestion_tipologias_big_data;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Gestion_tipologias_big_data');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarGestion_tipologias_big_data();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'gestion_tipologias_big_data/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Gestion_tipologias_big_data');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'gestion_tipologias_big_data/FormInsertGestion_tipologias_big_data.php');				
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
	 		$pagina = $this->load_template('Editar Gestion_tipologias_big_data');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MGestion_tipologias_big_data;
			// LO CREAMOS 			
			$object->CreateGestion_tipologias_big_data('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'gestion_tipologias_big_data/FormUpdateGestion_tipologias_big_data.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MGestion_tipologias_big_data;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Gestion_tipologias_big_data');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarGestion_tipologias_big_data('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'gestion_tipologias_big_data/Listar.php');	   			
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
		function Insertar($username, $proceso_id, $tipologia_referencia_id, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15){
			// DEFINIENDO EL OBJETO			
			$object = new MGestion_tipologias_big_data;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertGestion_tipologias_big_data($username, $proceso_id, $tipologia_referencia_id, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MGestion_tipologias_big_data;
			$create = $object->UpdateGestion_tipologias_big_data($constrain, $fields, $updates, $output);
						
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MGestion_tipologias_big_data;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteGestion_tipologias_big_data($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}

		function ActualizarMetadatos($constrain, $ar2, $ar1, $output, $id, $doc_id){

			global $c;
			global $f;
			global $con;

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

			$ga = new MGestion_anexos;
			$ga->CreateGestion_anexos("id", $doc_id);

			$object = new MGestion;
			$object->CreateGestion("id", $ga->GetGestion_id());

			$object_big_data = new MGestion_tipologias_big_data;
			$object_big_data->CreateGestion_tipologias_big_data("proceso_id", $ga->GetId());			

			$ref = new MDependencias_tipologias_referencias;
			$ref->CreateDependencias_tipologias_referencias('dependencia_id', $object_big_data->GetTipologia_referencia_id());


			$path = "";
			$change = false;

			if($ref->GetCol_1_name() != "")  {
				if ($col_1 != $object_big_data->Getcol_1()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_1_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_1()).'" por "'.$c->sql_quote($col_1).'"';
					$change = true;
				}

			}
			if($ref->GetCol_2_name() != "")  {
				if ($col_2 != $object_big_data->Getcol_2()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_2_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_2()).'" por "'.$c->sql_quote($col_2).'"';
					$change = true;
				}

			}
			if($ref->GetCol_3_name() != "")  {
				if ($col_3 != $object_big_data->Getcol_3()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_3_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_3()).'" por "'.$c->sql_quote($col_3).'"';
					$change = true;
				}

			}
			if($ref->GetCol_4_name() != "")  {
				if ($col_4 != $object_big_data->Getcol_4()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_4_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_4()).'" por "'.$c->sql_quote($col_4).'"';
					$change = true;
				}

			}
			if($ref->GetCol_5_name() != "")  {
				if ($col_5 != $object_big_data->Getcol_5()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_5_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_5()).'" por "'.$c->sql_quote($col_5).'"';
					$change = true;
				}

			}
			if($ref->GetCol_6_name() != "")  {
				if ($col_6 != $object_big_data->Getcol_6()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_6_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_6()).'" por "'.$c->sql_quote($col_6).'"';
					$change = true;
				}

			}
			if($ref->GetCol_7_name() != "")  {
				if ($col_7 != $object_big_data->Getcol_7()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_7_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_7()).'" por "'.$c->sql_quote($col_7).'"';
					$change = true;
				}

			}
			if($ref->GetCol_8_name() != "")  {
				if ($col_8 != $object_big_data->Getcol_8()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_8_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_8()).'" por "'.$c->sql_quote($col_8).'"';
					$change = true;
				}

			}
			if($ref->GetCol_9_name() != "")  {
				if ($col_9 != $object_big_data->Getcol_9()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_9_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_9()).'" por "'.$c->sql_quote($col_9).'"';
					$change = true;
				}

			}
			if($ref->GetCol_10_name() != "") {
				if ($col_10 != $object_big_data->Getcol_10()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_10_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_10()).'" por "'.$c->sql_quote($col_10).'"';
					$change = true;
				}

			}
			if($ref->GetCol_11_name() != "") {
				if ($col_11 != $object_big_data->Getcol_11()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_11_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_11()).'" por "'.$c->sql_quote($col_11).'"';
					$change = true;
				}

			}
			if($ref->GetCol_12_name() != "") {
				if ($col_12 != $object_big_data->Getcol_12()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_12_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_12()).'" por "'.$c->sql_quote($col_12).'"';
					$change = true;
				}

			}
			if($ref->GetCol_13_name() != "") {
				if ($col_13 != $object_big_data->Getcol_13()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_13_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_13()).'" por "'.$c->sql_quote($col_13).'"';
					$change = true;
				}

			}
			if($ref->GetCol_14_name() != "") {
				if ($col_14 != $object_big_data->Getcol_14()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_14_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_14()).'" por "'.$c->sql_quote($col_14).'"';
					$change = true;
				}

			}
			if($ref->GetCol_15_name() != "") {
				if ($col_15 != $object_big_data->Getcol_15()) {
					$path .= "Se ha editado el metadato: <b>".$ref->GetCol_15_name().'</b> de "'.$c->sql_quote($object_big_data->Getcol_15()).'" por "'.$c->sql_quote($col_15).'"';
					$change = true;
				}

			}

			echo $path;


			if ($change) {
				$this->Editar($constrain, $ar2, $ar1, $output);

				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				/*  InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario)) */
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Se ha editado un documento ".$ga->GetNombre(), "Se ha editado la informacion del documento  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "meta", $ga->GetId());

			}
/*
			echo "hey jude";
			*/

			echo "<script>alert('Metadatos Actualizados'); window.location.href='".HOMEDIR.DS."gestion_anexos/vermetadatos/".$_POST['proceso_id']."/'</script>";
		}
	}
?>
		