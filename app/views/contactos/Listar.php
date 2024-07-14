<link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/agenda.css'/>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<div class="icon white_contacto hight-blue"></div>
			<div class="text-folder">CONTACTOS</div>
		</div>
		<?
			if($keyword == "0"){ $numactive = "class='active'"; }	
			if($keyword == "A"){ $aactive  	= "class='active'"; }
			if($keyword == "B"){ $bactive  	= "class='active'"; }
			if($keyword == "C"){ $cactive  	= "class='active'"; }
			if($keyword == "D"){ $dactive  	= "class='active'"; }
			if($keyword == "E"){ $eactive  	= "class='active'"; }
			if($keyword == "F"){ $factive  	= "class='active'"; }
			if($keyword == "G"){ $gactive  	= "class='active'"; }
			if($keyword == "H"){ $hactive  	= "class='active'"; }
			if($keyword == "I"){ $iactive  	= "class='active'"; }
			if($keyword == "J"){ $jactive  	= "class='active'"; }
			if($keyword == "K"){ $kactive  	= "class='active'"; }
			if($keyword == "L"){ $lactive  	= "class='active'"; }
			if($keyword == "M"){ $mactive  	= "class='active'"; }
			if($keyword == "N"){ $nactive  	= "class='active'"; }
			if($keyword == "Ñ"){ $neactive 	= "class='active'"; }
			if($keyword == "O"){ $oactive  	= "class='active'"; }
			if($keyword == "P"){ $pactive  	= "class='active'"; }
			if($keyword == "Q"){ $qactive  	= "class='active'"; }
			if($keyword == "R"){ $ractive  	= "class='active'"; }
			if($keyword == "S"){ $sactive  	= "class='active'"; }
			if($keyword == "T"){ $tactive  	= "class='active'"; }
			if($keyword == "U"){ $uactive  	= "class='active'"; }
			if($keyword == "V"){ $vactive  	= "class='active'"; }
			if($keyword == "W"){ $wactive  	= "class='active'"; }
			if($keyword == "X"){ $xactive  	= "class='active'"; }
			if($keyword == "Y"){ $yactive  	= "class='active'"; }
			if($keyword == "Z"){ $zactive  	= "class='active'"; }
		?>
		<div class="header-agenda">
			<div id="nav_link_contacts">
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'A'.DS; ?>" <?= $aactive; ?> >A</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'B'.DS; ?>" <?= $bactive; ?> >B</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'C'.DS; ?>" <?= $cactive; ?> >C</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'D'.DS; ?>" <?= $dactive; ?> >D</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'E'.DS; ?>" <?= $eactive; ?> >E</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'F'.DS; ?>" <?= $factive; ?> >F</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'G'.DS; ?>" <?= $gactive; ?> >G</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'H'.DS; ?>" <?= $hactive; ?> >H</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'I'.DS; ?>" <?= $iactive; ?> >I</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'J'.DS; ?>" <?= $jactive; ?> >J</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'K'.DS; ?>" <?= $kactive; ?> >K</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'L'.DS; ?>" <?= $lactive; ?> >L</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'M'.DS; ?>" <?= $mactive; ?> >M</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'N'.DS; ?>" <?= $nactive; ?> >N</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'Ñ'.DS; ?>" <?= $neactive;?> >Ñ</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'O'.DS; ?>" <?= $oactive; ?> >O</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'P'.DS; ?>" <?= $pactive; ?> >P</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'Q'.DS; ?>" <?= $qactive; ?> >Q</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'R'.DS; ?>" <?= $ractive; ?> >R</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'S'.DS; ?>" <?= $sactive; ?> >S</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'T'.DS; ?>" <?= $tactive; ?> >T</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'U'.DS; ?>" <?= $uactive; ?> >U</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'V'.DS; ?>" <?= $vactive; ?> >V</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'W'.DS; ?>" <?= $wactive; ?> >W</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'X'.DS; ?>" <?= $xactive; ?> >X</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'Y'.DS; ?>" <?= $yactive; ?> >Y</a>
				<a href="<?= HOMEDIR.DS.'contactos'.DS.'ver'.DS.'Z'.DS; ?>" <?= $zactive; ?> >Z</a>
			</div>
		</div>
	</div>
