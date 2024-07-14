<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/agenda.css'/>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<div class="icon white_contacto search_icon"></div>
			<div class="text-folder">Resultados de busqueda: "<?= $attr; ?>"</div>
		</div>
		<div class="header-agenda">
			
		</div>
	</div>
</div>
<div id="folders-content">
	<div id="folders-list-content">
		<div class="contact-list_main_2">

<?
	

	$id = $attr;
	$us = $_SESSION["usuario"];


		if($id == ""){
			echo "<div class='da-message error'>Resultados: Debe ingresar algo para buscar</div>";
		}else{
			// Anexos
			if ($_SESSION['suscriptor_id'] == "") {
				$s1 = "select * from gestion where num_oficio_respuesta like '%".$id."%' or radicado like '%".$id."%' or min_rad like '%".$id."%'";
			}else{
				$s1 = "select * from gestion where num_oficio_respuesta = '".$id."' and suscriptor_id = '".$_SESSION['suscriptor_id']."' or radicado = '".$id."' and suscriptor_id = '".$_SESSION['suscriptor_id']."'";	
			}

				$q1 = $con->Query($s1);
				
				$pathn  = "";
				$pathm  = "";				
				$type_s = "Radicados";
				$i1 = 0;
				echo "<div class='search_result'>";	
				echo "<div class='header_result'><div class='bold'>".$type_s."</div>";

				if($con->NumRows($q1) <= 0){
					echo "<div class='light'>$i1 $type_s encontrados que contengan \"$id\" </div></div><div class='clear'></div>";
				}else{
					global $c;
					$i1 = 0;
					echo "<div class='light'>1 $type_s encontrados que contienen \"$id\" </div></div><div class='clear'></div>";
					while($row = $con->FetchAssoc($q1)){

						$i2++;

						$c->GetVistaExpedienteDefault($row["id"], $path);
						echo "<div class='clear'></div>";
					}
					echo "<div class='clear'></div>";
					
				}
				echo "</div><div class='clear'></div>";
			

		}
?>

		</div>
	</div>
</div>

<style type="text/css">
	
	.title_rad{
		float:left;
		font-weight: bold;
		font-size:16px;
		line-height: 20px;
		margin-bottom: 10px;
	}

	.alt_rad{
		float:left;
		font-size:14px;
		line-height: 20px;
		margin-bottom: 10px;
	}

	.title2{
		height: 30px;
		line-height: 30px;
	}
	.width60{ width:57%; float:left; text-align: left }
	.width50{ width:47%; float:left; text-align: left }
	.width30{ width:27%; float:left; text-align: left }
	.width40{ width:37%; float:left; text-align: left }
	.width25{ width:22%; float:left; text-align: left }

	.search_result{
		padding: 30px;
	}
</style>
