<?
session_start();
#session_start();
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
	#include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	
	include_once(MODELS.DS.'Solicitudes_documentosM.php');
	


	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	

	// Llamando al objeto a controlar		

	$ob = new CSolicitudes_documentos;

	$c = new Consultas;

	$f = new Funciones;

	

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

			$ob->Insertar($_SESSION['usuario'], $c->sql_quote($_REQUEST["usuario_destino"]), date("Y-m-d H:i:s"), "", "", $c->sql_quote($_REQUEST["gestion_id"]), $c->sql_quote($_REQUEST["descripcion"]), "0");

		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'editar')

			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')

			$ob->ActualizarSolicitud($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['fecha_caducidad']), $c->sql_quote($_REQUEST['gestion_id']), $c->sql_quote($_REQUEST['descripcion']), $c->sql_quote($_REQUEST['dar_permiso']));

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')

			$ob->Eliminar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			

		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')

			$ob->Buscar($c->sql_quote($_REQUEST['fechai']), $c->sql_quote($_REQUEST['fechaf']), $c->sql_quote($_REQUEST['filtro']));		

		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar('');		

	

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CSolicitudes_documentos extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){



			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO	

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();				

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

#			include_once(VIEWS.DS.'events/default.php');	   			



			// CREANDO UN NUEVO MODELO			

			$object = new MSolicitudes_documentos;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarSolicitudes_documentos("WHERE usuario_destino ='".$_SESSION['usuario']."' and estado = '0'");	    

			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO



			include_once(VIEWS.DS.'solicitudes_documentos/Listar.php');	   			

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

			$pagina = $this->load_template('Crear Solicitudes_documentos');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'solicitudes_documentos/FormInsertSolicitudes_documentos.php');				

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						

			$path = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER	

			$this->view_page($pagina);		

		}

		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO

		function VistaEditar($x){

			global $c;

			global $f;

			global $con;

			//CARGA EL TEMPLATE

			$pagina = $this->load_template('Crear Solicitudes_documentos');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

	 		// INVOCAMOS UN NUEVO OBJETO

		 	$object = new MSolicitudes_documentos;

			// LO CREAMOS 			

			$object->CreateSolicitudes_documentos('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'solicitudes_documentos/FormUpdateSolicitudes_documentos.php');		

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						

			$path = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER	

			$this->view_page($pagina);		



	 	}	

	 	function Buscar($fi, $ff, $filtro){

			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO	

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();				

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

#			include_once(VIEWS.DS.'events/default.php');	   			

			// CREANDO UN NUEVO MODELO			

			$object = new MSolicitudes_documentos;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			/*

				<option value="1">Solicitudes Nuevas</option>

				<option value="2">Solicitudes Realizadas por mi</option>

				<option value="3">Solicitudes Rechazadas</option>

				<option value="4">Solicitudes Aceptadas</option>

			*/

			switch ($filtro) {

				case '1':

					$path = "and usuario_destino ='".$_SESSION['usuario']."' and estado = '0'";

					$page = "Listar";

					break;

				case '2':

					$path = "and usuario_solicita ='".$_SESSION['usuario']."'";

					$page = "Listar2";

					break;

				case '3':

					$path = "and usuario_destino ='".$_SESSION['usuario']."' and estado = '2'";

					$page = "Listar";

					break;

				case '4':

					$path = "and usuario_destino ='".$_SESSION['usuario']."' and estado = '1'";

					$page = "Listar";

					break;

				

				default:

					$path = "and usuario_destino ='".$_SESSION['usuario']."' and estado = '0'";

					$page = "Listar";

					break;

			}



			$query = $object->ListarSolicitudes_documentos("WHERE fecha_solicitud between '$fi' and '$ff' $path");	    

				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

			include_once(VIEWS.DS.'solicitudes_documentos/'.$page.'.php');	   			

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

			$table = ob_get_clean();	

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);

	 	}		

		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS		

		function Insertar($usuario_solicita, $usuario_destino, $fecha_solicitud, $fecha_respuesta, $fecha_caducidad, $gestion_id, $observacion, $estado){

			// DEFINIENDO EL OBJETO			

			global $c;

			global $f;

			global $con;



			$id_gestion = "0";

			if ($gestion_id != "") {

				$g = new MGestion;

				$g->CreateGestion("min_rad", trim($gestion_id));

				if ($g->GetId() != "") {

					$id_gestion = $g->GetId();

				}

			}



			if ($observacion == '<br><span style="color:gray">Si no Conoce el número del expediente que necesita, escriba Aquí el(los) nombre del documento que necesita de forma especifica y el expediente donde desea le sea compartido</span><br>') {

				$observacion = "";

			}

			$object = new MSolicitudes_documentos;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertSolicitudes_documentos($usuario_solicita, $usuario_destino, $fecha_solicitud, $fecha_respuesta, $fecha_caducidad, $id_gestion, $observacion, $estado);

			

			$id = $c->GetMaxIdTabla("solicitudes_documentos", "id");

			$c->InsertarAlerta($usuario_destino, "1", "nsdoc", $id, $id_gestion);

			#echo "<script></script>";

			header("Location: ".HOMEDIR.DS."solicitudes_documentos/Listar/");



		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			$object = new MSolicitudes_documentos;

			$create = $object->UpdateSolicitudes_documentos($constrain, $fields, $updates, $output);



		}

		function ActualizarSolicitud($id, $fecha_caducidad, $gestion_id, $observacion, $dar_permiso){

			// DEFINIENDO EL OBJETO			

			global $c;

			global $f;

			global $con;



			$id_gestion = "0";

			if ($gestion_id != "") {

				$g = new MGestion;

				$g->CreateGestion("min_rad", trim($gestion_id));

				if ($g->GetId() != "") {

					$id_gestion = $g->GetId();

				}

			}



			$object = new MSolicitudes_documentos;

			$object->CreateSolicitudes_documentos("id", $id);



			$ar2 = array('estado', 'fecha_caducidad', 'fecha_respuesta', 'respuesta', 'gestion_id');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			$ar1 = array('1', $fecha_caducidad, date("Y-m-d H:i:s"), $observacion, $id_gestion);	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE id = '.$id;

			

			if ($dar_permiso != "-1") {



				$compartir = new MGestion_compartir;

				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

				$create = $compartir->InsertGestion_compartir($_SESSION['usuario'], $object->GetUsuario_solicita(), $id_gestion, date("Y-m-d H:i:s"), $observacion, $dar_permiso, "1", $fecha_caducidad);

				

				$id = $c->GetMaxIdTabla("gestion_compartir", "id");



				$us = new MUsuarios;

				$us->CreateUsuarios("user_id", $object->GetUsuario_solicita());



				$username = $us->GetP_nombre()." ".$us->GetP_apellido();

				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

				/*

					InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

				*/

				$objecte = new MEvents_gestion;

				$objecte->InsertEvents_gestion($_SESSION['usuario'], $id_gestion, date("Y-m-d"), "Expediente Compartido", "Se ha compartido el expediente con el usuario $username", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $us->GetA_i(), "comp", $id);



			}

			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.	

			$this->Editar($constrain, $ar2, $ar1, $output);

			header("Location: ".HOMEDIR.DS."solicitudes_documentos/Listar/");



		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id, $respuesta){

			global $con;

			global $f;

			global $c;



			$object = new MSolicitudes_documentos;

			$object->CreateSolicitudes_documentos("id", $id);

			// DEFINIMOS UN OBJETO NUEVO						

			// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

			$ar2 = array('estado', 'respuesta');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			$ar1 = array('2', $respuesta);	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE id = '.$_REQUEST['id'];

			

			echo "Solicitud Rechazada";

			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.	

			$this->Editar($constrain, $ar2, $ar1, $output);



			$c->InsertarAlerta($object->GetUsuario_solicita(), "1", "dndoc", $id, $object->GetGestion_id());

			

		}

	}

?>

		