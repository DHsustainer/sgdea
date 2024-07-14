<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'wf_tipos_elementos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formwf_tipos_elementos' action='/wf_tipos_elementos/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='wf_tipos_elementos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariowf_tipos_elementos}</td>
			</tr>-->
		<div class='title right'>Formulario de wf_tipos_elementos </div>
		<input type='text' class='form-control' placeholder='Nombre' name='nombre' id='nombre' maxlength='45' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>