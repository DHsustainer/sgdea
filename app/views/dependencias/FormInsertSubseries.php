<?
	global $c;
	$total_activos = $c->GetTotalFromTable("dependencias", "WHERE dependencia != '0' and id_version = '".$_SESSION['id_trd']."'");
	$cupos_totales = 0;
	
	if ($_SESSION['MODULES']['total_subseries'] == "0") {
		$cupos_totales = 9999; 	
	}else{
		$cupos_totales = $_SESSION['MODULES']['total_subseries'];
	}
?>	
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>
<div class="row">
	<div class="col-md-6 bg-success text-white bold p-10" <?= $c->Ayuda('267', 'tog') ?> >Sub-Series Registradas: <?= $total_activos; ?></div>
	<div class="col-md-6 bg-danger text-white bold p-10" <?= $c->Ayuda('268', 'tog') ?>>Sub-Series Totales: <?= $cupos_totales; ?></div>
</div>	
<?
		if ($cupos_totales > $total_activos) {

			$raiz = new MDependencias;
			$raiz->CreateDependencias("id", $id_dependencia);
?>
	<h2>Crear una Sub Serie documental en la serie <?=  $raiz->GetNombre(); ?>  <?= $c->Ayuda('269') ?></h2>
	<form id='formsubdependencias' action='/dependencias/registrar/' method='POST'> 
		<input type='hidden' name='dependencia' id='dependencia_raiza' value="<?= $id_dependencia; ?>" />
		<input type='hidden' name='usuario' id='usuario' value="<?= $_SESSION['usuario'] ?>" />
		<input type='hidden' name='fecha' id='fecha' value="<?= date("Y-m-d") ?>" />
		<input type='hidden' name='estado' id='estado' value="1" />
		<input type='hidden' name='id' id='id' value="<?= $id ?>" />
		<input type="hidden" name="subserie_id" id="subserie_id" value="N">

			
		<div class="row m-t-30">
			<div class="col-md-8">
				<input type='text'  <?= $c->Ayuda('270', 'tog') ?> class="form-control important" name='nombre' id='nombre_subserie' maxlength='60' placeholder ="Nombre"/>
			</div>
			<div class="col-md-4">
				<input type='text' <?= $c->Ayuda('271', 'tog') ?> class="form-control" name='id_c' id='id_c' maxlength=''  placeholder ="Código"/>
			</div>
			<div class="col-md-12">
				<div id='bloquebusquedasubserie' class="list-group mini_listado_boot scrollable"></div>
			</div>
		</div>
		<div class="row m-t-10">
			<div class="col-md-4">
				<select placeholder="A. Gestión" <?= $c->Ayuda('272', 'tog') ?>  class="form-control" name='t_g' id='t_g' style="width:110px">
					<option value="0">A. Gestión</option>		<option value="15">15 Días</option>			<option value="30">1 Mes</option>
					<option value="90">3 Meses</option>			<option value="180">6 Meses</option>		<option value="270">9 Meses</option>
					<option value="365">1 Año(s)</option>		<option value="730">2 Año(s)</option>		<option value="1095">3 Año(s)</option>
					<option value="1460">4 Año(s)</option>		<option value="1825">5 Año(s)</option>		<option value="2190">6 Año(s)</option>
					<option value="2555">7 Año(s)</option>		<option value="2990">8 Año(s)</option>		<option value="3650">10 Año(s)</option>
					<option value="4380">12 Año(s)</option>		<option value="5475">15 Año(s)</option>		<option value="7300">20 Año(s)</option>
					<option value="9125">25 Año(s)</option>		<option value="10950">30 Año(s)</option>	<option value="12775">35 Año(s)</option>
					<option value="14600">40 Año(s)</option>	<option value="16425">45 Año(s)</option>	<option value="18250">50 Año(s)</option>
					<option value="21900">60 Año(s)</option>	<option value="25550">70 Año(s)</option>	<option value="29200">80 Año(s)</option>
				</select>
			</div>
			<div class="col-md-4">
				<select placeholder="A. Central" <?= $c->Ayuda('273', 'tog') ?> class="form-control" name='t_c' id='t_c' style="width:110px">
					<option value="0">A. Central</option>		<option value="15">15 Días</option>			<option value="30">1 Mes</option>
					<option value="90">3 Meses</option>			<option value="180">6 Meses</option>		<option value="270">9 Meses</option>
					<option value="365">1 Año(s)</option>		<option value="730">2 Año(s)</option>		<option value="1095">3 Año(s)</option>
					<option value="1460">4 Año(s)</option>		<option value="1825">5 Año(s)</option>		<option value="2190">6 Año(s)</option>
					<option value="2555">7 Año(s)</option>		<option value="2990">8 Año(s)</option>		<option value="3650">10 Año(s)</option>
					<option value="4380">12 Año(s)</option>		<option value="5475">15 Año(s)</option>		<option value="7300">20 Año(s)</option>
					<option value="9125">25 Año(s)</option>		<option value="10950">30 Año(s)</option>	<option value="12775">35 Año(s)</option>
					<option value="14600">40 Año(s)</option>	<option value="16425">45 Año(s)</option>	<option value="18250">50 Año(s)</option>
					<option value="21900">60 Año(s)</option>	<option value="25550">70 Año(s)</option>	<option value="29200">80 Año(s)</option>
				</select>
			</div>
			<div class="col-md-4">
				<select placeholder="A. Histórico" class="form-control" <?= $c->Ayuda('274', 'tog') ?> name='t_h' id='t_h' style="width:110px">
					<option value="0">Unidad de Conservación</option> 	<option value="-2">Conservación Total</option>
					<option value="-1">Eliminación</option>				<option value="-3">Digitalización</option>
					<option value="-4">Selección</option>				<option value="-5">MicroFilmación</option>
					<option value="-6">Hibrido</option>					<option value="-7">Digitalizar y Eliminar</option>
					<option value="-8">Seleccionar y Eliminar</option>  <option value="-9">Conservación Total y Digitalización</option>
				</select>
			</div>
			<div class="col-md-12 m-t-10 m-b-10">
				<textarea id="observacion" name="observacion" <?= $c->Ayuda('275', 'tog') ?>  class="form-control height-100" placeholder="Procedimiento"></textarea>
			</div>
			<div class="col-md-8">
				<div class="form-group">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="is_inm" name="is_inm" class="form-control">
                        <label for="is_inm" <?= $c->Ayuda('276', 'tog') ?> >¿Subserie de Inmaterialización?</label>
                    </div>
                </div>
			</div>
			<div class="col-md-4">
				<input type='text' class="form-control" <?= $c->Ayuda('277', 'tog') ?>  name='dias_vencimiento' id='dias_vencimiento' placeholder ="Días Vencimiento" value=""/>
			</div>
		</div>	
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="is_inmx" name="is_inm" class="form-control">
                        <label for="is_inmx" <?= $c->Ayuda('278', 'tog') ?> >¿Soporte Digital?</label><br>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
				<div class="form-group">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="es_publicox" name="es_publico" class="form-control">
                        <label for="es_publicox" <?= $c->Ayuda('279', 'tog') ?> >¿Radicacion publica?</label>
                    </div>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input type='text' style="display:none" class="form-control" name='titulo_publico' id='titulo_publico' placeholder ="Título de Consulta Publica" />
			</div>
		</div>
		<div class="row m-t-20 m-b-20">
			<div class="col-md-12">
				<input type='button' class="btn btn-info" value='Crear Sub Serie' onClick="InsertSubserie('formsubdependencias')"/>
			</div>
		</div>
	</form>
		<?
		}else{
			echo '<div class="alert alert-info">No tienes cupos disponibles</div><br>';
		}
