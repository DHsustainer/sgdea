
<form id='formsuscriptores_reglas_negocios_generales' action='/suscriptores_reglas_negocios_generales/registrar/' method='POST'> 
	<h3>Crear Regla</h3>
	<input type='hidden' class='form-control' name='id_paquete' id='id_paquete' maxlength='10' value="<?= $negocio ?>" />
	<input type='hidden' class='form-control' name='id_proyecto' id='id_proyecto' maxlength='10' value="<?= $proyecto ?>"  />
	
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="Valor_base">Forma de Pago</label><br>
				<select name="forma_pago" id="forma_pago" style="height: 45px; margin-top: 10px">
				<?
					$q = $con->Query("select * from estadosx where tipo = 'forma_pago' and estado = '1'");
					while ($row = $con->FetchAssoc($q)) {
							echo "<option value='".$row['valor']."'>".$row['nombre']."</option>";
						}	
				?>

				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="tipo_regla">Tipo de Regla</label><br>
				<select name="tipo_regla" id="tipo_regla" style="height: 45px; margin-top: 10px">
				<?
					$q = $con->Query("select * from estadosx where tipo = 'tipo_regla' and estado = '1'");
					while ($row = $con->FetchAssoc($q)) {
							echo "<option value='".$row['valor']."'>".$row['nombre']."</option>";
						}	
				?>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="Valor_base">Detalle</label>
				<input type='text' class='form-control' placeholder='Ej: IVA, PAGO DE HOSTING' name='observacion' id='observacion' maxlength='200' />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="Valor_base">Valor de(los)  Pago(s)</label>
				<input type='text' class='form-control' placeholder='Valor' name='valor' id='valor' maxlength='10' />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="Valor_base">Cantidad <br>de Pagos</label>
				<input type='text' class='form-control' placeholder='1' name='cantidad' id='cantidad' maxlength='10' value="1" />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="Valor_base">Frecuencia del Cobro</label>
				<div id="type_cobro">
					<select name="tipo_cobro" id="tipo_cobro" style="height: 45px; margin-top: 10px">
					<?
						$q = $con->Query("select * from estadosx where tipo = 'tipo_cobro' and estado = '1'");
						while ($row = $con->FetchAssoc($q)) {
								echo "<option value='".$row['valor']."'>".$row['nombre']."</option>";
						}	
					?>	
					</select>
				</div>
			</div>
		</div>
	</div>

	<input type='submit' value='Insertar'  style='margin:10px;'/>
</form>
<script>
	$("#tipo_cobro").change(function(){
		if ($(this).val() == "otro") {
			$("#type_cobro").html("<input type='text' class='form-control' placeholder='Escriba la Frecuencia del Cobro' name='tipo_cobro' id='tipo_cobro'/>");
		}
	})
</script>