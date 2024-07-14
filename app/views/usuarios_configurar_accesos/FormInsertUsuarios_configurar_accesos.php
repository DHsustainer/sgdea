<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'usuarios_configurar_accesos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formusuarios_configurar_accesos' action='/usuarios_configurar_accesos/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='usuarios_configurar_accesos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariousuarios_configurar_accesos}</td>
			</tr>-->
		<div class='title right'>Formulario de usuarios_configurar_accesos </div>
		<input type='text' class='form-control' placeholder='User_id' name='user_id' id='user_id' maxlength='255' />
		<input type='text' class='form-control' placeholder='Tabla' name='tabla' id='tabla' maxlength='255' />
		<input type='text' class='form-control' placeholder='Id_tabla' name='id_tabla' id='id_tabla' maxlength='255' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>