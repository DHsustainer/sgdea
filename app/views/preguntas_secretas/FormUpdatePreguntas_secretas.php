
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatepreguntas_secretas' action='/preguntas_secretas/actualizar/' method='POST'> 
		<div class='title'>Editar preguntas_secretas</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar preguntas_secretas</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='pregunta' name='pregunta' id='pregunta' maxlength='' value='<? echo $object -> Getpregunta(); ?>' />
			
			<input type='text' class='form-control' placeholder='tipo' name='tipo' id='tipo' maxlength='' value='<? echo $object -> Gettipo(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
