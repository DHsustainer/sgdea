<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'mod_versiones'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formmod_versiones' action='/mod_versiones/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='mod_versiones' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariomod_versiones}</td>
			</tr>-->
		<div class='title right'>Formulario de mod_versiones </div>
		<input type='text' class='form-control' placeholder='Id_modulo' name='id_modulo' id='id_modulo' maxlength='10' />
		<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='200' />
		<input type='text' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='text' class='form-control' placeholder='Autor' name='autor' id='autor' maxlength='200' />
		<input type='text' class='form-control' placeholder='Url_instalacion' name='url_instalacion' id='url_instalacion' maxlength='200' />
		<input type='text' class='form-control' placeholder='Url_actualizacion' name='url_actualizacion' id='url_actualizacion' maxlength='200' />
		<input type='text' class='form-control' placeholder='Url_sql' name='url_sql' id='url_sql' maxlength='200' />
		<input type='text' class='form-control' placeholder='Notas' name='notas' id='notas' maxlength='' />
		<input type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='1' />
		<input type='text' class='form-control' placeholder='Requerimientos' name='requerimientos' id='requerimientos' maxlength='' />
		<input type='text' class='form-control' placeholder='Tipo_version' name='tipo_version' id='tipo_version' maxlength='2' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>