
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatemailer_attachments' action='<?= HOMEDIR.'mailer_attachments'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar mailer_attachments</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>Message_id:</strong></td>
				<td><input type='text' name='message_id' id='message_id' maxlength='' value='<? echo $object -> Getmessage_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Filename:</strong></td>
				<td><input type='text' name='filename' id='filename' maxlength='' value='<? echo $object -> Getfilename(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Size:</strong></td>
				<td><input type='text' name='size' id='size' maxlength='' value='<? echo $object -> Getsize(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Alt:</strong></td>
				<td><input type='text' name='alt' id='alt' maxlength='' value='<? echo $object -> Getalt(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Type:</strong></td>
				<td><input type='text' name='type' id='type' maxlength='' value='<? echo $object -> Gettype(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Title:</strong></td>
				<td><input type='text' name='title' id='title' maxlength='' value='<? echo $object -> Gettitle(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>At_id:</strong></td>
				<td><input type='text' name='at_id' id='at_id' maxlength='' value='<? echo $object -> Getat_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Folio:</strong></td>
				<td><input type='text' name='folio' id='folio' maxlength='' value='<? echo $object -> Getfolio(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
