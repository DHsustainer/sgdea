<?
	global $f;
?>
<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/config.css'/>
<div id="container_mail_config">
	<div id="header_profile">
		<div id="photo_profile">
			<img id="profilepic" style="cursor:pointer" src="<?= HOMEDIR.DS.'app/plugins/thumbnails/'.$object->GetFoto_perfil() ?>" alt="">
		</div>

		<div id="name_profile">
			<?= $object->GetP_nombre()." ".$object->GetP_apellido() ?> <span class="account_name">(<?= $object->GetUser_id() ?>)</span>
			<div class="subtitle">Cuenta activa hasta el <?= $f->ObtenerFecha($object->GetF_caducidad()); ?></div>
			<div class="clear"></div>
		</div>

	</div>

	<div id="profile_main">
		<div id="menu_list">
			<div id="title_blue">Informacion de Cuenta</div>
			<ul id="navigation_menu">
				<li id="btn_information" class="active" onClick="LoadPage('table_data_user', 'btn_information')">Información Personal</li>
				<li id="btn_password" onClick="LoadPage('table_password_user', 'btn_password')">Carpeta Publica</li>
				<li id="shared_folder" onClick="LoadPage('table_shared_folder', 'shared_folder')">Carpeta Compartida</li>

			</ul>
		</div>

		<div id="data_content">
			<div id="title_black">Informacion Personal</div>	
			<div id="body_data" style="width:90%">
				<form id="formUpdateUsuario" name="formUpdateUsuario">
					<table id="table_data_user"  width="90%">
						<tr>
							<td height="25px;" width="190px">Nombres:</td>
							<td class="text_regular" onClick="ShowField('p_nombre')" id="text_p_nombre"><?= $object->GetP_nombre() ?></td>
						</tr>
						<tr>
							<td height="25px;" width="190px">Apellidos:</td>
							<td class="text_regular" onClick="ShowField('p_apellido')" id="text_p_apellido"><?= $object->GetP_apellido(); ?></td>
						</tr>
						<tr>
							<td height="25px;">Sexo:</td>
							<? 
								$ar = array("h" => "Hombre", "m" => "Mujer");
							?>
							<td class="text_regular" onClick="ShowField('sexo')" id="text_sexo"><?= $ar[$object->GetSexo()]; ?></td>
							
						</tr>
						<tr>
							<td height="25px;">Cédula:</td>
							<td class="text_regular" onClick="ShowField('cedula')" id="text_cedula"><?= $object->GetCedula(); ?></td>
						</tr>
						<tr>
							<td height="25px;">Lugar de Expedición:</td>
							<td class="text_regular" onClick="ShowField('exp_cedula')" id="text_exp_cedula"><?= $object->GetExp_cedula(); ?></td>
						</tr>
						<tr>
							<td height="25px;">Dirección:</td>
							<td class="text_regular" onClick="ShowField('direccion')" id="text_direccion"><?= $object->GetDireccion(); ?></td>
						</tr>
						<tr>
							<td height="25px;">Ciudad:</td>
							<td class="text_regular" onClick="ShowField('ciudad')" id="text_ciudad"><?= $object->GetCiudad(); ?></td>
						</tr>
						<tr>
							<td height="25px;">Departamento:</td>
							<td class="text_regular" onClick="ShowField('departamento')" id="text_departamento"><?= $object->GetDepartamento(); ?></td>
						</tr>
						<tr>
							<td height="25px;">Teléfono:</td>
							<td class="text_regular" onClick="ShowField('telefono')" id="text_telefono"><?= $object->GetTelefono(); ?></td>
						</tr>
						<tr>
							<td height="25px;">Celular:</td>
							<td class="text_regular" onClick="ShowField('celular')" id="text_celular"><?= $object->GetCelular(); ?></td>
						</tr>
						<tr>
							<td height="25px;">Correo Electrónico:</td>
							<td class="text_regular" onClick="ShowField('email')" id="text_email"><a title="Enviar correo a <?= $object->GetEmail(); ?>" href="<?= HOMEDIR ?>/correo/nuevo/*./<?= $object->GetEmail(); ?>/"> <?= $object->GetEmail(); ?></a></td>
						</tr>
					</table>
				</form>
					<table id="table_password_user"  style="display:none"  width="100%">
						<tr>
							<td colspan="2">
								<div id="GetCarpetaPublica">
