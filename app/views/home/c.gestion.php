<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
	//Invocando archivos que seran usados en nuestro controlador generico

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'Areas_dependenciasM.php');

	include_once(MODELS.DS.'AreasM.php');

	include_once(MODELS.DS.'Alertas_suscriptorM.php');

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

	include_once(MODELS.DS.'Estados_gestionM.php');

	include_once(MODELS.DS.'FolderM.php');

	include_once(MODELS.DS.'GestionM.php');

	include_once(MODELS.DS.'Solicitudes_documentosM.php');

	include_once(MODELS.DS.'Mailer_messageM.php');

	include_once(MODELS.DS.'Mailer_attachmentsM.php');

	include_once(MODELS.DS.'Mailer_from_messageM.php');

	include_once(MODELS.DS.'Mailer_replysM.php');

	include_once(MODELS.DS.'NotificacionesM.php');

	include_once(MODELS.DS.'Gestion_anexosM.php');

	include_once(MODELS.DS.'Gestion_transferenciasM.php');

	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');

	include_once(MODELS.DS.'Gestion_compartirM.php');

	include_once(MODELS.DS.'Gestion_folderM.php');

	include_once(MODELS.DS.'Gestion_suscriptoresM.php');

	include_once(MODELS.DS.'ProvinceM.php');

	include_once(MODELS.DS.'Ref_tablesM.php');

	include_once(MODELS.DS.'Seccional_principalM.php');

	include_once(MODELS.DS.'SeccionalM.php');

	include_once(MODELS.DS.'Super_adminM.php');

	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');

	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');

	include_once(MODELS.DS.'Wf_mapasM.php');

	include_once(MODELS.DS.'Wf_mapas_elementosM.php');

	include_once(MODELS.DS.'Wf_gestion_mapasM.php');

	include_once(MODELS.DS.'Wf_gestion_mapas_elementosM.php');

	include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'Plantillas_emailM.php');

	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');

	include_once(PLUGINS.DS.'PHPExcel.php');

	include_once(PLUGINS.DS.'nusoap/nusoap.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');

	include_once(MODELS.DS.'Meta_big_dataM.php');	

	include_once(MODELS.DS.'Meta_referencias_camposM.php');	

	include_once(MODELS.DS.'Meta_referencias_titulosM.php');	

	include_once(MODELS.DS.'Meta_listas_valoresM.php');	

	include_once(MODELS.DS.'Meta_listasM.php');	


	include_once(MODELS.DS.'Plantilla_documento_configuracionM.php');
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');
	include_once(PLUGINS.DS.'phpqrcode/qrlib.php');
	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');

	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	// Llamando al objeto a controlar

	$ob = new CGestion;

	$c = new Consultas;

	$f = new Funciones;

	$au = new MAlertas_usuarios;

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('radicado', 'suscriptor_id', 'fecha_vencimiento', 'estado_respuesta', 'prioridad', 'observacion', 'estado_archivo', 'f_recibido', 'estado_solicitud', 'fecha_respuesta', 'documento_salida', 'observacion2', 'tipo_documento', 'id_dependencia_raiz', 'estado_personalizado');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER
	$ar1 = array($c->sql_quote($_REQUEST['radicado']), $c->sql_quote($_REQUEST['suscriptor_id']),  $c->sql_quote($_REQUEST['fecha_vencimiento']), $c->sql_quote($_REQUEST['estado_respuesta']), $c->sql_quote($_REQUEST['prioridad']), $c->sql_quote($_REQUEST['observacion']), $c->sql_quote($_REQUEST['estado_archivo']), $c->sql_quote($_REQUEST['fecha_recibido']), $c->sql_quote($_REQUEST['estado_solicitud']),  $c->sql_quote($_REQUEST['fecha_respuesta']), $c->sql_quote($_REQUEST['documento_salida']), $c->sql_quote($_REQUEST['observacion2']), $c->sql_quote($_REQUEST['tipo_documento']), $c->sql_quote($_REQUEST['id_dependencia_raiz']), $c->sql_quote($_REQUEST['estado_personalizado']));

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
		elseif($c->sql_quote($_REQUEST['action']) == 'carga')

			$ob->VistaMultiple();

		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR

		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')

		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR

			$ob->Insertar($c->sql_quote($_REQUEST["radicado"]), $c->sql_quote($_REQUEST["f_recibido"]), $c->sql_quote($_REQUEST["nombre_radica"]), $c->sql_quote($_REQUEST["folio"]), $c->sql_quote($_REQUEST["tipo_documento"]), $c->sql_quote($_REQUEST["dependencia_destino"]), $c->sql_quote($_REQUEST["nombre_destino"]), $c->sql_quote($_REQUEST["fecha_vencimiento"]), $c->sql_quote($_REQUEST["estado_respuesta"]), $c->sql_quote($_REQUEST["num_oficio_respuesta"]), $c->sql_quote($_REQUEST["fecha_respuesta"]), $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["prioridad"]), $c->sql_quote($_REQUEST["estado_solicitud"]), $c->sql_quote($_REQUEST["suscriptor_id"]), $c->sql_quote($_REQUEST["ciudad"]), $c->sql_quote($_REQUEST["usuario_registra"]), $c->sql_quote($_REQUEST["estado_archivo"]), $c->sql_quote($_REQUEST["oficina"]), $c->sql_quote($_REQUEST["id_dependencia_raiz"]), $c->sql_quote($_REQUEST["autorad"]), $c->sql_quote($_REQUEST["dtform"]), $c->sql_quote($_REQUEST["documento_salida"]), $c->sql_quote($_REQUEST['observacion2']));

		elseif($c->sql_quote($_REQUEST['action']) == 'registro_publico')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR

			$ob->InsertarPublico($c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST['observacion2']), $c->sql_quote($_REQUEST['tipo_documento']));


		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR

		elseif($c->sql_quote($_REQUEST['action']) == 'editar')

			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'ver')

			$ob->VistaVer($c->sql_quote($_REQUEST['id']));

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'GetAnexosMovil')

			$ob->VistaVerAnexosMovil($c->sql_quote($_REQUEST['id']));

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')

			$ob->Editar($constrain, $ar2, $ar1, $output, $_REQUEST['id']);

		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR

		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')

			$ob->Eliminar($c->sql_quote($_REQUEST['id']));

		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR

		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')

			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetAnexos')

			$ob->GetAnexos($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetAnexos2')

			$ob->GetAnexos2($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetDocumentos')

			$ob->GetDocumentos($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetFormularios')

			$ob->GetFormularios($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetAlertas')

			$ob->GetAlertas($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetSuscriptores')

			$ob->GetSuscriptores($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetActuaciones')

			$ob->GetActuaciones($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['fechai']) , $c->sql_quote($_REQUEST['fechaf']) , $c->sql_quote($_REQUEST['type']) , $c->sql_quote($_REQUEST['filter']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetInbox')

			$ob->GetElectronica($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetMailbox')

			$ob->GetMailbox($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetShared')

			$ob->GetShared($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'reparto')
			$ob->GetReparto($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		elseif($c->sql_quote($_REQUEST['action']) == 'getreparto')
			$ob->CargarReparto();
		elseif($c->sql_quote($_REQUEST['action']) == 'myfiles')

			$ob->GetMyfiles($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'obtener')

			$ob->GetDatosGestion($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'inventario')

			$ob->GetInventario($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		elseif($c->sql_quote($_REQUEST['action']) == 'inventario2')

			$ob->GetInventario2();
		elseif($c->sql_quote($_REQUEST['action']) == 'ventanilla')

			$ob->GetPendientes();

		elseif($c->sql_quote($_REQUEST['action']) == 'GetId_c')

			$ob->GetId_c($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'GetId_a')

			$ob->GetId_a($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'aceptarsolicitud')
		
			$ob->AceptarSolicitud($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['area']), $c->sql_quote($_REQUEST['serie']), $c->sql_quote($_REQUEST['subserie']), $c->sql_quote($_REQUEST['user']), $c->sql_quote($_REQUEST['observacion2']));	
		
		elseif($c->sql_quote($_REQUEST['action']) == 'rechazarsolicitud')
			$ob->RechazarSolicitud($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['observacion2']));	
		elseif($c->sql_quote($_REQUEST['action']) == 'esperasolicitud')
			$ob->EsperaSolicitud($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['observacion2']));	

		elseif($c->sql_quote($_REQUEST['action']) == 'imprimir')

			$ob->PrintPage($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'imprimirdocumento')

			$ob->PrintDocument($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'correspondencia')

			$ob->GetCorrespondencia($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'CargaMasivaCorrespondencia')

			$ob->GetCargaMasivaCorrespondencia($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'CargarArchivoCorrespondencia')

			$ob->GetCargarArchivoCorrespondencia($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'cargararchivocorrespondenciapublico'){
			
			$filename=UPLOADS.DS.'tmp_base/';
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . "tmp_base", 0777);
			}
			$filename=UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'];
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . "tmp_base/".$_SESSION['smallid'], 0777);
			}
			$uploads_dir = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'];
			$i = 0;
			foreach ($_FILES["pictures"]["error"] as $key => $error) {
			    if ($error == UPLOAD_ERR_OK) {
			        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
			        $name = $_FILES["pictures"]["name"][$key];

			        $rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);
					$ext = end(explode(".", $_FILES['pictures']['name'][$key]));

					$fname = $rand.".".$ext;

			        copy($tmp_name, $uploads_dir."/".$_FILES["pictures"]["name"][$key]);
			        $i++;
			    }
			}
			echo "<div class='alert alert-info'>$i Archivos Cargados<div>";

		}


		elseif($c->sql_quote($_REQUEST['action']) == 'CargarArchivoCorrespondenciaProcesar')

			$ob->GetCargarArchivoCorrespondenciaProcesar($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'cargamasivapublica')

			$ob->ProcesarMasiva();
		

		elseif($c->sql_quote($_REQUEST['action']) == 'carga_archivo_masivo'){

			$filename=UPLOADS.DS.'tmp_base/';
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . "tmp_base", 0777);
			}
			$filename=UPLOADS.DS.'tmp_base/'.$_SESSION['smallid']."/";
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS."tmp_base/".$_SESSION['smallid'] , 0777);
			}

			$uploads_dir = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'];

			foreach ($_FILES["pictures"]["error"] as $key => $error) {
			    if ($error == UPLOAD_ERR_OK) {
			        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
			        $name = $_FILES["pictures"]["name"][$key];

			        $rand = "file_".$_SESSION['suscriptor_id'];
					$ext = end(explode(".", $_FILES['pictures']['name'][$key]));

					$fname = $rand.".".$ext;

			        copy($tmp_name, $uploads_dir."/".$fname);
			    }
			}

			$ob->GetCargarArchivoCorrespondenciaProcesarPublico($uploads_dir."/".$fname);

		}


		elseif($c->sql_quote($_REQUEST['action']) == 'VerCodeQR')

			$ob->GetVerCodeQR($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'listadodocumentosqr')

			$ob->GetListadoDocumentosQR($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'InteraccionSuscriptores')

			$ob->GetInteraccionSuscriptores($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'vencimientoexpedientesarchivo')

			$ob->GetVencimientoExpedientesArchivo($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'doBigData')

			$ob->DoBigData($c->sql_quote($_REQUEST['id']),$c->sql_quote($_REQUEST['cn']));

		elseif($c->sql_quote($_REQUEST['action']) == 'verform')
			$ob->VerForm($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		elseif($c->sql_quote($_REQUEST['action']) == 'ConsultarFormularioSubSeries')
			$ob->ConsultarFormularioSubSeries($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'getlistadoformularios')
			$ob->getlistadoformularios($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'registrarFormulario')
			$ob->RegistrarFormulario($c->sql_quote($_REQUEST['type_id']), $c->sql_quote($_REQUEST['ref_id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'getareas')
			$ob->GetAreas($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'getusers')
			$ob->GetAreas($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'getuserfolders')
			$ob->GetUserFolders($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'exportar')
			$ob->ExportarResumen($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'cambiarfiltro'){
			
			$_SESSION['filtro_fi'] = $c->sql_quote($_REQUEST['f_fi']);
			$_SESSION['filtro_ff'] = $c->sql_quote($_REQUEST['f_ff']);
			$_SESSION['filtro_estado'] = $c->sql_quote($_REQUEST['estado']);
			$_SESSION['filtro_prioridad'] = $c->sql_quote($_REQUEST['prioridad']);

			header("LOCATION: ".HOMEDIR.$c->sql_quote($_REQUEST['retorno']));


		}else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO

			$ob->VistaListar('');

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CGestion extends MainController{

		// DEFINIENDO LA FUNCION LISTAR

		function VistaListar(){

			// CREANDO UN NUEVO MODELO

			$object = new MGestion;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ

			$pagina = $this->load_template('Listar Gestion');

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarGestion();

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

					include_once(VIEWS.DS.'gestion/Listar.php');

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

		function VistaVer($id){

			global $con;

			global $f;

			// CREANDO UN NUEVO MODELO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$object = new MGestion;

			// LO CREAMOS

			$object->CreateGestion('id', $id);



			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO

			if ($_SESSION['suscriptor_id'] == "") {
				//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

				$pagina = $this->load_template($object->GetMin_rad()." - ".$object->GetObservacion()." ".ST.PROJECTNAME);
				ob_start();
				include_once(VIEWS.DS.'gestion/FormUpdateGestion.php');
			}else{
				$pagina = $this->load_templateAmpleApp($object->GetMin_rad()." - ".$object->GetObservacion()." ".ST.PROJECTNAME);
				ob_start();
				include_once(VIEWS.DS.'gestion/FormUpdateGestionPublica.php');
			}

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

			global $con;
			global $f;
			// CREANDO UN NUEVO MODELO
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			if ($_SESSION['suscriptor_id'] == "") {
				$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				include_once(VIEWS.DS.'gestion/FormInsertGestion.php');
				// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.
				$table = ob_get_clean();
				// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
				// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				// RETORNAME LA PAGINA CARGADA
				$this->view_page($pagina);
			}else{
				$pagina = $this->load_templateAmpleApp(PROJECTNAME.ST." Sub Series");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				include_once(VIEWS.DS.'gestion/FormInsertGestionPublica.php');
				// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.
				$table = ob_get_clean();
				// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
				// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				// RETORNAME LA PAGINA CARGADA
				$this->view_page($pagina);
			}
		}

		function VistaMultiple(){

			global $con;
			global $f;
			// CREANDO UN NUEVO MODELO
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			$pagina = $this->load_templateAmpleApp(PROJECTNAME.ST." Sub Series");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'gestion/FormInsertGestionMasiva.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.
			$table = ob_get_clean();
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA
			$this->view_page($pagina);
		}

		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO

		function VistaEditar($x){

			// CARGA EL TEMPLATE

	 		$pagina = $this->load_template('Editar Gestion');

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

		 		// INVOCAMOS UN NUEVO OBJETO

			 	$object = new MGestion;

				// LO CREAMOS

				$object->CreateGestion('id', $x);

				// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO

				if ($_SESSION['suscriptor_id'] == "") {
					include_once(VIEWS.DS.'gestion/FormUpdateGestion.php');
				}else{
					include_once(VIEWS.DS.'gestion/FormUpdateGestionPublica.php');
				}

				// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.

				$table = ob_get_clean();

				// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER

				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);

				// CARGAMOS LA PAGINA EN EL BROWSER

				$this->view_page($pagina);

	 	}

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO

			$object = new MGestion;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

			global $con;

			// CARGA EL TEMPLATE

			$pagina = $this->load_template('Listado de Gestion');

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS

			$query = $object->ListarGestion('WHERE '.$cn.' = "'.$x.'"');

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

					include_once(VIEWS.DS.'gestion/Listar.php');

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

		function Insertar($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $num_oficio_respuesta, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $autorad, $dtform, $documento_salida="N", $observacion2){

			// DEFINIENDO EL OBJETO

			global $con;

			global $c;

			global $f;

			if ($suscriptor_id == "N") {

				$suscrr = new MSuscriptores_contactos;

				$createsuscr = $suscrr->InsertSuscriptores_contactos($c->sql_quote($_REQUEST['Identificacion_suscriptor']), $dtform, $c->sql_quote($_REQUEST['Type_suscriptor22']), $_SESSION['usuario'], date("Y-m-d"));

				$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");

				$suscd = new MSuscriptores_contactos_direccion;

				$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, $c->sql_quote($_REQUEST['Direccion_suscriptor']), $c->sql_quote($_REQUEST['Ciudad_suscriptor']), $c->sql_quote($_REQUEST['Telefonos_suscriptor']), $c->sql_quote($_REQUEST['Email_suscriptor']), "");

			}else{
				#actualizar suscriptor
				$con->Query("UPDATE suscriptores_contactos set identificacion = '".$c->sql_quote($_REQUEST['Identificacion_suscriptor'])."', nombre = '".$dtform."', type = '".$c->sql_quote($_REQUEST['Type_suscriptor22'])."' where id='".$suscriptor_id."' ");	
				$con->Query("UPDATE suscriptores_contactos_direccion set direccion = '".$c->sql_quote($_REQUEST['Direccion_suscriptor'])."', ciudad = '".$c->sql_quote($_REQUEST['Ciudad_suscriptor'])."', telefonos = '".$c->sql_quote($_REQUEST['Telefonos_suscriptor'])."', email = '".$c->sql_quote($_REQUEST['Email_suscriptor'])."' where id_contacto ='".$suscriptor_id."' ");	

			}


			$object = new MGestion;


			$nr = $object->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);

			$minr = $object->GetMinRadicado($documento_salida);


			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA

			$create = $object->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida, "0", $observacion2);

			$id = $c->GetMaxIdTabla("gestion", "id");

			$filename=UPLOADS.DS.$id.'/';

			if (!file_exists($filename)) {

			    mkdir(UPLOADS.DS . $id, 0777);

			}

			$filename=UPLOADS.DS.$id.'/anexos/';

			if (!file_exists($filename)) {

			    mkdir(UPLOADS.DS . $id.'/anexos', 0777);

			}

		

			$elementos = implode(',', $_REQUEST['elementos']);
			$listaelementos = explode(",", $elementos);

			for ($j=0; $j < count($listaelementos) ; $j++) { 

				# code...
				$dogc = new MDependencias_tipologias;
				$dogc->CreateDependencias_Tipologias("id", $listaelementos[$j]);

				if ($dogc->GetId() != "") {

					$an = new MGestion_anexos;

					$in_out = $c->GetDataFromTable("dependencias_tipologias", "id", $dogc->GetTipologia(), "es_entrada", "");
					$in_out = ($in_out == "0")?"-1":"1";
					
					$an->InsertGestion_anexos($id, $dogc->GetTipologia(), "", $_SESSION['usuario'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", 		"1", 	$i, 		$i, 		"1", 			$dogc->GetId(), $in_out, "0");


				}

			}
#			exit;
			if ($suscriptor_id != "") {

				$s = new MGestion_suscriptores();

				$s->InsertGestion_suscriptores($id, $suscriptor_id, $_SESSION['usuario'], "1", "1", date("Y-m-d"));

			}

			$call = "*";

			if ($nombre_destino == "0") {

				$call = "*";

			}elseif ($nombre_destino == "-1") {

				$call = "areaboss";

			}else{

				$call = $nombre_destino;

			}

			# SI ESTÁ EN GESTION CREA EVENTOS!


			$objecte = new MEvents_gestion;
			#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
			$objecte->InsertEvents_gestion($_SESSION['usuario'], $id, date("Y-m-d"), "Creación de Radicación", "Se ha creado la radicación $nr", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $call, "rad", $id);

			if ($fecha_vencimiento > date("Y-m-d")) {

				$objecte->InsertEvents_gestion($_SESSION['usuario'], $id, $fecha_vencimiento, "Vencimiento de un Expediente", "Se programó vencimiento del expediente para el día ".$fecha_vencimiento, date("Y-m-d"), 1, date("H:i:s"), 0, 3, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $call, "vexp", $id);

			}

			$aertasau = $con->Query("Select * from dependencias_alertas where id_dependencia = '".$tipo_documento."' and automatica = 'SI'");

			while ($rowau = $con->FetchAssoc($aertasau)) {

				$alerta = $rowau['id'];

				$gestion = $id;

				$depa = new MDependencias_alertas;

				$depa->CreateDependencias_alertas("id", $alerta);

				$fecha = date("Y-m-d");

				$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.

				date_modify($fecha_c, $depa->GetDias_alerta()." day");//sumas los dias que te hacen falta.

				$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

				$eventoe = new MEvents_gestion;

			#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA

				$create = $eventoe->InsertEvents_gestion($_SESSION['usuario'], $gestion, $fecha_a, $depa->GetNombre(), $depa->GetDescripcion(), date("Y-m-d"), 0, date("H:i:s"), 0, $depa->GetDias_antes(), 0, $fecha_a, $alerta, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", 'ev', $gestion);

			}

			#Compartir expediente con

			if($c->sql_quote($_REQUEST['cantidadusuariosagregados']) > 0){

				for ($i=0; $i < $c->sql_quote($_REQUEST['cantidadusuariosagregados']); $i++) {

					if($c->sql_quote($_REQUEST['usuarios_id'.$i]) != "" && $c->sql_quote($_REQUEST['usuarios_id'.$i]) != "N"){

						$MUsuarios = new MUsuarios;

						$MUsuarios->CreateUsuarios("a_i", $c->sql_quote($_REQUEST['usuarios_id'.$i]));

						if($MUsuarios->GetA_i() != ""){

							$MGestion_compartir = new MGestion_compartir;

							$create = $MGestion_compartir->InsertGestion_compartir($_SESSION['usuario'], $MUsuarios->GetUser_id(), $id, date("Y-m-d H:i:s"), $observacion, $c->sql_quote($_REQUEST['losusuariospuedenalcompartir']), "0", $fecha_caducidad);

							$idgestion_compartir = $c->GetMaxIdTabla("gestion_compartir", "id");

							$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();

							$MSolicitudes_documentos = new MSolicitudes_documentos;

							$MSolicitudes_documentos->InsertSolicitudes_documentos($MUsuarios->GetUser_id(), $_SESSION['usuario'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $fecha_caducidad, $id, $observacion, "1");

							$MEvents_gestion = new MEvents_gestion;

							$MEvents_gestion->InsertEvents_gestion($_SESSION['usuario'], $id, date("Y-m-d"), "Expediente Compartido", "Se ha compartido el expediente con el usuario $username", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $MUsuarios->GetA_i(), "comp", $idgestion_compartir);

						}

					}

				}

			}

			if($c->sql_quote($_REQUEST["informerporemail"]) == 'S'){

				$MUsuarios2 = new MUsuarios;

		    	$MUsuarios2->CreateUsuarios("user_id", $_SESSION['usuario']);

		    	$username2 = $MUsuarios2->GetP_nombre()." ".$MUsuarios2->GetP_apellido();

		    	$from = $MUsuarios2->GetEmail();

		    	$g = new MGestion;

				$g->CreateGestion("id", $id);

				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $tipo_documento, "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $suscriptor_id, "nombre", $separador = " ")."";

				$NUMRADICACION = "<a href='".HOMEDIR."/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";

				$MUsuarios = new MUsuarios;

		    	$MUsuarios->CreateUsuarios("a_i", $c->sql_quote($_REQUEST['nombre_destino']));

	    		$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();



				$MPlantillas_email = new MPlantillas_email;

				$MPlantillas_email->CreatePlantillas_email('id', '10');

				$contenido_email = $MPlantillas_email->GetContenido();

				$contenido_email = str_replace("[elemento]responsable[/elemento]",      $username,     $contenido_email );

				$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $username2,    $contenido_email );

				$contenido_email = str_replace("[elemento]rad_completo[/elemento]",      $NUMRADICACION,   $contenido_email );
				$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );


				$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Se le ha compartido el expediente ".$nr,$contenido_email,$MUsuarios->GetEmail());



				if($c->sql_quote($_REQUEST['cantidadusuariosagregados']) > 0){

					for ($i=0; $i < $c->sql_quote($_REQUEST['cantidadusuariosagregados']); $i++) {

						if($c->sql_quote($_REQUEST['usuarios_id'.$i]) != "" && $c->sql_quote($_REQUEST['usuarios_id'.$i]) != "N"){

							$MUsuarios = new MUsuarios;

					    	$MUsuarios->CreateUsuarios("a_i", $c->sql_quote($_REQUEST['usuarios_id'.$i]));

					    	if($MUsuarios->GetA_i() != ""){

					    		$g = new MGestion;

								$g->CreateGestion("id", $id);

								$suscriptordata = $c->GetDataFromTable("dependencias", "id", $tipo_documento, "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $suscriptor_id, "nombre", $separador = " ")."";

								$NUMRADICACION = "<a href='".HOMEDIR."/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";

						    	$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();

								$message = $f->BodyMail($username.'<br><br> El usuario '.$username2.' le ha compartido el expediente '.$NUMRADICACION);

								$mail = new PHPMailer;

								$mail->isSMTP();

								$mail->Host = "ssl://gator4161.hostgator.com";

								$mail->Port = 465;

								$mail->From = $from;

								$mail->FromName =  $username2;

							//	$mail->Mailer = "smtp";

								$mail->SMTPAuth = true; 

								$mail->Subject = "Se le ha compartido el expediente ".$nr;

								$mail->Username = "security@expedientesdigitales.com";

								$mail->Password = "skarface894";

								$mail->ConfirmReadingTo = $from;

								$body = $message;

								$mail->IsHTML(true);

								$mail->Body = $body;

								$mail->AddAddress($MUsuarios->GetEmail());

							}

						}

					}

				}

			}

				//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			$condocs = $con->Query("select id from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1' order by orden");

			#echo "select id from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1'";
			$idref = $con->NumRows($condocs);
/*
			echo "Hola..!";
			echo "--->".$idref['id'];
*/
			if ($idref > 0) {

				$checkInsert = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idref['id']."'");

				$smallid = $f->GenerarSmallId();

				while ($rrrx = $con->FetchAssoc($checkInsert)) {

					$con->Query("INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form, fecha_registro) VALUES ('".$id."', '".$idref['id']."', '".$rrrx['id']."', '', '".$smallid."', '1', '".date("Y-m-d")."')");

				}

				$grupo_id = $smallid;

				echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/doBigData/'.$grupo_id.'/'.$id.'/"</script>';				

			}else{

				echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/"</script>';

			}
		}

		function InsertarPublico($observacion, $observacion2, $tipo_documento){

			global $con;
			global $c;
			global $f;

			$tipo_d = $con->Query("select id, dependencia from dependencias where id = '".$tipo_documento."' ");
			$tipo_dq = $con->FetchAssoc($tipo_d);
			$tipo_documento = $tipo_dq['id'];	
			$id_dependencia_raiz = $tipo_dq['dependencia'];	

			$o = $con->Query("SELECT user_id FROM usuarios_funcionalidades WHERE id_funcionalidad = '12' and valor = '1' limit 0, 1 ");
			$ob = $con->FetchAssoc($o);
			$u = new MUsuarios;
			$u->CreateUsuarios('user_id', $ob['user_id']);

			$se = new MSeccional;
			$se->CreateSeccional("id", $u->GetSeccional());

			$sp = new MSeccional_principal;
			$sp->CreateSeccional_principal("ciudad_origen", $se->GetCiudad());

			$s = new MSuscriptores_contactos;
			$s->CreateSuscriptores_contactos("id", $_SESSION["suscriptor_id"]);
			$sd = new MSuscriptores_contactos_direccion;
			$sd->CreateSuscriptores_contactos_direccion("id_contacto", $_SESSION["suscriptor_id"]);

			$d = new MDependencias;
			$d->CreateDependencias("id", $tipo_documento);

			$dr = new MDependencias;
			$dr->CreateDependencias("id", $id_dependencia_raiz);

			$a = new MAreas;
			$a->CreateAreas("id", $u->GetRegimen());
			
			$radicado = "";
			$f_recibido = date("Y-m-d");
			$nombre_radica = $s->GetNombre();
			$folio = "0";
			$dependencia_destino = $u->GetRegimen();
			$nombre_destino = $u->GetA_i();
			$fecha_vencimiento = "";
			$estado_respuesta = "Pendiente";
			$fecha_respuesta = "";
			$num_oficio_respuesta = date("Y")."-".$a->GetPrefijo()."-".$dr->GetId_c()."-".$d->GetId_c();
			$prioridad = "1";
			$estado_solicitud = "1";
			$suscriptor_id = $s->GetId();
			$ciudad = $se->GetCiudad();
			$usuario_registra = $u->GetUser_id();
			$estado_archivo = "1";
			$oficina = $u->GetSeccional();
			$autorad = "SI";
			$dtform = "";
			$documento_salida="N";
			$observacion .= " ".$c->sql_quote($_REQUEST['nombresuscriptor']);
			// DEFINIENDO EL OBJETO

			#	exit;


			$object = new MGestion;
			#print_r($_REQUEST);
			$nr = $object->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);
			$minr = $object->GetMinRadicado();

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA

			$create = $object->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida, "0", $observacion2, "1");

			$id = $c->GetMaxIdTabla("gestion", "id");

			$filename=UPLOADS.DS.$id.'/';
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . $id, 0777);
			}
			$filename=UPLOADS.DS.$id.'/anexos/';
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . $id.'/anexos', 0777);
			}

			$elementos = implode(',', $_REQUEST['elementos']);
			$listaelementos = explode(",", $elementos);

			for ($j=0; $j < count($listaelementos) ; $j++) { 

				$dogc = new MDependencias_tipologias;
				$dogc->CreateDependencias_Tipologias("id", $listaelementos[$j]);

				if ($dogc->GetId() != "") {

					$an = new MGestion_anexos;
					$in_out = $c->GetDataFromTable("dependencias_tipologias", "id", $dogc->GetTipologia(), "es_entrada", "");
					$in_out = ($in_out == "0")?"-1":"1";					
					$an->InsertGestion_anexos($id, $dogc->GetTipologia(), "", $u->GetUser_id(), date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", 		"1", 	$i, 		$i, 		"1", 			$dogc->GetId(), $in_out, "0");

				}

			}

			if ($suscriptor_id != "") {
				$gs = new MGestion_suscriptores();
				$rsid = $c->sql_quote($_REQUEST['dtform']);
				if($_SESSION['suscriptor_id'] != $rsid){
					if ($rsid == "N") {

						$suscrr = new MSuscriptores_contactos;
						$createsuscr = $suscrr->InsertSuscriptores_contactos($c->sql_quote($_REQUEST['Identificacion_suscriptor']), $c->sql_quote($_REQUEST['nombresuscriptor']), $c->sql_quote($_REQUEST['Type_suscriptor']), $_SESSION['usuario'], date("Y-m-d"), $_SESSION['suscriptor_id']);

						$rsid = $c->GetMaxIdTabla("suscriptores_contactos", "id");

						$suscd = new MSuscriptores_contactos_direccion;
						$suscd->InsertSuscriptores_contactos_direccion($rsid, $c->sql_quote($_REQUEST['Direccion_suscriptor']), $c->sql_quote($_REQUEST['Ciudad_suscriptor']), $c->sql_quote($_REQUEST['Telefonos_suscriptor']), $c->sql_quote($_REQUEST['Email_suscriptor']), "");

					}else{
						#actualizar suscriptor
						$con->Query("UPDATE suscriptores_contactos set identificacion = '".$c->sql_quote($_REQUEST['Identificacion_suscriptor'])."', nombre = '".$c->sql_quote($_REQUEST['nombresuscriptor'])."', type = '".$c->sql_quote($_REQUEST['Type_suscriptor'])."' where id='".$rsid."' ");	

						$con->Query("UPDATE suscriptores_contactos_direccion set direccion = '".$c->sql_quote($_REQUEST['Direccion_suscriptor'])."', ciudad = '".$c->sql_quote($_REQUEST['Ciudad_suscriptor'])."', telefonos = '".$c->sql_quote($_REQUEST['Telefonos_suscriptor'])."', email = '".$c->sql_quote($_REQUEST['Email_suscriptor'])."' where id_contacto ='".$rsid."' ");	

					}

					$gs->InsertGestion_suscriptores($id, $rsid, $u->GetUser_id(), "1", "1", date("Y-m-d"));
				}else{

					#actualizar suscriptor
					$con->Query("UPDATE suscriptores_contactos set identificacion = '".$c->sql_quote($_REQUEST['Identificacion_suscriptor'])."', nombre = '".$c->sql_quote($_REQUEST['nombresuscriptor'])."' where id='".$_SESSION['suscriptor_id']."' ");	

					$con->Query("UPDATE suscriptores_contactos_direccion set direccion = '".$c->sql_quote($_REQUEST['Direccion_suscriptor'])."', ciudad = '".$c->sql_quote($_REQUEST['Ciudad_suscriptor'])."', telefonos = '".$c->sql_quote($_REQUEST['Telefonos_suscriptor'])."', email = '".$c->sql_quote($_REQUEST['Email_suscriptor'])."' where id_contacto ='".$_SESSION['suscriptor_id']."' ");						

				}

				
				$gs->InsertGestion_suscriptores($id, $_SESSION['suscriptor_id'], $u->GetUser_id(), "1", "1", date("Y-m-d"));

			}

			$call = "*";
			if ($nombre_destino == "0") {
				$call = "*";
			}elseif ($nombre_destino == "-1") {
				$call = "areaboss";
			}else{
				$call = $nombre_destino;
			}

			$objecte = new MEvents_gestion;

		#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA

			$objecte->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Creación de Radicación", "Se ha creado la radicación $nr", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $call, "rad", $id);

			if ($fecha_vencimiento > date("Y-m-d")) {

				$objecte->InsertEvents_gestion($u->GetUser_id(), $id, $fecha_vencimiento, "Vencimiento de un Expediente", "Se programó vencimiento del expediente para el día ".$fecha_vencimiento, date("Y-m-d"), 1, date("H:i:s"), 0, 3, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $call, "vexp", $id);

			}

			$aertasau = $con->Query("Select * from dependencias_alertas where id_dependencia = '".$tipo_documento."' and automatica = 'SI'");

			while ($rowau = $con->FetchAssoc($aertasau)) {

				$alerta = $rowau['id'];

				$gestion = $id;

				$depa = new MDependencias_alertas;

				$depa->CreateDependencias_alertas("id", $alerta);

				$fecha = date("Y-m-d");

				$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.

				date_modify($fecha_c, $depa->GetDias_alerta()." day");//sumas los dias que te hacen falta.

				$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

				$eventoe = new MEvents_gestion;

			#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA

				$create = $eventoe->InsertEvents_gestion($u->GetUser_id(), $gestion, $fecha_a, $depa->GetNombre(), $depa->GetDescripcion(), date("Y-m-d"), 0, date("H:i:s"), 0, $depa->GetDias_antes(), 0, $fecha_a, $alerta, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), "*", 'ev', $gestion);

			}

			$MUsuarios2 = new MUsuarios;

	    	$MUsuarios2->CreateUsuarios("user_id", $u->GetUser_id());

	    	$username2 = $MUsuarios2->GetP_nombre()." ".$MUsuarios2->GetP_apellido();

	    	$from = $MUsuarios2->GetEmail();

	    	$g = new MGestion;

			$g->CreateGestion("id", $id);

			$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetDependencia_destino(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ")."";

			$NUMRADICACION = "<a href='".HOMEDIR."/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetNum_oficio_respuesta()."</small>)</a>";

			$MUsuarios = new MUsuarios;

	    	$MUsuarios->CreateUsuarios("a_i", $u->GetA_i());

    		$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();


    		$link = HOMEDIR.DS."s/".$g->GetUri()."/";


			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', '10');
			$contenido_email = $MPlantillas_email->GetContenido();
			$contenido_email = str_replace("[elemento]responsable[/elemento]",      $username,     $contenido_email );
			$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $username2,    $contenido_email );
			$contenido_email = str_replace("[elemento]rad_completo[/elemento]",      $minr,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
			$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",      $s->GetNombre(),   $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );
			$contenido_email = str_replace("[elemento]rad_rapido[/elemento]",      $minr,   $contenido_email );
			$contenido_email = str_replace("[elemento]URI[/elemento]",      $g->GetUri(),   $contenido_email );
			$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Se le ha compartido el expediente ".$nr,$contenido_email,$MUsuarios->GetEmail());

			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', '9');
			$contenido_email = $MPlantillas_email->GetContenido();
			$contenido_email = str_replace("[elemento]responsable[/elemento]",      $username,     $contenido_email );
			$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $username2,    $contenido_email );
			$contenido_email = str_replace("[elemento]rad_completo[/elemento]",      $minr,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
			$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",      $s->GetNombre(),   $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );
			$contenido_email = str_replace("[elemento]rad_rapido[/elemento]",      $minr,   $contenido_email );
			$contenido_email = str_replace("[elemento]URI[/elemento]",      "<a href='".$link."' target='_blank'>".$link."</a>",  $contenido_email );
			$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Confirmacion de Radicacion de Expediente".$nr,$contenido_email,$sd->GetEmail());


			$con->Query("update meta_big_data set type_id = '".$g->GetId()."', fecha_registro = '".date("Y-m-d")."' where grupo_id = '".$_SESSION['smallid']."'");
			$con->Query("update gestion_anexos set gestion_id = '".$g->GetId()."', is_publico = '1' where id_servicio = '".$_SESSION['smallid']."' and ip = '".$_SERVER['REMOTE_ADDR']."'");

			$oname = UPLOADS.DS.$_SESSION['smallid'].DS;  
			$nname = UPLOADS.DS.$g->GetId().DS; 

			$f->copia($oname, $nname);
			echo "Espere un momento...";
			$_SESSION['smallid'] = "";
			unset($_SESSION['smallid']);

			echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/"</script>';
		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)

		function Editar($constrain, $fields, $updates, $output, $id){

			$cambioarchivo = "false";
			$object = new MGestion;
			$object->CreateGestion("id", $id);

			$estado_a = $object->GetEstado_archivo();

			if ($estado_a != "1") {
				if ($estado_a == "2" && $_SESSION['archivo_central'] == "1") {
					$cambioarchivo = "true";
				}elseif ($estado_a <= 0 && $_SESSION['archivo_historico'] == "1") {
					$cambioarchivo = "true";
				}else{
					$cambioarchivo = "false";
				}
			}

			#echo $cambioarchivo;

			if ($_SESSION['mayedit'] == "1" || "true" == $cambioarchivo) {

				global $con;

				global $c;


				$path = "";

	    		$change = false;

	    		$changeuser = false;

				$radicado 			= $c->sql_quote($_REQUEST['radicado']);

				$suscriptor_id 		= $c->sql_quote($_REQUEST['suscriptor_id']);

				$nombre_destino 	= $c->sql_quote($_REQUEST['nombre_destino']);

				$f_recibido			= $c->sql_quote($_REQUEST['fecha_recibido']);

				$fecha_vencimiento 	= $c->sql_quote($_REQUEST['fecha_vencimiento']);

				$estado_respuesta 	= $c->sql_quote($_REQUEST['estado_respuesta']);

				$fecha_respuesta	= $c->sql_quote($_REQUEST['fecha_respuesta']);

				$prioridad 			= $c->sql_quote($_REQUEST['prioridad']);

				$observacion 		= $c->sql_quote($_REQUEST['observacion']);

				$observacion2 		= $c->sql_quote($_REQUEST['observacion2']);

				$estado_archivo		= $c->sql_quote($_REQUEST['estado_archivo']);

				$estado_solicitud	= $c->sql_quote($_REQUEST['estado_solicitud']);

				$departamento		= $c->sql_quote($_REQUEST['departamento']);

				$ciudad				= $c->sql_quote($_REQUEST['ciudad']);

				$oficina			= $c->sql_quote($_REQUEST['oficina']);

				$dependencia_destino= $c->sql_quote($_REQUEST['dependencia_destino']);

				$nombre_destino		= $c->sql_quote($_REQUEST['nombre_destino']);

				$tipo_documento 	= $c->sql_quote($_REQUEST['tipo_documento']);

				$id_dependencia_raiz= $c->sql_quote($_REQUEST['id_dependencia_raiz']);

				$documento_salida= $c->sql_quote($_REQUEST['documento_salida']);

				$estado_personalizado= $c->sql_quote($_REQUEST['estado_personalizado']);

				$prioridades = array( "0" => "Baja", "1" => "Media", "2" => "Alta");



				if($object->GetEstado_personalizado() != $estado_personalizado){
					if ($object->GetEstado_personalizado() != "0") {
						$estadoxa = $c->GetDataFromTable("estados_gestion", "id", $object->GetEstado_personalizado(), "nombre", "");
					}

	    			$estadoxb = $c->GetDataFromTable("estados_gestion", "id", $estado_personalizado, "nombre", "");

	    			$path .= "<li>Se edito el campo EStado Personalizado de '".$estadoxa."' por '".$estadoxb."' </li>";

	    			$change = true;

	    		}

				if($object->GetDocumento_salida() != $documento_salida){

					$ARR = array('N' => "Entrada",'S' => "Salida",'C' => "Comunicaciones Internas");

	    			$path .= "<li>Se edito el campo Documento de '".$ARR[$object->GetDocumento_salida()]."' por '".$ARR[$documento_salida]."' </li>";

	    			$change = true;

	    		}

	    		if($object->GetRadicado() != $radicado){

	    			$path .= "<li>Se edito el campo Radicado Externo de '".$object->GetRadicado()."' por '$radicado' </li>";

	    			$change = true;

	    		}

	    		if($object->GetSuscriptor_id() != $suscriptor_id){

	    			$suscriptora = $c->GetDataFromTable("suscriptores_contactos", "id", $object->GetSuscriptor_id(), "nombre, type", " (").")";

	    			$suscriptorb = $c->GetDataFromTable("suscriptores_contactos", "id", $suscriptor_id, "nombre, type", " (").")";

	    			$path .= "<li>Se edito el campo Suscriptor de '".$suscriptora."' por '".$suscriptorb."' </li>";

	    			$change = true;

	    		}

	    		if($object->GetEstado_solicitud() != $estado_solicitud){

	    			$estadoa = $c->GetDataFromTable("gestion_estados", "id", $object->GetEstado_solicitud(), "nombre", "");

	    			$estadob = $c->GetDataFromTable("gestion_estados", "id", $estado_solicitud, "nombre", "");

	    			$path .= "<li>Se edito el campo Estado del Expediente de '".$estadoa."' por '".$estadob."' </li>";

	    			$change = true;

	    		}

	    		if($object->GetNombre_destino() != $nombre_destino && $nombre_destino != ""){

					$responsablea = $c->GetDataFromTable("usuarios", "a_i", $object->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

					$responsableb = $c->GetDataFromTable("usuarios", "a_i", $nombre_destino, "p_nombre, p_apellido", $separador = " ");

	    			$path .= "<li>Se Inició un Proceso de transferencia del usuario  '".$responsablea."' hacia el usuario '".$responsableb."' </li>";

	    			$change = true;

			    	$ordenq  = $con->Query("select count(*) as max from gestion_transferencias WHERE gestion_id = '".$id."' and estado = '0'");
					$orden = $con->Result($ordenq, 0, "max");	

					if ($orden == "0") {
		    			$mtransferencia = new MGestion_transferencias;
		    			$mtransferencia->InsertGestion_transferencias($object->GetId(), $_SESSION['usuario'], $nombre_destino, date("Y-m-d H:i:s"), "", "", "", "0");

		    			$con->Query("UPDATE gestion SET transferencia = '1' where id = '".$object->GetId()."'");

						$objecte = new MEvents_gestion;
						$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Nuevo Expediente Asignado: ".$object->GetNum_oficio_respuesta(), "El usuario $responsablea le acaba de asignar un expediente debe aceptarlo o rechazarlo", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $nombre_destino, "trexp", $object->GetId());

					}else{

						$nosend = true;
						
					}


	    		}

	    		if($object->GetTipo_documento() != $tipo_documento){

					$subseriea = $c->GetDataFromTable("dependencias", "id", $object->GetTipo_documento(), "nombre", $separador = " ");

					$subserieb = $c->GetDataFromTable("dependencias", "id", $tipo_documento, "nombre", $separador = " ");

	    			$path .= "<li>Se edito el campo Sub Serie de '".$subseriea."' por '$subserieb' </li>";

	    			$change = true;

	    		}

	    		if($object->GetId_dependencia_raiz() != $id_dependencia_raiz){

	    			$seriea = $c->GetDataFromTable("dependencias", "id", $object->GetId_dependencia_raiz(), "nombre", $separador = " ");

	    			$serieb = $c->GetDataFromTable("dependencias", "id", $id_dependencia_raiz, "nombre", $separador = " ");

	    			$path .= "<li>Se edito el campo Serie de '".$seriea."' por '$serieb' </li>";

	    			$change = true;

	    		}

	    		if($object->GetFecha_vencimiento() != $fecha_vencimiento){

	    			$path .= "<li>Se edito el campo Fecha de Vencimiento de '".$object->GetFecha_vencimiento()."' por '$fecha_vencimiento' </li>";

	    			$change = true;

	    		}

	    		if($object->GetF_recibido() != $f_recibido){

	    			$path .= "<li>Se edito el campo Fecha de Apertura de '".$object->GetF_recibido()."' por '$f_recibido' </li>";

	    			$change = true;

	    		}

	    		if($object->GetEstado_respuesta() != $estado_respuesta){

	    			$path .= "<li>Se edito el campo Estado de '".$object->GetEstado_respuesta()."' por '$estado_respuesta' </li>";

	    			$change = true;

	    			if($estado_respuesta == 'SI'){

	    				$con->Query("UPDATE alertas set status = '2' where id_gestion = '".$object->GetId()."'");

						$con->Query("UPDATE events_gestion set status = '2' where gestion_id = '".$object->GetId()."'");

						$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '0'");

						$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '1' and status = '2'");

	    			}

	    		}

	    		if($object->Getfecha_respuesta() != $fecha_respuesta){

	    			$path .= "<li>Se edito el campo Fecha de Cierre de '".$object->Getfecha_respuesta()."' por '$fecha_respuesta' </li>";

	    			$change = true;

	    		}

	    		if($object->GetPrioridad() != $prioridad){

	    			$path .= "<li>Se edito el campo prioridad del expediente de '".$prioridades[$object->GetPrioridad()]."' por '".$prioridades[$prioridad]."' </li>";

	    			$change = true;

	    		}

	    		if($object->GetObservacion() != $observacion){

	    			$path .= "<li>Se edito el campo Título del Expediente de '".$object->GetObservacion()."' por '$observacion' </li>";

	    			$change = true;

	    		}

	    		if($object->GetObservacion2() != $observacion2){

	    			$path .= "<li>Se edito el campo Observacion de '".$object->GetObservacion2()."' por '$observacion2' </li>";

	    			$change = true;

	    		}

	    		if($object->GetEstado_archivo() != $estado_archivo){

	    			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");

	    			$path .= "<li>Se edito el campo archivo de '".$ar2[$object->GetEstado_archivo()]."' por '".$ar2[$estado_archivo]."' </li>";

	    			$change = true;

	    			$con->Query("UPDATE alertas set status = '2' where id_gestion = '".$object->GetId()."'");

					$con->Query("UPDATE events_gestion set status = '2' where gestion_id = '".$object->GetId()."'");

					$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '0'");

					$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '1' and status = '2'");

	    		}
/*
				

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

*/
				if($change){

					$objecte = new MEvents_gestion;

					$create = $object->UpdateGestion($constrain, $fields, $updates, $output);

					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

					/*

						InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

					*/

					$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Editado", "Se ha editado la informacion del Expediente  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eexp", $object->GetId());

				}

				if ($changeuser) {

					$objecte = new MEvents_gestion;

					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

					/*

						InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

					*/

					$us = new MUsuarios;

					$us->CreateUsuarios("a_i", $_REQUEST['nombre_destino']);

					$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Transferido", "El Expediente ha sido transferndo al usuario ".$us->GetP_nombre()." ".$us->GetP_apellido(), date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $us->GetA_i(), "texp", $us->GetA_i());

				}

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
				if (!$nosend) {
					echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/"</script>';
				}else{
					echo "0";
				}

			}else{

				echo 'error';

			}

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS

		function VistaVerAnexosMovil($min_rad){

			global $con;

			$folder = ($folder == "")?'0':$folder;

			$_SESSION["folder_exp"] = $folder;

			$ge = new MGestion;

			$ge->CreateGestion("min_rad", $min_rad);

			$dep = new MDependencias;

			$dep->CreateDependencias("id", $ge->GetTipo_documento());

			$id =  $ge->GetId();

			include_once(VIEWS.DS."gestion/gestion_anexos_movil.php");

		}

		function GetAnexos($id, $folder = "0", $pag = "1" ){

			global $con;

			$folder = ($folder == "")?'0':$folder;

			$_SESSION["folder_exp"] = $folder;

			$ge = new MGestion;

			$ge->CreateGestion("id", $id);

			$dep = new MDependencias;

			$dep->CreateDependencias("id", $ge->GetTipo_documento());

			if ($_SESSION['suscriptor_id'] == "") {
				include_once(VIEWS.DS."gestion/gestion_anexos.php");
			}else{
				include_once(VIEWS.DS."gestion/gestion_anexosPublico.php");
			}

		}

		function GetDocumentos($id){

			global $con;

            $ang = new MDocumentos_gestion;

            $query = $ang->ListarDocumentos_gestion("WHERE gestion_id = '".$id."'");

			include_once(VIEWS.DS.'documentos_gestion/Listar.php');

		}

		function GetFormularios($id_gestion, $id_dependencia){

			global $con;

			global $c;

			$object = new MRef_tables;

			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id_dependencia);

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarRef_tables(" WHERE dependencia_id = '".$id_dependencia."'");

			include_once(VIEWS.DS.'big_data/FormInsertBig_data.php');

			$bg = new MBig_data;

			$query = $bg->ListarBig_data(" WHERE proceso_id = '".$id_gestion."'");

			include_once(VIEWS.DS.'big_data/Listar.php');

		}

		function GetAlertas($id_gestion, $id_dependencia){

#			echo "Mostrando Funcion: GetAlertas Para: {G: $id_gestion - D: $id_dependencia}";

			global $con;

			$object = new MDependencias_alertas;

			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id_dependencia);

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarDependencias_alertas(" WHERE id_dependencia = '".$id_dependencia."'");

			#include_once(VIEWS.DS.'gestion/Listado_Alertas.php');

			$object = new MGestion;

			$object->CreateGestion("id", $id_gestion);

			include(VIEWS.DS."events_gestion/FormInsertEvents_gestion.php");


			$ev = new MEvents_gestion;

			$query = $ev->ListarEvents_gestion(" WHERE gestion_id = '".$object->GetId()."' and grupo = '".$_SESSION['user_ai']."' and type_event = '1' ", "order by fecha desc, time desc");

			include(VIEWS.DS."events_gestion/MyListar.php");

		}

		function GetSuscriptores($id_gestion){

			global $con;

			$g = new MGestion;

			$g->CreateGestion("id", $id_gestion);

			$object = new MGestion_suscriptores;

			$query = $object->ListarGestion_suscriptores("WHERE id_gestion = '".$id_gestion."'");

			if ($_SESSION['mayedit'] == "1") {

				include_once(VIEWS.DS.'gestion_suscriptores/FormInsertGestion_suscriptores.php');

			}

			include_once(VIEWS.DS.'gestion_suscriptores/Listar.php');

		}

		function GetActuaciones($id, $pag = "1", $fi = '2000-01-01', $ff = '2054-12-31', $type="0", $filter=""){

			global $con;

			$RegistrosAMostrar = 10;

			if(isset($pag)){

				$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;

				$PagAct=$pag;

			}else{

				$RegistrosAEmpezar=0;

				$PagAct=1;

			}

			if ($fi == "") {
				$fi = '2000-01-01';
			}
			if ($ff == "") {
				$ff = '2099-12-31';
			}

			$pathtype = "";
			switch ($type) {
				case '0':
					$pathtype = "";
					break;
				case '1':
					$pathtype = " and es_publico = '1'";
					break;
				case '2':
					$pathtype = " and es_publico = '0'";
					break;
				
				default:
					$pathtype = "";
					break;
			}

			$pathfilter = "";

			if($filter == "on"){
				$pathfilter = " and status = '1'";
			}

			$object = new MGestion;

			$object->CreateGestion("id", $id);

			$ev = new MEvents_gestion;

			$query = $ev->ListarEvents_gestion(" WHERE gestion_id = '".$object->GetId()."' and fecha between '$fi' and '$ff' $pathtype $pathfilter ", "order by fecha desc, time desc", "limit $RegistrosAEmpezar, $RegistrosAMostrar");

			include(VIEWS.DS."events_gestion/Listar.php");

		}

		function GetShared($id){
			global $con;

			$g = new MGestion;

			$g->CreateGestion("id", $id);

			$object = new MGestion_compartir;

			$query = $object->ListarGestion_compartir("WHERE gestion_id = '".$id."'");

			if ($_SESSION['mayedit'] == "1") {

				include_once(VIEWS.DS.'gestion_compartir/FormInsertGestion_compartir.php');

			}
/*
			echo "hola";

			include_once(VIEWS.DS.'gestion_compartir/Listar.php');
*/
		}

		function GetAnexos2($id, $folder = "0", $pag = "1" ){

			global $con;

			$RegistrosAMostrar = 20;

			if(isset($pag)){

				$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;

				$PagAct=$pag;

			}else{

				$RegistrosAEmpezar=0;

				$PagAct=1;

			}

	      	$viewer =       array(".doc" => "google", "docx" => "google", ".zip" => "google", ".rar" => "google",
                          ".tar" => "google", ".xls" => "google", "xlsx" => "google", ".ppt" => "google",
                          ".pps" => "google", "pptx" => "google", "ppsx" => "google", ".pdf" => "google",
                          ".txt" => "google", ".jpg" => "image" , "jpeg" => "image" , ".bmp" => "image" ,
                          ".gif" => "image" , ".png" => "image" , ".dib" => "image" , ".tif" => "image" ,
                          "tiff" => "image" , "mpeg" => "video" , ".avi" => "video" , ".mp4" => "video" ,
                          "midi" => "audio" , ".acc" => "audio" , ".wma" => "audio" , ".ogg" => "audio" ,
                          ".mp3" => "audio" , ".flv" => "video" , ".wmv" => "video", ".csv" => "google",
                          ".DOC" => "google", "DOCX" => "google", ".ZIP" => "google", ".RAR" => "google",
                          ".TAR" => "google", ".XLS" => "google", "XLSX" => "google", ".PPT" => "google",
                          ".PPS" => "google", "PPTX" => "google", "PPSX" => "google", ".PDF" => "google",
                          ".TXT" => "google", ".JPG" => "image" , "JPEG" => "image" , ".BMP" => "image" ,
                          ".GIF" => "image" , ".PNG" => "image" , ".DIV" => "image" , ".TIF" => "image" ,
                          "TIFF" => "image" , "MPEG" => "video" , ".AVI" => "video" , ".MP4" => "video" ,
                          "MIDI" => "audio" , ".ACC" => "audio" , ".WMA" => "audio" , ".OGG" => "audio" ,
                          ".MP3" => "audio" , ".FLV" => "video" , ".WMV" => "video", ".CSV" => "google",

                          ".xml" => "google");

        	$ang = new MGestion_anexos;

        	$fol = new MGestion_folder;

        	if ($_SESSION['suscriptor_id'] == "") {

        		$query = $ang->ListarGestion_anexos("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and estado = '1'", "", "limit $RegistrosAEmpezar, $RegistrosAMostrar");

        		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and estado = '1'");

        	}else{

        		$query = $ang->ListarGestion_anexos("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and estado = '1' and is_publico = '1'", "", "limit $RegistrosAEmpezar, $RegistrosAMostrar");

        		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and tipo= '1' and estado = '1'");

        	}

			$fol->CreateGestion_folder("id", $folder);

			echo '<div id="menu_files" class="boton fa fa-bars">

                        <div id="bars-menu" class="bars-menu scrollable">

                            <div class="list-group" id="panelContent2">';

			if ($folder != "0") {

				$typefol = ($fol->GetTipo() == "1")?"folder":"folder_private";

				$subname = substr($fol->GetNombre(), 0, 30);

				echo "

                        <a href='#' class='list-group-item' onclick='showqanexos(\"/gestion/GetAnexos2/".$id."/".$fol->GetFolder_id()."/1/\", \"cargador_box_upfiles_menu\")' >

                            <div class='nom_anexo' title='Regresar a la Carpeta Anterior'>Regresar a la Carpeta Anterior</div>

                        </a>

						<a href='#' class='list-group-item'>

                            <div class='nom_anexo' title='Carpeta Actual: ".$fol->GetNombre()."'><b>Carpeta Actual: ".$subname."</b></div>

                        </a>

                     ";

			}

			while($rfolder = $con->FetchAssoc($queryf)){

				$typefol = ($rfolder["tipo"] == "1")?"folder":"folder_private";

				$subname = substr($fol->GetNombre(), 0, 35);

                echo "  <a href='#' class='list-group-item' onclick='showqanexos(\"/gestion/GetAnexos2/".$id."/".$rfolder['id']."/1/\", \"cargador_box_upfiles_menu\")' >

                            <div class='nom_anexo' title='$rfolder[nombre]'>$subname</div>

                        </a>";

			}

            while ($col=$con->FetchAssoc($query)) {

                $type=explode('.', strtolower($col[url]));

                $type=array_pop($type);

                $file = $col["url"];

                $subname = substr($col[nombre], 0, 35);

                if ($file != "") {

	                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";

	                $cadena_nombre = substr($file,0,200);

	                $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));

	                if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {

	                    if ($_SESSION['folder'] == '') {

	                        $path = "onclick='changetext(this)'";

	                    }

	                }

	                $tipo = new MDependencias_tipologias;

					$tipo->CreateDependencias_Tipologias("id", $col['tipologia']);

					if ($tipo->GetTipologia() != "") {

						$tipologia = $tipo->GetTipologia();

					}else{

						$tipologia = "-";

					}

	                echo "  <a href='#' class='list-group-item' id='$col[id]' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>

	                            <div class='nom_anexo' title='$col[nombre]'>$subname</div>

	                        </a>";

                }else{

                	echo "  <a href='#' class='list-group-item' id='ppic$col[id]'>

	                            <div class='nom_anexo' title='$col[nombre]'>$subname</div>

	                        </a>";

                }

            }	

	        	if ($_SESSION['suscriptor_id'] == "") {

                $querypag="SELECT count(*) as t from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '".$folder."'";

        	}else{

        		$querypag="SELECT count(*) as t from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and is_publico = '1'";

        	}

            echo '<div class="list-group-item active">';

                $NroRegistros = $con->Result($con->Query($querypag), 0, 't');

                if($NroRegistros == 0){

                echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';

                }

                $PagAnt=$PagAct-1;

                $PagSig=$PagAct+1;

                $PagUlt=$NroRegistros/$RegistrosAMostrar;

                $Res=$NroRegistros%$RegistrosAMostrar;

                if($Res>0) $PagUlt=floor($PagUlt)+1;

