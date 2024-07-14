
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateayuda_libros' action='/ayuda_libros/actualizar/' method='POST'> 
		<div class='title'>Editar ayuda_libros</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar ayuda_libros</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='titulo' name='titulo' id='titulo' maxlength='' value='<? echo $object -> Gettitulo(); ?>' />
			
			<input type='text' class='form-control' placeholder='descripcion' name='descripcion' id='descripcion' maxlength='' value='<? echo $object -> Getdescripcion(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario_registra' name='usuario_registra' id='usuario_registra' maxlength='' value='<? echo $object -> Getusuario_registra(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_registro' name='fecha_registro' id='fecha_registro' maxlength='' value='<? echo $object -> Getfecha_registro(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_actualizacion' name='fecha_actualizacion' id='fecha_actualizacion' maxlength='' value='<? echo $object -> Getfecha_actualizacion(); ?>' />
			
			<input type='text' class='form-control' placeholder='video' name='video' id='video' maxlength='' value='<? echo $object -> Getvideo(); ?>' />
			
			<input type='text' class='form-control' placeholder='tipo' name='tipo' id='tipo' maxlength='' value='<? echo $object -> Gettipo(); ?>' />
			
			<input type='text' class='form-control' placeholder='dependencia' name='dependencia' id='dependencia' maxlength='' value='<? echo $object -> Getdependencia(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
