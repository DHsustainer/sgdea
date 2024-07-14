
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdateusuarios_compras' action='/usuarios_compras/actualizar/' method='POST'> 
		<div class='title'>Editar usuarios_compras</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar usuarios_compras</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='title_act' placeholder='username' name='username' id='username' maxlength='' value='<? echo $object -> Getusername(); ?>' />
			
			<input type='text' class='title_act' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' />
			
			<input type='text' class='title_act' placeholder='descripcion' name='descripcion' id='descripcion' maxlength='' value='<? echo $object -> Getdescripcion(); ?>' />
			
			<input type='text' class='title_act' placeholder='total' name='total' id='total' maxlength='' value='<? echo $object -> Gettotal(); ?>' />
			
			<input type='text' class='title_act' placeholder='registro_saldo' name='registro_saldo' id='registro_saldo' maxlength='' value='<? echo $object -> Getregistro_saldo(); ?>' />
			
			<input type='text' class='title_act' placeholder='fecha_pago' name='fecha_pago' id='fecha_pago' maxlength='' value='<? echo $object -> Getfecha_pago(); ?>' />
			
			<input type='text' class='title_act' placeholder='medio_pago' name='medio_pago' id='medio_pago' maxlength='' value='<? echo $object -> Getmedio_pago(); ?>' />
			
			<input type='text' class='title_act' placeholder='medio_pago_comprobante' name='medio_pago_comprobante' id='medio_pago_comprobante' maxlength='' value='<? echo $object -> Getmedio_pago_comprobante(); ?>' />
			
			<input type='text' class='title_act' placeholder='medio_pago_imagen' name='medio_pago_imagen' id='medio_pago_imagen' maxlength='' value='<? echo $object -> Getmedio_pago_imagen(); ?>' />
			
			<input type='text' class='title_act' placeholder='codigoAutorizacion' name='codigoAutorizacion' id='codigoAutorizacion' maxlength='' value='<? echo $object -> GetcodigoAutorizacion(); ?>' />
			
			<input type='text' class='title_act' placeholder='numeroTransaccion' name='numeroTransaccion' id='numeroTransaccion' maxlength='' value='<? echo $object -> GetnumeroTransaccion(); ?>' />
			
			<input type='text' class='title_act' placeholder='FechaActualizacion' name='FechaActualizacion' id='FechaActualizacion' maxlength='' value='<? echo $object -> GetFechaActualizacion(); ?>' />
			
			<input type='text' class='title_act' placeholder='referente_pago' name='referente_pago' id='referente_pago' maxlength='' value='<? echo $object -> Getreferente_pago(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
