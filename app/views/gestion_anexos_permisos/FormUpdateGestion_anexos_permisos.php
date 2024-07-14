	<form id='FormUpdategestion_anexos_permisos' action='/firmas_usuarios/listar/' method='POST'> 
		<div class="descripcion">
			<b>Observación:</b><br>
			<div class="addmargin">
				<? echo $objectgap -> Getobservacion(); ?>
			</div>
		</div>
<!--	<input type='hidden' name='id' id='id' value='<? echo $objectgap -> GetId(); ?>' />
		<select placeholder='estado' name='estado' id='estado' class="form-control" style="width:540px;">
			<option value="0">Pendiente por Revisar</option>
			<option value="1">Aprobar Documento</option>
			<option value="2">Rechazar Documento</option>
		</select>
		<input type="hidden" value="<? echo $objectgap -> Getobservacion(); ?>" name="observacion2" id="observacion2">
		
		<textarea id="observacion" name="observacion" class="form-control" placeholder="Observacion" style="width:530px; height:70px; resize:none"></textarea>-->
		<input type='submit' value='Ver el Listado de Documentos por Firmar'/>
	</form>

<style type="text/css">
	.descripcion {
	    margin: 10px;
	    border: 1px dashed #EDEDED;
	    background-color: #F7F7F7;
	    padding: 10px;
	    line-height: 25px;
	}

	.addmargin{
		margin-left: 15px;
	}
</style>
