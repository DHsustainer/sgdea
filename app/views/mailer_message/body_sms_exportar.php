<?
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


$estado = array("0" => "Mensaje de Texto Enviado", 
                "1"  => "Mensaje de Texto Enviado", 
                "2"  => "Mensaje de Texto Abierto/Leído por el Destinatario", 
                "3"  => "Mensaje de Texto Abierto/Leído y uno o más Documentos Adjuntos Fueron Descargados");


$stringactuaciones .= '
    <h3 style="text-align:center">CERTIFICACIÓN DE ENVÍO, ENTREGA Y ACUSE DE RECIBO MENSAJE DE DATOS REALIZADO POR LA PLATAFORMA DE ENVÍOS ELECTRÓNICOS: '.HOMEDIR.' DE: '.MENSAJESERVIDORSALIDA.'</h3>
    <br>
        <table style="margin-bottom:15px" cellspacing="2" cellpadding="2">
            <tr>
                <td align="left" width="200px"><b>REMITENTE:</b></td>
                <td>'.$user->GetP_nombre()." ".$user->GetP_apellido().'</td>
                <td align="left" width="100px"><b>TELÉFONO:</b></td>
                <td width="100px">'.$user->GetCelular().'</td>
            </tr>
            <tr>
                <td align="left" width="200px"><b>DESTINATARIO:</b></td>
                <td>'.$sms['destinatario'].'</td>
                <td align="left" width="100px"><b>TELÉFONO:</b></td>
                <td width="100px">'.$sms['telefono'].'</td>
            </tr>
            <tr>
                <td align="left" width="200px"><b>ASUNTO:</b></td>
                <td colspan="3">'.$g->GetObservacion().'</td>
            </tr>';
if($g->GetRadicado() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>RADICADO :</b></td>
                        <td colspan="3">'.$g->GetRadicado().'</td>
                    </tr>';
            }  

            if($g->GetCampot1() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT1.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot1())).'</td>
                    </tr>';
            }
            if($g->GetCampot2() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT2.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot2())).'</td>
                    </tr>';
            }
            if($g->GetCampot15() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT15.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot15())).'</td>
                    </tr>';
            }                 
            if($g->GetCampot3() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT3.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot3())).'</td>
                    </tr>';
            }
            if($g->GetCampot4() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT4.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot4())).'</td>
                    </tr>';
            }
            if($g->GetCampot5() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT5.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot5())).'</td>
                    </tr>';
            }
            if($g->GetCampot6() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT6.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot6())).'</td>
                    </tr>';
            }
            if($g->GetCampot7() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT7.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot7())).'</td>
                    </tr>';
            }
            if($g->GetCampot8() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT8.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot8())).'</td>
                    </tr>';
            }
            if($g->GetCampot9() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT9.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot9())).'</td>
                    </tr>';
            }
            if($g->GetCampot10() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT10.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot10())).'</td>
                    </tr>';
            }
            if($g->GetCampot11() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT11.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot11())).'</td>
                    </tr>';
            }
            if($g->GetCampot12() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT12.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot12())).'</td>
                    </tr>';
            }
            if($g->GetCampot13() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT13.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot13())).'</td>
                    </tr>';
            }
            if($g->GetCampot14() != ""){
                $stringactuaciones .= '         
                     <tr>
                        <td align="left" width="200px"><b>'.CAMPOT14.' :</b></td>
                        <td colspan="3">'.$f->Reemplazo3(strtoupper($g->GetCampot14())).'</td>
                    </tr>';
            }

$stringactuaciones .= '         
            <tr>
                <td align="left" width="200px"><b>CUERPO DEL MENSAJE:</b></td>
                <td colspan="3">'.$g->GetObservacion2().'</td>
            </tr>
        </table>';

$stringactuaciones .= '
        <h3><b>TRAZABILIDAD DE TRASMISION Y RECIBIDO DEL MENSAJE DE DATOS</b></h3>
        <table style="margin-bottom:15px" cellspacing="2" cellpadding="2">
            <tr>
                <td align="left" width="200px"><b>ESTADO ACTUAL:</b></td>
                <td colspan="3"><b>'.$estado[$sms['sms_leido']].'</b></td>
            </tr>
            <tr>
                <td align="left" width="200px"><b>FECHA DE ELABORACION:</b></td>
                <td colspan="3">'.$f->ObtenerFecha4($sms['f_citacion']." ".$sms['hora']).'</td>
            </tr>';

