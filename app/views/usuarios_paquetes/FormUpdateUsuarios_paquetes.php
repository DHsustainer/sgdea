
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateusuarios_paquetes' action='/usuarios_paquetes/actualizar/' method='POST'> 
		<div class='title'>Editar usuarios_paquetes</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar usuarios_paquetes</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='title_act' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
			
			<input type='text' class='title_act' placeholder='valor' name='valor' id='valor' maxlength='' value='<? echo $object -> Getvalor(); ?>' />
			
			<input type='text' class='title_act' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='title_act' placeholder='usuario' name='usuario' id='usuario' maxlength='' value='<? echo $object -> Getusuario(); ?>' />
			
			<input type='text' class='title_act' placeholder='tipo' name='tipo' id='tipo' maxlength='' value='<? echo $object -> Gettipo(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
