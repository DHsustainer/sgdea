
	<form id='FormUpdatedian_facturacion'  method='POST'> 

		<div class="row" style="margin-left:0px; margin-top: 0px;">

		

			<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />

<div class="2u 12u(narrower)"><b>Razón Social:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>NIT:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='nit' name='nit' id='nit' maxlength='' value='<? echo $object -> Getnit(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Númer de Resolución:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='num_resolucion' name='num_resolucion' id='num_resolucion' maxlength='' value='<? echo $object -> Getnum_resolucion(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Fecha de Resolución:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control datepicker' placeholder='fecha_resolucion' name='fecha_resolucion' id='fecha_resolucion' maxlength='' value='<? echo $object -> Getfecha_resolucion(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Prefijo de Facturación:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='prefijo' name='prefijo' id='prefijo' maxlength='' value='<? echo $object -> Getprefijo(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Rango inicial de Facturación:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='rango_desde' name='rango_desde' id='rango_desde' maxlength='' value='<? echo $object -> Getrango_desde(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Rango Final de Facturación:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='rango_hasta' name='rango_hasta' id='rango_hasta' maxlength='' value='<? echo $object -> Getrango_hasta(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Clave Técnica:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='clave_tecnica' name='clave_tecnica' id='clave_tecnica' maxlength='' value='<? echo $object -> Getclave_tecnica(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Fecha Inicial Vigencia Clave:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control datepicker' placeholder='fecha_vigencia_desde' name='fecha_vigencia_desde' id='fecha_vigencia_desde' maxlength='' value='<? echo $object -> Getfecha_vigencia_desde(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Fecha Final Vigencia Clave:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control datepicker' placeholder='fecha_vigencia_hasta' name='fecha_vigencia_hasta' id='fecha_vigencia_hasta' maxlength='' value='<? echo $object -> Getfecha_vigencia_hasta(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Software ID:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='software_id' name='software_id' id='software_id' maxlength='' value='<? echo $object -> Getsoftware_id(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>PIN:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='pin' name='pin' id='pin' maxlength='' value='<? echo $object -> Getpin(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Nombre del Software Dian:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='nombre_software' name='nombre_software' id='nombre_software' maxlength='' value='<? echo $object -> Getnombre_software(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Fecha de Registro:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control datepicker' placeholder='fecha_registro' name='fecha_registro' id='fecha_registro' maxlength='' value='<? echo $object -> Getfecha_registro(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Estado Actual:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='estado' name='estado' id='estado' maxlength='' value='<? echo $object -> Getestado(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>URL:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='url' name='url' id='url' maxlength='' value='<? echo $object -> Geturl(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Usuario Dian:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='usuario' name='usuario' id='usuario' maxlength='' value='<? echo $object -> Getusuario(); ?>' /></div>			
			
<div class="2u 12u(narrower)"><b>Clave:</b></div>
<div class="4u 12u(narrower) "><input type='text' class='form-control' placeholder='clave' name='clave' id='clave' maxlength='' value='<? echo $object -> Getclave(); ?>' /></div>			
			
		</div>	
	<!--<tr>
				<td colspan='2' align='center'>
				</td>
			</tr>
		</table> -->
				<input type='button' value='Actualizar' onClick="EditarDian_facturacion()"/>
	</form>

<script type="text/javascript">
	
function EditarDian_facturacion(){
	var URL = '/dian_facturacion/actualizar/';
	var String = $("#FormUpdatedian_facturacion").serialize();
	$.ajax({
		type: 'POST',
		url: URL,
		data: String,
		success: function(msg){
			alert(msg);
		}
	});

}	

	

</script>