<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'wf_log'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formwf_log' action='/wf_log/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='wf_log' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariowf_log}</td>
			</tr>-->
		<div class='title right'>Formulario de wf_log </div>
		<input type='text' class='form-control' placeholder='Usuario' name='usuario' id='usuario' maxlength='200' />
		<input type='text' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='text' class='form-control' placeholder='Actividad' name='actividad' id='actividad' maxlength='' />
		<input type='text' class='form-control' placeholder='Id_mapa' name='id_mapa' id='id_mapa' maxlength='11' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>