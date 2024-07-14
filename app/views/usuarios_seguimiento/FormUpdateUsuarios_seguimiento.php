
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateusuarios_seguimiento' action='/usuarios_seguimiento/actualizar/' method='POST'> 
		<div class='title'>Editar usuarios_seguimiento</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar usuarios_seguimiento</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='title_act' placeholder='usuario_seguimiento' name='usuario_seguimiento' id='usuario_seguimiento' maxlength='' value='<? echo $object -> Getusuario_seguimiento(); ?>' />
			
			<input type='text' class='title_act' placeholder='username' name='username' id='username' maxlength='' value='<? echo $object -> Getusername(); ?>' />
			
			<input type='text' class='title_act' placeholder='observacion' name='observacion' id='observacion' maxlength='' value='<? echo $object -> Getobservacion(); ?>' />
			
			<input type='text' class='title_act' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='title_act' placeholder='tipo_seguimiento' name='tipo_seguimiento' id='tipo_seguimiento' maxlength='' value='<? echo $object -> Gettipo_seguimiento(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
