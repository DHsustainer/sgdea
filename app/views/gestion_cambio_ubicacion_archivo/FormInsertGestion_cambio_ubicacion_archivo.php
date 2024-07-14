<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'gestion_cambio_ubicacion_archivo'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formgestion_cambio_ubicacion_archivo' action='/gestion_cambio_ubicacion_archivo/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='gestion_cambio_ubicacion_archivo' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariogestion_cambio_ubicacion_archivo}</td>
			</tr>-->
		<div class='title right'>Formulario de gestion_cambio_ubicacion_archivo </div>
		<input type='text' class='form-control' placeholder='Id_gestion' name='id_gestion' id='id_gestion' maxlength='11' />
		<input type='text' class='form-control' placeholder='Nombre_destino' name='nombre_destino' id='nombre_destino' maxlength='50' />
		<input type='text' class='form-control' placeholder='Estado_archivo_origen' name='estado_archivo_origen' id='estado_archivo_origen' maxlength='11' />
		<input type='text' class='form-control' placeholder='Estado_archivo_destino' name='estado_archivo_destino' id='estado_archivo_destino' maxlength='11' />
		<input type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='11' />
		<input type='text' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>