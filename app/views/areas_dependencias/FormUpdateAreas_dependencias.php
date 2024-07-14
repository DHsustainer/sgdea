
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateareas_dependencias' action='<?= HOMEDIR.'areas_dependencias'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar areas_dependencias</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>Id_area:</strong></td>
				<td><input type='text' name='id_area' id='id_area' maxlength='' value='<? echo $object -> Getid_area(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Id_dependencia:</strong></td>
				<td><input type='text' name='id_dependencia' id='id_dependencia' maxlength='' value='<? echo $object -> Getid_dependencia(); ?>' /></td>
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
				<td width='30%'><strong>Id_dependencia_raiz:</strong></td>
				<td><input type='text' name='id_dependencia_raiz' id='id_dependencia_raiz' maxlength='' value='<? echo $object -> Getid_dependencia_raiz(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
