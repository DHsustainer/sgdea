
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdategestion_movimiento' action='<?= HOMEDIR.'gestion_movimiento'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar gestion_movimiento</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>Id_seguimiento:</strong></td>
				<td><input type='text' name='id_seguimiento' id='id_seguimiento' maxlength='' value='<? echo $object -> Getid_seguimiento(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Usuario:</strong></td>
				<td><input type='text' name='usuario' id='usuario' maxlength='' value='<? echo $object -> Getusuario(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Fecha:</strong></td>
				<td><input type='text' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Movimiento:</strong></td>
				<td><input type='text' name='movimiento' id='movimiento' maxlength='' value='<? echo $object -> Getmovimiento(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
