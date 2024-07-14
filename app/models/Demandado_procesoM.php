<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Demandado_procesoE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MDemandado_proceso extends EDemandado_proceso{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetUser_id("");
				parent::SetProceso_id("");
				parent::SetCedula("");
				parent::SetP_nombre("");
				parent::SetS_nombre("");
				parent::SetP_apellido("");
				parent::SetS_apellido("");
				parent::SetDireccion("");
				parent::SetDepartamento("");
				parent::SetCiudad("");
				parent::SetTipo("");
				parent::SetEmail("");
				parent::SetPais("");
				parent::SetTelefonos("");
				parent::SetExp_identificacion("");
				parent::SetNotif_actuaciones("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateDemandado_proceso($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from demandado_proceso where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetProceso_id($row['proceso_id']);
				parent::SetCedula($row['cedula']);
				parent::SetP_nombre($row['p_nombre']);
				parent::SetS_nombre($row['s_nombre']);
				parent::SetP_apellido($row['p_apellido']);
				parent::SetS_apellido($row['s_apellido']);
				parent::SetDireccion($row['direccion']);
				parent::SetDepartamento($row['departamento']);
				parent::SetCiudad($row['ciudad']);
				parent::SetTipo($row['tipo']);
				parent::SetEmail($row['email']);
				parent::SetPais($row['pais']);
				parent::SetTelefonos($row['telefonos']);
				parent::SetExp_identificacion($row['exp_identificacion']);
				parent::SetNotif_actuaciones($row['notif_actuaciones']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteDemandado_proceso($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from demandado_proceso where id = '.$id;
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
		function InsertDemandado_proceso($user_id, $proceso_id, $cedula, $p_nombre, $s_nombre, $p_apellido, $s_apellido, $direccion, $departamento, $ciudad, $tipo, $email, $pais, $telefonos, $exp_identificacion)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO demandado_proceso (user_id, proceso_id, cedula, p_nombre, s_nombre, p_apellido, s_apellido, direccion, departamento, ciudad, tipo, email, pais, telefonos, exp_identificacion) VALUES ('$user_id', '$proceso_id', '$cedula', '$p_nombre', '$s_nombre', '$p_apellido', '$s_apellido', '$direccion', '$departamento', '$ciudad', '$tipo', '$email', '$pais', '$telefonos', '$exp_identificacion')";
			// EJECUTAMOS LA CONSULTA
			echo $q_str;
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateDemandado_proceso($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE demandado_proceso SET ";
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
				return $output[0];
			}
		}

		// FUNCION PARA LISTAR REGISTROS 
		function ListarDemandado_proceso($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM demandado_proceso $path $constrain $order $limit"; 
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