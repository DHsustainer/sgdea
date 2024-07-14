
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateayuda_dependencias_elementos' action='/ayuda_dependencias_elementos/actualizar/' method='POST'> 
		<div class='title'>Editar ayuda_dependencias_elementos</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar ayuda_dependencias_elementos</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='libro_id' name='libro_id' id='libro_id' maxlength='' value='<? echo $object -> Getlibro_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='elemento_padre_id' name='elemento_padre_id' id='elemento_padre_id' maxlength='' value='<? echo $object -> Getelemento_padre_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='elemento_dependencia_id' name='elemento_dependencia_id' id='elemento_dependencia_id' maxlength='' value='<? echo $object -> Getelemento_dependencia_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='orden' name='orden' id='orden' maxlength='' value='<? echo $object -> Getorden(); ?>' />
			
			<input type='text' class='form-control' placeholder='mostrar' name='mostrar' id='mostrar' maxlength='' value='<? echo $object -> Getmostrar(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
