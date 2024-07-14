
<h2>Formulario de Registro de <?= SUSCRIPTORCAMPONOMBRE ?></h2>
<form id="formxdata">      
	<div class="row">
		<div class="col-md-8">
   			<input type="text" class="form-control" id="dtform" name="dtform" placeholder='Escriba el Nombre o el Número de Identificación de  <?= SUSCRIPTORCAMPONOMBRE ?>'>
   			<input type="hidden" id="truedata" name="truedata" />           
   			<div id='bloquebusqueda'></div>           
		</div>
		<div class="col-md-4">
		   <select class="form-control" name='type' id='type'>
				<option value="0"> <?= SUSCRIPTORCAMPONOMBRE ?> solo puede Consultar</option>
				<option value="1"> <?= SUSCRIPTORCAMPONOMBRE ?> puede Interactuar</option>
			</select>
		</div>
	</div>
</form>      
<form id='formgestion_suscriptores' action='/gestion_suscriptores/registrar/' method='POST'> 
	<input type='hidden' class='form-control' value="<?= $g->GetId() ?>"placeholder='Id_gestion' name='id_gestion' id='id_gestion' maxlength='10' />
	<input type='hidden' class='form-control' value="<?= date("Y-m-d") ?>"placeholder='Fecha' name='fecha' id='fecha' maxlength='' />
	<input type='hidden' class='form-control' value="<?= $_SESSION['usuario'] ?>"placeholder='Usuario_id' name='usuario_id' id='usuario_id' maxlength='50' />
	<input type='hidden' class='form-control' value="1"placeholder='Estado' name='estado' id='estado' maxlength='1' />
	<input type='hidden' class='form-control' placeholder='Estado' name='id_suscriptor' id='id_suscriptor' maxlength='1' />
	<input type="hidden" class="form-control" id="dtform" name="dtform" placeholder='Escriba el Nombre o el Número de Identificación del Suscriptor'>
	<div id='datasuscriptor'></div>
	<div id="datasuscriptor2" style="display:none">
		<div class="row m-t-10">
			<div class="col-md-4 hideform"><input class="form-control" type="text" placeholder="<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>" id="Identificacion_suscriptor" name="Identificacion_suscriptor"></div>
			<div class="col-md-4 hideform">
				<select class="form-control" name="Type_suscriptor22" id="Type_suscriptor22">
					<option value="">Tipo de <?= SUSCRIPTORCAMPONOMBRE ?></option>
					<?
						global $con;
						global $c;
						global $f;
						
						$lx = new MSuscriptores_tipos;
						$query_eg = $lx->ListarSuscriptores_tipos(); 
						while($row_type = $con->FetchAssoc($query_eg)){
							echo "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
						}
					?>
					<option value="OTRO">OTRO</option>
				</select>
				<input class="form-control" type="hidden" placeholder="Tipo de  <?= SUSCRIPTORCAMPONOMBRE ?>" id="Type_suscriptor2" name="Type_suscriptor2">
				<div id='bloquebusquedasuscriptor'></div>   
				<input type="text" class="form-control" style="display:none"  placeholder="Tipo de  <?= SUSCRIPTORCAMPONOMBRE ?>" name="Type_suscriptor" id="Type_suscriptor" value="">
			</div>
			<div class="col-md-4 hideform"><input class="form-control" type="text" placeholder="<?= SUSCRIPTORCAMPODIRECCION; ?>" id="Direccion_suscriptor" name="Direccion_suscriptor"></div>
		</div>
		<div class="row m-t-10">
			<div class="col-md-4 hideform"><input class="form-control" type="text" placeholder="Ciudad" id="Ciudad_suscriptor" name="Ciudad_suscriptor"></div>
			<div class="col-md-4 hideform"><input class="form-control" type="text" placeholder="Telefonos" id="Telefonos_suscriptor" name="Telefonos_suscriptor"></div>
			<div class="col-md-4 hideform"><input class="form-control" type="text" placeholder="E-mail" id="Email_suscriptor" name="Email_suscriptor"></div>
		</div>
	</div>
	<div class="row m-b-20 m-t-10">
		<div class="col-md-12">
			<input type='button' value='Guardar <?= SUSCRIPTORCAMPONOMBRE ?>' onClick="InsertSuscriptor('<?= $g->GetId() ?>')" class="btn btn-info pull-right"/>
		</div>
	</div>
</form>

<script type="text/javascript">
	$("#Type_suscriptor22").on("change", function(){
		if($(this).val() == 'OTRO'){
			$('#Type_suscriptor').val('');
			$('#Type_suscriptor').show();
			$('#Type_suscriptor22').hide();
		}else{
			$('#Type_suscriptor').val($(this).val());
			$('#Type_suscriptor').hide();
		}			
	});

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
	})

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
		$.ajax({
			type: "POST",
			dataType: "json",
			url: '/suscriptores_contactos/buscarsuscriptor/'+id+"/",
			success: function(msg){
				result = msg;
				//alert(msg["a"])
				if(msg["a"] == "vacio"){
					$("#datasuscriptor2").slideDown();
				}else{
					result = msg["a"];
					$("#datasuscriptor").html(result);
				}
			}
		});				
		$("#id_suscriptor").val(id);
		$("#formgestion_suscriptores #dtform").val(nombre);

		$("#dtform").val(nombre);
		$("#bloquebusqueda").fadeOut();		
	}

	function Hideform(){
		$("#bloquebusqueda").fadeOut();		
		$("#id_suscriptor").val("");
		$("#datasuscriptor").html("");					
	}
</script>