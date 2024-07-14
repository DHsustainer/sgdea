<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Ref_tablesE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MRef_tables extends ERef_tables{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetUsername("");
				parent::SetDependencia_id("");
				parent::SetTitle("");
				parent::SetCol_1("");
				parent::SetCol_2("");
				parent::SetCol_3("");
				parent::SetCol_4("");
				parent::SetCol_5("");
				parent::SetCol_6("");
				parent::SetCol_7("");
				parent::SetCol_8("");
				parent::SetCol_9("");
				parent::SetCol_10("");
				parent::SetCol_11("");
				parent::SetCol_12("");
				parent::SetCol_13("");
				parent::SetCol_14("");
				parent::SetCol_15("");
				parent::SetCol_16("");
				parent::SetCol_17("");
				parent::SetCol_18("");
				parent::SetCol_19("");
				parent::SetCol_20("");
				parent::SetCol_21("");
				parent::SetCol_22("");
				parent::SetCol_23("");
				parent::SetCol_24("");
				parent::SetCol_25("");
				parent::SetCol_26("");
				parent::SetCol_27("");
				parent::SetCol_28("");
				parent::SetCol_29("");
				parent::SetCol_30("");
				parent::SetFecha("");
				parent::SetEs_generico("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateRef_tables($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from ref_tables where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUsername($row['username']);
				parent::SetDependencia_id($row['dependencia_id']);
				parent::SetTitle($row['title']);
				parent::SetCol_1($row['col_1']);
				parent::SetCol_2($row['col_2']);
				parent::SetCol_3($row['col_3']);
				parent::SetCol_4($row['col_4']);
				parent::SetCol_5($row['col_5']);
				parent::SetCol_6($row['col_6']);
				parent::SetCol_7($row['col_7']);
				parent::SetCol_8($row['col_8']);
				parent::SetCol_9($row['col_9']);
				parent::SetCol_10($row['col_10']);
				parent::SetCol_11($row['col_11']);
				parent::SetCol_12($row['col_12']);
				parent::SetCol_13($row['col_13']);
				parent::SetCol_14($row['col_14']);
				parent::SetCol_15($row['col_15']);
				parent::SetCol_16($row['col_16']);
				parent::SetCol_17($row['col_17']);
				parent::SetCol_18($row['col_18']);
				parent::SetCol_19($row['col_19']);
				parent::SetCol_20($row['col_20']);
				parent::SetCol_21($row['col_21']);
				parent::SetCol_22($row['col_22']);
				parent::SetCol_23($row['col_23']);
				parent::SetCol_24($row['col_24']);
				parent::SetCol_25($row['col_25']);
				parent::SetCol_26($row['col_26']);
				parent::SetCol_27($row['col_27']);
				parent::SetCol_28($row['col_28']);
				parent::SetCol_29($row['col_29']);
				parent::SetCol_30($row['col_30']);
				parent::SetFecha($row['fecha']);
				parent::SetEs_generico($row['es_generico']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteRef_tables($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from ref_tables where id = '.$id;
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
		function InsertRef_tables($username, $dependencia_id, $title, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15, $col_16, $col_17, $col_18, $col_19, $col_20, $col_21, $col_22, $col_23, $col_24, $col_25, $col_26, $col_27, $col_28, $col_29, $col_30, $fecha, $es_generico)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO ref_tables (username, dependencia_id, title, col_1, col_2, col_3, col_4, col_5, col_6, col_7, col_8, col_9, col_10, col_11, col_12, col_13, col_14, col_15, col_16, col_17, col_18, col_19, col_20, col_21, col_22, col_23, col_24, col_25, col_26, col_27, col_28, col_29, col_30, fecha, es_generico) VALUES ('$username', '$dependencia_id', '$title', '$col_1', '$col_2', '$col_3', '$col_4', '$col_5', '$col_6', '$col_7', '$col_8', '$col_9', '$col_10', '$col_11', '$col_12', '$col_13', '$col_14', '$col_15', '$col_16', '$col_17', '$col_18', '$col_19', '$col_20', '$col_21', '$col_22', '$col_23', '$col_24', '$col_25', '$col_26', '$col_27', '$col_28', '$col_29', '$col_30', '$fecha', '$es_generico')";
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

		function UpdateRef_tables($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE ref_tables SET ";
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
		function ListarRef_tables($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM ref_tables $path $constrain $order $limit"; 
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