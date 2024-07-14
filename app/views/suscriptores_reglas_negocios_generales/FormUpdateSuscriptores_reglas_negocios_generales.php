
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script language='javascript' type='text/javascript' src='<?= APP.'views'.DS.'libros'.DS.'scripts'.DS ?>script.js'></script>
	<form id='FormUpdatesuscriptores_reglas_negocios_generales' action='/suscriptores_reglas_negocios_generales/actualizar/' method='POST'> 
		<div class='title'>Editar suscriptores_reglas_negocios_generales</div>
		<!--<table border='0' width='40%' cellspacing='10'>
			<tr>
				<td colspan='2' align='left' class='sub_titulo'>Editar suscriptores_reglas_negocios_generales</td>
			</tr> -->
			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
			<input type='text' class='form-control' placeholder='id_paquete' name='id_paquete' id='id_paquete' maxlength='' value='<? echo $object -> Getid_paquete(); ?>' />
			
			<input type='text' class='form-control' placeholder='forma_pago' name='forma_pago' id='forma_pago' maxlength='' value='<? echo $object -> Getforma_pago(); ?>' />
			
			<input type='text' class='form-control' placeholder='valor' name='valor' id='valor' maxlength='' value='<? echo $object -> Getvalor(); ?>' />
			
			<input type='text' class='form-control' placeholder='tipo_cobro' name='tipo_cobro' id='tipo_cobro' maxlength='' value='<? echo $object -> Gettipo_cobro(); ?>' />
			
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='submit' value='Actualizar'/>
	</form>
