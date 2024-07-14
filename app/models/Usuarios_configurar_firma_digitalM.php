<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Usuarios_configurar_firma_digitalE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MUsuarios_configurar_firma_digital extends EUsuarios_configurar_firma_digital{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id("");
				parent::SetCampo1("");
				parent::SetCampo2("");
				parent::SetCampo3("");
				parent::SetCampo4("");
				parent::SetCampo5("");
				parent::SetCampo6("");
				parent::SetCampo7("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateUsuarios_configurar_firma_digital($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from usuarios_configurar_firma_digital where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetCampo1($row['campo1']);
				parent::SetCampo2($row['campo2']);
				parent::SetCampo3($row['campo3']);
				parent::SetCampo4($row['campo4']);
				parent::SetCampo5($row['campo5']);
				parent::SetCampo6($row['campo6']);
				parent::SetCampo7($row['campo7']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteUsuarios_configurar_firma_digital($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from usuarios_configurar_firma_digital where id = '.$id;
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
		function InsertUsuarios_configurar_firma_digital($user_id, $campo1, $campo2, $campo3, $campo4, $campo5, $campo6, $campo7)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO usuarios_configurar_firma_digital (user_id, campo1, campo2, campo3, campo4, campo5, campo6, campo7) VALUES ('$user_id', '$campo1', '$campo2', '$campo3', '$campo4', '$campo5', '$campo6', '$campo7')";
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

		function UpdateUsuarios_configurar_firma_digital($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE usuarios_configurar_firma_digital SET ";
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
		function ListarUsuarios_configurar_firma_digital($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM usuarios_configurar_firma_digital $path $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
				if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}

		function CrearUsuarios_configurar_firma_digitalNoExiste($user_id)
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "INSERT into usuarios_configurar_firma_digital(user_id,campo1,campo7)
SELECT u.user_id,'nombre_usuario_firma','numero_aleatorio' FROM usuarios u  left join usuarios_configurar_firma_digital uc on u.user_id = uc.user_id 
where uc.user_id is null and u.user_id = '".$user_id."'"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}
		}

	}	
?>