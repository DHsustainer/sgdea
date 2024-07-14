<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Suscriptores_contactos_direccionE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MSuscriptores_contactos_direccion extends ESuscriptores_contactos_direccion{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetId_contacto("");
				parent::SetDireccion("");
				parent::SetCiudad("");
				parent::SetTelefonos("");
				parent::SetEmail("");
				parent::SetSubnombre("");
				parent::SetFirma("");
				parent::Setnatural_juridica("");
				parent::Setmunicipio("");
				parent::Setdepartamento("");


	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateSuscriptores_contactos_direccion($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from suscriptores_contactos_direccion where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_contacto($row['id_contacto']);
				parent::SetDireccion($row['direccion']);
				parent::SetCiudad($row['ciudad']);
				parent::SetTelefonos($row['telefonos']);
				parent::SetEmail($row['email']);
				parent::SetSubnombre($row['subnombre']);
				parent::SetFirma($row['firma']);
				parent::Setnatural_juridica($row['natural_juridica']);
				parent::Setmunicipio($row['municipio']);
				parent::Setdepartamento($row['departamento']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteSuscriptores_contactos_direccion($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from suscriptores_contactos_direccion where id = '.$id;
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
		function InsertSuscriptores_contactos_direccion($id_contacto, $direccion, $ciudad, $telefonos, $email, $subnombre, $natural_juridica = "Personal Natural", $municipio = "0", $departamento = "0")
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO suscriptores_contactos_direccion (id_contacto, direccion, ciudad, telefonos, email, subnombre, natural_juridica, municipio, departamento) VALUES ('$id_contacto', '$direccion', '$ciudad', '$telefonos', '$email', '$subnombre', '$natural_juridica', '$municipio', '$departamento')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			/*if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				echo '1';
			}*/
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateSuscriptores_contactos_direccion($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE suscriptores_contactos_direccion SET ";
			//HACEMOS UN FOR QUE RECORRA LOS VECTORES DE LOS CAMPOS Y LAS ACTUALIZACIONES PARA ARMAR LA CONSULTA CON CAMPOS FLEXIBLES
			for($i = 0; $i < count($fields); $i++){
				if($i+1 < count($fields)){
					$str .= $fields[$i]. " = '".$updates[$i]."', ";
				}else{
					$str .= $fields[$i]. " = '".$updates[$i]."' ";
				}
			}
			// INGRESAMOS LA CONDICION DE CONSTRAIN (CUIDADO CON ESTO YA QUE NO DEBE IR VACIO NUNCA)
			echo $str .= " $constrain"; 
			
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
		function ListarSuscriptores_contactos_direccion($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM suscriptores_contactos_direccion $path $constrain $order $limit"; 
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