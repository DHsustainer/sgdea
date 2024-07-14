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

	include_once(MODELS.DS.'UsuariosM.php');

	require_once(PLUGINS.DS.'tcpdf/tcpdf.php');

	require_once(PLUGINS.DS.'FPDI/fpdi.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	



	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	

	// Llamando al objeto a controlar		

	$ob = new CGestion_anexos_firmas;

	$c = new Consultas;

	$f = new Funciones;

	

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('fecha_firma', 'codigo_firma', 'clave_primaria', 'estado_firma', 'repo_1', 'repo_2');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

	$ar1 = array(date("Y-m-d H:i:s"), $_SESSION["ACTIVEKEY"], $_SESSION["SID"], "1", "", "");	

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

			$ob->Insertar($c->sql_quote($_REQUEST["gestion_id"]), $c->sql_quote($_REQUEST["anexo_id"]), $c->sql_quote($_REQUEST["tipologia_id"]), $c->sql_quote($_REQUEST["fecha_solicitud"]), $c->sql_quote($_REQUEST["usuario_solicita"]), $c->sql_quote($_REQUEST["usuario_firma"]), $c->sql_quote($_REQUEST["fecha_firma"]), $c->sql_quote($_REQUEST["codigo_firma"]), $c->sql_quote($_REQUEST["clave_primaria"]), $c->sql_quote($_REQUEST["estado_firma"]), $c->sql_quote($_REQUEST["repo_1"]), $c->sql_quote($_REQUEST["repo_2"]));

		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	

		elseif($c->sql_quote($_REQUEST['action']) == 'editar')

			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar'){



			$ob->Editar($constrain, $ar2, $ar1, $output, trim($c->sql_quote($_REQUEST["cn"])), '1');

			

		}

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')

			$ob->Eliminar($c->sql_quote($_REQUEST['id']), trim($c->sql_quote($_REQUEST["cn"])));

		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			

		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')

			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar('');		

	

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CGestion_anexos_firmas extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){

			// CREANDO UN NUEVO MODELO			

			$object = new MGestion_anexos_firmas;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template('Listar Gestion_anexos_firmas');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarGestion_anexos_firmas();	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

					include_once(VIEWS.DS.'gestion_anexos_firmas/Listar.php');	   			

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

			$pagina = $this->load_template('Crear Gestion_anexos_firmas');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'gestion_anexos_firmas/FormInsertGestion_anexos_firmas.php');				

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

	 		$pagina = $this->load_template('Editar Gestion_anexos_firmas');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

	 		// INVOCAMOS UN NUEVO OBJETO

		 	$object = new MGestion_anexos_firmas;

			// LO CREAMOS 			

			$object->CreateGestion_anexos_firmas('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'gestion_anexos_firmas/FormUpdateGestion_anexos_firmas.php');		

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											

			$table = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER		

			$this->view_page($pagina);

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MGestion_anexos_firmas;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Gestion_anexos_firmas');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarGestion_anexos_firmas('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'gestion_anexos_firmas/Listar.php');	   			

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

		function Insertar($gestion_id, $anexo_id, $tipologia_id, $fecha_solicitud, $usuario_solicita, $usuario_firma, $fecha_firma, $codigo_firma, $clave_primaria, $estado_firma, $repo_1, $repo_2){

			// DEFINIENDO EL OBJETO			

			$object = new MGestion_anexos_firmas;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertGestion_anexos_firmas($gestion_id, $anexo_id, $tipologia_id, $fecha_solicitud, $usuario_solicita, $usuario_firma, $fecha_firma, $codigo_firma, $clave_primaria, $estado_firma, $repo_1, $repo_2);

			

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($create != '1')

				$this->VistaListar('ERROR AL REGISTRAR');

			else

				$this->VistaListar('OK!');	



		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output, $password, $estadodc){

			global $con;

			global $f;

			global $c;



			$password = hash("sha512", $password);

			



			$objectfirma = new MGestion_anexos_firmas;

			$objectfirma->CreateGestion_anexos_firmas("id", $c->sql_quote($_REQUEST['id']));



			$id = $con->Result($con->Query("select id from gestion_anexos_permisos where usuario_permiso = '".$_SESSION['usuario']."' and id_documento = '".$objectfirma->GetAnexo_id()."'"), 0, "id");



			$object = new MGestion_anexos_permisos;

			$object->CreateGestion_anexos_permisos("id", $id);



			$ar1x = array($estadodc, date("Y-m-d H:i:s"), $object->GetObservacion()."<br><b>".$_SESSION['usuario']." dice: </b>".$c->sql_quote($_REQUEST['p1']));	

			$create = $object->UpdateGestion_anexos_permisos('WHERE id = '.$id, array('estado','fecha_actualizacion', 'observacion'), $ar1x,  array('registro actualizado', 'no se pudo actualizar'));



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





			$objectfirma = new MGestion_anexos_firmas;

			$create = $objectfirma->UpdateGestion_anexos_firmas($constrain, $fields, $updates, $output);


			$MUsuarios = new MUsuarios;
			$MUsuarios->CreateUsuarios("user_id", $_SESSION['usuario']);

			$nombre_usuario = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetS_nombre()." ".$MUsuarios->GetP_apellido()." ".$MUsuarios->GetS_apellido();

			$estadodov = array("0" => "Pendiente por Revisar", "1" => "Verificado", "2" => "Rechazado");
			$estadodov = $estadodov[$estadodc];
			/*modificar documento*/
			$filename = $doc->GetUrl();
		    $linkfile = HOMEDIR.DS."app/archivos_uploads/gestion/".$doc->GetGestion_id().trim("/anexos/ ").$doc->GetUrl();
		    $linkfile2 = "app/archivos_uploads/gestion/".$doc->GetGestion_id().trim("/anexos/ ").$doc->GetUrl();
		    //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);
		  	$path_file2 = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$doc->GetGestion_id().trim("/anexos/ ").$doc->GetUrl()."";
		    $file = realpath($path_file2);
		    $pdf = new FPDI(); 
		    $pagecount = $pdf->setSourceFile($file);
			for($i = 1 ; $i <= $pagecount ; $i++){
				$tpl  = $pdf->importPage($i);
	            $size = $pdf->getTemplateSize($tpl);
	            $orientation = $size['h'] > $size['w'] ? 'P':'L';
				$pdf->Rect(3, 4, 180, 4, 'F', array(), array(255,255,255));						
	            $pdf->SetFont('Helvetica', 0, '8');
	            $pdf->SetTextColor(0, 0, 0);
	            $pdf->SetXY(3, 4);
	            $pdf->Write(0, 'Documento '.$estadodov.' por '.$nombre_usuario." El día: ".date('d-m-Y')." a las: ".date('H:i:s'));
	           	$pdf->AddPage($orientation);
	           	$pdf->useTemplate($tpl, null, null, $size['w'], $size['h'], true);
			
			}

			$pdf->Rect(3, 4, 180, 4, 'F', array(), array(255,255,255));	
		    $pdf->SetFont('Helvetica', 0, '8');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(3, 4);
            $pdf->Write(0, 'Documento '.$estadodov.' por '.$nombre_usuario." El día: ".date('d-m-Y')." a las: ".date('H:i:s'));
			$pdf->Output($path_file2, 'F');
#			print_r($size);



			echo "1";
		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id, $password){

			global $c;

			global $con;



			// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

			$ar2 = array('fecha_firma', 'estado_firma');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			$ar1 = array(date("Y-m-d H:i:s"), "2");	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE id = '.$id;

			$this->Editar($constrain, $ar2, $ar1, $output, $password, "2");

					

		}

	}

?>