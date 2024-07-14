<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Events_gestionE.php');
// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD

	class MEvents_gestion extends EEvents_gestion{

		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
			parent::SetId("");
			parent::SetUser_id("");
			parent::SetGestion_id("");
			parent::SetFecha("");
			parent::SetTitle("");
			parent::SetDescription("");
			parent::SetAdded("");
			parent::SetStatus("");
			parent::SetTime("");
			parent::SetAlerted("");
			parent::SetAvisar_a("");
			parent::SetType_event("");
			parent::SetFecha_vencimiento("");
			parent::Setid_generico("");
			parent::Setseccional("");
			parent::Setoficina("");
			parent::Setarea("");
			parent::Setgrupo("");
			parent::Setelm_type("");
			parent::Setid_ext("");
			parent::Setrealizadopor("");
			parent::Setfecha_realizado("");
			parent::SetEs_publico("");
			parent::Seteses_recordatorio("");
			parent::Settipoalerta("");
		}
	// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){

		}
				// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateEvents_gestion($selector = 'id', $id){
			global $con;

			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 
			$q_str= "select * from events_gestion where $selector = '".$id."'";
						// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);
				// ASIGNAMOS LOS VALORES AL OBJETO
			parent::SetId($row['id']);
			parent::SetUser_id($row['user_id']);
			parent::SetGestion_id($row['gestion_id']);
			parent::SetFecha($row['fecha']);
			parent::SetTitle($row['title']);
			parent::SetDescription($row['description']);
			parent::SetAdded($row['added']);
			parent::SetStatus($row['status']);
			parent::SetTime($row['time']);
			parent::SetAlerted($row['alerted']);
			parent::SetAvisar_a($row['avisar_a']);
			parent::SetType_event($row['type_event']);
			parent::SetFecha_vencimiento($row['fecha_vencimiento']);
			parent::Setid_generico($row['id_generico']);
			parent::Setseccional($row['seccional']);
			parent::Setoficina($row['oficina']);
			parent::Setarea($row['area']);
			parent::Setgrupo($row['grupo']);
			parent::Setelm_type($row['elm_type']);
			parent::Setid_ext($row['id_ext']);
			parent::Setrealizadopor($row['realizadopor']);
			parent::Setfecha_realizado($row['fecha_realizado']);
			parent::SetEs_publico($row['es_publico']);
			parent::Seteses_recordatorio($row['es_recordatorio']);
			parent::Settipoalerta($row['tipoalerta']);
		}
				// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteEvents_gestion($id)
		{
			global $con; 
			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from events_gestion where id = '.$id;
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
		function InsertEvents_gestion($user_id, $gestion_id, $fecha, $title, $description, $added, $status, $time, $alerted, $avisar_a, $type_event, $fecha_vencimiento, $id_generico, $seccional, $oficina, $area, $grupo, $elm_type="A", $id_ext = "0", $es_publico = "0", $es_recordatorio = "0", $tipoalerta = "")
		{
			global $con; 
			global $c;
			global $f;
						// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO events_gestion (user_id, gestion_id, fecha, title, description, added, status, time, alerted, avisar_a, type_event, fecha_vencimiento, id_generico, seccional, oficina, area, grupo, elm_type, id_ext, es_publico, es_recordatorio, tipoalerta) 
				  		VALUES ('$user_id', '$gestion_id', '$fecha', '$title', '$description', '$added', '$status', '$time', '$alerted', '$avisar_a', '$type_event', '$fecha_vencimiento', '$id_generico', '$seccional', '$oficina', '$area', '$grupo', '$elm_type', '$id_ext', '$es_publico', '$es_recordatorio', '$tipoalerta')";
										  			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
			#return $q_str;
			$id_evento = $con->Result($con->Query("select MAX(id) as id from events_gestion"), 0, "id");

			#if ($_SESSION['typefolder'] == "1") {

				if ($grupo == "*") {
					$q = $con->Query("Select * from usuarios where seccional = '".$seccional."' and regimen = '".$area."' and estado = '1' and user_id = '".$user_id."' ");
					#$q = $con->Query("Select * from usuarios where seccional = '".$seccional."' and regimen = '".$area."' and estado = '1' ");
					if($q){
						while ($row = $con->FetchAssoc($q)) {
							/*
							*/
							if ($elm_type == "an") {
								$numy = $con->Result($con->Query("select count(*) as t from alertas where extra = 'rad' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and status = '0'"), 0, 't');

								#if ($numy != "0") {
									# code...
									$numx = $con->Result($con->Query("select count(*) as t from alertas where extra = 'an' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and log = '".$c->GetIdLog($fecha)."'"), 0, 't');
									
									if ($numx <= 0) {
										$con->Query("INSERT INTO alertas (user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".$row['user_id']."', '0', '".$c->GetIdLog($fecha)."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");
									}else{
										$con->Query("update alertas set fechahora = '".date("Y-m-d H:i:s")."' where extra = 'an' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and log = '".$c->GetIdLog($fecha)."'");
									}
								#}
							}else{
								$con->Query("INSERT INTO alertas (user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".$row['user_id']."', '0', '".$c->GetIdLog($fecha)."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");
							}

							if ($elm_type == "dcu") {

								$con->Query("INSERT INTO alertas (fechahora, user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date("Y-m-d H:i:s")."', '".$row['user_id']."', '0', '".$c->GetIdLog($fecha)."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");

							}
						}
					}
				}elseif ($grupo == "areaboss") {
					#$q = $con->Query("Select * from usuarios where seccional = '".$seccional."' and regimen = '".$area."' and estado = '1' and user_id != '".$_SESSION['usuario']."' and IsAdministrador = '1' ");
					$q = $con->Query("Select * from usuarios where seccional = '".$seccional."' and regimen = '".$area."' and estado = '1' and IsAdministrador = '1'  and notif_admin = '1' ");
					if($q){
						while ($row = $con->FetchAssoc($q)) {
							if ($elm_type == "an") {
								$numy = $con->Result($con->Query("select count(*) as t from alertas where extra = 'rad' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and status = '0'"), 0, 't');

								#if ($numy != "0") {
									# code...
									$numx = $con->Result($con->Query("select count(*) as t from alertas where extra = 'an' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and log = '".$c->GetIdLog($fecha)."'"), 0, 't');
									if ($numx <= 0) {
										$con->Query("INSERT INTO alertas (fechahora, user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date("Y-m-d H:i:s")."','".$row['user_id']."', '1', '".$c->GetIdLog($fecha)."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");
									}else{
										$con->Query("update alertas set fechahora = '".date("Y-m-d H:i:s")."' where extra = 'an' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and log = '".$c->GetIdLog($fecha)."'");
									}
								#}
							}else{
								$con->Query("INSERT INTO alertas (fechahora, user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date("Y-m-d H:i:s")."','".$row['user_id']."', '1', '".$c->GetIdLog($fecha)."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");
							}
						}
					}
				}else{
					$q = $con->Query("Select * from usuarios where a_i = '$grupo' or (seccional = '".$seccional."' and regimen = '".$area."' and IsAdministrador = '1' and notif_admin = '1' )");
					if($q){
						while ($row = $con->FetchAssoc($q)) {
							if ($elm_type == "an") {
								$numy = $con->Result($con->Query("select count(*) as t from alertas where extra = 'rad' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and status = '0'"), 0, 't');

								#if ($numy != "0") {
									$numx = $con->Result($con->Query("select count(*) as t from alertas where extra = 'an' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and log = '".$c->GetIdLog($fecha)."'"), 0, 't');
									if ($numx <= 0) {
										$con->Query("INSERT INTO alertas (fechahora, user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date("Y-m-d H:i:s")."','".$row['user_id']."', '1', '".$c->GetIdLog($fecha)."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");
									}else{
										$con->Query("update alertas set fechahora = '".date("Y-m-d H:i:s")."' where extra = 'an' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and log = '".$c->GetIdLog($fecha)."'");
									}
								#}

							}else{
								$con->Query("INSERT INTO alertas (fechahora, user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date("Y-m-d H:i:s")."','".$row['user_id']."', '1', '".$c->GetIdLog($fecha)."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");
							}
						}
					}
				}
				if ($grupo == "areaboss" || $grupo == "*") {
					$cou = $con->Result($con->Query("select count(*) as t from gestion_compartir where gestion_id = '$gestion_id'"), 0, 't');
					if ($cou >= 1) {
						$q = $con->Query("Select * from gestion_compartir where gestion_id = '".$gestion_id."'");
						if($q){
							while ($row = $con->FetchAssoc($q)) {
								if ($elm_type == "an") {

								$numy = $con->Result($con->Query("select count(*) as t from alertas where extra = 'rad' and id_gestion = '$gestion_id' and user_id = '".$row['user_id']."' and status = '0'"), 0, 't');

								#if ($numy != "0") {
										$numx = $con->Result($con->Query("select count(*) as t from alertas where extra = 'an' and id_gestion = '$gestion_id' and user_id = '".$row['usuario_nuevo']."' and log = '".$c->GetIdLog($fecha)."'"), 0, 't');
										if ($numx <= 0) {
											$con->Query("INSERT INTO alertas (fechahora, user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date("Y-m-d H:i:s")."','".$row['usuario_nuevo']."', '0', '".$c->GetIdLog($fecha)."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");
										}else{
											$con->Query("update alertas set fechahora = '".date("Y-m-d H:i:s")."' where extra = 'an' and id_gestion = '$gestion_id' and user_id = '".$row['usuario_nuevo']."' and log = '".$c->GetIdLog($fecha)."'");
										}
									}else{
											$con->Query("INSERT INTO alertas (fechahora, user_id, type, log, status, extra, id_gestion, id_act, id_evento) VALUES ('".date("Y-m-d H:i:s")."','".$row['usuario_nuevo']."', '0', '".$c->GetIdLog($fecha)."', '0', '$elm_type', '$gestion_id', '$id_ext', '$id_evento')");
									}
								#}
							}
						}
					}
				}
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
						/*if (!$query) {
					echo 'Invalid query: '.$con->Error($query);
				}else{
					echo "1";
				}*/
		} 
		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS
 		function UpdateEvents_gestion($constrain, $fields, $updates, $output){
			global $con;
			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			 $str = "UPDATE events_gestion SET ";
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
		function ListarEvents_gestion($constrain = '', $order = 'order by id',   $limit = 'limit 1000'){
			global $con;
			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM events_gestion $path $constrain $order $limit"; 
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