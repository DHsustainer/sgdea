<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'usuarios_paquetes'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formusuarios_paquetes' action='/usuarios_paquetes/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='usuarios_paquetes' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariousuarios_paquetes}</td>
			</tr>-->
		<div class='title right'>Formulario de usuarios_paquetes </div>
		<input type='text' class='title_act' placeholder='Nombre' name='nombre' id='nombre' maxlength='200' />
		<input type='text' class='title_act' placeholder='Valor' name='valor' id='valor' maxlength='7' />
		<input type='text' class='title_act' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='text' class='title_act' placeholder='Usuario' name='usuario' id='usuario' maxlength='200' />
		<input type='text' class='title_act' placeholder='Tipo' name='tipo' id='tipo' maxlength='1' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>