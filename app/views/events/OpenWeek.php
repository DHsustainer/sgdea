<div class="c_col_full_width" id="c_col" >
	<div id="btns_agenda" style="margin-top:10px; padding-left:0px; float:left; width:auto;">
<?
		$fecha_c = date_create($date);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		date_modify($fecha_c, "+7 day");//sumas los dias que te hacen falta.
		$next = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
		$fecha_d = date_create($date);//aca le pasas la fecha actual o ala que le queres sumar los dias.
		date_modify($fecha_d, "-7 day");//sumas los dias que te hacen falta.
		$prevday = date_format($fecha_d, "Y-m-d");//retornas la fecha en el formato que mas te guste.

		$numeroSemana = date("W", $current);

//Capturando datos de la semana...
		$dt = explode("-", $date);
		$year=$dt[0];
		$month=$dt[1];
		$day=$dt[2];

		# Obtenemos el numero de la semana
		$semana=date("W",mktime(0,0,0,$month,$day,$year));

		# Obtenemos el día de la semana de la fecha dada
		$diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

		# el 0 equivale al domingo...
		if($diaSemana==0)
		    $diaSemana=7;

		# A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
		$primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

		# A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
		$ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

		$week_day = $f->ObtenerFecha_3($primerDia, $ultimoDia, $year);
?>
		<div style="margin-left:0px;" class="btn_agenda prev" onClick="window.location.href='<?= HOMEDIR.DS.'agenda'.DS.$action.DS.$prevday.DS.$id.'.'.$pid.DS ?>'"></div>
		<div style="margin-left:0px;" class="btn_agenda none_full">
			<?

				echo $week_day;
		
			?>
		</div>
		<div style="margin-left:0px;" class="btn_agenda next" onClick="window.location.href='<?= HOMEDIR.DS.'agenda'.DS.$action.DS.$next.DS.$id.'.'.$pid.DS ?>'"></div>
		<div class="clear"></div>		 	
	</div>	
	<div id="btns_navigation">
		<div class="btns_navigation left"><a href="<?= HOMEDIR.DS.'agenda'.DS.'anho'.DS.$date.DS.$id.'.'.$pid.DS ?>">Año</a></div>
		<div class="btns_navigation center"><a href="<?= HOMEDIR.DS.'agenda'.DS.'mes'.DS.$date.DS.$id.'.'.$pid.DS ?>">Mes</a></div>
<!--		<div class="btns_navigation center active"><a href="<?= HOMEDIR.DS.'agenda'.DS.'semana'.DS.$date.DS.$id.'.'.$pid.DS ?>">Semana</a></div> -->
		<div class="btns_navigation right"><a href="<?= HOMEDIR.DS.'agenda'.DS.'dia'.DS.date("Y-m-d").DS.$id.'.'.$pid.DS ?>">Hoy</a></div>
		<div class="clearb"></div>			
	</div>
	<div class="clear"></div>		 	

	<table style="width:100%; margin-bottom: 10px;" border="0" cellspacing="0" cellpadding="3">
<?
	
	$fecha_p = date_create($primerDia);
	date_modify($fecha_p, "+1 day");
	$segundoDia = date_format($fecha_p, "Y-m-d");

	$fecha_s = date_create($primerDia);
	date_modify($fecha_s, "+2 day");
	$tercerDia = date_format($fecha_s, "Y-m-d");

	$fecha_cu = date_create($primerDia);
	date_modify($fecha_cu, "+3 day");
	$cuartoDia = date_format($fecha_cu, "Y-m-d");

	$fecha_q = date_create($primerDia);
	date_modify($fecha_q, "+4 day");
	$quintoDia = date_format($fecha_q, "Y-m-d");

	$fecha_sx = date_create($primerDia);
	date_modify($fecha_sx, "+5 day");
	$sextoDia = date_format($fecha_sx, "Y-m-d");


