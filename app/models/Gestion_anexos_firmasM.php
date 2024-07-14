<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Gestion_anexos_firmasE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MGestion_anexos_firmas extends EGestion_anexos_firmas{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetGestion_id("");
				parent::SetAnexo_id("");
				parent::SetTipologia_id("");
				parent::SetFecha_solicitud("");
				parent::SetUsuario_solicita("");
				parent::SetUsuario_firma("");
				parent::SetFecha_firma("");
				parent::SetCodigo_firma("");
				parent::SetClave_primaria("");
				parent::SetEstado_firma("");
				parent::SetRepo_1("");
				parent::SetRepo_2("");
				parent::Setfirma_crt("");
				parent::Setip("");
				parent::Setcod_alt("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateGestion_anexos_firmas($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from gestion_anexos_firmas where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			if($query){
				//OBTENEMOS EL RESULTADO DE LA CONSULTA
				$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetGestion_id($row['gestion_id']);
				parent::SetAnexo_id($row['anexo_id']);
				parent::SetTipologia_id($row['tipologia_id']);
				parent::SetFecha_solicitud($row['fecha_solicitud']);
				parent::SetUsuario_solicita($row['usuario_solicita']);
				parent::SetUsuario_firma($row['usuario_firma']);
				parent::SetFecha_firma($row['fecha_firma']);
				parent::SetCodigo_firma($row['codigo_firma']);
				parent::SetClave_primaria($row['clave_primaria']);
				parent::SetEstado_firma($row['estado_firma']);
				parent::SetRepo_1($row['repo_1']);
				parent::SetRepo_2($row['repo_2']);
				parent::Setfirma_crt($row['firma_crt']);
				parent::Setip($row['ip']);
				parent::Setcod_alt($row['cod_alt']);
			}

		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteGestion_anexos_firmas($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from gestion_anexos_firmas where id = '.$id;
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
		function InsertGestion_anexos_firmas($gestion_id, $anexo_id, $tipologia_id, $fecha_solicitud, $usuario_solicita, $usuario_firma, $fecha_firma, $codigo_firma, $clave_primaria, $estado_firma, $repo_1, $repo_2)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO gestion_anexos_firmas (gestion_id, anexo_id, tipologia_id, fecha_solicitud, usuario_solicita, usuario_firma, fecha_firma, codigo_firma, clave_primaria, estado_firma, repo_1, repo_2) VALUES ('$gestion_id', '$anexo_id', '$tipologia_id', '$fecha_solicitud', '$usuario_solicita', '$usuario_firma', '$fecha_firma', '$codigo_firma', '$clave_primaria', '$estado_firma', '$repo_1', '$repo_2')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			/*if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				echo '';
			}*/
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateGestion_anexos_firmas($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE gestion_anexos_firmas SET ";
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
			#echo $str;
			// EJECUTAMOS LA CONSULTA UNA VEZ ESTE CONSTRUIDA
			$query = $con->Query($str); 
 
		
			//VERIFICAMOS SI SE EJECUTO CORRECTAMENTE	
			if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $output[0];
			}
		}

		// FUNCION PARA LISTAR REGISTROS 
		function ListarGestion_anexos_firmas($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM gestion_anexos_firmas $path $constrain $order $limit"; 
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