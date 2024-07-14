<?
global $c;
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>
<ul class="nav nav-pills m-b-20 " role="tablist" id="tab_navegacion_widgets">
	<?

			$itdt = $id;
			$totd = 1;
			$tots = 1;
			$totc = 1;
	
			$menuactivea = "display:block";
			$menuactiveb = "";
			$menuactivec = "";

			$tabactivea = "active";
			$tabactiveb = "";
			$tabactivec = "";

			if ($totd <= 0) {
				if ($tots > 0) {
					$menuactiveb = "display:block;";
					$tabactiveb = "active";

					$menuactivea = "";
					$tabactivea = "";
					$menuactivec = "";
					$tabactivec = "";

				}elseif ($totc > 0) {
					$menuactivec = "display:block;";
					$tabactivec = "active";

					$menuactivea = "";
					$tabactivea = "";
					$menuactiveb = "";
					$tabactiveb = "";
				}else{

					$menuactivea = "display:block";
					$menuactiveb = "";
					$menuactivec = "";

					$tabactivea = "active";
					$tabactiveb = "";
					$tabactivec = "";

				}
			}
		

	?>
	<li <?= $c->Ayuda('171', 'tog') ?> onClick="CargarAlerta2('1', 'Bandeja de Correos Electrónicos', 'correoelectronico', '1', 'tab1');ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" class="<?= $tabactivea ?>"><a href="#">Mensajes con Acuse</a></li>
	<li <?= $c->Ayuda('172', 'tog') ?> onClick="CargarAlerta2('1', 'Bandeja de Correos Electrónicos', 'correoelectronico', '1', 'tab2');ActivarTab('tab2', 'buscartab2')" id="buscartab2" role="presentation" class="<?= $tabactiveb ?>"><a href="#">Mensajes sin Acuse</a></li>
	<li <?= $c->Ayuda('173', 'tog') ?> onClick="CargarAlerta2('1', 'Bandeja de Correos Electrónicos', 'correoelectronico', '1', 'tab3');ActivarTab('tab3', 'buscartab3')" id="buscartab3" role="presentation" class="<?= $tabactivec ?>"><a href="#">Mensajes Archivados</a></li>
</ul>
<div id="tab1" style="<?= $menuactivea ?>">
<?
			if($tab=='tab1'){
					$pag = $tipo;
					$RegistrosAMostrar = 5;
					if(isset($pag)){
						$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
						$PagAct=$pag;
					}else{
						$RegistrosAEmpezar=0;
						$PagAct=1;
					}
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

					$consulta = $str;
					$str .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";

				$queryxt = $con->Query($str);
					echo '	<div class="row" style="margin-bottom:10px">
								<div class="col-md-6">
								</div>
								<div class="col-md-6" align="right">
									<button class="btn btn-warning" '.$c->Ayuda('174', 'tog').' onClick="ArchivarTodosCorreos(\'1\')"><span class="fa fa-archive"></span> Archivar Todos los Mensajes con Acuse</button>
								</div>
							</div>';	
					echo "
							<ul class='list-group' id='lista_acusables'>";
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

						
							echo "	<li class='list-group-item'>
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
									</li>";
					}
					if ($i == "0") {
						echo "<li class='list-group-item'> <br><div class='alert alert-info' role='alert'>No tienes mensajes con acuse.</div></li>";
					}
					echo "	</ul>";


					echo '<div class="btn-group m-t-30">';
					$qwat = $con->Query($consulta);
	        		$NroRegistros = $con->NumRows($qwat);

					$PagAnt=$PagAct-1;
			        $PagSig=$PagAct+1;
			        $PagUlt=$NroRegistros/$RegistrosAMostrar;
			        $Res=$NroRegistros%$RegistrosAMostrar;
					if ($bon == "1") {
				        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
					        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"1\", \"tab1\")' >Pag. 1</button> ";
				        if($PagAct>1) 
					        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
					        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
				        if($PagAct<$PagUlt)  
					        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
					        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
					}else{
				        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
					        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"1\", \"tab1\")' >Pag. 1</button> ";
				        if($PagAct>1) 
					        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
					        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
				        if($PagAct<$PagUlt)  
					        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
					        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
					}
			   		echo '</div>';
				}
?>
</div>
<div id="tab2" style="<?= $menuactiveb ?>">
<?
			if($tab=='tab2'){
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
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

					$consulta = $str;
					$str .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";

					$queryxt = $con->Query($str);
					echo '	<div class="row" style="margin-bottom:10px">
								<div class="col-md-6">
								</div>
								<div class="col-md-6" align="right">
									<button class="btn btn-warning" '.$c->Ayuda('175', 'tog').' onClick="ArchivarTodosCorreos(\'2\')"><span class="fa fa-archive"></span> Archivar Todos los Mensajes sin Acuse</button>
								</div>
							</div>';
					$i = 0;
					echo "	<div class=''>
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

						
							echo "	<li class='list-group-item'>
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
					}
					if ($i == "0") {
						echo "<li class='list-group-item'> <br><div class='alert alert-info' role='alert'>No tienes mensajes sin acuse.</div></li>";
					}
					echo "		</ul>
							</div>";

					echo '<div class="btn-group m-t-30">';
					$qwat = $con->Query($consulta);
	        		$NroRegistros = $con->NumRows($qwat);

					$PagAnt=$PagAct-1;
			        $PagSig=$PagAct+1;
			        $PagUlt=$NroRegistros/$RegistrosAMostrar;
			        $Res=$NroRegistros%$RegistrosAMostrar;
					if ($bon == "1") {
				        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
					        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"1\", \"tab2\")' >Pag. 1</button> ";
				        if($PagAct>1) 
					        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
					        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
				        if($PagAct<$PagUlt)  
					        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
					        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
					}else{
				        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
					        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"1\", \"tab2\"))' >Pag. 1</button> ";
				        if($PagAct>1) 
					        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
					        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
				        if($PagAct<$PagUlt)  
					        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
					        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
					}
			   		echo '</div>';

			}
			?>
</div>
<div id="tab3" style="<?= $menuactivec ?>">
<?
			if($tab=='tab3'){
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
				$statuses = "and (mailer_replys.message_status = '3')";

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

				$consulta = $str;
				$str .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";

				$queryxt = $con->Query($str);
				$i = 0;
				echo "	<div class=''>
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

					
						echo "	<li class='list-group-item'>
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
				}

				if ($i == "0") {
					echo "<li class='list-group-item'> <br><div class='alert alert-info' role='alert'>No tienes mensajes archivados.</div></li>";
				}

				echo "		</ul>
						</div>";

				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);

				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"1\", \"tab3\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"1\", \"tab3\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Bandeja de Correos Electrónicos\", \"correoelectronico\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
			}
?>
			</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
	});

	function ActivarTab(tab, selector){

		$("#buscartab1").removeClass('active');
		$("#buscartab2").removeClass('active');
		$("#buscartab3").removeClass('active');

		$("#tab1").css('display', 'none');
		$("#tab2").css('display', 'none');
		$("#tab3").css('display', 'none');

		$("#"+selector).addClass("active");
		$("#"+tab).css("display", 'block');

	}
	ActivarTab('<?php echo $tab; ?>', 'buscar<?php echo $tab; ?>');
</script>
<style type="text/css">
	
	.busquedaresultadotab{
	    min-height: 400px;
	    border-top: none;
	    margin-top: -1px;
	    display: none;
	}

	#tab_navegacion_widgets.nav>li>a {
	    position: relative;
	    display: block;
	    padding: 10px 15px;
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
</style>