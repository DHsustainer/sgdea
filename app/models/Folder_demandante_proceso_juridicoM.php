<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Folder_demandante_proceso_juridicoE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MFolder_demandante_proceso_juridico extends EFolder_demandante_proceso_juridico{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetId_folder("");
				parent::SetUser_id("");
				parent::SetNom_entidad("");
				parent::SetNit_entidad("");
				parent::SetDir_entidad("");
				parent::SetCiu_entidad("");
				parent::SetP_nom_repres("");
				parent::SetS_nom_repres("");
				parent::SetP_ape_repres("");
				parent::SetS_ape_repres("");
				parent::SetCiu_repres("");
				parent::SetEmail("");
				parent::SetTelefonos("");
				parent::SetCiudad_expedicion("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateFolder_demandante_proceso_juridico($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from folder_demandante_proceso_juridico where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_folder($row['id_folder']);
				parent::SetUser_id($row['user_id']);
				parent::SetNom_entidad($row['nom_entidad']);
				parent::SetNit_entidad($row['nit_entidad']);
				parent::SetDir_entidad($row['dir_entidad']);
				parent::SetCiu_entidad($row['ciu_entidad']);
				parent::SetP_nom_repres($row['p_nom_repres']);
				parent::SetS_nom_repres($row['s_nom_repres']);
				parent::SetP_ape_repres($row['p_ape_repres']);
				parent::SetS_ape_repres($row['s_ape_repres']);
				parent::SetCiu_repres($row['ciu_repres']);
				parent::SetEmail($row['email']);
				parent::SetTelefonos($row['telefonos']);
				parent::SetCiudad_expedicion($row['ciudad_expedicion']);
		}
		function CreateFolder_demandante_proceso_juridicoByUser($constrain)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from folder_demandante_proceso_juridico where $constrain";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_folder($row['id_folder']);
				parent::SetUser_id($row['user_id']);
				parent::SetNom_entidad($row['nom_entidad']);
				parent::SetNit_entidad($row['nit_entidad']);
				parent::SetDir_entidad($row['dir_entidad']);
				parent::SetCiu_entidad($row['ciu_entidad']);
				parent::SetP_nom_repres($row['p_nom_repres']);
				parent::SetS_nom_repres($row['s_nom_repres']);
				parent::SetP_ape_repres($row['p_ape_repres']);
				parent::SetS_ape_repres($row['s_ape_repres']);
				parent::SetCiu_repres($row['ciu_repres']);
				parent::SetEmail($row['email']);
				parent::SetTelefonos($row['telefonos']);
				parent::SetCiudad_expedicion($row['ciudad_expedicion']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteFolder_demandante_proceso_juridico($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from folder_demandante_proceso_juridico where id = '.$id;
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
		function InsertFolder_demandante_proceso_juridico($id_folder, $user_id, $nom_entidad, $nit_entidad, $dir_entidad, $ciu_entidad, $p_nom_repres, $s_nom_repres, $p_ape_repres, $s_ape_repres, $ciu_repres, $email, $telefonos, $ciudad_expedicion)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO folder_demandante_proceso_juridico (id_folder, user_id, nom_entidad, nit_entidad, dir_entidad, ciu_entidad, p_nom_repres, s_nom_repres, p_ape_repres, s_ape_repres, ciu_repres, email, telefonos, ciudad_expedicion) VALUES ('$id_folder', '$user_id', '$nom_entidad', '$nit_entidad', '$dir_entidad', '$ciu_entidad', '$p_nom_repres', '$s_nom_repres', '$p_ape_repres', '$s_ape_repres', '$ciu_repres', '$email', '$telefonos', '$ciudad_expedicion')";
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

		function UpdateFolder_demandante_proceso_juridico($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE folder_demandante_proceso_juridico SET ";
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
		function ListarFolder_demandante_proceso_juridico($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM folder_demandante_proceso_juridico $path $constrain $order $limit"; 
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