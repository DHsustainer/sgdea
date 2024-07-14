<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'plantilla_documento_configuracion'.DS.'scripts'.DS ?>script.js'></script>
	<form id='formplantilla_documento_configuracion' action='/plantilla_documento_configuracion/registrar/' method='POST'> 
		<!--
    	<input type='hidden' id='m' name='m' value='plantilla_documento_configuracion' />     
    	<input type='hidden' id='action' name='action' value='registrar' />     
			<table border='0' cellspacing='3' cellpadding='0' class='tabla' width='40%'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>{Formularioplantilla_documento_configuracion}</td>
			</tr>-->
		<div class='title right'>Formulario de plantilla_documento_configuracion </div>
		<input type='text' class='form-control' placeholder='Ultima_modificacion' name='ultima_modificacion' id='ultima_modificacion' maxlength='200' />
		<input type='text' class='form-control' placeholder='Tipo' name='tipo' id='tipo' maxlength='11' />
		<input type='text' class='form-control' placeholder='M_t' name='m_t' id='m_t' maxlength='11' />
		<input type='text' class='form-control' placeholder='M_r' name='m_r' id='m_r' maxlength='11' />
		<input type='text' class='form-control' placeholder='M_b' name='m_b' id='m_b' maxlength='11' />
		<input type='text' class='form-control' placeholder='M_l' name='m_l' id='m_l' maxlength='11' />
		<input type='text' class='form-control' placeholder='M_e_t' name='m_e_t' id='m_e_t' maxlength='11' />
		<input type='text' class='form-control' placeholder='M_e_b' name='m_e_b' id='m_e_b' maxlength='11' />
		<input type='text' class='form-control' placeholder='M_p_t' name='m_p_t' id='m_p_t' maxlength='11' />
		<input type='text' class='form-control' placeholder='M_p_b' name='m_p_b' id='m_p_b' maxlength='11' />
		<input type='text' class='form-control' placeholder='Fuente' name='fuente' id='fuente' maxlength='200' />
		<input type='text' class='form-control' placeholder='Tamano' name='tamano' id='tamano' maxlength='11' />
		<input type='submit' value='Insertar'  style='margin:10px;'/>
	</form>