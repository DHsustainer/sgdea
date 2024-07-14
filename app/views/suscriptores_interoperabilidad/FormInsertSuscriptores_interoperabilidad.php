<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'suscriptores_interoperabilidad'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formsuscriptores_interoperabilidad' action='/suscriptores_interoperabilidad/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='suscriptores_interoperabilidad' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formulariosuscriptores_interoperabilidad}</td>
			</tr>-->
		<!--<div class='title right'>Formulario de suscriptores_interoperabilidad </div>-->
		<input type='hidden' class='form-control' placeholder='Suscriptor_origen' name='suscriptor_origen' id='suscriptor_origen' value='<?php echo $id; ?>' />
		<select class='form-control' style="width:110px;"name='suscriptor_destino' id='suscriptor_destino'>
		<?php
		$queryg = $con->Query("SELECT * from suscriptores_contactos where id != '".$id."' order by nombre");
		while($rowg = $con->FetchAssoc($queryg)){
			echo '<option value="'.$rowg['id'].'">'.$rowg['nombre'].'</option>';
		}
		?>
		</select>
		<input type='text' style="width:83px;" class='form-control' placeholder='Key_set' name='key_set' id='key_set' maxlength='255' />
		<input type='text' style="width:83px;" class='form-control' placeholder='Key_get' name='key_get' id='key_get' maxlength='255' />
		<input type='text' style="width:83px;" class='form-control' placeholder='Key_add' name='key_add' id='key_add' maxlength='255' />
		<input type='hidden' class='form-control' placeholder='Estado' name='estado' id='estado' value='1' maxlength='11' />		
		<input type='submit' value='Registrar'  style='margin:10px;'/>
		<!--<input type='text' class='form-control' placeholder='FechaActualizacion' name='FechaActualizacion' id='FechaActualizacion' maxlength='' />
		-->
	</form>