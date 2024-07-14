<div class="list-group">

<?
	while($row = $con->FetchAssoc($query)){
		$l = new MUsuarios_seguimiento;
		$l->Createusuarios_seguimiento('id', $row[id]);
?>			
		<div class="list-group-item">
			<small>Creado por <?php echo $l -> GetUsername(); ?> el <?php echo $l -> GetFecha(); ?></small><br>
			<?php echo $l -> GetObservacion(); ?>
		</div>					
<?
	}
?>			
</div>