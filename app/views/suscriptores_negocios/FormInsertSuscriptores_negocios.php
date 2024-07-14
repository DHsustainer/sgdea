<form id='formsuscriptores_negocios' action='/suscriptores_negocios/registrar/' method='POST'> 
	<h3>Crear Negocio</h3>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="nombre">Nombre del Suscriptor</label>
				<input type="text" id="dtform" name="dtform" placeholder='Nombre o <?= SUSCRIPTORCAMPOIDENTIFICACION; ?> del <?= SUSCRIPTORCAMPONOMBRE; ?>' style="height:35px;" class='input1_0 form-control important'>
				    <div id='bloquebusqueda'></div>           
					<input type="hidden"  name="suscriptor_id" id="suscriptor_id" value="N">

			</div>
		</div>
	</div>
	<div class="row hideform">
		<div class="col-md-12 hideform">
			<label for="nombre">Datos del Suscriptor</label>
		</div>
		<div class="col-md-6 hideform">
			<input class="form-control" type="text" placeholder="<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>" id="Identificacion_suscriptor" name="Identificacion_suscriptor"></div>
		<div class="col-md-6 hideform">
			<select class="form-control"  placeholder="Tipo de Suscriptor" style="height:35px;" name="Type_suscriptor22" id="Type_suscriptor22">
				<option value="">Tipo de Suscriptor</option>
				<?
					$query_eg = $con->Query("SELECT type from suscriptores_contactos where type <> '' group by type order by type ");   
					while($row_type = $con->FetchAssoc($query_eg)){
						echo "<option value='".$row_type['type']."'>".$row_type['type']."</option>";
					}
				?>
				<option value="OTRO">OTRO</option>
			</select>
			<input class="form-control" type="hidden" placeholder="Tipo de Suscriptor" id="Type_suscriptor2" name="Type_suscriptor2">
			<div id='bloquebusquedasuscriptor'></div>   
			<input type="text" class="form-control" style="display:none"  placeholder="Tipo de Suscriptor" name="Type_suscriptor" id="Type_suscriptor" value="">
		</div>
		<div class="col-md-6 hideform"><input class="form-control" type="text" placeholder="E-mail" id="Email_suscriptor" name="Email_suscriptor"></div>
		<div class="col-md-6 hideform"><input class="form-control" type="text" placeholder="<?= SUSCRIPTORCAMPODIRECCION; ?>" id="Direccion_suscriptor" name="Direccion_suscriptor"></div>
		<div class="col-md-6 hideform"><input class="form-control" type="text" placeholder="Ciudad" id="Ciudad_suscriptor" name="Ciudad_suscriptor"></div>
		<div class="col-md-6 hideform"><input class="form-control" type="text" placeholder="Telefonos" id="Telefonos_suscriptor" name="Telefonos_suscriptor"></div>
		<div class="col-md-12 hideform">
			<br>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="id_proyecto_main">Seleccione un Proyecto</label>
				<select name="id_proyecto_main" id="id_proyecto_main" class="input1_0 form-control important" style="height:35px" onChange="dependencia_item('id_proyecto_main', 'id_negocio', '/suscriptores_paquetes_negocios/listarnegocios/')">
					<option value="0">Seleccione un Proyecto</option>
					<?
						$tp = new MSuscriptores_tipos_proyectos;
						$q = $tp->ListarSuscriptores_tipos_proyectos();

						while ($row = $con->FetchAssoc($q)) {
							$selected = ($proyecto == $row['id'])?"selected='selected'":"";
							echo "<option value='".$row['id']."' ".$selected.">".$row['nombre']."</option>";
						}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="id_negocio">Seleccione un Negocio</label><br>
				<select name="id_negocio" id="id_negocio" class="input1_0 form-control important" style="height:35px" disabled="disabled">
					<option value="0">Seleccione un Negocio</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="nombre">Codigo del Negocio</label>
				<input type='text' class='form-control' value='<?= strtoupper($f->randomText(6)) ?>' name='codigo' id='codigo' maxlength='6' />
			</div>
		</div>
	</div>
	<input type='submit' value='Insertar'  style='margin:10px;'/>
</form>

<script>
	$(document).ready(function(){
		$("#dtform").on("keyup", function(){
			$("#bloquebusqueda").fadeIn();				
			$.ajax({
				type: "POST",
				url: '/suscriptores_contactos/buscar/'+$(this).val()+"/",
				success: function(msg){
					result = msg;
					$("#bloquebusqueda").html(result);					
				}
			});				
		});
	});
	function onTecla(e){	
		var num = e?e.keyCode:event.keyCode;
		if (num == 9 || num == 27){
			$("#bloquebusqueda").fadeOut();		
		}
	}
	document.onkeydown = onTecla;
	if(document.all){
		document.captureEvents(Event.KEYDOWN);	
	}

	function AddSuscriptor(id, nombre){
		$(".hideform").slideDown("fast");
		
		$.ajax({
			type: "POST",
			dataType: "json",
		  	url: '/suscriptores_contactos/buscarJsuscriptor/'+id+"/",
		  	success: function(msg){
		  		$("#Identificacion_suscriptor").val(msg["Identificacion_suscriptor"]);
				$("#Type_suscriptor").val(msg["Type_suscriptor"]);
				$("#Type_suscriptor2").val(msg["Type_suscriptor"]);
				$("#Direccion_suscriptor").val(msg["Direccion_suscriptor"]);
				$("#Ciudad_suscriptor").val(msg["Ciudad_suscriptor"]);
				$("#Telefonos_suscriptor").val(msg["Telefonos_suscriptor"]);
				$("#Email_suscriptor").val(msg["Email_suscriptor"]);

				$('#Type_suscriptor').show();
				$("#Type_suscriptor22").css("display", "none");
		  	}
		});	
		$("#suscriptor_id").val(id);
		$("#dtform").val(nombre);
		$("#nombre_radica").val(nombre);
		$("#bloquebusqueda").fadeOut();		
	}
	function Hideform(){
		$("#bloquebusqueda").fadeOut();
		$("#id_suscriptor").val("");
		$("#datasuscriptor").html("");					
	}
	$("#Type_suscriptor2").on("keyup", function(){
		$("#bloquebusquedasuscriptor").fadeIn();				
		$.ajax({
			type: "POST",
			url: '/suscriptores_contactos/buscarsuscriptortipo/'+$(this).val()+"/",
			success: function(msg){
				result = msg;
				$("#bloquebusquedasuscriptor").html(result);					
			}
		});				
	});
	$("#Type_suscriptor22").on("change", function(){
		if($(this).val() == 'OTRO'){
			$('#Type_suscriptor').val('');
			$('#Type_suscriptor').show();
		}else{
			$('#Type_suscriptor').val($(this).val());
			$('#Type_suscriptor').hide();
		}			
	});
	function AddSuscriptorTipo(typo){
		$("#Type_suscriptor2").val(typo);
		$("#Type_suscriptor").val(typo);
		$("#bloquebusquedasuscriptor").fadeOut();		
	}
</script>
<style>
	.hideform{
		display: none;
	}

</style>