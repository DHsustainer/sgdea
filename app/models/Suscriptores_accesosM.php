<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Suscriptores_accesosE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MSuscriptores_accesos extends ESuscriptores_accesos{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_suscriptor("");
				parent::SetDominio("");
				parent::SetkeyUser("");
				parent::SetHost("");
				parent::SetUsuario("");
				parent::SetClave("");
				parent::SetDb_nombre("");
				parent::SetUrl1("");
				parent::SetUrl2("");
				parent::SetUrl3("");
				parent::SetHost_correo("");
				parent::SetPuerto_correo("");
				parent::SetUsuario_correo("");
				parent::SetClave_correo("");
				parent::SetAutenticacion_correo("");
				parent::SetSmtp_correo("");
				parent::SetUsuario_ftp("");
				parent::SetClave_ftp("");
				parent::SetPuerto_ftp("");
				parent::SetPath_ftp("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateSuscriptores_accesos($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from suscriptores_accesos where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_suscriptor($row['id_suscriptor']);
				parent::SetDominio($row['dominio']);
				parent::SetkeyUser($row['d_key']);
				parent::SetHost($row['host']);
				parent::SetUsuario($row['usuario']);
				parent::SetClave($row['clave']);
				parent::SetDb_nombre($row['db_nombre']);
				parent::SetUrl1($row['url1']);
				parent::SetUrl2($row['url2']);
				parent::SetUrl3($row['url3']);

				parent::SetHost_correo($row['host_correo']);
				parent::SetPuerto_correo($row['puerto_correo']);
				parent::SetUsuario_correo($row['usuario_correo']);
				parent::SetClave_correo($row['clave_correo']);
				parent::SetAutenticacion_correo($row['autenticacion_correo']);
				parent::SetSmtp_correo($row['smtp_correo']);
				parent::SetUsuario_ftp($row['usuario_ftp']);
				parent::SetClave_ftp($row['clave_ftp']);
				parent::SetPuerto_ftp($row['puerto_ftp']);
				parent::SetPath_ftp($row['path_ftp']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteSuscriptores_accesos($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from suscriptores_accesos where id = '.$id;
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
		function InsertSuscriptores_accesos($id_suscriptor, $dominio, $d_key, $host, $usuario, $clave, $db_nombre, $url1, $url2, $url3)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO suscriptores_accesos (id_suscriptor, dominio, d_key, host, usuario, clave, db_nombre, url1, url2, url3) VALUES ('$id_suscriptor', '$dominio', '$d_key', '$host', '$usuario', '$clave', '$db_nombre', '$url1', '$url2', '$url3')";
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

		function UpdateSuscriptores_accesos($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE suscriptores_accesos SET ";
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
		function ListarSuscriptores_accesos($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM suscriptores_accesos $path $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
				if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}

	}	
?>