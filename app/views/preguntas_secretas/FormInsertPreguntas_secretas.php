<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'preguntas_secretas'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formpreguntas_secretas' action='/preguntas_secretas/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='preguntas_secretas' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariopreguntas_secretas}</td>
			</tr>-->
		<div class='title right'>Formulario de preguntas_secretas </div>
		<input type='text' class='form-control' placeholder='Pregunta' name='pregunta' id='pregunta' maxlength='400' />
		<input type='text' class='form-control' placeholder='Tipo' name='tipo' id='tipo' maxlength='1' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>