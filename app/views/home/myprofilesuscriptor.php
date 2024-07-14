<?
	global $f;
?>
<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/config.css'/>
<div id="container_mail_config">
	<div id="header_profile">
		<div id="name_profile">
			<?= $object->GetNombre() ?> <span class="account_name">(<?= $object->GetType(); ?>)</span>
			
		</div>

	</div>

	<div id="profile_main">
		<div id="menu_list">
			<div id="title_blue">Cuenta</div>
			<ul id="navigation_menu">
				<li id="btn_information" class="active" onClick="LoadPage('table_data_user', 'btn_information')">Información Personal</li>
				<li id="btn_password" onClick="LoadPage('table_password_user', 'btn_password')">Cambiar Clave</li>
				<!--
				<li id="btn_s_password" onClick="OpenWindow('/usuarios/segundaclave/')">Segunda Clave</li>-->

			</ul>
		</div>

		<div id="data_content">
			<div id="title_black">Informacion Personal</div>	
			<div id="body_data">
				<form id="formUpdateUsuario" name="formUpdateUsuario">
					<table id="table_data_user"  width="90%">
						<tr>
							<td height="25px;" width="190px">Nombre:</td>
							<td class="text_regular" onClick="ShowField('nombre')" id="text_nombre"><?= $object->GetNombre() ?></td>
							<td class="input_regular" id="input_nombre"><input type='text' onBlur="HideField('nombre')" name='nombre' id='nombre' maxlength='' value='<? echo $object -> GetNombre(); ?>' /></td>
						</tr>
						<tr>
							<td height="25px;">Identificacion</td>
							<td class="text_regular" onClick="ShowField('identificacion')" id="text_identificacion"><?= $object->GetIdentificacion(); ?></td>
							<td class="input_regular" id="input_identificacion"><input type='text' onBlur="HideField('identificacion')" name='identificacion' id='identificacion' maxlength='' value='<? echo $object -> GetIdentificacion(); ?>' class="textbox" /></td>
						</tr>
						<tr>
							<td height="25px;">Type</td>
							<td class="text_regular" onClick="ShowField('type')" id="text_type"><?= $object->GetType(); ?></td>
							<td class="input_regular" id="input_type"><input type='text' onBlur="HideField('type')" name='type' id='type' maxlength='' value='<? echo $object -> GetType(); ?>' class="textbox" /></td>
						</tr>
						<tr>
							<td height="25px;">Dirección</td>
							<td class="text_regular" onClick="ShowField('direccion')" id="text_direccion"><?= $objectd->GetDireccion(); ?></td>
							<td class="input_regular" id="input_direccion"><input type='text' onBlur="HideField('direccion')" name='direccion' id='direccion' maxlength='' value='<? echo $objectd -> Getdireccion(); ?>' class="textbox" /></td>
						</tr>
						<tr>
							<td height="25px;">Ciudad</td>
							<td class="text_regular" onClick="ShowField('ciudad')" id="text_ciudad"><?= $objectd->GetCiudad(); ?></td>
							<td class="input_regular" id="input_ciudad"><input type='text' onBlur="HideField('ciudad')" name='ciudad' id='ciudad' maxlength='' value='<? echo $objectd -> Getciudad(); ?>' class="textbox" /></td>
						</tr>
						<tr>
							<td height="25px;">Teléfono</td>
							<td class="text_regular" onClick="ShowField('telefonos')" id="text_telefonos"><?= $objectd->GetTelefonos(); ?></td>
							<td class="input_regular" id="input_telefonos"><input type='text' onBlur="HideField('telefonos')" name='telefonos' id='telefonos' maxlength='' value='<? echo $objectd -> Gettelefonos(); ?>' class="textbox" /></td>
						</tr>
						<tr>
							<td height="25px;">Correo Electrónico</td>
							<td class="text_regular" onClick="ShowField('email')" id="text_email"><?= $objectd->GetEmail(); ?></td>
							<td class="input_regular" id="input_email"><input type='text' onBlur="HideField('email')" name='email' id='email' maxlength='' value='<? echo $objectd -> GetEmail(); ?>' class="textbox" /></td>
						</tr>

					</table>
					<table id="table_password_user"  style="display:none"  width="90%">
						<tr>
							<td height="60px">
								<div class="subtitle_password">Nueva Clave </div>
								<input autocomplete="off" type='password' name='newpassword' id='newpassword' placeholder="Escribe tu nueva contraseña"maxlength='' />
							</td>
						</tr>
						<tr>
							<td height="60px">
								<div class="subtitle_password"> Confirmar Cave: </div>
								<input autocomplete="off" type='password' name='checkpassword' id='checkpassword' placeholder="Vuelve a escribir tu nueva contraseña" maxlength='' />
								<input type='hidden' name='password' id='password' maxlength='' value='<?= $objectd->Getdec_pass(); ?>' size="50"/>
							</td>
						</tr>
					</table>
				</form>
				<br>
				<input type="button" value="Guardar Cambios" class="btn btn-primary" id="updateprofile">
			</div>

			<div class="clear"></div>
		</div>
	</div>
