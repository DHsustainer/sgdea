<form id='FormUpdateareas' action='/areas/actualizar/' method='POST' method='POST'> 	
	<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
	<input type='hidden'  name='user_id' id='user_id' maxlength='100' value="<?= $object -> Getuser_id(); ?>" />
	<div class="row">
		<div class="col-md-8">
			<input type='text' class="form-control" placeholder="Nombre" name='nombre' id='nombre' maxlength='100' value='<? echo $object -> Getnombre(); ?>' />
		</div>
		<div class="col-md-4">
			<input type="text" class="form-control" name="prefijo" id="prefijo" maxlength="" placeholder="Código" value="<? echo $object -> GetPrefijo(); ?>">
		</div>
		<div class="col-md-12 m-t-30">
			<input type='submit' class="btn btn-info" value='Guardar <?= CAMPOAREADETRABAJO; ?>'/>
		</div>
	</div>
</form>