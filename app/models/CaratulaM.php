<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'CaratulaE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MCaratula extends ECaratula{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetUser_id("");
				parent::SetProceso_id("");
				parent::SetTip_demanda("");
				parent::SetJuzgado("");
				parent::SetRad("");
				parent::SetDir_juz("");
				parent::SetTel_juz("");
				parent::SetEmail_juz("");
				parent::SetEst_proceso("");
				parent::SetTit_demanda("");
				parent::SetFec_pres("");
				parent::SetVal_demanda("");
				parent::SetTipo_demandante("");
				parent::SetFec_auto("");
				parent::SetNum_oficio("");
				parent::SetContenido("");
				parent::SetCostas("");
				parent::SetEdit_juz("");
				parent::SetTracking("");
				parent::SetRad_completo("");
				parent::SetFecha_creacion("");
				parent::SetType_proceso("");
				parent::SetUsuario_registra("");
				parent::SetFolder_id("");
				parent::SetFecha_actualizacion("");
				parent::SetCiudad("");
				parent::SetDepartamento("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateCaratula($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from caratula where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetProceso_id($row['proceso_id']);
				parent::SetTip_demanda($row['tip_demanda']);
				parent::SetJuzgado($row['juzgado']);
				parent::SetRad($row['rad']);
				parent::SetDir_juz($row['dir_juz']);
				parent::SetTel_juz($row['tel_juz']);
				parent::SetEmail_juz($row['email_juz']);
				parent::SetEst_proceso($row['est_proceso']);
				parent::SetTit_demanda($row['tit_demanda']);
				parent::SetFec_pres($row['fec_pres']);
				parent::SetVal_demanda($row['val_demanda']);
				parent::SetTipo_demandante($row['tipo_demandante']);
				parent::SetFec_auto($row['fec_auto']);
				parent::SetNum_oficio($row['num_oficio']);
				parent::SetContenido($row['contenido']);
				parent::SetCostas($row['costas']);
				parent::SetEdit_juz($row['edit_juz']);
				parent::SetTracking($row['tracking']);
				parent::SetRad_completo($row['rad_completo']);
				parent::SetFecha_creacion($row['fecha_creacion']);
				parent::SetType_proceso($row['type_proceso']);
				parent::SetUsuario_registra($row['usuario_registra']);
				parent::SetFecha_actualizacion($row['fecha_actualizacion']);
				parent::SetCiudad($row['ciudad']);
				parent::SetDepartamento($row['departamento']);

			$id = $row["proceso_id"];
			$q = $con->FetchAssoc($con->Query("SELECT * FROM folder_demanda WHERE user_id = '".$_SESSION["usuario"]."' AND proceso_id = '".$id."' "));

				parent::SetFolder_id($q['folder_id']);				
		}

		function CreateCaratula_by_Proceso($constrain)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from caratula where $constrain";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetProceso_id($row['proceso_id']);
				parent::SetTip_demanda($row['tip_demanda']);
				parent::SetJuzgado($row['juzgado']);
				parent::SetRad($row['rad']);
				parent::SetDir_juz($row['dir_juz']);
				parent::SetTel_juz($row['tel_juz']);
				parent::SetEmail_juz($row['email_juz']);
				parent::SetEst_proceso($row['est_proceso']);
				parent::SetTit_demanda($row['tit_demanda']);
				parent::SetFec_pres($row['fec_pres']);
				parent::SetVal_demanda($row['val_demanda']);
				parent::SetTipo_demandante($row['tipo_demandante']);
				parent::SetFec_auto($row['fec_auto']);
				parent::SetNum_oficio($row['num_oficio']);
				parent::SetContenido($row['contenido']);
				parent::SetCostas($row['costas']);
				parent::SetEdit_juz($row['edit_juz']);
				parent::SetTracking($row['tracking']);
				parent::SetRad_completo($row['rad_completo']);
				parent::SetFecha_creacion($row['fecha_creacion']);
				parent::SetType_proceso($row['type_proceso']);
				parent::SetUsuario_registra($row['usuario_registra']);
				parent::SetFecha_actualizacion($row['fecha_actualizacion']);
				parent::SetCiudad($row['ciudad']);
				parent::SetDepartamento($row['departamento']);

			$id = $row["proceso_id"];
			$q = $con->FetchAssoc($con->Query("SELECT * FROM folder_demanda WHERE user_id = '".$_SESSION["usuario"]."' AND proceso_id = '".$id."' "));

				parent::SetFolder_id($q['folder_id']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteCaratula($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from caratula where id = '.$id;
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
		function InsertCaratula($user_id, $proceso_id, $tip_demanda, $juzgado, $rad, $dir_juz, $tel_juz, $email_juz, $est_proceso, $tit_demanda, $fec_pres, $val_demanda, $tipo_demandante, $fec_auto, $num_oficio, $contenido, $costas, $edit_juz, $tracking, $rad_completo, $fecha_creacion, $type_proceso, $usuario_registra)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO caratula (user_id, proceso_id, tip_demanda, juzgado, rad, dir_juz, tel_juz, email_juz, est_proceso, tit_demanda, fec_pres, val_demanda, tipo_demandante, fec_auto, num_oficio, contenido, costas, edit_juz, tracking, rad_completo, fecha_creacion, type_proceso, usuario_registra) VALUES ('$user_id', '$proceso_id', '$tip_demanda', '$juzgado', '$rad', '$dir_juz', '$tel_juz', '$email_juz', 'ACTIVO', '$tit_demanda', '$fec_pres', '$val_demanda', '$tipo_demandante', '$fec_auto', '$num_oficio', '$contenido', '$costas', '$edit_juz', '$tracking', '$rad_completo', '$fecha_creacion', '$type_proceso', '$usuario_registra')";
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

		function UpdateCaratula($constrain, $fields, $updates, $output)
		{
			global $con;
			$query = $con->Query("SELECT * caratula where num_oficio = $updates[8]");
			if ($con->NumRows($query)==0) {
				$str = "UPDATE caratula SET ";			
				for($i = 0; $i < count($fields); $i++){
					if($i+1 < count($fields)){
						$str .= $fields[$i]. " = '".$updates[$i]."', ";
					}else{
						$str .= $fields[$i]. " = '".$updates[$i]."' ";
					}
				}			
				$str .= " $constrain"; 
				$query = $con->Query($str);
				#return "SELECT * caratula where num_oficio = $updates[8]";
			}else{
				return "Número de Consignación ya ingresado";
			}		
		}

		// FUNCION PARA LISTAR REGISTROS 
		function ListarCaratula($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT *,fd.proceso_id as id_fd,c.id as id_p FROM caratula $path $constrain $order $limit"; 

			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			#echo $q_str;
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
				if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function Create_Lista($query,$type, $estado = "ACTIVO"){
			global $con;
			while ($col=$con->FetchArray($query)) {
				if ($col["est_proceso"] == $estado) {
					$result.=$this->Pain_Proces($col,$type);
				}
			}
			return $result;

		}
		function Pain_Proces($col,$type){

			global $con;
			$display=($_GET[action]=='opcion')?'table-row':'none';
			$id = $col["proceso_id"];
			$$_GET[cn] = 'active';
			$q = $con->FetchAssoc($con->Query("SELECT * FROM folder_demanda WHERE user_id = '".$_SESSION["usuario"]."' AND proceso_id = '".$id."' "));
			$j = $con->FetchAssoc($con->Query("SELECT * FROM juzgados WHERE id = '$col[juzgado]'"));
			$pid = $con->FetchArray($con->Query("Select * from caratula where id = '".$col[0]."'"));

			$juzgado = (is_null($j[nom]))?$col[juzgado]:$j[nom];

			$vretorno = "<table cellspacing='0' cellpadding='5' class='proces-list-item'>
				<tr>
					<td colspan='3' class='title-list-ps'>$col[tit_demanda]</td>
					<td rowspan='3' class='blue-td'><div title='opciones' id='btn_opc' onclick=\"$('#opc_$col[id_p]').toggle(500)\"></div></td>
				</tr>
				<tr>
					<td class='juz-name-ps'><span class='title-ps'><b>Entidad:</b> </span>$juzgado</td>
					<td class='cod-ps'><span class='title-ps'><b>Código:</b> </span>$q[folder_id]$col[proceso_id]</td>
					<td class='rad-ps'><span class='title-ps'><b>Radicado:</b> </span>$col[rad]</td>
				</tr>
				<!--<tr>
					<td colspan='3' class='dem-dem-ps'><span class='title-ps'><b>Cliente:</b> </span>";
					
					$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$id."' and user_id = '".$_SESSION['usuario']."'";
					$st = $con->Query($strx);
					while ($colx=$con->FetchAssoc($st)) {
						$vretorno .= $colx[nom_entidad].", ";
					} 
					
					$strx  = "select * from demandado_proceso where proceso_id = '".$id."' and user_id = '".$_SESSION['usuario']."'";

					$st = $con->Query($strx);
					$vretorno .= "<span class='title-ps'><b>Contraparte:</b> </span>";
						while ($colx = $con->FetchAssoc($st)) {
							$vretorno .= $colx[p_nombre].", ";
						} 
			$vretorno .= "</td> -->
				</tr>";

			if ($_SESSION['t_cuenta'] == "1") {
				$vretorno .= "	<tr style='display:$display;' class='blue-tr' id='opc_$col[id_p]'>
						<td colspan='4'>
							<table class='linkbar' border='0'>
								<tr>
									<td style='width:42px' class='$ver'>
										<a href='/caratula/opcion/$pid[id]/ver/' class='no_link'><div class='mini-ico mini-ver $ver' title='Ver'></div></a>
									</td>
									<td style='width:42px' class='$documentos'>
										<a href='/caratula/opcion/$pid[id]/documentos/' class='no_link'><div class='mini-ico mini-do $documentos' title='Documentos Oficiales'></div></a>
									</td>
									<td style='width:42px' class='$anexos'>
										<a href='/caratula/opcion/$pid[id]/anexos/' class='no_link'><div class='mini-ico mini-anexos $anexos' title='Expediente'></div></a>
									</td>
									<td style='width:42px' class='$abonos'>
										<a href='/caratula/opcion/$pid[id]/abonos/' class='no_link'><div class='mini-ico mini-abonos $abonos' title='Abonos'></div></a>
									</td>
									<td style='width:42px' class='$gastos'>
										<a href='/caratula/opcion/$pid[id]/gastos/' class='no_link'><div class='mini-ico mini-gastos $gastos' title='Gastos'></div></a>
									</td>
									<td style='width:42px'>
										<a href='".HOMEDIR.DS."agenda/dia/".date("Y-m-d")."/$q[folder_id].$pid[id]/' class='no_link'><div class='mini-ico mini-eventos' title='Eventos'></div></a>
									</td>
									";
				if ($_SESSION['folder'] == '') {
					$vretorno .= "					
									<td style='width:42px'>
										<a href='".HOMEDIR.DS."correo/inbox/$q[folder_id].$pid[id]/' class='no_link'><div class='mini-ico mini-be' title='Bandeja de Correos'></div></a>
									</td>
									";
				}
					$vretorno .= "								
									<td style='width:42px' class='$notas'>
										<a href='/caratula/opcion/$pid[id]/notas/' class='no_link'><div class='mini-ico mini-notas $notas' title='Notas'></div></a>
									</td>
									<td style='width:42px' class='$actuaciones'>
										<a href='/caratula/opcion/$pid[id]/actuaciones/' class='no_link'><div class='mini-ico mini-actuaciones $actuaciones' title='Actuaciones'></div></a>
									</td>
									";
				if ($_SESSION['folder'] == '') {								
					$vretorno .= "																
									<td style='width:42px' class='$transferir'>
										<a href='/caratula/opcion/$pid[id]/transferir/' class='no_link'><div class='mini-ico mini-transferir $transferir' title='Compartir'></div></a>
									</td>
									";
				}	
			}else{
				$vretorno .= "	<tr style='display:$display;' class='blue-tr' id='opc_$col[id_p]'>
						<td colspan='4'>
							<table class='linkbar' border='0'>
								<tr>
									<td style='width:42px' class='$ver'>
										<a href='/caratula/opcion/$pid[id]/ver/' class='no_link'><div class='mini-ico mini-ver $ver' title='Ver'></div></a>
									</td>
									<td style='width:42px' class='$documentos'>
										<a href='/caratula/opcion/$pid[id]/documentos/' class='no_link'><div class='mini-ico mini-do $documentos' title='Documentos Oficiales'></div></a>
									</td>
									<td style='width:42px' class='$anexos'>
										<a href='/caratula/opcion/$pid[id]/anexos/' class='no_link'><div class='mini-ico mini-anexos $anexos' title='Expediente'></div></a>
									</td>
														
									<td style='width:42px'>
										<a href='".HOMEDIR.DS."correo/inbox/$q[folder_id].$pid[id]/' class='no_link'><div class='mini-ico mini-be' title='Bandeja de Correos'></div></a>
									</td>";
			}

			$vretorno .= "																
								<td>&nbsp</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";

			return $vretorno;
		}
		function opcion_ver($id,$user){
			global $con;			
			ob_start();
			$query = $con->Query("SELECT * from caratula where proceso_id = '$id' and user_id = '$user'");
			$proceso = $con->FetchAssoc($query);
			$actuaciones=$this->get_actuaciones($proceso['id'], $user);
			$demandados = $con->Query("SELECT * from demandado_proceso where user_id='$user' and proceso_id = '$id'");
			$demandantes = $con->Query("SELECT * from demandante_proceso_juridico where user_id='$user' and proceso_id = '$id'");
			include_once VIEWS.DS.'caratula/opcion/ver.php';
			return ob_get_clean();
		}
		function get_actuaciones($id,$user){
			global $con;
			$query=$con->Query("SELECT * from actuaciones where user_id = '$user' and proceso_id = '$id'");
			while ($col=$con->FetchAssoc($query)) {
				$table.="	<tr>
								<td style='width:70%'>$col[act]</td>
								<td>$col[fecha]</td>
							</tr>";
			}
			return $table;
		}
		function opcion_editar($id,$user,$f,$msg){
			global $con;
			
			ob_start();
			$query=$con->Query("SELECT * from caratula where proceso_id = '$id' and user_id = '$user'");
			$proceso = $con->FetchAssoc($query);
			$query =$con->Query("SELECT * FROM juzgados where user_id='$user' or user_id = 'DEFAULT'");
			$juzgados=$f->Create_Select($query,'id','nom','JUZGADO DE PRUEBA DE SANDER CADENA');
			include_once VIEWS.DS.'caratula/opcion/editar.php';
			return ob_get_clean();
		}
		function opcion_documentos($id,$user,$f){
			global $con;
			
			ob_start();
			$query=$con->Query("SELECT * from memoriales where proceso_id = '$id' and user_id = '$user'");
			include_once VIEWS.DS.'caratula/opcion/documentos.php';
			return ob_get_clean();
		}
		function opcion_crear_documento($id,$user,$f){
			global $con;
			$object2 = new MPlantilla;
			$query2 = $object2->ListarPlantilla("WHERE user_id = '$_SESSION[usuario]'");
			$contents=$con->Query("SELECT * from memoriales where id='$_REQUEST[p1]'");
			$content[0]=$con->Result($contents,0,'contenido');
			$content[1]=$con->Result($contents,0,'nombre');
			ob_start();
			//$query=$con->Query("SELECT * from memoriales where proceso_id = '$id' and user_id = '$_SESSION[usuario]'");
			include_once VIEWS.DS.'caratula/opcion/crear_documento.php';
			return ob_get_clean();
		}
		function opcion_anexos($id,$user,$f){

			global $con;

			$RegistrosAMostrar = 20;
			if(isset($_GET['p1'])){
				$RegistrosAEmpezar=($_GET['p1']-1)*$RegistrosAMostrar;
				$PagAct=$_GET['p1'];
			//caso contrario los iniciamos
			}else{
				$RegistrosAEmpezar=0;
				$PagAct=1;
				
			}	
			
			ob_start();
#echo "SELECT * from anexos where proceso_id = '$id' and user_id = '$user' and estado = '1' limit $RegistrosAEmpezar, $RegistrosAMostrar";			
			$query=$con->Query("SELECT * from anexos where proceso_id = '$id' and user_id = '$user' and estado = '1' limit $RegistrosAEmpezar, $RegistrosAMostrar");
			$querytot=$con->Query("SELECT count(*) as t from anexos where proceso_id = '$id' and user_id = '$user' and estado = '1'");
			include_once VIEWS.DS.'caratula/opcion/anexos.php';
			return ob_get_clean();
		}
		function opcion_notas($id,$user,$f){
			global $con;
			
			ob_start();
			$notes=$con->Query("SELECT * from notas where user_id='$user' and proceso_id='$id'");
			include_once VIEWS.DS.'caratula/opcion/notas.php';
			return ob_get_clean();
		}
		function opcion_abonos($id,$user,$f){
			global $con;
			
			ob_start();
			$query=$con->Query("SELECT * from abonos_img where user_id='$user' and proceso_id='$id' and estado = '1'");
			$abonos=$con->Query("SELECT * from abonos where user_id='$user' and proceso_id='$id'");
			include_once VIEWS.DS.'caratula/opcion/abonos.php';
			return ob_get_clean();
		}
		function opcion_gastos($id,$user,$f){
			global $con;
			
			ob_start();
			$query=$con->Query("SELECT * from gastos_img where user_id='$user' and proceso_id='$id' and estado = '1'");
			$gastos=$con->Query("SELECT * from gastos where user_id='$user' and proceso_id='$id'");
			include_once VIEWS.DS.'caratula/opcion/gastos.php';
			return ob_get_clean();
		}
		function opcion_notificaciones($id,$user,$f){
			global $con;
			
			ob_start();
			$query=$con->Query("SELECT * from demandado_proceso where proceso_id='$id' and user_id='$user'");
			$demandado=$f->Create_Select($query,'id','p_nombre');
			include_once VIEWS.DS.'caratula/opcion/notificaciones.php';
			return ob_get_clean();
		}
		function opcion_actuaciones($id,$user,$f){
			global $con;
			
			ob_start();
			$query = $con->Query("SELECT * from caratula where proceso_id = '$id' and user_id = '$user'");
			$proceso = $con->FetchAssoc($query);
			$actuaciones=$this->get_actuaciones($proceso['id'], $user);

			include_once VIEWS.DS.'caratula/opcion/actuaciones.php';
			return ob_get_clean();
		}
		function opcion_transferir($id,$user,$f){
			global $con;
			if (isset($_POST[submit])) {
				$query=$con->Query("SELECT * from usuarios where user_id = '$_POST[compartir]'");
				if ($con->NumRows($query)>0) {
					$con->Query("INSERT into compartir (user_id,proceso_id,compartir, pid)
									values ('$user','$id','$_POST[compartir]','$_GET[id]')");
					$error = 'Proceso Compartido con '.$_POST[compartir];
				}else{
					$error = "El Usuario \"$_POST[compartir]\" No Existe";
				}
			}
			ob_start();
			$sadmin_id=$con->Result($con->Query("SELECT * from arbol_super_admin where id_usuario = '$user'"),0,'id_super_admin');
			$user_list=$f->Create_Select($con->Query("SELECT u.user_id, concat(u.p_nombre,' ',u.p_apellido) as nombre from usuarios u, arbol_super_admin asa where asa.id_usuario=u.user_id and asa.id_super_admin=$sadmin_id and u.user_id <> '$_SESSION[usuario]'"),'user_id','nombre');
			$unique = $con->Query("SELECT f.* from folder f, folder_demanda fd where f.id = fd.folder_id and fd.proceso_id = '$id' and fd.user_id = '$user'");
		   	$id=$con->Result($unique,0,'id');
			include_once VIEWS.DS.'caratula/opcion/transferir.php';
			return ob_get_clean();
		}

		function ProcesosInactivosDetalle($days, $pid, $username){
			global $con;
			if($pid != "*"){
				$q_str_folder= "select * from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$pid."'";
				$query_folder = $con->Query($q_str_folder);

				$path  = "(";
				$total_rows = $con->NumRows($query_folder);
				
				for ($i=0 ; $i<$total_rows ; $i++){

					$q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $i, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."'";
					$queryx = $con->Query($q_str);
	// VOY A MOSTRAR T ODOS LOS PROCESOS TENER EN CUENTA PARA PROXIMAS REFERENCIAS LOS PROCESOS INACTIVOS
					if($total_rows == 1){
						$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
					}else{
						if($i == $total_rows -1){
							$path .= "proceso_id = '".$con->Result($queryx, 0, 'id')."'";	
						}else{
							$path .= "proceso_id = '".$con->Result($queryx, 0, 'id')."' OR ";	
						}
					}
				}	
				$path  .= ") AND ";
				$q_str = 'select max(id) as max, proceso_id, date from events where '.$path.' date <= "'.$days.'" and user_id = "'.$username.'" group by proceso_id order by date desc';	
			}else{
				$q_str = 'select max(id) as max, proceso_id, date from events where date <= "'.$days.'" and user_id = "'.$username.'" group by proceso_id order by date desc';	
			}
			$query = $con->Query($q_str);
			
			return $query;
		}

		function GetTotalAnexosProcesos($pid){
			global $con;
			$q_str = "SELECT COUNT(*) AS t FROM anexos WHERE user_id = '".$_SESSION["usuario"]."' and proceso_id = '".$pid."' ";
			$query = $con->Query($q_str);
			
			return $con->Result($query, 0, "t");
		}
	}	
?>