</div>


<script>
$(document).ready(function(){

	$("#view_signatures").click(function(){
		$("#ListSignatures").slideDown();
	})


	$("#mytextsignature").keyup(function(){
		var x = "<?= $object->GetNombre() ?>";

		if ($(this).val() == "") {
			$(".texttoshowinfont").html(x);
		}else{
			$(".texttoshowinfont").html($(this).val());
		}
	})  

	$("#nombre").live("change", function(){
		$("#text_nombre").html($(this).val());
		$("#text_nombre").css("display", "block");
		$("#input_nombre").css("display", "none");
	})
	$("#identificacion").live("change", function(){
		$("#text_identificacion").html($("#identificacion option:selected").text());
		$("#text_identificacion").css("display", "block");
		$("#input_identificacion").css("display", "none");
	})
	$("#type").live("change", function(){
		$("#text_type").html($(this).val());
		$("#text_type").css("display", "block");
		$("#input_type").css("display", "none");
	})
	$("#direccion").live("change", function(){
		$("#text_direccion").html($(this).val());
		$("#text_direccion").css("display", "block");
		$("#input_direccion").css("display", "none");
	})
	$("#ciudad").live("change", function(){
		$("#text_ciudad").html($(this).val());
		$("#text_ciudad").css("display", "block");
		$("#input_ciudad").css("display", "none");
	})
	$("#telefonos").live("change", function(){
		$("#text_telefonos").html($(this).val());
		$("#text_telefonos").css("display", "block");
		$("#input_telefonos").css("display", "none");
	})
	$("#email").live("change", function(){
		$("#text_email").html($(this).val());
		$("#text_email").css("display", "block");
		$("#input_email").css("display", "none");
	}) 

	$("#updateprofile").live("click", function(){

		if($("#nombre").val() == ""){
			$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre</div>");
			return false;
		}
		if($("#email").val() == ""){
			$("#update_field").html("<div class='alert alert-info'>El campo E-Mail es obligatorio</div>");
			return false;
		}else{
			var str = $("#formUpdateUsuario").serialize();
			$.ajax({
				type: "POST",
				url: "/dashboard/actualizarperfilsuscriptor/",
				data: str,
				success:function(msg){
					result = msg;
					alert(msg);
					//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
				}
			});
		}
			
	})

});
</script>
<script>
	function ShowField(id){
		$("#text_"+id).css("display", "none");
		$("#input_"+id).css("display", "block");
		$("#"+id).focus();
	}

	function HideField(id){
		$("#text_"+id).css("display", "block");
		$("#input_"+id).css("display", "none");
	}

function LoadPage(id, selector){


		$("#navigation_menu > li").removeClass('active');

		$("#"+selector).addClass('active');

		$('#updateprofile').show();

		if (id == "table_data_user") {

			$("#table_password_user").slideUp("fast");

			$("#table_data_user").slideDown("slow");

			$("#table_firma_digital").slideUp("fast");

			$("#title_black").html("Información personal");

		}
		if (id == "table_password_user"){

			$("#table_data_user").slideUp("fast");

			$("#table_password_user").slideDown("slow");

			$("#table_firma_digital").slideUp("fast");

			$("#title_black").html("Cambiar la clave");

		}
		if (id == "table_firma_digital"){
			$('#updateprofile').hide();

			$("#table_data_user").slideUp("fast");

			$("#table_password_user").slideUp("fast");

			$("#table_firma_digital").slideDown("slow");

			$("#title_black").html("Firma Digital");

		}

	} 

	function CambiarFirma(idf){

		var x = "<?= $object->GetNombre() ?>";
		cn = "";

		if ($("#mytextsignature").val() == "") {
			cn = x;
		}else{
			cn = $("#mytextsignature").val()
		}

		var URL = "/suscriptores_contactos_direccion/upload/"+idf+"/"+cn+"/";
		$.ajax({
			type: "POST",
			url: URL,
			success:function(msg){
				result = msg;
				alert(result);
				window.location.reload();
			}
		});
	}

</script>