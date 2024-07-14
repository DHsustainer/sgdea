<?
	$value = trim($mid);
	$value = explode('.', $value);
	#date_default_timezone_set("America/Bogota");
	$_SESSION['SID'] = $value[0];
	global $f;
	global $c;
	global $con;
	$status = $value[1];
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
    if($m->GetExp_day() >= date("Y-m-d") || $status_message == ""){
?>
<div class="row">
  	<div class="col-md-8 col-md-offset-2" style="background: #FFF">
  		<div class="row">
  			<div class="col-md-12">
  				<h3>Asunto: <b><?= $m->GetSubject(); ?></b></h3>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-1">De:</div>
  			<div class="col-md-11"><?= $me->GetP_nombre()." ".$me->GetP_apellido(); ?> (<?= $m->GetFrom_nom() ?>)</div>
  		</div>
  		<div class="row">
  			<div class="col-md-1">Para:</div>
  			<div class="col-md-5"><?= $to->GetEmail() ?></div>
  			<div class="col-md-2">Estado del mensaje:</div>
  			<div class="col-md-4"><?= $status_message; ?></div>
  		</div>
  		<div class="row">
  			<div class="col-md-2">Fecha de Lectura:</div>
  			<div class="col-md-4"><?= $replydate ?></div>
  			<div class="col-md-2">Disponible Hasta:</div>
  			<div class="col-md-4"><?= $m->GetExp_day(); ?></div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  				<h4>Documentos Adjuntos</h4>
<?
			if($r->GetReply_ip() == ""){
				$constrain = "receiver_token = '".$to->GetToken_ID()."'";
				$ip= $_SERVER['REMOTE_ADDR']; #"181.32.105.81";
				$ar = array();
				$preurl="http://whatismyipaddress.com/ip/$ip/";
				$query = urlencode('select * from html where url="'.$preurl.'" and xpath="*"');
				$url = "http://query.yahooapis.com/v1/public/yql?q=".$query; 
				/*$html = file_get_html($url);
				foreach($html->find('#section_left_3rd td',  null) as $e){
					array_push($ar, $e->innertext);
				}*/
				$IP 			= $f->UnDirt($ar[0]); 
				$Hostname	    = $f->UnDirt($ar[2]); 
				$ISP 		    = $f->UnDirt($ar[3]); 
				$Organization	= $f->UnDirt($ar[4]); 
				$Country 		= "";
				$State 			= "";
				$City 			= "";
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
				$usuario = $m->GetUser_ID();
				$userd = new MUsuarios;
				$userd->CreateUsuarios("user_id", $usuario);
				$objecte->InsertEvents_gestion($usuario, $m->GetP_id(), date("Y-m-d"), "Se ha notificado electronicamente", "Tiene un acuse de recibo del mensaje $email", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $userd->GetSeccional(), $userd->GetRegimen(), $userd->GetRegimen(), $userd->GetA_i(), "reciv", $to->GetId());
			}
			if($status == "1"){
			$viewer =       array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,
		                          ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,
		                          ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,
		                          ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,
		                          ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,
		                          "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,
		                          "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,
		                          ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video"							, ".csv" => "google"                        ,
		                          ".DOC" => "google"                        , "DOCX" => "google"                        , ".ZIP" => "google"                        , ".RAR" => "google"                        ,
		                          ".TAR" => "google"                        , ".XLS" => "google"                        , "XLSX" => "google"                        , ".PPT" => "google"                        ,
		                          ".PPS" => "google"                        , "PPTX" => "google"                        , "PPSX" => "google"                        , ".PDF" => "google"                        ,
		                          ".TXT" => "google"                        , ".JPG" => "image"                         , "JPEG" => "image"                         , ".BMP" => "image"                         ,
		                          ".GIF" => "image"                         , ".PNG" => "image"                         , ".DIV" => "image"                         , ".TIF" => "image"                         ,
		                          "TIFF" => "image"                         , "MPEG" => "video"                         , ".AVI" => "video"                         , ".MP4" => "video"                         ,
		                          "MIDI" => "audio"                         , ".ACC" => "audio"                         , ".WMA" => "audio"                         , ".OGG" => "audio"                         ,
		                          ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google"						,
		                          ".xml" => "google");
			$class =       array(".doc" => "file-word-o"                        , "docx" => "file-word-o"                   , ".zip" => "file-zip-o"                    , ".rar" => "file-zip-o"                    ,
		                          ".tar" => "file-zip-o"                        , ".xls" => "file-excel-o"                  , "xlsx" => "file-excel-o"                  , ".ppt" => "file-powerpoint-o"             ,
		                          ".pps" => "file-powerpoint-o"                	, "pptx" => "file-powerpoint-o"             , "ppsx" => "file-powerpoint-o"             , ".pdf" => "file-pdf-o"                    ,
		                          ".txt" => "file-word-o"                     	, ".jpg" => "file-image-o"                  , "jpeg" => "file-image-o"                  , ".bmp" => "file-image-o"                  ,
		                          ".gif" => "file-image-o"                      , ".png" => "file-image-o"                  , ".dib" => "file-image-o"                  , ".tif" => "file-image-o"                  ,
		                          "tiff" => "file-image-o"                      , "mpeg" => "file-movie-o"                  , ".avi" => "file-movie-o"                  , ".mp4" => "file-movie-o"                  ,
		                          "midi" => "file-sound-o"                      , ".acc" => "file-sound-o"                  , ".wma" => "file-sound-o"                  , ".ogg" => "file-sound-o"                  ,
		                          ".mp3" => "file-sound-o"                      , ".flv" => "file-movie-o"                  , ".wmv" => "file-movie-o"					, ".csv" => "file-excel-o"                  ,
		                          ".DOC" => "file-word-o"                       , "DOCX" => "file-word-o"                   , ".ZIP" => "file-zip-o"                    , ".RAR" => "file-zip-o"                    ,
		                          ".TAR" => "file-zip-o"                        , ".XLS" => "file-excel-o"                  , "XLSX" => "file-excel-o"                  , ".PPT" => "file-powerpoint-o"             ,
		                          ".PPS" => "file-powerpoint-o"                 , "PPTX" => "file-powerpoint-o"             , "PPSX" => "file-powerpoint-o"             , ".PDF" => "file-pdf-o"                    ,
		                          ".TXT" => "file-word-o"                      	, ".JPG" => "file-image-o"                  , "JPEG" => "file-image-o"                  , ".BMP" => "file-image-o"                  ,
		                          ".GIF" => "file-image-o"                      , ".PNG" => "file-image-o"                  , ".DIV" => "file-image-o"                  , ".TIF" => "file-image-o"                  ,
		                          "TIFF" => "file-image-o"                      , "MPEG" => "file-movie-o"                  , ".AVI" => "file-movie-o"                  , ".MP4" => "file-movie-o"                  ,
		                          "MIDI" => "file-sound-o"                      , ".ACC" => "file-sound-o"                  , ".WMA" => "file-sound-o"                  , ".OGG" => "file-sound-o"                  ,
		                          ".MP3" => "file-sound-o"                      , ".FLV" => "file-movie-o"                  , ".WMV" => "file-movie-o"					, ".CSV" => "file-excel-o"					,
		                          ".xml" => "file-code-o");
				while ($rrx = $con->FetchAssoc($archivos_adjuntos)) {
					$att = new MMailer_attachments;
					$att->CreateMailer_attachments("id", $rrx["id"]);
						$file = $att->GetFilename();
						$ruta = $att->GetFilename();
						$name_not = $att->GetTitle();


						$cadena_nombre = $file;
						$fulef = explode("/", $ruta);
						$fule = end($fulef);
						$ext = ".".end(explode(".", $fule));
						$extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));	

						$idg    = @$fulef[6];

						echo '	<div class="btn-group">
								  <button type="button" class="btn btn-info">'.$name_not.'</button>
								  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="caret"></span>
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <ul class="dropdown-menu">
								    <!--<li><a href="#">Visualizar</a></li> -->
								    <li><a href="/app/plugins/descargar.php?ga='.$idga.'&g='.$idg.'&f='.$file.'&tf='.$name_not.'&format='.$class['$extension'].' " target="_blank">Descargar</a></li>
								  </ul>
								</div>';
				}
