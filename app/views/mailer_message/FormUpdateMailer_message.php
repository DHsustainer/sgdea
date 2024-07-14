
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatemailer_message' action='<?= HOMEDIR.'mailer_message'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar mailer_message</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>Message_id:</strong></td>
				<td><input type='text' name='message_id' id='message_id' maxlength='' value='<? echo $object -> Getmessage_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>SID:</strong></td>
				<td><input type='text' name='sID' id='sID' maxlength='' value='<? echo $object -> GetsID(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>User_ID:</strong></td>
				<td><input type='text' name='user_ID' id='user_ID' maxlength='' value='<? echo $object -> Getuser_ID(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Ip:</strong></td>
				<td><input type='text' name='ip' id='ip' maxlength='' value='<? echo $object -> Getip(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Date:</strong></td>
				<td><input type='text' name='date' id='date' maxlength='' value='<? echo $object -> Getdate(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Size:</strong></td>
				<td><input type='text' name='size' id='size' maxlength='' value='<? echo $object -> Getsize(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>From_nom:</strong></td>
				<td><input type='text' name='from_nom' id='from_nom' maxlength='' value='<? echo $object -> Getfrom_nom(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Subject:</strong></td>
				<td><input type='text' name='subject' id='subject' maxlength='' value='<? echo $object -> Getsubject(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Message:</strong></td>
				<td><input type='text' name='message' id='message' maxlength='' value='<? echo $object -> Getmessage(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Exp_day:</strong></td>
				<td><input type='text' name='exp_day' id='exp_day' maxlength='' value='<? echo $object -> Getexp_day(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>P_id:</strong></td>
				<td><input type='text' name='p_id' id='p_id' maxlength='' value='<? echo $object -> Getp_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Name:</strong></td>
				<td><input type='text' name='name' id='name' maxlength='' value='<? echo $object -> Getname(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
