<?
	$pid = $id;

	$statuses = "";
	$xpath = "mailer_message.p_id = '".$pid."'";

	$usuario = $_SESSION["usuario"];


	echo '<h2>Correspondencias Electrónica</h2>';
		$i = 0;
		echo "<ul id='listadonovedades' class='list-group'>";

		$str = "select mailer_message.id as mmid, mailer_replys.id as mrid, mailer_replys.receiver_token, mailer_replys.readed from mailer_message 
			inner join mailer_replys on mailer_message.message_id  = mailer_replys.message_id 
			INNER JOIN mailer_from_message ON mailer_from_message.token_ID = mailer_replys.receiver_token where $xpath order by mailer_message.date desc";

		$queryxt = $con->Query($str);
		while($row = $con->FetchAssoc($queryxt)){
			$i++;
			$fm = new MMailer_from_message;
			$fm->CreateMailer_from_message("token_ID", $row['receiver_token']);
			
			$m = new MMailer_message;
			$m->CreateMailer_message("id",$row['mmid']);

			$r = new MMailer_Replys;
			$r->CreateMailer_replys("id", $row['mrid']);
			$style="style='color:#000'";
			$readed = "";
			$leido = "Leído";
			$dater = $f->nicetime($r->GetReply_datetime());
			if($row["readed"] == "0"){
				# CON ACUSE DE RECIBO SIN LEER
				$readed = "unread";
				$style = "style='color:#0063A5;'";
				$leido = "Sin leer";
				
			}

			if($r->GetMessage_status() == "0"){
				# SIN ACUSE DE RECIBO
				$readed = "greenunread";
				$style = "style='color:#C00;'";
				$dater = $f->nicetime($m->GetDate());
				$leido = "Sin leer";
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


			$url = HOMEDIR.DS."correo/ver/.".$m->GetP_id().".".$r->GetReceiver_token().DS;

			#echo "->".$m->GetDate();
			#$d = new MCaratula;
			#$d->CreateCaratula("id", $m->GetP_id());

			echo "	<li class='list-group-item $readed mailer'>";
						echo "<a href='".$url."' target='_blank'>";
						echo "<div $style class='email_mail $readed'>".$fm->GetEmail()."</b></div>";
						echo "<div $style class='time_mail $readed'>".$dater." - ".$leido."</div>";
						echo "<div $style class='title_mail $readed'>".$a."</div>";
						echo "<div $style class='clear'></div>";
						echo "</a>";
			echo "	</li>";
		}

		if ($i == "0") {
			echo "<li class='list-group-item'><div class='alert alert-info'>No tienes nuevos correos electrónicos enviados o con acuse</div></li>";
		}

		echo "</ul>";	

?>
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
	.email_mail{
		float:left;
		width:160px;
		overflow-x:hidden; 
		margin-right: 10px;
	}	
	.title_mail{
		float:left;
		overflow-x:hidden; 	
		margin-right: 10px;	
	}
	.time_mail{
		float:right;
		width:120px;
		font-size: 11px;
		padding-right: 7px;
	}	
	.title_mail a{
		color: #000;
	}

	.itemList:hover{
		cursor: pointer;
		background: #F5F5F5;
	}
	.itemList{
		padding: 0px;
		margin: 0px;
		line-height: 30px;
		padding-left: 7px;
		list-style: none;
	}
	ul#listadonovedades{
		margin:0px;
		padding: 0px;
		padding-left: 0px;
	}
</style>


