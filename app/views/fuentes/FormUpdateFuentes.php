
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatefuentes' action='/fuentes/actualizar/' method='POST'> 
		<div class='title'>Editar fuentes</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar fuentes</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
			
			<input type='text' class='form-control' placeholder='url' name='url' id='url' maxlength='' value='<? echo $object -> Geturl(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario' name='usuario' id='usuario' maxlength='' value='<? echo $object -> Getusuario(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
