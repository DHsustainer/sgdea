<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Mailer_replysE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MMailer_replys extends EMailer_replys{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetReceiver_id("");
				parent::SetMessage_id("");
				parent::SetReceiver_token("");
				parent::SetMessage_status("");
				parent::SetReply_datetime("");
				parent::SetReply_ip("");
				parent::SetSesionID("");
				parent::SetDetails("");
				parent::SetSubject("");
				parent::SetReaded("");
				parent::SetDns("");
				parent::SetHostname("");
				parent::SetIsp("");
				parent::SetOrganization("");
				parent::SetCountry("");
				parent::SetState("");
				parent::SetCity("");
				parent::SetLatitude("");
				parent::SetLongitude("");
				parent::SetLt("");
				parent::SetLg("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateMailer_replys($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from mailer_replys where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetReceiver_id($row['receiver_id']);
				parent::SetMessage_id($row['message_id']);
				parent::SetReceiver_token($row['receiver_token']);
				parent::SetMessage_status($row['message_status']);
				parent::SetReply_datetime($row['reply_datetime']);
				parent::SetReply_ip($row['reply_ip']);
				parent::SetSesionID($row['sesionID']);
				parent::SetDetails($row['details']);
				parent::SetSubject($row['subject']);
				parent::SetReaded($row['readed']);
				parent::SetDns($row['dns']);
				parent::SetHostname($row['hostname']);
				parent::SetIsp($row['isp']);
				parent::SetOrganization($row['organization']);
				parent::SetCountry($row['country']);
				parent::SetState($row['state']);
				parent::SetCity($row['city']);
				parent::SetLatitude($row['latitude']);
				parent::SetLongitude($row['longitude']);
				parent::SetLt($row['lt']);
				parent::SetLg($row['lg']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteMailer_replys($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from mailer_replys where id = '.$id;
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
		function InsertMailer_replys($receiver_id, $message_id, $receiver_token, $message_status, $reply_datetime, $reply_ip, $sesionID, $details, $subject, $readed, $dns, $hostname, $isp, $organization, $country, $state, $city, $latitude, $longitude, $lt, $lg)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO mailer_replys (receiver_id, message_id, receiver_token, message_status, reply_datetime, reply_ip, sesionID, details, subject, readed, dns, hostname, isp, organization, country, state, city, latitude, longitude, lt, lg, envio_fecha, estado) VALUES ('$receiver_id', '$message_id', '$receiver_token', '$message_status', '$reply_datetime', '$reply_ip', '$sesionID', '$details', '$subject', '$readed', '$dns', '$hostname', '$isp', '$organization', '$country', '$state', '$city', '$latitude', '$longitude', '$lt', '$lg', '".date('Y-m-d H:i:s')."', '0')";
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

		function UpdateMailer_replys($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE mailer_replys SET ";
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
		function ListarMailer_replys($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM mailer_replys $path $constrain $order $limit"; 
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