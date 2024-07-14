<?
session_start();
date_default_timezone_set('America/Bogota');
if ($_REQUEST['action'] == 'registrov2' && $_SESSION['usuario'] == 'sanderkdna@gmail.com') {
	// error_reporting(E_ALL);
	// ini_set('display_errors', '1');
	// code...
}
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
	require_once(PLUGINS.DS.'tcpdf/tcpdf.php');
	require_once(PLUGINS.DS.'FPDI/fpdi.php');


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

	$ar2 = array('radicado', 'suscriptor_id', 'fecha_vencimiento', 'estado_respuesta', 'prioridad', 'observacion', 'estado_archivo', 'f_recibido', 'estado_solicitud', 'fecha_respuesta', 'documento_salida', 'observacion2', 'tipo_documento', 'id_dependencia_raiz', 'estado_personalizado', 'campot1', 'campot2', 'campot3', 'campot4', 'campot5', 'campot6', 'campot7', 'campot8', 'campot9', 'campot10', 'campot11', 'campot12', 'campot13', 'campot14', 'campot15');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER
	$ar1 = array($c->sql_quote($_REQUEST['radicado']), $c->sql_quote($_REQUEST['suscriptor_id']),  $c->sql_quote($_REQUEST['fecha_vencimiento']), $c->sql_quote($_REQUEST['estado_respuesta']), $c->sql_quote($_REQUEST['prioridad']), $c->sql_quote($_REQUEST['observacion']), $c->sql_quote($_REQUEST['estado_archivo']), $c->sql_quote($_REQUEST['fecha_recibido']), $c->sql_quote($_REQUEST['estado_solicitud']),  $c->sql_quote($_REQUEST['fecha_respuesta']), $c->sql_quote($_REQUEST['documento_salida']), $c->sql_quote($_REQUEST['observacion2']), $c->sql_quote($_REQUEST['tipo_documento']), $c->sql_quote($_REQUEST['id_dependencia_raiz']), $c->sql_quote($_REQUEST['estado_personalizado']), $c->sql_quote($_REQUEST['campot1']), $c->sql_quote($_REQUEST['campot2']), $c->sql_quote($_REQUEST['campot3']), $c->sql_quote($_REQUEST['campot4']), $c->sql_quote($_REQUEST['campot5']), $c->sql_quote($_REQUEST['campot6']), $c->sql_quote($_REQUEST['campot7']), $c->sql_quote($_REQUEST['campot8']), $c->sql_quote($_REQUEST['campot9']), $c->sql_quote($_REQUEST['campot10']), $c->sql_quote($_REQUEST['campot11']), $c->sql_quote($_REQUEST['campot12']), $c->sql_quote($_REQUEST['campot13']), $c->sql_quote($_REQUEST['campot14']), $c->sql_quote($_REQUEST['campot15']));

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
		elseif($c->sql_quote($_REQUEST['action']) == 'correo')
			$ob->VistaCorreoCorrespondencia();
		elseif($c->sql_quote($_REQUEST['action']) == 'nuevov2')
			$ob->VistaInsertarV2();
		elseif($c->sql_quote($_REQUEST['action']) == 'carga')

			$ob->VistaMultiple();

		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR

		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')

		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR

			$ob->Insertar($c->sql_quote($_REQUEST["radicado"]), $c->sql_quote($_REQUEST["f_recibido"]), $c->sql_quote($_REQUEST["nombre_radica"]), $c->sql_quote($_REQUEST["folio"]), $c->sql_quote($_REQUEST["tipo_documento"]), $c->sql_quote($_REQUEST["dependencia_destino"]), $c->sql_quote($_REQUEST["nombre_destino"]), $c->sql_quote($_REQUEST["fecha_vencimiento"]), $c->sql_quote($_REQUEST["estado_respuesta"]), $c->sql_quote($_REQUEST["num_oficio_respuesta"]), $c->sql_quote($_REQUEST["fecha_respuesta"]), $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["prioridad"]), $c->sql_quote($_REQUEST["estado_solicitud"]), $c->sql_quote($_REQUEST["suscriptor_id"]), $c->sql_quote($_REQUEST["ciudad"]), $c->sql_quote($_REQUEST["usuario_registra"]), $c->sql_quote($_REQUEST["estado_archivo"]), $c->sql_quote($_REQUEST["oficina"]), $c->sql_quote($_REQUEST["id_dependencia_raiz"]), $c->sql_quote($_REQUEST["autorad"]), $c->sql_quote($_REQUEST["dtform"]), $c->sql_quote($_REQUEST["documento_salida"]), $c->sql_quote($_REQUEST['observacion2']), $c->sql_quote($_REQUEST['campot1']), $c->sql_quote($_REQUEST['campot2']), $c->sql_quote($_REQUEST['campot3']), $c->sql_quote($_REQUEST['campot4']), $c->sql_quote($_REQUEST['campot5']), $c->sql_quote($_REQUEST['campot6']), $c->sql_quote($_REQUEST['campot7']), $c->sql_quote($_REQUEST['campot8']), $c->sql_quote($_REQUEST['campot9']), $c->sql_quote($_REQUEST['campot10']), $c->sql_quote($_REQUEST['campot11']), $c->sql_quote($_REQUEST['campot12']), $c->sql_quote($_REQUEST['campot13']), $c->sql_quote($_REQUEST['campot14']), $c->sql_quote($_REQUEST['campot15']), $c->sql_quote($_REQUEST['expediente_publico']));

		elseif($c->sql_quote($_REQUEST['action']) == 'registro_publico')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR

			$ob->InsertarPublico($c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST['observacion2']), $c->sql_quote($_REQUEST['tipo_documento']));

		elseif($c->sql_quote($_REQUEST['action']) == 'registrodecorrespondencia')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR
			$ob->InsertarCorrespondencia($c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST['observacion2']), $c->sql_quote($_REQUEST['tipo_documento']));
		
		elseif($c->sql_quote($_REQUEST['action']) == 'registrov2')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR
			$ob->RegistroV2($c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST['observacion2']), $c->sql_quote($_REQUEST['tipo_documento']));

		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR

		elseif($c->sql_quote($_REQUEST['action']) == 'editar')

			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'dosms'){

			echo $_SERVER['SERVER_ADDR'];
			$f->EnviarSMS("3158009300", "hola sander como vas");

		}
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

		elseif($c->sql_quote($_REQUEST['action']) == 'GetAnexosBuscar')

			$ob->GetAnexosBuscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));

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

		elseif($c->sql_quote($_REQUEST['action']) == 'Getseguimiento')

			$ob->Getseguimiento($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		
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

        elseif($c->sql_quote($_REQUEST['action']) == 'quepaso')
            $ob->QuePaso();
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

		
		elseif($c->sql_quote($_REQUEST['action']) == 'getsuscriptoresexpediente')
			$ob->GetsuscriptoresExpedientes($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'GetId_a')

			$ob->GetId_a($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'aceptarsolicitud')

			$ob->AceptarSolicitud($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['area']), $c->sql_quote($_REQUEST['serie']), $c->sql_quote($_REQUEST['subserie']), $c->sql_quote($_REQUEST['user']), $c->sql_quote($_REQUEST['observacion2']));

		elseif($c->sql_quote($_REQUEST['action']) == 'rechazarsolicitud')
			$ob->RechazarSolicitud($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['observacion2']));
		elseif($c->sql_quote($_REQUEST['action']) == 'esperasolicitud')
			$ob->EsperaSolicitud($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['observacion2']));

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizarcampoproceso')
			$ob->ActualizarCampoExpediente($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
		
		elseif($c->sql_quote($_REQUEST['action']) == 'archivarexpedienteweb')
			$ob->ArchivarExpediente($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['observacion2']));

		elseif($c->sql_quote($_REQUEST['action']) == 'imprimir')

			$ob->PrintPage($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'imprimirdocumento')

			$ob->PrintDocument($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'correspondencia')

			$ob->GetCorrespondencia($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'exportarcorreoemail')

			$ob->ExportarCorreoMail($c->sql_quote($_REQUEST['id']));


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

			        copy($tmp_name, $uploads_dir."/".$rand.".".$ext);
			        $_SESSION['filed'] = $rand.".".$ext;
			        $i++;
			    }
			}

			echo $rand.$name."////<div class='alert alert-info'>$i Archivos Cargados<div>";

		}
		elseif($c->sql_quote($_REQUEST['action']) == 'cargararchivocorrespondenciapublico2'){

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
			foreach ($_FILES["pictures2"]["error"] as $key => $error) {
			    if ($error == UPLOAD_ERR_OK) {
			        $tmp_name = $_FILES["pictures2"]["tmp_name"][$key];
			        $name = $_FILES["pictures2"]["name"][$key];

			        $rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);
					$ext = end(explode(".", $_FILES['pictures2']['name'][$key]));

					$fname = $rand.".".$ext;

			        copy($tmp_name, $uploads_dir."/".$_FILES['pictures2']['name'][$key]);
			        //$_SESSION['filed'] = $_FILES['pictures2']['name'][$key];
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

		elseif($c->sql_quote($_REQUEST['action']) == 'archivocentral')
			
			$ob->GetAreas('2', $c->sql_quote($_REQUEST['id']));

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
		elseif($c->sql_quote($_REQUEST['action']) == 'exportar')
			$ob->ExportarResumen($c->sql_quote($_REQUEST['id']));

		elseif($c->sql_quote($_REQUEST['action']) == 'cerrarproceso')
			$ob->CerrarExpediente($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		elseif($c->sql_quote($_REQUEST['action']) == 'cambiarfiltro'){

			$_SESSION['filtro_fi'] = $c->sql_quote($_REQUEST['f_fi']);
			$_SESSION['filtro_ff'] = $c->sql_quote($_REQUEST['f_ff']);
			$_SESSION['filtro_estado'] = $c->sql_quote($_REQUEST['estado']);
			$_SESSION['filtro_prioridad'] = $c->sql_quote($_REQUEST['prioridad']);

			header("LOCATION: ".HOMEDIR.$c->sql_quote($_REQUEST['retorno']));
		}elseif($c->sql_quote($_REQUEST['action']) == 'explorar'){
			$ob->GetExpedientebyId($c->sql_quote($_REQUEST['id']));
		
		}elseif($c->sql_quote($_REQUEST['action']) == 'getplantilla'){
			$ob->GetPlantilla($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), $c->sql_quote($_REQUEST['p1']));
			
		}elseif($c->sql_quote($_REQUEST['action']) == 'getdetailexpediente'){
			$ob->GetDetailExpediente($c->sql_quote($_REQUEST['id']));
		}else{
			// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO
			$ob->VistaListar('');
		}

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
			global $c;

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
				include_once(VIEWS.DS.'gestion/FormUpdateGestionV2.php');
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

		function Insertar($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $num_oficio_respuesta, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $autorad, $dtform, $documento_salida="N", $observacion2, $t1 = "", $t2 = "", $t3 = "", $t4 = "", $t5 = "", $t6 = "", $t7 = "", $t8 = "", $t9 = "", $t10 = "", $t11 = "", $t12 = "", $t13 = "", $t14 = "", $t15 = "", $expediente_publico){

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

			$expediente_publico = ($expediente_publico == "S")?"1":"0";

			$object = new MGestion;

			$nr = $object->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);

			// if ($_SESSION['usuario'] == 'sanderkdna@gmail.com') {
			// 	$minr = $object->GetMinRadicado($documento_salida, '2024-10-195');
			// }else{
			// }
			$minr = $object->GetMinRadicado($documento_salida);


			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA

			$create = $object->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida, "0", $observacion2, "0", $t1, $t2, $t3, $t4, $t5,$t6, $t7, $t8, $t9, $t10,$t11, $t12, $t13, $t14, $t15, "", $expediente_publico);

			$id = $c->GetMaxIdTabla("gestion", "id");

			/*Se realiza transferencia*/
			$responsablea = $c->GetDataFromTable("usuarios", "user_id",  $_SESSION['usuario'], "p_nombre, p_apellido", $separador = " ");
			$MUsuariost = new MUsuarios;
			$MUsuariost->CreateUsuarios("user_id", $_SESSION['usuario']);
			if($nombre_destino != $MUsuariost->GetA_i()){
				$nombre_destino_old = $nombre_destino;
				$nombre_destino = $MUsuariost->GetA_i();
				$con->Query("UPDATE gestion set transferencia = '1',nombre_destino = '".$nombre_destino."' where id = '".$id."' ");
				$mtransferencia = new MGestion_transferencias;
	    		$mtransferencia->InsertGestion_transferencias($id, $_SESSION['usuario'], $nombre_destino_old, date("Y-m-d H:i:s"), "", "", "", "0");

				$objecte = new MEvents_gestion;
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $id, date("Y-m-d"), "Nuevo Expediente Asignado: ".$nr, "El usuario $responsablea le acaba de asignar un expediente debe aceptarlo o rechazarlo", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $nombre_destino_old, "trexp", $id);
			}
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

			$aertasau = $con->Query("Select * from dependencias_alertas where id_dependencia = '".$tipo_documento."' and automatica = 'SI' and dependencia_alerta = '0' ");

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

				$NUMRADICACION = "<a href='".HOMEDIR."/gestion/ver/".$g->GetId()."/' target='_blank'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";

				$subs = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", " ");
				$area = $c->GetDataFromTable("areas", "id", $g->GetDependencia_destino(), "nombre", " ");

				$MUsuarios = new MUsuarios;

		    	$MUsuarios->CreateUsuarios("a_i", $c->sql_quote($_REQUEST['nombre_destino']));

	    		$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();



				$MPlantillas_email = new MPlantillas_email;

				$MPlantillas_email->CreatePlantillas_email('id', '10');

				$contenido_email = $MPlantillas_email->GetContenido();

				$contenido_email = str_replace("[elemento]responsable[/elemento]",      $username,     $contenido_email );
				$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $username2,    $contenido_email );
				$contenido_email = str_replace("[elemento]rad_rapido[/elemento]",      $NUMRADICACION,   $contenido_email );
				$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
				$contenido_email = str_replace("[elemento]Suscriptor[/elemento]", $g->GetNombre_radica(), $cmail);
				$contenido_email = str_replace("[elemento]area[/elemento]", $area, $cmail);


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


			$qu = $con->Query("Select email, CONCAT(p_nombre,' ',p_apellido) as nombre from usuarios where correos = '1' and estado = '1'");

			while ($rus = $con->FetchAssoc($qu)) {

				$logo = '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">';

				$g = new MGestion;
				$g->CreateGestion("id", $id);

				$subs = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", " ");
				$area = $c->GetDataFromTable("areas", "id", $g->GetDependencia_destino(), "nombre", " ");

				$MPlantillas_email = new MPlantillas_email;
				$MPlantillas_email->CreatePlantillas_email('id', '31');
				$cmail = $MPlantillas_email->GetContenido();
				$cmail = str_replace("[elemento]LOGO[/elemento]", $logo, $cmail);
				$cmail = str_replace("[elemento]responsable[/elemento]", $rus['nombre'], $cmail);
				$cmail = str_replace("[elemento]USUARIO[/elemento]",$_SESSION['nombre'].' ('.$_SESSION['usuario'].')',$cmail);
				$cmail = str_replace("[elemento]rad_completo[/elemento]", $g->GetMin_rad(), $cmail);
				$cmail = str_replace("[elemento]ASUNTO[/elemento]", $g->GetObservacion(), $cmail);
				$cmail = str_replace("[elemento]origen[/elemento]", "Ventanilla Unica", $cmail);
				$cmail = str_replace("[elemento]Suscriptor[/elemento]", $g->GetNombre_radica(), $cmail);
				$cmail = str_replace("[elemento]area[/elemento]", $area, $cmail);
				$cmail = str_replace("[elemento]sub_Serie[/elemento]", $subs, $cmail);
				$titulo = "Se a creado un nuevo expediente! - ".PROJECTNAME;
				$c->fnEnviaEmailGlobal(CONTACTMAIL, PROJECTNAME, $titulo, $cmail, $rus['email']);

			}


				//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			$condocs = $con->Query("select id from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1'");

			#echo "select id from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1'";

			#echo "select id from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1'";
			$referencia = $con->FetchAssoc($condocs);
			$idref = $con->NumRows($condocs);
