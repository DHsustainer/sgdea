<form id='formestados_gestion' action='/estados_gestion/registrar/' method='POST'> 
	<h2>Crear un nuevo estado <?= $c->Ayuda('205') ?></h2>
	<input type='hidden' name='dependencia' id='dependencia' maxlength='250' value="<?= $id ?>" />
	<input type='text' class='form-control important' placeholder='Nombre' name='nombre' id='nombre' maxlength='250' />
	<input type='button' value='Insertar' class='btn btn-info m-t-30 m-b-30' onClick="InsertEstado_gestion()"/>
</form>