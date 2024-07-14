<?

// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'UsuariosE.php');
// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MUsuarios extends EUsuarios{

		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
			parent::SetId("");
			parent::SetUser_id("");
			parent::SetP_nombre("");
			parent::SetS_nombre("");
			parent::SetP_apellido("");
			parent::SetS_apellido("");
			parent::SetPassword("");
			parent::SetDireccion("");
			parent::SetTelefono("");
			parent::SetEmail("");
			parent::SetCiudad("");
			parent::SetF_nacimiento("");
			parent::SetEstado("");
			parent::SetSexo("");
			parent::SetCuenta("");
			parent::SetF_registro("");
			parent::SetT_profesional("");
			parent::SetT_cuenta("");
			parent::SetT_persona("");
			parent::SetUniversidad("");
			parent::SetF_caducidad("");
			parent::SetFoto_perfil("");
			parent::SetAuditoria("");
			parent::SetSeccional("");
			parent::SetValor_cuota("");
			parent::SetRegimen("");
			parent::SetCedula("");
			parent::SetCelular("");
			parent::SetDepartamento("");
			parent::SetA_i("");
			parent::SetExp_cedula("");
			parent::SetFirma("");
			parent::SetAlt_text("");
			parent::SetIsAdministrador("");
			parent::SetIsSuperAdministrador("");
			parent::SetId_empresa("");
			parent::SetNotif_usuario("");
			parent::SetNotif_admin("");
			parent::SetProcesos("");
			parent::SetAnexos("");
			parent::SetCorreos("");
			parent::SetId_carpeta_publica("");
			parent::Setbase_file("");
			parent::Setclave_firma("");
			parent::SetEstadochat("");
			parent::SetSeccional_siamm("");
			parent::Setfreemium("");
			parent::Setcupo("");
			parent::Setcupousuario("");
			parent::Setlogo_correos("");
			parent::Setfecha_capacitacion("");
			parent::Sethora_capacitacion("");

			parent::Setsmtp_host("");
			parent::Setsmtp_puerto("");
			parent::Setsmtp_user("");
			parent::Setsmtp_pww("");
			parent::Setsmtp_aut("");
			parent::Setsmtp_es("");
			parent::Setsmtp_helo("");
			parent::Setsmtp_tls("");
			parent::setupdatepassword("");
			parent::setsha2pww("");

		}

		

		// CREAMOS EL DESTRUCTOR DE LA CLASE

		function __destruct(){

		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 

		function CreateUsuarios($selector = 'id', $id)

		{

			global $con;

			

			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from usuarios where $selector = '".$id."'";

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str);

			//OBTENEMOS EL RESULTADO DE LA CONSULTA

			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO

				parent::SetId($row['id']);

				parent::SetUser_id($row['user_id']);

				parent::SetP_nombre($row['p_nombre']);

				parent::SetS_nombre($row['s_nombre']);

				parent::SetP_apellido($row['p_apellido']);

				parent::SetS_apellido($row['s_apellido']);

				parent::SetPassword($row['password']);

				parent::SetDireccion($row['direccion']);

				parent::SetTelefono($row['telefono']);

				parent::SetEmail($row['email']);

				parent::SetCiudad($row['ciudad']);

				parent::SetF_nacimiento($row['f_nacimiento']);

				parent::SetEstado($row['estado']);

				parent::SetSexo($row['sexo']);

				parent::SetCuenta($row['cuenta']);

				parent::SetF_registro($row['f_registro']);

				parent::SetT_profesional($row['t_profesional']);

				parent::SetT_cuenta($row['t_cuenta']);

				parent::SetT_persona($row['t_persona']);

				parent::SetUniversidad($row['universidad']);

				parent::SetF_caducidad($row['f_caducidad']);

				parent::SetFoto_perfil($row['foto_perfil']);

				parent::SetAuditoria($row['auditoria']);

				parent::SetSeccional($row['seccional']);

				parent::SetValor_cuota($row['valor_cuota']);

				parent::SetRegimen($row['regimen']);

				parent::SetCedula($row['cedula']);

				parent::SetCelular($row['celular']);

				parent::SetDepartamento($row['departamento']);

				parent::SetA_i($row['a_i']);

				parent::SetExp_cedula($row['exp_cedula']);

				parent::SetFirma($row['firma']);

				parent::SetAlt_text($row['alt_text']);

				parent::SetLogo($row['logo']);

				parent::SetIsAdministrador($row['IsAdministrador']);

				parent::SetIsSuperAdministrador($row['IsSuperAdministrador']);

				parent::SetId_empresa($row['id_empresa']);

				parent::SetNotif_usuario($row['notif_usuario']);

				parent::SetNotif_admin($row['notif_admin']);

				parent::SetProcesos($row['procesos']);

				parent::SetAnexos($row['anexos']);

				parent::SetCorreos($row['correos']);

				parent::Setbase_file($row['base_file']);

				parent::Setclave_firma($row['clave_firma']);
				
				parent::SetEstadochat($row['estadochat']);

				parent::SetSeccional_siamm($row['seccional_siamm']);
				
				parent::Setfreemium($row['freemium']);
				
				parent::Setcupo($row['cupo']);
				
				parent::Setcupousuario($row['cupo_usuario']);
				
				parent::Setlogo_correos($row['logo_correos']);
				
				parent::Setfecha_capacitacion($row['fecha_capacitacion']);
				
				parent::Sethora_capacitacion($row['hora_capacitacion']);


				parent::Setsmtp_host($row['smtp_host']);
				
				parent::Setsmtp_puerto($row['smtp_puerto']);
				
				parent::Setsmtp_user($row['smtp_user']);
				
				parent::Setsmtp_pww($row['smtp_pww']);
				
				parent::Setsmtp_aut($row['smtp_aut']);
				
				parent::Setsmtp_es($row['smtp_es']);
				
				parent::Setsmtp_helo($row['smtp_helo']);
				parent::Setsmtp_tls($row['smtp_tls']);

				parent::setupdatepassword($row['updatepassword']);
				parent::setsha2pww($row['sha2pww']);

				$cfolderp = "select id from folder_ciudadano where user_id = '".$row['user_id']."' and type = 'PU'";

				// EJECUTAMOS LA CONSULTA

				$queryfolderp = $con->Query($cfolderp);

				if($queryfolderp){

					//OBTENEMOS EL RESULTADO DE LA CONSULTA

					$rowfp = $con->FetchAssoc($queryfolderp);

				

					parent::SetId_carpeta_publica($rowfp['id']);

				}

		}

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateUsuarios($constrain, $fields, $updates, $output)
		{
			global $con;
			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE usuarios SET ";
			//HACEMOS UN FOR QUE RECORRA LOS VECTORES DE LOS CAMPOS Y LAS ACTUALIZACIONES PARA ARMAR LA CONSULTA CON CAMPOS FLEXIBLES
			for($i = 0; $i < count($fields); $i++){
				if($i+1 < count($fields)){
					$str .= $fields[$i]. " = '".$updates[$i]."', ";
				}else{
					$str .= $fields[$i]. " = '".$updates[$i]."' ";
				}
			}
			// INGRESAMOS LA CONDICION DE CONSTRAIN (CUIDADO CON ESTO YA QUE NO DEBE IR VACIO NUNCA)
			$str .= " $constrain"; 
			#echo $str;
			// EJECUTAMOS LA CONSULTA UNA VEZ ESTE CONSTRUIDA
			$query = $con->Query($str); 
			//VERIFICAMOS SI SE EJECUTO CORRECTAMENTE	
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $output[0];
			}
		}

		function InsertUsuario($user_id, $p_nombre, $p_apellido, $password, $telefono, $email, $ciudad, $estado, $cuenta, $f_registro, $t_cuenta, $f_caducidad, $cedula, $procesos = "0", $anexos = "0", $correos = "0", $id_empresa = "0")

		{

			global $con;

			$q_str = "INSERT INTO usuarios (id,         user_id,   p_nombre,     p_apellido, password,     email, ciudad,       estado,    cuenta,    f_registro, t_cuenta, f_caducidad, cedula, procesos, anexos, correos, id_empresa, isAdministrador, isSuperAdministrador) VALUES ('$cedula','$user_id', '$p_nombre', '$p_apellido','$password', '$email', '$ciudad', '$estado', '$cuenta', '$f_registro', '$t_cuenta', '$f_caducidad', '$cedula', '5', '0', '50', '$id_empresa', '1', '1')";

		

			$query = $con->Query($q_str); 

			$q_str = "INSERT INTO folder_ciudadano (user_id, titulo, fecha, type, estado, user_2) VALUES ('$user_id', 'Carpeta Publica', '".date('Y-m-d H:i:s')."', 'PU', '1', '')";

			$query = $con->Query($q_str); 

	

			if (!$query) {

				echo 'Invalid query: '.$con->Error();

			}else{

				return 1;

			}

		} 

		function CheckSession($username, $password, $dec)

		{

			global $con;	
			global $f;

			$npww = $f->EncriptarPassword($dec);

			$qcheck = $con->Query("select sha2pww  from usuarios  WHERE user_id='".$username."' ");
			$fieldc = $con->FetchAssoc($qcheck);

			if ($fieldc['sha2pww'] == "1") {

				$q_str = "SELECT count(*) as total,CONCAT(p_nombre,' ',p_apellido) as nombre, estado, IsAdministrador, IsSuperAdministrador, id_empresa, procesos, anexos, t_cuenta, correos, auditoria, seccional, regimen, cedula,user_id, a_i, valor_cuota, f_caducidad , t_persona, ver_ayudas, sha2pww 
							from usuarios 
								WHERE user_id='".$username."' 
										AND password= '".$npww."'";
			}else{
				$q_str = "SELECT count(*) as total,CONCAT(p_nombre,' ',p_apellido) as nombre, estado, IsAdministrador, IsSuperAdministrador, id_empresa, procesos, anexos, t_cuenta, correos, auditoria, seccional, regimen, cedula,user_id, a_i, valor_cuota, f_caducidad , t_persona, ver_ayudas, sha2pww 
							from usuarios 
								WHERE user_id='".$username."' 
										AND password= '".$password."'";
			}

			$query = $con->Query($q_str);

			$totalR = $con->Result($query, 0, "total");
			

			if($totalR < 1){

				return "1@@1";

			}else{

				$username = $con->Result($query, 0, "user_id");
				$user_ai = $con->Result($query, 0, "a_i");
				$nombre = $con->Result($query, 0, "nombre");
				$estado = $con->Result($query, 0, "estado");
				$cedula = $con->Result($query, 0, "cedula");
				$admin = $con->Result($query, 0, "IsAdministrador");
				$sadmin = $con->Result($query, 0, "IsSuperAdministrador");
				$id_empresa = $con->Result($query, 0, "id_empresa");
				$t_cuenta = $con->Result($query, 0, "t_cuenta");
				$c_procesos = $con->Result($query, 0, "procesos");
				$c_anexos = $con->Result($query, 0, "anexos");
				$c_correos = $con->Result($query, 0, "correos");
				$seccional = $con->Result($query, 0, "seccional");
				$area_principal = $con->Result($query, 0, "regimen");
				$ultima_alerta = $con->Result($query, 0, "valor_cuota");
				$t_persona = $con->Result($query, 0, "t_persona");
				$f_caducidad = $con->Result($query, 0, "f_caducidad");
				$shapww = $con->Result($query, 0, "sha2pww");
				$ayudas =  $con->Result($query, 0, "ver_ayudas");
				$q_strx = "SELECT ciudad from seccional WHERE id='".$seccional."'";
				$queryx = $con->Query($q_strx);
				$ciudad = $con->Result($queryx, 0, "ciudad");

				$q_strx = "SELECT id_version from super_admin WHERE id='".$id_empresa."'";
				$queryx = $con->Query($q_strx);
				$id_version = $con->Result($queryx, 0, "id_version");

				$f_caducidad = explode(" ", $f_caducidad);
				$f_caducidad = $f_caducidad[0];

				if ($t_persona == "SI") {
					if ($f_caducidad < date("Y-m-d")) {
						return "2@@".false;
					}
				}


				if ($shapww == "0") {
					$npww = $f->EncriptarPassword($dec);
					$con->Query("update usuarios set sha2pww = '1', password= '".$npww."' WHERE user_id ='".$username."' ");
				}
// 

				if ($estado == 1) {

					$con->Query("update logins set status = '2' WHERE username ='".$username."' and status = '1'");

					

					$sid = md5($username.date('Y-m-d H:i:s').$_SERVER['REMOTE_ADDR']);

					$sid = hash ("sha256", $sid);

					$q_stre = "insert into logins (username, fecha, ip, sID, status) value('".$username."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."','".$sid."','1')";

					$querye = $con->Query($q_stre);				

					session_start();

						$_SESSION['id_trd_empresa'] 		= $id_version;

						$_SESSION['id_trd'] 		= $id_version;

						$_SESSION['active_vista'] 		= $id_version;

						# VARIABLE PRINCIPAL DE SESION

						$_SESSION['usuario'] 		= $username;	

						$_SESSION['user_ai'] 		= $user_ai;	

						# NOMBRE DE USUARIO

						$_SESSION['nombre'] 		= $nombre;

						# CODIGO DE LA SESION

						$_SESSION['SID'] 			= $sid;

						#CODIGO DE MANUAL (DEPRECATED VARIABLE)

						$_SESSION['helper'] 		= "inicio";

						$_SESSION['showhelps'] = $ayudas;

						#SESION DE CARPETA (ARCHIVO) SE INICIA GESTION

						$_SESSION['typefolder'] 	= '1';

						#VARIABLE QUE DEFINE SI EL USUARIO ES JEFE DE AREA

						$_SESSION['t_cuenta'] 		= $admin;	

						#CANTIDAD DE PROCESOS POSIBLES (DEPRECATED VARIABLE)

						$_SESSION['c_procesos'] 	= $c_procesos;

						#CANTIDAD DE ANEXOS QUE PUEDE CARGAR (DEPRECATED VARIABLE)

						$_SESSION['c_anexos'] 		= $c_anexos;

						#CANTIDAD DE CORREOS QUE PUEDE ENVIAR (DEPRECATED VARIABLE)

						$_SESSION['c_correos'] 		= $c_correos;

						#ES SUPER ADMINISTRADOR

						$_SESSION['sadmin'] 		= $sadmin;

						#ID DEL SUPER ADMINISTRADOR

						$_SESSION['sadminid'] 		= $sadmin;

						#ID DE LA EMPRESA

						$_SESSION['id_empresa'] 	= $id_empresa;				

						#SECCIONAL EN LA QUE TRABAJA (OFICINA)

						$_SESSION['seccional'] 		= $seccional;

						#AREA DE TRABAJO

						$_SESSION['area_principal'] = $area_principal;

						#CIUDAD A LA QUE PERTENECE

						$_SESSION['ciudad'] 		= $ciudad;

						#NUMERO DE CEDULA

						$_SESSION['cedula'] 		= $cedula;

						#CARPETA ACTUAL 

						$_SESSION["folder_exp"] 	= "0";

						#KEY DEL DOMINIO

						$_SESSION["user_key"] 		= $_SESSION["user_key"];

						#VARIABLE DEL USUARIO REAL CUANDO ESTE CAMBIA DE USUARIO

						$_SESSION["usuario_real_cambio"] 		 = "";

						$_SESSION["seccional_real_cambio"] 		 = "";

						$_SESSION["area_principal_real_cambio"] = "";

						$_SESSION['filtro_fi'] = "2016-01-01";
						$_SESSION['filtro_ff'] = date("Y-m-d");
						$_SESSION['filtro_estado'] = "Todos";
						$_SESSION['filtro_prioridad'] = "Todos";

						$_SESSION["alerta_activa"] = $ultima_alerta;

						$sql = "SELECT nombre_campo, valor FROM funcionalidades f inner join usuarios_funcionalidades uf on f.id = uf.id_funcionalidad where uf.user_id = '".$username."' ";

						$qe = $con->Query($sql);

						while($row = $con->FetchAssoc($qe)){

							$_SESSION[$row['nombre_campo']] 		= $row['valor'];

						}

						$con->Query("update usuarios set estadochat = 1, session_id = '".$_SESSION['SID']."', ip = '".$_SERVER['REMOTE_ADDR']."', lastlogin = '".date("Y-m-d H:i:s")."'  WHERE user_id ='".$username."'");

				}else{

					return "2@@".false;

				}

			}

						

		}

		function CheckSessionAdmin($username, $password)

		{

			global $con;	

			

			$q_str = "SELECT count(*) as total,p_nombre as nombre,id,user_id from super_admin WHERE user_id='".$username."' AND password= '".$password."'";

			$query = $con->Query($q_str);

			$username = $con->Result($query, 0, "user_id");

			$totalR = $con->Result($query, 0, "total");

			$nombre = $con->Result($query, 0, "nombre");

			$id = $con->Result($query, 0, "id");

			if($totalR < 1){

				return "1@@1";

			}else{

				

				$sid = md5($username.date('Y-m-d H:i:s').$_SERVER['REMOTE_ADDR']);

				$sid = hash ("sha256", $sid);

				$q_stre = "insert into logins (username, fecha, ip, sID) value('".$username."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."','".$sid."')";

				$querye = $con->Query($q_stre);				

				

				if(!isset($_SESSION['usuario'])){

					session_start();

					$_SESSION['usuario'] = $username;	

					$_SESSION['nombre'] = $nombre;

					$_SESSION['sadmin'] = 1;

					$_SESSION['sadminid'] = $username;

					$_SESSION['sadminidnum'] = $id;

					$_SESSION['SID'] = $sid;

					$_SESSION['helper'] = "inicio";

					$_SESSION['typefolder'] = 'ACTIVO';

				}else{

					$_SESSION['usuario'] = $username;

					$_SESSION['nombre'] = $nombre;

					$_SESSION['sadmin'] = 1;

					$_SESSION['sadminid'] = $username;

					$_SESSION['sadminidnum'] = $id;

					$_SESSION['SID'] = $sid;

					$_SESSION['helper'] = "inicio";

					$_SESSION['typefolder'] = 'ACTIVO';

				}

				return "0@@".true;

			}

						

		}

		function CheckSessionCliente($username, $password)

		{

			global $con;	

			

			$q_str = "SELECT count(*) as total, nombre, id, user_id from suscriptores_contactos WHERE cod_ingreso='".$username."' AND password= '".$password."'";

			#echo $q_str;

			$query = $con->Query($q_str);

			$totalR = $con->Result($query, 0, "total");

			$nombre = $con->Result($query, 0, "nombre");

			$id = $con->Result($query, 0, "id");

			if($totalR < 1){

				return "1@@1";

			}else{

				

				$sid = md5($username.date('Y-m-d H:i:s').$_SERVER['REMOTE_ADDR']);

				$sid = hash ("sha256", $sid);

				$q_stre = "insert into logins (username, fecha, ip, sID) value('".$id."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."','".$sid."')";

				$querye = $con->Query($q_stre);				

				

				$username = $con->Result($query, 0, "user_id");

				$q_str_main = "SELECT seccional from usuarios WHERE user_id='".$username."'";

				$queryuser_main = $con->Query($q_str_main);

				$seccional = $con->Result($queryuser_main, 0, "seccional");

				$q_strx = "SELECT ciudad from seccional WHERE id='".$seccional."'";

				$queryx = $con->Query($q_strx);

				$ciudad = $con->Result($queryx, 0, "ciudad");

				session_start();

				

				$_SESSION['suscriptor_id'] = $id;

				# VARIABLE PRINCIPAL DE SESION

				$_SESSION['usuario'] 	= $username;	

				# NOMBRE DE USUARIO

				$_SESSION['nombre'] 	= $nombre;

				# CODIGO DE LA SESION

				$_SESSION['SID'] 		= $sid;

				#CODIGO DE MANUAL (DEPRECATED VARIABLE)

				$_SESSION['helper'] 	= "inicio";

				#SESION DE CARPETA SE INICIA ACTIV

				$_SESSION['typefolder'] = '1';

				#VARIABLE QUE DEFINE SI EL USUARIO ES JEFE DE AREA

				$_SESSION['t_cuenta'] 	= 0;	

				#CANTIDAD DE PROCESOS POSIBLES (DEPRECATED VARIABLE)

				$_SESSION['c_procesos'] = 0;

				#CANTIDAD DE ANEXOS QUE PUEDE CARGAR (DEPRECATED VARIABLE)

				$_SESSION['c_anexos'] 	= 0;

				#CANTIDAD DE CORREOS QUE PUEDE ENVIAR (DEPRECATED VARIABLE)

				$_SESSION['c_correos'] 	= 0;

				#ES SUPER ADMINISTRADOR

				$_SESSION['sadmin'] = 0;

				#ID DEL SUPER ADMINISTRADOR

				$_SESSION['sadminid'] = 0;

				#ID DE LA EMPRESA

				$_SESSION['id_empresa'] = 6;

				#SECCIONAL EN LA QUE TRABAJA (OFICINA)

				$_SESSION['seccional'] = ""; #DEFINIDA OK!

				#AREA DE TRABAJO

				$_SESSION['area_principal'] = "";

				#CIUDAD A LA QUE PERTENECE

				$_SESSION['ciudad'] = $ciudad; #DEFINIDA OK!

				#NUMERO DE CEDULA

				$_SESSION['cedula'] = $cedula;

				#CARPETA ACTUAL 

				$_SESSION["folder_exp"] = "0";

			

				return "0@@".true;

			}

		}

		function KillSession()

		{

			global $con;

			

			if ($_SESSION['suscriptor_id'] == "") {
				# code...
				$q_strx = "update usuarios set estadochat = 0 WHERE user_id='".$_SESSION["usuario"]."'";

				$con->Query($q_strx);

				$q_strx = "update logins set status = 0 WHERE username ='".$_SESSION["usuario"]."'";

				$con->Query($q_strx);
			
			}

			$_SESSION['usuario'] 	= 	"";

			$_SESSION['nombre'] 	= 	"";

			$_SESSION['SID'] 		= 	"";

			$_SESSION['sadmin'] 	= 	"";

			$_SESSION['sadminid'] 	= 	"";

			$_SESSION['sadminidnum']= 	"";

			$_SESSION['helper'] 	= 	"";

			$_SESSION['typefolder'] = 	"";

			$_SESSION['id_empresa'] = 	"";

			$_SESSION['folder'] 	= 	"";

			$_SESSION['master'] 	= 	"";

			$_SESSION['t_cuenta'] 	= 	"";	

			$_SESSION['c_procesos'] = 	"";

			$_SESSION['c_anexos'] 	= 	"";

			$_SESSION['c_correos'] 	= 	"";

			$_SESSION['suscriptor_id'] 	= 	"";

			$_SESSION["VAR_SESSIONES"] = "";

			$_SESSION["intentos"] = "";

			$_SESSION["ACTIVEKEY"] = "";

			$_SESSION["LAST_ACTIVITY"] = "";

			$_SESSION["alerta_activa"] = "";

			

			unset($_SESSION["usuario"]);

			unset($_SESSION["nombre"]);

			unset($_SESSION["SID"]);

			unset($_SESSION["sadmin"]);

			unset($_SESSION["sadminid"]);

			unset($_SESSION["sadminidnum"]);

			unset($_SESSION["helper"]);

			unset($_SESSION["typefolder"]);

			unset($_SESSION["id_empresa"]);

			unset($_SESSION["folder"]);

			unset($_SESSION["master"]);

			

			unset($_SESSION["t_cuenta"]);

			unset($_SESSION["c_procesos"]);

			unset($_SESSION["c_anexos"]);

			unset($_SESSION["c_correos"]);

			unset($_SESSION["suscriptor_id"]);

			unset($_SESSION["VAR_SESSIONES"]);

			unset($_SESSION["intentos"]);

			unset($_SESSION["ACTIVEKEY"]);

			unset($_SESSION["LAST_ACTIVITY"]);

			unset($_SESSION["alerta_activa"]);	

			

		}

		function ResetPassword($np)

		{

			$fields = array("password");

			$updates = array($np);

			$otput = array("", "");

			$this->UpdateUsuarios(" WHERE user_id='".$this->GetUser_id()."' ", $fields, $updates, $otput);

		}	

		function GetCountNotifications(){

	
			global $con;
			global $c;
			global $f;
/*
		    $usua = new MUsuarios;
		    $usua->CreateUsuarios("user_id", $_SESSION['usuario']);

		    $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0' and a.user_id = '".$_SESSION['usuario']."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra not in('trexp', 'texp', 'doc', 'an', 'rad', 'comp') group by eg.id";

		    #echo $sql;
		    $qwa = $con->Query($sql);
		    $contact    = $con->NumRows($qwa);


		    $sql = "SELECT * from events_gestion eg  inner join gestion gx on gx.id = eg.gestion_id  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and eg.status = '1' and eg.grupo = '".$_SESSION['user_ai']."'";

		    $qwa = $con->Query($sql);
		    $contacttareas = $con->NumRows($qwa);

		    $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and  a.type = '1' and a.status = '0'  and a.user_id = '".$_SESSION['usuario']."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('rad') group by eg.id";

		    #echo $sql;
		    $qwa = $con->Query($sql);
		    $contacte    = $con->NumRows($qwa);

		    $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0'  and a.user_id = '".$_SESSION['usuario']."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('doc', 'an') group by eg.id";

		    #echo $sql;
		    $qwa = $con->Query($sql);

		    if(M_ALERTA_NEWDOCS != "dn"){
		        $contactd    = $con->NumRows($qwa);    
		    }else{
		        $contactd = 0;
		    }
		    

		    $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra inner join gestion gx on gx.id = a.id_gestion where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0'  and a.user_id = '".$_SESSION['usuario']."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('comp') group by eg.id";

		    #echo $sql;
		    $qwa = $con->Query($sql);
		    $contactc    = $con->NumRows($qwa);
		    
		    if(M_ALERTA_COMPARTIDOS != "dn"){
		        $contactc    = $con->NumRows($qwa);    
		    }else{
		        $contactc = 0;
		    }

		    $qwa = $con->Query("select * from solicitudes_documentos WHERE usuario_destino ='".$_SESSION['usuario']."' and estado = '0'");
		    $contvenc = $con->NumRows($qwa);

		    $sql = "SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and $comparacion e.dias > 0 group by g.id";
		    $qwa = $con->Query($sql);
		    
		    
		    if(M_ALERTA_INACTIVOS != "dn"){
		        $continact  =  $con->NumRows($qwa);
		    }else{
		        $continact  =  0;
		    }
		    

		    $qwa = $con->Query("select * from gestion_anexos_firmas where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '0'");
		    $contfirmas   =  $con->NumRows($qwa);

		    $qwa = $con->Query("Select * from solicitudes_documentos WHERE usuario_destino ='".$_SESSION['usuario']."' and estado = '0'");
		    $contsol    = $con->NumRows($qwa);

		    $newemails = $c->GetNewMailsNumber();

		    $qws =   $con->Query("Select * from solicitudes_documentos WHERE usuario_destino ='".$_SESSION['usuario']."' and estado = '0'" ,"order by fecha_solicitud","");
		    $consolicitudes = $con->NumRows($qws);


		    $nsp = $con->Query("select count(*) as t from gestion_transferencias  inner join gestion on gestion.id = gestion_transferencias.gestion_id where user_transfiere = '".$_SESSION['usuario']."' and (gestion_transferencias.estado = '0' or gestion_transferencias.estado = '2')");
		    $nspr = $con->FetchAssoc($nsp); 

		    $nsr = $con->Query("select count(*) as t from gestion_transferencias  inner join gestion on gestion.id = gestion_transferencias.gestion_id where user_recibe = '".$_SESSION['user_ai']."' and gestion_transferencias.estado = '0'");
		    $nsrr = $con->FetchAssoc($nsr);

		    $cantidadPendientes = "<span title='Solicitudes de Transferencias: Recibidas - Enviadas'>".$nsrr['t']." - ".$nspr['t']."</span>";


		    $total_exp = 0;
		    $sql = "SELECT count(*) as t FROM gestion g inner join gestion_cambio_ubicacion_archivo gcua on g.id = gcua.id_gestion WHERE gcua.estado_archivo_origen = '1' and gcua.estado = '0' UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) AND nombre_destino = '".$usua->GetA_i()."' and estado_archivo = '1' and DATE_ADD(f_recibido, INTERVAL (SELECT t_g FROM dependencias where id = tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) and gestion.dependencia_destino = '".$usua->GetRegimen()."' and  nombre_destino <> '".$usua->GetA_i()."' and estado_archivo = '1' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_g FROM dependencias where id = gestion.tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion g inner join gestion_cambio_ubicacion_archivo gcua on g.id = gcua.id_gestion WHERE gcua.estado_archivo_origen = '2' and gcua.estado = '0' UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) AND nombre_destino = '".$usua->GetA_i()."' and estado_archivo = '2' and DATE_ADD(f_recibido, INTERVAL (SELECT t_c FROM dependencias where id = tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) and gestion.dependencia_destino = '".$usua->GetRegimen()."' and  nombre_destino <> '".$usua->GetA_i()."' and estado_archivo = '2' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_c FROM dependencias where id = gestion.tipo_documento) DAY) <= DATE(NOW())";

		    #echo $sql;

		    $chck = $con->Query($sql);
		    while($row = $con->FetchAssoc($chck)){
		        $total_exp += $row['t'];
		    }

		    $cantidad = $f->Zerofill($total_exp,3);


		    $cantidadvalidar = 0;
		    $myid = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "a_i", $separador = " ");

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
		    $queryxr = $con->Query("select * from gestion WHERE estado_archivo = '1' and estado_respuesta = 'Pendiente'");   
		    $cantidadvalidar = $con->NumRows($queryxr);



			$retorno = $contact+ $contacttareas+ $contacte+ $contactd+ $contactc+ $contvenc+ $continact+ $contfirmas+ $contsol+ $newemails+ $consolicitudes;
			return $retorno;
*/
			return "1";

		}

		function GetNotifications($day){

			global $con;

			$q_str = "SELECT * FROM alertas WHERE user_id = '".$_SESSION["usuario"]."' and log = '".$day."' order by log desc";

			$query = $con->Query($q_str);

			

			return $query;

		}		

		function GetTotalProcesos(){

			global $con;

			$q_str = "SELECT COUNT(*) AS t FROM caratula WHERE user_id = '".$_SESSION["usuario"]."'";

			$query = $con->Query($q_str);

			

			return $con->Result($query, 0, "t");

		}

		function GetTotalAnexos(){

			global $con;

			$q_str = "SELECT COUNT(*) AS t FROM anexos WHERE user_id = '".$_SESSION["usuario"]."'";

			$query = $con->Query($q_str);

			

			return $con->Result($query, 0, "t");

		}

		function GetTotalCorreos(){

			global $con;

			$q_str = "SELECT COUNT(*) AS t FROM mailer_message WHERE user_ID = '".$_SESSION["usuario"]."'";

			$query = $con->Query($q_str);

			

			return $con->Result($query, 0, "t");

		}		

		function GetDocumentosPublicos(){

			global $con;

			$q_str = "SELECT * FROM anexos_carpeta WHERE user_id = '".parent::GetUser_id()."' and folder_id = '".parent::GetId_carpeta_publica()."'";

				

			$query = $con->Query($q_str);

			

			return $query;

		}

		function GetCarpetaCompartida($user){

			global $con;

			$q_str = "SELECT * FROM folder_ciudadano WHERE 

													(user_id = '".parent::GetUser_id()."' and user_2 ='".$user."') 

												or  (user_id = '".$user."' and user_2 ='".parent::GetUser_id()."')";

				

			$query = $con->Query($q_str);

			return $query;

		}

		function GetDocumentosCarpeta($id){

			global $con;

			$q_str = "SELECT * FROM anexos_carpeta WHERE folder_id = '".$id."'";

				

			$query = $con->Query($q_str);

			

			return $query;

		}

				// FUNCION PARA LISTAR REGISTROS 

		function ListarUsuarios($constrain = '', $order = 'order by id',   $limit = 'limit 1000')

		{

			global $con;

			// DEFINIMOS LA CONSULTA

			$q_str = "SELECT * FROM usuarios $path $constrain $order $limit"; 

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str); 

			

			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE

				if (!$query) {

				return 'Invalid query: '.$con->Error($query);

			}else{

				return $query;

			}

		}

		function ListarUsuariosSuscriptores($constrain = '', $order = 'order by sc.id',   $limit = 'limit 1000')

		{

			global $con;

			// DEFINIMOS LA CONSULTA

			$q_str = "SELECT sc.nombre as nombre, sc.user_id as user_id, sc.id as a_i, sc.type as type FROM suscriptores_contactos sc left join usuarios u on sc.identificacion = u.id where u.id is null $path $constrain $order $limit"; 

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str); 

			

			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE

				if (!$query) {

				return 'Invalid query: '.$con->Error($query);

			}else{

				return $query;

			}

		}

		function CheckSessionCambioUsuario($username)

		{

			global $con;	

			

			$q_str = "SELECT count(*) as total,CONCAT(p_nombre,' ',p_apellido) as nombre, estado, IsAdministrador, IsSuperAdministrador, id_empresa, procesos, anexos, t_cuenta, correos, auditoria, seccional, regimen, cedula from usuarios WHERE user_id='".$username."'";

			$query = $con->Query($q_str);

			$totalR = $con->Result($query, 0, "total");

			$nombre = $con->Result($query, 0, "nombre");

			$estado = $con->Result($query, 0, "estado");

			$cedula = $con->Result($query, 0, "cedula");

			$admin = $con->Result($query, 0, "IsAdministrador");

			$sadmin = $con->Result($query, 0, "IsSuperAdministrador");

			$id_empresa = $con->Result($query, 0, "id_empresa");

			$t_cuenta = $con->Result($query, 0, "t_cuenta");

			$c_procesos = $con->Result($query, 0, "procesos");

			$c_anexos = $con->Result($query, 0, "anexos");

			$c_correos = $con->Result($query, 0, "correos");

			$seccional = $con->Result($query, 0, "seccional");

			$area_principal = $con->Result($query, 0, "regimen");

			$q_strx = "SELECT ciudad from seccional WHERE id='".$seccional."'";

			$queryx = $con->Query($q_strx);

			$ciudad = $con->Result($queryx, 0, "ciudad");

			if($totalR < 1){

				return "1";

			}else{

				

				if ($estado == 1) {

					$con->Query("update logins set status = '2' WHERE username ='".$username."' and status = '1'");

					

					$sid = md5($username.date('Y-m-d H:i:s').$_SERVER['REMOTE_ADDR']);

					$sid = hash ("sha256", $sid);

					$q_stre = "insert into logins (username, fecha, ip, sID, status) value('".$username."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."','".$sid."','1')";

					$querye = $con->Query($q_stre);				

						# VARIABLE PRINCIPAL DE SESION

						$_SESSION['usuario'] 		= $username;	

						# NOMBRE DE USUARIO

						$_SESSION['nombre'] 		= $nombre;

						# CODIGO DE LA SESION

						$_SESSION['SID'] 			= $sid;

						#CODIGO DE MANUAL (DEPRECATED VARIABLE)

						$_SESSION['helper'] 		= "inicio";

						#SESION DE CARPETA (ARCHIVO) SE INICIA GESTION

						$_SESSION['typefolder'] 	= '1';

						#VARIABLE QUE DEFINE SI EL USUARIO ES JEFE DE AREA

						$_SESSION['t_cuenta'] 		= $admin;	

						#CANTIDAD DE PROCESOS POSIBLES (DEPRECATED VARIABLE)

						$_SESSION['c_procesos'] 	= $c_procesos;

						#CANTIDAD DE ANEXOS QUE PUEDE CARGAR (DEPRECATED VARIABLE)

						$_SESSION['c_anexos'] 		= $c_anexos;

						#CANTIDAD DE CORREOS QUE PUEDE ENVIAR (DEPRECATED VARIABLE)

						$_SESSION['c_correos'] 		= $c_correos;

						#ES SUPER ADMINISTRADOR

						$_SESSION['sadmin'] 		= $sadmin;

						#ID DEL SUPER ADMINISTRADOR

						$_SESSION['sadminid'] 		= $sadmin;

						#ID DE LA EMPRESA

						$_SESSION['id_empresa'] 	= $id_empresa;				

						#SECCIONAL EN LA QUE TRABAJA (OFICINA)

						$_SESSION['seccional'] 		= $seccional;

						#AREA DE TRABAJO

						$_SESSION['area_principal'] = $area_principal;

						#CIUDAD A LA QUE PERTENECE

						$_SESSION['ciudad'] 		= $ciudad;

						#NUMERO DE CEDULA

						$_SESSION['cedula'] 		= $cedula;

						#CARPETA ACTUAL 

						$_SESSION["folder_exp"] 	= "0";

						#KEY DEL DOMINIO

						$_SESSION["user_key"] 		= $_SESSION["user_key"];						

						$sql = "SELECT nombre_campo, valor FROM funcionalidades f inner join usuarios_funcionalidades uf on f.id = uf.id_funcionalidad where uf.user_id = '".$_SESSION["usuario_real_cambio"]."' ";

						$qe = $con->Query($sql);

						while($row = $con->FetchAssoc($qe)){

							$_SESSION[$row['nombre_campo']] 		= $row['valor'];

						}

						$con->Query("update usuarios set estadochat = 1, session_id = '".$_SESSION['SID']."', ip = '".$_SERVER['REMOTE_ADDR']."', lastlogin = '".date("Y-m-d H:i:s")."'  WHERE user_id ='".$username."'");

						return true;

				}else{

					return false;

				}

			}

						

		}

	}	

?>