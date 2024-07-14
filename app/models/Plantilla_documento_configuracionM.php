<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Plantilla_documento_configuracionE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MPlantilla_documento_configuracion extends EPlantilla_documento_configuracion{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUltima_modificacion("");
				parent::SetTipo("");
				parent::SetM_t("");
				parent::SetM_r("");
				parent::SetM_b("");
				parent::SetM_l("");
				parent::SetM_e_t("");
				parent::SetM_e_b("");
				parent::SetM_p_t("");
				parent::SetM_p_b("");
				parent::SetFuente("");
				parent::SetTamano("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreatePlantilla_documento_configuracion($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from plantilla_documento_configuracion where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUltima_modificacion($row['ultima_modificacion']);
				parent::SetTipo($row['tipo']);
				parent::SetM_t($row['m_t']);
				parent::SetM_r($row['m_r']);
				parent::SetM_b($row['m_b']);
				parent::SetM_l($row['m_l']);
				parent::SetM_e_t($row['m_e_t']);
				parent::SetM_e_b($row['m_e_b']);
				parent::SetM_p_t($row['m_p_t']);
				parent::SetM_p_b($row['m_p_b']);
				parent::SetFuente($row['fuente']);
				parent::SetTamano($row['tamano']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeletePlantilla_documento_configuracion($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from plantilla_documento_configuracion where id = '.$id;
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
		function InsertPlantilla_documento_configuracion($ultima_modificacion, $tipo, $m_t, $m_r, $m_b, $m_l, $m_e_t, $m_e_b, $m_p_t, $m_p_b, $fuente, $tamano)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO plantilla_documento_configuracion (ultima_modificacion, tipo, m_t, m_r, m_b, m_l, m_e_t, m_e_b, m_p_t, m_p_b, fuente, tamano) VALUES ('$ultima_modificacion', '$tipo', '$m_t', '$m_r', '$m_b', '$m_l', '$m_e_t', '$m_e_b', '$m_p_t', '$m_p_b', '$fuente', '$tamano')";
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

		function UpdatePlantilla_documento_configuracion($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE plantilla_documento_configuracion SET ";
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
		function ListarPlantilla_documento_configuracion($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM plantilla_documento_configuracion $path $constrain $order $limit"; 
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