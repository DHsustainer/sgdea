<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Meta_referencias_camposE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MMeta_referencias_campos extends EMeta_referencias_campos{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetId_referencia("");
				parent::SetTitulo_campo("");
				parent::SetTipo_elemento("");
				parent::SetObservacion("");
				parent::SetVisible("");
				parent::SetEs_obligatorio("");
				parent::SetId_lista("");
				parent::SetPlaceHolder("");
				parent::SetColumnas("");
				parent::SetOrden("");
				parent::SetSlug("");
				parent::SetValor_generico("");
				parent::SetValidar("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateMeta_referencias_campos($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from meta_referencias_campos where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_referencia($row['id_referencia']);
				parent::SetTitulo_campo($row['titulo_campo']);
				parent::SetTipo_elemento($row['tipo_elemento']);
				parent::SetObservacion($row['observacion']);
				parent::SetVisible($row['visible']);
				parent::SetEs_obligatorio($row['es_obligatorio']);
				parent::SetId_lista($row['id_lista']);
				parent::SetPlaceHolder($row['placeholder']);
				parent::SetColumnas($row['columnas']);
				parent::SetOrden($row['orden']);
				parent::SetSlug($row['slug']);
				parent::SetValor_generico($row['valor_generico']);
				parent::SetValidar($row['validar']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteMeta_referencias_campos($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from meta_referencias_campos where id = '.$id;
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
		function InsertMeta_referencias_campos($id_referencia, $titulo_campo, $tipo_elemento, $observacion, $visible, $es_obligatorio, $id_lista, $placeholder, $columnas, $valor_generico, $validar)
		{
			global $con; 

			$mint = strtolower($titulo_campo);
			$b=array(" ", "\'","'","&OACUTE",",",";","&OACUTE","&oacute","&Oacute","&eacute","&Eacute","&EACUTE","&AACUTE","&Aacute","&Eacute","&ntilde","&Iacute","&QUOT;","&quot;","&#8216;","&8216;","º",'Ã','Á','á','É','é','Í','í','Ó','ó','Ñ','ñ','Ú','ú','ü','Ü','"',"'","`","´","‘","’","“","”","„","&NTILDE","&iacute","Ã","ƒ","˜","â","€","&#8216;", "\t", "\n");

			$c=array("_", "", "" ,"o" ,"" ,"" ,"o","o","o","e","e","e","a","a","e","n","i","","","","","","","a","a","e","e","i","i","o","o","n","n","u","u","u","u",'',"",'',"","","","","",",","n","i","","","","","","","","");
			
			$slug=str_replace($b,$c,$mint);

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO meta_referencias_campos (id_referencia, titulo_campo, tipo_elemento, observacion, visible, es_obligatorio, id_lista, placeholder, columnas, slug, valor_generico, orden, validar) VALUES ('$id_referencia', '$titulo_campo', '$tipo_elemento', '$observacion', '$visible', '$es_obligatorio', '$id_lista', '$placeholder', '$columnas', '$slug', '$valor_generico', '9999', '$validar')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query).$q_str;
			}else{
				echo '1';
			}
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateMeta_referencias_campos($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE meta_referencias_campos SET ";
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
		function ListarMeta_referencias_campos($constrain = '', $order = 'order by orden',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM meta_referencias_campos $path $constrain $order $limit"; 
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