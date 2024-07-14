<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'wf_gestion_mapas'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formwf_gestion_mapas' action='/wf_gestion_mapas/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='wf_gestion_mapas' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariowf_gestion_mapas}</td>
			</tr>-->
		<div class='title right'>Formulario de wf_gestion_mapas </div>
		<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='200' />
		<input type='text' class='form-control' placeholder='Descripcion' name='descripcion' id='descripcion' maxlength='' />
		<input type='text' class='form-control' placeholder='Usuario' name='usuario' id='usuario' maxlength='200' />
		<input type='text' class='form-control' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
		<input type='text' class='form-control' placeholder='Id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='11' />
		<input type='text' class='form-control' placeholder='Id_gestion' name='id_gestion' id='id_gestion' maxlength='11' />
		<input type='text' class='form-control' placeholder='Tipo_dependencia' name='tipo_dependencia' id='tipo_dependencia' maxlength='2' />
		<input type='text' class='form-control' placeholder='Id_mapa' name='id_mapa' id='id_mapa' maxlength='10' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>