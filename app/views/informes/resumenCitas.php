<?

  $nombre = "reporte_".$_SESSION['usuario'];
  $vcampos_reporte = $_REQUEST["campos"];
  $campos_reporte = implode(',',$vcampos_reporte);
  $arr_campos = explode(",", $campos_reporte);

  $path = "";
  #$path .= " f_registro between '".$f_inicio."' AND '".$f_corte."' ";

  if($seccional != "V"){
      $path .= " AND seccional_siamm = '".$seccional."'";
  }

  if($ignorar != "NO"){
      $path .= " AND fecha_capacitacion != ''";
  }

  $str = "SELECT * FROM usuarios WHERE estado = '1' $path order by fecha_capacitacion";
  $query = $con->Query($str);

  $_SESSION['tmptxt'] = "rpw";

?>
<form action="/ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
  <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>
<script type="text/javascript">
  function ExportarExcel(id){
      $("#datos_a_enviar").val( $("<div>").append( $("#"+id).eq(0).clone()).html());
      $("#FormularioExportacion").submit();
  }
</script>
<div id="exportardocumento" style="padding:20px; background-color: #FFF;">
      <table class="table table-bordered">
        <tr>
          <td><b>Leyendas</b></td>
        </tr>
        <tr>
          <td class="bg-warning">Cuenta Vencida</td>
        </tr>
    </table>
   <br>
      <button class="btn btn-primary" onclick="ExportarExcel('divTablagestion')">
        Descargar Informe
         <!--<a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre.".csv" ?>" style="color:#FFF">Descargar Informe</a>-->
      </button>
    <br><br>
    <div id="divTablagestion">
    <table border='0' cellspacing='0' cellpadding='3' class='table table-striped table-bordered' id='Tablagestion' style="width:100%;">
      <thead>
        <tr>
            <th><b>#</b></th>
            <th>Usario</th>
            <th>Ciudad</th>
            <th>Teléfono</th>
            <th>Fecha de Registro</th>
            <th>Fecha de Capacitación</th>
            <th>Hora de Capacitación</th>
            <th>Fecha de Vencimiento</th>

        </tr>
      </thead>
      <tbody>
<?
      $i = 0;
      $j = 0;

      while($row = $con->FetchAssoc($query)){
  
          $i++;   
          
          $enviad_q = $con->Query("select count(*) as t from usuarios_seguimiento where usuario_seguimiento = '".$row['user_id']."'");         
          $enviado = $con->Result($enviad_q, 0, 't');
          $color_row = "";

          $fv = substr($row['f_caducidad'], 0, 10);

          if ($fv <= date("Y-m-d")) {
            $color_row = "bg-warning";
          }


          
          
          $enviad_q = $con->Query("select count(*) as t from notificaciones where user_id = '".$row['user_id']."'");
          $enviadot = $con->Result($enviad_q, 0, 't');
          
          $enviad_q = $con->Query("select count(*) as t from notificaciones where user_id = '".$row['user_id']."'  and  f_citacion between '".$f_inicio."' AND '".$f_corte."'");
          $enviado = $con->Result($enviad_q, 0, 't');
          
          $enviad_c = $con->Query("select sum(valor) as t from notificaciones where user_id = '".$row['user_id']."' and  f_citacion between '".$f_inicio."' AND '".$f_corte."'");
          $consumo = $con->Result($enviad_c, 0, 't');

          if ($consumo == "") {
            $consumo = 0;
          }
          
          $ultimo_movimiento = 0;

          $ultimo_pago_q = $con->Query("select max(fecha) as t from usuarios_seguimiento where username = '".$row['user_id']."' and tipo_seguimiento = '2'");
          $ultimo_pago = substr($con->Result($ultimo_pago_q, 0, 't'), 0, 10);

          $nombreu = $row['p_apellido']." ".$row['p_nombre'];
          echo '<tr class="'.$color_row.'">
                    <td class="'.$color_row.'">'.$i.'</td>
                    <td class="'.$color_row.'">'.$nombreu.'<br>'.$row['user_id'].'</td>
                    <td class="'.$color_row.'">'.$row['ciudad'].'<br>'.$row['seccional_siamm'].'</td>
                    <td class="'.$color_row.'">'.$row['telefono'].'</td>
                    <td class="'.$color_row.'">'.$row['f_registro'].'</td>
                    <td class="'.$color_row.'"><input type="date" class="form-control input-sm" value="'.$row['fecha_capacitacion'].'"  onchange="UpdateFechaCita(\''.$row['user_id'].'\', this.id)" id="el'.$row['a_i'].'" style="width:150px !important; height:35px;"></td>
                    <td class="'.$color_row.'"><input type="text" class="form-control input-sm" value="'.$row['hora_capacitacion'].'"  onblur="UpdateHoraCita(\''.$row['user_id'].'\', this.id)" id="elb'.$row['a_i'].'" style="width:100px !important;"></td>
                    <td class="'.$color_row.'">'.$fv.'</td>
                </tr>';
      }

?>      
      </tbody>
  </table>
      </div>
</div>
<script>
function UpdateFechaCita(username, who){

      var credito = $("#"+who).val();
      var URL = '/usuarios_seguimiento/updatefcita/';
      var str = "username="+username+"&actualizar="+credito;
      $.ajax({
          type: 'POST',
          url:  URL,
          data: str,
          success:function(msg){
              alert("Información del Usuario Actualizada");
              window.location.reload();
          }
      });   
  }


  function UpdateHoraCita(username, who){

      var credito = $("#"+who).val();
      var URL = '/usuarios_seguimiento/updatehrcita/';
      var str = "username="+username+"&actualizar="+credito;
      $.ajax({
          type: 'POST',
          url:  URL,
          data: str,
          success:function(msg){
              alert("Información del Usuario Actualizada");
              window.location.reload();
          }
      });   
  }

</script>
<?
  function Reemplaxoxy($str){

      $b = array("&aacute", "&eacute", "&iacute", "&oacute", "&uacute", "&ntilde", "&Aacute", "&Eacute", "&Iacute", "&Oacute", "&Uacute", "&Ntilde");
      $c = array("a", "e", "i", "o", "u", "n", "A", "E", "I", "O", "U", "N");

      $temp = str_replace($b, $c, $str);

      return strip_tags($temp);

  }

  function strpos_array($haystack, $needles) {
    if ( is_array($needles) ) {
        foreach ($needles as $str) {
            if ( is_array($str) ) {
                $pos = strpos_array($haystack, $str);
            } else {
                $pos = strpos($haystack, $str);
            }
            if ($pos !== FALSE) {
                return "1";
            }
        }
    } else {
        return strpos($haystack, $needles);
    }
}

?>