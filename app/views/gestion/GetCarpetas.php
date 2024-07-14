<?
    $ang = new MGestion_anexos;
	$object = new MGestion;
    $fol = new MGestion_folder;
	$object->CreateGestion("id", $id);
	$usua = new MUsuarios;
	$usua->CreateUsuarios("user_id", $_SESSION['usuario']);
    $isboss = false;
    $insuscriptor = false;
	$inshare = false;
 	$haveshared = false;
 	$haveshared2 = false;


    if (($_SESSION['t_cuenta'] == "1" && $usua->GetRegimen() == $object->GetDependencia_destino()) || $_SESSION['sadminid'] == "1") {
        $isboss = true;
    }

	$gc = new MGestion_compartir;
	$qn = $gc->ListarGestion_compartir(" where usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");
	$com = $con->NumRows($qn);

	if ($com >= 1) {
	    $inshare = true;
	    $gc->CreateGestion_compartirQuery("usuario_nuevo ='".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");
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
		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3')");
	}else{
		if($haveshared2 == true){
			$sql_a =" UNION SELECT ga.*,gap.* FROM gestion_anexos as ga inner join gestion_anexos_permisos_documentos as gap on gap.id_documento=ga.id left join gestion_anexos_permisos k on gap.id_documento=k.id_documento WHERE k.id_documento is null and ga.gestion_id = '".$id."' and ga.folder_id = '".$folder."' and gap.usuario_permiso = '".$_SESSION['usuario']."' and (ga.estado = '1' or ga.estado = '3')";
		}
		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3')");
	}

	$fol->CreateGestion_folder("id", $folder);


?>

<style type="text/css">
	.MIdropzone {
	    width: 100%;
	    height: 48px;
	    /* background: blueviolet; */
	    margin-bottom: 10px;
	    padding: 10px;
	    border: 1px solid #eee;
	}
</style>
<script type="text/javascript">
	var dragged;

  /* events fired on the draggable target */
  document.addEventListener("drag", function( event ) {

  }, false);

  document.addEventListener("dragstart", function( event ) {
      // store a ref. on the dragged elem
      dragged = event.target;
      // make it half transparent
      event.target.style.opacity = .5;
  }, false);

  	document.addEventListener("dragend", function( event ) {
      // reset the transparency
      	event.target.style.opacity = "";
        

  }, false);

  /* events fired on the drop targets */
  document.addEventListener("dragover", function( event ) {
      // prevent default to allow drop
      event.preventDefault();
  }, false);

  document.addEventListener("dragenter", function( event ) {
      // highlight potential drop target when the draggable element enters it
      if ( event.target.className == "MIdropzone" ) {
          event.target.style.background = "#F44335";
      }

  }, false);

  document.addEventListener("dragleave", function( event ) {
      // reset background of potential drop target when the draggable element leaves it
      if ( event.target.className == "MIdropzone" ) {
          event.target.style.background = "";
      }

  }, false);

  	document.addEventListener("drop", function( event ) {
      	// prevent default action (open as link for some elements)
      	event.preventDefault();
      	// move dragged elem to the selected drop target
      	if ( event.target.className == "MIdropzone" ) {
          	event.target.style.background = "#F44335";
          	dragged.parentNode.removeChild( dragged );
          	event.target.appendChild( dragged );

          	var id_folder = event.target.getAttribute("id");
          	var id_file = dragged.getAttribute("id");

          	var idfile = $("#"+id_file).attr("data-role");
			var idfolder = $("#"+id_folder).attr("data-role");
          
          //	alert("Elemento drageado: "+idfile+" Carpeta:"+idfolder);

          	URL = '/gestion_anexos/cambiarcarpetadocumento/'+idfile+'/'+idfolder+'/';
          	//alert(URL);
			$.ajax({
	            type: "POST",
	            url: URL,
	            success:function(msg){
	                //alert(msg);
	                window.location.reload()
	            }
	        }); 
          //alert("dropped: "+event);
      	}
  	}, false);
</script>


<input type="text" name="folder_id" id="folder_id" value="<?= $folder ?>" class="dn">
<div class="row">
	<div class="col-md-12 col-sm-12">
		<form action="javascript:BuscarAnexoGestion('<?= $id ?>');" id="searchanexo" class="form-horizontal">
            <div class="form-group m-t-5">
                <div class="input-group">
                	<input type="hidden" id="searchfilterid" value="<?= $id ?>">
                    <input type="email" name="searchfilter" id="searchfilter" class="form-control" placeholder="Buscar Documentos Aqui"> 
                    <span class="input-group-btn">
						<button type="button"  onclick='BuscarAnexoGestion("<?= $id ?>")' class="btn waves-effect waves-light btn-info " <?= $c->Ayuda('59', 'tog') ?>><span class="fa fa-search"></span></button>
					</span> 
				</div>
                
            </div>
            <!-- form-group -->
        </form>
	</div>
	<div class="col-md-12 col-sm-12">
		<button class="btn btn-info waves-effect waves-light m-b-10 dn" type="button" onClick='LoadModal("", "Cargar Nuevo Documento", "/gestion_anexos/nuevo/<?= $id ?>/<?= $folder ?>/")'>
			<span class="btn-label"><i class="fa fa-plus"></i></span>Cargar Documentos
		</button>
		<button class="btn btn-info waves-effect waves-light m-b-10 " type="button" onClick='AdministrarDocumentos("<?= $id ?>")'>
			<span class="btn-label"><i class="fa fa-plus"></i></span>Administrar Documentos
		</button>
<?php 
	if ($_SESSION['MODULES']['digitalizacion'] == "0"): 
?>
		<button class="btn btn-info waves-effect waves-light m-b-10" type="button" <?= $c->Ayuda('57', 'tog') ?> onClick='LoadModal("", "Crear Carpeta", "/gestion_folder/nuevo/<?= $folder ?>/<?= $id ?>/")'>
			<span class="btn-label"><i class="fa fa-plus"></i></span>Crear Carpeta
		</button>
<?
	    if ($folder != "0") {
?>

<?
		}
	    if ($_SESSION['sadmin'] == "1") {
?>
			<button class="btn btn-warning waves-effect waves-light m-b-10" type="button" <?= $c->Ayuda('60', 'tog') ?> onclick="OpenWindow(\'/gestion_anexos/descargarfullexpediente/'.$id.'/\')">
			<span class="btn-label"><i class="fa fa-cloud-download"></i></span>Descargar Todo el Expediente
			</button>
<?
		}
 	endif 
?>
	</div>
</div>
<?
	if ($folder != "0") {
		$typefol = ($fol->GetTipo() == "1")?"mdi-folder":"mdi-folder-lock";
?>
<div class="row">
	<div class="col-md-11">
		<h4><span class="mdi <?= $typefol ?>  text-warning " <?= $c->Ayuda('58', 'tog') ?>></span> <?= $fol->GetNombre(); ?></h4>
	</div>
	<div class='col-md-1 hidden-xs  hidden-sm'>			
		<div class="btn-group" >
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="#" onClick='LoadModal("", "Editar Carpeta", "/gestion_folder/editar/<?= $fol->GetId() ?>/")' >Editar Carpeta</a></li>
					<li><a href="#" onClick="DeleteFolder('<?= $fol->GetId() ?>')">Eliminar Carpeta</a></li>

					
				</ul>
		</div>
	</div>
</div>

<?
	}

	

	if ($folder != "0") {


		$patdrag = 'data-role="'.$fol->GetFolder_id().'" id="content'.$fol->GetFolder_id().'"';
		$patdrag2 = 'data-role="'.$fol->GetFolder_id().'" id="cnt'.$fol->GetFolder_id().'"';

        echo "  <div class='MIdropzone' style='cursor:pointer' $patdrag onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$fol->GetFolder_id()."/1/\", \"cargador_box_upfiles_menu\")' >
		            <span class='mdi $typefol text-warning'></span><span  class='MIdropzone' style='cursor:pointer; font-size:12px; border:none;' $patdrag2> Carpeta Anterior</span>
                </div>";
	}

	while($rfolder = $con->FetchAssoc($queryf)){
		$typefol = ($rfolder["tipo"] == "1")?"mdi-folder":"mdi-folder-lock";

		//$patdrag = 'data-role="'.$rfolder['id'].'" id="content'.$rfolder['id'].'"';

        echo "  
        <div class='MIdropzone' data-role='".$rfolder['id']."' id='bloque-".$rfolder['id']."' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$rfolder['id']."/1/\", \"cargador_box_upfiles_menu\")' style='cursor:pointer'>

				<span class='mdi $typefol text-warning'></span><span style='cursor:pointer; font-size:12px; border:none;' class='MIdropzone' data-role='".$rfolder['id']."' id='blq-".$rfolder['id']."'> $rfolder[nombre]</span>

        </div>";
	}
	echo '<div class="list-group">';
    #echo "</div>";
?>
<script type="text/javascript">
	$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>