<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'plantillas_email'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formplantillas_email' action='/plantillas_email/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='plantillas_email' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioplantillas_email}</td>
			</tr>-->
		<div class='title right'>Formulario de plantillas_email </div>
		<input type='text' class='form-control' placeholder='Tipo' name='tipo' id='tipo' maxlength='255' />
		<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='255' />
		<input type='text' class='form-control' placeholder='Contenido' name='contenido' id='contenido' maxlength='' />
		<input type='text' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>