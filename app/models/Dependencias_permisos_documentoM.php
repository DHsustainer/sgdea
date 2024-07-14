<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Dependencias_permisos_documentoE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MDependencias_permisos_documento extends EDependencias_permisos_documento{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_documento("");
				parent::SetId_dependencia("");
				parent::SetUsuario_permiso("");
				parent::SetFecha("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateDependencias_permisos_documento($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from dependencias_permisos_documento where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_documento($row['id_documento']);
				parent::SetId_dependencia($row['id_dependencia']);
				parent::SetUsuario_permiso($row['usuario_permiso']);
				parent::SetFecha($row['fecha']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteDependencias_permisos_documento($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from dependencias_permisos_documento where id = '.$id;
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
		function InsertDependencias_permisos_documento($id_documento, $id_dependencia, $usuario_permiso, $fecha)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO dependencias_permisos_documento (id_documento, id_dependencia, usuario_permiso, fecha) VALUES ('$id_documento', '$id_dependencia', '$usuario_permiso', '$fecha')";
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

		function UpdateDependencias_permisos_documento($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE dependencias_permisos_documento SET ";
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
		function ListarDependencias_permisos_documento($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM dependencias_permisos_documento $path $constrain $order $limit"; 
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