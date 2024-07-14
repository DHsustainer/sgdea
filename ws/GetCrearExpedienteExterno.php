<?php

    require_once ("lib/nusoap.php");

    if (!isset($_SESSION['VAR_SESSIONES'])) {

            $cliente = new nusoap_client("http://laws.com.co/ws/GetDetailSuscriptorKeys.wsdl", true);

            $error = $cliente->getError();

            if ($error) {

                echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

            }

            $array = array("id" => $_SERVER['HTTP_HOST'], "key" => $_SESSION['user_key']);

            $result = $cliente->call("GetDataSesion", $array);

            if ($cliente->fault) {

                echo "<h2>Fault</h2><pre>";

                echo "</pre>";

            }else{

                $error = $cliente->getError();

                if ($error) {

                    echo "<h2>Error</h2><pre>" . $error . "</pre>";

                }else {

                    if ($result == "") {

                        echo "No se creo el WS";

                    }else{

                        $x  = explode(",", $result);

                        if ($x[0] != 'errno') {

                            $_SESSION["pzhkCSC0XMwpGMT"] = desencriptar($x[0], $_SESSION['user_key']);

                            $_SESSION["kYg8omRSc1EDj3u"] = desencriptar($x[1], $_SESSION['user_key']);

                            $_SESSION["1oKU35BSbQ7CG5Q"] = desencriptar($x[2], $_SESSION['user_key']);

                            $_SESSION["71c029wus3yJWEN"] = desencriptar($x[3], $_SESSION['user_key']);

                            $_SESSION['VAR_SESSIONES'] = true;

                        }else{

                            $_SESSION['VAR_SESSIONES'] = false;

                        }

                    }

                }

            }

        }

    include_once('../app/basePaths.inc.php');

    include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

    include_once('../app/controller/consultas.php');

    include_once('../app/controller/funciones.php');

    include_once(MODELS.DS.'UsuariosM.php');

    include_once(MODELS.DS.'Suscriptores_contactosM.php');

	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');

	include_once(MODELS.DS.'Dependencias_documentosM.php');

	include_once(MODELS.DS.'DependenciasM.php');

	include_once(MODELS.DS.'Gestion_suscriptoresM.php');

	include_once(MODELS.DS.'Gestion_anexosM.php');

	include_once(MODELS.DS.'GestionM.php');

	include_once(MODELS.DS.'Events_gestionM.php');

	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');

	include_once(MODELS.DS.'Firmas_usuariosM.php');

	include_once(MODELS.DS.'Dependencias_alertasM.php');

	include_once(MODELS.DS.'Dian_facturacionM.php');

	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');

	include_once(MODELS.DS.'Super_adminM.php');

	include_once(MODELS.DS.'Mailer_messageM.php');

	include_once(MODELS.DS.'Mailer_attachmentsM.php');

	include_once(MODELS.DS.'Mailer_from_messageM.php');

	include_once(MODELS.DS.'Mailer_replysM.php');

	include_once(MODELS.DS.'SortM.php');

	require_once(PLUGINS.DS.'tcpdf/tcpdf.php');

	require_once(PLUGINS.DS.'FPDI/fpdi.php');

	require_once(PLUGINS.DS.'phpqrcode/qrlib.php');

	#require_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');

    $con = new ConexionBaseDatos;

    $con->Connect($con);

    $c = new Consultas;

    $f = new Funciones;

    function GetCrearExpedienteExterno($cedula,$nit_suscriptor,$nombre_suscriptor,$tipo_suscriptor,$Direccion_suscriptor,$Telefonos_suscriptor,$Email_suscriptor,$radicado,$dependencia_destino,$observacion,$archivo, $archivo_nombre, $como_enviar_expediente, $datosfactura) {

        global $con;

        global $c;

        global $f;

        /*se consulta si existe el usuario*/

        $MUsuarios = new MUsuarios;

		$MUsuarios->CreateUsuarios("id", $c->sql_quote($cedula));

		$dependencia = new MDependencias;

		$dependencia->CreateDependencias("id", $dependencia_destino);

		if($MUsuarios->GetId() == '' || $MUsuarios->GetId() == 0){

			return json_encode(array('respuesta' => '0', 'mensaje' => 'El usuario no existe'));

		}

		/*Si el nit o el nombre del suscriptor estan en blanco*/

		if($archivo != ""){

			if($nit_suscriptor == '' || $nombre_suscriptor == '' || $Email_suscriptor == ''){

					return json_encode(array('respuesta' => '0', 'mensaje' => 'El nit, nombre, email del suscriptor son necesarios'));

				}

			/*Se verifica que el tipo de suscriptor este entre los validos*/

				if($tipo_suscriptor != 'CLIENTE' && $tipo_suscriptor != 'PROVEEDOR'){

					return json_encode(array('respuesta' => '0', 'mensaje' => 'El tipo de suscriptor no es valido'));

				}

				/*Se verifica que el tipo de suscriptor este entre los validos*/

			/*if($dependencia_destino != '2' && $dependencia_destino != '3'){

					return json_encode(array('respuesta' => '0', 'mensaje' => 'La dependencia destino no es valida'));

				}*/

		}

		/*Se verifica que el tipo de suscriptor este entre los validos*/

		if($como_enviar_expediente == ''){

			return json_encode(array('respuesta' => '0', 'mensaje' => 'Elcomo_enviar_expediente son necesario'));

		}

		/*Se verifica que el tipo de suscriptor este entre los validos

		EMAIL_CERTIFICADO, INTERRACCION_ELECTRONICA, CODIGO_QR, IMPRESION*/

		if($como_enviar_expediente != 'INTERRACCION_ELECTRONICA' && $como_enviar_expediente != 'EMAIL_CERTIFICADO' && $como_enviar_expediente != 'CODIGO_QR' && $como_enviar_expediente != 'IMPRESION' && $como_enviar_expediente != 'PROCESAR'){

			return json_encode(array('respuesta' => '0', 'mensaje' => 'El como_enviar_expediente no es valido'));

		}

		$Ciudad_suscriptor = $MUsuarios->GetCiudad();

        $dtform = $nombre_radica;

      	$nombre_destino = $MUsuarios->GetA_i();

      	$ciudad = $MUsuarios->GetCiudad();

      	$usuario_registra = $MUsuarios->GetUser_id();

      	$oficina = $MUsuarios->GetSeccional();

      	$area_principal = $MUsuarios->GetRegimen();

      	$user_id = $MUsuarios->GetUser_id();

      	$nombre_usuario = $MUsuarios->GetP_nombre().' '.$MUsuarios->GetP_apellido();

      	$q_strx = "SELECT ciudad from seccional WHERE id='".$oficina."'";

		$queryx = $con->Query($q_strx);

		$ciudadcodigo = $con->Result($queryx, 0, "ciudad");

		$ciudad = $ciudadcodigo;

        /*Verificar si existe el suscriptor*/

        $MSuscriptores_contactos = new MSuscriptores_contactos;

        $MSuscriptores_contactos->CreateSuscriptores_contactos('identificacion',$nit_suscriptor);

        if($MSuscriptores_contactos->GetId() == '' || $MSuscriptores_contactos->GetId() == 0){

			$createsuscr = $MSuscriptores_contactos->InsertSuscriptores_contactos($c->sql_quote($nit_suscriptor), $nombre_suscriptor, $c->sql_quote($tipo_suscriptor), $MUsuarios->GetUser_id(), date("Y-m-d"));

			$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");

			$suscd = new MSuscriptores_contactos_direccion;

			$suscd->InsertSuscriptores_contactos_direccion($suscriptor_id, $c->sql_quote($Direccion_suscriptor), $ciudadcodigo, $c->sql_quote($Telefonos_suscriptor), $c->sql_quote($Email_suscriptor), "");

			$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos_direccion", "id");

			$nombre_radica = $nombre_suscriptor;

		} else {

			$suscriptor_id =  $MSuscriptores_contactos->GetId();

			$nombre_radica = $MSuscriptores_contactos->GetNombre();

			$MSuscriptores_contactos_direccion = new MSuscriptores_contactos_direccion;

			$MSuscriptores_contactos_direccion->CreateSuscriptores_contactos_direccion('id_contacto',$suscriptor_id);

			$Direccion_suscriptor =  $MSuscriptores_contactos_direccion->GetDireccion();

		}

        $fecha = date_create($f_recibido);

		date_add($fecha, date_interval_create_from_date_string('3 days'));

		$fecha_vencimiento = date_format($fecha, 'Y-m-d');

		$f_recibido = date('Y-m-d');

        $folio = 1;

        $tipo_documento = $dependencia->GetId();

        $dependencia_destino = $MUsuarios->GetRegimen();

        $estado_respuesta = "NO";

        $fecha_respuesta = "";

        $prioridad  = "2";

        $estado_solicitud = "1";

        $estado_archivo = "1";

        $id_dependencia_raiz = $dependencia->GetDependencia();

      	$num_oficio_respuesta = $ciudadcodigo.'-'.$f->zerofill($oficina,3).'-001-'.$f->zerofill($dependencia_destino,3);

      	$MGestion = new MGestion;

		$nr = $MGestion->GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento);

		$minr = $MGestion->GetMinRadicado();

		// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

		$create = $MGestion->InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $nr, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr);

		$id = $c->GetMaxIdTabla("gestion", "id");

		$filename=UPLOADS.DS.$id.'/';

		if (!file_exists($filename)) {

		    mkdir(UPLOADS.DS . $id, 0777);

		}

		$filename=UPLOADS.DS.$id.'/anexos/';

		if (!file_exists($filename)) {

		    mkdir(UPLOADS.DS . $id.'/anexos', 0777);

		}

		$dogc = new MDependencias_documentos;

		$listdoc = $dogc->ListarDependencias_documentos("WHERE id_dependencia = '$tipo_documento'");

		$i;

		while ($rx = $con->FetchAssoc($listdoc)) {

			$i++;

			$an = new MGestion_anexos;

			$an->InsertGestion_anexos($id, $rx['nombre'], "", $usuario_registra, date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], "", "1", $i, $i);

			$gestion_anexos_id = $c->GetMaxIdTabla("gestion_anexos", "id");

		}

		if ($suscriptor_id != "") {

			$s = new MGestion_suscriptores();

			$s->InsertGestion_suscriptores($id, $suscriptor_id, $usuario_registra, "1", "1", date("Y-m-d "));

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

		$objecte->InsertEvents_gestion($usuario_registra, $id, date("Y-m-d"), "Creación de Radicación", "Se ha creado la radicación $nr", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $oficina, $area_principal, $area_principal, $call, "rad", $id);

		/* GENERA ERROR

		if ($fecha_vencimiento > date("Y-m-d")) {

			$objecte->InsertEvents_gestion($usuario_registra, $id, $fecha_vencimiento, "Vencimiento de un Expediente", "Se programó vencimiento del expediente para el día ".$fecha_vencimiento, date("Y-m-d"), 1, date("H:i:s"), 0, 3, 0, date("Y-m-d"), 0, $oficina, $area_principal, $area_principal, $call, "vexp", $id);

		}*/		

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

			/*$eventoe = new MEvents_gestion;

		#	// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $eventoe->InsertEvents_gestion($usuario_registra, $gestion, $fecha_a, $depa->GetNombre(), $depa->GetDescripcion(), date("Y-m-d"), 0, date("H:i:s"), 0, $depa->GetDias_antes(), 0, $fecha_a, $alerta, $oficina, $area_principal, $area_principal, "*", 'ev', $gestion);*/

		}

		/*Crear archivo*/

		$ext = "";

		if( $archivo_nombre != "" ){

			$car = new MGestion_anexos;

			$tot  = $con->Query("select count(*) as max from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '0'");

			$fol = $con->Result($tot, 0, "max");

			$fol += 1;

			$rand = md5(date('Y-m-d').rand().$user_id);

			$arrarch = explode(".", $archivo_nombre);

			$ext = end($arrarch);

			$fname = $rand.".".$ext;

			$fh = fopen(UPLOADS.DS . $id.'/anexos/'.$fname, 'w');

	        fwrite($fh, base64_decode($archivo));

	        fclose($fh);

	        $size = filesize(UPLOADS.DS . $id.'/anexos/'.$fname);

	        $hash = hash("sha256", $archivo_nombre.$fname.$user_id.$_SERVER[REMOTE_ADDR].date("Y-m-d").date("H:i:s").$size);

			//base 64

			$base_file = '';

			$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$id."/anexos".DS.$fname);

			$base_file = base64_encode($data_base_file);

			$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, folder_id, folio_final, is_publico, orden, hash, base_file) values ('".date("Y-m-d H:i:s")."', '$id','".$archivo_nombre."','".$fname."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '0', '".$fol."', '1', '".$fol."', '".$hash."', '".$base_file."')");

			$anexo_id = $c->GetMaxIdTabla("gestion_anexos", "id");		

		}

		/*$objecte = new MEvents_gestion;

		$objecte->InsertEvents_gestion($suscriptor_id, $id, date("Y-m-d"), "Carga de Documento", "Se ha cargado un documento llamado: \"".$archivo_nombre."\"", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $oficina, $area_principal, $area_principal, "*", "lsus", $id);*/

		/*Firmar el documento*/

		if($ext == 'pdf' || $ext == 'PDF'){

			$MGestion_anexos_firmas = new MGestion_anexos_firmas;

			$MGestion_anexos_firmas->InsertGestion_anexos_firmas($id, $anexo_id, $tipologia_id, date('Y-m-d H:i:s'), $user_id, $user_id, date('Y-m-d H:i:s'), $codigo_firma, $clave_primaria, "0", $repo_1, $repo_2);

			$gestion_anexos_firmas_id = $c->GetMaxIdTabla("gestion_anexos_firmas", "id");

			$MGestion_anexos_permisos = new MGestion_anexos_permisos;

			$MGestion_anexos_permisos->InsertGestion_anexos_permisos($anexo_id, $user_id, "0", date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), "", $id);

			$ddd = $c->FirmaDigitalExterno($gestion_anexos_firmas_id, "0813", "2,1", "1", "1","firmasander.crt",$user_id,$oficina, $area_principal);

		}

		/*datos a returnar funciones

		'INTERRACCION_ELECTRONICA' 'EMAIL_CERTIFICADO'  'CODIGO_QR' 'IMPRESION'*/

		$mensajerespuesta = "Creado";

		if($como_enviar_expediente == 'CODIGO_QR'){

			//$mensajerespuesta = $c->CodeQrExterno($gestion_anexos_firmas_id);

			$mensajerespuesta = $c->CodeQrExterno2($id,$user_id);

		}

		if($como_enviar_expediente == 'IMPRESION'){

			$mensajerespuesta = $c->ImpresionDocumentoExterno($gestion_anexos_firmas_id);

		}

		if($como_enviar_expediente == 'INTERRACCION_ELECTRONICA'){

			$mensajerespuesta = $c->InterraccionElectronocaExterno($suscriptor_id,$nombre_usuario,$usuario_registra,$id);

		}

		if($como_enviar_expediente == 'EMAIL_CERTIFICADO'){ 

			$anexos_listado = "";

			$archivos_anexos_listado = "";

			$mensajerespuesta = $c->EmailCertificadoExterno($gestion_anexos_firmas_id, $id,$user_id,$oficina, $area_principal, $Email_suscriptor, "Mensaje de datos del expediente", "", $anexos_listado, $archivos_anexos_listado, "", "2", $id);

		}

		if($datosfactura != "" && $archivo_nombre != ""){

			$var = array(

	    	"UBLVersionID" => "UBL 2.0", 	"ProfileID" => "DIAN 1.0", 	"ID" => "45910281428", 	"UUID" => "ae0869bcc9044db987aecbe976187fd3ba0937c", 

			"IssueDate" => "2015-07-20", 	"IssueTime" => "00:00:00", 	"InvoiceTypeCode" => "1", 		

			"Note" => "Set de pruebas =  fos0001_700085371_f7999_R469910-459-27223_0C_700085371  2015-07-20 -- número factura fuera de rango&#13;

						NumFac: 45910281428&#13;

						FecFac: 20150720000000&#13;

						ValFac: 97128.00&#13;

						CodImp1: 01&#13;

						ValImp1: 15540.48&#13;

						CodImp2: 02&#13;

						ValImp2: 0.00&#13;

						CodImp3: 03&#13;

						ValImp3: 4021.09&#13;

						ValImp: 116689.57&#13;

						NitOFE: 700085371&#13;

						TipAdq: 22&#13;

						NumAdq: 11222333&#13;

						String: 459102814282015072000000097128.000115540.48020.00034021.09116689.577000853712211222333693ff6f2a553c3646a063436fd4dd9ded0311471&#13;",

			"DocumentCurrencyCode" => "COP", "AdditionalAccountID" => "1", 	"ID2" => "700085371", 	"Name" => "PJ - 700085371 - Adquiriente FE", 

			"Department" => "Bolivar", "CitySubdivisionName" => "Centro", 	"CityName" => "Pasa Caballos", 		"Line" => "	carrera 8 Nº 6C - 60", 

			"IdentificationCode" => "CO", 	"TaxLevelCode" => "0", 	"RegistrationName" => "PJ - 700085371", 	"AdditionalAccountID2" => "2", 

			"ID3" => "11222333", 			"Department2" => "Huila", "CitySubdivisionName2" => "Centro", 	"CityName2" => "Aipe", 

			"Line2" => "	carrera 8 Nº 6C - 40", 	"IdentificationCode2" => "CO", 	"TaxLevelCode2" => "0", 	"FirstName" => "Primer-N", 	

			"FamilyName" => "Apellido-11222333", 	"MiddleName" => "Segundo-N", 	"TaxAmount" => "15540.48", 		"TaxEvidenceIndicator" => "FALSE", 

			"TaxableAmount" => "97128", 	"TaxAmount2" => "15540.48", 		"Percent" => "16", 		"ID4" => "01", 	"TaxAmount3" => "4021.09", 

			"TaxEvidenceIndicator2" => "FALSE", 	"TaxableAmount2" => "97128", 		"TaxAmount4" => "4021.09", 		"Percent2" => "4.14", 

			"ID5" => "03", 	"LineExtensionAmount" => "97128", 		"TaxExclusiveAmount" => "19561.57", 	"PayableAmount" => "116689.57", 

			"ID6" => "01", 	"InvoicedQuantity" => "456", 	"LineExtensionAmount2" => "97128", 	"Description" => "Línea-1 45910281428 fos0001_700085371_f7999_R469910-459-27223", 

			"PriceAmount" => "213"

			);

			$array = explode('##',$datosfactura);

			foreach ($array as $key => $value) {

				if($value != ""){

					$arr3 = explode('|',$value);

					$var[$arr3[0]] = $arr3[1];

				}

			}

			$MDian_facturacion = new MDian_facturacion;

			$listdMDian_facturacion = $MDian_facturacion->ListarDian_facturacion("");

			while ($rx = $con->FetchAssoc($listdMDian_facturacion)) {

				$var['InvoiceAuthorization'] = $rx['num_resolucion'];

		        $var['StartDate'] = $rx['fecha_vigencia_desde'];

		        $var['EndDate'] = $rx['fecha_vigencia_hasta'];

		        $var['Prefix'] = $rx['prefijo'];

		        $var['From'] = $rx['rango_desde'];

		        $var['To'] = $rx['rango_hasta'];

		        $var['ProviderID'] = $rx['nit']; 

		        $var['SoftwareID'] = $rx['software_id'];

		        $var['SoftwareSecurityCode'] = $rx['pin'];

		        $var['UUID'] = $rx['clave'];

		        $var['UUID2'] = $rx['clave'];

				$var['password'] = hash("sha256", $rx['clave']);

				$var['nonce'] = base64_encode(date("Y-m-d H:i:s").$f->zerofill($var['ID'], 10).$rx['nit']);

				$var['Num_Factura_C'] = $rx['prefijo'].$var['ID'];

			}

			$archivo_FOS = "face_f".$f->zerofill($var['ProviderID'], 10).$f->zerofill($var['ID'], 10).".xml";

			$var['NombreArchivo'] = $archivo_FOS;

			$emptyfields = array();

	        $validationdata = true;

			foreach ($var as $key => $value) {

	            $response = $f->ValidarXMLField(trim($key), trim($value));

	            if ($response['respuesta'] == "0") {

	            	array_push($emptyfields, $response['mensaje']);

	           		$validationdata = false;

	           		break;

	            }

	        }

			if(!$validationdata){

				return json_encode(array('respuesta' => '1', 'mensaje' => $emptyfields));

			}else{

				$str = $f->GetFOS($var);

				$arrarch = explode(".", $archivo_nombre);

				$nombre_arc = $arrarch[0];

				$archivo_FOS = "face_f".$f->zerofill($var['ProviderID'], 10).$f->zerofill($var['ID'], 10).".xml";

				$sfile= ROOT."/plugins/facturasXML/".$archivo_FOS;			

				$fp = fopen($sfile,"w");

				fwrite($fp,$str);

				fclose($fp);

			/*COPIAR ARCHIVO AL EXPEDIENTE*/

				$car = new MGestion_anexos;

				$tot  = $con->Query("select count(*) as max from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '0'");

				$fol = $con->Result($tot, 0, "max");

				$fol += 1;

				$rand = md5(date('Y-m-d').rand().$user_id);

				$arrarch = explode(".", $archivo_FOS);

				$ext = end($arrarch);

				$fname = $rand.".".$ext;

				$fh = fopen(UPLOADS.DS . $id.'/anexos/'.$fname, 'w');

				fwrite($fh,$str);

				fclose($fh);

		        $size = filesize(UPLOADS.DS . $id.'/anexos/'.$fname);

		        $hash = hash("sha256", $archivo_nombre.$fname.$user_id.$_SERVER[REMOTE_ADDR].date("Y-m-d").date("H:i:s").$size);

		        //base 64

				$base_file = '';

				$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$id."/anexos".DS.$fname);

				$base_file = base64_encode($data_base_file);

				$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, folder_id, folio_final, is_publico, orden, hash, base_file) values ('".date("Y-m-d H:i:s")."', '$id','".$archivo_FOS."','".$fname."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '0', '".$fol."', '1', '".$fol."', '".$hash."', '".$base_file."')");

				$anexo_id = $c->GetMaxIdTabla("gestion_anexos", "id");

				/*FIN COPIAR ARCHIVO AL EXPEDIENTE*/

				//return json_encode(array('respuesta' => '0', 'mensaje' => "Archivo XML Generado Correctamente $sfile"));

				$cliente_dian = new nusoap_client("https://facturaelectronica.dian.gov.co/habilitacion/B2BIntegrationEngine/FacturaElectronica/facturaElectronica.wsdl", true);

	            $error = $cliente_dian->getError();

	            if ($error) {

	                 return json_encode(array('respuesta' => '1', 'mensaje' => "Constructor error WS DIAN"));

	            }

	            $zip = new ZipArchive();

 				$archivo_ZIP = $var['Prefix'].$f->zerofill($var['ID'], 10).".zip";

				$filename = ROOT."/plugins/facturasXML/zip/".$archivo_ZIP;

				if($zip->open($filename,ZIPARCHIVE::CREATE)===true) {

			        $zip->addFile(ROOT."/plugins/facturasXML/".$archivo_FOS);

			        $zip->close();

				}

				$sfile= ROOT."/plugins/facturasXML/zip/".$archivo_ZIP;

	            $data = file_get_contents($sfile);

				$base64 = base64_encode($data);

				$var['Base64'] = $base64;

				$envelope = $f->SoapEnvelope($var);

	            $archivo_FOS = "face_f".$f->zerofill($var['ProviderID'], 10).$f->zerofill($var['ID'], 10).".xml";

				$sfile= ROOT."/plugins/facturasXML/envelopes/".$archivo_FOS;			

				$fp = fopen($sfile,"w");

				fwrite($fp,$envelope);

				fclose($fp);

				$data_2 = file_get_contents($sfile);

				$base64_2 = base64_encode($data_2);

	            $array_dian = array("NIT" => $var['ProviderID'], "InvoiceNumber" => $var['ID'], "IssueDate" => $var['IssueDate']." ".$var['IssueTime'], "Document" => $var['Base64']);

	            $result = $cliente_dian->call("EnvioFacturaElectronica", $array_dian);

	            $result2 =  implode(",", $result);

	            if ($cliente_dian->fault) {

	                #return json_encode(array('respuesta' => '1', 'mensaje' => "fault WS DIAN: ".$result2));

	                return $result2;

	            }else{

	                $error = $cliente_dian->getError();

	                if ($error) {

	                    return json_encode(array('respuesta' => '1', 'mensaje' => "Error No se creo el WS DIAN"));

	                }else {

	                    if ($result == "") {

	                        return json_encode(array('respuesta' => '1', 'mensaje' => "No se creo el WS DIAN"));

	                    }else{

	                        return json_encode(array('respuesta' => '0', 'mensaje' => "Factura enviada a la DIAN"));

	                    }

	                }

	            }

	        }

		}

		/*FIN GENERAR FOS*/

		if($ddd === true || $ddd === null){

			return json_encode(array('respuesta' => '1', 'mensaje' => $mensajerespuesta));

		}else{

			return json_encode(array('respuesta' => '0', 'mensaje' => $ddd));

		}

    }

    function desencriptar($cadena, $key){

        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

        return $decrypted;  //Devuelve el string desencriptado

    }

    #ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER

    $server = new soap_server();

    $server->configureWSDL("CrearExpedienteExterno", "urn:CrearExpedienteExterno");

    $server->register("GetCrearExpedienteExterno",

        array("cedula" => "xsd:string","nit_suscriptor" => "xsd:string","nombre_suscriptor" => "xsd:string","tipo_suscriptor" => "xsd:string","Direccion_suscriptor" => "xsd:string","Telefonos_suscriptor" => "xsd:string","Email_suscriptor" => "xsd:string","radicado" => "xsd:string","dependencia_destino" => "xsd:string","observacion" => "xsd:string","archivo" => "xsd:string","archivo_nombre" => "xsd:string","como_enviar_expediente" => "xsd:string","datosfactura" => "xsd:string"),

        array("return" => "xsd:string"),

        "urn:CrearExpedienteExterno",

        "urn:CrearExpedienteExterno#GetCrearExpedienteExterno",

        "rpc",

        "encoded",

        "Registra un expediente");

    $server->service($HTTP_RAW_POST_DATA);

?>