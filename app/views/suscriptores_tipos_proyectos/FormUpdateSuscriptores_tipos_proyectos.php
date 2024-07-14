
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatesuscriptores_tipos_proyectos' action='/suscriptores_tipos_proyectos/actualizar/' method='POST'> 
		<div class='title'>Editar suscriptores_tipos_proyectos</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar suscriptores_tipos_proyectos</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='form-control' placeholder='tipo_proyecto' name='tipo_proyecto' id='tipo_proyecto' maxlength='' value='<? echo $object -> Gettipo_proyecto(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='form-control' placeholder='usuario' name='usuario' id='usuario' maxlength='' value='<? echo $object -> Getusuario(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
