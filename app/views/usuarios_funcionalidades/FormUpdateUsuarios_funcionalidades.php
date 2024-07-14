
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateusuarios_funcionalidades' action='/usuarios_funcionalidades/actualizar/' method='POST'> 
		<div class='title'>Editar usuarios_funcionalidades</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar usuarios_funcionalidades</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='user_id' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_funcionalidad' name='id_funcionalidad' id='id_funcionalidad' maxlength='' value='<? echo $object -> Getid_funcionalidad(); ?>' />
			
			<input type='text' class='form-control' placeholder='valor' name='valor' id='valor' maxlength='' value='<? echo $object -> Getvalor(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
