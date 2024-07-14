<?
	global $c;
	$total_activos = $c->GetTotalFromTable("areas");
	$cupos_totales = 0;
	if ($_SESSION['MODULES']['total_areas'] == "0") {
		$cupos_totales = 9999; 	
	}else{
		$cupos_totales = $_SESSION['MODULES']['total_areas'];
	}
?>	
<h4><b>Creación de <?= CAMPOAREADETRABAJO; ?></b></h4>
<div class="row">
	<div class="col-md-6 bg-success text-white bold p-10" <?= $c->Ayuda('137', 'tog') ?>>Areas Registradas: <?= $total_activos; ?></div>
	<div class="col-md-6 bg-danger text-white bold p-10" <?= $c->Ayuda('138', 'tog') ?>>Areas Totales: <?= $cupos_totales; ?></div>
</div>
	
<?
	if ($cupos_totales > $total_activos) {
?>
	<form id='formareas' action='/areas/registrar/' method='POST'> 
		<input type='hidden'  name='user_id' id='user_id' maxlength='100' value="<?= $_SESSION['usuario'] ?>" />
		<div class="row m-t-30">
			<div class="col-md-6">
				<div class="col-md-12">
					<label for="nombre">Nombre de <?= CAMPOAREADETRABAJO; ?></label>
					<input type='text' class="form-control important" placeholder="" name='nombre' id='nombre' maxlength='100'  />
				</div>
				<div class="col-md-12 m-t-30">
					<label for="prefijo">Código Interno de <?=  CAMPOAREADETRABAJO?></label>
					<input type="text" class="form-control" name="prefijo" id="prefijo" maxlength="">
				</div>
			</div>
			<div class="col-md-6">
				<label for="nombre"><?= CAMPOSEDES ?> En la que se va a Registrar</label>
				<div class="multiselect">

					<?
						echo '<label><input type="checkbox" name="oficina[]" value="0" /> Global (Se creará para todas las areas)</label>';
						$lciudades = $con->Query("SELECT * FROM seccional_principal");
						while ($row = $con->FetchAssoc($lciudades)) {
							echo '<spam class="text-muted"><b>'.$row['nombre'].'</b></spam>';

							$loficinas = $con->Query("SELECT * FROM seccional where principal = '".$row['id']."'");
							while ($rox = $con->FetchAssoc($loficinas)) {
								echo '<label><input type="checkbox" name="oficina[]" value="'.$rox['id'].'" /> '.$rox['nombre'].'</label>';
							}
						}
					?>
				</div>
			</div>
		</div>
		<div class="row m-t-30">
			<div class="col-md-8">
				<input type='button' class="btn btn-info" value='Crear <?= CAMPOAREADETRABAJO; ?>' onClick="InsertArea()"/>
			</div>
		</div>
	</form>
<?
	}else{
		echo '	<div class="row">
					<div class="col-md-12">
						<div class="alert alert-info">No tienes cupos disponibles</div>
					</div>
				</div>';
	}
?>
<script type="text/javascript">
jQuery.fn.multiselect = function() {
    $(this).each(function() {
        var checkboxes = $(this).find("input:checkbox");
        checkboxes.each(function() {
            var checkbox = $(this);
            // Highlight pre-selected checkboxes
            if (checkbox.prop("checked"))
                checkbox.parent().addClass("multiselect-on");
 
            // Highlight checkboxes that the user selects
            checkbox.click(function() {
                if (checkbox.prop("checked"))
                    checkbox.parent().addClass("multiselect-on");
                else
                    checkbox.parent().removeClass("multiselect-on");
            });
        });
    });
};
$(function() {
     $(".multiselect").multiselect();
});
</script>