<div class="row m-t-30">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
	 		<div class="row p-30">
	 			<div class="col-md-12">

				  	<h2><span class="fa fa-search"></span> Resultados de Consulta</h2>
					<p class="m-t-30 m-b-30">Resultados de la consulta de <?= $tipo ?> del d&iacute;a <b><?= $radicado ?></b></p>
					<div class="bloque_radicado_detalle">
						<?php
							if ($con->NumRows($query) >= 1) {
								$i = 0;
						?>	
								<table class="table table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Radicado</th>
											<th>Asunto</th>
											<th>Firmado Por</th>
											<th>Fecha de Firma</th>
											<th>Adjunto</th>
										</tr>
									</thead>
									<tbody>
						<?
									while ($row = $con->FetchAssoc($query)) {

/*
*/
										$doc = $con->Query("select * from gestion_anexos where id_event = '".$row['id']."'");
					                	$docg  = $con->FetchAssoc($doc);

					                	if ($docg['id'] != "") {

					                		$ga = new MGestion_anexos;
					                		$ga->CreateGestion_anexos("id", $docg['id']);

					                		$url = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$ga->GetGestion_id().'/anexos/'.$ga->GetUrl();

					                		$link = '<a href="'.$url.'" target="_blank" title="'.$ga->GetNombre().'"><i class="mdi mdi-paperclip"></i></a>';

					                	}

										$g = new MGestion;
										$g->CreateGestion("id", $row['gestion_id']);

										$u = new MUsuarios;
										$u->CreateUsuarios("user_id", $row['user_id']);

										$nombre = $row['title'];


										$i++;
										echo '<tr>
												<td>'.$i.'</td>
												<td>'.$g->GetRadicado().'</td>
												<td>'.$nombre.'</td>
												<td>'.$u->GetP_nombre().' '.$u->GetP_apellido().'</td>
												<td>'.$row['fecha'].' '.$row['time'].'</td>
												<td>'.$link.'</td>

											</tr>';
									}
						?>
									</tbody>
								</table>
						<?
							}else{

								echo "<br><br><br><div class='alert alert-warning' role='alert'>La fecha consultada no arrojó resultados</div><br><br>";
							}
						?>
					</div>
					<br>
					<a href="<?= HOMEDIR.DS ?>consultapublica/estados/" class="btn btn-primary btn-lg fullwidth">
						Consultar Otra Fecha
					</a>
					
				</div>
			</div>
		</div>
	</div>
</div>


<style type="text/css">
	#wrapper {
	    background-color: #FFF;
	}

	#header {
	    border-bottom: 1px solid #FFF;
	 
	}
	.bodycontainer {
	    padding-bottom: 0px !important;
	}
	@media screen and (min-width: 768px){
		
		.jumbotron {
		    padding-top: 10px;
		}
	}

</style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>