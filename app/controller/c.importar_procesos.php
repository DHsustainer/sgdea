<?
session_start();
#date_default_timezone_set("America/Bogota");
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
$ob = new CImportar;
$c = new Consultas;
$f = new Funciones;
// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
if($c->sql_quote($_REQUEST['action']) == 'listar')
	$ob->VistaImportar('');	
	// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
elseif($c->sql_quote($_REQUEST['action']) == 'cargamasivainterna')
	$ob->ProcesarMasiva();
elseif($c->sql_quote($_REQUEST['action']) == 'correspondencia')
	$ob->VistaImportarCorrespondencia();
elseif($c->sql_quote($_REQUEST['action']) == 'viewgrid')
	$ob->ViewGrid($c->sql_quote($_REQUEST['id']));
elseif($c->sql_quote($_REQUEST['action']) == 'cargamasivacorrespondenciainterna')
	$ob->ProcesarCorrespondenciaMasiva();
elseif($c->sql_quote($_REQUEST['action']) == 'leertablaexcel')
	$ob->ReadForm();
else
// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
	$ob->VistaImportar('');		
// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
class CImportar extends MainController{

	function VistaImportarCorrespondencia(){

		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
		global $con;
		global $c;
		global $f;
		//CARGANDO LA PAGINA DE INTERFAZ			
		$object = new MSuscriptores_Contactos;
    	#$query = $object->ListarSuscriptores_modulos();
		$pagina = $this->load_template_limpiaAmple('Administracion de Metadatos');			
		// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
		// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
		ob_start();
		// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
    	include(VIEWS.DS."importar_procesos/index.php");	   			
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

	function ProcesarCorrespondenciaMasiva(){
		global $con;
		global $c;
		global $f;

		$archivo = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'].'/'.$_SESSION['filed'];
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
			$NOMBRE_DEL_DEMANDANTE_COL = "";
			$IDENTIFICACION_DEL_DEMANDANTE_COL = "";
			$CIUDAD_DEL_DEMANDANTE_COL = "";
			$DIRECCION_DEL_DEMANDANTE_COL = "";
			$TELEFONO_DEMANDANTE_COL = "";
			$EMAIL_DEMANDANTE_COL = "";
			$NOMBRE_DEL_DEMANDADO_COL = "";
			$NOMBRE_DEL_NOTIFICADO_COL = "";
			$IDENTIFICACION_DEL_NOTIFICADO_COL = "";
			$DEPARTAMENTO_NOTIFICADO_COL = "";
			$CIUDAD_NOTIFICADO_COL = "";
			$CODIGO_MUNICIPIO_COL = "";
			$DIRECCION_NOTIFICADO_COL = "";
			$EMAIL_NOTIFICADO_COL = "";
			$NOTIFICADO_PERSONA_NATURAL_SI_NO_COL = "";
			$TIPO_CORRESPONDENCIA_COL = "";
			$ASUNTO_COL = "";
			$RADICADO_COL = "";
			$EMAIL_PARTE_INTERESADA_COL = "";
			$JUZGADO_COL = "";
			$DIRECCION_JUZGADO_COL = "";
			$DEPARTAMENTO_JUZGADO_COL = "";
			$CIUDAD_JUZGADO_COL = "";
			$ARTICULO_COL = "";
			$NATURALEZA_PROCESO_COL = "";
			$HORARIO_JUZGADO_COL = "";
			$DIAS_PARA_COMPARECER_COL = "";
			$ANEXO_COL = "";
			$FECHA_PROVIDENCIA_COL = "";
			$NUMERO_OBLIGACION_COL = "";

			

			$refcol_anexo = "";
			echo "<ul class='list-group'>";
			/*
			$con->Query('truncate table meta_big_data');
			$con->Query('truncate table gestion');
			$con->Query('truncate table alertas');
			$con->Query('truncate table events_gestion');
			$con->Query('truncate table gestion_suscriptores');
			$con->Query('truncate table gestion_compartir');
			#$con->Query('truncate table suscriptores_contactos');
			#$con->Query('truncate table suscriptores_contactos_direccion');
			*/
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



					#RECORRO LA COLUMNA
					for ($col = 0; $col < $highestColumnIndex; ++ $col){

						$val = "";
						$cell = $worksheet->getCellByColumnAndRow( $col , $row );
						$val = $cell->getValue();
						$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
						#Codigo Supremamente importante para el patron de recocimiento.
						
						# code...
						if($row == 1 && strlen($val) > 0){
							$arrCabecera[$col] = $val;
						}

						if($row > 1 && strlen($val) > 0){
							$arrFilas[$col] = $val;
						}


						if($row == 1){
							switch (trim($val)) {
								case 'NOMBRE_DEL_DEMANDANTE': $NOMBRE_DEL_DEMANDANTE_COL = $col; break;
								case 'IDENTIFICACION_DEL_DEMANDANTE': $IDENTIFICACION_DEL_DEMANDANTE_COL = $col; break;
								case 'CIUDAD_DEL_DEMANDANTE': $CIUDAD_DEL_DEMANDANTE_COL = $col; break;
								case 'DIRECCION_DEL_DEMANDANTE': $DIRECCION_DEL_DEMANDANTE_COL = $col; break;
								case 'TELEFONO_DEMANDANTE': $TELEFONO_DEMANDANTE_COL = $col; break;
								case 'EMAIL_DEMANDANTE': $EMAIL_DEMANDANTE_COL = $col; break;
								case 'NOMBRE_DEL_DEMANDADO': $NOMBRE_DEL_DEMANDADO_COL = $col; break;
								case 'NOMBRE_DEL_NOTIFICADO': $NOMBRE_DEL_NOTIFICADO_COL = $col; break;
								case 'IDENTIFICACION_DEL_NOTIFICADO': $IDENTIFICACION_DEL_NOTIFICADO_COL = $col; break;
								case 'DEPARTAMENTO_NOTIFICADO': $DEPARTAMENTO_NOTIFICADO_COL = $col; break;
								case 'CIUDAD_NOTIFICADO': $CIUDAD_NOTIFICADO_COL = $col; break;
								case 'CODIGO_MUNICIPIO': $CODIGO_MUNICIPIO_COL = $col; break;
								case 'DIRECCION_NOTIFICADO': $DIRECCION_NOTIFICADO_COL = $col; break;
								case 'EMAIL_NOTIFICADO': $EMAIL_NOTIFICADO_COL = $col; break;
								case 'NOTIFICADO_PERSONA_NATURAL_SI_NO': $NOTIFICADO_PERSONA_NATURAL_SI_NO_COL = $col; break;
								case 'TIPO_CORRESPONDENCIA': $TIPO_CORRESPONDENCIA_COL = $col; break;
								case 'ASUNTO': $ASUNTO_COL = $col; break;
								case 'RADICADO': $RADICADO_COL = $col; break;
								case 'EMAIL_PARTE_INTERESADA': $EMAIL_PARTE_INTERESADA_COL = $col; break;
								case 'JUZGADO': $JUZGADO_COL = $col; break;
								case 'DIRECCION_JUZGADO': $DIRECCION_JUZGADO_COL = $col; break;
								case 'DEPARTAMENTO_JUZGADO': $DEPARTAMENTO_JUZGADO_COL = $col; break;
								case 'CIUDAD_JUZGADO': $CIUDAD_JUZGADO_COL = $col; break;
								case 'ARTICULO': $ARTICULO_COL = $col; break;
								case 'NATURALEZA_PROCESO': $NATURALEZA_PROCESO_COL = $col; break;
								case 'HORARIO_JUZGADO': $HORARIO_JUZGADO_COL = $col; break;
								case 'DIAS_PARA_COMPARECER': $DIAS_PARA_COMPARECER_COL = $col; break;
								case 'ANEXO': $ANEXO_COL = $col; break;
								case 'FECHA_PROVIDENCIA': $FECHA_PROVIDENCIA_COL = $col; break;
								case 'NUMERO_OBLIGACION': $NUMERO_OBLIGACION_COL = $col; break;
								default: break;
							}
						}else{

							if ($col == $refcol) {
								$suscriptor = $val;
							}


						}

						if ($row != 1) {
							#echo "Fila $row - Columna $col = $val <br>";
							# code...
						}
					} #ESTE CIERRA FOR DE LA FILA SOLO NECESITO REFCOL, 1


					if($suscriptor != ""){

						#echo "-->".$tipo_documento;
						#exit;
						
						$countfilas++;

						$tipo_d = $con->Query("select id, dependencia from dependencias where id = '".$tipo_documento."' ");
						$tipo_dq = $con->FetchAssoc($tipo_d);	
						$id_dependencia_raiz = $tipo_dq['dependencia'];	
												
						
						$cellmeta = $worksheet->getCellByColumnAndRow( $NOMBRE_DEL_DEMANDANTE_COL, $row );
						$NOMBRE_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $IDENTIFICACION_DEL_DEMANDANTE_COL, $row );
						$IDENTIFICACION_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $CIUDAD_DEL_DEMANDANTE_COL, $row );
						$CIUDAD_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $DIRECCION_DEL_DEMANDANTE_COL, $row );
						$DIRECCION_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $TELEFONO_DEMANDANTE_COL, $row );
						$TELEFONO_DEMANDANTE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $EMAIL_DEMANDANTE_COL, $row );
						$EMAIL_DEMANDANTE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $NOMBRE_DEL_DEMANDADO_COL, $row );
						$NOMBRE_DEL_DEMANDADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $NOMBRE_DEL_NOTIFICADO_COL, $row );
						$NOMBRE_DEL_NOTIFICADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $IDENTIFICACION_DEL_NOTIFICADO_COL, $row );
						$IDENTIFICACION_DEL_NOTIFICADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $DEPARTAMENTO_NOTIFICADO_COL, $row );
						$DEPARTAMENTO_NOTIFICADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $CIUDAD_NOTIFICADO_COL, $row );
						$CIUDAD_NOTIFICADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $CODIGO_MUNICIPIO_COL, $row );
						$CODIGO_MUNICIPIO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $DIRECCION_NOTIFICADO_COL, $row );
						$DIRECCION_NOTIFICADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $EMAIL_NOTIFICADO_COL, $row );
						$EMAIL_NOTIFICADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $NOTIFICADO_PERSONA_NATURAL_SI_NO_COL, $row );
						$NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $TIPO_CORRESPONDENCIA_COL, $row );
						$TIPO_CORRESPONDENCIA_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $ASUNTO_COL, $row );
						$ASUNTO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $RADICADO_COL, $row );
						$RADICADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $EMAIL_PARTE_INTERESADA_COL, $row );
						$EMAIL_PARTE_INTERESADA_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $JUZGADO_COL, $row );
						$JUZGADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $DIRECCION_JUZGADO_COL, $row );
						$DIRECCION_JUZGADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $DEPARTAMENTO_JUZGADO_COL, $row );
						$DEPARTAMENTO_JUZGADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $CIUDAD_JUZGADO_COL, $row );
						$CIUDAD_JUZGADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $ARTICULO_COL, $row );
						$ARTICULO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $NATURALEZA_PROCESO_COL, $row );
						$NATURALEZA_PROCESO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $HORARIO_JUZGADO_COL, $row );
						$HORARIO_JUZGADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $DIAS_PARA_COMPARECER_COL, $row );
						$DIAS_PARA_COMPARECER_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $ANEXO_COL, $row );
						$ANEXO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $FECHA_PROVIDENCIA_COL, $row );
						$FECHA_PROVIDENCIA_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $NUMERO_OBLIGACION_COL, $row );
						$NUMERO_OBLIGACION_VALOR = $cellmeta->getValue();


						$suscriptores = array();
						#REGISTRO DEL DEMANDANTE
						$suscriptor_id = "";
						$sid = "";
						$snm = "";


						$idd = $IDENTIFICACION_DEL_DEMANDANTE_VALOR;
						$idm = $NOMBRE_DEL_DEMANDANTE_VALOR;
						if ($idd != "" & $idd != "0") {
							$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$idd' and user_id = '".$_SESSION['usuario']."'");
							$dataqd = $con->FetchAssoc($qd);
							if ($dataqd['id'] == "") {
								$suscrr = new MSuscriptores_contactos;
								$createsuscr = $suscrr->InsertSuscriptores_contactos($idd, $idm, "1", $_SESSION['usuario'], date("Y-m-d"));

								$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
								$suscd = new MSuscriptores_contactos_direccion;

								$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, $DIRECCION_DEL_DEMANDANTE_VALOR, $CIUDAD_DEL_DEMANDANTE_VALOR, $TELEFONO_DEMANDANTE_VALOR, $EMAIL_DEMANDANTE_VALOR, "");
							}else{
								$suscriptor_id = $dataqd['id'];
							}
							array_push($suscriptores, $suscriptor_id);
						}
						if ($i == 0) {
							$sus = new MSuscriptores_contactos;
							$sus->CreateSuscriptores_contactos("id", $suscriptor_id);

							$sid = $sus->GetId();
							$snm = $sus->GetNombre();
						}
						#echo "Demandado: ".$IDENTIFICACION_DEL_DEMANDADO_VALOR[$i]." Suscriptor: $sid - $snm<br>";
						
						$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$IDENTIFICACION_DEL_DEMANDANTE_VALOR' and user_id = '".$_SESSION['usuario']."'");
						$dataqd = $con->FetchAssoc($qd);
						if ($dataqd['id'] == "") {
							$suscrr = new MSuscriptores_contactos;
							$createsuscr = $suscrr->InsertSuscriptores_contactos($IDENTIFICACION_DEL_DEMANDANTE_VALOR, $NOMBRE_DEL_DEMANDANTE_VALOR, "26", $_SESSION['usuario'], date("Y-m-d"));

							$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
							$suscd = new MSuscriptores_contactos_direccion;

							$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, "", $CIUDAD_ORIGEN_VALOR, "", $EMAIL_NOTIFICADO_VALOR, "");
						}else{
							$suscriptor_id = $dataqd['id'];
						}
						array_push($suscriptores, $suscriptor_id);
						#FIN REGISTRO DEL DEMANDANTE

						#REGISTRO DEL DEMANDADO
						$suscriptor_id = "";
						$sid = "";
						$snm = "";


						$idd = $IDENTIFICACION_DEL_NOTIFICADO_VALOR;
						$idm = $NOMBRE_DEL_NOTIFICADO_VALOR;
						if ($idd != "" & $idd != "0") {
							$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$idd' and user_id = '".$_SESSION['usuario']."'");
							$dataqd = $con->FetchAssoc($qd);
							if ($dataqd['id'] == "") {
								$suscrr = new MSuscriptores_contactos;
								$createsuscr = $suscrr->InsertSuscriptores_contactos($idd, $idm, "27", $_SESSION['usuario'], date("Y-m-d"));

								$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
								$suscd = new MSuscriptores_contactos_direccion;

								$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, $DIRECCION_NOTIFICADO_VALOR, $CIUDAD_NOTIFICADO_VALOR, "", "", "");
							}else{
								$suscriptor_id = $dataqd['id'];
							}
							array_push($suscriptores, $suscriptor_id);
						}
						if ($i == 0) {
							$sus = new MSuscriptores_contactos;
							$sus->CreateSuscriptores_contactos("id", $suscriptor_id);

							$sid = $sus->GetId();
							$snm = $sus->GetNombre();
						}
						#echo "Demandado: ".$IDENTIFICACION_DEL_DEMANDADO_VALOR[$i]." Suscriptor: $sid - $snm<br>";
						
						$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$IDENTIFICACION_DEL_DEMANDANTE_VALOR' and user_id = '".$_SESSION['usuario']."'");
						$dataqd = $con->FetchAssoc($qd);
						if ($dataqd['id'] == "") {
							$suscrr = new MSuscriptores_contactos;
							$createsuscr = $suscrr->InsertSuscriptores_contactos($IDENTIFICACION_DEL_DEMANDANTE_VALOR, $NOMBRE_DEL_DEMANDANTE_VALOR, "26", $_SESSION['usuario'], date("Y-m-d"));

							$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
							$suscd = new MSuscriptores_contactos_direccion;

							$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, "", $CIUDAD_ORIGEN_VALOR, "", $EMAIL_NOTIFICADO_VALOR, "");
						}else{
							$suscriptor_id = $dataqd['id'];
						}
						array_push($suscriptores, $suscriptor_id);
						#FIN REGISTRO DEL DEMANDADO
						#print_r($suscriptores);
						#echo "<hr>";
						
						

						$u = new MUsuarios;
						$u->CreateUsuarios('user_id', $_SESSION['usuario']);

						#echo "Nombre del Usuario: ".$u->GetP_nombre()."<br>";
						$se = new MSeccional;
						$se->CreateSeccional("id", $u->GetSeccional());

						$sp = new MSeccional_principal;
						$sp->CreateSeccional_principal("ciudad_origen", $se->GetCiudad());

						$s = new MSuscriptores_contactos;
						$s->CreateSuscriptores_contactos("id", $sid);

						$ss = new MSuscriptores_contactos_direccion;
						$ss->CreateSuscriptores_contactos_direccion("id_contacto", $s->GetId());

						$d = new MDependencias;
						$d->CreateDependencias("id", $tipo_documento);

						$dr = new MDependencias;
						$dr->CreateDependencias("id", $id_dependencia_raiz);

						$a = new MAreas;
						$a->CreateAreas("id", $u->GetRegimen());

						$radicado = $RADICADO_VALOR;
						$f_recibido = date("Y-m-d");
						$nombre_radica = $s->GetNombre();
						$folio = "0";
						$dependencia_destino = $u->GetRegimen();
						$nombre_destino = $u->GetA_i();
						$fecha_vencimiento = "";
						$estado_respuesta = "Activo";
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
						$campot1  =  $JUZGADO_VALOR;
						$campot2  =  $DIRECCION_JUZGADO_VALOR;
						$campot3  =  $DEPARTAMENTO_JUZGADO_VALOR;
						$campot4  =  $CIUDAD_JUZGADO_VALOR;
						$campot5  =  $ARTICULO_VALOR;
						$campot6  =  $NATURALEZA_PROCESO_VALOR;
						$campot7  =  $HORARIO_JUZGADO_VALOR;

						$campot8  =  $DIAS_PARA_COMPARECER_VALOR;
						$campot9  =  $ANEXO_VALOR;
						$campot10 =  $NUMERO_OBLIGACION_VALOR;
						$campot11 =  $FECHA_PROVIDENCIA_VALOR;
						$campot12 =  "";
						$campot13 =  "";
						$campot14 =  "";
						$campot15 =  "";

						$estado_personalizado = 0;
						

						$object = new MGestion;
						#print_r($_REQUEST);
						$nr = $object->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);
						$minr = $object->GetMinRadicado();

						// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
						$create = $object->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $ASUNTO_VALOR, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida, "0", $observacion2, "0", $campot1, $campot2, $campot3, $campot4, $campot5, $campot6, $campot7, $campot8, $campot9, $campot10, $campot11, $campot12, $campot13, $campot14, $campot15, $estado_personalizado);

						$id = $c->GetMaxIdTabla("gestion", "id");

						$filename=UPLOADS.DS.$id.'/';
						if (!file_exists($filename)) {
						    mkdir(UPLOADS.DS . $id, 0777);
						}
						$filename=UPLOADS.DS.$id.'/anexos/';
						if (!file_exists($filename)) {
						    mkdir(UPLOADS.DS . $id.'/anexos', 0777);
						}

						for ($j=0; $j < count($suscriptores) ; $j++) { 
							# code...
							$gs = new MGestion_suscriptores();
							$gs->InsertGestion_suscriptores($id, $suscriptores[$j], $u->GetUser_id(), "1", "1", date("Y-m-d"));
						}



		#ENVIO DE NOTIFICACIÓN O GENERACIÓN DE NOTIFICACIONES
					#	"CC"
					#	"CE"
					#	"CC/CE"
						$it = "";
						$nt = "";
						$tm = "";

						if ($TIPO_CORRESPONDENCIA_VALOR == "Correo Físico y Correo Electrónico Certificado") {
							$TIPO_CORRESPONDENCIA_VALOR = "CC/CE";
						}
						if ($TIPO_CORRESPONDENCIA_VALOR == "Correo Físico") {
							$TIPO_CORRESPONDENCIA_VALOR = "CC";
						}
						if ($TIPO_CORRESPONDENCIA_VALOR == "Correo Electrónico Certificado") {
							$TIPO_CORRESPONDENCIA_VALOR = "CE";
						}
						

						if ($TIPO_CORRESPONDENCIA_VALOR == "CC/CE") {
							$it = "2";
						}else{
							$nt = $TIPO_CORRESPONDENCIA_VALOR;
							$it = "1";
						}

						for ($k=0; $k < $it ; $k++) { 
							if ($TIPO_CORRESPONDENCIA_VALOR == "CC/CE") {
								if ($k == "0") {
									$nt = "CC";
								}else{
									$nt = "CE";
								}
							}else{
								$nt = $TIPO_CORRESPONDENCIA_VALOR;
							}
							
							if ($nt == "CC") {
								$tm = $DIRECCION_NOTIFICADO_VALOR;
							}else{
								$tm =  $EMAIL_NOTIFICADO_VALOR;
							}

							$remitente = $NOMBRE_DEL_DEMANDANTE_VALOR;
							$user_id = $_SESSION['usuario'];

							
							if ($remitente == "") {
								$remitente = $u->GetP_nombre()." ".$u->GetP_apellido();
							}

							$demandado = $DIRECCION_NOTIFICADO_VALOR." ".$CIUDAD_NOTIFICADO_VALOR;

							$object = new MNotificaciones;
							// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
							$create = $object->InsertNotificaciones($_SESSION['usuario'], $id, $suscriptores[1], $nt, 'jRNCGxg4RCgpIs14UoLq3vkUTGSDHlB0jdgenRD0SMY=', date("Y-m-d"), '0', '', $tm, $campot8, '', '', $NOMBRE_DEL_DEMANDADO_VALOR, $suscriptores[1]);
							

							$g = new MGestion;
							$g->CreateGestion("id", $id);



							$oname = UPLOADS.DS.$_SESSION['smallid'].DS;  
							$nname = UPLOADS.DS.$g->GetId().DS; 

							if($_SESSION['smallid'] != ''){
								$f->copia($oname, $nname);
								#echo "Espere un momento...";			
							}

							//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
							$sq = $con->Query("select * from gestion_anexos where gestion_id = '".$g->GetId()."' and url != '' ");

							$max = $c->GetMaxIdTabla("notificaciones", "id");

							$ufirma = new MUsuarios;
							$ufirma->CreateUsuarios("user_id", $_SESSION['usuario']);

/*$IDENTIFICACION_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();
$CIUDAD_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();
$DIRECCION_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();
$TELEFONO_DEMANDANTE_VALOR = $cellmeta->getValue();
$EMAIL_DEMANDANTE_VALOR = $cellmeta->getValue();
$NOMBRE_DEL_DEMANDADO_VALOR = $cellmeta->getValue();
$NOMBRE_DEL_NOTIFICADO_VALOR = $cellmeta->getValue();
$IDENTIFICACION_DEL_NOTIFICADO_VALOR = $cellmeta->getValue();
$DEPARTAMENTO_NOTIFICADO_VALOR = $cellmeta->getValue();
$CIUDAD_NOTIFICADO_VALOR = $cellmeta->getValue();
$DIRECCION_NOTIFICADO_VALOR = $cellmeta->getValue();
$EMAIL_NOTIFICADO_VALOR = $cellmeta->getValue();
$NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR = $cellmeta->getValue();
$TIPO_CORRESPONDENCIA_VALOR = $cellmeta->getValue();*/

							$datoenvio = [];
							$datoenvio['files'] = [];

							$datoenvio['data'] = array( "observacion" => $ASUNTO_VALOR, "ciudad" => $CODIGO_MUNICIPIO_VALOR, "radicado" => $RADICADO_VALOR, "responsble_firma" => $EMAIL_PARTE_INTERESADA_VALOR,"nombre_abogado" => $ufirma->GetP_nombre()." ".$ufirma->GetP_apellido(), "email_abogado" => $EMAIL_PARTE_INTERESADA_VALOR, "cedula_abogado" => $ufirma->GetId(), "direccion_abogado" => $ufirma->GetDireccion(), "telefono_abogado" => $ufirma->GetTelefono(), "tarjeta_profesional_abogado" => $ufirma->GetUniversidad(), "cargo_abogado" => $ufirma->GetT_profesional(), "cedula_expedicion_abogado" => "", "campot1" => $JUZGADO_VALOR, "campot2" => $DIRECCION_JUZGADO_VALOR, "campot3" => $DEPARTAMENTO_JUZGADO_VALOR, "campot4" => $CIUDAD_JUZGADO_VALOR, "campot5" => $ARTICULO_VALOR, "campot6" => $NATURALEZA_PROCESO_VALOR, "campot7" => $HORARIO_JUZGADO_VALOR, "campot8" => $DIAS_PARA_COMPARECER_VALOR, "campot9" => $ANEXO_VALOR, "campot10" => $NUMERO_OBLIGACION_VALOR, "campot11" => $FECHA_PROVIDENCIA_VALOR, "campot12" => "", "campot13" => "", "campot14" => "", "num_oficio_respuesta" => "", "documento_salida" => "N" , "es_externo" => "NO" , "g_id" => "N" ,"nombre_radica" => $NOMBRE_DEL_DEMANDANTE_VALOR, "usuario_registra" => $_SESSION['usuario'],  "g_id_text" => "", "comparecer" => $DIAS_PARA_COMPARECER_VALOR, "spostal" => "jRNCGxg4RCgpIs14UoLq3vkUTGSDHlB0jdgenRD0SMY=", "notif_tipo_documento" => "Correspondencia Judicial", "dtform" => array([0] => $suscriptores[1]), "suscriptor_id" => $suscriptor_id, "nombresuscriptor" => $nombre_radica, "Type_suscriptor" => $s->GetType(), "Identificacion_suscriptor" => $s->GetIdentificacion(), "Ciudad_suscriptor" => $ss->GetCiudad(), "Direccion_suscriptor" => $ss->GetDireccion(), "Telefonos_suscriptor" => $ss->GetTelefonos(), "Email_suscriptor" => $ss->GetEmail(), "nombre_destinatario" => array(0 => $NOMBRE_DEL_DEMANDADO_VALOR) , "tipo_destinatario" => array(0 => "26") , "identificacion_destinatario" => array(0 => $IDENTIFICACION_DEL_NOTIFICADO_VALOR) , "departamento_destinatario" => array(0 => "") , "namecity" => array(0 => $CIUDAD_NOTIFICADO_VALOR) , "ciudad_destinatario" => array(0 => $CODIGO_MUNICIPIO_VALOR) , "direccion_destinatario" => array(0 => $DIRECCION_NOTIFICADO_VALOR) , "telefono_destinatario" => array(0 => "") , "email_destinatario" => array(0 => $EMAIL_NOTIFICADO_VALOR) , "es_juridica" => array(0 => $NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR) , "titulo" => array(0 => $nt) ,"email_abogado" => $ufirma->GetEmail(), "cedula_abogado" => $ufirma->GetId(), "direccion_abogado" => $ufirma->GetDireccion(), "telefono_abogado" => $ufirma->GetTelefono(), "tarjeta_profesional_abogado" => $ufirma->GetUniversidad(), "cargo_abogado" => $ufirma->GetT_profesional(), "cedula_expedicion_abogado" => "", "departamento" => "", "oficina" => "", "dependencia_destino" => "", "areatemp" => "" , "nombre_destino" => "" , "id_dependencia_raiz" => "" , "tipo_documento" => "" , "autorad" => "" , "folio" => "", "num_oficio_respuesta_hid" => "", "anho_rad" => "" , "f_recibido" => date("Y-m-d"), "fecha_vencimiento" => "", "prioridad" => "", "estado_solicitud" => "" , "estado_respuesta" => "" , "fecha_respuesta" => "" , "estado_archivo" => "" , "observacion2" => "" );

							$datoenvio['data_destinatario'] = array("nombre_destinatario" => $NOMBRE_DEL_NOTIFICADO_VALOR, 'nombre_demandado' => $NOMBRE_DEL_DEMANDADO_VALOR, 'identificacion_destinatario'=>$IDENTIFICACION_DEL_NOTIFICADO_VALOR, 'direccion_destinatario'=>$DIRECCION_NOTIFICADO_VALOR, 'ciudad_destinatario'=>$CODIGO_MUNICIPIO_VALOR, 'telefono_destinatario'=>'', 'email_destinatario'=>$EMAIL_NOTIFICADO_VALOR, 'es_juridica'=>$NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR, 'GetSeccional_siamm'=>$u->GetSeccional_siamm(), 'titulo'=>$nt, 'nombre_abogado' => $ufirma->GetP_nombre()." ".$ufirma->GetP_apellido() , 'email_abogado' => $ufirma->GetEmail(), 'cedula_abogado' => $ufirma->GetId(), 'tarjeta_profesional_abogado' => $ufirma->GetUniversidad(), 'cargo_abogado' => $ufirma->GetT_profesional(), 'firma_abogado' => $ufirma->GetFirma());
							
							while ($archivos = $con->FetchAssoc($sq)) {
								#echo $archivos['id'];
								$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado, type) VALUES ('".$max."','".$archivos['id']."','".date("Y-m-d H:i:s")."','0','0')");

								$ga = new MGestion_anexos;
								$ga->CreateGestion_anexos("id", $archivos['id']);

								$c->SendContabilizadorDocumentos($ga->GetCantidad(), $g->GetTipo_documento(), $g->GetId(), "NT");	


								//$rutaDoc = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";
								$rutaDoc = UPLOADS.DS.$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";
								//$b64Doc = chunk_split(base64_encode(file_get_contents($rutaDoc)));
								$b64Doc = (base64_encode(file_get_contents($rutaDoc)));
								$nombreDoc = $ga->GetNombre();
								$ce = explode('.',$nombreDoc);
								if(count($ce) <= 1){
									$ac = explode('.',$ga->GetUrl());
									$ext = end($ac);
									$nombreDoc = $nombreDoc.'.'.$ext;
								}
								if($b64Doc != ''){
									$datoenvio['files'][] = [$nombreDoc,$b64Doc];
								}else{
									echo "Error al con los archivos ";
									exit;
								}

							}
							#print_r($datoenvio); echo "<hr>";
							$form_id = base64_encode(serialize($datoenvio));

							$nom = $remitente;
							$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);
			                $error = $cliente->getError();
			                if ($error) {
			                    echo "Error <h2>Constructor error</h2><pre>" . $error . "</pre>";
			                }

			                $array = array("id" => 'jRNCGxg4RCgpIs14UoLq3vkUTGSDHlB0jdgenRD0SMY=');
			                $result = $cliente->call("GetDetalleOperador", $array);                 
			                if ($cliente->fault) {
			                    echo "Error <h2>Fault</h2><pre>";
			                    echo "</pre>";
			                }else{
			                    $error = $cliente->getError();
			                    if ($error) {
			                        echo "Error <h2>Error</h2><pre>" . $error . "</pre>";
			                    }else {
			                        if ($result == "") {
			                            echo "Error No se creo el WS";
			                        }else{
			                            $x  = explode(",", $result);
			            				$id_postal = $x[1];
			            				$nomPostal = $x[0];
			                        }
			                    }
			                }

							$con->Query("UPDATE notificaciones set nombre_postal = '".$nomPostal."'  where id = '".$max."'");
							$url = $id_postal;

							$cliente = new nusoap_client($url, true);
						    $error = $cliente->getError();
						    if ($error) {
						        echo "Error <h2>Constructor error</h2><pre>" . $error . "</pre>";
						    }

						   $array = array("user_id" => $_SESSION['usuario'], "message_id" => $max, "direccion" => $DIRECCION_NOTIFICADO_VALOR, "rid" => $id , "type" => $nt, "nombre" => $nom, "destinatario" => $NOMBRE_DEL_NOTIFICADO_VALOR, "url" => $urls_archivos, "juzgado" => $JUZGADO_VALOR, "naturaleza" => $NATURALEZA_PROCESO_VALOR, "radicado" => $radicado, "demandado" => $NOMBRE_DEL_DEMANDADO_VALOR , "remitente" => $remitente, "anexos" => $dcontenido, "keyword" => $_SERVER['HTTP_HOST'], "link" => $_SESSION['71c029wus3yJWEN'], "form" => $form_id );			      
						    $result = $cliente->call("InsertNotification", $array);	  

						  #   print_r($array); echo "<hr>";  

						    if ($cliente->fault) {
						        echo "Error <h2>Fault</h2><pre>";
						        echo "</pre>";
						    }else{
						        $error = $cliente->getError();

						        if ($error) {
						            echo "Error <h2>Error</h2><pre>" . $error . "</pre>";
						        }else {
									if ($result == "") {
										echo "Error No se creo el WS";
									}else{
										#echo "Servicio registrado y enviado a la empresa: ".$nomPostal;
									}
						        }
						    }
					    }

		# FIN GENERACIÓN DE NOTIFICACIONES...

					/*
						$call = "*";
						if ($nombre_destino == "0") {
							$call = "*";
						}elseif ($nombre_destino == "-1") {
							$call = "areaboss";
						}else{
							$call = $nombre_destino;
						}

						$objecte = new MEvents_gestion;

						$objecte->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Historico de Actuaciones", $ACTUACIONES_VALOR,			 date("Y-m-d"), 1, date("H:i:s"), 1, 0, 1, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $call, "ev",  $id);
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
				
						if($COMPARTIR_CON_VALOR != ""){
							#echo $COMPARTIR_CON_VALOR;
							if ($COMPARTIR_CON_VALOR == "*") {
							#	echo "Compartir con todos!";
								
								$COMPARTIR_CON_VALOR = "";
								$lits = $con->Query("select * from usuarios where regimen = '".$u->GetRegimen()."' and seccional = '".$u->GetSeccional()."'");

								#echo "select * from usuarios where regimen = '".$u->GetRegimen()."' and seccional = '".$u->GetSeccional()."'";

								$i = 0;

								while ($rrrx = $con->FetchAssoc($lits)) {

									$COMPARTIR_CON_VALOR .= $rrrx['user_id'].";";

									$cantidadusuariosagregados = explode(";", $COMPARTIR_CON_VALOR);
									for ($k=0; $k < count($cantidadusuariosagregados); $k++) {

										$MUsuarios = new MUsuarios;
										$MUsuarios->CreateUsuarios("user_id", $cantidadusuariosagregados[$k]);

										if($MUsuarios->GetA_i() != ""){

											$MGestion_compartir = new MGestion_compartir;
											$create = $MGestion_compartir->InsertGestion_compartir($u->GetUser_id(), $MUsuarios->GetUser_id(), $id, date("Y-m-d H:i:s"), "Compartido desde Carga Masiva", "1", "0", "0");

											$idg_c = $c->GetMaxIdTabla("gestion_compartir", "id");
											$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();
											$MSolicitudes_documentos = new MSolicitudes_documentos;
											$MSolicitudes_documentos->InsertSolicitudes_documentos($MUsuarios->GetUser_id(), $u->GetUser_id(), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), "", $id, "Compartido desde Carga Masiva", "1");

											$MEvents_gestion = new MEvents_gestion;
											$MEvents_gestion->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Expediente Compartido", "Se ha compartido el expediente con el usuario $username", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $MUsuarios->GetA_i(), "comp", $idg_c);

										}
									}


								}
							}else{
								#echo "Comparto con algunos";
								$cantidadusuariosagregados = explode(";", $COMPARTIR_CON_VALOR);
								for ($k=0; $k < count($cantidadusuariosagregados); $k++) {

									$MUsuarios = new MUsuarios;
									$MUsuarios->CreateUsuarios("user_id", $cantidadusuariosagregados[$k]);

									if($MUsuarios->GetA_i() != ""){

										$MGestion_compartir = new MGestion_compartir;
										$create = $MGestion_compartir->InsertGestion_compartir($u->GetUser_id(), $MUsuarios->GetUser_id(), $id, date("Y-m-d H:i:s"), "Compartido desde Carga Masiva", "1", "0", "0");

										$idg_c = $c->GetMaxIdTabla("gestion_compartir", "id");
										$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();
										$MSolicitudes_documentos = new MSolicitudes_documentos;
										$MSolicitudes_documentos->InsertSolicitudes_documentos($MUsuarios->GetUser_id(), $u->GetUser_id(), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), "", $id, "Compartido desde Carga Masiva", "1");

										$MEvents_gestion = new MEvents_gestion;
										$MEvents_gestion->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Expediente Compartido", "Se ha compartido el expediente con el usuario $username", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $MUsuarios->GetA_i(), "comp", $idg_c);

									}
								}
								
							}
						}	
					*/	


						#$con->Query("update gestion_anexos set gestion_id = '".$g->GetId()."', is_publico = '1' where id_servicio = '".$mys_id."' and ip = '".$_SERVER['REMOTE_ADDR']."'");
						#$archivo = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'].'/file_'.$_SESSION['suscriptor_id'].'.xlsx';
						#$oname = UPLOADS.DS."tmp_base/".$_SESSION['smallid'].DS;  
						#$nname = UPLOADS.DS.$g->GetId().DS."anexos/"; 
						#$f->copia($oname, $nname);
						#unset($mys_id);
						#echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/"</script>';
					}
					if ($row != 1) {
						echo "<li class='list-group-item'>Expediente <a href='/gestion/ver/".$id."/correspondencia/' target='_blank'>$radicado</a> Registrado Correctamente</li>";
						#echo "Fila $row - Columna $col = $val <br>";
						# code...
					}
					$cellmeta = $worksheet->getCellByColumnAndRow( 1 , $row );
					$checker = $cellmeta->getValue();
					if ($checker == "") {
						echo "		<li class=' list-group-item alert alert-success'>$countfilas Expedientes Creados!</div>";
						echo  "</ul>";
						#unset($_SESSION['smallid']);
						exit;
					}
				}
			}
		}
		
	}


	function VistaImportar(){

		//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
		global $con;
		global $c;
		global $f;
		//CARGANDO LA PAGINA DE INTERFAZ			
		$object = new MSuscriptores_Contactos;
    	#$query = $object->ListarSuscriptores_modulos();
		$pagina = $this->load_template_limpiaAmple('Administracion de Metadatos');			
		// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
		// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
		ob_start();
		// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		#echo "hola";
    	include(VIEWS.DS."importar_procesos/index_procesos.php");	   			
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

	function ProcesarMasiva(){
		global $con;
		global $c;
		global $f;

		$archivo = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'].'/'.$_SESSION['filed'];
		
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

			$NOMBRE_DEL_DEMANDANTE_COL = "";
			$IDENTIFICACION_DEL_DEMANDANTE_COL = "";
			$NOMBRE_DEL_DEMANDADO_COL = "";
			$IDENTIFICACION_DEL_DEMANDADO_COL = "";

			$APODERADO_DEMANDANTE_NOMBRE_COL = "";
			$APODERADO_DEMANDANTE_IDENTIFICACION_COL = "";
			$APODERADO_DEMANDANTE_CORREO_COL = "";
			$APODERADO_DEMANDADO_NOMBRE_COL = "";
			$APODERADO_DEMANDADO_IDENTIFICACION_COL = "";
			$APODERADO_DEMANDADO_CORREO_COL = "";

			$JUZGADO_COL = "";
			$RADICADO_COL = "";
			$TIPO_DE_PROCESO_COL = "";
			$CIUDAD_DEL_JUZGADO_COL = "";
			$NUMERO_DE_OBLIGACION_COL = "";
			$AGENCIA_COL = "";
			$ACTUACIONES_COL = "";
			$CIUDAD_ORIGEN_COL = "";
			$USUARIO_RESPONSABLE_COL = "";
			$ASUNTO_COL = "";
			$ESTADO_ACTUAL_COL = "";
			$COMPARTIR_CON_COL = "";
			$CLIENTE_COL = "";
			$CLASE_COL = "";
			$TITULO_VALOR_COL = "";
			$EMBARGOS_COL = "";	
			$EMBARGOS_OBSERVACIONES_COL = "";	
			$SECUESTROS_COL = "";	
			$SECUESTROS_OBSERVACIONES_COL = "";	
			$AVALUO_COL = "";	
			$AVALUO_OBSERVACIONES_COL = "";	
			$REMATE_COL = "";	
			$REMATE_OBSERVACIONES_COL = "";
			$SUBSERIE_COL = "";

			$campot1_col  =  "";
			$campot2_col  =  "";
			$campot3_col  =  "";
			$campot4_col  =  "";
			$campot5_col  =  "";
			$campot6_col  =  "";
			$campot7_col  =  "";
			$campot8_col  =  "";
			$campot9_col  =  "";
			$campot10_col =  "";
			$campot11_col =  "";
			$campot12_col =  "";
			$campot13_col =  "";
			$campot14_col =  "";
			$campot15_col =  "";

			$refcol_anexo = "";
			echo "<ul class='list-group'>";

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
						if ($row != 1) {
							$con->Query("INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form, fecha_registro, orden) VALUES ('0', '".$idref['id']."', '".$rrrx['id']."', '', '".$mys_id."', '1', '".date("Y-m-d")."', '".$rrrx['orden']."')");
						}
						#echo "INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form, fecha_registro, orden) VALUES ('0', '".$idref['id']."', '".$rrrx['id']."', '', '".$mys_id."', '1', '".date("Y-m-d")."', '".$rrrx['orden']."')";
					}

					#RECORRO LA COLUMNA
					for ($col = 0; $col < $highestColumnIndex; ++ $col){

						$val = "";
						$cell = $worksheet->getCellByColumnAndRow( $col , $row );
						$val = $cell->getValue();
						$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
						#Codigo Supremamente importante para el patron de recocimiento.
						
						# code...
						if($row == 1 && strlen($val) > 0){
							$arrCabecera[$col] = $val;
						}

						if($row > 1 && strlen($val) > 0){
							$arrFilas[$col] = $val;
						}


						if($row == 1){
							switch (trim($val)) {
								case 'RADICADO': $RADICADO_COL = $col; break;
								case 'SUBSERIE': $SUBSERIE_COL = $col; break;
								case 'NOMBRE_DEL_DEMANDADO': $NOMBRE_DEL_DEMANDADO_COL = $col; break;
								case 'IDENTIFICACION_DEL_DEMANDADO': $IDENTIFICACION_DEL_DEMANDADO_COL = $col; break;
								case 'IDENTIFICACION_DEL_DEMANDANTE': $refcol = $col; $IDENTIFICACION_DEL_DEMANDANTE_COL = $col; break;
								case 'NOMBRE_DEL_DEMANDANTE': $NOMBRE_DEL_DEMANDANTE_COL = $col; break;	

								case 'APODERADO_DEMANDANTE_NOMBRE': $APODERADO_DEMANDANTE_NOMBRE_COL = $col; break;
								case 'APODERADO_DEMANDANTE_IDENTIFICACION': $APODERADO_DEMANDANTE_IDENTIFICACION_COL = $col; break;
								case 'APODERADO_DEMANDANTE_CORREO': $APODERADO_DEMANDANTE_CORREO_COL = $col; break;
								case 'APODERADO_DEMANDADO_NOMBRE': $APODERADO_DEMANDADO_NOMBRE_COL = $col; break;
								case 'APODERADO_DEMANDADO_IDENTIFICACION': $APODERADO_DEMANDADO_IDENTIFICACION_COL = $col; break;
								case 'APODERADO_DEMANDADO_CORREO': $APODERADO_DEMANDADO_CORREO_COL = $col; break;


								case 'anexos': $refcol_anexo = $col; break;
								case 'JUZGADO': $JUZGADO_COL = $col; break;
								case 'TIPO_DE_PROCESO': $TIPO_DE_PROCESO_COL = $col; break;
								case 'CIUDAD_DEL_JUZGADO': $CIUDAD_DEL_JUZGADO_COL = $col; break;
								case 'NUMERO_DE_OBLIGACION': $NUMERO_DE_OBLIGACION_COL = $col; break;
								case 'AGENCIA': $AGENCIA_COL = $col; break;
								case 'ACTUACIONES': $ACTUACIONES_COL = $col; break;
								case 'CIUDAD_ORIGEN': $CIUDAD_ORIGEN_COL = $col; break;
								case 'USUARIO_RESPONSABLE': $USUARIO_RESPONSABLE_COL = $col; break;
								case 'ASUNTO': $ASUNTO_COL = $col; break;
								case 'ESTADO DEL PROCESO ACTUAL': $ESTADO_ACTUAL_COL = $col; break;
								case 'COMPARTIR CON': $COMPARTIR_CON_COL = $col; break;
								case 'CLIENTE_COL': $CLIENTE_COL = $col; break;
								case 'CLASE_COL': $CLASE_COL = $col; break;
								case 'TITULO_VALOR': $TITULO_VALOR_COL = $col; break;
								case 'EMBARGOS_COL': $EMBARGOS_COL = $col; break;
								case 'EMBARGOS_OBSERVACIONES_COL': $EMBARGOS_OBSERVACIONES_COL = $col; break;
								case 'SECUESTROS_COL': $SECUESTROS_COL = $col; break;
								case 'SECUESTROS_OBSERVACIONES_COL': $SECUESTROS_OBSERVACIONES_COL = $col; break;
								case 'AVALUO_COL': $AVALUO_COL = $col; break;
								case 'AVALUO_OBSERVACIONES_COL': $AVALUO_OBSERVACIONES_COL = $col; break;
								case 'REMATE_COL': $REMATE_COL = $col; break;
								case 'REMATE_OBSERVACIONES_COL': $REMATE_OBSERVACIONES_COL = $col; break;
								default: break;
							}
						}else{

							if ($col == $refcol) {
								$suscriptor = $val;
							}

							$cellmeta = $worksheet->getCellByColumnAndRow( $col , 1 );
							$valmeta = $cellmeta->getValue();

							$fl = $con->Query("select id from meta_referencias_campos where id_referencia = '".$idr."' and slug = '".$valmeta."' ");

							$idref = $con->FetchAssoc($fl);
							$referencia = $idref['id'];
							$string = "update meta_big_data set valor = '".$val."' where grupo_id = '".$mys_id."' and campo_id = '".$referencia."' and ref_id = '".$idr."'";
							$con->Query($string);

						}

						if ($row != 1) {
							#echo "Fila $row - Columna $col = $val <br>";
							# code...
						}
					} #ESTE CIERRA FOR DE LA FILA SOLO NECESITO REFCOL, 1


					if($suscriptor != ""){

						
						$countfilas++;

						$cellmeta = $worksheet->getCellByColumnAndRow( $SUBSERIE_COL , $row );
						$tipo_documento = $cellmeta->getValue();

						$tipo_d = $con->Query("select id, dependencia from dependencias where id = '".$tipo_documento."' ");
						$tipo_dq = $con->FetchAssoc($tipo_d);	
						$id_dependencia_raiz = $tipo_dq['dependencia'];	

						$cellmeta = $worksheet->getCellByColumnAndRow( $JUZGADO_COL , $row );
						$JUZGADO_VALOR = $cellmeta->getValue();
						
						$cellmeta = $worksheet->getCellByColumnAndRow( $RADICADO_COL , $row );
						$RADICADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $CIUDAD_DEL_JUZGADO_COL , $row );
						$CIUDAD_DEL_JUZGADO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $USUARIO_RESPONSABLE_COL , $row );
						$USUARIO_RESPONSABLE_VALOR = $cellmeta->getValue();

						$NUMERO_DE_OBLIGACION_VALOR = "";
						$AGENCIA_VALOR = "";
						$TITULO_VALOR_VALOR = "";
						
						
						$cellmeta = $worksheet->getCellByColumnAndRow( $ESTADO_ACTUAL_COL , $row );
						$ESTADO_ACTUAL_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $CIUDAD_ORIGEN_COL , $row );
						$CIUDAD_ORIGEN_VALOR = $cellmeta->getValue();
						
						$cellmeta = $worksheet->getCellByColumnAndRow( $NOMBRE_DEL_DEMANDADO_COL , $row );
						$NOMBRE_DEL_DEMANDADO_VALOR = $cellmeta->getValue();
						$NOMBRE_DEL_DEMANDADO_VALOR = explode(";", $NOMBRE_DEL_DEMANDADO_VALOR);
						
						$cellmeta = $worksheet->getCellByColumnAndRow( $IDENTIFICACION_DEL_DEMANDADO_COL , $row );
						$IDENTIFICACION_DEL_DEMANDADO_VALOR = $cellmeta->getValue();
						$IDENTIFICACION_DEL_DEMANDADO_VALOR = explode(";", $IDENTIFICACION_DEL_DEMANDADO_VALOR);

						$cellmeta = $worksheet->getCellByColumnAndRow( $NOMBRE_DEL_DEMANDANTE_COL , $row );
						$NOMBRE_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();
						
						$cellmeta = $worksheet->getCellByColumnAndRow( $IDENTIFICACION_DEL_DEMANDANTE_COL , $row );
						$IDENTIFICACION_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $APODERADO_DEMANDANTE_NOMBRE_COL , $row );
						$APODERADO_DEMANDANTE_NOMBRE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $APODERADO_DEMANDANTE_IDENTIFICACION_COL , $row );
						$APODERADO_DEMANDANTE_IDENTIFICACION_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $APODERADO_DEMANDANTE_CORREO_COL , $row );
						$APODERADO_DEMANDANTE_CORREO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $APODERADO_DEMANDADO_NOMBRE_COL , $row );
						$APODERADO_DEMANDADO_NOMBRE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $APODERADO_DEMANDADO_IDENTIFICACION_COL , $row );
						$APODERADO_DEMANDADO_IDENTIFICACION_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $APODERADO_DEMANDADO_CORREO_COL , $row );
						$APODERADO_DEMANDADO_CORREO_VALOR = $cellmeta->getValue();


						$cellmeta = $worksheet->getCellByColumnAndRow( $ACTUACIONES_COL , $row );
						$ACTUACIONES_VALOR = $cellmeta->getValue();
						
						$cellmeta = $worksheet->getCellByColumnAndRow( $ASUNTO_COL , $row );
						$ASUNTO_VALOR = "PROCESO ".$tipo_dq['nombre']." DE ".$NOMBRE_DEL_DEMANDANTE_VALOR." VS ".$NOMBRE_DEL_DEMANDADO_VALOR[0];
