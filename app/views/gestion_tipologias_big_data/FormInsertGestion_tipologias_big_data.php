<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'gestion_tipologias_big_data'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formgestion_tipologias_big_data' action='/gestion_tipologias_big_data/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='gestion_tipologias_big_data' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariogestion_tipologias_big_data}</td>
			</tr>-->
		<div class='title right'>Formulario de gestion_tipologias_big_data </div>
		<input type='text' class='form-control' placeholder='Username' name='username' id='username' maxlength='50' />
		<input type='text' class='form-control' placeholder='Proceso_id' name='proceso_id' id='proceso_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Tipologia_referencia_id' name='tipologia_referencia_id' id='tipologia_referencia_id' maxlength='10' />
		<input type='text' class='form-control' placeholder='Col_1' name='col_1' id='col_1' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_2' name='col_2' id='col_2' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_3' name='col_3' id='col_3' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_4' name='col_4' id='col_4' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_5' name='col_5' id='col_5' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_6' name='col_6' id='col_6' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_7' name='col_7' id='col_7' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_8' name='col_8' id='col_8' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_9' name='col_9' id='col_9' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_10' name='col_10' id='col_10' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_11' name='col_11' id='col_11' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_12' name='col_12' id='col_12' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_13' name='col_13' id='col_13' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_14' name='col_14' id='col_14' maxlength='' />
		<input type='text' class='form-control' placeholder='Col_15' name='col_15' id='col_15' maxlength='' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>