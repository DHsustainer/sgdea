<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Suscriptores_referenciasE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MSuscriptores_referencias extends ESuscriptores_referencias{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUsername("");
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
				parent::SetType_1("");
				parent::SetType_2("");
				parent::SetType_3("");
				parent::SetType_4("");
				parent::SetType_5("");
				parent::SetType_6("");
				parent::SetType_7("");
				parent::SetType_8("");
				parent::SetType_9("");
				parent::SetType_10("");
				parent::SetType_11("");
				parent::SetType_12("");
				parent::SetType_13("");
				parent::SetType_14("");
				parent::SetType_15("");
				parent::SetType_16("");
				parent::SetType_17("");
				parent::SetType_18("");
				parent::SetType_19("");
				parent::SetType_20("");
				parent::SetType_21("");
				parent::SetType_22("");
				parent::SetType_23("");
				parent::SetType_24("");
				parent::SetType_25("");
				parent::SetType_26("");
				parent::SetType_27("");
				parent::SetType_28("");
				parent::SetType_29("");
				parent::SetType_30("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateSuscriptores_referencias($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from suscriptores_referencias where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUsername($row['username']);
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
				parent::SetType_1($row['type_1']);
				parent::SetType_2($row['type_2']);
				parent::SetType_3($row['type_3']);
				parent::SetType_4($row['type_4']);
				parent::SetType_5($row['type_5']);
				parent::SetType_6($row['type_6']);
				parent::SetType_7($row['type_7']);
				parent::SetType_8($row['type_8']);
				parent::SetType_9($row['type_9']);
				parent::SetType_10($row['type_10']);
				parent::SetType_11($row['type_11']);
				parent::SetType_12($row['type_12']);
				parent::SetType_13($row['type_13']);
				parent::SetType_14($row['type_14']);
				parent::SetType_15($row['type_15']);
				parent::SetType_16($row['type_16']);
				parent::SetType_17($row['type_17']);
				parent::SetType_18($row['type_18']);
				parent::SetType_19($row['type_19']);
				parent::SetType_20($row['type_20']);
				parent::SetType_21($row['type_21']);
				parent::SetType_22($row['type_22']);
				parent::SetType_23($row['type_23']);
				parent::SetType_24($row['type_24']);
				parent::SetType_25($row['type_25']);
				parent::SetType_26($row['type_26']);
				parent::SetType_27($row['type_27']);
				parent::SetType_28($row['type_28']);
				parent::SetType_29($row['type_29']);
				parent::SetType_30($row['type_30']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteSuscriptores_referencias($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from suscriptores_referencias where id = '.$id;
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
		function InsertSuscriptores_referencias($username, $title, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15, $col_16, $col_17, $col_18, $col_19, $col_20, $col_21, $col_22, $col_23, $col_24, $col_25, $col_26, $col_27, $col_28, $col_29, $col_30, $type_1, $type_2, $type_3, $type_4, $type_5, $type_6, $type_7, $type_8, $type_9, $type_10, $type_11, $type_12, $type_13, $type_14, $type_15, $type_16, $type_17, $type_18, $type_19, $type_20, $type_21, $type_22, $type_23, $type_24, $type_25, $type_26, $type_27, $type_28, $type_29, $type_30)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO suscriptores_referencias (username, title, col_1, col_2, col_3, col_4, col_5, col_6, col_7, col_8, col_9, col_10, col_11, col_12, col_13, col_14, col_15, col_16, col_17, col_18, col_19, col_20, col_21, col_22, col_23, col_24, col_25, col_26, col_27, col_28, col_29, col_30, type_1, type_2, type_3, type_4, type_5, type_6, type_7, type_8, type_9, type_10, type_11, type_12, type_13, type_14, type_15, type_16, type_17, type_18, type_19, type_20, type_21, type_22, type_23, type_24, type_25, type_26, type_27, type_28, type_29, type_30) VALUES ('$username', '$title', '$col_1', '$col_2', '$col_3', '$col_4', '$col_5', '$col_6', '$col_7', '$col_8', '$col_9', '$col_10', '$col_11', '$col_12', '$col_13', '$col_14', '$col_15', '$col_16', '$col_17', '$col_18', '$col_19', '$col_20', '$col_21', '$col_22', '$col_23', '$col_24', '$col_25', '$col_26', '$col_27', '$col_28', '$col_29', '$col_30', '$type_1', '$type_2', '$type_3', '$type_4', '$type_5', '$type_6', '$type_7', '$type_8', '$type_9', '$type_10', '$type_11', '$type_12', '$type_13', '$type_14', '$type_15', '$type_16', '$type_17', '$type_18', '$type_19', '$type_20', '$type_21', '$type_22', '$type_23', '$type_24', '$type_25', '$type_26', '$type_27', '$type_28', '$type_29', '$type_30')";
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

		function UpdateSuscriptores_referencias($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE suscriptores_referencias SET ";
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
		function ListarSuscriptores_referencias($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM suscriptores_referencias $path $constrain $order $limit"; 
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