<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Gestion_cambio_ubicacion_archivoE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MGestion_cambio_ubicacion_archivo extends EGestion_cambio_ubicacion_archivo{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_gestion("");
				parent::SetNombre_destino("");
				parent::SetEstado_archivo_origen("");
				parent::SetEstado_archivo_destino("");
				parent::SetEstado("");
				parent::SetFecha("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateGestion_cambio_ubicacion_archivo($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from gestion_cambio_ubicacion_archivo where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_gestion($row['id_gestion']);
				parent::SetNombre_destino($row['nombre_destino']);
				parent::SetEstado_archivo_origen($row['estado_archivo_origen']);
				parent::SetEstado_archivo_destino($row['estado_archivo_destino']);
				parent::SetEstado($row['estado']);
				parent::SetFecha($row['fecha']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteGestion_cambio_ubicacion_archivo($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from gestion_cambio_ubicacion_archivo where id = '.$id;
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}
		}

		function DeleteGestion_cambio_ubicacion_archivo2($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from gestion_cambio_ubicacion_archivo where id_gestion = '.$id;
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			/*if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}*/
		}

		// FUNCION QUE INSERTA UN REGISTRO EN LA BASE DE DATOS
		function InsertGestion_cambio_ubicacion_archivo($id_gestion, $nombre_destino, $estado_archivo_origen, $estado_archivo_destino, $estado, $fecha)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO gestion_cambio_ubicacion_archivo (id_gestion, nombre_destino, estado_archivo_origen, estado_archivo_destino, estado, fecha) VALUES ('$id_gestion', '$nombre_destino', '$estado_archivo_origen', '$estado_archivo_destino', '$estado', '".date("Y-m-d H:i:s")."')";
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

		function UpdateGestion_cambio_ubicacion_archivo($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE gestion_cambio_ubicacion_archivo SET ";
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
		function ListarGestion_cambio_ubicacion_archivo($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM gestion_cambio_ubicacion_archivo $path $constrain $order $limit"; 
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