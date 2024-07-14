<div class="tmain">Nuevo Formulario de Metadato</div>
<form id='formmeta_referencias_titulos' action='/meta_referencias_titulos/registrar/' method='POST'> 
<?
	$pathname = "";
	global $c;

	switch ($_REQUEST['id']) {
		case '1':
			$pathname = "";
			break;
		case '2':
			$pathname = "Metadatos de ".$c->GetDataFromTable("dependencias_tipologias", "id", $_REQUEST['cn'], "tipologia", " ");
			break;
		case '3':
			$pathname = "";
			break;
		default:
			$pathname = "";
			break;
	}
?>

	<div class="form-group">
		<div class="form-group form-group-lg">
			<div class="input-group" data-toggle="tooltip" data-placement="bottom" title="Nombre del Usuario">	
				<div class="input-group-addon fa fa-user iconbox"></div>
				<input type="text" class="form-control " placeholder="Nombre del Formulario" name="titulo" id="titulo" maxlength="200" value="<?= $pathname ?>">
				<input type="hidden" class="form-control " placeholder="Nombre del Formulario" name="id_s" id="id_s" maxlength="200" value="<?= $_REQUEST['cn'] ?>">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group form-group-lg">
				<div class="input-group" data-toggle="tooltip" data-placement="bottom" title="">	
					<div class="input-group-addon fa fa-user iconbox"></div>
					<select class="form-control" placeholder='Tipo' name='tipo' id='tipo'>
						<?
							switch ($_REQUEST['id']) {
								case '1':
									echo "<option value='1'>Formularios</option>";
									break;
								case '2':
									echo "<option value='2'>Tipología Documental</option>";
									break;
								case '3':
									echo "<option value='3'>Suscriptores</option>";
									break;
								default:
									echo "<option value='1'>Formularios</option>";
									echo "<option value='2'>Tipología Documental</option>";
									echo "<option value='3'>Suscriptores</option>";
									break;
							}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="form-group form-group-lg">
				<div class="input-group" data-toggle="tooltip" data-placement="bottom" title="">	
					<div class="input-group-addon fa fa-user iconbox"></div>
					<select class="form-control" placeholder='es_generico' name='es_generico' id='es_generico'>
						<option value="0">¿El Formulario es Generico o Principal?</option>
							<option value="1">SI</option>
							<option value="0">NO</option>
					</select>
				</div>
			</div>
		</div>
	</div>


<br>
	<div class="row">
		<div class="col-md-12">
			<? 
				if ($_REQUEST['cn'] == "") {
			?>
					<button type="button" class="btn btn-success fullwidth" onclick="SendForm('formmeta_referencias_titulos', '/meta_referencias_titulos/','fmeta', 'body-metadatosjs')">Guardar Formulario</button>
			<?
				}else{

					switch ($_REQUEST['id']) {
								case '1':
			?>
									<button type="button" class="btn btn-success fullwidth" onclick="SendForm('formmeta_referencias_titulos', '/meta_referencias_titulos/dependencia/<?= $_REQUEST['cn'] ?>/form/','form', 'body-metadatosjs')">Guardar Formulario</button>
			<?
									break;
								case '2':
			?>
									<button type="button" class="btn btn-success fullwidth" onclick="SendForm('formmeta_referencias_titulos', '/meta_referencias_titulos/dependencia/<?= $_REQUEST['cn'] ?>/<?= $_REQUEST['p1'] ?>/','fmeta', 'body-metadatosjs')">Guardar Formulario</button>
			<?
									break;
								default:
					}
			?>
					
			<?
				}
			?>
			
		</div>
	</div>

</form>