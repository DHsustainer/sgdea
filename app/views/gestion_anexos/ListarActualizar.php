<div class="row" style="background: #FFF">
	<div class="col-md-12" >
		<table class="table table-striped" width="100%">
			<thead>
				<th width="250px">Documento</th>
				<th width="100px" >Estado</th>
				<th width="162px">Tipo Documental</th>
				<th width="162px">Público / Privado</th>
				<th width="162px">Observacion</th>
			</thead>
			<tbody>
				
<?
	$ge = new MGestion;
	$ge->CreateGestion("id", $id);

	$dep = new MDependencias;
	$dep->CreateDependencias("id", $ge->GetTipo_documento());

	$iconfile = array("doc" => "mdi-file-word text-info" , "docx" => "mdi-file-word text-info" , "zip" => "mdi-zip-box text-info" , "rar" => "mdi-zip-box text-info" , "tar" => "mdi-zip-box text-info" , "xls" => "mdi-file-excel text-success" , "xlsx" => "mdi-file-excel text-success" , "ppt" => "mdi-file-powerpoint text-danger" , "pps" => "mdi-file-powerpoint text-danger" , "pptx" => "mdi-file-powerpoint text-danger" , "ppsx" => "mdi-file-powerpoint text-danger" , "pdf" => "mdi-file-pdf text-danger" , "txt" => "mdi-file-document text-muted" , "jpg" => "mdi-file-image text-success"  , "jpeg" => "mdi-file-image text-success"  , "bmp" => "mdi-file-image text-success"  , "gif" => "mdi-file-image text-success"  , "png" => "mdi-file-image text-success"  , "dib" => "mdi-file-image text-success"  , "tif" => "mdi-file-image text-success"  , "tiff" => "mdi-file-image text-success"  , "mpeg" => "mdi-file-video text-warning"  , "avi" => "mdi-file-video text-warning"  , "mp4" => "mdi-file-video text-warning"  , "midi" => "mdi-audiobook mdi-warning"  , "acc" => "mdi-audiobook mdi-warning"  , "wma" => "mdi-audiobook mdi-warning"  , "ogg" => "mdi-audiobook mdi-warning"  , "mp3" => "mdi-audiobook mdi-warning" , "flv" => "mdi-file-video text-warning"  , "wmv" => "mdi-file-video text-warning"  , "csv" => "mdi-file-excel text-success" , "" => "mdi-file-find text-warning" );

echo '			<tr>
					<td colspan="5">'."<span class='mdi mdi-folder text-warning'></span> Carpeta Principal</td>
				</tr>";

				$v = $con->Query("select * from gestion_anexos where gestion_id = '".$id."' and  folder_id = '0' order by ".ORDENARDOCUMENTOSBY);
				$i = 0;
				$last = $con->NumRows($v);

				while ($col = $con->FetchAssoc($v)) {
					$type=explode('.', strtolower($col[url]));
	                $type=array_pop($type);
	                $file = $col["url"];
	                if ($file != "") {
		                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";
		                $cadena_nombre = substr($file,0,200);
		                $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));
						$bad = (strlen($col[nombre]) > 40)?"...":"";
					 	$nombredoc = $col[nombre]; //substr($col[nombre], 0, 40).$bad;

					 	if ($retorno == "SID") {
							$retorno = $col["id"];
						}else{
							$retorno = $ruta;
						}
						$retorno = $col["id"];

						$optiona = '<select class="form-control" id="changetypedoc'.$col['id'].'" onChange="changetypedoc(\''.$col['id'].'\', \''.$ge->GetId().'\', this.value)">';
						$optiona .= "<option value=''>Seleccione una Tipología</option>";
		
						$tipo = new MDependencias_tipologias;
						$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$dep->GetId()."'");
						while ($rl = $con->FetchAssoc($listado)) {
							$sel = ($col['tipologia'] == $rl['id'])?"selected='selected'":"";
							$optiona .= "<option value='".$rl['id']."' $sel>".$rl['tipologia']."</option>";	
						}
						$optiona .= "</select>";

						$estado = ($col['estado'] == "1")?"Activo":"Eliminado";
						$selecpublicsi = ($col['is_publico'] == "0")?"selected = 'selected'":"";
						$selecpublicno = ($col['is_publico'] == "1")?"selected = 'selected'":"";

						echo '	<tr>
									<td>'."<i class='mdi ".$iconfile[$type]."'></i><span style='font-size:11px;'> $nombredoc</span>".'</td>
									<td>'.$estado.'</td>
									<td>'.$optiona.'</td>';
						echo '		<td>
										<select class="form-control" onChange=" changePublic(\''.$col['id'].'\', this.value)">';
								echo  "		<option value='0' $selecpublicsi>Privado</option>";	
								echo  "		<option value='1' $selecpublicno>Publico</option>";	
						echo "			</select>
									</td>";			
						echo 	'	<td>
									<textarea  class="form-control" id="obsx'.$col['id'].'" onblur="changeObservacionDocumento(\''.$col['id'].'\')">'.$col['observacion'].'</textarea>';
						echo		'</td>
								</tr>';
	                }
				}
	$c->GetAnexosGesetionAdministar($id, 0, "-");
?>
			</tbody>
		</table>
	</div>
</div>
