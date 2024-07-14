
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatepreguntas_usuarios' action='/preguntas_usuarios/actualizar/' method='POST'> 
		<div class='title'>Editar preguntas_usuarios</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar preguntas_usuarios</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_pregunta' name='id_pregunta' id='id_pregunta' maxlength='' value='<? echo $object -> Getid_pregunta(); ?>' />
			
			<input type='text' class='form-control' placeholder='respuesta' name='respuesta' id='respuesta' maxlength='' value='<? echo $object -> Getrespuesta(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='form-control' placeholder='username' name='username' id='username' maxlength='' value='<? echo $object -> Getusername(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
