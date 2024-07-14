<form id='FormUpdatewf_mapas_elementos' method='POST'> 
	<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
	<input type='text' class='form-control' placeholder='titulo' name='titulo' id='titulo' maxlength='' value='<? echo $object -> Gettitulo(); ?>' />
	<textarea placeholder="Descripción de la Actividad"  class='form-control' style="height:150px"  name='titulo_conector' id='titulo_conector'><? echo $object -> GetTitulo_conector(); ?></textarea>
		<div style="float:right">
			<button type="button" class="btn btn-primary" data-dismiss="modal" onClick="ActualizarElemento('FormUpdatewf_mapas_elementos')">Guardar Elemento</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		</div><br>
		<div style="clear:both"></div>
</form>
