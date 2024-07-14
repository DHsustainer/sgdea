
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatecontrol_versiones' action='/control_versiones/actualizar/' method='POST'> 
		<div class='title'>Editar control_versiones</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar control_versiones</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='tipo' name='tipo' id='tipo' maxlength='' value='<? echo $object -> Gettipo(); ?>' />
			
			<input type='text' class='form-control' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
			
			<input type='text' class='form-control' placeholder='archivos' name='archivos' id='archivos' maxlength='' value='<? echo $object -> Getarchivos(); ?>' />
			
			<input type='text' class='form-control' placeholder='estructura_db' name='estructura_db' id='estructura_db' maxlength='' value='<? echo $object -> Getestructura_db(); ?>' />
			
			<input type='text' class='form-control' placeholder='datos_db' name='datos_db' id='datos_db' maxlength='' value='<? echo $object -> Getdatos_db(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