/*
			echo "Hola..!";
*/
			#echo "--->".$referencia['id'];

			if ($idref > 0) {

				$checkInsert = $con->Query("select * from meta_referencias_campos where id_referencia = '".$referencia['id']."'");
			#	echo "select * from meta_referencias_campos where id_referencia = '".$referencia['id']."'";
				$smallid = $f->GenerarSmallId();

			#	echo "antes de  while!, ";
				while ($rrrx = $con->FetchAssoc($checkInsert)) {

					$con->Query("INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form, fecha_registro) VALUES ('".$id."', '".$referencia['id']."', '".$rrrx['id']."', '', '".$smallid."', '1', '".date("Y-m-d")."')");

				}

				$grupo_id = $smallid;
			#	exit;
				echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/doBigData/'.$grupo_id.'/'.$id.'/"</script>';

			}else{
				$redirect = $c->GetDataFromTable("plantillas_email", "nombre", "redirect_to", "contenido", "");
				echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/'.$redirect.'/"</script>';

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
			    	
			if ($create) {
		    	$g = new MGestion;
				$g->CreateGestion("id", $id);
			}else{
				echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/anexos/"</script>';
				exit;
			}

	    	$g = new MGestion;
			$g->CreateGestion("id", $id);

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
					$an->InsertGestion_anexos($g->GetId(), $dogc->GetTipologia(), "", $u->GetUser_id(), date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", 		"1", 	$i, 		$i, 		"1", 			$dogc->GetId(), $in_out, "0");

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

			$archivos_adjuntos_ruta = array();
			$noms_adjuntos_ruta = array();
			$qadjuntos = $con->Query("select * from gestion_anexos where gestion_id = '$gestion' and url != ''");
			while ($radt = $con->FetchAssoc($qadjuntos)) {
				$rutanueva = ROOT.DS."archivos_uploads/gestion/".$id.'/anexos/'.$radt['url'];
				array_push($archivos_adjuntos_ruta, $rutanueva);
				array_push($noms_adjuntos_ruta, $radt['nombre']);
			}

			$MUsuarios2 = new MUsuarios;

	    	$MUsuarios2->CreateUsuarios("user_id", $u->GetUser_id());

	    	$username2 = $MUsuarios2->GetP_nombre()." ".$MUsuarios2->GetP_apellido();

	    	$from = $MUsuarios2->GetEmail();


			$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetDependencia_destino(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ")."";

			$NUMRADICACION = "<a href='".HOMEDIR."/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetNum_oficio_respuesta()."</small>)</a>";

			$MUsuarios = new MUsuarios;

	    	$MUsuarios->CreateUsuarios("a_i", $u->GetA_i());

    		$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();

			$oname = UPLOADS.DS.$_SESSION['smallid'].DS;
			$nname = UPLOADS.DS.$g->GetId().DS;

			$con->Query("update meta_big_data set type_id = '".$g->GetId()."', fecha_registro = '".date("Y-m-d")."' where grupo_id = '".$_SESSION['smallid']."'");
			$con->Query("update gestion_anexos set gestion_id = '".$g->GetId()."', is_publico = '1' where id_servicio = '".$_SESSION['smallid']."' and ip = '".$_SERVER['REMOTE_ADDR']."' and gestion_id = '0'");

			if($_SESSION['smallid'] != ''){
				$f->copia($oname, $nname);
				echo "Espere un momento...";
				//unset($_SESSION['smallid']);
				$oname = UPLOADS.DS.$_SESSION['smallid'].DS.'anexos';
				$f->rmDir_rf($oname);
				$oname = UPLOADS.DS.$_SESSION['smallid'].DS.'backup';
				$f->rmDir_rf($oname);
				$oname = UPLOADS.DS.$_SESSION['smallid'];
				$f->rmDir_rf($oname);
				$_SESSION['smallid'] = "";
			}

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

			$qu = $con->Query("Select email, CONCAT(p_nombre,' ',p_apellido) as nombre from usuarios where correos = '1' and estado = '1'");

			while ($rus = $con->FetchAssoc($qu)) {

				$logo = '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">';

				$subs = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", " ");
				$area = $c->GetDataFromTable("areas", "id", $g->GetDependencia_destino(), "nombre", " ");

				$MPlantillas_email = new MPlantillas_email;
				$MPlantillas_email->CreatePlantillas_email('id', '31');
				$cmail = $MPlantillas_email->GetContenido();
				$cmail = str_replace("[elemento]LOGO[/elemento]", $logo, $cmail);
				$cmail = str_replace("[elemento]responsable[/elemento]", $rus['nombre'], $cmail);
				$cmail = str_replace("[elemento]USUARIO[/elemento]",$s->GetNombre().' ('.$sd->GetEmail().')',$cmail);
				$cmail = str_replace("[elemento]rad_completo[/elemento]", $g->GetMin_rad(), $cmail);
				$cmail = str_replace("[elemento]ASUNTO[/elemento]", $g->GetObservacion(), $cmail);
				$cmail = str_replace("[elemento]origen[/elemento]", "Radicacion Web", $cmail);
				$cmail = str_replace("[elemento]Suscriptor[/elemento]", $s->GetNombre(), $cmail);
				$cmail = str_replace("[elemento]area[/elemento]", $area, $cmail);
				$cmail = str_replace("[elemento]sub_Serie[/elemento]", $subs, $cmail);
				$titulo = "Se a creado un nuevo expediente! - ".PROJECTNAME;
				$c->fnEnviaEmailGlobal(CONTACTMAIL, PROJECTNAME, $titulo, $cmail, $rus['email'], $archivos_adjuntos_ruta, $noms_adjuntos_ruta);

			}
			echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/"</script>';
		}


		function RegistroV2($observacion, $observacion2, $tipo_documento){
			global $con;
			global $c;
			global $f;

			$tipo_d = $con->Query("select id, dependencia from dependencias where id = '".$tipo_documento."' ");
			$tipo_dq = $con->FetchAssoc($tipo_d);
			$tipo_documento = $tipo_dq['id'];
			$id_dependencia_raiz = $tipo_dq['dependencia'];

			$u = new MUsuarios;
			if (REGISTROCONTRANSFERENCIA == "1") {
				$u->CreateUsuarios('a_i', $_SESSION['user_ai']);
			}else{
				$u->CreateUsuarios('a_i', $c->sql_quote($_REQUEST['nombre_destino']));
			}

			$se = new MSeccional;
			$se->CreateSeccional("id", $u->GetSeccional());

			$sp = new MSeccional_principal;
			$sp->CreateSeccional_principal("ciudad_origen", $se->GetCiudad());

			$s = new MSuscriptores_contactos;
			$s->CreateSuscriptores_contactos("id", $c->sql_quote($_REQUEST['suscriptor_id']));

			$sd = new MSuscriptores_contactos_direccion;
			$sd->CreateSuscriptores_contactos_direccion("id_contacto", $c->sql_quote($_REQUEST['suscriptor_id']));

			$d = new MDependencias;
			$d->CreateDependencias("id", $tipo_documento);

			$dr = new MDependencias;
			$dr->CreateDependencias("id", $id_dependencia_raiz);

			$a = new MAreas;
			$a->CreateAreas("id", $u->GetRegimen());

			$gs = new MGestion_suscriptores;

			$id_gestion = $c->sql_quote($_REQUEST['id_gestion']);
			$radicado = $c->sql_quote($_REQUEST['radicado']);
			$f_recibido = date("Y-m-d");
			$nombre_radica = $c->sql_quote($_REQUEST['nombre_radica']);
			$folio = "0";
			$dependencia_destino = $c->sql_quote($_REQUEST['dependencia_destino']);;
			$nombre_destino = $u->GetA_i();
			$fecha_vencimiento = "";
			$estado_respuesta = $c->sql_quote($_REQUEST['estado_respuesta']);
			$fecha_respuesta = "";
			$ar = date("Y")."-".$a->GetPrefijo()."-".$dr->GetId_c()."-".$d->GetId_c();
			$num_oficio_respuesta = ($c->sql_quote($_REQUEST['num_oficio_respuesta']) == "" )?$ar:$c->sql_quote($_REQUEST['num_oficio_respuesta']);
			$prioridad = "1";
			$estado_solicitud = "1";
			$suscriptor_id = $s->GetId();
			$ciudad = $se->GetCiudad();
			$usuario_registra = $_SESSION['usuario'];
			$estado_archivo = "1";
			$oficina = $c->sql_quote($_REQUEST['oficina']);;
			$autorad = "SI";
			$dtform = "";
			$documento_salida=$c->sql_quote($_REQUEST['documento_salida']);;
			$salida_servidor = $c->sql_quote($_REQUEST['salida_servidor']);
			$observacion .= " ".$c->sql_quote($_REQUEST['nombresuscriptor']);
			$es_publico = $c->sql_quote($_REQUEST['expediente_publico']);
			$es_publico = ($es_publico == "on")?"1":"0";

			// DEFINIENDO EL OBJETO

			#	exit;

			if ($tipo_documento != "") {
				# code...



				$object = new MGestion;
				#print_r($_REQUEST);
				if($c->sql_quote($_REQUEST['num_oficio_respuesta']) == "" ){
					$nr = $object->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);
				}else{
					$nr = $c->sql_quote($_REQUEST['num_oficio_respuesta']);
				}
				
				$minr = $object->GetMinRadicado($documento_salida);

				

				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA


				if ($id_gestion == "") {
					# code...
					// echo 'going here...';
					$create = $object->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida, "0", $observacion2, "0", $c->sql_quote($_REQUEST['campot1']), $c->sql_quote($_REQUEST['campot2']), $c->sql_quote($_REQUEST['campot3']), $c->sql_quote($_REQUEST['campot4']), $c->sql_quote($_REQUEST['campot5']), $c->sql_quote($_REQUEST['campot6']), $c->sql_quote($_REQUEST['campot7']), $c->sql_quote($_REQUEST['campot8']), $c->sql_quote($_REQUEST['campot9']), $c->sql_quote($_REQUEST['campot10']), $c->sql_quote($_REQUEST['campot11']), $c->sql_quote($_REQUEST['campot12']), $c->sql_quote($_REQUEST['campot13']), $c->sql_quote($_REQUEST['campot14']), $c->sql_quote($_REQUEST['campot15']), "", $es_publico);

					// echo $create;
					$id = $c->GetMaxIdTabla("gestion", "id");
			    	
					if ($create) {
				    	$g = new MGestion;
						$g->CreateGestion("id", $id);
					}else{
						if ($_SESSION['usuario'] != 'sanderkdna@gmail.com') {
							echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/anexos/"</script>';
							exit;
						}else{
							echo 'No se pudo crear el expediente, '.$create;
						}
					}

				}else{



					$id = $id_gestion;

			    	$g = new MGestion;
					$g->CreateGestion("id", $id);

				}

			// if ($_SESSION['usuario'] == 'sanderkdna@gmail.com') {
			// 	echo $id;
			// 	print_r($_REQUEST);
			// 	exit;
			// }
				$folder_id = '0';

				if (CARPETAGENERICA != "") {
					$object = new MGestion_folder;
					// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
					$create = $object->InsertGestion_folder(CARPETAGENERICA, "0", $g->GetId(), $_SESSION['usuario'], date("Y-m-d"), "1", "1");

					$folder_id = $c->GetMaxIdTabla("gestion_folder", "id");
				}


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
						$an->InsertGestion_anexos($g->GetId(), $dogc->GetTipologia(), "", $u->GetUser_id(), date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", 		"1", 	$i, 		$i, 		"1", 			$dogc->GetId(), $in_out, "0");

					}

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

					$NUMRADICACION = "<a href='".HOMEDIR."/gestion/ver/".$g->GetId()."/' target='_blank'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";

					$subs = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", " ");
					$area = $c->GetDataFromTable("areas", "id", $g->GetDependencia_destino(), "nombre", " ");

					$MUsuarios = new MUsuarios;

			    	$MUsuarios->CreateUsuarios("a_i", $c->sql_quote($_REQUEST['nombre_destino']));

		    		$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();



					$MPlantillas_email = new MPlantillas_email;

					$MPlantillas_email->CreatePlantillas_email('id', '10');

					$contenido_email = $MPlantillas_email->GetContenido();

					$contenido_email = str_replace("[elemento]responsable[/elemento]",      $username,     $contenido_email );
					$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $username2,    $contenido_email );
					$contenido_email = str_replace("[elemento]rad_rapido[/elemento]",      $NUMRADICACION,   $contenido_email );
					$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );
					$contenido_email = str_replace("[elemento]Suscriptor[/elemento]", $g->GetNombre_radica(), $cmail);
					$contenido_email = str_replace("[elemento]area[/elemento]", $area, $cmail);


					$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Se le ha compartido el expediente ".$nr,$contenido_email,$MUsuarios->GetEmail());
				}

				$g = new MGestion;
				$g->CreateGestion("id", $id);
				
				$dtform = implode("@|@|@", $c->sql_quote($_REQUEST[dtform]));
				$dtform = explode("@|@|@", $dtform);

				$nombre_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[nombre_destinatario]));
				$nombre_destinatario = explode("@|@|@", $nombre_destinatario);

				$nombre_notificado = implode("@|@|@", $c->sql_quote($_REQUEST[nombre_notificado]));
				$nombre_notificado = explode("@|@|@", $nombre_notificado);

				$tipo_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[tipo_destinatario]));
				$tipo_destinatario = explode("@|@|@", $tipo_destinatario);

				$identificacion_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[identificacion_destinatario]));
				$identificacion_destinatario = explode("@|@|@", $identificacion_destinatario);

				$departamento_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[departamento_destinatario]));
				$departamento_destinatario = explode("@|@|@", $departamento_destinatario);

				$namecity = implode("@|@|@", $c->sql_quote($_REQUEST[namecity]));
				$namecity = explode("@|@|@", $namecity);

				$ciudad_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[ciudad_destinatario]));
				$ciudad_destinatario = explode("@|@|@", $ciudad_destinatario);

				$direccion_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[direccion_destinatario]));
				$direccion_destinatario = explode("@|@|@", $direccion_destinatario);

				$telefono_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[telefono_destinatario]));
				$telefono_destinatario = explode("@|@|@", $telefono_destinatario);

				$email_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[email_destinatario]));
				$email_destinatario = explode("@|@|@", $email_destinatario);

				$es_juridica = implode("@|@|@", $c->sql_quote($_REQUEST[es_juridica]));
				$es_juridica = explode("@|@|@", $es_juridica);

				$titulo = implode("@|@|@", $c->sql_quote($_REQUEST[titulo]));
				$titulo = explode("@|@|@", $titulo);

				$sms = implode("@|@|@", $c->sql_quote($_REQUEST[sms]));
				$sms = explode("@|@|@", $sms);
				#print_r($dtform);

				$idss = "";
				$nsss = "";
				$psid = "";
				for ($i=0; $i < count($nombre_destinatario) ; $i++) {
				#	echo $nombre_destinatario[$i];
					if($nombre_destinatario[$i] != ""){
						
						if ($dtform[$i] != "N") {
							#actualizar suscriptor
					#		echo "ACTUALIZAR SUSCRIPTOR";
							$rsid = $dtform[$i];

							$con->Query("UPDATE suscriptores_contactos set identificacion = '".$identificacion_destinatario[$i]."', nombre = '".$nombre_destinatario[$i]."', type = '".$tipo_destinatario[$i]."' where id='".$rsid."' ");

							$con->Query("UPDATE suscriptores_contactos_direccion set direccion = '".$direccion_destinatario[$i]."', ciudad = '".$namecity[$i]."', telefonos = '".$telefono_destinatario[$i]."', email = '".$email_destinatario[$i]."', natural_juridica = '".$es_juridica[$i]."', municipio = '".$ciudad_destinatario[$i]."', departamento = '".$departamento_destinatario[$i]."' where id_contacto ='".$dtform[$i]."' ");


						}else{
					#		echo "CREAR SUSCRIPTOR";
							$suscrr = new MSuscriptores_contactos;
							$createsuscr = $suscrr->InsertSuscriptores_contactos($identificacion_destinatario[$i], $nombre_destinatario[$i], $tipo_destinatario[$i], $_SESSION['usuario'], date("Y-m-d"), $_SESSION['suscriptor_id']);

							$rsid = $c->GetMaxIdTabla("suscriptores_contactos", "id");

							$suscd = new MSuscriptores_contactos_direccion;
							$suscd->InsertSuscriptores_contactos_direccion($rsid, $direccion_destinatario[$i], $namecity[$i], $telefono_destinatario[$i], $email_destinatario[$i], "", $es_juridica[$i], $ciudad_destinatario[$i], $departamento_destinatario[$i]);
						}

						$gs->InsertGestion_suscriptores($id, $rsid, $u->GetUser_id(), "1", "1", date("Y-m-d"));
						if ($i == 0) {
							$psid = $rsid;
						}
						if ($idss == "") {

							if ($tipo_destinatario[$i] == "26") {
								$idss = $rsid ;
								$nsss = $nombre_destinatario[$i] ;
							}
						}

						if($email_destinatario[$i] != ''){

							$idpsus = 9;
							$objectxsus = new MSuscriptores_contactos;;
							$objectxsus->CreateSuscriptores_contactos("id", $rsid);

							$usuariosus = $objectxsus->GetCod_ingreso();
							$clavesus = $objectxsus->GetDec_pass();

							$MPlantillas_emailsus = new MPlantillas_email;
							$MPlantillas_emailsus->CreatePlantillas_email('id', $idpsus);
							$contenido_emailsus = $MPlantillas_emailsus->GetContenido();
							$contenido_emailsus = str_replace("[elemento]Suscriptor[/elemento]",      $nombre_destinatario[$i],     $contenido_emailsus );
							$contenido_emailsus = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_emailsus );
							$contenido_emailsus = str_replace("[elemento]rad_completo[/elemento]",      $minr,     $contenido_emailsus );
							$contenido_emailsus = str_replace("[elemento]responsable[/elemento]", $_SESSION['nombre'],     	   $contenido_emailsus );
							$contenido_emailsus = str_replace("[elemento]USUARIO[/elemento]",      $usuariosus,   $contenido_emailsus );
							$contenido_emailsus = str_replace("[elemento]CLAVE_USUARIO[/elemento]",      $clavesus,   $contenido_emailsus );
							$contenido_emailsus = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $contenido_emailsus );
							$contenido_emailsus = str_replace("[elemento]observacion[/elemento]",      '',   $contenido_emailsus );
							$contenido_emailsus = str_replace("[elemento]rad_externo[/elemento]",      $minr,   $contenido_emailsus );
							$contenido_emailsus = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_emailsus );

							$exito = $c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_emailsus->GetNombre(),$contenido_emailsus,$email_destinatario[$i]);
							//echo $exito;

						}
						//echo 'correo enviado';
						//exit;

					}

				}

				if ($idss == "") {
					$idss = $psid;
					$nsss = $nombre_destinatario[0] ;
				}

				$con->Query("update gestion set suscriptor_id = '".$idss."', nombre_radica = '".$nsss."' where id = '".$id."' ");

				$archivos_adjuntos_ruta = array();
				$noms_adjuntos_ruta = array();
				$qadjuntos = $con->Query("select * from gestion_anexos where gestion_id = '$id' and url != ''");
				while ($radt = $con->FetchAssoc($qadjuntos)) {
					$rutanueva = ROOT.DS."archivos_uploads/gestion/".$id.'/anexos/'.$radt['url'];
					array_push($archivos_adjuntos_ruta, $rutanueva);
					array_push($noms_adjuntos_ruta, $radt['nombre']);
				}

				$MUsuarios2 = new MUsuarios;

		    	$MUsuarios2->CreateUsuarios("user_id", $u->GetUser_id());

		    	$username2 = $MUsuarios2->GetP_nombre()." ".$MUsuarios2->GetP_apellido();

		    	$from = $MUsuarios2->GetEmail();

				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetDependencia_destino(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ")."";

				$NUMRADICACION = "<a href='".HOMEDIR."/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetNum_oficio_respuesta()."</small>)</a>";

				$MUsuarios = new MUsuarios;

		    	$MUsuarios->CreateUsuarios("a_i", $u->GetA_i());

	    		$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();


	    		$oname = UPLOADS.DS.$_SESSION['smallid'].DS;
				$nname = UPLOADS.DS.$g->GetId().DS;

				$con->Query("update meta_big_data set type_id = '".$g->GetId()."', fecha_registro = '".date("Y-m-d")."' where grupo_id = '".$_SESSION['smallid']."'");
				$con->Query("update gestion_anexos set gestion_id = '".$g->GetId()."', is_publico = '0', folder_id = '".$folder_id ."' where id_servicio = '".$_SESSION['smallid']."' and gestion_id = '0' and ip = '".$_SERVER['REMOTE_ADDR']."'");
				//$con->Query("delete from gestion_anexos where id_servicio = '".$_SESSION['smallid']."' and url = ''");

				if (REGISTROCONTRANSFERENCIA == "1") {
					/*Se realiza transferencia*/
	    			$responsablea = $c->GetDataFromTable("usuarios", "user_id",  $_SESSION['usuario'], "p_nombre, p_apellido", $separador = " ");
	    			$MUsuariost = new MUsuarios;
	    			$MUsuariost->CreateUsuarios("user_id", $_SESSION['usuario']);
	    			if($_REQUEST['nombre_destino'] != $MUsuariost->GetA_i()){
	   					$nombre_destino_old = $MUsuariost->GetA_i();
	    				$nombre_destino = $_REQUEST['nombre_destino'];
	    				$con->Query("UPDATE gestion set transferencia = '1',nombre_destino = '".$nombre_destino_old."' where id = '".$id."' ");
	    				$mtransferencia = new MGestion_transferencias;
	    	    		$mtransferencia->InsertGestion_transferencias($id, $_SESSION['usuario'], $nombre_destino, date("Y-m-d H:i:s"), "", "", "", "0");
	    
	    				$objecte = new MEvents_gestion;
	    				$objecte->InsertEvents_gestion($_SESSION['usuario'], $id, date("Y-m-d"), "Nuevo Expediente Asignado: ".$nr, "El usuario $responsablea le acaba de asignar un expediente debe aceptarlo o rechazarlo", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $nombre_destino_old, "trexp", $id);
	    			}
				}


				if($_SESSION['smallid'] != ''){
					$f->copia($oname, $nname);
					echo "Espere un momento...";
					//unset($_SESSION['smallid']);
					$oname = UPLOADS.DS.$_SESSION['smallid'].DS.'anexos';
					$f->rmDir_rf($oname);
					$oname = UPLOADS.DS.$_SESSION['smallid'].DS.'backup';
					$f->rmDir_rf($oname);
					$oname = UPLOADS.DS.$_SESSION['smallid'];
					$f->rmDir_rf($oname);

					#echo $_SESSION['smallid']." : ";

					#exit;
					$_SESSION['smallid'] = "";
				}

	    		$link = HOMEDIR.DS."s/".$g->GetUri()."/";

				$mensaje = "<p>Un usuario de Notificador Judicial acaba de enviar nuevos correos</p><p><b>Paso 1, Procesar Correspondencia nueva:</b><br><a href='https://s.siammservice.com/cronjob/cron.servicios_SGDEA.php' target='_blank'>https://s.siammservice.com/cronjob/cron.servicios_SGDEA.php</a></p><br><br><p><b>Paso 2, Enviar Correos Electrónicos:</b><br><a href='https://s.siammservice.com/cronjob/cron.vs_acuse_procesamientoemail.php' target='_blank'>https://s.siammservice.com/cronjob/cron.vs_acuse_procesamientoemail.php</a></p>";

				#$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"REGISTRO DE NUEVOS CORREOS",$mensaje,"sander.cadena@laws.com.co");
				#$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"REGISTRO DE NUEVOS CORREOS",$mensaje,"registros@notificadorjudicial.com");


				echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/anexos/"</script>';
			}else{

				$pagina = $this->load_template('Ups! Error');
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();

				include_once(VIEWS.DS.'gestion/error_registro.php');

				$table = ob_get_clean();
				// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
				// CARGAMOS LA PAGINA EN EL BROWSER
				$this->view_page($pagina);


			}
		}


		function InsertarCorrespondencia($observacion, $observacion2, $tipo_documento){
			global $con;
			global $c;
			global $f;
		// CREANDO UN NUEVO MODELO
		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL
		// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			$tipo_d = $con->Query("select id, dependencia from dependencias where id = '".$tipo_documento."' ");
			$tipo_dq = $con->FetchAssoc($tipo_d);
			$tipo_documento = $tipo_dq['id'];
			$id_dependencia_raiz = $tipo_dq['dependencia'];

			$u = new MUsuarios;
			$u->CreateUsuarios('user_id', $_SESSION['usuario']);

			$se = new MSeccional;
			$se->CreateSeccional("id", $u->GetSeccional());

			$sp = new MSeccional_principal;
			$sp->CreateSeccional_principal("ciudad_origen", $se->GetCiudad());

			if ($c->sql_quote($_REQUEST['suscriptor_id']) == "N") {
				echo "<div class='list-group-item'>CREANDO SUSCRIPTOR,</div>";
				$suscrr = new MSuscriptores_contactos;
				$createsuscr = $suscrr->InsertSuscriptores_contactos(rand(0,99999), $c->sql_quote($_REQUEST['nombresuscriptor']), "26", $_SESSION['usuario'], date("Y-m-d"), "0");

				$rsid = $c->GetMaxIdTabla("suscriptores_contactos", "id");

				$suscd = new MSuscriptores_contactos_direccion;
				$suscd->InsertSuscriptores_contactos_direccion($rsid, "", "", "", "", "", "", "", "");

				$s = new MSuscriptores_contactos;
				$s->CreateSuscriptores_contactos("id", $rsid);

			}else{
				$s = new MSuscriptores_contactos;
				$s->CreateSuscriptores_contactos("id", $c->sql_quote($_REQUEST['suscriptor_id']));
			}

			$sd = new MSuscriptores_contactos_direccion;
			$sd->CreateSuscriptores_contactos_direccion("id_contacto", $c->sql_quote($_REQUEST['suscriptor_id']));

			$d = new MDependencias;
			$d->CreateDependencias("id", $tipo_documento);

			$dr = new MDependencias;
			$dr->CreateDependencias("id", $id_dependencia_raiz);

			$a = new MAreas;
			$a->CreateAreas("id", $u->GetRegimen());

			$id_gestion = $c->sql_quote($_REQUEST['id_gestion']);
			$radicado = $c->sql_quote($_REQUEST['radicado']);
			$f_recibido = date("Y-m-d");
			$nombre_radica = $c->sql_quote($_REQUEST['nombre_radica']);
			$folio = "0";
			$dependencia_destino = $u->GetRegimen();
			$nombre_destino = $u->GetA_i();
			$fecha_vencimiento = "";
			$estado_respuesta = $c->sql_quote($_REQUEST['estado_respuesta']);
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
			$salida_servidor = $c->sql_quote($_REQUEST['salida_servidor']);
			$observacion .= " ";
			$observacion2 = $c->sql_quote($_REQUEST['observacion2']);
			// DEFINIENDO EL OBJETO

			#print_r($_REQUEST);
			#exit;
			#	exit;
			if ($tipo_documento == "") {
				if($_REQUEST['notif_tipo_documento'] == "Correspondencia Certificada"){
					$tipo_documento = "14";
				}else{
					$tipo_documento = "2";
				}
			}
			#echo "->".$tipo_documento."<br>";
			if ($tipo_documento != "") {
				$pagina = $this->load_template_limpiaAmpleNoPreLoad(PROJECTNAME.ST." Enviando Correspondencia...");
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();
				
				echo '<div class="row m-t-20">
						<div class="col-md-12 panel">
		 					<div class="white-panel">
		 						<div class="row">
		 							<div class="col-md-12 p-30">
		 								<div class="list-group">';


				$object = new MGestion;
				#print_r($_REQUEST);
				$nr = $object->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);
				$minr = $object->GetMinRadicado();

				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA


				if ($id_gestion == "") {
					# code...

					$create = $object->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida, "0", $observacion2, "0", $c->sql_quote($_REQUEST['campot1']), $c->sql_quote($_REQUEST['campot2']), $c->sql_quote($_REQUEST['campot3']), $c->sql_quote($_REQUEST['campot4']), $c->sql_quote($_REQUEST['campot5']), $c->sql_quote($_REQUEST['campot6']), $c->sql_quote($_REQUEST['campot7']), $c->sql_quote($_REQUEST['campot8']), $c->sql_quote($_REQUEST['campot9']), $c->sql_quote($_REQUEST['campot10']), $c->sql_quote($_REQUEST['campot11']), $c->sql_quote($_REQUEST['campot12']), $c->sql_quote($_REQUEST['campot13']), $c->sql_quote($_REQUEST['campot14']), $c->sql_quote($_REQUEST['campot15']));

					$id = $c->GetMaxIdTabla("gestion", "id");

			    	$g = new MGestion;
					$g->CreateGestion("id", $id);

				}else{


					$id = $id_gestion;

			    	$g = new MGestion;
					$g->CreateGestion("id", $id);

					$con->Query("UPDATE gestion set 
											radicado  = '".$radicado."',
											observacion  = '".$observacion."',
											observacion2 = '".$observacion2."',
											suscriptor_id= '".$c->sql_quote($_REQUEST['suscriptor_id'])."',
											campot1      = '".$c->sql_quote($_REQUEST['campot1'])."',
											campot2  	 = '".$c->sql_quote($_REQUEST['campot2'])."',
											campot3  	 = '".$c->sql_quote($_REQUEST['campot3'])."',
											campot4  	 = '".$c->sql_quote($_REQUEST['campot4'])."',
											campot5  	 = '".$c->sql_quote($_REQUEST['campot5'])."',
											campot6  	 = '".$c->sql_quote($_REQUEST['campot6'])."',
											campot7  	 = '".$c->sql_quote($_REQUEST['campot7'])."',
											campot8  	 = '".$c->sql_quote($_REQUEST['campot8'])."',
											campot9  	 = '".$c->sql_quote($_REQUEST['campot9'])."',
											campot10  	 = '".$c->sql_quote($_REQUEST['campot10'])."',
											campot11  	 = '".$c->sql_quote($_REQUEST['campot11'])."',
											campot12  	 = '".$c->sql_quote($_REQUEST['campot12'])."',
											campot13  	 = '".$c->sql_quote($_REQUEST['campot13'])."',
											campot14 	 = '".$c->sql_quote($_REQUEST['campot14'])."',
											campot15 	 = '".$c->sql_quote($_REQUEST['campot15'])."'
										where id='".$id."' ");

				}


				$qts = $con->Query("select count(*) as t from gestion_suscriptores where id_gestion = '".$g->GetId()."' and id_suscriptor = '".$s->GetId()."' ");
				$tqts = $con->FetchAssoc($qts);
				if ($tqts['t'] == "0") {
					$gs = new MGestion_suscriptores;
					$gs->InsertGestion_suscriptores($g->GetId(), $s->GetId(), $u->GetUser_id(), "1", "1", date("Y-m-d"));
					# code...
				}



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
						$an->InsertGestion_anexos($g->GetId(), $dogc->GetTipologia(), "", $u->GetUser_id(), date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", 		"1", 	$i, 		$i, 		"1", 			$dogc->GetId(), $in_out, "0");

					}

				}

				$dtform = implode("@|@|@", $c->sql_quote($_REQUEST[dtform]));
				$dtform = explode("@|@|@", $dtform);

				$nombre_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[nombre_destinatario]));
				$nombre_destinatario = explode("@|@|@", $nombre_destinatario);

				$nombre_notificado = implode("@|@|@", $c->sql_quote($_REQUEST[nombre_notificado]));
				$nombre_notificado = explode("@|@|@", $nombre_notificado);

				$tipo_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[tipo_destinatario]));
				$tipo_destinatario = explode("@|@|@", $tipo_destinatario);

				$identificacion_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[identificacion_destinatario]));
				$identificacion_destinatario = explode("@|@|@", $identificacion_destinatario);

				$departamento_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[departamento_destinatario]));
				$departamento_destinatario = explode("@|@|@", $departamento_destinatario);

				$namecity = implode("@|@|@", $c->sql_quote($_REQUEST[namecity]));
				$namecity = explode("@|@|@", $namecity);

				$ciudad_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[ciudad_destinatario]));
				$ciudad_destinatario = explode("@|@|@", $ciudad_destinatario);

				$direccion_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[direccion_destinatario]));
				$direccion_destinatario = explode("@|@|@", $direccion_destinatario);

				$telefono_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[telefono_destinatario]));
				$telefono_destinatario = explode("@|@|@", $telefono_destinatario);

				$email_destinatario = implode("@|@|@", $c->sql_quote($_REQUEST[email_destinatario]));
				$email_destinatario = explode("@|@|@", $email_destinatario);

				$es_juridica = implode("@|@|@", $c->sql_quote($_REQUEST[es_juridica]));
				$es_juridica = explode("@|@|@", $es_juridica);

				$titulo = implode("@|@|@", $c->sql_quote($_REQUEST[titulo]));
				$titulo = explode("@|@|@", $titulo);

				$sms = implode("@|@|@", $c->sql_quote($_REQUEST[sms]));
				$sms = explode("@|@|@", $sms);
				#print_r($dtform);

				$con->Query("update gestion_anexos set gestion_id = '".$g->GetId()."', is_publico = '0' where id_servicio = '".$_SESSION['smallid']."' and gestion_id = '0' and ip = '".$_SERVER['REMOTE_ADDR']."'");


				$oname = UPLOADS.DS.$_SESSION['smallid'].DS;
				$nname = UPLOADS.DS.$g->GetId().DS;

				if($_SESSION['smallid'] != ''){
					$f->copia($oname, $nname);
					echo "<div class='list-group-item'>Actualizando Archivos Espere un momento... </div>";
				}

				//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
				$sq = $con->Query("select * from gestion_anexos where id_servicio = '".$_SESSION['smallid']."' and url != '' ");

				$demandantes_nombre = "";
				$demandados_nombres = "";
				$qsuscriptt = $con->Query("select sc.nombre, sc.type from gestion_suscriptores as gs inner join suscriptores_contactos sc on sc.id = gs.id_suscriptor where id_gestion = '$id'");

				while ($rsust = $con->FetchAssoc($qsuscriptt)) {
					# code...
					if ($rsust['type'] == "26") {
						$demandantes_nombre .= $rsust['nombre']."<br>";
					}

					if ($rsust['type'] == "27") {
						$demandados_nombres .= $rsust['nombre']."<br>";
					}
				}
				

				for ($i=0; $i < count($nombre_destinatario) ; $i++) {
					if($nombre_destinatario[$i] != ""){
						$gs = new MGestion_suscriptores;
						if ($dtform[$i] != "N") {
							# actualizar suscriptor
							echo "<div class='list-group-item'>ACTUALIZAR SUSCRIPTOR, ".$nombre_destinatario[$i]."</div>";
							$rsid = $dtform[$i];

							$con->Query("UPDATE suscriptores_contactos set identificacion = '".$identificacion_destinatario[$i]."', nombre = '".$nombre_destinatario[$i]."', type = '".$tipo_destinatario[$i]."' where id='".$rsid."' ");

							$con->Query("UPDATE suscriptores_contactos_direccion set direccion = '".$direccion_destinatario[$i]."', ciudad = '".$namecity[$i]."', telefonos = '".$telefono_destinatario[$i]."', email = '".$email_destinatario[$i]."', natural_juridica = '".$es_juridica[$i]."', municipio = '".$ciudad_destinatario[$i]."', departamento = '".$departamento_destinatario[$i]."' where id_contacto ='".$dtform[$i]."' ");

						}else{
							echo "<div class='list-group-item'>CREANDO SUSCRIPTOR, ".$nombre_destinatario[$i]."</div>";
							$suscrr = new MSuscriptores_contactos;
							$createsuscr = $suscrr->InsertSuscriptores_contactos($identificacion_destinatario[$i], $nombre_destinatario[$i], $tipo_destinatario[$i], $_SESSION['usuario'], date("Y-m-d"), $_SESSION['suscriptor_id']);

							$rsid = $c->GetMaxIdTabla("suscriptores_contactos", "id");

							$suscd = new MSuscriptores_contactos_direccion;
							$suscd->InsertSuscriptores_contactos_direccion($rsid, $direccion_destinatario[$i], $namecity[$i], $telefono_destinatario[$i], $email_destinatario[$i], "", $es_juridica[$i], $ciudad_destinatario[$i], $departamento_destinatario[$i]);
						}

						$gs->InsertGestion_suscriptores($id, $rsid, $u->GetUser_id(), "1", "1", date("Y-m-d"));
						#echo $_SESSION['smallid'];

						if ($titulo[$i] == "SMS") {

							echo "<div class='list-group-item'>Envio notificacion por SMS! </div>";

							$nt = $titulo[$i];
							$tm = $telefono_destinatario[0];

							$remitente = $c->sql_quote($_REQUEST['nombresuscriptor']);
							$user_id = $_SESSION['usuario'];


							if ($remitente == "") {
								$remitente = $u->GetP_nombre()." ".$u->GetP_apellido();
							}

							$demandado = $direccion_destinatario[0]." ".$namecity[0]." / ".$telefono_destinatario[0];
							#echo $demandado;

							$max = $c->GetMaxIdTabla("notificaciones", "id");
							$max += 1;

							if ($sms[$i] == "SI") {

								$max = $c->GetMaxIdTabla("notificaciones", "id");
								$max += 1;
								$observacionSMS = MENSAJEDETEXTO." ".HOMEDIR."/s/sms/".$max."/";

								$smsenviado = $f->EnviarSMS($telefono_destinatario[$i], $observacionSMS);
								echo "<div class='list-group-item'>Enviando mensaje a ".$telefono_destinatario[$i]." con mensaje $observacionSMS </div>";
							}

							$tnot = "";
							if($_REQUEST['notif_tipo_documento'] == "Correspondencia Certificada"){
								$tnot = "CC";
							}else{
								$tnot = "NJ";
							}

							$object = new MNotificaciones;
							$guia = $c->GetIdRecursivoTabla("guia_id","notificaciones","");
							// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
							$create = $object->InsertNotificaciones($_SESSION['usuario'], $id, $rsid, $nt, $_REQUEST['spostal'], date("Y-m-d"), $tnot, '', $tm, $_REQUEST['campot8'], '', $guia, $nombre_destinatario[$i], $rsid, $observacionSMS, $telefono_destinatario[$i], "0", $sms[$i], $smsenviado, $nombre_notificado[$i], $_REQUEST['responsble_firma']);

							$max = $create; #$c->GetMaxIdTabla("notificaciones", "id");
							$ufirma = new MUsuarios;
							$ufirma->CreateUsuarios("user_id", $_REQUEST['responsble_firma']);

							$datoenvio = [];
							$datoenvio['files'] = [];
							$datoenvio['data'] = $_REQUEST;
							$datoenvio['data_destinatario'] = array('nombre_destinatario'=>$nombre_destinatario[$i], 'nombre_demandado' => $nombre_notificado[$i]  , 'identificacion_destinatario'=>$identificacion_destinatario[$i], 'direccion_destinatario'=>$direccion_destinatario[$i], 'ciudad_destinatario'=>$ciudad_destinatario[$i], 'telefono_destinatario'=>$telefono_destinatario[$i], 'email_destinatario'=>$email_destino, 'es_juridica'=>$es_juridica[$i], 'GetSeccional_siamm'=>$ufirma->GetSeccional_siamm(), 'titulo'=>$nt, 'nombre_abogado' => $ufirma->GetP_nombre()." ".$ufirma->GetP_apellido() , 'email_abogado' => $ufirma->GetEmail(), 'cedula_abogado' => $ufirma->GetCedula(), 'tarjeta_profesional_abogado' => $ufirma->GetUniversidad(), 'cargo_abogado' => $ufirma->GetT_profesional(), "firma_abogado" => $ufirma->GetFirma());


							$servicios = implode(',', $_REQUEST['servicios2']);
							$listaservicios = explode(",", $servicios);

							#print_r($listaservicios);
							for ($kj=0; $kj <  count($listaservicios) ; $kj++) { 
								if ($listaservicios[$kj] != "") {
									# code...
									$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado, type) VALUES ('".$max."','".$listaservicios[$kj]."','".date("Y-m-d H:i:s")."','0','0')");

									$ga = new MGestion_anexos;
									$ga->CreateGestion_anexos("id", $listaservicios[$k]);
								}
							}

							$servicios = implode(',', $_REQUEST['servicio']);
							$listaservicios = explode(",", $servicios);

							for ($kj=0; $kj <  count($listaservicios) ; $kj++) { 
								if ($listaservicios[$kj] != "") {
									# code...
									$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado, type) VALUES ('".$max."','".$listaservicios[$kj]."','".date("Y-m-d H:i:s")."','0','0')");
								}

							}

						
						

							#CODIGO PARA ENVIO DE CORREOS POR PLATAFORMA PROPIA
							if($c->sql_quote($_REQUEST['notif_tipo_documento']) == "Correspondencia Certificada"){

								$MPlantillas_email = new MPlantillas_email;
								//$MPlantillas_email->CreatePlantillas_email('id', '71');
								$MPlantillas_email->CreatePlantillas_email('id', '74');
								$emailMessage = $MPlantillas_email->GetContenido();

							}else{

								$MPlantillas_email = new MPlantillas_email;
								//$MPlantillas_email->CreatePlantillas_email('id', '70');
								
								$MPlantillas_email->CreatePlantillas_email('id', '76');
								/*if ($_SESSION['usuario'] == 'info@laws.com.co') {
								}else{
									$MPlantillas_email->CreatePlantillas_email('id', '73');
								}*/
								$emailMessage = $MPlantillas_email->GetContenido();

							}

							$em = new MSuper_admin;
							$em->CreateSuper_admin("id", $_SESSION['id_empresa']);


							$rp = new MMailer_replys;
							$message_id .= $tm.$_SERVER['REMOTE_ADDR'].date("Y-m-d H:i:s").$max;
							$message_id = md5($message_id);
							$message_id = hash ("sha256", $message_id);
							$token = $message_id;

							$logo = $c->getLogo();

							if (LOGOCORREO == "G") {
								$logo = $c->getLogo();
							}else{
								if ($u->Getlogo_correos() == "") {
									$logo = $c->getLogo();
								}else{
									$logo = $u->Getlogo_correos();
								}
							}

							$diasc = array("2" => "Dos", "5" => "Cinco", "10" => "Diez", "30" => "Treinta");
							$dias_comparecer_letras = $diasc[$c->sql_quote($_REQUEST['campot8'])];
							$dias_comparecer_numero = $c->sql_quote($_REQUEST['campot8']);

							$recibir = $f->MakeButtonMail(HOMEDIR.DS.'s'.DS.'acuse'.DS.$token.'.1'.DS, "Ver Contenido del mensaje");
							$norecibir = $f->MakeButtonMail(HOMEDIR.DS.'s'.DS.'acuse'.DS.$token.'.2'.DS, "Rehusarse");

							$emailMessage = str_replace("[elemento]Fecha_registro[/elemento]", date("d-m-Y h:i:s a"),$emailMessage );
							$emailMessage = str_replace("[elemento]ASUNTO[/elemento]",      $observacion,   $emailMessage );
							$emailMessage = str_replace("[elemento]OBSERVACION2[/elemento]",      $observacion2,   $emailMessage );
							$emailMessage = str_replace("[elemento]responsable[/elemento]", $_SESSION['nombre'],  $emailMessage );
							$emailMessage = str_replace("[elemento]destinatario[/elemento]", $nombre_destinatario[$i], $emailMessage );
							$emailMessage = str_replace("[elemento]email_destinatario[/elemento]", $email_destino, $emailMessage );
							$emailMessage = str_replace("[elemento]direccion_destinatario[/elemento]", $direccion_destinatario[$i], $emailMessage );
							$emailMessage = str_replace("[elemento]identificacion_destinatario[/elemento]", $identificacion_destinatario[$i], $emailMessage );
							$emailMessage = str_replace("[elemento]GUIA[/elemento]", substr($guia, 0, 20), $emailMessage );
							$emailMessage = str_replace("[elemento]demandado[/elemento]", $c->sql_quote($_REQUEST['demandados_nombres']),  $emailMessage );
							$emailMessage = str_replace("[elemento]demandante[/elemento]", $c->sql_quote($_REQUEST['nombresuscriptor']),  $emailMessage );
							$emailMessage = str_replace("[elemento]BOTON_NORECIBIR[/elemento]",      $recibir,   $emailMessage );
							$emailMessage = str_replace("[elemento]BOTON_RECIBIR[/elemento]",      $norecibir,   $emailMessage );
							$emailMessage = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$logo.'" width="150px">',   $emailMessage );
							$emailMessage = str_replace("[elemento]LOGOCOURRIER[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$em->Getlogo_courrier().'" width="150px">',   $emailMessage );										
							$emailMessage = str_replace("[elemento]observacion[/elemento]",      $observacion,   $emailMessage );
							$emailMessage = str_replace("[elemento]rad_externo[/elemento]",      $radicado,   $emailMessage );
							$emailMessage = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $emailMessage );
							$emailMessage = str_replace("[elemento]TOKEN[/elemento]",      $message_id,   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT1[/elemento]", $c->sql_quote($_REQUEST['campot1']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT2[/elemento]", $c->sql_quote($_REQUEST['campot2']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT3[/elemento]", $c->sql_quote($_REQUEST['campot3']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT4[/elemento]", $c->sql_quote($_REQUEST['campot4']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT5[/elemento]", $c->sql_quote($_REQUEST['campot5']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT6[/elemento]", $c->sql_quote($_REQUEST['campot6']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT7[/elemento]", $c->sql_quote($_REQUEST['campot7']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT8[/elemento]", $dias_comparecer_numero,   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT8L[/elemento]", $dias_comparecer_letras,   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT9[/elemento]", $c->sql_quote($_REQUEST['campot9']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT10[/elemento]", $c->sql_quote($_REQUEST['campot10']),   $emailMessage );

							$fecha_providencia = $c->sql_quote($_REQUEST['campot11']);
							if ($c->sql_quote($_REQUEST['campot12']) != "") {
								$fecha_providencia .= " <br> ".$c->sql_quote($_REQUEST['campot12']);
							}
							if ($c->sql_quote($_REQUEST['campot13']) != "") {
								$fecha_providencia .= " <br> ".$c->sql_quote($_REQUEST['campot13']);
							}
							$emailMessage = str_replace("[elemento]CAMPOT11[/elemento]", $fecha_providencia,   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT12[/elemento]", $c->sql_quote($_REQUEST['campot12']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT13[/elemento]", $c->sql_quote($_REQUEST['campot13']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT14[/elemento]", $c->sql_quote($_REQUEST['campot14']),   $emailMessage );
							$emailMessage = str_replace("[elemento]CAMPOT15[/elemento]", $c->sql_quote($_REQUEST['campot15']),   $emailMessage );


							$firmausuario = "Nombre: ".$ufirma->GetP_nombre()." ".$ufirma->GetP_apellido()."<br>Correo Electr&oacute;nico: ".$ufirma->GetEmail()."<br>Tel&eacute;fono: ".$ufirma->GetCelular()."<br>T.P.: ".$ufirma->GetUniversidad();

							$emailMessage = str_replace("[elemento]firmausuario[/elemento]", $firmausuario,   $emailMessage );

				#CODIGO PARA ENVIO DE CORREOS POR PLATAFORMA PROPIA
							if($c->sql_quote($_REQUEST['notif_tipo_documento']) != "Correspondencia Certificada"){

								// $this->CrearDocumentoNotificacion($emailMessage, $id, $nombre_destinatario[$i], $max);

							}
							if ($sms[$i] == "SI") {
								echo "<div class='list-group-item'>";
								$this->ExportarCorreoSMS($max);
								echo '</div>';
							}
				# /*
							$BOTON_ADJUNTOS ='<ul style="list-style: none;margin-left: 0px;padding-left: 0px;">';
							$qan = $con->Query("select * from notificaciones_attachments where id_notificacion = '".$max."' and type='0'");
				            $iii = 0;
				            $ruta_adjuntos = array();
				            $ruta_documentos = array();
				            while ($rowan = $con->FetchAssoc($qan)) {

				                $iii++;

				                $ga = new MGestion_anexos;
				                $ga->CreateGestion_anexos("id", $rowan['id_anexo']);

				                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";
				                $ruta2 = ROOT.DS."/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";

				                $rext = explode(".", $ga->GetUrl());
				                $rext = end($rext);

				                $rnam = explode(".", $ga->GetNombre());
				                $rnam = end($rnam);

				                //array_push($ruta_adjuntos, $ruta2);
								//array_push($ruta_documentos, $ga->GetNombre());

								if ($c->sql_quote($_REQUEST['cotejar']) == "SI") {
									
									$rutanueva = ROOT.DS."archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();
									#echo "$this->CotejarDocumento(".$ga->GetGestion_id().", ".$ga->GetId().", ".$rutanueva.", ".$ga->GetNombre().",  ".$guia.");";
									#exit;
									$this->CotejarDocumento($ga->GetGestion_id(), $ga->GetId(), $rutanueva, $ga->GetNombre(), $guia);

								}

				                $ext = "";
				                if ($rext != $rnam) {
				                	$ext = $rext;
				                }

				                $BOTON_ADJUNTOS .= "<li class='list-group-item' style = 'list-style: none; border: 1px solid #CCC; padding: 10px;border-radius: 5px; margin-bottom: 5px;'>
				                			<a href='".HOMEDIR."/s/descarganotificacioncorreo/".$ga->GetGestion_id()."/".$ga->GetUrl()."/".$ga->GetNombre().'.'.$ext."/".$rowan['id']."/' style='font-weight: bold;'>".$ga->GetNombre()."</a>
				                		</li>";
				            }
				            $BOTON_ADJUNTOS .= "</ul>";

						}else{

						#ENVIO DE NOTIFICACIÓN O GENERACIÓN DE NOTIFICACIONES
						#	"CC"
						#	"CE"
						#	"CC/CE"
							$vdestinatarios = explode(";", $email_destinatario[$i]);

							for ($ll=0; $ll < count($vdestinatarios) ; $ll++) { 

								$email_destino = trim($vdestinatarios[$ll]);

								if ($sms[$i] == "SI") {
									if ($ll != 0) {
										$sms[$i] = "NO";
									}
								}
							
								$it = "";
								$nt = "";
								$tm = "";
								if ($titulo[$i] == "CC/CE") {
									$it = "2";
								}else{
									$nt = $titulo[$i];
									$it = "1";
								}

								for ($k=0; $k < $it ; $k++) {
									if ($titulo[$i] == "CC/CE") {
										if ($k == "0") {
											$nt = "CC";
										}else{
											$nt = "CE";
										}
									}else{
										$nt = $titulo[$i];
									}

									if ($nt == "CC") {
										$tm = $direccion_destinatario[$i];
									}else{
										$tm =  $email_destino;
									}

									$remitente = $c->sql_quote($_REQUEST['nombresuscriptor']);
									$user_id = $_SESSION['usuario'];


									if ($remitente == "") {
										$remitente = $u->GetP_nombre()." ".$u->GetP_apellido();
									}

									$demandado = $direccion_destinatario[0]." ".$namecity[0]." / ".$telefono_destinatario[0];
									#echo $demandado;

									$max = $c->GetMaxIdTabla("notificaciones", "id");
									$max += 1;

									if ($sms[$i] == "SI") {

										$max = $c->GetMaxIdTabla("notificaciones", "id");
										$max += 1;
										$observacionSMS = MENSAJEDETEXTO." ".HOMEDIR."/s/sms/".$max."/";

										if ($nt == "CE") {
											$smsenviado = $f->EnviarSMS($telefono_destinatario[$i], $observacionSMS);
											echo "<div class='list-group-item'>Enviando mensaje a ".$telefono_destinatario[$i]." con mensaje $observacionSMS </div>";
										}

									}else{
										$sms[$i] = "NO";
										$smsenviado = "0";
									}
									#exit;
									$tnot = "";
									if($_REQUEST['notif_tipo_documento'] == "Correspondencia Certificada"){

										$tnot = "CC";

									}else{

										$tnot = "NJ";

									}

									$object = new MNotificaciones;
									$guia = $c->GetIdRecursivoTabla("guia_id","notificaciones","");
									// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
									$create = $object->InsertNotificaciones($_SESSION['usuario'], $id, $rsid, $nt, $_REQUEST['spostal'], date("Y-m-d"), $tnot, '', $tm, $_REQUEST['campot8'], '', $guia, $nombre_destinatario[$i], $rsid, $observacionSMS, $telefono_destinatario[$i], "0", $sms[$i], $smsenviado, $nombre_notificado[$i], $_REQUEST['responsble_firma']);


									$max = $create; #$c->GetMaxIdTabla("notificaciones", "id");
									$ufirma = new MUsuarios;
									$ufirma->CreateUsuarios("user_id", $_REQUEST['responsble_firma']);



									$datoenvio = [];
									$datoenvio['files'] = [];
									$datoenvio['data'] = $_REQUEST;
									$datoenvio['data_destinatario'] = array('nombre_destinatario'=>$nombre_destinatario[$i], 'nombre_demandado' => $nombre_notificado[$i]  , 'identificacion_destinatario'=>$identificacion_destinatario[$i], 'direccion_destinatario'=>$direccion_destinatario[$i], 'ciudad_destinatario'=>$ciudad_destinatario[$i], 'telefono_destinatario'=>$telefono_destinatario[$i], 'email_destinatario'=>$email_destino, 'es_juridica'=>$es_juridica[$i], 'GetSeccional_siamm'=>$ufirma->GetSeccional_siamm(), 'titulo'=>$nt, 'nombre_abogado' => $ufirma->GetP_nombre()." ".$ufirma->GetP_apellido() , 'email_abogado' => $ufirma->GetEmail(), 'cedula_abogado' => $ufirma->GetCedula(), 'tarjeta_profesional_abogado' => $ufirma->GetUniversidad(), 'cargo_abogado' => $ufirma->GetT_profesional(), "firma_abogado" => $ufirma->GetFirma());


									$servicios = implode(',', $_REQUEST['servicios2']);
									$listaservicios = explode(",", $servicios);

									#print_r($listaservicios);
									for ($kj=0; $kj <  count($listaservicios) ; $kj++) { 
										if ($listaservicios[$kj] != "") {
											# code...
											$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado, type) VALUES ('".$max."','".$listaservicios[$kj]."','".date("Y-m-d H:i:s")."','0','0')");

											$ga = new MGestion_anexos;
											$ga->CreateGestion_anexos("id", $listaservicios[$k]);

											#$c->SendContabilizadorDocumentos($ga->GetCantidad(), $g->GetTipo_documento(), $g->GetId(), "NT");	

											//$rutaDoc = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";
											$rutaDoc = UPLOADS.DS.$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
											//$b64Doc = chunk_split(base64_encode(file_get_contents($rutaDoc)));
											$b64Doc = (base64_encode(file_get_contents($rutaDoc)));
											#echo "<br>";
											$nombreDoc = $ga->GetNombre();
											$ce = explode('.',$nombreDoc);
											if(count($ce) <= 1){
												$ac = explode('.',$ga->GetUrl());
												$ext = end($ac);
												$nombreDoc = $nombreDoc.'.'.$ext;
											}
										#	if($b64Doc != ''){
										#		$datoenvio['files'][] = [$nombreDoc,$b64Doc];
										#	}else{
										#		echo "Error Procesar los archivos: 1940 ";
										#		exit;
										#	}
										}

									}

									

									$servicios = implode(',', $_REQUEST['servicio']);
									$listaservicios = explode(",", $servicios);

									#print_r($listaservicios);
									for ($kj=0; $kj <  count($listaservicios) ; $kj++) { 
										if ($listaservicios[$kj] != "") {
											# code...
											$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado, type) VALUES ('".$max."','".$listaservicios[$kj]."','".date("Y-m-d H:i:s")."','0','0')");

											$ga = new MGestion_anexos;
											$ga->CreateGestion_anexos("id", $listaservicios[$k]);

											#$c->SendContabilizadorDocumentos($ga->GetCantidad(), $g->GetTipo_documento(), $g->GetId(), "NT");	

											//$rutaDoc = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";
											$rutaDoc = UPLOADS.DS.$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
											//$b64Doc = chunk_split(base64_encode(file_get_contents($rutaDoc)));
											$b64Doc = (base64_encode(file_get_contents($rutaDoc)));
											#echo "<br>";
											$nombreDoc = $ga->GetNombre();
											$ce = explode('.',$nombreDoc);
											if(count($ce) <= 1){
												$ac = explode('.',$ga->GetUrl());
												$ext = end($ac);
												$nombreDoc = $nombreDoc.'.'.$ext;
											}
										#	if($b64Doc != ''){
										#		$datoenvio['files'][] = [$nombreDoc,$b64Doc];
										#	}else{
										#		echo "Error Procesar los archivos: 1940 ";
										#		exit;
										#	}
										}

									}
								

									if ($nt == "CE") {
										#CODIGO PARA ENVIO DE CORREOS POR PLATAFORMA PROPIA
										if($c->sql_quote($_REQUEST['notif_tipo_documento']) == "Correspondencia Certificada"){

											$MPlantillas_email = new MPlantillas_email;
											//$MPlantillas_email->CreatePlantillas_email('id', '71');
											$MPlantillas_email->CreatePlantillas_email('id', '74');
											$emailMessage = $MPlantillas_email->GetContenido();

										}else{

											$MPlantillas_email = new MPlantillas_email;
											//$MPlantillas_email->CreatePlantillas_email('id', '70');
											
											$MPlantillas_email->CreatePlantillas_email('id', '76');
											/*if ($_SESSION['usuario'] == 'info@laws.com.co') {
											}else{
												$MPlantillas_email->CreatePlantillas_email('id', '73');
											}*/
											$emailMessage = $MPlantillas_email->GetContenido();

										}

										$em = new MSuper_admin;
										$em->CreateSuper_admin("id", $_SESSION['id_empresa']);


										$rp = new MMailer_replys;
										$message_id .= $tm.$_SERVER['REMOTE_ADDR'].date("Y-m-d H:i:s").$max;
										$message_id = md5($message_id);
										$message_id = hash ("sha256", $message_id);
										$token = $message_id;

										$logo = $c->getLogo();

										if (LOGOCORREO == "G") {
											$logo = $c->getLogo();
										}else{
											if ($u->Getlogo_correos() == "") {
												$logo = $c->getLogo();
											}else{
												$logo = $u->Getlogo_correos();
											}
										}

										$diasc = array("2" => "Dos", "5" => "Cinco", "10" => "Diez", "30" => "Treinta");
										$dias_comparecer_letras = $diasc[$c->sql_quote($_REQUEST['campot8'])];
										$dias_comparecer_numero = $c->sql_quote($_REQUEST['campot8']);

										$recibir = $f->MakeButtonMail(HOMEDIR.DS.'s'.DS.'acuse'.DS.$token.'.1'.DS, "Ver Contenido del mensaje");
										$norecibir = $f->MakeButtonMail(HOMEDIR.DS.'s'.DS.'acuse'.DS.$token.'.2'.DS, "Rehusarse");

										$emailMessage = str_replace("[elemento]Fecha_registro[/elemento]", date("d-m-Y h:i:s a"),$emailMessage );
										$emailMessage = str_replace("[elemento]ASUNTO[/elemento]",      $observacion,   $emailMessage );
										$emailMessage = str_replace("[elemento]OBSERVACION2[/elemento]",      $observacion2,   $emailMessage );
										$emailMessage = str_replace("[elemento]responsable[/elemento]", $_SESSION['nombre'],  $emailMessage );
										$emailMessage = str_replace("[elemento]destinatario[/elemento]", $nombre_destinatario[$i], $emailMessage );
										$emailMessage = str_replace("[elemento]email_destinatario[/elemento]", $email_destino, $emailMessage );
										$emailMessage = str_replace("[elemento]direccion_destinatario[/elemento]", $direccion_destinatario[$i], $emailMessage );
										$emailMessage = str_replace("[elemento]identificacion_destinatario[/elemento]", $identificacion_destinatario[$i], $emailMessage );
										$emailMessage = str_replace("[elemento]GUIA[/elemento]", substr($guia, 0, 20), $emailMessage );
										$emailMessage = str_replace("[elemento]demandado[/elemento]", $c->sql_quote($_REQUEST['demandados_nombres']),  $emailMessage );
										$emailMessage = str_replace("[elemento]demandante[/elemento]", $c->sql_quote($_REQUEST['nombresuscriptor']),  $emailMessage );
										$emailMessage = str_replace("[elemento]BOTON_NORECIBIR[/elemento]",      $recibir,   $emailMessage );
										$emailMessage = str_replace("[elemento]BOTON_RECIBIR[/elemento]",      $norecibir,   $emailMessage );
										$emailMessage = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$logo.'" width="150px">',   $emailMessage );
										$emailMessage = str_replace("[elemento]LOGOCOURRIER[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$em->Getlogo_courrier().'" width="150px">',   $emailMessage );										
										$emailMessage = str_replace("[elemento]observacion[/elemento]",      $observacion,   $emailMessage );
										$emailMessage = str_replace("[elemento]rad_externo[/elemento]",      $radicado,   $emailMessage );
										$emailMessage = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $emailMessage );
										$emailMessage = str_replace("[elemento]TOKEN[/elemento]",      $message_id,   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT1[/elemento]", $c->sql_quote($_REQUEST['campot1']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT2[/elemento]", $c->sql_quote($_REQUEST['campot2']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT3[/elemento]", $c->sql_quote($_REQUEST['campot3']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT4[/elemento]", $c->sql_quote($_REQUEST['campot4']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT5[/elemento]", $c->sql_quote($_REQUEST['campot5']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT6[/elemento]", $c->sql_quote($_REQUEST['campot6']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT7[/elemento]", $c->sql_quote($_REQUEST['campot7']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT8[/elemento]", $dias_comparecer_numero,   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT8L[/elemento]", $dias_comparecer_letras,   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT9[/elemento]", $c->sql_quote($_REQUEST['campot9']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT10[/elemento]", $c->sql_quote($_REQUEST['campot10']),   $emailMessage );
										
										$fecha_providencia = $c->sql_quote($_REQUEST['campot11']);
										if ($c->sql_quote($_REQUEST['campot12']) != "") {
											$fecha_providencia .= " <br> ".$c->sql_quote($_REQUEST['campot12']);
										}
										if ($c->sql_quote($_REQUEST['campot13']) != "") {
											$fecha_providencia .= " <br> ".$c->sql_quote($_REQUEST['campot13']);
										}
										$emailMessage = str_replace("[elemento]CAMPOT11[/elemento]", $fecha_providencia,   $emailMessage );

										$emailMessage = str_replace("[elemento]CAMPOT12[/elemento]", $c->sql_quote($_REQUEST['campot12']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT13[/elemento]", $c->sql_quote($_REQUEST['campot13']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT14[/elemento]", $c->sql_quote($_REQUEST['campot14']),   $emailMessage );
										$emailMessage = str_replace("[elemento]CAMPOT15[/elemento]", $c->sql_quote($_REQUEST['campot15']),   $emailMessage );


										$firmausuario = "Nombre: ".$ufirma->GetP_nombre()." ".$ufirma->GetP_apellido()."<br>Correo Electr&oacute;nico: ".$ufirma->GetEmail()."<br>Tel&eacute;fono: ".$ufirma->GetCelular()."<br>T.P.: ".$ufirma->GetUniversidad();

										$emailMessage = str_replace("[elemento]firmausuario[/elemento]", $firmausuario,   $emailMessage );

	#CODIGO PARA ENVIO DE CORREOS POR PLATAFORMA PROPIA
										if($c->sql_quote($_REQUEST['notif_tipo_documento']) != "Correspondencia Certificada"){

											// $this->CrearDocumentoNotificacion($emailMessage, $id, $nombre_destinatario[$i], $max);

										}
	# /*
										$BOTON_ADJUNTOS ='<ul style="list-style: none;margin-left: 0px;padding-left: 0px;">';
										$qan = $con->Query("select * from notificaciones_attachments where id_notificacion = '".$max."' and type='0'");
				                        $iii = 0;
				                        $ruta_adjuntos = array();
				                        $ruta_documentos = array();
				                        while ($rowan = $con->FetchAssoc($qan)) {

				                            $iii++;

				                            $ga = new MGestion_anexos;
				                            $ga->CreateGestion_anexos("id", $rowan['id_anexo']);

				                            $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";
				                            $ruta2 = ROOT.DS."/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";

				                            $rext = explode(".", $ga->GetUrl());
				                            $rext = end($rext);

				                            $rnam = explode(".", $ga->GetNombre());
				                            $rnam = end($rnam);

				                            //array_push($ruta_adjuntos, $ruta2);
											//array_push($ruta_documentos, $ga->GetNombre());

											if ($c->sql_quote($_REQUEST['cotejar']) == "SI") {
												
												$rutanueva = ROOT.DS."archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();
												#echo "$this->CotejarDocumento(".$ga->GetGestion_id().", ".$ga->GetId().", ".$rutanueva.", ".$ga->GetNombre().",  ".$guia.");";
												#exit;
												$this->CotejarDocumento($ga->GetGestion_id(), $ga->GetId(), $rutanueva, $ga->GetNombre(), $guia);

											}

				                            $ext = "";
				                            if ($rext != $rnam) {
				                            	$ext = $rext;
				                            }

				                            $BOTON_ADJUNTOS .= "<li class='list-group-item' style = 'list-style: none; border: 1px solid #CCC; padding: 10px;border-radius: 5px; margin-bottom: 5px;'>
				                            			<a href='".HOMEDIR."/s/descarganotificacioncorreo/".$ga->GetGestion_id()."/".$ga->GetUrl()."/".$ga->GetNombre().'.'.$ext."/".$rowan['id']."/' style='font-weight: bold;'>".$ga->GetNombre()."</a>
				                            		</li>";
				                        }
				                        $BOTON_ADJUNTOS .= "</ul>";
				                        $emailMessage = str_replace("[elemento]BOTON_ADJUNTOS[/elemento]", $BOTON_ADJUNTOS,   $emailMessage );
				                        //echo $emailMessage;
										$rp->InsertMailer_replys($max, $message_id, $message_id, "SENT", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

										$subject = "NUEVA CORRESPONDENCIA ELECTRONICA...";
										echo "<div class='list-group-item'>Enviando Correo Electrónico a $tm </div>";


										$exito = $c->fnEnviaEmailGlobalGoogle(CONTACTMAIL,$u->GetP_nombre()." ".$u->GetP_apellido() ,$subject,$emailMessage,$tm, $ruta_adjuntos, $ruta_documentos);



										$_SESSION['debug'] = str_replace("'",'', $_SESSION['debug'] );
										$_SESSION['debug'] = str_replace('"','', $_SESSION['debug'] );
										$con->Query("update mailer_replys set envio='".$se_envio_mail."', message='". strip_tags($emailMessage)."', log='".$_SESSION['debug']."' where receiver_id = '".$max."'");

			
										if ($sms[$i] == "SI") {
											echo "<div class='list-group-item'>";
											$this->ExportarCorreoSMS($max);
											echo '</div>';
										}

										if ($exito) {
											$se_envio_mail = "1";
											echo '<div class="list-group-item">Mensaje enviado a la direccion de correo: '.$tm.'</div>';

											$this->ExportarCorreoMail($max);
										}else{
											$se_envio_mail = "0";

											$con->Query("update mailer_replys set envio='".$se_envio_mail."', message='". strip_tags($emailMessage)."',log='".$_SESSION['debug']."', estado = '-1' where receiver_id = '".$max."'");

											$this->ExportarCorreoMail($max);

											echo '<div class="list-group-item">No se pudo enviar el mensaje a la direccion de correo: '.$tm.' ('.$exito.')'.'</div>';
											echo '<div class="list-group-item">'.$_SESSION['debug'].'</div>';
										}
										#exit;
										#exit;
										#if ($_SERVER['REMOTE_ADDR'] == "190.29.205.15") {
											#echo "update mailer_replys set envio='".$se_envio_mail."',envio_fecha='".date('Y-m-d H:i:s')."',message='".strip_tags($emailMessage)."',log='".$_SESSION['debug']."' where receiver_id = '".$max."'";
											#exit;
										#}
									#}
	#*/
	# /*
									}else{
										// $form_id = base64_encode(serialize($datoenvio));
										// $nom = $remitente;
										// $cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);
						                // $error = $cliente->getError();
						                // if ($error) {
						                //     echo "Error <h2>Constructor error</h2><pre>" . $error . "</pre>";
						                // }

						                // $array = array("id" => $_REQUEST['spostal']);
						                // $result = $cliente->call("GetDetalleOperador", $array);
						                // if ($cliente->fault) {
						                //     echo "Error <h2>Fault</h2><pre>";
						                //     echo "</pre>";
						                // }else{
						                //     $error = $cliente->getError();
						                //     if ($error) {
						                //         echo "Error <h2>Error</h2><pre>" . $error . "</pre>";
						                //     }else {
						                //         if ($result == "") {
						                //             echo "Error No se creo el WS";
						                //         }else{
						                //             $x  = explode(",", $result);
						            	// 			$id_postal = $x[1];
						            	// 			$nomPostal = $x[0];
						            	// 			echo "obteniendo Autorización de la empresa de mensajería <br>";
						                //         }
						                //     }
						                // }

										// $con->Query("UPDATE notificaciones set nombre_postal = '".$nomPostal."'  where id = '".$max."'");
										// $url = $id_postal;

										// $cliente = new nusoap_client($url, true);
									    // $error = $cliente->getError();
									    // if ($error) {
									    //     echo "Error <h2>Constructor error</h2><pre>" . $error . "</pre>";
									    // }

									  //  $array = array("user_id" => $_SESSION['usuario'], "message_id" => $max, "direccion" => $direccion_destinatario[$i], "rid" => $id , "type" => $nt, "nombre" => $nom, "destinatario" => $nombre_destinatario[$i], "url" => $urls_archivos, "juzgado" => $c->sql_quote($_REQUEST['campot1']), "naturaleza" => $c->sql_quote($_REQUEST['campot6']), "radicado" => $radicado, "demandado" => $demandado, "remitente" => $remitente, "anexos" => $dcontenido, "keyword" => $_SERVER['HTTP_HOST'], "link" => $_SESSION['71c029wus3yJWEN'], "form" => $form_id );
									  //   $result = $cliente->call("InsertNotification", $array);

									  // #  print_r($array); echo "<hr>";
									  //   if ($cliente->fault) {
									  //       echo "Error <h2>Fault</h2><pre>";
									  //       echo "</pre>";
									  //   }else{
									  //       $error = $cliente->getError();

									  //       if ($error) {
									  //           echo "Error <h2>Error</h2><pre>" . $error . "</pre>";
									  //       }else {
									// 			if ($result == "") {
									// 				echo "Error No se creo el WS";
									// 			}else{
									// 				echo "Servicio Entregado en la empresa de mensajería y pendiente de validacion <br>";
									// 				#echo "Servicio registrado y enviado a la empresa: ".$nomPostal;
									// 			}
									  //       }
									  //   }
									}
	# */

									# => 1
									#print_r($datoenvio); echo "<hr>";
							    }
						    }
						}
					}
	# FIN GENERACIÓN DE NOTIFICACIONES...
					#echo "<hr>";

				}
#				exit;

				$archivos_adjuntos_ruta = array();
				$noms_adjuntos_ruta = array();
			/*	$qadjuntos = $con->Query("select * from gestion_anexos where gestion_id = '$id' and url != ''");
				while ($radt = $con->FetchAssoc($qadjuntos)) {
					$rutanueva = ROOT.DS."archivos_uploads/gestion/".$id.'/anexos/'.$radt['url'];
					array_push($archivos_adjuntos_ruta, $rutanueva);
					array_push($noms_adjuntos_ruta, $radt['nombre']);
				}*/

				$MUsuarios2 = new MUsuarios;

		    	$MUsuarios2->CreateUsuarios("user_id", $u->GetUser_id());

		    	$username2 = $MUsuarios2->GetP_nombre()." ".$MUsuarios2->GetP_apellido();

		    	$from = $MUsuarios2->GetEmail();


				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetDependencia_destino(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ")."";

				$NUMRADICACION = "<a href='".HOMEDIR."/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetNum_oficio_respuesta()."</small>)</a>";

				$MUsuarios = new MUsuarios;

		    	$MUsuarios->CreateUsuarios("a_i", $u->GetA_i());

	    		$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();

				$con->Query("update meta_big_data set type_id = '".$g->GetId()."', fecha_registro = '".date("Y-m-d")."' where grupo_id = '".$_SESSION['smallid']."'");
				$con->Query("update gestion_anexos set gestion_id = '".$g->GetId()."', is_publico = '0' where id_servicio = '".$_SESSION['smallid']."' and ip = '".$_SERVER['REMOTE_ADDR']."' and gestion_id = '0'");
				//$con->Query("delete from gestion_anexos where id_servicio = '".$_SESSION['smallid']."' and url = ''");


				if($_SESSION['smallid'] != ''){

					echo "<div class='list-group-item'>Finalizando el proceso espere un momento...</div>";
					//unset($_SESSION['smallid']);
					$oname = UPLOADS.DS.$_SESSION['smallid'].DS.'anexos';
					$f->rmDir_rf($oname);
					$oname = UPLOADS.DS.$_SESSION['smallid'].DS.'backup';
					$f->rmDir_rf($oname);
					$oname = UPLOADS.DS.$_SESSION['smallid'];
					$f->rmDir_rf($oname);
					$_SESSION['smallid'] = "";
				}

				#$mensaje = "<p>Un usuario de Notificador Judicial acaba de enviar nuevos correos</p><p><b>Paso 1, Procesar Correspondencia nueva:</b><br><a href='https://s.siammservice.com/cronjob/cron.servicios_SGDEA.php' target='_blank'>https://s.siammservice.com/cronjob/cron.servicios_SGDEA.php</a></p><br><br><p><b>Paso 2, Enviar Correos Electrónicos:</b><br><a href='https://s.siammservice.com/cronjob/cron.vs_acuse_procesamientoemail.php' target='_blank'>https://s.siammservice.com/cronjob/cron.vs_acuse_procesamientoemail.php</a></p>";

				#$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"REGISTRO DE NUEVOS CORREOS",$mensaje,"sander.cadena@laws.com.co");
				#$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"REGISTRO DE NUEVOS CORREOS",$mensaje,"registros@notificadorjudicial.com");
#				sleep(30);

				echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/correspondencia/"</script>';
				echo '</div></div></div></div></div></div>';

				$table = ob_get_clean();
				// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
				// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				// RETORNAME LA PAGINA CARGADA
				$this->view_page($pagina);
			}else{

				$pagina = $this->load_template('Ups! Error');
				// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
				ob_start();

				include_once(VIEWS.DS.'gestion/error_registro.php');

				$table = ob_get_clean();
				// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
				// CARGAMOS LA PAGINA EN EL BROWSER
				$this->view_page($pagina);


			}

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


				$campot1= $c->sql_quote($_REQUEST['campot1']);
				$campot2= $c->sql_quote($_REQUEST['campot2']);
				$campot3= $c->sql_quote($_REQUEST['campot3']);
				$campot4= $c->sql_quote($_REQUEST['campot4']);
				$campot5= $c->sql_quote($_REQUEST['campot5']);

				$campot6= $c->sql_quote($_REQUEST['campot6']);
				$campot7= $c->sql_quote($_REQUEST['campot7']);
				$campot8= $c->sql_quote($_REQUEST['campot8']);
				$campot9= $c->sql_quote($_REQUEST['campot9']);
				$campot10= $c->sql_quote($_REQUEST['campot10']);

				$campot11= $c->sql_quote($_REQUEST['campot11']);
				$campot12= $c->sql_quote($_REQUEST['campot12']);
				$campot13= $c->sql_quote($_REQUEST['campot13']);
				$campot14= $c->sql_quote($_REQUEST['campot14']);
				$campot15= $c->sql_quote($_REQUEST['campot15']);




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
	    		#echo ";Holap".$object->GetEstado_solicitud()." :".$estado_solicitud;
	    		if($object->GetEstado_solicitud() != $estado_solicitud ){

	    			if ($object->GetEstado_solicitud() != "") {

	    				$estadoa = $c->GetDataFromTable("estados_gestion", "id", $object->GetEstado_solicitud(), "nombre", "");
	    			}

	    			if ($estado_solicitud != "") {
	    				# code...
	    				$estadob = $c->GetDataFromTable("estados_gestion", "id", $estado_solicitud, "nombre", "");
	    			}

	    			$path .= "<li>Se edito el campo Estado del Expediente de '".$estadoa."' por '".$estadob."' </li>";

	    			$change = true;

	    		}
	    		#echo "Hola!";

	    		if($object->GetNombre_destino() != $nombre_destino && $nombre_destino != ""){

	    			#echo "Hey! el nombe destino es diferente!";
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
						if($object->GetTransferencia() == "1"){
							
							$nosend = true;

						}else{
							$ordenq  = $con->Query("delete from gestion_transferencias WHERE gestion_id = '".$id."' and estado = '0'");

							$mtransferencia = new MGestion_transferencias;
		    				$mtransferencia->InsertGestion_transferencias($object->GetId(), $_SESSION['usuario'], $nombre_destino, date("Y-m-d H:i:s"), "", "", "", "0");

		    				$con->Query("UPDATE gestion SET transferencia = '1' where id = '".$object->GetId()."'");

							$objecte = new MEvents_gestion;
							$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Nuevo Expediente Asignado: ".$object->GetNum_oficio_respuesta(), "El usuario $responsablea le acaba de asignar un expediente debe aceptarlo o rechazarlo", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $nombre_destino, "trexp", $object->GetId());

						}

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

	    		if($object->GetCampot1() != $campot1){
	    			$path .= "<li>Se edito el campo ".CAMPOT1." de '".$object->GetCampot1()."' por '$campot1' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot2() != $campot2){
	    			$path .= "<li>Se edito el campo ".CAMPOT2." de '".$object->GetCampot2()."' por '$campot2' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot3() != $campot3){
	    			$path .= "<li>Se edito el campo ".CAMPOT3." de '".$object->GetCampot3()."' por '$campot3' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot4() != $campot4){
	    			$path .= "<li>Se edito el campo ".CAMPOT4." de '".$object->GetCampot4()."' por '$campot4' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot5() != $campot5){
	    			$path .= "<li>Se edito el campo ".CAMPOT5." de '".$object->GetCampot5()."' por '$campot5' </li>";
	    			$change = true;
	    		}

	    		if($object->GetCampot6() != $campot6){
	    			$path .= "<li>Se edito el campo ".CAMPOT6." de '".$object->GetCampot6()."' por '$campot6' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot7() != $campot7){
	    			$path .= "<li>Se edito el campo ".CAMPOT7." de '".$object->GetCampot7()."' por '$campot7' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot8() != $campot8){
	    			$path .= "<li>Se edito el campo ".CAMPOT8." de '".$object->GetCampot8()."' por '$campot8' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot9() != $campot9){
	    			$path .= "<li>Se edito el campo ".CAMPOT9." de '".$object->GetCampot9()."' por '$campot9' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot10() != $campot10){
	    			$path .= "<li>Se edito el campo ".CAMPOT10." de '".$object->GetCampot10()."' por '$campot10' </li>";
	    			$change = true;
	    		}

	    		if($object->GetCampot11() != $campot11){
	    			$path .= "<li>Se edito el campo ".CAMPOT11." de '".$object->GetCampot11()."' por '$campot11' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot12() != $campot12){
	    			$path .= "<li>Se edito el campo ".CAMPOT12." de '".$object->GetCampot12()."' por '$campot12' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot13() != $campot13){
	    			$path .= "<li>Se edito el campo ".CAMPOT13." de '".$object->GetCampot13()."' por '$campot13' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot14() != $campot14){
	    			$path .= "<li>Se edito el campo ".CAMPOT14." de '".$object->GetCampot14()."' por '$campot14' </li>";
	    			$change = true;
	    		}
	    		if($object->GetCampot15() != $campot15){
	    			$path .= "<li>Se edito el campo ".CAMPOT15." de '".$object->GetCampot15()."' por '$campot15' </li>";
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
# /*


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

# */
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
			global $f;
			global $c;


			$folder = ($folder == "")?'0':$folder;

			$_SESSION["folder_exp"] = $folder;

			$ge = new MGestion;

			$ge->CreateGestion("id", $id);

			$dep = new MDependencias;

			$dep->CreateDependencias("id", $ge->GetTipo_documento());

			if ($_SESSION['suscriptor_id'] == "") {
				include_once(VIEWS.DS."gestion/GetCarpetas.php");
				include_once(VIEWS.DS."gestion/gestion_anexos.php");
			}else{
				include_once(VIEWS.DS."gestion/GetCarpetasPublico.php");
				include_once(VIEWS.DS."gestion/gestion_anexosPublico.php");
			}

		}

		function GetAnexosBuscar($id, $folder = "0", $pag = "1" ){

			global $con;

			$busquedadatos = $folder;

			$folder=0;
			$pag=1;


			$folder = ($folder == "")?'0':$folder;

			$_SESSION["folder_exp"] = $folder;

			$ge = new MGestion;

			$ge->CreateGestion("id", $id);

			$dep = new MDependencias;

			$dep->CreateDependencias("id", $ge->GetTipo_documento());

			include_once(VIEWS.DS."gestion/gestion_anexos_buscar.php");

		}

		function GetDocumentos($id){

			global $con;

            $ang = new MDocumentos_gestion;

            $query = $ang->ListarDocumentos_gestion("WHERE gestion_id = '".$id."'");

			if ($_SESSION['suscriptor_id'] == "") {
				include_once(VIEWS.DS.'documentos_gestion/Listar.php');
			}

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
			global $c;
			global $f;

			$object = new MDependencias_alertas;

			$dep = new MDependencias;

			$dep->CreateDependencias("id", $id_dependencia);

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarDependencias_alertas(" WHERE id_dependencia = '".$id_dependencia."'");

			#include_once(VIEWS.DS.'gestion/Listado_Alertas.php');
			if ($_SESSION['suscriptor_id'] == "") {
				$object = new MGestion;
				$object->CreateGestion("id", $id_gestion);

				include(VIEWS.DS."events_gestion/FormInsertEvents_gestion.php");

				$ev = new MEvents_gestion;
				$query = $ev->ListarEvents_gestion(" WHERE gestion_id = '".$object->GetId()."' and type_event = '1' ", "order by fecha desc, time desc");
				$hidebtn = false;
				include(VIEWS.DS."events_gestion/MyListar.php");
			}else{
				$object = new MGestion;
				$object->CreateGestion("id", $id_gestion);

				$ev = new MEvents_gestion;
				$query = $ev->ListarEvents_gestion(" WHERE gestion_id = '".$object->GetId()."' and type_event = '1' and es_publico = '1' ", "order by fecha desc, time desc");

				$hidebtn = true;
				include(VIEWS.DS."events_gestion/MyListar.php");
			}


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

*/
			include_once(VIEWS.DS.'gestion_compartir/Listar.php');
		}

		function GetAnexos2($id, $folder = "0", $pag = "1" ){

			global $con;

			$RegistrosAMostrar = 10;

			if(isset($pag)){

				$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;

				$PagAct=$pag;

			}else{

				$RegistrosAEmpezar=0;

				$PagAct=1;

			}
			$op = "";
			if ($pag != "1") {
				$op = "open";
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



			echo '<div class="btn-group pull-right '.$op.'">
				    <button aria-expanded="true" data-toggle="dropdown" class="boton dropdown-toggle" type="button">
				    	<span class="fa fa-bars"></span>
				    </button>
				    <ul role="menu" class="dropdown-menu" style="width:360px">';

#    <li><a href="#">Action</a></li>

#    <li><a href="#">Separated link</a></li>
# /*
			if ($folder != "0") {

				$typefol = ($fol->GetTipo() == "1")?"folder":"folder_private";

				$subname = substr($fol->GetNombre(), 0, 30);

				echo "<li>
                        <a href='#' onclick='showqanexos(\"/gestion/GetAnexos2/".$id."/".$fol->GetFolder_id()."/1/\", \"cargador_box_upfiles_menu\")' >
                            <div class='nom_anexo' title='Regresar a la Carpeta Anterior'>Regresar a la Carpeta Anterior</div>
                        </a>
						<a href='#'>
                            <div class='nom_anexo' title='Carpeta Actual: ".$fol->GetNombre()."'><b>Carpeta Actual: ".$subname."</b></div>
                        </a>
                        </li>";

			}

			while($rfolder = $con->FetchAssoc($queryf)){

				$typefol = ($rfolder["tipo"] == "1")?"folder":"folder_private";

				$subname = substr($fol->GetNombre(), 0, 35);

                echo "<li>  <a href='#' onclick='showqanexos(\"/gestion/GetAnexos2/".$id."/".$rfolder['id']."/1/\", \"cargador_box_upfiles_menu\")' >

                            <div class='nom_anexo' title='$rfolder[nombre]'>$subname</div>

                        </a></li>";

			}
			echo '    <li class="divider"></li>';

# */
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



	                echo "<li>  <a href='#' id='$col[id]' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>

	                            <div class='nom_anexo' title='$col[nombre]'>$subname</div>

	                        </a></li>";

                }else{

                	echo "<li>  <a href='#' id='ppic$col[id]'>

	                            <div class='nom_anexo' title='$col[nombre]'>$subname</div>

	                        </a></li>";

                }

            }

	echo '    <li class="divider"></li>';
#/*
	        if ($_SESSION['suscriptor_id'] == "") {

                $querypag="SELECT count(*) as t from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '".$folder."'";

        	}else{

        		$querypag="SELECT count(*) as t from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and is_publico = '1'";

        	}

            echo '<div class="list-group-item">';

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
                echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos2(\"/gestion/GetAnexos2/".$id."/".$folder."/1/\")' >Pag 1</a> ";

                if($PagAct>1)

                echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos2(\"/gestion/GetAnexos2/".$id."/".$folder."/".$PagAnt."/\")'>Pag Ant.</a> ";

                echo "<a class='pag darker' href='#'>Pag ".$PagAct." de ".$PagUlt."</a>";

                if($PagAct<$PagUlt)

                echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos2(\"/gestion/GetAnexos2/".$id."/".$folder."/".$PagSig."/\")'>Pag Sig.</a> ";

                echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showqanexos2(\"/gestion/GetAnexos2/".$id."/".$folder."/".$PagUlt."/\")'>Pag $PagUlt</a>";

            echo '</div>';
#*/
			echo '
				    </ul>
				</div>';

		}

		function GetReparto($fi, $ff, $p1){

			global $con;
			global $c;
			global $f;
			// CARGA EL TEMPLATE
	 		$pagina = $this->load_template_limpiaAmple('Reparto Dinamico');
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

		function Getseguimiento($id, $tipo_seguimiento = ""){

			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'gestion/Seguimiento.php');

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

		function GetCorrespondencia(){

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
							if ($val == "IDENTIFICACION") {
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
				if ($_SESSION['mayedit'] == "1") {
					include_once(VIEWS.DS.'gestion/DetalleExpedientenEditable.php');
					#include_once(VIEWS.DS.'gestion/DetalleExpediente.php');
				}else{
					#include_once(VIEWS.DS.'gestion/DetalleExpediente.php');
					include_once(VIEWS.DS.'gestion/DetalleExpedienteNonEditable.php');
				}
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
		$ar1 = array($user, $subserie, $serie, $_SESSION['ciudad'], $u->GetSeccional(), $area, '1', $object->GetObservacion2()."<br>--<br>".date("Y-m-d H:i:s").": ".$observacion2, 'Abierto');
		$output = array('registro actualizado', 'no se pudo actualizar');
		$constrain = 'WHERE id = '.$gestion->GetId();

		$mtransferencia = new MGestion_transferencias;
		    			$mtransferencia->InsertGestion_transferencias($object->GetId(), $_SESSION['usuario'], $user, date("Y-m-d H:i:s"), $observacion2, "", "", "0");

		$objecte = new MEvents_gestion;
		$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Nuevo Expediente Asignado: ".$object->GetRadicado(), "El usuario ".$u->GetP_nombre()." ".$u->GetP_apellido()." le acaba de asignar un expediente debe aceptarlo o rechazarlo", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $user, "trexp", $object->GetId());

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

		$objecte = new MEvents_gestion;
		$us = new MUsuarios;
		$us->CreateUsuarios("a_i", $u->GetA_i());
		$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId (), date("Y-m-d"), "Expediente ".$object->GetNum_oficio_respuesta()." Transferido", "La transferencia del expediente al usuario ".$us->GetP_nombre()." ".$us->GetP_apellido()." ha sido completada correctamente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $us->GetA_i(), "texp", $us->GetA_i());
		
		if ($changeuser) {
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

			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Rechazado", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");
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

		#$con->Query("update gestion_anexos set url = '' where gestion_id = '".$object->GetId()."'");

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

	function ActualizarCampoExpediente($valor, $campo, $id){

		global $con;
		global $c;
		global $f;
		// DEFINIMOS UN OBJETO NUEVO
		$object = new MGestion;
		$object->CreateGestion("id", $id);

		$q = $con->Query("select * from gestion where id = '$id'");
		$qr = $con->FetchAssoc($q);

		$vanaquel  = $campo;
		$valorana = $valor;

		if ($vanaquel == "fechaestadoanaquel") {
			$valor = "Anaquel";
			$campo = "estado_respuesta";
		}

		if ($qr[$campo] != $valor) {

			$path = "Se edito el campo $valor de ".$qr[$campo]." por $valor";

			$objecte = new MEvents_gestion;
			$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Expediente ".$object->GetRadicado()." Editado", "Se ha editado la informacion del Expediente. ".$c->sql_quote($path)."", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "eexp", $object->GetId());



			if ($campo == "estado_respuesta") {
				$con->Query('insert into gestion_cambio_estado (estado, fecha, id_gestion, usuario) VALUES ("'.$valor.'", "'.$valorana.'",  "'.$object->GetId().'", "'.$_SESSION['usuario'].'")');
			}
			// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
			$ar2 = array($campo);
			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER
			$ar1 = array($valor);
			// DEFINIMOS LOS ESTADOS DE SALIDA
			$output = array('registro actualizado', 'no se pudo actualizar');
			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION
			$constrain = 'WHERE id = '.$id;

			$create = $object->UpdateGestion($constrain, $ar2, $ar1, $output);
			echo "1";

		}else{
			echo "0";
		}

	}

	function ArchivarExpediente($id, $observacion2){

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
			$con->Query("UPDATE gestion_anexos_firmas set estado_firma = '2' where gestion_id = '".$object->GetId()."'");
			$con->Query("UPDATE gestion_anexos_firmas set estado_firma = '2' where gestion_id = '".$object->GetId()."'");
			$con->Query("UPDATE gestion_transferencias set estado = '2' where gestion_id = '".$object->GetId()."'");

		}
		// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
		$ar2 = array('observacion2', 'estado_respuesta', 'fecha_respuesta', 'estado_archivo');
		// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER
		$ar1 = array($observacion2, 'Cerrado', date("Y-m-d"), "2");
		// DEFINIMOS LOS ESTADOS DE SALIDA
		$output = array('registro actualizado', 'no se pudo actualizar');
		// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION
		$constrain = 'WHERE id = '.$id;

		$create = $object->UpdateGestion($constrain, $ar2, $ar1, $output);
		echo "Solicitud Colocada En Espera Correccion";



	}

	function getlistadoformularios($id){

		global $con;

		$ids = $id;
		$consulta = $con->Query("Select * from meta_referencias_titulos where id_s = '".$ids."' and tipo = '1'");
		while ($row = $con->FetchAssoc($consulta)) {
			echo "<option value='".$row['id']."'>".$row['titulo']."</option>";
		}

	}

	function GetAreas($idx, $area = 0){

		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL

		global $con;
		global $c;
		global $f;

		//CARGANDO LA PAGINA DE INTERFAZ

		$pagina = $this->load_template('Archivo Central');


		// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

		ob_start();

		include_once(VIEWS.DS.'gestion/FiltroGestion.php');
		if ($idx == '1') {
		
			include_once(VIEWS.DS.'gestion/ListarAreas.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.
		}elseif ($idx == '2') {
			include_once(VIEWS.DS.'folder/ListarAreasCentral.php');
		}elseif ($idx == '3') {
			include_once(VIEWS.DS.'folder/ListarAreasCentral.php');
		}else{
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

			$perfil = 'U';
			if ($_SESSION['t_cuenta'] == '1') {
				$perfil = 'J';
			}
			if ($_SESSION['sadmin'] == '1') {
				$perfil = 'A';
			}

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
							if ($val == "IDENTIFICACION") {
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
							}

							if($col == $refcol_anexo){

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
						$con->Query("update gestion_anexos set gestion_id = '".$g->GetId()."', is_publico = '1' where id_servicio = '".$mys_id."' and ip = '".$_SERVER['REMOTE_ADDR']."' and gestion_id = '0'");
						#$archivo = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'].'/file_'.$_SESSION['suscriptor_id'].'.xlsx';
						$oname = UPLOADS.DS."tmp_base/".$_SESSION['smallid'].DS;
						$nname = UPLOADS.DS.$g->GetId().DS."anexos/";
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
 	function VistaCorreoCorrespondencia(){
		global $con;
		global $f;
		// CREANDO UN NUEVO MODELO
		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL
		// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		if ($_SESSION['suscriptor_id'] == "") {
			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'gestion/FormInsertCorrespondencia.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.
			$table = ob_get_clean();
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA
			$this->view_page($pagina);
		}
 	}
 	function VistaInsertarV2(){
		global $con;
		global $f;
		// CREANDO UN NUEVO MODELO
		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL
		// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		if ($_SESSION['suscriptor_id'] == "") {
			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'gestion/FormInsertGestionV2.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.
			$table = ob_get_clean();
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA
			$this->view_page($pagina);
		}
 	}
 	
 	function GetExpedientebyId($id){
 		global $con;
 		global $c;
 		global $f;
		echo "<ul class=list-group>";
 		if ($id != "") {

			$itdt = $id;
			$s1w = "";

			if ($_SESSION['buscador_global'] == "1") {
				# code...
				$s1 = "select *
							$paths
							from gestion
								where
									".$s1w."
									(num_oficio_respuesta like '%".$id."%' or radicado like '%".$id."%' or  observacion like '%".$id."%' or
									observacion2 like '%".$id."%' or min_rad like '%".$id."%') and estado_archivo != '-99' order by id desc  limit 0, 10";

			}else{

				 $s1 = "select *
							from gestion
								where
									gestion.nombre_destino = '".$_SESSION['user_ai']."' and
									(gestion.num_oficio_respuesta like '%".$id."%' or  gestion.radicado like '%".$id."%' or
									gestion.observacion like '%".$id."%' or gestion.observacion2 like '%".$id."%' or
									gestion.min_rad like '%".$id."%') and gestion.estado_archivo != '-99' order by id desc limit 0, 10";
			}

			$s1;

			$q1 = $con->Query($s1);

			$i = 0;
			while ($roe = $con->FetchAssoc($q1)) {
				$i++;
				$radicado = $roe['radicado'];
				if ($radicado == "") {
					$radicado = $roe['min_rad'];
				}
				$ts = $c->GetDataFromTable("suscriptores_contactos", "id", $roe['suscriptor_id'], "nombre"," ");
				echo "	<li class='list-group-item' onclick='GetDetailExpediente(\"".$roe['id']."\", \"".$radicado."\")'>".$radicado." (".$ts.")</li>";
			}
			if ($i == 0) {
				echo "<li class='list-group-item'>".$x." (No se encontraron resultados)</li>";
			}

		}else{
			echo "<li class='list-group-item'>".$x." (Escriba un radicado a consultar)</li>";
		}
		echo "</ul>";
 	}

 	function GetDetailExpediente($id){
 		global $con;
 		global $c;
 		global $f;

 		$g = new MGestion;
 		$g->CreateGestion("id", $id);

 		$sc = new MSuscriptores_contactos;
	 	$sc->CreateSuscriptores_contactos("id", $g->GetSuscriptor_id());


		$demandantes_nombre = "";
	    $demandados_nombres = "";
	    $qsuscriptt = $con->Query("select sc.nombre, sc.type from gestion_suscriptores as gs inner join suscriptores_contactos sc on sc.id = gs.id_suscriptor where id_gestion = '".$g->GetId()."'");

	    while ($rsust = $con->FetchAssoc($qsuscriptt)) {
	        # code...
	        if ($rsust['type'] == "26") {
	            $demandantes_nombre .= $rsust['nombre']." / ";
	        }

	        if ($rsust['type'] == "27") {
	            $demandados_nombres .= $rsust['nombre']." / ";
	        }
	    }
	    $demandantes_nombre = substr($demandantes_nombre, 0, -3);
	    $demandados_nombres = substr($demandados_nombres, 0, -3);

	    if ($demandantes_nombre == "") {
	    	$demandantes_nombre = $sc->GetNombre();
	    }

		$arr = array(
						'id_suscriptor' 	=> html_entity_decode($sc->GetId()),
						'nombre_suscriptor' => html_entity_decode($demandantes_nombre),
						'id_gestion' 		=> html_entity_decode($g->GetId()),
						'observacion' 		=> html_entity_decode($g->GetObservacion()),
						'observacion2' 		=> html_entity_decode($g->GetObservacion2()),
						'radicado' 			=> html_entity_decode($g->GetRadicado()),
						'campot1' 			=> html_entity_decode($g->GetCampot1()),
						'campot2' 			=> html_entity_decode($g->GetCampot2()),
						'campot3' 			=> html_entity_decode($g->GetCampot3()),
						'campot4' 			=> html_entity_decode($g->GetCampot4()),
						'campot5' 			=> html_entity_decode($g->GetCampot5()),
						'campot6' 			=> html_entity_decode($g->GetCampot6()),
						'campot7' 			=> html_entity_decode($g->GetCampot7()),
						'campot8' 			=> html_entity_decode($g->GetCampot8()),
						'campot9' 			=> html_entity_decode($g->GetCampot9()),
						'campot10' 			=> html_entity_decode($g->GetCampot10()),
						'campot11' 			=> html_entity_decode($g->GetCampot11()),
						'campot12' 			=> html_entity_decode($g->GetCampot12()),
						'campot13' 			=> html_entity_decode($g->GetCampot13()),
						'campot14' 			=> html_entity_decode($g->GetCampot14()),
						'campot15' 			=> html_entity_decode($g->GetCampot15()),
						'demandantes_nombre'=> html_entity_decode($demandantes_nombre),
						'demandados_nombres'=> html_entity_decode($demandados_nombres)
					);
		echo json_encode($arr);

 	}

 	function CerrarExpediente($id, $tipo){
		global $c;
		global $con;

		$g = new MGestion;
		$g->CreateGestion("id", $id);

		$changes = false;
		$path = "";
		if ($g->GetEstado_respuesta() != $tipo) {

			$path .= "<li>Se edito el campo Estado del Proceso de '".$g->GetEstado_respuesta()."' por '".$tipo."' </li>";

			echo "update gestion set estado_respuesta = '$tipo' where id = '$id'";
			$query = $con->Query("update gestion set estado_respuesta = '$tipo' where id = '$id'");

			$objecte = new MEvents_gestion;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
			/*  InsertEvents_gestion(	usuario_registra , 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario)) */
			$objecte->InsertEvents_gestion($_SESSION['usuario'], $object->GetId(), date("Y-m-d"), "Se ha editado el estado del proceso a ".$tipo, "Se ha editado la informacion del Proceso  <ul>".$c->sql_quote($path)."</ul>", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $_SESSION['a_i'], "ev", $g->GetId());
		}
	}

	function ExportarCorreoSMS($id){
		global $con;
		global $c;
		global $f;

		$n = new MNotificaciones;
		$n->CreateNotificaciones("id", $id);

		$qsms = $con->Query("select * from notificaciones where id = '$id'");
		$sms = $con->FetchAssoc($qsms);

		$gestion_id = $n->GetProceso_id();

		$g = new MGestion;
		$g->CreateGestion("id", $gestion_id);

		$user = new MUsuarios;
		$user->CreateUsuarios("user_id", $g->GetUsuario_registra());

		echo "Generando Certificado de SMS";
		$pathp = "";

		#$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
		$name = md5($_SESSION['usuario'].date("Y-m-d H:i:s"))."m.pdf";
		$urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;

		$string = hash("sha256", $id.date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]);

		#	include(APP.'plugins/mix_images/index.php');

		$timestamp = "	<div style='clear:both'>
							<table width='700px' style='font-size:10px; text-style:italic' cellspacing='0' cellpadding='0' border='0'>
								<tr>
									<td><b>Estampado Cronologico:</b> ".date("Y-m-d")." a las ".date("H:i:s")."</td>
									<td><b>IP:</b> ".$_SERVER["REMOTE_ADDR"]."</td>
								</tr>
								<tr>
									<td><b>Firma Digital:</b> $string</td>
								</tr>
								<tr>
									<td>-----<br><br></td>
								</tr>
							</table>
						  </div>";

		$timestamp = "";

		$foot = "	<div>
						<div style='font-size:10px; float:left'>";
		$foot .= 			$pathp;
		$foot .= "		</div>
					</div>";

		$fpath = '<html><head></head><body>'.$timestamp;

		$lpath = '<br><br>-----'.$foot.'</body></html>';

		$stringactuaciones = "<h2>Detalle del Mensaje de Texto ".$id."-".$sms['telefono']." </h2>";

		$stringactuaciones = "";

		include(VIEWS.DS."mailer_message".DS."body_sms_exportar.php");

		$html = utf8_decode($fpath.html_entity_decode($stringactuaciones).$lpath);
		

		$em = new MSuper_admin;
		$em->CreateSuper_admin("id", $_SESSION['id_empresa']);


    	$logo_courrier = ROOT.DS.'plugins/thumbnails/'.$em->Getlogo_courrier();
    	$exists = file_exists( $logo_courrier );
    	if ($em->Getlogo_courrier() == "") {
    		$encabezado = HOMEDIR.DS.'app/plugins/thumbnails/'.$em->GetFoto_perfil();
    	}else{
    		$encabezado = HOMEDIR.DS.'app/plugins/thumbnails/'.$em->Getlogo_courrier();
    	}

		$pie_pagina = "";

		$html2 = '

					<html>

					<head>

					  <style>

					    @page { margin: 120px 100px; }

					    #header { position: fixed; left: -50px; top: -120px; right: 0px; height: 83px; background: url('.$encabezado.') no-repeat; background-size: 170px !important; text-align: center; border-bottom:2px solid #C2E1F1; }

					    #footer { position: fixed; left: 0px; bottom: -120px; right: 0px; height: 110px; background: url('.$pie_pagina.') no-repeat; }

					    #footer .page:after { content: counter(page, upper-roman); }

					    body{ font-family:"Helvetica"; }

					    h2{margin-top:20px !important;}

					  </style>

					<body>

					  <div id="header">&nbsp;</div>

					  <div id="footer"><p class="page">&nbsp;</p></div>

					  <div id="content" style="font-size:12px;">

					   '.$html.'

					  </div>

					</body>

					</html>';

        $html2 = preg_replace('/>\s+</', '><', $html2);
		$dompdf = new DOMPDF();

		$dompdf->set_paper('letter','');
		$dompdf->load_html($html2);
		ini_set("memory_limit","512M");
		$dompdf->render();


		/*
			DOCUMENTAR LA SIGUIENTE LINEA AL TERMINAR
			$dompdf->stream('my.pdf',array('Attachment'=>0));
		*/

		$pdf = $dompdf->output();
		if (file_put_contents($urlfile, $pdf)) {
/*
			echo "<a href='$urlfile' target='_blank'> Documento exportado a anexos </a>";
*/
			$car = new MGestion_anexos;
			$tot  = $car->ListarGestion_anexos("WHERE gestion_id = '".$gestion_id."'");

			$fol = $con->NumRows($tot);
			$fol += 1;
			$user_id = $user->GetUser_id();

			//base 64
			$base_file = '';
			#$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);
			#$base_file = base64_encode($data_base_file);
			$con->Query("delete from gestion_anexos where id_servicio = 'SMS".$n->GetId()."'");

			$con->Query("delete from alertas_suscriptor where type = 'rsms' and extra = '".$sms['telefono']."' and id_gestion =  '".$g->GetId()."'");

			$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file, id_servicio) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','Acuse Telefonico de: ".$sms['telefono']." Fecha: ".date("Y-m-d H:i:s")."' ,'".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."', 'SMS".$n->GetId()."')");


			$id = $c->GetMaxIdTabla("gestion_anexos", "id");

			$objecte = new MEvents_gestion;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
			$objecte->InsertEvents_gestion($_SESSION['usuario'],  $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"Actuaciones del Expediente Hasta ".date("Y-m-d H:i:s")."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, "6", "1", "1", "*", "expdpc", $id);


			$description = "Se a Creado o actualizado el certificado de lectura del mensaje enviado a ".$n->GetDestinatario()." con telefono ".$n->GetTelefono()."";
			$con->Query("INSERT INTO alertas_suscriptor 
								(suscriptor_id, alerta, id_gestion, fechahora, estado, type, tipo_usuario, extra, id_anexo) 
						VALUES 	('".$n->GetUser_id()."', '".$description."', '".$g->GetId()."', '".date("Y-m-d H:i:s")."', '0', 'rsms', 'U', '".$sms['telefono']."', '".$id."')");

			$con->Query("update gestion set suscriptor_leido = '1',  usuario_leido = '1' where id = '".$n->GetProceso_id()."'");


			#echo $idretorno."Documento Exportado a Anexos";
		}else{
			#echo "Se produjo un error al Exportar";
		}
	}
	
	function ExportarCorreoMail($id){
			global $con;
			global $c;
			global $f;

			$n = new MNotificaciones;
			$n->CreateNotificaciones("id", $id);

			$qsms = $con->Query("select * from notificaciones where id = '$id'");
			$sms = $con->FetchAssoc($qsms);

			$qmr = $con->Query("select * from mailer_replys where receiver_id = '".$id."'");
			$mr = $con->FetchAssoc($qmr);

			$gestion_id = $n->GetProceso_id();

			$g = new MGestion;
			$g->CreateGestion("id", $gestion_id);

			$user = new MUsuarios;
			$user->CreateUsuarios("user_id", $g->GetUsuario_registra());


			$pathp = "";

			#$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
			$name = md5($_SESSION['usuario'].date("Y-m-d H:i:s"))."a.pdf";
			$urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;

			$string = hash("sha256", $id.date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]);

			#	include(APP.'plugins/mix_images/index.php');

			$timestamp = "	<div style='clear:both'>
								<table width='700px' style='font-size:10px; text-style:italic' cellspacing='0' cellpadding='0' border='0'>
									<tr>
										<td><b>Estampado Cronologico:</b> ".date("Y-m-d")." a las ".date("H:i:s")."</td>
										<td><b>IP:</b> ".$_SERVER["REMOTE_ADDR"]."</td>
									</tr>
									<tr>
										<td><b>Firma Digital:</b> $string</td>
									</tr>
									<tr>
										<td>-----<br><br></td>
									</tr>
								</table>
							  </div>";

			$timestamp = "";

			$foot = "	<div>
							<div style='font-size:10px; float:left'>";
			$foot .= 			$pathp;
			$foot .= "		</div>
						</div>";

			$fpath = '<html><head></head><body>'.$timestamp;

			$lpath = '<br><br>-----'.$foot.'</body></html>';

			$stringactuaciones = "<h2>Detalle del Correo Electrónico ".$id."-".$sms['direccion']." </h2>";

			$stringactuaciones = "";

			include(VIEWS.DS."mailer_message".DS."body_email_nuevo_exportar.php");

			$html = utf8_decode($fpath.html_entity_decode($stringactuaciones).$lpath);

			$em = new MSuper_admin;
			$em->CreateSuper_admin("id", $_SESSION['id_empresa']);

	    	$logo_courrier = ROOT.DS.'plugins/thumbnails/'.$em->Getlogo_courrier();
	    	$exists = file_exists( $logo_courrier );
	    	if ($em->Getlogo_courrier() == "") {
	    		$encabezado = HOMEDIR.DS.'app/plugins/thumbnails/'.$em->GetFoto_perfil();
	    	}else{
	    		$encabezado = HOMEDIR.DS.'app/plugins/thumbnails/'.$em->Getlogo_courrier();
	    	}

			$pie_pagina = "";

			$html2 = '

						<html>

						<head>

						  <style>

						    @page { margin: 120px 100px; }

						    #header { position: fixed; left: -50px; top: -120px; right: 0px; height: 83px; background: url('.$encabezado.') no-repeat; background-size: 170px !important; text-align: center; border-bottom:2px solid #C2E1F1; }

						    #footer { position: fixed; left: 0px; bottom: -120px; right: 0px; height: 110px; background: url('.$pie_pagina.') no-repeat; }

						    #footer .page:after { content: counter(page, upper-roman); }

						    body{ font-family:"Helvetica"; }

						    h2{margin-top:20px !important;}

						  </style>

						<body>

						  <div id="header">&nbsp;</div>

						  <div id="footer"><p class="page">&nbsp;</p></div>

						  <div id="content" style="font-size:12px;">

						   '.$html.'

						  </div>

						</body>

						</html>';

            $html2 = preg_replace('/>\s+</', '><', $html2);
			$dompdf = new DOMPDF();

			$dompdf->set_paper('letter','');
			$dompdf->load_html($html2);
			ini_set("memory_limit","512M");
			$dompdf->render();


			/*
				DOCUMENTAR LA SIGUIENTE LINEA AL TERMINAR
				$dompdf->stream('my.pdf',array('Attachment'=>0));
			*/

			$pdf = $dompdf->output();
			if (file_put_contents($urlfile, $pdf)) {
/*
				echo "<a href='$urlfile' target='_blank'> Documento exportado a anexos </a>";
*/
				$car = new MGestion_anexos;
				$tot  = $car->ListarGestion_anexos("WHERE gestion_id = '".$gestion_id."'");

				$fol = $con->NumRows($tot);
				$fol += 1;
				$user_id = $user->GetUser_id();

				//base 64
				$base_file = '';
				#$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);
				#$base_file = base64_encode($data_base_file);
				$con->Query("delete from gestion_anexos where id_servicio = 'EMAIL".$n->GetId()."'");

				$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file, id_servicio) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','Acuse Por Email de: ".$sms['direccion']." Fecha: ".date("Y-m-d H:i:s")."' ,'".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."', 'EMAIL".$n->GetId()."')");


				$id = $c->GetMaxIdTabla("gestion_anexos", "id");

				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"Actuaciones del Expediente Hasta ".date("Y-m-d H:i:s")."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, "6", "1", "1", "*", "expdpc", $id);
				#echo $idretorno."Documento Exportado a Anexos";
			}else{
				#echo "Se produjo un error al Exportar";
			}
		}

		function GetsuscriptoresExpedientes($id){

			global $c;
			global $con;
			global $f;

			// INVOCAMOS UN NUEVO OBJETO
			$object = new MSuscriptores_contactos;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS
			$str = 'select sc.id, gs.id_suscriptor, sc.nombre, sc.type from gestion_suscriptores as gs inner join suscriptores_contactos as sc on sc.id = gs.id_suscriptor where id_gestion = "'.$id.'" ';

			$query = $con->Query($str);
			$i = 0;
			while ($roe = $con->FetchAssoc($query)) {
				$i++;
				$ts = $c->GetDataFromTable("suscriptores_tipos", "id", $roe['type'], "nombre"," ");
				echo "<option value='".$roe['id']."'>".$roe['nombre']." Tipo: ".$ts."</option>";
				#echo "<li class='list-group-item' onclick='AddDestinatarioRole(\"".."\", \"".$roe['nombre']."\", \"".$role."\")'></li>";
			}
		}

		function CotejarDocumento($id, $id_doc, $ruta, $nombre, $guia_id){

			global $con;
			global $c;
			global $f;
			
			$em = new MSuper_admin;
			$em->CreateSuper_admin("id", $_SESSION['id_empresa']);
			
			$MENSAJESERVIDORSALIDA = $em->GetP_nombre();
				
			$guia_id = substr($guia_id, 0, 20);
			echo "<li class='list-group-item'>Iniciando Cotejo de Documento: $nombre</li>";
# /*				
			##$pdf = new FPDI();
			##$pages_count = $pdf->setSourceFile($ruta); 

			$doc = new MGestion_anexos;
			$doc->CreateGestion_anexos("id", $id_doc);
			
			/*CAMBIAR VERSION PDF A 1.4*/
			$dataarchivo = $this->url_get_contents("https://s.siammservice.com/a/validarversionpdf.php?URL=".HOMEDIR.DS."app/archivos_uploads/gestion/".$doc->GetGestion_id().trim("/anexos/ ").$doc->GetUrl());
            file_put_contents($_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$doc->GetGestion_id().trim("/anexos/TEMP_").$doc->GetUrl()."", $dataarchivo);

			$nombre_usuario = $_SESSION['usuario'];

			$linkfile = HOMEDIR.DS."app/archivos_uploads/gestion/".$doc->GetGestion_id().trim("/anexos/ ").$doc->GetUrl();
		    $linkfile2 = "app/archivos_uploads/gestion/".$doc->GetGestion_id().trim("/anexos/ ").$doc->GetUrl();
		    //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);
		  	$path_file = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$doc->GetGestion_id().trim("/anexos/TEMP_").$doc->GetUrl()."";
		  	$path_file2 = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$doc->GetGestion_id().trim("/anexos/doc_").$doc->GetUrl()."";
		    $file = realpath($path_file);
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
	            $pdf->Write(0, 'COTEJADO POR '.$MENSAJESERVIDORSALIDA.", EL DÍA: ".date('d-m-Y')." a las ".date('H:i:s')." CÓDIGO DE SEGUIMIENTO: $guia_id");
	           	$pdf->AddPage($orientation);
	           	$pdf->useTemplate($tpl, null, null, $size['w'], $size['h'], true);
			
			}

			$pdf->Rect(3, 4, 180, 4, 'F', array(), array(255,255,255));	
		    $pdf->SetFont('Helvetica', 0, '8');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(3, 4);
            $pdf->Write(0, 'COTEJADO POR '.$MENSAJESERVIDORSALIDA.", EL DÍA: ".date('d-m-Y')." a las ".date('H:i:s')." CÓDIGO DE SEGUIMIENTO: $guia_id");
			$pdf->Output($path_file2, 'F');
#			print_r($size);
# * /
			$str = "INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file, id_servicio, typefile, peso) values ('".date("Y-m-d H:i:s")."', '".$id."', 'COTEJO DE ".$nombre."' , 'doc_".$doc->GetUrl()."', '$nombre_usuario', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."', '', 'application/PDF', '".$doc->GetPeso()."')";
			$con->Query($str);
			echo "<li class='list-group-item'>Documento $nombre Cotejado</li>";
#				exit;

		}
		function url_get_contents ($Url) {
            if (!function_exists('curl_init')){
                die('CURL is not installed!');
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $Url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }
        function GetPlantilla($idp, $emr, $radicado = ""){

        	global $con;
        	global $f;
        	global $c;

        	$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', $idp);

			$emailMessage = $MPlantillas_email->GetContenido();

			$ufirma = new MUsuarios;
			$ufirma->CreateUsuarios("user_id", $emr);

			$firmausuario = "Nombre: ".$ufirma->GetP_nombre()." ".$ufirma->GetP_apellido()."<br>Correo Electr&oacute;nico: ".$ufirma->GetEmail()."<br>Tel&eacute;fono: ".$ufirma->GetCelular()."<br>T.P.: ".$ufirma->GetUniversidad();
			$emailMessage = str_replace("[elemento]firmausuario[/elemento]", $firmausuario,   $emailMessage );
			$emailMessage = str_replace("[elemento]responsable[/elemento]", $_SESSION['nombre'],  $emailMessage );

			echo $emailMessage;


        }

        function CrearDocumentoNotificacion($html, $gestion_id, $notificado, $id_notificacion){
			global $con;
			global $c;
			global $f;

			$g = new MGestion;
			$g->CreateGestion("id", $gestion_id);

			$user = new MUsuarios;
			$user->CreateUsuarios("user_id", $_SESSION['usuario']);

			$pathp = "";
			$name = md5(date("Y-m-d H:i:s"))."N.pdf";
			$urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;

			$string = hash("sha256", $id.date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]);


			$html = str_replace("[elemento]TOKEN[/elemento]", "", $html); 
			$html = str_replace("[elemento]BOTON_ADJUNTOS[/elemento]", "", $html); 
			#	include(APP.'plugins/mix_images/index.php');

			$html = utf8_decode(html_entity_decode($html));
            $html2 = preg_replace('/>\s+</', '><', $html);
			$dompdf = new DOMPDF();

			$dompdf->set_paper('letter','');
			$dompdf->load_html($html2);
			ini_set("memory_limit","512M");
			$dompdf->render();

			$pdf = $dompdf->output();
			if (file_put_contents($urlfile, $pdf)) {
/*
*/
				$car = new MGestion_anexos;
				$tot  = $car->ListarGestion_anexos("WHERE gestion_id = '".$gestion_id."'");

				$fol = $con->NumRows($tot);
				$fol += 1;
				$user_id = $user->GetUser_id();

				$nombreanexo = "Notificación enviada Para $notificado";

				//base 64
				$base_file = '';
				#$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);
				#$base_file = base64_encode($data_base_file);
				$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file, id_servicio) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."', '$nombreanexo' ,'".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."', 'NOTX".$id_notificacion."')");

				$id = $c->GetMaxIdTabla("gestion_anexos", "id");

				$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado, type) VALUES ('".$id_notificacion."','".$id."','".date("Y-m-d H:i:s")."','0','0')");

				echo "<li class='list-group-item'>Notificacion exportada a anexos, resource Id # $id</li>";
				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"Actuaciones del Expediente Hasta ".date("Y-m-d H:i:s")."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, "6", "1", "1", "*", "expdpc", $id);
				#echo $idretorno."Documento Exportado a Anexos";
			}else{
				echo "<li class='list-group-item'>Se produjo un error al Exportar</li>";
			}
		}
		
		function QuePaso(){
			global $con;

			$query = $con->Query('SELECT t1.id, t1.gestion_id, t1.description, t1.fecha, t1.time, t1.user_id, t1.id_ext FROM events_gestion as t1 LEFT JOIN gestion_anexos as t2 ON t2.id = t1.id_ext WHERE t2.id IS NULL and t1.gestion_id != "" and t1.title = "CARGA DE DOCUMENTO" ORDER BY t1.gestion_id DESC');

			$vector = array();
			while($row = $con->FetchAssoc($query)){

				$nom = explode('Se ha cargado un documento llamado: "' , $row['description']);
				$nom = substr($nom[1], 0, -1);
				array_push($vector, array($row['gestion_id'], $nom, $row['fecha'], $row['time'], $row['user_id'], $row['id_ext'], $row['id']) );
			}

			echo '<table border="1">
					</tr>
						<td>i</td>
						<td>id_gestion</td>
						<td>nombre_archivo</td>
						<td>fecha_hora</td>
						<td>archivo_encontrado</td>
					</tr>';
			for($i = 0; $i < count($vector); $i++){
				$interno = $vector[$i];

				$q = $con->Query("select * from gestion_anexos where id = '".$interno[5]."'");
				$r = $con->FetchAssoc($q);

				if ($r['id'] == "") {
					$path = ROOT.DS."archivos_uploads/gestion/".$interno[0]."/anexos";
					$dir = opendir($path);
				    // Leo todos los ficheros de la carpeta
				    $archivos = "";
				    while ($elemento = readdir($dir)){
				        // Tratamos los elementos . y .. que tienen todas las carpetas
				        if( $elemento != "." && $elemento != ".."){
				            // Si es una carpeta
				            if( is_dir($path.$elemento) ){
				                // Muestro la carpeta
				            // Si es un fichero
				            } else {
				                // Muestro el fichero
				                
				                $qbusc = $con->Query("select * from gestion_anexos where url = '$elemento' and gestion_id = '".$interno[0]."'");
				                $qrs = $con->FetchAssoc($qbusc);
				                if ($qrs['id'] == "") {

				                	$fecha = date("Y-m-d H:i:s", filectime($path."/".$elemento));
									$masuno = strtotime ( '+1 second' , strtotime ( $fecha ) ) ;
									$masuno = date ( 'Y-m-d H:i:s' , $masuno );

									$fecha = date("Y-m-d H:i:s", filectime($path."/".$elemento));
									$menosuno = strtotime ( '-1 second' , strtotime ( $fecha ) ) ;
									$menosuno = date ( 'Y-m-d H:i:s' , $menosuno );
				                	/*
				                	if($interno[2].' '.$interno[3] == date("Y-m-d H:i:s", filectime($path."/".$elemento))){
				                		//$archivos.= "<br>".$elemento." - ".date("Y-m-d H:i:s", filectime($path."/".$elemento));
				                		$archivos.= $elemento;
				                	}
				                	*/
				                	/*
				                	if($interno[2].' '.$interno[3] >= $menosuno && $interno[2].' '.$interno[3] <= $masuno){

				                		$extb = explode(".", $elemento);
						                $extb = end($extb);

						                $extr = explode(".", $interno[1]);
						                $extr = end($extr);
						                if ($extr == $extb) {
						                }
						                $archivos.= $elemento;
						                break;
				                	}
				                	if ($interno[0] == "21094") {
				                		$archivos.= "5210491156ea47e89f7b6e88f38409c4.pdf";
				                	}
				                	if ($interno[0] == "17620") {
				                		$archivos.= "ee631c8d963bb5223c36c6846f684842.pdf";
				                	}
				                	*/
				                }

						    	/*
						    	if (trim($archivos) == "") {
						    		$qbusc = $con->Query("select * from gestion_anexos_firmas where anexo_id =  '".$interno[5]."'");
					                $qrs = $con->FetchAssoc($qbusc);
					                if ($qrs['id'] != "") {
					                	$fecha = date("Y-m-d H:i:s", filectime($path."/".$elemento));
										$masuno = strtotime ( '+10 second' , strtotime ( $fecha ) ) ;
										$masuno = date ( 'Y-m-d H:i:s' , $masuno );

										$fecha = date("Y-m-d H:i:s", filectime($path."/".$elemento));
										$menosuno = strtotime ( '-10 second' , strtotime ( $fecha ) ) ;
										$menosuno = date ( 'Y-m-d H:i:s' , $menosuno );

					                	if($qrs['fecha_firma'] >= $menosuno && $qrs['fecha_firma'] <= $masuno){
					                		//$archivos.= "<br>".$elemento." - ".$menosuno;
					                		$archivos.= $elemento;
					                	}
					                	//$archivos.= "<br>".$elemento." - ".date("Y-m-d H:i:s", filectime($path."/".$elemento));
					                	$interno[2] = $qrs['fecha_firma'];
					                	$interno[3] = "";
					                }
						    	}
						    	*/
				            }
				        }
				    }


				    if (strlen(trim($archivos)) == 36 || strlen(trim($archivos)) == 37) {
				    /*
				    	$con->Query("INSERT into gestion_anexos (id, timest, gestion_id, nombre, url, user_id, 	ip, fecha,hora,folio, 		 folder_id,	folio_final, is_publico, cantidad, orden, hash, base_file, typefile, peso, indice, hashx, soporte, checked, id_servicio) values ('$interno[5]', '".$interno[2].' '.$interno[3]."', '$interno[0]','".$interno[1]."','".$archivos."','$interno[4]', '$_SERVER[REMOTE_ADDR]', '".$interno[2]."', '".$interno[3]."', '1', '0', '0', '0', '0', '0', '','','application/PDF' ,'', '', '', '0', '0', '1')");
					*/
				    }

					echo '</tr>
							<td>'.$i.'</td>
							<td>'.$interno[0].'</td>
							<td>'.$interno[1].'</td>
							<td>'.$interno[2].' '.$interno[3].'</td>
							<td>'.$archivos.'</td>
						</tr>';
				}else{
					/*
					*/
					echo '</tr>
							<td style="background-color:#0F0">'.$i.'</td>
							<td style="background-color:#0F0">'.$interno[0].'</td>
							<td style="background-color:#0F0">'.$interno[1].'</td>
							<td style="background-color:#0F0">'.$interno[2].' '.$interno[3].'</td>
							<td style="background-color:#0F0"></td>
						</tr>';
				}
			}
			echo '</table>';

		}
	}
?>