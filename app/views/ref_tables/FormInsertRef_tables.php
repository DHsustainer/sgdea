<div class="title right">Crear Formulario</div>
<br>
<form id='formref_tables' method='POST'> 
	<input type='hidden' class="form-control" name='username' id='username' maxlength='50' value="<?= $_SESSION['usuario'] ?>" />
	<input type='hidden' class="form-control" name='dependencia_id' id='dependencia_id' maxlength='10' value="<?= $id ?>" />
	<input type='text' class="form-control important" name='title' id='title' maxlength='200' placeholder="Título del formulario" />
	<br>
	<input type="checkbox" id="es_generico" name="es_generico">
	<label for="es_generico">¿Formulario Generico? <small>El formulario se activará al crear un documento</small></label><br>
	<input type='hidden' class="form-control" name='fecha' id='fecha' maxlength='' value="<?= date("Y-m-d") ?>" />
	<input type='button' style="margin:10px;" value='Insertar' onClick="InsertarFormulario()"/> 
</form>