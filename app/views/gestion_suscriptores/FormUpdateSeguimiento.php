<form id='formupdateavisos' method='POST' class="p-20"> 
	<input type='hidden' name='id' id='id' value='<?= $object -> GetId() ?>' />
<?

	$sus = new MSuscriptores_contactos;
	$sus->CreateSuscriptores_contactos("id", $object -> GetId_suscriptor());

	$susd = new MSuscriptores_contactos_direccion;
	$susd->CreateSuscriptores_contactos_direccion("id_contacto", $sus->GetId());

	$g = new MGestion;
	$g->CreateGestion("id", $object->GetId_gestion());

	$lx = new MSuscriptores_tipos;
	$lx->CreateSuscriptores_tipos("id", $sus->GetType());

	$sn = ($object->GetAviso() == "NO")?"selected='selected'":"";
	$ss = ($object->GetAviso() == "SI")?"selected='selected'":"";

	echo '	
			<div class="row">
				<div class="col-md-4">
					<b>'.SUSCRIPTORCAMPONOMBRE.':</b>
				</div>
				<div class="col-md-8">
					'.$sus->GetNombre().'
				</div>
			</div>
			<div class="row m-t-10 m-b-30">
				<div class="col-md-4">
					<b>Radicado:</b>
				</div>
				<div class="col-md-8">
					'.$g->GetRadicado().'
				</div>
			</div>
			';


	$path =  "	<select class='form-control' id='estadoaviso' name='estadoaviso'>
				<option value='NO' ".$sn.">NO</option>
				<option value='SI' ".$ss.">SI</option>
			</select>";
?>
	<div class="row">
		<div class="col-md-6">
			<label for="estado"><?= TITULOSEGUIMIENTOSUSCRIPTORES ?>:</label>
			<?= $path ?>	
		</div>
		<div class="col-md-6">
			<label for="fecha_aviso">Fecha de Aviso</label>
			<input type="date" value="<?= $object->GetFecha_aviso() ?>" class="form-control" name="fecha_aviso" id="fecha_aviso">
		</div>
	</div>
	<div class="row m-t-30">
		<div class="col-md-12">
			<label for="estado">Observacion:</label><br>
			<textarea id="observacion" name="observacion" class="form-control"><?= $object->GetObservacion() ?></textarea>
		</div>
	</div>
	<div class="row m-t-30">
		<div class="col-md-12">
			<button type="button" class="btn btn-info" onclick="CambiarAvisoSuscriptor()">Actualizar <?= TITULOSEGUIMIENTOSUSCRIPTORES ?></button>
		</div>
	</div>
</form>