<?
    $n = new MNotificaciones;
    $n->CreateNotificaciones("id", $id);

    $g = new MGestion;
    $g->CreateGestion("id", $n->GetProceso_id());

    $u = new MUsuarios;
    $u->CreateUsuarios("a_i", $g->GetNombre_destino());


    $demandantes_nombre = "";
    $demandados_nombres = "";
    $qsuscriptt = $con->Query("select sc.nombre, sc.type from gestion_suscriptores as gs inner join suscriptores_contactos sc on sc.id = gs.id_suscriptor where id_gestion = '".$g->GetId()."'");

    while ($rsust = $con->FetchAssoc($qsuscriptt)) {
        # code...
        if ($rsust['type'] == "26") {
            $demandantes_nombre .= $rsust['nombre']."<br>";
        }

        if ($rsust['type'] == "27") {
            $demandados_nombres .= $rsust['nombre']."<br>";
        }
    }

    $ss = new MSuscriptores_contactos;
    $ss->CreateSuscriptores_contactos("id", $n->Getsuscriptor());

    $sd = new MSuscriptores_contactos_direccion;
    $sd->CreateSuscriptores_contactos_direccion("id_contacto", $ss->GetId());


?>

<div class="panel m-t-30">
	<div class="row">
		<div class="col-md-12 p-30">
			<h2>Correspondencia Enviada por Mensaje de Texto</h2>
