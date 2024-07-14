<div class="row m-t-20">
	<div class="col-md-6">
		<h2>Listado de Actuaciones</h2>
	</div>
	<div class="col-md-6">
		<?php if (!$hidebtn): ?>
			
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Exportar Actuaciones
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
			</button>
			<ul class="dropdown-menu">			    						
				<li><a href="#"  onclick="ExportarAct(<?= $object->GetId() ?>, '0')" <?= $c->Ayuda(342, 'tog') ?>>Todas las Actuaciones</a></li>
				<li><a href="#"  onclick="ExportarAct(<?= $object->GetId() ?>, '1')" <?= $c->Ayuda(343, 'tog') ?>>Actuaciones Publicas</a></li>
				<li><a href="#"  onclick="ExportarAct(<?= $object->GetId() ?>, '2')" <?= $c->Ayuda(344, 'tog') ?>>Actuaciones Privadas</a></li>
			</ul>
		</div>
		<?php endif ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12 m-t-10 m-b-20">
		<div class="list-group">
<?
	global $f;
	global $c;
	$type_ev = array("1" => "activo", "0" => "echo", "2" => "anulado", "3" => "retrasado");

	while($row = $con->FetchAssoc($query)){

		$l = new MEvents_gestion;
		$l->Createevents_gestion('id', $row[id]);

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
		if ($l->Gettipoalerta() == "") {
			if ($l->Getes_recordatorio() == "0") {
				$typeremd = '<span class="label label-info m-l-10"><span class="fa fa-info"></span> Actuación</span>';
			}else{
				$typeremd = '<span class="label label-warning m-l-10"><span class="fa fa-star"></span> Recordatorio</span>';
			}
		}else{
			$typeremd = '<span class="label label-warning m-l-10"><span class="fa fa-star"></span> '.$l->Gettipoalerta().'</span>';
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
	            	<div class="col-md-8">
	            		<?php echo $l -> GetTitle(); ?>
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
							<?php if ($_SESSION['elliminaractuaciones'] == '1'): ?>
							<button type="button" id="navnext" onclick="EliminarAlerta('<?= $l->GetId() ?>')" class="btn <?= $switcherror ?> waves-effect">
								<i class="fa fa-trash-o"></i>
							</button>
							<?php endif ?>

							
						</div>
					<?
					   	}
					?>      		
	            	</div>
	            </h4> 
	            <div class="row m-b-10">
	            	<div class="col-md-12">
	            		<div class="m-t-10">
	            		<?php echo $typeevent.$typeremd.$estadoactual; ?> 
	            		</div>
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

function EliminarAlerta(id){
	if(confirm("Esta seguro que desea eliminar esta actuación")){
		var URL = '/events_gestion/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				window.location.reload();
			}
		});
	}
}

    $(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip(); 

        $('[data-toggle="popover"]').popover()

    });

</script>
