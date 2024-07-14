<link href="<?=ASSETS?>/styles/bootstrap.css" rel="stylesheet">
<link href="<?=ASSETS?>/styles/prettify.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?=ASSETS?>/styles/summernote.css">
<link rel="stylesheet" type="text/css" href="<?=ASSETS?>/styles/bootstrap-tagsinput.css">
<script src="<?=ASSETS?>/js/summernote.js"></script>

<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->


<div id="tools-content-ps">
		<a href="/proceso/nuevo/"><div class="opc-folder blue"><div class="ico-content-ps"><div class="icon plus hight-blue"></div></div><div class="text-folder">Crear carpeta</div></div></a>
		<div id="tools-content-ps-sub">
			<div class="opc-folder normal active" onclick="show_folder('all-fl',this);"><div class="icon users-f normal-ic"></div></div>
			<div class="opc-folder normal" onclick="show_folder('fl-jur',this);"><div class="icon juridico-f normal-ic"></div></div>
			<div class="opc-folder normal" onclick="show_folder('fl-nat',this);"><div class="icon natural-f normal-ic"></div></div>
		</div>
		
	</div>
	<div id="folders-content">
		<div id="folders-list-content-cara-select">
			<?=$unique?>
		</div>
		<div id="folders-list-content-cara">
			<?=$result?>
		</div>
		<div id="proces-list-content-cara">
			<form id="new_caratula" action="/caratula/registrar/" method="POST">
				<section id="wizard">
					<h3 class="title-form-ps">Crear Proceso</h3>
					<div id="rootwizard">
						<ul>
						  	<li><a href="#tab1" data-toggle="tab"><span class="label">1</span><div>Ingrese la Información General</div></a></li>
							<li><a href="#tab2" data-toggle="tab"><span class="label">2</span><div>Ingrese Información de su Cliente</div></a></li>
							<li><a href="#tab3" data-toggle="tab"><span class="label">3</span><div>Ingrese Información de la Contraparte</div></a></li>
							<li><a href="#tab4" data-toggle="tab"><span class="label">4</span><div>Redacte su Primer Documento</div></a></li>
						</ul>
						<div class="tab-content">
						    <div class="tab-pane" id="tab1">
						      	<div class="form-item" style="display:none">
						      		<span class="title-item">Que deseas hacer? <span class="obligatorio">*</span></span>
						      		<div class="input-item"><select name="demanda"><option>Presentar</option></select></div>	
						      	</div>
						      	<div class="form-item">
						      		<span class="title-item">Título <span class="obligatorio">*</span></span>
						      		<div class="input-item"><input type="text" name="titulo"></div>	
						      	</div>
						      	<br>
						      	<div class="form-item">
						      		<span class="title-item">Entidad</span>
						      		<div class="input-item"><select name="juzgado"><?=$juzgados?></select></div>	
						      	</div>
						      	<div class="form-item">
						      		<span class="title-item">Dirección de Entidad</span>
						      		<div class="input-item"><input type="text" name="dir_juzgado"></div>	
						      	</div>
						      	<div class="form-item">
						      		<span class="title-item">Valor <span class="obligatorio">*</span></span>
						      		<div class="input-item"><input type="text" name="valor_cuantia"></div>	
						      	</div>
						      	<div class="form-item">
						      		<span class="title-item">Teléfono del Entidad</span>
						      		<div class="input-item"><input type="text" name="tel_juzgado"></div>	
						      	</div>
						      	<div class="form-item">
						      		<span class="title-item">Naturaleza</span>
						      		<div class="input-item"><select name="naturaleza"><?=$demandas?></select></div>	
						      	</div>
						      	<div class="form-item">
						      		<span class="title-item">Departamento</span>
						      		<div class="input-item"><input type="text" name="departamento"></div>	
						      	</div>
						      	<div class="form-item">
						      		<span class="title-item">Fecha de Presentación <span class="obligatorio">*</span></span>
						      		<div class="input-item"><input type="text" class="datepicker" name="f_presentacion"></div>	
						      	</div>
						      	<div class="form-item">
						      		<span class="title-item">Ciudad</span>
						      		<div class="input-item"><input type="text" name="ciudad"></div>	
						      	</div>
						    </div>
						    <div class="tab-pane" id="tab2">
						    	<input type="hidden" value="0" id="dem_num">
						    	<input type="hidden" value="0" id="dem_num2">
								<div class="form-item-full">
									<div class="form-item">
							      		<span class="title-item">Seleccione Carpeta Donde Desea Guardar el Proceso</span>
							      		<div class="input-item"><select name="folder_id" id="folder_id" onchange="BuscarDemandanteJuridica('0')" ><?=$folders?></select></div>	
							      	</div>
							      	<div class="form-item">
							      		<span class="title-item">Agregar Más</span>
							      		<div class="input-item"><a onclick="add_normal_de()">Natural</a> <a onclick="add_jur_de()">Jurídica</a></div>	
							      	</div>
								</div>
								<div id="dem"></div>
						    </div>
							<div class="tab-pane" id="tab3">
								<input type="hidden" value="0" id="dem_num3">
						    	<input type="hidden" value="0" id="dem_num4">
								<div class="form-item-full">
							      	<div class="form-item">
							      		<span class="title-item">Agregar Más</span>
							      		<div class="input-item"><a onclick="add_normal_de2()">Natural</a> <a onclick="add_jur_de2()">Jurídica</a></div>	
							      	</div>
								</div>
								<div id="dem2"></div>
						    </div>
						    <div class="tab-pane" id="tab4">
						    	<div id="pantillas" style="float:left; height:465px; margin-bottom: 20px;">
						    		<input type="hidden" value="0" id="id-summernote">
						    		<div id="title-plant">PLANTILLAS</div>
						    		<div id="plant" class="scrollable" style="height:410px;">
					                <?
						                $query2 = $object2->ListarPlantilla("WHERE def = 'No' and user_id = '".$_SESSION['usuario']."'");    

						                echo '<div class="item-plantilla" onClick="ShowPlants(\'plant_fav\')"><b>Mis Plantillas</b></div>';
						                echo '<div id="plant_fav" class="showplant">';
						                while($row = $con->FetchAssoc($query2)){
						                    $ln = new MPlantilla;
						                    $ln->Createplantilla('id', $row[id]);
						                    ?>
						                        <div class="item-plantilla" onclick="view_plantilla(<?=$row[id]?>,this)"><?php echo $ln->GetNombre(); ?></div>
						                    <?
						                    
						                }
						                echo '</div>';

						                $query2 = $object2->ListarPlantilla("WHERE def = 'Si'", "group by t_plantilla");    

						                while($row = $con->FetchAssoc($query2)){
						                    $l = new MPlantilla;
						                    $lq = $l->ListarPlantilla("WHERE t_plantilla = '".$row['t_plantilla']."' and def='Si' ");

						                    echo '<div class="item-plantilla" onClick="ShowPlants(\'plant_'.$row["t_plantilla"].'\')"><b>Plantillas Genericas de: '.$row["t_plantilla"].'</b></div>';
						                    echo '<div id="plant_'.$row["t_plantilla"].'" class="showplant active">';
						                    while ($rx = $con->FetchAssoc($lq)) {
						                        $ln = new MPlantilla;
						                        $ln->Createplantilla('id', $rx[id]);
						                        ?>
						                            <div class="item-plantilla" onclick="view_plantilla(<?=$rx[id]?>,this)"><?php echo $ln->GetNombre(); ?></div>
						                        <?
						                    }
						                    echo '</div>';
						                }
					                ?>
						    		</div>
						    	</div>
						    	<div><input type="submit" value="Finalizar"></div>
