<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'gestion_anexos_firmas'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formgestion_anexos_firmas' action='/gestion_anexos_firmas/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='gestion_anexos_firmas' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariogestion_anexos_firmas}</td>
			</tr>-->
		<div class='title right'>Formulario de gestion_anexos_firmas </div>
		<input type='text' class='form-control' placeholder='Gestion_id' name='gestion_id' id='gestion_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Anexo_id' name='anexo_id' id='anexo_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Tipologia_id' name='tipologia_id' id='tipologia_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Fecha_solicitud' name='fecha_solicitud' id='fecha_solicitud' maxlength='' />
		<input type='text' class='form-control' placeholder='Usuario_solicita' name='usuario_solicita' id='usuario_solicita' maxlength='500' />
		<input type='text' class='form-control' placeholder='Usuario_firma' name='usuario_firma' id='usuario_firma' maxlength='500' />
		<input type='text' class='form-control' placeholder='Fecha_firma' name='fecha_firma' id='fecha_firma' maxlength='' />
		<input type='text' class='form-control' placeholder='Codigo_firma' name='codigo_firma' id='codigo_firma' maxlength='500' />
		<input type='text' class='form-control' placeholder='Clave_primaria' name='clave_primaria' id='clave_primaria' maxlength='500' />
		<input type='text' class='form-control' placeholder='Estado_firma' name='estado_firma' id='estado_firma' maxlength='10' />
		<input type='text' class='form-control' placeholder='Repo_1' name='repo_1' id='repo_1' maxlength='500' />
		<input type='text' class='form-control' placeholder='Repo_2' name='repo_2' id='repo_2' maxlength='500' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>