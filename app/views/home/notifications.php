<?
	global $f;
	global $c;
?>
<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/config.css'/>
<div id="container_mail_config">
<?
	$q_str = "SELECT * FROM alertas WHERE user_id = '".$_SESSION['usuario']."' group by log desc";
	$query = $con->Query($q_str);
?>
<div class="main_title_alertas">
  <div class="icon alertacolor del-alarma" style="float:left;" ></div>
  <div class="title_alertas">
    Tus Alertas
  </div>
</div>
	<?
    $aar = array( "1" => "rojo", 
                  "2" => "rojo", 
                  "6" => "verde", 
                  "7" => "azulclaro",
                  "10" => "verde", 
                  "11" => "amarillo", 
                  "14" => "azulclaro",
                  "16" => "rojo");
    $i = 0;
    echo "<div>";
    $j = 0;
		while($row = $con->FetchAssoc($query)){
      $path = "";
      $j++;
      if($i == "1"){
        $path = "style='border-top:none'";
      }		
			$lid = $con->Result($con->Query("select * from log where id='".$row["log"]."'"), 0, "fecha");	

      $add = "";
      if ($j == "1") {
        $add = "hoy";
      }

			echo '<div class="daybloq" '.$path.'><div class="title_alerta '.$add.'">'.$f->ObtenerFecha($lid).'</div>';

				$wa = "select * from alertas inner join tipos_alertas on tipos_alertas.alt = alertas.extra where log = '".$row["log"]."' and user_id='".$_SESSION['usuario']."'";
				$qwa = $con->Query($wa);

				while($rrt = $con->FetchArray($qwa)){
      			$i++;

            $filter= $rrt["nombre"];
            $lnid = $con->Result($con->Query("select * from log where id='".$row["log"]."'"), 0, "fecha");	
            $b=array( 
                      "#NOMUSUARIO#",
                      "#NOMDOCUMENTO#",
                      "#NUMRADICACION#",
                      "#NOMFORMULARIO",
                      "#NUMRADICACION#",
                      "#NOMSUSCRIPTOR#",
                      "#NOTIFICACION#",
                      "#NOMDOCUMENTO#",
                      "#TITULO_PROCESO#",
                      "#MAIL_REMITENTE#",
                      "#LEERMENSAJE#",
                      "#USERNAMEX#"
                    );

            $c=array( "",
                      "",
                      "",
                      "",
                      "",
                      "",
                      "",
                      "",
                      "<a href='".HOMEDIR.DS."correo/ver/".$bptahx[1]."/'><strong>$titulo</strong></a>",
                      "<a href='".HOMEDIR.DS."correo/veracuse/".$bptah[1].".1/'>Ver Mensaje</a>",
                      ""
                    );

          $filter=str_replace($b,$c,$filter);   

          $mark = "";
          $checked = "";
          $statusact = $aar[$rrt['type']];

          if($rrt["status"] == "2"){
            $checked = 'checked="checked"';
            $statusact = "azulfuerte";
          }

          echo "<div class='notification_bloq'>
                    <div class='notificationicon ".$statusact."'></div>
                    <div class='checkbox'><input type='checkbox' $checked onChange='ChangeStatusAlerta(\"".$rrt[0]."\")' id='act_".$rrt[0]."' ></div>
                    <div class='texto'>".$filter."</div>
                    <div class='clearb'></div>
                </div>";						

				}
        echo "</div>";
		}
    echo "</div>";
	?>
</div>
<div class="clear"></div>