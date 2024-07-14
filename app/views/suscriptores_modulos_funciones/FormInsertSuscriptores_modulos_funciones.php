<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'suscriptores_modulos_funciones'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formsuscriptores_modulos_funciones' action='/suscriptores_modulos_funciones/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='suscriptores_modulos_funciones' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariosuscriptores_modulos_funciones}</td>
			</tr>-->
		<div class='title right'>Formulario de suscriptores_modulos_funciones </div>
		<input type='text' class='form-control' placeholder='User_id' name='user_id' id='user_id' maxlength='255' />
		<input type='text' class='form-control' placeholder='Id_suscriptores_modulos' name='id_suscriptores_modulos' id='id_suscriptores_modulos' maxlength='11' />
		<input type='text' class='form-control' placeholder='Valor' name='valor' id='valor' maxlength='11' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>