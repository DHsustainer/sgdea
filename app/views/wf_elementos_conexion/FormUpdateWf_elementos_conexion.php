
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatewf_elementos_conexion' action='/wf_elementos_conexion/actualizar/' method='POST'> 
		<div class='title'>Editar wf_elementos_conexion</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar wf_elementos_conexion</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_inicial' name='id_inicial' id='id_inicial' maxlength='' value='<? echo $object -> Getid_inicial(); ?>' />
			
			<input type='text' class='form-control' placeholder='id_final' name='id_final' id='id_final' maxlength='' value='<? echo $object -> Getid_final(); ?>' />
			
			<input type='text' class='form-control' placeholder='titulo' name='titulo' id='titulo' maxlength='' value='<? echo $object -> Gettitulo(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
