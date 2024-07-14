
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatesuscriptores_control_versiones' action='/suscriptores_control_versiones/actualizar/' method='POST'> 
		<div class='title'>Editar suscriptores_control_versiones</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar suscriptores_control_versiones</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_version' name='id_version' id='id_version' maxlength='' value='<? echo $object -> Getid_version(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_suscriptor' name='id_suscriptor' id='id_suscriptor' maxlength='' value='<? echo $object -> Getid_suscriptor(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='form-control' placeholder='activo' name='activo' id='activo' maxlength='' value='<? echo $object -> Getactivo(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
