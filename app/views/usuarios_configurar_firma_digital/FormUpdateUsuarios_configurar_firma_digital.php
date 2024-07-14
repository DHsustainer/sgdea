
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateusuarios_configurar_firma_digital' action='/usuarios_configurar_firma_digital/actualizar/' method='POST'> 
		<div class='title'>Editar usuarios_configurar_firma_digital</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar usuarios_configurar_firma_digital</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='user_id' name='user_id' id='user_id' maxlength='' value='<? echo $object -> Getuser_id(); ?>' />
			
			<input type='text' class='form-control' placeholder='campo1' name='campo1' id='campo1' maxlength='' value='<? echo $object -> Getcampo1(); ?>' />
			
			<input type='text' class='form-control' placeholder='campo2' name='campo2' id='campo2' maxlength='' value='<? echo $object -> Getcampo2(); ?>' />
			
			<input type='text' class='form-control' placeholder='campo3' name='campo3' id='campo3' maxlength='' value='<? echo $object -> Getcampo3(); ?>' />
			
			<input type='text' class='form-control' placeholder='campo4' name='campo4' id='campo4' maxlength='' value='<? echo $object -> Getcampo4(); ?>' />
			
			<input type='text' class='form-control' placeholder='campo5' name='campo5' id='campo5' maxlength='' value='<? echo $object -> Getcampo5(); ?>' />
			
			<input type='text' class='form-control' placeholder='campo6' name='campo6' id='campo6' maxlength='' value='<? echo $object -> Getcampo6(); ?>' />
			
			<input type='text' class='form-control' placeholder='campo7' name='campo7' id='campo7' maxlength='' value='<? echo $object -> Getcampo7(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
