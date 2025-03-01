<form  action="<?php echo HOMEDIR ?>/gestion_transferencias/historial/" method="POST">
	<div class="row" style="margin:0px; margin-top:20px; margin-left:20px;">
		<div class="col-md-12">
			<h4>Consulta de Transferencias</h4>	
		</div>
	</div>
	<div class="row" style="margin:0px; margin-left: 20px;">
		<div class="col-md-2">
			<label for="">Fecha de Inicio
				<input type="date" name="fi" id="fi" value="<?php echo $fi ?>" class="input1_0 form-control" style="border:1px solid #CCC; height: 35px;">
			</label>
		</div>
		<div class="col-md-2">
			<label for="">Fecha de Corte
				<input type="date" name="ff" id="ff" value="<?php echo $ff ?>" class="input1_0 form-control" style="border:1px solid #CCC; height: 35px;">
				
			</label>
		</div>
		<div class="col-md-2">
			<label for="">Tipo de Transferencia
				<select id="id" name="id" class="input1_0 form-control" style="border:1px solid #CCC; height: 35px;">
					<option value="1" <?php echo ($type == "1")?"selected='selected'":"" ?> >Transferencias Generadas</option>
					<option value="2" <?php echo ($type == "2")?"selected='selected'":"" ?>>Transferencias Recibidas</option>
					<option value="3" <?php echo ($type == "3")?"selected='selected'":"" ?>>Transferencias Rechazadas</option>
				</select>
			</label>
		</div>
		<div class="col-md-2" style="padding-top: 20px">
			<input type="submit" value="Consultar">
		</div>
	</div> 
</form>
<hr>
<div class="row" style="margin:0px"> 
	<div class="col-md-10" style="padding:20px !important">
<?
	$y = $consulta;
	$t = $con->NumRows($y);
?>
		<h2><?= $titulo ?> (<?= $t ?>) Resultados Encontrados</h2>
		<br>
		<div class="list-group">
					
	<?
		$j = 0;

		
		while ($rx = $con->FetchAssoc($consulta)) {
			$u = new MUsuarios;
			$u->createUsuarios("a_i", $rx['user_recibe']);

			$ux = new MUsuarios;
			$ux->createUsuarios("user_id", $rx['user_transfiere']);

			$j++;
			$path = "";
			$xpath = "";
			echo "<div class='list-group-item' id='r".$rx['id']."'>";

			$estados = array("0" => "SOLICITUD PENDIENTE", "1" => "SOLICITUD ACEPTADA", "2" => "SOLICITUD RECHAZADA");
			if ($rx['estado'] == "2") {
				$xpath = '	<div class="col-md-12">
							 	<b>Rechazado Por:</b> <br>
								'.$rx['observaciona'].' el '.$rx['fecha_aceptacion'].'
							</div>';
			}

			$path = '
					<div class="col-md-8">
					 	<b>Transferido a:</b> <br>
						'.$u->GetP_nombre().' '.$u->GetP_apellido().' 
					</div>
					<div class="col-md-4">
						<b>Fecha de Transferencia:</b> <br>
						'.$rx['fecha_transferencia'].' 
					</div>';		
			$path .= '
					<div class="col-md-8">
					 	<b>Transferido Por:</b> <br>
						'.$ux->GetP_nombre().' '.$ux->GetP_apellido().' 
					</div>
					<div class="col-md-4">
						<b>Estado:</b> <br>
						'.$estados[$rx['estado']].' 
					</div>';		

			echo $c->GetVistaExpedienteReducida($rx['gestion_id'], $path.$xpath);
			echo "</div>";
		}
	?>
		</div>
	<?
			if ($j == "0"){
				echo '<div class="alert alert-info" role="alert">No se encontraron resultados</div>';
			}
	?>
		</div>
	</div>
</div>

<style type="text/css">
	/*FORMATO DE TABLA*/

/* Grid */

