
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatealertas_usuarios' action='<?= HOMEDIR.'alertas_usuarios'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar alertas_usuarios</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Dias:</strong></td>
				<td><input type='text' name='dias' id='dias' maxlength='' value='<? echo $object -> Getdias(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Titulo:</strong></td>
				<td><input type='text' name='titulo' id='titulo' maxlength='' value='<? echo $object -> Gettitulo(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Type:</strong></td>
				<td><input type='text' name='type' id='type' maxlength='' value='<? echo $object -> Gettype(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
