<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CGestion_anexos_permisos;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('estado','fecha_actualizacion', 'observacion');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['estado']), date("Y-m-d H:i:s"), $c->sql_quote($_REQUEST['observacion2'])."<br><b>".$_SESSION['usuario']." dice: </b>".$c->sql_quote($_REQUEST['observacion']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["id_documento"]), $c->sql_quote($_REQUEST["usuario_permiso"]), "0", date("Y-m-d"), "0000-00-00 00:00:00", $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["diasmaxtoresponse"]), $c->sql_quote($_REQUEST["usuario_permiso_username"]),$c->sql_quote($_REQUEST["essuscriptor"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output, $_REQUEST['id']);
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
	class CGestion_anexos_permisos extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MGestion_anexos_permisos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Gestion_anexos_permisos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarGestion_anexos_permisos();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'gestion_anexos_permisos/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Gestion_anexos_permisos');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'gestion_anexos_permisos/FormInsertGestion_anexos_permisos.php');				
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
	 		$pagina = $this->load_template('Editar Gestion_anexos_permisos');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MGestion_anexos_permisos;
			// LO CREAMOS 			
			$object->CreateGestion_anexos_permisos('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'gestion_anexos_permisos/FormUpdateGestion_anexos_permisos.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MGestion_anexos_permisos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Gestion_anexos_permisos');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarGestion_anexos_permisos('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'gestion_anexos_permisos/Listar.php');	   			
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
		function Insertar($id_documento, $usuario_permiso, $estado, $fecha_solicitud, $fecha_actualizacion, $observacion, $diasmaxtoresponse, $usuario_permiso_username,$essuscriptor = ''){
			// DEFINIENDO EL OBJETO			
			global $con;
			global $f;
			global $c;

			$doc = new MGestion_anexos;
			$doc->CreateGestion_anexos("id", $id_documento);
			$gestion_id = $doc->GetGestion_id();

			if($essuscriptor != ''){
				$fields = array('is_publico');
				$updates = array('1');	

				$output = array('', ''); 
				$constrain = 'WHERE id = '.$id_documento;
				$doc->UpdateGestion_anexos($constrain, $fields, $updates, $output);
			}			
			

			$object = new MGestion_anexos_permisos;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$USERNAMEX = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "p_nombre", " ");
			$create = $object->InsertGestion_anexos_permisos($id_documento, $usuario_permiso_username, $estado, $fecha_solicitud, $fecha_actualizacion, "<b>".$USERNAMEX." Dice: </b> ".$observacion, $gestion_id);

			#SOLICITUD DE FIRMA DEL DOCUMENTO
			$typol = new MDependencias_tipologias;
			$typol->CreateDependencias_tipologias("id", $doc->GetTipologia()) ;
			$tiporigen = $c->GetDataFromTable("dependencias_tipologias", "id", $doc->GetTipologia(), "tipologia", "");
			
			$usuario_firma = $usuario_permiso_username;

			$gaf = new MGestion_anexos_firmas;
			$gaf->InsertGestion_anexos_firmas($gestion_id, $doc->GetId(), $typol->GetId(), date("Y-m-d H:i:s"), $_SESSION['usuario'], $usuario_firma, "", "", "", "0", "", "");
			
			if($_SESSION['usuario'] != $usuario_permiso_username){
				echo "\nSe notificará al usuario para que firme este documento";
			}else{
				$query = $gaf->ListarGestion_anexos_firmas("where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '0' and gestion_id = '$gestion_id' and anexo_id='".$doc->GetId()."'");
				while($row = $con->FetchAssoc($query)){
					$idretorno = $row[id];
				}
				echo $idretorno;
			}			
			#FIN SOLICITUD DE FIRMA DEL DOCUMENTO		


			$fecha = date("Y-m-d");
			$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
			date_modify($fecha_c, "+$diasmaxtoresponse day");//sumas los dias que te hacen falta.
			$fecha_vencimiento = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
			
			$objecte = new MEvents_gestion;
			

			if($essuscriptor != ''){
				$responsablea = $c->GetDataFromTable("suscriptores_contactos", "id", $usuario_permiso, "nombre", $separador = " ");
				$objecte->InsertEvents_gestion($usuario_firma, $gestion_id, date("Y-m-d"), "Solicitúd de Revisión de Documento", "Se ha compartido un documento \"".$doc->GetNombre()."\" con el suscriptor ".$responsablea." para que sea revisado" , date("Y-m-d"), 0, date("H:i:s"), 0, $diasmaxtoresponse, 0, $fecha_vencimiento, 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usuario_permiso, "rdocs", $id_documento);
				
				$MGestion_suscriptores = new MGestion_suscriptores;			
				$create = $MGestion_suscriptores->InsertGestion_suscriptores($gestion_id, $usuario_firma, $_SESSION['usuario'], '1', '1', date("Y-m-d"));
			
			} else {
				$responsablea = $c->GetDataFromTable("usuarios", "a_i", $usuario_permiso, "p_nombre, p_apellido", $separador = " ");
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Solicitúd de Revisión de Documento", "Se ha compartido un documento \"".$doc->GetNombre()."\" con el usuario ".$responsablea." para que sea revisado" , date("Y-m-d"), 0, date("H:i:s"), 0, $diasmaxtoresponse, 0, $fecha_vencimiento, 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usuario_permiso, "rdoc", $id_documento);
				$con->Query("insert into gestion_compartir (usuario_comparte, usuario_nuevo, gestion_id, fecha, type) VALUES ('".$_SESSION['usuario']."', '".$usuario_permiso_username."', '".$id_documento."', '".date("Y-m-d")."', '0')");
			}
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output, $id, $estadodc){
			$object = new MGestion_anexos_permisos;
			$object->CreateGestion_anexos_permisos("id", $id);
			$create = $object->UpdateGestion_anexos_permisos($constrain, $fields, $updates, $output);
			
			global $con;
			global $f;
			global $c;

			$doc = new MGestion_anexos;
			$doc->CreateGestion_anexos("id", $object->GetId_documento());
			$gestion_id = $doc->GetGestion_id();

			$objecte = new MEvents_gestion;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
			/*
				InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))
			*/
			$responsablea = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "p_nombre, p_apellido", $separador = " ");

			$estado = array("0" => "Pendiente por Revisar", "1" => "Aprobado", "2" => "Rechazado");
			$estado = $estado[$estadodc];

			$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Se ha revisado un documento", "El documento ".$doc->GetNombre()." ha sido revisado por el usuario ".$responsablea." para que sea revisado y marcado como \"$estado\" " , date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $doc->GetUser_id(), "crdoc", $id);

			echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$gestion_id.'/"</script>';
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MGestion_anexos_permisos;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteGestion_anexos_permisos($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}

		
	}
?>