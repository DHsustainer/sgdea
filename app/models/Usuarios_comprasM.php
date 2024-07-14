<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Usuarios_comprasE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MUsuarios_compras extends EUsuarios_compras{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUsername("");
				parent::SetEstado("");
				parent::SetDescripcion("");
				parent::SetTotal("");
				parent::SetRegistro_saldo("");
				parent::SetFecha_pago("");
				parent::SetMedio_pago("");
				parent::SetMedio_pago_comprobante("");
				parent::SetMedio_pago_imagen("");
				parent::SetCodigoAutorizacion("");
				parent::SetNumeroTransaccion("");
				parent::SetFechaActualizacion("");
				parent::SetReferente_pago("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateUsuarios_compras($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from usuarios_compras where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUsername($row['username']);
				parent::SetEstado($row['estado']);
				parent::SetDescripcion($row['descripcion']);
				parent::SetTotal($row['total']);
				parent::SetRegistro_saldo($row['registro_saldo']);
				parent::SetFecha_pago($row['fecha_pago']);
				parent::SetMedio_pago($row['medio_pago']);
				parent::SetMedio_pago_comprobante($row['medio_pago_comprobante']);
				parent::SetMedio_pago_imagen($row['medio_pago_imagen']);
				parent::SetCodigoAutorizacion($row['codigoAutorizacion']);
				parent::SetNumeroTransaccion($row['numeroTransaccion']);
				parent::SetFechaActualizacion($row['FechaActualizacion']);
				parent::SetReferente_pago($row['referente_pago']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteUsuarios_compras($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from usuarios_compras where id = '.$id;
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
		function InsertUsuarios_compras($username, $estado, $descripcion, $total, $registro_saldo, $fecha_pago, $medio_pago, $medio_pago_comprobante, $medio_pago_imagen, $codigoAutorizacion, $numeroTransaccion, $FechaActualizacion, $referente_pago, $paquete_id, $token, $fecha_c, $nombre_pago, $identificacion_pago, $telefono_pago, $email_pago)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO usuarios_compras (username, estado, descripcion, total, registro_saldo, fecha_pago, medio_pago, medio_pago_comprobante, medio_pago_imagen, codigoAutorizacion, numeroTransaccion, FechaActualizacion, referente_pago, paquete_id, token_id, fecha_registro, nombre_pago, identificacion_pago, telefono_pago, email_pago) VALUES ('$username', '$estado', '$descripcion', '$total', '$registro_saldo', '$fecha_pago', '$medio_pago', '$medio_pago_comprobante', '$medio_pago_imagen', '$codigoAutorizacion', '$numeroTransaccion', '$FechaActualizacion', '$referente_pago', '$paquete_id', '$token', '$fecha_c', '$nombre_pago', '$identificacion_pago', '$telefono_pago', '$email_pago')";
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

		function UpdateUsuarios_compras($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE usuarios_compras SET ";
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
		function ListarUsuarios_compras($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM usuarios_compras $path $constrain $order $limit"; 
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