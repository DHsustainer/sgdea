<?
session_start();
#error_reporting(E_ALL);

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Big_dataM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'Documentos_gestionM.php');
	include_once(MODELS.DS.'Dependencias_documentosM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');
	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Dependencias_alertasM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Gestion_compartirM.php');
	include_once(MODELS.DS.'Gestion_folderM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'Plantilla_dependenciaM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'SeccionalM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');
	include_once(MODELS.DS.'Gestion_tipologias_big_dataM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'Gestion_transferenciasM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CGestion_transferencias;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('gestion_id', 'user_transfiere', 'user_recibe', 'fecha_transferencia', 'fecha_aceptacion', 'observaciona', 'observacionb', 'estado');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['gestion_id']), $c->sql_quote($_REQUEST['user_transfiere']), $c->sql_quote($_REQUEST['user_recibe']), $c->sql_quote($_REQUEST['fecha_transferencia']), $c->sql_quote($_REQUEST['fecha_aceptacion']), $c->sql_quote($_REQUEST['observaciona']), $c->sql_quote($_REQUEST['observacionb']), $c->sql_quote($_REQUEST['estado']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["gestion_id"]), $c->sql_quote($_REQUEST["user_transfiere"]), $c->sql_quote($_REQUEST["user_recibe"]), $c->sql_quote($_REQUEST["fecha_transferencia"]), $c->sql_quote($_REQUEST["fecha_aceptacion"]), $c->sql_quote($_REQUEST["observaciona"]), $c->sql_quote($_REQUEST["observacionb"]), $c->sql_quote($_REQUEST["estado"]));
		elseif($c->sql_quote($_REQUEST['action']) == 'rechazar')
			$ob->RechazarSolicitud($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['observaciona']));	
		elseif($c->sql_quote($_REQUEST['action']) == 'aceptarsolicitud')
			$ob->AceptarSolicitud($c->sql_quote($_REQUEST['id']),  $c->sql_quote($_REQUEST['area']));	
		
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'historial')
			$ob->GetHistorial($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['fi']), $c->sql_quote($_REQUEST['ff']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));		
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CGestion_transferencias extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){

			global $con;
			global $f;
			global $c;

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");
			ob_start();				

			$myid = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "a_i", $separador = " ");

  			$object = new MGestion_transferencias;	
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarGestion_transferencias("WHERE user_recibe = '$myid' and estado = '0'");	 
			include_once(VIEWS.DS.'gestion_transferencias/Listar.php');	   			   
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);

		}
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar(){
			//CARGA EL TEMPLATE
			$pagina = $this->load_template('Crear Gestion_transferencias');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'gestion_transferencias/FormInsertGestion_transferencias.php');				
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
	 		$pagina = $this->load_template('Editar Gestion_transferencias');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MGestion_transferencias;
			// LO CREAMOS 			
			$object->CreateGestion_transferencias('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'gestion_transferencias/FormUpdateGestion_transferencias.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MGestion_transferencias;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Gestion_transferencias');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarGestion_transferencias('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'gestion_transferencias/Listar.php');	   			
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
		function Insertar($gestion_id, $user_transfiere, $user_recibe, $fecha_transferencia, $fecha_aceptacion, $observaciona, $observacionb, $estado){
			// DEFINIENDO EL OBJETO			
			$object = new MGestion_transferencias;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertGestion_transferencias($gestion_id, $user_transfiere, $user_recibe, $fecha_transferencia, $fecha_aceptacion, $observaciona, $observacionb, $estado);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MGestion_transferencias;
			$create = $object->UpdateGestion_transferencias($constrain, $fields, $updates, $output);
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			global $con;
			global $c;
			global $f;

			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MGestion_transferencias;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteGestion_transferencias($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			

			$gt = new MGestion_transferencias;
			$gt->CreateGestion_transferencias("id", $id);

			$object = new MGestion;
			$object->CreateGestion("id", $gt->GetGestion_id());

			$ar2 = array('transferencia');
			$ar1 = array('0');
			$output = array('registro actualizado', 'no se pudo actualizar');
			$constrain = 'WHERE id = '.$gt->GetGestion_id();

			$objecte = new MEvents_gestion;
			$create = $object->UpdateGestion($constrain, $ar2, $ar1, $output);
			$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Editado", "Se ha Eliminado la solicitud de trasferencia", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eexp", $object->GetId());

			
		}

		function RechazarSolicitud($id, $observacion){
			global $con;
			global $c;
			global $f;
			// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
			$ar2 = array('fecha_aceptacion', 'observaciona', 'estado');
			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
			$ar1 = array(date("Y-m-d H:i:s"), $observacion, "2");	
			// DEFINIMOS LOS ESTADOS DE SALIDA
			$output = array('registro actualizado', 'no se pudo actualizar'); 
			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
			$constrain = 'WHERE id = '.$id;

			$this->Editar($constrain, $ar2, $ar1, $output);

			echo "Solicitud Rechazada";

			$gt = new MGestion_transferencias;
			$gt->CreateGestion_transferencias("id", $id);

			$object = new MGestion;
			$object->CreateGestion("id", $gt->GetGestion_id());

			$ar2 = array('transferencia');
			$ar1 = array('0');
			$output = array('registro actualizado', 'no se pudo actualizar');
			$constrain = 'WHERE id = '.$gt->GetGestion_id();

			$objecte = new MEvents_gestion;
			$create = $object->UpdateGestion($constrain, $ar2, $ar1, $output);
			$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Editado", "Se ha rechazado la solicitud de trasferencia", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eexp", $object->GetId());


		}

		function AceptarSolicitud($id, $area){
			global $con;
			global $c;
			global $f;
			// DEFINIMOS UN OBJETO NUEVO						
			$gt = new MGestion_transferencias;
			$gt->CreateGestion_transferencias("id", $id);

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $_SESSION['usuario']);

			$object = new MGestion;
			$object->CreateGestion("id", $gt->GetGestion_id());

			$u_exp = new Musuarios;
			$u_exp->CreateUsuarios("a_i", $object->GetNombre_destino());

			$con->Query("UPDATE alertas set status = '2', keep_alive = '0' where id_gestion = '".$object->GetId()."' and user_id = '".$u_exp->GetUser_id()."'");


            $con->Query("UPDATE events_gestion set status = '2' , realizadopor = '".$u_exp->GetUser_id()."', fecha_realizado = '".date("Y-m-d H:i:s")."' where gestion_id = '".$object->GetId()."' and user_id = '".$u_exp->GetUser_id()."'");

            #echo "UPDATE alertas set status = '2' where id_gestion = '".$object->GetId()."' and user_id = '".$u_exp->GetUser_id()."'";

            #echo "UPDATE events_gestion set status = '2' , realizadopor = '".$u_exp->GetUser_id()."', fecha_realizado = '".date("Y-m-d H:i:s")."' where gestion_id = '".$object->GetId()."' and user_id = '".$u_exp->GetUser_id()."'";


			$ar2 = array('nombre_destino',  'ciudad', 'oficina', 'dependencia_destino', 'transferencia');
			$ar1 = array($u->GetA_i(), $_SESSION['ciudad'], $u->GetSeccional(), $area, '0');
			$output = array('registro actualizado', 'no se pudo actualizar');
			$constrain = 'WHERE id = '.$gt->GetGestion_id();

				$path = "";
	    		$change = false;
	    		$changeuser = false;
				
				$ciudad				  =   $_SESSION['ciudad'];
				$oficina			  =   $u->GetSeccional();
				$dependencia_destino  =   $area;
				$nombre_destino		  =   $_SESSION['usuario'];

				if($object->GetNombre_destino() != $nombre_destino){
					$responsablea = $c->GetDataFromTable("usuarios", "a_i", $object->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");
					$responsableb = $c->GetDataFromTable("usuarios", "user_id", $nombre_destino, "p_nombre, p_apellido", $separador = " ");
	    			$path .= "<li>Se edito el campo usuario destino '".$responsablea."' por '".$responsableb."' </li>";
	    			$change = true;
	    			$changeuser = true;
	    		}
	    		if($object->GetCiudad() != $ciudad){
					$responsablea = $c->GetDataFromTable("city", "Code", $object->GetCiudad(), "Name", $separador = " ");
					$responsableb = $c->GetDataFromTable("city", "Code", $ciudad, "Name", $separador = " ");
	    			$path .= "<li>Se edito el campo Ciudad'".$responsablea."' por '".$responsableb."' </li>";
	    			$change = true;
	    			$changeuser = true;
	    		}
	    		if($object->GetOficina() != $oficina){
					$responsablea = $c->GetDataFromTable("seccional", "id", $object->GetOficina(), "nombre", $separador = " ");
					$responsableb = $c->GetDataFromTable("seccional", "id", $oficina, "nombre", $separador = " ");
	    			$path .= "<li>Se edito el campo Oficina '".$responsablea."' por '".$responsableb."' </li>";
	    			$change = true;
	    			$changeuser = true;
	    		}
	    		if($object->GetDependencia_destino() != $dependencia_destino){
					$responsablea = $c->GetDataFromTable("areas", "id", $object->GetDependencia_destino(), "nombre", $separador = " ");
					$responsableb = $c->GetDataFromTable("areas", "id", $dependencia_destino, "nombre", $separador = " ");
	    			$path .= "<li>Se edito el campo ".CAMPOAREADETRABAJO." de trabajo '".$responsablea."' por '".$responsableb."' </li>";
	    			$change = true;
	    			$changeuser = true;
	    		}

	    		if($change){

					$objecte = new MEvents_gestion;
					$create = $object->UpdateGestion($constrain, $ar2, $ar1, $output);
					$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Editado", "Se ha editado la informacion del Expediente  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eexp", $object->GetId());

				}

				if ($changeuser) {

					$objecte = new MEvents_gestion;
					$us = new MUsuarios;
					$us->CreateUsuarios("a_i", $u->GetA_i());
					$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Transferido", "La transferencia del expediente al usuario ".$us->GetP_nombre()." ".$us->GetP_apellido()." ha sido completada correctamente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $us->GetA_i(), "texp", $us->GetA_i());

				}

			$ar2 = array('estado');
			$ar1 = array("1");	
			$output = array('registro actualizado', 'no se pudo actualizar'); 
			$constrain = 'WHERE id = '.$id;
			$this->Editar($constrain, $ar2, $ar1, $output);
		}

		function GetHistorial($type = "1", $fi = "", $ff = ""){
				//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;
			global $c;
			global $f;

	    	#$query = $object->ListarSuscriptores_modulos();
			
			$pagina = $this->load_template_limpia('Historial de Transferencias');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			if ($fi == "" && $ff == "") {
				$fi = "2017-01-01";
				$ff = date("Y-m-d");
			}
			$object = new MGestion_transferencias;
			$path = "";
			$titulo = "";
			switch ($type) {
				case '1':
					$path = "WHERE user_transfiere = '".$_SESSION['usuario']."' and estado = '0' ";
					$titulo = "Historial de Transferencias Enviadas";
					if ($fi != "" && $ff != "") {
						$path .= " and date(fecha_transferencia) between '$fi' and '$ff' ";
					}
					break;
				
				case '2':
					$path = "WHERE user_recibe = '".$_SESSION['user_ai']."' and estado = '1' ";
					$titulo = "Historial de Transferencias Recibidas";
					if ($fi != "" && $ff != "") {
						$path .= " and date(fecha_transferencia) between '$fi' and '$ff' ";
					}
					break;
				case '3':
					$path = "WHERE (user_recibe = '".$_SESSION['user_ai']."' or user_transfiere = '".$_SESSION['usuario']."') and estado = '2' ";
					$titulo = "Historial de Transferencias Rechazadas";
					if ($fi != "" && $ff != "") {
						$path .= " and date(fecha_transferencia) between '$fi' and '$ff' ";
					}
					break;
				
				default:
					$path = "WHERE user_transfiere = '".$_SESSION['usuario']."' and estado = '0'";
					$titulo = "Historial de Transferencias Enviadas";
					if ($fi != "" && $ff != "") {
						$path .= " and date(fecha_transferencia) between '$fi' and '$ff' ";
					}
					break;
			}


			$consulta = $object->ListarGestion_transferencias($path);

	    	include(VIEWS.DS."gestion_transferencias/historial.php");	   			
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
	}
?>