
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdategestion_compartir' action='/gestion_compartir/actualizar/' method='POST'> 
		<div class='title'>Editar gestion_compartir</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar gestion_compartir</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='usuario_comparte' name='usuario_comparte' id='usuario_comparte' maxlength='' value='<? echo $object -> Getusuario_comparte(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario_nuevo' name='usuario_nuevo' id='usuario_nuevo' maxlength='' value='<? echo $object -> Getusuario_nuevo(); ?>' />
			
			<input type='text' class='form-control' placeholder='gestion_id' name='gestion_id' id='gestion_id' maxlength='' value='<? echo $object -> Getgestion_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='form-control' placeholder='observacion' name='observacion' id='observacion' maxlength='' value='<? echo $object -> Getobservacion(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
