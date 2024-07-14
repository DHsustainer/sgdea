
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatemailer_replys' action='<?= HOMEDIR.'mailer_replys'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar mailer_replys</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>Receiver_id:</strong></td>
				<td><input type='text' name='receiver_id' id='receiver_id' maxlength='' value='<? echo $object -> Getreceiver_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Message_id:</strong></td>
				<td><input type='text' name='message_id' id='message_id' maxlength='' value='<? echo $object -> Getmessage_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Receiver_token:</strong></td>
				<td><input type='text' name='receiver_token' id='receiver_token' maxlength='' value='<? echo $object -> Getreceiver_token(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Message_status:</strong></td>
				<td><input type='text' name='message_status' id='message_status' maxlength='' value='<? echo $object -> Getmessage_status(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Reply_datetime:</strong></td>
				<td><input type='text' name='reply_datetime' id='reply_datetime' maxlength='' value='<? echo $object -> Getreply_datetime(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Reply_ip:</strong></td>
				<td><input type='text' name='reply_ip' id='reply_ip' maxlength='' value='<? echo $object -> Getreply_ip(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>SesionID:</strong></td>
				<td><input type='text' name='sesionID' id='sesionID' maxlength='' value='<? echo $object -> GetsesionID(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Details:</strong></td>
				<td><input type='text' name='details' id='details' maxlength='' value='<? echo $object -> Getdetails(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Subject:</strong></td>
				<td><input type='text' name='subject' id='subject' maxlength='' value='<? echo $object -> Getsubject(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Readed:</strong></td>
				<td><input type='text' name='readed' id='readed' maxlength='' value='<? echo $object -> Getreaded(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Dns:</strong></td>
				<td><input type='text' name='dns' id='dns' maxlength='' value='<? echo $object -> Getdns(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Hostname:</strong></td>
				<td><input type='text' name='hostname' id='hostname' maxlength='' value='<? echo $object -> Gethostname(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Isp:</strong></td>
				<td><input type='text' name='isp' id='isp' maxlength='' value='<? echo $object -> Getisp(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Organization:</strong></td>
				<td><input type='text' name='organization' id='organization' maxlength='' value='<? echo $object -> Getorganization(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Country:</strong></td>
				<td><input type='text' name='country' id='country' maxlength='' value='<? echo $object -> Getcountry(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>State:</strong></td>
				<td><input type='text' name='state' id='state' maxlength='' value='<? echo $object -> Getstate(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>City:</strong></td>
				<td><input type='text' name='city' id='city' maxlength='' value='<? echo $object -> Getcity(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Latitude:</strong></td>
				<td><input type='text' name='latitude' id='latitude' maxlength='' value='<? echo $object -> Getlatitude(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Longitude:</strong></td>
				<td><input type='text' name='longitude' id='longitude' maxlength='' value='<? echo $object -> Getlongitude(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Lt:</strong></td>
				<td><input type='text' name='lt' id='lt' maxlength='' value='<? echo $object -> Getlt(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Lg:</strong></td>
				<td><input type='text' name='lg' id='lg' maxlength='' value='<? echo $object -> Getlg(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
