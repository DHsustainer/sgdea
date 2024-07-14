
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatealertas_suscriptor' action='/alertas_suscriptor/actualizar/' method='POST'> 
		<div class='title'>Editar alertas_suscriptor</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar alertas_suscriptor</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='suscriptor_id' name='suscriptor_id' id='suscriptor_id' maxlength='' value='<? echo $object -> Getsuscriptor_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='alerta' name='alerta' id='alerta' maxlength='' value='<? echo $object -> Getalerta(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_gestion' name='id_gestion' id='id_gestion' maxlength='' value='<? echo $object -> Getid_gestion(); ?>' />
			
			<input type='text' class='form-control' placeholder='fechahora' name='fechahora' id='fechahora' maxlength='' value='<? echo $object -> Getfechahora(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='form-control' placeholder='type' name='type' id='type' maxlength='' value='<? echo $object -> Gettype(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
