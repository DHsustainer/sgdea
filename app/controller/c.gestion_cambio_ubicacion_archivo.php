<?
	session_start();
	#error_reporting(E_ALL);

#ini_set('display_errors', '1');
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Gestion_cambio_ubicacion_archivoM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CGestion_cambio_ubicacion_archivo;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('id_gestion', 'nombre_destino', 'estado_archivo_origen', 'estado_archivo_destino', 'estado', 'fecha');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['id_gestion']), $c->sql_quote($_REQUEST['nombre_destino']), $c->sql_quote($_REQUEST['estado_archivo_origen']), $c->sql_quote($_REQUEST['estado_archivo_destino']), $c->sql_quote($_REQUEST['estado']), $c->sql_quote($_REQUEST['fecha']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["id_gestion"]), $c->sql_quote($_REQUEST["nombre_destino"]), $c->sql_quote($_REQUEST["estado_archivo_origen"]), $c->sql_quote($_REQUEST["estado_archivo_destino"]), $c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["fecha"]));
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
		elseif($c->sql_quote($_REQUEST['action']) == 'resgistrargestion')
			$ob->RegistrarGestion($c->sql_quote($_REQUEST['id']),$c->sql_quote($_REQUEST['cn']),$c->sql_quote($_REQUEST['p1']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CGestion_cambio_ubicacion_archivo extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MGestion_cambio_ubicacion_archivo;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Gestion_cambio_ubicacion_archivo');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarGestion_cambio_ubicacion_archivo();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'gestion_cambio_ubicacion_archivo/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Gestion_cambio_ubicacion_archivo');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'gestion_cambio_ubicacion_archivo/FormInsertGestion_cambio_ubicacion_archivo.php');				
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
	 		$pagina = $this->load_template('Editar Gestion_cambio_ubicacion_archivo');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MGestion_cambio_ubicacion_archivo;
			// LO CREAMOS 			
			$object->CreateGestion_cambio_ubicacion_archivo('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'gestion_cambio_ubicacion_archivo/FormUpdateGestion_cambio_ubicacion_archivo.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MGestion_cambio_ubicacion_archivo;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Gestion_cambio_ubicacion_archivo');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarGestion_cambio_ubicacion_archivo('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'gestion_cambio_ubicacion_archivo/Listar.php');	   			
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
		function Insertar($id_gestion, $nombre_destino, $estado_archivo_origen, $estado_archivo_destino, $estado, $fecha){
			// DEFINIENDO EL OBJETO			
			$object = new MGestion_cambio_ubicacion_archivo;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertGestion_cambio_ubicacion_archivo($id_gestion, $nombre_destino, $estado_archivo_origen, $estado_archivo_destino, $estado, $fecha);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	

		}

		function RegistrarGestion($id_gestion, $valor, $estado_archivo_destino){
			global $con;
			// DEFINIENDO EL OBJETO
			$object = new MGestion;
			$object->CreateGestion("id", $id_gestion);

			$MGestion_cambio_ubicacion_archivo = new MGestion_cambio_ubicacion_archivo;
			$MGestion_cambio_ubicacion_archivo->CreateGestion_cambio_ubicacion_archivo("id_gestion",$id_gestion);

			$enviara = array("1" => "Archivo Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico");

			if($estado_archivo_destino != '0'){
				$rg = new MGestion;
				$rg->CreateGestion("id", $id_gestion);
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
				$MGestion_cambio_ubicacion_archivo->DeleteGestion_cambio_ubicacion_archivo2($id_gestion);
				if($valor == '1'){

					 $create = $MGestion_cambio_ubicacion_archivo->InsertGestion_cambio_ubicacion_archivo($id_gestion, $rg->GetNombre_destino(), $rg->GetEstado_archivo(), $estado_archivo_destino, '0', date('Y-m-d H:i:s'));
				}
			}else{

				if($valor == '0'){

					$objecte = new MEvents_gestion;
					$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." ", "Se ha rechazado del ".$enviara[$MGestion_cambio_ubicacion_archivo->GetEstado_archivo_destino()]."", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eexpr", $object->GetId());

    				if($MGestion_cambio_ubicacion_archivo->GetEstado_archivo_origen() == 1){
						$con->Query("update alertas set time = '".date("Y-m-d H:i:s")."' WHERE extra = 'aveg' and left(time,10) = '".date('Y-m-d')."'");
					}
					if($MGestion_cambio_ubicacion_archivo->GetEstado_archivo_origen() == 2){
						$con->Query("update alertas set time = '".date("Y-m-d H:i:s")."' WHERE extra = 'avec' and left(time,10) = '".date('Y-m-d')."'");
					}

					$MGestion_cambio_ubicacion_archivo->DeleteGestion_cambio_ubicacion_archivo($MGestion_cambio_ubicacion_archivo->GetId());

				}else{

					/*eliminar alertas del expediente*/
					$con->Query("UPDATE alertas set status = '2' where id_gestion = '$id_gestion'");
					$con->Query("UPDATE events_gestion set status = '2' where gestion_id = '$id_gestion'");
					$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '$id_gestion' and type = '0'");
					$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '$id_gestion' and type = '1' and status = '2'");

					$constrain = 'WHERE id = '.$id_gestion;
					$fields = array('estado_archivo');
					$updates = array($MGestion_cambio_ubicacion_archivo->GetEstado_archivo_destino());
					$output = array('registro actualizado', 'no se pudo actualizar'); 
					$create = $object->UpdateGestion($constrain, $fields, $updates, $output);

					$constrain = 'WHERE id = '.$MGestion_cambio_ubicacion_archivo->GetId();
					$fields = array('estado');
					$updates = array('1');
					$output = array('registro actualizado', 'no se pudo actualizar'); 
					$create = $MGestion_cambio_ubicacion_archivo->UpdateGestion_cambio_ubicacion_archivo($constrain, $fields, $updates, $output);

					$objecte = new MEvents_gestion;
					$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." ", "Se ha movido del ".$enviara[$MGestion_cambio_ubicacion_archivo->GetEstado_archivo_origen()]." al ".$enviara[$MGestion_cambio_ubicacion_archivo->GetEstado_archivo_destino()]."", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eexp", $object->GetId());

					if($MGestion_cambio_ubicacion_archivo->GetEstado_archivo_destino() == 2){
						$con->Query("update alertas set time = '".date("Y-m-d H:i:s")."' WHERE extra = 'avecm' and left(time,10) = '".date('Y-m-d')."'");
					}
					if($MGestion_cambio_ubicacion_archivo->GetEstado_archivo_destino() == 3){
						$con->Query("update alertas set time = '".date("Y-m-d H:i:s")."' WHERE extra = 'avehm' and left(time,10) = '".date('Y-m-d')."'");
					}
				}
			}		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			/*if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');*/

		}


		
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MGestion_cambio_ubicacion_archivo;
			$create = $object->UpdateGestion_cambio_ubicacion_archivo($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MGestion_cambio_ubicacion_archivo;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteGestion_cambio_ubicacion_archivo($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			/*if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';*/	
		}
	}
?>
		