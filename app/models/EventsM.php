<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'EventsE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MEvents extends EEvents{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetUser_id("");
				parent::SetDate("");
				parent::SetTitle("");
				parent::SetDescription("");
				parent::SetAdded("");
				parent::SetStatus("");
				parent::SetDeadline("");
				parent::SetDayevent("");
				parent::SetTime("");
				parent::SetProceso_id("");
				parent::SetAlerted("");
				parent::SetAvisar_a("");
				parent::SetEcho("");
				parent::SetType_event("");
				parent::SetFecha_vencimiento("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateEvents($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from events where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetDate($row['date']);
				parent::SetTitle($row['title']);
				parent::SetDescription($row['description']);
				parent::SetAdded($row['added']);
				parent::SetStatus($row['status']);
				parent::SetDeadline($row['deadline']);
				parent::SetDayevent($row['dayevent']);
				parent::SetTime($row['time']);
				parent::SetProceso_id($row['proceso_id']);
				parent::SetAlerted($row['alerted']);
				parent::SetAvisar_a($row['avisar_a']);
				parent::SetEcho($row['echo']);
				parent::SetType_event($row['type_event']);
				parent::SetFecha_vencimiento($row['fecha_vencimiento']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteEvents($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from events where id = '.$id;
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
		function InsertEvents($user_id, $date, $title, $description, $added, $status, $deadline, $dayevent, $time, $proceso_id, $alerted, $avisar_a, $echo, $type_event, $fecha_vencimiento)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO events (user_id, date, title, description, added, status, deadline, dayevent, time, proceso_id, alerted, avisar_a, echo, type_event, fecha_vencimiento) VALUES ('$user_id', '$date', '$title', '$description', '$added', '$status', '$deadline', '$dayevent', '$time', '$proceso_id', '$alerted', '$avisar_a', '$echo', '$type_event', '$fecha_vencimiento')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateEvents($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE events SET ";
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
				return "1";
			}
		}

		// FUNCION PARA LISTAR REGISTROS 
		function ListarEvents($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM events $path $constrain $order $limit"; 
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