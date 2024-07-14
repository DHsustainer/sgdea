<?

session_start();

#error_reporting(E_ALL);

#ini_set('display_errors', '1');





	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'Equipos_usuariosM.php');

	include_once(MODELS.DS.'zpagos/ClienteM.php');

	include_once(MODELS.DS.'Usuarios_librosM.php');	

	include_once(PLUGINS.DS.'messages2.php');	

	#include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	

	include_once(MODELS.DS.'zpagos/ClienteM.php');

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	



	$con = new ConexionBaseDatos;



	$con->Connect($con);



	

	$ob = new CRegistro;



	$c = new Consultas;



	$f = new Funciones;

	

	$m = new Messages;



	$action = $c->sql_quote($_REQUEST["action"]);



	



// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA

		if($c->sql_quote($_REQUEST['action']) == 'nuevo'){

			$ob->VistaInsertar();

		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	

		}elseif($c->sql_quote($_REQUEST['action']) == 'registrar'){

			// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		

			$text = $c->sql_quote($_REQUEST["password"]);

			

			$xname = explode("@", $c->sql_quote($_REQUEST["email"]));

			$nickname = $xname[0];



			$fecha = date("Y-m-d");

			$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.

			date_modify($fecha_c, "+3 day");//sumas los dias que te hacen falta.

			$f_caducidad = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.





			$ob->Insertar($c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["apellido"]), $c->sql_quote($_REQUEST["email"]), $c->sql_quote($_REQUEST["identificacion"]), $c->sql_quote($_REQUEST["telefono"]), $c->sql_quote($_REQUEST["ciudad"]), $text, $f_caducidad);



		}elseif($c->sql_quote($_REQUEST['action']) == 'checkemailexist'){

			$ob->CheckUserExist($c->sql_quote($_REQUEST['id']));

		}else{

			// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaInsertar();		

		}





	class CRegistro extends MainController{



		/*COMPONENTE REGISTRO*/

		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)

		function VistaInsertar(){

			//CARGA EL TEMPLATE

			$pagina = $this->load_templateRegister('Registro en linea de Usuarios');			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'usuarios/FormInsertUsuarios.php');				

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						

			$path = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER	

			$this->view_page($pagina);		

		}

		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS		

		function Insertar($nombre, $apellido, $email, $identificacion, $ciudad, $password, $f_caducidad){



			global $con;			

			#$np = hash ("sha256", $password);

			$np = md5($password);

			$pagina = $this->load_templateRegister('Registro Completado');			

			ob_start();

			// DEFINIENDO EL OBJETO			

			$object = new MUsuarios;

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			#			       InsertUsuario($user_id, $p_nombre, $p_apellido, $password, $telefono, $email, $ciudad, $estado, $cuenta, $f_registro,  $t_cuenta, $f_caducidad, $cedula, $procesos = "0", $anexos = "0", $correos = "0", $id_empresa = "0")			

			$create = $object->InsertUsuario($email,   $nombre,   $apellido,   $np,       "",        $email, $ciudad, "1", "1",         date("Y-m-d"),"1"      , $f_caducidad, $identificacion);

			#$create = 1;

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($create != '1'){

				echo '	<div style="margin:0 auto;"><div class="clear">&nbsp;</div><div>

      						<div class="titulo_box center" style="width:100%">Error de Registro</div>

							<table id="tabla_login" cellspacing="10" width="100%">

								<tr>

									<td align="center">

										<div class="message bold">Su registro no pudo ser completado porfavor intentelo nuevamente <a href="http://audiocodigosjuridicos.com/registro/">Aqui</a> </div>

									</td>

								</tr>

							</table>

							</div></div>	';

			}else{



				global $f;

				global $c;

				global $m;



				$MPlantillas_email = new MPlantillas_email;

				$MPlantillas_email->CreatePlantillas_email('id', '6');

				$contenido_email = $MPlantillas_email->GetContenido();

				$contenido_email = str_replace("[elemento]USUARIO[/elemento]",      $email,     $contenido_email );

				$contenido_email = str_replace("[elemento]CLAVE_USUARIO[/elemento]",$password,     	   $contenido_email );

				$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );

				$contenido_email = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $contenido_email );
				$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );


				$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$email);



				echo '	<div style="margin:0 auto;"><div class="clear">&nbsp;</div><div>

      						<div class="titulo_box center" style="width:100%">Registro Completo</div>

							<table id="tabla_login" cellspacing="10" width="100%">

								<tr>

									<td align="center">

										<div class="message bold">Su Registro ha sido completado para ingresar dirijase a <a href="'.HOMEDIR.'">Aqui</a> y haga clic en el boton Ingresar</div>

									</td>

								</tr>

							</table>

							</div></div>	';

			}

			$path = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER	

			$this->view_page($pagina);		

		}



		function CheckUserExist($email){

			global $con;



			$q_str = "select count(*) as t from usuarios where username = '".$email."'";

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str);



			$r = $con->Result($query, 0, "t");



			if($r >= "1"){

				echo "error";

			}else{

				echo "ok";

			}



		}





	

}