<?
/*
        if ($_SESSION['usuario'] == 'info@laws.com.co') {
*/        
            if($n->GetTodos() == "CC"){

                $MPlantillas_email = new MPlantillas_email;
                $MPlantillas_email->CreatePlantillas_email('id', '74');
                $emm = $MPlantillas_email->GetContenido();

            }else{

                $MPlantillas_email = new MPlantillas_email;
                $MPlantillas_email->CreatePlantillas_email('id', '76');
                $emm = $MPlantillas_email->GetContenido();

            }

            $em = new MSuper_admin;
            $em->CreateSuper_admin("id", "6");


            $logo = $c->getLogo();

            if (LOGOCORREO == "G") {
                $logo = $c->getLogo();
            }else{
                if ($u->Getlogo_correos() == "") {
                    $logo = $c->getLogo();
                }else{
                    $logo = $u->Getlogo_correos();
                }
            }

            $diasc = array("2" => "Dos", "5" => "Cinco", "10" => "Diez", "30" => "Treinta");
            $dias_comparecer = $diasc[$g->GetCampot8()];

            #echo HOMEDIR.'/app/plugins/thumbnails/'.$logo;
            $firmausuario = "Nombre: ".$u->GetP_nombre()." ".$u->GetP_apellido()."<br>Correo Electr&oacute;nico: ".$u->GetUser_id()."<br>Tel&eacute;fono: ".$u->GetCelular()."<br>T.P.: ".$u->GetUniversidad();

            $emm = str_replace("[elemento]LOGO[/elemento]",'<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$logo.'" width="150px">',  $emm );
            $emm = str_replace("[elemento]LOGOCOURRIER[/elemento]",'<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$em->Getlogo_courrier().'" width="150px">',   $emm );

            $emm = str_replace("[elemento]HOMEDIR[/elemento]",                  HOMEDIR,                                    $emm );
            $emm = str_replace("[elemento]Fecha_registro[/elemento]",           $n->GetF_citacion(),                        $emm );
            $emm = str_replace("[elemento]ASUNTO[/elemento]",                   $g->GetObservacion(),                       $emm );
            $emm = str_replace("[elemento]OBSERVACION2[/elemento]",             $g->GetObservacion2(),                      $emm );
            $emm = str_replace("[elemento]responsable[/elemento]",              $u->GetP_nombre()." ".$u->GetP_apellido(),  $emm );
            $emm = str_replace("[elemento]destinatario[/elemento]",             $n->GetDestinatario(),                      $emm );
            $emm = str_replace("[elemento]email_destinatario[/elemento]",       $sd->GetTelefonos(),                        $emm );
            $emm = str_replace("[elemento]direccion_destinatario[/elemento]",   $sd->GetDireccion().", ".$sd->GetCiudad(),  $emm );
            $emm = str_replace("[elemento]demandado[/elemento]",                $demandados_nombres,                        $emm );
            $emm = str_replace("[elemento]demandante[/elemento]",               $demandantes_nombre,                        $emm );
            $emm = str_replace("[elemento]observacion[/elemento]",              $g->GetObservacion(),                       $emm );
            $emm = str_replace("[elemento]rad_externo[/elemento]",              $g->GetRadicado(),                          $emm );
            $emm = str_replace("[elemento]identificacion_destinatario[/elemento]", $ss->GetIdentificacion(), $emm );
            $emm = str_replace("[elemento]GUIA[/elemento]", $n->GetGuia_id(), $emm );


            $emm = str_replace("[elemento]CAMPOT1[/elemento]",                  $g->GetCampot1(),                           $emm );
            $emm = str_replace("[elemento]CAMPOT2[/elemento]",                  $g->GetCampot2(),                           $emm );
            $emm = str_replace("[elemento]CAMPOT3[/elemento]",                  $g->GetCampot3(),                           $emm );
            $emm = str_replace("[elemento]CAMPOT4[/elemento]",                  $g->GetCampot4(),                           $emm );
            $emm = str_replace("[elemento]CAMPOT5[/elemento]",                  $g->GetCampot5(),                           $emm );
            $emm = str_replace("[elemento]CAMPOT6[/elemento]",                  $g->GetCampot6(),                           $emm );
            $emm = str_replace("[elemento]CAMPOT7[/elemento]",                  $g->GetCampot7(),                           $emm );
            $emm = str_replace("[elemento]CAMPOT8[/elemento]",                  $dias_comparecer,                           $emm );
            $emm = str_replace("[elemento]CAMPOT9[/elemento]",                  $g->GetCampot9(),                           $emm );
            $emm = str_replace("[elemento]CAMPOT10[/elemento]",                 $g->GetCampot10(),                          $emm );
            $emm = str_replace("[elemento]CAMPOT11[/elemento]",                 $g->GetCampot11(),                          $emm );
            $emm = str_replace("[elemento]CAMPOT12[/elemento]",                 $g->GetCampot12(),                          $emm );
            $emm = str_replace("[elemento]CAMPOT13[/elemento]",                 $g->GetCampot13(),                          $emm );
            $emm = str_replace("[elemento]CAMPOT14[/elemento]",                 $g->GetCampot14(),                          $emm );
            $emm = str_replace("[elemento]CAMPOT15[/elemento]",                 $g->GetCampot15(),                          $emm );
            $emm = str_replace("[elemento]firmausuario[/elemento]",             $firmausuario,                              $emm );
            $emm = str_replace("EMAIL DEL DESTINATARIO",                        "TELÉFONO DEL DESTINATARIO",                $emm );
            $emm = str_replace('width="600"',                                   'width="100%"',                             $emm );
            $emm = str_replace("s/read_mail/[elemento]TOKEN[/elemento]/",       "app/views/assets/images/blanco.fw.png",    $emm );
            

            $BOTON_ADJUNTOS ='<ul style="list-style: none;margin-left: 0px;padding-left: 0px;">';
            $qan = $con->Query("select * from notificaciones_attachments where id_notificacion = '".$n->GetId()."' and type='0'");
            $iii = 0;
            $ruta_adjuntos = array();
            $ruta_documentos = array();
            while ($rowan = $con->FetchAssoc($qan)) {

                $iii++;

                $ga = new MGestion_anexos;
                $ga->CreateGestion_anexos("id", $rowan['id_anexo']);

                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";
                $ruta2 = ROOT.DS."/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";

                $rext = explode(".", $ga->GetUrl());
                $rext = end($rext);

                $rnam = explode(".", $ga->GetNombre());
                $rnam = end($rnam);

                //array_push($ruta_adjuntos, $ruta2);
                //array_push($ruta_documentos, $ga->GetNombre());

                $ext = "";
                if ($rext != $rnam) {
                    $ext = $rext;
                }

                // $BOTON_ADJUNTOS .= "<li class='list-group-item' style = 'ist-style: none; border: 1px solid #CCC; padding: 10px;border-radius: 5px; margin-bottom: 5px;'>
                //             <a href='".HOMEDIR."/s/descarganotificacion/".$ga->GetGestion_id()."/".$ga->GetUrl()."/".$ga->GetNombre().'.'.$ext."/".$rowan['id']."/' style='font-weight: bold;'>".$ga->GetNombre()."</a>
                //         </li>";

                $BOTON_ADJUNTOS .= "<li class='list-group-item' style = 'ist-style: none; border: 1px solid #CCC; padding: 10px;border-radius: 5px; margin-bottom: 5px;'>
                            <a href='".$ruta."' target='_blank' style='font-weight: bold;'>".$ga->GetNombre()."</a>
                        </li>";
            }

            $BOTON_ADJUNTOS .= "</ul>";
            $emm = str_replace("[elemento]BOTON_ADJUNTOS[/elemento]", $BOTON_ADJUNTOS,   $emm );
            echo $emm;
/*
        }
*/
?>
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
            url:'/s/geolocation/',
            data:{'latitud':latitud,'longitud':longitud,'token':'<?= $id ?>'},
            success:function(msg){
            }
        });
    }
    function mostrarDireccion(response) {
        $('#direccion').text(response.display_name);
        altdata = response.display_name;
        $.ajax({
            type:'post',
            url:'/s/alterdata/',
            data:{'altdata':altdata,'token':'<?= $id ?>'},
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
        ur =  '/s/generarcertificado/<?= $id ?>/';
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

    if ($n->Getfecha_lectura_sms() != "") {
        $fecha_lectura_sms = $n->Getfecha_lectura_sms();
    }

    $upd = "UPDATE notificaciones SET reply_ip = '$ip', sms_leido = '2', fecha_lectura_sms = '".$fecha_lectura_sms."' , fecha_otras_lectura_sms = '".date("Y-m-d H:i:s")."' WHERE id = '$id'";
    $con->Query($upd);



    $description = "El Destinatario ".$n->GetDestinatario()." con telefono ".$n->GetTelefono()." a leído un Mensaje de Texto";
    $con->Query("INSERT INTO alertas_suscriptor (suscriptor_id, alerta, id_gestion, fechahora, estado, type, tipo_usuario) VALUES 
                                                        ('".$n->GetUser_id()."', '".$description."', '".$n->GetProceso_id()."', '".date("Y-m-d H:i:s")."', '0', 'smse', 'U')");

    $con->Query("update gestion set suscriptor_leido = '1',  usuario_leido = '1' where id = '".$n->GetProceso_id()."'");
?>

    