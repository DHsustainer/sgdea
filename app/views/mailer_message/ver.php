<?
global $c;
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>

<?

	$message_id = $arr[2];

	$r = new MMailer_Replys;
	$r->CreateMailer_replys("receiver_token", $message_id);


	$m = new MMailer_message;
	$m->CreateMailer_message("message_id",$r->GetMessage_id());

	$p1 = $c->GetDataFromTable("gestion", "id", $m->GetP_id(), "min_rad", $separador = "");
	$p2 = $c->GetDataFromTable("gestion", "id", $m->GetP_id(), "radicado", $separador = "");

	switch (TIPO_RADICACION) {
    	case '1':
    		$p = $p1;
    		break;
    	case '2':
    		$p = $p1." <small>(".$p2.")</small>";
    		break;
    	case '3':
    		$p = $p2." <small>(".$p1.")</small>";
    		break;
    	default:
    		$p = $p2;
    		break;
    }	

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

	$rstatus = array("1" => "El mensaje fue <strong>Abierto</strong>", "2" => "El mensaje fue <strong>Rehusado</strong>", "0" => "El mensaje <strong>No fue leido</strong>");

?>

	<div class="row">
		<div class="col-md-9"><h1>Asunto: <b><?= $title ?></b></h1></div>
		<div class="col-md-1">
			<?
				if ($r->GetMessage_status() != "3") {
			?>
					<button type="button"  <?= $c->Ayuda('176', 'tog') ?>  class="btn btn-primary margintop_2" onClick="ArchivarCorreo('<?= $message_id ?>')">Archivar</button>
			<?
				}
			?>
		</div>
		<div class="col-md-1">
			<button type="button"  <?= $c->Ayuda('177', 'tog') ?>  class="btn btn-primary margintop_2" onClick="ExportarCorreoAExpediente('<?= $message_id ?>')">Exportar al Expediente</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
	  		<div class="row">
	  			<div class="col-md-4"><b>EXPEDIENTE:</b></div>
				<div class="col-md-8"><a href='/gestion/ver/<?= $m->GetP_id() ?>/' class="btn btn-info"><?= $p ?></a></div>
	  		</div>
			<div class="row">
				<div class="col-md-4"><b>DE:</b></div>
				<div class="col-md-8"><?= $fm->GetName()." ".$fm->GetEmail() ?></div>
			</div>
			<div class="row">
				<div class="col-md-4"><b>PARA:</b></div>
				<div class="col-md-8"><?= $m->GetName()." (".$m->GetFrom_nom().")" ?></div>
			</div>
			<div class="row">
				<div class="col-md-4"><b>F. LECTURA:</b></div>
				<div class="col-md-8"><?= $f->ObtenerFecha($readtime[0])." ".$readtime[1] ?></div>
			</div>
			<div class="row">
				<div class="col-md-4"><b>LEIDO EN</b></div>
				<div class="col-md-8"><?= HOMEDIR." (".$r->GetDNS().")" ?></div>
			</div>
			<div class="row">
				<div class="col-md-4"><b>ESTADO:</b></div>
				<div class="col-md-8"><?= $rstatus[$r->GetMessage_status()] ?></div>
			</div>


			<div class="row">
				<div class="col-md-12" align="center"><h3><b>Información IP</b></h3></div>
			</div>
			<div class="row">
				<div  class="col-md-4"><b>DIRECCION IP:</b></div>
				<div class="col-md-8"><?= $r->GetReply_ip() ?></div>
			</div>
			<div class="row">
				<div  class="col-md-4"><b>HOST:</b></div>
				<div class="col-md-8"><?= $r->GetHostname() ?></div>
			</div>
			<div class="row">
				<div  class="col-md-4"><b>ISP:</b></div>
				<div class="col-md-8"><?= $r->GetIsp() ?></div>
			</div>
			<div class="row">
				<div  class="col-md-4"><b>ORGANIZACION:</b></div>
				<div class="col-md-8"><?= $r->GetOrganization() ?></div>
			</div>
			<div class="row">
				<div class="col-md-12" align="center"><h3><b>Geo Localizacion</b></h3></div>
			</div>
			<div class="row">
				<div  class="col-md-4"><b>PAÍS:</b></div>
				<div class="col-md-8"><?= utf8_encode($r->GetCountry()) ?></div>
			</div>
			<div class="row">
				<div  class="col-md-4"><b>COD. POSTAL:</b></div>
				<div class="col-md-8"><?= utf8_decode($r->GetState()) ?></div>
			</div>
			<div class="row">
				<div  class="col-md-4"><b>CERCANÍA:</b></div>
				<div class="col-md-8"><?= $r->GetCity() ?></div>
			</div>
			<div class="row">
				<div  class="col-md-4"><b>LATITUD:</b></div>
				<div class="col-md-8"><?= utf8_decode($r->GetLatitude()) ?></div>
			</div>
			<div class="row">
				<div  class="col-md-4"><b>LONGITUD:</b></div>
				<div class="col-md-8"><?= utf8_decode($r->GetLongitude()) ?></div>
			</div>
		</div>
		<div class="col-md-8">
			<?
				if ($r->Getlt() != "") {
			?>
			<div class='gmaps acf-map'>
	       		<div class='marker' data-lat='<?= $r->Getlt() ?>' data-lng='<?= $r->Getlg() ?>'></div>
	        </div>
			<?
				}else{
					echo "<div align='center' class='alert alert-info m-t-30' role='alert'>El Destinatario no compartió su ubicación</div>";
				}
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-7">
			<h1><b>Mensaje Original</b></h1>
			<div><?= $fm->GetMessage() ?></div>
			<?
				if($r->GetDetails() != ""){
					echo "	<p>
								<div class='mot'>El remitente ha escrito una respuesta a este mensaje</div>
									<div>".str_replace("\n", "<br>", $r->GetDetails())."</div>
								</div>
							</p>";						
				}			
			?>
		</div>
		<div class="col-md-5">

			<h1><b>Archivos Adjuntos</b></h1>
			<?
				echo "<ul class='list-group' id='list-anexos'>";


				while($rowat = @$con->FetchAssoc($attachments)){
					$att = new MMailer_Attachments;
					$att->CreateMailer_Attachments("id", $rowat["id"]);

					$type=explode('.', $rowat['filename']);
					$type=array_pop($type);
					$file = $att->GetFilename();
					$ruta = $att->GetFilename();
					$name_not = $att->GetTitle();
					$cadena_nombre = substr($file,0,200);

					$extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));	

		      echo "  	<li class='list-group-item'>
		      				<a href='".$ruta."' target='_blank'>
	                            <div class='img-icon $type'></div>
	                            <div class='nom_anexo' title='$name_not'>".$name_not."</div>
		      				</a>
                        </li>";

				}
				echo "	</ul>";
			?>
		</div>
	</div>
<style>

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
#vip:hover, #vgeo:hover{
	cursor:pointer;
	text-decoration: underline;

}
.gmaps{
    width: 100%;
    height: 500px;
    border:6px solid #CCC;
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
		
	$("#archivar_btn").live("click", function(){
		var str = "id=<?= $message_id; ?>";
		$.ajax({
			type: "POST",
			url: "/	correo/archivar/",
			data: str, 
			success:function(msg){
				alert(msg);
			}

		})
	})

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