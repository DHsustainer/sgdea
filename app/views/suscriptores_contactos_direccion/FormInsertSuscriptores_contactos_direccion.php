<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'suscriptores_contactos_direccion'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formsuscriptores_contactos_direccion' action='<?= HOMEDIR.DS.'suscriptores_contactos_direccion'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='suscriptores_contactos_direccion' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariosuscriptores_contactos_direccion}</td>
			</tr>
			<tr>
				<td width='30%'><strong>Id_contacto:</strong></td>
				<td><input type='text' name='id_contacto' id='id_contacto' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Direccion:</strong></td>
				<td><input type='text' name='direccion' id='direccion' maxlength='200' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Ciudad:</strong></td>
				<td><input type='text' name='ciudad' id='ciudad' maxlength='200' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Telefonos:</strong></td>
				<td><input type='text' name='telefonos' id='telefonos' maxlength='100' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Email:</strong></td>
				<td><input type='text' name='email' id='email' maxlength='400' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Subnombre:</strong></td>
				<td><input type='text' name='subnombre' id='subnombre' maxlength='400' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>