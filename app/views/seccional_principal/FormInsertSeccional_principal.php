<form id='formseccional_principal' action='/seccional_principal/registrar/' method='POST'> 
	<h4>Creación de Ciudad</h4>
<?
	global $c;
	$total_activos = $c->GetTotalFromTable("seccional_principal");
	$cupos_totales = 0;
	if ($_SESSION['MODULES']['total_oficinas'] == "0") {
		$cupos_totales = 9999; 	
	}else{
		$cupos_totales = $_SESSION['MODULES']['total_oficinas'];
	}
	?>	
	<div class="row">
		<div class="col-md-6 bg-success text-white bold p-10"  <?= $c->Ayuda('127', 'tog') ?> >Oficinas Registradas: <?= $total_activos; ?></div>
		<div class="col-md-6 bg-danger text-white bold p-10" <?= $c->Ayuda('128', 'tog') ?> >Oficinas Totales: <?= $cupos_totales; ?></div>
	</div>
	
	<div class="bloq_utilizadas"></div>
	<div class="bloq_totales"></div>
	<div class="clear"></div>
	<br>
	
<?
	if ($cupos_totales > $total_activos) {
?>
		<select class="form-control m-b-10" name="departamento" placeholder="Departamento" id="departamento">
			<option value="">Seleccione un Departamento</option>
		</select>
		<select class="form-control" name="ciudad_origen" placeholder="Ciudad de Origen" id="ciudad_origen" disabled="disabled">
			<option value="">Seleccione una Ciudad</option>
		</select>

		<input type='hidden' class="form-control" placeholder="Nombre" name='nombre' id='nombre' maxlength='100' />
		<input type='hidden' class="form-control" placeholder="Sigla" name='sigla' id='sigla' maxlength='6' />
		
		
		<input type='button' value='Guardar Ciudad' onClick="InsertSeccionalPrincipal()" class="btn btn-info m-t-30"/>
<?
	}else{
		echo '<div class="alert alert-info">No tienes cupos disponibles</div>';
	}
?>
</form>

<script>
	
	$(document).ready(function() {
		dependencia_estado('departamento');

		$("#departamento").change(function(){
			dependencia_ciudad("departamento","ciudad_origen");
		});

		$("#ciudad_origen").change(function(){
			$("#nombre").val($("#ciudad_origen option:selected").text());
		})
	});

</script>