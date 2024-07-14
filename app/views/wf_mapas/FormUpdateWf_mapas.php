<form id='FormUpdatewf_mapas' action='/wf_mapas/actualizar/' method='POST'> 
<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
	<input type='text' class='form-control' placeholder='titulo' name='titulo' id='titulo' maxlength='' value='<? echo $object -> Gettitulo(); ?>' />
	<textarea placeholder="Descripción de la Actividad"  class='form-control' style="height:150px"  name='descripcion' id='descripcion'><? echo $object -> GetDescripcion(); ?></textarea>
		<div style="float:right">
			<button type="button" class="btn btn-primary" data-dismiss="modal" onClick="ActualizarMapa('FormUpdatewf_mapas')">Guardar Elemento</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		</div><br>
		<div style="clear:both"></div>
	</form>
