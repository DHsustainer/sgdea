<?
class Funciones {
	//Funcion que recibe una fecha y hora y retorna la hora en forma amigable...
	function nicetime($date){
	    	if(empty($date)){
		      return "Fecha no especificada";
		   }
		   $periods    = array("Seg", "minuto", "hora", "d&iacute;a", "semana", "mes", "a&ntilde;o", "d&eacute;cada");
		   $lengths    = array("60","60","24","7","4.35","12","10");

		   $now = time();
		   if(is_int($date)){
		      //$unix_date   = $date + 3600 ;
		      $unix_date   = $date;
		   }else{
		      //$unix_date   = strtotime($date) + 3600;
		      $unix_date   = strtotime($date);
		   }

		   if(empty($unix_date)) {
		      return "Fecha incorrecta";
		   }
		   if($now > $unix_date) {
		      $difference  = $now - $unix_date;
		      $tense       = "Hace ";
		   }else{
		      $difference  = $unix_date - $now;
		      $tense       = "En ";
		   }
		   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		      $difference /= $lengths[$j];
		   }
		   $difference = round($difference);
		   if($difference != 1) {
		   		if($periods[$j] == "mes"){
		      		$periods[$j].= "es";
		   		}else{
		      		$periods[$j].= "s";
		   		}
		   }
		   return "{$tense} $difference $periods[$j] ";
	}
	function nicetime2($date){
	    if(empty($date)){
		    return "Fecha no especificada";
		}
		if ($date < date("Y-m-d")) {
			return "Eliminacion";
		}
		   $periods    = array("Seg", "minuto", "hora", "d&iacute;a", "semana", "mes", "a&ntilde;o", "d&eacute;cada");
		   $lengths    = array("60","60","24","7","4.35","12","10");

		   $now = time();
		   if(is_int($date)){
		      //$unix_date   = $date + 3600 ;
		      $unix_date   = $date;
		   }else{
		      //$unix_date   = strtotime($date) + 3600;
		      $unix_date   = strtotime($date);
		   }

		   if(empty($unix_date)) {
		      return "Fecha incorrecta";
		   }
		   if($now > $unix_date) {
		      $difference  = $now - $unix_date;
		      $tense       = "Hace ";
		   }else{
		      $difference  = $unix_date - $now;
		      $tense       = "";
		   }
		   for($j = 0; $difference>= $lengths[$j] && $j < count($lengths)-1; $j++) {
		      $difference /= $lengths[$j];
		   }
		   $difference = round($difference);
		   if($difference != 1) {
		   		if($periods[$j] == "mes"){
		      		$periods[$j].= "es";
		   		}else{
		      		$periods[$j].= "s";
		   		}
		   }
		   return "{$tense} $difference $periods[$j] ";
	}
	//Funcion que retorna laos dias entre dos fechas ingresadas
	function Diferencia ($f1, $f2){
		$date1=$f1;
		$date2=$f2;
	
		$s = strtotime($date1)-strtotime($date2); ///para mi caso, simplemente $s = strtotime($periodo_ep_2)-strtotime($periodo_ep_1);
		$d = intval($s/86400);
		$s -= $d*86400;
		$h = intval($s/3600);
		$s -= $h*3600;
		$m = intval($s/60);
		$s -= $m*60;
	
		$dif= (($d*24)+$h).hrs.' '.$m.'min';
		$dif2= $d;
		
		return $dif2;
	}
	//Funbcion que recibe la fecha en formato y-m-d y la retorna en formato leible
	function ObtenerFecha($fechai){
		//fecha AAAA/MM/DD
		$trozos=explode('-',$fechai,3); 
		$mes = $trozos[1];
		// número del mes de 01 a 12
	       switch($mes)
	       {
	       case '01':
	          $mes='Enero';
	          break;
	       case '02':
	          $mes='Febrero';
	          break;
	       case '03':
	          $mes='Marzo';
	          break;
	       case '04':
	          $mes='Abril';
	          break;
	       case '05':
	          $mes='Mayo';
	          break;
	       case '06':
	          $mes='Junio';
	          break;
	       case '07':
	          $mes='Julio';
	          break;
	       case '08':
	          $mes='Agosto';
	          break;
	       case '09':
	          $mes='Septiembre';
	          break;
	       case '10':
	          $mes='Octubre';
	          break;
	       case '11':
	          $mes='Noviembre';
	          break;
	       case '12':
	          $mes='Diciembre';
	          break;
	       } 
		return $trozos[2].' de '.$mes.' de '.$trozos[0];
	}
	//Funbcion que recibe la fecha en formato y-m-d y la retorna en formato leible
	function ObtenerFecha_2($fechai, $format = ""){
		//fecha AAAA/MM/DD
		$trozos=explode('-',$fechai,3); 
		$mes = $trozos[1];
		// número del mes de 01 a 12
	       switch($mes)
	       {
	       case '01':
	          $mes='Enero'; break;
	       case '02':
	          $mes='Febrero'; break;
	       case '03':
	          $mes='Marzo'; break;
	       case '04':
	          $mes='Abril'; break;
	       case '05':
	          $mes='Mayo'; break;
	       case '06':
	          $mes='Junio'; break;
	       case '07':
	          $mes='Julio'; break;
	       case '08': 
	          $mes='Agosto'; break;
	       case '09':
	          $mes='Septiembre.'; break;
	       case '10':
	          $mes='Octubre'; break;
	       case '11':
	          $mes='Noviembre'; break;
	       case '12':
	          $mes='Diciembre'; break;
	       } 
	       if ($format == "") {
				return $mes.'/'.$trozos[0];
	       }elseif($format == "mes"){
	       		return $mes.' de '.$trozos[0];
	       }elseif($format == "year"){
	       		return $trozos[0];
	       }else{
	       		$x = array( "Sun" => "Domingo", 
	       					"Mon" => "Lunes", 
	       					"Tue" => "Martes", 
	       					"Wed" => "Miercoles", 
	       					"Thu" => "Jueves", 
	       					"Fri" => "Viernes", 
	       					"Sat" => "Sabado");


	       		$day = date("D", $fechai);
	       		#echo $day." (".$fechai.") ";
	       		$day = $x[$day];


	       		return $trozos[2].' de '.$mes.' de '.$trozos[0];
	       	}
	}	

	function ObtenerFecha_3($primerDia, $ultimoDia, $year){
				//fecha AAAA/MM/DD
		$trozos=explode('-',$primerDia,3); 
		$trozos2=explode('-',$ultimoDia,3); 
		$mes = $trozos[1];
		$mes2 = $trozos2[1];
		// número del mes de 01 a 12
	       	switch($mes){
				case '01': $mes='Enero'; break;
				case '02': $mes='Febrero'; break;
				case '03': $mes='Marzo'; break;
				case '04': $mes='Abril'; break;
				case '05': $mes='Mayo'; break;
				case '06': $mes='Junio'; break;
				case '07': $mes='Julio'; break;
				case '08': $mes='Agosto'; break;
				case '09': $mes='Septiembre'; break;
				case '10': $mes='Octubre'; break;
				case '11': $mes='Noviembre'; break;
				case '12': $mes='Diciembre'; break;
	       	} 

	       	switch($mes2){
				case '01': $mes2='Enero'; break;
				case '02': $mes2='Febrero'; break;
				case '03': $mes2='Marzo'; break;
				case '04': $mes2='Abril'; break;
				case '05': $mes2='Mayo'; break;
				case '06': $mes2='Junio'; break;
				case '07': $mes2='Julio'; break;
				case '08': $mes2='Agosto'; break;
				case '09': $mes2='Septiembre'; break;
				case '10': $mes2='Octubre'; break;
				case '11': $mes2='Noviembre'; break;
				case '12': $mes2='Diciembre'; break;
	       	} 

	       	if ($trozos[0] != $trozos2[0]) {
	       		$year = $trozos[0]."-".$trozos2[0];
	       		# code...
	       	}
       		return $mes.' '.$trozos[2].' - '.$mes2.' '.$trozos2[2].' /'.$year;
	}

	//Funbcion que recibe la fecha en formato y-m-d y la retorna en formato leible
	function ObtenerFecha4($fechai){
		//fecha AAAA/MM/DD
		$fechai = explode(' ',$fechai); 
		$trozos=explode('-',$fechai[0],3); 
		$mes = $trozos[1];
		// número del mes de 01 a 12
	       switch($mes)
	       {
	       case '01':
	          $mes='Enero';
	          break;
	       case '02':
	          $mes='Febrero';
	          break;
	       case '03':
	          $mes='Marzo';
	          break;
	       case '04':
	          $mes='Abril';
	          break;
	       case '05':
	          $mes='Mayo';
	          break;
	       case '06':
	          $mes='Junio';
	          break;
	       case '07':
	          $mes='Julio';
	          break;
	       case '08':
	          $mes='Agosto';
	          break;
	       case '09':
	          $mes='Septiembre';
	          break;
	       case '10':
	          $mes='Octubre';
	          break;
	       case '11':
	          $mes='Noviembre';
	          break;
	       case '12':
	          $mes='Diciembre';
	          break;
	       } 
		return $trozos[2].' de '.$mes.' de '.$trozos[0]." a las ".$fechai[1];
	}
	// funcion para obtener el numero de la semana	
	function diasSemana($numerosemana){
		$ano = date('Y');
		if ($numerosemana > 0 and $numerosemana < 54) {
			$numerosemana = $numerosemana;
			$primerdia = $numerosemana * 7 -6;
			$ultimodia = $numerosemana * 7;
			$principioano = '$ano-01-01';
			$fecha1 = date('Y-m-d', strtotime('$principioano + $primerdia DAY')); 
			$fecha2 = date('Y-m-d', strtotime ('$principioano + $ultimodia DAY')); 
				if ($fecha2 <= date('Y-m-d', strtotime('$ano-12-31'))) {
					$fecha2 = $fecha2;
				}else{
					$fecha2 = date('Y-m-d',strtotime('$ano-12-31'));
				}
				
			echo $fecha1.','.$fecha2.'</br>';
			
		}else{
			echo 'este número de semana no es válido';
		}
	}
	//Funcion que retorna una serie de ceros a la izquierda
		function zerofill ($num,$zerofill) {
		    while (strlen($num)<$zerofill) {
		        $num = '0'.$num;
		    }
		    return $num;
		}
	//Funcion que retorna el lenguaje usado por el navegador del usuario
	function getUserLanguage() {  
       	$idioma =substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); 
     	return $idioma;
		//return 'es';
  
	
  	}	
  	//funcion para filtrar caracteres especiales para el motor de busquedas
	function CharsSearchEngine ($temp) {
#		$b = array('Á','Â','Ã','Ä','È','É','Ê','Ë','Ì','Í','Î','Ï','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','Ü','Š','Ý','Ÿ','à','á','â','ã','ä','è','é','ê','ë','ì','í','î','ï','ò','ó','ô','õ','ö','ù','ú','û','ü','š','ý','ÿ','〈','〉','«','»','‹','›','~','&','¦','¤','§','¶','¢','£','¥','€','ƒ','%','‰','©','®','™','¬','ˆ','˜','¨','º','ª','°','×','÷','±','¹','²','³','¼','½','¾','Ø','ø','‡','^','+','†','Þ','þ','Œ','œ','Ç','ç','Ñ','ñ','Ð','ð','Å','å','Æ','æ','µ','ß','◊','♠','♣','♥','♦','Γ','Δ','Θ','Λ','Ξ','Π','Σ','Φ','Ψ','Ω','α','β','γ','δ','ε','ζ','η','θ','ι','κ','λ','μ','ν','ξ','ο','π','ρ','ς','σ','τ','υ','φ','χ','ψ','ω','ϑ','ϒ','ϖ','←','↑','→','↓','↔','↵','⇐','⇑','⇒','⇓','⇔','∀','∂','∃','∅','∇','∈','∉','∋','∏','∑','−','∗','√','∝','∞','∠','∧','∨','∩','∪','∫','∴','∼','≅','≈','≠','≡','≤','≥','⊂','⊃','⊄','⊆','⊇','⊕','⊗','⊥','℘','ℑ','ℜ','ℵ',);
#		$c = array('&Aacute;','&Acirc;','&Atilde;','&Auml;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Scaron;','&Yacute;','&Yuml;','&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&ugrave;','&uacute;','&ucirc;','&uuml;','&scaron;','&yacute;','&yuml;','&lang;','&rang;','&laquo;','&raquo;','&lsaquo;','&rsaquo;','&#126;','&amp;','&brvbar;','&curren;','&sect;','&para;','&cent;','&pound;','&yen;','&euro;','&fnof;','&#37;','&permil;','&copy;','&reg;','&trade;','&not;','&circ;','&tilde;','&uml;','&ordm;','&ordf;','&deg;','&times;','&divide;','&plusmn;','&sup1;','&sup2;','&sup3;','&frac14;','&frac12;','&frac34;','&Oslash;','&oslash;','&Dagger;','&#94;','&#43;','&dagger;','&THORN;','&thorn;','&OElig;','&oelig;','&Ccedil;','&ccedil;','&Ntilde;','&ntilde;','&ETH;','&eth;','&Aring;','&aring;','&AElig;','&aelig;','&micro;','&szlig;','&loz;','&spades;','&clubs;','&hearts;','&diams;','&Gamma;','&Delta;','&Theta;','&Lambda;','&Xi;','&Pi;','&Sigma;','&Phi;','&Psi;','&Omega;','&alpha;','&beta;','&gamma;','&delta;','&epsilon;','&zeta;','&eta;','&theta;','&iota;','&kappa;','&lambda;','&mu;','&nu;','&xi;','&omicron;','&pi;','&rho;','&sigmaf;','&sigma;','&tau;','&upsilon;','&phi;','&chi;','&psi;','&omega;','&thetasym;','&upsih;','&piv;','&larr;','&uarr;','&rarr;','&darr;','&harr;','&crarr;','&lArr;','&uArr;','&rArr;','&dArr;','&hArr;','&forall;','&part;','&exist;','&empty;','&nabla;','&isin;','&notin;','&ni;','&prod;','&sum;','&minus;','&lowast;','&radic;','&prop;','&infin;','&ang;','&and;','&or;','&cap;','&cup;','&int;','&there4;','&sim;','&cong;','&asymp;','&ne;','&equiv;','&le;','&ge;','&sub;','&sup;','&nsub;','&sube;','&supe;','&oplus;','&otimes;','&perp;','&weierp;','&image;','&real;','&alefsym;');
		$b=array('Á','á','É','é','Í','í','Ó','ó','Ñ','ñ','Ú','ú','ü','Ü');
		$c=array("&Aacute;","&aacute;","&Eacute;","&eacute;","&Iacute;","&iacute;","&Oacute;","&oacute;","&Ntilde;","&ntilde;","&Uacute;","&uacute;","&uuml;","&Uuml;");
		$temp=str_replace($b,$c,$temp);
		return $temp;
	}
	//funcion para filtrar caracteres especiales
	function reemplazo ($temp) {
		$temp=strtoupper($temp);
		$b=array('á','é','í','ó','ú','ä','ë','ï','ö','ü','à','è','ì','ò','ù','ñ','----',',','/',';',':','¡','!','¿','?','\'','|',' - ','*');
		$c=array('a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','n','_','','-','','','','','','','','','-','');
		$temp=str_replace($b,$c,$temp);
		return $temp;
	}

	function ReemplazoXX($titulo_campo){

		$mint = strtolower($titulo_campo);
		$b=array("\'","'","&OACUTE",",",";","&OACUTE","&oacute","&Oacute","&eacute","&Eacute","&EACUTE","&AACUTE","&Aacute","&Eacute","&ntilde","&Iacute","&QUOT;","&quot;","&#8216;","&8216;","º",'Ã','Á','á','É','é','Í','í','Ó','ó','Ñ','ñ','Ú','ú','ü','Ü','"',"'","`","´","‘","’","“","”","„","&NTILDE","&iacute","Ã","ƒ","˜","â","€","&#8216;", "\t", "\n");

		$c=array("", "" ,"o" ,"" ,"" ,"o","o","o","e","e","e","a","a","e","n","i","","","","","","","a","a","e","e","i","i","o","o","n","n","u","u","u","u",'',"",'',"","","","","",",","n","i","","","","","","","","");
		
		$slug=str_replace($b,$c,$mint);
		return $slug;
	}

	function Reemplazo2($temp) {
		#$b=array('Á','á','É','é','Í','í','Ó','ó','Ñ','ñ','Ú','ú','ü','Ü','"',"'","`","´","‘","’","“","”","„","&NTILDE;","&iacute;");
		#$c=array("&Aacute;","&aacute;","&Eacute;","&eacute;","&Iacute;","i","&Oacute;","&oacute;","&Ntilde;","&ntilde;","&Uacute;","&uacute;","&uuml;","&Uuml;","&quot;","&#39;","&#96;","&acute;","&#8216;","&#8217;","&#8220;","&#8221;","&#8222;","Ñ","i");
		$b=array("\'","'","&OACUTE;",",",";","&OACUTE;","&oacute;","&Oacute;","&eacute;","&Eacute;","&EACUTE;","&AACUTE;","&Aacute;","&Eacute;","&Ntilde;","&Iacute;","&QUOT;","&quot;","&#8216;","&8216;","º",'Ã','Á','á','É','é','Í','í','Ó','ó','Ñ','ñ','Ú','ú','ü','Ü','"',"'","`","´","‘","’","“","”","„","&NTILDE;","&iacute;","Ã","ƒ","˜","â","€","&#8216;", "\t", "\n", "&IACUTE;");

		$c=array(" "," " ,"O"	  ,"" ,"" ,"O"       ,"O"       ,"O"       ,"e"       ,"E"       ,"E"       ,"A"       ,"A"       ,"E"       ,"N"       ,"I"       ,""        ,""      ,""     ,""      ,"" ,"" ,"A","a","E","e","I","i","O","o","N","n","U","u","u","U",' '," ",' '," "," "," "," "," ",",","N"       , "i"      ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"", "I");
		$temp=str_replace($b,$c,$temp);
		return $temp;
	}

	function Reemplazo3($temp) {

		$b=array("&OACUTE;","&EACUTE;","&AACUTE;","&NTILDE;","&IACUTE;","&UACUTE;");
		$c=array("&Oacute;","&Eacute;","&Aacute;","&Ntilde;","&Iacute;","&Uacute;");
		$temp=str_replace($b,$c,$temp);
		return $temp;
	}
	function MakeButtonMail($URL, $label){
		$path = '<table cellspacing="0" cellpadding="0" border="0">
					<tbody>
						<tr>
							<td height="44" align="center" style="font-family: Verdana, Arial; background:#0072C6;font-size:12px;font-weight:normal;padding-left:12px;padding-right:12px;line-height:30px;margin-left:7px;margin-right:7px; font-weight:bold ">
								<a href="'.$URL.'" target="_blank"style=" color:#FFF">'.$label.'</a>
							</td>
						</tr>
					</tbody>
				</table>';
				
		return $path;
	}
	
	function BodyMail($body, $footer= ""){
		global $c;
		global $con;

        $fid = 6;

        $sadmin = new MSuper_admin;
        $sadmin->CreateSuper_admin("id", $fid);


        
		$path = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

</head>

<body style="margin:0 auto;">
	<div style="background:#FFF width:100%; margin:0 auto; font-size:11px; font-family:Verdana, Geneva, sans-serif">
		<br />
		<table width="600" align="center" cellspacing="0" cellpadding="0">
		    <tbody>
		        <tr>
		            <td align="left" valign="middle" style="background:#FFF; padding:10px;border-top:2px solid #1579C4;border-left:1px solid #FFF;border-right:1px solid #FFF;"  height="50px">

					'."<img src='".HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil()."' width='150px'>".'

					</td>

		        </tr>
		        <tr>
		            <td style="background:#FCFCFC; border: 1px solid #F5F5F5; color:#444; margin-top:10px;padding:15px; font-size:12px;" align="justify">
		                '.$body.'
		            </td>
		        </tr>
		        <tr>
		            <td>
		                <table width="600" align="center" cellspacing="0" style="margin-top:40px; margin-bottom:40px">
		                    <tr>
		                        <td height="15px" style="border-top:1px solid #ccc; padding-top:20px; font-size:9px; color:#BBB" align="center">
								'.$footer.'
		                        </td>
		                    </tr>
		                </table>
		            </td>
		        </tr>						
		    </tbody>
		</table>         
	</div>
</body>
</html>';
				
		return $path;
	}
	function randomText($length) {
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		for($i=0;$i<$length;$i++) {
		  $key .= $pattern{rand(0,35)};
		}
		return $key;
	}	
	function getBrowser(){ 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		$navegadores = array(
			'Opera' => 'Opera',
			'Mozilla Firefox'=> '(Firebird)|(Firefox)',
			'Google Chrome'=>'(Chrome)',
			'Galeon' => 'Galeon',
			'Mozilla'=>'Gecko',
			'MyIE'=>'MyIE',
			'Lynx' => 'Lynx',
			'Chrome'=>'Chrome',
			'Konqueror'=>'Konqueror',
			'Internet Explorer' => 'MSIE');
		
		foreach($navegadores as $navegador=>$pattern){
			if (preg_match($pattern, $u_agent))
				$bname = $navegador; 
		}
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){ 
			$ub = "MSIE"; 
		}elseif(preg_match('/Firefox/i',$u_agent)){ 
			$ub = "Firefox"; 
		}elseif(preg_match('/Chrome/i',$u_agent)){ 
			$ub = "Chrome"; 
		}elseif(preg_match('/Safari/i',$u_agent)){ 
			$ub = "Safari"; 
		}elseif(preg_match('/Opera/i',$u_agent)){ 
			$ub = "Opera"; 
		}elseif(preg_match('/Netscape/i',$u_agent)){ 
			$ub = "Netscape"; 
		} 

		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
		}

		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}else {
				$version= $matches['version'][1];
			}
		}else {
			$version= $matches['version'][0];
		}

		// check if we have a number
		if ($version==null || $version=="") {
			$version="?";
		}

		return array(
		'userAgent' => $u_agent,
		'name' => $bname,
		'version' => $version,
		'pattern' => $pattern,
		'ub' => $ub
		);
	} 
	function getOs(){
		$useragent= strtolower($_SERVER['HTTP_USER_AGENT']);

		//winxp
		if (strpos($useragent, 'windows nt 5.1') !== FALSE) {
			return 'Windows XP';
		}elseif (strpos($useragent, 'windows nt 6.1') !== FALSE) {
			return 'Windows 7';
		}elseif (strpos($useragent, 'windows nt 6.0') !== FALSE) {
			return 'Windows Vista';
		}elseif (strpos($useragent, 'windows 98') !== FALSE) {
			return 'Windows 98';
		}elseif (strpos($useragent, 'windows nt 5.0') !== FALSE) {
			return 'Windows 2000';
		}elseif (strpos($useragent, 'windows nt 5.2') !== FALSE) {
			return 'Windows 2003 Server';
		}elseif (strpos($useragent, 'windows nt') !== FALSE) {
			return 'Windows NT';
		}elseif (strpos($useragent, 'win 9x 4.90') !== FALSE && strpos($useragent, 'win me')) {
			return 'Windows ME';
		}elseif (strpos($useragent, 'win ce') !== FALSE) {
			return 'Windows CE';
		}elseif (strpos($useragent, 'win 9x 4.90') !== FALSE) {
			return 'Windows ME';
		}elseif (strpos($useragent, 'windows phone') !== FALSE) {
			return 'Windows Phone';
		}elseif (strpos($useragent, 'iphone') !== FALSE) {
			return 'iPhone';
		}
		// experimental
		elseif (strpos($useragent, 'ipad') !== FALSE) {
			return 'iPad';
		}elseif (strpos($useragent, 'webos') !== FALSE) {
			return 'webOS';
		}elseif (strpos($useragent, 'symbian') !== FALSE) {
			return 'Symbian';
		}elseif (strpos($useragent, 'android') !== FALSE) {
			return 'Android';
		}elseif (strpos($useragent, 'blackberry') !== FALSE) {
			return 'Blackberry';
		}elseif (strpos($useragent, 'mac os x') !== FALSE) {
			return 'Mac OS X';
		}elseif (strpos($useragent, 'macintosh') !== FALSE) {
			return 'Macintosh';
		}elseif (strpos($useragent, 'linux') !== FALSE) {
			return 'Linux';
		}elseif (strpos($useragent, 'freebsd') !== FALSE) {
			return 'Free BSD';
		}elseif (strpos($useragent, 'symbian') !== FALSE) {
			return 'Symbian';
		}else{
			return 'Desconocido';
		}
	}

	function GetActivityIcon($status){

		$array = array( "1" => "book", "2" => "nota", "3" => "playlist", "4" => "admin", 
						"5" => "share", "6" => "topic", "7" => "update", "8" => "update", 
						"9" => "favorite", "10" => "location", "11" => "adminw", "12" => "adminw");


		return $array[$status];

	}

	function GenerarNuevoId($name){
		$nuevo_id = "";
		$ext = explode(".", $name);
		$ext = end($ext);
		
		for ($i=0; $i<32; $i++){
			$num = rand(0, 3);	
			if($num %2){
				$nuevo_id .= strtoupper(substr(md5(uniqid(rand())),0,1));
			}else{
				$nuevo_id .= substr(md5(uniqid(rand())),0,1);
			}
		}
		return $nuevo_id.".".$ext;
	}

	function GenerarSmallId(){
		$nuevo_id = "";
		
		for ($i=0; $i<7; $i++){
			$num = rand(0, 3);	
			if($num %2){
				$nuevo_id .= strtoupper(substr(md5(uniqid(rand())),0,1));
			}else{
				$nuevo_id .= substr(md5(uniqid(rand())),0,1);
			}
		}
		return $nuevo_id;
	}

	function Create_Select($query, $value, $option, $id=''){
		global $con;
		while ($col=$con->FetchAssoc($query)) {
			$result.=($col[$value]==$id)?"<option selected value='$col[$value]'>$col[$option]</option>":"<option value='$col[$value]'>$col[$option]</option>";
		}
		return $result;
	}

	function CalcularFecha($fecha, $dias, $type){
		$fecha_c = date_create($fecha);
		date_modify($fecha_c, "$type$dias day");
		$fecha_c = date_format($fecha_c, "Y-m-d");
		return $fecha_c;
	}

	function GetDNS(){
	    $nav="demandasenlinea.com"; // guardo en la variable el Navegador 
	    $dns=dns_get_record($nav); // guardo en la variable la resolucion del DNS 
	    $datos = $dns[2];

	    return $datos["rname"];

	}

	function UnDirt($temp) {
		$temp=strtolower($temp);
		$b=array("°","?");
		$c=array("","");
		$temp=str_replace($b,$c,$temp);

		$temp = trim($temp,chr(0xC2).chr(0xA0));
		$temp = trim($temp);
		$temp = strip_tags($temp);
		
		return $temp;
	}

	function parseBBCodex( $text ){
	    $path = "/\[elemento\](.*?)\[\/elemento\]/is";
		$text = preg_replace($path, "<span class='eltof $1'>$1</span>", $text);
		$path2 = "/\[meta\](.*?)\[\/meta\]/is";
		$text = preg_replace($path2, "<span class='eltof metax $1'>$1</span>", $text);
		$path3 = "/\[sc\](.*?)\[\/sc\]/is";
		$text = preg_replace($path3, "<span class='eltof susdata $1'>$1</span>", $text);
		return $text;
	}

	function encriptar($cadena, $key){
	    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
	    return $encrypted; //Devuelve el string encriptado
 
	}
	 
	function desencriptar($cadena, $key){
	    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	    return $decrypted;  //Devuelve el string desencriptado
	}

	function OpensslDesencriptar($plaintext, $key){

        $cipher = "aes-128-gcm";
        
        if (in_array($cipher, openssl_get_cipher_methods()))
        {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = "openssl_rand"; #openssl_random_pseudo_bytes($ivlen);

            $original_plaintext = openssl_decrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
            return $original_plaintext;
        }
    }

    function OpensslEncriptar($plaintext, $key){
        
        $cipher = "aes-128-gcm";
        if (in_array($cipher, openssl_get_cipher_methods()))
        {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = "openssl_rand"; #openssl_random_pseudo_bytes($ivlen);
            
            $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
            return $ciphertext;

        }
    }

	Function GetCOS($var){
		$str = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
					<fe:CreditNote xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">
					
					<ext:UBLExtensions>
						<ext:UBLExtension>
							<ext:ExtensionContent>
								<sts:DianExtensions>
									<sts:InvoiceControl>
										<sts:InvoiceAuthorization>'.$var['InvoiceAuthorization'].'</sts:InvoiceAuthorization>
										<sts:AuthorizationPeriod>
											<cbc:StartDate>'.$var['StartDate'].'</cbc:StartDate>
											<cbc:EndDate>'.$var['EndDate'].'</cbc:EndDate>
										</sts:AuthorizationPeriod>
										<sts:AuthorizedInvoices>
											<sts:Prefix>'.$var['Prefix'].'</sts:Prefix>
											<sts:From>'.$var['From'].'</sts:From>
											<sts:To>'.$var['To'].'</sts:To>
										</sts:AuthorizedInvoices>
									</sts:InvoiceControl>
									<sts:InvoiceSource>
										<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">'.$var['IdentificationCode'].'</cbc:IdentificationCode>
									</sts:InvoiceSource>
									<sts:SoftwareProvider>
										<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['ProviderID'].'</sts:ProviderID>
										<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['SoftwareID'].'</sts:SoftwareID>
									</sts:SoftwareProvider>
									<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['SoftwareSecurityCode'].'</sts:SoftwareSecurityCode>
								</sts:DianExtensions>
							</ext:ExtensionContent>
						</ext:UBLExtension>
					</ext:UBLExtensions>	
									
					<cbc:UBLVersionID>'.$var['UBLVersionID'].'</cbc:UBLVersionID>
						<cbc:CustomizationID/>
						<cbc:ProfileID>'.$var['ProfileID'].'</cbc:ProfileID>
						<cbc:ID>'.$var['ID'].'</cbc:ID>
						<cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion Impuestos y Aduanas Nacionales)">
							'.$var['UUID'].'
						</cbc:UUID>
						<cbc:IssueDate>'.$var['IssueDate'].'</cbc:IssueDate>
						<cbc:IssueTime>'.$var['IssueTime'].'</cbc:IssueTime>
						<cbc:Note>'.$var['Note'].'</cbc:Note>
						<cbc:DocumentCurrencyCode>'.$var['DocumentCurrencyCode'].'</cbc:DocumentCurrencyCode>
						<cac:DiscrepancyResponse>
							<cbc:ReferenceID/>
							<cbc:ResponseCode>'.$var['ResponseCode'].'</cbc:ResponseCode>
						</cac:DiscrepancyResponse>
						<fe:AccountingSupplierParty>
							<cbc:AdditionalAccountID>'.$var['AdditionalAccountID'].'</cbc:AdditionalAccountID>
							<fe:Party>
								<cac:PartyIdentification>
									<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$var['ID2'].'</cbc:ID>
								</cac:PartyIdentification>
								<cac:PartyName>
									<cbc:Name>'.$var['Name'].'</cbc:Name>
								</cac:PartyName>
								<fe:PhysicalLocation>
									<fe:Address>
										<cbc:Department>'.$var['Department'].'</cbc:Department>
										<cbc:CitySubdivisionName>'.$var['CitySubdivisionName'].'</cbc:CitySubdivisionName>
										<cbc:CityName>'.$var['CityName'].'</cbc:CityName>
										<cac:AddressLine>
											<cbc:Line>'.$var['Line'].'</cbc:Line>
										</cac:AddressLine>
										<cac:Country>
											<cbc:IdentificationCode>'.$var['IdentificationCode'].'</cbc:IdentificationCode>
										</cac:Country>
									</fe:Address>
								</fe:PhysicalLocation>
								<fe:PartyTaxScheme>
									<cbc:TaxLevelCode>'.$var['TaxLevelCode'].'</cbc:TaxLevelCode>
									<cac:TaxScheme/>
								</fe:PartyTaxScheme>
								<fe:PartyLegalEntity>
									<cbc:RegistrationName>'.$var['RegistrationName'].'</cbc:RegistrationName>
								</fe:PartyLegalEntity>
							</fe:Party>
						</fe:AccountingSupplierParty>
						<fe:AccountingCustomerParty>
							<cbc:AdditionalAccountID>'.$var['AdditionalAccountID2'].'</cbc:AdditionalAccountID>
							<fe:Party>
								<cac:PartyIdentification>
									<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="22">'.$var['ID3'].'</cbc:ID>
								</cac:PartyIdentification>
								<fe:PhysicalLocation>
									<fe:Address>
										<cbc:Department>'.$var['Department2'].'</cbc:Department>
										<cbc:CitySubdivisionName>'.$var['CitySubdivisionName2'].'</cbc:CitySubdivisionName>
										<cbc:CityName>'.$var['CityName2'].'</cbc:CityName>
										<cac:AddressLine>
											<cbc:Line>'.$var['Line2'].'</cbc:Line>
										</cac:AddressLine>
										<cac:Country>
											<cbc:IdentificationCode>'.$var['IdentificationCode2'].'</cbc:IdentificationCode>
										</cac:Country>
									</fe:Address>
								</fe:PhysicalLocation>
								<fe:PartyTaxScheme>
									<cbc:TaxLevelCode>'.$var['TaxLevelCode2'].'</cbc:TaxLevelCode>
									<cac:TaxScheme/>
								</fe:PartyTaxScheme>
								<fe:Person>
									<cbc:FirstName>'.$var['FirstName'].'</cbc:FirstName>
									<cbc:FamilyName>'.$var['FamilyName'].'</cbc:FamilyName>
									<cbc:MiddleName>'.$var['MiddleName'].'</cbc:MiddleName>
								</fe:Person>
							</fe:Party>
						</fe:AccountingCustomerParty>
						<fe:LegalMonetaryTotal>
							<cbc:LineExtensionAmount currencyID="'.$var['currency'].'">'.$var['LineExtensionAmount'].'</cbc:LineExtensionAmount>
							<cbc:TaxExclusiveAmount currencyID="'.$var['currency'].'">'.$var['TaxExclusiveAmount'].'</cbc:TaxExclusiveAmount>
							<cbc:PayableAmount currencyID="'.$var['currency'].'">'.$var['PayableAmount'].'</cbc:PayableAmount>
						</fe:LegalMonetaryTotal>
						<cac:CreditNoteLine>
							<cbc:ID>'.$var['ID4'].'</cbc:ID>
							<cbc:Note>'.$var['Note2'].'</cbc:Note>
							<cbc:CreditedQuantity>'.$var['CreditedQuantity'].'</cbc:CreditedQuantity>
							<cbc:LineExtensionAmount currencyID="'.$var['currency'].'">'.$var['LineExtensionAmount'].'</cbc:LineExtensionAmount>
							<cbc:AccountingCostCode>'.$var['AccountingCostCode'].'</cbc:AccountingCostCode>
							<cac:Item>
								<cbc:Description>'.$var['Description'].'</cbc:Description>
							</cac:Item>
							<cac:Price>
								<cbc:PriceAmount currencyID="'.$var['currency'].'">'.$var['PriceAmount'].'</cbc:PriceAmount>
							</cac:Price>
						</cac:CreditNoteLine>
					</fe:CreditNote>';

		return $str;
	}


	Function GetDOS($var){
		$str = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
					<fe:DebitNote xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">
					

					<ext:UBLExtensions>
						<ext:UBLExtension>
							<ext:ExtensionContent>
								<sts:DianExtensions>
									<sts:InvoiceControl>
										<sts:InvoiceAuthorization>'.$var['InvoiceAuthorization'].'</sts:InvoiceAuthorization>
										<sts:AuthorizationPeriod>
											<cbc:StartDate>'.$var['StartDate'].'</cbc:StartDate>
											<cbc:EndDate>'.$var['EndDate'].'</cbc:EndDate>
										</sts:AuthorizationPeriod>
										<sts:AuthorizedInvoices>
											<sts:Prefix>'.$var['Prefix'].'</sts:Prefix>
											<sts:From>'.$var['From'].'</sts:From>
											<sts:To>'.$var['To'].'</sts:To>
										</sts:AuthorizedInvoices>
									</sts:InvoiceControl>
									<sts:InvoiceSource>
										<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">'.$var['IdentificationCode'].'</cbc:IdentificationCode>
									</sts:InvoiceSource>
									<sts:SoftwareProvider>
										<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['ProviderID'].'</sts:ProviderID>
										<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['SoftwareID'].'</sts:SoftwareID>
									</sts:SoftwareProvider>
									<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['SoftwareSecurityCode'].'</sts:SoftwareSecurityCode>
								</sts:DianExtensions>
							</ext:ExtensionContent>
						</ext:UBLExtension>
					</ext:UBLExtensions>	


					<cbc:UBLVersionID>'.$var['UBLVersionID'].'</cbc:UBLVersionID>
						<cbc:CustomizationID/>
						<cbc:ProfileID>'.$var['ProfileID'].'</cbc:ProfileID>
						<cbc:ID>'.$var['ID'].'</cbc:ID>
						<cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion Impuestos y Aduanas Nacionales)">
							'.$var['UUID'].'
						</cbc:UUID>
						<cbc:IssueDate>'.$var['IssueDate'].'</cbc:IssueDate>
						<cbc:IssueTime>'.$var['IssueTime'].'</cbc:IssueTime>
						<cbc:InvoiceTypeCode listAgencyID="195" listAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" listSchemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/InvoiceType">'.$var['InvoiceTypeCode'].'</cbc:InvoiceTypeCode>
						<cbc:Note>'.$var['Note'].'</cbc:Note>
						<cbc:DocumentCurrencyCode>'.$var['DocumentCurrencyCode'].'</cbc:DocumentCurrencyCode>
						<cac:DiscrepancyResponse>
							<cbc:ReferenceID/>
							<cbc:ResponseCode>'.$var['ResponseCode'].'</cbc:ResponseCode>
						</cac:DiscrepancyResponse>
						<fe:AccountingSupplierParty>
							<cbc:AdditionalAccountID>'.$var['AdditionalAccountID'].'</cbc:AdditionalAccountID>
							<fe:Party>
								<cac:PartyIdentification>
									<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$var['ID2'].'</cbc:ID>
								</cac:PartyIdentification>
								<cac:PartyName>
									<cbc:Name>'.$var['Name'].'</cbc:Name>
								</cac:PartyName>
								<fe:PhysicalLocation>
									<fe:Address>
										<cbc:Department>'.$var['Department'].'</cbc:Department>
										<cbc:CitySubdivisionName>'.$var['CitySubdivisionName'].'</cbc:CitySubdivisionName>
										<cbc:CityName>'.$var['CityName'].'</cbc:CityName>
										<cac:AddressLine>
											<cbc:Line>'.$var['Line'].'</cbc:Line>
										</cac:AddressLine>
										<cac:Country>
											<cbc:IdentificationCode>'.$var['IdentificationCode'].'</cbc:IdentificationCode>
										</cac:Country>
									</fe:Address>
								</fe:PhysicalLocation>
								<fe:PartyTaxScheme>
									<cbc:TaxLevelCode>'.$var['TaxLevelCode'].'</cbc:TaxLevelCode>
									<cac:TaxScheme/>
								</fe:PartyTaxScheme>
								<fe:PartyLegalEntity>
									<cbc:RegistrationName>'.$var['RegistrationName'].'</cbc:RegistrationName>
								</fe:PartyLegalEntity>
							</fe:Party>
						</fe:AccountingSupplierParty>
						<fe:AccountingCustomerParty>
							<cbc:AdditionalAccountID>'.$var['AdditionalAccountID2'].'</cbc:AdditionalAccountID>
							<fe:Party>
								<cac:PartyIdentification>
									<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="22">'.$var['ID3'].'</cbc:ID>
								</cac:PartyIdentification>
								<fe:PhysicalLocation>
									<fe:Address>
										<cbc:Department>'.$var['Department2'].'</cbc:Department>
										<cbc:CitySubdivisionName>'.$var['CitySubdivisionName2'].'</cbc:CitySubdivisionName>
										<cbc:CityName>'.$var['CityName2'].'</cbc:CityName>
										<cac:AddressLine>
											<cbc:Line>'.$var['Line2'].'</cbc:Line>
										</cac:AddressLine>
										<cac:Country>
											<cbc:IdentificationCode>'.$var['IdentificationCode2'].'</cbc:IdentificationCode>
										</cac:Country>
									</fe:Address>
								</fe:PhysicalLocation>
								<fe:PartyTaxScheme>
									<cbc:TaxLevelCode>'.$var['TaxLevelCode2'].'</cbc:TaxLevelCode>
									<cac:TaxScheme/>
								</fe:PartyTaxScheme>
								<fe:Person>
									<cbc:FirstName>'.$var['FirstName'].'</cbc:FirstName>
									<cbc:FamilyName>'.$var['FamilyName'].'</cbc:FamilyName>
									<cbc:MiddleName>'.$var['MiddleName'].'</cbc:MiddleName>
								</fe:Person>
							</fe:Party>
						</fe:AccountingCustomerParty>
						<fe:LegalMonetaryTotal>
							<cbc:LineExtensionAmount currencyID="'.$var['currency'].'">'.$var['LineExtensionAmount'].'</cbc:LineExtensionAmount>
							<cbc:TaxExclusiveAmount currencyID="'.$var['currency'].'">'.$var['TaxExclusiveAmount'].'</cbc:TaxExclusiveAmount>
							<cbc:PayableAmount currencyID="'.$var['currency'].'">'.$var['PayableAmount'].'</cbc:PayableAmount>
						</fe:LegalMonetaryTotal>
						<cac:DebitNoteLine>
							<cbc:ID>'.$var['ID4'].'</cbc:ID>
							<cbc:UUID>'.$var['UUID2'].'</cbc:UUID>
							<cbc:Note>'.$var['Note2'].'</cbc:Note>
							<cbc:DebitedQuantity>'.$var['DebitedQuantity'].'</cbc:DebitedQuantity>
							<cbc:LineExtensionAmount currencyID="'.$var['currency'].'">'.$var['LineExtensionAmount'].'</cbc:LineExtensionAmount>
							<cbc:AccountingCostCode>'.$var['AccountingCostCode'].'</cbc:AccountingCostCode>
							<cac:Item>
								<cbc:Description>'.$var['Description'].'</cbc:Description>
							</cac:Item>
							<cac:Price>
								<cbc:PriceAmount currencyID="'.$var['currency'].'">'.$var['PriceAmount'].'</cbc:PriceAmount>
							</cac:Price>
						</cac:DebitNoteLine>
					</fe:DebitNote>';

		return $str;
	}

	function GetFOS($var){
		$str = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
					<fe:Invoice xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">
					<ext:UBLExtensions>
						<ext:UBLExtension>
							<ext:ExtensionContent>
								<sts:DianExtensions>
									<sts:InvoiceControl>
										<sts:InvoiceAuthorization>'.$var['InvoiceAuthorization'].'</sts:InvoiceAuthorization>
										<sts:AuthorizationPeriod>
											<cbc:StartDate>'.$var['StartDate'].'</cbc:StartDate>
											<cbc:EndDate>'.$var['EndDate'].'</cbc:EndDate>
										</sts:AuthorizationPeriod>
										<sts:AuthorizedInvoices>
											<sts:Prefix>'.$var['Prefix'].'</sts:Prefix>
											<sts:From>'.$var['From'].'</sts:From>
											<sts:To>'.$var['To'].'</sts:To>
										</sts:AuthorizedInvoices>
									</sts:InvoiceControl>
									<sts:InvoiceSource>
										<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">'.$var['IdentificationCode'].'</cbc:IdentificationCode>
									</sts:InvoiceSource>
									<sts:SoftwareProvider>
										<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['ProviderID'].'</sts:ProviderID>
										<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['SoftwareID'].'</sts:SoftwareID>
									</sts:SoftwareProvider>
									<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['SoftwareSecurityCode'].'</sts:SoftwareSecurityCode>
								</sts:DianExtensions>
							</ext:ExtensionContent>
						</ext:UBLExtension>
					</ext:UBLExtensions>	


					<cbc:UBLVersionID>'.$var['UBLVersionID'].'</cbc:UBLVersionID>
					<cbc:ProfileID>'.$var['ProfileID'].'</cbc:ProfileID>
						<cbc:ID>'.$var['ID'].'</cbc:ID>
						<cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$var['UUID'].'</cbc:UUID>
						<cbc:IssueDate>'.$var['IssueDate'].'</cbc:IssueDate>
						<cbc:IssueTime>'.$var['IssueTime'].'</cbc:IssueTime>
						<cbc:InvoiceTypeCode listAgencyID="195" listAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" listSchemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/InvoiceType">'.$var['InvoiceTypeCode'].'</cbc:InvoiceTypeCode>
						<cbc:Note>'.$var['Note'].'</cbc:Note>
						<cbc:DocumentCurrencyCode>'.$var['DocumentCurrencyCode'].'</cbc:DocumentCurrencyCode>
						<fe:AccountingSupplierParty>
							<cbc:AdditionalAccountID>'.$var['AdditionalAccountID'].'</cbc:AdditionalAccountID>
							<fe:Party>
								<cac:PartyIdentification>
									<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$var['ID2'].'</cbc:ID>
								</cac:PartyIdentification>
								<cac:PartyName>
									<cbc:Name>'.$var['Name'].'</cbc:Name>
								</cac:PartyName>
								<fe:PhysicalLocation>
									<fe:Address>
										<cbc:Department>'.$var['Department'].'</cbc:Department>
										<cbc:CitySubdivisionName>'.$var['CitySubdivisionName'].'</cbc:CitySubdivisionName>
										<cbc:CityName>'.$var['CityName'].'</cbc:CityName>
										<cac:AddressLine>
											<cbc:Line>'.$var['Line'].'</cbc:Line>
										</cac:AddressLine>
										<cac:Country>
											<cbc:IdentificationCode>'.$var['IdentificationCode'].'</cbc:IdentificationCode>
										</cac:Country>
									</fe:Address>
								</fe:PhysicalLocation>
								<fe:PartyTaxScheme>
									<cbc:TaxLevelCode>'.$var['TaxLevelCode'].'</cbc:TaxLevelCode>
									<cac:TaxScheme/>
								</fe:PartyTaxScheme>
									<fe:PartyLegalEntity>
										<cbc:RegistrationName>'.$var['RegistrationName'].'</cbc:RegistrationName>
									</fe:PartyLegalEntity>
							</fe:Party>
						</fe:AccountingSupplierParty>
						<fe:AccountingCustomerParty>
							<cbc:AdditionalAccountID>'.$var['AdditionalAccountID2'].'</cbc:AdditionalAccountID>
							<fe:Party>
								<cac:PartyIdentification>
									<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="22">'.$var['ID3'].'</cbc:ID>
								</cac:PartyIdentification>
								<fe:PhysicalLocation>
									<fe:Address>
										<cbc:Department>'.$var['Department2'].'</cbc:Department>
										<cbc:CitySubdivisionName>'.$var['CitySubdivisionName2'].'</cbc:CitySubdivisionName>
										<cbc:CityName>'.$var['CityName2'].'</cbc:CityName>
										<cac:AddressLine>
											<cbc:Line>'.$var['Line2'].'</cbc:Line>
										</cac:AddressLine>
										<cac:Country>
											<cbc:IdentificationCode>'.$var['IdentificationCode2'].'</cbc:IdentificationCode>
										</cac:Country>
									</fe:Address>
								</fe:PhysicalLocation>
								<fe:PartyTaxScheme>
									<cbc:TaxLevelCode>'.$var['TaxLevelCode2'].'</cbc:TaxLevelCode>
									<cac:TaxScheme/>
								</fe:PartyTaxScheme>
								<fe:Person>
									<cbc:FirstName>'.$var['FirstName'].'</cbc:FirstName>
									<cbc:FamilyName>'.$var['FamilyName'].'</cbc:FamilyName>
									<cbc:MiddleName>'.$var['MiddleName'].'</cbc:MiddleName>
								</fe:Person>
							</fe:Party>
						</fe:AccountingCustomerParty>
						<fe:TaxTotal>
							<cbc:TaxAmount currencyID="'.$var['currency'].'">'.$var['TaxAmount'].'</cbc:TaxAmount>
							<cbc:TaxEvidenceIndicator>'.$var['TaxEvidenceIndicator'].'</cbc:TaxEvidenceIndicator>
							<fe:TaxSubtotal>
								<cbc:TaxableAmount currencyID="'.$var['currency'].'">'.$var['TaxableAmount'].'</cbc:TaxableAmount>
								<cbc:TaxAmount currencyID="'.$var['currency'].'">'.$var['TaxAmount2'].'</cbc:TaxAmount>
								<cbc:Percent>'.$var['Percent'].'</cbc:Percent>
								<cac:TaxCategory>
									<cac:TaxScheme>
									<cbc:ID>'.$var['ID4'].'</cbc:ID>
								</cac:TaxScheme>
								</cac:TaxCategory>
							</fe:TaxSubtotal>
						</fe:TaxTotal>
						<fe:TaxTotal>
							<cbc:TaxAmount currencyID="'.$var['currency'].'">'.$var['TaxAmount3'].'</cbc:TaxAmount>
							<cbc:TaxEvidenceIndicator>'.$var['TaxEvidenceIndicator2'].'</cbc:TaxEvidenceIndicator>
							<fe:TaxSubtotal>
								<cbc:TaxableAmount currencyID="'.$var['currency'].'">'.$var['TaxableAmount2'].'</cbc:TaxableAmount>
								<cbc:TaxAmount currencyID="'.$var['currency'].'">'.$var['TaxAmount4'].'</cbc:TaxAmount>
								<cbc:Percent>'.$var['Percent2'].'</cbc:Percent>
								<cac:TaxCategory>
									<cac:TaxScheme>
									<cbc:ID>'.$var['ID5'].'</cbc:ID>
								</cac:TaxScheme>
								</cac:TaxCategory>
							</fe:TaxSubtotal>
						</fe:TaxTotal>
						<fe:LegalMonetaryTotal>
							<cbc:LineExtensionAmount currencyID="'.$var['currency'].'">'.$var['LineExtensionAmount'].'</cbc:LineExtensionAmount>
							<cbc:TaxExclusiveAmount currencyID="'.$var['currency'].'">'.$var['TaxExclusiveAmount'].'</cbc:TaxExclusiveAmount>
							<cbc:PayableAmount currencyID="'.$var['currency'].'">'.$var['PayableAmount'].'</cbc:PayableAmount>
						</fe:LegalMonetaryTotal>
						<fe:InvoiceLine>
							<cbc:ID>'.$var['ID6'].'</cbc:ID>
							<cbc:InvoicedQuantity>'.$var['InvoicedQuantity'].'</cbc:InvoicedQuantity>
							<cbc:LineExtensionAmount currencyID="'.$var['currency'].'">'.$var['LineExtensionAmount2'].'</cbc:LineExtensionAmount>
							<fe:Item>
								<cbc:Description>'.$var['Description'].'</cbc:Description>
							</fe:Item>
							<fe:Price>
								<cbc:PriceAmount currencyID="'.$var['currency'].'">'.$var['PriceAmount'].'</cbc:PriceAmount>
							</fe:Price>
						</fe:InvoiceLine>
					</fe:Invoice>';

		return $str;
	}

	function SoapEnvelope($var){

		$str = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:rep="http://www.dian.gov.co/servicios/facturaelectronica/ReportarFactura">
	   <soapenv:Header><wsse:Security soapenv:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
	         <wsse:UsernameToken wsu:Id="UsernameToken-2">
	            <wsse:Username>'.$var['SoftwareID'].'</wsse:Username>
	            <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$var['password'].'</wsse:Password>
	            <wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">'.$var['nonce'].'</wsse:Nonce>
	            <wsu:Created>'.date("Y-m-d H:i:s").'</wsu:Created>
	         </wsse:UsernameToken>
	      </wsse:Security>
	   </soapenv:Header>
	   <soapenv:Body>
			<rep:EnvioFacturaElectronicaPeticion>
				<rep:NIT>'.$var['ProviderID'].'</rep:NIT>
				<rep:InvoiceNumber>'.$var['Num_Factura_C'].'</rep:InvoiceNumber>
				<rep:IssueDate>'.$var['IssueDate'].' '.$var['IssueTime'].'</rep:IssueDate>
				<rep:Document>
					'.$var['Base64'].'
				</rep:Document>
			</rep:EnvioFacturaElectronicaPeticion>
	   	</soapenv:Body>
	</soapenv:Envelope>';

		return $str;

	}

	function ValidarXMLField($field, $value){

		$var = array(
			'UBLVersionID' => "UBL 2.0", 		'ProfileID' => "DIAN 1.0", 			'ID' => "STRINGAZ09", 
			'UUID' => "STRING", 				'IssueDate' => "DATE",				'IssueTime' => "TIME", 
			'Note' => "STRING",					'DocumentCurrencyCode' => "COP",	'ResponseCode' => "NUMBER", 
			'AdditionalAccountID' => "NUMBER",	'ID2' => "STRINGAZ09", 				'Name' => "STRING", 
			'Department' => "STRING",			'CitySubdivisionName' => "STRING", 	'CityName' => "STRING", 
			'Line' => "STRING", 				'IdentificationCode' => "STRING", 	'TaxLevelCode' => "NUMBER", 
			'RegistrationName' => "STRING",		'AdditionalAccountID2' => "NUMBER",	'ID3' => "STRINGAZ09", 
			'Department2' => "STRING",			'CitySubdivisionName2' => "STRING",	'CityName2' => "STRING", 
			'Line2' => "STRING",				'IdentificationCode2' => "STRING",	'TaxLevelCode2' => "NUMBER", 
			'FirstName' => "STRING",			'FamilyName' => "STRING",			'MiddleName' => "STRING", 
			'currency' => "COP",				'LineExtensionAmount' => "NUMBER",	'TaxExclusiveAmount' => "NUMBER", 
			'PayableAmount' => "NUMBER",		'ID4' => "STRINGAZ09", 				'Note2' => "STRING", 
			'CreditedQuantity' => "NUMBER", 	'LineExtensionAmount' => "NUMBER",	'AccountingCostCode' => "STRING", 
			'Description' => "STRING",			'PriceAmount' => "STRING", 			'UUID2' => "STRING",
			"DebitedQuantity" => "STRING", 		"InvoiceTypeCode" => "NUMBER", 		'TaxAmount' => "NUMBER", 
			'TaxEvidenceIndicator' => "BOOLEAN",'TaxableAmount' => "NUMBER",		'TaxAmount2' => "NUMBER", 
			'Percent' => "NUMBER",				'TaxAmount3' => "NUMBER",			'TaxEvidenceIndicator2' => "BOOLEAN", 
			'TaxableAmount2' => "NUMBER",		'TaxAmount4' => "NUMBER",			'Percent2' => "NUMBER", 
			'ID5' => "STRINGAZ09", 				'ID6' => "STRINGAZ09", 				'InvoicedQuantity' => "NUMBER", 
			'LineExtensionAmount2' => "NUMBER", 'Percent2' => "NUMBER", 			'InvoiceAuthorization' => "STRING", 		
			'StartDate' => "DATE",				'EndDate' => "DATE",				'Prefix' => "STRING", 
			'From' => "STRING", 				'To' => "STRING", 					'IdentificationCode' => "STRING", 
			'ProviderID' => "STRING",			'SoftwareID' => "STRING", 			'SoftwareSecurityCode' => "STRING",
			"password" => "STRING", 			"nonce" => "STRING", 				"Num_Factura_C" => "STRING", 
			"NombreArchivo" => "STRING"
			);

		
		if($value == ""){
			return array('respuesta' => '0', 'mensaje' => "El campo $field se encuentra vacio");
		}else{

			if(array_key_exists($field, $var)){
				if ($var[$field] == "STRING") {
					return array('respuesta' => '1', 'mensaje' => "Campo OK!");
				}elseif($var[$field] == "STRINGAZ09"){
					if (ereg("^[a-zA-Z0-9]$", $value)) { 
				       return array('respuesta' => '0', 'mensaje' => "El campo $field contiene caracteres especiales");
				   	}else{ 
				      return array('respuesta' => '1', 'mensaje' => "Campo OK!");
				   	} 
				}elseif($var[$field] == "NUMBER"){
					if (is_numeric($value)) {
						return array('respuesta' => '1', 'mensaje' => "Campo OK!");
					}else{
						return array('respuesta' => '0', 'mensaje' => "En el campo $field solo se reciben numeros");
					}
				}elseif($var[$field] == "DATE"){
					if ($this->validateDate($value, "Y-m-d")) {
						return array('respuesta' => '1', 'mensaje' => "Campo OK!");
					}else{
						return array('respuesta' => '0', 'mensaje' => "En el campo $field solo se recibe fecha en formato YYYY-MM-DD");
					}
				}elseif($var[$field] == "TIME"){
					if ($this->validateDate($value, "H:i:s")) {
						return array('respuesta' => '1', 'mensaje' => "Campo OK!");
					}else{
						return array('respuesta' => '0', 'mensaje' => "En el campo $field solo se reciben hora en formato HH:II:SS");
					}
				}elseif($var[$field] == "BOOLEAN"){
					if ($value == "TRUE" || $value == "FALSE" || $value == "1" || $value == "0") {
						return array('respuesta' => '1', 'mensaje' => "Campo OK!");
					}else{
						return array('respuesta' => '0', 'mensaje' => "En el campo $field solo permite valores TRUE/FALSE/1/0 ");
					}
				}else{
					if ($value == $var[$field]) {
						return array('respuesta' => '1', 'mensaje' => "Campo OK!");
					}else{
						return array('respuesta' => '0', 'mensaje' => "El campo $field solo debe contener $var[$field] ");
					}
				}
			}else{
				return array('respuesta' => '0', 'mensaje' => "El campo $field no se encuentra definido en la base de datos");	
			}
		}

	}

	function validateDate($date, $format = 'Y-m-d H:i:s'){
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

	function UrlAmigable ($temp) {
		$temp=strtolower($temp);
		$b=array('á','é','í','ó','ú','ä','ë','ï','ö','ü','à','è','ì','ò','ù','ñ','----',',','/',';',':','¡','!','¿','?','\'','|',' - ','*', ' ', "&Aacute","&aacute","&Eacute","&eacute","&Iacute","&iacute","&Oacute","&oacute","&Ntilde","&ntilde","&Uacute","&uacute","&uuml","&Uuml");
		$c=array('a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','n','_','','-','','','','','','','','','-','', '-', 'A','a','E','e','I','i','O','o','N','n','U','u','U','U');
		$temp=str_replace($b,$c,$temp);
		return $temp;
	}
	function dameURL(){
		$url = "http://" . $_SERVER [ 'HTTP_HOST' ].$_SERVER['REQUEST_URI'] ;
		echo $url;
	}

	function DoFolder($nombre, $enlace, $cantidad, $color = "", $target = "", $area = "0"){
		global $c;
		$nombre = strtolower($nombre);
		$subnombre = substr($nombre, 0, 45);
		if ($target == "1") {
			$path = "onclick='window.open(\"$enlace\", \"_blank\")'";
		}else{
			$path = "onclick='window.location.href=\"$enlace\"'";
		}

		if ($color == "green") {
			if ($cantidad == "000") {
				$color = "gray";
			}else{
				$color = "green";
			}

		}else{
			if ($cantidad == "000") {
				$color = "gray";
			}else{
				$color = "blue";
			}
				# code...
		}
		$idayuda = '72';

		switch ($nombre) {
			case 'CORRESPONDENCIA':
				$idayuda = '73';
				break;
			case 'REPARTO':
				$idayuda = '74';
				break;
			case 'VER TODOS MIS EXPEDIENTES':
				$idayuda = '75';
				break;
			case 'EXPEDIENTES CREADOS POR MI':
				$idayuda = '76';
				break;
			case 'EXPEDIENTES QUE ME HAN COMPARTIDO':
				$idayuda = '77';
				break;				
			default:
				$idayuda = '72';
				break;
		}

		$nombrem = strtolower($nombre);

		return '
				<div class="col-md-4">
					<div class="media" attr="'.$nombrem.'">
					  	<div class="media-left">
					    	<a href="#" '.$path.'>
						    	<span class="folder '.$color.'">
						      		<img class="folder '.$color.' media-object" src="/image/datepicker.png" data-holder-rendered="true" style="display:none" >
						      	</span>
						    </a>
					  	</div>
					  	<div class="media-body '.$color.'">
					    	<h5 class="media-heading" title="'.$nombre.'"><a href="#" '.$path.' class="nombre text-muted" style="text-transform:uppercase" '.$c->Ayuda($idayuda, 'tog').'>'.$subnombre.'</a></h5>
					    	<div class="min-text"><a href="#" '.$path.' class="text-muted">'.$cantidad.' Expedientes</a></div>
					  	</div>
				  	</div>
				</div>';		
	}


	function DoFolderAjax($nombre, $enlace, $cantidad, $color = "", $target = "", $area = "0"){
		global $c;
		$nombre = strtolower($nombre);
		$subnombre = substr($nombre, 0, 45);
		if ($target == "1") {
			$path = "onclick='LoadAjaxFolder(\"$enlace\")'";
		}else{
			$path = "onclick='window.location.href=\"$enlace\"'";
		}

		if ($color == "green") {
			if ($cantidad == "000") {
				$color = "gray";
			}else{
				$color = "green";
			}

		}else{
			if ($cantidad == "000") {
				$color = "gray";
			}else{
				$color = "blue";
			}
				# code...
		}
		$idayuda = '72';

		switch ($nombre) {
			case 'CORRESPONDENCIA':
				$idayuda = '73';
				break;
			case 'REPARTO':
				$idayuda = '74';
				break;
			case 'VER TODOS MIS EXPEDIENTES':
				$idayuda = '75';
				break;
			case 'EXPEDIENTES CREADOS POR MI':
				$idayuda = '76';
				break;
			case 'EXPEDIENTES QUE ME HAN COMPARTIDO':
				$idayuda = '77';
				break;				
			default:
				$idayuda = '72';
				break;
		}

		$nombrem = strtolower($nombre);

		return '
				<div class="col-md-4">
					<div class="media" attr="'.$nombrem.'">
					  	<div class="media-left">
					    	<a href="#" '.$path.'>
						    	<span class="folder '.$color.'">
						      		<img class="folder '.$color.' media-object" src="/image/datepicker.png" data-holder-rendered="true" style="display:none" >
						      	</span>
						    </a>
					  	</div>
					  	<div class="media-body '.$color.'">
					    	<h5 class="media-heading" title="'.$nombre.'"><a href="#" '.$path.' class="nombre text-muted" style="text-transform:uppercase" '.$c->Ayuda($idayuda, 'tog').'>'.$subnombre.'</a></h5>
					    	<div class="min-text"><a href="#" '.$path.' class="text-muted">'.$cantidad.' Expedientes</a></div>
					  	</div>
				  	</div>
				</div>';		
	}

	function fichero_csv($parametro,$nombre = ""){
		unlink(PLUGINS.trim(" /files/").$nombre.".csv");
		fopen(PLUGINS.trim(" /files/").$nombre.".csv","w+");
		$nombre_archivo = PLUGINS.trim(" /files/").$nombre.'.csv';
		$contenido = $parametro;
		// Primero vamos a asegurarnos de que el archivo existe y es escribible.
		if (is_writable($nombre_archivo)) {
		    // En nuestro ejemplo estamos abriendo $nombre_archivo en modo de adición.
		    // El puntero al archivo está al final del archivo
		    // donde irá $contenido cuando usemos fwrite() sobre él.
		    if (!$gestor = fopen($nombre_archivo, 'a')) {
		         echo "No se puede abrir el archivo ($nombre_archivo)";
		         exit;
		    }
		    // Escribir $contenido a nuestro archivo abierto.
		    if (fwrite($gestor, $contenido) === FALSE) {
		        echo "No se puede escribir en el archivo ($nombre_archivo)";
		        exit;
		    }
		    //echo "Éxito, se escribió ($contenido) en el archivo ($nombre_archivo)";
		    fclose($gestor);
		} else {
		    echo "El archivo $nombre_archivo no es escribible";
		}
	}

	//Recojo el valor de donde copio y donde tengo que copiar
	function copia($dirOrigen, $dirDestino){
		//Creo el directorio destino

		mkdir($dirDestino, 0777, true);
		//abro el directorio origen

		if ($vcarga = opendir($dirOrigen)){
			while($file = readdir($vcarga)){
				if ($file != "." && $file != ".."){
					#echo "<b>$file</b>";
					if (!is_dir($dirOrigen.$file)){
						if(copy($dirOrigen.$file, $dirDestino.$file)){
					#		echo " COPIADO!";
						}else{
					#		echo " ERROR!";
						}
					}else{
					#	echo " — directorio — <br />";
						$this->copia($dirOrigen.$file."/", $dirDestino.$file."/");
					}
					#echo "<br />";
				}
			}
		closedir($vcarga);
		}
	}	

	function PlantillaDocumento($html, $titulo, $gestion_id, $papel = "carta"){

	 	global $con;
	 	global $c;
    			
		$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
		$nameqr = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".png";

		$urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;
		$urlfilqr = FILESAT.DS.$gestion_id.'/anexos/'.$name;
		$urlqr = UPLOADS.DS.'qr/'.$nameqr;

		$sadmin = new MSuper_admin;
		$sadmin->CreateSuper_admin("id", "6");

		$config = new MPlantilla_documento_configuracion;
		$config->CreatePlantilla_documento_configuracion("id", "1");


		$string = hash("sha256", $id.$_SESSION["usuario"].date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]); 
		$timestamp = "";
		$foot = "<div><div style='font-size:10px; float:left'>";

		$foot .= $pathp;

		$fpath = '<html><head></head><body>'.$timestamp;
		$lpath = $foot.'</body></html>';

		$html = utf8_decode($fpath.html_entity_decode($html).$lpath);
		
		$em = new MSuper_admin;
		$em->CreateSuper_admin("id", $_SESSION['id_empresa']);

		$encabezado = HOMEDIR.DS."app/plugins/thumbnails/".$em->GetEncabezado();
		$pie_pagina = HOMEDIR.DS."app/plugins/thumbnails/".$em->GetPie_pagina();


		$m_t 	= ($config->GetM_t() * 28) -100;
		$m_r	= $config->GetM_r() * 28;
		$m_b	= 100 - ($config->GetM_b() * 28);
		$m_l	= ($config->GetM_l() * 28) -20;
		$m_e_t	= 150 - ($config->GetM_e_t() * 28);
		$m_e_b	= $config->GetM_e_b() * 28;
		$m_p_t	= $config->GetM_p_t() * 28;
		$m_p_b	= $config->GetM_p_b() * 28;
		$fuente = $config->GetFuente();
		$tamano = $config->GetTamano();

		$html2 = '
					<html>
					<head>
					  <style>
						@font-face {
							font-family: "def_font";
							src: url('.HOMEDIR.DS.'app/views/assets/fonts/'.$fuente.');
						}
					    @page { margin: 150px 0px; font-size: '.$tamano.'px; font-family: "def_font", Arial; }
					    #header { position: fixed; top:-'.$m_e_t.'px; width:120%; height: 100px; background: url('.$encabezado.') no-repeat; background-size: contain; text-align: center; }
					    #footer { position: fixed; bottom: -130px; height: 110px; background: url('.$pie_pagina.') no-repeat; }
					    #content{margin: '.$m_t.'px '.$m_r.'px -'.$m_b.'px '.$m_l.'px; font-family: "def_font", Arial; }
					  </style>
					<body>
					  <div id="header">&nbsp;</div>
					  <div id="footer"><p class="page">&nbsp;</p></div>
					  <div id="content">
					   '.$html.'
					  </div>
					</body>
					</html>';

		#echo $html2;

		$dompdf = new DOMPDF();

		if ($papel == "carta") {
			$dompdf->set_paper('letter','');
			# code...
		}else{
			$dompdf->set_paper('legal', 'landscape');
		}
		$dompdf->load_html($html2);
		ini_set("memory_limit","32M"); 
		$dompdf->render();

		$pdf = $dompdf->output();

		if (file_put_contents($urlfile, $pdf)) {
			$car = new MGestion_anexos;
			$tot  = $car->ListarGestion_anexos("WHERE gestion_id = '".$gestion_id."'");

			$fol = $con->NumRows($tot);
			$fol += 1;
			$user_id = $_SESSION['usuario'];

			//base 64
			$base_file = '';
			$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);

			$base_file = base64_encode($data_base_file);			
			
			$con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','".$titulo.".pdf','".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."')");


			$id = $c->GetMaxIdTabla("gestion_anexos", "id");					

			$objecte = new MEvents_gestion;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
			$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"".$titulo."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "expdpc", $id);


			/* AQUI INICIA PROCESO DE FIRMA DIGITAL DEL DOCUMENTO*/
/*
*/
			$doc = new MGestion_anexos;
			$doc->CreateGestion_anexos("id", $id);


				
			$gaf = new MGestion_anexos_firmas;
			$gaf->InsertGestion_anexos_firmas($gestion_id, $doc->GetId(), 0, date("Y-m-d H:i:s"), $_SESSION['usuario'], $_SESSION['usuario'], "", "", "", "0", "", "");
				
				$query = $gaf->ListarGestion_anexos_firmas("where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '0' and gestion_id = '$gestion_id' and anexo_id='".$doc->GetId()."'");

				$row = $con->FetchAssoc($query);
				$idretorno = $row['id'];
				#FIN SOLICITUD DE FIRMA DEL DOCUMENTO		

				$fecha = date("Y-m-d");
				$fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
				date_modify($fecha_c, "+$diasmaxtoresponse day");//sumas los dias que te hacen falta.
				$fecha_vencimiento = date_format($fecha_c, "Y-m-d");//retornas la fecha en el formato que mas te guste.
				
				$objecte = new MEvents_gestion;

				$responsablea = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "p_nombre, p_apellido", $separador = " ");
				$usuario_permiso = $_SESSION['usuario'];
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Solicitúd de Revisión de Documento", "Se ha compartido un documento \"".$doc->GetNombre()."\" con el usuario ".$responsablea." para que sea revisado" , date("Y-m-d"), 0, date("H:i:s"), 0, $diasmaxtoresponse, 0, $fecha_vencimiento, 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usuario_permiso, "rdoc", $id_documento);

				$con->Query("insert into gestion_compartir (usuario_comparte, usuario_nuevo, gestion_id, fecha, type) VALUES ('".$_SESSION['usuario']."', '".$usuario_permiso_username."', '".$id_documento."', '".date("Y-m-d")."', '0')");

			echo $idretorno."@@Documento Exportado a Anexos";

		}

	}

	function rmDir_rf($carpeta)
    {
      foreach(glob($carpeta . "/*") as $archivos_carpeta){             
        if (is_dir($archivos_carpeta)){
          rmDir_rf($archivos_carpeta);
        } else {
        unlink($archivos_carpeta);
        }
      }
      rmdir($carpeta);
    }
    function EnviarSMS($telefono, $mensaje){

		$numero = "57".$telefono;

		$ch=curl_init();

		$post = array(
		'account' => SMSCLIENT, //número de usuario
		'apiKey' => SMSKEY, //clave API del usuario
		'token' => 'b226d0b5757c5cf6f9407b1a4efd3c68', // Token de usuario
		'toNumber' => $numero, //número de destino
		'sms' => $mensaje , // mensaje de texto
		'flash' => '0', //mensaje tipo flash
		'sendDate'=> time(), //fecha de envío del mensaje
		'isPriority' => 0, //mensaje prioritario
		'sc'=> '899991', //código corto para envío del mensaje de texto
		'request_dlvr_rcpt' => 0, //mensaje de texto con confirmación de entrega al celular
		);

		$url = "https://api101.hablame.co/api/sms/v2.1/send/"; //endPoint: Primario
		curl_setopt ($ch,CURLOPT_URL,$url) ;
		curl_setopt ($ch,CURLOPT_POST,1);
		curl_setopt ($ch,CURLOPT_POSTFIELDS, $post);
		curl_setopt ($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT ,3);
		curl_setopt ($ch,CURLOPT_TIMEOUT, 20);
		$response= curl_exec($ch);
		curl_close($ch);
		$response= json_decode($response ,true) ;

		//La respuesta estará alojada en la variable $response

		if ($response["status"]== '1x000' ){
			return "1";
		} else {
			return "0";
		}


    }

    function EncriptarPassword($pw){
		$conteo = 100;

		$clave = $pw;

		for ($i=0; $i < $conteo ; $i++) { 
			$clave = hash("sha256", $clave);
			# code...
		}

		return $clave;
	}

	function generateFormToken($form) {
	   	// generar token de forma aleatoria
	   	$token = md5(uniqid(microtime(), true));
	   	// generar fecha de generación del token
	   	$token_time = time();
	   	// escribir la información del token en sesión para poder
	   	// comprobar su validez cuando se reciba un token desde un formulario
	   	$_SESSION['csrf'][$form.'_token'] = array('token'=>$token, 'time'=>$token_time);; 
	   	
	   	return $token;
	}

	function verifyFormToken($form, $token, $delta_time=0) {
 
	   	// comprueba si hay un token registrado en sesión para el formulario
	   	if(!isset($_SESSION['csrf'][$form.'_token'])) {
	       return false;
	   	}
	 
	   	// compara el token recibido con el registrado en sesión
	   	if ($_SESSION['csrf'][$form.'_token']['token'] !== $token) {
	       return false;
	   	}
	 
	   	// si se indica un tiempo máximo de validez del ticket se compara la
	   	// fecha actual con la de generación del ticket
	   	if($delta_time > 0){
	    	$token_age = time() - $_SESSION['csrf'][$form.'_token']['time'];
	       	if($token_age >= $delta_time){
	      		return false;
	       	}
	   	}
	 
	   return true;
	}
}
?>