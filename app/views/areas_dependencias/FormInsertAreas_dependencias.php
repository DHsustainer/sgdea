<?
global $c;
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>
<div class="row">
  <div class="col-md-12">
      <div <?= $c->Ayuda('145', 'tog') ?> style="width: auto; float:left">
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Gestión Documental</button>
      </div>
  </div>
</div>

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registrar Serie Documental</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin:0px">
        	<div class="col-md-6">
        		<div>
	        		<?
	        			include(VIEWS.DS."dependencias/FormInsertSeries.php");

	        			$area = new MAreas;
	        			$area->CreateAreas("id", $id);
	        		?>
        		</div>
				    <h2>Series Registradas en  <?php echo $area->GetNombre() ?></h2>
        		<div class="list-group" id="listadodependencias">
        			<?

						$object = new MAreas_dependencias;
						$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' AND id_version = '".$_SESSION['id_trd']."' group by id_dependencia_raiz");

						include(VIEWS.DS."areas_dependencias/ListarSeries.php");

        			?>
        		</div>
        	</div>
        	<div class="col-md-6" id="editarelementosubseries" class="disabled" style="display:none"></div>
        	<div class="col-md-6" id="abrirlistadosubseries" class="disabled" style="display:none"></div>
        </div>
      </div>    
    </div>
  </div>
</div>

<script type="text/javascript">
	$('#myModal').on('shown.bs.modal', function () {
		$('#myInput').focus()
	})
</script>