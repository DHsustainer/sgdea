<?	
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_attachmentsM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Mailer_replysM.php');

	global $f;
	global $c;
	

		$datos .= "<h3 style='margin-top:0px'><b>Mensajes con Acuse</b></h3>";
	
		/*$statuses = "";
		if($action == "inbox"){
			$statuses = "and (mailer_replys.message_status = '1' or mailer_replys.message_status = '2')";
		}elseif($action == "archived"){
			$statuses = "and mailer_replys.message_status = '3' ";	
		}*/
		$statuses = "and (mailer_replys.message_status = '1' or mailer_replys.message_status = '2')";

		$usuario = $_SESSION["usuario"];

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
				
					where mailer_message.user_ID = '".$usuario."' $statuses $pathtype order by mailer_message.date desc";

	$queryxt = $con->Query($str);
		$i = 0;
		$datos .= "	<div class=''>
					<ul class='list-group'>";
		while($row = $con->FetchArray($queryxt)){
			$i++;
			$fm = new MMailer_from_message;
			$fm->CreateMailer_from_message("token_ID", $row[2]);
			
			$m = new MMailer_message;
			$m->CreateMailer_message("id",$row[0]);

			$r = new MMailer_Replys;
			$r->CreateMailer_replys("id", $row[1]);

			$readed = "";
			$color = "color: #000";
			if($row["readed"] == "0"){
				# CON ACUSE DE RECIBO SIN LEER
				$readed = "fa-envelope-o";
				$leido = "Sin leer por el Usuario";
				$color = "color: #0C0";
				$dater = "Le&iacute;do ".$f->nicetime($r->GetReply_datetime());
			}elseif($r->GetMessage_status() == "0"){
				# SIN ACUSE DE RECIBO
				$readed = "fa-envelope-o";
				$leido = "Sin leer por el destinatario";
				$dater = "Sin leer desde ".$f->nicetime($m->GetDate());
			}else{
				$readed = "fa-envelope-open-o";
				$leido = "Le&iacute;do";
				$dater = "Le&iacute;do ".$f->nicetime($r->GetReply_datetime());
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

			
				$datos .= "	<li class='list-group-item'>
							<div class='row'>
								<div class='col-md-1'>
									<span class='faicon fa $readed' title='Mensaje $leido' style='$color'></span>
								</div>
								<div class='col-md-10'>
									<div class='link_nombre'><span class='link_subtitulo'>De: </span><a href='".HOMEDIR.DS."correo".DS."ver".DS.".".$m->GetP_id().".".$r->GetReceiver_token().DS."'><b>".$fm->GetEmail()."</b></a></div>
									<div class='link_asunto'><span class='link_subtitulo'>Asunto: </span><a href='".HOMEDIR.DS."correo".DS."ver".DS.".".$m->GetP_id().".".$r->GetReceiver_token().DS."'>".$a."</a></div>
									<div class='link_fecha'>".$dater."</div>
								</div>
							</div>
						</li>
				";
				$datos .= "	</li>";
		}
		$datos .= "		</ul>
				</div>";



		$datos .= "<h3 style='margin-top:0px'><b>Mensajes Sin Acuse</b></h3>";
	
		/*$statuses = "";
		if($action == "inbox"){
			$statuses = "and (mailer_replys.message_status = '1' or mailer_replys.message_status = '2')";
		}elseif($action == "archived"){
			$statuses = "and mailer_replys.message_status = '3' ";	
		}*/
		$statuses = "and mailer_replys.message_status = '0' ";	

		$usuario = $_SESSION["usuario"];

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
				
					where mailer_message.user_ID = '".$usuario."' $statuses $pathtype order by mailer_message.date desc";

	$queryxt = $con->Query($str);
		$i = 0;
		$datos .= "	<div class=''>
					<ul class='list-group'>";
		while($row = $con->FetchArray($queryxt)){
			$i++;
			$fm = new MMailer_from_message;
			$fm->CreateMailer_from_message("token_ID", $row[2]);
			
			$m = new MMailer_message;
			$m->CreateMailer_message("id",$row[0]);

			$r = new MMailer_Replys;
			$r->CreateMailer_replys("id", $row[1]);

			$readed = "";
			$color = "color: #000";
			if($row["readed"] == "0"){
				# CON ACUSE DE RECIBO SIN LEER
				$readed = "fa-envelope-o";
				$leido = "Sin leer por el Destinatario";
				$color = "color: #C00";
				$dater = "Le&iacute;do ".$f->nicetime($r->GetReply_datetime());
			}elseif($r->GetMessage_status() == "0"){
				# SIN ACUSE DE RECIBO
				$readed = "fa-envelope-o";
				$leido = "Sin leer por el destinatario";
				$dater = "Sin leer desde ".$f->nicetime($m->GetDate());
			}else{
				$readed = "fa-envelope-open-o";
				$leido = "Le&iacute;do";
				$dater = "Le&iacute;do ".$f->nicetime($r->GetReply_datetime());
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

			
				$datos .= "	<li class='list-group-item'>
							<div class='row'>
								<div class='col-md-1'>
									<span class='faicon fa $readed' title='Mensaje $leido' style='$color'></span>
								</div>
								<div class='col-md-10'>
									<div class='link_nombre'><span class='link_subtitulo'>Para: </span><a href='".HOMEDIR.DS."correo".DS."ver".DS.".".$m->GetP_id().".".$r->GetReceiver_token().DS."'><b>".$fm->GetEmail()."</b></a></div>
									<div class='link_asunto'><span class='link_subtitulo'>Asunto: </span><a href='".HOMEDIR.DS."correo".DS."ver".DS.".".$m->GetP_id().".".$r->GetReceiver_token().DS."'>".$a."</a></div>
								</div>
							</div>
						</li>
				";
				$datos .= "	</li>";
		}
		$datos .= "		</ul>
				</div>";				








$datos .= '<style type="text/css">

	
	.list-group-item{
    	padding: 5px 5px;
	}
	.list-group-item .row{
		margin:0px !important;
		padding:0px !important;
		border:none;
	}
	.list-group-item .row > * {
	    padding: 1px 0 0 1px !important;
	    margin-bottom: 2px !important;
	}
	.list-group-item .faicon{
		font-size: 25px;
		padding: 10px;
		border-radius: 20px;
		background-color: #f5f5f5;
		cursor: pointer;

	}
	.list-group-item .link_nombre{
		line-height: 15px;
		text-align: left;
		padding-left: 10px;

	}
	.list-group-item .link_asunto{
		line-height: 15px;
		text-align: left;
		padding-left: 10px;

	}
	.list-group-item .link_fecha{
		line-height: 15px;
		text-align: left;
		font-size: 11px;
		color: #BBB;
		padding-left: 10px;

	}
	.link_subtitulo{
		text-align: left;
		color: #BBB;
		font-size: 12px;
	}
</style>';	
?>