<input class="form-control" type='hidden' name='id' id='form_id' value='<? echo $object -> GetId(); ?>' />
<input class="form-control" type='hidden' name='id' id='form_id_contacto' value='<? echo $object -> GetId_contacto(); ?>' />

<div class="row m-t-20">
	<div class="col-md-6">
		<label for="form_ciudad">Ciudad</label>
		<input class="form-control" type='text' name='ciudad' id='form_ciudad' placeholder="Ciudad" value='<? echo $object -> Getciudad(); ?>' />
	</div>
	<div class="col-md-6">
		<label for="form_direccion">Dirección</label>
		<input class="form-control" type='text' name='direccion' id='form_direccion' placeholder="<?= SUSCRIPTORCAMPODIRECCION ?>" value='<? echo $object -> Getdireccion(); ?>' />
	</div>
</div>
<div class="row m-t-20">
	<div class="col-md-6">
		<label for="form_telefonos">Teléfono</label>
		<input class="form-control" type='text' name='telefonos' id='form_telefonos' placeholder="Telefonos" value='<? echo $object -> Gettelefonos(); ?>' />
	</div>
	<div class="col-md-6">
		<label for="form_email">E-mail</label>
		<input class="form-control" type='text' name='email' id='form_email' placeholder="E-mail" value='<? echo $object -> Getemail(); ?>' />
	</div>
</div>
<div class="row m-t-20">
	<input type="button" class="btn btn-info" onClick="UpdateSuscriptores_contactos_direccion()" value="Actualizar Información de Contacto" />
</div>