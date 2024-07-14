<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'suscriptores_control_versiones'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formsuscriptores_control_versiones' action='/suscriptores_control_versiones/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='suscriptores_control_versiones' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariosuscriptores_control_versiones}</td>
			</tr>-->
		<div class='title right'>Formulario de suscriptores_control_versiones </div>
		<input type='text' class='form-control' placeholder='Id_version' name='id_version' id='id_version' maxlength='11' />
		<input type='text' class='form-control' placeholder='Id_suscriptor' name='id_suscriptor' id='id_suscriptor' maxlength='11' />
		<input type='text' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='255' />
		<input type='text' class='form-control' placeholder='Activo' name='activo' id='activo' maxlength='11' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>