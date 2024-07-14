<?
	$l = new MEvents_gestion;
	$l->Createevents_gestion('id', $id);

	$type = $type_ev[$l->GetStatus()];
	$typee = "";

	if ($l -> GetType_event() == "0") {
		$typee = "Actuación generada automaticamente";
	}

	if ($l->Getelm_type() == "lsus") {
		$userna    = $c->GetDataFromTable("suscriptores_contactos", "id", $l->GetUser_id(), "nombre", $separador = " ")." / <b>SUSCRIPTOR</b>";
	}else{
		$us = new MUsuarios;
		$us->CreateUsuarios("user_id", $l->GetUser_id());
		$userna = $us->GetP_nombre()." ".$us->GetP_apellido();
	}

	$pic = HOMEDIR.DS."app/plugins/thumbnails/";
	$grupo = "";

	if ($l->GetGrupo() == "*") {
		$pic .= $c->GetDataFromTable("super_admin", "id", "6", "foto_perfil", " ");
		$grupo = "Todos los Usuarios";
	}else{
		$pic .= $c->GetDataFromTable("usuarios", "a_i", $l->GetGrupo(), "foto_perfil", " ");
		$grupo = $c->GetDataFromTable("usuarios", "a_i", $l->GetGrupo(), "p_nombre, p_apellido", " ");;
	}
	
	$typeevent = "";
	if ($l->GetEs_publico() == "0") {
		$typeevent = '<div><span class="label label-success">Actuación Privada</span></div>';
	}else{
		$typeevent = '<div><span class="label label-info">Actuación Publica</span></div>';
	}
?>			
		<div class="media" id="row<?= $l->GetId() ?>">
            <div class="media-left">
                <a href="javascript:void(0)"> <img alt="64x64" class="media-object" title="<?= $grupo ?>" src="<?= $pic ?>" data-holder-rendered="true" style="width: 64px; height: 64px;"> </a>
            </div>
            <div class="media-body">
	            <h4 class="media-heading">
	            	<?php echo $l -> GetTitle(); ?>
	            </h4> 
	            	<?php echo $typeevent; ?> 
					<p class="font-12 m-t-10 m-b-10 text-muted">Creado el <?php echo $f->ObtenerFecha4($l -> GetFecha()." ".$l -> GetTime())." Por ".$userna ?></p>
		        <p><?php echo $l -> GetDescription(); ?></p>
            </div>
            <div class="media-footer pull-right">
            	<a href="/gestion/ver/<?= $l->GetGestion_id() ?>/alertas/" class="btn btn-primary" target="_blank">Ir al Expediente </a>
             
            </div>
        </div>