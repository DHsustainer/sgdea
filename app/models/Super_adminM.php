<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Super_adminE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MSuper_admin extends ESuper_admin{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetUser_id("");
				parent::SetP_nombre("");
				parent::SetF_caducidad("");
				parent::SetPassword("");
				parent::SetDireccion("");
				parent::SetTelefono("");
				parent::SetEmail("");
				parent::SetCiudad("");
				parent::SetEstado("");
				parent::SetSexo("");
				parent::SetF_registro("");
				parent::SetFoto_perfil("");
				parent::SetAuditoria("");
				parent::SetSeccional("");
				parent::SetCedula("");
				parent::SetCelular("");
				parent::SetDepartamento("");
				parent::SetNombre_representante("");
				parent::SetCedula_representante("");
				parent::SetExpedicion_cedula("");
				parent::SetCiudad_residencia("");
				parent::SetExpedicion_identificacion("");
				parent::SetCupos("");
				parent::SetEncabezado("");
				parent::SetPie_pagina("");
				parent::Setid_version("");
				parent::Setprefijo("");
				parent::SetDias_eliminacion("");
				parent::Setformato_r("");
				parent::Setimajotipo("");
				parent::Setestilo("");
				parent::Setlogo_white("");
				parent::Setimage_white("");
				parent::Settipo_radicacion("");
				parent::Setcupo_cuenta("");
				parent::Setcupo_negocio("");
				parent::Setlogo_courrier("");
				
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateSuper_admin($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from super_admin where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			if($query){
				//OBTENEMOS EL RESULTADO DE LA CONSULTA
				$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetP_nombre($row['p_nombre']);
				parent::SetF_caducidad($row['f_caducidad']);
				parent::SetPassword($row['password']);
				parent::SetDireccion($row['direccion']);
				parent::SetTelefono($row['telefono']);
				parent::SetEmail($row['email']);
				parent::SetCiudad($row['ciudad']);
				parent::SetEstado($row['estado']);
				parent::SetSexo($row['sexo']);
				parent::SetF_registro($row['f_registro']);
				parent::SetFoto_perfil($row['foto_perfil']);
				parent::SetAuditoria($row['auditoria']);
				parent::SetSeccional($row['seccional']);
				parent::SetCedula($row['cedula']);
				parent::SetCelular($row['celular']);
				parent::SetDepartamento($row['departamento']);
				parent::SetNombre_representante($row['nombre_representante']);
				parent::SetCedula_representante($row['cedula_representante']);
				parent::SetExpedicion_cedula($row['expedicion_cedula']);
				parent::SetCiudad_residencia($row['ciudad_residencia']);
				parent::SetExpedicion_identificacion($row['expedicion_identificacion']);
				parent::SetCupos($row['cupos']);
				parent::SetEncabezado($row['encabezado']);
				parent::SetPie_pagina($row['pie_pagina']);
				parent::Setid_version($row['id_version']);
				parent::Setprefijo($row['prefijo']);
				parent::SetDias_eliminacion($row['dias_eliminacion']);
				parent::Setformato_r($row['formato_r']);
				parent::Setimajotipo($row['imajo_tipo']);
				parent::Setestilo($row['estilo']);
				parent::Setlogo_white($row['logo_white']);
				parent::Setimage_white($row['image_white']);
				parent::Settipo_radicacion($row['tipo_radicacion']);
				parent::Setcupo_cuenta($row['cupo_cuenta']);
				parent::Setcupo_negocio($row['cupo_negocio']);
				parent::Setlogo_courrier($row['logo_courrier']);
			}
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteSuper_admin($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from super_admin where id = '.$id;
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
		function InsertSuper_admin($user_id, $p_nombre, $f_caducidad, $password, $direccion, $telefono, $email, $ciudad, $estado, $sexo, $f_registro, $foto_perfil, $auditoria, $seccional, $cedula, $celular, $departamento, $nombre_representante, $cedula_representante, $expedicion_cedula, $ciudad_residencia, $expedicion_identificacion, $cupos)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO super_admin (user_id, p_nombre, f_caducidad, password, direccion, telefono, email, ciudad, estado, sexo, f_registro, foto_perfil, auditoria, seccional, cedula, celular, departamento, nombre_representante, cedula_representante, expedicion_cedula, ciudad_residencia, expedicion_identificacion, cupos) VALUES ('$user_id', '$p_nombre', '$f_caducidad', '$password', '$direccion', '$telefono', '$email', '$ciudad', '$estado', '$sexo', '$f_registro', '$foto_perfil', '$auditoria', '$seccional', '$cedula', '$celular', '$departamento', '$nombre_representante', '$cedula_representante', '$expedicion_cedula', '$ciudad_residencia', '$expedicion_identificacion', '$cupos')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				echo '1';
			}
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateSuper_admin($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE super_admin SET ";
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
		function ListarSuper_admin($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM super_admin $path $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
				if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}

		function GetTotalUsuarios($user_id){
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT count(*) as t FROM usuarios where id_empresa = '".$user_id."'"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			$t = $con->FetchAssoc($query);

			return $t['t'];
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
		}

		function GetTotalUsuariosActivos($user_id){
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT count(*) as t FROM usuarios where id_empresa = '".$user_id."' and usuarios.estado = '1'"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			$t = $con->FetchAssoc($query);

			return $t['t'];
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
		}

	}	
?>