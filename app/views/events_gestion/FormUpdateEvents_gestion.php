<?
global $c;
?>
<form id='FormUpdateevents_gestion' action='/events_gestion/actualizar/' method='POST'> 
	<input type='hidden' name='gestion_id' id='gestion_id' value="<?= $object->GetGestion_Id() ?>" />
	<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />

	<div class="row m-t-10">
		<div class="col-md-12">
			<label for="">Título</label>
			<input type="text" name="title" id="title" class="form-control" value="<? echo $object -> Gettitle(); ?>" placeholder="Escriba un Titulo para la Alerta">
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-4">
			<label for="">Fecha de la Actividad</label>
			<input type='date' style="width:185px" class="form-control fecha" placeholder="Día de la Actuación" name='fecha' id='fecha' maxlength='' value="<?= $object->GetFecha() ?>" />
		</div>
		<div class="col-md-4">
			<label for="">Hora</label>
			<input type='time' style="width:185px" class="form-control" placeholder="Hora de Actuación Ej: 14:50" name='time' id='time' maxlength='' value="<? echo $object -> GetTime(); ?>" />
		</div>
		<div class="col-md-4">
			<label>Usuario Responsable:</label>
			<?
				$grupo = $c->GetDataFromTable("usuarios", "a_i", $object->GetGrupo(), "p_nombre, p_apellido", " ");;
			?>
			<input type="text" id="dtformcompartircomx" value="<?= $grupo ?>" name="dtformcompartircomx" placeholder="Nombre Usuario" class="form-control important">
			<input type="hidden" id="grupox" value="<?= $object->Getgrupo() ?>" name="grupox" placeholder="Nombre Usuario" class="form-control important">
			<div id="bloquebusquedacompartircomx"></div>
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-4 dn">
			<label>Estado:</label>
			<select name='status' id='status'  class="form-control">
				<option value="0" <?= ($object -> Getstatus() == "0")?"selected='selected'":"" ?>>Realizado</option>
				<option value="1" <?= ($object -> Getstatus() == "1")?"selected='selected'":"" ?>>Pendiente</option>
				<option value="2" <?= ($object -> Getstatus() == "2")?"selected='selected'":"" ?>>Anular / No Realizado</option>
				<option value="3" <?= ($object -> Getstatus() == "3")?"selected='selected'":"" ?>>Atrasado</option>
			</select>
			
		</div>		
		<div class="col-md-4">
			<label>Avisar a:</label>
			<select name="avisar_a" id="avisar_a" class="form-control" >
				<option value="1">Avisar...</option>
				<option value="1" <?= ($object->Getavisar_a()=="1")?"selected='selected'":""?>>Un dia antes del evento</option>
				<option value="2" <?= ($object->Getavisar_a()=="2")?"selected='selected'":""?>>Dos dias antes del evento</option>
				<option value="3" <?= ($object->Getavisar_a()=="3")?"selected='selected'":""?>>Tres dias antes del evento</option>
				<option value="4" <?= ($object->Getavisar_a()=="4")?"selected='selected'":""?>>Cuatro dias antes del evento</option>
				<option value="6" <?= ($object->Getavisar_a()=="6")?"selected='selected'":""?>>Seis dias antes del evento</option>
				<option value="7" <?= ($object->Getavisar_a()=="7")?"selected='selected'":""?>>Siete dias antes del evento</option>
				<option value="15" <?= ($object->Getavisar_a()=="15")?"selected='selected'":""?>>15 dias evento personalizado</option>
				<option value="999" <?= ($object->Getavisar_a()=="999")?"selected='selected'":""?>>Avisar a fin de mes</option>

			</select>
			
		</div>		
		<div class="col-md-4">
			<label>¿El evento es Publico?:</label>
			<select name='es_publico' id='es_publico'  class="form-control">
				<option value="0" <?= ($object -> GetEs_publico() == "0")?"selected='selected'":"" ?>>NO</option>
				<option value="1" <?= ($object -> GetEs_publico() == "1")?"selected='selected'":"" ?>>SI</option>
			</select>
			
		</div>		
	</div>
	<div class="row m-t-10">
		<div class="col-md-12">
			<label>Descripción:</label>
			<textarea class="form-control" placeholder="Descripción de la Actuación" name='description' id='description' style="height: 100px; resize: none;"><? echo $object -> Getdescription(); ?></textarea>
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-12">
			<input type='submit' value='Actualizar Actuación' class="btn btn-info pull-right"/>
		</div>
	</div>
</form>

<script type="text/javascript">
$("#dtformcompartircomx").on("keyup", function(){
	$("#bloquebusquedacompartircomx").fadeIn();					
	$.ajax({
		type: "POST",
		url: '/usuarios/ListadoUsuariosTodos/'+$(this).val()+"/",
		success: function(msg){
			result = msg;
			$("#bloquebusquedacompartircomx").html(result);					
		}
	});				
});

function AddUsuario(id, nombre){
	$("#bloquebusquedacompartircomx").fadeOut("fast");
	$("#dtformcompartircomx").val(nombre);
	$("#grupox").val(id);

}
function setWhiteTitle(elm){
	enlace = "/dependencias_alertas/obtenerdetallealerta/"+$("#"+elm).val()+"/";
	$.ajax({
		type: 'POST',
		url: enlace,
		success: function(msg){
			$("#title").val(msg['title']);
			$("#fecha").val(msg['fecha']);
			$("#time").val(msg['hora']);
			$("#avisar_a").val(msg['avisar']);
			$("#description").val(msg['description']);
			if (msg['es_publica'] == "1") {
				$("#es_publica").prop('checked', true);
			}else{
				$("#es_publica").prop('checked', false);
			}
		}
	});
}
/*
*/
</script>

