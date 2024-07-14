
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdategestion_anexos' action='<?= HOMEDIR.'gestion_anexos'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar gestion_anexos</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>Gestion_id:</strong></td>
				<td><input type='text' name='gestion_id' id='gestion_id' maxlength='' value='<? echo $object -> Getgestion_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nombre:</strong></td>
				<td><input type='text' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Url:</strong></td>
				<td><input type='text' name='url' id='url' maxlength='' value='<? echo $object -> Geturl(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Fecha:</strong></td>
				<td><input type='text' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Hora:</strong></td>
				<td><input type='text' name='hora' id='hora' maxlength='' value='<? echo $object -> Gethora(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Ip:</strong></td>
				<td><input type='text' name='ip' id='ip' maxlength='' value='<? echo $object -> Getip(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Timest:</strong></td>
				<td><input type='text' name='timest' id='timest' maxlength='' value='<? echo $object -> Gettimest(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Estado:</strong></td>
				<td><input type='text' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' /></td>
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
