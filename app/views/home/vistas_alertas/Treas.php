<?
global $c;
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>

<div class="row fullheight">
	<div class="col-md-12">
		<ul class="nav nav-pills m-b-30 " role="tablist" id="tab_navegacion_widgets">
	<?
		$itdt = $id;
		$totd = 1;
		$tots = 1;
		$totc = 1;

		$menuactivea = "display:block";
		$menuactiveb = "";
		$menuactivec = "";

		$tabactivea = "active";
		$tabactiveb = "";
		$tabactivec = "";

		if ($totd <= 0) {
			if ($tots > 0) {
				$menuactiveb = "display:block;";
				$tabactiveb = "active";

				$menuactivea = "";
				$tabactivea = "";
				$menuactivec = "";
				$tabactivec = "";

			}elseif ($totc > 0) {

				$menuactivec = "display:block;";
				$tabactivec = "active";

				$menuactivea = "";
				$tabactivea = "";
				$menuactiveb = "";
				$tabactiveb = "";
			}else{

				$menuactivea = "display:block";
				$menuactiveb = "";
				$menuactivec = "";

				$tabactivea = "active";
				$tabactiveb = "";
				$tabactivec = "";

			}
		}
	?>
			<li onClick="CargarAlerta2('1', 'Tareas', 'tareas', '1', 'tab1');ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" <?= $c->Ayuda('149', 'tog') ?> class="<?= $tabactivea ?>"><a href="#">Tareas Pendientes / En Curso</a></li>
			<li onClick="CargarAlerta2('1', 'Tareas', 'tareas', '1', 'tab3');ActivarTab('tab3', 'buscartab3')" id="buscartab3" role="presentation" <?= $c->Ayuda('151', 'tog') ?> class="<?= $tabactivec ?>"><a href="#">Tareas Atrasadas</a></li>
			<li onClick="CargarAlerta2('1', 'Tareas', 'tareas', '1', 'tab2');ActivarTab('tab2', 'buscartab2')" id="buscartab2" role="presentation" <?= $c->Ayuda('150', 'tog') ?> class="<?= $tabactiveb ?>"><a href="#">Tareas Realizadas</a></li>
		</ul>
		<div class="col-md-12 busquedaresultadotab" id="tab1" style="<?= $menuactivea ?>">
<div class="row">
	<div class="col-md-12 m-t-10 m-b-20">
		<div class="list-group">
			<h3>Actividades Pendientes / En Curso</h3>
