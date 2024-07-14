<h2>Compartir este expediente con un usuario</h2>
<form id='formgestion_compartir' action='/gestion_compartir/registrar/' method='POST'> 
	<input type='hidden' value="<?= $_SESSION['usuario'] ?>" name='usuario_comparte' id='usuario_comparte'/>
	<input type='hidden' value="<?= $id ?>" name='gestion_id' id='gestion_id' />
	<input type='hidden' value="<?= date("Y-m-d H:i:s") ?>" name='fecha' id='fecha'/>
	<input type='hidden' name='usuario_nuevo' id='usuario_nuevo' maxlength='50' />
	<div class="row">
		<div class="col-md-6">
			<input type="text" class='form-control important' id="searchbform" placeholder="Escriba el nombre del usuario">	
			<div id="bloquebusqueda"></div>
		</div>
		<div class="col-md-3">
			<select class="form-control" name='type' id='type'>
				<option value="0">El Usuario solo puede Consultar</option>
				<option value="1">El Usuario puede Interactuar</option>
			</select>
		</div>
		<div class="col-md-3">
			<input type="date" class='form-control' id="fecha_caducidad" name="fecha_caducidad" placeholder="Fecha de Caducidad del Permiso" >	
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-12">
			<textarea class="form-control important" type='text' name='observacion' id='observacion' placeholder="Observacion" style="height:80px"></textarea>
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-12">
			<input type='button' value='Compartir Expediente' class="btn btn-info pull-right" onClick="InsertGestion_compartir()"/>
		</div>
	</div>
</form>
<script>
	$("#searchbform").on("keyup", function(){
		$("#bloquebusqueda").fadeIn();				
		$.ajax({
			type: "POST",
			url: '/usuarios/GestListadoUsuarios/'+$(this).val()+"/",
			success: function(msg){
				result = msg;
				$("#bloquebusqueda").html(result);					
			}
		});				
	})



	function onTecla(e){	
		var num = e?e.keyCode:event.keyCode;
		if (num == 9 || num == 27){
			$("#bloquebusqueda").fadeOut();		
		}
	}
	document.onkeydown = onTecla;
	if(document.all){
		document.captureEvents(Event.KEYDOWN);	
	}
	function AddUsuarioToListado(nombre, email, id){
		$("#searchbform").val(nombre);
		$("#usuario_nuevo").val(email);

		$("#bloquebusqueda").fadeOut();		
	}
	/*
	$('.datepicker').datepicker({
		dateFormat: 'yy-mm-dd',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
		dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday				
	});
	*/
</script>