<?php
session_start();
date_default_timezone_set("America/Bogota");
error_reporting(0);



	// Llamando al controlador principal






	require_once('app/plugins/nusoap/nusoap.php');





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



                }



            }



        }



    }



#    print_r($_SESSION['variablessmtp']);

#    echo $_SESSION['MODULES']['estado_cuenta'];



	if ($_SESSION['VAR_SESSIONES'] ) {



		if ($_SESSION['MODULES']['estado_cuenta'] == "1") {



			# code...



			require 'app/controller/mvc.main_controller.php';



		



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



			$controllers = array('login', 'usuario', 'dashboard', 'usuarios','proceso','caratula','herramientas', 'agenda', 'contactos', 'correo', 'anexos', 'ayuda', 'notas', 'compartir' , 'informes', 'memoriales' , 'abonos', 'gastos', 'actuaciones', 'alertas_usuarios', 'demandante_proceso_juridico', 'demandado_proceso', 'super_admin', 'abonos_img', 'gastos_img', 'city', 'province', 'propuesta', 'anexos_carpeta', 'folder_ciudadano', 'registro', 'chat', 'seccional', 'seccional_principal', 'areas', 'dependencias', 'areas_dependencias', 'suscriptores_contactos', 'suscriptores_contactos_direccion', 'gestion', 'gestion_movimiento', 'gestion_anexos', 'big_data', 'ref_tables', 'plantilla_dependencia', 'documentos_gestion', 'events_gestion', 'dependencias_alertas', 'dependencias_documentos', 'dependencias_tipologias', 'dependencias_permisos_documento', 'gestion_suscriptores', 'gestion_folder', 'gestion_compartir', 'documentos_gestion_permisos', 'notificaciones', 'estados_gestion', 'gestion_anexos_permisos', 'gestion_tipologias_big_data', 'dependencias_tipologias_referencias', 'firmas_usuarios', 'preguntas_usuarios', 'preguntas_secretas', 'gestion_anexos_firmas', 'fuentes', 'usuarios_funcionalidades','usuarios_configurar_accesos', 'solicitudes_documentos','gestion_cambio_ubicacion_archivo','sort', 'consultapublica','suscriptores_empresas');



			require 'app/controller/controller_helpers.php';



			//echo $browser_name;



			// si uso un navegador desactualizado...	



			$os = array('Internet Explorer 4', 'Internet Explorer 5', 'Internet Explorer 6', 'Internet Explorer 7');



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