<?

	global $f;
	global $c;

	$ev = new MEvents_gestion;
	$query = $ev->ListarEvents_gestion(" WHERE status = '1' and type_event = '1' and (grupo = '".$_SESSION['user_ai']."' or user_id = '".$_SESSION['usuario']."') and grupo != '*' ", "order by fecha desc, time desc");

	$type_ev = array("1" => "activo", "0" => "echo", "2" => "anulado", "3" => "retrasado");

	while($row = $con->FetchAssoc($query)){

		$l = new MEvents_gestion;
		$l->Createevents_gestion('id', $row[id]);

		$g = new MGestion;
		$g->CreateGestion("id", $l->GetGestion_id());
		$radicado = $g->GetRadicado();
		if ($g->GetRadicado() == "") {
			$radicado = $g->GetMin_rad();
		}

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


		$mr = "";

		$pic = HOMEDIR.DS."app/plugins/thumbnails/";
		$picx = HOMEDIR.DS."app/plugins/thumbnails/";

		$grupo = "";

		if ($l->GetGrupo() == "*") {
			$pic .= $c->GetDataFromTable("super_admin", "id", "6", "foto_perfil", " ");
			$grupo = "Todos los Usuarios";
		}else{
			$pic .= $c->GetDataFromTable("usuarios", "user_id", $l->GetUser_id(), "foto_perfil", " ");
			$grupo = $c->GetDataFromTable("usuarios", "a_i", $l->GetGrupo(), "p_nombre, p_apellido", " ");;
		}
		
		$typeevent = "";
		if ($l->GetEs_publico() == "0") {
			$typeevent = '<span class="label label-success"><span class="fa fa-lock"></span> Privada</span>';
		}else{
			$typeevent = '<span class="label label-info"><span class="fa fa-unlock"></span> Publica</span>';
		}

		$typeremd = "";
		if ($l->Getes_recordatorio() == "0") {
			$typeremd = '<span class="label label-info m-l-10"><span class="fa fa-info"></span> Actuación</span>';
		}else{
			$typeremd = '<span class="label label-warning m-l-10"><span class="fa fa-star"></span> Recordatorio</span>';
		}

		$estadoactual = "";
		if ($l->GetFecha() < date("Y-m-d")) {
			$l->SetStatus("3");
		}
		$switchcheck = "btn-default";
		$switcherror = "btn-default";
		switch ($l->Getstatus()) {
			case '0':

				$estadoactual = '<span class="label label-success m-l-10"><span class="fa fa-check"></span> Realizada</span>';
				$switchcheck = "btn-success";

				break;
			case '1':
				if ($l->GetFecha() < date("Y-m-d")) {
					$estadoactual = '<span class="label label-info m-l-10"><span class="fa fa-clock-o"></span> En Espera</span>';
				}else{
					$estadoactual = '<span class="label label-info m-l-10"><span class="fa fa-coffee"></span> En Curso</span>';
				}
				break;
			case '2':
				$estadoactual = '<span class="label label-danger m-l-10"><span class="fa fa-times"></span> Anulada</span>';
				$switcherror = "btn-danger";
				break;
			case '3':
				$estadoactual = '<span class="label label-danger m-l-10"><span class="fa fa-warning"></span> Atrasada</span>';
				break;		
			default:
				$estadoactual = '<span class="label label-info m-l-10"><span class="fa fa-coffee"></span> En Curso</span>';
				break;
		}

		if ($l->Getgrupo() != "*") {
			$ud = new MUsuarios;
			$ud->CreateUsuarios("a_i", $l->GetGrupo());

			if ($ud->GetUser_id() != $us->GetUser_id()) {
				$mr = '	
						<h2 class="text-muted" align="center"><span class="fa fa-angle-double-down"></span></h2>
		                    <a href="javascript:void(0)"> <img alt="64x64" class="media-object" src="'.$picx.$ud->GetFoto_perfil().'" data-holder-rendered="true" style="width: 64px; height: 64px;" data-toggle="popover" data-trigger="hover" data-content="'.$grupo.': Usuario al que se le asigna la Actividad" data-placement="right" data-original-title=""> </a>
		                ';
			}
			
		}

		if (trim($userna) == trim($grupo)) {
			$userna == "El mismo";
		}

?>			
		<div class="media" id="row<?= $l->GetId() ?>">
            <div class="media-left">
                <a href="javascript:void(0)"> <img alt="64x64" class="media-object" src="<?= $pic ?>" data-holder-rendered="true" style="width: 64px; height: 64px;" data-toggle="popover" data-trigger="hover" data-content="<?= $userna ?>: Usuario que crea la Actividad" data-placement="right" data-original-title=""> </a>
                <?= $mr ?>
            </div>
            <div class="media-body">
	            <h4 class="media-heading">
	            	<?php echo $radicado." - ".$l -> GetTitle(); ?>
	            </h4> 
	            <div class="row m-b-10">
	            	<div class="col-md-8">
	            		<div class="m-t-10">
	            		<?php echo $typeevent.$typeremd.$estadoactual; ?> 
	            		</div>
	            	</div>
	            	<div class="col-md-4">
					<?
					   	if ($_SESSION['suscriptor_id'] == "") {
					?>
						<div class="btn-group pull-right navigation_bar">
							<button type="button" onclick='EditarEvents_gestion(<?= $l->GetId() ?>)' class="btn btn-default waves-effect">
								<i class="fa fa-pencil"></i>
							</button>
							<button type="button" id="navprev" onclick="ChangeStatusAlertav2('<?= $l->GetId() ?>', '0')" class="btn <?= $switchcheck ?> waves-effect">
								<i class="fa fa-check"></i>
							</button>
							<button type="button" id="navnext" onclick="ChangeStatusAlertav2('<?= $l->GetId() ?>', '2')" class="btn <?= $switcherror ?> waves-effect">
								<i class="fa fa-times"></i>
							</button>
						</div>
					<?
					   	}
					?>      		
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
						<small class="text-muted">Creado el <?php echo $f->ObtenerFecha4($l -> GetFecha()." ".$l -> GetTime())." Por ".$userna ?> para <? echo $grupo; ?></small>
	            	</div>
	            </div>
	            <div class="row m-t-10">
	            	<div class="col-md-12">
                		<p>
                		<?php 
	                		if ($l -> GetDescription() == "") {
	                			echo '<em>Sin Descripción...</em>';
	                		}else{
	                			echo $l -> GetDescription(); 
	                		}
	                	?>
	                	</p>
	            	</div>
	            </div>
	            <hr>
                <?
                	$doc = $con->Query("select * from gestion_anexos where id_event = '".$l->GetId()."'");
                	$docg  = $con->FetchAssoc($doc);

                	if ($docg['id'] != "") {

                		$ga = new MGestion_anexos;
                		$ga->CreateGestion_anexos("id", $docg['id']);

                		$url = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$ga->GetGestion_id().'/anexos/'.$ga->GetUrl();

                		$link = '<a href="'.$url.'" target="_blank">'.$ga->GetNombre().'</a>';

                		echo '	<p>
				                	<i class="mdi mdi-paperclip"> <small>Archivo Adjunto: '.$link.'</small> </i>
				                </p>';
                	}
                ?>
            </div>
            
        </div>			
<?
	}
