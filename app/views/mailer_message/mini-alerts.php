<?	
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_attachmentsM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Mailer_replysM.php');

	global $f;
	global $c;
	

		$statuses = "";
		if($action == "inbox"){
			$statuses = "";
		}elseif($action == "archived"){
			$statuses = "and mailer_replys.message_status = '3' ";
		}

		$usuario = $_SESSION["usuario"];

		$xpath = "";
	
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



		$str = "select mailer_message.id, mailer_replys.id, mailer_replys.receiver_token, mailer_replys.readed from mailer_message 
				inner join mailer_replys 
				on mailer_message.message_id  = mailer_replys.message_id 

				INNER JOIN mailer_from_message 
				ON mailer_from_message.token_ID = mailer_replys.receiver_token 
				
					where mailer_from_message.email = '".$usuario."' $statuses $pathtype order by mailer_message.date desc limit 0, 12";

	$queryxt = $con->Query($str);
		$i = 0;

		

		$gid = $_GET['id'];

		if ($gid == "") {
			$gid = "";
		}


		$statuses = "";
		if($action == "inbox"){
			$statuses = "and (mailer_replys.message_status = '1' or mailer_replys.message_status = '2')";
		}elseif($action == "archived"){
			$statuses = "and mailer_replys.message_status = '3' ";	
		}
		$statuses = "and mailer_replys.message_status != '0' ";	

		$usuario = $_SESSION["usuario"];

		$xpath = "";


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




		$str = "select mailer_message.id, mailer_replys.id, mailer_replys.receiver_token, mailer_replys.readed from mailer_message 
				inner join mailer_replys 
				on mailer_message.message_id  = mailer_replys.message_id 

				INNER JOIN mailer_from_message 
				ON mailer_from_message.token_ID = mailer_replys.receiver_token 
				
					where mailer_message.user_ID = '".$usuario."' $statuses $pathtype order by mailer_message.date desc limit 0, 12";

	$queryxt = $con->Query($str);
		$i = 0;
		while($row = $con->FetchArray($queryxt)){
			$i++;
			$fm = new MMailer_from_message;
			$fm->CreateMailer_from_message("token_ID", $row[2]);
			
			$m = new MMailer_message;
			$m->CreateMailer_message("id",$row[0]);

			$r = new MMailer_Replys;
			$r->CreateMailer_replys("id", $row[1]);

			$readed = "";
			$color = "default";
			if($row["readed"] == "0"){
				# CON ACUSE DE RECIBO SIN LEER
				$readed = "mdi-email";
				$leido = "Sin leer por el Usuario";
				$color = "primary";
				$dater = "Leído ".$f->nicetime($r->GetReply_datetime());
			}elseif($r->GetMessage_status() == "0"){
				# SIN ACUSE DE RECIBO
				$readed = "mdi-email";
				$leido = "Sin leer por el destinatario";
				$dater = "Sin leer desde ".$f->nicetime($m->GetDate());
			}else{
				$readed = "mdi-email-open";
				$leido = "Leído";
				$dater = "Leído ".$f->nicetime($r->GetReply_datetime());
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

			echo '
			<a href="'.HOMEDIR.DS."correo".DS."ver".DS.".".$m->GetP_id().".".$r->GetReceiver_token().DS.'">
			    <div class="user-img"> 
			    	<span class="mdi '.$readed.' btn btn-'.$color.' btn-circle btn-lg" title="Mensaje '.$leido.'" style=""></span>
			    </div>
			    <div class="mail-contnet">
			        <h5>'.$fm->GetEmail().'</h5> 
			        <span class="mail-desc">'.$a.'</span> 
			        <span class="time">'.$dater.'</span> 
			    </div>
			</a>';
		}
?>