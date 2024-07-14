<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'firmas_usuarios'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formfirmas_usuarios' action='/firmas_usuarios/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='firmas_usuarios' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariofirmas_usuarios}</td>
			</tr>-->
		<div class='title right'>Formulario de firmas_usuarios </div>
		<input type='text' class='form-control' placeholder='Username' name='username' id='username' maxlength='500' />
		<input type='text' class='form-control' placeholder='SID' name='SID' id='SID' maxlength='500' />
		<input type='text' class='form-control' placeholder='Fecha_firma' name='fecha_firma' id='fecha_firma' maxlength='' />
		<input type='text' class='form-control' placeholder='Fecha_expiracion' name='fecha_expiracion' id='fecha_expiracion' maxlength='' />
		<input type='text' class='form-control' placeholder='Firma' name='firma' id='firma' maxlength='500' />
		<input type='text' class='form-control' placeholder='Estado_firma' name='estado_firma' id='estado_firma' maxlength='1' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>