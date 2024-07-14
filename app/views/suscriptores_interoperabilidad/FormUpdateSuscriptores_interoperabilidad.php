
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatesuscriptores_interoperabilidad' action='/suscriptores_interoperabilidad/actualizar/' method='POST'> 
		<div class='title'>Editar suscriptores_interoperabilidad</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar suscriptores_interoperabilidad</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='suscriptor_origen' name='suscriptor_origen' id='suscriptor_origen' maxlength='' value='<? echo $object -> Getsuscriptor_origen(); ?>' />
			
			<input type='text' class='form-control' placeholder='suscriptor_destino' name='suscriptor_destino' id='suscriptor_destino' maxlength='' value='<? echo $object -> Getsuscriptor_destino(); ?>' />
			
			<input type='text' class='form-control' placeholder='key_set' name='key_set' id='key_set' maxlength='' value='<? echo $object -> Getkey_set(); ?>' />
			
			<input type='text' class='form-control' placeholder='key_get' name='key_get' id='key_get' maxlength='' value='<? echo $object -> Getkey_get(); ?>' />
			
			<input type='text' class='form-control' placeholder='key_add' name='key_add' id='key_add' maxlength='' value='<? echo $object -> Getkey_add(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='form-control' placeholder='FechaActualizacion' name='FechaActualizacion' id='FechaActualizacion' maxlength='' value='<? echo $object -> GetFechaActualizacion(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
