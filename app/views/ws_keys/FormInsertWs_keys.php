<?
	global $c;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form id='formws_keys' method='POST'> 
			<h2>Registrar una nueva Key Para Servicio <?= $c->Ayuda('246') ?></h2>
			<div class="row m-t-20">
			 	<div>
					<b>Tipo de Key: <?= $c->Ayuda('247') ?></b>
				</div>
				<div>
					<select  placeholder="Tipo de key" important class="form-control important disabled" id="tipokey" name="tipokey" onchange="fntipokey(this.value)">
						<option value="SET">Consulta</option>
						<option value="GET">Registro</option>
						<option value="ADD">Documento</option>
					</select>
				</div>
			</div>
			<div class="row m-t-20">
				<div>
					<b>IP Consumo Key: <?= $c->Ayuda('248') ?></b>
				</div>
				<div>
					<input type='text' class='form-control important' placeholder='Escriba la Ip de donde se consumera el servicio' name='ip' id='ip' maxlength='256' />
			 	</div>
		 	</div>
			<div class="row m-t-20">
				<div>
					<b>Nombre Key: <?= $c->Ayuda('249') ?></b>
				</div>
				<div>
					<input type='text' class='form-control important' placeholder='Escriba un nombre para la Key de Servicio' name='nombre' id='nombre' maxlength='256' />
			 	</div>
		 	</div>
		 	<div class="row classregistro m-t-30">
		 		<h4>Seleccione Como Desea Armar su Web Service <?= $c->Ayuda('250') ?></h4>
		 	</div>
			<div class="row classregistro m-t-30">
				<div>
					<b>Departamento:</b>
				</div>
				<div>
					<select  placeholder="departamento" name="departamento" id="departamento" class=' form-control disabled' disabled="disabled"><option value="">Seleccione un Departamento</option></select>
				</div>
			</div>
			<div class="row classregistro m-t-30">
				<div>
					<b>Ciudad:</b>
				</div>
				<div>
					<select  placeholder="ciudad" name="ciudad" id="ciudad" class=' form-control disabled' disabled="disabled"><option value="">Seleccione una Ciudad</option></select>
				</div>
			</div>
			<div class="row classregistro m-t-30">
				<div>
					<b>Oficina:</b>
				</div>
				<div>
					<select placeholder="Oficina" name="oficina" id="oficina" class=' form-control disabled' disabled="disabled"><option value="">Seleccione una Oficina</option></select>
				</div>
			</div>
			<div class="row classregistro m-t-30">
				<div>
					<b><?= CAMPOAREADETRABAJO; ?></b>
				</div>
				<div>
					<select placeholder="<?= CAMPOAREADETRABAJO; ?>" name="dependencia_destino" id="dependencia_destino" class=' form-control disabled' disabled="disabled" ><option value="">Seleccione un <?= CAMPOAREADETRABAJO; ?></option></select>
					<input class="form-control" type='text' name='areatemp' id='areatemp' maxlength='100' style="display:none" />
				</div>
			</div>
			<div class="row classregistro m-t-30">
				<div>
					<b>Usuario Responsable</b>
				</div>
				<div>
					<select  placeholder="Usuario Destino" disabled="disabled" name="nombre_destino" id="nombre_destino" class=' form-control disabled'><option value="">Seleccione un Usuario de Destino</option></select>
				</div>
			</div>
			<div class="row classregistro m-t-30">
				<div>
					<b>Serie / Tipo de Documento (Principal)</b>
				</div>
				<div>
					<select  placeholder="Serie Documental" class="form-control disabled" id="id_dependencia_raiz" name="id_dependencia_raiz"  disabled="disabled">
						<option value="">Seleccione una Serie</option>
						<?php
							$s = new MDependencias;
							$q = $s->ListarDependencias(" where dependencia = '0' and id_version = '".$_SESSION['id_trd_empresa']."'");
							while ($row = $con->FetchAssoc($q)) {
								echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
							}
						?>
					</select>
					<input class="form-control" type='hidden' name='depratemp' id='depratemp' maxlength='100' />
				</div>
			</div>
			<div class="row classregistro m-t-30">
				<div>
					<b>Sub-Serie / Tipo de Documento (Especifico)</b>
				</div>
				<div>
					<select  placeholder="Sub Serie Documental" class="form-control disabled" id="tipo_documento" name="tipo_documento" disabled="disabled">
						<option value="">Seleccione una Sub-Serie</option></select>
				</div>
			</div>
			<div class="row classregistro m-t-30">
				<div>
					<b>Formulario</b>
				</div>
				<div>
					<select  placeholder="Formulario" class="form-control disabled" id="id_formulario" name="id_formulario"  disabled="disabled">
						<option value="0">Seleccione un Formulario</option>
					</select>
				</div>
			</div>
			<button type="button" class="btn btn-primary btn-lg m-t-30" onClick="InsertarKey()"><span class="fa fa-plus"></span> Crear Key de Servicio Web</button>
				<?php
						$cy = new MCity;
						$cy->CreateCity("code", $_SESSION['ciudad']);
				?>
				<input type='hidden' id='mydpto' value="<?= $cy->GetProvince() ?>" />
				<input type='hidden' id='mycity' value="<?= $cy->GetCode() ?>" />

		</form>
		<div id="dump"></div>

	</div>
