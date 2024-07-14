
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateayuda_elementos_busqueda' action='/ayuda_elementos_busqueda/actualizar/' method='POST'> 
		<div class='title'>Editar ayuda_elementos_busqueda</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar ayuda_elementos_busqueda</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='titulo' name='titulo' id='titulo' maxlength='' value='<? echo $object -> Gettitulo(); ?>' />
			
			<input type='text' class='form-control' placeholder='pista' name='pista' id='pista' maxlength='' value='<? echo $object -> Getpista(); ?>' />
			
			<input type='text' class='form-control' placeholder='texto' name='texto' id='texto' maxlength='' value='<? echo $object -> Gettexto(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_registro' name='fecha_registro' id='fecha_registro' maxlength='' value='<? echo $object -> Getfecha_registro(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha_actualizacion' name='fecha_actualizacion' id='fecha_actualizacion' maxlength='' value='<? echo $object -> Getfecha_actualizacion(); ?>' />
			
			<input type='text' class='form-control' placeholder='libro_id' name='libro_id' id='libro_id' maxlength='' value='<? echo $object -> Getlibro_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='categoria' name='categoria' id='categoria' maxlength='' value='<? echo $object -> Getcategoria(); ?>' />
			
			<input type='text' class='form-control' placeholder='error' name='error' id='error' maxlength='' value='<? echo $object -> Geterror(); ?>' />
			
			<input type='text' class='form-control' placeholder='error_descripcion' name='error_descripcion' id='error_descripcion' maxlength='' value='<? echo $object -> Geterror_descripcion(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
