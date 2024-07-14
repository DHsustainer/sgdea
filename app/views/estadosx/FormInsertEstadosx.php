<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'estadosx'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formestadosx' action='/estadosx/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='estadosx' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioestadosx}</td>
			</tr>-->
		<div class='title right'>Formulario de estadosx </div>
		<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='400' />
		<input type='text' class='form-control' placeholder='Valor' name='valor' id='valor' maxlength='400' />
		<input type='text' class='form-control' placeholder='Tipo' name='tipo' id='tipo' maxlength='100' />
		<input type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='1' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>