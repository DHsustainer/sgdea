<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'LibrosE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MLibros extends ELibros{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetTitulo("");
				parent::SetCover("");
				parent::SetDescripcion("");
				parent::SetAutor("");
				parent::SetPrecio("");
				parent::SetUsuario_registra("");
				parent::SetSigla("");
				parent::SetRaiz("");		
				parent::SetXML("");		
				parent::SetEstado("");	
				parent::SetFecha_actualizacion("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateLibros($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from libros where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetTitulo($row['titulo']);
				parent::SetCover($row['cover']);
				parent::SetDescripcion($row['descripcion']);
				parent::SetAutor($row['autor']);
				parent::SetPrecio($row['precio']);
				parent::SetUsuario_registra($row['usuario_registra']);
				parent::SetSigla($row['sigla']);
				parent::SetRaiz($row['elemento_raiz']);
				parent::SetXML($row['XML']);
				parent::SetEstado($row['estado']);	
				parent::SetFecha_actualizacion($row['fecha_actualizacion']);			
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteLibros($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from libros where id = '.$id;
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}
		}

		// FUNCION PARA LISTAR REGISTROS 
		function ListarLibros($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM usuarios_libros $path $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
				if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}

		function ListadoLibros($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM libros $path $constrain $order $limit"; 

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
