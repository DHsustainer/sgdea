
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateusuarios_configurar_accesos' action='/usuarios_configurar_accesos/actualizar/' method='POST'> 
		<div class='title'>Editar usuarios_configurar_accesos</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar usuarios_configurar_accesos</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='user_id' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='tabla' name='tabla' id='tabla' maxlength='' value='<? echo $object -> Gettabla(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_tabla' name='id_tabla' id='id_tabla' maxlength='' value='<? echo $object -> Getid_tabla(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
