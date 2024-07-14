<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Folder_ciudadanoE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MFolder_ciudadano extends EFolder_ciudadano{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id("");
				parent::SetTitulo("");
				parent::SetFecha("");
				parent::SetType("");
				parent::SetEstado("");
				parent::SetUser_2("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateFolder_ciudadano($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from folder_ciudadano where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetTitulo($row['titulo']);
				parent::SetFecha($row['fecha']);
				parent::SetType($row['type']);
				parent::SetEstado($row['estado']);
				parent::SetUser_2($row['user_2']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteFolder_ciudadano($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from folder_ciudadano where id = '.$id;
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return '1';
			}
		}
function GetMaxIdTabla($tbl_name, $field){
	global $con;

	$str = "SELECT MAX(".$field.") as mx FROM ".$tbl_name;

	$query = $con->Query($str);
	
	return $con->Result($query, 0, 'mx');
}
		// FUNCION QUE INSERTA UN REGISTRO EN LA BASE DE DATOS
		function InsertFolder_ciudadano($user_id, $titulo, $fecha, $type, $estado, $user_2)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO folder_ciudadano (user_id, titulo, fecha, type, estado, user_2) VALUES ('$user_id', '$titulo', '$fecha', '$type', '$estado', '$user_2')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 


			$this->Insert_Event('0',
								'Creacion de Carpeta',
								$this->sql_quote("Se ha creado la carpeta ".strip_tags($titulo)."  <a href='".HOMEDIR.DS."folder_ciudadano/ver/".$this->GetMaxIdTabla("folder_ciudadano", "id")."/'>Ver Carpeta </a>"),
								'1',
								'1');

			$this->InsertarAlerta($user_id, '18', $this->GetMaxIdTabla("folder_ciudadano", "id"));

			if($user_id_2 != ""){

				$this->Insert_Event('0',
									'Creacion de Carpeta',
									$this->sql_quote("Se ha creado la carpeta ".strip_tags($titulo)."  <a href='".HOMEDIR.DS."folder_ciudadano/ver/".$this->GetMaxIdTabla("folder_ciudadano", "id")."/'>Ver Carpeta </a>"),
									'1',
									'1',
									'0', 
									$user_id_2
								);			
				$this->InsertarAlerta($user_id_2, '18', $this->GetMaxIdTabla("folder_ciudadano", "id"));
			}

			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return mysql_insert_id();
			}
		} 

function sql_quote($value){
	if(get_magic_quotes_gpc())
	$value = stripslashes($value);
   
	if(function_exists('mysql_real_escape_string'))
		$value = mysql_real_escape_string( $value );
	else //for PHP version <4.3.0 use addslashes
		$value = addslashes( $value );
	
	$value = $this->Reemplazo($value);

	return $value;
}
  	//funcion para filtrar caracteres especiales para el motor de busquedas
function Reemplazo ($temp) {
	$b=array('Á','á','É','é','Í','í','Ó','ó','Ñ','ñ','Ú','ú','ü','Ü');
	$c=array("&Aacute;","&aacute;","&Eacute;","&eacute;","&Iacute;","&iacute;","&Oacute;","&oacute;","&Ntilde;","&ntilde;","&Uacute;","&uacute;","&uuml;","&Uuml;");
	$temp=str_replace($b,$c,$temp);
	return $temp;
}


function crearLog(){
	global $con;
	$qr = "INSERT INTO log (fecha) VALUES ('".date('Y-m-d')."')";
	$query = $con->Query($qr,'insert');
	
	if($query){
		return "success";
	}else{
		return "Error";
	}
}
function consultarlog(){

	global $con;
    $query = "select max(id) as max from log";
    $response = $con->Query($query);

	$row = $con->FetchAssoc($response);
    $valor = $row['max'];


    return $valor;

}

function InsertarAlerta($usuario, $type, $extra){

		$alog = $this->consultarlog();
	
		$q_str = "insert into alertas (fechahora, user_id, type, log, status, extra) values('".date("Y-m-d H:i:s")."','$usuario','$type','$alog', '0', '$extra')";

		$query = $con->Query($q_str);
	if($query){
		return true;
	}
	else{
		return false;
	}
}

function Insert_Event($id,$title,$description,$status,$echo,$color = "0", $usuario=''){
	global $con;
	
	if ($_SESSION[usuario] == $usuario || $usuario == "") {
		$usuario = $_SESSION[usuario];
	}
	
	$this->crearLog();
	$date=$this->consultarlog();		
	$time=date('H:i:s');
	$con->Query("INSERT INTO events (user_id,proceso_id,title,description,date,added,status,time,echo, deadline)
				values ('$usuario','$id','$title','$description','$date','$date','$status','$time','$echo','$color')");

}

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateFolder_ciudadano($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE folder_ciudadano SET ";
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
		function ListarFolder_ciudadano($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM folder_ciudadano $path $constrain $order $limit"; 
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