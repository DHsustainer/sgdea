<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'mailer_attachments'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formmailer_attachments' action='<?= HOMEDIR.DS.'mailer_attachments'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='mailer_attachments' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariomailer_attachments}</td>
			</tr>
			<tr>
				<td width='30%'><strong>Message_id:</strong></td>
				<td><input type='text' name='message_id' id='message_id' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Filename:</strong></td>
				<td><input type='text' name='filename' id='filename' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Size:</strong></td>
				<td><input type='text' name='size' id='size' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Alt:</strong></td>
				<td><input type='text' name='alt' id='alt' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Type:</strong></td>
				<td><input type='text' name='type' id='type' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Title:</strong></td>
				<td><input type='text' name='title' id='title' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>At_id:</strong></td>
				<td><input type='text' name='at_id' id='at_id' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Folio:</strong></td>
				<td><input type='text' name='folio' id='folio' maxlength='10' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>