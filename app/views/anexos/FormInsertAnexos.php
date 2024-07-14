<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'anexos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formanexos' action='<?= HOMEDIR.DS.'anexos'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='anexos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioanexos}</td>
			</tr>
			<tr>
				<td width='30%'><strong>Proceso_id:</strong></td>
				<td><input type='text' name='proceso_id' id='proceso_id' maxlength='9' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nom_palabra:</strong></td>
				<td><input type='text' name='nom_palabra' id='nom_palabra' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nom_img:</strong></td>
				<td><input type='text' name='nom_img' id='nom_img' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='100' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>