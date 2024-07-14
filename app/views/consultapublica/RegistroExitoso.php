
<?
	#$email = "sanderkdna@gmail.com";
	#$objectx = new MUsuarios;
	#$objectx->CreateUSuarios("user_id", $email);

	$nombre = $objectx->GetP_nombre()." ".$objectx->GetP_apellido();

	$MPlantillas_email = new MPlantillas_email;
	$MPlantillas_email->CreatePlantillas_email('id', '66');
	$contenido_email = $MPlantillas_email->GetContenido();
	$contenido_email = str_replace("[elemento]Suscriptor[/elemento]", $nombre, $contenido_email );
?>
<div class="row">
	<div class="col-md-6 p-30">
		<?= $contenido_email ?>
		<form action="#" id="form-cita">
			<input type="hidden" name="username" id="username" value="<?= $email; ?>" class="form-control">
			<div class="row m-t-30">
				<div class="col-md-6">
					<div class="form-group">
						<label for="date_cita">Selecciona la Fecha en la que deseas agendar su capacitación</label>
						<?
							$min= date("Y-m-d");

							 if (date("D")=="Mon"){
							     $week_start = date("Y-m-d");
							 } else {
							     $week_start = date("Y-m-d", strtotime('last Monday', time()));
							 }
							 $week_end = strtotime('next Saturday', time());
							 $max =  date('Y-m-d', $week_end);

						?>
						<input type="date" name="date_cita" id="date_cita" min="<?= $min ?>" max="<?= $max ?>" value="" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="time_cita">Selecciona la hora de su conveniencia</label>
						<select class="form-control" name="time_cita" id="time_cita">
							<option value="08:00 - 08:40">De 08:00 a 08:40</option>
							<option value="10:00 - 10:40">De 10:00 a 10:40</option>
							<option value="11:00 - 12:00">De 11:00 a 12:00</option>
							<option value="14:00 - 14:40">De 14:00 a 14:40</option>
							<option value="16:00 - 16:40">De 16:00 a 16:40</option>
						</select>
						
					</div>
				</div>
			</div>
			<div class="row m-t-30">
				<div class="col-md-12">
					<button type="button" class="btn btn-info" onclick="SendRequestAp()">Realizar Solicitud de Capacitación</button>
					<div id="output" class="m-t-30 m-b-30"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4>
						<a href='<? echo HOMEDIR.'/index.php?m=login&action=check&username='.$email.'&pass='.$identificacion ?>' class='btn btn-danger'>haga clic aqui Para ingresar al sistema</a> 
					</h4>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6 p-30">
		<h3 class="dn">Antes de Empezar</h3>
		<p class="dn">Tómate unos minutos para aprender como funciona <?= PROJECTNAME ?></p>

		<div class="row dn">
			<div class="col-md-12">
				<h4>
					<a href='<? echo HOMEDIR.'/index.php?m=login&action=check&username='.$email.'&pass='.$identificacion ?>' class='btn btn-danger'>haga clic aqui Para ingresar al sistema</a> 
				</h4>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	function SendRequestAp(){


		var str = $("#form-cita").serialize();
		var URL = "/s/actualizarcita/";

		$.ajax({
	        type: 'POST',
	        url: URL,
            data: str,
	        success:function(msg){
	        	$("#output").addClass("alert");
	        	$("#output").addClass("alert-success");
	    		$("#output").html(msg);
	    		return false;
	        }
	    });
	    return false;
	}

	$("#date_cita").change(function(){
		if($(this).val() == "<?= $max ?>"){
			$("#time_cita").html('<option value="09:00 - 09:40">De 09:00 a 09:40</option>');
		}else{
			$("#time_cita").html('<option value="08:00 - 08:40">De 08:00 a 08:40</option><option value="10:00 - 10:40">De 10:00 a 10:40</option><option value="11:00 - 12:00">De 11:00 a 12:00</option><option value="14:00 - 14:40">De 14:00 a 14:40</option><option value="16:00 - 16:40">De 16:00 a 16:40</option>');

		}
	});

</script>