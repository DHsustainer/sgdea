<div class="block_mailer_body">

	

	<div class='mailer_header'>

		<div class="mailer_title">

			<?= $title; ?>

		</div>

		<div class="mailer_other_actions"></div>

	</div>



	<div id='contenido_bloque' style="height:auto; overflow:auto;">



		<div style="min-height:450px; margin-top:5px;" id="mail_body_acuse">

				

			<?



	$value = trim($id);

	$value = explode('.', $value);



	#date_default_timezone_set("America/Bogota");



	$_SESSION['SID'] = $value[0];



	global $f;

	global $c;

	global $con;

	$status = 1;



	$r = new MMailer_Replys;

	$r->CreateMailer_replys("receiver_token", $_SESSION['SID']);

	

	$to = new MMailer_from_message;

	$to->CreateMailer_from_message("token_ID", $_SESSION['SID']);



	$m = new MMailer_message;

	$m->CreateMailer_message("message_id", $to->GetMessage_code());







	$atachments = new MMailer_attachments;

	$archivos_adjuntos = $atachments->ListarMailer_attachments('where message_id = "'.$m->GetMessage_id().'"', 'order by id', 'limit 1000');





	$id_notification = $atachments->GetAlt();



	$me = new MUsuarios;

	$me->CreateUsuarios("user_id", $m->GetUser_ID());



	//print_r($m);

	$rstatus = array("1" => "El mensaje fue <strong>Abierto</strong>", "2" => "El mensaje ah sido <strong>Rehusado</strong>", "3" => "El mensaje fue <strong>abierto</strong> con anterioridad");

	

	if($r->GetReply_datetime() == ""){



		$replydate = date("Y-m-d H:i:s");



	}else{

		$replydate = $r->GetReply_datetime();

	}



	$status_message = "";

	if($r->GetReply_ip() == ""){

			$status_message = $rstatus[$value[1]];

	}else{

			$status_message = $rstatus[3];

	}



	$message = $to->GetMessage_id();

    $id_p = $m->GetP_id();



    if ($id_p != "0") { 

	    $dem = new MCaratula;

	    $dem->CreateCaratula("id", $id_p);



	    $titulo = $dem->GetTit_demanda();

    	# code...

    }else{

    	$titulo = $m->GetSubject();

    }



    if($m->GetExp_day() >= date("Y-m-d") || $status_message != "1"){



?>

		<div id="main_content_acuse">

			<table border="0" width="100%" cellspacing="0" cellpadding="10" style="font-size:11px;">

				<tr>

					<td width="50px" style="background:#EBEAEF; font-size:11px;">Asunto</td>

					<td style="background:#EBEAEF; font-size:14px;"><?= $m->GetSubject(); ?></td>

				</tr>

			</table>



			<table border="0" width="100%" cellspacing="10" cellpadding="8" style="font-size:11px; margin-top:10px;">

				<tr>

					<td colspan="4" style="background-color:#546674; font-size: 14px; color: #FFF">De: <?= $me->GetP_nombre()." ".$me->GetP_apellido(); ?> (<?= $m->GetFrom_nom() ?>)</td>

				</tr>

				<tr>

					<td width="90px" style="background:#1579C4; color: #FFF">Para</td>

					<td width="220px"><?= $to->GetEmail() ?></td>

					<td width="90px" style="background-color:#546674; color: #FFF">Estado</td>

					<td><?= $status_message; ?></td>

				</tr>

				<tr>

					<td style="background:#1579C4; color: #FFF">Abierto</td>

					<td><?= $replydate ?></td>

					<td style="background-color:#546674; color: #FFF">Expiración</td>

					<td><?= $m->GetExp_day(); ?></td>

				</tr>

				<tr>

					<td style="background:#1579C4; color: #FFF; font-size: 14px; text-align: center" colspan="4">Mensaje</td>

				</tr>

				<tr>

					<td colspan="4">

					<?

						if($r->GetReply_ip() == ""){





							$constrain = "receiver_token = '".$to->GetToken_ID()."'";



							$ip= $_SERVER['REMOTE_ADDR']; #"181.32.105.81";



							$preurl="http://whatismyipaddress.com/ip/$ip/";

							$query = urlencode('select * from html where url="'.$preurl.'" and xpath="*"');

							$url = "http://query.yahooapis.com/v1/public/yql?q=".$query; 



							$html = file_get_html($url);

							$ar = array();



							foreach($html->find('#section_left_3rd td',  null) as $e){

								array_push($ar, $e->innertext);

							}

							$IP 			= $f->UnDirt($ar[0]); 

							$Hostname	    = $f->UnDirt($ar[2]); 

							$ISP 		    = $f->UnDirt($ar[3]); 

							$Organization	= $f->UnDirt($ar[4]); 



							$Country 		= $f->UnDirt($ar[9]);

							$State 			= $f->UnDirt($ar[10]);

							$City 			= $f->UnDirt($ar[11]); 

							$Latitude	 	= "";

							$Longitude	    = "";



							$lat = "";

							$lng = "";



							$constrain = "WHERE receiver_token = '".$to->GetToken_ID()."'";



							$dns = $f->GetDNS();



							$fields = array("message_status","reply_datetime","reply_ip","sesionID","details", "dns","hostname","isp","organization","country","state","city","latitude","longitude","lt","lg");



							$data = array($status,date("Y-m-d H:i:s"),$_SERVER['REMOTE_ADDR'],$_SESSION["sID"],"", $dns, $Hostname, $ISP, $Organization, $Country, $State, $City, $Latitude, $Longitude, $lat, $lng );

							$output = array("Query Correct","Query Error");



							$r->UpdateMailer_replys($constrain, $fields, $data, $output);	



							$MPlantillas_email = new MPlantillas_email;

							$MPlantillas_email->CreatePlantillas_email('id', '7');

							$contenido_email = $MPlantillas_email->GetContenido();

							$contenido_email = str_replace("[elemento]CODIGO_MENSAJE[/elemento]",      $r->GetMessage_id(),     $contenido_email );

							$contenido_email = str_replace("[elemento]USUARIO[/elemento]",$to->GetEmail(),     	   $contenido_email );

							$contenido_email = str_replace("[elemento]Estado[/elemento]",      $rstatus[$status],   $contenido_email );
							$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );


							$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$m->GetFrom_nom());



							

							$objecte = new MEvents_gestion;

							// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

							/*

								InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

							*/

							$usuario = $m->GetUser_ID();

							$userd = new MUsuarios;

							$userd->CreateUsuarios("user_id", $usuario);

							$objecte->InsertEvents_gestion($usuario, $m->GetP_id(), date("Y-m-d"), "Se ha notificado electronicamente", "Tiene un acuse de recibo del mensaje $email", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $userd->GetSeccional(), $userd->GetRegimen(), $userd->GetRegimen(), $userd->GetA_i(), "reciv", $to->GetId());





						    ?>

								<script>

								/*

									var latitud = "<?= $Latitude;?>";

									var longitud = "<?= $Longitude;?>";



									if(latitud == "" && longitud == ""){

										getLocation();



									}

									function getLocation() {

									    if (navigator.geolocation) {

									        navigator.geolocation.getCurrentPosition(showPosition);

									    }else{alert("No Consigue La Ip :(");}

									}



									function showPosition(position) {

									     var lat = position.coords.latitude;

									     var lon =  position.coords.longitude;

									     $.ajax({

									     	type:"POST",

									     	url:"/correo/cambiarIp/",

									     	data:{'lat':lat,'lon':lon,'token':'<?= $_SESSION['SID'];?>'},

									     	success:function(msg){

									     		//alert(msg);

									     	}

									     });

									}

									*/

								</script>

						    <?



						}



						if($status == "1"){

							echo '<table style="width:100%" cellpadding="5" cellspacing="0"> 

									<tr>

										<td align="left" class="title_table" width="120px">Anexos:</td>

										<td align="left" class="text_table">';

										echo "<ul id='listado_anexos'>";

										while ($rrx = $con->FetchAssoc($archivos_adjuntos)) {

											$att = new MMailer_attachments;

											$att->CreateMailer_attachments("id", $rrx["id"]);

/*



											if($att->GetType() == "1" || $att->GetType() == "2" || $att->GetType() == "4" ){

												$name_not = $att->GetTitle();

												$ruta = HOMEDIR.DS.$att->GetFilename();

												echo '<li><a href="'.$ruta.'" target="_blank">'.$name_not.'</a></li>';



											}

											if($att->GetType() == "3"){

													*/

												$file = $att->GetFilename();

												$ruta = $att->GetFilename();

												$name_not = $att->GetTitle();

												$cadena_nombre = substr($file,0,200);



												$extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));	



												echo '<li><a href="'.$ruta.'" target="_blank">'.$name_not.'</a></li>';

