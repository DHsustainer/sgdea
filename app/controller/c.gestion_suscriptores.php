<?
session_start();

#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CGestion_suscriptores;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('estado', 'type');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['estado']), $c->sql_quote($_REQUEST['type']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["id_gestion"]), $c->sql_quote($_REQUEST["id_suscriptor"]), $c->sql_quote($_REQUEST["usuario_id"]), $c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["type"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["dtform"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'cambiarestadoaviso')
			$ob->cambiarestadoaviso();
		elseif($c->sql_quote($_REQUEST['action']) == 'cambiaraviso')
			$ob->formcambioaviso($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizarestado')
			$ob->actualizarestado($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR
		
		
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CGestion_suscriptores extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MGestion_suscriptores;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Gestion_suscriptores');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarGestion_suscriptores();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'gestion_suscriptores/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Gestion_suscriptores');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'gestion_suscriptores/FormInsertGestion_suscriptores.php');				
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
		 	$object = new MGestion_suscriptores;
			// LO CREAMOS 			
			$object->CreateGestion_suscriptores('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'gestion_suscriptores/FormUpdateGestion_suscriptores.php');		
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MGestion_suscriptores;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Gestion_suscriptores');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarGestion_suscriptores('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'gestion_suscriptores/Listar.php');	   			
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
		function Insertar($id_gestion, $id_suscriptor, $usuario_id, $estado, $type, $fecha, $dtform){
			// DEFINIENDO EL OBJETO			

			global $con; 
			global $c;
			global $f;

			if ($id_suscriptor == "N") {

				$Identificacion_suscriptor = $c->sql_quote($_REQUEST['Identificacion_suscriptor']);
				$Type_suscriptor = $c->sql_quote($_REQUEST['Type_suscriptor']);
				$Direccion_suscriptor = $c->sql_quote($_REQUEST['Direccion_suscriptor']);
				$Ciudad_suscriptor = $c->sql_quote($_REQUEST['Ciudad_suscriptor']);
				$Telefonos_suscriptor = $c->sql_quote($_REQUEST['Telefonos_suscriptor']);
				$Email_suscriptor = $c->sql_quote($_REQUEST['Email_suscriptor']);

				$suscrr = new MSuscriptores_contactos;
				$createsuscr = $suscrr->InsertSuscriptores_contactos($Identificacion_suscriptor, $dtform, $Type_suscriptor, $_SESSION['usuario'], date("Y-m-d"));

				$id_suscriptor = $c->GetMaxIdTabla("suscriptores_contactos", "id");

				$suscrd = new MSuscriptores_contactos_direccion;
				$suscrd->InsertSuscriptores_contactos_direccion($id_suscriptor, $Direccion_suscriptor, $Ciudad_suscriptor, $Telefonos_suscriptor, $Email_suscriptor, "");

			}

			$object = new MGestion_suscriptores;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertGestion_suscriptores($id_gestion, $id_suscriptor, $usuario_id, $estado, $type, $fecha);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			echo "1";

			$id = $c->GetMaxIdTabla("gestion_suscriptores", "id");

			$objecte = new MEvents_gestion;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
			/*
				InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))
			*/
			$objecte->InsertEvents_gestion($_SESSION['usuario'], $id_gestion, date("Y-m-d"), "Suscriptor Agregado", "Se ha agregado un nuevo suscriptor al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "sus", $id);

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			global $con;
			global $c;
			global $f;

			$object = new MGestion_suscriptores;
			$object->CreateGestion_suscriptores("id", $_REQUEST['id']);

			$sus = new MSuscriptores_contactos;
			$sus->CreateSuscriptores_contactos("id", $object->GetId_suscriptor());

			$estado = $c->sql_quote($_REQUEST['estado']);
			$type = $c->sql_quote($_REQUEST['type']);

			$path = "";
    		$change = false;
    		$estados = array("0" => "Inactivo", "1" => "Activo");
    		$tipos = array("0" => "El suscriptor solo puede consultar", "1" => "El suscriptor puede interactuar");


    		if($object->GetEstado() != $estado){ $path .= "<li>Se edito el campo Estado de '".$estados[$object->GetEstado()]."' por '".$estados[$estado]."' </li>"; $change = true; }
    		if($object->GetType() != $type){ $path .= "<li>Se edito el campo Permisos de '".$tipos[$object->GetType()]."' por '".$tipos[$type]."' </li>"; $change = true; }


			if($change){

				$create = $object->UpdateGestion_suscriptores($constrain, $fields, $updates, $output);
				echo "1";
				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				/*
					InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))
				*/
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId_gestion(), date("Y-m-d"), "Suscriptor Actualizado", "Se ha actualizado el suscriptor ".$sus->GetNombre()." del expediente  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "esus", $object->GetId());
			}
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MGestion_suscriptores;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteGestion_suscriptores($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
		}

		function cambiarestadoaviso(){

			global $c;
			global $con;
			global $f;

			$id = $c->sql_quote($_REQUEST['id']);
			$estadoaviso = $c->sql_quote($_REQUEST['estadoaviso']);
			$fecha_aviso = $c->sql_quote($_REQUEST['fecha_aviso']);
			$observacion = $c->sql_quote($_REQUEST['observacion']);

			$q = $con->Query("	update 
									gestion_suscriptores 
										set 
											aviso = '$estadoaviso', 
											fecha_aviso = '$fecha_aviso', 
											observacion = '$observacion' 
												where id = '$id'");

			if ($q) {
				echo "Información Actualizada $id";
			}else{
				echo "No se pudo actualizar";
			}
		}

		function formcambioaviso($id){

			global $con;
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MGestion_suscriptores;
			// LO CREAMOS 			
			$object->CreateGestion_suscriptores('id', $id);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'gestion_suscriptores/FormUpdateSeguimiento.php');		


		}

		function actualizarestado($id, $valor){

			global $c;
			global $con;
			global $f;

			$q = $con->Query("	update 
									gestion_suscriptores 
										set 
											estado = '$valor'
												where id = '$id'");

			if ($q) {
				echo "Información Actualizada $id";
			}else{
				echo "No se pudo actualizar";
			}

		}
	}
?>