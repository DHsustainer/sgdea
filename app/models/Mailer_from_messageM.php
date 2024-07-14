<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Mailer_from_messageE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MMailer_from_message extends EMailer_from_message{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetMessage_id("");
				parent::SetMessage_code("");
				parent::SetSID("");
				parent::SetToken_ID("");
				parent::SetUser_ID("");
				parent::SetEmail("");
				parent::SetSize("");
				parent::SetMessage("");
				parent::SetClean_message("");
				parent::SetType_message("");
				parent::SetName("");
				parent::SetDns("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateMailer_from_message($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from mailer_from_message where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetMessage_id($row['message_id']);
				parent::SetMessage_code($row['message_code']);
				parent::SetSID($row['sID']);
				parent::SetToken_ID($row['token_ID']);
				parent::SetUser_ID($row['user_ID']);
				parent::SetEmail($row['email']);
				parent::SetSize($row['size']);
				parent::SetMessage($row['message']);
				parent::SetClean_message($row['clean_message']);
				parent::SetType_message($row['type_message']);
				parent::SetName($row['name']);
				parent::SetDns($row['dns']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteMailer_from_message($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from mailer_from_message where id = '.$id;
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
		function InsertMailer_from_message($message_id, $message_code, $sID, $token_ID, $user_ID, $email, $size, $message, $clean_message, $type_message, $name, $dns)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO mailer_from_message (message_id, message_code, sID, token_ID, user_ID, email, size, message, clean_message, type_message, name, dns) VALUES ('$message_id', '$message_code', '$sID', '$token_ID', '$user_ID', '$email', '$size', '$message', '$clean_message', '$type_message', '$name', '$dns')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			/*if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				echo '1';
			}*/
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateMailer_from_message($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE mailer_from_message SET ";
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
		function ListarMailer_from_message($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM mailer_from_message $path $constrain $order $limit"; 
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