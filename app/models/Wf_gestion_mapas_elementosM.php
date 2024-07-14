<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Wf_gestion_mapas_elementosE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MWf_gestion_mapas_elementos extends EWf_gestion_mapas_elementos{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_mapa("");
				parent::SetId_elemento("");
				parent::SetTitulo("");
				parent::SetFecha("");
				parent::SetUsuario("");
				parent::SetId_evento("");
				parent::SetId_dependencia("");
				parent::SetId_mapas_elementos("");
				parent::SetEstado("");
				parent::SetTitulo_conector("");
				parent::SetId_elemento_mapa_elemento("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateWf_gestion_mapas_elementos($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from wf_gestion_mapas_elementos where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_mapa($row['id_mapa']);
				parent::SetId_elemento($row['id_elemento']);
				parent::SetTitulo($row['titulo']);
				parent::SetFecha($row['fecha']);
				parent::SetUsuario($row['usuario']);
				parent::SetId_evento($row['id_evento']);
				parent::SetId_dependencia($row['id_dependencia']);
				parent::SetId_mapas_elementos($row['id_mapas_elementos']);
				parent::SetEstado($row['estado']);
				parent::SetTitulo_conector($row['titulo_conector']);
				parent::SetId_elemento_mapa_elemento($row['id_elemento_mapa_elemento']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteWf_gestion_mapas_elementos($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from wf_gestion_mapas_elementos where id = '.$id;
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
		function InsertWf_gestion_mapas_elementos($id_mapa, $id_elemento, $titulo, $fecha, $usuario, $id_evento, $id_dependencia, $id_mapas_elementos, $estado, $titulo_conector, $id_gestion, $id_elemento_mapa_elemento)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO wf_gestion_mapas_elementos (id_mapa, id_elemento, titulo, fecha, usuario, id_evento, id_dependencia, id_mapas_elementos, estado, titulo_conector, id_gestion, id_elemento_mapa_elemento) VALUES ('$id_mapa', '$id_elemento', '$titulo', '".date("Y-m-d H:i:s")."',  '$usuario', '$id_evento', '$id_dependencia', '$id_mapas_elementos', '$estado', '$titulo_conector', '$id_gestion', '$id_elemento_mapa_elemento')";
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

		function UpdateWf_gestion_mapas_elementos($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE wf_gestion_mapas_elementos SET ";
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
			
			echo $str;
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
		function ListarWf_gestion_mapas_elementos($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM wf_gestion_mapas_elementos $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			#echo $q_str;
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