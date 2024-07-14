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
	$r->CreateMailer_replys("receiver_token", $value[0]);

	$n = new MNotificaciones;
	$n->CreateNotificaciones("id", $r->GetReceiver_id());

	$g = new MGestion;
    $g->CreateGestion("id", $n->GetProceso_id());

	$me = new MUsuarios;
	$me->CreateUsuarios("user_id", $n->GetUser_id());

	#echo md5("900766608");
?>

<div class="panel m-t-30">
	<div class="row">
		<div class="col-md-12 p-30">
			<h2>Correspondencia Enviada por Mensaje de Texto</h2>
            <?php if ($n->GetTodos() == "NJ"): ?>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>REMITENTE:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetNombre_radica(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>ASUNTO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetObservacion(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>RADICADO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetRadicado(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>JUZGADO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetCampot1(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>CIUDAD JUZGADO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetCampot4(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>ARTÍCULO / TIPO DE CORRESPONDENCIA:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetCampot5(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>NATURALEZA DEL PROCESO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetCampot6(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>HORARIO DEL JUZGADO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetCampot7(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>DIAS PARA COMPARECER:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetCampot8(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>ANEXO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetCampot9(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>FECHA PROVIDENCIA 1:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetCampot10(); ?></div>
                </div>

                <h2 class="m-t-30">Información del Destinatario</h2>

                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>DESTINATARIO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $n->GetDestinatario(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>E-MAIL:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $n->GetDireccion(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3 col-sm-12 col-xs-12"><b>FECHA Y HORA DE LECTURA:</b></div>
                    <div class="col-md-3 col-sm-12 col-xs-12"><?= date("Y-m-d H:i:s"); ?></div>
                    <div class="col-md-3">ESTADO DEL MENSAJE:</div>
  					<div class="col-md-3">MENSAJE LEÍDO</div>
                </div>
        <?php else: ?>
                <h2 class="m-t-30">Información del Destinatario</h2>
        		<div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>REMITENTE:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetNombre_radica(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>ASUNTO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $g->GetObservacion(); ?></div>
                </div>

                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>DESTINATARIO:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $n->GetDestinatario(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-4 col-sm-12 col-xs-12"><b>E-MAIL:</b></div>
                    <div class="col-md-8 col-sm-12 col-xs-12"><?= $n->GetDireccion(); ?></div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3 col-sm-12 col-xs-12"><b>FECHA Y HORA DE LECTURA:</b></div>
                    <div class="col-md-3 col-sm-12 col-xs-12"><?= date("Y-m-d H:i:s"); ?></div>
                    <div class="col-md-3">ESTADO DEL MENSAJE:</div>
  					<div class="col-md-3">MENSAJE LEÍDO</div>
                </div>
        <?php endif ?>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <h2>Documentos Adjuntos</h2>
        			<ul class="list-group">
        			<?
        				$con->Query("update notificaciones set sms_leido = '1', fecha_lectura_sms = '".date("Y-m-d H:i:s")."' where id = '".$id."'");
                                        
                    	$qan = $con->Query("select * from notificaciones_attachments where id_notificacion = '".$n->GetId()."' and type='0'");
                        $i = 0;
                        while ($rowan = $con->FetchAssoc($qan)) {

                            $i++;

                            $ga = new MGestion_anexos;
                            $ga->CreateGestion_anexos("id", $rowan['id_anexo']);

                            $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$n->GetProceso_id().trim("/anexos/ ").$ga->GetUrl()."";

                            $rext = explode(".", $ga->GetUrl());
                            $rext = end($rext);

                            $rnam = explode(".", $ga->GetNombre());
                            $rnam = end($rnam);

                            $ext = "";
                            if ($rext != $rnam) {
                            	$ext = $rext; 
                            }

                            echo "	<li class='list-group-item'>
                            			<a href='".HOMEDIR."/s/descarganotificacion/".$ga->GetGestion_id()."/".$ga->GetUrl()."/".$ga->GetNombre().'.'.$ext."/".$rowan['id']."/'>".$ga->GetNombre()."</a>
                            		</li>";
                        }
                        if ($i == 0) {
                            echo "  <li class='list-group-item'>
                                        No hay documentos Adjuntos...
                                    </li>";
                        }
        			?>
        			</ul>
                </div>
            </div>
		</div>
	</div>
</div>
<script>
    
    function coordenadas(position) {
        var latitud = position.coords.latitude;
        var longitud = position.coords.longitude;
        convertirGpsADireccion(latitud, longitud, mostrarDireccion); 
        $.ajax({
            type:'post',
            url:'/s/geolocationmail/',
            data:{'latitud':latitud,'longitud':longitud,'token':'<?= $n->GetId() ?>'},
            success:function(msg){
            }
        });
    }
    function mostrarDireccion(response) {
        $('#direccion').text(response.display_name);
        altdata = response.display_name;
        $.ajax({
            type:'post',
            url:'/s/alterdatamail/',
            data:{'altdata':altdata,'token':'<?= $n->GetId() ?>'},
            success:function(msg){
                $("#direccion").text(msg);
            }
        });
    }
    function convertirGpsADireccion(lat, lon, callback) {
        $.getJSON("https://nominatim.openstreetmap.org/reverse?format=json&addressdetails=0&zoom=18&lat=" + lat + "&lon=" + lon + "&json_callback=?", callback);
    }
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(coordenadas);
    }else{
        alert('Tu navegador no soporta la API de geolocalizacion');
    }


    setTimeout(function (){
        ur =  '/s/generarcertificadomail/<?= $n->GetId() ?>/';
        $.ajax({
            type:'get',
            url:ur,
            success:function(msg){
            }
        });

    }, 1000);
</script>
<?
    $ip= $_SERVER['REMOTE_ADDR'];

    $fecha_lectura_sms = date("Y-m-d H:i:s");

    if ($r->GetReply_datetime() != "" && $r->GetReply_datetime() != '0000-00-00 00:00:00') {
        $fecha_lectura_sms = $r->GetReply_datetime();
    }

    $upd = "UPDATE mailer_replys SET reply_ip = '$ip', message_status = '1', reply_datetime = '".$fecha_lectura_sms."', otra_fecha_apertura = '".date("Y-m-d H:i:s")."' WHERE receiver_id = '".$n->GetId()."'";
    $con->Query($upd);

    $description = "El Destinatario a leído un E-mail";
    $con->Query("INSERT INTO alertas_suscriptor (suscriptor_id, alerta, id_gestion, fechahora, estado, type, tipo_usuario) VALUES 
                                                        ('".$n->GetUser_id()."', '".$description."', '".$n->GetProceso_id()."', '".date("Y-m-d H:i:s")."', '0', 'smse', 'U')");

    $con->Query("update gestion set suscriptor_leido = '1',  usuario_leido = '1' where id = '".$n->GetId()."'");
?>