?>


		<tr>
			<td class="tbl_header_left" width="42px" height="27px"></td>
			<td class="tbl_header_right"><a href="<?= HOMEDIR.DS."agenda".DS."dia".DS.$primerDia.DS.$id.".".$pid.DS ?>"><?= $primerDia ?></a></td>
			<td class="tbl_header_right"><a href="<?= HOMEDIR.DS."agenda".DS."dia".DS.$segundoDia.DS.$id.".".$pid.DS ?>"><?= $segundoDia ?></a></td>
			<td class="tbl_header_right"><a href="<?= HOMEDIR.DS."agenda".DS."dia".DS.$tercerDia.DS.$id.".".$pid.DS ?>"><?= $tercerDia ?></a></td>
			<td class="tbl_header_right"><a href="<?= HOMEDIR.DS."agenda".DS."dia".DS.$cuartoDia.DS.$id.".".$pid.DS ?>"><?= $cuartoDia ?></a></td>
			<td class="tbl_header_right"><a href="<?= HOMEDIR.DS."agenda".DS."dia".DS.$quintoDia.DS.$id.".".$pid.DS ?>"><?= $quintoDia ?></a></td>
			<td class="tbl_header_right"><a href="<?= HOMEDIR.DS."agenda".DS."dia".DS.$sextoDia.DS.$id.".".$pid.DS ?>"><?= $sextoDia ?></a></td>
			<td class="tbl_header_right"><a href="<?= HOMEDIR.DS."agenda".DS."dia".DS.$ultimoDia.DS.$id.".".$pid.DS ?>"><?= $ultimoDia ?></a></td>
		</tr>
		<tr>
			<td class="tbl_line_2" style="border-bottom:1px solid #C5C8CD">Todo-dia</td>
			<td class="tbl_line" colspan="7" style="border-bottom:1px solid #C5C8CD"></td>
		</tr>
		<?
			
			$log  = $c->GetFechaLog();
			$alog = $c->consultarlog();
			$dif  = $c->Diferencia($date, $log);
			$dia  = $dif + $alog;		

			for ($i=0; $i < 24; $i++) { 
				if ($i <= 9) {
					$rt = "0".$i;
				}else{
					$rt = $i;
				}

				$stra = QueryString($primerDia, $rt, $id, $pid);
				$query = $con->Query($stra);

				$ie = 0;
				echo '<tr>';
					while ($rowev = $con->FetchAssoc($query)) {
						$ie++;
						$box_path = '<span class="hora_evento">'.substr($rowev["time"], 0, 5).'</span>'.$rowev["title"].': '.$rowev["description"];
						if ($ie == "1") {
							echo '	<td class="tbl_line_2">'.$rt.':00</td>';
							echo '	<td class="tbl_line">'.$box_path.'</td>';
						}else{
							echo '	<td class="tbl_line_2"></td>
									<td class="tbl_line">'.$box_path.'</td>';

						}
					}


				$stra = QueryString($segundoDia, $rt, $id, $pid);
				$query = $con->Query($stra);
			
					while ($rowev = $con->FetchAssoc($query)) {
						$ie++;
						$box_path = '<span class="hora_evento">'.substr($rowev["time"], 0, 5).'</span>'.$rowev["title"].': '.$rowev["description"];
						if ($ie == "1") {
							echo '  <td class="tbl_line_2">'.$rt.':00</td>';
							echo '	<td class="tbl_line">'.$box_path.'</td>';
						}else{
							echo '	<td class="tbl_line_2"></td>
									<td class="tbl_line">'.$box_path.'</td>';
						}
					}
				echo '</tr>';
				if ($ie == 0) {
					echo '
							<tr>
								<td class="tbl_line_2">'.$rt.':00</td>
								<td class="tbl_line"></td>
							</tr>	
							<tr>
								<td class="tbl_line_2">&nbsp;</td>
								<td class="tbl_line"></td>
							</tr>';						
				}elseif ($ie >= 1) {
					echo '	<tr>
								<td class="tbl_line_2">&nbsp;</td>
								<td class="tbl_line"></td>
							</tr>';
				} 
			}
		?>
		<tr>
			<td class="tbl_line_2" style="border-top:3px double #C5C8CD; border-right:none">&nbsp;</td>
			<td class="tbl_line" colspan="7" style="border-top:3px double #C5C8CD"></td>
		</tr>
	</table>

</div>

<?
	
	function QueryString($dia, $rt, $id, $pid){

		if($pid == ""){
			$q_str = "SELECT * FROM events WHERE date = '".$dia."' and  time LIKE  '".$rt.":%' AND user_id =  '".$_SESSION["usuario"]."' ORDER BY time";
		}else{
			if($pid == "*"){

				$q_str_folder= "select * from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$id."'";
				$query_folder = $con->Query($q_str_folder);

				$path  = "(";
				$total_rows = $con->NumRows($query_folder);
				
				for ($j=0 ; $j<$total_rows ; $j++){

					$q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $j, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."'";
					$queryx = $con->Query($q_str);
					if($total_rows == 1){
						$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
					}else{
						if($j == $total_rows -1){
							$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
						}else{
							$path .= "proceso_id = ".$con->Result($queryx, 0, 'id')." OR ";	
						}
					}
				}	
				$path  .= ") AND ";
				$q_str = "SELECT * FROM events WHERE $path date = '".$dia."' and time LIKE  '".$rt.":%' AND user_id =  '".$_SESSION["usuario"]."' ORDER BY time";
			}else{
				$q_str = "SELECT * FROM events WHERE date = '".$dia."' and time LIKE  '".$rt.":%' AND user_id =  '".$_SESSION["usuario"]."' and proceso_id = '".$pid."' ORDER BY time";
			}
		}
		return $q_str;
	}

?>