<div class="row">
	<div class="col-md-12">
		<?
			$s = new MSuscriptores_contactos;
			$s->CreateSuscriptores_contactos("id", $object->GetId_suscriptor());

			$n = new MSuscriptores_paquetes_negocios;
			$n->CreateSuscriptores_paquetes_negocios("id", $object->GetId_negocio());

			$p = new MSuscriptores_tipos_proyectos;
			$p->CreateSuscriptores_tipos_proyectos("id", $n->GetProyecto_id());
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3>Suscriptor: <?php echo $s->GetNombre(); ?></h3>
		<h4><?php echo "Proyecto: ".$p->GetNombre(); ?> - <?php echo $n->GetNombre(); ?> (<?php echo $n->GetValor_base(); ?>)</h4>
		<small>
			Fecha de registro: <?= $f->ObtenerFecha4($l->GetFecha_registro()); ?><br>Código: <?php echo $l->GetCodigo(); ?>
		</small>
	</div>
</div>
<form id='FormUpdatesuscriptores_negocios' action='/suscriptores_negocios/actualizar/' method='POST'> 
	<input type='hidden' name='id' id='id' value='<?= $object->GetId(); ?>' />
	<input type='text' class='form-control' placeholder='id_suscriptor' name='id_suscriptor' id='id_suscriptor' value='<?= $object->Getid_suscriptor(); ?>' />
	
	<input type='text' class='form-control' placeholder='id_negocio' name='id_negocio' id='id_negocio' value='<?= $object->Getid_negocio(); ?>' />
	
	<input type='text' class='form-control' placeholder='fecha_registro' name='fecha_registro' id='fecha_registro' value='<?= $object->Getfecha_registro(); ?>' />
	
	<input type='text' class='form-control' placeholder='usuario' name='usuario' id='usuario' value='<?= $object->Getusuario(); ?>' />
	
	<input type='text' class='form-control' placeholder='codigo' name='codigo' id='codigo' value='<?= $object->Getcodigo(); ?>' />
	
		<input type='submit' value='Actualizar'/>
</form>
