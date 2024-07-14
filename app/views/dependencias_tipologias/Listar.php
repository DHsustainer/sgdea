<div class="alert alert-info" role="alert">En este panel puede configurar las tipologías documentales relacionadas con cada Sub-Serie</div>
<div id="gestion-actuaciones2" class="row">
    <div id="form-oficinas2" class="col-md-12">
    	<? 
    		include(VIEWS.DS."dependencias_tipologias".DS."FormInsertDependencias_tipologias.php");
    		global $f;
    	?>
    </div>
<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/nestable/nestable.css'/>
<script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/nestable/jquery.nestable.js'></script>
<div class="col-md-12">
	<h2>Listado de Tipologías Documentales </h2>

<div id="listadoelementos">
	<div class="myadmin-dd-empty dd" id="nestable" style="max-width: 100%">
        <ol class="list-group dd-list">
<?
		while($row = $con->FetchArray($query)){
			$l = new MDependencias_tipologias;
			$l->Createdependencias_tipologias('id', $row[id]);
?>	
			<li style="cursor:pointer" data-id="<?= $l->GetOrden() ?>" data-role="<?= $l->GetId() ?>" class="dd-item dd3-item list-group-item" id="rcampo<?= $l->GetId() ?>"  onclick='EditarMeta_referencias_campos(<?= $l->GetId() ?>)'>
				<div class="dd-handle dd3-handle" style="height: 172px; border-bottom: 1px"></div>
                <div class="dd3-content" style="margin-top:0px; margin-bottom: 0px; border:none; font-weight: normal">			
					<div class="row">
						<div class="col-md-9">		
							<b style="text-transform: uppercase"><?php echo $l -> GetTipologia(); ?></b>
							<br>
							<small>
								Creado por	<?php echo $l -> GetUsuario(); ?> el <?php echo $l -> GetFecha(); ?>
							</small>
						</div>
						<div class="col-md-3">		
							<div onclick='EliminarDependencias_tipologias(<?= $l->GetId() ?>)'  class="pull-right  m-r-5">
			                    <div class='mdi mdi-delete btn btn-danger btn-circle' title='eliminar'></div>
			                </div>
			                <div onclick='LoadModal("large",  "Editar Tipo Documental: <?= $l->GetTipologia() ?>", "/dependencias_tipologias/editar/<?= $l->GetId() ?>/")'  class="pull-right m-r-5" data-toggle="modal" data-target="#myModalLarge">
								<div class='btn btn-info btn-circle fa fa-pencil' title='editar'></div>
							</div>

							<?php 
								if ($_SESSION['MODULES']['metadatos'] == "1") {
							?>
							<div onclick='OpenWindow("/dependencias_tipologias/metadatos/<?= $l->GetId() ?>/")' class="pull-right  m-r-5">
			                    <div class='mdi mdi-sitemap btn btn-circle btn-warning' title='Metadatos'></div>
			                </div>
			                <?php 
								}
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">Tipología de Inmaterialización: <b><?php echo ($l -> GetInmaterial() == "1")?"SI":"NO"; ?></b></div>
						<div class="col-md-6">Documento de Salida: <b><?php echo ($l -> GetEntrada() == "1")?"SI":"NO"; ?></b></div>
					</diV>
					<div class="row">
						<div class="col-md-6">Documento Obligatorio: <b><?php echo ($l -> GetObligatorio() == "1")?"SI":"NO"; ?></b></div>
						<div class="col-md-6">Documento Publico: <b><?php echo ($l -> GetEs_publico() == "1")?"SI":"NO"; ?></b></div>
					</diV>
					<div class="row">
						<div class="col-md-6">Prioridad del Dcto.: <b><?php echo $l->GetPrioridad(); ?></b></div>
		<?
						$vencimiento = "El Documento Persiste en el tiempo";
						if($l->GetDias_vencimiento() == "0" || $l->GetDias_vencimiento() == ""){
							$vencimiento = "El Documento Persiste en el tiempo";
						}else{

							$fecha = date("Y-m-d H:i:s");
							$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
							$mes = $l->GetDias_vencimiento();
							date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.
							$fecha_tc = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
							$vencimiento = $f->nicetime2($fecha_tc);
						}

		?>

						<div class="col-md-6">Días de Vencimiento: <b><?php echo $vencimiento; ?></b></div>
					</diV>
					<div class="row">
						<div class="col-md-6">Soporte / Origen: </div>
						<div class="col-md-6"><b>
							<?php 
								$ar = array("0" => "Documento en Papel", "1" => "Documento Electrónico", "2" => "Documento en Papel y Electrónico", "3" => "XML", "4" => "Documento en Papel o Electrónico, XML");
								
								echo $ar[$l->GetSoporte()];
							?>
						</b></div>
					</diV>
					<div class="row">
						<div class="col-md-2">Observación: </div>
						<div class="col-md-10"><b><?php echo $l -> GetObservacion(); ?></b></div>
					</diV>
					<div class="row" style="margin: 0 0 0 15px; margin-bottom: 15px;">
					<?
						if ($l -> GetFormato() != "") {

					?>
						<br>
						<div class="col-md-12" align="left"><a href="<?php echo HOMEDIR.DS."app/plugins/uploadsfiles/".$l -> GetFormato(); ?>" target="_blank"><button class="btn btn-success">Descargar Formato de Datos</button></a></div>
						<br><br><br>
					<?
						}
					?>
					</diV>
				</div>
			</li>
<?
		}
?>
		</ol>
	</div>
</div>


<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		



function EliminarDependencias_tipologias(id){
	if(confirm('Esta seguro desea eliminar este dependencias_tipologias')){
		var URL = '/dependencias_tipologias/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				$('#row'+id).remove();
			}
		});
	}
	
}	



function UpdateTipologia(){
    var URL = '/dependencias_tipologias/actualizar/';
    var str = $("#FormUpdatedependencias_tipologias").serialize();
    $.ajax({
        type: 'POST',
        url: URL,
        data: str,
        success:function(msg){
            alert("Tipología Actualizado");
            window.location.reload();
            msgx = $("#FormUpdatedependencias_tipologias #id").val();
            $("#col"+msgx).text($("#FormUpdatedependencias_tipologias #tipologia").val());
        }
    });
}
</script>		
<script type="text/javascript">
    $(document).ready(function () {
        // Nestable
        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target)
                , output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            }
            else {
                output.val('JSON browser support required for this demo.');
            }
        };
        $('#nestable').nestable({
            group: 1,
            maxDepth: 1
        }).change( function(){

        	updateOutput($('#nestable').data('output', $('#nestable-output')));

        	var i = 0;
        	var path = "";
        	$('ol.dd-list li').each(function(indice, elemento) {
        		i++;
			  	path += ''+$(elemento).attr('data-role')+':'+i+",";
			});
			
			var URL = '/dependencias_tipologias/ordenar/<?= $x ?>/';
			var str = "list="+path;
			$.ajax({
				type: 'POST',
				url: URL,
				data: str,
				success: function(msg){
				}
			});
        });
        
        
    });

</script>