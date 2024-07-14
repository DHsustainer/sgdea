<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'wf_elementos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formwf_elementos' action='/wf_elementos/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='wf_elementos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariowf_elementos}</td>
			</tr>-->
		<div class='title right'>Formulario de wf_elementos </div>
		<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='45' />
		<input type='text' class='form-control' placeholder='Descripcion' name='descripcion' id='descripcion' maxlength='' />
		<input type='text' class='form-control' placeholder='Tipo_elemento' name='tipo_elemento' id='tipo_elemento' maxlength='11' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>