#											}			

										}

										echo "</ul>

										</td>

									</tr>

									<tr>

										<td align='left' valign='top' class='title_table'>Mensaje:</td>

										<td align='left' valign='top' class='text_table'>".$m->GetMessage()."</td>

									</tr>

								</table>";



						    echo "<div class='clearb'></div>";



						}else{

							

							echo '	<div id="main_content_acuse">

										<div class="da-message error">

					    					Se ha reusado a leer el mensaje :\'(

					    				</div>

									</div>';

						}

					?>						

					</td>

				</tr>

				<?

					if($r->GetDetails() == ""){

				?>

						<tr>

							<td colspan="2" align="left"  style="font-size:12px;">

								<input type="button" value="Puede responder a este mensaje aqui" id="replymessage">

							</td>

							<td colspan="2" align="right"  style="background:#EBEAEF; font-size:13px;">

								Enviado el <b><?= $m->GetDate() ?></b>

							</td>

						</tr>

				<?

					}else{

				?>

						<tr>

							<td colspan="2" align="left"  style="font-size:12px;">

								<input type="button" value="Leer respuesta" id="replymessage">

							</td>

							<td colspan="2" align="right"  style="background:#EBEAEF; font-size:13px;">

								Enviado el <b><?= $m->GetDate() ?></b>

							</td>

						</tr>

				<?		

					}

				?>

			</table>



			<div id="reply_message" style="display:none">

				<table style="width:100%" cellpadding="5" cellspacing="0"> 

					<form id="sendreply">

					<tr>

						<td align="left" class="title_table" width="90px">Para:</td>

						<td align="left" class="text_table"><?= $me->GetP_nombre()." ".$me->GetP_apellido(); ?> (<?= $m->GetFrom_nom() ?>)</td>

					</tr>			

					<tr>

						<td align="left" width="90px" class="title_table">Asunto:</td>

						<td align="left" class="text_table" colspan="4">

							<input type="text" id="newsubject" name="newsubject" value="RE: <?= $m->GetSubject(); ?>" size="71">

							<input type="hidden" id="sid" name="sid" value="<?= $_SESSION['SID']; ?>">

						</td>

					</tr>

					<tr>

						<td align="left" width="90px" class="title_table" valign="top">Mensaje:</td>

						<td align="left" class="text_table" colspan="4" height="200px;">

							<?

								if($r->GetDetails() == ""){

									if ($id_p != "0") { 

										$body = "\n\n\n---------------------------------------------------------------------\n\nRemitente: ".$me->GetP_nombre()." ".$me->GetP_apellido()."\n\nDemanda: ".$dem->GetTit_demanda()."\n\nAsunto: ".$m->GetSubject()."\n\nFecha: ".$m->GetDate()."\n\nEste es un Aviso de Comunicación Electr&oacute;nica Registrada\n\n---------------------------------------------------------------------";

								    }else{

										$body = "\n\n\n---------------------------------------------------------------------\n\nRemitente: ".$me->GetP_nombre()." ".$me->GetP_apellido()."\n\nAsunto: ".$m->GetSubject()."\n\nFecha: ".$m->GetDate()."\n\nEste es un Aviso de Comunicación Electr&oacute;nica Registrada\n\n---------------------------------------------------------------------";

								    }

									echo '<textarea name="mytextarea" id="mytextarea" cols="70" style="height:200px;">'.$body.'</textarea>';

				

								}else{

									echo '<textarea name="mytextarea" id="mytextarea" cols="70" style="height:200px;" readonly="readonly" style="background-color:#FFF; border:1px solid #FFF;">'.$r->GetDetails().'</textarea>';

								}



							?>



						</td>

					</tr>



				<?

					if($r->GetDetails() == ""){

				?>

					<tr>

						<td colspan="2" class="text_table"><input type="button" value="Enviar Mensaje" id="sendmessage"></td>

					</tr>

				<?

					}else{

				?>

					<tr align="left">

						<td colspan="2" class="text_table"><input type="button" value="Ocultar Respuesta" id="hidebox"></td>

					</tr>

				<?		

					}

				?>	

					</form>			

				</table>

			</div>

		</div>





