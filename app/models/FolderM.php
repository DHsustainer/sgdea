<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'FolderE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MFolder extends EFolder{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetUser_id("");
				parent::SetNom("");
				parent::SetFecha("");
				parent::SetCod_ingreso("");
				parent::SetPassword("");
				parent::SetEstado("");
				parent::SetDec_pass("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateFolder($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from folder where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetUser_id($row['user_id']);
				parent::SetNom($row['nom']);
				parent::SetFecha($row['fecha']);
				parent::SetCod_ingreso($row['cod_ingreso']);
				parent::SetPassword($row['password']);
				parent::SetEstado($row['estado']);
				parent::SetDec_pass($row['dec_pass']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteFolder($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from folder where id = '.$id;
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
		function InsertFolder($user_id, $nom, $fecha, $cod_ingreso, $password, $estado, $dec_pass)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO folder (user_id, nom, fecha, cod_ingreso, password, estado, dec_pass) VALUES ('$user_id', '$nom', '$fecha', '$cod_ingreso', '$password', '$estado', '$dec_pass')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str,'insert'); 
			return $query;
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			/*if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				return mysql_insert_id();
			}*/
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateFolder($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE folder SET ";
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
		function ListarFolder($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM folder $path $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
				if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}
		function Create_List($query,$type=0){
			global $con;

			if ($type=='1') {
				$numproces = $con->Query("SELECT * from compartir where compartir = '$_SESSION[usuario]'");
				$result .= "

			<div class='folder-item fl-nat' onclick='window.location.replace(\"/caratula/ver/0/ACTIVO/\")'>
				<div class='tipo-fl'>Natural</div>
				<div class='nombre-fl'>Procesos Compartidos</div>
				<div class='fecha-fl'>__</div>
				<div class='num-fl'>".$con->NumRows($numproces)."</div>
			</div>
			";
			}else{

				$stsf = $con->Query("select * from folder_ciudadano where user_id = '".$_SESSION['usuario']."' or user_2 = '".$_SESSION['usuario']."'");

#				echo "select * from folder_ciudadano where user_id = '".$_SESSION['usuario']."' or user_2 = '".$_SESSION['usuario']."'";
				while ($colsf=$con->FetchAssoc($stsf)) {
					if ($colsf[estado]==1) {
						$result.=$this->Paint_FolderCiudadano($colsf);
					}				
				}


				while ($col=$con->FetchAssoc($query)) {
					if ($col[estado]==1) {
						$result.=$this->Paint_Folder($col);
					}				
				}
			}
			return $result;
		}
		function Paint_Folder($col){
			global $con;
			global $f;
			$natural = $con->Query("SELECT * from folder_demandante_proceso where id_folder='$col[id]'");
			$type=($con->NumRows($natural)>0)?'fl-nat':'fl-jur';
			$typen=($con->NumRows($natural)>0)?'Natural':'Jur&iacute;dica';
			$fecha = $f->ObtenerFecha($col[fecha]);
			$numproces = $con->Query("SELECT * from folder_demanda 
											INNER JOIN caratula ON caratula.proceso_id = folder_demanda.proceso_id AND caratula.user_id = folder_demanda.user_id 
											where folder_id = '$col[id]' AND caratula.est_proceso =  '".$_SESSION['typefolder']."'");
			
			$foldername = ucfirst(strtolower($col[nom]));
			
				if (strlen($foldername) >= 27) {
					$foldername = substr($foldername, 0, 27)."...";
				}

			if ($_SESSION['folder'] == "") {

				return "
						<div class='folder-item $type'>
							<div class='opc-min-fl'>
								<a class='no_link' href='/proceso/nuevo/$col[id]/'><div class='min-fl'></div></a>
								<a class='no_link' onClick='confirmDel(\"/proceso/del/$col[id]/\");'  href='#'><div class='close-fl'></div></a>
							</div>
							<div onclick='window.location.replace(\"/caratula/ver/$col[id]/ACTIVO/\")' title='".ucfirst(strtolower($col[nom]))."'>
								<div class='tipo-fl'>$typen</div>
								<div class='nombre-fl'>".$foldername."</div>
								<div class='fecha-fl'>$fecha</div>
								<div class='num-fl'>".$con->NumRows($numproces)."</div>
							</div>
						</div>
						";
			}else{
				if ($_SESSION['folder'] == $col[id]) {
					$ret = "
							<div class='folder-item $type'>
								<div class='opc-min-fl'>";
					if ($_SESSION['folder'] == "") {
						$ret .= "			
										<a class='no_link' href='/proceso/nuevo/$col[id]/'><div class='min-fl'></div></a>
										<a class='no_link' onClick='confirmDel(\"/proceso/del/$col[id]/\");'  href='#'><div class='close-fl'></div></a>";
					}
					$ret .= "									
								</div>
								<div onclick='window.location.replace(\"/caratula/ver/$col[id]/ACTIVO/\")'>
									<div class='tipo-fl'>$typen</div>
									<div class='nombre-fl'>".$foldername."</div>
									<div class='fecha-fl'>$fecha</div>
									<div class='num-fl'>".$con->NumRows($numproces)."</div>
								</div>
							</div>
							";

					return $ret;		
				}
			}
		}

		function Paint_FolderCiudadano($col){
			global $con;
			global $f;
			$type=($col['type']=="PU")?'fl-nat':'fl-jur';
			$typen=($col['type']=="PU")?'&nbsp;':'Carpeta Privada';
			$numproces = $con->Query("SELECT * from anexos_carpeta where folder_id = '".$col['id']."'");
			
			$foldername = strtolower($col[titulo]);
			
				if (strlen($foldername) >= 50) {
					$foldername = substr($foldername, 0, 50)."...";
				}

			if ($_SESSION['folder'] == "") {

				$ret = "
						<div class='folder-item $type'>
							<div class='opc-min-fl'>";
					if ($col['type'] != "PU") {

						$ret .= "	<a class='no_link' onClick='confirmDel(\"/proceso/del/$col[id]/\");'  href='#'><div class='close-fl'></div></a>";
					
					}
					$ret .= "	</div>
							<div onclick='window.location.replace(\"/folder_ciudadano/ver/$col[id]/\")' title='".strtolower($col[nom])."'>
								<div class='tipo-fl'>$typen</div>
								<div class='nombre-fl' style='height:40px'>".$foldername."</div>
								<div class='fecha-fl'></div>
								<div class='num-fl'>".$con->NumRows($numproces)."</div>
							</div>
						</div>
						";
						return $ret;
			}else{
				if ($_SESSION['folder'] == $col[id]) {
					$ret = "
							<div class='folder-item $type'>
								<div class='opc-min-fl'>";
					if ($col['type'] != "PU") {

						$ret .= "	<a class='no_link' onClick='confirmDel(\"/proceso/del/$col[id]/\");'  href='#'><div class='close-fl'></div></a>";
					
					}
					$ret .= "									
								</div>
								<div onclick='window.location.replace(\"/folder_ciudadano/ver/$col[id]/\")'>
									<div class='tipo-fl'>$typen</div>
									<div class='nombre-fl' style='height:40px'>".$foldername."</div>
									<div class='fecha-fl'>$fecha</div>
									<div class='num-fl'>".$con->NumRows($numproces)."</div>
								</div>
							</div>
							";

					return $ret;		
				}
			}
		}


		function Create_List_Proces($query){
			global $con;
			$i = 0;
			while ($col=$con->FetchAssoc($query)) {
				$i++;
				if ($col['est_proceso'] == $_SESSION['typefolder']) {
					$result.=$this->Paint_Proces($col);		
				}
			}
			if ($i == 0) {
				return '<div class="alert alert-info"> No hay procesos en esta carpeta</div>';
			}else{
				return $result;
			}
		}
		function Paint_Proces($col){

			global $con;
			$display=($_GET[action]=='opcion')?'table-row':'none';
			$id = $col["proceso_id"];
			$$_GET[cn] = 'active';
			$q = $con->FetchAssoc($con->Query("SELECT * FROM folder_demanda WHERE user_id = '".$_SESSION["usuario"]."' AND proceso_id = '".$id."' "));
			$j = $con->FetchAssoc($con->Query("SELECT * FROM juzgados WHERE id = '$col[juzgado]'"));
			$pid = $con->FetchAssoc($con->Query("Select * from caratula where user_id = '".$_SESSION["usuario"]."' AND proceso_id = '".$id."' "));
			$juzgado = (is_null($j[nom]))?$col[juzgado]:$j[nom];
			$vretorno = "<div class='proces_sm'>
						<div class='t_sm'><a href='/caratula/opcion/$col[id_p]/ver/'>".strtolower($col[tit_demanda])."</a></div>";
/*
			$vretorno .="<!--<div class='btn-group'>
						  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
						    <span class='icon menu_drop'></span>
						  </button>
						  <ul class='dropdown-menu minimenu' role='menu'>
						    <li>
						    	<table>
									<tr>
										<td><div class='mini-ico mini-ver' title='ver'></div></a></td>
										<td><a href='/caratula/opcion/$col[id_p]/documentos/' class='no_link'><div class='mini-ico mini-do' title='documentos oficiales'></div></a></td>
										<td><a href='/caratula/opcion/$col[id_p]/anexos/' class='no_link'><div class='mini-ico mini-anexos' title='anexos'></div></a></td>
										<td><a href='/caratula/opcion/$col[id_p]/abonos/' class='no_link'><div class='mini-ico mini-abonos' title='abonos'></div></a></td>
									</tr>
									<tr>
										<td><a href='/caratula/opcion/$col[id_p]/gastos/' class='no_link'><div class='mini-ico mini-gastos' title='gastos'></div></a></td>
										<td><a href='".HOMEDIR.DS."agenda/dia/".date("Y-m-d")."/$q[folder_id].$pid[id]/' class='no_link'><div class='mini-ico mini-eventos' title='eventos'></div></a></td>
										<td><a href='".HOMEDIR.DS."correo/inbox/$q[folder_id].$pid[id]/' class='no_link'><div class='mini-ico mini-be' title='bandeja de entrada'></div></a></td>
										<td><a href='/caratula/opcion/$col[id_p]/notas/' class='no_link'><div class='mini-ico mini-notas' title='notas'></div></a></td>
									</tr>
									<tr>
										<td><a href='/caratula/opcion/$col[id_p]/actuaciones/' class='no_link'><div class='mini-ico mini-actuaciones' title='actuaciones'></div></a></td>
										<td><a href='/caratula/opcion/$col[id_p]/transferir/' class='no_link'><div class='mini-ico mini-transferir' title='transferir'></div></a></td>
									</tr>
						    	</table>
							</li>
						  </ul>
						</div>						-->";
*/
			$vretorno .="</div>";

			return $vretorno;
		}
	}	
?>