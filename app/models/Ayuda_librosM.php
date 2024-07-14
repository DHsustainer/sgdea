<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Ayuda_librosE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MAyuda_libros extends EAyuda_libros{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetTitulo("");
				parent::SetDescripcion("");
				parent::SetUsuario_registra("");
				parent::SetEstado("");
				parent::SetFecha_registro("");
				parent::SetFecha_actualizacion("");
				parent::SetVideo("");
				parent::SetTipo("");
				parent::SetDependencia("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateAyuda_libros($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from ayuda_libros where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetTitulo($row['titulo']);
				parent::SetDescripcion($row['descripcion']);
				parent::SetUsuario_registra($row['usuario_registra']);
				parent::SetEstado($row['estado']);
				parent::SetFecha_registro($row['fecha_registro']);
				parent::SetFecha_actualizacion($row['fecha_actualizacion']);
				parent::SetVideo($row['video']);
				parent::SetTipo($row['tipo']);
				parent::SetDependencia($row['dependencia']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteAyuda_libros($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from ayuda_libros where id = '.$id;
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
		function InsertAyuda_libros($titulo, $descripcion, $usuario_registra, $estado, $fecha_registro, $fecha_actualizacion, $video, $tipo, $dependencia)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO ayuda_libros (titulo, descripcion, usuario_registra, estado, fecha_registro, fecha_actualizacion, video, tipo, dependencia) VALUES ('$titulo', '$descripcion', '$usuario_registra', '$estado', '$fecha_registro', '$fecha_actualizacion', '$video', '$tipo', '$dependencia')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				#echo '1';
			}
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateAyuda_libros($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE ayuda_libros SET ";
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
		function ListarAyuda_libros($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM ayuda_libros $path $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
				if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}

		function GetArbolLibros($lid, $separador){
			global $con;
			global $c;
			global $f;

			$q_str = "Select * from ayuda_libros where dependencia = '$lid'";
			$query = $con->Query($q_str);

			if($query){
				while ($row = $con->FetchAssoc($query)) {
					echo '<a href="#" onClick="CargarDiv(\'loadElementosPagina\', \'/ayuda_elementos/buscar/'.$row['id'].'/\')" class="list-group-item p-l-'.$separador.'">'.$row['titulo'].'</a>';
					$nseparador = $separador + 10;
					$this->GetArbolLibros($row['id'], $nseparador);
				}
			}else{
				echo '<a href="#" class="list-group-item p-l-'.$separador.'">No hay Articulos...</a>';
			}
		}
		function GetArbolLibrosPublic($lid, $separador){
			global $con;
			global $c;
			global $f;

			$q_str = "Select * from ayuda_libros where dependencia = '$lid'";
			$query = $con->Query($q_str);

			if($query){
				while ($row = $con->FetchAssoc($query)) {
					echo '<a href="#" onClick="CargarDiv(\'loadElementosPagina\', \'/ayuda_elementos/buscarpublic/'.$row['id'].'/\')" class="list-group-item p-l-'.$separador.' book_main_item">'.$row['titulo'].'</a>';
					$nseparador = $separador + 10;
					$this->GetArbolLibrosPublic($row['id'], $nseparador);
				}
			}else{
				echo '<a href="#" class="list-group-item p-l-'.$separador.'">No hay Articulos...</a>';
			}
		}

	}	
?>