<div class='title right'>Listado de Alertas Automaticas para <?= $dep->GetNombre()?></div>
	<div id="form" class="white">
        <form id="anexosdescargas">
			<div class="table">
				<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tabladependencias_alertas'>
		           	<thead>
						<tr class='encabezadot'>
							<th class='th_act'>Título</th>
							<th class='th_act'>Dias para ejecutar Alerta</th>
							<th class='th_act'>Estado</th>
							<th class='th_act'></th>
						</tr>
					</thead>

					<tbody>

		<?
				while($row = $con->FetchAssoc($query)){
					$l = new MDependencias_alertas;
					$l->Createdependencias_alertas('id', $row[id]);

					$co = $con->Query("Select * from events_gestion where id_generico = '".$row['id']."' and gestion_id = '".$id_gestion."'");
					
					$el = "<div class='mini-ico green-wait' style='float:left' onClick='ActivarAlerta(\"$row[id]\", \"$id_gestion\", \"$id_dependencia\")' title='La alerta en espera de ser activada'></div>";

					if ($con->NumRows($co) >= 1) {
						$el = "<div class='mini-ico green-act' style='float:left; cursor:default' title='La alerta fue activada el dia ".$con->Result($co, 0, 'added')."'></div>";
					}
		?>						
					<tr id='row<?= $l->GetId() ?>' class='tblresult'> 
						<td id='col<?= $l->GetId() ?>'><?php echo $l -> GetNombre(); ?></td> 
						<td id='colx<?= $l->GetId() ?>'><?php echo $l -> GetDias_alerta(); ?></td> 
						<td><?= $el; ?></td>	       
						<td>
							
						</td>
					</tr>
		<?
				}
		?>			</tbody>
				</table>
			</div>
		</form>
	</div>