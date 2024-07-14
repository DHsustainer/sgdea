<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Mod_versionesE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MMod_versiones extends EMod_versiones{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_modulo("");
				parent::SetTitulo("");
				parent::SetFecha("");
				parent::SetAutor("");
				parent::SetUrl_instalacion("");
				parent::SetUrl_actualizacion("");
				parent::SetUrl_sql("");
				parent::SetNotas("");
				parent::SetEstado("");
				parent::SetRequerimientos("");
				parent::SetTipo_version("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateMod_versiones($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from mod_versiones where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_modulo($row['id_modulo']);
				parent::SetTitulo($row['titulo']);
				parent::SetFecha($row['fecha']);
				parent::SetAutor($row['autor']);
				parent::SetUrl_instalacion($row['url_instalacion']);
				parent::SetUrl_actualizacion($row['url_actualizacion']);
				parent::SetUrl_sql($row['url_sql']);
				parent::SetNotas($row['notas']);
				parent::SetEstado($row['estado']);
				parent::SetRequerimientos($row['requerimientos']);
				parent::SetTipo_version($row['tipo_version']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteMod_versiones($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from mod_versiones where id = '.$id;
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
		function InsertMod_versiones($id_modulo, $titulo, $fecha, $autor, $url_instalacion, $url_actualizacion, $url_sql, $notas, $estado, $requerimientos, $tipo_version)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO mod_versiones (id_modulo, titulo, fecha, autor, url_instalacion, url_actualizacion, url_sql, notas, estado, requerimientos, tipo_version) VALUES ('$id_modulo', '$titulo', '$fecha', '$autor', '$url_instalacion', '$url_actualizacion', '$url_sql', '$notas', '$estado', '$requerimientos', '$tipo_version')";
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

		function UpdateMod_versiones($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE mod_versiones SET ";
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
		function ListarMod_versiones($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM mod_versiones $path $constrain $order $limit"; 
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