<?
 $viewer =  array(     ".doc" => "google" , "docx" => "google" , ".zip" => "google" , ".rar" => "google" , ".tar" => "google" 
, ".xls" => "google" , "xlsx" => "google" , ".ppt" => "google" , ".pps" => "google" , "pptx" => "google" , "ppsx" => "google" 
, ".pdf" => "google" , ".txt" => "google" , ".jpg" => "image"  , "jpeg" => "image"  , ".bmp" => "image"  , ".gif" => "image"  
, ".png" => "image"  , ".dib" => "image"  , ".tif" => "image"  , "tiff" => "image"  , "mpeg" => "video"  , ".avi" => "video"  
, ".mp4" => "video"  , "midi" => "audio"  , ".acc" => "audio"  , ".wma" => "audio"  , ".ogg" => "audio"  , ".mp3" => "audio"  
, ".flv" => "video"  , ".wmv" => "video"  , ".csv" => "google" , ".DOC" => "google" , "DOCX" => "google" , ".ZIP" => "google" 
, ".RAR" => "google" , ".TAR" => "google" , ".XLS" => "google" , "XLSX" => "google" , ".PPT" => "google" , ".PPS" => "google" 
, "PPTX" => "google" , "PPSX" => "google" , ".PDF" => "google" , ".TXT" => "google" , ".JPG" => "image"  , "JPEG" => "image"  
, ".BMP" => "image"  , ".GIF" => "image"  , ".PNG" => "image"  , ".DIV" => "image"  , ".TIF" => "image"  , "TIFF" => "image"  
, "MPEG" => "video"  , ".AVI" => "video"  , ".MP4" => "video"  , "MIDI" => "audio"  , ".ACC" => "audio"  , ".WMA" => "audio"  
, ".OGG" => "audio"  , ".MP3" => "audio"  , ".FLV" => "video"  , ".WMV" => "video"  , ".CSV" => "google" );

 $iconfile = array("doc" => "mdi-file-word text-info" , "docx" => "mdi-file-word text-info" , "zip" => "mdi-zip-box text-info" , "rar" => "mdi-zip-box text-info" , "tar" => "mdi-zip-box text-info" , "xls" => "mdi-file-excel text-success" , "xlsx" => "mdi-file-excel text-success" , "ppt" => "mdi-file-powerpoint text-danger" , "pps" => "mdi-file-powerpoint text-danger" , "pptx" => "mdi-file-powerpoint text-danger" , "ppsx" => "mdi-file-powerpoint text-danger" , "pdf" => "mdi-file-pdf text-danger" , "txt" => "mdi-file-document text-muted" , "jpg" => "mdi-file-image text-success"  , "jpeg" => "mdi-file-image text-success"  , "bmp" => "mdi-file-image text-success"  , "gif" => "mdi-file-image text-success"  , "png" => "mdi-file-image text-success"  , "dib" => "mdi-file-image text-success"  , "tif" => "mdi-file-image text-success"  , "tiff" => "mdi-file-image text-success"  , "mpeg" => "mdi-file-video text-warning"  , "avi" => "mdi-file-video text-warning"  , "mp4" => "mdi-file-video text-warning"  , "midi" => "mdi-audiobook mdi-warning"  , "acc" => "mdi-audiobook mdi-warning"  , "wma" => "mdi-audiobook mdi-warning"  , "ogg" => "mdi-audiobook mdi-warning"  , "mp3" => "mdi-audiobook mdi-warning" , "flv" => "mdi-file-video text-warning"  , "wmv" => "mdi-file-video text-warning"  , "csv" => "mdi-file-excel text-success" , "" => "mdi-file-find text-warning" );

$ar_firmo = array(	"" => HOMEDIR.DS."app/views/assets/images/white_spot.png",  "-" => HOMEDIR.DS."app/views/assets/images/white_spot.png",  "0" => HOMEDIR.DS."app/views/assets/images/firmaw.png",  "1" => HOMEDIR.DS."app/views/assets/images/firmao.png", "2" => HOMEDIR.DS."app/views/assets/images/firmae.png");

