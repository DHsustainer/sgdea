<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'SortM.php');
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
	include_once(MODELS.DS.'Estados_gestionM.php');
	include_once(PLUGINS.DS.'parse.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Solicitudes_documentosM.php');
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_attachmentsM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Mailer_replysM.php');
	include_once(MODELS.DS.'NotificacionesM.php');
	include_once(MODELS.DS.'Gestion_anexosM.php');
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
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Wf_mapasM.php');
	include_once(MODELS.DS.'Wf_mapas_elementosM.php');
	include_once(MODELS.DS.'Wf_gestion_mapasM.php');
	include_once(MODELS.DS.'Wf_gestion_mapas_elementosM.php');
	include_once(MODELS.DS.'UsuariosM.php');
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
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');


	#error_reporting(E_ALL);
	#ini_set('display_errors', '1');

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);

	// Llamando al objeto a controlar
	$ob = new CSort;
	$c = new Consultas;
	$f = new Funciones;


		if($c->sql_quote($_REQUEST['action']) == 'listar')
			$ob->VistaListar($_REQUEST['action']);
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR
		elseif($c->sql_quote($_REQUEST['action']) == 'sms')
			$ob->VistaSMS($_REQUEST['id']);
		elseif($c->sql_quote($_REQUEST['action']) == 'checkerror')
			$ob->CheckFor($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		
		elseif($c->sql_quote($_REQUEST['action']) == 'read_mail')
			$ob->read_mail($_REQUEST['id']);
		elseif($c->sql_quote($_REQUEST['action']) == 'acuse')
			$ob->Acuse($_REQUEST['id']);

		elseif ($c->sql_quote($_REQUEST['action']) == 'alterdatamail')
			$ob->AltDataMail( $c->sql_quote($_REQUEST['altdata']) , $c->sql_quote($_REQUEST['token']) );
		elseif ($c->sql_quote($_REQUEST['action']) == 'geolocationmail')
			$ob->geolocationMail( $c->sql_quote($_REQUEST['latitud']) , $c->sql_quote($_REQUEST['longitud']) , $c->sql_quote($_REQUEST['token']) );
		elseif($c->sql_quote($_REQUEST['action']) == 'generarcertificadomail')
			$ob->ExportarCorreoMail($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == "pruebacorreos")
			$ob->PruebaCorreos($c->sql_quote($_REQUEST['id']));
		
		elseif($c->sql_quote($_REQUEST['action']) == 'dosms'){

			echo "IP:".$_SERVER['SERVER_ADDR']."<br>";
			$telefono = $c->sql_quote($_REQUEST['id']);
			$mensaje = "Mensaje de pruebas desde EXPEDIENTES";
			echo $numero = "57".$telefono;


			$ch=curl_init();

			$post = array(
			'account' => SMSCLIENT, //número de usuario
			'apiKey' => SMSKEY, //clave API del usuario
			'token' => 'b226d0b5757c5cf6f9407b1a4efd3c68', // Token de usuario
			'toNumber' => $numero, //número de destino
			'sms' => 'SMS de prueba Hablame' , // mensaje de texto
			'flash' => '0', //mensaje tipo flash
			'sendDate'=> time(), //fecha de envío del mensaje
			'isPriority' => 0, //mensaje prioritario
			'sc'=> '899991', //código corto para envío del mensaje de texto
			'request_dlvr_rcpt' => 0, //mensaje de texto con confirmación de entrega al celular
			);

			$url = "https://api101.hablame.co/api/sms/v2.1/send/"; //endPoint: Primario
			curl_setopt ($ch,CURLOPT_URL,$url) ;
			curl_setopt ($ch,CURLOPT_POST,1);
			curl_setopt ($ch,CURLOPT_POSTFIELDS, $post);
			curl_setopt ($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT ,3);
			curl_setopt ($ch,CURLOPT_TIMEOUT, 20);
			$response= curl_exec($ch);
			curl_close($ch);
			$response= json_decode($response ,true) ;

			//La respuesta estará alojada en la variable $response

			if ($response["status"]== '1x000' ){
				print_r($response);
				echo 'El SMS se ha enviado exitosamente con el ID: '.$response["smsId"].PHP_EOL;
			} else {
				echo 'Ha ocurrido un error:'.$response["error_description"].'('.$response ["status" ]. ')'. PHP_EOL;
			}

			/*

			echo $url = 'https://api101.hablame.co/api/sms/v2.1/send/';
			echo "<br>";
			$data = array(
				'cliente' => SMSCLIENT, //Numero de cliente
				'api' => SMSKEY, //Clave API suministrada
				'numero' => $numero, //numero o numeros telefonicos a enviar el SMS (separados por una coma ,)
				'sms' => $mensaje, //Mensaje de texto a enviar
				'fecha' => '', //(campo opcional) Fecha de envio, si se envia vacio se envia inmediatamente (Ejemplo: 2017-12-31 23:59:59)
				'referencia' => 'Referenca Envio Hablame', //(campo opcional) Numero de referencio ó nombre de campaña
			);

			$options = array(
			    'http' => array(
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($data)
			    )
			);
			$context  = stream_context_create($options);
			$result = json_decode((file_get_contents($url, false, $context)), true);
			echo "Data: <br>";
			print_r($data);
			echo "<br>Options<br>";
			print_r($options);
			echo "<br>Retorno Hablame: <br>";
			var_dump($result);
			if ($result["resultado"]===0) {
				$result = implode("; ", $result);
				
				return "1";
			} else {
				return "0";
			}*/
		
		}elseif($c->sql_quote($_REQUEST['action']) == 'actualizarcita'){

			$ob->ActualizarCita();

		}

		elseif ($c->sql_quote($_REQUEST['action']) == 'alterdata')
			$ob->AltData( $c->sql_quote($_REQUEST['altdata']) , $c->sql_quote($_REQUEST['token']) );
		elseif ($c->sql_quote($_REQUEST['action']) == 'geolocation')
			$ob->geolocation( $c->sql_quote($_REQUEST['latitud']) , $c->sql_quote($_REQUEST['longitud']) , $c->sql_quote($_REQUEST['token']) );
		elseif($c->sql_quote($_REQUEST['action']) == 'generarcertificado'){
			$ob->ExportarCorreo($c->sql_quote($_REQUEST['id']));
		}elseif ($c->sql_quote($_REQUEST['action']) == "descarganotificacion") {
			echo 'descarga notificacion';
			exit;
			    $id = $c->sql_quote($_REQUEST['id']);
			    $fileurl = $c->sql_quote($_REQUEST['cn']);
			    $filename = $c->sql_quote($_REQUEST['p1']);
			    $filename = substr($filename, 0, -1);
			    $not = $c->sql_quote($_REQUEST['p2']);
/*
			    header("Content-type: application/octet-stream");
			    header("Content-Disposition: attachment; filename=\"$filename\"\n");
			    $fp=fopen("$f", "r");
			    fpassthru($fp);
*/

			    $query = $con->Query("select * from notificaciones_attachments where id = '$not'");
			    $rs = $con->FetchAssoc($query);

			    $fecha_descarga = date("Y-m-d H:i:s");
			    if ($rs['fecha_descarga'] != "") {
			    	$fecha_descarga = $rs['fecha_descarga'];
			    }

			    $con->Query("update notificaciones_attachments set fecha_descarga = '".$fecha_descarga."', estado = '1', fecha_otra_descarga = '".date("Y-m-d H:i:s")."' where id = '$not'");


			    $upd = "UPDATE notificaciones SET sms_leido = '3' WHERE id = '".$rs['id_notificacion']."'";
    			$con->Query($upd);


			    $ob->ExportarCorreo($rs['id_notificacion']);
			    

			    $url = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$id.DS.'anexos/'.$fileurl;
			    header ("Location: ".$url);


			    #$f = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$id.DS.'anexos/'.$fileurl;;
			    #header("Content-type: application/octet-stream");
			    #header("Content-Disposition: attachment; filename=\"$filename\"\n");
			    #$fp=fopen("$f", "r");
			    #fpassthru($fp);
		}elseif ($c->sql_quote($_REQUEST['action']) == "descarganotificacioncorreo") {

	#		echo $_SERVER['REMOTE_ADDR'];
	#		exit;
			$ip = $_SERVER['REMOTE_ADDR'];
			$ip = explode(".", $ip);
			$ip = $ip[0];
			#echo "<br>";
			#echo $ip;
			#exit;
			if ($ip > '128') {
			
			    $id = $c->sql_quote($_REQUEST['id']);
			    $fileurl = $c->sql_quote($_REQUEST['cn']);
			    $filename = $c->sql_quote($_REQUEST['p1']);
			    $not = $c->sql_quote($_REQUEST['p2']);

			
				$ext = explode(".", $fileurl);
				$ext = end($ext);
/*

			    header("Content-type: application/octet-stream");
			    header("Content-Disposition: attachment; filename=\"$filename\"\n");
			    $fp=fopen("$f", "r");
			    fpassthru($fp);
*/
			    $query = $con->Query("select * from notificaciones_attachments where id = '$not'");
			    $rs = $con->FetchAssoc($query);

			    $fecha_descarga = date("Y-m-d H:i:s");
			    $fecha_otra_descarga = "";
			    if ($rs['fecha_descarga'] != "") {
			    	$fecha_descarga = $rs['fecha_descarga'];
			    }

			    if ($fecha_descarga != date("Y-m-d H:i:s")) {
			    	$fecha_otra_descarga = date("Y-m-d H:i:s");
			    }

			    $con->Query("update notificaciones_attachments set fecha_descarga = '".$fecha_descarga."', estado = '1', fecha_otra_descarga = '".$fecha_otra_descarga."' where id = '$not'");

			    $str = "update mailer_replys set abierto='1', message_status = '1', estado = '2', reply_ip = '".$_SERVER['REMOTE_ADDR']."' where receiver_id = '".$rs['id_notificacion']."' ";

			    $con->Query($str);

			    $ob->ExportarCorreoMail($rs['id_notificacion']);

                #exit;
			    #$filename = $filename.".".$ext;
			    $url = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$id.DS.'anexos/'.$fileurl;
			    header ("Location: ".$url);
			    
			}
		}else{
			$ob->VistaListar($_REQUEST['action']);

		}
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CSort extends MainController{

		// DEFINIENDO LA FUNCION LISTAR
		function VistaListar($code){

			global $con;
			global $c;
			global $f;
			global $object;

			$pagina = $this->load_template_limpia(PROJECTNAME.' Getresultados_radicado');
			ob_start();
			$s1 = "select id, num_oficio_respuesta from gestion where uri = '".$code."'";

			$query = $con->Query($s1);
			$row = $con->FetchAssoc($query);

			$radicado = $row['num_oficio_respuesta'];
			$id = $row['id'];

	    	include_once(VIEWS.DS.'consultapublica'.DS."Getresultados_radicado.php");
	    	include_once(VIEWS.DS.'consultapublica'.DS."footer.php");
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.
			$table = ob_get_clean();
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			if($message != '')
				$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			$this->view_page($pagina);

		}
		function read_mail($id){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL
			global $con;
			global $c;
			global $f;


			$blacklist = array('74.125','72.14','69.147','67.73','66.249','66.102','40.94','40.107');
			#$blacklist = array();

			$ip = $_SERVER['REMOTE_ADDR'];
			$ip = explode(".", $ip);
			$ip = $ip[0];
			#echo "<br>";
			#echo $ip;
			#exit;
			if ($ip > '128') {

				$x = $con->Query("select * from mailer_replys where message_id = '".$id."'");
				$xx = $con->FetchAssoc($x);

				$fecha = $xx['envio_fecha'];
				$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
				date_modify($fecha_c, "+10 second");//sumas los dias que te hacen falta.
				$fecha_a = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

				$fecha_update = date('Y-m-d H:i:s');

				if ($fecha_update > $fecha_a) {
					# code...
					$con->Query("update mailer_replys set abierto='1', message_status = '1', abierto_fecha='".date('Y-m-d H:i:s')."', reply_datetime ='".date('Y-m-d H:i:s'	)."', reply_ip = '".$_SERVER['REMOTE_ADDR']."' where message_id = '".$id."' and abierto='0'");
					$con->Query("update mailer_replys set visitas = (visitas+1) where message_id = '".$id."'");
				}

				$con->Query("update mailer_replys set abierto='1', message_status = '1', estado = '1', reply_ip = '".$_SERVER['REMOTE_ADDR']."' where message_id = '".$id."' ");


				$archivo=VIEWS.DS.'assets/images/blanco.fw.png';
				header("Content-type: image/png");
				header("Content-length: ".filesize($archivo));
				header("Content-Disposition: inline; filename=$archivo");
				readfile($archivo);

				$this->ExportarCorreoMail($xx['receiver_id']);
			}else{

				$archivo=VIEWS.DS.'assets/images/blanco.fw.png';
				header("Content-type: image/png");
				header("Content-length: ".filesize($archivo));
				header("Content-Disposition: inline; filename=$archivo");
				readfile($archivo);

			}

		}
		function VistaSMS($id){
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL
			global $con;
			global $c;
			global $f;
			$pagina = $this->load_template_limpiaAmple(PROJECTNAME.' Getregistro');
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
		    	include_once(VIEWS.DS.'notificaciones/listadodenotificaciones.php');
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

		function Acuse($mid){
			//CARGA EL TEMPLATE
			$pagina = $this->load_template_limpiaAmple('Lectura Mensaje');
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'notificaciones/acuse.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.
			$path = ob_get_clean();
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER
			$this->view_page($pagina);
		}

		function geolocation( $latitud , $longitud , $token){
			global $con;
			$str = "SELECT * FROM notificaciones
						WHERE id = '$token'";
			$query = $con->Query($str);
			$respuesta = $con->FetchAssoc($query);

			if( $respuesta['latitude'] == "" && $respuesta['longitude'] == "" ){
				$ip= $_SERVER['REMOTE_ADDR'];
				$upd = "UPDATE notificaciones SET reply_ip = '$ip', latitude = '$latitud', longitude = '$longitud' WHERE id = '$token'";
				$con->Query($upd);
			}
		}
		function AltData($alt, $token){
			global $con;
			$str = "SELECT * FROM notificaciones
						WHERE id = '$token'";
			$query = $con->Query($str);
			$ary = explode(",", $alt);
			$zip = "";
			$cou = "";
			$alt = "";
			for ($i=0; $i < count($ary) ; $i++) {
				if ($i == count($ary)-1) {
					$cou = trim($ary[$i]);
				}elseif($i == count($ary)-2){
					$zip = trim($ary[$i]);
				}else{
					$alt .= trim($ary[$i]).", ";
				}
			}
			$respuesta = $con->FetchAssoc($query);
			if( $respuesta['country'] == ""){
					$upd = "UPDATE notificaciones SET country = '$cou', state = '$zip', city = '$alt' WHERE id = '$token'";
					$con->Query($upd);
			}

			//$this->ExportarCorreo($token);
		}


		function ExportarCorreo($id){
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


			$pathp = "";

			#$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
			$name = md5(date("Y-m-d H:i:s"))."x.pdf";
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

						  <div id="content" style="font-size:10px;">

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

				$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file, id_servicio) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','Acuse de: ".$sms['telefono']." Fecha: ".date("Y-m-d H:i:s")."' ,'".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."', 'SMS".$n->GetId()."')");


				$id = $c->GetMaxIdTabla("gestion_anexos", "id");

				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				$objecte->InsertEvents_gestion("sanderkdna@gmail.com", $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"Actuaciones del Expediente Hasta ".date("Y-m-d H:i:s")."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, "6", "1", "1", "*", "expdpc", $id);


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


		function geolocationMail( $latitud , $longitud , $token){
			global $con;
			$str = "SELECT * FROM mailer_replys
						WHERE receiver_id = '$token'";
			$query = $con->Query($str);
			$respuesta = $con->FetchAssoc($query);

			if( $respuesta['latitude'] == "" && $respuesta['longitude'] == "" ){
				$ip= $_SERVER['REMOTE_ADDR'];
				$upd = "UPDATE mailer_replys SET reply_ip = '$ip', latitude = '$latitud', longitude = '$longitud' WHERE receiver_id = '$token'";
				$con->Query($upd);
			}
		}
		function AltDataMail($alt, $token){
			global $con;
			$str = "SELECT * FROM mailer_replys
						WHERE receiver_id = '$token'";
			$query = $con->Query($str);
			$ary = explode(",", $alt);
			$zip = "";
			$cou = "";
			$alt = "";
			for ($i=0; $i < count($ary) ; $i++) {
				if ($i == count($ary)-1) {
					$cou = trim($ary[$i]);
				}elseif($i == count($ary)-2){
					$zip = trim($ary[$i]);
				}else{
					$alt .= trim($ary[$i]).", ";
				}
			}
			$respuesta = $con->FetchAssoc($query);
			if( $respuesta['country'] == ""){
					$upd = "UPDATE mailer_replys SET country = '$cou', state = '$zip', city = '$alt' WHERE receiver_id = '$token'";
					$con->Query($upd);
			}

			//$this->ExportarCorreo($token);
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
			$name = md5(date("Y-m-d H:i:s"))."x.pdf";
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


	    	// $logo_courrier = ROOT.DS.'plugins/thumbnails/'.$em->Getlogo_courrier();
	    	// $exists = file_exists( $logo_courrier );
	    	// if ($em->Getlogo_courrier() == "") {
	    	// 	$encabezado = HOMEDIR.DS.'app/plugins/thumbnails/'.$em->GetFoto_perfil();
	    	// }else{
	    	// 	$encabezado = HOMEDIR.DS.'app/plugins/thumbnails/'.$em->Getlogo_courrier();
	    	// }

			$pie_pagina = "";

			$html2 = '

						<html>

						<head>

						  <style>

						    @page { margin: 120px 100px; }

						    #header { position: fixed; left: -50px; top: -120px; right: 0px; height: 83px; background-size: 170px !important; text-align: center; border-bottom:2px solid #C2E1F1; }

						    #footer { position: fixed; left: 0px; bottom: -120px; right: 0px; height: 110px;  }

						    #footer .page:after { content: counter(page, upper-roman); }

						    body{ font-family:"Helvetica"; }

						    h2{margin-top:20px !important;}

						  </style>

						<body>

						  <div id="header"></div>

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

				$con->Query("delete from alertas_suscriptor where type = 'rmail' and extra = '".$sms['direccion']."' and id_gestion =  '".$g->GetId()."'");


				$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file, id_servicio) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','Acuse de ".$sms['direccion']." Fecha: ".date("Y-m-d H:i:s")."' ,'".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."', 'EMAIL".$n->GetId()."')");


				$id = $c->GetMaxIdTabla("gestion_anexos", "id");

				$objecte = new MEvents_gestion;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
				$objecte->InsertEvents_gestion("sanderkdna@gmail.com", $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"Actuaciones del Expediente Hasta ".date("Y-m-d H:i:s")."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, "6", "1", "1", "*", "expdpc", $id);


				$description = "Se a Creado o actualizado el certificado de lectura del mensaje enviado a ".$n->GetDestinatario();
    			$con->Query("INSERT INTO alertas_suscriptor 
    								(suscriptor_id, alerta, id_gestion, fechahora, estado, type, tipo_usuario, extra, id_anexo) 
    						VALUES 	('".$n->GetUser_id()."', '".$description."', '".$g->GetId()."', '".date("Y-m-d H:i:s")."', '0', 'rmail', 'U', '".$sms['direccion']."', '".$id."')");

    			$con->Query("update gestion set suscriptor_leido = '1',  usuario_leido = '1' where id = '".$n->GetProceso_id()."'");

				#echo $idretorno."Documento Exportado a Anexos";
			}else{
				#echo "Se produjo un error al Exportar";
			}
		}

		function CheckFor($campo, $valor){
			global $con;
			global $c;
			global $f;			

			$campo_query = "user_id";
			$campo_texto = "Dirección de Correo Electrónico";

			if ($campo == "identificacion") {
				$campo_query = "id";
				$campo_texto = "Identificación";
			}

			$q = $con->Query("select count(*) as t from usuarios where $campo_query = '$valor'");
			$r = $con->FetchAssoc($q);

			$t = $r["t"];

			$msg = "";
			$val = "1";

			if ($t > 0) {
				$msg = "<div class='text-danger m-t-10 m-l-10'><span class='mdi mdi-close-circle'></span> El campo $campo_texto $valor, ya se encuentra registrado, intente con otro </div>";
				$val = "0";
			}else{
				$msg = "<div class='text-success m-t-10 m-l-10'><span class='mdi mdi-check-circle'></span> El campo $campo_texto $valor, se encuentra disponible</div>";
				$val = "1";
			}

			$arr = array(	'msg' => $msg, 
							'stat' => $val);

			echo json_encode($arr);	


		}

		function ActualizarCita(){
			global $con;
			global $c;
			global $f;

			$username = $c->sql_quote($_REQUEST['username']);
			$date_cita = $c->sql_quote($_REQUEST['date_cita']);
			$time_cita = $c->sql_quote($_REQUEST['time_cita']);

			if ($date_cita == "") {
				echo "Debe seleccionar una fecha para su cita";
			}else{
				$update = "update usuarios set fecha_capacitacion = '$date_cita', hora_capacitacion = '$time_cita' where user_id = '$username'";
				$q = $con->Query($update);

				if ($q) {
					echo "Solicitud de Capacitación Generada Correctamente";
				}else{
					echo "Error al Realizar la Cita";
				}

			}

		}

		function PruebaCorreos($tm){
			global $con;
			global $f;
			global $c;

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $_SESSION['usuario']);

			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', '5');
			$emailMessage = $MPlantillas_email->GetContenido();

			$subject = "Prueba de Conexion SMTP";

			$exito = $c->fnEnviaEmailGlobal2(CONTACTMAIL,$u->GetP_nombre()." ".$u->GetP_apellido() ,$subject,$emailMessage,$tm, "1", $tm);

			if ($exito) {
				$se_envio_mail = "1";
				echo '<b>Mensaje enviado a la direccion de correo: '.$tm.'<br></b>';

			}else{
				$se_envio_mail = "0";
				echo "<h4>Estado Final</h4>";
				echo '<br><b>No se pudo enviar el mensaje a la direccion de correo: '.$tm.' ('.$exito.')'.'<br></b><br>';
			}
		}

	}
?>