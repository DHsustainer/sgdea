<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/nestable/nestable.css'/>
<script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/nestable/jquery.nestable.js'></script>

	<div id="listadoelementos">
    	<div class="myadmin-dd-empty dd" id="nestable">
	        <ol class="list-group dd-list">
<?
		$i = 0;
		global $c;
		while($row = $con->FetchAssoc($query)){
			$i++;
			$l = new MMeta_referencias_campos;
			$l->Createmeta_referencias_campos('id', $row[id]);
			$validar = "";
			switch ($l->GetValidar()) {
				case 'existence':
					$validar = "Validar Existencia del campo con otros registros del mismo formulario<br>";
					break;
				case 'unique':
					$validar = "Validar Clave Unica (Este registro no se puede repetir)<br>";
					break;
				
				default:
					$validar = "";
					break;
			}
?>			
			<li style="cursor:pointer" data-id="<?= $l->GetOrden() ?>" data-role="<?= $l->GetId() ?>" class="dd-item dd3-item list-group-item" id="rcampo<?= $l->GetId() ?>"  onclick='EditarMeta_referencias_campos(<?= $l->GetId() ?>)'>
				<div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
					<div class="row">
						<div class="col-md-9" style="padding-right: 5px;">
			    			<h5 class="list-group-item-heading"><?php echo utf8_decode($l -> GetTitulo_campo()); ?></h5>
						</div>
						<div class="col-md-3" style="padding-left: 5px;">
							<?
								$visible = ($l -> GetVisible() == "0")?"eye":"eye-slash";
								$caption = ($l -> GetVisible() == "0")?"El campo es visible desde el registro publico":"El campo no es visible desde el registro publico";

								$typeelm   = array("5"=>"fa-font", "6"=>"fa-font", "7"=>"fa-paperclip", "8"=>"fa-sort-numeric-asc", "9"=>"fa-calendar", "10"=>"fa-at", "11"=>"fa-list", "12"=>"fa-check-square-o", "13" => "fa-minus", "14" => "fa-superscript", "15" => "fa-subscript", "16" => "fa-code");
								$typeelm_d = "EL CAMPO ES UN/A ".$c->GetDataFromTable("meta_tipos_elementos", "id", $l->GetTipo_elemento(), "nombre", "");

								$obligatorio = ($l -> GetEs_obligatorio() == "1")?'<span class="fa fa-asterisk" title="El campo es Obligatorio"></span>':'';
								$placeholder = ($l -> GetPlaceholder() != "")?'<span class="fa fa-info" title="'.$l->GetPlaceholder().'"></span>':'';
							?>
			    			<h6 class="list-group-item-heading" align="right">
			    				<span class="fa fa-<?= $visible ?>" title="<?= $caption ?>"></span>
			    				<span class="fa <?= $typeelm[$l->GetTipo_elemento()] ?>" title="<?= $typeelm_d ?>"></span>
			    				<?= $obligatorio ?>
			    				<?= $placeholder ?>
			    				<b>(<?= $l->GetColumnas() ?>)</b>
			    			</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
			    			<small><?php echo $validar.$l -> GetObservacion(); ?></small>
						</div>
					</div>
                </div>
				<!--<div class="row">
					<div class="col-md-12 col-md-offset-8" align="right">
						<div style='float:right;' class="fa fa-close" title="Eliminar Campo del Formulario"  ></div>
					</div> 
				</div> -->
		    	
		  	</li>		
<?
		}
		if ($i == 0) {
			echo '<div class="alert alert-info" role="alert">No hay elementos en este formulario</div>';
		}
?>	
			</ol>
		</div>
	</div>
<script>

function EliminarMeta_referencias_campos(id){
	if(confirm('Esta seguro desea eliminar este meta_referencias_campos')){
		var URL = '/meta_referencias_campos/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				$('#rcampo'+id).remove();
				$('#formelementoslistas').html("");
			}
		});
	}
	
}	

function EditarMeta_referencias_campos(id){
	var URL = '/meta_referencias_campos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#formelementoslistas').html(msg);
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
			
			var URL = '/meta_referencias_campos/ordenar/<?= $x ?>/';
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
<style type="text/css">
	.myadmin-dd-empty .dd-list .dd3-handle {
	    height: 63px !important;
	}
</style>