$ar_title = array(	""  => "",  "-" => "",  "0" => "Documento Pendiente de Firma",  "1" => "Documento Firmado por $usuario_fir el $fecha_firma",  "2" => "Firma Rechazada por $usuario_fir el $fecha_firma");

	$RegistrosAMostrar = 12;
	if(isset($pag)){
		$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
		$PagAct=$pag;
	}else{
		$RegistrosAEmpezar=0;
		$PagAct=1;
	}	

	$ang = new MGestion_anexos;
	$object = new MGestion;
	$object->CreateGestion("id", $id);
	$usua = new MUsuarios;
	$usua->CreateUsuarios("user_id", $_SESSION['usuario']);
    $isboss = false;
    $insuscriptor = false;
	$inshare = false;
 	$haveshared = false;
 	$haveshared2 = false;

    if(($_SESSION['t_cuenta']=="1" && $usua->GetRegimen()==$object->GetDependencia_destino()) || $_SESSION['sadminid']=="1") {
        $isboss = true;
    }

	$gc = new MGestion_compartir;
	$qn =$gc->ListarGestion_compartir("where usuario_nuevo='".$_SESSION['usuario']."' and gestion_id='".$object->GetId()."'");
	$com = $con->NumRows($qn);

	if ($com >= 1) {

	    $inshare = true;
	    $gc->CreateGestion_compartirQuery("usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id='".$object->GetId()."'");
	    $_SESSION['mayedit'] = $gc->GetType();

	}

	if ($_SESSION['usuario'] == $object->GetUsuario_registra() || $usua->GetA_i() == $object->GetNombre_destino()) {
		$_SESSION['mayedit'] = "1";
	}

	$sg = new MGestion_suscriptores;
	$qns = $sg->ListarGestion_suscriptores(" where id_suscriptor = '".$_SESSION['suscriptor_id']."' and id_gestion = '".$object->GetId()."'");

	$coms = $con->NumRows($qns);

	if ($coms >= 1) {
	    $insuscriptor = true;
	}

    $conx = $con->NumRows($con->Query("select * from gestion_anexos_permisos where gestion_id = '".$object->GetId()."' and usuario_permiso = '".$_SESSION['usuario']."'"));

    if ($conx >= 1) {
        $haveshared = true;
    }

    $conx = $con->NumRows($con->Query("select * from gestion_anexos_permisos_documentos where gestion_id = '".$object->GetId()."' and usuario_permiso = '".$_SESSION['usuario']."'"));

    if ($conx >= 1) {
        $haveshared2 = true;
    }

	if ($object->Getnombre_destino() == $usua->GetA_i() || $insuscriptor || $inshare || $object->GetUsuario_registra() == $usua->GetUser_id() || $isboss) {

	# echo "Tengo Acceso por X o Y Motivo Excepto un documento compartido";				

		$query = $ang->ListarGestion_anexos("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3')", "order by ".ORDENARDOCUMENTOSBY, "limit $RegistrosAEmpezar, $RegistrosAMostrar");

		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3')");

	}else{
	# echo "Solo me Compartieron así que no debería tener acceso a este expediente excepto a los documentos que me compartieron";
		if($haveshared2 == true){
			$sql_a =" UNION SELECT ga.*,gap.* FROM gestion_anexos as ga inner join gestion_anexos_permisos_documentos as gap on gap.id_documento=ga.id left join gestion_anexos_permisos k on gap.id_documento=k.id_documento WHERE k.id_documento is null and ga.gestion_id = '".$id."' and ga.folder_id = '".$folder."' and gap.usuario_permiso = '".$_SESSION['usuario']."' and (ga.estado = '1' or ga.estado = '3')";
		}
		$query = $ang->ListarGestion_anexos(" as ga inner join gestion_anexos_permisos as gap on gap.id_documento=ga.id  WHERE ga.gestion_id = '".$id."' and ga.folder_id = '".$folder."' and gap.usuario_permiso = '".$_SESSION['usuario']."' and (ga.estado = '1' or ga.estado = '3') ".$sql_a, "order by ".ORDENARDOCUMENTOSBY, "limit $RegistrosAEmpezar, $RegistrosAMostrar");
	}

	#echo '<div class="list-group">';
    while ($col=$con->FetchArray($query)) {
    	
        $type=explode('.', strtolower($col[url]));

        $type=array_pop($type);

        $tipologia = "";

        $file = $col["url"];

        $idb = $col[0];

        $propietario_documento = false;

        
        if ($file != "") {

            $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";
            $ruta2 = ROOT.DS."archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";
            $cadena_nombre = substr($file,0,200);
            $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  
        	
        	$exists = file_exists( $ruta2 );
        	$exs = "";
        	if (!$exists) {
				$exs = "<span class='text-danger mdi mdi-alert-octagon' data-toggle='tooltip'  title='Error al Leer el Archivo' data-placement='right'></span>";
        	}

        	$checknew  = $con->Query("select count(*) as t from gestion_anexos_consultas where id_anexo = '".$col['id']."'");
        	$datnew = $con->FetchAssoc($checknew);
        	$exxs = "";
        	
        	if ($datnew["t"] == "0") {
        		if ($col['tipologia'] == '0') {
        			$exxs = "<span class='text-warning mdi mdi-alert-circle' data-toggle='tooltip'  title='Documento Nuevo!' 	data-placement='right'></span>";
        			# code...
        		}
        	}
        	
 		

			$bad = (strlen($col[nombre]) > 90)?"...":"";
		 	$nombredoc = substr($col[nombre], 0, 90).$bad;

			
			$fecha_firma    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "fecha_firma", " ");
			$usuario_fir    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "usuario_firma", " ");
			$usuario_fir    = $c->GetDataFromTable("usuarios", "user_id", $usuario_fir, "p_nombre, p_apellido", " ");

			$ar_firmo = array(	"" => "", 
								"-" => "", 
								"0" => HOMEDIR.DS."app/views/assets/images/firmaw.png", 
								"1" => HOMEDIR.DS."app/views/assets/images/firmao.png", 
								"2" => HOMEDIR.DS."app/views/assets/images/firmae.png");

			$ar_title = array(	""  => "", 
								"-" => "", 
								"0" => "Documento Pendiente de Firma", 
								"1" => "Documento Firmado por $usuario_fir el $fecha_firma", 
								"2" => "Firma Rechazada por $usuario_fir el $fecha_firma");

			$se_firmo    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "estado_firma", $separador = " ");

			if ($ar_firmo[$se_firmo] != "") {
				$se_firmo = "<img src='".$ar_firmo[$se_firmo]."' title='".$ar_title[$se_firmo]."' class='m-r-10'>";
			}
			$doc_firmado = "";
			$doc_firmado = $se_firmo;

			$namtipo = "";
			if ($col['tipologia'] != "0") {
				$namtipo = $c->GetDataFromTable("dependencias_tipologias", "id", $col['tipologia'], "tipologia", " ");
				$namtipo = "<div style='line-height:10px; margin-top: -6px;' class='m-l-5'>
								<small class='text-muted'>$namtipo</small>
							</div>";
			}

 			#$path = 'id= data-role="" draggable="true" ondragstart="dragstart(this, event)"';
 			$path = 'data-role="'.$col['id'].'" id="caja'.$col['id'].'"';

            echo "  <div class='list-group-item draggable' $path>
						<div class='row box-content'>
							<div class='col-md-11 col-sm-12 col-xs-12 waves-effect'>
								<div class='material-icon-list-demo' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>
									<div class='icons'>
										<div class='row'>
											<div class='col-md-1 col-sm-2 col-xs-2'>
												<i class='mdi ".$iconfile[$type]."'></i>
											</div>
											<div class='col-md-11 col-sm-10 col-xs-10 p-l-0' style='margin-top:2px;'>
						                    	<span style='font-size:12px;'> $doc_firmado $nombredoc $exs $exxs $namtipo</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class='col-md-1 hidden-xs  hidden-sm'>".'			
	                    		<div class="btn-group" >
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    					<span class="caret"></span>
				    					<span class="sr-only">Toggle Dropdown</span>
		  							</button>
			  						<ul class="dropdown-menu">';
			  						?>
			  							<li <?php $c->Ayuda(85, 'tog') ?>><a href="#" onclick="LoadModal('','Propiedades del Documento - <?php echo $col["nombre"]; ?>','/gestion_anexos/fnnuevopropiedadesdocumento/<?php echo $col["id"]; ?>/')">Propiedades del Documento</a></li>

			    						<li <?php $c->Ayuda(85, 'tog') ?>><a href="#" onclick="LoadModal('','Cambiar Nombre del Documento - <?php echo $col["nombre"]; ?>','/gestion_anexos/fnpropiedadesdocumento/<?php echo $col["id"]; ?>/nombre/')">Cambiar Nombre</a></li>
			    						<li <?php $c->Ayuda(85, 'tog') ?>><a href="#" onclick="LoadModal('','Cambiar Nombre del Documento - <?php echo $col["nombre"]; ?>','/gestion_anexos/fnpropiedadesdocumento/<?php echo $col["id"]; ?>/tipodocumental/')">Cambiar Tipo Documental</a></li>

			    						
			    						<li <?php $c->Ayuda(85, 'tog') ?>><a href="#" onclick="LoadModal('','Mover a... - <?php echo $col["nombre"]; ?>','/gestion_anexos/fnpropiedadesdocumento/<?php echo $col["id"]; ?>/carpeta/')">Mover a Otra Carpeta</a></li>
			    						<li <?php $c->Ayuda(85, 'tog') ?> class="<?= M_ALERTA_COMPARTIDOS ?>" ><a href="#" onclick="LoadModal('','Compartir Documento - <?php echo $col["nombre"]; ?>','/gestion_anexos/fncompartirdocumento/<?php echo $col["id"]; ?>/')">Compartir Documento</a></li>
			    						<?php if ($_SESSION['MODULES']['digitalizacion'] == "0"): ?>
			    						<li <?php $c->Ayuda(85, 'tog') ?>  class="<?= M_ALERTA_FIRMAS ?>" ><a href="#" onclick="LoadModal('','Firmas del Documento - <?php echo $col["nombre"]; ?>','/gestion_anexos/fnfirmasdocumento/<?php echo $col["id"]; ?>/')">Firmas del Documento</a></li>
                        				<?php endif ?>

                        				<?

                        				$propietario_documento = false;
										if ($_SESSION['usuario'] == $col['user_id']) {
											$propietario_documento = true;
										}
										if ($_SESSION['sadmin'] == "1") {
											$propietario_documento = true;
										}
										if ($_SESSION['t_cuenta'] == "1") {
											$propietario_documento = true;
										}
										if ($propietario_documento) {
											if($_SESSION['eliminar'] == 1){

												echo "	<li onClick='ChangeStatusDoc(\"".$col['id']."\", \"0\")' ".$c->Ayuda('117', 'tog').">
											            	<a href='#'>Eliminar Documento</a> 
														</li>";
											}
										}


										if ($col['is_publico'] == "0") {
											echo "	<li onclick='changePublic(\"".$col['id']."\", \"1\")'>
														<a href='#'>
															Convertir este documento en Público
														</a>
													</li>"; #  "<option value='1'>SI</option>";	
										}else{
											echo "	<li onclick='changePublic(\"".$col['id']."\", \"0\")'>
														<a href='#'>
															Convertir este documento en Privado
														</a>
													</li>"; #  "<option value='0'>NO</option>";	

										}

			   						echo '</ul>
			   					</div>
			   				</div>
			   			</div>
			   		</div>';
        }else{
        	echo '<li class="list-group-item">';
        	echo "	<div class='row'>
						<div class='col-md-11 col-sm-12 waves-effect'>
							<div class='material-icon-list-demo'>
								<div class='icons'>
									<div>
					                    <i class='mdi mdi-file-find text-warning'></i>
					                    <span> $col[nombre]</span>".'
					                    <form action="/gestion_anexos/updatephoto/'.$col[0].'/" id="formpicture'.$col[0].'"  name="formpicture'.$col[0].'" method="post" enctype="multipart/form-data">
				        					<input name="archivo" id="selfile'.$col[0].'" type="file" size="35"/>
		      						</form>
							      	<script>
							      		$("#selfile'.$col[0].'").change(function() {
							      			$("#formpicture'.$col[0].'").submit();
							      		});
							      	</script>'."
									</div>
								</div>
							</div>
						</div>
						<div class='col-md-1 hidden-sm'>".'			
	                    		<div class="btn-group" '.$c->Ayuda(79, 'tog').'>
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    					<span class="caret"></span>
				    					<span class="sr-only">Toggle Dropdown</span>
		  							</button>
			  						<ul class="dropdown-menu">';
			  						?>
			    						<li <?php $c->Ayuda(85, 'tog') ?>><a href="#" onclick="LoadModal('','Propiedades del Documento - <?php echo $col["nombre"]; ?>','/gestion_anexos/fnpropiedadesdocumento/<?php echo $col["id"]; ?>/')">Propiedades del Documento</a></li>
			   						<?
			   						echo "</ul>
			   					</div>
			   				</div>

					</div>";
        	echo "  <!-- <input type='checkbox' name='servicio[]'  class='album_inner_button active_check' />-->";
			echo '</li>';
        }
    }

    echo "</div>
	<input type='hidden' id='id_documento'>";

    echo '<div class="btn-group m-t-30">';

    $querypag="SELECT count(*) as t from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '".$folder."'";
    $NroRegistros = $con->Result($con->Query($querypag), 0, 't');

    if($NroRegistros == 0){
    	echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';
    }

    $PagAnt=$PagAct-1;
    $PagSig=$PagAct+1;
    $PagUlt=$NroRegistros/$RegistrosAMostrar;
    $Res=$NroRegistros%$RegistrosAMostrar;

    if($Res>0) $PagUlt=floor($PagUlt)+1;
        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/1/\", \"cargador_box_upfiles_menu\")' >Pagina 1</button> ";
    if($PagAct>1) 
        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/".$PagAnt."/\", \"cargador_box_upfiles_menu\")'>Pagina Anterior.</button> ";
    echo "<button type='button' class='btn btn-default btn-outline waves-effect disabled' >Pagina ".$PagAct." de ".$PagUlt."</button>";
	if ($PagUlt > 5) {
		echo "<select onChange='GotoPag(this.value, \"".$id."\", \"".$folder."\")'  > ";
		echo "		<option value='".$PagAct."'>".$PagAct."</option>";
			for ($i=1; $i <  $PagUlt+1 ; $i++) { 
				if ($i != $PagAct) {
					echo "<option value='".$i."'>".$i."</option>";
				}
			}
		echo "</select>";                
	}

    if($PagAct<$PagUlt)  
    	echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/".$PagSig."/\", \"cargador_box_upfiles_menu\")'>Pagina Siguiente.</button> ";
    echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/".$PagUlt."/\", \"cargador_box_upfiles_menu\")'>Pagina. $PagUlt</button>";

    echo '</div>';

