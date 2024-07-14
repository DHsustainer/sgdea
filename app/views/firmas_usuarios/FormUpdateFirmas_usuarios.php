
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatefirmas_usuarios' action='/firmas_usuarios/actualizar/' method='POST'> 
		<div class='title'>Editar firmas_usuarios</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar firmas_usuarios</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='username' name='username' id='username' maxlength='' value='<? echo $object -> Getusername(); ?>' />
			
			<input type='text' class='form-control' placeholder='SID' name='SID' id='SID' maxlength='' value='<? echo $object -> GetSID(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_firma' name='fecha_firma' id='fecha_firma' maxlength='' value='<? echo $object -> Getfecha_firma(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_expiracion' name='fecha_expiracion' id='fecha_expiracion' maxlength='' value='<? echo $object -> Getfecha_expiracion(); ?>' />
			
			<input type='text' class='form-control' placeholder='firma' name='firma' id='firma' maxlength='' value='<? echo $object -> Getfirma(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado_firma' name='estado_firma' id='estado_firma' maxlength='' value='<? echo $object -> Getestado_firma(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
