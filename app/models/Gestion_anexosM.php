<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Gestion_anexosE.php');
// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
class MGestion_anexos extends EGestion_anexos{

	// CREAMOS EL CONSTRUCTOR DE LA CLASE
	function __construct()
	{				// ASIGNAMOS LOS VALORES AL OBJETO
		parent::SetId("");
		parent::SetGestion_id("");
		parent::SetNombre("");
		parent::SetUrl("");
		parent::SetUser_id("");
		parent::SetFecha("");
		parent::SetHora("");
		parent::SetIp("");
		parent::SetTimest("");
		parent::SetEstado("");
		parent::SetFolio("");
		parent::SetFolder_id("");
		parent::SetTipologia("");
		parent::SetIs_publico("");
		parent::SetFolio_final("");				
		parent::Setcantidad("");
		parent::Setorden("");
		parent::Setorigen("");
		parent::Sethash("");
		parent::Setbase_file("");
		parent::SetTypefile("");
		parent::SetPeso("");
		parent::SetIndice("");
		parent::SetIn_out("");
		parent::SetSoporte("");
		parent::SetObservacion("");
		parent::SetProductor("");
	}

	// CREAMOS EL DESTRUCTOR DE LA CLASE
	function __destruct(){
		}
	// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
			function CreateGestion_anexos($selector = 'id', $id)
	{
			global $con;

			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 
			$q_str= "select * from gestion_anexos where $selector = '".$id."'";
						// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			if($query){
					//OBTENEMOS EL RESULTADO DE LA CONSULTA
					$row = $con->FetchAssoc($query);
					// ASIGNAMOS LOS VALORES AL OBJETO
					parent::SetId($row['id']);
					parent::SetGestion_id($row['gestion_id']);
					parent::SetNombre($row['nombre']);
					parent::SetUrl($row['url']);
					parent::SetUser_id($row['user_id']);
					parent::SetFecha($row['fecha']);
					parent::SetHora($row['hora']);
					parent::SetIp($row['ip']);
					parent::SetTimest($row['timest']);
					parent::SetEstado($row['estado']);
					parent::SetFolio($row['folio']);
					parent::SetFolder_id($row['folder_id']);
					parent::SetTipologia($row['tipologia']);
					parent::SetIs_publico($row['is_publico']);
					parent::SetFolio_final($row['folio_final']);
					parent::Setcantidad($row['cantidad']);
					parent::Setorden($row['orden']);
					parent::Setorigen($row['origen']);
					parent::Sethash($row['hash']);
					parent::Setbase_file($row['base_file']);
					parent::SetTypefile($row['typefile']);
					parent::SetPeso($row['peso']);
					parent::SetIndice($row['indice']);
					parent::SetIn_out($row['in_out']);
					parent::SetSoporte($row['soporte']);
					parent::SetObservacion($row['observacion']);
					parent::SetProductor($row['productor']);

				}
		}
	// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
			function DeleteGestion_anexos($id)
	{
			global $con; 
			// DEFINIMOS LA CONSULTA
						$q_str= 'delete from gestion_anexos where id = '.$id;
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
			function InsertGestion_anexos($gestion_id, $nombre, $url, $user_id, $fecha, $hora, $ip, $timest, $estado, $folio, $folio_final, $cantidad = "1", $tipo = "0", $in_out = "0", $id_externo = "0", $soporte = "2")
	{
			global $con; 
			$hash = hash("sha256", $nombre.$url.$user_id.$fecha.$hora.$ip);
			//base 64

			$ordenq  = $con->Query("select count(*) as max from gestion_anexos WHERE gestion_id = '".$gestion_id."' and folder_id = '".$_SESSION["folder_exp"]."'");
			$orden = $con->Result($ordenq, 0, "max");
			$orden += 1;


			$base_file = '';
			$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$url);
			$base_file = base64_encode($data_base_file);
			$backupname=UPLOADS.DS.$gestion_id.'/backup';
			
			if (!file_exists($backupname)) {
			    mkdir(UPLOADS.DS . $gestion_id.'/backup', 0777);
			}
			$rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);
			$textname = $rand.".txt";

			$file = fopen(UPLOADS.DS.$gestion_id.'/backup/'.$textname, "w");
			fwrite($file, $base_file . PHP_EOL);
			fclose($file);
			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO gestion_anexos (timest, gestion_id, nombre, url, user_id, fecha, hora, ip, estado, folio, folio_final, hash, base_file, cantidad, tipologia, in_out, id_servicio, indice, soporte, is_publico) VALUES ('".date("Y-m-d H:i:s")."', '$gestion_id', '$nombre', '$url', '$user_id', '$fecha', '$hora', '$ip','$estado', '$folio', '$folio_final', '$hash', '$textname', '$cantidad', '$tipo', '$in_out', '$id_externo', '$orden', '$soporte', '".DOCUMENTOPUBLICO."')";
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
		function UpdateGestion_anexos($constrain, $fields, $updates, $output)
				{
			global $con;
			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			 			$str = "UPDATE gestion_anexos SET ";
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
					return $query[0];
				}
		}
	// FUNCION PARA LISTAR REGISTROS 
			function ListarGestion_anexos($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
	{
			global $con;
			// DEFINIMOS LA CONSULTA
						$q_str = "SELECT * FROM gestion_anexos $path $constrain $order $limit"; 
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