
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatemod_versiones' action='/mod_versiones/actualizar/' method='POST'> 
		<div class='title'>Editar mod_versiones</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar mod_versiones</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_modulo' name='id_modulo' id='id_modulo' maxlength='' value='<? echo $object -> Getid_modulo(); ?>' />
			
			<input type='text' class='form-control' placeholder='titulo' name='titulo' id='titulo' maxlength='' value='<? echo $object -> Gettitulo(); ?>' />
			
			<input type='text' class='form-control' placeholder='fecha' name='fecha' id='fecha' maxlength='' value='<? echo $object -> Getfecha(); ?>' />
			
			<input type='text' class='form-control' placeholder='autor' name='autor' id='autor' maxlength='' value='<? echo $object -> Getautor(); ?>' />
			
			<input type='text' class='form-control' placeholder='url_instalacion' name='url_instalacion' id='url_instalacion' maxlength='' value='<? echo $object -> Geturl_instalacion(); ?>' />
			
			<input type='text' class='form-control' placeholder='url_actualizacion' name='url_actualizacion' id='url_actualizacion' maxlength='' value='<? echo $object -> Geturl_actualizacion(); ?>' />
			
			<input type='text' class='form-control' placeholder='url_sql' name='url_sql' id='url_sql' maxlength='' value='<? echo $object -> Geturl_sql(); ?>' />
			
			<input type='text' class='form-control' placeholder='notas' name='notas' id='notas' maxlength='' value='<? echo $object -> Getnotas(); ?>' />
			
			<input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='form-control' placeholder='requerimientos' name='requerimientos' id='requerimientos' maxlength='' value='<? echo $object -> Getrequerimientos(); ?>' />
			
			<input type='text' class='form-control' placeholder='tipo_version' name='tipo_version' id='tipo_version' maxlength='' value='<? echo $object -> Gettipo_version(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