<?	

}else{

		echo '	<div id="main_content_acuse">

					<div class="da-message error">

    					El Mensaje que intenta ver ya ha expirado.

    				</div>

				</div>';

}

?>

<!--

<div id="mascara_registro">

    <div id="mascara_contenido">

        <div id="cerrar"></div>

        <div class="titulo" id="titulo_bloque_mascara"></div>

        <div id="contenido_bloque"></div>

    </div>

</div>  -->



<script>





	function coordenadas(position) {

	 	var latitud = position.coords.latitude;

		var longitud = position.coords.longitude;



		$.ajax({

			type:'post',

			url:'/correo/geolocation/',

			data:{'latitud':latitud,'longitud':longitud,'token':'<?= $_SESSION['SID'] ?>'},

			success:function(msg){

				console.log(msg);

			}

		});

	}



	if (navigator.geolocation) {

		navigator.geolocation.getCurrentPosition(coordenadas);



	}else{

		alert('Tu navegador no soporta la API de geolocalizacion');

	}







	$("#replymessage").live("click", function(){



		$("#reply_message").slideDown();



	})



	$("#hidebox").live("click", function(){



		$("#reply_message").slideUp();



	})



	$("#sendmessage").live("click", function(){



		str = $("#sendreply").serialize();

		$.ajax({

			type: 'POST',

			url: '<?= HOMEDIR.DS."correo".DS."respondermensaje".DS ?>',

			data: str,

			success: function(msg){

				alert("Mensaje Enviado");

				$("#reply_message").slideUp();

				window.location.reload();

			}

		});



	})

