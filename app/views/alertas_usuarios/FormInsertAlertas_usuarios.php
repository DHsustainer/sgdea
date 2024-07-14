<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'alertas_usuarios'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formalertas_usuarios' action='<?= HOMEDIR.DS.'alertas_usuarios'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='alertas_usuarios' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioalertas_usuarios}</td>
			</tr>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Dias:</strong></td>
				<td><input type='text' name='dias' id='dias' maxlength='3' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Titulo:</strong></td>
				<td><input type='text' name='titulo' id='titulo' maxlength='300' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Type:</strong></td>
				<td><input type='text' name='type' id='type' maxlength='1' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>