?>
		</div>
	</div>
</div>
		</div>
		<div class="busquedaresultadotab" id="tab2" style="<?= $menuactiveb ?>">
<div class="row">
	<div class="col-md-12 m-t-10 m-b-20">
		<div class="list-group">
			<h3>Actividades Realizadas</h3>
<?
	global $f;
	global $c;

	$ev = new MEvents_gestion;
	$query = $ev->ListarEvents_gestion(" WHERE status in ('1', '2') and type_event = '1'  and (grupo = '".$_SESSION['user_ai']."' or user_id = '".$_SESSION['usuario']."') and grupo != '*'", "order by fecha desc, time desc");

	$type_ev = array("1" => "activo", "0" => "echo", "2" => "anulado", "3" => "retrasado");

	while($row = $con->FetchAssoc($query)){

		$l = new MEvents_gestion;
		$l->Createevents_gestion('id', $row[id]);

		$g = new MGestion;
		$g->CreateGestion("id", $l->GetGestion_id());
		$radicado = $g->GetRadicado();
		if ($g->GetRadicado() == "") {
			$radicado = $g->GetMin_rad();
		}

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


		$mr = "";

		$pic = HOMEDIR.DS."app/plugins/thumbnails/";
		$picx = HOMEDIR.DS."app/plugins/thumbnails/";

		$grupo = "";

		if ($l->GetGrupo() == "*") {
			$pic .= $c->GetDataFromTable("super_admin", "id", "6", "foto_perfil", " ");
			$grupo = "Todos los Usuarios";
		}else{
			$pic .= $c->GetDataFromTable("usuarios", "user_id", $l->GetUser_id(), "foto_perfil", " ");
			$grupo = $c->GetDataFromTable("usuarios", "a_i", $l->GetGrupo(), "p_nombre, p_apellido", " ");;
		}
		
		$typeevent = "";
		if ($l->GetEs_publico() == "0") {
			$typeevent = '<span class="label label-success"><span class="fa fa-lock"></span> Privada</span>';
		}else{
			$typeevent = '<span class="label label-info"><span class="fa fa-unlock"></span> Publica</span>';
		}

		$typeremd = "";
		if ($l->Getes_recordatorio() == "0") {
			$typeremd = '<span class="label label-info m-l-10"><span class="fa fa-info"></span> Actuación</span>';
		}else{
			$typeremd = '<span class="label label-warning m-l-10"><span class="fa fa-star"></span> Recordatorio</span>';
		}

		$estadoactual = "";
		if ($l->GetFecha_vencimiento() < date("Y-m-d")) {
			$l->SetStatus("3");
		}
		$switchcheck = "btn-default";
		$switcherror = "btn-default";
		switch ($l->Getstatus()) {
			case '0':

				$estadoactual = '<span class="label label-success m-l-10"><span class="fa fa-check"></span> Realizada</span>';
				$switchcheck = "btn-success";

				break;
			case '1':
				if ($l->GetFecha() < date("Y-m-d")) {
					$estadoactual = '<span class="label label-info m-l-10"><span class="fa fa-clock-o"></span> En Espera</span>';
				}else{
					$estadoactual = '<span class="label label-info m-l-10"><span class="fa fa-coffee"></span> En Curso</span>';
				}
				break;
			case '2':
				$estadoactual = '<span class="label label-danger m-l-10"><span class="fa fa-times"></span> Anulada</span>';
				$switcherror = "btn-danger";
				break;
			case '3':
				$estadoactual = '<span class="label label-danger m-l-10"><span class="fa fa-warning"></span> Atrasada</span>';
				break;		
			default:
				$estadoactual = '<span class="label label-info m-l-10"><span class="fa fa-coffee"></span> En Curso</span>';
				break;
		}

		if ($l->Getgrupo() != "*") {
			$ud = new MUsuarios;
			$ud->CreateUsuarios("a_i", $l->GetGrupo());

			if ($ud->GetUser_id() != $us->GetUser_id()) {
				$mr = '	
						<h2 class="text-muted" align="center"><span class="fa fa-angle-double-down"></span></h2>
		                    <a href="javascript:void(0)"> <img alt="64x64" class="media-object" src="'.$picx.$ud->GetFoto_perfil().'" data-holder-rendered="true" style="width: 64px; height: 64px;" data-toggle="popover" data-trigger="hover" data-content="'.$grupo.': Usuario al que se le asigna la Actividad" data-placement="right" data-original-title=""> </a>
		                ';
			}
			
		}

		if (trim($userna) == trim($grupo)) {
			$userna == "El mismo";
		}

?>			
		<div class="media" id="row<?= $l->GetId() ?>">
            <div class="media-left">
                <a href="javascript:void(0)"> <img alt="64x64" class="media-object" src="<?= $pic ?>" data-holder-rendered="true" style="width: 64px; height: 64px;" data-toggle="popover" data-trigger="hover" data-content="<?= $userna ?>: Usuario que crea la Actividad" data-placement="right" data-original-title=""> </a>
                <?= $mr ?>
            </div>
            <div class="media-body">
	            <h4 class="media-heading">
	            	<?php echo $radicado." - ".$l -> GetTitle(); ?>
	            </h4> 
	            <div class="row m-b-10">
	            	<div class="col-md-8">
	            		<div class="m-t-10">
	            		<?php echo $typeevent.$typeremd.$estadoactual; ?> 
	            		</div>
	            	</div>
	            	<div class="col-md-4">
					<?
					   	if ($_SESSION['suscriptor_id'] == "") {
					?>
						<div class="btn-group pull-right navigation_bar">
							<button type="button" onclick='EditarEvents_gestion(<?= $l->GetId() ?>)' class="btn btn-default waves-effect">
								<i class="fa fa-pencil"></i>
							</button>
							<button type="button" id="navprev" onclick="ChangeStatusAlertav2('<?= $l->GetId() ?>', '0')" class="btn <?= $switchcheck ?> waves-effect">
								<i class="fa fa-check"></i>
							</button>
							<button type="button" id="navnext" onclick="ChangeStatusAlertav2('<?= $l->GetId() ?>', '2')" class="btn <?= $switcherror ?> waves-effect">
								<i class="fa fa-times"></i>
							</button>
						</div>
					<?
					   	}
					?>      		
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
						<small class="text-muted">Creado el <?php echo $f->ObtenerFecha4($l -> GetFecha()." ".$l -> GetTime())." Por ".$userna ?> para <? echo $grupo; ?></small>
	            	</div>
	            </div>
	            <div class="row m-t-10">
	            	<div class="col-md-12">
                		<p>
                		<?php 
	                		if ($l -> GetDescription() == "") {
	                			echo '<em>Sin Descripción...</em>';
	                		}else{
	                			echo $l -> GetDescription(); 
	                		}
	                	?>
	                	</p>
	            	</div>
	            </div>
	            <hr>
                <?
                	$doc = $con->Query("select * from gestion_anexos where id_event = '".$l->GetId()."'");
                	$docg  = $con->FetchAssoc($doc);

                	if ($docg['id'] != "") {

                		$ga = new MGestion_anexos;
                		$ga->CreateGestion_anexos("id", $docg['id']);

                		$url = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$ga->GetGestion_id().'/anexos/'.$ga->GetUrl();

                		$link = '<a href="'.$url.'" target="_blank">'.$ga->GetNombre().'</a>';

                		echo '	<p>
				                	<i class="mdi mdi-paperclip"> <small>Archivo Adjunto: '.$link.'</small> </i>
				                </p>';
                	}
                ?>
            </div>
            
        </div>			
<?
	}
