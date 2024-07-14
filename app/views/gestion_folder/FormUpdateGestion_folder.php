<form id='FormUpdategestion_folder' action='/gestion_folder/actualizar/' method='POST'> 
	<input type='hidden' name='id' id='id' value='<? echo $object->GetId(); ?>' />
	<div class="row">
		<div class="col-md-6">
			<label>NOMBRE DE LA CARPETA</label>
			<input type="text" placeholder='nombre' name='nombre' id='foldername' maxlength='' value='<? echo $object -> Getnombre(); ?>' class="form-control">
		</div>
		<div class="col-md-6">
			<label>TIPO DE CARPETA</label>
			<select class='form-control' style="width:100%;" placeholder='Tipo' name='tipo' id='typefolder' >
				<option <?= ($object -> Gettipo() == '1')?"selected='selected'":"" ?> value="1">Carpeta Publica</option>
				<option <?= ($object -> Gettipo() == '2')?"selected='selected'":"" ?> value="2">Carpeta Privada</option>			
			</select>
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-6">
			<input type='button' value='Actualizar Carpeta' class="btn btn-primary pull-left" onClick="UpdateFolderName('<?= $object->GetId() ?>')"/>
		</div>
		<div class="col-md-6">
			<input type='button' value='Eliminar Carpeta' class="btn btn-danger  pull-right" onClick="DeleteFolder('<?= $object->GetId() ?>')"/>
		</div>
	</div>
</form>