<? 
										 

		$files = $object->GetDocumentosPublicos();

        $viewer =       array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,
                              ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,
                              ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,
                              ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,
                              ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,
                              "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,
                              "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,
                              ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video",

                              ".DOC" => "google"                        , "DOCX" => "google"                        , ".ZIP" => "google"                        , ".RAR" => "google"                        ,
                              ".TAR" => "google"                        , ".XLS" => "google"                        , "XLSX" => "google"                        , ".PPT" => "google"                        ,
                              ".PPS" => "google"                        , "PPTX" => "google"                        , "PPSX" => "google"                        , ".PDF" => "google"                        ,
                              ".TXT" => "google"                        , ".JPG" => "image"                         , "JPEG" => "image"                         , ".BMP" => "image"                         ,
                              ".GIF" => "image"                         , ".PNG" => "image"                         , ".DIV" => "image"                         , ".TIF" => "image"                         ,
                              "TIFF" => "image"                         , "MPEG" => "video"                         , ".AVI" => "video"                         , ".MP4" => "video"                         ,
                              "MIDI" => "audio"                         , ".ACC" => "audio"                         , ".WMA" => "audio"                         , ".OGG" => "audio"                         ,
                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video");

		$pathn  = "";
		$pathm  = "";				
		$type_s = "Anexos";
		$i1 = 0;
		$pathn .= "<div class='search_result'>";	
		if($con->NumRows($files) <= 0){
			$pathn .= "<div class='alert alert-info'>El usuario no ha cargado documentos en su carpeta publica</div>";
		}else{
			$i1 = 0;
			$pathm = "";
			    while ($col=$con->FetchAssoc($files)) {
			    	$i1++;
			        $type=explode('.', strtolower($col[url]));
			        $type=array_pop($type);

			        $file = $col["url"];
			        $ruta = HOMEDIR.DS."app/archivos_uploads/".$object->GetUser_id().trim("/folders/ ").$file."";
			        $cadena_nombre = substr($file,0,200);
			        $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

			        echo "  <div class='anexos-div' id='$col[id]' style='float:left'>
			                    <div style='padding-top:0px; margin-top:-15px;' class='img-icon $type' onclick='AbrirDocumentoPublico(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"1\", \"".$col["id"]."\")'></div>
			                    <div class='clear'></div>
			                    <div class='nom_anexo' title='$col[nombre]' style='font-size:12px'>
			                        $col[nombre]
			                    </div>
			                </div>";
			    }
			$pathm .= "<div class='clear'></div>";
		}
		echo $pathn.$pathm."</div><div class='clear'></div>";


?>
								</div>
							</td>
						</tr>
					</table>
					<table id="table_shared_folder"  style="display:none"  width="100%">
						<tr>
							<td colspan="2">
								<div id="GetCarpetaCompartida">
<? 
										 

		$files = $object->GetCarpetaCompartida($_SESSION['usuario']);

		$pathy  = "";
		$pathz  = "";				
		$pathy .= "<div class='search_result'>";	
		$r = $con->Result($files, 0, 'id');
		if($r <= 0){
			$pathy .= "<div class='alert alert-info'>No se ha creado una carpeta compartida entre usted y este usuario</div>";
			$pathy .= "<div class='alert alert-info'>Haga <a href='".HOMEDIR.DS."folder_ciudadano/registrar/".$object->GetUser_id()."/'>Clic aqui</a> si desea crear una carpeta compartida</div>";
		}else{
			
			$files2 = $object->GetDocumentosCarpeta($r);

			    while ($colcom=$con->FetchAssoc($files2)) {
			        $type=explode('.', strtolower($colcom[url]));
			        $type=array_pop($type);

			        $file = $colcom["url"];
			        $UID = $colcom["user_id"];
			        $ruta = HOMEDIR.DS."app/archivos_uploads/".$UID.trim("/folders/ ").$file."";
			        $cadena_nombre = substr($file,0,200);
			        $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

			        echo "  <div class='anexos-div' id='$colcom[id]' style='float:left'>
			                    <div style='padding-top:0px; margin-top:-15px;' class='img-icon $type' onclick='AbrirDocumentoPublico(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$colcom["nombre"]."\", \"1\", \"".$colcom["id"]."\")'></div>
			                    <div class='clear'></div>
			                    <div class='nom_anexo' title='$colcom[nombre]' style='font-size:12px'>
			                        $colcom[nombre]
			                    </div>
			                </div>";
			    }
			$pathz .= "<div class='clear'></div>";
		}
		echo $pathy.$pathz."</div><div class='clear'></div>";


?>
								</div>
							</td>
						</tr>
					</table>
			</div>
			
	</div>
</div>

<script>
	
function LoadPage(id, selector){

	$("#navigation_menu > li").removeClass('active');
	$("#"+selector).addClass('active');

	if (id == "table_data_user") {
		$("#table_password_user").slideUp("fast");
		$("#table_shared_folder").slideUp("fast");

		$("#table_data_user").slideDown("slow");
		$("#title_black").html("Información personal");
	}else if(id == "table_password_user"){
		$("#table_data_user").slideUp("fast");
		$("#table_shared_folder").slideUp("fast");

		$("#table_password_user").slideDown("slow");
		$("#title_black").html("Carpeta Publica");
	}else if(id == "table_shared_folder"){
		$("#table_data_user").slideUp("fast");
		$("#table_password_user").slideUp("fast");

		$("#table_shared_folder").slideDown("slow");
		$("#title_black").html("Carpeta Compartida");
	}
} 

</script>