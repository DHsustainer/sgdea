<form id='FormUpdateseccional' action='/seccional/actualizar/' method='POST' method='POST'> 
	<div class="title">Editar Ciudad</div><br>
	<input type='hidden' class="form-control"  placeholder="nombre" name='id' id='id' maxlength='' value='<? echo $object -> GetId(); ?>' />
	<input type='text' class="form-control"  placeholder="nombre" name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
	<input type='text' class="form-control"  placeholder="direccion" name='direccion' id='direccion' maxlength='' value='<? echo $object -> Getdireccion(); ?>' />
	<input type='text' class="form-control"  placeholder="telefono" name='telefono' id='telefono' maxlength='' value='<? echo $object -> Gettelefono(); ?>' />
	<input type='hidden' class="form-control"  placeholder="principal" name='principal' id='principal' maxlength='' value='<? echo $object -> Getprincipal(); ?>' />
	<input type='hidden' class="form-control"  placeholder="ciudad" name='ciudad' id='ciudad' maxlength='' value='<? echo $object -> Getciudad(); ?>' />
	
	<input style="margin:10px;" type='submit' value='Actualizar'/>

</form>

