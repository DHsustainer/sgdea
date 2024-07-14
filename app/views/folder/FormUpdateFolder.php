
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatefolder' action='<?= HOMEDIR.'folder'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar folder</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nombre:</strong></td>
				<td><input type='text' name='nom' id='nom' maxlength='' value='<? echo $object -> Getnom(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Fecha:</strong></td>
				<td><input type='text' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Codigo De Ingreso:</strong></td>
				<td><input type='text' name='cod_ingreso' id='cod_ingreso' maxlength='' value='<? echo $object -> Getcod_ingreso(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Contraseña:</strong></td>
				<td><input type='password' name='password' id='password' maxlength='' value='<? echo $object -> Getpassword(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Estado:</strong></td>
				<td><input type='text' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