</div>	
<script type="text/javascript">

$(document).ready(function() {
	dependencia_estadoinExistence('departamento');
	$("#departamento").change(function(){
		dependencia_ciudadinExistence("departamento","ciudad");
	});
	$("#ciudad").change(function(){
		dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");
//			$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3));
		setTimeout(function(){
			if($("#oficina").val() != "" && $("#oficina").val()  != "Seleccione una Oficina"){
				$("#oficina").change();
			}
		}, 1000);
	});
	$("#oficina").change(function(){
		dependencia_item("oficina","dependencia_destino", "/usuarios/ListadoAreasOficinaNew");
//			$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3)+"-"+zeroFill($("#oficina").val(), 3));
		setTimeout(function(){
			if($("#dependencia_destino").val() != "" && $("#dependencia_destino").val()  != "Seleccione un Area de Trabajo"){
				$("#dependencia_destino").change();
			}
		}, 1000);
	});
	setTimeout(function(){
		$("#departamento option[value="+ $("#mydpto").val() +"]").attr("selected",true);
	}, 1000);
	setTimeout(function(){
		dependencia_ciudadinExistence("departamento","ciudad");
	}, 2000);
	setTimeout(function(){
		$("#ciudad option[value="+ $("#mycity").val() +"]").attr("selected",true);
		dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");
	//	$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3));
		$("body").css("cursor", "default");
		setTimeout(function(){
			if($("#oficina").val() != "" && $("#oficina").val()  != "Seleccione una Oficina"){
				$("#oficina").change();
			}
		}, 1000);
	}, 3000);
	$("#dependencia_destino").change(function(){
		dependencia_item("dependencia_destino","nombre_destino", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());

        dependencia_item('dependencia_destino','id_dependencia_raiz','/areas_dependencias/GetSeriesArea/');
        setTimeout(function(){
			if($("#id_dependencia_raiz").val() != "" && $("#id_dependencia_raiz").val()  != "Seleccione una Serie"){
				$("#id_dependencia_raiz").change();
			}
		}, 1000);
	});
	$("#id_dependencia_raiz").change(function(){
		//GetId_c($("#id_dependencia_raiz").val());
		dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/');
		setTimeout(function(){
			if($("#tipo_documento").val() != "" && $("#tipo_documento").val()  != "Seleccione una Sub-Serie"){
				$("#tipo_documento").change();
			}
		}, 1000);
	});
	$("#tipo_documento").change(function(){
		setTimeout(function(){
		dependencia_item2('tipo_documento', 'tipo_documento','id_formulario', '/gestion/ConsultarFormularioSubSeries');
		}, 1000);

	});
});

function fntipokey(obje){
	$('.classregistro').hide();
	if($('#tipokey').val() == 'GET'){
		$('.classregistro').show();
	}
}
</script>
<style type="text/css">
	.classregistro{
		display:none;
	}
</style>