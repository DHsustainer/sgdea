<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'gestion_favoritos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formgestion_favoritos' action='/gestion_favoritos/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='gestion_favoritos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariogestion_favoritos}</td>
			</tr>-->
		<div class='title right'>Formulario de gestion_favoritos </div>
		<input type='text' class='title_act' placeholder='User_id' name='user_id' id='user_id' maxlength='200' />
		<input type='text' class='title_act' placeholder='Gestion_id' name='gestion_id' id='gestion_id' maxlength='100' />
		<input type='text' class='title_act' placeholder='Tipo_user' name='tipo_user' id='tipo_user' maxlength='1' />
		<input type='text' class='title_act' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>