<?
$ARR_KEY = array('GET' => 'Registro', 'SET' => 'Consulta', 'ADD' => 'Documento');
	if($con->NumRows($query) > 0){

		echo '	<div class="row">
					<div class="col-md-12">
						<button class="btn btn-primary" onClick="LoadWsCofig(\'/ws_keys/nuevo/\', \'listkeys\')"><span class=\'fa fa-plus\'></span> Crear Key de Servicios Web</button>
					</div>
				</div>
				<div class="row">';
		while($row = $con->FetchAssoc($query)){

			$l = new MWs_keys;
			$l->Createws_keys('id', $row[id]);

			$city = new MCity;
            $city->CreateCity("code", $l -> GetCiudad());
            $ciudad = $city->GetName();

            $dp = new MProvince;
            $dp->CreateProvince("code", $l -> GetDepartamento());
            $province = $dp->GetName();

            $of = new MSeccional;
            $of->CreateSeccional("id", $l -> GetOficina());
            $oficina = $of->GetNombre();

            $area = new MAreas;
            $area->CreateAreas("id", $l -> GetArea());
            $narea = $area->GetNombre();

			$u = new MUsuarios;
			$u->CreateUsuarios("a_i", $l -> GetUsuario_destino());
			$nombreresponsable = $u->GetP_nombre()." ".$u->GetP_apellido();

			$d = new MDependencias();
			$d->CreateDependencias("id", $l -> GetSerie());

			$serie = $d->GetNombre();
			
			$d->CreateDependencias("id", $l -> GetSubserie());

			$subserie = $d->GetNombre();

			$nombre_formulario = '';
			if($row['formulario'] > 0){
				$ane = $con->FetchAssoc($con->Query("select * from meta_referencias_titulos where id = '".$row['formulario']."'"));
				$nombre_formulario = $ane['titulo'];
			}
?>		
			<div class="col-md-4 box-key-item">
				<div class="col-md-12" style="margin-left:-12px; margin-right:5px;">
					<div class="col-md-2" style="margin-left:-12px; margin-right:5px;">
						<span class="fa fa-cube iconcube"></span>
					</div>
					<div class="col-md-10">
						<div class="keytitulo"><a hre="#" onClick="LoadWsCofig('/ws_keys/xmlservicio/<?php echo $l -> GetId(); ?>/', 'listkeys')"><?php echo $l -> GetNombre(); ?></a></div>
						<div class="keyid"><b>Key id:</b> <?php echo $l -> Getllave(); ?></div>
						<div class="keystatus"><b>Tipo:</b> <?= $ARR_KEY[$l->GetTipokey()] ?></div>
						<div class="keystatus"><b>Ip Consumo:</b> <?php echo $l -> GetIpkey(); ?></div>
						<?php if($l->GetTipokey() == "GET"){ ?>
						<div class="keystatus"><b>Departamento:</b> <?php echo $province; ?></div>
						<div class="keystatus"><b>Ciudad:</b> <?php echo $ciudad; ?></div>
						<div class="keystatus"><b>Oficina:</b> <?php echo $oficina; ?></div>
						<div class="keystatus"><b>Area:</b> <?php echo $narea; ?></div>
						<div class="keystatus"><b>Responsable:</b> <?php echo $nombreresponsable; ?></div>
						<div class="keystatus"><b>Serie:</b> <?php echo $serie; ?></div>
						<div class="keystatus"><b>Sub Serie:</b> <?php echo $subserie; ?></div>
						<?php 
						if($nombre_formulario != ''){
						?>
						<div class="keystatus"><b>Formulario:</b> <?= $nombre_formulario; ?></div>
						<?php } ?>
						<div class="keystatus"><b>Estado:</b> <?= ($l->GetEstado() == "1")?"Activo":"Inactivo" ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
<?
		}
	echo "		</div>";
?>
<script>
function EliminarWs_keys(id){
	if(confirm('Esta seguro desea eliminar este ws_keys')){
		var URL = '<?= HOMEDIR ?>ws_keys/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				Alert2(msg);
				if(msg == 'OK!')
					$('#r'+id).remove();
			}
		});
	}
}	
</script>	
<style>
	.box-key-item{
		border:1px solid #CCC;
		padding:5px !important;
		border-radius: 4px;
		margin:10px;
	}
	.keytitulo{
		font-weight: bold;
		font-size: 15px;
		text-transform: uppercase;
	}
	.keyid{
		font-size: 14px;
	}

	.keystatus{
		font-size: 11px;
	}
	.iconcube{
		font-size: 40px;
		padding-top: 7px;
		text-align: center;
		color:#1579C4;
	}
</style>	
<?
	}else{
?>		
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-warning" role="alert" align="center">
					No se han encontrado Keys para servicios web registradas
				</div>
			</div>
			<div class="col-md-12">
				<button class="btn btn-primary btn-lg pull-right" onClick="LoadWsCofig('/ws_keys/nuevo/', 'listkeys')">
					<span class='fa fa-plus'></span> Crear Key de Servicios Web
				</button>
			</div>
		</div>
<?
	}
?>