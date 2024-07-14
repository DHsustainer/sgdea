<style>
	.pathmailer{
		width: 48%;
		float: right;
		margin: 5px;
		padding: 5px;
		border: 1px solid #ccc;
	}

</style>


<div class="block_mailer_body" >
	<div class="pathmailer">		
<?
	echo "<div class='mailer_header'><b>Mensajes Recibidos</b></div>";
	

		$statuses = "";
		if($action == "inbox"){
			$statuses = "";
		}elseif($action == "archived"){
			$statuses = "and mailer_replys.message_status = '3' ";
		}

		$usuario = $_SESSION["usuario"];

		$xpath = "";
		if($pid == ""){
			$xpath = "";
		}else{
			$xpath = "and mailer_message.p_id = '".$pid."'";
		}

		$pathtype = "";
		if($type != ""){
			if($type == "1"){
				$pathtype = "and mailer_from_message.type_message = '1'";
			}elseif($type == "2"){
				$pathtype = "and mailer_from_message.type_message = '2'";
			}else{
				$pathtype = "";
			}
		}

		$RegistrosAMostrar = 30;
		if(isset($_GET['cn'])){
			$RegistrosAEmpezar=($_GET['cn']-1)*$RegistrosAMostrar;
			$PagAct=$_GET['cn'];
		//caso contrario los iniciamos
		}else{
			$RegistrosAEmpezar=0;
			$PagAct=1;
			
		}	


		$str = "select mailer_message.id, mailer_replys.id, mailer_replys.receiver_token, mailer_replys.readed from mailer_message 
				inner join mailer_replys 
				on mailer_message.message_id  = mailer_replys.message_id 

				INNER JOIN mailer_from_message 
				ON mailer_from_message.token_ID = mailer_replys.receiver_token 
				
					where mailer_from_message.email = '".$usuario."' $xpath $statuses $pathtype order by mailer_message.date desc limit $RegistrosAEmpezar, $RegistrosAMostrar";

	$queryxt = $con->Query($str);
	echo "<div id='contenido_bloque'>";
		$i = 0;
		echo "<ul id='listadonovedades'>";
		while($row = $con->FetchArray($queryxt)){
			$i++;
			$fm = new MMailer_from_message;
			$fm->CreateMailer_from_message("token_ID", $row[2]);
			
			$m = new MMailer_message;
			$m->CreateMailer_message("id",$row[0]);

			$r = new MMailer_Replys;
			$r->CreateMailer_replys("id", $row[1]);

			$readed = "";
			$dater = $f->nicetime($r->GetReply_datetime());
			if($row["readed"] == "0"){
				# CON ACUSE DE RECIBO SIN LEER
				$readed = "unread";
				$style = "style='color:#0063A5;'";
				
			}

			if($r->GetMessage_status() == "0"){
				# SIN ACUSE DE RECIBO
				$readed = "greenunread";
				$style = "style='color:#C00;'";
				$dater = $f->nicetime($m->GetDate());
				
			}

			$Tt = $m->GetSubject();
			$tamt = strlen($Tt);
			if ($tamt <= 80){
				$T = $Tt;
			}else{
				$T = substr($Tt, 0,80).'...';
			}
			$a = $T;

			if ($a == ""){
				$a = "Sin Asunto";
			}

			$d = new MCaratula;
			$d->CreateCaratula("id", $m->GetP_id());

				echo "	<li class='itemList $readed mailer'>";
							echo "<div $style class='email_mail $readed'><a $style href='".HOMEDIR.DS."correo".DS."veracuse".DS.$r->GetReceiver_token().".1".DS."'><b>".$fm->GetUser_ID()."</b></a></div>";
							echo "<div $style class='title_mail $readed'><a $style href='".HOMEDIR.DS."correo".DS."veracuse".DS.$r->GetReceiver_token().".1".DS."'>".$a."</a></div>";
							echo "<div $style class='time_mail $readed'>".$dater."</div>";
							echo "<div $style class='clear'></div>";
							
				echo "	</li>";


		}
		echo "</ul>";	

		$querypag = "SELECT count(*) as t from mailer_message 
						inner join mailer_replys on mailer_message.message_id  = mailer_replys.message_id 
						INNER JOIN mailer_from_message ON mailer_from_message.token_ID = mailer_replys.receiver_token 
							where mailer_message.user_ID = '".$usuario."' $xpath $statuses $pathtype ";

		echo '<div class="btn-group m-t-30">';
			$NroRegistros = $con->Result($con->Query($querypag), 0, 't');

			if($NroRegistros == 0){
			echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';
			}

			$PagAnt=$PagAct-1;
			$PagSig=$PagAct+1;
			$PagUlt=$NroRegistros/$RegistrosAMostrar;

			$Res=$NroRegistros%$RegistrosAMostrar;

			if($Res>0) $PagUlt=floor($PagUlt)+1;

			$gid = $_GET['id'];

			if ($gid == "") {
				$gid = "";
			}

			echo "<button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/correo/inbox/".$gid."/1/'>Pagina 1</a> ";

			if($PagAct>1) 
			echo "<button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/correo/inbox/".$gid."/$PagAnt/'>Pagina Anterior.</a> ";


			echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

			if($PagAct<$PagUlt)  
			echo " <button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/correo/inbox/".$gid."/$PagSig/'>Pagina Siguiente.</a> ";

			echo " <button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/correo/inbox/".$gid."/$PagUlt/'>Pagina. $PagUlt</a>";
		echo '</div>';
		if($i == 0){
			echo "<ul id='listadonovedades'>";
				echo "	<li class='itemList $readed mailer' style='border:none'>";
							echo "<div $style class='email_mail $readed'></div>";
							echo "<div $style class='title_mail $readed'></a></div>";
							echo "<div $style class='time_mail $readed'></div>";
							echo "<div $style class='clear'></div>";
							
				echo "	</li>";


			echo "</ul>";


			echo '<div class="da-message success">No tienes correos nuevos en tu bandeja</div>';
		}
	echo "</div>";
