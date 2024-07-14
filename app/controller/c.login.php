<?

session_start();

#error_reporting(E_ALL);

#ini_set('display_errors', '1');

date_default_timezone_set("America/Bogota");

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'Super_adminM.php');

	include_once(MODELS.DS.'FolderM.php');

	include_once(MODELS.DS.'CityM.php');

	include_once(MODELS.DS.'AreasM.php');

	include_once(MODELS.DS.'SeccionalM.php');
	
	include_once(MODELS.DS.'UsuariosM.php');
	
	include_once(MODELS.DS.'GestionM.php');

	include_once(PLUGINS.DS.'messages.php');	

	include_once(MODELS.DS.'Suscriptores_contactosM.php');

	#include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	$ob = new CLogin;

	$c = new Consultas;

	$f = new Funciones;

	$m = new Messages;

	#$mail = new PHPMailer;	

	$action = $c->sql_quote($_REQUEST["action"]);

	if($action == "login"){

		if($_SESSION["usuario"]  == '') {

			$ob->CargarLogin();	

			$c->crearLog();

		} else {

			$ob->CargarHome();

			$c->crearLog();	

		}

	}elseif($action == "check"){
	 	 
		$ticket = $_POST['auth_token'];
		$valid = $f->verifyFormToken('loginform', $ticket, 900);


		if ($_REQUEST['vtoken'] == "NO") {

			$c = new Consultas;
			$username = strtolower(trim($c->sql_quote($_REQUEST["username"])));
			$password = md5($c->sql_quote($_REQUEST["pass"]));

			$ob->ValidarSession($username, $password, $c->sql_quote($_REQUEST["pass"]));

		}else{
			if(!$valid){
			   	$ob->CargarLogin("4");
			   	exit;
			}

		$recaptcha = $_REQUEST["g-recaptcha-response"];
			// $url = 'https://www.google.com/recaptcha/api/siteverify';
			// $data = array(
			// 	'header' => "Content-Type: application/x-www-form-urlencoded\r\n", 
			// 	'secret' => '6LeuotIZAAAAAB5yN6N9yo1mIT5Kmj_91CLMZUXb',
			// 	'response' => $recaptcha
			// );
			// $options = array(
			// 	'http' => array (
			// 		'method' => 'POST',
			// 		'content' => http_build_query($data)
			// 	)
			// );
			// $context  = stream_context_create($options);
			// $verify = file_get_contents($url, false, $context);
			// $captcha_success = json_decode($verify);
			// if ($captcha_success->success) {

				$c = new Consultas;
				$username = strtolower(trim($c->sql_quote($_REQUEST["username"])));
				$password = md5($c->sql_quote($_REQUEST["pass"]));

				$ob->ValidarSession($username, $password, $c->sql_quote($_REQUEST["pass"]));
			// } else {
			// 	$ob->CargarLogin("3");
			// }
/*				
		
			$c = new Consultas;
				$username = strtolower(trim($c->sql_quote($_REQUEST["username"])));
				$password = md5($c->sql_quote($_REQUEST["pass"]));

				$ob->ValidarSession($username, $password, $c->sql_quote($_REQUEST["pass"]));
*/
			
		}



	}elseif($action == "clientes"){

		if ($_SESSION['MODULES']['acceso_suscriptores'] == "1") {

			if($_SESSION["cliente"]  == '') {

				$c->crearLog();	
				$ob->CargarLoginClientes();	


			} else {

				$ob->CargarHome();

				$c->crearLog();	

			}

		}else{

			header("Location: ".HOMEDIR);

		}

	}elseif($action == "checkclientes"){

		$c = new Consultas;

		$username = strtolower(trim($c->sql_quote($_REQUEST["username"])));

		$password = md5($c->sql_quote($_REQUEST["pass"]));

		$ob->ValidarSessionClientes($username, $password);

	}elseif($action == "kill"){

		$ob->LogOut();

	}elseif($action == "restablecer"){

		$ob->RecuperarClave();

	}elseif($action == "sendpassword"){

		$c = new Consultas;

		$username = strtolower(trim($c->sql_quote($_REQUEST["username"])));

		$captcha = $c->sql_quote($_REQUEST["tmptxt"]);

		$ob->EnviarClave($username, $captcha);

	}elseif($action == "as"){

		$ob->LoginAs($c->sql_quote($_REQUEST[id]));

	}elseif($action == "updateession"){

		$_SESSION['updateession'] = '1';
		echo $_SESSION['updateession'];

	}elseif($action == "actualizarsesion"){

		$ob->ResetSesiones($c->sql_quote($_REQUEST["id"]));
	
	}elseif($action == "changeempresacambio"){

		$ob->ChangeEmpresaCambio($c->sql_quote($_REQUEST["id"]));
	
	}elseif($action == "changeempresaverificador"){

		$ob->ChangeEmpresaVerificador($c->sql_quote($_REQUEST["id"]));
	
	}elseif($action == "LoginE"){
		$_SESSION['71c029wus3yJWEN'] = $c->sql_quote($_REQUEST["id"]);

	}else{
		if($_SESSION["usuario"]  == '') {

			$ob->CargarLogin();	

			$c->crearLog();

		} else {

			$ob->CargarHome();	

			$c->crearLog();

		}

	}

	class CLogin extends MainController{

		/*COMPONENTE LOGIN*/

		function CargarLogin($id = ""){

			$pagina = $this->load_templateLogin(utf8_decode(PROJECTNAME).ST.'Iniciar sesion');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();

			switch ($id) {
				case '1':
					$error = "Su nombre de usuario o contraseña es incorrecto ";
					break;
				case '2':
					$error = "Su cuenta de usuario se encuentra desactivada";
					break;
				case '3':
					$error = "Debe Indicar que no es un Robot!";
					break;
				case '4':
					$error = "El Token de Sesión no es valido";
					break;	
				default:
					$error = "";
					break;
			}

			include_once(VIEWS.DS.'login/loginform.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);	
		}

		function CargarLoginClientes($id = ""){
			#echo "hola";
			header("Location: ".HOMEDIR.DS.'login/' );

		}		


		function CargarHome($id = ""){

			$pagina = $this->load_templateLogin(PROJECTNAME.ST.$_SESSION["usuario"]);			

			include_once(VIEWS.DS.'login'.DS.'dashBoard.php');

//			$contenido = $this->load_page(VIEWS.DS.'login'.DS.'dashBoard.php');

//			$pagina = $this->replace_content('/\#CONTENIDO\#/ms',$contenido , $pagina);

			$this->view_page($pagina, "login");

		}

		function ValidarSessionClientes($username, $password){

			global $con;

			$object = new MUsuarios;
			$result = explode("@@",$object->CheckSessionCliente($username, $password));
			if($result[0] == "1"){
				$this->CargarLogin("1");
			}else{
				echo $this->CargarHome();
			}
		}		
		function ValidarSession($username, $password, $dec){

			global $con;

			$object = new MUsuarios;
			if (isset($_POST[admin])) {
				$result = explode("@@",$object->CheckSessionAdmin($username, $password));
			}else{
				$result = explode("@@",$object->CheckSession($username, $password, $dec));
			}
			if($result[0] == "1"){
				$this->ValidarSessionClientes($username, $password);
				#$this->CargarLogin("1");
			}elseif($result[0] == "2"){
				$this->CargarLogin("2");
			}
			else{
				echo $this->CargarHome();
			}
		}

		function LogOut(){

			$object = new MUsuarios;

			global $con;

			$pagina = $this->load_template('Cerrar Sesion');			

			$query = $object->KillSession();	

			unset($_SESSION);    

   			echo "<script> window.location.href = '".HOMEDIR.DS."';</script>";

   			#header("Location: ".HOMEDIR.DS."login".DS);	

			#ob_start();		

			#$table = ob_get_clean();	

			#$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			#$this->view_page($pagina, "login");			

		}

		function RecuperarClave($id = "", $username = "", $usrmessage = ""){

			$pagina = $this->load_templateLogin('Restablecer la Contrase&ntilde;a');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			$error = "";

			if($id != "")

				$error = "El codigo de verificacion es incorrecto";

			if($usrmessage != "")

				$usrmessage = "El nombre de usuario ingresado no existe";

			include_once(VIEWS.DS.'login/forgotpassword.php');				

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						

			$path = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);

			$pagina = $this->replace_content('/\#ERRORMESSAGE\#/ms', $error  , $pagina);

			$pagina = $this->replace_content('/\#USERNAME\#/ms', $username  , $pagina);									

			$pagina = $this->replace_content('/\#USERMESSAGE\#/ms', $usrmessage  , $pagina);												

			// CARGAMOS LA PAGINA EN EL BROWSER	

			$this->view_page($pagina);	

		}		

		function EnviarClave($username, $captcha, $id = ""){

			$pagina = $this->load_templateLogin('Restablecer la Contrase&ntilde;a.');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			if ($_SESSION['tmptxt'] != $captcha) {

				$this->RecuperarClave(1, $username);	

			}else{

				global $con;

				$object = new MUsuarios;

				$object->CreateUsuarios("user_id", $username);

				if($object->GetA_i() != ""){

					global $f;

					global $m;

					global $c;

					#global $mail;

					$text = $f->randomText(8);

					$np = md5($text);

					

					$MPlantillas_email = new MPlantillas_email;

					if ($_SESSION['tmptxt'] == "rpw") {
						$MPlantillas_email->CreatePlantillas_email('id', '72');
					}else{
						$MPlantillas_email->CreatePlantillas_email('id', '3');
					}

					$contenido_email = $MPlantillas_email->GetContenido();

					$contenido_email = str_replace("[elemento]USUARIO[/elemento]",      $username,     $contenido_email );

					$contenido_email = str_replace("[elemento]CLAVE_USUARIO[/elemento]",$text,     	   $contenido_email );

					$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );
					$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );


					$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$username);

					$q_str = "INSERT INTO usuarios_seguimiento (usuario_seguimiento, username, observacion, fecha, tipo_seguimiento) VALUES ('$username', '".$_SESSION['usuarios']."', 'Se le reseteó la clave al usuario', '".date("Y-m-d H:i:s")."', '0')";
					// EJECUTAMOS LA CONSULTA
					$query = $con->Query($q_str); 


					$object->ResetPassword($np);

					include_once(VIEWS.DS.'login/sendPassword.php');				

					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						

					$path = ob_get_clean();	

					// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															

					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);

					$pagina = $this->replace_content('/\#ERRORMESSAGE\#/ms', $error  , $pagina);			

					// CARGAMOS LA PAGINA EN EL BROWSER	

					$this->view_page($pagina);

				}else{

					$this->RecuperarClave(NULL, $username, 1);

				}

			}	

		}

		function LoginAs($id){

			global $con;

			global $f;

			global $c;

			$st = $con->Query("select count(*) as t from arbol_super_admin where id_super_admin = '".$_SESSION['sadminidnum']."' and id_usuario = '".$id."'");

			$query = $con->FetchAssoc($st);

			$total = $query["t"];

			if($total == "0"){

				echo  "	<script>

							alert('Error! El usuario que esta intentando ingresar no se encuentra en su grupo de trabajo')

							window.location.href = '".HOMEDIR.DS."dashboard/'

						</script>";

				header('location:'.HOMEDIR.DS.'dashboard/');

			}else{

				if ($_SESSION[sadmin]==1) {

					$_SESSION['usuario'] = $id;

				}

				echo  "	<script>

							window.location.href = '".HOMEDIR.DS."dashboard/'

						</script>";

			}

		}

		/*FIN COMPONENTE LOGIN*/

		function ResetSesiones($id = ""){

			global $con;

			if($id == "1") {

				$con->Query("UPDATE logins set status = '0' where sID != '".$_SESSION['SID']."'");

				$con->Query("UPDATE logins set status = '1' where sID  = '".$_SESSION['SID']."'");

				$con->Query("UPDATE usuarios set ip = '".$_SERVER['REMOTE_ADDR']."', session_id = '".$_SESSION['SID']."' where user_id = '".$_SESSION['usuario']."'");

				echo "Las sesiones abiertas han sido cerradas";

			}else{

				$_SESSION['keep_alive_sesions'] = "1";

				echo "Se conservarán las sesiones abiertas";

			}

		}
		function ChangeEmpresaCambio($id){

			global $con;

			if ($id != "") {

				$_SESSION['71c029wus3yJWENACTUAL'] = $_SESSION['71c029wus3yJWEN'];
				$_SESSION['71c029wus3yJWEN'] = $id;

				echo "<script>document.location.href='/login/changeempresaverificador/0/';</script>";
			}

		}
		function ChangeEmpresaVerificador($id){

			global $con;

			if ($id != "") {

				/*$empresa_actual = $_SESSION['71c029wus3yJWEN'];
				$_SESSION['71c029wus3yJWEN'] = $id;*/

				$MUsuarios = new MUsuarios;
				$MUsuarios->CreateUsuarios('user_id',$_SESSION['usuario']);
				$mensaje = "";
				if($MUsuarios->GetId() > 0){
					$result = explode("@@",$MUsuarios->CheckSession($_SESSION['usuario'], $MUsuarios->GetPassword()));
					if($result[0] == "1"){
						$mensaje = "No se pudo realizar el cambio de empresa por que no perteneces a dicha empresa";
						$_SESSION['71c029wus3yJWEN'] = $_SESSION['71c029wus3yJWENACTUAL'];
						$con->Disconnect($con);
						$con->Connect($con);
					}elseif($result[0] == "2"){
						$_SESSION['71c029wus3yJWEN'] = $_SESSION['71c029wus3yJWENACTUAL'];
						$mensaje = "No se pudo realizar el cambio de empresa por que no perteneces a dicha empresa";

					}else{
						$mensaje = "Cambio de empresa realizado";
					}
				}else{
					$_SESSION['71c029wus3yJWEN'] = $_SESSION['71c029wus3yJWENACTUAL'];
					$mensaje = "No se pudo realizar el cambio de empresa por que no perteneces a dicha empresa";
				}
				if($mensaje != ''){
					echo "<script>alert('".$mensaje."');</script>";
				}
				echo "<script>document.location.href='/dashboard/';</script>";
			}

		}

	}

?>