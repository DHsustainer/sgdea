<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'DependenciasE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MDependencias extends EDependencias{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetNombre("");
				parent::SetDependencia("");
				parent::SetUsuario("");
				parent::SetFecha("");
				parent::SetEstado("");
				parent::SetId_c("");
				parent::SetT_g("");	
				parent::SetT_c("");
				parent::SetT_h("");
				parent::SetObservacion("");
				parent::SetEs_inmaterial("");
				parent::SetId_version("");
				parent::SetNo_s("");
				parent::SetDependencia_inversa("");
				parent::SetEs_publico("");
				parent::SetTitulo_publico("");
				parent::SetDias_vencimiento("");
		}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateDependencias($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from dependencias where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetNombre($row['nombre']);
				parent::SetDependencia($row['dependencia']);
				parent::SetUsuario($row['usuario']);
				parent::SetFecha($row['fecha']);
				parent::SetEstado($row['estado']);
				parent::SetId_c($row['id_c']);
				parent::SetT_g($row['t_g']);
				parent::SetT_c($row['t_c']);
				parent::SetT_h($row['t_h']);
				parent::SetObservacion($row['observacion']);
				parent::SetEs_inmaterial($row['es_inmaterial']);
				parent::SetId_version($row['id_version']);
				parent::SetNo_s($row['no_s']);
				parent::SetDependencia_inversa($row['dependencia_inversa']);
				parent::SetEs_publico($row['es_publico']);
				parent::SetTitulo_publico($row['titulo_publico']);
				parent::SetDias_vencimiento($row['dias_vencimiento']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteDependencias($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from dependencias where id = '.$id;
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
		function InsertDependencias($nombre, $dependencia, $usuario, $fecha, $estado, $id_c, $t_g, $t_c, $t_h, $observacion, $inm = '0', $no_s = "0", $es_publico = "0", $titulo_publico = "", $dias_vencimiento = "0")
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO dependencias (nombre, dependencia, usuario, fecha, estado, id_c, t_g, t_c, t_h, observacion, es_inmaterial,id_version, no_s, es_publico, titulo_publico, dias_vencimiento) VALUES ('$nombre', '$dependencia', '$usuario', '$fecha', '$estado', '$id_c', '$t_g', '$t_c', '$t_h', '$observacion', '$inm','".$_SESSION['id_trd']."', '$no_s', '$es_publico', '$titulo_publico', '$dias_vencimiento')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				echo '';
			}
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateDependencias($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE dependencias SET ";
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
		function ListarDependencias($constrain = '', $order = 'order by nombre',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM dependencias $path $constrain $order $limit"; 
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