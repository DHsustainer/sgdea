<?php
#exit;
session_start();
date_default_timezone_set("America/Bogota");
error_reporting(0);

	// Llamando al controlador principal
	require_once('app/plugins/nusoap/nusoap.php');

    $result = 'localhost|,|USER_DB|,|PASSWORD_DB|,|DB_NAME|,|estado_cuenta:1;estado_cuenta:1;firma_electronica:1;firma_electronica:1;firma_digital:1;firma_digital:1;acceso_suscriptores:1;acceso_suscriptores:1;foleado_electronico:0;foleado_electronico:0;formularios:1;formularios:1;inmaterializacion:0;inmaterializacion:0;total_usuarios:300;total_usuarios:300;total_oficinas:5;total_oficinas:5;correo_electronico:1;correo_electronico:1;correo_fisico:1;correo_fisico:1;metadatos:1;metadatos:1;actualizaciones:1;actualizaciones:1;total_areas:140;total_areas:140;total_series:200;total_series:200;total_subseries:10000;total_subseries:10000;correspondencia:1;correspondencia:1;interaccion_suscriptores:1;interaccion_suscriptores:1;:0;manuales_usuario:0;ofuscador:0;suscriptores_keys:0;configuracion_modulos:0;versionador:0;sgdea:1;sgdea:1;dep_sus:0;workflow:0;workflow:0;control_versiones:0;multiempresa:0;multiempresa:0;chat:0;chat:0;radicacion_externa:0;radicacion_externa:0;firmacrt:1;tabla_historica:0;tabla_historica:0;digitalizacion:0;digitalizacion:0;demandas_en_linea:1;demandas_en_linea:1;import_ejecutivos:0;seguimiento:0;seguimiento:0;actuaciones:1;actuaciones:1;registro_publico_usuarios:0;registro_publico_usuarios:0;tipo_negocio_correpondencia:2;tipo_negocio_correpondencia:2;modo_negocio_correpondencia:1;modo_negocio_correpondencia:1;tipo_smtp:1;tipo_smtp:1;salida_servidor:0;salida_servidor:0;correspondencia_subserie:1;correspondencia_subserie:1;configuracion_pagos:0;configuracion_pagos:0;multioficina:0;multioficina:0;|,|||Creador de Firmas Digitales:dashboard/firmacrt:fa-certificate;||||,|mail.sgdea.com|587|comunicaciones@sgdea.com|[yVXQMI6[ML!|1|1|,|';
    
    $x  = explode("|,|", $result);

    if ($x[0] != 'errno') {

        $_SESSION["pzhkCSC0XMwpGMT"] = desencriptar($x[0], $_SESSION['user_key']);
		$_SESSION["kYg8omRSc1EDj3u"] = desencriptar($x[1], $_SESSION['user_key']);
		$_SESSION["1oKU35BSbQ7CG5Q"] = desencriptar($x[2], $_SESSION['user_key']);
		$_SESSION["71c029wus3yJWEN"] = desencriptar($x[3], $_SESSION['user_key']);
		$elementos = explode(";", $x[4]);
		$permisos = array();
		for ($i=0; $i <  count($elementos) ; $i++) { 
			$val = explode(":", $elementos[$i]);
			$permisos[$val[0]] = $val[1];

		}
		$_SESSION['MODULES'] = $permisos;
		$_SESSION['VAR_SESSIONES'] = true;

	    $string = $x[5];
	    $elementos = explode("|", $string);
	    $vector = array();

	    for ($i=0; $i <  count($elementos) ; $i++) { 
	        $bloques = explode(";", $elementos[$i]);
	        $vector[$i] = $bloques;
	    }
	    $_SESSION['vector'] = $vector;

	    #DEFINIENDO LOS PARAMETROS PARA EL CORREO CERTIFICADO

	    $string = $x[6];					   
	    $elementos = explode("|", $string);
	    $_SESSION['variablessmtp'] = $elementos;

	    #DEFINIENDO PRA LAS EMPRESAS SIEMPRE Y CUANDO EL MODULO ESTE ACTIVADO
	    $string = $x[7];
	    $listempresas = array();
		if($string != ""){
		    $elementos = explode("|", $string);
		    for ($i=0; $i <  count($elementos) ; $i++){ 
		        $bloques = explode(";", $elementos[$i]);
		        $listempresas[$i] = $bloques;
		    }
		}
	    $_SESSION['listempresas'] = $listempresas;
    }else{
    	$_SESSION['VAR_SESSIONES'] = false;
    }
    #print_r($_SESSION);
    #$_SESSION['71c029wus3yJWEN'] = "expvir_fuuldb";

