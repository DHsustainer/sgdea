<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'usuarios_configurar_firma_digital'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formusuarios_configurar_firma_digital' action='/usuarios_configurar_firma_digital/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='usuarios_configurar_firma_digital' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariousuarios_configurar_firma_digital}</td>
			</tr>-->
		<div class='title right'>Formulario de usuarios_configurar_firma_digital </div>
		<input type='text' class='form-control' placeholder='User_id' name='user_id' id='user_id' maxlength='11' />
		<input type='text' class='form-control' placeholder='Campo1' name='campo1' id='campo1' maxlength='255' />
		<input type='text' class='form-control' placeholder='Campo2' name='campo2' id='campo2' maxlength='255' />
		<input type='text' class='form-control' placeholder='Campo3' name='campo3' id='campo3' maxlength='255' />
		<input type='text' class='form-control' placeholder='Campo4' name='campo4' id='campo4' maxlength='255' />
		<input type='text' class='form-control' placeholder='Campo5' name='campo5' id='campo5' maxlength='255' />
		<input type='text' class='form-control' placeholder='Campo6' name='campo6' id='campo6' maxlength='255' />
		<input type='text' class='form-control' placeholder='Campo7' name='campo7' id='campo7' maxlength='255' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>