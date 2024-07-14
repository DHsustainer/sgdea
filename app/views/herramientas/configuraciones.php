<?
    $object = new MSuper_admin;
    $object->CreateSuper_admin("id", "6");

    $MDependencias_version = new MDependencias_version;
	$MDependencias_version->CreateDependencias_version("id", $object->Getid_version());
?>
<div class="col-md-12">
	<h2>Configuraciones Generales <?= $c->Ayuda('234') ?></h2>
	<div class="col-md-6">	
		<form id="formUpdateUsuario" name="formUpdateUsuario">
			<table id="table_data_user" class="table">
				<td style='display:none;'><input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' /></td>
				<tr>
					<td height='35' width="170px"><strong>Version TRD: <?= $c->Ayuda('231') ?></strong></td>
					<td width="100px" class="input_regular" id="input_p_id_version">
						<select name='p_id_version' id='p_id_version' class="form-control important" style="width: 100%" >
						<?php
							echo "<option value='".$MDependencias_version->GetId()."'>".$MDependencias_version->GetNombre()."</option>";
							$lits = $MDependencias_version->ListarDependencias_version("WHERE estado in (2)");
							while ($row = $con->FetchAssoc($lits)) {
								echo "<option value='".$row['id']."'>".$row["nombre"]."</option>";
							}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td height='35'><strong>Prefijo:  <?= $c->Ayuda('232') ?></strong></td>
					<td class="input_regular" id="input_p_prefijo"><input type='text' name='p_prefijo' id='p_prefijo' maxlength='4' value='<? echo $object -> Getprefijo(); ?>'  class="form-control" /></td>
				</tr>
				<tr>
					<td height='35'><strong>Días Para Eliminación: <?= $c->Ayuda('233') ?></strong></td>
					<td class="input_regular" id="input_p_dias_eliminacion"><input type='text' name='p_dias_eliminacion' id='p_dias_eliminacion' maxlength='4' value='<? echo $object -> GetDias_eliminacion(); ?>'  class="form-control" /></td>
				</tr>
				<tr>
					<td height='35' width="170px"><strong>Radicado Principal: <?= $c->Ayuda('231') ?></strong></td>
					<td width="100px" class="input_regular" id="input_tipo_radicado">
						<select name='tipo_radicado' id='tipo_radicado' class="form-control important" style="width: 100%" >
							<option value="0">Seleccione una Opción</option>
							<option value="0" <?= (TIPO_RADICACION == "0")?'selected="selected"':"" ?>>Usar Solo <?= CAMPORADRAPIDO ?></option>
							<option value="1" <?= (TIPO_RADICACION == "1")?'selected="selected"':"" ?>>Usar solo <?= CAMPORADEXTERNO ?></option>
							<option value="2" <?= (TIPO_RADICACION == "2")?'selected="selected"':"" ?>>Mostrar Los dos (<?= CAMPORADRAPIDO ?> / <?= CAMPORADEXTERNO ?>)</option>
							<option value="3" <?= (TIPO_RADICACION == "3")?'selected="selected"':"" ?>>Mostrar Los dos (<?= CAMPORADEXTERNO ?> / <?= CAMPORADRAPIDO ?>)</option>
						</select>

						
						
					</td>
				</tr>
				<tr>
					<td colspan='3' align='right'><input type='button' value='Actualizar' class="btn btn-info" id="MYUPDATEPROFILE"/></td>
				</tr>
			</table>
			<div id="output"></div>
		</form>	
	</div>
	<div class="col-md-12">

		<h4>Configurar Papel en los Documentos <?= $c->Ayuda('235') ?></h4>
		<?
			include_once(MODELS.DS.'Plantilla_documento_configuracionM.php');
			$conf = new MPlantilla_documento_configuracion;
			$conf->CreatePlantilla_documento_configuracion('id', "1");
			include_once(VIEWS.DS.'plantilla_documento_configuracion/FormUpdatePlantilla_documento_configuracion.php');
		?>
		<br><br>
		<h4>Encabezado  <?= $c->Ayuda('242') ?></h4>	
		<div class="photo_encabezado">
		<?
	    	$pie_pagina = ROOT.DS.'plugins/thumbnails/'.$object->GetPie_pagina();
			$exists = file_exists( $pie_pagina );
	    	if (!$exists) {
	    		$pie_pagina = HOMEDIR.DS.'app/plugins/thumbnails/ae1abd_encabezado-arte.jpg';
	    	}else{
				$pie_pagina = HOMEDIR.DS.'app/plugins/thumbnails/'.$object->GetPie_pagina();
	    	}

	    	$encabezado = ROOT.DS.'plugins/thumbnails/'.$object->GetEncabezado();
	    	$exists = file_exists( $encabezado );
	    	if (!$exists) {
	    		$encabezado = HOMEDIR.DS.'app/plugins/thumbnails/ae1abd_encabezado-arte.jpg';
	    	}else{
	    		$encabezado = HOMEDIR.DS.'app/plugins/thumbnails/'.$object->GetEncabezado();
	    	}
		?>
			<img id="ppic_encabezado"  class="imtochange" src="<?= $encabezado  ?>" alt="">
			<form action="<?= HOMEDIR; ?>/super_admin/upload/r/encabezado/" id="formpictureencabezado" method="post" enctype="multipart/form-data">
		        <div style="display:none">
			        <input name="archivo" id="selfile_encabezado" type="file" size="35"/>
		        </div>
	      	</form>
		</div>
		<div class="leyenda">
			Se recomienda que la imagen esté en formato <br> .png o .jpg y maneje una resolución
				no mayor <br> y proporcional a 820 x 100 pixeles
		</div>
		<div style="clear:both"></div>
		<h4>Pie de Pagina <?= $c->Ayuda('243') ?></h4>	
		<div class="photo_pie">
			<img id="ppic_pie"  class="imtochange" src="<?= $pie_pagina ?>" alt="">
			<form action="<?= HOMEDIR; ?>/super_admin/upload/r/pie_pagina/" id="formpicturepie" method="post" enctype="multipart/form-data">
		        <div style="display:none">
			        <input name="archivo" id="selfile_pie" type="file" size="35"/>
		        </div>
	      	</form>
		</div>
		<div class="leyenda">
			Se recomienda que la imagen esté en formato <br> .png o .jpg y maneje una resolución
				no mayor <br> y proporcional a 820 x 100 pixeles
		</div>
	</div>
