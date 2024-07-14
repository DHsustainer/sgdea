
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateestadosx' action='/estadosx/actualizar/' method='POST'> 
		<div class='title'>Editar estadosx</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar estadosx</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
			
			<input type='text' class='form-control' placeholder='valor' name='valor' id='valor' maxlength='' value='<? echo $object -> Getvalor(); ?>' />
			
			<input type='text' class='form-control' placeholder='tipo' name='tipo' id='tipo' maxlength='' value='<? echo $object -> Gettipo(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
