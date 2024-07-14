<?
	function printmonthtable($offset, $firstday, $pid = "", $folder= "", $action = ""){
		global $con;
		$today = mktime(0, 0, 0, date("m", $firstday), date('d', $firstday), date("y", $firstday));
		$month = mktime(0, 0, 0, date("m", $today) + $offset, 1, date("y", $today));
		
		$fecha = date("Y-m-d", $firstday);

		$startpos = date("w", $month);
		if ($startpos == 0) {
			$startpos = 7;
		}
		$tmpnextmonth = mktime(0, 0, 0, date("m", $month) + 1, 0, date("y", $month));
		$tmpmonth = $month;

	//	echo $firstday."<br>";
	//	echo $today."<br>".$tmpnextmonth;
		$mes = array("January"		=>	"Enero",		
					 "February"		=>	"Febrero",		
					 "March"		=>	"Marzo",		
					 "April"		=>	"Abril",		
					 "May"			=>	"Mayo",		
					 "June"			=>	"Junio",		
					 "July"			=>	"Julio",		
					 "August"		=>	"Agosto",		
					 "September"	=>	"Septiembre",		
					 "October"		=>	"Octubre",		
					 "November"		=>	"Noviembre",		
					 "December"		=>	"Diciembre");

		echo '<table cellpadding="0" cellspacing="0" style="margin-left:14px;margin-right:14px; padding-top:0px;">';
		echo '<tr><td colspan="7" align="center" class="titulo"><b><a href="'.HOMEDIR.DS.'agenda'.DS.'mes'.DS.$fecha.DS.$folder.'.'.$pid.DS.'">' .$mes[date("F", $month)]." - ". date("Y", $month) . '</a></b></td></tr>';	
		echo '<tr>
				<td class="title_header"  style="height:12px; width:30px; background-color:#EBEBED; font-size:10px; border:1px solid #EBEBEB;" >Lun</td>
				<td class="title_header"  style="height:12px; width:30px; background-color:#EBEBED; font-size:10px; border:1px solid #EBEBEB;" >Mar</td>
				<td class="title_header"  style="height:12px; width:30px; background-color:#EBEBED; font-size:10px; border:1px solid #EBEBEB;" >Mie</td>
				<td class="title_header"  style="height:12px; width:30px; background-color:#EBEBED; font-size:10px; border:1px solid #EBEBEB;" >Jue</td>
				<td class="title_header"  style="height:12px; width:30px; background-color:#EBEBED; font-size:10px; border:1px solid #EBEBEB;" >Vie</td>
				<td class="title_header"  style="height:12px; width:30px; background-color:#EBEBED; font-size:10px; border:1px solid #EBEBEB;" >Sab</td>
				<td class="title_header"  style="height:12px; width:30px; background-color:#EBEBED; font-size:10px; border:1px solid #EBEBEB;" >Dom</td>
			</tr>';
		for ($i = 1;(date("m", $month) == date("m", $tmpmonth)); $i++) {
			echo '<tr>';
			for ($j = 1; $j <= 7; $j++) {
				if (($i == 1 and $j < $startpos) or (date("m", $month) != date("m", $tmpmonth))) {
					echo '<td>&nbsp;</td>';
				} else {
					
					#INICIALIZAMOS EL COLOR DE FONDO
					$backcolor 	= '#ffffff';
					$textcolor 	= '#000000';
					$alttext 	= "";
					$border = ";border:1px solid #EBEBEB;";
					#SI TIENE CITAS ENTONCES MARCALO EN UN COLOR DIFERENTE
					if (hasAppointments($tmpmonth, $pid, $folder)) {
						$backcolor = '#FFFFFF';
						$textcolor = "#000";
						$alttext = "title='Hay Actividad este dia'";
						$border = ";border:1px solid #EBEBEB; border-bottom:2px solid #0C0;";
					}
					if (IsFestivo(date("Y-m-d", $tmpmonth))) {

						$s = $con->Query("select motivo from dias_festivos where fecha = '".date("Y-m-d", $tmpmonth)."'");
						$backcolor = '#FFFFFF';
						$textcolor = "#F00";
						$alttext = "title = 'Dia Festivo: ".$con->Result($s, 0, 'motivo')."'";
						$border = ";border:1px solid #EBEBEB; border-bottom:2px solid #F00;";
						#border:1px solid #EBEBEB
					}				
					# SELECCIONA EL DIA QUE SE ESTA REVISANDO Y LO MARCA EN UN COLOR X
					if (date("Y-m-d", $tmpmonth) == date("Y-m-d", $today)) {
						$backcolor = '#FFFFFF';
						$alttext = "title = 'Dia Activo'";
						#$textcolor = "#0072C6";
						#$alttext = "Dia Activo";
						#$border = ";border:2px solid #0072C6; font-weight: bold;";
						
					}
					# SELECCIONA EL DIA DE HOY Y LO PONE EN UN COLOR X
					if (date("Y-m-d", $tmpmonth) == date("Y-m-d")) {
						$backcolor = '#FFFFFF';
						$textcolor = "#0072C6";
						$alttext = "title = 'Hoy'";
						$border = ";border:2px solid #0072C6; font-weight: bold;";
					}
					#aplica para fines de semana
					if ($j >= 7) {
						if($backcolor == "#ffffff"){
							$backcolor = '#FFFFFF';
							$textcolor = "#F00";
							$alttext = "title = 'Domingo'";
							$border = ";border:1px solid #EBEBEB; border-bottom:2px solid #F00;";
						}
						echo '<td bgcolor='.$backcolor.' style="height:25px; width:30px; font-size:12px; padding:0px; margin:0px;  '.$border.'  padding-right:4px" valign="top" align="right"  '.$alttext.' >
								<span style="">
									<a href="'.HOMEDIR.DS.'agenda'.DS."dia".DS.date("Y-m-d", $tmpmonth).DS.$folder.'.'.$pid.DS.'" style="color:'.$textcolor.'">'.date("d", $tmpmonth).'</a>
								</span>
							   </td>';
					#si no resto de la semana
					} else {
						echo '<td  style="background: '.$backcolor.' ; height:25px; width:30px; font-size:12px; padding:0px;  '.$border.'  padding-right:4px;" valign="top" align="right" '.$alttext.' >
								<span style="background: ' . $backcolor . ';">
									<a href="'.HOMEDIR.DS.'agenda'.DS."dia".DS.date("Y-m-d", $tmpmonth).DS.$folder.'.'.$pid.DS.'" style="color:'.$textcolor.'">' . date("d", $tmpmonth) . '</a>
								</span>
							  </td>';
					}
				}
				if ($i != 1 or $j >= $startpos) {
					$tmpmonth = mktime(0, 0, 0, date("m", $tmpmonth), date("d", $tmpmonth) + 1, date("y", $tmpmonth));
				}
			}
			echo '</tr>';
		}
		echo '</table>';
	}

	function printmonthtable_2($offset, $firstday, $pid = "", $folder= "", $action = ""){
		global $con;
		$today = mktime(0, 0, 0, date("m", $firstday), date('d', $firstday), date("y", $firstday));
		$month = mktime(0, 0, 0, date("m", $today) + $offset, 1, date("y", $today));
		
		$fecha = date("Y-m-d", $firstday);

		$array = array("1" => "regular", "2" => "regular", "3" => "regular", "4" => "regular", "5" => "regular", "6" => "regular");

		$startpos = date("w", $month);
		if ($startpos == 0) {
			$startpos = 7;
		}
		$tmpnextmonth = mktime(0, 0, 0, date("m", $month) + 1, 0, date("y", $month));
		$tmpmonth = $month;

	//	echo $firstday."<br>";
	//	echo $today."<br>".$tmpnextmonth;
		$mes = array("January"		=>	"Enero",		
					 "February"		=>	"Febrero",		
					 "March"		=>	"Marzo",		
					 "April"		=>	"Abril",		
					 "May"			=>	"Mayo",		
					 "June"			=>	"Junio",		
					 "July"			=>	"Julio",		
					 "August"		=>	"Agosto",		
					 "September"	=>	"Septiembre",		
					 "October"		=>	"Octubre",		
					 "November"		=>	"Noviembre",		
					 "December"		=>	"Diciembre");

		echo '<table cellpadding="0" cellspacing="0" style="margin-left:14px;margin-right:14px; padding-top:0px; margin-bottom:15px; width:100%;">';
		echo '<tr>
				<td class="title_header" align="center"  style="height:16px;  width:90px; background-color:#EBEBED; font-size:12px; border:1px solid #EBEBEB;  line-height:20px" >Lunes</td>
				<td class="title_header" align="center"  style="height:16px;  width:90px; background-color:#EBEBED; font-size:12px; border:1px solid #EBEBEB;  line-height:20px" >Martes</td>
				<td class="title_header" align="center"  style="height:16px;  width:90px; background-color:#EBEBED; font-size:12px; border:1px solid #EBEBEB;  line-height:20px" >Miercoles</td>
				<td class="title_header" align="center"  style="height:16px;  width:90px; background-color:#EBEBED; font-size:12px; border:1px solid #EBEBEB;  line-height:20px" >Jueves</td>
				<td class="title_header" align="center"  style="height:16px;  width:90px; background-color:#EBEBED; font-size:12px; border:1px solid #EBEBEB;  line-height:20px" >Viernes</td>
				<td class="title_header" align="center"  style="height:16px;  width:90px; background-color:#EBEBED; font-size:12px; border:1px solid #EBEBEB;  line-height:20px" >Sabado</td>
				<td class="title_header" align="center"  style="height:16px;  width:90px; background-color:#EBEBED; font-size:12px; border:1px solid #EBEBEB;  line-height:20px" >Domomingo</td>
			</tr>';
		for ($i = 1;(date("m", $month) == date("m", $tmpmonth)); $i++) {
			echo '<tr>';
			for ($j = 1; $j <= 7; $j++) {
				if (($i == 1 and $j < $startpos) or (date("m", $month) != date("m", $tmpmonth))) {
					echo '<td>&nbsp;</td>';
				} else {

					#INICIALIZAMOS EL COLOR DE FONDO
					$backcolor 	= '#ffffff';
					$textcolor 	= '#000000';
					$alttext 	= "";
					$border = ";border:1px solid #EBEBEB;";
					$activities = "";
					#SI TIENE CITAS ENTONCES MARCALO EN UN COLOR DIFERENTE
					if (hasAppointments($tmpmonth, $pid, $folder)) {
						$backcolor = '#FFFFFF';
						$textcolor = "#0C0";
						$alttext = "title='Hay Actividad este dia'";
						$border = ";border:1px solid #EBEBEB; border-bottom:2px solid #0C0;";
						$activities = "<div class='clear'></div><div class='month_event_group scrollable'>";
						$act = GetDayAppiontments($tmpmonth, $pid, $folder); 
						while ($rowapp = $con->FetchAssoc($act)) {

							if ($rowapp["description"] == "") {
								$name = $rowapp["title"];
								$name = substr($name, 0, 40);
								if (strlen($rowapp["title"]) > 40) {
									$name .= "...";
									# code...
								}
							}else{
								$name = $rowapp["description"];
								$name = substr($name, 0, 40);
								if (strlen($rowapp["description"]) > 40) {
									$name .= "...";
									# code...
								}
							}

							$name = strip_tags($name);
							
							if ($rowapp['deadline'] == "1") {
								$color = "#009C58;";
								$title = "Evento creado por el cliente";
							}elseif($rowapp['deadline'] == "2"){
								$color = "#FFBB04;";
								$title = "Evento creado por el administrador";
							}else{
								$title = "";
								$color = "#000;";
							}
					

							$activities .= "<div class='month_event".$array[$rowapp["type_event"]]."'  style='color:".$color."'  title='".$title."'  onClick='OpenEvent(\"".$rowapp["id"]."\")'>".$name."</div><br>";
						}
						$activities .= "</div>";
					}
					if (IsFestivo(date("Y-m-d", $tmpmonth))) {
						$s = $con->Query("select motivo from dias_festivos where fecha = '".date("Y-m-d", $tmpmonth)."'");
						$backcolor = '#FFFFFF';
						$textcolor = "#F00";
						$alttext = "title = 'Dia Festivo: ".$con->Result($s, 0, 'motivo')."'";
						$border = ";border:1px solid #EBEBEB; border-bottom:2px solid #F00;";
						#border:1px solid #EBEBEB
					}				
					# SELECCIONA EL DIA QUE SE ESTA REVISANDO Y LO MARCA EN UN COLOR X
					if (date("Y-m-d", $tmpmonth) == date("Y-m-d", $today)) {
						$backcolor = '#FFFFFF';
						$alttext = "title = 'Dia Activo'";
						#$textcolor = "#0072C6";
						#$alttext = "Dia Activo";
						#$border = ";border:2px solid #0072C6; font-weight: bold;";
						
					}
					# SELECCIONA EL DIA DE HOY Y LO PONE EN UN COLOR X
					if (date("Y-m-d", $tmpmonth) == date("Y-m-d")) {
						$backcolor = '#FFFFFF';
						$textcolor = "#0072C6";
						$alttext = "title = 'Hoy'";
						$border = ";border:2px solid #0072C6;";
					}
					#aplica para fines de semana
					if ($j >= 7) {
						if($backcolor == "#ffffff"){
							$backcolor = '#FFFFFF';
							$textcolor = "#F00";
							$alttext = "title = 'Domingo'";
							$border = ";border:1px solid #EBEBEB; border-bottom:2px solid #F00;";
						}
						echo '<td bgcolor='.$backcolor.' style="height:100px; width:30px; font-size:12px; padding:0px; margin:0px;  '.$border.'  padding-right:4px" valign="top" align="left"  '.$alttext.' >
								<span style="">
									<div style="text-align:right">
										<a href="'.HOMEDIR.DS.'agenda'.DS.'dia'.DS.date("Y-m-d", $tmpmonth).DS.$folder.'.'.$pid.DS.'" style="color:'.$textcolor.'">'.date("d", $tmpmonth).'</a>
									</div>
									'.$activities.'								
								</span>
							   </td>';
					#si no resto de la semana
					} else {
						echo '<td  style="background: '.$backcolor.' ; height:100px; width:30px; font-size:12px; padding:0px;  '.$border.'  padding-right:4px;" valign="top" align="left" '.$alttext.' >
								<span style="background: ' . $backcolor . ';">
								<div style="text-align:right">
									<a href="'.HOMEDIR.DS.'agenda'.DS.'dia'.DS.date("Y-m-d", $tmpmonth).DS.$folder.'.'.$pid.DS.'" style="color:'.$textcolor.'">' . date("d", $tmpmonth) . '</a>
								</div>
									'.$activities.'
								</span>
							  </td>';

					}
				}
				if ($i != 1 or $j >= $startpos) {
					$tmpmonth = mktime(0, 0, 0, date("m", $tmpmonth), date("d", $tmpmonth) + 1, date("y", $tmpmonth));
				}
			}
			echo '</tr>';
		}
		echo '</table>';
	}

	function printmonthtable_3	($offset, $firstday, $pid = "", $folder= "", $action = ""){
		global $con;
		$today = mktime(0, 0, 0, date("m", $firstday), date('d', $firstday), date("y", $firstday));
		$month = mktime(0, 0, 0, date("m", $today) + $offset, 1, date("y", $today));
		
		$fecha = date("Y-m-d", $firstday);

		$startpos = date("w", $month);
		if ($startpos == 0) {
			$startpos = 7;
		}
		$tmpnextmonth = mktime(0, 0, 0, date("m", $month) + 1, 0, date("y", $month));
		$tmpmonth = $month;

	//	echo $firstday."<br>";
	//	echo $today."<br>".$tmpnextmonth;
		$mes = array("January"		=>	"Enero",		
					 "February"		=>	"Febrero",		
					 "March"		=>	"Marzo",		
					 "April"		=>	"Abril",		
					 "May"			=>	"Mayo",		
					 "June"			=>	"Junio",		
					 "July"			=>	"Julio",		
					 "August"		=>	"Agosto",		
					 "September"	=>	"Septiembre",		
					 "October"		=>	"Octubre",		
					 "November"		=>	"Noviembre",		
					 "December"		=>	"Diciembre");

		echo '<table cellpadding="0" cellspacing="0" style="margin-right:25px; padding-top:0px; margin-bottom:25px;">';
		echo '<tr>
				<td colspan="7" align="center" class="titulo" style="background-color:#EBEBED; line-height:20px">
					<a href="'.HOMEDIR.DS.'agenda'.DS.'mes'.DS.$fecha.DS.$folder.'.'.$pid.DS.'" style="font-size:12px;">' .$mes[date("F", $month)]." - ". date("Y", $month) . '</a>
				</td>
			  </tr>';	
		echo '<tr>
				<td class="title_header" align="center"  style="height:14px; width:27px; font-size:10px; border:1px solid #EBEBEB; border-right:none;" >L</td>
				<td class="title_header" align="center"  style="height:14px; width:27px; font-size:10px; border:1px solid #EBEBEB; border-right:none;" >M</td>
				<td class="title_header" align="center"  style="height:14px; width:27px; font-size:10px; border:1px solid #EBEBEB; border-right:none;" >M</td>
				<td class="title_header" align="center"  style="height:14px; width:27px; font-size:10px; border:1px solid #EBEBEB; border-right:none;" >J</td>
				<td class="title_header" align="center"  style="height:14px; width:27px; font-size:10px; border:1px solid #EBEBEB; border-right:none;" >V</td>
				<td class="title_header" align="center"  style="height:14px; width:27px; font-size:10px; border:1px solid #EBEBEB; border-right:none;" >S</td>
				<td class="title_header" align="center"  style="height:14px; width:27px; font-size:10px; border:1px solid #EBEBEB;" >D</td>
			</tr>';
		for ($i = 1;(date("m", $month) == date("m", $tmpmonth)); $i++) {
			echo '<tr>';
			for ($j = 1; $j <= 7; $j++) {
				if (($i == 1 and $j < $startpos) or (date("m", $month) != date("m", $tmpmonth))) {
					echo '<td>&nbsp;</td>';
				} else {

					#INICIALIZAMOS EL COLOR DE FONDO
					$backcolor 	= '#ffffff';
					$textcolor 	= '#000000';
					$alttext 	= "";
					$border = ";border:1px solid #EBEBEB;";
					#SI TIENE CITAS ENTONCES MARCALO EN UN COLOR DIFERENTE
					if (hasAppointments($tmpmonth, $pid, $folder)) {
						$backcolor = '#FFFFFF';
						$textcolor = "#000";
						$alttext = "title='Hay Actividad este dia'";
						$border = ";border:1px solid #EBEBEB; border-bottom:2px solid #0C0;";
					}
					if (IsFestivo(date("Y-m-d", $tmpmonth))) {

						$s = $con->Query("select motivo from dias_festivos where fecha = '".date("Y-m-d", $tmpmonth)."'");

						$backcolor = '#FFFFFF';
						$textcolor = "#F00";
						$alttext = "title = 'Dia Festivo: ".$con->Result($s, 0, 'motivo')."'";

						$border = ";border:1px solid #EBEBEB; border-bottom:2px solid #F00;";
						#border:1px solid #EBEBEB
					}				
					# SELECCIONA EL DIA QUE SE ESTA REVISANDO Y LO MARCA EN UN COLOR X
					if (date("Y-m-d", $tmpmonth) == date("Y-m-d", $today)) {
						$backcolor = '#FFFFFF';
						#$textcolor = "#0072C6";
						$alttext = "title = 'Dia Activo'";
						#$border = ";border:2px solid #0072C6; font-weight: bold;";
						
					}
					# SELECCIONA EL DIA DE HOY Y LO PONE EN UN COLOR X
					if (date("Y-m-d", $tmpmonth) == date("Y-m-d")) {
						$backcolor = '#FFFFFF';
						$textcolor = "#0072C6";
						$alttext = "title = 'Hoy'";
						$border = ";border:2px solid #0072C6; font-weight: bold;";
					}
					#aplica para fines de semana
					if ($j >= 7) {
						if($backcolor == "#ffffff"){
							$backcolor = '#FFFFFF';
							$textcolor = "#F00";
							$alttext = "title = 'Domingo'";
							$border = ";border:1px solid #EBEBEB; border-bottom:2px solid #F00;";
						}
						echo '<td bgcolor='.$backcolor.' style="height:25px; width:22px; font-size:12px; padding:0px; margin:0px; '.$border.' padding-right:4px" valign="middle" align="center" '.$alttext.' >
								<span style="">
									<a href="'.HOMEDIR.DS.'agenda'.DS."dia".DS.date("Y-m-d", $tmpmonth).DS.$folder.'.'.$pid.DS.'" style="color:'.$textcolor.'">'.date("d", $tmpmonth).'</a>
								</span>
							   </td>';
					#si no resto de la semana
					} else {
						echo '<td  style="background: '.$backcolor.' ; height:25px; width:22px; font-size:12px; padding:0px; '.$border.' padding-right:4px;" valign="middle" align="center" '.$alttext.'>
								<span style="background: ' . $backcolor . ';">
									<a href="'.HOMEDIR.DS.'agenda'.DS."dia".DS.date("Y-m-d", $tmpmonth).DS.$folder.'.'.$pid.DS.'" style="color:'.$textcolor.'">' . date("d", $tmpmonth) . '</a>
								</span>
							  </td>';
					}
				}
				if ($i != 1 or $j >= $startpos) {
					$tmpmonth = mktime(0, 0, 0, date("m", $tmpmonth), date("d", $tmpmonth) + 1, date("y", $tmpmonth));
				}
			}
			echo '</tr>';
		}
		echo '</table>';
	}

	function GetNextDays($now){
		global $con;
		echo '<table width="100%">';
			echo '<tr><td colspan="7" align="center" class="titulo">Proximos Dias</td></tr>';
			echo '<tr>';
			for ($i = 0; $i < 7; $i++) {	
				$xcolor = '#ffffff';
				$tmp = mktime(0, 0, 0, date("m", $now), date("d", $now) + $i, date("Y", $now));
				$tmp1 = mktime(0, 0, 0, date("m", $now), date("d", $now) + $i +1, date("Y", $now));
			//	$sql = "select * from events where status!=1 and date>=$tmp and date<$tmp1 and user_id=" . $_SESSION[""]. " order by date asc";
					#INICIALIZAMOS EL COLOR DE FONDO
					$xcolor = '#ffffff';
					$textcolor = '#000000';
					#SI TIENE CITAS ENTONCES MARCALO EN UN COLOR DIFERENTE
					if (hasAppointments($tmp)) {
						$xcolor = '#D3E8FB';
					}
					# SELECCIONA EL DIA QUE SE ESTA REVISANDO Y LO MARCA EN UN COLOR X
					if (date("Y-m-d", $tmp) == date("Y-m-d", $today)) {
						$xcolor = '#FF0000';					
					}
					# SELECCIONA EL DIA DE HOY Y LO PONE EN UN COLOR X
					if (date("Y-m-d", $tmp) == date("Y-m-d")) {
						$xcolor = '#689BDF';
					}
				
				if (date("w", $tmp) == 0 or date("w", $tmp) == 6)
					echo '<td style="background: '.$xcolor.' ; height:25px; width:25px;">
							<span style=""><b><a href="?id=servicios&date='.date("Y-m-d", $tmp).'" style="color:'.$textcolor.'">'.date("j", $tmp)."</a></b></span>
						  </td>";
				else
					echo '<td style="background: '.$xcolor.' ; height:25px; width:25px;">
							<span style="background: '.$xcolor.' ;"><a href="id=servicios&?date='.date("Y-m-d", $tmp).'" style="color:'.$textcolor.'">'.date("j", $tmp)."</a></span>
						  </td>";
			}
			echo '</tr>';
		echo '</table>';
	}

	function hasAppointments($day, $pid = "", $folder = ""){
		global $con;
		
		$log = GetFechaLog();
					
		$alog = consultarlog();
		$dif = Diferencia(date("Y-m-d", $day), $log);
		
		$fecha_inicio = date("Y-m-d");
		$date = $dif + $alog;		


		if($pid == ""){
			$qstr = "select count(*) as c from events where user_id = '".$_SESSION["usuario"]."' and date = '".$date."'";
		}else{
			if($pid == "*"){
				$q_str_folder= "select * from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$folder."'";

				$query_folder = $con->Query($q_str_folder);

				$total_rows = $con->NumRows($query_folder);
				if ($total_rows >= 1) {
					# code...
					$path  = "(";
					for ($i=0 ; $i<$total_rows ; $i++){

						$q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $i, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."'";
						$queryx = $con->Query($q_str);
		// VOY A MOSTRAR T ODOS LOS PROCESOS TENER EN CUENTA PARA PROXIMAS REFERENCIAS LOS PROCESOS INACTIVOS
						if($total_rows == 1){
							$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
						}else{
							if($i == $total_rows -1){
								$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
							}else{
								$path .= "proceso_id = ".$con->Result($queryx, 0, 'id')." OR ";	
							}
						}
					}	
					$path  .= ") AND ";
				}else{
					$path .= 'proceso_id = "0000000000" and ';
				}
	#			$q_str = "select * from events where $path user_id = '".$this->GetUser_id()."' and date between '".$day."' and '99999' order by date, time";					
				$qstr = "select count(*) as c from events where $path user_id = '".$_SESSION["usuario"]."' and date = '".$date."'";			
			}else{
				$qstr = "select count(*) as c from events where user_id = '".$_SESSION["usuario"]."' and date = '".$date."' and proceso_id = '".$pid."'";
			}				
			
		}			

		$query = $con->Query($qstr);

		if($query){
			$d = $con->Result($query, 0, "c");
			if($d > 0)
				return true;
			else
				return false;
		}else{
			echo "¡No se pudo ejecutar la Consulta!";
		}

	}

	function GetDayAppiontments($day, $pid = "", $folder = ""){
		global $con;
		
		$log = GetFechaLog();
					
		$alog = consultarlog();
		$dif = Diferencia(date("Y-m-d", $day), $log);
		
		$fecha_inicio = date("Y-m-d");
		$date = $dif + $alog;		


		if($pid == ""){
			$qstr = "select * from events where user_id = '".$_SESSION["usuario"]."' and date = '".$date."'";
		}else{
			if($pid == "*"){
				$q_str_folder= "select * from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$folder."'";
				$query_folder = $con->Query($q_str_folder);

				$path  = "(";
				$total_rows = $con->NumRows($query_folder);
				
				for ($i=0 ; $i<$total_rows ; $i++){

					$q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $i, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."'";
					$queryx = $con->Query($q_str);
	// VOY A MOSTRAR T ODOS LOS PROCESOS TENER EN CUENTA PARA PROXIMAS REFERENCIAS LOS PROCESOS INACTIVOS
					if($total_rows == 1){
						$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
					}else{
						if($i == $total_rows -1){
							$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
						}else{
							$path .= "proceso_id = ".$con->Result($queryx, 0, 'id')." OR ";	
						}
					}
				}	
				$path  .= ") AND ";
	#			$q_str = "select * from events where $path user_id = '".$this->GetUser_id()."' and date between '".$day."' and '99999' order by date, time";					
				$qstr = "select * from events where $path user_id = '".$_SESSION["usuario"]."' and date = '".$date."'";			
			}else{
				$qstr = "select * from events where user_id = '".$_SESSION["usuario"]."' and date = '".$date."' and proceso_id = '".$pid."'";
			}				
			
		}			

		$query = $con->Query($qstr);

		return $query;

	}


	function TodayAppointments(){
		global $con;
		$alog = consultarlog();

		$qstr = "select count(*) as c from events where user_id = '".$_SESSION["usuario"]."' and date = '".$alog."' and status = '1'";
		$query = $con->Query($qstr);

		if($query){
			$d = $con->Result($query, 0, "c");
			if($d > 0)
				return true;
			else
				return false;
		}else{
			echo "No se pudo ejecutar la Coonsulta";
		}

	}

	function NewAppointments(){
		global $con;
		$alog = consultarlog();
		
		$fecha2=time()+7200;
		$time = date("H:i",$fecha2);
		//$time = date('H:i');
		
		$qstr = "select count(*) as c from events where user_id = '".$_SESSION["usuario"]."' and date = '".$alog."' and time = '".$time."'";
		$query = $con->Query($qstr);

		if($query){
			$d = $con->Result($query, 0, "c");
			if($d > 0)
				return true;
			else
				return false;
		}else{
			echo "No se pudo ejecutar la Consulta";
		}

	}

	function GetLogs(){
		global $con;
		$qstr = "select * from log";
		$query = $con->Query($qstr);
		
		return $query;
	}
	function GetIdLog($ff){
		global $con;
		$qstr = "select * from log where fecha='".$ff."'";
		$query = $con->Query($qstr);
		return @$con->Result($query, 0, "id");	
	}
	function GetFechaLogD($ff){
		global $con;
		$qstr = "select * from log where id='".$ff."'";
		$query = $con->Query($qstr);
		return $con->Result($query, 0, "fecha");	
	}

	function consultarlog(){
		global $con;

	     $query = "select max(id) as max from log";
	     $response = $con->Query($query);

		 $row = $con->FetchAssoc($response);
	     $valor = $row['max'];


	    return $valor;

	}
	function GetFechaLog(){
		global $con;
		$log = consultarlog();
		$qstr = "select date(fecha) as d from log where id='".$log."'";
		$query = $con->Query($qstr);
		return $con->Result($query, 0, "d");

	}
	function Diferencia ($f1, $f2){
		global $con;
		$date1=$f1;
		$date2=$f2;

		$s = strtotime($date1)-strtotime($date2); ///para mi caso, simplemente $s = strtotime($periodo_ep_2)-strtotime($periodo_ep_1);
		$d = intval($s/86400);
		$s -= $d*86400;
		$h = intval($s/3600);
		$s -= $h*3600;
		$m = intval($s/60);
		$s -= $m*60;

		$dif= (($d*24)+$h).hrs." ".$m."min";
		$dif2= $d;
		
		return $dif2;
	}
	function crearLog(){
		global $con;
		$qr = "INSERT INTO log (fecha) VALUES ('".date('Y-m-d')."')";
		$query = $con->Query($qr);
		
		if($query){
			return "success";
		}else{
			return "Error";
		}
	}

	function CalcularFecha($fecha, $dias, $type){
		global $con;
		$fecha_c = date_create($fecha);
		date_modify($fecha_c, "$type$dias day");
		$fecha_c = date_format($fecha_c, "Y-m-d");
		return $fecha_c;
	}

	function IsFestivo($date){
		global $con;
		$qw = "select count(*) as t from dias_festivos where fecha = '$date'";
	//	echo $qw;
		$qqw = $con->Query($qw);
		$tqqw = $con->Result($qqw, 0, "t");

		return $tqqw;

	}

?>