?>
		</div>
	</div>
</div>
		</div>
		<div class="busquedaresultadotab" id="tab3" style="<?= $menuactivec ?>">
<div class="row">
	<div class="col-md-12 m-t-10 m-b-20">
		<div class="list-group">
			<h3>Actividades Pendientes / Vencidas</h3>
<?
	global $f;
	global $c;

	$ev = new MEvents_gestion;
	$query = $ev->ListarEvents_gestion(" WHERE status = '1' and type_event = '1' and fecha < '".date("Y-m-d")."'  and (grupo = '".$_SESSION['user_ai']."' or user_id = '".$_SESSION['usuario']."') and grupo != '*' ", "order by fecha desc, time desc");


	$type_ev = array("1" => "activo", "0" => "echo", "2" => "anulado", "3" => "retrasado");

	while($row = $con->FetchAssoc($query)){

		$l = new MEvents_gestion;
		$l->Createevents_gestion('id', $row[id]);

		$g = new MGestion;
		$g->CreateGestion("id", $l->GetGestion_id());
		$radicado = $g->GetRadicado();
		if ($g->GetRadicado() == "") {
			$radicado = $g->GetMin_rad();
		}

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


		$mr = "";

		$pic = HOMEDIR.DS."app/plugins/thumbnails/";
		$picx = HOMEDIR.DS."app/plugins/thumbnails/";

		$grupo = "";

		if ($l->GetGrupo() == "*") {
			$pic .= $c->GetDataFromTable("super_admin", "id", "6", "foto_perfil", " ");
			$grupo = "Todos los Usuarios";
		}else{
			$pic .= $c->GetDataFromTable("usuarios", "user_id", $l->GetUser_id(), "foto_perfil", " ");
			$grupo = $c->GetDataFromTable("usuarios", "a_i", $l->GetGrupo(), "p_nombre, p_apellido", " ");;
		}
		
		$typeevent = "";
		if ($l->GetEs_publico() == "0") {
			$typeevent = '<span class="label label-success"><span class="fa fa-lock"></span> Privada</span>';
		}else{
			$typeevent = '<span class="label label-info"><span class="fa fa-unlock"></span> Publica</span>';
		}

		$typeremd = "";
		if ($l->Getes_recordatorio() == "0") {
			$typeremd = '<span class="label label-info m-l-10"><span class="fa fa-info"></span> Actuación</span>';
		}else{
			$typeremd = '<span class="label label-warning m-l-10"><span class="fa fa-star"></span> Recordatorio</span>';
		}

		$estadoactual = "";
		if ($l->GetFecha_vencimiento() < date("Y-m-d")) {
			$l->SetStatus("3");
		}
		$switchcheck = "btn-default";
		$switcherror = "btn-default";
		switch ($l->Getstatus()) {
			case '0':

				$estadoactual = '<span class="label label-success m-l-10"><span class="fa fa-check"></span> Realizada</span>';
				$switchcheck = "btn-success";

				break;
			case '1':
				if ($l->GetFecha() < date("Y-m-d")) {
					$estadoactual = '<span class="label label-info m-l-10"><span class="fa fa-clock-o"></span> En Espera</span>';
				}else{
					$estadoactual = '<span class="label label-info m-l-10"><span class="fa fa-coffee"></span> En Curso</span>';
				}
				break;
			case '2':
				$estadoactual = '<span class="label label-danger m-l-10"><span class="fa fa-times"></span> Anulada</span>';
				$switcherror = "btn-danger";
				break;
			case '3':
				$estadoactual = '<span class="label label-danger m-l-10"><span class="fa fa-warning"></span> Atrasada</span>';
				break;		
			default:
				$estadoactual = '<span class="label label-info m-l-10"><span class="fa fa-coffee"></span> En Curso</span>';
				break;
		}

		if ($l->Getgrupo() != "*") {
			$ud = new MUsuarios;
			$ud->CreateUsuarios("a_i", $l->GetGrupo());

			if ($ud->GetUser_id() != $us->GetUser_id()) {
				$mr = '	
						<h2 class="text-muted" align="center"><span class="fa fa-angle-double-down"></span></h2>
		                    <a href="javascript:void(0)"> <img alt="64x64" class="media-object" src="'.$picx.$ud->GetFoto_perfil().'" data-holder-rendered="true" style="width: 64px; height: 64px;" data-toggle="popover" data-trigger="hover" data-content="'.$grupo.': Usuario al que se le asigna la Actividad" data-placement="right" data-original-title=""> </a>
		                ';
			}
			
		}

		if (trim($userna) == trim($grupo)) {
			$userna == "El mismo";
		}

?>			
		<div class="media" id="row<?= $l->GetId() ?>">
            <div class="media-left">
                <a href="javascript:void(0)"> <img alt="64x64" class="media-object" src="<?= $pic ?>" data-holder-rendered="true" style="width: 64px; height: 64px;" data-toggle="popover" data-trigger="hover" data-content="<?= $userna ?>: Usuario que crea la Actividad" data-placement="right" data-original-title=""> </a>
                <?= $mr ?>
            </div>
            <div class="media-body">
	            <h4 class="media-heading">
	            	<?php echo $radicado." - ".$l -> GetTitle(); ?>
	            </h4> 
	            <div class="row m-b-10">
	            	<div class="col-md-8">
	            		<div class="m-t-10">
	            		<?php echo $typeevent.$typeremd.$estadoactual; ?> 
	            		</div>
	            	</div>
	            	<div class="col-md-4">
					<?
					   	if ($_SESSION['suscriptor_id'] == "") {
					?>
						<div class="btn-group pull-right navigation_bar">
							<button type="button" onclick='EditarEvents_gestion(<?= $l->GetId() ?>)' class="btn btn-default waves-effect">
								<i class="fa fa-pencil"></i>
							</button>
							<button type="button" id="navprev" onclick="ChangeStatusAlertav2('<?= $l->GetId() ?>', '0')" class="btn <?= $switchcheck ?> waves-effect">
								<i class="fa fa-check"></i>
							</button>
							<button type="button" id="navnext" onclick="ChangeStatusAlertav2('<?= $l->GetId() ?>', '2')" class="btn <?= $switcherror ?> waves-effect">
								<i class="fa fa-times"></i>
							</button>
						</div>
					<?
					   	}
					?>      		
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
						<small class="text-muted">Creado el <?php echo $f->ObtenerFecha4($l -> GetFecha()." ".$l -> GetTime())." Por ".$userna ?> para <? echo $grupo; ?></small>
	            	</div>
	            </div>
	            <div class="row m-t-10">
	            	<div class="col-md-12">
                		<p>
                		<?php 
	                		if ($l -> GetDescription() == "") {
	                			echo '<em>Sin Descripción...</em>';
	                		}else{
	                			echo $l -> GetDescription(); 
	                		}
	                	?>
	                	</p>
	            	</div>
	            </div>
	            <hr>
                <?
                	$doc = $con->Query("select * from gestion_anexos where id_event = '".$l->GetId()."'");
                	$docg  = $con->FetchAssoc($doc);

                	if ($docg['id'] != "") {

                		$ga = new MGestion_anexos;
                		$ga->CreateGestion_anexos("id", $docg['id']);

                		$url = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$ga->GetGestion_id().'/anexos/'.$ga->GetUrl();

                		$link = '<a href="'.$url.'" target="_blank">'.$ga->GetNombre().'</a>';

                		echo '	<p>
				                	<i class="mdi mdi-paperclip"> <small>Archivo Adjunto: '.$link.'</small> </i>
				                </p>';
                	}
                ?>
            </div>
            
        </div>			
<?
	}
