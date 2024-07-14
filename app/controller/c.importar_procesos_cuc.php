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
else
// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
	$ob->VistaImportar('');		
// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
class CImportar extends MainController{

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

	function ProcesarMasiva(){
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

			$NO_FORMULARIO = "";
			$FECHA = "";
			$ANO_ACADEMICO = "";
			$PERIODO = "";
			$PRIMER_APELLIDO = "";
			$SEGUNDO_APELLIDO = "";
			$NOMBRES = "";
			$PROGRAMA_ACADEMICO = "";
			$LUGAR_NACIMIENTO = "";
			$FECHA_NACIMIENTO = "";
			$SEXO = "";
			$TIPO_DOCUMENTO_I = "";
			$NUMERO_DOCUMENTO = "";
			$LUGAR_EXPEDICION_DOC = "";
			$ESTADO_CIVIL = "";
			$DIRECCION_RESIDENCIA = "";
			$CIUDAD_RESIDENCIA = "";
			$TELEFONO = "";
			$CELULAR = "";
			$ESTRATO = "";
			$CORREO_ELECTRONICO = "";
			$USUARIO_RESPONSABLE = "";
			$ANEXOS = "";

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
								case 'NO_FORMULARIO' : $NO_FORMULARIO = $col; break;
								case 'FECHA' : $FECHA = $col; break;
								case 'ANO_ACADEMICO' : $ANO_ACADEMICO = $col; break;
								case 'PERIODO' : $PERIODO = $col; break;
								case 'PRIMER_APELLIDO' : $PRIMER_APELLIDO = $col; break;
								case 'SEGUNDO_APELLIDO' : $SEGUNDO_APELLIDO = $col; break;
								case 'NOMBRES' : $NOMBRES = $col; break;
								case 'PROGRAMA_ACADEMICO' : $PROGRAMA_ACADEMICO = $col; break;
								case 'LUGAR_NACIMIENTO' : $LUGAR_NACIMIENTO = $col; break;
								case 'FECHA_NACIMIENTO' : $FECHA_NACIMIENTO = $col; break;
								case 'SEXO' : $SEXO = $col; break;
								case 'TIPO_DOCUMENTO_I' : $TIPO_DOCUMENTO_I = $col; break;
								case 'NUMERO_DOCUMENTO' : $NUMERO_DOCUMENTO = $col; break;
								case 'LUGAR_EXPEDICION_DOC' : $LUGAR_EXPEDICION_DOC = $col; break;
								case 'ESTADO_CIVIL' : $ESTADO_CIVIL = $col; break;
								case 'DIRECCION_RESIDENCIA' : $DIRECCION_RESIDENCIA = $col; break;
								case 'CIUDAD_RESIDENCIA' : $CIUDAD_RESIDENCIA = $col; break;
								case 'TELEFONO' : $TELEFONO = $col; break;
								case 'CELULAR' : $CELULAR = $col; break;
								case 'ESTRATO' : $ESTRATO = $col; break;
								case 'CORREO_ELECTRONICO' : $CORREO_ELECTRONICO = $col; break;
								case 'USUARIO_RESPONSABLE' : $USUARIO_RESPONSABLE = $col; break;
								case 'ANEXOS' : $ANEXOS = $col; break;
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

						$tipo_d = $con->Query("select id, dependencia from dependencias where id = '".$tipo_documento."' ");
						$tipo_dq = $con->FetchAssoc($tipo_d);	
						$id_dependencia_raiz = $tipo_dq['dependencia'];

						$cellmeta = $worksheet->getCellByColumnAndRow( $NO_FORMULARIO, $row );
						$NO_FORMULARIO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $FECHA, $row );
						$FECHA_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $ANO_ACADEMICO, $row );
						$ANO_ACADEMICO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $PERIODO, $row );
						$PERIODO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $PRIMER_APELLIDO, $row );
						$PRIMER_APELLIDO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $SEGUNDO_APELLIDO, $row );
						$SEGUNDO_APELLIDO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $NOMBRES, $row );
						$NOMBRES_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $PROGRAMA_ACADEMICO, $row );
						$PROGRAMA_ACADEMICO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $LUGAR_NACIMIENTO, $row );
						$LUGAR_NACIMIENTO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $FECHA_NACIMIENTO, $row );
						$FECHA_NACIMIENTO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $SEXO, $row );
						$SEXO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $TIPO_DOCUMENTO_I, $row );
						$TIPO_DOCUMENTO_I_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $NUMERO_DOCUMENTO, $row );
						$NUMERO_DOCUMENTO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $LUGAR_EXPEDICION_DOC, $row );
						$LUGAR_EXPEDICION_DOC_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $ESTADO_CIVIL, $row );
						$ESTADO_CIVIL_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $DIRECCION_RESIDENCIA, $row );
						$DIRECCION_RESIDENCIA_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $CIUDAD_RESIDENCIA, $row );
						$CIUDAD_RESIDENCIA_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $TELEFONO, $row );
						$TELEFONO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $CELULAR, $row );
						$CELULAR_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $ESTRATO, $row );
						$ESTRATO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $CORREO_ELECTRONICO, $row );
						$CORREO_ELECTRONICO_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $USUARIO_RESPONSABLE, $row );
						$USUARIO_RESPONSABLE_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $ANEXOS, $row );
						$ANEXOS_VALOR = $cellmeta->getValue();

						$cellmeta = $worksheet->getCellByColumnAndRow( $COMPARTIR_CON_COL , $row );
						$COMPARTIR_CON_VALOR = $cellmeta->getValue();

						$suscriptores = array();

						$suscriptor_id = "";
						$sid = "";
						$snm = "";

						$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$NUMERO_DOCUMENTO_VALOR'");
						$dataqd = $con->FetchAssoc($qd);
						if ($dataqd['id'] == "") {
							$suscrr = new MSuscriptores_contactos;
							$createsuscr = $suscrr->InsertSuscriptores_contactos($NUMERO_DOCUMENTO_VALOR, $PRIMER_APELLIDO_VALOR.' '.$SEGUNDO_APELLIDO_VALOR.' '.$NOMBRES_VALOR, "1", $_SESSION['usuario'], date("Y-m-d"));

							$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
							$sid = $suscriptor_id;
							$snm = $PRIMER_APELLIDO_VALOR.' '.$SEGUNDO_APELLIDO_VALOR.' '.$NOMBRES_VALOR;
							$suscd = new MSuscriptores_contactos_direccion;

							$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, $DIRECCION_VALOR, $LUGAR_NACIMIENTO_VALOR, $TELEFONO_VALOR, $CORREO_ELECTRONICO_VALOR, "");
						}else{
							$sid = $dataqd['id'];
							$snm = $dataqd['nombre'];
						}
						array_push($suscriptores, $sid);

						$qd = $con->Query("Select id, nombre from suscriptores_contactos where identificacion = '$NUMERO_DOCUMENTO_VALOR'");
						$dataqd = $con->FetchAssoc($qd);
						if ($dataqd['id'] == "") {
							$suscrr = new MSuscriptores_contactos;
							$createsuscr = $suscrr->InsertSuscriptores_contactos($NUMERO_DOCUMENTO_VALOR, $PRIMER_APELLIDO_VALOR.' '.$SEGUNDO_APELLIDO_VALOR.' '.$NOMBRES_VALOR, "2", $_SESSION['usuario'], date("Y-m-d"));

							$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
							$suscd = new MSuscriptores_contactos_direccion;

							$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, $DIRECCION_VALOR, $LUGAR_NACIMIENTO_VALOR, $TELEFONO_VALOR, $CORREO_ELECTRONICO_VALOR, "");
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

						$radicado = $NO_FORMULARIO_VALOR;
						$f_recibido = $FECHA_VALOR;
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
						
						$estado_personalizado = "";
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

						$uploads_dir = UPLOADS.DS.$id.'/anexos';
						if($ANEXOS_VALOR != ''){
							$arr_a = explode(';',$ANEXOS_VALOR);
							foreach ($arr_a as $key => $value_arr) {
								$archivo = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'].'/'.$value_arr;

								$rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);
								$ext = end(explode(".", $value_arr));
								$fname = $rand.".".$ext;
						        if(copy($archivo, $uploads_dir."/".$fname)){
						        	$an = new MGestion_anexos;				
									$an->InsertGestion_anexos($id, $value_arr, $fname, $u->GetUser_id(), date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "","1", 	"1");
						        }
							}
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

						//$objecte->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Historico de Actuaciones", $ACTUACIONES_VALOR,			 date("Y-m-d"), 1, date("H:i:s"), 1, 0, 1, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $call, "ev",  $id);
						$objecte->InsertEvents_gestion($u->GetUser_id(), $id, date("Y-m-d"), "Creación de Inscripción", "Se ha creado la radicación $nr", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), $call, "rad", $id);

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
}
?>