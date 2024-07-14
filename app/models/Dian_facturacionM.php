<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Dian_facturacionE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MDian_facturacion extends EDian_facturacion{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetNombre("");
				parent::SetNit("");
				parent::SetNum_resolucion("");
				parent::SetFecha_resolucion("");
				parent::SetPrefijo("");
				parent::SetRango_desde("");
				parent::SetRango_hasta("");
				parent::SetClave_tecnica("");
				parent::SetFecha_vigencia_desde("");
				parent::SetFecha_vigencia_hasta("");
				parent::SetSoftware_id("");
				parent::SetPin("");
				parent::SetNombre_software("");
				parent::SetFecha_registro("");
				parent::SetEstado("");
				parent::SetUrl("");
				parent::SetUsuario("");
				parent::SetClave("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateDian_facturacion($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from dian_facturacion where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetNombre($row['nombre']);
				parent::SetNit($row['nit']);
				parent::SetNum_resolucion($row['num_resolucion']);
				parent::SetFecha_resolucion($row['fecha_resolucion']);
				parent::SetPrefijo($row['prefijo']);
				parent::SetRango_desde($row['rango_desde']);
				parent::SetRango_hasta($row['rango_hasta']);
				parent::SetClave_tecnica($row['clave_tecnica']);
				parent::SetFecha_vigencia_desde($row['fecha_vigencia_desde']);
				parent::SetFecha_vigencia_hasta($row['fecha_vigencia_hasta']);
				parent::SetSoftware_id($row['software_id']);
				parent::SetPin($row['pin']);
				parent::SetNombre_software($row['nombre_software']);
				parent::SetFecha_registro($row['fecha_registro']);
				parent::SetEstado($row['estado']);
				parent::SetUrl($row['url']);
				parent::SetUsuario($row['usuario']);
				parent::SetClave($row['clave']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteDian_facturacion($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from dian_facturacion where id = '.$id;
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
		function InsertDian_facturacion($nombre, $nit, $num_resolucion, $fecha_resolucion, $prefijo, $rango_desde, $rango_hasta, $clave_tecnica, $fecha_vigencia_desde, $fecha_vigencia_hasta, $software_id, $pin, $nombre_software, $fecha_registro, $estado, $url, $usuario, $clave)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO dian_facturacion (nombre, nit, num_resolucion, fecha_resolucion, prefijo, rango_desde, rango_hasta, clave_tecnica, fecha_vigencia_desde, fecha_vigencia_hasta, software_id, pin, nombre_software, fecha_registro, estado, url, usuario, clave) VALUES ('$nombre', '$nit', '$num_resolucion', '$fecha_resolucion', '$prefijo', '$rango_desde', '$rango_hasta', '$clave_tecnica', '$fecha_vigencia_desde', '$fecha_vigencia_hasta', '$software_id', '$pin', '$nombre_software', '$fecha_registro', '$estado', '$url', '$usuario', '$clave')";
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

		function UpdateDian_facturacion($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE dian_facturacion SET ";
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
		function ListarDian_facturacion($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM dian_facturacion $path $constrain $order $limit"; 
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