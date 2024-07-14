<?
global $c;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>
<form id='formsuscriptores_contactos' method='POST'> 


	<div class="row">
		<div class="col-md-6">
			<select class="input1_0  form-control important" <?= $c->Ayuda('193', 'tog') ?> placeholder="Tipo de <?= SUSCRIPTORCAMPONOMBRE ?>" name="Type_suscriptor22" id="Type_suscriptor22" maxlength='200'>
				<option value="">Tipo de <?= SUSCRIPTORCAMPONOMBRE ?></option>
				<?
					$lx = new MSuscriptores_tipos;
					$query_eg = $lx->ListarSuscriptores_tipos(); 
					while($row_type = $con->FetchAssoc($query_eg)){
						echo "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
					}

				?>
				<option value="OTRO">OTRO</option>
			</select>
		</div>
		<div class="col-md-6">
			<select class="input1_0 select2_1 form-control" <?= $c->Ayuda('194', 'tog') ?>  name="dependencia" id="dependencia" maxlength='200'>
				<option value=""><?= SUSCRIPTORCAMPONOMBRE ?> Principal</option>
				<?
					$lx = new MSuscriptores_contactos;
					$query_eg = $lx->ListarSuscriptores_contactos(); 
					while($row_type = $con->FetchAssoc($query_eg)){
						echo "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
					}

				?>
				<option value="OTRO">OTRO</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<input type='text' class="form-control important" name='nombre' placeholder="<?= SUSCRIPTORCAMPONOMBRE; ?>" id='nombre' maxlength='200' />
		</div>
		<div class="col-md-6">
			<input type='text' class="form-control important" name='identificacion' placeholder="<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>" id='identificacion' maxlength='15' />
		</div>
	</div>
	<div class="row m-t-10">	
		<div class="col-md-6">
			<input type='text' class="form-control important" name='email' placeholder="Direccion de correo electrónico" id='email' maxlength='200' />
		</div>
		<div class="col-md-6">
			<input class="form-control" type='text' name='telefonos' id='form_telefonos' maxlength='' placeholder="Telefonos" />
		</div>
	</div>
	<div class="row m-t-10">	
		<div class="col-md-6">
			<input class="form-control" type='text' name='direccion' id='form_direccion' maxlength='' placeholder="<?= SUSCRIPTORCAMPODIRECCION ?>"/>
		</div>
		<div class="col-md-6">
			<input class="form-control" type='text' name='ciudad' id='form_ciudad' maxlength='' placeholder="Ciudad"/>
		</div>
		<div class="col-md-12 m-t-10">
			<input type='button'  class="btn btn-info" value='Crear <?= SUSCRIPTORCAMPONOMBRE ?>' onClick="ChecSuscriptoresExists()"/>
		</div>
	</div>
	<br>

	<input type='text' class="form-control" name='type' style="display:none" id='type' maxlength='200' />
	<input type='hidden' class="form-control" name='user_id' id='user_id' maxlength='200' value="<?= $_SESSION['usuario'] ?>" />
	<input type='hidden' class="form-control" name='fecha' id='fecha' maxlength='' value="<?= date('Y-m-d') ?>" />


	



</form>
<script>
$("#Type_suscriptor22").on("change", function(){
		if($(this).val() == 'OTRO'){
			$('#type').val('');
			$('#type').show();
		}else{
			$('#type').val($(this).val());
			$('#type').hide();
		}			
	});

(function($) {
	if ($('.select2_1').length) $(".select2_1").select2();
})(jQuery);
</script>