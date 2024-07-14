<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'NotificacionesE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MNotificaciones extends ENotificaciones{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetUser_id("");
				parent::SetProceso_id("");
				parent::SetId_demandado("");
				parent::SetTipo_notificacion("");
				parent::SetId_postal("");
				parent::SetF_citacion("");
				parent::SetTodos("");
				parent::SetNom_archivo("");
				parent::SetDireccion("");
				parent::SetNum_dias("");
				parent::SetIs_certificada("");
				parent::SetGuia_id("");
				parent::SetDestinatario("");

				parent::Setnombre_postal("");
				parent::Sethora("");
				parent::Setvalor("");
				parent::Setsuscriptor("");
				parent::Setobservacion("");
				parent::Settelefono("");
				parent::Setsms_leido("");
				parent::Setsms_usar("");
				parent::Setfecha_lectura_sms("");
				parent::Setreply_ip("");
				parent::Setcountry("");
				parent::Setstate("");
				parent::Setcity("");
				parent::Setlatitude("");
				parent::Setlongitude("");
				parent::Setsms_enviado("");
				parent::Setnotificado("");
				parent::Setinteresado("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateNotificaciones($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from notificaciones where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetProceso_id($row['proceso_id']);
				parent::SetId_demandado($row['id_demandado']);
				parent::SetTipo_notificacion($row['tipo_notificacion']);
				parent::SetId_postal($row['id_postal']);
				parent::SetF_citacion($row['f_citacion']);
				parent::SetTodos($row['todos']);
				parent::SetNom_archivo($row['nom_archivo']);
				parent::SetDireccion($row['direccion']);
				parent::SetNum_dias($row['num_dias']);
				parent::SetIs_certificada($row['is_certificada']);
				parent::SetGuia_id($row['guia_id']);
				parent::SetDestinatario($row['destinatario']);
				parent::Setnombre_postal($row['nombre_postal']);
				parent::Sethora($row['hora']);
				parent::Setvalor($row['valor']);
				parent::Setsuscriptor($row['suscriptor']);
				parent::Setobservacion($row['observacion']);
				parent::Settelefono($row['telefono']);
				parent::Setsms_leido($row['sms_leido']);
				parent::Setsms_usar($row['sms_usar']);
				parent::Setfecha_lectura_sms($row['fecha_lectura_sms']);
				parent::Setreply_ip($row['reply_ip']);
				parent::Setcountry($row['country']);
				parent::Setstate($row['state']);
				parent::Setcity($row['city']);
				parent::Setlatitude($row['latitude']);
				parent::Setlongitude($row['longitude']);
				parent::Setsms_enviado($row['sms_enviado']);
				parent::Setnotificado($row['notificado']);
				parent::Setinteresado($row['interesado']);
				
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteNotificaciones($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from notificaciones where id = '.$id;
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
		function InsertNotificaciones($user_id, $proceso_id, $id_demandado, $tipo_notificacion, $id_postal, $f_citacion, $todos, $nom_archivo, $direccion, $num_dias, $is_certificada, $guia_id, $destinatario, $suscriptor = "0", $observacion = "", $telefono = "", $sms_leido = "", $sms_usar = "", $smsenviado = "0", $notificado = "", $responsable = "")
		{
			global $con; 
			global $c;


			if ($tipo_notificacion == "SMS") {
				$precio = $c->GetDataFromTable("keywords", "codeword", $tipo_notificacion, "p_clave", "");
			}else{
				$precio = $c->GetDataFromTable("keywords", "codeword", $tipo_notificacion, "p_clave", "");

				if ($sms_usar == "SI") {
					if ($smsenviado == "1") {
						$precio += $c->GetDataFromTable("keywords", "codeword", "SMS", "p_clave", "");
					}
				}

			}

			if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "1") {
				$us = new MUsuarios;
				$us->CreateUsuarios("user_id", $user_id);
				$cupo = $us->GetCupo();

				$cupo_nuevo = $cupo - $precio;

				$con->Query("update usuarios set cupo = '$cupo_nuevo' where user_id = '".$user_id."'");
			}else{

				if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "3") {
					
					$sadmin = new MSuper_admin;
	    			$sadmin->CreateSuper_admin("id", "6");

					#$cupo = $sadmin->Getcupo_cuenta() - $precio;
					$c->DescontarCupo($precio, "cupo_cuenta");

				}
			}

			if($_SESSION['MODULES']['modo_negocio_correpondencia'] == "1"){
				if ($tipo_notificacion == "SMS") {
					$preciov = $c->GetDataFromTable("keywords", "codeword", "BS-".$tipo_notificacion, "p_clave", "");
				}else{
					$preciov = $c->GetDataFromTable("keywords", "codeword", "BS-".$tipo_notificacion, "p_clave", "");

					if ($sms_usar == "SI") {
						if ($smsenviado == "1") {
							$preciov += $c->GetDataFromTable("keywords", "codeword", "BS-SMS", "p_clave", "");
						}
					}

				}
				$c->DescontarCupo($preciov, "cupo_negocio");
			}


			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO notificaciones (user_id, proceso_id, id_demandado, tipo_notificacion, id_postal, f_citacion, todos, nom_archivo, direccion, num_dias, is_certificada, guia_id, destinatario, hora, suscriptor, observacion, telefono, sms_leido, sms_usar, valor, sms_enviado, notificado, estado, interesado) VALUES ('$user_id', '$proceso_id', '$id_demandado', '$tipo_notificacion', '$id_postal', '$f_citacion', '$todos', '$nom_archivo', '$direccion', '$num_dias', '$is_certificada', '$guia_id', '$destinatario', '".date("H:i:s")."', '$suscriptor', '$observacion', '$telefono', '$sms_leido', '$sms_usar', '$precio', '$smsenviado', '$notificado', '0', '".$responsable."')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str, 'insert'); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateNotificaciones($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE notificaciones SET ";
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
		function ListarNotificaciones($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM notificaciones $path $constrain $order $limit"; 
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