// PENDIENTE POR TRAMITAR!
						$cellmeta = $worksheet->getCellByColumnAndRow( $COMPARTIR_CON_COL , $row );
						$COMPARTIR_CON_VALOR = $cellmeta->getValue();

						$suscriptores = array();

						$suscriptor_id = "";
						$sid = "";
						$snm = "";
						for ($i=0; $i < count($IDENTIFICACION_DEL_DEMANDADO_VALOR) ; $i++) { 
							$idd = $IDENTIFICACION_DEL_DEMANDADO_VALOR[$i];
							$idm = $NOMBRE_DEL_DEMANDADO_VALOR[$i];
							if ($idd != "" & $idd != "0") {
								$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$idd'");
								$dataqd = $con->FetchAssoc($qd);
								if ($dataqd['id'] == "") {
									$suscrr = new MSuscriptores_contactos;
									$createsuscr = $suscrr->InsertSuscriptores_contactos($idd, $idm, "27", $_SESSION['usuario'], date("Y-m-d"));

									$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
									$suscd = new MSuscriptores_contactos_direccion;

									$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, "", $CIUDAD_ORIGEN_VALOR, "", "", "");
								}else{
									$suscriptor_id = $dataqd['id'];
								}
								array_push($suscriptores, $suscriptor_id);
							}
							if ($i == 0) {
								$sus = new MSuscriptores_contactos;
								$sus->CreateSuscriptores_contactos("id", $suscriptor_id);

								$sid = $sus->GetId();
								$snm = $sus->GetNombre();
							}
							#echo "Demandado: ".$IDENTIFICACION_DEL_DEMANDADO_VALOR[$i]." Suscriptor: $sid - $snm<br>";
						}

						$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$IDENTIFICACION_DEL_DEMANDANTE_VALOR'");
						$dataqd = $con->FetchAssoc($qd);
						if ($dataqd['id'] == "") {
							$suscrr = new MSuscriptores_contactos;
							$createsuscr = $suscrr->InsertSuscriptores_contactos($IDENTIFICACION_DEL_DEMANDANTE_VALOR, $NOMBRE_DEL_DEMANDANTE_VALOR, "26", $_SESSION['usuario'], date("Y-m-d"));

							$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
							$suscd = new MSuscriptores_contactos_direccion;

							$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, "", $CIUDAD_ORIGEN_VALOR, "", "", "");
						}else{
							$suscriptor_id = $dataqd['id'];
						}
						array_push($suscriptores, $suscriptor_id);


						$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$APODERADO_DEMANDANTE_IDENTIFICACION_VALOR'");
						$dataqd = $con->FetchAssoc($qd);
						if ($dataqd['id'] == "") {
							$suscrr = new MSuscriptores_contactos;
							$createsuscr = $suscrr->InsertSuscriptores_contactos($APODERADO_DEMANDANTE_IDENTIFICACION_VALOR, $APODERADO_DEMANDANTE_NOMBRE_VALOR, "54", $_SESSION['usuario'], date("Y-m-d"));

							$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
							$suscd = new MSuscriptores_contactos_direccion;

							$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, "", $CIUDAD_ORIGEN_VALOR, "", "", "");

							$sid = $suscriptor_id;
						}else{
							$suscriptor_id = $dataqd['id'];
							$sid = $dataqd['id'];
						}
						array_push($suscriptores, $suscriptor_id);


						$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$APODERADO_DEMANDADO_IDENTIFICACION_VALOR'");
						$dataqd = $con->FetchAssoc($qd);
						if ($dataqd['id'] == "") {
							$suscrr = new MSuscriptores_contactos;
							$createsuscr = $suscrr->InsertSuscriptores_contactos($APODERADO_DEMANDADO_IDENTIFICACION_VALOR, $APODERADO_DEMANDADO_NOMBRE_VALOR, "55", $_SESSION['usuario'], date("Y-m-d"));

							$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
							$suscd = new MSuscriptores_contactos_direccion;

							$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, "", $CIUDAD_ORIGEN_VALOR, "", "", "");
						}else{
							$suscriptor_id = $dataqd['id'];
						}
						array_push($suscriptores, $suscriptor_id);
						
						#print_r($suscriptores);
						#echo "<hr>";
						
						

						$u = new MUsuarios;
						$u->CreateUsuarios('user_id', $USUARIO_RESPONSABLE_VALOR);

						#echo "Nombre del Usuario: ".$u->GetP_nombre()."<br>";
						$se = new MSeccional;
						$se->CreateSeccional("id", $u->GetSeccional());

						$sp = new MSeccional_principal;
						$sp->CreateSeccional_principal("ciudad_origen", $se->GetCiudad());

						$s = new MSuscriptores_contactos;
						$s->CreateSuscriptores_contactos("id", $sid);

						$d = new MDependencias;
						$d->CreateDependencias("id", $tipo_documento);

						$dr = new MDependencias;
						$dr->CreateDependencias("id", $id_dependencia_raiz);

						$a = new MAreas;
						$a->CreateAreas("id", $u->GetRegimen());

						$radicado = $RADICADO_VALOR;
						$f_recibido = date("Y-m-d");
						$nombre_radica = $s->GetNombre();
						$folio = "0";
						$dependencia_destino = $u->GetRegimen();
						$nombre_destino = $u->GetA_i();
						$fecha_vencimiento = "";
						$estado_respuesta = "Activo";
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
						$observacion2 = $JUZGADO_VALOR;

						$campot1 = $NUMERO_DE_OBLIGACION_VALOR;
						$campot2 = $AGENCIA_VALOR;
						$campot3 = $TITULO_VALOR_VALOR;
						$campot4 = $JUZGADO_VALOR;
						$campot5 = $CIUDAD_DEL_JUZGADO_VALOR;

						$estado_personalizado = $ESTADO_ACTUAL_VALOR;
						$qestado = $con->Query("select id from estados_gestion where nombre = '".$c->sql_quote($ESTADO_ACTUAL_VALOR)."' and dependencia = '".$tipo_documento."'");
						#echo "select id from estados_gestion where nombre = '".$c->sql_quote($ESTADO_ACTUAL_VALOR)."' and dependencia = '".$tipo_documento."'";
						$estado_personalizado = $con->FetchAssoc($qestado);
						$estado_personalizado = $estado_personalizado['id'];
						// DEFINIENDO EL OBJETO

						$object = new MGestion;
						#print_r($_REQUEST);
						$nr = $object->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);
						$minr = $object->GetMinRadicado();

						// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA
						$create = $object->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $ASUNTO_VALOR, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida, "0", $observacion2, "0", $campot1, $campot2, $campot3, $campot4, $campot5, $campot6, $campot7, $campot8, $campot9, $campot10, $campot11, $campot12, $campot13, $campot14, $campot15, $estado_personalizado);

						$id = $c->GetMaxIdTabla("gestion", "id");

						$filename=UPLOADS.DS.$id.'/';
						if (!file_exists($filename)) {
						    mkdir(UPLOADS.DS . $id, 0777);
						}
						$filename=UPLOADS.DS.$id.'/anexos/';
						if (!file_exists($filename)) {
						    mkdir(UPLOADS.DS . $id.'/anexos', 0777);
						}

						for ($j=0; $j < count($suscriptores) ; $j++) { 
							# code...
							$gs = new MGestion_suscriptores();
							$gs->InsertGestion_suscriptores($id, $suscriptores[$j], $u->GetUser_id(), "1", "1", date("Y-m-d"));
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

						$objecte->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Historico de Actuaciones", $ACTUACIONES_VALOR,			 date("Y-m-d"), 1, date("H:i:s"), 1, 0, 1, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $call, "ev",  $id);
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
				
						if($COMPARTIR_CON_VALOR != ""){
							#echo $COMPARTIR_CON_VALOR;
							if ($COMPARTIR_CON_VALOR == "*") {
							#	echo "Compartir con todos!";
								
								$COMPARTIR_CON_VALOR = "";
								$lits = $con->Query("select * from usuarios where regimen = '".$u->GetRegimen()."' and seccional = '".$u->GetSeccional()."'");

								#echo "select * from usuarios where regimen = '".$u->GetRegimen()."' and seccional = '".$u->GetSeccional()."'";

								$i = 0;

								while ($rrrx = $con->FetchAssoc($lits)) {

									$COMPARTIR_CON_VALOR .= $rrrx['user_id'].";";

									$cantidadusuariosagregados = explode(";", $COMPARTIR_CON_VALOR);
									for ($k=0; $k < count($cantidadusuariosagregados); $k++) {

										$MUsuarios = new MUsuarios;
										$MUsuarios->CreateUsuarios("user_id", $cantidadusuariosagregados[$k]);

										if($MUsuarios->GetA_i() != ""){

											$MGestion_compartir = new MGestion_compartir;
											$create = $MGestion_compartir->InsertGestion_compartir($u->GetUser_id(), $MUsuarios->GetUser_id(), $id, date("Y-m-d H:i:s"), "Compartido desde Carga Masiva", "1", "0", "0");

											$idg_c = $c->GetMaxIdTabla("gestion_compartir", "id");
											$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();
											$MSolicitudes_documentos = new MSolicitudes_documentos;
											$MSolicitudes_documentos->InsertSolicitudes_documentos($MUsuarios->GetUser_id(), $u->GetUser_id(), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), "", $id, "Compartido desde Carga Masiva", "1");

											$MEvents_gestion = new MEvents_gestion;
											$MEvents_gestion->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Expediente Compartido", "Se ha compartido el expediente con el usuario $username", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $MUsuarios->GetA_i(), "comp", $idg_c);

										}
									/*
									*/
									}


								}
							}else{
								#echo "Comparto con algunos";
								$cantidadusuariosagregados = explode(";", $COMPARTIR_CON_VALOR);
								for ($k=0; $k < count($cantidadusuariosagregados); $k++) {

									$MUsuarios = new MUsuarios;
									$MUsuarios->CreateUsuarios("user_id", $cantidadusuariosagregados[$k]);

									if($MUsuarios->GetA_i() != ""){

										$MGestion_compartir = new MGestion_compartir;
										$create = $MGestion_compartir->InsertGestion_compartir($u->GetUser_id(), $MUsuarios->GetUser_id(), $id, date("Y-m-d H:i:s"), "Compartido desde Carga Masiva", "1", "0", "0");

										$idg_c = $c->GetMaxIdTabla("gestion_compartir", "id");
										$username = $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido();
										$MSolicitudes_documentos = new MSolicitudes_documentos;
										$MSolicitudes_documentos->InsertSolicitudes_documentos($MUsuarios->GetUser_id(), $u->GetUser_id(), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), "", $id, "Compartido desde Carga Masiva", "1");

										$MEvents_gestion = new MEvents_gestion;
										$MEvents_gestion->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Expediente Compartido", "Se ha compartido el expediente con el usuario $username", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $MUsuarios->GetA_i(), "comp", $idg_c);

									}
								}
								/*
								*/
							}
						}	


						#$con->Query("update gestion_anexos set gestion_id = '".$g->GetId()."', is_publico = '1' where id_servicio = '".$mys_id."' and ip = '".$_SERVER['REMOTE_ADDR']."'");
						#$archivo = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'].'/file_'.$_SESSION['suscriptor_id'].'.xlsx';
						#$oname = UPLOADS.DS."tmp_base/".$_SESSION['smallid'].DS;  
						#$nname = UPLOADS.DS.$g->GetId().DS."anexos/"; 
						#$f->copia($oname, $nname);
						#unset($mys_id);
						#echo '<script> window.location.href = "'.HOMEDIR.DS.'gestion/ver/'.$id.'/"</script>';
					}
					if ($row != 1) {
						echo "<li class='list-group-item'>Expediente $radicado Registrado Correctamente</li>";
						#echo "Fila $row - Columna $col = $val <br>";
						# code...
					}
					$cellmeta = $worksheet->getCellByColumnAndRow( 1 , $row );
					$checker = $cellmeta->getValue();
					if ($checker == "") {
						echo "		<li class=' list-group-item alert alert-success'>$countfilas Expedientes Creados!</div>";
						echo  "</ul>";
						$con->Query("delete from meta_big_data where type_id = '0' and grupo_id like '%".$_SESSION['smallid']	."%' ");
						#echo $path;
						unset($_SESSION['smallid']);
						exit;
					}
				}
			}
		}
		
	}

	function ViewGrid($filename){
		global $con;
		global $c;
		global $f;

		include(VIEWS.DS."importar_procesos/view_grid.php");
	}

	function ReadForm(){
		print_r($_REQUEST);
	}
}
?>