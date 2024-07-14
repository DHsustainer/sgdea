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

	global $c;	

	$id = $attr;
	$us = $_SESSION["usuario"];


		if($id == ""){
			echo "<div class='da-message error'>Resultados: Debe ingresar algo para buscar</div>";
		}else{
			// Anexos
				$s1 =		"SELECT * 
							FROM gestion_tipologias_big_data 
								WHERE 
									MATCH(col_1, col_2, col_3, col_4, col_5, col_6, col_7, col_8, col_9, col_10, col_11, col_12, col_13, col_14, col_15) 
									AGAINST('".$id."' IN BOOLEAN MODE)";

				#$s1 = "	select * from gestion_anexos where nombre like '%".$id."%'";
/*
				$q1 = $con->Query($s1);
				
				$pathn  = "";
				$pathm  = "";				
				$type_s = "Anexos";
				$i1 = 0;
				$pathn .= "<div class='search_result'>";	
				$pathn .= "<div class='header_result'><div class='bold'>".$type_s."</div>";
				if($con->NumRows($q1) <= 0){
					$pathn .= "<div class='light'>$i1 $type_s encontrados que contengan \"$id\" </div></div><div class='clear'></div>";
				}else{
					$i1 = 0;
					$pathm = "";
					while($row = $con->FetchAssoc($q1)){

						$ga = new MGestion_anexos;
						$ga->CreateGestion_anexos("id", $row['proceso_id']);

						$i1++;
						$imid = $row["id"];
						$g = new MGestion;
						$g->CreateGestion("id", $ga->GetGestion_id());

						$tit_anexo = $ga->GetNombre();
						$tit_demanda = $g->GetNum_oficio_respuesta();

						if (strlen($tit_demanda) >= 50 ) {
							$tit_demanda = substr($tit_demanda, 0, 50)."...";
						}

						$pathm .= "	<div class='result_box'>
										<div class='logo_s'></div>
										<div class='search_text' title = '".$g->GetNum_oficio_respuesta()."'>
											<div class='link_search'><a href='/gestion/ver/".$g->GetId()."/'>".$tit_anexo."</a></div>
											<div class='tit_demanda'>".$tit_demanda."</div>
										</div>

									</div>";
					}
					$pathm .= "<div class='clear'></div>";
					$pathn .= "<div class='light'>$i1 $type_s encontrados que contienen \"$id\" </div></div><div class='clear'></div>";
				}
				echo $pathn.$pathm."</div><div class='clear'></div>";
			
*/

			


			// Caratula
				$s2 = "SELECT * FROM gestion WHERE nombre_radica like'%$id%' or observacion like '%$id%' or observacion2 like '%$id%'";
				$q2 = $con->Query($s2);
			
				$type_s = "Expedientes";
				$i2 = 0;
				echo "	<div class='search_result'>";	
				echo "		<div class='header_result'>
								<div class='bold'>".$type_s."</div>";
				if($con->NumRows($q2) <= 0){
					echo "			<div class='light'>$i2 $type_s encontrados que contengan \"$id\" </div>
							</div>
							<div class='clear'></div>";
				}else{
					$i2 = 0;
					
					echo "<div class='light'>$i2 $type_s encontrados que contienen \"$id\" </div></div><div class='clear'></div>";
					while($row2 = $con->FetchAssoc($q2)){
						$i2++;

						$c->GetVistaExpedienteDefault($row2["id"], $path);
						echo "<div class='clear'></div>";
					}
				}
				echo "		</div>
						<div class='clear'></div>";



/*



			// Demandado Proceso
				$s3 = "SELECT * FROM documentos_gestion WHERE nombre like '%$id%' or contenido like '%$id%' ";

				$q3 = $con->Query($s3);
		
				$pathn  = "";
				$pathm  = "";				
				$type_s = "Documentos";
				$i3 = 0;
				$pathn .= "<div class='search_result'>";	
				$pathn .= "<div class='header_result'><div class='bold'>".$type_s."</div>";
				if($con->NumRows($q3) <= 0){
					$pathn .= "<div class='light'>$i3 $type_s encontrados que contengan \"$id\" </div></div><div class='clear'></div>";
				}else{
					$i3 = 0;
					$pathm = "";
					while($row3 = $con->FetchAssoc($q3)){

						$i3++;
						$g = new MGestion;
						$g->CreateGestion("id", $row3['gestion_id']);

						$tit_anexo = $row3["nombre"];
						$tit_demanda = $g->GetNum_oficio_respuesta();


						#echo "<li><a href='ver_demanda.php?id=".$car->GetId()."&pro=".$row3["proceso_id"]."#dmdo".$row3["id"]."'>".$row3["p_nombre"]."</a></li>" ;						

						$tit_demanda = $g->GetNum_oficio_respuesta();

						if (strlen($tit_demanda) >= 50 ) {
							$tit_demanda = substr($tit_demanda, 0, 50)."...";
						}

						$pathm .= "	<div class='result_box'>
										<div class='logo_s'></div>
										<div class='search_text' title = '".$car->GetTit_demanda()."'>
											<div class='link_search'><a href='/documentos_gestion/nuevo/".$g->GetId()."/".$row3['id']."/'>".$tit_anexo."</a></div>
											<div class='tit_demanda'>".$tit_demanda."</div>
										</div>

									</div>";						

					}
					$pathm .= "<div class='clear'></div>";
					$pathn .= "<div class='light'>$i3 $type_s encontrados que contienen \"$id\" </div></div><div class='clear'></div>";
				}
				echo $pathn.$pathm."</div><div class='clear'></div>";







			// Demandante Proceso
				$s4 = "SELECT * FROM 
									big_data 
										where 
											col_1  like '%$id%' or col_2  like '%$id%' or col_3  like '%$id%' or col_4  like '%$id%' or 
											col_5  like '%$id%' or col_6  like '%$id%' or col_7  like '%$id%' or col_8  like '%$id%' or 
											col_9  like '%$id%' or col_10 like '%$id%' or col_11 like '%$id%' or col_12 like '%$id%' or 
											col_13 like '%$id%' or col_14 like '%$id%' or col_15 like '%$id%' or col_16 like '%$id%' or 
											col_17 like '%$id%' or col_18 like '%$id%' or col_19 like '%$id%' or col_20 like '%$id%' or 
											col_21 like '%$id%' or col_22 like '%$id%' or col_23 like '%$id%' or col_24 like '%$id%' or 
											col_25 like '%$id%' or col_26 like '%$id%' or col_27 like '%$id%' or col_28 like '%$id%' or 
											col_29 like '%$id%' or col_30 like '%$id%' ";
				$q4 = $con->Query($s4);
				
				$pathn  = "";
				$pathm  = "";				
				$type_s = "Formularios";
				$i4 = 0;
				$pathn .= "<div class='search_result'>";	
				$pathn .= "<div class='header_result'><div class='bold'>".$type_s."</div>";
				if($con->NumRows($q4) <= 0){
					$pathn .= "<div class='light'>$i4 $type_s encontrados que contengan \"$id\" </div></div><div class='clear'></div>";
				}else{
					$i4 = 0;
					$pathm = "";
					while($row4 = $con->FetchAssoc($q4)){
						$i4++;

						$g = new MGestion;
						$g->CreateGestion("id", $row4['proceso_id']);

						$bd = new MRef_tables;
						$bd->CreateRef_tables("id", $row4['ref_tables_id']);

						$tit_anexo = $bd->GetTitle()." ($row4[col_1])";
						$tit_demanda = $g->GetNum_oficio_respuesta();


						$pathm .= "	<div class='result_box'>
										<div class='logo_s'></div>
										<div class='search_text'>
											<div class='link_search'><a href='/gestion/ver/".$g->GetId()."/'>".$tit_anexo."</a></div>
											<div class='tit_demanda'>".$tit_demanda."</div>
										</div>

									</div>";	

					}
					$pathm .= "<div class='clear'></div>";
					$pathn .= "<div class='light'>$i4 $type_s encontrados que contienen \"$id\" </div></div><div class='clear'></div>";
				}
				echo $pathn.$pathm."</div><div class='clear'></div>";

*/







		}

		$tte = $i1 + $i2 + $i3 + $i4;

?>

		</div>
	</div>
</div>