@media (min-width: 992px)

	.col-md-3 ,.col-md-9 {

	    padding-top: 6px !important;

	}

}

	.row {



		border-bottom: solid 1px transparent;

				-moz-box-sizing: border-box;

				-webkit-box-sizing: border-box;

				box-sizing: border-box;

			}

		.row > * {

				float: left;

				-moz-box-sizing: border-box;

				-webkit-box-sizing: border-box;

				box-sizing: border-box;

			}

		.row:after, .row:before {

				content: '';

				display: block;

				clear: both;

				height: 0;

			}

		.row.uniform > * > :first-child {

				margin-top: 0;

			}

		.row.uniform > * > :last-child {

				margin-bottom: 0;

			}

		.row.\30 \25 > * {

				padding: 0px 0 0 0px;

			}

		.row.\30 \25 {

				margin: 0px 0 -1px 0px;

			}

		.row.uniform.\30 \25 > * {

				padding: 0px 0 0 0px;

			}

		.row.uniform.\30 \25 {

				margin: 0px 0 -1px 0px;

			}

		.row > * {

				padding: 30px 0 0 5px;

			}

		.row {

				margin: -50px 0 -1px -50px;

			}

		.row.uniform > * {

				padding: 50px 0 0 50px;

			}

		.row.uniform {

				margin: -50px 0 -1px -50px;

			}

		.row.\32 00\25 > * {

				padding: 100px 0 0 100px;

			}

		.row.\32 00\25 {

				margin: -100px 0 -1px -100px;

			}

		.row.uniform.\32 00\25 > * {

				padding: 100px 0 0 100px;

			}

		.row.uniform.\32 00\25 {

				margin: -100px 0 -1px -100px;

			}

		.row.\31 50\25 > * {

				padding: 75px 0 0 75px;

			}

		.row.\31 50\25 {

				margin: -75px 0 -1px -75px;

			}

		.row.uniform.\31 50\25 > * {

				padding: 75px 0 0 75px;

			}

		.row.uniform.\31 50\25 {

				margin: -75px 0 -1px -75px;

			}

		.row.\35 0\25 > * {

				padding: 25px 0 0 25px;

			}

		.row.\35 0\25 {

				margin: -25px 0 -1px -25px;

			}

		.row.uniform.\35 0\25 > * {

				padding: 25px 0 0 25px;

			}

		.row.uniform.\35 0\25 {

				margin: -25px 0 -1px -25px;

			}

		.row.\32 5\25 > * {

				padding: 12.5px 0 0 12.5px;

			}

		.row.\32 5\25 {

				margin: -12.5px 0 -1px -12.5px;

			}

		.row.uniform.\32 5\25 > * {

				padding: 12.5px 0 0 12.5px;

			}

		.row.uniform.\32 5\25 {

				margin: -12.5px 0 -1px -12.5px;

			}

		.\31 2u, .\31 2u\24 {

				width: 100%;

				clear: none;

				margin-left: 0;

			}

		.\31 1u, .\31 1u\24 {

				width: 91.6666666667%;

				clear: none;

				margin-left: 0;

			}

		.\31 0u, .\31 0u\24 {

				width: 83.3333333333%;

				clear: none;

				margin-left: 0;

			}

		.\39 u, .\39 u\24 {

				width: 75%;

				clear: none;

				margin-left: 0;

			}

		.\38 u, .\38 u\24 {

				width: 66.6666666667%;

				clear: none;

				margin-left: 0;

			}

		.\37 u, .\37 u\24 {

				width: 58.3333333333%;

				clear: none;

				margin-left: 0;

			}

		.\36 u, .\36 u\24 {

				width: 50%;

				clear: none;

				margin-left: 0;

			}

		.\35 u, .\35 u\24 {

				width: 41.6666666667%;

				clear: none;

				margin-left: 0;

			}

		.\34 u, .\34 u\24 {

				width: 33.3333333333%;

				clear: none;

				margin-left: 0;

			}

		.\33 u, .\33 u\24 {

				width: 25%;

				clear: none;

				margin-left: 0;

			}

		.\32 u, .\32 u\24 {

				width: 16.6666666667%;

				clear: none;

				margin-left: 0;

			}

		.\31 u, .\31 u\24 {

				width: 8.3333333333%;

				clear: none;

				margin-left: 0;

			}

		.\31 2u\24 + *,

			.\31 1u\24 + *,

			.\31 0u\24 + *,

			.\39 u\24 + *,

			.\38 u\24 + *,

			.\37 u\24 + *,

			.\36 u\24 + *,

			.\35 u\24 + *,

			.\34 u\24 + *,

			.\33 u\24 + *,

			.\32 u\24 + *,

			.\31 u\24 + * {

				clear: left;

			}

		.\-11u {

				margin-left: 91.66667%;

			}

		.\-10u {

				margin-left: 83.33333%;

			}

		.\-9u {

				margin-left: 75%;

			}

		.\-8u {

				margin-left: 66.66667%;

			}

		.\-7u {

				margin-left: 58.33333%;

			}

		.\-6u {

				margin-left: 50%;

			}

		.\-5u {

				margin-left: 41.66667%;

			}

		.\-4u {

				margin-left: 33.33333%;

				border-bottom: 1px solid #ccc;

			}

		.\-3u {

				margin-left: 25%;

				border-bottom: 1px solid #ccc;

			}

		.\-2u {

				margin-left: 16.66667%;

				border-bottom: 1px solid #ccc;

			}

		.\-1u {

				margin-left: 8.33333%;

			}

		@media screen and (max-width: 1280px) {

			.row > * {

						padding: 4px 0 0 4px;

					}

				.row {

							margin: -40px 0 -1px -40px;

						}

				.row.uniform > * {

							padding: 40px 0 0 40px;

						}

				.row.uniform {

							margin: -40px 0 -1px -40px;

						}

				.row.\32 00\25 > * {

							padding: 80px 0 0 80px;

						}

				.row.\32 00\25 {

							margin: -80px 0 -1px -80px;

						}

				.row.uniform.\32 00\25 > * {

							padding: 80px 0 0 80px;

						}

				.row.uniform.\32 00\25 {

							margin: -80px 0 -1px -80px;

						}

				.row.\31 50\25 > * {

							padding: 60px 0 0 60px;

						}

				.row.\31 50\25 {

							margin: -60px 0 -1px -60px;

						}

				.row.uniform.\31 50\25 > * {

							padding: 60px 0 0 60px;

						}

				.row.uniform.\31 50\25 {

							margin: -60px 0 -1px -60px;

						}

				.row.\35 0\25 > * {

							padding: 20px 0 0 20px;

						}

				.row.\35 0\25 {

							margin: -20px 0 -1px -20px;

						}

				.row.uniform.\35 0\25 > * {

							padding: 20px 0 0 20px;

						}

				.row.uniform.\35 0\25 {

							margin: -20px 0 -1px -20px;

						}

				.row.\32 5\25 > * {

							padding: 10px 0 0 10px;

						}

				.row.\32 5\25 {

							margin: -10px 0 -1px -10px;

						}

				.row.uniform.\32 5\25 > * {

							padding: 10px 0 0 10px;

						}

				.row.uniform.\32 5\25 {

							margin: -10px 0 -1px -10px;

						}

				.\31 2u\28normal\29, .\31 2u\24\28normal\29 {

							width: 100%;

							clear: none;

							margin-left: 0;

						}

				.\31 1u\28normal\29, .\31 1u\24\28normal\29 {

							width: 91.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 0u\28normal\29, .\31 0u\24\28normal\29 {

							width: 83.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\39 u\28normal\29, .\39 u\24\28normal\29 {

							width: 75%;

							clear: none;

							margin-left: 0;

						}

				.\38 u\28normal\29, .\38 u\24\28normal\29 {

							width: 66.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\37 u\28normal\29, .\37 u\24\28normal\29 {

							width: 58.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\36 u\28normal\29, .\36 u\24\28normal\29 {

							width: 50%;

							clear: none;

							margin-left: 0;

						}

				.\35 u\28normal\29, .\35 u\24\28normal\29 {

							width: 41.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\34 u\28normal\29, .\34 u\24\28normal\29 {

							width: 33.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\33 u\28normal\29, .\33 u\24\28normal\29 {

							width: 25%;

							clear: none;

							margin-left: 0;

						}

				.\32 u\28normal\29, .\32 u\24\28normal\29 {

							width: 16.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 u\28normal\29, .\31 u\24\28normal\29 {

							width: 8.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\31 2u\24\28normal\29 + *,

						.\31 1u\24\28normal\29 + *,

						.\31 0u\24\28normal\29 + *,

						.\39 u\24\28normal\29 + *,

						.\38 u\24\28normal\29 + *,

						.\37 u\24\28normal\29 + *,

						.\36 u\24\28normal\29 + *,

						.\35 u\24\28normal\29 + *,

						.\34 u\24\28normal\29 + *,

						.\33 u\24\28normal\29 + *,

						.\32 u\24\28normal\29 + *,

						.\31 u\24\28normal\29 + * {

							clear: left;

						}

				.\-11u\28normal\29 {

							margin-left: 91.66667%;

						}

				.\-10u\28normal\29 {

							margin-left: 83.33333%;

						}

				.\-9u\28normal\29 {

							margin-left: 75%;

						}

				.\-8u\28normal\29 {

							margin-left: 66.66667%;

						}

				.\-7u\28normal\29 {

							margin-left: 58.33333%;

						}

				.\-6u\28normal\29 {

							margin-left: 50%;

						}

				.\-5u\28normal\29 {

							margin-left: 41.66667%;

						}

				.\-4u\28normal\29 {

							margin-left: 33.33333%;

						}

				.\-3u\28normal\29 {

							margin-left: 25%;

						}

				.\-2u\28normal\29 {

							margin-left: 16.66667%;

						}

				.\-1u\28normal\29 {

							margin-left: 8.33333%;

						}

			}

			@media screen and (max-width: 1080px) {

				.row > * {

							padding: 40px 0 0 40px;

						}

				.row {

							margin: -40px 0 -1px -40px;

						}

				.row.uniform > * {

							padding: 40px 0 0 40px;

						}

				.row.uniform {

							margin: -40px 0 -1px -40px;

						}

				.row.\32 00\25 > * {

							padding: 80px 0 0 80px;

						}

				.row.\32 00\25 {

							margin: -80px 0 -1px -80px;

						}

				.row.uniform.\32 00\25 > * {

							padding: 80px 0 0 80px;

						}

				.row.uniform.\32 00\25 {

							margin: -80px 0 -1px -80px;

						}

				.row.\31 50\25 > * {

							padding: 60px 0 0 60px;

						}

				.row.\31 50\25 {

							margin: -60px 0 -1px -60px;

						}

				.row.uniform.\31 50\25 > * {

							padding: 60px 0 0 60px;

						}

				.row.uniform.\31 50\25 {

							margin: -60px 0 -1px -60px;

						}

				.row.\35 0\25 > * {

							padding: 20px 0 0 20px;

						}

				.row.\35 0\25 {

							margin: -20px 0 -1px -20px;

						}

				.row.uniform.\35 0\25 > * {

							padding: 20px 0 0 20px;

						}

				.row.uniform.\35 0\25 {

							margin: -20px 0 -1px -20px;

						}

				.row.\32 5\25 > * {

							padding: 10px 0 0 10px;

						}

				.row.\32 5\25 {

							margin: -10px 0 -1px -10px;

						}

				.row.uniform.\32 5\25 > * {

							padding: 10px 0 0 10px;

						}

				.row.uniform.\32 5\25 {

							margin: -10px 0 -1px -10px;

						}

				.\31 2u\28narrow\29, .\31 2u\24\28narrow\29 {

							width: 100%;

							clear: none;

							margin-left: 0;

						}

				.\31 1u\28narrow\29, .\31 1u\24\28narrow\29 {

							width: 91.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 0u\28narrow\29, .\31 0u\24\28narrow\29 {

							width: 83.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\39 u\28narrow\29, .\39 u\24\28narrow\29 {

							width: 75%;

							clear: none;

							margin-left: 0;

						}

				.\38 u\28narrow\29, .\38 u\24\28narrow\29 {

							width: 66.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\37 u\28narrow\29, .\37 u\24\28narrow\29 {

							width: 58.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\36 u\28narrow\29, .\36 u\24\28narrow\29 {

							width: 50%;

							clear: none;

							margin-left: 0;

						}

				.\35 u\28narrow\29, .\35 u\24\28narrow\29 {

							width: 41.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\34 u\28narrow\29, .\34 u\24\28narrow\29 {

							width: 33.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\33 u\28narrow\29, .\33 u\24\28narrow\29 {

							width: 25%;

							clear: none;

							margin-left: 0;

						}

				.\32 u\28narrow\29, .\32 u\24\28narrow\29 {

							width: 16.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 u\28narrow\29, .\31 u\24\28narrow\29 {

							width: 8.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\31 2u\24\28narrow\29 + *,

						.\31 1u\24\28narrow\29 + *,

						.\31 0u\24\28narrow\29 + *,

						.\39 u\24\28narrow\29 + *,

						.\38 u\24\28narrow\29 + *,

						.\37 u\24\28narrow\29 + *,

						.\36 u\24\28narrow\29 + *,

						.\35 u\24\28narrow\29 + *,

						.\34 u\24\28narrow\29 + *,

						.\33 u\24\28narrow\29 + *,

						.\32 u\24\28narrow\29 + *,

						.\31 u\24\28narrow\29 + * {

							clear: left;

						}

				.\-11u\28narrow\29 {

							margin-left: 91.66667%;

						}

				.\-10u\28narrow\29 {

							margin-left: 83.33333%;

						}

				.\-9u\28narrow\29 {

							margin-left: 75%;

						}

				.\-8u\28narrow\29 {

							margin-left: 66.66667%;

						}

				.\-7u\28narrow\29 {

							margin-left: 58.33333%;

						}

				.\-6u\28narrow\29 {

							margin-left: 50%;

						}

				.\-5u\28narrow\29 {

							margin-left: 41.66667%;

						}

				.\-4u\28narrow\29 {

							margin-left: 33.33333%;

						}

				.\-3u\28narrow\29 {

							margin-left: 25%;

						}

				.\-2u\28narrow\29 {

							margin-left: 16.66667%;

						}

				.\-1u\28narrow\29 {

							margin-left: 8.33333%;

						}

			}

			@media screen and (max-width: 820px) {

				.row > * {

							padding: 30px 0 0 30px;

						}

				.row {

							margin: -30px 0 -1px -30px;

						}

				.row.uniform > * {

							padding: 30px 0 0 30px;

						}

				.row.uniform {

							margin: -30px 0 -1px -30px;

						}

				.row.\32 00\25 > * {

							padding: 60px 0 0 60px;

						}

				.row.\32 00\25 {

							margin: -60px 0 -1px -60px;

						}

				.row.uniform.\32 00\25 > * {

							padding: 60px 0 0 60px;

						}

				.row.uniform.\32 00\25 {

							margin: -60px 0 -1px -60px;

						}

				.row.\31 50\25 > * {

							padding: 45px 0 0 45px;

						}

				.row.\31 50\25 {

							margin: -45px 0 -1px -45px;

						}

				.row.uniform.\31 50\25 > * {

							padding: 45px 0 0 45px;

						}

				.row.uniform.\31 50\25 {

							margin: -45px 0 -1px -45px;

						}

				.row.\35 0\25 > * {

							padding: 15px 0 0 15px;

						}

				.row.\35 0\25 {

							margin: -15px 0 -1px -15px;

						}

				.row.uniform.\35 0\25 > * {

							padding: 15px 0 0 15px;

						}

				.row.uniform.\35 0\25 {

							margin: -15px 0 -1px -15px;

						}

				.row.\32 5\25 > * {

							padding: 7.5px 0 0 7.5px;

						}

				.row.\32 5\25 {

							margin: -7.5px 0 -1px -7.5px;

						}

				.row.uniform.\32 5\25 > * {

							padding: 7.5px 0 0 7.5px;

						}

				.row.uniform.\32 5\25 {

							margin: -7.5px 0 -1px -7.5px;

						}

				.\31 2u\28narrower\29, .\31 2u\24\28narrower\29 {

							width: 100%;

							clear: none;

							margin-left: 0;

						}

				.\31 1u\28narrower\29, .\31 1u\24\28narrower\29 {

							width: 91.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 0u\28narrower\29, .\31 0u\24\28narrower\29 {

							width: 83.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\39 u\28narrower\29, .\39 u\24\28narrower\29 {

							width: 75%;

							clear: none;

							margin-left: 0;

						}

				.\38 u\28narrower\29, .\38 u\24\28narrower\29 {

							width: 66.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\37 u\28narrower\29, .\37 u\24\28narrower\29 {

							width: 58.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\36 u\28narrower\29, .\36 u\24\28narrower\29 {

							width: 50%;

							clear: none;

							margin-left: 0;

						}

				.\35 u\28narrower\29, .\35 u\24\28narrower\29 {

							width: 41.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\34 u\28narrower\29, .\34 u\24\28narrower\29 {

							width: 33.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\33 u\28narrower\29, .\33 u\24\28narrower\29 {

							width: 25%;

							clear: none;

							margin-left: 0;

						}

				.\32 u\28narrower\29, .\32 u\24\28narrower\29 {

							width: 16.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 u\28narrower\29, .\31 u\24\28narrower\29 {

							width: 8.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\31 2u\24\28narrower\29 + *,

						.\31 1u\24\28narrower\29 + *,

						.\31 0u\24\28narrower\29 + *,

						.\39 u\24\28narrower\29 + *,

						.\38 u\24\28narrower\29 + *,

						.\37 u\24\28narrower\29 + *,

						.\36 u\24\28narrower\29 + *,

						.\35 u\24\28narrower\29 + *,

						.\34 u\24\28narrower\29 + *,

						.\33 u\24\28narrower\29 + *,

						.\32 u\24\28narrower\29 + *,

						.\31 u\24\28narrower\29 + * {

							clear: left;

						}

				.\-11u\28narrower\29 {

							margin-left: 91.66667%;

						}

				.\-10u\28narrower\29 {

							margin-left: 83.33333%;

						}

				.\-9u\28narrower\29 {

							margin-left: 75%;

						}

				.\-8u\28narrower\29 {

							margin-left: 66.66667%;

						}

				.\-7u\28narrower\29 {

							margin-left: 58.33333%;

						}

				.\-6u\28narrower\29 {

							margin-left: 50%;

						}

				.\-5u\28narrower\29 {

							margin-left: 41.66667%;

						}

				.\-4u\28narrower\29 {

							margin-left: 33.33333%;

						}

				.\-3u\28narrower\29 {

							margin-left: 25%;

						}

				.\-2u\28narrower\29 {

							margin-left: 16.66667%;

						}

				.\-1u\28narrower\29 {

							margin-left: 8.33333%;

						}

			}

			@media screen and (max-width: 736px) {

				.row > * {

							padding: 30px 0 0 30px;

						}

				.row {

							margin: -30px 0 -1px -30px;

						}

				.row.uniform > * {

							padding: 30px 0 0 30px;

						}

				.row.uniform {

							margin: -30px 0 -1px -30px;

						}

				.row.\32 00\25 > * {

							padding: 60px 0 0 60px;

						}

				.row.\32 00\25 {

							margin: -60px 0 -1px -60px;

						}

				.row.uniform.\32 00\25 > * {

							padding: 60px 0 0 60px;

						}

				.row.uniform.\32 00\25 {

							margin: -60px 0 -1px -60px;

						}

				.row.\31 50\25 > * {

							padding: 45px 0 0 45px;

						}

				.row.\31 50\25 {

							margin: -45px 0 -1px -45px;

						}

				.row.uniform.\31 50\25 > * {

							padding: 45px 0 0 45px;

						}

				.row.uniform.\31 50\25 {

							margin: -45px 0 -1px -45px;

						}

				.row.\35 0\25 > * {

							padding: 15px 0 0 15px;

						}

				.row.\35 0\25 {

							margin: -15px 0 -1px -15px;

						}

				.row.uniform.\35 0\25 > * {

							padding: 15px 0 0 15px;

						}

				.row.uniform.\35 0\25 {

							margin: -15px 0 -1px -15px;

						}

				.row.\32 5\25 > * {

							padding: 7.5px 0 0 7.5px;

						}

				.row.\32 5\25 {

							margin: -7.5px 0 -1px -7.5px;

						}

				.row.uniform.\32 5\25 > * {

							padding: 7.5px 0 0 7.5px;

						}

				.row.uniform.\32 5\25 {

							margin: -7.5px 0 -1px -7.5px;

						}

				.\31 2u\28mobile\29, .\31 2u\24\28mobile\29 {

							width: 100%;

							clear: none;

							margin-left: 0;

						}

				.\31 1u\28mobile\29, .\31 1u\24\28mobile\29 {

							width: 91.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 0u\28mobile\29, .\31 0u\24\28mobile\29 {

							width: 83.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\39 u\28mobile\29, .\39 u\24\28mobile\29 {

							width: 75%;

							clear: none;

							margin-left: 0;

						}

				.\38 u\28mobile\29, .\38 u\24\28mobile\29 {

							width: 66.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\37 u\28mobile\29, .\37 u\24\28mobile\29 {

							width: 58.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\36 u\28mobile\29, .\36 u\24\28mobile\29 {

							width: 50%;

							clear: none;

							margin-left: 0;

						}

				.\35 u\28mobile\29, .\35 u\24\28mobile\29 {

							width: 41.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\34 u\28mobile\29, .\34 u\24\28mobile\29 {

							width: 33.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\33 u\28mobile\29, .\33 u\24\28mobile\29 {

							width: 25%;

							clear: none;

							margin-left: 0;

						}

				.\32 u\28mobile\29, .\32 u\24\28mobile\29 {

							width: 16.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 u\28mobile\29, .\31 u\24\28mobile\29 {

							width: 8.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\31 2u\24\28mobile\29 + *,

						.\31 1u\24\28mobile\29 + *,

						.\31 0u\24\28mobile\29 + *,

						.\39 u\24\28mobile\29 + *,

						.\38 u\24\28mobile\29 + *,

						.\37 u\24\28mobile\29 + *,

						.\36 u\24\28mobile\29 + *,

						.\35 u\24\28mobile\29 + *,

						.\34 u\24\28mobile\29 + *,

						.\33 u\24\28mobile\29 + *,

						.\32 u\24\28mobile\29 + *,

						.\31 u\24\28mobile\29 + * {

							clear: left;

						}

				.\-11u\28mobile\29 {

							margin-left: 91.66667%;

						}

				.\-10u\28mobile\29 {

							margin-left: 83.33333%;

						}

				.\-9u\28mobile\29 {

							margin-left: 75%;

						}

				.\-8u\28mobile\29 {

							margin-left: 66.66667%;

						}

				.\-7u\28mobile\29 {

							margin-left: 58.33333%;

						}

				.\-6u\28mobile\29 {

							margin-left: 50%;

						}

				.\-5u\28mobile\29 {

							margin-left: 41.66667%;

						}

				.\-4u\28mobile\29 {

							margin-left: 33.33333%;

						}

				.\-3u\28mobile\29 {

							margin-left: 25%;

						}

				.\-2u\28mobile\29 {

							margin-left: 16.66667%;

						}

				.\-1u\28mobile\29 {

							margin-left: 8.33333%;

						}

			}

			@media screen and (max-width: 480px) {

				.row > * {

							padding: 20px 0 0 20px;

						}

				.row {

							margin: -20px 0 -1px -20px;

						}

				.row.uniform > * {

							padding: 20px 0 0 20px;

						}

				.row.uniform {

							margin: -20px 0 -1px -20px;

						}

				.row.\32 00\25 > * {

							padding: 40px 0 0 40px;

						}

				.row.\32 00\25 {

							margin: -40px 0 -1px -40px;

						}

				.row.uniform.\32 00\25 > * {

							padding: 40px 0 0 40px;

						}

				.row.uniform.\32 00\25 {

							margin: -40px 0 -1px -40px;

						}

				.row.\31 50\25 > * {

							padding: 30px 0 0 30px;

						}

				.row.\31 50\25 {

							margin: -30px 0 -1px -30px;

						}

				.row.uniform.\31 50\25 > * {

							padding: 30px 0 0 30px;

						}

				.row.uniform.\31 50\25 {

							margin: -30px 0 -1px -30px;

						}

				.row.\35 0\25 > * {

							padding: 10px 0 0 10px;

						}

				.row.\35 0\25 {

							margin: -10px 0 -1px -10px;

						}

				.row.uniform.\35 0\25 > * {

							padding: 10px 0 0 10px;

						}

				.row.uniform.\35 0\25 {

							margin: -10px 0 -1px -10px;

						}

				.row.\32 5\25 > * {

							padding: 5px 0 0 5px;

						}

				.row.\32 5\25 {

							margin: -5px 0 -1px -5px;

						}

				.row.uniform.\32 5\25 > * {

							padding: 5px 0 0 5px;

						}

				.row.uniform.\32 5\25 {

							margin: -5px 0 -1px -5px;

						}

				.\31 2u\28mobilep\29, .\31 2u\24\28mobilep\29 {

							width: 100%;

							clear: none;

							margin-left: 0;

						}

				.\31 1u\28mobilep\29, .\31 1u\24\28mobilep\29 {

							width: 91.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 0u\28mobilep\29, .\31 0u\24\28mobilep\29 {

							width: 83.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\39 u\28mobilep\29, .\39 u\24\28mobilep\29 {

							width: 75%;

							clear: none;

							margin-left: 0;

						}

				.\38 u\28mobilep\29, .\38 u\24\28mobilep\29 {

							width: 66.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\37 u\28mobilep\29, .\37 u\24\28mobilep\29 {

							width: 58.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\36 u\28mobilep\29, .\36 u\24\28mobilep\29 {

							width: 50%;

							clear: none;

							margin-left: 0;

						}

				.\35 u\28mobilep\29, .\35 u\24\28mobilep\29 {

							width: 41.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\34 u\28mobilep\29, .\34 u\24\28mobilep\29 {

							width: 33.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\33 u\28mobilep\29, .\33 u\24\28mobilep\29 {

							width: 25%;

							clear: none;

							margin-left: 0;

						}

				.\32 u\28mobilep\29, .\32 u\24\28mobilep\29 {

							width: 16.6666666667%;

							clear: none;

							margin-left: 0;

						}

				.\31 u\28mobilep\29, .\31 u\24\28mobilep\29 {

							width: 8.3333333333%;

							clear: none;

							margin-left: 0;

						}

				.\31 2u\24\28mobilep\29 + *,

						.\31 1u\24\28mobilep\29 + *,

						.\31 0u\24\28mobilep\29 + *,

						.\39 u\24\28mobilep\29 + *,

						.\38 u\24\28mobilep\29 + *,

						.\37 u\24\28mobilep\29 + *,

						.\36 u\24\28mobilep\29 + *,

						.\35 u\24\28mobilep\29 + *,

						.\34 u\24\28mobilep\29 + *,

						.\33 u\24\28mobilep\29 + *,

						.\32 u\24\28mobilep\29 + *,

						.\31 u\24\28mobilep\29 + * {

							clear: left;

						}

				.\-11u\28mobilep\29 {

							margin-left: 91.66667%;

						}

				.\-10u\28mobilep\29 {

							margin-left: 83.33333%;

						}

				.\-9u\28mobilep\29 {

							margin-left: 75%;

						}

				.\-8u\28mobilep\29 {

							margin-left: 66.66667%;

						}

				.\-7u\28mobilep\29 {

							margin-left: 58.33333%;

						}

				.\-6u\28mobilep\29 {

							margin-left: 50%;

						}

				.\-5u\28mobilep\29 {

							margin-left: 41.66667%;

						}

				.\-4u\28mobilep\29 {

							margin-left: 33.33333%;

						}

				.\-3u\28mobilep\29 {

							margin-left: 25%;

						}

				.\-2u\28mobilep\29 {

							margin-left: 16.66667%;

						}

				.\-1u\28mobilep\29 {

							margin-left: 8.33333%;

						}

			}

</style>