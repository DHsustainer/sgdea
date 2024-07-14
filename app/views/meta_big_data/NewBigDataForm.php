<?
	
	$ids = $object->GetTipo_documento();
	$consulta = $con->Query("Select * from meta_referencias_titulos where id_s = '".$ids."' and tipo = '1'");

?>
<form id="formnewbigdata">
	<div class="row" style="padding:20px">
		<div class="col-md-8">
			<div class="form-group">
				<div class="form-group form-group-lg">
					<input type="hidden" id="type_id" name="type_id" value="<?= $object->GetId() ?>">
					<label>
						Seleccione un Formulario para Crear
						<select class="form-control" name='ref_id' id='ref_id' >
							<option value="0">Seleccione un Formulario</option>		
						<?
							while ($row = $con->FetchAssoc($consulta)) {
								echo "<option value='".$row['id']."'>".$row['titulo']."</option>";
							}
						?>
						</select>
					</label>
				</div>
			</div>
		</div>
		<div class="col-md-4"><br>
			<input type="button" value="Crear Formulario" onClick="DoBigData()">
		</div>
	</div>			

</form>