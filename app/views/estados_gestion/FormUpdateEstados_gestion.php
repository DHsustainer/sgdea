<form id='FormUpdateestados_gestion' action='/estados_gestion/actualizar/' method='POST'> 
	<div class='title'>Editar estados_gestion</div>
		<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
		<input type='text' class='form-control important' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
		<input type='button' value='Actualizar' onClick="EditEstado_gestion()"/>
</form>
