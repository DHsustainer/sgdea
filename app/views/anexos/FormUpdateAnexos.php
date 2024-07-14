
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateanexos' action='<?= HOMEDIR.'anexos'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar anexos</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>Proceso_id:</strong></td>
				<td><input type='text' name='proceso_id' id='proceso_id' maxlength='' value='<? echo $object -> Getproceso_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nom_palabra:</strong></td>
				<td><input type='text' name='nom_palabra' id='nom_palabra' maxlength='' value='<? echo $object -> Getnom_palabra(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nom_img:</strong></td>
				<td><input type='text' name='nom_img' id='nom_img' maxlength='' value='<? echo $object -> Getnom_img(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
