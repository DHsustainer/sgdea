
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatesuscriptores_modulos_funciones' action='/suscriptores_modulos_funciones/actualizar/' method='POST'> 
		<div class='title'>Editar suscriptores_modulos_funciones</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar suscriptores_modulos_funciones</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='user_id' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_suscriptores_modulos' name='id_suscriptores_modulos' id='id_suscriptores_modulos' maxlength='' value='<? echo $object -> Getid_suscriptores_modulos(); ?>' />
			
			<input type='text' class='form-control' placeholder='valor' name='valor' id='valor' maxlength='' value='<? echo $object -> Getvalor(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
