<?
	$message_id = $arr[0];

	$r = new MMailer_Replys;
	$r->CreateMailer_replys("receiver_token", $message_id);


	$m = new MMailer_message;
	$m->CreateMailer_message("message_id",$r->GetMessage_id());

	$fm = new MMailer_from_message;
	$fm->CreateMailer_from_message("token_ID", $message_id);
	
	$at = new MMailer_Attachments;
	$attachments = $at->ListarMailer_attachments("WHERE message_id = '".$r->GetMessage_id()."'");


	$fields = array("readed");
	$constrain = "WHERE receiver_token = '".$message_id."'";
	$data = array("1");
	$output = array("Query Correct","Query Error");
	

	$qup = $r->UpdateMailer_replys($constrain, $fields, $data, $output);	

	$readtime = explode(" ", $r->GetReply_datetime());

	$title = $m->GetSubject();

	if( $r->GetSubject() != "" ){

		$title = $r->GetSubject();

	}
?>
<div class="block_mailer_body">

	<div id='contenido_bloque' style="height:auto; overflow:auto;">

<div style="min-height:450px; margin-top:5px;" id="mail_body_acuse">
<?
	
	$rstatus = array("1" => "El mensaje fue <strong>Abierto</strong>", "2" => "El mensaje fue <strong>Rehusado</strong>", "0" => "El mensaje <strong>No fue leido</strong>");
	
	echo "	<div>
				<table style='width:100%' cellpadding='1' >
					<tr>
						<td>&nbsp;</td>
						<td align='left' class='titulo'><b>".$title."</b></td>
					</tr>
					<tr>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>De:</b></td>
						<td align='left' >".$fm->GetName()." ".$fm->GetEmail()."</td>
					</tr>
					<tr>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Para:</b></td>
						<td align='left'>(Mí) ".$m->GetName()." (".$m->GetFrom_nom().")</td>
					</tr>
					<tr>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Fecha de Lectura:</b></td>
						<td align='left'>".$f->ObtenerFecha($readtime[0])." ".$readtime[1]."</td>
					</tr>
					<tr>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Enviado por:</b></td>
						<td align='left'>".HOMEDIR." (".$r->GetDNS().")</td>
					</tr>
					<tr>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Estado:</b></td>
						<td align='left'>".$rstatus[$r->GetMessage_status()]."</td>
					</tr>
				</table>
			
			<div style='margin-left:20px;margin-right:20px; padding:20px;  background-color: #EBEAEF'>  
				<table border='0'>
					<tr>
						<td align='left' colspan='3' id='vip' class='titulo' style='height:60px;'>Ocultar Informacion de IP</td>
						<td rowspan='11' width='10px'></td>
						<td rowspan='11' width='25px' style='background-color:#546674'></td>
						<td rowspan='11' align='left'>
					        <div class='gmaps acf-map' style='width: 360px; height: 380px;'>
					            <div class='marker' data-lat='".$r->Getlt()."' data-lng='".$r->Getlg()."'></div>
					        </div>
					    </td>
					</tr>
					<tr>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Direccion IP:</b></td>
						<td class='ipdata' width='230px' align='left'>".$r->GetReply_ip()."</td>
					</tr>
					<tr class='ipdata'>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Host </b>:</td>
						<td align='left'>".$r->GetHostname()."</td>
					</tr>
					<tr class='ipdata'>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>ISP </b>:</td>
						<td align='left'>".$r->GetIsp()."</td>
					</tr>
					<tr class='ipdata'>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Empresa </b>:</td>
						<td align='left'>".$r->GetOrganization()."</td>
					</tr>
					<tr>
						<td colspan='3' align='left' id='vgeo' class='titulo' style='height:60px;'>Ocultar Geo Localizacion</td>
					</tr>
					<tr class='geodata'>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Pais:</b></td>
						<td align='left'>".utf8_encode($r->GetCountry())."</td>
					</tr>
					<tr class='geodata'>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Departamento:</b></td>
						<td align='left'>".utf8_decode($r->GetState())."</td>
					</tr>
					<tr class='geodata'>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Ciudad:</b></td>
						<td align='left'>".utf8_decode($r->GetCity())."</td>
					</tr>
					<tr class='geodata'>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Latitud:</b></td>
						<td align='left'>".utf8_decode($r->GetLatitude())."</td>
					</tr>
					<tr class='geodata'>
						<td align='right' width='120px' style='font-size:13px; height: 23px; padding-right:20px;'><b>Longitud:</b></td>
						<td align='left'>".utf8_decode($r->GetLongitude())."</td>
					</tr>
				</table>
			</div>

			<H1 class='SaltoDePagina'></H1>
			
			<div class='mot'>Mensaje Original</div>
			<div>".$fm->GetMessage()."</div>

			<div class='mot'>Documentos Adjuntos</div>
				<table>
					<tr>
						<td align='left' id='anexos_correo'>";
							
		$viewer =       array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,
                              ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,
                              ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,
                              ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,
                              ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,
                              "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,
                              "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,
                              ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video");

							while($rowat = @$con->FetchAssoc($attachments)){
								$att = new MMailer_Attachments;
								$att->CreateMailer_Attachments("id", $rowat["id"]);

								$type=explode('.', $rowat['filename']);
								$type=array_pop($type);
								#if($att->GetType() == "3"){

									$file = $att->GetFilename();
									$ruta = HOMEDIR.DS.$att->GetFilename();
							        #$ruta = ."app/archivos_uploads/".$_SESSION["usuario"].trim("/anexos/ ").$file."";

									$name_not = $att->GetTitle();
									$cadena_nombre = substr($file,0,200);

									$extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));	


								#	echo '<li onclick="AbrirDocumento(\''.$ruta.'\',\''.$viewer[$extension].'\',\''.$name_not.'\')">'.$name_not.'</li>';
								#}

								  echo "  	<div class='anexos-div' id='$rowat[id]' style='border:none'>
								  				<a href='".$ruta."' target='_blank'>
							                    	<div title='$name_not' style='padding-top:0px; margin-top:-15px;' class='img-icon $type'></div>
							                		<div style='font-size:12px; font-style:italic'>".strtolower(substr($name_not, 0, 25))."...</div>
								  				</a>
							                </div>";			
							}
			echo "			
						</td>
					</tr>					
				</table>
				<hr style='width:100%'>";

		if($r->GetDetails() != ""){
			echo "	<p>
						<div class='mot'>El remitente ha escrito una respuesta a este mensaje</div>
							<div style='margin-left:35px;margin-top:15px'>".str_replace("\n", "<br>", $r->GetDetails())."</div>
						</div>
					</p>";						
		}			
	
	echo "	</div>";
