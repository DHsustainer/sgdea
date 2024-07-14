
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatecontactos_emails' action='<?= HOMEDIR.'contactos_emails'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar contactos_emails</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>Contacto_id:</strong></td>
				<td><input type='text' name='contacto_id' id='contacto_id' maxlength='' value='<? echo $object -> Getcontacto_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Email:</strong></td>
				<td><input type='text' name='email' id='email' maxlength='' value='<? echo $object -> Getemail(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
