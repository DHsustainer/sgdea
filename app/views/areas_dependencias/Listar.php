<?
	if ($sx == "1") {
?>
	<div class="row m-t-5">
		<div class="col-md-12">
			<div class='btn btn-info' <?= $c->Ayuda('146', 'tog') ?>  onclick='OpenWindow("/dependencias/CCD/<?= $id ?>/")'>
				Ver Cuadro de Clasificación Documental
			</div>
		</div>
	</div>
	<div class="row m-t-5">
		<div class="col-md-12">
			<div class='btn btn-info' <?= $c->Ayuda('147', 'tog') ?>  onclick='OpenWindow("/dependencias/TRD/<?= $id ?>/")'>
				Ver Tabla de Retención Documental
			</div>
		</div>
	</div>
<?
	if ($_SESSION['MODULES']['tabla_historica'] == "1") {
?>
	<div class="row m-t-5">
		<div class="col-md-12">
			<div class='btn btn-info' <?= $c->Ayuda('333', 'tog') ?> onclick='OpenWindow("/dependencias/TVD/<?= $id ?>/")'>Ver Tabla de Valoración Documental</div>
		</div>
	</div>
<?
	}
?>	
	<div class="row m-t-5">
		<div class="col-md-12">
			<div class='btn btn-info' <?= $c->Ayuda('148', 'tog') ?>  onclick='OpenWindow("/flujos/mod/<?= $id ?>/A/")'>
				Ver Flujos de Trabajo
			</div>
		</div>
	</div>
<?
	}else{


?>
		<table border='0' cellspacing='0' cellpadding='1' width='100%' class='tabla' id='Tablaareas_dependencias' style="width:100%; padding:5px !important;">
			<thead>
				<th class="th_act_inner" colspan="5" ><?= 'CUADRO DE CLASIFICACION DOCUMENTAL: '.CAMPOAREADETRABAJO.' "'.$area->GetNombre().'"' ?></th>
			</thead>
			<tbody>

<?

		while($row = $con->FetchAssoc($query)){
			$l = new MAreas_dependencias;
			$l->Createareas_dependencias('id', $row[id]);

			$d = new MDependencias;
			$d->CreateDependencias("id", $l->GetId_dependencia_raiz());

			$icon = ($d->GetDependencia_inversa() == "0")?"sr.png":"matadato.png";
			
			if ($d->GetDependencia_inversa() == "0") {
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td width="10px"><img src="<?= ASSETS.DS.'images/sr.png' ?>"></td>
				<td colspan="4" style="padding-left:4px; font-size: 10px"><b><?php echo $d->GetId_c()." ".$d->GetNombre() ?></b></td> 
			</tr>
<?
			}
			
			$qn = $l->ListarAreas_dependencias(" where id_area = '".$l->GetId_area()."' and id_dependencia_raiz = '".$d->GetId()."' "," order by ndd");

				while ($ro2 = $con->FetchAssoc($qn)) {
					$s = new MDependencias;
					$s->CreateDependencias("id", $ro2['id_dependencia']);

					if ($d->GetDependencia_inversa() == "0") {
?>

					<tr id='r<?= $ro2[id] ?>' class='tblresult'> 
						<td width="10px"></td>
						<td width="20px"><img src="<?= ASSETS.DS.'images/subc.png' ?>">	</td>
						<td title="<?= $l->GetObservacion() ?>" colspan="2" style="font-size: 10px"><?php echo $s->GetId_c()." ".$s->GetNombre() ?></td> 

						<td>
							<?
								if ($xsx == "1") {
							?>
							<div style="float:right;"  onclick='EliminarAreas_dependencias(<?= $ro2[id] ?>, <?= $id ?>)'>
		                    	<div class="btn btn-warning btn-circle mdi mdi-delete" title="eliminar"></div>
		                	</div>
		                	<?
		                		}
		                	?>
						</td>	       
					</tr>
<?
					}else{
?>

					<tr id='r<?= $ro2[id] ?>' class='tblresult'> 
						<td width="10px"><img src="<?= ASSETS.DS.'images/matadato.png' ?>">	</td>
						<td title="<?= $l->GetObservacion() ?>" colspan="2" style="font-size: 10px"><b><?php echo $d->GetId_c()." ".$d->GetNombre() ?></b></td> 	

						<td>
							<?
								if ($xsx == "1") {
							?>
							<div style="float:right;"  onclick='EliminarAreas_dependencias(<?= $ro2[id] ?>, <?= $id ?>)'>
		                    	<div class="btn btn-warning btn-circle mdi mdi-delete" title="eliminar"></div>
		                	</div>
		                	<?
		                		}
		                	?>
						</td>	       
					</tr>
<?						
					}
				$countertip = $con->Query("select * from dependencias_tipologias where id_dependencia = '".$s->GetId()."' and estado = '1' order by tipologia");

					while ($riowt = $con->FetchAssoc($countertip)) {
						$ntipologia = ($riowt['formato'] != "")?"<a href='".HOMEDIR.DS."app/plugins/uploadsfiles/".$riowt['formato']."' target='_blank'>".$riowt['tipologia']."</a>":$riowt['tipologia'];
						echo "	<tr  class='tblresult'>
									<td width='10px'></td>
									<td width='40px' colspan='4' align='left' style='padding-left:40px !important; font-size:10px'>
										<img src='".ASSETS.DS."images/tip.png'>".$ntipologia."
									</td>
								</tr>";
					}
?>					
<?					
				}


		}
?>			</tbody>
		</table>
<script>
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
</script>		
<?
	}
?>