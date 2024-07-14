<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'suscriptores_accesos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formsuscriptores_accesos' action='/suscriptores_accesos/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='suscriptores_accesos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariosuscriptores_accesos}</td>
			</tr>-->
		<div class='title right'>Formulario de suscriptores_accesos </div>
		<input type='text' class='form-control' placeholder='Id_suscriptor' name='id_suscriptor' id='id_suscriptor' maxlength='10' />
		<input type='text' class='form-control' placeholder='Dominio' name='dominio' id='dominio' maxlength='200' />
		<input type='text' class='form-control' placeholder='D_key' name='d_key' id='d_key' maxlength='100' />
		<input type='text' class='form-control' placeholder='Host' name='host' id='host' maxlength='100' />
		<input type='text' class='form-control' placeholder='Usuario' name='usuario' id='usuario' maxlength='100' />
		<input type='text' class='form-control' placeholder='Clave' name='clave' id='clave' maxlength='100' />
		<input type='text' class='form-control' placeholder='Db_nombre' name='db_nombre' id='db_nombre' maxlength='100' />
		<input type='text' class='form-control' placeholder='Url1' name='url1' id='url1' maxlength='' />
		<input type='text' class='form-control' placeholder='Url2' name='url2' id='url2' maxlength='' />
		<input type='text' class='form-control' placeholder='Url3' name='url3' id='url3' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>