</div>
<style>
		
		a.active{
			color: #F00;
		}

</style>



<div id="folders-content">
	<div id="folders-list-content">
		<div class="contact-list_main">
		
	

<?
	global $con;

	$patha 	= 	" and nom like '".$keyword."%'";
	$pathb 	= 	" and nom like '".$keyword."%'";
	$pathc 	= 	" and p_nombre like '".$keyword."%'";
	$pathd 	= 	" and nombre like '".$keyword."%'";

	$usuario = $_SESSION["usuario"];

    $sql = "SELECT * FROM folder inner join folder_demandante_proceso on folder_demandante_proceso.id_folder = folder.id
            WHERE folder.user_id = '".$usuario."' $patha";

    $query_sql = $con->Query($sql);
    while ($row = $con->FetchAssoc($query_sql)){

   		echo '<div class="main_contact_bloc" style="border-bottom:2px solid #009CDE" id="bl'.$row["id_folder"].'">';
	    	echo '<div class="contact_photo">';
	    		echo '<img src="'.ASSETS.DS.'images'.DS.'iconocarpeta.png">';
	    		echo '<div class="link_procesos"><a href="#" onClick="ExpandProcesos('.$row["id_folder"].')">Ver Procesos</a></div>';
	    	echo '</div>';
	    	echo '<div class="contact_data">';
	    		$name = $row['p_nombre']." ".$row['s_nombre']." ".$row['p_apellido']." ".$row['s_apellido'];
	    		$fname = $row['p_nombre']." ".$row['s_nombre']." ".$row['p_apellido']." ".$row['s_apellido'];
	    		if (strlen($name) > 25) {
	    			$name = substr($name, 0, 25)."...";
	    		}
    			echo '<div class="item-title" title="'.$fname.'">'.$name."</div>" ;
    			echo '<div class="table-data scrollable">';
    			echo '	<table width="100%">
							<tr>
								<td class="table_title" valign="top">Identificacion</td>
								<td class="table_text">'.$row['cedula'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Direccion</td>
								<td class="table_text">'.$row['direccion'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Ciudad</td>
								<td class="table_text">'.$row['ciudad'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">E-mail</td>
								<td class="table_text">'.$row['email'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Telefono</td>
								<td class="table_text">'.$row['telefonos'].'</td>
							</tr>
						</table>';
				echo '</div>';
	    	echo '</div>';
			echo '<div class="clear"></div>';			
			echo '<div class="proccess_list scrollable" id="fl'.$row["id_folder"].'">';

			$fid = $row["id_folder"];
			$q_str_folder= "select * from folder_demanda where user_id = '".$usuario."' AND folder_id ='".$fid."'";
			$query_folder = $con->Query($q_str_folder);
			echo "	<table cellpadding='0' cellspacing='0'>
						<tr>
							<td class='header_table' width='280px;'><b>Titulo</b></td>
							<td class='header_table' width='100px;'><b>Estado</b></td>
						</tr>";
			while($row_query = $con->FetchAssoc($query_folder)){

				$car->CreateCaratula_by_Proceso(" user_id = '".$usuario."' AND proceso_id = '".$row_query['proceso_id']."'");

				echo '	<tr>
							<td class="text_table" align="left">'.$car->GetTit_demanda().'</td>
							<td class="text_table" align="center"><strong>'.$car->GetEst_proceso().'</	strong></td>
						</tr>';
			}	
			echo '	</table>';
			echo '</div>';

    	echo '</div>';
    }


    $sql = "SELECT * FROM folder inner join folder_demandante_proceso_juridico on folder_demandante_proceso_juridico.id_folder = folder.id WHERE folder.user_id = '".$usuario."' $pathb";
    $query_sql = $con->Query($sql);
    while ($row = $con->FetchAssoc($query_sql)){
  		echo '<div class="main_contact_bloc" style="border-bottom:2px solid #99BE11" id="bl'.$row["id"].'">';
	    	echo '<div class="contact_photo">';
	    		echo '<img src="'.ASSETS.DS.'images'.DS.'icon_image.png">';
	    		echo '<div class="link_procesos"><a href="#" onClick="ExpandProcesos('.$row["id"].')">Ver Procesos</a></div>';
	    	echo '</div>';
	    	echo '<div class="contact_data">';
	    		$name = $row['nom_entidad'];
	    		$fname = $row['nom_entidad'];
	    		if (strlen($name) > 25) {
	    			$name = substr($name, 0, 25)."...";
	    		}
    			echo '<div class="item-title" title="'.$fname.'">'.$name."</div>" ;
    			echo '<div class="table-data scrollable">';
    			echo '	<table width="100%">
							<tr>
								<td class="table_title" valign="top">Identificacion</td>
								<td class="table_text">'.$row['nit_entidad'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Direccion</td>
								<td class="table_text">'.$row['dir_entidad'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Ciudad</td>
								<td class="table_text">'.$row['ciu_entidad'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">E-mail</td>
								<td class="table_text">'.$row['email_respres'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Telefono</td>
								<td class="table_text">'.$row['telefonos'].'</td>
							</tr>';
				if($row['p_nom_repres'] != ""){
					echo '	<tr>
								<td class="table_title" valign="top">Rep. Legal</td>
								<td class="table_text">'.$row['p_nom_repres'].'</td>
							</tr>
						  	<tr>
								<td  class="table_title" valign="top">Ciudad. R. Legal</td>
								<td  class="table_text">'.$row['ciu_repres'].'</td>
						  	</tr>';								
				}	
				echo '	</table>';
				echo '</div>';
	    	echo '</div>';
			echo '<div class="clear"></div>';
			echo '<div class="proccess_list scrollable" id="fl'.$row["id"].'">';

			$q_str_folder= "select * from folder_demanda where user_id = '".$usuario."' AND folder_id ='".$fid."'";
			$query_folder = $con->Query($q_str_folder);
			echo "	<table cellpadding='0' cellspacing='0'>
						<tr>
							<td class='header_table' width='280px;'>Titulo</td>
							<td class='header_table' width='100px;'>Estado</td>
						</tr>";
			while($row_query = $con->FetchAssoc($query_folder)){

				$car->CreateCaratula_by_Proceso(" user_id = '".$usuario."' AND proceso_id = '".$row_query['proceso_id']."'");

				echo '	<tr>
							<td class="text_table" align="left">'.$car->GetTit_demanda().'</td>
							<td class="text_table" align="center"><strong>'.$car->GetEst_proceso().'</	strong></td>
						</tr>';
			}	
			echo '	</table>';
			echo '</div>';

    	echo '</div>';
    }


    $sql = "SELECT * FROM demandado_proceso WHERE user_id = '".$usuario."' $pathc group by cedula";
    $query_sql = $con->Query($sql);
    while ($row = $con->FetchAssoc($query_sql)){

		echo '<div class="main_contact_bloc" style="border-bottom:2px solid #DF0209" id="bl'.$row["id"].'">';
	    	echo '<div class="contact_photo">';
	    		echo '<img src="'.ASSETS.DS.'images'.DS.'icon_image.png">';
	    		echo '<div class="link_procesos"><a href="#" onClick="ExpandProcesos('.$row["id"].')">Ver Procesos</a></div>';
	    	echo '</div>';
	    	echo '<div class="contact_data">';
	    		$name = $row['p_nombre']." ".$row['p_apellido'];
	    		$fname = $row['p_nombre']." ".$row['p_apellido'];
	    		if (strlen($name) > 25) {
	    			$name = substr($name, 0, 25)."...";
	    		}
    			echo '<div class="item-title" title="'.$fname.'">'.$name."</div>" ;
    			echo '<div class="table-data scrollable">';
    			echo '	<table width="100%">
							<tr>
								<td class="table_title" valign="top">Identificacion</td>
								<td class="table_text">'.$row['cedula'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Direccion</td>
								<td class="table_text">'.$row['direccion'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Ciudad</td>
								<td class="table_text">'.$row['ciudad'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">E-mail</td>
								<td class="table_text">'.$row['email'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Telefono</td>
								<td class="table_text">'.$row['telefonos'].'</td>
							</tr>';

						if($row['s_apellido']!= ""){
							echo '<tr align="left">
									<td class="table_title" valign="top">Rep. Legal:</td>
									<td class="table_text">'.$row['s_apellido'].'</td>
								  </tr>
								  <tr align="left">
									<td class="table_title" valign="top">Ciudad. R. Legal:</td>
									<td class="table_text">'.$row['departamento'].'</td>
								  </tr>';					
						}
				echo '	</table>';
				echo '</div>';
	    	echo '</div>';
			echo '<div class="clear"></div>';
			echo '<div class="proccess_list scrollable" id="fl'.$row["id"].'">';
			$fid = $row["cedula"];
			$q_str_folder= "select * from demandado_proceso where user_id = '".$usuario."' AND cedula ='".$fid."'";
			$query_folder = $con->Query($q_str_folder);
			echo "	<table cellpadding='0' cellspacing='0'>
						<tr>
							<td class='header_table' width='280px;'>Titulo</td>
							<td class='header_table' width='100px;'>Estado</td>
						</tr>";
			while($row_query = $con->FetchAssoc($query_folder)){

				$car->CreateCaratula_by_Proceso(" user_id = '".$usuario."' AND proceso_id = '".$row_query['proceso_id']."'");

				echo '	<tr>
							<td class="text_table" align="left">'.$car->GetTit_demanda().'</td>
							<td class="text_table" align="center"><strong>'.$car->GetEst_proceso().'</	strong></td>
						</tr>';
			}	
			echo '	</table>';
			echo '</div>';

    	echo '</div>';

    }




    $sql = "SELECT * FROM contactos WHERE user_id = '".$usuario."' $pathd";
    $query_sql = $con->Query($sql);
    while ($row = $con->FetchAssoc($query_sql)){

		echo '<div class="main_contact_bloc" style="border-bottom:2px solid #1263A1">';
	    	echo '<div class="contact_photo">';
	    		echo '<img src="'.ASSETS.DS.'images'.DS.'icon_image.png">';
	    	echo '</div>';
	    	echo '<div class="contact_data">';
	    		$name = $row['nombre']." ".$row['apellido'];
	    		$fname = $row['nombre']." ".$row['apellido'];
	    		if (strlen($name) > 25) {
	    			$name = substr($name, 0, 25)."...";
	    		}

				$direcciones = "";
				$correos = "";
				$telefonos = "";

	    		$strd = $con->Query("select * from contactos_direccion where contacto_id = '".$row["id"]."'");
	    		while ($rd = @$con->FetchAssoc($strd)) {
	    			$direcciones .= $rd["direccion"]." - ".$rd["ciudad"]."<br>";
	    			# code...
	    		}

	    		$strt = $con->Query("select * from contactos_telefonos where contacto_id = '".$row["id"]."'");
	    		while ($rt = @$con->FetchAssoc($strt)) {
	    			$telefonos.= $rt["telefono"]."<br>";
	    		}

	    		$strc = $con->Query("select * from contactos_emails where contacto_id = '".$row["id"]."'");
	    		while ($rc = @$con->FetchAssoc($strc)) {
	    			$correos .= $rc["email"]."<br>";
	    			# code...
	    		}


    			echo '<div class="item-title" title="'.$fname.'">'.$name."</div>" ;
    			echo '<div class="table-data scrollable">';
    			echo '	<table width="100%">
							<tr>
								<td class="table_title" valign="top">Tipo</td>
								<td class="table_text">'.$row['type'].'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Direccion</td>
								<td class="table_text">'.$direcciones.'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">E-mail</td>
								<td class="table_text">'.$correos.'</td>
							</tr>
							<tr>
								<td class="table_title" valign="top">Telefono</td>
								<td class="table_text">'.$telefonos.'</td>
							</tr>';
				echo '	</table>';
				echo '</div>';
	    	echo '</div>';
    	echo '</div>';

    }

?>	
		</div>

	</div>
</div>


<script>
	
	function ExpandProcesos(id){
		if ($("#bl"+id).height() == "500") {
			$("#bl"+id).animate({height: "170px"}, 250);
			$("#fl"+id).css("display","none");
		}else{
			$("#bl"+id).animate({height: "500px"}, 250);
			$("#fl"+id).css("display","block");
		}
	}
</script>