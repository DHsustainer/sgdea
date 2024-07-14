<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='tablat' style="width:100%">
   	<thead>
		<tr class='encabezadot'>
			<th class="th_act">ID</th>
			<th class="th_act">Nombre</th>
			<th class="th_act">A.G.</th>
			<th class="th_act">A.C.</th>
			<th class="th_act">A.H.</th>
			<th width="80px" class="th_act">OP</th>
		</tr>
	</thead>
	<tbody>

<?
	global $f;
	while($row = $con->FetchAssoc($query)){
		$l = new MDependencias;
		$l->Createdependencias('id', $row[id]);

		global $f;

		$fecha = date("Y-m-d H:i:s");
		$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		$mes = $l->GetT_g();
		date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.
		$fecha_tg = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

		$fecha = date("Y-m-d H:i:s");
		$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		$mes = $l->GetT_c();
		date_modify($fecha_c, $mes." day");//sumas los dias que te hacen falta.
		$fecha_tc = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.

		
		$fecha_th = "-";
		if ($l->GetT_h() == "-1") {
			$fecha_th = "Eliminación";
		}elseif ($l->GetT_h() == "-2") {
			$fecha_th = "Conservación Total";
		}elseif ($l->GetT_h() == "-3") {
			$fecha_th = "Digitalización";
		}elseif ($l->GetT_h() == "-4") {
			$fecha_th = "Selección";
		}elseif ($l->GetT_h() == "-5") {
			$fecha_th = "MicroFilmación";
		}

		$is_inmaterial = ($l->GetEs_inmaterial() == "1")?"pintar":"";
?>			
		<?php if ($l->GetEstado() == "1"): ?>
				<tr id='rho<?= $l->GetId() ?>' class='tblresult <?= $is_inmaterial ?>' title="<?= $l->GetObservacion() ?>"> 
					<?php if ($l->GetDependencia() == "0"): ?>
						<td width="50px"><?php echo $f->zerofill($l->GetId_c(), 3); ?></td> 
					<?php else: ?>
					<?
						$rot = new MDependencias;
						$rot->CreateDependencias("id", $l->GetDependencia());
					?>
						<td width="55px"><?php echo $f->zerofill($rot->GetId_c(), 3)."-".$f->zerofill($l->GetId_c(), 3); ?></td> 
					<?php endif ?>
					
					<td>
						<div id="elmname<?= $l->GetId()?>">
							<?php echo $l -> GetNombre(); ?>
						</div>
					</td> 
					<td width="45px" align="center"><?= ($l->GetT_g() != "0")?$f->nicetime2($fecha_tg):"-";  ?></td>
					<td width="45px" align="center"><?= ($l->GetT_c() != "0")?$f->nicetime2($fecha_tc):"-";  ?></td>
					<td width="45px" align="center"><?= $fecha_th; ?></td>
					<td width="115px">
						<div style="float:right;" onclick="EliminarDependencias('<?= $l->GetId() ?>', '<?= $l->GetDependencia() ?>')">
		                    <div class="btn btn-warning btn-circle mdi mdi-delete" title="eliminar"></div>
		                </div>
					<?php if ($l->GetDependencia() == "0"): ?>
		                <div style="float:right; margin-right: 5px;" onclick="DependenciaDependencias('<?= $l->GetId() ?>')">
		                    <div class="mini-ico green-dep" title="Dependencias"></div>
		                </div>
		                <div style="float:right; margin-right:5px;" onclick="EditarDependenciaPrincipal('<?= $l->GetId() ?>')">
							<div class="btn btn-info btn-circle" title="editar"></div>
						</div>
					<?php else: ?>
						<div style="float:right; margin-right: 5px;" onclick="select_gestSubs('subsr-per','onactionb','<?= $l->GetId() ?>')">
		                    <div class="mini-ico green-conf" title="Configurar"></div>
		                </div>
		   				<div style="float:right; margin-right:5px;" onclick="EditarDependencias('<?= $l->GetId() ?>')">
							<div class="btn btn-info btn-circle" title="editar"></div>
						</div>
					<?php endif ?>
				</tr>
		<?php else: ?>
				<tr id='rho<?= $l->GetId() ?>' class='tblresult disabled'> 
					<?php if ($l->GetDependencia() == "0"): ?>
						<td width="50px"><?php echo $f->zerofill($l->GetId_c(), 3); ?></td> 
					<?php else: ?>
					<?
						$rot = new MDependencias;
						$rot->CreateDependencias("id", $l->GetDependencia());
					?>
						<td width="70px"><?php echo $f->zerofill($rot->GetId_c(), 3)."-".$f->zerofill($l->GetId_c(), 3); ?></td> 
					<?php endif ?>

					<td>
						<div id="elmname<?= $l->GetId()?>">
							<?php echo $l -> GetNombre(); ?>
						</div>
					</td> 
					<td width="40px" align="center"><?= $l->GetT_g() ?></td>
					<td width="40px" align="center"><?= $l->GetT_c() ?></td>
					<td width="40px" align="center"><?= $fecha_th; ?></td>
					<td width="115px">
						<div style="float:right;" onclick="ActivarDependencias('<?= $l->GetId() ?>', '<?= $l->GetDependencia() ?>')">
		                    <div class="mini-ico green-act" title="eliminar"></div>
		                </div>
						<?php if ($l->GetDependencia() == "0"): ?>
			                <div style="float:right; margin-right: 5px;" onclick="DependenciaDependencias('<?= $l->GetId() ?>')">
			                    <div class="mini-ico green-dep" title="Dependencias"></div>
			                </div>
			                 <div style="float:right; margin-right:5px;" onclick="EditarDependenciaPrincipal('<?= $l->GetId() ?>')">
								<div class="btn btn-info btn-circle" title="editar"></div>
							</div>
						<?php else: ?>
							<div style="float:right; margin-right: 5px;" onclick="select_gestSubs('subsr-per','onactionb','<?= $l->GetId() ?>')">
			                    <div class="mini-ico green-conf" title="Configurar"></div>
			                </div>
			                <div style="float:right; margin-right:5px;" onclick="EditarDependencias('<?= $l->GetId() ?>')">
								<div class="btn btn-info btn-circle" title="editar"></div>
							</div>
						<?php endif ?>
				</tr>
		<?php endif ?>			
<?
	}
?>	</tbody>
</table>