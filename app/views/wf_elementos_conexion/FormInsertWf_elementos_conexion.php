<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'wf_elementos_conexion'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formwf_elementos_conexion' action='/wf_elementos_conexion/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='wf_elementos_conexion' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariowf_elementos_conexion}</td>
			</tr>-->
		<div class='title right'>Formulario de wf_elementos_conexion </div>
		<input type='text' class='form-control' placeholder='Id_inicial' name='id_inicial' id='id_inicial' maxlength='11' />
		<input type='text' class='form-control' placeholder='Id_final' name='id_final' id='id_final' maxlength='11' />
		<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='200' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>