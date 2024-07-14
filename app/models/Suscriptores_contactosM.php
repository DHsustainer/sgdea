<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Suscriptores_contactosE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MSuscriptores_contactos extends ESuscriptores_contactos{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetIdentificacion("");
				parent::SetNombre("");
				parent::SetType("");
				parent::SetUser_id("");
				parent::SetFecha("");
				parent::Setcod_ingreso("");
				parent::Setpassword("");
				parent::Setestado("");
				parent::Setdec_pass("");
				parent::Setdependencia("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateSuscriptores_contactos($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from suscriptores_contactos where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetIdentificacion($row['identificacion']);
				parent::SetNombre($row['nombre']);
				parent::SetType($row['type']);
				parent::SetUser_id($row['user_id']);
				parent::SetFecha($row['fecha']);
				parent::Setcod_ingreso($row['cod_ingreso']);
				parent::Setpassword($row['password']);
				parent::Setestado($row['estado']);
				parent::Setdec_pass($row['dec_pass']);
				parent::Setdependencia($row['dependencia']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteSuscriptores_contactos($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from suscriptores_contactos where id = '.$id;
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
		function InsertSuscriptores_contactos($identificacion, $nombre, $type, $user_id, $fecha, $dependencia = '0')
		{
			global $con; 
			global $f;
			global $c; 

			$m = new MUsuarios;
			$m->CreateUsuarios("user_id", $_SESSION['usuario']);
			
			if ($identificacion == "") {
				# code...
				#$idx = $f->zerofill($m->GetA_i(), 4);
				$fid = $c->GetMaxIdTabla("suscriptores_contactos", "id");
				$fid = $fid+1;
				$fid = $f->zerofill($fid, 4);
				$idx .= $fid.rand(0, 99999);
			}else{

				$exists = $c->GetDataFromTable("suscriptores_contactos", "identificacion", $identificacion, "nombre", $separador = " ");
				if ($exists == "") {
					$idx = $identificacion;
				}else{
					#$idx = $f->zerofill($m->GetA_i(), 4);
					$fid = $c->GetMaxIdTabla("suscriptores_contactos", "id");
					$fid = $fid+1;
					$fid = $f->zerofill($fid, 4);
					$idx .= $fid.rand(0, 99999);
				}
			}


			$password = $f->GenerarSmallId();
			$mdp = md5($password);
			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO suscriptores_contactos (identificacion, nombre, type, user_id, fecha, cod_ingreso, password, estado, dec_pass, dependencia) VALUES ('$identificacion', '$nombre', '$type', '$user_id', '$fecha', '$idx', '$mdp', '1', '$password', '$dependencia')";
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

		function UpdateSuscriptores_contactos($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE suscriptores_contactos SET ";
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
				return $output[0];
			}
		}

		// FUNCION PARA LISTAR REGISTROS 
		function ListarSuscriptores_contactos($constrain = '', $order = 'order by id',   $limit = '')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM suscriptores_contactos $path $constrain $order $limit"; 
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