?>

<script type="text/javascript">

	function shoideitem(id, me){

		$(".bloq_data_anexo .inner_item_anexo").slideUp();

		$(".bl_pro").removeClass("active");

		if ($(".bloq_data_anexo #"+id).hasClass('active')) {

			$(".bloq_data_anexo #"+id).removeClass('active');

		}else{

			$(".bloq_data_anexo .inner_item_anexo").slideUp();

			$(".bloq_data_anexo #"+id).slideDown();		

			$(".bloq_data_anexo #"+id).addClass('active');		

			$("#"+me).addClass('active');

		}

	}

	$(".activarbuscador2").on("keyup", function(){

		var ide = $(this).attr('alt')

		$("#id_documento").val(ide);

		$(".bloquebusqueda2_"+ide).fadeIn();				

		$.ajax({

			type: "POST",

			url: '/usuarios/GestListadoUsuarios3/'+$(this).val()+"/",

			success: function(msg){

				result = msg;

				$(".bloquebusqueda2_"+ide).html(result);					

			}

		});				

	})

	$(".activarbuscador").on("keyup", function(){

		var ide = $(this).attr('alt')

		$("#id_documento").val(ide);

		$(".bloquebusqueda_"+ide).fadeIn();				

		$.ajax({

			type: "POST",

			url: '/usuarios/GestListadoUsuariosSuscriptores/'+$(this).val()+"/",

			success: function(msg){

				result = msg;

				$(".bloquebusqueda_"+ide).html(result);					

			}

		});				

	})

	function onTecla(e){	

		var num = e?e.keyCode:event.keyCode;

		if (num == 9 || num == 27){

			$(".bloquebusqueda_"+ide).fadeOut();		

		}

	}

	document.onkeydown = onTecla;

	if(document.all){

		document.captureEvents(Event.KEYDOWN);	

	}

	function AddUsuarioToListado3(nombre, email, id){

		$(".bloquebusqueda2").fadeOut();

		$("#whoishare2_"+$("#id_documento").val()).val(nombre);

		$("#id_usuario_"+$("#id_documento").val()).val(email);

	}

	function AddUsuarioToListado(nombre, email, id){

		if (email == "<?= $_SESSION['usuario'] ?>") {

				$(".activarbuscador").val("");

				$(".bloquebusqueda").fadeOut();		

				var URL = '/gestion_anexos_permisos/registrar/';

				var essuscriptor = '';

				if(email.indexOf("@") < 0){

					essuscriptor = 'S';

				}

		        var str = "id_documento="+$("#id_documento").val()+"&usuario_permiso="+id+"&observacion="+''+"&diasmaxtoresponse="+$("#diasmaxtoresponse_"+$("#id_documento").val()).val()+"&usuario_permiso_username="+email+"&essuscriptor="+essuscriptor;

		        $.ajax({

		            type: 'POST',

		            url: URL,

		            data: str,

		            success:function(msg){

		            	OpenWindow("/firmas_usuarios/firmar/"+msg+"/");
		            	showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu');


		            }

		        });

		}else{

			if ($("#diasmaxtoresponse_"+$("#id_documento").val()).val() == "0") {

				alert("Debe seleccionar de primero los días para revisar el expediente");

				$(".activarbuscador").val("");

				$(".bloquebusqueda").fadeOut();		

				return false;

			}else{

				if (confirm("¿Está seguro que desea solicitar revisar este documento con el usuario "+nombre+"?")) {

					var observacion = prompt("¿Algúna observación para este documento?");

					$(".activarbuscador").val("");

					$(".bloquebusqueda").fadeOut();		

					var URL = '/gestion_anexos_permisos/registrar/';

					var essuscriptor = '';

					if(email.indexOf("@") < 0){

						essuscriptor = 'S';

					}

			        var str = "id_documento="+$("#id_documento").val()+"&usuario_permiso="+id+"&observacion="+observacion+"&diasmaxtoresponse="+$("#diasmaxtoresponse_"+$("#id_documento").val()).val()+"&usuario_permiso_username="+email+"&essuscriptor="+essuscriptor;

			        $.ajax({

			            type: 'POST',

			            url: URL,

			            data: str,

			            success:function(msg){

			            	alert(msg);

			            	if (email == "<?= $_SESSION['usuario'] ?>") {

			            		alert("Envio la alerta al mismo usuario");

			            	};

			            	showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu');

			                //var string = "<li id='elm"+id+"_"+$("#id_documento").val()+"'><div class='t_listado' style='float:left'>"+nombre+"</div>"+'<div class="nom_anexo" style="float:right"><div class="mini-ico green-deact" style="float:left" title="El documento aún no ha sido revisado por el usuario '+email+'"></div></div>'+"</li>";

							//$("#listlookfor_"+$("#id_documento").val()).append(string);

			            }

			        });

				}else{

					$(".activarbuscador").val("");

					$(".bloquebusqueda").fadeOut();		

					return false;

				}

			}

		}

	}

	function UpdateFolderName(id){

		if (confirm("¿Está seguro que desea actualizar la carpeta?")) {

			fname = $("#foldername").val();
			type = $("#typefolder").val();

			$.ajax({

				type: "POST",

				url: '/gestion_folder/ActualizarNombre/'+id+"/"+fname+"/"+type+"/",

				success: function(msg){

				result = msg;

					alert(result);					

				}

			});			

		};

	}

	function DeleteFolder(id){

		if (confirm("¿Está seguro que desea Eliminar esta carpeta?")) {

			$.ajax({

				type: "POST",

				url: '/gestion_folder/eliminar/'+id+"/",

				success: function(msg){

					result = msg;

					alert(result);	

					window.location.reload();				

				}

			});			

		}

	}

	function UpdateGAnexo(id){

		if (confirm("¿Está Seguro que Actualizar Este Documento?")) {

			var str = $("#fromupdatedoc_"+id).serialize();

			$.ajax({

				type: "POST",

				data: str,

				url: '/gestion_anexos/actualizar/'+id+"/",

				success: function(msg){

					result = msg;

					//alert(msg);

					alert("Documento Actualizado");	

					showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu')

					//window.location.reload();				

				}

			});			

		}

	}

</script>