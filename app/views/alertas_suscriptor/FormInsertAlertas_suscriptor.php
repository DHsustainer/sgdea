<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'alertas_suscriptor'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formalertas_suscriptor' action='/alertas_suscriptor/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='alertas_suscriptor' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioalertas_suscriptor}</td>
			</tr>-->
		<div class='title right'>Formulario de alertas_suscriptor </div>
		<input type='text' class='form-control' placeholder='Suscriptor_id' name='suscriptor_id' id='suscriptor_id' maxlength='50' />
		<input type='text' class='form-control' placeholder='Alerta' name='alerta' id='alerta' maxlength='' />
		<input type='text' class='form-control' placeholder='Id_gestion' name='id_gestion' id='id_gestion' maxlength='10' />
		<input type='text' class='form-control' placeholder='Fechahora' name='fechahora' id='fechahora' maxlength='' />
		<input type='text' class='form-control' placeholder='Estado' name='estado' id='estado' maxlength='11' />
		<input type='text' class='form-control' placeholder='Type' name='type' id='type' maxlength='50' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>