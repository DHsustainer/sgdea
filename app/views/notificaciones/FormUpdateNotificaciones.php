
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatenotificaciones' action='<?= HOMEDIR.'notificaciones'.DS.'actualizar'.DS ?>' method='POST' method='POST'> 
    	<input type='hidden' id='action' name='action' value='actualizar' />    
		
		
		<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar notificaciones</td>
			</tr>
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
			<tr>
				<td width='30%'><strong>User_id:</strong></td>
				<td><input type='text' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Proceso_id:</strong></td>
				<td><input type='text' name='proceso_id' id='proceso_id' maxlength='' value='<? echo $object -> Getproceso_id(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Id_demandado:</strong></td>
				<td><input type='text' name='id_demandado' id='id_demandado' maxlength='' value='<? echo $object -> Getid_demandado(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Tipo_notificacion:</strong></td>
				<td><input type='text' name='tipo_notificacion' id='tipo_notificacion' maxlength='' value='<? echo $object -> Gettipo_notificacion(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Id_postal:</strong></td>
				<td><input type='text' name='id_postal' id='id_postal' maxlength='' value='<? echo $object -> Getid_postal(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>F_citacion:</strong></td>
				<td><input type='text' name='f_citacion' id='f_citacion' maxlength='' value='<? echo $object -> Getf_citacion(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Todos:</strong></td>
				<td><input type='text' name='todos' id='todos' maxlength='' value='<? echo $object -> Gettodos(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Nom_archivo:</strong></td>
				<td><input type='text' name='nom_archivo' id='nom_archivo' maxlength='' value='<? echo $object -> Getnom_archivo(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Direccion:</strong></td>
				<td><input type='text' name='direccion' id='direccion' maxlength='' value='<? echo $object -> Getdireccion(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Num_dias:</strong></td>
				<td><input type='text' name='num_dias' id='num_dias' maxlength='' value='<? echo $object -> Getnum_dias(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Is_certificada:</strong></td>
				<td><input type='text' name='is_certificada' id='is_certificada' maxlength='' value='<? echo $object -> Getis_certificada(); ?>' /></td>
			</tr>
			<tr>
				<td width='30%'><strong>Guia_id:</strong></td>
				<td><input type='text' name='guia_id' id='guia_id' maxlength='' value='<? echo $object -> Getguia_id(); ?>' /></td>
			</tr>
	<tr>
				<td colspan='2' align='center'><input type='submit' value='Actualizar'/></td>
			</tr>
		</table>
	</form>