/*					
											/app/plugins/descargar.php?f=https://expedientesdigitales.com/app/archivos_uploads/gestion/1/anexos/af961293336210ed3b44f829016efc6d.pdf&tf=14599748-Las-TIC-en-Colombia-trazos-y-retrasos.pdf&format=pdf
*/
				echo "	<div class='row'>
							<div class='col-md-12'><hr></div>
						</div>
						<div class='row'>
							<div class='col-md-12'>".$m->GetMessage()."</div>
						</div>";
			}else{
				echo '	<div class="row">
							<div class="col-md-12">
								<div class="alert alert-danger">Se ha reusado a leer el mensaje :\'(</div>
		    				</div>
						</div>';
			}
?>  				
  			</div>
  		</div>
<?
		if($r->GetDetails() == ""){
?>
			<div class='row'>
				<div class='col-md-12'><hr></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="button" value="Puede responder a este mensaje haciendo clic aqui" id="replymessage">
					Enviado el <b><?= $m->GetDate() ?></b>
				</div>
			</div>
<?
		}else{
?>
			<div class='row'>
				<div class='col-md-12'><hr></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="button" value="Leer respuesta" id="replymessage">
					Enviado el <b><?= $m->GetDate() ?></b>
				</div>
			</div>
<?		
		}
?>
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
									$body = "\n\n\n---------------------------------------------------------------------\n\nRemitente: ".$me->GetP_nombre()." ".$me->GetP_apellido()."\n\nAsunto: ".$m->GetSubject()."\n\nFecha: ".$m->GetDate()."\n\nEste es un Aviso de Comunicación Electr&oacute;nica Registrada\n\n---------------------------------------------------------------------";
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
	</div>
