<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'mailer_replys'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formmailer_replys' action='<?= HOMEDIR.DS.'mailer_replys'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='mailer_replys' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariomailer_replys}</td>
			</tr>
			<tr>
				<td width='30%'><strong>Receiver_id:</strong></td>
				<td><input type='text' name='receiver_id' id='receiver_id' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Message_id:</strong></td>
				<td><input type='text' name='message_id' id='message_id' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Receiver_token:</strong></td>
				<td><input type='text' name='receiver_token' id='receiver_token' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Message_status:</strong></td>
				<td><input type='text' name='message_status' id='message_status' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Reply_datetime:</strong></td>
				<td><input type='text' name='reply_datetime' id='reply_datetime' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Reply_ip:</strong></td>
				<td><input type='text' name='reply_ip' id='reply_ip' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>SesionID:</strong></td>
				<td><input type='text' name='sesionID' id='sesionID' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Details:</strong></td>
				<td><input type='text' name='details' id='details' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Subject:</strong></td>
				<td><input type='text' name='subject' id='subject' maxlength='200' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Readed:</strong></td>
				<td><input type='text' name='readed' id='readed' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Dns:</strong></td>
				<td><input type='text' name='dns' id='dns' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Hostname:</strong></td>
				<td><input type='text' name='hostname' id='hostname' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Isp:</strong></td>
				<td><input type='text' name='isp' id='isp' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Organization:</strong></td>
				<td><input type='text' name='organization' id='organization' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Country:</strong></td>
				<td><input type='text' name='country' id='country' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>State:</strong></td>
				<td><input type='text' name='state' id='state' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>City:</strong></td>
				<td><input type='text' name='city' id='city' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Latitude:</strong></td>
				<td><input type='text' name='latitude' id='latitude' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Longitude:</strong></td>
				<td><input type='text' name='longitude' id='longitude' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Lt:</strong></td>
				<td><input type='text' name='lt' id='lt' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Lg:</strong></td>
				<td><input type='text' name='lg' id='lg' maxlength='50' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>