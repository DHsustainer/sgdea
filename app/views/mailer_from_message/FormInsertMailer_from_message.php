<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'mailer_from_message'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formmailer_from_message' action='<?= HOMEDIR.DS.'mailer_from_message'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='mailer_from_message' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariomailer_from_message}</td>
			</tr>
			<tr>
				<td width='30%'><strong>Message_id:</strong></td>
				<td><input type='text' name='message_id' id='message_id' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Message_code:</strong></td>
				<td><input type='text' name='message_code' id='message_code' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>SID:</strong></td>
				<td><input type='text' name='sID' id='sID' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Token_ID:</strong></td>
				<td><input type='text' name='token_ID' id='token_ID' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>User_ID:</strong></td>
				<td><input type='text' name='user_ID' id='user_ID' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Email:</strong></td>
				<td><input type='text' name='email' id='email' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Size:</strong></td>
				<td><input type='text' name='size' id='size' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Message:</strong></td>
				<td><input type='text' name='message' id='message' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Clean_message:</strong></td>
				<td><input type='text' name='clean_message' id='clean_message' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Type_message:</strong></td>
				<td><input type='text' name='type_message' id='type_message' maxlength='1' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Name:</strong></td>
				<td><input type='text' name='name' id='name' maxlength='200' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Dns:</strong></td>
				<td><input type='text' name='dns' id='dns' maxlength='50' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>