?>
<script>
/*
	$("#nombre_subserie").on("keyup", function(){
		$("#bloquebusquedasubserie").fadeIn();	

		$.ajax({
			type: "POST",
			url: '/dependencias/buscar/'+$(this).val()+"/"+$("#dependencia_raiza").val()+"/"+$("#id").val()+"/",
			success: function(msg){
				result = msg;
				$("#bloquebusquedasubserie").html(result);					
			}
		});				
	});

	function onTecla(e){	
		var num = e?e.keyCode:event.keyCode;
		if (num == 9 || num == 27){
			$("#bloquebusquedasubserie").fadeOut();
		}
	}
	document.onkeydown = onTecla;
	if(document.all){
		document.captureEvents(Event.KEYDOWN);	
	}*/

	function AddSubSerieToList(id, nombre, form){
		$.ajax({
			type: "POST",
			dataType: "json",
		  	url: '/dependencias/buscarJsdependencia/'+id+"/",
		  	success: function(msg){
				
				$("#"+form+" #id_c").val(msg["id_c"]);
				$("#"+form+" #subserie_id").val(msg["subserie_id"]);
				$("#"+form+" #t_g").val(msg["t_g"]);
				$("#"+form+" #t_c").val(msg["t_c"]);
				$("#"+form+" #t_h").val(msg["t_h"]);
				$("#"+form+" #observacion").val(msg["observacion"]);

				if (msg["is_inm"] == "1") {
					$("#"+form+" #is_inm").checked(true);
				};
		  	}
		});
		$("#"+form+" #serie_id").val(id);
		$("#"+form+" #nombre_subserie").val(nombre);
		$("#"+form+" #bloquebusquedasubserie").fadeOut();
	}

	$("#es_publicox").change(function(){

		if ($("#es_publicox").is(" :checked")) {
			$("#titulo_publico").css("display", "block");
		}else{
			$("#titulo_publico").css("display", "none");
		}

	})
</script>