if ($sms['fecha_lectura_sms'] != "") {
    $stringactuaciones .= '            
                <tr>
                    <td align="left" width="200px"><b>FECHA DE LECTURA:</b></td>
                    <td colspan="3">'.$f->ObtenerFecha4($sms['fecha_lectura_sms']).'</td>
                </tr>';
}

            if ($sms['fecha_lectura_sms'] != $sms['fecha_otras_lectura_sms']) {
$stringactuaciones .=   '
                <tr>
                    <td align="left" width="200px"><b>FECHA DE ÚLTIMA LECTURA:</b></td>
                    <td colspan="3">'.$f->ObtenerFecha4(date("Y-m-d H:i:s")).'</td>
                </tr>';
            }

$stringactuaciones .= '</table>';

if ($sms['fecha_lectura_sms'] != "") {
$stringactuaciones .= ' 
    <h3><b>INFORMACIÓN DE IP Y GEOLOCALIZACION</b></h3>
        <table style="margin-bottom:15px" cellspacing="2" cellpadding="2">
            <tr>
                <td align="left" width="150px"><b>DIRECCION IP:</b></td>
                <td>'.$sms['reply_ip'].'</td>
            </tr>';

            if ($sms['country'] != "") {
$stringactuaciones .=   '
                <tr>
                    <td align="left" width="150px"><b>PAÍS:</b></td>
                    <td>'.utf8_encode($sms['country']).'</td>
                </tr>';
            }
            if ($sms['state'] != "") {
$stringactuaciones .=   '
                <tr>
                    <td align="left" width="150px"><b>COD. POSTAL:</b></td>
                    <td>'.utf8_decode($sms['state']).'</td>
                </tr>';
            }                        
            if ($sms['city'] != "") {
$stringactuaciones .=   '
                <tr>
                    <td align="left" width="150px"><b>CERCANÍA:</b></td>
                    <td>'.$sms['city'].'</td>
                </tr>';
            }
            if ($sms['latitude'] != "") {
$stringactuaciones .=   '
                <tr>
                    <td align="left" width="150px"><b>LATITUD:</b></td>
                    <td>'.$sms['latitude'].'</td>
                </tr>';
            }                        
            if ($sms['longitude'] != "") {
$stringactuaciones .=   '
                <tr>
                    <td align="left" width="150px"><b>LONGITUD:</b></td>
                    <td>'.$sms['longitude'].'</td>
                </tr>';
            }
$stringactuaciones .=   '</table>';
}


$stra = "select * from notificaciones_attachments where id_notificacion = '".$sms['id']."'";
#$stringactuaciones .= $stra;
$qan = $con->Query($stra);

        if ($con->NumRows($qan) > 0) {
            # code...
            $stringactuaciones .= '
                <div style="page-break-after:always;"></div>
                <h3><b>DOCUMENTOS ADJUNTOS</b></h3>
                    <table style="margin-bottom:15px" cellspacing="0" cellpadding="0" border = "1">
                        <tr>
                            <td align="left" width="150px"><b>DOCUMENTO</b></td>
                            <td align="left" width="150px"><b>ESTADO</b></td>
                            <td align="left" width="150px"><b>FECHA DE DESCARGA</b></td>
                            <td align="left" width="150px"><b>ÚLTIMA DESCARGA</b></td>
                        </tr>';

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
                $estados = array("0" => "Sin Descargar", "1" => "Descargado");

                $fdescarga = $rowan['fecha_otra_descarga'];

                if ($rowan['fecha_descarga'] == '') {
                    $fdescarga = "";
                }

                $stringactuaciones .= 
                                    '   <tr>
                                            <td align="left" width="150px">'.$ga->GetNombre().'</td>
                                            <td align="left" width="150px">'.$estados[$rowan['estado']].'</td>
                                            <td align="left" width="150px">'.$rowan['fecha_descarga'].'</td>
                                            <td align="left" width="150px">'.$fdescarga.'</td>
                                        </tr>';
            }
            if ($i == 0) {
                $stringactuaciones .=  "  <tr>
                           <td colspan='4'>No Se Adjuntaron Documentos</td>
                        </tr>";
            }

$stringactuaciones .= '
        </table>';
        }
?>