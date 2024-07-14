<?
	if ($_SESSION['sadmin'] == "0") {
		header("LOCATION: ".HOMEDIR.trim(" /dashboard/"));
	}

	$object = new MSuper_admin;
    $object->CreateSuper_admin("id", "6");

    $MDependencias_version = new MDependencias_version;
	$MDependencias_version->CreateDependencias_version("id", $object->Getid_version());


?>
<div class="row">
	<div class="col-md-12">
		<h1><?= $object->GetP_nombre() ?> <?= $c->Ayuda('107') ?></h1>
		<form class="form-material form-horizontal" id="formUpdateUsuario" name="formUpdateUsuario">
        	<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
        	<input type='hidden' name='p_id_version' id='p_id_version' value='<? echo $MDependencias_version->GetId(); ?>'/>
			<input type='hidden' name='p_prefijo' id='p_prefijo' value='<? echo $object -> Getprefijo(); ?>'/>
			<input type='hidden' name='p_dias_eliminacion' id='p_dias_eliminacion' value='<? echo $object -> GetDias_eliminacion(); ?>'/>
			<div class="col-md-6">
		    	<h3 class="box-title m-b-20">Informacion De la Empresa</h3>
			    <div class="row">
			        <div class="col-md-12">
		                <div class="form-group">
		                    <label class="col-md-12" for="">Nombre de la Empresa:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_p_nombre' id='p_p_nombre' value='<? echo $object -> Getp_nombre(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Identificación (NIT):</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_cedula' id='p_cedula' value='<? echo $object -> Getcedula(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Ciudad de Expedición:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_expedicion_identificacion' id='p_expedicion_identificacion' value='<? echo $object -> Getexpedicion_identificacion(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Email:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_email' id='p_email' value='<? echo $object -> Getemail(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Teléfono:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_telefono' id='p_telefono' value='<? echo $object -> Gettelefono(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Celular:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_celular' id='p_celular' value='<? echo $object -> Getcelular(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Departamento:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_departamento' id='p_departamento' value='<? echo $object -> Getdepartamento(); ?>'  class="form-control" />
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-6">
		    	<div class="row">
			        <div class="col-md-12">
		                <div class="form-group">
		                    <label class="col-md-12" for="">Ciudad:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_ciudad' id='p_ciudad' value='<? echo $object -> Getciudad(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Dirección:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_direccion' id='p_direccion' value='<? echo $object -> Getdireccion(); ?>'  class="form-control" />
		                    </div>
		                </div>
		            </div>
		        </div>
			    <h3 class="box-title m-b-20">Informacion Del Representante Legal</h3>
		        <div class="row">
			        <div class="col-md-12">
		                <div class="form-group">
		                    <label class="col-md-12" for="">Representante Legal:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_nombre_representante' id='p_nombre_representante' value='<? echo $object -> Getnombre_representante(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Identificación del Representante:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_cedula_representante' id='p_cedula_representante' value='<? echo $object -> Getcedula_representante(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Ciudad de Expedición:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_expedicion_cedula' id='p_expedicion_cedula' value='<? echo $object -> Getexpedicion_cedula(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Ciudad de Residencia:</label>
		                    <div class="col-md-12">
		                        <input type='text' name='p_ciudad_residencia' id='p_ciudad_residencia' value='<? echo $object -> Getciudad_residencia(); ?>'  class="form-control" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-12" for="">Email</label>
		                    <div class="col-md-12">
		                        <input type="email" id="" name="" class="form-control">
		                    </div>
		                </div>
			        </div>
			    </div>
			</div>
		    <div class="row">
		    	<div class="col-md-12">
		    		<input type='button' value='Actualizar Perfil de la Empresa' id="updateprofile" class="btn btn-info pull-right m-t-20 m-b-30"/>
		    	</div>
		    </div>
	    </form>
	</div>
</div>
<h1>Logotipos <?= $c->Ayuda('108') ?></h1>	
<?
	$GetFoto_perfil = ROOT.DS.'plugins/thumbnails/'.$object->GetFoto_perfil();
	$exists = file_exists( $GetFoto_perfil );
	if (!$exists) {
		$GetFoto_perfil = HOMEDIR.DS.'app/plugins/thumbnails/text_color.png';
	}else{
		$GetFoto_perfil = HOMEDIR.DS.'app/plugins/thumbnails/'.$object->GetFoto_perfil();
	}

	$Getimajotipo = ROOT.DS.'plugins/thumbnails/'.$object->Getimajotipo();
	$exists = file_exists( $Getimajotipo );
	if (!$exists) {
		$Getimajotipo = HOMEDIR.DS.'app/plugins/thumbnails/logo_color.png';
	}else{
		$Getimajotipo = HOMEDIR.DS.'app/plugins/thumbnails/'.$object->Getimajotipo();
	}

	$Getlogo_white = ROOT.DS.'plugins/thumbnails/'.$object->Getlogo_white();
	$exists = file_exists( $Getlogo_white );
	if (!$exists) {
		$Getlogo_white = HOMEDIR.DS.'app/plugins/thumbnails/text_white.png';
	}else{
		$Getlogo_white = HOMEDIR.DS.'app/plugins/thumbnails/'.$object->Getlogo_white();
	}

	$Getimage_white = ROOT.DS.'plugins/thumbnails/'.$object->Getimage_white();
	$exists = file_exists( $Getimage_white );
	if (!$exists) {
		$Getimage_white = HOMEDIR.DS.'app/plugins/thumbnails/logo_white.png';
	}else{
		$Getimage_white = HOMEDIR.DS.'app/plugins/thumbnails/'.$object->Getimage_white();
	}

?>
<div class="row" style="margin:0px">
	<div class="col-md-6">
		<h2 class="m-l-20">Logo tipo (Texto) en Color</h2>
		<div class="col-md-6">
			<img id="ppic"  class="imtochange waves-effect" src="<?= $GetFoto_perfil ?>" style="width: 170px; !important; height: auto;" alt="">
			<form action="<?= HOMEDIR; ?>/super_admin/upload/foto_perfil/prof_text/" id="formpicture" method="post" enctype="multipart/form-data">
		        <div style="display:none">
			        <input name="archivo" id="selfile" type="file" size="35"/>
		        </div>
	      	</form>
	      	<script>
	      		$("#ppic").click(function() {
	      			$("#selfile").click();
	      		});
	      		$("#selfile").change(function() {
	      			$("#formpicture").submit();
	      		});
	      	</script>
		</div>
		<div class="col-md-6">
			<div class="leyenda">
				Se recomienda que la imagen esté en formato .png o .jpg <br>Y que maneje una resolucion no mayor y proporcional 139 x 24 pixeles
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<h2 class="m-l-20">Logo tipo (Imagen) en Color</h2>
		<div class="col-md-6">
			<img id="ppic_ima"  class="imtochange waves-effect" src="<?= $Getimajotipo ?>" alt=""  style="width: 90px; !important; height: auto;">
			<form action="<?= HOMEDIR; ?>/super_admin/upload/foto_perfil/prof_ima/" id="formpicture_ima" method="post" enctype="multipart/form-data">
		        <div style="display:none">
			        <input name="archivo" id="selfile_ima" type="file" size="35"/>
		        </div>
	      	</form>
	      	<script>
	      		$("#ppic_ima").click(function() {
	      			$("#selfile_ima").click();
	      		});
	      		$("#selfile_ima").change(function() {
	      			$("#formpicture_ima").submit();
	      		});
	      	</script>
		</div>
		<div class="col-md-6">
			<div class="leyenda">
				Se recomienda que la imagen esté en formato .png o .jpg <br>Y que maneje una resolucion no mayor y proporcional 33 x 31 pixeles
			</div>
		</div>
		
	</div>
</div>
<div class="row m-t-30">
	<div class="col-md-6">
		<h2 class="m-l-20">Logo tipo (Texto) en Blanco</h2>
		<div class="col-md-6"  style="background-color: #F5F5F5;">
			<img id="ppic_white_text"  class="imtochange waves-effect" src="<?= $Getlogo_white ?>" alt="" style="width: 170px; !important; height: auto;">
			<form action="<?= HOMEDIR; ?>/super_admin/upload/foto_perfil/white_text/" id="formpicture_white_text" method="post" enctype="multipart/form-data">
		        <div style="display:none">
			        <input name="archivo" id="selfile_white_text" type="file" size="35"/>
		        </div>
	      	</form>
	      	<script>
	      		$("#ppic_white_text").click(function() {
	      			$("#selfile_white_text").click();
	      		});
	      		$("#selfile_white_text").change(function() {
	      			$("#formpicture_white_text").submit();
	      		});
	      	</script>
		</div>
		<div class="col-md-6">
			<div class="leyenda">
				Se recomienda que la imagen esté en formato .png o .jpg <br>Y que maneje una resolucion no mayor y proporcional 139 x 24 pixeles
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<h2 class="m-l-20">Logo tipo (Imagen) en Blanco</h2>
		<div class="col-md-6" style="background-color: #F5F5F5;">
			<img id="ppic_white_ima"  class="imtochange waves-effect" src="<?= $Getimage_white ?>" alt="" style="width: 90px; !important; height: auto;">
			<form action="<?= HOMEDIR; ?>/super_admin/upload/foto_perfil/white_ima/" id="formpicture_white_ima" method="post" enctype="multipart/form-data">
		        <div style="display:none">
			        <input name="archivo" id="selfile_white_ima" type="file" size="35"/>
		        </div>
	      	</form>
	      	<script>
	      		$("#ppic_white_ima").click(function() {
	      			$("#selfile_white_ima").click();
	      		});
	      		$("#selfile_white_ima").change(function() {
	      			$("#formpicture_white_ima").submit();
	      		});
	      	</script>
		</div>
		<div class="col-md-6">
			<div class="leyenda">
				Se recomienda que la imagen esté en formato .png o .jpg <br>Y que maneje una resolucion no mayor y proporcional 33 x 31 pixeles
			</div>
		</div>
	
	</div>
</div>
<h1 class="m-t-20">Diseño del Sistema <?= $c->Ayuda('109') ?></h1>	
<div class="row" style="margin:0px;">
	<div class="col-md-12">
		<ul id="themecolors" class="m-t-20">
            <li><b>Con Barra Lateral Blanca</b></li>
            <li><a href="/super_admin/style/default/" data-theme="default" class="default-theme <?= ($object->Getestilo() == 'default')?"working":"" ?>">1</a></li>
            <li><a href="/super_admin/style/green/" data-theme="green" class="green-theme  <?= ($object->Getestilo() == 'green')?"working":"" ?>"">2</a></li>
            <li><a href="/super_admin/style/yellow/" data-theme="gray" class="yellow-theme  <?= ($object->Getestilo() == 'yellow')?"working":"" ?>"">3</a></li>
            <li><a href="/super_admin/style/blue/" data-theme="blue" class="blue-theme  <?= ($object->Getestilo() == 'blue')?"working":"" ?>"">4</a></li>
            <li><a href="/super_admin/style/purple/" data-theme="purple" class="purple-theme  <?= ($object->Getestilo() == 'purple')?"working":"" ?>"">5</a></li>
            <li><a href="/super_admin/style/megna/" data-theme="megna" class="megna-theme  <?= ($object->Getestilo() == 'megna')?"working":"" ?>"">6</a></li>
            <br>
            <li><b>Con Barra Lateral Oscura</b></li>
            <br>
            <li><a href="/super_admin/style/default-dark/" data-theme="default-dark" class="default-dark-theme  <?= ($object->Getestilo() == 'default-dark')?"working":"" ?>"">7</a></li>
            <li><a href="/super_admin/style/green-dark/" data-theme="green-dark" class="green-dark-theme  <?= ($object->Getestilo() == 'green-dark')?"working":"" ?>"">8</a></li>
            <li><a href="/super_admin/style/yellow-dark/" data-theme="gray-dark" class="yellow-dark-theme  <?= ($object->Getestilo() == 'yellow-dark')?"working":"" ?>"">9</a></li>
            <li><a href="/super_admin/style/blue-dark/" data-theme="blue-dark" class="blue-dark-theme  <?= ($object->Getestilo() == 'blue-dark')?"working":"" ?>"">10</a></li>
            <li><a href="/super_admin/style/purple-dark/" data-theme="purple-dark" class="purple-dark-theme  <?= ($object->Getestilo() == 'purple-dark')?"working":"" ?>"">11</a></li>
            <li><a href="/super_admin/style/megna-dark/" data-theme="megna-dark" class="megna-dark-theme  <?= ($object->Getestilo() == 'megna-dark')?"working":"" ?>"">12</a></li>
		</ul>
	</div>
</div>



<script>
$(document).ready(function(){
	$("#updateprofile").click(function(){
		if($("#p_p_nombre").val() == ""){
			$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre</div>");
			return false;
		}if($("#p_direccion").val() == ""){
			$("#update_field").html("<div class='alert alert-info'>Debes escribir un nombre apellido</div>");
			return false;
		}
		if($("#p_email").val() == ""){
			$("#update_field").html("<div class='alert alert-info'>El campo E-Mail es obligatorio</div>");
			return false;
		}else{
			var str = $("#formUpdateUsuario").serialize();
			$.ajax({
				type: "POST",
				url: "/super_admin/actualizar/",
				data: str,
				success:function(msg){
					result = msg;
					window.location.reload();
					//$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
				}
			});
		}
	})
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
	height: 120px;
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
	font-style: italic;
}
</style>