
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdategestion_cambio_ubicacion_archivo' action='/gestion_cambio_ubicacion_archivo/actualizar/' method='POST'> 
		<div class='title'>Editar gestion_cambio_ubicacion_archivo</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar gestion_cambio_ubicacion_archivo</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_gestion' name='id_gestion' id='id_gestion' maxlength='' value='<? echo $object -> Getid_gestion(); ?>' />
			
			<input type='text' class='form-control' placeholder='nombre_destino' name='nombre_destino' id='nombre_destino' maxlength='' value='<? echo $object -> Getnombre_destino(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado_archivo_origen' name='estado_archivo_origen' id='estado_archivo_origen' maxlength='' value='<? echo $object -> Getestado_archivo_origen(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado_archivo_destino' name='estado_archivo_destino' id='estado_archivo_destino' maxlength='' value='<? echo $object -> Getestado_archivo_destino(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
