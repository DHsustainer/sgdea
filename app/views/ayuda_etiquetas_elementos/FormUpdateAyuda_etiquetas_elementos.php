
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateayuda_etiquetas_elementos' action='/ayuda_etiquetas_elementos/actualizar/' method='POST'> 
		<div class='title'>Editar ayuda_etiquetas_elementos</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar ayuda_etiquetas_elementos</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_elemento' name='id_elemento' id='id_elemento' maxlength='' value='<? echo $object -> Getid_elemento(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_etiqueta' name='id_etiqueta' id='id_etiqueta' maxlength='' value='<? echo $object -> Getid_etiqueta(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