?>

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
<script>
	function imprSelec(nombre){
	  	var ficha = document.getElementById(nombre);
	  	var ventimp = window.open(' ', 'popimpr');
	  	ventimp.document.write(ficha.innerHTML );
	  	ventimp.document.close();
	  	ventimp.print( );
	  	ventimp.close();
	} 
</script>

<script>
		
	$("#vip").live("click", function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(".ipdata").slideDown("fast");
			$(this).html("Ocultar informacion de IP");
		}else{
			$(this).addClass("active");
			$(".ipdata").slideUp("fast");
			$(this).html("Ver informacion de IP");
		}
	})		
	$("#vgeo").live("click", function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(".geodata").slideDown("fast");
			$(this).html("Ocultar Geo localizacion");
		}else{
			$(this).addClass("active");
			$(".geodata").slideUp("fast");
			$(this).html("Ver Geo localizacion");
		}		
	})

	$("#enviar_mensajeria").on('click', function() {
		var dir = $("#id_destino").val();
		if(dir == "-"){
			alert("Debe seleccionar una direccion de destino");
		}else{
			var str = "id=<?= $message_id; ?>&dir="+dir;
			$.ajax({
				type: "POST",
				url: "/correo/enviaram/",
				data: str, 
				success:function(msg){
					alert(msg);
				}

			})
		}
	});

</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
  (function($) {
    
  function render_map( $el ) {
   
    // var
    var $markers = $el.find('.marker');
   
    // vars
    var args = {
      zoom    : 14,
      center    : new google.maps.LatLng(0, 0),
      mapTypeId : google.maps.MapTypeId.ROADMAP
    };
   
    // create map           
    var map = new google.maps.Map( $el[0], args);
   
    // add a markers reference
    map.markers = [];
   
    // add markers
    $markers.each(function(){
   
        add_marker( $(this), map );
        GetCircle( $(this), map );
   
    });
   
    // center map
    center_map( map );
   
  }
   
  function GetCircle($marker, map){

    var Mycircle = new google.maps.Circle({
      
      center: new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng')),
      radius: 500,
      strokeColor:"#0000FF",
      strokeOpacity:0.6,
      strokeWeight:2,
      fillColor:"#0000FF",
      fillOpacity:0.3
    });   
    Mycircle.setMap(map);
  }
   
  function add_marker( $marker, map ) {
   
    // var
    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
   
    // create marker
    var marker = new google.maps.Marker({
      position  : latlng,
      map     : map
    });
   
    // add to array
    map.markers.push( marker );
   
    // if marker contains HTML, add it to an infoWindow
    if( $marker.html() )
    {
      // create info window
      var infowindow = new google.maps.InfoWindow({
        content   : $marker.html()
      });
   
      // show info window when marker is clicked
      google.maps.event.addListener(marker, 'click', function() {
   
        infowindow.open( map, marker );
   
      });
    }
  }
   
  function center_map( map ) {
   
    // vars
    var bounds = new google.maps.LatLngBounds();
   
    // loop through all markers and create bounds
    $.each( map.markers, function( i, marker ){
   
      var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
   
      bounds.extend( latlng );
   
    });
   
    // only 1 marker?
    if( map.markers.length == 1 )
    {
      // set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( 15 );
    }
    else
    {
      // fit to bounds
      map.fitBounds( bounds );
    }
  }
   

   
  $(document).ready(function(){
   
    $('.acf-map').each(function(){
   
      render_map( $(this) );
   
    });
   
  });
   
  })(jQuery);
</script>