</script>

<script type="text/javascript">

	function AbrirDocumento(url, type, title){

		//$("#mascara_registro").fadeIn("fast");

		$("#titulo_bloque_mascara").html(title);



		id = $('#mascara_registro');



		//Get the screen height and width

		var maskHeight = $(document).height();

		var maskWidth = $(window).width();



		//Set heigth and width to mask to fill up the whole screen

		$('#mascara_registro').css({'width':maskWidth,'height':maskHeight});

		

		//transition effect		

		$('#mascara_registro').fadeIn(1000);	

		$('#mascara_registro').fadeTo("slow",1);	



		//Get the window height and width

		var winH = $(window).height();

		var winW = $(window).width();

	          

		//Set the popup window to center

		$(id).css('top',  winH/2-$(id).height()/2);

		$(id).css('left', winW/2-$(id).width()/2);



		//transition effect

		$(id).fadeIn(2000); 





			var box = $('#mascara_registro');



	    //Get the screen height and width

	    var maskHeight = $(document).height();

	    var maskWidth = $(window).width();

	  

	    //Set height and width to mask to fill up the whole screen

	    $('#mask').css({'width':maskWidth,'height':maskHeight});

	           

	    //Get the window height and width

	    var winH = $(window).height();

	    var winW = $(window).width();



	    //Set the popup window to center

	    box.css('left', winW/2 - box.width()/2);







		var str = "url="+url+"&type="+type;

	    $.ajax({

	        type: 'POST',

	        url: 'preview_file.php',

	        data: str,

	        success: function(msg){

	        	result = msg;

	        	$("#contenido_bloque").html(result);

	            // Some code here!

	        }

	    }); 



	}	









</script>	

<style>

	#listado_anexos{

		margin-top: 0px;

		margin-left: 0px;

		margin-top: 3px;

		margin-bottom: 3px;

		padding-top: 3px;

		padding-bottom: 3px;

		padding-left: 0px;

	}

	#listado_anexos li{

		list-style: none;

		font-style: italic;

		font-size: 12px;

		padding-top: 4px;

		padding-bottom: 4px;

		margin-top: 0px;

		margin-bottom: 0px;

		line-height: 16px;

		background: url(images/iconos/upload.png) no-repeat;

		padding-left: 18px;

	}

	#listado_anexos li:hover{

		cursor:pointer;

		text-decoration: underline;

	}

</style>



		</div>    

	</div>

</div>



	</div>

</div>

<style>

H1.SaltoDePagina{

    PAGE-BREAK-AFTER: always

}

.mot {

	background-color: #1579C4;

	background: #1579C4;

	color: #FFF;

	font-weight: bold;

	line-height: 35px;

	padding-left: 20px;

	margin-bottom: 0px;

	margin-top: 20px;

}

#anexos_correo ul{

	list-style: none;

	list-style-type: circle;

	margin-left: 0px;

	padding-left: 13px;

	margin-top: 0px;

	padding-top: 0px;

}



#anexos_correo li{

	line-height: 30px;

	color:#2E6CAB;

}



#anexos_correo li:hover{

	cursor:pointer;

	text-decoration: underline;

	background: #F5F5F5;



}



#vip:hover, #vgeo:hover{

	cursor:pointer;

	text-decoration: underline;



}

.gmaps{

    width: 470px;

    height: 380px;

  }



  #listado_anexos{

		margin-top: 0px;

		margin-left: 0px;

		margin-top: 3px;

		margin-bottom: 3px;

		padding-top: 3px;

		padding-bottom: 3px;

		padding-left: 0px;

	}

	#listado_anexos li{

		list-style: none;

		font-style: italic;

		font-size: 12px;

		padding-top: 4px;

		padding-bottom: 4px;

		margin-top: 0px;

		margin-bottom: 0px;

		line-height: 16px;

		background: url(images/iconos/upload.png) no-repeat;

		padding-left: 18px;

	}

	#listado_anexos li:hover{

		cursor:pointer;

		text-decoration: underline;

	}

</style>



