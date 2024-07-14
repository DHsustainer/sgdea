
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatewf_elementos' action='/wf_elementos/actualizar/' method='POST'> 
		<div class='title'>Editar wf_elementos</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar wf_elementos</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='titulo' name='titulo' id='titulo' maxlength='' value='<? echo $object -> Gettitulo(); ?>' />
			
			<input type='text' class='form-control' placeholder='descripcion' name='descripcion' id='descripcion' maxlength='' value='<? echo $object -> Getdescripcion(); ?>' />
			
			<input type='text' class='form-control' placeholder='tipo_elemento' name='tipo_elemento' id='tipo_elemento' maxlength='' value='<? echo $object -> Gettipo_elemento(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