<!--
						    	<textarea name="summernote-plant" id="summernote-plant"></textarea>
						    	<input type="hidden" id="plantchosed" name="plantchosed" value=""> -->


								<div class="bloq_newdoc" style="float:left; width: 650px; height:400px">
									<input type="hidden" id="plantchosed" name="plantchosed" value="">
									<textarea name="summernote-plant" id="summernote-plant"><?=$content[0]?></textarea>
								</div>

						    </div>
							<ul class="pager wizard">
								<li class="next"><a href="#">Siguiente</a></li>
								<li class="previous first" style="display:none;"><a>First</a></li>
								<li class="previous"><a href="#">Atras</a></li>
								<li class="next last" style="display:none;"><a>Last</a></li>							  	
							</ul>
						</div>	
					</div>
				</section>
			</form>
		</div>
	</div>
	<script src="<?=ASSETS?>/js/bootstrap.js"></script>
	<script src="<?=ASSETS?>/js/jquery.bootstrap.wizard.js"></script>
	<script src="<?=ASSETS?>/js/prettify.js"></script>
	<script src="<?=ASSETS?>/js/bootstrap-tagsinput.js"></script>
	<script>
	$(document).ready(function() {

		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday				
		});
		$('.tags').tagsinput();
	  	$('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps'});	
		window.prettyPrint && prettyPrint();
		$('#summernote-plant').summernote({
		  toolbar: [
		    ['style', ['fontname', 'bold', 'italic', 'underline']],
		    ['para', ['ul', 'ol', 'paragraph']],
		    ['insert', ['table']]
		  ]
		});
		BuscarDemandanteJuridica("1");
	});
	function add_normal_de(){
		var num = $('#dem_num').val();
		var content = "	<div id='dem_"+num+"'><h4 class='item-title-mid'>CLIENTE PERSONA NATURAL<span class='x_dem' onclick=\"$('#dem_"+num+"').remove()\">x</span></h4>"+
						"<div class='form-item'>"+
				      		"<span class='title-item'>Nombre <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input id='nom_n' name='dem_nombre[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Número de Identificación <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input id='idn_n' name='dem_id[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Lugar de Expedición</span>"+
				      		"<div class='input-item'><input id='lug_n' name='dem_exp[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='contact'><legend></legend>"+
				      	
				      	"<div class='form-item' title='Separar por coma(,) o enter para varios telefonos'>"+
				      		"<span class='title-item'>Teléfono</span>"+
				      		"<div class='input-item'><input id='tel_n' name='dem_tel[]' type='text' class='tags'></div>	"+
				      	"</div>"+
				      	"<div class='form-item' title='Separar por coma(,) o enter para varios emails'>"+
				      		"<span class='title-item'>Email <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input id='mai_n' name='dem_mail[]' type='text' class='tags'></div>	"+
				      	"</div>"+
				      	"<hr><div class='form-item'>"+
				      		"<span class='title-item'>Ciudad<input type='hidden' value='"+num+"' name='dem_dirs[]'></span>"+
				      		"<div class='input-item'><input id='ciu_"+num+"' name='dem_ciudad[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Dirección</span>"+
				      		"<div class='input-item'><input id='dir_"+num+"' name='dem_dir[]' type='text' style='width:210px;'><span class='plus-dir icon plus' onclick='plus_dir("+num+",$(\"#ciu_"+num+"\").val(),$(\"#dir_"+num+"\").val());$(\"#ciu_"+num+"\").val(\"\");$(\"#dir_"+num+"\").val(\"\")'></span></div>	"+
				      	"</div><div id='dirs_"+num+"'></div></div></div>";
		$('#dem').after(content);
		$('#dem_num').val(num+1);
		$('.tags').tagsinput();
	}	
	function add_jur_de(){
		var num = $('#dem_num2').val();
		var content = "	<div id='dem2_"+num+"'><h4 class='item-title-mid'>CLIENTE PERSONA JURÍDICA<span class='x_dem' onclick=\"$('#dem2_"+num+"').remove()\">x</span></h4>"+
						"<div class='form-item'>"+
				      		"<span class='title-item'>Nombre <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input name='demj_nombre[]' id='nom_j' type='text'></div>	"+
				      	"</div><div class='clear'></div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Numero de Identificación <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input name='demj_id[]' id='nit_j' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Lugar de Registro</span>"+
				      		"<div class='input-item'><input name='demj_exp[]' id='lug_j' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Dirección</span>"+
				      		"<div class='input-item'><input name='demj_direccion[]' id='dir_j' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Ciudad</span>"+
				      		"<div class='input-item'><input name='demj_ciudad[]' id='ciu_j' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Nombre del Representante Legal</span>"+
				      		"<div class='input-item'><input name='demj_nombrer[]' id='cre_j' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Ciudad del Representante Legal</span>"+
				      		"<div class='input-item'><input name='demj_ciur[]' id='rep_j' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item' title='Separar por coma(,) o enter para varios telefonos'>"+
				      		"<span class='title-item'>Teléfono</span>"+
				      		"<div class='input-item'><input name='demj_tel[]' id='tel_j' type='text' class='tags'></div>	"+
				      	"</div>"+
				      	"<div class='form-item' title='Separar por coma(,) o enter para varios emails'>"+
				      		"<span class='title-item'>Email <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input name='demj_mail[]' id='mai_j' type='text' class='tags'></div>	"+
				      	"</div></div>";
		$('#dem').after(content);
		$('#dem_num2').val(num+1);
		$('.tags').tagsinput();
	}
	function add_normal_de2(){
		var num = $('#dem_num3').val();
		var content = "	<div id='dem3_"+num+"'><h4 class='item-title-mid'>CONTRAPARTE 'PERSONA NATURAL'<span class='x_dem' onclick=\"$('#dem3_"+num+"').remove()\">x</span></h4>"+
						"<div class='form-item'>"+
				      		"<span class='title-item'>Nombre <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input name='dem2_nombre[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Numero de Identificación <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input name='dem2_id[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Lugar de Expedición</span>"+
				      		"<div class='input-item'><input name='dem2_exp[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='contact'><legend></legend>"+
				      	
				      	"<div class='form-item' title='Separar por coma(,) o enter para varios telefonos'>"+
				      		"<span class='title-item'>Teléfono</span>"+
				      		"<div class='input-item'><input name='dem2_tel[]' type='text' class='tags'></div>	"+
				      	"</div>"+
				      	"<div class='form-item' title='Separar por coma(,) o enter para varios emails'>"+
				      		"<span class='title-item'>Email <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input name='dem2_mail[]' type='text' class='tags'></div>	"+
				      	"</div>"+
				      	"<hr><div class='form-item'>"+
				      		"<span class='title-item'>Ciudad<input type='hidden' value='"+num+"' name='dem2_dirs[]'></span>"+
				      		"<div class='input-item'><input id='ciu2_"+num+"' name='dem2_ciudad[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Dirección</span>"+
				      		"<div class='input-item'><input id='dir2_"+num+"' name='dem2_dir[]' type='text' style='width:210px;'><span class='plus-dir icon plus' onclick='plus2_dir("+num+",$(\"#ciu2_"+num+"\").val(),$(\"#dir2_"+num+"\").val());$(\"#ciu2_"+num+"\").val(\"\");$(\"#dir2_"+num+"\").val(\"\")'></span></div>	"+
				      	"</div><div id='dirs2_"+num+"'></div></div></div>";
		$('#dem2').after(content);
		$('#dem_num3').val(num+1);
		$('.tags').tagsinput();
	}	
	function add_jur_de2(){
		var num = $('#dem_num4').val();
		var content = "	<div id='dem4_"+num+"'><h4 class='item-title-mid'>CONTRAPARTE 'PERSONA JURÍDICA'<span class='x_dem' onclick=\"$('#dem4_"+num+"').remove()\">x</span></h4>"+
						"<div class='form-item'>"+
				      		"<span class='title-item'>Nombre <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input name='demj2_nombre[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Numero de Identificación <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input name='demj2_id[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Lugar de Registro</span>"+
				      		"<div class='input-item'><input name='demj2_exp[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Ciudad</span>"+
				      		"<div class='input-item'><input name='demj2_ciudad[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Nombre del Representante Legal</span>"+
				      		"<div class='input-item'><input name='demj2_nombrer[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Ciudad del Representante Legal</span>"+
				      		"<div class='input-item'><input name='demj2_ciur[]' type='text'></div>	"+
				      	"</div>"+
				      	"<div class='form-item' title='Separar por coma(,) o enter para varios telefonos'>"+
				      		"<span class='title-item'>Teléfono</span>"+
				      		"<div class='input-item'><input name='demj2_tel[]' type='text' class='tags'></div>	"+
				      	"</div>"+
				      	"<div class='form-item' title='Separar por coma(,) o enter para varios emails'>"+
				      		"<span class='title-item'>Email <span class='obligatorio'>*</span></span>"+
				      		"<div class='input-item'><input name='demj2_mail[]' type='text' class='tags'></div>	"+
				      	"</div></div>";
		$('#dem2').after(content);
		$('#dem_num4').val(num+1);
		$('.tags').tagsinput();
	}
	function plus_dir(num,ciudad,direccion){
		var content = "<div class='form-item'>"+
				      		"<span class='title-item'>Ciudad</span>"+
				      		"<div class='input-item'><input name='dem_ciudad_"+num+"[]' type='text' value='"+ciudad+"'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Dirección</span>"+
				      		"<div class='input-item'><input name='dem_dir_"+num+"[]' type='text' value='"+direccion+"'></div>	"+
				      	"</div>";
		$('#dirs_'+num).after(content);
	}
	function plus2_dir(num,ciudad,direccion){
		var content = "<div class='form-item'>"+
				      		"<span class='title-item'>Ciudad</span>"+
				      		"<div class='input-item'><input name='dem2_ciudad_"+num+"[]' type='text' value='"+ciudad+"'></div>	"+
				      	"</div>"+
				      	"<div class='form-item'>"+
				      		"<span class='title-item'>Dirección</span>"+
				      		"<div class='input-item'><input name='dem2_dir_"+num+"[]' type='text' value='"+direccion+"'></div>	"+
				      	"</div>";
		$('#dirs2_'+num).after(content);
		ciudad = "";
		direccion = "";
	}
	function view_plantilla(id,div){
		var dat = $('#new_caratula').serialize();
		$("#plantchosed").val(id);
		$.ajax({
			url:'/herramientas/plantilla/'+id+'/1/',
			data:dat,
			type:'post',
			success:function(msg){
				var data = eval('('+msg+')');
				$('#summernote-plant').code(data['content']);
				$('#id-summernote').val(id);
				$('.item-plantilla').removeClass('active');
				$(div).addClass('active');
			}
		})
	}
	function show_folder(type,div){	
		if (type=='all-fl') {
			$('#folders-list-content-cara .folder-item').show(500);
		}else{
			$('#folders-list-content-cara .folder-item:not(.'+type+')').hide(500);
			$('#folders-list-content-cara .folder-item.'+type).show(500);		
		}
		$('.opc-folder').removeClass('active');
		$(div).addClass('active');
	}
	function ShowPlants(wich){
        if ($("#"+wich).hasClass('active')) {
            $("#"+wich).slideUp();
            $("#"+wich).removeClass('active');
        }else{
            $("#"+wich).slideDown();
            $("#"+wich).addClass('active');
        }
    }
	</script>