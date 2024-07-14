<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Usuarios_configurar_accesosE.php');
// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MUsuarios_configurar_accesos extends EUsuarios_configurar_accesos{
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetUser_id("");
				parent::SetTabla("");
				parent::SetId_tabla("");
	}
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}
		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateUsuarios_configurar_accesos($selector = 'id', $id)
		{
			global $con;
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 
			$q_str= "select * from usuarios_configurar_accesos where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);
				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetTabla($row['tabla']);
				parent::SetId_tabla($row['id_tabla']);
		}
		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteUsuarios_configurar_accesos($id)
		{
			global $con; 
			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from usuarios_configurar_accesos where id = '.$id;
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}
		}
		function DeleteUsuarios_configurar_accesos_porusuario($id)
		{
			global $con; 
			// DEFINIMOS LA CONSULTA
			$q_str= "delete from usuarios_configurar_accesos where user_id = '$id'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}
		}
		// FUNCION QUE INSERTA UN REGISTRO EN LA BASE DE DATOS
		function InsertUsuarios_configurar_accesos($user_id, $tabla, $id_tabla)
		{
			global $con; 
			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT IGNORE INTO usuarios_configurar_accesos (user_id, tabla, id_tabla) VALUES ('$user_id', '$tabla', '$id_tabla')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				//echo '1';
			}
		} 
		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS
		function UpdateUsuarios_configurar_accesos($constrain, $fields, $updates, $output)
		{
			global $con;
			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE usuarios_configurar_accesos SET ";
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
			// EJECUTAMOS LA CONSULTA UNA VEZ ESTE CONSTRUIDA
			$query = $con->Query($str); 
			//VERIFICAMOS SI SE EJECUTO CORRECTAMENTE	
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query[1];
			}
		}
		// FUNCION PARA LISTAR REGISTROS 
		function ListarUsuarios_configurar_accesos($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;
			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM usuarios_configurar_accesos $path $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
				if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function CiudadUsuario($seccionalusuario)
		{
			global $con;
			$q_strx = "SELECT ciudad from seccional WHERE id='".$seccionalusuario."'";
			$queryx = $con->Query($q_strx);
			return $ciudad = $con->Result($queryx, 0, "ciudad");
		}
		// FUNCION PARA LISTAR REGISTROS 
		function ListarCiudades($seccionalusuario,$user_idusuario)
		{
			global $con;
			// DEFINIMOS LA CONSULTA
			$q_strx = "SELECT ciudad from seccional WHERE id='".$seccionalusuario."'";
			$queryx = $con->Query($q_strx);
			$ciudad = $con->Result($queryx, 0, "ciudad");
			if($_SESSION['cambio_ciudad'] == 1){
				$q_str = "SELECT c.code, c.Name as name, sc.id,(SELECT count(*) FROM `usuarios_configurar_accesos` where tabla = 'city' and user_id = '$user_idusuario' and id_tabla = c.code) as valor FROM seccional_principal sc inner join city c on sc.ciudad_origen = c.code";
			} else {
				$q_str = "SELECT c.code, c.Name as name, sc.id,(SELECT count(*) FROM `usuarios_configurar_accesos` where tabla = 'city' and user_id = '$user_idusuario' and id_tabla = c.code) as valor FROM seccional_principal sc inner join city c on sc.ciudad_origen = c.code WHERE c.code = '".$ciudad."'";
			}
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function ListarCiudadesOficinas($id,$seccionalusuario,$user_idusuario)
		{
			global $con;
			// DEFINIMOS LA CONSULTA
			if($_SESSION['cambio_oficina'] == 1){
				$q_str = "SELECT id, nombre,(SELECT count(*) FROM `usuarios_configurar_accesos` where tabla = 'oficina' and user_id = '$user_idusuario' and id_tabla = seccional.id) as valor FROM seccional where principal = '$id' "; 
			} else {
				$q_str = "SELECT id, nombre,(SELECT count(*) FROM `usuarios_configurar_accesos` where tabla = 'oficina' and user_id = '$user_idusuario' and id_tabla = seccional.id) as valor FROM seccional where principal = '$id' and id ='".$seccionalusuario."'"; 
			}
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function ListarCiudadesOficinasAreas($id,$area_principalusuario,$user_idusuario)
		{
			global $con;
			// DEFINIMOS LA CONSULTA
			if($_SESSION['cambio_area'] == 1){
				$q_str = "SELECT a.id, a.nombre,(SELECT count(*) FROM `usuarios_configurar_accesos` where tabla = 'area' and user_id = '$user_idusuario' and id_tabla = concat(a.id,u.seccional)) as valor FROM usuarios u inner join areas a on u.regimen = a.id where u.seccional = '$id' group by a.id, a.nombre"; 
			} else {
				$q_str = "SELECT a.id, a.nombre,(SELECT count(*) FROM `usuarios_configurar_accesos` where tabla = 'area' and user_id = '$user_idusuario' and id_tabla = concat(a.id,u.seccional)) as valor FROM usuarios u inner join areas a on u.regimen = a.id where u.seccional = '$id' and a.id ='".$area_principalusuario."' group by a.id, a.nombre"; 
			}
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function ListarCiudadesOficinasAreasUsuarios($id,$user_idusuario)
		{
			global $con;
			// DEFINIMOS LA CONSULTA
			if($_SESSION['cambio_usuario'] == 1){
				$q_str = "SELECT user_id, concat(p_nombre, ' ', s_nombre, ' ', p_apellido, ' ', s_apellido) as nombre,  a_i as id,
				(SELECT count(*) FROM `usuarios_configurar_accesos` where tabla = 'usuario' and user_id = '$user_idusuario' and id_tabla = concat(u.a_i,'$id',u.seccional)) as valor FROM usuarios u where regimen = '$id'"; 
			} else {
				$q_str = "SELECT user_id, concat(p_nombre, ' ', s_nombre, ' ', p_apellido, ' ', s_apellido) as nombre,  a_i as id,
				(SELECT count(*) FROM `usuarios_configurar_accesos` where tabla = 'usuario' and user_id = '$user_idusuario' and id_tabla = concat(u.a_i,'$id',u.seccional)) as valor FROM usuarios u where regimen = '$id' and u.user_id = '".$user_idusuario."'"; 
			}
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		// FUNCION PARA LISTAR REGISTROS 
		function ListarCiudadesUsuario()
		{
			global $con;
			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT c.code,c.Name FROM `usuarios_configurar_accesos` uc inner join city c on uc.id_tabla = c.code where uc.user_id = '".$_SESSION['usuario']."' and uc.tabla = 'city'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function ListarOficinasUsuario()
		{
			global $con;
			ECHO $q_str = "SELECT s.id, s.nombre FROM `usuarios_configurar_accesos` uc inner join seccional s on uc.id_tabla = s.id where uc.user_id = '".$_SESSION['usuario']."'  and uc.tabla = 'oficina'  and s.ciudad = '".$_SESSION['ciudad']."'"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function ListarAreasUsuario()
		{
			global $con;
/*
			$q_str = "SELECT t.id, t.nombre FROM `usuarios_configurar_accesos` uc inner join 
			(SELECT a.id, a.nombre FROM usuarios u inner join areas a on u.regimen = a.id where u.seccional = '".$_SESSION['seccional']."' group by a.id, a.nombre) t 
			 on uc.id_tabla = concat(t.id,".$_SESSION['seccional'].") where uc.user_id = '".$_SESSION['usuario']."'  and uc.tabla = 'area'"; 
*/
			 $q_str = "SELECT t.id, t.nombre FROM usuarios_configurar_accesos uc inner join (SELECT a.id, a.nombre FROM areas a ) t on uc.id_tabla = concat(t.id,".$_SESSION['seccional'].") where uc.user_id = '".$_SESSION['usuario']."' and uc.tabla = 'area'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function ListarAreasUsuarioNew()
		{
			global $con;
			$q_str = "
			SELECT a.id, a.nombre FROM `usuarios_configurar_accesos` uc inner join areas a on uc.id_tabla = concat(a.id,'".$_SESSION['seccional']."') where uc.tabla = 'area' and uc.user_id = '".$_SESSION['usuario']."'"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function ListarOficinasUsuarioUna($ciudadusuario)
		{
			global $con;
			$q_str = "SELECT s.id, s.nombre FROM `usuarios_configurar_accesos` uc inner join seccional s on uc.id_tabla = s.id where uc.user_id = '".$_SESSION['usuario']."'  and uc.tabla = 'oficina'  and s.ciudad = '".$ciudadusuario."' limit 1"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function ListarAreasUsuarioUna($seccionalusuario)
		{
			global $con;
			$q_str = "SELECT t.id, t.nombre FROM `usuarios_configurar_accesos` uc inner join 
			(SELECT a.id, a.nombre FROM usuarios u inner join areas a on u.regimen = a.id where u.seccional = '".$seccionalusuario."' group by a.id, a.nombre) t 
			 on uc.id_tabla = concat(t.id,".$_SESSION['seccional'].") where uc.user_id = '".$_SESSION['usuario']."'  and uc.tabla = 'area' limit 1"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function ListarUsuarioUsuario($user_id,$seccional,$area_principal)
		{
			global $con;
			 $q_str = "SELECT u.user_id, concat(p_nombre, ' ', s_nombre, ' ', p_apellido, ' ', s_apellido) as nombre
				FROM `usuarios_configurar_accesos` uc inner join usuarios u on uc.id_tabla = concat(u.a_i,'".$area_principal."','".$seccional."') where uc.user_id = '".$user_id."' and uc.tabla = 'usuario'"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function CrearCiudadUsuario($a_i,$user_id)
		{
			global $con;
			global $c;
			$seccional = $c->GetDataFromTable('usuarios','a_i',$a_i,'seccional');
			$area = $c->GetDataFromTable('usuarios','a_i',$a_i,'regimen'); 
			$q_strx = "SELECT ciudad from seccional WHERE id='".$seccional."'";
			$queryx = $con->Query($q_strx);
			$ciudad = $con->Result($queryx, 0, "ciudad");
			$q_str = "delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'city' and id_tabla= '$ciudad'"; 
			$query = $con->Query($q_str);
			$this->InsertUsuarios_configurar_accesos($user_id, 'city', $ciudad);
			$q_str = "delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'oficina' and id_tabla= '$seccional'"; 
			$query = $con->Query($q_str);
			$this->InsertUsuarios_configurar_accesos($user_id, 'oficina', $seccional);
			$q_str = "delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'area' and id_tabla= '".$area.$seccional."'"; 
			$query = $con->Query($q_str);
			$this->InsertUsuarios_configurar_accesos($user_id, 'area', $area.$seccional);
			$q_str = "delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'usuario' and id_tabla= '".$a_i.$area.$seccional."'"; 
			$query = $con->Query($q_str);
			$this->InsertUsuarios_configurar_accesos($user_id, 'usuario', $a_i.$area.$seccional);
		}
	}	
?>