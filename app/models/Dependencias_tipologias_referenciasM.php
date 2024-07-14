<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Dependencias_tipologias_referenciasE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MDependencias_tipologias_referencias extends EDependencias_tipologias_referencias{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUsername("");
				parent::SetDependencia_id("");
				parent::SetTitle("");
				parent::SetCol_1_name("");
				parent::SetCol_1_type("");
				parent::SetCol_1_size("");
				parent::SetCol_2_name("");
				parent::SetCol_2_type("");
				parent::SetCol_2_size("");
				parent::SetCol_3_name("");
				parent::SetCol_3_type("");
				parent::SetCol_3_size("");
				parent::SetCol_4_name("");
				parent::SetCol_4_type("");
				parent::SetCol_4_size("");
				parent::SetCol_5_name("");
				parent::SetCol_5_type("");
				parent::SetCol_5_size("");
				parent::SetCol_6_name("");
				parent::SetCol_6_type("");
				parent::SetCol_6_size("");
				parent::SetCol_7_name("");
				parent::SetCol_7_type("");
				parent::SetCol_7_size("");
				parent::SetCol_8_name("");
				parent::SetCol_8_type("");
				parent::SetCol_8_size("");
				parent::SetCol_9_name("");
				parent::SetCol_9_type("");
				parent::SetCol_9_size("");
				parent::SetCol_10_name("");
				parent::SetCol_10_type("");
				parent::SetCol_10_size("");
				parent::SetCol_11_name("");
				parent::SetCol_11_type("");
				parent::SetCol_11_size("");
				parent::SetCol_12_name("");
				parent::SetCol_12_type("");
				parent::SetCol_12_size("");
				parent::SetCol_13_name("");
				parent::SetCol_13_type("");
				parent::SetCol_13_size("");
				parent::SetCol_14_name("");
				parent::SetCol_14_type("");
				parent::SetCol_14_size("");
				parent::SetCol_15_name("");
				parent::SetCol_15_type("");
				parent::SetCol_15_size("");
				parent::SetFecha("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateDependencias_tipologias_referencias($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from dependencias_tipologias_referencias where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUsername($row['username']);
				parent::SetDependencia_id($row['dependencia_id']);
				parent::SetTitle($row['title']);
				parent::SetCol_1_name($row['col_1_name']);
				parent::SetCol_1_type($row['col_1_type']);
				parent::SetCol_1_size($row['col_1_size']);
				parent::SetCol_2_name($row['col_2_name']);
				parent::SetCol_2_type($row['col_2_type']);
				parent::SetCol_2_size($row['col_2_size']);
				parent::SetCol_3_name($row['col_3_name']);
				parent::SetCol_3_type($row['col_3_type']);
				parent::SetCol_3_size($row['col_3_size']);
				parent::SetCol_4_name($row['col_4_name']);
				parent::SetCol_4_type($row['col_4_type']);
				parent::SetCol_4_size($row['col_4_size']);
				parent::SetCol_5_name($row['col_5_name']);
				parent::SetCol_5_type($row['col_5_type']);
				parent::SetCol_5_size($row['col_5_size']);
				parent::SetCol_6_name($row['col_6_name']);
				parent::SetCol_6_type($row['col_6_type']);
				parent::SetCol_6_size($row['col_6_size']);
				parent::SetCol_7_name($row['col_7_name']);
				parent::SetCol_7_type($row['col_7_type']);
				parent::SetCol_7_size($row['col_7_size']);
				parent::SetCol_8_name($row['col_8_name']);
				parent::SetCol_8_type($row['col_8_type']);
				parent::SetCol_8_size($row['col_8_size']);
				parent::SetCol_9_name($row['col_9_name']);
				parent::SetCol_9_type($row['col_9_type']);
				parent::SetCol_9_size($row['col_9_size']);
				parent::SetCol_10_name($row['col_10_name']);
				parent::SetCol_10_type($row['col_10_type']);
				parent::SetCol_10_size($row['col_10_size']);
				parent::SetCol_11_name($row['col_11_name']);
				parent::SetCol_11_type($row['col_11_type']);
				parent::SetCol_11_size($row['col_11_size']);
				parent::SetCol_12_name($row['col_12_name']);
				parent::SetCol_12_type($row['col_12_type']);
				parent::SetCol_12_size($row['col_12_size']);
				parent::SetCol_13_name($row['col_13_name']);
				parent::SetCol_13_type($row['col_13_type']);
				parent::SetCol_13_size($row['col_13_size']);
				parent::SetCol_14_name($row['col_14_name']);
				parent::SetCol_14_type($row['col_14_type']);
				parent::SetCol_14_size($row['col_14_size']);
				parent::SetCol_15_name($row['col_15_name']);
				parent::SetCol_15_type($row['col_15_type']);
				parent::SetCol_15_size($row['col_15_size']);
				parent::SetFecha($row['fecha']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteDependencias_tipologias_referencias($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from dependencias_tipologias_referencias where id = '.$id;
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
		function InsertDependencias_tipologias_referencias($username, $dependencia_id, $title, $col_1_name, $col_1_type, $col_1_size, $col_2_name, $col_2_type, $col_2_size, $col_3_name, $col_3_type, $col_3_size, $col_4_name, $col_4_type, $col_4_size, $col_5_name, $col_5_type, $col_5_size, $col_6_name, $col_6_type, $col_6_size, $col_7_name, $col_7_type, $col_7_size, $col_8_name, $col_8_type, $col_8_size, $col_9_name, $col_9_type, $col_9_size, $col_10_name, $col_10_type, $col_10_size, $col_11_name, $col_11_type, $col_11_size, $col_12_name, $col_12_type, $col_12_size, $col_13_name, $col_13_type, $col_13_size, $col_14_name, $col_14_type, $col_14_size, $col_15_name, $col_15_type, $col_15_size, $fecha)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO dependencias_tipologias_referencias (username, dependencia_id, title, col_1_name, col_1_type, col_1_size, col_2_name, col_2_type, col_2_size, col_3_name, col_3_type, col_3_size, col_4_name, col_4_type, col_4_size, col_5_name, col_5_type, col_5_size, col_6_name, col_6_type, col_6_size, col_7_name, col_7_type, col_7_size, col_8_name, col_8_type, col_8_size, col_9_name, col_9_type, col_9_size, col_10_name, col_10_type, col_10_size, col_11_name, col_11_type, col_11_size, col_12_name, col_12_type, col_12_size, col_13_name, col_13_type, col_13_size, col_14_name, col_14_type, col_14_size, col_15_name, col_15_type, col_15_size, fecha) VALUES ('$username', '$dependencia_id', '$title', '$col_1_name', '$col_1_type', '$col_1_size', '$col_2_name', '$col_2_type', '$col_2_size', '$col_3_name', '$col_3_type', '$col_3_size', '$col_4_name', '$col_4_type', '$col_4_size', '$col_5_name', '$col_5_type', '$col_5_size', '$col_6_name', '$col_6_type', '$col_6_size', '$col_7_name', '$col_7_type', '$col_7_size', '$col_8_name', '$col_8_type', '$col_8_size', '$col_9_name', '$col_9_type', '$col_9_size', '$col_10_name', '$col_10_type', '$col_10_size', '$col_11_name', '$col_11_type', '$col_11_size', '$col_12_name', '$col_12_type', '$col_12_size', '$col_13_name', '$col_13_type', '$col_13_size', '$col_14_name', '$col_14_type', '$col_14_size', '$col_15_name', '$col_15_type', '$col_15_size', '$fecha')";
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

		function UpdateDependencias_tipologias_referencias($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE dependencias_tipologias_referencias SET ";
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
		function ListarDependencias_tipologias_referencias($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM dependencias_tipologias_referencias $path $constrain $order $limit"; 
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