<?
global $c;
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>

<?php 
function fnactivo($valor,$id){

	if($valor == $id){
		return 'class="active"';
	}
	if($valor == $id){
		return 'class="active"';
	}
	if($valor == $id){
		return 'class="active"';
	}
	if($valor == $id){
		return 'class="active"';
	}
	return '';
}
?>
<div class="row m-t-30">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default p-30">
			<ul class="nav nav-pills m-30 " role="tablist" id="tab_navegacion_widgets">
				<li role="presentation"  <?= $c->Ayuda('160', 'tog') ?>  <?php echo fnactivo('1',$id); ?>>
					<a href="/gestion/vencimientoexpedientesarchivo/1/">
                        Expedientes vencidos en Gestión
                    </a>
				</li>
				<?php 
				if($_SESSION['archivo_gestion_nuevo'] == '1'){ ?>
					<li role="presentation"  <?= $c->Ayuda('331', 'tog') ?>  <?php echo fnactivo('4',$id); ?>>
						<a href="/gestion/vencimientoexpedientesarchivo/4/">
	                        Expedientes vencidos en Archivo Gestión
	                    </a>
					</li>
				<?php 
				}
				if($_SESSION['archivo_central'] == '1'){ ?>
					<li role="presentation"  <?= $c->Ayuda('161', 'tog') ?>  <?php echo fnactivo('2',$id); ?>>
						<a href="/gestion/vencimientoexpedientesarchivo/2/">
	                        Expedientes vencidos en Archivo Central
	                    </a>
					</li>
				<?php 
				}
				if($_SESSION['archivo_central'] == '11'){ ?>
					<li role="presentation"  <?= $c->Ayuda('162', 'tog') ?>  <?php echo fnactivo('11',$id); ?>>
						<a href="/gestion/vencimientoexpedientesarchivo/11/">
	                        Enviar a Archivo Central
	                    </a>
					</li>
				<?php } 
				if($_SESSION['archivo_historico'] == '22'){ ?>
					<li role="presentation"  <?= $c->Ayuda('163', 'tog') ?>  <?php echo fnactivo('22',$id); ?>>
						<a href="/gestion/vencimientoexpedientesarchivo/22/">
	                        Enviar a Archivo Histórico
	                    </a>
					</li>
				<?php } ?>
			</ul>        	
