<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'usuarios_funcionalidades'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formusuarios_funcionalidades' action='/usuarios_funcionalidades/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='usuarios_funcionalidades' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariousuarios_funcionalidades}</td>
			</tr>-->
		<div class='title right'>Formulario de usuarios_funcionalidades </div>
		<input type='text' class='form-control' placeholder='User_id' name='user_id' id='user_id' maxlength='11' />
		<input type='text' class='form-control' placeholder='Id_funcionalidad' name='id_funcionalidad' id='id_funcionalidad' maxlength='11' />
		<input type='text' class='form-control' placeholder='Valor' name='valor' id='valor' maxlength='11' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>