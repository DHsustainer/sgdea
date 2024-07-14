<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	date_default_timezone_set("America/Bogota");

	//Invocando archivos que seran usados en nuestro controlador generico	

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'Super_adminM.php');

	include_once(MODELS.DS.'AreasM.php');

	include_once(MODELS.DS.'Super_adminM.php');

	include_once(MODELS.DS.'CityM.php');

	include_once(MODELS.DS.'SeccionalM.php');

	include_once(MODELS.DS.'Firmas_usuariosM.php');

	include_once(MODELS.DS.'FuentesM.php');

	include_once(MODELS.DS.'Preguntas_usuariosM.php');

	include_once(MODELS.DS.'Preguntas_secretasM.php');

	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');

	include_once(MODELS.DS.'Suscriptores_contactosM.php');

	include_once(PLUGINS.DS.'messages.php');

	#include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	

	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	// Llamando al objeto a controlar		

	$ob = new CUsuarios;

	$c = new Consultas;

	$f = new Funciones;

	$m = new Messages;

		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL

		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos

		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA

		if($c->sql_quote($_REQUEST['action']) == 'listar'){

			$ob->VistaListar('');	

		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	

		}elseif($c->sql_quote($_REQUEST['action']) == 'editar'){

			$ob->VistaEditar($_SESSION["usuario"]);	

		}

		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS

		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar'){

			// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

			$ar2 = array('password', 'nombre_completo', 'identificacion', 'email', 'direccion', 'telefono', 'ciudad','universidad', 'usuarioscol');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			if($c->sql_quote($_REQUEST['checkpassword']) == ""){

				$password = $c->sql_quote($_REQUEST['password']);

			}else{

				$password = hash ("sha256", $c->sql_quote($_REQUEST['checkpassword']));

			}

			$ar1 = array($password, $c->sql_quote($_REQUEST['nombre_completo']), $c->sql_quote($_REQUEST['identificacion']), $c->sql_quote($_REQUEST['email']), $c->sql_quote($_REQUEST['direccion']), $c->sql_quote($_REQUEST['telefono']), $c->sql_quote($_REQUEST['ciudad']), $c->sql_quote($_REQUEST['universidad']), $c->sql_quote($_REQUEST['usuarioscol']));	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE username = "'.$_SESSION['usuario'].'"';			

			$ob->Editar($constrain, $ar2, $ar1, $output);

		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			

		}elseif($c->sql_quote($_REQUEST['action']) == "cambiarAvatar"){

			// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

			$ar2 = array('foto_perfil');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			$ar1 = array($c->sql_quote($_REQUEST['img']));	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE username = "'.$_SESSION['usuario'].'"';			

			$ob->Editar($constrain, $ar2, $ar1, $output);			

		}elseif($c->sql_quote($_REQUEST['action']) == 'actdeact') {

			$ob->ActDeact($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'actdeactadmin') {

			$ob->ActDeactAdmin($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'actdeactmailadmin') {

			$ob->ActDeactMailAdmin($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'actdeactsadmin') {

			$ob->ActDeactSadmin($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'listadoareasoficina') {

			$ob->ListadoAreasOficina($c->sql_quote($_REQUEST['id']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'ListadoAreasOficinaNew') {

			$ob->ListadoAreasOficinaNew($c->sql_quote($_REQUEST['id']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'ListadoAreasOficinaNew') {

			$ob->ListadoUsuariosAreasOficina($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'abrirusuarios') {

			$ob->abrirusuarios($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'listadousuariosareasoficina2') {

			$ob->ListadoUsuariosAreasOficina2($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'listadousuariosareasoficina3') {

			$ob->ListadoUsuariosAreasOficina3($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'ListadoUsuariosAreasOficina3New') {

			$ob->ListadoUsuariosAreasOficina3New($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'ListadoUsuariosTodos') {

			$ob->ListadoUsuariosTodos($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'ListadoUsuariosTodos2') {

			$ob->ListadoUsuariosTodos2($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));


		}elseif($c->sql_quote($_REQUEST['action']) == 'actualizarcita'){

			$ob->ActualizarCita();

		}elseif($c->sql_quote($_REQUEST['action']) == 'buscar'){

			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
		}elseif($c->sql_quote($_REQUEST['action']) == 'disabled'){
			$con->Query("update usuarios set procesos = '1' where user_id = '".$_SESSION['usuario']."'");
		}elseif($c->sql_quote($_REQUEST['action']) == 'importar_firma'){

			if($c->sql_quote($_REQUEST['clave_firma']) == ""){

				echo "error";

				exit;

			}else{

				$uploads_dir = 'files/';

				$tmp_name = $_FILES["userfile"]["tmp_name"];

				$name = $_FILES["userfile"]["name"];

				$newname = $f->GenerarNuevoId($name);

				$destino =  ROOT."/archivos_uploads/".$newname;

				if (copy($_FILES['userfile']['tmp_name'],$destino)) {

					$dato = file_get_contents($destino);

					$ar2 = array('base_file','clave_firma');

					$ar1 = array($dato,$c->sql_quote($_REQUEST['clave_firma']));	

					$output = array('registro actualizado', 'no se pudo actualizar'); 

					$constrain = 'WHERE user_id = "'.$_SESSION['usuario'].'"';

					$editar = $ob->Editar($constrain, $ar2, $ar1, $output);

				}	

			}	

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

		}elseif($c->sql_quote($_REQUEST['action']) == 'uploadfirma'){

				$tamano = $_FILES["archivo"]['size'];

				$tipo = $_FILES["archivo"]['type'];

				$archivo = $_FILES["archivo"]['name'];

				$prefijo = "f".md5($_SESSION['usuario'].date("Y-m-d H:i:s"));

				$extension = end(explode(".", $archivo));

				$name = $prefijo.'.'.$extension;

				$destino =  ROOT."/plugins/thumbnails/".$name;

				echo $destino;

				if($archivo == ""){

					$status = "No hay archivos que cargar <a href='inicial.php'>Intentarlo nuevamente</a>";

				}

				if (copy($_FILES['archivo']['tmp_name'],$destino)) {

					  $status = "Archivo subido: <b>".$archivo."</b><br><a href='inicial.php'>Regresar</a>";

				} else {

					$status = "Error al subir el archivo <a href='inicial.php'>Intentarlo nuevamente</a>";

				}

					$ar2 = array('firma');

					// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

					$ar1 = array($name);	

					// DEFINIMOS LOS ESTADOS DE SALIDA

					$output = array('registro actualizado', 'no se pudo actualizar'); 

					// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

					$constrain = 'WHERE user_id = "'.$_SESSION['usuario'].'"';

					$ob->Editar($constrain, $ar2, $ar1, $output);

				echo "	<script>

							window.location.href = '".HOMEDIR."/dashboard/profile/';

						</script>";

		}elseif($c->sql_quote($_REQUEST['action']) == 'upload'){

			$l = new MFuentes;

			$l->Createfuentes('id', $c->sql_quote($_REQUEST['id']));

			$name = time()."-ZQT.jpg";

			$img_name = ROOT."/plugins/thumbnails/signature_user.jpg";

			$img_namep = ROOT."/plugins/thumbnails/signature_user.png";

			$new_name = ROOT."/plugins/thumbnails/".$name; 

			$string = ucwords($c->sql_quote($_REQUEST['cn'])); 

			$xpl = explode(".", strtolower($img_name));

			$whitelist = array("jpg","jpeg","bmp","gif","png");

			if(in_array(end($xpl), $whitelist)){

				$texto = $string;

				$src = imagecreatefrompng($img_namep); 

				$negro = imagecolorallocate($src, 0, 0, 0);

				$fuente = ROOT.DS."views/assets/fonts/".$l->GetUrl();

				imagettftext($src, 17, 0, 0, 19, $negro, $fuente, $texto);

				$dest = imagecreatefromjpeg($img_name); 

				// Añadir el texto

				imagecopy($dest, $src, 0, 0, 0, 0, imagesx($src), imagesY($src)); 

				imagejpeg($dest,$new_name,100);

			}

			$ar2 = array('firma');

			// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

			$ar1 = array($name);	

			// DEFINIMOS LOS ESTADOS DE SALIDA

			$output = array('registro actualizado', 'no se pudo actualizar'); 

			// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

			$constrain = 'WHERE user_id = "'.$_SESSION['usuario'].'"';

			$editar = $ob->Editar($constrain, $ar2, $ar1, $output);

			if ($_REQUEST['id'] == "2") {

				echo "	<script>

							window.location.href = '".HOMEDIR."/dashboard/profile/';

						</script>";

			}else{

				echo $editar;

			}

		}elseif($c->sql_quote($_REQUEST['action']) == 'changedisplay'){

				$tamano = $_FILES["archivo"]['size'];

				$tipo = $_FILES["archivo"]['type'];

				$archivo = $_FILES["archivo"]['name'];

				$prefijo = "f".md5($_SESSION['usuario'].date("Y-m-d H:i:s"));

				$extension = end(explode(".", $archivo));

				$name = $prefijo.'.'.$extension;

				$destino =  ROOT."/plugins/thumbnails/".$name;

				echo $destino;

				if($archivo == ""){

					$status = "No hay archivos que cargar <a href='inicial.php'>Intentarlo nuevamente</a>";

				}

				if (copy($_FILES['archivo']['tmp_name'],$destino)) {

					  $status = "Archivo subido: <b>".$archivo."</b><br><a href='inicial.php'>Regresar</a>";

				} else {

					$status = "Error al subir el archivo <a href='inicial.php'>Intentarlo nuevamente</a>";

				}

					$ar2 = array('foto_perfil');

					// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

					$ar1 = array($name);	

					// DEFINIMOS LOS ESTADOS DE SALIDA

					$output = array('registro actualizado', 'no se pudo actualizar'); 

					// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	

					$constrain = 'WHERE user_id = "'.$_SESSION['usuario'].'"';

					$ob->Editar($constrain, $ar2, $ar1, $output);

				echo "	<script>

							window.location.href = '".HOMEDIR."/dashboard/profile/';

						</script>";

		}elseif($c->sql_quote($_REQUEST['action']) == 'upload_logo'){
				
				$field = $c->sql_quote($_REQUEST['cn']);

				$tamano = $_FILES["archivo"]['size'];
				$tipo = $_FILES["archivo"]['type'];
				$archivo = $_FILES["archivo"]['name'];
				$prefijo = substr(md5(uniqid(rand())),0,30);
				$extension = strtolower(substr($archivo,strlen($archivo)-3,strlen($archivo)));
				$name = $prefijo.".".$extension;
				$destino =  ROOT."/plugins/thumbnails/".$name;
				if($archivo == ""){
					$status = "No hay archivos que cargar <a href='inicial.php'>Intentarlo nuevamente</a>";
				}
				if (copy($_FILES['archivo']['tmp_name'],$destino)) {
					  $status = "Archivo subido: <b>".$archivo."</b><br><a href='inicial.php'>Regresar</a>";
				}else {
					$status = "Error al subir el archivo <a href='inicial.php'>Intentarlo nuevamente</a>";
				}
				$con->Query("update usuarios set logo_correos = '".$name."' where user_id = '".$_SESSION['usuario']."'");

				echo '<script> window.location.href = "'.HOMEDIR.'/dashboard/profile/" </script>';
				
		}elseif($c->sql_quote($_REQUEST['action']) == 'GestListadoUsuarios'){

			$ob->GestListadoUsuarios($c->sql_quote($_REQUEST['id']));	

		}elseif($c->sql_quote($_REQUEST['action']) == 'GestListadoUsuarios3'){

			$ob->GestListadoUsuarios3($c->sql_quote($_REQUEST['id']));	

		}elseif($c->sql_quote($_REQUEST['action']) == 'GestListadoUsuariosSuscriptores'){

			$ob->GestListadoUsuariosSuscriptores($c->sql_quote($_REQUEST['id']));	

		}elseif($c->sql_quote($_REQUEST['action']) == 'GestListadoUsuariosSuscriptores2'){

			$ob->GestListadoUsuariosSuscriptores2($c->sql_quote($_REQUEST['id']));	

		}elseif ($c->sql_quote($_REQUEST['action']) == 'segundaclave'){

			$ob->GetPreguntas();

		}elseif ($c->sql_quote($_REQUEST['action']) == 'EnviarSegundaClave'){

			$ob->FormEnviarClave();

		}

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CUsuarios extends MainController{

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){

			// CREANDO UN NUEVO MODELO			

			$object = new MUsuarios;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template('Listar Usuarios');			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarUsuarios();	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

					include_once(VIEWS.DS.'usuarios/Listar.php');	   			

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

		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO

		function VistaEditar($x){

	 		// INVOCAMOS UN NUEVO OBJETO

		 	$object = new MUsuarios;

			// LO CREAMOS 			

			$object->CreateUsuarios('username', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'usuarios/FormUpdateUsuarios.php');		

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MUsuarios;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de Usuarios');			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarUsuarios('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'usuarios/Listar.php');	   			

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

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			$object = new MUsuarios;

			$create = $object->UpdateUsuarios($constrain, $fields, $updates, $output);

			echo $create;

		}

		function ActDeact($id, $status){

			global $con;

			#echo $id." --- ".$status;

			if ($status == "1") {

				$s = new MSuper_admin;

				$s->CreateSuper_admin("user_id", $_SESSION['sadminid']);

				#$total_usuarios = $s->GetTotalUsuarios($s->GetId());

				#$usuarios_activos = $s->GetTotalUsuariosActivos($s->GetId());

				#if ($usuarios_activos < $s->GetCupos() ) {

					$ar1 = array($status);

					$ar2 = array('estado');

					$output = array("OK", "OK");

					$constrain = "WHERE a_i = '".$id."'";

					$out = $this->Editar($constrain, $ar2, $ar1, $output);

					echo "Usuario Activado";

				#}else{

				#	echo 'error!';

				#}

			}else{

					$ar1 = array($status);

					$ar2 = array('estado');

					$output = array("OK", "OK");

					$constrain = "WHERE a_i = '".$id."'";

					$out = $this->Editar($constrain, $ar2, $ar1, $output);

					echo "Usuario Desactivado";

			}

		}

#

		function ActDeactAdmin($id, $status){

			global $con;

			$ar1 = array($status);

			$ar2 = array('IsAdministrador');

			$output = array("OK", "OK");

			$constrain = "WHERE a_i = '".$id."'";

			$out = $this->Editar($constrain, $ar2, $ar1, $output);

			echo $out;

		}

		function ActDeactMailAdmin($id, $status){

			global $con;

			$ar1 = array($status);

			$ar2 = array('notif_admin');

			$output = array("OK", "OK");

			$constrain = "WHERE a_i = '".$id."'";

			$out = $this->Editar($constrain, $ar2, $ar1, $output);

			echo $out;

		}

		function ActDeactSadmin($id, $status){

			global $con;

			$ar1 = array($status);

			$ar2 = array('IsSuperAdministrador');

			$output = array("OK", "OK");

			$constrain = "WHERE a_i = '".$id."'";

			$out = $this->Editar($constrain, $ar2, $ar1, $output);

			echo $out;

		}

		function ListadoAreasOficinaNew($id){

			global $con;
#			echo $id;
#			echo "select regimen from usuarios where seccional = '".$id."' group by regimen";
			$q_str = "
			SELECT a.id, a.nombre 
			FROM `usuarios_configurar_accesos` uc inner join areas a on uc.id_tabla = concat(a.id,'".$id."')
			where uc.tabla = 'area'
			group by a.id, a.nombre";
			$lits = $con->Query($q_str);
			$select="";
			if($con->NumRows($lits) == 1){
				$select = " selected ";
			}
			while ($row = $con->FetchAssoc($lits)) {
				$r = new MAreas;
				$r->CreateAreas("id", $row['id']);
				echo "<option value='".$r->GetId()."' $select>".$r->GetNombre()."</option>";
			}
		}	

		/*para eliminar*/function ListadoAreasOficina($id){

			global $con;
#			echo $id;

			if ($_SESSION['sadminid'] == "1") {
				$q_str =  "select regimen as id from usuarios where seccional = '".$id."' group by regimen";
			}else{
				$q_str = "
				SELECT a.id, a.nombre 
				FROM `usuarios_configurar_accesos` uc inner join areas a on uc.id_tabla = concat(a.id,'".$id."')
				where uc.tabla = 'area' and uc.user_id = '".$_SESSION['usuario']."'";
				
			}
			$lits = $con->Query($q_str);
			$select="";
			if($con->NumRows($lits) == 1){
				$select = " selected ";
			}
			while ($row = $con->FetchAssoc($lits)) {
				$r = new MAreas;
				$r->CreateAreas("id", $row['id']);
				echo "<option value='".$r->GetId()."' $select>".$r->GetNombre()."</option>";
			}
		}

		function ListadoUsuariosAreasOficina($id, $regimen){

			global $con;

			$lits = $con->Query("select * from usuarios where seccional = '".$id."' and regimen = '".$regimen."'");

			echo "<option value='0'>Todos</option>";

			echo "<option value='-1'>Jefe de ".CAMPOAREADETRABAJO."</option>";

			while ($row = $con->FetchAssoc($lits)) {

				$nombre = ucwords(strtolower($row['p_nombre']." ".$row['p_apellido']));

				echo "<option value='".$row['a_i']."'>".$nombre."</option>";

			}

		}

		function ListadoUsuariosAreasOficina2($id, $regimen){

			global $con;

			$lits = $con->Query("select * from usuarios where  seccional = '".$id."' and regimen = '".$regimen."'");

			$select="";

			if($con->NumRows($lits) == 1){

				$select = " selected ";

			}

			while ($row = $con->FetchAssoc($lits)) {

				$nombre = ucwords(strtolower($row['p_nombre']." ".$row['p_apellido']));

				echo "<option value='".$row['a_i']."' $select>".$nombre."</option>";

			}

		}

		function ListadoUsuariosAreasOficina3($id, $regimen){

			global $con;

			$q_str = "SELECT u.a_i, concat(p_nombre, ' ', s_nombre, ' ', p_apellido, ' ', s_apellido) as nombre

				FROM `usuarios_configurar_accesos` uc inner join usuarios u on uc.id_tabla = concat(u.a_i,'".$regimen."','".$id."') where uc.user_id = '".$_SESSION['usuario']."' and uc.tabla = 'usuario'"; 

			#$lits = $con->Query("select * from usuarios where user_id in(SELECT user_id FROM usuarios_configurar_accesos where tabla = 'usuario' and id_tabla = '".$regimen.$id."' group by user_id) ");
			$lits = $con->Query($q_str);
			$select="";

			if($con->NumRows($lits) == 1){

				$select = " selected ";

			}

			while ($row = $con->FetchAssoc($lits)) {

				$nombre = ucwords(strtolower($row['nombre']));

				echo "<option value='".$row['a_i']."' $select>".$nombre."</option>";

			}

		}

		function ListadoUsuariosAreasOficina3New($id, $regimen){

			global $con;
			$q_str = "SELECT u.a_i, concat(p_nombre, ' ', s_nombre, ' ', p_apellido, ' ', s_apellido) as nombre
				FROM `usuarios_configurar_accesos` uc inner join usuarios u on uc.id_tabla = concat(u.a_i,'".$regimen."','".$id."') 
				where  uc.tabla = 'usuario' and u.estado = '1'
				group by  u.a_i"; 
/*
			$lits = $con->Query("select * from usuarios where user_id in(SELECT user_id FROM usuarios_configurar_accesos where tabla = 'usuario' and id_tabla = '".$regimen.$id."' group by user_id) ");
*/
			$lits = $con->Query($q_str);
			$select="";

			if($con->NumRows($lits) == 1){

				$select = " selected ";

			}

			while ($row = $con->FetchAssoc($lits)) {

				$nombre = ucwords(strtolower($row['nombre']));
				#echo $nombre;
				echo "<option value='".$row['a_i']."' $select>".$nombre."</option>";

			}

		}

		function ListadoUsuariosTodos($id, $regimen){

			global $con;

			$lits = $con->Query("select * from usuarios where concat(p_nombre,p_apellido) like '%$id%' and estado = '1' ");

			echo "<ul class=list-group>";

			$i = 0;

			while ($row = $con->FetchAssoc($lits)) {

				$i++;

				$nombre = ucwords(strtolower($row['p_nombre']." ".$row['p_apellido']));

				echo "<li class='list-group-item'  onclick='AddUsuario(\"".$row['a_i']."\", \"".$nombre."\")'>".$nombre."</li>";

			}

			if ($i == 0) {
				echo "<li onclick='Hideform()' class='list-group-item'>No se encontraron resultados</li>";
			}

			echo "</ul>";

		}

		function ListadoUsuariosTodos2($id, $regimen){

			global $con;
			 $q_str = "SELECT u.a_i, concat(p_nombre, ' ', s_nombre, ' ', p_apellido, ' ', s_apellido) as nombre
				FROM `usuarios_configurar_accesos` uc inner join usuarios u on uc.id_tabla = concat(u.a_i,'".$regimen."','".$id."') 
				where  uc.tabla = 'usuario' and u.estado = '1'
				group by  u.a_i"; 

			$lits = $con->Query($q_str);

			while ($row = $con->FetchAssoc($lits)) {
				if($i != 0){
					echo '###';
				}
				$nombre = ucwords(strtolower($row['nombre']));
				echo $row['a_i']."|".$nombre;
				$i++;
			}

		}

		function GestListadoUsuarios3($x){

			// INVOCAMOS UN NUEVO OBJETO						

			$object = new MUsuarios;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarUsuarios('WHERE (p_nombre like "%'.$x.'%" or p_apellido like "%'.$x.'%") ');

			echo "<ul class='list-group'>";

			$i = 0;

			while ($roe = $con->FetchAssoc($query)) {

				$i++;

				echo "<li class='list-group-item' onclick='AddUsuarioToListado3(\"".$roe['p_nombre']." ".$roe['p_apellido']."\", \"".$roe['user_id']."\", \"".$roe['a_i']."\")'>".$roe['p_nombre']." ".$roe['p_apellido']."</li>";

			}

			if ($i == 0) {

				echo "<li class='list-group-item' onclick='Hideform()'>No se encontraron resultados</li>";

			}

			echo "</ul>";

		}

		function GestListadoUsuarios($x){

			// INVOCAMOS UN NUEVO OBJETO						

			$object = new MUsuarios;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarUsuarios('WHERE (p_nombre like "%'.$x.'%" or p_apellido like "%'.$x.'%") ');

			echo "<ul class'list-group'>";

			$i = 0;

			while ($roe = $con->FetchAssoc($query)) {

				$i++;

				echo "<li class='list-group-item' onclick='AddUsuarioToListado(\"".$roe['p_nombre']." ".$roe['p_apellido']."\", \"".$roe['user_id']."\", \"".$roe['a_i']."\")'>".$roe['p_nombre']." ".$roe['p_apellido']."</li>";

			}

			if ($i == 0) {

				echo "<li class='list-group-item' onclick='Hideform()'>No se encontraron resultados</li>";

			}

			echo "</ul>";

		}

		function GestListadoUsuariosSuscriptores($x){

			// INVOCAMOS UN NUEVO OBJETO						

			$object = new MUsuarios;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarUsuarios('WHERE (p_nombre like "%'.$x.'%" or p_apellido like "%'.$x.'%") ');

			echo "<ul class='list-group'>";

			$i = 0;

			while ($roe = $con->FetchAssoc($query)) {

				$i++;

				echo "<li class='list-group-item' onclick='AddUsuarioToListado(\"".$roe['p_nombre']." ".$roe['p_apellido']."\", \"".$roe['user_id']."\", \"".$roe['a_i']."\")'>".$roe['p_nombre']." ".$roe['p_apellido']." (Usuario)</li>";

			}

			$query2 = $object->ListarUsuariosSuscriptores(' AND (sc.nombre like "%'.$x.'%") ');

			while ($roe2 = $con->FetchAssoc($query2)) {

				$i++;

				echo "<li class='list-group-item' onclick='AddUsuarioToListado(\"".$roe2['nombre']."\", \"".$roe2['a_i']."\", \"".$roe2['a_i']."\")'>".$roe2['nombre']." (Suscriptor-".$roe2['type'].")</li>";

			}

			if ($i == 0) {

				echo "<li class='list-group-item' onclick='Hideform()'>No se encontraron resultados</li>";

			}

			echo "</ul>";

		}

		function GestListadoUsuariosSuscriptores2($x){

			// INVOCAMOS UN NUEVO OBJETO						

			$Msuscriptores_contactos = new Msuscriptores_contactos;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$que = $Msuscriptores_contactos->ListarSuscriptores_contactos('WHERE (nombre like "%'.$x.'%") ');

			echo "<ul class='list-group'>";

			$i = 0;

			while ($rc = $con->FetchAssoc($que)) {

            	$i++;

                echo "<li class='list-group-item' onclick='AddUsuarioToListado2(\"".$rc['nombre']."\", \"".''."\", \"".$rc['id']."\")'>".$rc['nombre']." </li>";

            }

			if ($i == 0) {

				echo "<li class='list-group-item' onclick='Hideform()'>No se encontraron resultados</li>";

			}

			echo "</ul>";

		}

		function GetPreguntas(){

			global $con;

			global $c;

			global $f;

				$object = new MUsuarios;

				$object->CreateUsuarios("user_id", $_SESSION['usuario']);

				$preguntas = new MPreguntas_usuarios;

				$query = $preguntas->ListarPreguntas_usuarios("WHERE username = '".$_SESSION['usuario']."'");

				$t = $con->NumRows($query);

				if ($t == "0") {

					include_once(VIEWS.DS."preguntas_usuarios/FormInsertPreguntas_usuarios.php");

				}else{

					include_once(VIEWS.DS."preguntas_usuarios/FormFormularioPreguntas_usuarios.php");

				}

			#include_once(VIEWS.DS.'usuarios/CheckPreguntas.php');

		}

		function FormEnviarClave(){

			global $con;

			global $c;

			global $f;

			global $m;

			$object = new MUsuarios;

			$object->CreateUsuarios("user_id", $_SESSION['usuario']);

			$text = $f->randomText(8);

			$np = hash("sha512", $text);

	 		$_SESSION['ACTIVEKEY'] = $np;

	 		$_SESSION['LAST_ACTIVITY'] = time();

		 	$fecha = date("Y-m-d H:i:s");

			$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.

			date_modify($fecha_c, "+4 hour");//sumas los dias que te hacen falta.

			$fcaduca = date_format($fecha_c, "Y-m-d H:i:s");//retornas la fecha en el formato que mas te guste.

			$firmas = new MFirmas_usuarios;

			$con->Query("update firmas_usuarios set estado_firma = '0' where username = '".$_SESSION['usuario']."'");

			$con->Query("update usuarios set s_password = '".$np."' where user_id = '".$_SESSION['usuario']."'");

			$acti   = $firmas->InsertFirmas_usuarios($_SESSION['usuario'], $_SESSION['SID'], $fecha, $fcaduca, $np, "1");



			$MPlantillas_email = new MPlantillas_email;

			$MPlantillas_email->CreatePlantillas_email('id', '5');

			$contenido_email = $MPlantillas_email->GetContenido();

			$contenido_email = str_replace("[elemento]fecha_vence[/elemento]",      $fcaduca,     $contenido_email );

			$contenido_email = str_replace("[elemento]responsable[/elemento]", $object->GetP_nombre()." ".$object->GetP_apellido(),     	   $contenido_email );

			$contenido_email = str_replace("[elemento]CLAVE_USUARIO[/elemento]",      $text,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );


			$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Restablecimiento de clave",$contenido_email,$_SESSION['usuario']);



			include_once(VIEWS.DS.'firmas_usuarios/Listar.php');


		}

		function abrirusuarios($regimen, $id){

			global $con;

			$MUsuarios = new MUsuarios;
			$MUsuarios->CreateUsuarios("a_i", $_POST['a_iusuario']);

			$usuarioactivo2='0';
			$id_usuario = "";

			$sql = " 
			select usuarios.*,id_tabla as activo_k 
			from usuarios inner join usuarios_configurar_accesos c on c.user_id = usuarios.user_id
			where c.tabla='usuario' and id_tabla = concat(usuarios.a_i,'$regimen','$id') and c.user_id = '".$MUsuarios->GetUser_id()."'
			union 
			select t.*,
					coalesce((SELECT id_tabla 
						FROM usuarios_configurar_accesos c 
						where c.tabla='usuario' and id_tabla = concat(t.a_i,'$regimen','$id') and c.user_id = '".$MUsuarios->GetUser_id()."'),'') as activo_k 
			from (SELECT uu.* 
				FROM usuarios_configurar_accesos c inner join usuarios uu 
				where c.tabla='usuario' and id_tabla = concat(uu.a_i,'$regimen','$id') and c.user_id = uu.user_id) t 
						left join usuarios u on t.user_id = u.user_id 
			where 1=1";

			$lits = $con->Query($sql);
			while ($row = $con->FetchAssoc($lits)) {
				$nombre = ucwords(strtolower($row['p_nombre']." ".$row['p_apellido']));

				if($MUsuarios->GetUser_id() == $row['user_id']){
					if($row['activo_k'] != ""){
						$usuarioactivo2='1';
						echo "<li class='list-group-item' >";
						echo '<div id="a'.$row['activo_k'].'">'.$nombre.'</div>';
                        if($row['activo_k'] != ''){
                        	$usuarioactivo='0';
                        	echo '<div style="float:right;margin-top: -28px;" id="ckusuario'.$row['activo_k'].'" value="'.$usuarioactivo.'" onclick="fnUsuarios_configurar_accesos(\'teliminar\',\''.$row['a_i'].'\',\''.$regimen.'\',\''.$id.'\')"  title="Desactivar usuario" class="mdi mdi-toggle-switch  text-success '.$row['activo_k'].'"></div>';
                        }else{
                        	$usuarioactivo='1';
                        	echo '<div style="float:right;margin-top: -28px;" value="'.$usuarioactivo.'"  onclick="fnUsuarios_configurar_accesos(\'tregistrar\',\''.$row['a_i'].'\',\''.$regimen.'\',\''.$id.'\')" title="Activar usuario" class="mdi mdi-toggle-switch-off '.$row['activo_k'].' text-muted"></div>';
                        }
                        echo "</li>";
					}else{
						$id_usuario = $row['id'];
					}
				}else{
					$usuarioactivo='1';
					echo "<li class='list-group-item' >";
					echo '<div id="a'.$row['activo_k'].'">'.$nombre.'</div>';
                    if($row['activo_k'] != ''){
                    	$usuarioactivo='0';
                    	echo '<div style="float:right;margin-top: -28px;" id="ckusuario'.$row['activo_k'].'" value="'.$usuarioactivo.'" onclick="fnUsuarios_configurar_accesos(\'teliminar\',\''.$row['a_i'].'\',\''.$regimen.'\',\''.$id.'\')" title="Desactivar usuario" class="mdi mdi-toggle-switch text-success  '.$row['activo_k'].'"></div>';
                    }else{
                    	$usuarioactivo='1';
                    	echo '<div style="float:right;margin-top: -28px;" value="'.$usuarioactivo.'" onclick="fnUsuarios_configurar_accesos(\'tregistrar\',\''.$row['a_i'].'\',\''.$regimen.'\',\''.$id.'\')" title="Activar usuario" class="mdi mdi-toggle-switch-off text-muted  '.$row['activo_k'].'"></div>';
                    }
                    echo "</li>";
				}
			}
			
			if($usuarioactivo2 == '0'){
				global $con;

				/*$sql = "SELECT * FROM usuarios";
				$query3 = $con->Query($sql);
				while ($row = $con->FetchAssoc($query3)) {
					$seccional = $row['seccional'];
					$area = $row['regimen'];
					$user_id = $row['user_id'];
					$id = $row['a_i'];

					$q_strx = "SELECT ciudad from seccional WHERE id='".$seccional."'";
					$queryx = $con->FetchAssoc($con->Query($q_strx));
					$ciudad = $queryx["ciudad"];

					$q_str = $con->Query("delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'city' and id_tabla= '$ciudad'"); 
					$q_str = $con->Query("INSERT INTO usuarios_configurar_accesos (user_id, tabla, id_tabla) VALUES ('$user_id', 'city', '$ciudad')");

					$q_str = $con->Query("delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'oficina' and id_tabla= '$seccional'"); 
					$q_str = $con->Query("INSERT INTO usuarios_configurar_accesos (user_id, tabla, id_tabla) VALUES ('$user_id', 'oficina', '$seccional')");

					$q_str = $con->Query("delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'area' and id_tabla= '".$area.$seccional."'"); 
					$q_str = $con->Query("INSERT INTO usuarios_configurar_accesos (user_id, tabla, id_tabla) VALUES ('$user_id', 'area', '".$area.$seccional."')");
					
					$q_str = $con->Query("delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'usuario' and id_tabla= '".$id.$area.$seccional."'"); 
					$q_str = $con->Query("INSERT INTO usuarios_configurar_accesos (user_id, tabla, id_tabla) VALUES ('$user_id', 'usuario', '".$id.$area.$seccional."')");
				
				}*/

				/*$object = new MUsuarios;
				$object->CreateUsuarios("user_id", $_SESSION['usuario']);*/

				echo '<li class="list-group-item" onclick="fnUsuarios_configurar_accesos(\'tregistrar\',\''.$MUsuarios->GetA_i().'\',\''.$regimen.'\',\''.$id.'\')"><div class="waves-effect">Registrarme en esta Area <span class="fa fa-plus-circle"></span> </div> </li>';
			}
			
		}

		function ActualizarCita(){
			global $con;
			global $c;
			global $f;

			$username = $c->sql_quote($_REQUEST['username']);
			$date_cita = $c->sql_quote($_REQUEST['date_cita']);
			$time_cita = $c->sql_quote($_REQUEST['time_cita']);

			if ($date_Cita == "") {
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
	}

?>