<form id='FormUpdatewf_gestion_mapas_elementos' action='/wf_gestion_mapas_elementos/actualizar/' method='POST'> 
<?
	
	$elemento = new MWf_mapas_elementos;
	$elemento->CreateWf_mapas_elementos("id", $id);

?>
		<input type='hidden' name='id_elemento' id='id_elemento' value='<? echo $id_elemento; ?>' />
		<input type='hidden' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='1' />

		<input type='hidden' class="form-control" placeholder="user_id" name='user_id' id='user_id' maxlength='99' value="<?= $_SESSION['usuario'] ?>" />
		<input type='hidden' class="form-control" placeholder="gestion_id" name='gestion_id' id='gestion_id' maxlength='9' value="<?= $id_gestion ?>" />
		<input type='hidden' class="form-control" placeholder="added" name='added' id='added' maxlength='' value="<?= date("Y-m-d") ?>" />
		<input type='hidden' class="form-control" placeholder="status" name='status' id='status' maxlength='4' value="1" />
		<input type='hidden' class="form-control" placeholder="alerted" name='alerted' id='alerted' maxlength='1' value="0" />
		<input type='hidden' class="form-control fecha" placeholder="fecha_vencimiento" name='fecha_vencimiento' id='fecha_vencimiento' maxlength='' value="" />
		<input type='hidden' class="form-control" placeholder="type_event" name='type_event' id='type_event' maxlength='2' value="1" />
		<input type="hidden" id="grupo" name="grupo" placeholder="Nombre Usuario" style="height:35px;">
		
		<input type='text' style="width:117px" class="form-control fecha important" placeholder="Fecha del Evento" name='fecha' id='fecha' maxlength='' />
		<input type='time' style="width:108px" class="form-control important" placeholder="Hora de Actuación Ej: 14:50" name='time' id='time' maxlength='' value="" />
		<select name="avisar_a" id="avisar_a" style="width:82px !important; height:46px;" class="form-control" >
			<option value="1">Avisar...</option>
			<?

				global $au;
				global $c;

				$GetAlertas = $au->ListarAlertas_usuariosByType("2");
				while ($row = $con->FetchAssoc($GetAlertas)) {
					echo "<option value='".$row["dias"]."'>".$row["titulo"]."</option>";
				}

			?>

		</select>
		<select name="es_publico" id="es_publico" style="width:165px !important; height:46px;" class="form-control" >
			<option value="0">¿El evento es Publico?</option>
			<option value="1">SI</option>
			<option value="0">NO</option>
			
		</select>
		<input type='text' class="form-control important" style="width:356px" placeholder="Título" name='title' id='title' maxlength='' value="<?= $elemento->GetTitulo() ?>" />
		<input type="text" id="dtformcompartircom" name="dtformcompartircom" placeholder="Nombre Usuario" style="height:35px; width:165px" class="input1_0 form-control important"><div id="bloquebusquedacompartircom"></div>
		<textarea class="form-control" placeholder="Descripción de la Actuación" name='description' id='description' style="height: 100px; resize: none; width:96%"><?= $elemento->GetTitulo_conector() ?></textarea>



		<input type='button' value='Actualizar' onClick="RegistarEvento_Elemento()"/>

		<div id="outputme">...</div>
</form>
<script type="text/javascript">
	
	$("#myModalLabel").html("Activar Alerta")


$(document).ready(function(){

	$('#fecha').datepicker({
		dateFormat: 'yy-mm-dd',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],		
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
		dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday		
	});

});

	$("#dtformcompartircom").on("keyup", function(){
		$("#bloquebusquedacompartircom").fadeIn();					
		$.ajax({
			type: "POST",
			url: '/usuarios/ListadoUsuariosTodos/'+$(this).val()+"/",
			success: function(msg){
				result = msg;
				$("#bloquebusquedacompartircom").html(result);					
			}
		});				
	});

	function AddUsuario(id, nombre){
		$("#bloquebusquedacompartircom").fadeOut("fast");
		$("#dtformcompartircom").val(nombre);
		$("#grupo").val(id);

	}
</script>