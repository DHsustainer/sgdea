<?
	$area = new MAreas;
	$area->CreateAreas("id", $id);


?>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<a href="/gestion/nuevo/"><div class="icon schedule hight-blue"></div></a>
		</div>
		<div class="header-agenda"></div>
		<?
		echo '	<div class="boton-new-proces-blankspace" style="float: left"></div>
				<div id="boton-new-proces" style="float: right">
					<a class="no_link" href="'.HOMEDIR.'/proceso/1/">
						<div >'.$area->GetNombre().'</div>
					</a>
				</div>';
		?>
	</div>
</div>
<div id="folders-content">
	<div id="folders-list-content">
		<div class="title">Listado de Usuarios en las <?= CAMPOAREADETRABAJO; ?> Disponibles</div>
		<br>
<?
	global $f;
	global $c;
	global $con;


		$object = new MUsuarios;
		$query = $object->ListarUsuarios("where regimen = '$id'", 'order by p_nombre');

		while($row = $con->FetchAssoc($query)){
			$l = new MUsuarios;
			$l->CreateUsuarios('user_id', $row['user_id']);
?>						
			<div class='newblock_suscriptor' onclick='window.location.href="/dependencias/SeriesUsuariosAreas/<?= $l->Geta_i().'.'.$id ?>/"'>
				<div class='icono'>
					<div class="myicon"></div>
				</div>
				<?
					$nombre = substr($l->Getp_nombre(), 0, 30)." ".substr($l->Getp_apellido(), 0, 30);
					$path_archivo = ($_SESSION['typefolder'] != "3")?"and estado_archivo = '".$_SESSION['typefolder']."'":"and estado_archivo <= '0'";
				?>
				<div class='nombre' title='<?= $l->Getp_nombre()." ".$l->Getp_apellido() ?>'><?php echo strtoupper($nombre) ?></div>
				<div class='num_exp'><?= $f->zerofill($c->GetTotalFromTable("gestion", "WHERE nombre_destino = '".$l->Geta_i()."' $path_archivo and ciudad = '".$_SESSION['ciudad']."' and dependencia_destino = '".$id."'"), 3) ?></div>
			</div>			
<?
		}
?>


	</div>
</div>