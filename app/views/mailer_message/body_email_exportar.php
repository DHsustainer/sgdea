<?
$stringactuaciones .= '

	<h1>Asunto: <b>'.$title.'</b></h1>
		<table style="margin-bottom:15px">
			<tr>
				<td align="left" width="150px"><b>EXPEDIENTE:</b></td>
				<td>'.$p.'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>DE:</b></td>
				<td>'.$fm->GetName()." ".$fm->GetEmail().'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>PARA:</b></td>
				<td>'.$m->GetName()." (".$m->GetFrom_nom().")".'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>F. LECTURA:</b></td>
				<td>'.$f->ObtenerFecha($readtime[0])." ".$readtime[1].'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>LEIDO POR</b></td>
				<td>'.HOMEDIR." (".$r->GetDNS().")".'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>ESTADO:</b></td>
				<td>'.$rstatus[$r->GetMessage_status()].'</td>
			</tr>
		</table>
	<h2><b>Información IP</b></h2>
		<table style="margin-bottom:15px">
			<tr>
				<td align="left" width="150px"><b>DIRECCION IP:</b></td>
				<td>'.$r->GetReply_ip().'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>HOST:</b></td>
				<td>'.$r->GetHostname().'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>ISP:</b></td>
				<td>'.$r->GetIsp().'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>ORGANIZACION:</b></td>
				<td>'.$r->GetOrganization().'</td>
			</tr>
		</table>

	<h2><b>Geo Localizacion</b></h2>
		<table style="margin-bottom:15px">
			<tr>
				<td align="left" width="150px"><b>PAÍS:</b></td>
				<td>'.utf8_encode($r->GetCountry()).'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>COD. POSTAL:</b></td>
				<td>'.utf8_decode($r->GetState()).'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>CERCANÍA:</b></td>
				<td>'.$r->GetCity().'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>LATITUD:</b></td>
				<td>'.utf8_decode($r->GetLatitude()).'</td>
			</tr>
			<tr>
				<td align="left" width="150px"><b>LONGITUD:</b></td>
				<td>'.utf8_decode($r->GetLongitude()).'</td>
			</tr>
		</table>';

		$gkey = "AIzaSyBwgxzPwnUFHHG18uZJYW6ioHjmXro5p5w";
		if($r->GetLatitude() != '' && $r->GetLongitude() != ''){
			$src = 'https://maps.googleapis.com/maps/api/staticmap?center='.$r->GetLatitude().','.$r->GetLongitude().'&zoom=16&size=750x250&markers=color:red|'.$r->GetLatitude().','.$r->GetLongitude().'&key='.$gkey;

			$imageData = base64_encode(file_get_contents($src));
			$imagen = file_get_contents($src);
			$filepath = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.".jpg";
			file_put_contents($filepath, $imagen);
		}

$stringactuaciones .= '
		<div class=\'gmaps acf-map\' style="width: 100%; height: 250px;border:2px solid #CCC;">
            <img src="'.$filepath.'" width="700px" height="250px">
        </div>

	<h2><b>Mensaje Original</b></h2>

			<div>'.$fm->GetMessage().'</div>';
					
			if($r->GetDetails() != ""){
				$stringactuaciones .=  "<p>
											<div class='mot'>El remitente ha escrito una respuesta a este mensaje</div>
												<div>".str_replace("\n", "<br>", $r->GetDetails())."</div>
											</div>
										</p>";						
			}			
	$stringactuaciones .=  '					
	<h2><b>Archivos Adjuntos</b></h2>
		<ul class=\'list-group\' id=\'list-anexos\'>';

		while($rowat = @$con->FetchAssoc($attachments)){
			$att = new MMailer_Attachments;
			$att->CreateMailer_Attachments("id", $rowat["id"]);
			$name_not = $att->GetTitle();

      		$stringactuaciones .= "  	
      			<li class='list-group-item anexos-li'>".$name_not."</li>";

		}
	$stringactuaciones .=  	"
		</ul>";
?>