</div>		
<div id="direccion">-</div>
<?	
}else{
	echo '	<div class="row">
				<div class="col-md-12"><br>
					<div class="alert alert-danger">El Mensaje que intenta ver ya expiró.</div>
				</div>
			</div>';
}
?>
<script>
	function coordenadas(position) {
	 	var latitud = position.coords.latitude;
		var longitud = position.coords.longitude;
		convertirGpsADireccion(latitud, longitud, mostrarDireccion); 
		$.ajax({
			type:'post',
			url:'/correo/geolocation/',
			data:{'latitud':latitud,'longitud':longitud,'token':'<?= $_SESSION['SID'] ?>'},
			success:function(msg){
			}
		});
	}
	function mostrarDireccion(response) {
		$('#direccion').text(response.display_name);
		altdata = response.display_name;
		$.ajax({
			type:'post',
			url:'/correo/alterdata/',
			data:{'altdata':altdata,'token':'<?= $_SESSION['SID'] ?>'},
			success:function(msg){
				$("#direccion").text(msg);
			}
		});
	}
	function convertirGpsADireccion(lat, lon, callback) {
        $.getJSON("https://nominatim.openstreetmap.org/reverse?format=json&addressdetails=0&zoom=18&lat=" + lat + "&lon=" + lon + "&json_callback=?", callback);
    }
    function btnConvertirClick() {
        var lat = $('#lat').val();
        var lon = $('#lon').val();
        if (lat === '' || lon === '' || isNaN(lat) || isNaN(lon))
            alert('Indique unas coordenadas GPS válidas');
        else
            convertirGpsADireccion(lat, lon, mostrarDireccion); 
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
	.btn-group>.btn+.dropdown-toggle {
	    padding-top: 14px;
	    padding-bottom: 14px;
	}
	.row {
	    margin-right: 0px !important;
	    margin-left: 0px !important;
	}
</style>