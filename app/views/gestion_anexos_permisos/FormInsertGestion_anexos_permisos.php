<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'gestion_anexos_permisos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formgestion_anexos_permisos' action='/gestion_anexos_permisos/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='gestion_anexos_permisos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariogestion_anexos_permisos}</td>
			</tr>-->
		<div class='title right'>Formulario de gestion_anexos_permisos </div>
		<input type='text' class='form-control' placeholder='Id_documento' name='id_documento' id='id_documento' maxlength='10' />
		<input type='text' class='form-control' placeholder='Usuario_permiso' name='usuario_permiso' id='usuario_permiso' maxlength='50' />
		<input type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='10' />
		<input type='text' class='form-control' placeholder='Fecha_solicitud' name='fecha_solicitud' id='fecha_solicitud' maxlength='' />
		<input type='text' class='form-control' placeholder='Fecha_actualizacion' name='fecha_actualizacion' id='fecha_actualizacion' maxlength='' />
		<input type='text' class='form-control' placeholder='Observacion' name='observacion' id='observacion' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>