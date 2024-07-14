<hr>
<div class="row">
	<div class="col-md-12">
		<h5 class="m-t-10"><b>CREAR OFICINA</b></h5>
		<form id='formareas' action='/seccional/registrar/' method='POST'> 
			<input type='text' class="form-control m-t-10 important" placeholder="Nombre" name='nombre' id='nombre' maxlength='60' placeholder ="Nombre" />
			<input type='text' class="form-control m-t-10 important" placeholder="Direccion" name='direccion' id='direccion' maxlength='100' placeholder ="Direccion" />
			<input type='text' class="form-control m-t-10 important" placeholder="Telefono" name='telefono' id='telefono' maxlength='100' placeholder ="Telefono" />
			<input type='hidden' class="hidden" name='principal' id='principal' maxlength='10' placeholder ="Principal" value="<?= $sp->GetId() ?>" />
			<input type='hidden' class="hidden" name='ciudad' id='ciudad' maxlength='10' placeholder ="Principal" value="<?= $sp->GetCiudad_origen() ?>" />
			

			<input type='button' value='Crear Oficina' onClick="InsertSeccional()" class="btn btn-info m-t-30" />

		</form>
	</div>
</div>