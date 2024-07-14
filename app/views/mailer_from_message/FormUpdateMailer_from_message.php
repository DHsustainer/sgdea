
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatemailer_from_message' action='<?= HOMEDIR.'mailer_from_message'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar mailer_from_message</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>Message_id:</strong></td>
				<td><input type='text' name='message_id' id='message_id' maxlength='' value='<? echo $object -> Getmessage_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Message_code:</strong></td>
				<td><input type='text' name='message_code' id='message_code' maxlength='' value='<? echo $object -> Getmessage_code(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>SID:</strong></td>
				<td><input type='text' name='sID' id='sID' maxlength='' value='<? echo $object -> GetsID(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Token_ID:</strong></td>
				<td><input type='text' name='token_ID' id='token_ID' maxlength='' value='<? echo $object -> Gettoken_ID(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>User_ID:</strong></td>
				<td><input type='text' name='user_ID' id='user_ID' maxlength='' value='<? echo $object -> Getuser_ID(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Email:</strong></td>
				<td><input type='text' name='email' id='email' maxlength='' value='<? echo $object -> Getemail(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Size:</strong></td>
				<td><input type='text' name='size' id='size' maxlength='' value='<? echo $object -> Getsize(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Message:</strong></td>
				<td><input type='text' name='message' id='message' maxlength='' value='<? echo $object -> Getmessage(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Clean_message:</strong></td>
				<td><input type='text' name='clean_message' id='clean_message' maxlength='' value='<? echo $object -> Getclean_message(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Type_message:</strong></td>
				<td><input type='text' name='type_message' id='type_message' maxlength='' value='<? echo $object -> Gettype_message(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Name:</strong></td>
				<td><input type='text' name='name' id='name' maxlength='' value='<? echo $object -> Getname(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Dns:</strong></td>
				<td><input type='text' name='dns' id='dns' maxlength='' value='<? echo $object -> Getdns(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