#  ;

                echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos2(\"/gestion/GetAnexos2/".$id."/".$folder."/1/\")' >Pagina 1</a> ";

                if($PagAct>1)

                echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos2(\"/gestion/GetAnexos2/".$id."/".$folder."/".$PagAnt."/\")'>Pagina Anterior.</a> ";

                echo "<a class='pag darker' href='#'>Pagina ".$PagAct." de ".$PagUlt."</a>";

                if($PagAct<$PagUlt)

                echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos2(\"/gestion/GetAnexos2/".$id."/".$folder."/".$PagSig."/\")'>Pagina Siguiente.</a> ";

                echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos2(\"/gestion/GetAnexos2/".$id."/".$folder."/".$PagUlt."/\")'>Pagina. $PagUlt</a>";

            echo '</div>';

			echo '          </div>

                        </div>

                    </div>';

		}

		function GetReparto($fi, $ff, $p1){

			global $con;
			global $c;
			global $f;
			// CARGA EL TEMPLATE			
	 		$pagina = $this->TemplateAmplelimpia('Reparto Dinamico');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();	

			echo "<div class='row' style='background-color:#FFF; padding:0px 30px'>";
			include_once(VIEWS.DS.'gestion/reparto.php');
			echo "</div>";

			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);

			

		}

		function GetDatosGestion($id){

			global $con;

			$g = new MGestion;

			$g->CreateGestion("id", $id);

			$Suscriptor_id = $g->GetSuscriptor_id();

			$Nombre_destino = $g->GetNombre_destino();

			$Fecha_vencimiento = $g->GetFecha_vencimiento();

			$Estado_respuesta = $g->GetEstado_respuesta();

			$Prioridad = $g->GetPrioridad();

			$Dependencia_raiz = $g->GetId_dependencia_raiz();

			$Tipo_documento = $g->GetTipo_documento();

			$Observacion = $g->GetObservacion();

			$Estado_archivo = $g->GetEstado_archivo();

			$radicado = $g->GetRadicado();

			$estado_solicitud = $g->GetEstado_solicitud();

			$fecha_recibido = $g->GetF_recibido();

			$ciudad = $g->GetCiudad();

			$oficina = $g->GetOficina();

			$dependencia_destino = $g->GetDependencia_destino();

			$fecha_respuesta = $g->GetFecha_respuesta();

			#echo $Suscriptor_id."@|@".$Nombre_destino."@|@".$Fecha_vencimiento."@|@".$Estado_respuesta."@|@".$Prioridad."@|@".$Dependencia_raiz."@|@".$Tipo_documento."@|@".$Observacion."@|@".$Estado_archivo;

			echo json_encode(array('suscriptor_id' => $Suscriptor_id, 'nombre_destino' => $Nombre_destino, 'fecha_vencimiento' => $Fecha_vencimiento, 'estado_respuesta' => $Estado_respuesta, 'prioridad' => $Prioridad, 'dependencia_raiz' => $Dependencia_raiz, 'tipo_documento' => $Tipo_documento, 'observacion' => $Observacion, 'estado_archivo' => $Estado_archivo, 'radicado' => $radicado, 'estado_solicitud' => $estado_solicitud, 'fecha_recibido' => $fecha_recibido, 'ciudad' => $ciudad, 'oficina' => $oficina, 'dependencia_destino' => $dependencia_destino, 'fecha_respuesta' => $fecha_respuesta));

		}

		function GetInventario($id, $cn = ""){

			global $con;
			global $c;
			global $f;

			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template_limpia('Listar Suscriptores_modulos');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			$g = new MGestion;
			if ($cn == "") {
				$g->CreateGestion("id", $id);
			}else{
				$g->CreateGestion("num_oficio_respuesta", $id);
			}
			include_once(VIEWS.DS.'gestion/inventario.php');
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

		function GetInventario2(){

			include_once(VIEWS.DS.'gestion/inventario2.php');

		}

		function GetId_c($x){

			global $con;

			echo trim($con->Result($con->Query("select id_c from dependencias where id = '$x'"), 0, 'id_c'));

		}

		function GetId_a($x){

			global $con;

			echo trim($con->Result($con->Query("select prefijo from areas where id = '$x'"), 0, 'prefijo'));

		}

		function PrintPage($id){

			global $con;

			global $c;

			global $f;

			$object = new MGestion;

			$object->CreateGestion("id", $id);

			include_once(VIEWS.DS.'gestion/printable.php');

		}

		function PrintDocument($id){

			global $con;

			global $c;

			global $f;

			$ga = new MGestion_anexos;
			$ga->CreateGestion_anexos("id", $id);

			$object = new MGestion;

			$object->CreateGestion("id", $ga->GetGestion_id());

			include_once(VIEWS.DS.'gestion_anexos/printable.php');

		}



		function GetElectronica($id){

			global $con;

			global $c;

			global $f;

			$object = new MGestion;

			$object->CreateGestion("id", $id);

			include_once(VIEWS.DS.'mailer_message/miniview.php');

		}

		function GetMailbox($id){

			global $con;

			global $c;

			global $f;

			$object = new MGestion;

			$object->CreateGestion("id", $id);

			include_once(VIEWS.DS.'notificaciones/miniview.php');

		}

		function GetMyfiles($pag){

			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

			$pagina = $this->load_template(PROJECTNAME.ST." Expedientes compartidos");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			$g = new MGestion_compartir;
			$qn = $con->Query("SELECT count(*) as t FROM gestion where (usuario_registra = '".$_SESSION['usuario']."' or nombre_destino = '".$_SESSION['user_ai']."') and dependencia_destino = '".$_SESSION['area_principal']."' and oficina = '".$_SESSION['seccional']."' and version = '".$_SESSION['active_vista']."' and estado_archivo = '".$_SESSION['typefolder']."' ");
			
			include_once(VIEWS.DS.'gestion/FiltroGestion.php');
			include_once(VIEWS.DS.'gestion/listar_expedientes.php');

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.

			$table = ob_get_clean();

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA

			$this->view_page($pagina);

		}

		function GetInteraccionSuscriptores(){

			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

			$pagina = $this->load_template(PROJECTNAME.ST." Expedientes compartidos");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$usua = new MUsuarios;

		    $usua->CreateUsuarios("user_id", $_SESSION['usuario']);

			$g = new MGestion_compartir;

			$qn = $g->ListarGestion_compartir(" where dependencia_destino = '".$usua->GetRegimen()."' and estado_archivo = '".$_SESSION['typefolder']."'");

			$viewer =       array(".doc" => "google", "docx" => "google", ".zip" => "google", ".rar" => "google",
                          ".tar" => "google", ".xls" => "google", "xlsx" => "google", ".ppt" => "google",
                          ".pps" => "google", "pptx" => "google", "ppsx" => "google", ".pdf" => "google",
                          ".txt" => "google", ".jpg" => "image" , "jpeg" => "image" , ".bmp" => "image" ,
                          ".gif" => "image" , ".png" => "image" , ".dib" => "image" , ".tif" => "image" ,
                          "tiff" => "image" , "mpeg" => "video" , ".avi" => "video" , ".mp4" => "video" ,
                          "midi" => "audio" , ".acc" => "audio" , ".wma" => "audio" , ".ogg" => "audio" ,
                          ".mp3" => "audio" , ".flv" => "video" , ".wmv" => "video", ".csv" => "google",
                          ".DOC" => "google", "DOCX" => "google", ".ZIP" => "google", ".RAR" => "google",
                          ".TAR" => "google", ".XLS" => "google", "XLSX" => "google", ".PPT" => "google",
                          ".PPS" => "google", "PPTX" => "google", "PPSX" => "google", ".PDF" => "google",
                          ".TXT" => "google", ".JPG" => "image" , "JPEG" => "image" , ".BMP" => "image" ,
                          ".GIF" => "image" , ".PNG" => "image" , ".DIV" => "image" , ".TIF" => "image" ,
                          "TIFF" => "image" , "MPEG" => "video" , ".AVI" => "video" , ".MP4" => "video" ,
                          "MIDI" => "audio" , ".ACC" => "audio" , ".WMA" => "audio" , ".OGG" => "audio" ,
                          ".MP3" => "audio" , ".FLV" => "video" , ".WMV" => "video", ".CSV" => "google",

                          ".xml" => "google");

			if($c->sql_quote($_REQUEST['cn']) == ''){

				$fecha_i=date('Y-m-d');

			}else{

				$fecha_i=$c->sql_quote($_REQUEST['cn']);

			}

			if($c->sql_quote($_REQUEST['p1']) == ''){

				$fecha_f=date('Y-m-d');

			}else{

				$fecha_f=$c->sql_quote($_REQUEST['p1']);

			}

			include_once(VIEWS.DS.'gestion/listar_interaccion_suscriptores.php');

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.

			$table = ob_get_clean();

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA

			$this->view_page($pagina);

		}

		function GetFolders(){

			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

			$pagina = $this->load_template(PROJECTNAME.ST." Expedientes compartidos");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$usua = new MUsuarios;

		    $usua->CreateUsuarios("user_id", $_SESSION['usuario']);

			$g = new MGestion_compartir;

			$qn = $g->ListarGestion_compartir(" where dependencia_destino = '".$usua->GetRegimen()."' and estado_archivo = '".$_SESSION['typefolder']."'");

			$viewer =       array(".doc" => "google", "docx" => "google", ".zip" => "google", ".rar" => "google",
                          ".tar" => "google", ".xls" => "google", "xlsx" => "google", ".ppt" => "google",
                          ".pps" => "google", "pptx" => "google", "ppsx" => "google", ".pdf" => "google",
                          ".txt" => "google", ".jpg" => "image" , "jpeg" => "image" , ".bmp" => "image" ,
                          ".gif" => "image" , ".png" => "image" , ".dib" => "image" , ".tif" => "image" ,
                          "tiff" => "image" , "mpeg" => "video" , ".avi" => "video" , ".mp4" => "video" ,
                          "midi" => "audio" , ".acc" => "audio" , ".wma" => "audio" , ".ogg" => "audio" ,
                          ".mp3" => "audio" , ".flv" => "video" , ".wmv" => "video", ".csv" => "google",
                          ".DOC" => "google", "DOCX" => "google", ".ZIP" => "google", ".RAR" => "google",
                          ".TAR" => "google", ".XLS" => "google", "XLSX" => "google", ".PPT" => "google",
                          ".PPS" => "google", "PPTX" => "google", "PPSX" => "google", ".PDF" => "google",
                          ".TXT" => "google", ".JPG" => "image" , "JPEG" => "image" , ".BMP" => "image" ,
                          ".GIF" => "image" , ".PNG" => "image" , ".DIV" => "image" , ".TIF" => "image" ,
                          "TIFF" => "image" , "MPEG" => "video" , ".AVI" => "video" , ".MP4" => "video" ,
                          "MIDI" => "audio" , ".ACC" => "audio" , ".WMA" => "audio" , ".OGG" => "audio" ,
                          ".MP3" => "audio" , ".FLV" => "video" , ".WMV" => "video", ".CSV" => "google",

                          ".xml" => "google");

			if($c->sql_quote($_REQUEST['cn']) == ''){

				$fecha_i=date('Y-m-d');

			}else{

				$fecha_i=$c->sql_quote($_REQUEST['cn']);

			}

			if($c->sql_quote($_REQUEST['p1']) == ''){

				$fecha_f=date('Y-m-d');

			}else{

				$fecha_f=$c->sql_quote($_REQUEST['p1']);

			}

			include_once(VIEWS.DS.'gestion/listar_correspondencia.php');

						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.

			$table = ob_get_clean();

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA

			$this->view_page($pagina);

		}

		function GetCargaMasivaCorrespondencia(){

			global $con;

			global $f;

			global $c;

			// CREANDO UN NUEVO MODELO

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

			$pagina = $this->load_template(PROJECTNAME.ST." Expedientes compartidos");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$usua = new MUsuarios;

		    $usua->CreateUsuarios("user_id", $_SESSION['usuario']);

			$g = new MGestion_compartir;

			$qn = $g->ListarGestion_compartir(" where dependencia_destino = '".$usua->GetRegimen()."' and estado_archivo = '".$_SESSION['typefolder']."'");

			$viewer =       array(".doc" => "google", "docx" => "google", ".zip" => "google", ".rar" => "google",
                          ".tar" => "google", ".xls" => "google", "xlsx" => "google", ".ppt" => "google",
                          ".pps" => "google", "pptx" => "google", "ppsx" => "google", ".pdf" => "google",
                          ".txt" => "google", ".jpg" => "image" , "jpeg" => "image" , ".bmp" => "image" ,
                          ".gif" => "image" , ".png" => "image" , ".dib" => "image" , ".tif" => "image" ,
                          "tiff" => "image" , "mpeg" => "video" , ".avi" => "video" , ".mp4" => "video" ,
                          "midi" => "audio" , ".acc" => "audio" , ".wma" => "audio" , ".ogg" => "audio" ,
                          ".mp3" => "audio" , ".flv" => "video" , ".wmv" => "video", ".csv" => "google",
                          ".DOC" => "google", "DOCX" => "google", ".ZIP" => "google", ".RAR" => "google",
                          ".TAR" => "google", ".XLS" => "google", "XLSX" => "google", ".PPT" => "google",
                          ".PPS" => "google", "PPTX" => "google", "PPSX" => "google", ".PDF" => "google",
                          ".TXT" => "google", ".JPG" => "image" , "JPEG" => "image" , ".BMP" => "image" ,
                          ".GIF" => "image" , ".PNG" => "image" , ".DIV" => "image" , ".TIF" => "image" ,
                          "TIFF" => "image" , "MPEG" => "video" , ".AVI" => "video" , ".MP4" => "video" ,
                          "MIDI" => "audio" , ".ACC" => "audio" , ".WMA" => "audio" , ".OGG" => "audio" ,
                          ".MP3" => "audio" , ".FLV" => "video" , ".WMV" => "video", ".CSV" => "google",

                          ".xml" => "google");

			include_once(VIEWS.DS.'gestion/carga_masiva_correspondencia.php');

						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.

			$table = ob_get_clean();

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA

			$this->view_page($pagina);

	}

	function GetCargarArchivoCorrespondencia($id = ""){

		$filename=UPLOADS.DS.'temporal/';

		if (!file_exists($filename)) {

		    mkdir(UPLOADS.DS . 'temporal', 0777);

		}

		$filename=UPLOADS.DS.'temporal/'.$_SESSION['usuario'].'/';

		if (!file_exists($filename)) {

		    mkdir(UPLOADS.DS . 'temporal/'.$_SESSION['usuario'], 0777);

		}

		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

			if(move_uploaded_file($_FILES['upl']['tmp_name'], $filename.$_FILES['upl']['name'])){

				exit;

			}

		}

	}

	function CargarArchivoCorrespondenciaPublico($id = ""){

		$filename=UPLOADS.DS.'temporal/';

		if (!file_exists($filename)) {

		    mkdir(UPLOADS.DS . 'temporal', 0777);

		}

		$filename=UPLOADS.DS.'temporal/'.$_SESSION['suscriptor_id'].'/';

		if (!file_exists($filename)) {

		    mkdir(UPLOADS.DS . 'temporal/'.$_SESSION['suscriptor_id'], 0777);

		}

		if(isset($_FILES['pictures']) && $_FILES['pictures']['error'] == 0){

			if(move_uploaded_file($_FILES['pictures']['tmp_name'], $filename.$_FILES['pictures']['name'])){

				exit;

			}

		}

	}

	function GetCargarArchivoCorrespondenciaProcesarPublico($archivo){
		global $con;
		global $c;
		global $f;

		$olbigatorios = array();
		$slugs = array();
		$tipo_documento = $c->sql_quote($_REQUEST['C_F_docto']);
		$arrext=explode('.',$archivo);
		$ext=end($arrext);

		if($ext != 'xlsx' && $ext != 'xls' ){
			echo "Formato del Archivo Incorrecto!";
			exit;
		}

		$condocs = $con->Query("select id from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1'");
		$idref = $con->FetchAssoc($condocs);

		if ($idref > 0) {

			$checkInsert = $con->Query("select slug from meta_referencias_campos where id_referencia = '".$idref['id']."' and visible = '0' and tipo_elemento not in (13, 14, 15) and es_obligatorio = '1' order by orden");
			while ($row = $con->FetchAssoc($checkInsert)) {
				array_push($slugs, $row['slug']);
			}		
		}else{
			echo "No hay formulario";
			exit;
		}

		$procesados = 0;
		$noprocesados = 0;
		/*procesar archivo*/
		$archivoList = $archivo;
		$path = "";

		if(file_exists($archivoList)){

			$objPHPExcel = PHPExcel_IOFactory::load($archivoList);
			#foreach que leer el archivo de excel.
			$refcol = "";
			$path .= "<ul>";
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){

				$worksheetTitle     = $worksheet->getTitle();
				$highestRow         = $worksheet->getHighestRow();
				$highestColumn      = $worksheet->getHighestColumn();
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
				$total_lineas = $highestRow;

				for ($row = 1; $row <= $total_lineas; ++ $row){

					$k++;
					$arrFilas = array();

					for ($col = 0; $col < $highestColumnIndex; ++ $col){

						$val = "";
						$cell = $worksheet->getCellByColumnAndRow( $col , $row );
						$val = $cell->getValue();
						$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
						#Codigo Supremamente importante para el patron de recocimiento.
						
						if($row == 1 && strlen($val) > 0){
							$arrCabecera[$col] = $val;
						}

						if($row > 1 && strlen($val) > 0){
							$arrFilas[$col] = $val;
						}


						if($row == 1){
							if ($val == "IDENTIFICACION_EMPLEADO") {
								$refcol = $col;
							}else{
								if (in_array($val, $slugs)) {
									array_push($olbigatorios, $col);
								}
							}
							
						}else{

							if ($col == $refcol) {
								$d = $con->Query("select id from suscriptores_contactos where identificacion = '".$val."' and dependencia = '".$_SESSION['suscriptor_id']."'");

								$idx = $con->FetchAssoc($d);
								if ($idx['id'] == "") {
									$path .= "<li>Fila: '$row' Identificación '$val' no está asociado a su cuenta </li>";
								}
								#echo "Verificar: ".$val." en ".$_SESSION['suscriptor_id']."<br>";
							}else{
								if (in_array($col, $olbigatorios)) {
									if ($val == "") {
										$cellhead = $worksheet->getCellByColumnAndRow( $col , "1" );
										$valhead = $cellhead->getValue();
										$path .= "<li>Fila: '$row' Campo '$valhead' es Obligatorio</li>";
									}
								}
							}

						}
					}
				}
			}
			$path .= "</ul>";
		}

		if ($path == "<ul></ul>") {
			$path = "<div class='alert alert-success m-t-20 m-b-30'>Archivo Verificado, Los registros estan correctos!</div>";
		}
		echo $path;
		exit;

	}

	function GetCargarArchivoCorrespondenciaProcesar($id = ""){


		global $con;

		global $f;

		global $c;

		$usua = new MUsuarios;

	    $usua->CreateUsuarios("user_id", $_SESSION['usuario']);

/*		
*/
		$arrext=explode('.',$_FILES['upl']['name']);

		$ext=end($arrext);

		if($ext != 'xlsx' && $ext != 'xls' && $ext != 'PDF' && $ext != 'pdf'){

			echo "error_archivo";

			exit;

		}

		if($ext == 'PDF' || $ext == 'pdf'){

			echo "";

			exit;

		}

		$filename=UPLOADS.DS.'temporal/';

		if (!file_exists($filename)) {

		    mkdir(UPLOADS.DS . 'temporal', 0777);

		}

		$filename=UPLOADS.DS.'temporal/'.$_SESSION['usuario'].'/';

		if (!file_exists($filename)) {

		    mkdir(UPLOADS.DS . 'temporal/'.$_SESSION['usuario'], 0777);

		}

		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

			if(move_uploaded_file($_FILES['upl']['tmp_name'], $filename.$_FILES['upl']['name'])){

				$procesados = 0;

				$noprocesados = 0;

				/*procesar archivo*/

				$archivoList = $filename.$_FILES['upl']['name'];
				$rotfolder = ROOT."/archivos_uploads/gestion/";

				if(file_exists($archivoList))

				{

					$objPHPExcel = PHPExcel_IOFactory::load($archivoList);

					#foreach que leer el archivo de excel.

					foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)

					{

						$worksheetTitle     = $worksheet->getTitle();

						$highestRow         = $worksheet->getHighestRow();

						$highestColumn      = $worksheet->getHighestColumn();

						$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

						$total_lineas = $highestRow;

						for ($row = 1; $row <= $total_lineas; ++ $row)

						{

							$k++;

							$arrFilas = array();

							for ($col = 0; $col < $highestColumnIndex; ++ $col)

							{

								$val = "";

								$cell = $worksheet->getCellByColumnAndRow( $col , $row );

								$val = $cell->getValue();

								$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

								#Codigo Supremamente importante para el patron de recocimiento.

								if($row == 1 && strlen($val) > 0)

								{

									$arrCabecera[$col] = $val;

								}

								if($row > 1 && strlen($val) > 0)

								{

									$arrFilas[$col] = $val;

								}

							}

							if($row == 1)

							{

								if(in_array("NIT_SUSCRIPTOR", $arrCabecera)){$col_NIT_SUSCRIPTOR = array_search("NIT_SUSCRIPTOR", $arrCabecera);}

								if(in_array("NOMBRE_SUSCRIPTOR", $arrCabecera)){$col_NOMBRE_SUSCRIPTOR = array_search("NOMBRE_SUSCRIPTOR", $arrCabecera);}

								if(in_array("TIPO_SUSCRIPTOR", $arrCabecera)){$col_TIPO_SUSCRIPTOR = array_search("TIPO_SUSCRIPTOR", $arrCabecera);}

								if(in_array("DIRECCION_SUSCRIPTOR", $arrCabecera)){$col_DIRECCION_SUSCRIPTOR = array_search("DIRECCION_SUSCRIPTOR", $arrCabecera);}

								if(in_array("TELEFONOS_SUSCRIPTOR", $arrCabecera)){$col_TELEFONOS_SUSCRIPTOR = array_search("TELEFONOS_SUSCRIPTOR", $arrCabecera);}

								if(in_array("EMAIL_SUSCRIPTOR", $arrCabecera)){$col_EMAIL_SUSCRIPTOR = array_search("EMAIL_SUSCRIPTOR", $arrCabecera);}

								if(in_array("RADICADO", $arrCabecera)){$col_RADICADO = array_search("RADICADO", $arrCabecera);}

								if(in_array("DEPENDENCIA_DESTINO", $arrCabecera)){$col_DEPENDENCIA_DESTINO = array_search("DEPENDENCIA_DESTINO", $arrCabecera);}

								if(in_array("OBSERVACION", $arrCabecera)){$col_OBSERVACION = array_search("OBSERVACION", $arrCabecera);}

								if(in_array("ARCHIVO_NOMBRE", $arrCabecera)){$col_ARCHIVO_NOMBRE = array_search("ARCHIVO_NOMBRE", $arrCabecera);}

								if(in_array("RESPONSABLE", $arrCabecera)){$col_RESPONSABLE = array_search("RESPONSABLE", $arrCabecera);}

								if(in_array("ID", $arrCabecera)){$col_ID = array_search("ID", $arrCabecera);}

							}

							if($row > 1)

							{

								$NIT_SUSCRIPTOR = "";

								$NOMBRE_SUSCRIPTOR = "";

								$TIPO_SUSCRIPTOR = "";

								$DIRECCION_SUSCRIPTOR = "";

								$TELEFONOS_SUSCRIPTOR = "";

								$EMAIL_SUSCRIPTOR = "";

								$RADICADO = "";

								$DEPENDENCIA_DESTINO = "";

								$OBSERVACION = "";

								$ARCHIVO_NOMBRE = "";

								$RESPONSABLE = "";

								$ID = "";

								if(isset($col_NIT_SUSCRIPTOR) ){$NIT_SUSCRIPTOR = $c->sql_quote(trim( $arrFilas[$col_NIT_SUSCRIPTOR]));}

								if(isset($col_NOMBRE_SUSCRIPTOR) ){$NOMBRE_SUSCRIPTOR = $c->sql_quote(trim( $arrFilas[$col_NOMBRE_SUSCRIPTOR]));}

								if(isset($col_TIPO_SUSCRIPTOR) ){$TIPO_SUSCRIPTOR = $c->sql_quote(trim( $arrFilas[$col_TIPO_SUSCRIPTOR]));}

								if(isset($col_DIRECCION_SUSCRIPTOR) ){$DIRECCION_SUSCRIPTOR = $c->sql_quote(trim( $arrFilas[$col_DIRECCION_SUSCRIPTOR]));}

								if(isset($col_TELEFONOS_SUSCRIPTOR) ){$TELEFONOS_SUSCRIPTOR = $c->sql_quote(trim( $arrFilas[$col_TELEFONOS_SUSCRIPTOR]));}

								if(isset($col_EMAIL_SUSCRIPTOR) ){$EMAIL_SUSCRIPTOR = $c->sql_quote(trim( $arrFilas[$col_EMAIL_SUSCRIPTOR]));}

								if(isset($col_RADICADO) ){$RADICADO = $c->sql_quote(trim( $arrFilas[$col_RADICADO]));}

								if(isset($col_DEPENDENCIA_DESTINO) ){$DEPENDENCIA_DESTINO = $c->sql_quote(trim( $arrFilas[$col_DEPENDENCIA_DESTINO]));}

								if(isset($col_OBSERVACION) ){$OBSERVACION = $c->sql_quote(trim( $arrFilas[$col_OBSERVACION]));}

								if(isset($col_ARCHIVO_NOMBRE) ){$ARCHIVO_NOMBRE = $c->sql_quote(trim( $arrFilas[$col_ARCHIVO_NOMBRE]));}

								if(isset($col_RESPONSABLE) ){$RESPONSABLE = $c->sql_quote(trim( $arrFilas[$col_RESPONSABLE]));}

								if(isset($col_ID) ){$ID = $c->sql_quote(trim( $arrFilas[$col_ID]));}

								$linkfile = ROOT."/archivos_uploads/gestion/temporal/".$_SESSION['usuario']."/".$ARCHIVO_NOMBRE;

								$data = file_get_contents($linkfile);

								$base64 = base64_encode($data);

						        $array = array(

						        	"cedula" => $RESPONSABLE,

						        	"nit_suscriptor" => $NIT_SUSCRIPTOR,

									"nombre_suscriptor" => $NOMBRE_SUSCRIPTOR,

									"tipo_suscriptor" => $TIPO_SUSCRIPTOR,

									"Direccion_suscriptor" => $DIRECCION_SUSCRIPTOR,

									"Telefonos_suscriptor" => $TELEFONOS_SUSCRIPTOR,

									"Email_suscriptor" => $EMAIL_SUSCRIPTOR,

									"radicado" => $RADICADO,

									"dependencia_destino" => $DEPENDENCIA_DESTINO,

									"observacion" => $OBSERVACION,

									"archivo" => $base64,

									"archivo_nombre" => $ARCHIVO_NOMBRE,

									"como_enviar_expediente" => "PROCESAR"

						        );
						        # FUNCION PARA /*
						        if ($ID != "") {
						        	# code...
						        	echo "Expediente: $ID.<br>";
						        	if (file_exists($rotfolder)) {
										
						        		$MUsuarios = new MUsuarios;
										$MUsuarios->CreateUsuarios("user_id", $RESPONSABLE);
										$dependencia = new MDependencias;
										$dependencia->CreateDependencias("id", $DEPENDENCIA_DESTINO);


										echo $this->rmDir_rf($rotfolder.$ID."/anexos/", $rotfolder.$ID, $ID);
									}

						        	echo "<hr>";
						        }
						        #*/


								/*
						        */
								$cliente = new nusoap_client(HOMEDIR."/ws/GetCrearExpedienteExterno.wsdl", true);

						        $error = $cliente->getError();

						        if ($error) {

						            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

						        }

						        $result = $cliente->call("GetCrearExpedienteExterno", $array);

						        if ($cliente->fault) {

						            $noprocesados++;

						        }else{

						            $error = $cliente->getError();

						            if ($error) {

						                $noprocesados++;

						            }else {

						                $arr = json_decode($result);

						               	if($arr->respuesta == "0"){

						               		$noprocesados++;

						               	}else{

						               		$procesados++;

						               	}

						            }

						        }

							}

						}

					}

				}
/*
*/
			}

		}

		echo "valido_archivo|".$procesados."|".$noprocesados;

		exit;



	}

	function GetVerCodeQR($id){

		global $con;

			global $c;

			global $f;

			include_once(VIEWS.DS.'gestion/vercodeqr.php');

	}

	function GetListadoDocumentosQR($id){

		global $con;

		global $c;

		global $f;

		include_once(VIEWS.DS.'gestion/listadodocumentosqr.php');

	}

	function GetVencimientoExpedientesArchivo($id){

		global $con;

		global $c;

		global $f;

		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

		$pagina = $this->load_template(PROJECTNAME.ST." Expedientes compartidos");

		$dias_vencimiento = 't_g';

		if($id == 2 || $id == 22){

			$dias_vencimiento = 't_c';

		}

		// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

		ob_start();

		include_once(VIEWS.DS.'gestion/vencimientoexpedientesarchivo.php');

		$table = ob_get_clean();

		// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

		// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA

		$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

		// RETORNAME LA PAGINA CARGADA

		$this->view_page($pagina);

	}

	function DoBigData($id, $gid){

		global $con;

		global $f;

		$grupo_id = $id;
		// CREANDO UN NUEVO MODELO

		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

		$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");

		// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

		ob_start();

			$object = new MRef_tables;

			$gestion = new MGestion;

			$gestion->CreateGestion("id", $gid);

			$dep = new MDependencias;

			$dep->CreateDependencias("id", $gestion->GetTipo_documento());

			$mayeditform = true;
			$nooptions = "1";

		// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			$query = $con->Query("select * from meta_big_data where grupo_id = '$grupo_id' limit 0, 1");
			include_once(VIEWS.DS.'big_data/NewFormularioDefault.php');

		// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.

		$table = ob_get_clean();

		// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

		// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA

		$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

		// RETORNAME LA PAGINA CARGADA

		$this->view_page($pagina);

	}

	function VerForm($id, $cn){

		global $con;
		global $f;
		global $c;

		if ($cn == "main") {
			
			$object = new MGestion;
			$object->CreateGestion("id", $id);

			$usua = new MUsuarios;
			$usua->CreateUsuarios('user_id', $_SESSION['usuario']);

			if ($_SESSION['suscriptor_id'] == "") {
				include_once(VIEWS.DS.'gestion/DetalleExpediente.php');
			}else{
				include_once(VIEWS.DS.'gestion/DetallePublicoExpediente.php');
			}

			

		}elseif ($cn == "form") {
			
			$grupo_id = $id;

			$gid = $con->Query("select type_id from meta_big_data where grupo_id = '".$grupo_id."'");
			$bgestion  = $con->FetchAssoc($gid);

			$object = new Mgestion;
			$object->CreateGestion("id", $bgestion['type_id']);

			$mayeditform = false;

			if ($_SESSION['user_ai'] == $object->GetNombre_destino() || $_SESSION['usuario'] == $object->GetUsuario_registra()) {
				$mayeditform = true;
			}else{

				$gc = new MGestion_compartir;
		        $qn = $gc->ListarGestion_compartir(" where usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");
	        	$com = $con->FetchAssoc($qn);
	        	
		        if ($com['type'] >= 1) {
		            $mayeditform = true;
		        }else{
		        	$mayeditform = false;
		        }
			}

			if ($object->GetEstado_archivo() != "1") {
				$mayeditform = false;
			}

	        if ($_SESSION['suscriptor_id'] != "") {
	        	$mayeditform = false;
	        }

	        $vista = "small";
			include_once(VIEWS.DS."meta_big_data/FormUpdateMeta_big_data.php");

		}elseif ($cn == "newform") {
			$object = new MGestion;
			$object->CreateGestion("id", $id);
			include_once(VIEWS.DS."meta_big_data/NewBigDataForm.php");
		}else{
			$object = new MGestion;
			$object->CreateGestion("id", $id);

			include_once(VIEWS.DS.'gestion/DetalleExpediente.php');
		}

		


	}

	function ConsultarFormularioSubSeries($id){
		

		global $con;
		global $f;
		global $c;

		$consulta = $con->Query("Select * from meta_referencias_titulos where id_s = '".$id."' and tipo = '1'");
		while ($row = $con->FetchAssoc($consulta)) {
			echo "<option value='".$row['id']."'>".$row['titulo']."</option>";
		}
	}

	function RegistrarFormulario($id, $form_id){

		global $con;
		global $f;
		global $con;

		$checkInsert = $con->Query("select * from meta_referencias_campos where id_referencia = '".$form_id."'");


		$smallid = $f->GenerarSmallId();

	#	$con->Query("INSERT INTO meta_titulo_big_data (type_id, ref_id, grupo_id, tipo_form, fecha) 
	#									VALUES ('".$id."', '".$form_id."', '".$smallid."', '1', '".date("Y-m-d")."')");

		$i = 0;

		while ($rrrx = $con->FetchAssoc($checkInsert)) {
			$i++;
			$con->Query("INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form, fecha_registro) VALUES ('".$id."', '".$form_id."', '".$rrrx['id']."', '', '".$smallid."', '1', '".date("Y-m-d")."')");

		}

		if ($i == 0) {
			echo "El formulario se encuentra vacío, no se realizará el registro";
		}else{
			echo "Formulario creado correctamente";
		}

	}

	function GetPendientes(){
			global $con;
			global $f;
			global $c;

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");
			ob_start();				

			$myid = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "a_i", $separador = " ");

  			$object = new MGestion;	
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$tipo_d = $con->Query("select id, dependencia from dependencias where es_publico = 1");

	

			$tipo_documento = "";
			$i = 0;
			while ($row = $con->FetchAssoc($tipo_d)) {
				$i++;
				if ($i < $con->NumRows($tipo_d)) {
					$tipo_documento .= $row['id'].", ";	
				}else{
					$tipo_documento .= $row['id'];	
				}
				# code...
			}

			

			$query = $object->ListarGestion("WHERE tipo_documento in ($tipo_documento) and estado_archivo = '1' and estado_respuesta = 'Pendiente'");
			include_once(VIEWS.DS.'gestion/PendientesValidar.php');	   			   
			

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
	}

	function AceptarSolicitud($id, $area, $serie, $subserie, $user, $observacion2){
		global $con;
		global $c;
		global $f;
		// DEFINIMOS UN OBJETO NUEVO						
		$gestion = new MGestion;
		$gestion->CreateGestion("id", $id);

		$u = new MUsuarios;
		$u->CreateUsuarios("user_id", $_SESSION['usuario']);

		$object = new MGestion;
		$object->CreateGestion("id", $gestion->GetId());

		$us = new MUsuarios;
		$us->CreateUsuarios("a_i", $user);

		$ar2 = array('nombre_destino', 'tipo_documento', 'id_dependencia_raiz', 'ciudad', 'oficina', 'dependencia_destino', 'transferencia', 'observacion2', 'estado_respuesta');
		$ar1 = array($user, $subserie, $serie, $_SESSION['ciudad'], $u->GetSeccional(), $area, '0', $object->GetObservacion2()."<br>--<br>".date("Y-m-d H:i:s").": ".$observacion2, 'Abierto');
		$output = array('registro actualizado', 'no se pudo actualizar');
		$constrain = 'WHERE id = '.$gestion->GetId();

		#$create = $object->UpdateGestion($constrain, $fields, $updates, $output);



			$path = "";
    		$change = false;
    		$changeuser = false;
			
			$ciudad				  =   $_SESSION['ciudad'];
			$oficina			  =   $u->GetSeccional();
			$dependencia_destino  =   $area;
			$nombre_destino		  =   $_SESSION['usuario'];
			$tipo_documento 	  =   $subserie;
			$id_dependencia_raiz  =   $serie;

			if($object->GetNombre_destino() != $nombre_destino){
				$responsablea = $c->GetDataFromTable("usuarios", "a_i", $object->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");
				$responsableb = $c->GetDataFromTable("usuarios", "user_id", $nombre_destino, "p_nombre, p_apellido", $separador = " ");
    			$path .= "<li>Se edito el campo usuario destino '".$responsablea."' por '".$responsableb."' </li>";
    			$change = true;
    			$changeuser = true;
    		}
			if($object->GetTipo_documento() != $tipo_documento){
				$subseriea = $c->GetDataFromTable("dependencias", "id", $object->GetTipo_documento(), "nombre", $separador = " ");
				$subserieb = $c->GetDataFromTable("dependencias", "id", $tipo_documento, "nombre", $separador = " ");
    			$path .= "<li>Se edito el campo Sub Serie de '".$subseriea."' por '$subserieb' </li>";
    			$change = true;
    		}
    		if($object->GetId_dependencia_raiz() != $id_dependencia_raiz){
    			$seriea = $c->GetDataFromTable("dependencias", "id", $object->GetId_dependencia_raiz(), "nombre", $separador = " ");
    			$serieb = $c->GetDataFromTable("dependencias", "id", $id_dependencia_raiz, "nombre", $separador = " ");
    			$path .= "<li>Se edito el campo Serie de '".$seriea."' por '$serieb' </li>";
    			$change = true;
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
    		if($object->GetObservacion2() != $observacion2){
    			$path .= "<li>Se edito el campo Observacion de '".$object->GetObservacion2()."' por '$observacion2' </li>";
    			$change = true;
    		}

    		if($change){

				$objecte = new MEvents_gestion;
				$create = $object->UpdateGestion($constrain, $ar2, $ar1, $output);
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Editado", "Se ha editado la informacion del Expediente  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eexp", $object->GetId());

				$s = new MSuscriptores_contactos;
				$s->CreateSuscriptores_contactos("id", $object->GetSuscriptor_id());
				$sd = new MSuscriptores_contactos_direccion;
				$sd->CreateSuscriptores_contactos_direccion("id_contacto", $object->GetSuscriptor_id());
				$movimiento = "Solicitud Aceptada (".$observacion2.")";

				$MPlantillas_email = new MPlantillas_email;
				$MPlantillas_email->CreatePlantillas_email('id', '13');
				$contenido_email = $MPlantillas_email->GetContenido();
				$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",  $s->GetNombre(),   $contenido_email );
				$contenido_email = str_replace("[elemento]rad_rapido[/elemento]",  $object->GetMin_rad(),   $contenido_email );
				$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]", PROJECTNAME,   $contenido_email );
				$contenido_email = str_replace("[elemento]FECHA_HORA[/elemento]",  date("Y-m-d H:i:s"),     $contenido_email );
				$contenido_email = str_replace("[elemento]MOVIMIENTO[/elemento]",  $movimiento,    $contenido_email );
				$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
				$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Actualiación de un Expediente".$nr,$contenido_email,$sd->GetEmail());

			}

			$fecha = date("Y-m-d H:i:s");
			$msj = "La solicitud ".$object->GetMin_rad()." ha sido Recibida y se encuentra en revisión";
			$als = new MAlertas_suscriptor;
			$als->InsertAlertas_suscriptor($object->GetSuscriptor_id(), $msj, $object->GetId(), $fecha, "0", "sol_aceptada");

			if ($changeuser) {

				$objecte = new MEvents_gestion;
				$us = new MUsuarios;
				$us->CreateUsuarios("a_i", $u->GetA_i());
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Transferido", "La transferencia del expediente al usuario ".$us->GetP_nombre()." ".$us->GetP_apellido()." ha sido completada correctamente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $us->GetA_i(), "texp", $us->GetA_i());

			}
	}


	function RechazarSolicitud($id, $observacion2){

		global $con;
		global $c;
		global $f;
		// DEFINIMOS UN OBJETO NUEVO						
		$object = new MGestion;
		$object->CreateGestion("id", $id);

		$estado_archivo = "-1";

		if($object->GetObservacion2() != $observacion2){

			$path .= "<li>Se edito el campo Observacion de '".$object->GetObservacion2()."' por '$observacion2' </li>";
			$change = true;

		}

		if($object->GetEstado_archivo() != $estado_archivo){

			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");
			$path .= "<li>Se edito el campo archivo de '".$ar2[$object->GetEstado_archivo()]."' por '".$ar2[$estado_archivo]."' </li>";
			$change = true;
			$con->Query("UPDATE alertas set status = '2' where id_gestion = '".$object->GetId()."'");
			$con->Query("UPDATE events_gestion set status = '2' where gestion_id = '".$object->GetId()."'");
			$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '0'");
			$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '1' and status = '2'");

		}
		// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
		$ar2 = array('observacion2', 'estado_respuesta');
		// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
		$ar1 = array($observacion2, "Rechazado");	
		// DEFINIMOS LOS ESTADOS DE SALIDA
		$output = array('registro actualizado', 'no se pudo actualizar'); 
		// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
		$constrain = 'WHERE id = '.$id;

		$create = $object->UpdateGestion($constrain, $ar2, $ar1, $output);
		echo "Solicitud Rechazada";

		$fecha = date("Y-m-d H:i:s");
		$msj = "La solicitud ".$object->GetMin_rad()." ha sido rechazada por $observacion2";
		$als = new MAlertas_suscriptor;
		$als->InsertAlertas_suscriptor($object->GetSuscriptor_id(), $msj, $object->GetId(), $fecha, "0", "sol_rechazo");


		$s = new MSuscriptores_contactos;
		$s->CreateSuscriptores_contactos("id", $object->GetSuscriptor_id());
		$sd = new MSuscriptores_contactos_direccion;
		$sd->CreateSuscriptores_contactos_direccion("id_contacto", $object->GetSuscriptor_id());
		$movimiento = "Solicitud Rechazada (".$observacion2.")";

		$MPlantillas_email = new MPlantillas_email;
		$MPlantillas_email->CreatePlantillas_email('id', '13');
		$contenido_email = $MPlantillas_email->GetContenido();
		$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",  $s->GetNombre(),   $contenido_email );
		$contenido_email = str_replace("[elemento]rad_rapido[/elemento]",  $object->GetMin_rad(),   $contenido_email );
		$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]", PROJECTNAME,   $contenido_email );
		$contenido_email = str_replace("[elemento]FECHA_HORA[/elemento]",  date("Y-m-d H:i:s"),     $contenido_email );
		$contenido_email = str_replace("[elemento]MOVIMIENTO[/elemento]",  $movimiento,    $contenido_email );
		$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
		$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Actualiación de un Expediente".$nr,$contenido_email,$sd->GetEmail());

	}

	function EsperaSolicitud($id, $observacion2){

		global $con;
		global $c;
		global $f;
		// DEFINIMOS UN OBJETO NUEVO						
		$object = new MGestion;
		$object->CreateGestion("id", $id);

		$estado_archivo = "-1";

		if($object->GetObservacion2() != $observacion2){

			$path .= "<li>Se edito el campo Observacion de '".$object->GetObservacion2()."' por '$observacion2' </li>";
			$change = true;

		}

		if($object->GetEstado_archivo() != $estado_archivo){

			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");
			$path .= "<li>Se edito el campo archivo de '".$ar2[$object->GetEstado_archivo()]."' por '".$ar2[$estado_archivo]."' </li>";
			$change = true;
			$con->Query("UPDATE alertas set status = '2' where id_gestion = '".$object->GetId()."'");
			$con->Query("UPDATE events_gestion set status = '2' where gestion_id = '".$object->GetId()."'");
			$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '0'");
			$con->Query("UPDATE alertas SET keep_alive = '0' where id_gestion = '".$object->GetId()."' and type = '1' and status = '2'");

		}
		// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
		$ar2 = array('observacion2', 'estado_respuesta');
		// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
		$ar1 = array($observacion2, "En Espera Correccion");	
		// DEFINIMOS LOS ESTADOS DE SALIDA
		$output = array('registro actualizado', 'no se pudo actualizar'); 
		// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
		$constrain = 'WHERE id = '.$id;

		$create = $object->UpdateGestion($constrain, $ar2, $ar1, $output);
		echo "Solicitud Colocada En Espera Correccion";

		$fecha = date("Y-m-d H:i:s");
		$msj = "La solicitud ".$object->GetMin_rad()." ha sido puesta en espera porque $observacion2";
		$als = new MAlertas_suscriptor;
		$als->InsertAlertas_suscriptor($object->GetSuscriptor_id(), $msj, $object->GetId(), $fecha, "0", "sol_pausada");


		$s = new MSuscriptores_contactos;
		$s->CreateSuscriptores_contactos("id", $object->GetSuscriptor_id());
		$sd = new MSuscriptores_contactos_direccion;
		$sd->CreateSuscriptores_contactos_direccion("id_contacto", $object->GetSuscriptor_id());
		$movimiento = "Solicitud Colocada en Pausa (".$observacion2.")";

		$MPlantillas_email = new MPlantillas_email;
		$MPlantillas_email->CreatePlantillas_email('id', '13');
		$contenido_email = $MPlantillas_email->GetContenido();
		$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",  $s->GetNombre(),   $contenido_email );
		$contenido_email = str_replace("[elemento]rad_rapido[/elemento]",  $object->GetMin_rad(),   $contenido_email );
		$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]", PROJECTNAME,   $contenido_email );
		$contenido_email = str_replace("[elemento]FECHA_HORA[/elemento]",  date("Y-m-d H:i:s"),     $contenido_email );
		$contenido_email = str_replace("[elemento]MOVIMIENTO[/elemento]",  $movimiento,    $contenido_email );
		$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
		$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Actualiación de un Expediente".$nr,$contenido_email,$sd->GetEmail());

	}

	function getlistadoformularios($id){

		global $con;

		$ids = $id;
		$consulta = $con->Query("Select * from meta_referencias_titulos where id_s = '".$ids."' and tipo = '1'");
		while ($row = $con->FetchAssoc($consulta)) {
			echo "<option value='".$row['id']."'>".$row['titulo']."</option>";
		}
					
	}

	function GetAreas($idx){

		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

		global $con;
		global $c;
		global $f;

		//CARGANDO LA PAGINA DE INTERFAZ			

		$pagina = $this->load_template('Listar Carpetas');			


		// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

		ob_start();
		include_once(VIEWS.DS.'gestion/FiltroGestion.php');
		if ($_SESSION['typefolder'] == "1") {
			include_once(VIEWS.DS.'gestion/ListarAreas.php');	   			
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
		}elseif ($_SESSION['typefolder'] == "2") {
			include_once(VIEWS.DS.'folder/ListarAreasCentral.php');	   			
		}elseif ($_SESSION['typefolder'] == "3") {
			include_once(VIEWS.DS.'folder/ListarAreasCentral.php');	   			
		}else{
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'gestion/ListarAreas.php');	   			

		}

		$table = ob_get_clean();	

		// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

		if($message != '')

		$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);

		// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

		$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

		// RETORNAME LA PAGINA CARGADA		

		$this->view_page($pagina);			
	}

	function GetUsers($idx){

		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

		global $con;
		global $c;
		global $f;

		//CARGANDO LA PAGINA DE INTERFAZ			

		$pagina = $this->load_template('Listar Carpetas');			


		// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

		ob_start();
		include_once(VIEWS.DS.'gestion/FiltroGestion.php');
		if ($_SESSION['typefolder'] == "1") {
			include_once(VIEWS.DS.'gestion/ListarAreas.php');	   			
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
		}elseif ($_SESSION['typefolder'] == "2") {
			include_once(VIEWS.DS.'folder/ListarAreasCentral.php');	   			
		}elseif ($_SESSION['typefolder'] == "3") {
			include_once(VIEWS.DS.'folder/ListarAreasCentral.php');	   			
		}else{
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'gestion/ListarAreas.php');	   			

		}

		$table = ob_get_clean();	

		// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

		if($message != '')

		$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);

		// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

		$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

		// RETORNAME LA PAGINA CARGADA		

		$this->view_page($pagina);			
	}

	function GetUserFolders($idx){

		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

		global $con;
		global $c;
		global $f;

		//CARGANDO LA PAGINA DE INTERFAZ			

		$pagina = $this->load_template('Listar Carpetas');			


		// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

		ob_start();
		include_once(VIEWS.DS.'gestion/FiltroGestion.php');
		if ($_SESSION['typefolder'] == "1") {
			include_once(VIEWS.DS.'gestion/ListarFolders.php');	   			
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
		}elseif ($_SESSION['typefolder'] == "2") {
			include_once(VIEWS.DS.'folder/ListarAreasCentral.php');	   			
		}elseif ($_SESSION['typefolder'] == "3") {
			include_once(VIEWS.DS.'folder/ListarAreasCentral.php');	   			
		}else{
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'gestion/ListarFolders.php');	   			

		}

		$table = ob_get_clean();	

		// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

		if($message != '')

		$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);

		// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

		$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

		// RETORNAME LA PAGINA CARGADA		

		$this->view_page($pagina);			
	}



	function rmDir_rf($carpeta, $id, $iid){
		global $con;
		global $c;
		global $f;

		if (is_dir($carpeta)) {
			# code...
			$folderCont = scandir($carpeta);
			$observacion = "";
			foreach ($folderCont as $clave => $valor) {
				if ($valor!='.' && $valor!='..') {

					if(is_dir($carpeta.'/'.$valor)){
						echo $carpeta.'/'.$valor." Es un directorio, se Explorara el directorio <br>";
					}else{
						#echo "Mover $carpeta/$folderCont[$clave] ===> $id/anexos/$folderCont[$clave] <br>";
						try {
						
							if ($iid >= $_GET['id']) {
								# code...
							
							$backupname= $id.'/backup/';
							if (!file_exists($backupname)) {
							    mkdir($id.'/backup', 0777);
							}
							$src = $carpeta."/".$folderCont[$clave];


							$ext = explode(".", $folderCont[$clave]);
							$rand = $ext[0];
							$fname = $rand.".".$ext[1];
							$textname = $rand.".txt";

							$base_file = '';
							$data_base_file = file_get_contents($src);
							$base_file = base64_encode($data_base_file);

							$file = fopen(UPLOADS.DS.$iid.'/backup/'.$textname, "w");
							fwrite($file, $base_file . PHP_EOL);
							fclose($file);

							$hash = hash("sha256", $folderCont[$clave].$folderCont[$clave].$_SESSION['usuario'].$_SERVER[REMOTE_ADDR].date("Y-m-d").date("H:i:s").$size);

							$ordenq  = $con->Query("select count(*) as max from gestion_anexos WHERE gestion_id = '".$iid."' and folder_id = '".$_SESSION["folder_exp"]."'");
							$orden = $con->Result($ordenq, 0, "max");
							$orden += 1;

							$indice = $orden;

							$nombre_archivo = array("1" => "Inscripcion", "2" => "Contrato", "3" => "Correspondencia y Remesas", "4" => "Facturas", "5" => "Actas Recibido y Entregas", "6" => "Otros", "7" => "Comprobantes de egreso");

							$observacion .= $ext[0];

							$str = "INSERT into gestion_anexos (timest, gestion_id, nombre, url, user_id, ip, fecha, hora, folio, folder_id, folio_final, is_publico, cantidad,orden, hash, base_file, typefile, peso, indice) 
								values ('".date("Y-m-d H:i:s")."', '".$iid."','".$ext[0]."','".$folderCont[$clave]."','".$_SESSION['usuario']."', '".$_SERVER[REMOTE_ADDR]."', '".date("Y-m-d")."', '".date("H:i:s")."', '2', '".$_SESSION["folder_exp"]."', '".$folfinal."', '0', '1', '".$orden."', '".$hash."','".$textname."','application/pdf' ,'0', '".$indice."')";

								echo $str;
							$con->Query($str);

							$gestion_anexos_id = $c->GetMaxIdTabla("gestion_anexos", "id");

							$objecte = new MEvents_gestion;
							$objecte->InsertEvents_gestion($_SESSION['usuario'], $iid, date("Y-m-d"), "Carga de Documento", "Se ha cargado un documento llamado: \"".$nombre_archivo[$ext[0]]."\"", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "an", $gestion_anexos_id);
/*
							return $observacion;
*/
							}
						} catch (Exception $e) {
							echo  $e->getMessage();
						} 
						#unlink($carpeta.'/'.$folderCont[$clave]);
					}
				}

			}

			#$con->Query("update getion set observacion = '".$observacion."' where id = '".$iid."' ");

		}else{
			echo "El directorio no se encuentra o no existe<br>";
		}

	}

	function ExportarResumen($id){
		global $c;
		global $f;
		global $con;

		$object = new MGestion;
		$object->CreateGestion("id", $id);

		$html = '<table style="width:100% !important">';
		$html .= '	<tr>
						<td colspan="4">';
		if ($object->GetTransferencia() == "1"){
        
            $qut = $con->Query("select user_recibe from gestion_transferencias where gestion_id = '".$object->GetId()."' and estado = '0'");
            $ut = $con->FetchAssoc($qut);
            $usuario_transfiere = $c->GetDataFromTable("usuarios", "a_i", $ut['user_recibe'], "p_nombre, p_apellido", $separador = " ");
        
        	$html .= ' ESTE EXPEDIENTE SE ENCUENTRA EN TRANSFERENCIA HACIA EL USUARIO <b>'.$usuario_transfiere.'</b>';
        }
		$html .= '		</td>
					</tr>';

		$html .= '	<tr>
						<td><strong>Rad. Externo:</strong></td>
						<td colspan="3">'.$object->GetRadicado().'</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Radicado:</strong></td>
						<td colspan="3">'.$object->GetMin_rad().'</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Titulo:</strong></td>
						<td colspan="3">'.$object->GetObservacion().'</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Suscriptor:</strong></td>
						<td colspan="3">';
        $s = new Msuscriptores_contactos;
        $s->CreateSuscriptores_contactos("id", $object->Getsuscriptor_id());
        $html .=  "			<span>".$s->GetNombre()."</span>";
		$html .=		'</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Soporte:</strong> </td>
						<td>';
		$estado_solicitud = $c->GetDataFromTable("estados_gestion", "id", $object -> GetEstado_solicitud(), "nombre", $separador = " ");
        $html .= "			<span class='tempspace'>".$estado_solicitud."</span>"; 
		$html .=		'</td>
						<td><strong>Fecha de Apertura:</strong></td>
						<td>'.$object -> Getf_recibido().'</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Documento de:</strong></td>
						<td>';

                    $tipo_d="Entrada";
                    if($object -> GetDocumento_salida() == 'S'){

                         $tipo_d= "Salida";

                    }
                    if($object -> GetDocumento_salida() == 'C'){

                         $tipo_d= "Comunicaciones Internas";

                    }                            
                    $html .= "<span class='tempspace'>".$tipo_d."</span>";

		$html .= '		</td>
						<td><strong>Fecha Vencimiento:</strong></td>
						<td>'.$object -> Getfecha_vencimiento().'</td>
					</tr>';
		$html .= '	<tr>
						<td><strong>Estado:</strong></td>
						<td>'.$object -> Getestado_respuesta().'</td>
						<td><strong>Fecha Cierre:</strong></td>
						<td>'.$object -> Getfecha_respuesta().'</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Prioridad:</strong></td>
						<td>';
						$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
		$html .= "			<span class='tempspace'>".$ar[$object -> Getprioridad()]."</span>"; 
		$html .='		</td>
						<td><strong># Folios:</strong></td>
						<td>'.$object -> Getfolio().'</td>
					</tr>';
		$html .= '	<tr>
						<td><strong>Departamento:</strong></td>
						<td colspan="3">';

        $city = new MCity;

        $city->CreateCity("code", $object->GetCiudad());

        $dp = new MProvince;

        $dp->CreateProvince("code", $city->GetProvince());

        $province = $dp->GetName();

        $html .= "<span class='tempspace'>".$province."</span>";

		$html .= '		</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Ciudad:</strong></td>
						<td colspan="3">';
		$html .= "<span class='tempspace'>".$city->GetName()."</span>";
		$html .= '		</td>
					</tr>';
		$html .= '	<tr>
						<td><strong>Oficina:</strong></td>
						<td colspan="3">';
		 $of = new MSeccional;

        $of->CreateSeccional("id", $object->GetOficina());

        $oficina = $of->GetNombre();

        $html .= "<span class='tempspace'>".$oficina."</span>";
		$html .= '		</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Area:</strong></td>
						<td colspan="3">';
		$area = new MAreas;

        $area->CreateAreas("id", $object->GetDependencia_destino());

        $narea = $area->GetNombre();

        $html .= "<span class='tempspace'>".$narea."</span>";
		$html .= '		</td>
					</tr>';
		$html .= '	<tr>
						<td><strong>Responsable:</strong></td>
						<td colspan="3">';
	    $u = new MUsuarios;

        $u->CreateUsuarios("a_i", $object -> Getnombre_destino());

        $nombreresponsable = $u->GetP_nombre()." ".$u->GetP_apellido();

        $html .= "<span class='tempspace'>".$nombreresponsable."</span>";
		$html .= '		</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Cotejado Por:</strong></td>
						<td colspan="3">';
		$ur = new MUsuarios;
        $ur->CreateUsuarios("user_id", $object -> GetUsuario_registra());
        $nombreregistra = $ur->GetP_nombre()." ".$ur->GetP_apellido();
        $html .= "<span class='tempspace'>".$nombreregistra."</span>";
		$html .= '		</td>
					</tr>';
		$html .= '	<tr>
						<td><strong>Serie:</strong></td>
						<td colspan="3">';
	    $d = new MDependencias();

        $d->CreateDependencias("id", $object -> GetId_dependencia_raiz());

        $html .= "  <span class='tempspace'>".$d->GetNombre()."</span>";
		$html .= '		</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Subserie:</strong></td>
						<td colspan="3">';
		$d = new MDependencias();

        $d->CreateDependencias("id", $object -> Gettipo_documento());

        $html .= "  <span class='tempspace'>".$d->GetNombre()."</span>";
		$html .= '		</td>
					</tr>';
		$html .= '	<tr>
						<td><strong>Observacion:</strong></td>
						<td colspan="3">';
		$html .= "<span class='tempspace'>".$object -> Getobservacion2()."</span>";
		$html .= '		</td>
					</tr>';					
		$html .= '	<tr>
						<td><strong>Ubicación:</strong></td>
						<td colspan="3">';
        $ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");
        $html .= "<span class='tempspace tempspace2'>".$ar2[$object -> Getestado_archivo()]."</span>"; 
		$html .= '		</td>
					</tr>';
		$html .= '	<tr>
						<td><strong>Enlace de Consulta Publica (URI):</strong></td>
						<td colspan="3">';
		$codeText = HOMEDIR.DS.'s/'.$object->GetUri().'/'; 
        $html .= "<a href='".$codeText."' target='_blank'>".$codeText."</a>";
		$html .= '		</td>
					</tr>';

		$html .= '</div>';


		$f->PlantillaDocumento($html, "Resumen del Expediente ".$object->GetMin_rad(), $object->GetId());

	}

	function ProcesarMasiva(){
		global $con;
		global $c;
		global $f;

		$archivo = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'].'/file_'.$_SESSION['suscriptor_id'].'.xlsx';
		$tipo_documento = $c->sql_quote($_REQUEST['tipo_documento']);
		$arrext=explode('.',$archivo);
		$ext=end($arrext);

		if($ext != 'xlsx' && $ext != 'xls' ){
			echo "Formato del Archivo Incorrecto!";
			exit;
		}

		

		$procesados = 0;
		$noprocesados = 0;
		/*procesar archivo*/
		$archivoList = $archivo;
		$path = "";

		if(file_exists($archivoList)){

			$objPHPExcel = PHPExcel_IOFactory::load($archivoList);
			#foreach que leer el archivo de excel.
			$refcol = "";
			$refcol_anexo = "";
			$path .= "<ul>";
			$countfilas = 0;
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){

				$worksheetTitle     = $worksheet->getTitle();
				$highestRow         = $worksheet->getHighestRow();
				$highestColumn      = $worksheet->getHighestColumn();
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
				$total_lineas = $highestRow;

				#RECORRO LA FILA
				for ($row = 1; $row <= $total_lineas; ++ $row){

					$k++;
					$arrFilas = array();

					$mys_id = $_SESSION['smallid']."_".$row;

					$con->Query("delete from meta_big_data where grupo_id = '".$mys_id."'");

					$condocs = $con->Query("select id, titulo from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1'");
					$idref = $con->FetchAssoc($condocs);
					$observacion = $idref['titulo']." ";
					$idr = $idref['id'];

					$checkInsert = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idr."'");
					while ($rrrx = $con->FetchAssoc($checkInsert)) {
						$con->Query("INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form, fecha_registro, orden) VALUES ('0', '".$idref['id']."', '".$rrrx['id']."', '', '".$mys_id."', '1', '".date("Y-m-d")."', '".$rrrx['orden']."')");
					}

					#RECORRO LA COLUMNA
					for ($col = 0; $col < $highestColumnIndex; ++ $col){

						$val = "";
						$cell = $worksheet->getCellByColumnAndRow( $col , $row );
						$val = $cell->getValue();
						$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
						#Codigo Supremamente importante para el patron de recocimiento.
						
						if($row == 1 && strlen($val) > 0){
							$arrCabecera[$col] = $val;
						}

						if($row > 1 && strlen($val) > 0){
							$arrFilas[$col] = $val;
						}


						if($row == 1){
							if ($val == "IDENTIFICACION_EMPLEADO") {
								$refcol = $col;
							}elseif($val == "anexos"){
								$refcol_anexo = $col;
							}
						}else{

							if ($col == $refcol) {
								$dex = $con->Query("select id, nombre from suscriptores_contactos where identificacion = '".$val."' and dependencia = '".$_SESSION['suscriptor_id']."'");

								$idx = $con->FetchAssoc($dex);
								$suscriptor = $idx['id'];
								$observacion .= $idx['nombre'];
							}elseif($col == $refcol_anexo){

								$elem = $con->Query("select * from dependencias_tipologias where id_dependencia = '".$tipo_documento."' and es_obligatorio = '1' and web_default = '1'");

								while ($docrow = $con->FetchAssoc($elem)) {
									
									$dogc = new MDependencias_tipologias;
									$dogc->CreateDependencias_Tipologias("id", $docrow['id']);

									$an = new MGestion_anexos;
									$in_out = $c->GetDataFromTable("dependencias_tipologias", "id", $dogc->GetTipologia(), "es_entrada", "");
									$in_out = ($in_out == "0")?"-1":"1";

									$exs = $con->Query("select count(*) as t from gestion_anexos where tipologia = '".$dogc->GetId()."' and id_servicio = '$mys_id'");
									$tt = $con->Result($exs, 0, 't');

									if ($tt == "0") {
										$an->InsertGestion_anexos("0", $dogc->GetTipologia(), $val, $_SESSION['usuario'], date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", "0", "0", "1", $dogc->GetId(), $in_out, $mys_id, "2");
									}
								}

							}else{

								$cellmeta = $worksheet->getCellByColumnAndRow( $col , "1" );
								$valmeta = $cellmeta->getValue();

								$fl = $con->Query("select id from meta_referencias_campos where id_referencia = '".$idr."' and slug = '".$valmeta."' ");
								$idref = $con->FetchAssoc($fl);
								$referencia = $idref['id'];
								$string = "update meta_big_data set valor = '".$val."' where grupo_id = '".$mys_id."' and campo_id = '".$referencia."' and ref_id = '".$idr."'";
								$con->Query($string);

							}

						}
					} #ESTE CIERRA FOR DE LA FILA SOLO NECESITO REFCOL, 1

					if($suscriptor != ""){

						$countfilas++;

						$tipo_d = $con->Query("select id, dependencia from dependencias where id = '".$tipo_documento."' ");
						$tipo_dq = $con->FetchAssoc($tipo_d);	
						$id_dependencia_raiz = $tipo_dq['dependencia'];	

						$o = $con->Query("SELECT user_id FROM usuarios_funcionalidades WHERE id_funcionalidad = '12' and valor = '1' limit 0, 1 ");
						$ob = $con->FetchAssoc($o);
						$u = new MUsuarios;
						$u->CreateUsuarios('user_id', $ob['user_id']);

						$se = new MSeccional;
						$se->CreateSeccional("id", $u->GetSeccional());

						$sp = new MSeccional_principal;
						$sp->CreateSeccional_principal("ciudad_origen", $se->GetCiudad());

						$s = new MSuscriptores_contactos;
						$s->CreateSuscriptores_contactos("id", $_SESSION["suscriptor_id"]);

						$d = new MDependencias;
						$d->CreateDependencias("id", $tipo_documento);

						$dr = new MDependencias;
						$dr->CreateDependencias("id", $id_dependencia_raiz);

						$a = new MAreas;
						$a->CreateAreas("id", $u->GetRegimen());

						$radicado = "";
						$f_recibido = date("Y-m-d");
						$nombre_radica = $s->GetNombre();
						$folio = "0";
						$dependencia_destino = $u->GetRegimen();
						$nombre_destino = $u->GetA_i();
						$fecha_vencimiento = "";
						$estado_respuesta = "Pendiente";
						$fecha_respuesta = "";
						$num_oficio_respuesta = date("Y")."-".$a->GetPrefijo()."-".$dr->GetId_c()."-".$d->GetId_c();
						$prioridad = "1";
						$estado_solicitud = "1";
						$suscriptor_id = $s->GetId();
						$ciudad = $se->GetCiudad();
						$usuario_registra = $u->GetUser_id();
						$estado_archivo = "1";
						$oficina = $u->GetSeccional();
						$autorad = "SI";
						$dtform = "";
						$documento_salida="N";
						// DEFINIENDO EL OBJETO

						$object = new MGestion;
						#print_r($_REQUEST);
						$nr = $object->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);
						$minr = $object->GetMinRadicado();

						// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
						$create = $object->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida, "0", $observacion2, "1");

						$id = $c->GetMaxIdTabla("gestion", "id");

						$filename=UPLOADS.DS.$id.'/';
						if (!file_exists($filename)) {
						    mkdir(UPLOADS.DS . $id, 0777);
						}
						$filename=UPLOADS.DS.$id.'/anexos/';
						if (!file_exists($filename)) {
						    mkdir(UPLOADS.DS . $id.'/anexos', 0777);
						}

						$gs = new MGestion_suscriptores();
						$gs->InsertGestion_suscriptores($id, $suscriptor_id, $u->GetUser_id(), "1", "1", date("Y-m-d"));
						$gs->InsertGestion_suscriptores($id, $suscriptor, $u->GetUser_id(), "1", "1", date("Y-m-d"));

						$call = "*";
						if ($nombre_destino == "0") {
							$call = "*";
						}elseif ($nombre_destino == "-1") {
							$call = "areaboss";
						}else{
							$call = $nombre_destino;
						}
						$objecte = new MEvents_gestion;
					#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
						$objecte->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Creación de Radicación", "Se ha creado la radicación $nr", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $call, "rad", $id);

						if ($fecha_vencimiento > date("Y-m-d")) {
							$objecte->InsertEvents_gestion($u->GetUser_id(), $id, $fecha_vencimiento, "Vencimiento de un Expediente", "Se programó vencimiento del expediente para el día ".$fecha_vencimiento, date("Y-m-d"), 1, date("H:i:s"), 0, 3, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $call, "vexp", $id);
						}
						$aertasau = $con->Query("Select * from dependencias_alertas where id_dependencia = '".$tipo_documento."' and automatica = 'SI'");
						while ($rowau = $con->FetchAssoc($aertasau)) {
							$alerta = $rowau['id'];
							$gestion = $id;
							$depa = new MDependencias_alertas;
							$depa->CreateDependencias_alertas("id", $alerta);
							$fecha = date("Y-m-d");
							$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
							date_modify($fecha_c, $depa->GetDias_alerta()." day");//sumas los dias que te hacen falta.
							$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
							$eventoe = new MEvents_gestion;
						#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
							$create = $eventoe->InsertEvents_gestion($u->GetUser_id(), $gestion, $fecha_a, $depa->GetNombre(), $depa->GetDescripcion(), date("Y-m-d"), 0, date("H:i:s"), 0, $depa->GetDias_antes(), 0, $fecha_a, $alerta, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), "*", 'ev', $gestion);
						}
						$MUsuarios2 = new MUsuarios;
				    	$MUsuarios2->CreateUsuarios("user_id", $u->GetUser_id());
				    	$username2 = $MUsuarios2->GetP_nombre()." ".$MUsuarios2->GetP_apellido();
				    	$from = $MUsuarios2->GetEmail();
				    	$g = new MGestion;
						$g->CreateGestion("id", $id);
						$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetDependencia_destino(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ")."";
						$NUMRADICACION = "<a href='".HOMEDIR."/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetNum_oficio_respuesta()."</small>)</a>";
						$MUsuarios = new MUsuarios;
				    	$MUsuarios->CreateUsuarios("a_i", $u->GetA_i());
			    		$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();

			    		$link = HOMEDIR.DS."s/".$g->GetUri()."/";

						$con->Query("update meta_big_data set type_id = '".$g->GetId()."', fecha_registro = '".date("Y-m-d")."' where grupo_id = '".$mys_id."'");
						$con->Query("update gestion_anexos set gestion_id = '".$g->GetId()."', is_publico = '1' where id_servicio = '".$mys_id."' and ip = '".$_SERVER['REMOTE_ADDR']."'");
						#$archivo = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'].'/file_'.$_SESSION['suscriptor_id'].'.xlsx';
						$oname = UPLOADS.DS."tmp_base/".$_SESSION['smallid'].DS;  
						$nname = UPLOADS.DS.$g->GetId().DS; 
						$f->copia($oname, $nname);
						#unset($mys_id);
						#echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/"</script>';
					}



				}
			}
			$path .= "</ul>";
		}

		if ($path == "<ul></ul>") {
			$path = "<div class='alert alert-success m-t-20 m-b-30'>$countfilas Expedientes Creados!</div>";
		}
		echo $path;
		
	}
	function CargarReparto(){
		global $con;
		global $c;
		global $f;
		
		$f_fi = $c->sql_quote($_REQUEST['f_fi']);
		$f_ff = $c->sql_quote($_REQUEST['f_ff']);
		$estado = $c->sql_quote($_REQUEST['estado']); // ESTADO PENDIENTE, ACTIVO....
		$responsable = $c->sql_quote($_REQUEST['responsable']); // USUARIO RESPONSABLE: nombre_destino
		$formulario = $c->sql_quote($_REQUEST['formulario']); // tipo_documento
		$suscriptor = $c->sql_quote($_REQUEST['suscriptor']); // suscriptor_id
		$usuarios = $c->sql_quote($_REQUEST['usuarios']); // suscriptor_id

		$path = "";
		if ($estado != "*" ) {
			$path .= ' and estado_respuesta = "'.$estado.'"';
		}
		if ($responsable != "*" ) {
			#$usuarios = implode(",", $usuarios);
			$path .= ' and nombre_destino =  "'.$_SESSION['user_ai'].'"';
		}
		if ($formulario != "*" ) {
			$path .= ' and tipo_documento = "'.$formulario.'"';
		}
		if ($suscriptor != "*" ) {
			$path .= ' and suscriptor_id = "'.$suscriptor.'"';
		}

		$str = "select * from gestion where f_recibido between '$f_fi' and '$f_ff' $path ";
		$query = $con->Query($str);
		$t = $con->NumRows($query);

		$prom = $t / count($usuarios);
		$prom = round($prom);

		echo "<h4>Expedientes Para Repartir: ".$t."</h4>";

		echo "<h4>Entre: ".count($usuarios)." usuarios</h4>";
		echo "<h4>Promedio de Exp por Usuario: ".$prom."</h4>";
		echo "<hr>";

		$consulta = "";
		for ($i=0; $i < count($usuarios) ; $i++) { 
			$us = new MUsuarios;
			$us->CreateUsuarios("a_i", $usuarios[$i]);

			$in = $i * $prom;
			

			$str = "select * from gestion where f_recibido between '$f_fi' and '$f_ff' $path limit $in, $prom";
			$qx = $con->Query($str);
			$n = $con->NumRows($qx);
			
			echo "<h4>Usuario ".$us->GetP_nombre()." ".$us->GetP_apellido()." $n Expedientes Asignados (";
			$cons  = array();
			while ($ro = $con->FetchAssoc($qx)) {
				echo "<small><a href='/gestion/ver/".$ro['id']."/' target='_blank'>".$ro['min_rad']."</a>, </small>";
				array_push($cons, "'".$ro['id']."'");
			}
			$cons = implode(",", $cons);
			$consulta .= "UPDATE gestion set nombre_destino = '".$us->GetA_i()."' where id in (".$cons.");";
			echo  ")<br>";
		}
		$rs = explode(";", $consulta);

		for ($i=0; $i < count($rs) ; $i++) { 
			$qu = $con->Query($rs[$i]);
		}
		#$con->Query($consulta);

	}
}

?>