?>
		
	</div>
	<div class="pathmailer">
<?
	echo "<div class='mailer_header'><b>Mensajes con Acuse</b></div>";
	

		$statuses = "";
		if($action == "inbox"){
			$statuses = "and (mailer_replys.message_status = '1' or mailer_replys.message_status = '2')";
		}elseif($action == "archived"){
			$statuses = "and mailer_replys.message_status = '3' ";
		}

		$usuario = $_SESSION["usuario"];

		$xpath = "";
		if($pid == ""){
			$xpath = "";
		}elseif($pid == "*"){

			$q_str_folder= "select proceso_id from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$id."'";
			$query_folder = $con->Query($q_str_folder);

			$xpath  = "AND (";
			$total_rows = $con->NumRows($query_folder);
			
			for ($i=0 ; $i<$total_rows ; $i++){

				$q_str = "SELECT id FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $i, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."'";
				$queryx = $con->Query($q_str);
				// VOY A MOSTRAR T ODOS LOS PROCESOS TENER EN CUENTA PARA PROXIMAS REFERENCIAS LOS PROCESOS INACTIVOS
				if($total_rows == 1){
					$xpath .= "mailer_message.p_id = ".$con->Result($queryx, 0, 'id');	
				}else{
					if($i == $total_rows -1){
						$xpath .= "mailer_message.p_id = ".$con->Result($queryx, 0, 'id');	
					}else{
						$xpath .= "mailer_message.p_id = ".$con->Result($queryx, 0, 'id')." OR ";	
					}
				}
			}	
			$xpath  .= ") ";

		}else{
			$xpath = "and mailer_message.p_id = '".$pid."'";
		}

		$pathtype = "";
		if($type != ""){
			if($type == "1"){
				$pathtype = "and mailer_from_message.type_message = '1'";
			}elseif($type == "2"){
				$pathtype = "and mailer_from_message.type_message = '2'";
			}else{
				$pathtype = "";
			}
		}

		$RegistrosAMostrar = 30;
		if(isset($_GET['cn'])){
			$RegistrosAEmpezar=($_GET['cn']-1)*$RegistrosAMostrar;
			$PagAct=$_GET['cn'];
		//caso contrario los iniciamos
		}else{
			$RegistrosAEmpezar=0;
			$PagAct=1;
			
		}	


		$str = "select mailer_message.id, mailer_replys.id, mailer_replys.receiver_token, mailer_replys.readed from mailer_message 
				inner join mailer_replys 
				on mailer_message.message_id  = mailer_replys.message_id 

				INNER JOIN mailer_from_message 
				ON mailer_from_message.token_ID = mailer_replys.receiver_token 
				
					where mailer_message.user_ID = '".$usuario."' $xpath $statuses $pathtype order by mailer_message.date desc limit $RegistrosAEmpezar, $RegistrosAMostrar";


	$queryxt = $con->Query($str);
	echo "<div id='contenido_bloque'>";
		$i = 0;
		echo "<ul id='listadonovedades'>";
		while($row = $con->FetchArray($queryxt)){
			$i++;
			$fm = new MMailer_from_message;
			$fm->CreateMailer_from_message("token_ID", $row[2]);
			
			$m = new MMailer_message;
			$m->CreateMailer_message("id",$row[0]);

			$r = new MMailer_Replys;
			$r->CreateMailer_replys("id", $row[1]);

			$readed = "";
			$dater = $f->nicetime($r->GetReply_datetime());
			if($row["readed"] == "0"){
				# CON ACUSE DE RECIBO SIN LEER
				$readed = "unread";
				$style = "style='color:#0063A5;'";
				
			}

			if($r->GetMessage_status() == "0"){
				# SIN ACUSE DE RECIBO
				$readed = "greenunread";
				$style = "style='color:#C00;'";
				$dater = $f->nicetime($m->GetDate());
				
			}

			$Tt = $m->GetSubject();
			$tamt = strlen($Tt);
			if ($tamt <= 80){
				$T = $Tt;
			}else{
				$T = substr($Tt, 0,80).'...';
			}
			$a = $T;

			if ($a == ""){
				$a = "Sin Asunto";
			}

			$d = new MCaratula;
			$d->CreateCaratula("id", $m->GetP_id());

				echo "	<li class='itemList $readed mailer'>";
							echo "<div $style class='email_mail $readed'><a $style href='".HOMEDIR.DS."correo".DS."ver".DS.$d->GetFolder_id().".".$m->GetP_id().".".$r->GetReceiver_token().DS."'><b>".$fm->GetEmail()."</b></a></div>";
							echo "<div $style class='title_mail $readed'><a $style href='".HOMEDIR.DS."correo".DS."ver".DS.$d->GetFolder_id().".".$m->GetP_id().".".$r->GetReceiver_token().DS."'>".$a."</a></div>";
							echo "<div $style class='time_mail $readed'>".$dater."</div>";
							echo "<div $style class='clear'></div>";
							
				echo "	</li>";


		}
		echo "</ul>";	

		$querypag = "SELECT count(*) as t from mailer_message 
						inner join mailer_replys on mailer_message.message_id  = mailer_replys.message_id 
						INNER JOIN mailer_from_message ON mailer_from_message.token_ID = mailer_replys.receiver_token 
							where mailer_message.user_ID = '".$usuario."' $xpath $statuses $pathtype ";

		echo '<div class="btn-group m-t-30">';
			$NroRegistros = $con->Result($con->Query($querypag), 0, 't');

			if($NroRegistros == 0){
			echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';
			}

			$PagAnt=$PagAct-1;
			$PagSig=$PagAct+1;
			$PagUlt=$NroRegistros/$RegistrosAMostrar;

			$Res=$NroRegistros%$RegistrosAMostrar;

			if($Res>0) $PagUlt=floor($PagUlt)+1;

			$gid = $_GET['id'];

			if ($gid == "") {
				$gid = "";
			}

			echo "<button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/correo/inbox/".$gid."/1/'>Pagina 1</a> ";

			if($PagAct>1) 
			echo "<button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/correo/inbox/".$gid."/$PagAnt/'>Pagina Anterior.</a> ";


			echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

			if($PagAct<$PagUlt)  
			echo " <button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/correo/inbox/".$gid."/$PagSig/'>Pagina Siguiente.</a> ";

			echo " <button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/correo/inbox/".$gid."/$PagUlt/'>Pagina. $PagUlt</a>";
		echo '</div>';
		if($i == 0){
			echo "<ul id='listadonovedades'>";
				echo "	<li class='itemList $readed mailer' style='border:none'>";
							echo "<div $style class='email_mail $readed'></div>";
							echo "<div $style class='title_mail $readed'></a></div>";
							echo "<div $style class='time_mail $readed'></div>";
							echo "<div $style class='clear'></div>";
							
				echo "	</li>";


			echo "</ul>";


			echo '<div class="da-message success">No tienes correos nuevos en tu bandeja</div>';
		}
	echo "</div>";
?>
	</div>

<script>
	
	$(document).ready(function() {
		$("#listadonovedades li:last").css("border-bottom", "1px solid #D1D6DA");
		
	});
</script>
</div>


<style>
	
	.unread{
		color: #0063A5;
		font-weight: bold;
	}

	.greenunread{
		color: #C00;
		font-weight: bold;	
	}

	.contenido_bloque{
		margin-top: 0px;
	}
</style>


