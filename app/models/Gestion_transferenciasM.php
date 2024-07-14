<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Gestion_transferenciasE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MGestion_transferencias extends EGestion_transferencias{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetGestion_id("");
				parent::SetUser_transfiere("");
				parent::SetUser_recibe("");
				parent::SetFecha_transferencia("");
				parent::SetFecha_aceptacion("");
				parent::SetObservaciona("");
				parent::SetObservacionb("");
				parent::SetEstado("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateGestion_transferencias($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from gestion_transferencias where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetGestion_id($row['gestion_id']);
				parent::SetUser_transfiere($row['user_transfiere']);
				parent::SetUser_recibe($row['user_recibe']);
				parent::SetFecha_transferencia($row['fecha_transferencia']);
				parent::SetFecha_aceptacion($row['fecha_aceptacion']);
				parent::SetObservaciona($row['observaciona']);
				parent::SetObservacionb($row['observacionb']);
				parent::SetEstado($row['estado']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteGestion_transferencias($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from gestion_transferencias where id = '.$id;
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
		function InsertGestion_transferencias($gestion_id, $user_transfiere, $user_recibe, $fecha_transferencia, $fecha_aceptacion, $observaciona, $observacionb, $estado)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO gestion_transferencias (gestion_id, user_transfiere, user_recibe, fecha_transferencia, fecha_aceptacion, observaciona, observacionb, estado) VALUES ('$gestion_id', '$user_transfiere', '$user_recibe', '$fecha_transferencia', '$fecha_aceptacion', '$observaciona', '$observacionb', '$estado')";
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

		function UpdateGestion_transferencias($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE gestion_transferencias SET ";
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
		function ListarGestion_transferencias($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM gestion_transferencias $path $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			#echo $q_str;
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