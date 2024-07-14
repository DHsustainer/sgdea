<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'contactos_direccion'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formcontactos_direccion' action='<?= HOMEDIR.DS.'contactos_direccion'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='contactos_direccion' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariocontactos_direccion}</td>
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
				<td width='30%'><strong>Telefono:</strong></td>
				<td><input type='text' name='telefono' id='telefono' maxlength='200' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>