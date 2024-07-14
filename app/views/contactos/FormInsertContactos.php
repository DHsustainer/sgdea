<form id='formcontactos' method='POST'> 
	<table border='0' cellspacing='2' cellpadding='0' class='tabla' width='100%'>
		<tr style='display: none'>
			<td width='30%'>Proceso_id:</td>
			<td><input type='text' name='proceso_id' id='proceso_id' maxlength='10' value='<?= $_GET["id"] ?>' /></td>
		</tr>
		<tr>
			<td width='30%' height='44px;' style="line-height: 44px">Nombre:</td>
			<td style="line-height: 44px;"><input type='text' name='nombre' id='nombrec' maxlength='200' style="height: 25px; width:250px; margin-top:7px;" /></td>
		</tr>
		<tr>
			<td width='30%' style="height:44px; line-height: 44px" class='par'>Apellido:</td>
			<td class='par' style="line-height: 44px;"><input type='text' name='apellido' id='apellidoc' maxlength='200' style="height: 25px; width:250px; margin-top:7px;" /></td>
		</tr>
		<tr>
			<td width='30%' style="height:44px; line-height: 44px" class='impar'>Dirección:</td>
			<td class='impar' style="line-height: 44px;">
				<input type='text' name='direccionx' id='direccionxc' placeholder="Direccion" maxlength='100' style="height: 25px; width:120px; margin-top:7px;" />
				<input type='text' name='ciudadx' id='ciudadc' placeholder="Ciudad" maxlength='100' style="height: 25px; width:120px; margin-top:7px;" />
			</td>
		</tr>	 
		<tr>
			<td width='30%' style="height:44px; line-height: 44px" class='par'>Teléfono:</td>
			<td class='par' style="line-height: 44px;"><input type='text' name='telefono' id='telefonoc' maxlength='200' style="height: 25px; width:250px; margin-top:7px;" /></td>
		</tr>
		<tr>
			<td width='30%' style="height:44px; line-height: 44px" class='impar'>Email:</td>
			<td class='impar' style="line-height: 44px;"><input type='text' name='email' id='emailc' maxlength='200' style="height: 25px; width:250px; margin-top:7px;" /></td>
		</tr>
		<tr>
			<td style="line-height: 44px" width='30%' height='44px;' class='par'>Tipo de Contacto:</td>
			<td style="line-height: 44px;" class='par'><input type='text' name='type' id='typec' maxlength='200' style="height: 25px; width:250px; margin-top:7px;" /></td>
		</tr>
		<tr>
			<td colspan='2' align='right'><input type='button' value='Continuar' onclick="SaveContact()"/></td>
		</tr>
	</table>
</form>
<script>
function SaveContact(){
	var str = $('#formcontactos').serialize();
	$.ajax({
		url:'<?=HOMEDIR?>/contactos/registrar/',
		type:'POST',
		data:str+'&proceso_id=<?=$_GET["id"]?>',
		success:function(msg){
			alert("Contacto Registrado");
			var functions = $("	<div class='title' style='cursor:pointer' onclick='$(\"#formulario3_"+$.trim(msg)+"\").slideToggle(500)'>"+$('#nombrec').val()+" "+$('#apellidoc').val()+
								"</div>"+
								"<form id='formulario3_"+$.trim(msg)+"' style='display:none'>"+
									"<table class='right'>"+
										"<tr class='impar'>"+
											"<td>Nombre:</td>"+
											"<td><input type='text' disabled class='no_editable input1_$col[id]' value='"+$('#nombrec').val()+" "+$('#apellidoc').val()+"'></td>"+
										"</tr>"+
										"<tr class='par'>"+
											"<td>Tipo:</td>"+
											"<td><input type='text' disabled class='no_editable input1_$col[id]' value='"+$('#typec').val()+"'></td>"+
										"</tr>"+
										"<tr class='impar'>"+
											"<td>Dirección:</td>"+
											"<td><input type='text' disabled class='no_editable input1_$col[id]' value='"+$('#direccionxc').val()+"'></td>"+
										"</tr>"+
										"<tr class='par'>"+
											"<td>Teléfono:</td>"+
											"<td><input type='text' disabled class='no_editable input1_$col[id]' value='"+$('#telefonoc').val()+"'></td>"+
										"</tr>"+
										"<tr class='impar'>"+
											"<td>E-mail:</td>"+
											"<td><input type='text' disabled class='no_editable input1_$col[id]' value='"+$('#emailc').val()+"'></td>"+
										"</tr>"+
									"</table>"+
								"</form>");
      		$("#contact_group").each(function(){
        		/*$(this).html("");*/
        		functions.clone().appendTo(this);

				$("#nombrec").val("");
				$("#apellidoc").val("");
				$("#telefonoc").val("");
				$("#direccionxc").val("");
				$("#emailc").val("");
				$("#type").val("");
      		});
		}
	})
}
</script>