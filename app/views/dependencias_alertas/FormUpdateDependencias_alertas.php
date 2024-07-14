<form id='FormUpdatedependencias_alertas' action='/dependencias_alertas/actualizar/' method='POST'> 
	<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
	<h3>Actualizar Alerta</h3>
	<br>
	<div class="row"> 
	 	<div class="col-md-8">
	 		<label for="">Nombre:</label>
			<input type='text' class='form-control important' placeholder='Nombre' name='nombre' id='nombre' value='<? echo $object -> Getnombre(); ?>' />
	 	</div>
	 	<div class="col-md-4">
	 		<label for="">Dependencia: <span class="fa fa-question-circle-o" style="cursor:pointer" data-toggle="popover" data-trigger="hover" data-content="La alerta está asociada con otra"></span></label>
			<select class='form-control' name='dependencia' id='dependencia' maxlength='3'>
				<option value="0">Seleccione una opción si esta alerta se crea a partir de otra</option>
			<?
				$da = new MDependencias_alertas;
				$da->GetDependientes($object -> Getid_dependencia(), 0, "-");	
			?>
			</select>
	 	</div>
	</div>
	<div class="row"> 
	 	<div class="col-md-6 m-t-20">
	 		<label for="">Dias para Ejecutar Alerta:</label>
			<input type='number' class='form-control important' placeholder='Dias para Ejecutar Alerta'  title='Dias para Ejecutar Alerta' name='dias_alerta' id='dias_alerta' maxlength='3' value='<? echo $object -> Getdias_alerta(); ?>' />
	 	</div>
	 	<div class="col-md-6 m-t-20">
	 		<label for="">Avisar Cuantos Días Antes:</label>
			<input type='text' class='form-control important' placeholder='Avisar Cuantos Días Antes'  title='Avisar Cuantos Días Antes' name='dias_antes' id='dias_antes' maxlength='3' value="<?= $object->GetDias_antes() ?>" />
	 	</div>
	</div>
	<div class="row"> 
	 	<div class="col-md-6 m-t-20">
	 		<label for="">¿Crear Alerta al Crear el Expediente? <span class="fa fa-question-circle-o" style="cursor:pointer" data-toggle="popover" data-trigger="hover" title="Crear alerta al Crear el Expediente" data-content="Al crear un expediente nuevo de esta subserie se creará esta actividad por defecto"></span></label>
			<select class='form-control important' name='automatica' id='automatica'>
				<option value="NO">¿Crear Alerta al Crear el Expediente?</option>
				<option value="SI" <?= ($object->GetAutomatica() == "SI")?"selected='selected'":"" ?> >SI, GENERAR AUTOMÁTICAMENTE</option>
				<option value="NO" <?= ($object->GetAutomatica() == "NO")?"selected='selected'":"" ?> >NO, GENERAR MANUALMENTE</option>
				<option value="AR" <?= ($object->GetAutomatica() == "AR")?"selected='selected'":"" ?> >NO, GENERAR AL REALIZAR LA ALERTA PADRE</option>
				<option value="AA" <?= ($object->GetAutomatica() == "AA")?"selected='selected'":"" ?> >NO, GENERAR AL ANULAR LA ALERTA PADRE</option>
				<option value="AV" <?= ($object->GetAutomatica() == "AV")?"selected='selected'":"" ?> >NO, GENERAR AL VENCERSE LA ALERTA PADRE</option>
			</select>
			
	 	</div>
	 	<div class="col-md-6 m-t-20">
	 		<label for="">¿La actividad es Publica? <span class="fa fa-question-circle-o" style="cursor:pointer" data-toggle="popover" data-trigger="hover" title="La actividad es Publica" data-content="Las actividades realizadas y marcadas como publicas serán vistas desde la consulta externa"></span></label>
	 		<select class='form-control important' name='es_publico' id='es_publico'>
				<option value="0">¿La actividad es Publica?</option>
				<option value="1" <?= ($object->GetEs_publico() == "1")?"selected='selected'":"" ?> >SI</option>
				<option value="0" <?= ($object->GetEs_publico() == "0")?"selected='selected'":"" ?> >NO</option>
			</select>
			
	 	</div>
	</div>
	<div class="row"> 
	 	<div class="col-md-12 m-t-20">
			<textarea class='form-control' placeholder='Descripcion del Evento Max: 400 caractares' name='descripcion' id='descripcion' style="height: 90px;" ><? echo $object -> GetDescripcion(); ?></textarea>
	 	</div>
	</div>
	<input type='hidden' value="<? echo $object -> Getid_dependencia(); ?>" class='form-control' placeholder='Id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='10' />
	<input type='hidden' value='<? echo $object -> Getusuario(); ?>' class='form-control' placeholder='Usuario' name='usuario' id='usuario' maxlength='50' />
	<input type='hidden' value='<? echo $object -> Getfecha(); ?>' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
	<input type='button' value='Actualizar Alerta' class="btn btn-info m-t-20 m-b-30"  onClick="UpdateAlertaDependencia()"/>
</form>
<hr>

<style type="text/css">
	.row{
		margin:0px !important;
	}
</style>

<script type="text/javascript">
	
	$(document).ready(function(){
    	$('[data-toggle="popover"]').popover()

    	$('#dependencia option[value="<?= $object->Getdependencia_alerta() ?>"]').attr("selected", true);

	});

</script>