</div>

<script>
	$("#ppic_encabezado").click(function() {
		$("#selfile_encabezado").click();
	});

	$("#selfile_encabezado").change(function() {
		$("#formpictureencabezado").submit();
	});

	$("#ppic_pie").click(function() {
		$("#selfile_pie").click();
	});

	$("#selfile_pie").change(function() {
		$("#formpicturepie").submit();
	});
</script>

<style>

	#header_profile{
		background-color: #fff;
		height: 120px;
	}
	#photo_profile{
		width: 270px;
		height: 100px;
		float: left;
	}
	#photo_profile img{
		width: 250px;
		height: 80px;
		border-radius: 0px;
		margin-left: 15px;
		margin-top:10px;
	}
	.photo_encabezado, .photo_pie{
		width: 730px;
		float: left;
	}
	.photo_encabezado img, .photo_pie img{
		width: 710px;
		height: 90px;
		border-radius: 0px;
		margin-left: 15px;
		margin-top:10px;
	}
	#name_profile{
		overflow: hidden;
		font-size: 25px;
		color: #383637;
		font-weight: bold;
		text-transform: capitalize;
		padding-top: 15px;
		padding-left: 20px;
	}
	#data_content{
		height: auto;
	}
	#picture_main{
		background: #FFF;
		height: 200px;
	}
	.leyenda{
		float:left;
		font-style: italic;
		padding: 30px;
	}
</style>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 

	$("#MYUPDATEPROFILE").click(function(){
		var str = $("#formUpdateUsuario").serialize();
		$.ajax({
			type: "POST",
			url: "/super_admin/minactualizar/",
			data: str,
			success:function(msg){
				result = msg;
				alert("Información Actualizada");
			}
		});
	})
});
</script>
