
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdategestion_seguimiento' action='/gestion_seguimiento/actualizar/' method='POST'> 
		<div class='title'>Editar gestion_seguimiento</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar gestion_seguimiento</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='title_act' placeholder='id_gestion' name='id_gestion' id='id_gestion' maxlength='' value='<? echo $object -> Getid_gestion(); ?>' />
			
			<input type='text' class='title_act' placeholder='user_id' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' />
			
			<input type='text' class='title_act' placeholder='fecha_solicitud' name='fecha_solicitud' id='fecha_solicitud' maxlength='' value='<? echo $object -> Getfecha_solicitud(); ?>' />
			
			<input type='text' class='title_act' placeholder='estado_solicitud' name='estado_solicitud' id='estado_solicitud' maxlength='' value='<? echo $object -> Getestado_solicitud(); ?>' />
			
			<input type='text' class='title_act' placeholder='id_seguimiento' name='id_seguimiento' id='id_seguimiento' maxlength='' value='<? echo $object -> Getid_seguimiento(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
