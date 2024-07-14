	<form id='formcontrol_versiones' action='/control_versiones/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='control_versiones' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariocontrol_versiones}</td>
			</tr>-->
		<div class='title right'>Crear Version</div>
		<label for="tipo">Tipo Versión: 
			<select class='form-control' placeholder='Tipo' name='tipo' id='tipo'>
				<option value="instalacion">Instalacion</option>
				<option value="actualizacion">Actualizacion</option>
			</select>
		</label><br>
		<label for="tipo">Nombre: 
			<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='255' />
		</label><br>
		<label for="tipo">Archivo: 
			<input type='button' id="upload_archivo" style="margin:10px;" value='Subir Archivo Zip' />
			<input type='hidden' class='form-control' placeholder='Archivos' name='archivos' id='archivos' maxlength='255' />
		</label><br>
		<label for="tipo">Esturctura DB: 
			<input type='button' id="upload_estructura" style="margin:10px;" value='Subir Extructura DB' />
			<input type='hidden' class='form-control' placeholder='Estructura_db' name='estructura_db' id='estructura_db' maxlength='255' />
		</label><br>
		<label for="tipo">Datos DB: 
			<input type='button' id="upload_datos" style="margin:10px;" value='Subir Datos DB' /> 
			<input type='hidden' class='form-control' placeholder='Datos_db' name='datos_db' id='datos_db' maxlength='255' />
		</label><br><br>
		<input type='submit' value='Crear Version'  style='margin:10px;'/>
	</form>
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/AjaxUpload.2.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var button = $('#upload_archivo'), interval;
	new AjaxUpload('#upload_archivo', {
        action: '/control_versiones/importar/',
		onSubmit : function(file , ext){
			if (! (ext && /^(zip)$/.test(ext))){
				// extensiones permitidas
				alert('Error: Solo se permiten archivos zip');
				// cancela upload
				return false;
			} else {
				this.disable();
			}
		},
		onComplete: function(file, response){
			if(response=='error'){
				alert('Error al Cargar el Archivo');
				button.text('Subir Archivo Zip');
				this.enable();	
			}else{
				$("#archivos").val(response);
				alert('Archivo Cargado Correctamente');
				button.text('Archivo Zip Subido');
				this.enable();	
			}
		}
	});
	var button2 = $('#upload_estructura'), interval;
	new AjaxUpload('#upload_estructura', {
        action: '/control_versiones/importar/',
		onSubmit : function(file , ext){
			if (! (ext && /^(txt)$/.test(ext))){
				// extensiones permitidas
				alert('Error: Solo se permiten archivos txt');
				// cancela upload
				return false;
			} else {
				this.disable();
			}
		},
		onComplete: function(file, response){
			if(response=='error'){
				alert('Error al Cargar el Archivo');
				button.text('Subir Extructura DB');
				this.enable();
			}else{
				$("#estructura_db").val(response);
				alert('Archivo Cargado Correctamente');
				button.text('Extructura DB Subida');
				this.enable();
			}
		}
	});
	var button3 = $('#upload_datos'), interval;
	new AjaxUpload('#upload_datos', {
        action: '/control_versiones/importar/',
		onSubmit : function(file , ext){
			if (! (ext && /^(txt)$/.test(ext))){
				// extensiones permitidas
				alert('Error: Solo se permiten archivos txt');
				// cancela upload
				return false;
			} else {
				this.disable();
			}
		},
		onComplete: function(file, response){
			if(response=='error'){
				alert('Error al Cargar el Archivo');
				button.text('Subir Datos DB');
				this.enable();
			}else{
				$("#datos_db").val(response);
				alert('Archivo Cargado Correctamente');
				button.text('Datos DB Subidos');
				this.enable();
			}
		}
	});
});
</script>