#    echo $_SESSION['MODULES']['estado_cuenta'];


	if ($_SESSION['VAR_SESSIONES'] ) {



		if ($_SESSION['MODULES']['estado_cuenta'] == "1") {

			require 'app/controller/mvc.main_controller.php';
			# VALIDACIÓN DE TOKEN CSRF!
			/*
		    if (isset($_POST['auth_token'])) {
		        $ticket = $_POST['auth_token'];
		        $valid = $f->verifyFormToken('loginform', $ticket, 900);
		        if(!$valid){
		    		$mvc = new MainController;
					$mvc->ErrorToken();	
					exit;
		        }
		    }*/
		    # FIN VALIDACIÓN DE TOKEN CSRF!

			$tr = $c->GetDataFromTable("super_admin", "id", "6", "tipo_radicacion", "");

			if(!defined('TIPO_RADICACION')){
			    define("TIPO_RADICACION", $tr);//Proceso
			}

			$qx = $con->Query("Select codeword, p_clave, mostrar from keywords");
			while ($row = $con->FetchAssoc($qx)) {
				if(!defined($row['codeword'])){
			    	define($row['codeword'], $row['p_clave']);
				}
				if(!defined('M_'.$row['codeword'])){
			    	define('M_'.$row['codeword'], $row['mostrar']);
				}
			}

			# code...
			//VARIABLES QUE RECIBIMOS DESDE LA URL O POR POST!

			/*
				m		=	MODELO A CARGAR
				action	=	LA ACCION A EJECUTAR
				id		= 	VARIABLE PRINCIPAL
				cn		= 	OTRA VARIABLE
				SE IRAN AGREGANDO VARIABLES NUEVAS DE ACUERDO A LA NECESIDAD. SE DEBE CONFIGURAR EL ARCHIVO .HTACCESS
			*/



			//Obteniendo informacion del navegador		



			$browser = $f->getBrowser();

		

			$browser_name = $browser["name"];


			// Cargando el listado de controladores disponibles



			$controllers = array('login', 'usuario', 'dashboard', 'usuarios','proceso','caratula','herramientas', 'agenda', 'contactos', 'correo', 'anexos', 'ayuda', 'notas', 'compartir' , 'informes', 'memoriales' , 'abonos', 'gastos', 'actuaciones', 'alertas_usuarios', 'demandante_proceso_juridico', 'demandado_proceso', 'super_admin', 'abonos_img', 'gastos_img', 'city', 'province', 'propuesta', 'anexos_carpeta', 'folder_ciudadano', 'registro', 'chat', 'seccional', 'seccional_principal', 'areas', 'dependencias', 'areas_dependencias', 'suscriptores_contactos', 'suscriptores_contactos_direccion', 'gestion', 'gestion_movimiento', 'gestion_anexos', 'big_data', 'ref_tables', 'plantilla_dependencia', 'documentos_gestion', 'events_gestion', 'dependencias_alertas', 'dependencias_documentos', 'dependencias_tipologias', 'dependencias_permisos_documento', 'gestion_suscriptores', 'gestion_folder', 'gestion_compartir', 'documentos_gestion_permisos', 'notificaciones', 'estados_gestion', 'gestion_anexos_permisos', 'gestion_tipologias_big_data', 'dependencias_tipologias_referencias', 'firmas_usuarios', 'preguntas_usuarios', 'preguntas_secretas', 'gestion_anexos_firmas', 'fuentes', 'usuarios_funcionalidades','usuarios_configurar_accesos', 'solicitudes_documentos','gestion_cambio_ubicacion_archivo','sort', 'consultapublica','suscriptores_empresas', 'gestion_favoritos', 'usuarios_seguimiento', 'usuarios_compras', 'usuarios_paquetes', 'correcciones', 's', 'navigator');



			require 'app/controller/controller_helpers.php';



			//echo $browser_name;



			// si uso un navegador desactualizado...	



			$os = array('Internet Explorer');



			if (in_array($browser_name, $os)) {







					$mvc = new MainController;



					$mvc->CargarNavegadorObsoleto();	



			// si no entonces ejecuta la aplicacion :D



			}else{

				// Si controlador no es encontrado entonces llama al controlador principal en la accion ejecutada sino llama al controlador invocado
				#echo "hola ";


				if(!in_array($_REQUEST['m'], $controllers)){
					$mvc = new MainController;	
					// Si la accion buscada existe entonces ejecutala sino... carga la pagina principal	
					if(method_exists($mvc, $_REQUEST['m'])){
						if(strtolower($_REQUEST['m']) == "acerca"){
							$mvc->acerca();
						}elseif (strtolower($_REQUEST['m']) == "que_es") {
							$mvc->Que_es();
							# code...
						}elseif (strtolower($_REQUEST['m']) == "como_funciona") {
							$mvc->Como_funciona();
							# code...
						}elseif (strtolower($_REQUEST['m']) == "dirigido") {
							$mvc->Dirigido();
							# code...
						}elseif (strtolower($_REQUEST['m']) == "ecologico") {
							$mvc->Ecologico();
							# code...
						}elseif (strtolower($_REQUEST['m']) == "marco_legal") {
							$mvc->Marco_legal();
							# code...
						}elseif (strtolower($_REQUEST['m']) == "precios") {
							$mvc->Precios();
							# code...
						}else{
							$mvc->CargarHome();	
						}
					}else{ 
						$mvc->CargarHome();	
					}
				}else{
					if(isset($_SESSION["usuario"])){
						if ($_REQUEST['action'] == 'acuse' || $_REQUEST['action'] == 'geolocation' || $_REQUEST['m'] == 'sort' || $_REQUEST['action'] == 'alterdata') {
							$filename = strtolower($_REQUEST['m']);
							// verificamos si el archivo del controlador solicitado existe en la carpeta del controlador; de existir lo invocamos
							if (file_exists('app/controller/c.'.$filename.'.php')) {
								require('app/controller/c.'.$filename.'.php');
							}else {
							//	si no existe entonces ejecuta el controlador principal en inicio
								$mvc = new MainController;			
								$mvc->CargarHome();	
							}
						}elseif ($_REQUEST['m'] == 'consultapublica') {
								$filename = strtolower($_REQUEST['m']);
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}

						}elseif ($_REQUEST['m'] == 'recursos') {
								$filename = strtolower($_REQUEST['m']);
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}

						}elseif ($_REQUEST['m'] == 's') {
								$filename = strtolower($_REQUEST['m']);
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}

						}else{
							//	organizamos el controlador solicitado para buscar en minusculas, para evitar error de typeo humano 	
							$filename = strtolower($_REQUEST['m']);
							// verificamos si el archivo del controlador solicitado existe en la carpeta del controlador; de existir lo invocamos
							if (file_exists('app/controller/c.'.$filename.'.php')) {
								require('app/controller/c.'.$filename.'.php');

							} else {
							//	si no existe entonces ejecuta el controlador principal en inicio
								$mvc = new MainController;			
								$mvc->CargarHome();	
							}
						}
					}else{
							if ($_REQUEST['action'] == 'acuse' || $_REQUEST['action'] == 'geolocation' || $_REQUEST['m'] == 'sort' || $_REQUEST['action'] == 'alterdata') {
								$filename = strtolower($_REQUEST['m']);
								// verificamos si el archivo del controlador solicitado existe en la carpeta del controlador; de existir lo invocamos

								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}
							}elseif ($_REQUEST['action'] == 'buscar') {
								$filename = strtolower($_REQUEST['m']);
								// verificamos si el archivo del controlador solicitado existe en la carpeta del controlador; de existir lo invocamos
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}
							}elseif ($_REQUEST['action'] == 'descargar') {
								$filename = strtolower($_REQUEST['m']);
								// verificamos si el archivo del controlador solicitado existe en la carpeta del controlador; de existir lo invocamos
								
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}
							}elseif ($_REQUEST['action'] == 'descarganotificacion') {

								$filename = strtolower($_REQUEST['m']);
								// verificamos si el archivo del controlador solicitado existe en la carpeta del controlador; de existir lo invocamos
								
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}
							}elseif ($_REQUEST['action'] == 'listadodenotificaciones') {
								$filename = strtolower($_REQUEST['m']);
								// verificamos si el archivo del controlador solicitado existe en la carpeta del controlador; de existir lo invocamos
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}
							}elseif ($_REQUEST['action'] == 'listadodocumentosqr') {
								$filename = strtolower($_REQUEST['m']);
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}

							}elseif ($_REQUEST['m'] == 'consultapublica') {
								$filename = strtolower($_REQUEST['m']);
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}
							}elseif ($_REQUEST['m'] == 'recursos') {
								$filename = strtolower($_REQUEST['m']);
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}

							}elseif ($_REQUEST['m'] == 's') {
								$filename = strtolower($_REQUEST['m']);
								echo 'I think im here';
								// exit;
								if (file_exists('app/controller/c.'.$filename.'.php')) {
									require('app/controller/c.'.$filename.'.php');
								} else {
								//	si no existe entonces ejecuta el controlador principal en inicio
									$mvc = new MainController;			
									$mvc->CargarHome();	
								}

							}else{
								if($_REQUEST['m'] == "registro"){
									require('app/controller/c.registro.php');	
								}else{
									require('app/controller/c.login.php');
									
								}
								#require('app/controller/c.login.php');
							}
						}
					/*}*/
				}
			}	
		}else{
		
			include(VIEWS.DS.'template/error_view.php');
		}

	}else{



		echo "<html>



		<head>



			<title>Error de Sesion</title>



			<style>



				.da-message



				{	



					font-size:15px;



					font-weight: bold;



					border-bottom:1px solid #d2d2d2;



					padding:15px 8px 15px 8px;



					position:relative;



					vertical-align:middle;



					cursor:pointer;



					



					background-color:#f8f8f8;



					background-position:12px 12px;



					background-repeat:no-repeat;



					text-align: center;



				}











					.da-message p, 



					.da-message ul, 



					.da-message ol



					{



						margin:0;



					}







					.da-message ul li, 



					.da-message ol li



					{



						list-style-position:inside;



						list-style-type:inherit;



						margin:0;



					}







					.da-message.error



					{



						background-color:#DC6E53;



						border-color:#DC6E53;



						color:#FFF;



					}







					.da-message.error .da-message-close



					{



						background-position:right bottom;



					}











					.da-message.success



					{



						background-color:#67C295;



						border-color:#67C295;



						color:#FFF;



					}







					.da-message.success .da-message-close



					{



						background-position:left bottom;



					}











					.da-message.warning



					{



						background-color:#F3A343;



						border-color:#F3A343;



						color:#FFF;



					}







					.da-message.warning .da-message-close



					{



						background-position:right top;



					}











					.da-message.info



					{



						background-color:#5CB0DC;



						border-color:#5CB0DC;



						color:#FFF;



					}







					.da-message.info .da-message-close



					{



						background-position:left top;



					}



					.middle{



						margin-top: 20%;



					}







			</style>



		</head>



		<body>







			<div class='da-message error'>El dominio ingresado no se encuentra activo en PGD Empresarial</div>



		



		</body>



		</html>";







		#mail("sander.cadena@laws.com.co", "Inicio de sesion no registrado", "el servidor ".$_SERVER['HTTP_HOST']." no se encuentra configurado en PGD Empresarial");



	}







	function desencriptar($plaintext, $key){

		/*
		$cipher = "aes-128-gcm";
		if (in_array($cipher, openssl_get_cipher_methods()))
		{
		    $ivlen = openssl_cipher_iv_length($cipher);
		    $iv = "openssl_rand"; #openssl_random_pseudo_bytes($ivlen);

		    $original_plaintext = openssl_decrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
		    return $original_plaintext;
		}*/

		return $plaintext;



	}
?>