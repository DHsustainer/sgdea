<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Ws_keysE.php');



// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD

	class MWs_keys extends EWs_keys{

		

		// CREAMOS EL CONSTRUCTOR DE LA CLASE

		function __construct()

		{				// ASIGNAMOS LOS VALORES AL OBJETO

				parent::SetId("");

				parent::SetLlave("");

				parent::SetEstado("");

				parent::SetFecha("");

				parent::SetDepartamento("");

				parent::SetCiudad("");

				parent::SetOficina("");

				parent::SetArea("");

				parent::SetUsuario_destino("");

				parent::SetSerie("");

				parent::SetSubserie("");

				parent::SetIpkey("");

				parent::SetTipokey("");

				parent::SetUsuario("");

				parent::SetNombre("");

				parent::SetFormulario("");

		}



		// CREAMOS EL DESTRUCTOR DE LA CLASE

		function __destruct(){

		}



		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 

		function CreateWs_keys($selector = 'id', $id)

		{

			global $con;

			

			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 



			$q_str= "select * from ws_keys where $selector = '".$id."'";

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str);

			//OBTENEMOS EL RESULTADO DE LA CONSULTA

			$row = $con->FetchAssoc($query);



				// ASIGNAMOS LOS VALORES AL OBJETO

				parent::SetId($row['id']);

				parent::SetLlave($row['llave']);

				parent::SetEstado($row['estado']);

				parent::SetFecha($row['fecha']);

				parent::SetDepartamento($row['departamento']);

				parent::SetCiudad($row['ciudad']);

				parent::SetOficina($row['oficina']);

				parent::SetArea($row['area']);

				parent::SetUsuario_destino($row['usuario_destino']);

				parent::SetSerie($row['serie']);

				parent::SetSubserie($row['subserie']);

				parent::SetIpkey($row['ipkey']);

				parent::SetTipokey($row['tipokey']);

				parent::SetUsuario($row['usuario']);

				parent::SetNombre($row['nombre']);

				parent::SetFormulario($row['formulario']);

		}



		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS

		function DeleteWs_keys($id)

		{

			global $con; 



			// DEFINIMOS LA CONSULTA

			$q_str= 'delete from ws_keys where id = '.$id;

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

		function InsertWs_keys($llave, $estado, $fecha, $departamento, $ciudad, $oficina, $area, $usuario_destino, $serie, $subserie, $ipkey, $tipokey, $usuario, $nombre, $formulario)

		{

			global $con; 

			// DEFINIMOS LA CONSULTA		

			$q_str = "INSERT INTO ws_keys (llave, estado, fecha, departamento, ciudad, oficina, area, usuario_destino, serie, subserie, ipkey, tipokey, usuario, nombre, formulario) VALUES ('$llave', '$estado', '$fecha', '$departamento', '$ciudad', '$oficina', '$area', '$usuario_destino', '$serie', '$subserie', '$ipkey', '$tipokey', '$usuario', '$nombre', '$formulario')";

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str); 

	

			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE

			if (!$query) {

				return 'Invalid query: '.$con->Error($query)." :: ".$q_str;

			}else{

				return '1';

			}

		} 



		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS



		function UpdateWs_keys($constrain, $fields, $updates, $output)

		{

			global $con;



			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA

			$str = "UPDATE ws_keys SET ";

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

		function ListarWs_keys($constrain = '', $order = 'order by id',   $limit = 'limit 1000')

		{

			global $con;



			// DEFINIMOS LA CONSULTA

			$q_str = "SELECT * FROM ws_keys $path $constrain $order $limit"; 

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