?>
		</div>
	</div>
</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
	});

	function ActivarTab(tab, selector){

		$("#buscartab1").removeClass('active');
		$("#buscartab2").removeClass('active');
		$("#buscartab3").removeClass('active');

		$("#tab1").css('display', 'none');
		$("#tab2").css('display', 'none');
		$("#tab3").css('display', 'none');

		$("#"+selector).addClass("active");
		$("#"+tab).css("display", 'block');

	}
	ActivarTab('<?php echo $tab; ?>', 'buscar<?php echo $tab; ?>');
</script>
<style type="text/css">
	
	.busquedaresultadotab{
	    min-height: 400px;
	    border-top: none;
	    margin-top: -1px;
	    display: none;
	}

	#tab_navegacion_widgets.nav>li>a {
	    position: relative;
	    display: block;
	    padding: 10px 15px;
	}

</style>
<style type="text/css">
	.sub_titulo{
		margin-left: 5px;
		font-size: 12px;
	}
	.descripcion{
		margin: 10px;
		margin-left: 20px;
		border: 1px dashed #EDEDED;
		padding:10px;
	}
	.looksuscriptor:hover{ background-color: #f5f5f5; }
	.looksuscriptor.activo{ border-left:4px solid #0C0; }
	.looksuscriptor.echo{ border-left:4px solid #00C; }
	.looksuscriptor.anulado{ border-left:4px solid #CCC; }
	.looksuscriptor.retrasado{ border-left:4px solid #C00; }
	.footevento{ margin-left: 10px; }
</style>
<script>
function EditarEvents_gestion(id){
	var URL = '/events_gestion/editar/'+id+'/';
	LoadModal("", "Editar Actividad", URL);
	/*$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#row'+id).html(msg);
		}
	});*/
}

    $(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip(); 

        $('[data-toggle="popover"]').popover()

    });

</script>
