<?
global $c;
$total_activos = $c->GetTotalFromTable("dependencias", "WHERE dependencia = '0' and id_version = '".$_SESSION['id_trd']."'");
$cupos_totales = 0;
if ($_SESSION['MODULES']['total_series'] == "0") {
	$cupos_totales = 9999; 	
}else{
	$cupos_totales = $_SESSION['MODULES']['total_series'];
}
?>	
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>
	<div class="row">
		<div class="col-md-6 bg-success text-white bold p-10" <?= $c->Ayuda("251", "tog") ?>>Series Registradas: <?= $total_activos; ?></div>
		<div class="col-md-6 bg-danger text-white bold p-10" <?= $c->Ayuda("252", "tog") ?>>Series Totales: <?= $cupos_totales; ?></div>
	</div>	
<?
if ($cupos_totales > $total_activos) {
?>
	<h2 class="m-t-20">Crear una Serie documental <?= $c->Ayuda("253") ?></h2>
	<form id='formdependencias' action='/dependencias/registrar/' method='POST'> 
		<input type="hidden" name="serie_id" id="serie_id" value="N">
		<input type='hidden' name='id' id='id' value="<?= $id ?>"/>
		<input type='hidden' name='dependencia' id='dependencia' value="<?= $id_dependencia; ?>" />
		<input type='hidden' name='usuario' id='usuario' value="<?= $_SESSION['usuario'] ?>" />
		<input type='hidden' name='fecha' id='fecha' value="<?= date("Y-m-d") ?>" />
		<input type='hidden' name='estado' id='estado' value="1" />			

		<div class="row m-t-30">
			<div class="col-md-8">
				<input type='text' <?= $c->Ayuda("254", "tog") ?> class="form-control important" name='nombre' id='nombre_Serie' placeholder ="Nombre"/>
			</div>
			<div class="col-md-4">
				<input type='text' <?= $c->Ayuda("255", "tog") ?> class="form-control" name='id_c' id='id_c' maxlength=''  placeholder ="Código"/>
			</div>
			<div class="col-md-12">
				<div id='bloquebusqueda' class="list-group mini_listado_boot scrollable"></div>           
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" name="no_s" id="no_s" class="form-control">
                        <label for="no_s" <?= $c->Ayuda("256", "tog") ?>> Selecciona esta Opción si la Serie es Simple </label>
                    </div>
                </div>
			</div>
		</div>
		<div class="row m-t-10" style="display:none" id="detaildependencias">
			<div class="col-md-4">
				<select placeholder="A. Gestión" class="form-control" <?= $c->Ayuda("257", "tog") ?> name='t_g' id='t_g' style="width:110px">
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
				<select placeholder="A. Central" class="form-control" <?= $c->Ayuda("258", "tog") ?> name='t_c' id='t_c' style="width:110px">
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
				<select placeholder="A. Histórico" class="form-control" <?= $c->Ayuda("259", "tog") ?> name='t_h' id='t_h' style="width:110px">
					<option value="0">Unidad de Conservación</option> 	<option value="-2">Conservación Total</option>
					<option value="-1">Eliminación</option>				<option value="-3">Digitalización</option>
					<option value="-4">Selección</option>				<option value="-5">MicroFilmación</option>
					<option value="-6">Hibrido</option>					<option value="-7">Digitalizar y Eliminar</option>
					<option value="-8">Seleccionar y Eliminar</option>  <option value="-9">Conservación Total y Digitalización</option>
				</select>
			</div>
			<div class="col-md-12 m-t-10 m-b-10">
				<textarea id="observacion" name="observacion" <?= $c->Ayuda("260", "tog") ?> class="form-control height-100" placeholder="Procedimiento"></textarea>
			</div>
			<div class="col-md-6">
				<div class="form-group">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="is_inm" name="is_inm" class="form-control">
                        <label for="is_inm" <?= $c->Ayuda("261", "tog") ?>>¿Subserie de Inmaterialización?</label>
                    </div>
                </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
                    <div class="checkbox checkbox-success">
                        <input type="checkbox" id="es_publicoy" name="es_publico">
                        <label for="es_publicoy" <?= $c->Ayuda("262", "tog") ?>>¿Ventanilla de Radicacion publica?</label>
                    </div>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input type='button' class="btn btn-info" value='Crear Serie' onClick="InsertSerie('formdependencias')"/>
			</div>
		</div>
	</form>
<?
}else{
	echo '<div class="alert alert-info">No tienes cupos disponibles</div><br>';
}
?>
<script>
	$(document).ready(function(){
		$("#no_s").click(function () {	 
			if ($('#no_s').is(':checked') ) {
				$("#detaildependencias").slideDown();
			}else{
				$("#detaildependencias").slideUp();
			}
		});
	});
/*

	$("#nombre_Serie").on("keyup", function(){
		$("#bloquebusqueda").fadeIn();				
		$.ajax({
			type: "POST",
			url: '/dependencias/buscar/'+$(this).val()+"/0/",
			success: function(msg){
				result = msg;
				$("#bloquebusqueda").html(result);					
			}
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
	}*/

	function AddSerieToList(id, nombre, form){

		$.ajax({
			type: "POST",
			dataType: "json",
		  	url: '/dependencias/buscarJsdependencia/'+id+"/",
		  	success: function(msg){
				
				$("#"+form+" #id_c").val(msg["id_c"]);
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
		$("#"+form+" #nombre_Serie").val(nombre);
		$("#"+form+" #id_c").val(id_c);
		$("#bloquebusqueda").fadeOut();		
	}
</script>