<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'events'.DS.'scripts'.DS ?>script.js'></script>

	<form id='formevents' method='POST'> 
		<div class="item-title">CREAR EVENTO</div>
		<table border='0' cellspacing='4' cellpadding='0' class='tabla' width='90%' style="margin: 0 auto;">
			<tr>
				<td colspan='2'><input type='text' placeholder="Título:" name='title' id='title' maxlength='' /></td>
			</tr>
			<tr>
				<td colspan="2s"><input type='text' value="<?= $date; ?>" name='date' id='date' maxlength='11'/></td>
				<td style="display:none"><input type='text' placeholder="Fecha Vence" name='fecha_vencimiento' style="width:83px; display:none" id='fecha_vencimiento' maxlength='' /></td>
			</tr>
			<tr>
				<td><input type='text' placeholder="Hora: Ej: 17:45" name='time' id='time' maxlength='10' style="width:83px" /></td>
				<!--<td >
					<input type='checkbox' name='deadline' id='deadline' maxlength='4' />
					<label for="deadline">Evento importante</label>
				</td> -->
				<td>
					<select name="avisar_a" id="avisar_a">
						<option value="1">Avisar...</option>
						<?

							global $au;

							$GetAlertas = $au->ListarAlertas_usuariosByType("2");
							while ($row = $con->FetchAssoc($GetAlertas)) {
								echo "<option value='".$row["dias"]."'>".$row["titulo"]."</option>";
							}

						?>

					</select>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<textarea name="description" id="description" cols="10" style="height:60px" rows="4" placeholder="Descripción"></textarea>
				</td>
			</tr>
			<tr style="display:none">
				<td><input type='text' value="<?= $pid; ?>" placeholder="Proceso_id:" name='proceso_id' id='proceso_id' maxlength='9' /></td>
			</tr>
			<tr>
				<td align='center' colspan="4">
					<input type='button' value='Guardar Evento' id="btn_insert_event" onClick="InsertEvent()"/>
				</td>
			</tr>
		</table>
	</form>

<script>

$(document).ready(function(){

	$('#date').datepicker({
		dateFormat: 'yy-mm-dd',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],		
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
		dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday		
	});

});

</script>