<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Dependencias_tipologiasE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MDependencias_tipologias extends EDependencias_tipologias{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetId_dependencia("");
				parent::SetUsuario("");
				parent::SetFecha("");
				parent::SetTipologia("");
				parent::SetRequiere_firma("");
				parent::SetInmaterial("");
				parent::SetObligatorio("");
				parent::SetEntrada("");
				parent::SetEs_publico("");
				parent::SetObservacion("");
				parent::SetFormato("");
				parent::SetPrioridad("");
				parent::SetDias_vencimiento("");
				parent::SetSoporte("");
				parent::Setid_clon("");
				parent::Setid_asociada("");
				parent::Setweb_default("");
				parent::Setorden("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateDependencias_tipologias($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from dependencias_tipologias where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_dependencia($row['id_dependencia']);
				parent::SetUsuario($row['usuario']);
				parent::SetFecha($row['fecha']);
				parent::SetTipologia($row['tipologia']);
				parent::SetRequiere_firma($row['requiere_firma']);
				parent::SetInmaterial($row['es_inmaterial']);
				parent::SetObligatorio($row['es_obligatorio']);
				parent::SetEntrada($row['es_entrada']);
				parent::SetEs_publico($row['es_publico']);
				parent::SetObservacion($row['observacion']);
				parent::SetFormato($row['formato']);
				parent::SetPrioridad($row['prioridad']);
				parent::SetDias_vencimiento($row['dias_vencimiento']);
				parent::SetSoporte($row['soporte']);
				parent::Setid_clon($row['id_clon']);
				parent::Setid_asociada($row['id_asociada']);
				parent::Setweb_default($row['web_default']);
				parent::Setorden($row['orden']);

		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteDependencias_tipologias($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from dependencias_tipologias where id = '.$id;
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
		function InsertDependencias_tipologias($id_dependencia, $usuario, $fecha, $tipologia, $requiere_firma, $inm = "0", $es_obligatorio = "", $es_entrada = "", $es_publico = "", $observacion = "", $formato = "", $prioridad = "", $dias_vencimiento = "0", $soporte = "0")
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO dependencias_tipologias (id_dependencia, usuario, fecha, tipologia, estado, requiere_firma, es_inmaterial, es_obligatorio, es_entrada, es_publico, observacion, formato, prioridad, dias_vencimiento, soporte) VALUES ('$id_dependencia', '$usuario', '$fecha', '$tipologia', '1', '$requiere_firma', '$inm', '$es_obligatorio', '$es_entrada', '$es_publico', '$observacion', '$formato', '$prioridad', '$dias_vencimiento', '$soporte')";
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

		function UpdateDependencias_tipologias($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE dependencias_tipologias SET ";
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
		function ListarDependencias_tipologias($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM dependencias_tipologias $path $constrain $order $limit"; 
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