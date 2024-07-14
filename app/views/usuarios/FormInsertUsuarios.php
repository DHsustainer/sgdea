
    <div class="titulo_box center" style="width:100%">Registrese en carpeta ciudadana</div>

	<form id='formusuarios' action='<?= HOMEDIR.DS.'registro'.DS.'registrar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='registro' />     
    	<input type='hidden' id='action' name='action' value='registrar' />    
		<table id="tabla_login" cellspacing="5" width="100%" border="0" style="width:100%">
			<tr>
				<td align="center" colspan="3">
					<div class="message bold">Registrese ahora en carpetaciudadana y aginice sus tramites ante miles de entidades en el país</div>
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div class="texto_subject">Nombre</div>
					<input type='text' name='nombre' id='nombre' style="width:100%;" maxlength='45' placeholder="Pedro" class="importante" />
				</td>
				<td width="13px">&nbsp;&nbsp;&nbsp;</td>
				<td width="50%">
					<div class="texto_subject">Apellido</div>
					<input type='text' name='apellido' id='apellido' maxlength='45' placeholder="Perez" class="importante" />
				</td>
			</tr>
			<tr>
				<td id="emailwid" >
					<div class="texto_subject">Correo Electronico</div>
					<input type='text' name='email' id='email' maxlength='45' placeholder="sucorreo@ejemplo.com" class="importante" />
				</td>
				<td width="13px">&nbsp;&nbsp;&nbsp;</td>
				<td>
					<div class="texto_subject">Identificacion:</div>
					<input type='text' name='identificacion' id='identificacion' maxlength='15' />
				</td>
			</tr>
			
			<tr>
				<td>
					<div class="texto_subject">Numero Celular</div>
					<input type='text' name='telefono' id='telefono' maxlength='10' placeholder="3150000000" class="importante" />
				</td>
				<td width="13px">&nbsp;&nbsp;&nbsp;</td>
				<td>
					<div class="texto_subject">Ciudad de Residencia</div>
					<input type='text' name='ciudad' id='ciudad' maxlength='45' placeholder="Ciudad donde vives" class="importante" />
				</td>
			</tr>
			
			<tr style="display:none">
				<td colspan="2">
					<div class="texto_subject">Clave</div>
					<input type='text' name='contrasena' id='contrasena' value="CEMPTY" maxlength='45' placeholder="Escriba una clave segura" class="importante" />
				</td>
			</tr>
			<tr>
				<td align='center' colspan="3">
					<input type='submit' class="marginbottom_2" value='Registrarse' id="insertprofile"/>
				</td>
			</tr>
		</table>
	</form>
	</div>
  </div>	
<script type="text/javascript" src="http://www.bichlmeier.info/sha256.js"></script>
<script language='javascript' type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js'></script>
<script>


	$(document).ready(function(){
		//JS CODE HERE
		$('#formusuarios').validate({
			rules 	 : 	{	
				nombre_completo:{
					required:true,
					minlength: 5	
				},				
				email:{
					required:true,
					email: true
				},				
				telefono:{
					required:true,
					minlength: 6	
				},				
				ciudad:{
					required:true,
					minlength: 4	
				},				
				password:{
					required:true,
					minlength: 6	
				}				
			},

			messages : 	{		
				nombre_completo:{
					required:"El Campo Nombre es Obligatorio",
					minlength: "El Campo Nombre Debe un minimo de 5 Caracteres"	
				},				
				email:{
					required:"El Campo E-mail es Obligatorio",
					email: "El Campo E-mail es Obligatorio"
				},				
				telefono:{
					required:"El Campo Telefono es Obligatorio",
					minlength: "El Campo Telefono Debe un minimo de 6 Numeros"	
				},				
				ciudad:{
					required:"El Campo Ciudad es Obligatorio",
					minlength: "El Campo Ciudad Debe un minimo de 4 Caracteres"	
				},				
				password:{
					required:"El Campo Password es Obligatorio",
					minlength: "El Campo Password Debe un minimo de 6 Caracteres"	
				}
			}
	 	}); 

  		$("#email").live("blur", function(){
  			var str = $("#email").val();
			$.ajax({
				type: "POST",
				url: "http://audio.audiocodigosjuridicos.com/registro/checkemailexist/"+str+"/",
				success:function(msg){
					result = msg;
					if(result == "error"){
						$("#emailwid").append('<label for="email" class="error" id="emailerror">La direccion de correo electronico ingresada ya existe</label>');	
						$("#email").val("");		
					}else{
						$("#emailerror").remove();
					}
				}
			});		
  			
  		})
  	})
</script>