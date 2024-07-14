	<div class="row fullheight">
		<div class="col-md-12">
			<ul class="nav nav-tabs" id="tab_navegacion_widgets">
				<?
					$ex = new MEstadosx;
					$q = $ex->ListarEstadosx("WHERE tipo = 'tipo_negocio'");
					$i = 0;
					while ($row = $con->FetchAssoc($q)) {
						$i++;
						$path = "";
						$t = $con->Query("select count(*) as t from suscriptores_paquetes_negocios where tipo_negocio = '".$row['valor']."'");

						$tx = $con->Result($t, 0, "t");

						if ($i == "1") {
							$path = "active";
						}
						echo '	<li onClick="ActivarTab(\'tab'.$row['valor'].'\', \'buscartab'.$row['valor'].'\')" id="buscartab'.$row['valor'].'" role="presentation" class="tabselm '.$path.'">
									<a href="#buscartab'.$row['valor'].'">'.$row['nombre'].' ('.$tx.')</a>
								</li>';
					}
				?>
				

			</ul>
		<?
			$q = $ex->ListarEstadosx("WHERE tipo = 'tipo_negocio'");
			$j = 0;
			while ($rx = $con->FetchAssoc($q)) {
				$j++;
				$path = "";
				if ($j == "1") {
					$path = "style='display:block'";
				}
				echo '	<div class="col-md-12 busquedaresultadotab" id="tab'.$rx['valor'].'" '.$path.' >';

					$object = new MSuscriptores_paquetes_negocios;
					$query = $object->ListarSuscriptores_paquetes_negocios("WHERE tipo_negocio = '".$rx['valor']."'");

					$i = 0;

					echo "<div class='list-group'>";

					while($row = $con->FetchAssoc($query)){

						$i++;
						$l = new MSuscriptores_paquetes_negocios;
						$l->Createsuscriptores_paquetes_negocios('id', $row[id]);
						$val = number_format($l->GetValor_base(), "0", ",", '.');

						#$proyecto = $l->GetProyecto_id();
						$proyecto = new MSuscriptores_tipos_proyectos;
						$proyecto->CreateSuscriptores_tipos_proyectos("id", $l->GetProyecto_id());

						echo "<div class='list-group-item'>";
						echo "	<div>".$l -> GetNombre()."</div>
								<small style='color:#666'>Valor: $ ".$val." / Proyecto: ".$proyecto->GetNombre()."</small>";
						echo '</div>';


					}

					if ($i == 0) {
						echo "<div class='alert alert-info' role='alert'>No hay negocios de tipo ".$rx['nombre']." definidos</div>";
					}

					echo "</div>";
				echo "</div>";
			}
		?>		
		</div>
	</div>




<!--
    <div onclick='EditarSuscriptores_paquetes_negocios(< ?= $l->GetId() ?>)'>
		<div class='btn btn-info btn-circle' title='editar'></div>
	</div>
	<div onclick='EliminarSuscriptores_paquetes_negocios(< ?= $l->GetId() ?>)'>
        <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
    </div>
-->
	

<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
	});

	function ActivarTab(tab, selector){

		$(".tabselm").removeClass('active');
		$(".busquedaresultadotab").css('display', 'none');

		$("#"+selector).addClass("active");
		$("#"+tab).css("display", 'block');

	}
</script>
<style type="text/css">
	
	.busquedaresultadotab{
		border: 1px solid #CCC;
	    min-height: 400px;
	    border-top: none;
	    margin-top: -1px;
	    display: none;
	    padding: 20px;
	}

	#tab_navegacion_widgets.nav>li>a {
	    position: relative;
	    display: block;
	    padding: 10px 15px;
	}

</style>
					


<script>
	

function EliminarSuscriptores_paquetes_negocios(id){
	if(confirm('Esta seguro desea eliminar este suscriptores_paquetes_negocios')){
		var URL = '/suscriptores_paquetes_negocios/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				if(msg == 'OK!')
					$('#r'+id).slideUp();
			}
		});
	}
	
}	

function EditarSuscriptores_paquetes_negocios(id){
	var URL = '/suscriptores_paquetes_negocios/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#main_form_suscriptores_modulosx').html(msg);
		}
	});
}	
</script>		
