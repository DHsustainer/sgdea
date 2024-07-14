<?

$fecha_envio = "";
$fecha_apertura = "";

$sadmin = new MSuper_admin;
$sadmin->CreateSuper_admin("id", "6");


$path = ROOT.DS.'plugins/thumbnails/';
$image_white = $sadmin->Getimage_white();
$imajotipo   = $sadmin->GetImajotipo();
$logo_white  = $sadmin->Getlogo_white();
$text_tipo   = $sadmin->GetFoto_perfil();

$exists = file_exists( $path.$image_white );
if (!$exists) { $image_white = 'logo_color.png'; }else{ $image_white = $image_white; }

$exists = file_exists( $path.$imajotipo );
if (!$exists) { $imajotipo = 'logo_color.png'; }else{ $imajotipo = $imajotipo; }

$exists = file_exists( $path.$logo_white );
if (!$exists) { $logo_white = 'text_color.png'; }else{ $logo_white = $logo_white; }

$exists = file_exists( $path.$text_tipo );
if (!$exists) { $text_tipo = 'text_color.png'; }else{ $text_tipo = $text_tipo; }


$stringactuaciones .= '
        <b><img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$imajotipo.'" alt="home" style="width:33px" /></b>
		<b><img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$text_tipo.'" alt="home" style="width:139px" /></b>
        


	<h2>SEGUIMIENTO DE SERVICIO # '.$sms['guia_id'].'</h2>
	<h2><b>INFORMACIÓN GENERAL</b></h2>
		<table  cellspacing="5" cellpadding="5" border="1" width="750px">
			<tr>
				<td align="left" width="150px"><b>DESTINATARIO:</b></td>
				<td  width="200px">'.$sms['destinatario'].'</td>
				<td align="left" width="100px"><b>EMAIL:</b></td>
				<td width="200px">'.$sms['direccion'].'</td>
				<td align="left" width="150px"><b>PRECIO DEL SERVICIO:</b></td>
				<td>'.$sms['valor'].'</td>
			</tr>
			<tr>
				<td align="left"><b>REMITENTE:</b></td>
				<td>'.$g->GetNombre_radica().'</td>
				<td align="left"><b>EMAIL:</b></td>
				<td colspan="3">'.$user->GetEmail().'</td>

			</tr>
		</table>
		<br>
		<table  cellspacing="5" cellpadding="5" border="1" width="750px">
			<tr>
				<td align="left" width="200px"><b>FECHA DE CREACIÓN<br>DEL MENSAJE DE DATOS:</b></td>
				<td>'.$f->ObtenerFecha4($sms['f_citacion']." ".$sms['hora']).'</td>
				<td align="left" width="200px"><b>FECHA DE ENVÍO <br>DEL MENSAJE DE DATOS:</b></td>
				<td>'.$f->ObtenerFecha4($mr['envio_fecha']).'</td>
			</tr>
			<tr>
				<td align="left"><b>CONTENIDO DEL MENSAJE:</b></td>
				<td colspan="3">'.$mr['message'].'</td>
			</tr>
		</table>
	<h2><b>DOCUMENTOS ADJUNTOS</b></h2>
		<table  cellspacing="5" cellpadding="5" border="1" width="750px">
			<tr>
				<td align="left" width="150px"><b>DOCUMENTO</b></td>
				<td align="left" width="150px"><b>ESTADO</b></td>
				<td align="left" width="150px"><b>FECHA DE DESCARGA</b></td>
				<td align="left" width="150px"><b>ÚLTIMA DESCARGA</b></td>
			</tr>';


                                        
                    	$qan = $con->Query("select * from notificaciones_attachments where id_notificacion = '".$sms['id']."' and type='0'");
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

                            $stringactuaciones .= 
                            					'	<tr>
														<td align="left" width="150px">'.$ga->GetNombre().'</td>
														<td align="left" width="150px">'.$estados[$rowan['estado']].'</td>
														<td align="left" width="150px">'.$rowan['fecha_descarga'].'</td>
														<td align="left" width="150px">'.$rowan['fecha_otra_descarga'].'</td>
                            						</tr>';
                        }
                        if ($i == 0) {
                            $stringactuaciones .=  "  <tr>
                                       <td colspan='4'>No Se Adjuntaron Documentos</td>
                                    </tr>";
                        }

$stringactuaciones .= '</table>';
?>
<div class="row m-t-20">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
	 		<?= $stringactuaciones ?>
		</div>
	</div>
</div>