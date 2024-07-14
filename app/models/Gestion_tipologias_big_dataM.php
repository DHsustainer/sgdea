<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Gestion_tipologias_big_dataE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MGestion_tipologias_big_data extends EGestion_tipologias_big_data{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUsername("");
				parent::SetProceso_id("");
				parent::SetTipologia_referencia_id("");
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
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateGestion_tipologias_big_data($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from gestion_tipologias_big_data where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUsername($row['username']);
				parent::SetProceso_id($row['proceso_id']);
				parent::SetTipologia_referencia_id($row['tipologia_referencia_id']);
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
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteGestion_tipologias_big_data($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from gestion_tipologias_big_data where id = '.$id;
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
		function InsertGestion_tipologias_big_data($username, $proceso_id, $tipologia_referencia_id, $col_1, $col_2, $col_3, $col_4, $col_5, $col_6, $col_7, $col_8, $col_9, $col_10, $col_11, $col_12, $col_13, $col_14, $col_15)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO gestion_tipologias_big_data (username, proceso_id, tipologia_referencia_id, col_1, col_2, col_3, col_4, col_5, col_6, col_7, col_8, col_9, col_10, col_11, col_12, col_13, col_14, col_15) VALUES ('$username', '$proceso_id', '$tipologia_referencia_id', '$col_1', '$col_2', '$col_3', '$col_4', '$col_5', '$col_6', '$col_7', '$col_8', '$col_9', '$col_10', '$col_11', '$col_12', '$col_13', '$col_14', '$col_15')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateGestion_tipologias_big_data($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE gestion_tipologias_big_data SET ";
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
		function ListarGestion_tipologias_big_data($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM gestion_tipologias_big_data $path $constrain $order $limit"; 
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