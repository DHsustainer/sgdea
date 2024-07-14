
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdategestion_transferencias' action='/gestion_transferencias/actualizar/' method='POST'> 
		<div class='title'>Editar gestion_transferencias</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar gestion_transferencias</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='gestion_id' name='gestion_id' id='gestion_id' maxlength='' value='<? echo $object -> Getgestion_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='user_transfiere' name='user_transfiere' id='user_transfiere' maxlength='' value='<? echo $object -> Getuser_transfiere(); ?>' />
			
			<input type='text' class='form-control' placeholder='user_recibe' name='user_recibe' id='user_recibe' maxlength='' value='<? echo $object -> Getuser_recibe(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_transferencia' name='fecha_transferencia' id='fecha_transferencia' maxlength='' value='<? echo $object -> Getfecha_transferencia(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_aceptacion' name='fecha_aceptacion' id='fecha_aceptacion' maxlength='' value='<? echo $object -> Getfecha_aceptacion(); ?>' />
			
			<input type='text' class='form-control' placeholder='observaciona' name='observaciona' id='observaciona' maxlength='' value='<? echo $object -> Getobservaciona(); ?>' />
			
			<input type='text' class='form-control' placeholder='observacionb' name='observacionb' id='observacionb' maxlength='' value='<? echo $object -> Getobservacionb(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