<?php

	$estado_archivo = $con->Query("select nombre from estadosx where valor = '".$id."' and tipo = 'estado_archivo'");
	$estado_archivo = $con->Result($estado_archivo, 0, 'nombre');
	

	echo '  <h2 class="m-t-30 m-b-30">Listado de Expedientes Vencidos Que Cumplieron su Tiempo en '.$estado_archivo.'</h2>
			<div id="listadoexportable" class="list-group">';
						
	
	$usua = new MUsuarios;
	$usua->CreateUsuarios("user_id", $_SESSION['usuario']);

	switch ($id) {
		case '1':
			$sql = "SELECT gestion.id,DATE_ADD(gestion.f_recibido, INTERVAL (SELECT $dias_vencimiento FROM `dependencias` where id = gestion.tipo_documento) DAY) fecha_vencimiento FROM `gestion` WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) AND nombre_destino = '".$usua->GetA_i()."' and estado_respuesta = 'Cerrado' and estado_archivo = '".$id."' and DATE_ADD(fecha_respuesta, INTERVAL (SELECT $dias_vencimiento FROM `dependencias` where id = tipo_documento) DAY) <= DATE(NOW())";
			break;
		case '4':
			# code...
			break;
		default:
			# code...
			break;
	}

	//echo $sql;
	/*
	if($id == 1 || $id == 2){
		
		if($usua->GetIsAdministrador() == 1){
			$sql .= " union SELECT gestion.id,DATE_ADD(gestion.f_recibido, INTERVAL (SELECT $dias_vencimiento FROM `dependencias` where id = gestion.tipo_documento) DAY) fecha_vencimiento FROM gestion where  gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) and gestion.dependencia_destino = '".$usua->GetRegimen()."' and  nombre_destino <> '".$usua->GetA_i()."' and estado_archivo = '".$id."' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT $dias_vencimiento FROM `dependencias` where id = gestion.tipo_documento) DAY) <= DATE(NOW()) ";
		}
	} else {
		if($id == 11 || $id == 22){
			$sql = "SELECT g.id,DATE_ADD(g.f_recibido, INTERVAL (SELECT $dias_vencimiento FROM `dependencias` where id = g.tipo_documento) DAY) fecha_vencimiento FROM gestion g inner join gestion_cambio_ubicacion_archivo gcua on g.id = gcua.id_gestion WHERE  gcua.estado_archivo_origen = '".$enviara3[$id]."' and gcua.estado = '0' ";
		}
	}
	*/
	$query = $con->Query($sql);
	$i = 0;
	$if = 0;
	while ($row = $con->FetchAssoc($query)) {
		$i++;

		$checked = '';
		if($id == 1 || $id == 2){
			$seleccionado = $c->GetDataFromTable("gestion_cambio_ubicacion_archivo", "id_gestion", $row["id"], "id_gestion", $separador = " ");
			
			if($seleccionado != ""){
				$checked = 'checked';
			}
		}

		$path = '
		<div class="row">
			<div class="col-md-2">
				<h5><b> Fecha de Cierre: </b></h5>
			</div>
			<div class="col-md-2">
				<h5>'.$row["fecha_respuesta"].'</h5>
			</div>
			<div class="col-md-3">';
		if($id == 11 || $id == 22){	

			$path .= '<h5><b>Enviar al'.$enviara[$id].'</b></h5> ';

		}else{

			$path .= '
			<div class="checkbox checkbox-success pull-left m-r-10 m-t-10" '.$ayuda.'>
  				<label for="exp_'.$row["id"].'">Enviar al '.$enviara[$id].'</label>
                <input type="checkbox" onchange="ChangeCambioArchivo('.$row["id"].','.$enviara2[$id].')" id="exp_'.$row["id"].'" '.$checked .'>
            </div>';
		}
		$path .= '
			<div class="col-md-3">';
			if($id == 11 || $id == 22){	

			$path .= '<button type="button" class="btn btn-info btn-circle  m-r-5  " onclick="FnAceptarRechazarArchivo('.$row["id"].','."'".$enviara4[$id]."'".',1)">
					<i class="fa fa-check"></i> 
				</button>
				<button type="button" class="btn btn-warning btn-circle " onclick="FnAceptarRechazarArchivo('.$row["id"].','."'".$enviara4[$id]."'".',0)" >
					<i class="fa fa-times"></i> 
				</button>';
			}
		$path .= '
			</div>
		</div>';

		$c->GetVistaAmple($row["id"], $path, "full");

	}

	echo '
			</div>';

?>
		</div>
    </div>
</div>
<script type="text/javascript">
	
	function ChangeCambioArchivo(id,destino){

		if($("#exp_"+id).is(':checked')) { 
	        var URL = '/gestion_cambio_ubicacion_archivo/resgistrargestion/'+id+'/1/'+destino+'/';
	    } else {  
	       var URL = '/gestion_cambio_ubicacion_archivo/resgistrargestion/'+id+'/0/'+destino+'/';
	    } 
	    $.ajax({
	        url:URL,
	        type:'POST',
	        success:function(msg){
	            $('#wor'+id).remove();
	        }
	    });
	}

	function FnAceptarRechazarArchivo(id,destino,tipo){
		var mensaje = "Está seguro de mover el expediente al archivo "+destino;
		if(tipo == 0){
			mensaje = "Está seguro de rechazar el expediente del archivo "+destino;
		}
		if(confirm(mensaje)){
			var URL = '/gestion_cambio_ubicacion_archivo/resgistrargestion/'+id+'/'+tipo+'/0/';
		    $.ajax({
		        url:URL,
		        type:'POST',
		        success:function(msg){
		             $('#wor'+id).remove();
		        }
		    });
		}
		
	}

</script>