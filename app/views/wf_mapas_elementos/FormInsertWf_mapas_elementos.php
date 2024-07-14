<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'wf_mapas_elementos'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formwf_mapas_elementos' action='/wf_mapas_elementos/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='wf_mapas_elementos' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariowf_mapas_elementos}</td>
			</tr>-->
		<div class='title right'>Formulario de wf_mapas_elementos </div>
		<input type='text' class='form-control' placeholder='Id_mapa' name='id_mapa' id='id_mapa' maxlength='11' />
		<input type='text' class='form-control' placeholder='Id_elemento' name='id_elemento' id='id_elemento' maxlength='11' />
		<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='200' />
		<input type='text' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='text' class='form-control' placeholder='Usuario' name='usuario' id='usuario' maxlength='200' />
		<input type='text' class='form-control' placeholder='Id_evento' name='id_evento' id='id_evento' maxlength='11' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>