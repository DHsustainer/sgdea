<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'gestion_movimiento'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formgestion_movimiento' action='<?= HOMEDIR.DS.'gestion_movimiento'.DS.'nuevo'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion_movimiento' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
		<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariogestion_movimiento}</td>
			</tr>
			<tr>
				<td width='30%'><strong>Id_seguimiento:</strong></td>
				<td><input type='text' name='id_seguimiento' id='id_seguimiento' maxlength='10' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Usuario:</strong></td>
				<td><input type='text' name='usuario' id='usuario' maxlength='50' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Fecha:</strong></td>
				<td><input type='text' name='fecha' id='fecha' maxlength='' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Movimiento:</strong></td>
				<td><input type='text' name='movimiento' id='movimiento' maxlength='' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Insertar'/></td>
			</tr>
		</table>
	</form>