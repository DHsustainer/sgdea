<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>
			<?
			    $permisos = $_SESSION['vector'][3];
			    $module = $_REQUEST['m'];
			    $exist = true;
			    global $f;
			    for ($k=0; $k < count($permisos) ; $k++) { 
			    	$link = explode(":", $permisos[$k])	;
			    	if ($module == $link[1]) {

			    		$suscaccs = new MSuscriptores_accesos;
						$suscaccs->CreateSuscriptores_accesos('id_suscriptor', $id);

						if ($suscaccs->GetId() == "") {
							
							$rand = hash("sha256", $f->GenerarSmallId().$id.date("Y-m-d"));
							$suscaccs->InsertSuscriptores_accesos($id, "", $rand, "", "", "", "", "", "", "");
							
							$suscaccs->CreateSuscriptores_accesos('id_suscriptor', $id);
						}

						$s = new MSuscriptores_contactos;
						$s->CreateSuscriptores_contactos("id", $id);

				        echo '<span class="fa '.$link[2].'"></span>'.$link[0].' Para: '.$s->GetNombre();
				        $exist = true;
				        break;
			    	}else{
			    		$exist = false;
			    	}
			    }
			?>
			</h2>
		</div>
	</div>
<?
	if ($exist) {
?>	
	<div class="row">
		<div class="col-md-12" id="main_form_suscriptores_modulos">
			<?
				include(VIEWS.DS."suscriptores_accesos/FormUpdateSuscriptores_accesos.php");
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h2>
				<?
			    $permisos = $_SESSION['vector'][2];
			    $module = 'control_versiones';
			    $exist = true;
			    global $f;
			    for ($k=0; $k < count($permisos) ; $k++) { 
			    	$link = explode(":", $permisos[$k])	;
			    	if ($module == $link[1]) {

			    		$suscaccs = new MSuscriptores_accesos;
						$suscaccs->CreateSuscriptores_accesos('id_suscriptor', $id);

						if ($suscaccs->GetId() == "") {
							
							$rand = hash("sha256", $f->GenerarSmallId().$id.date("Y-m-d"));
							$suscaccs->InsertSuscriptores_accesos($id, "", $rand, "", "", "", "", "", "", "");
							
							$suscaccs->CreateSuscriptores_accesos('id_suscriptor', $id);
						}

						$s = new MSuscriptores_contactos;
						$s->CreateSuscriptores_contactos("id", $id);

				        echo '<span class="fa '.$link[2].'"></span>'.$link[0].' Para: '.$s->GetNombre();
				        $exist = true;
				        break;
			    	}else{
			    		$exist = false;
			    	}
			    }
			?>
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12" id="main_form_suscriptores_modulos">
			<?
				include(VIEWS.DS."suscriptores_control_versiones/Listar.php");
			?>
		</div>
	</div>
<?
	}
?>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>