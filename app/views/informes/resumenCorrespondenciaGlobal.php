<?

  $nombre = "reporte_".$_SESSION['usuario'];
  $vcampos_reporte = $_REQUEST["campos"];
  $campos_reporte = implode(',',$vcampos_reporte);
  $arr_campos = explode(",", $campos_reporte);

  $path = "";
  $path .= " notificaciones.f_citacion between '".$f_inicio."' AND '".$f_corte."' ";

  if($seccional != "V"){
      $path .= " AND usuarios.seccional_siamm = '".$seccional."'";
  }

   $str = "SELECT * FROM notificaciones inner join usuarios on usuarios.user_id = notificaciones.user_id WHERE $path group by notificaciones.user_id";
  $query = $con->Query($str);

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
   <br>
      <button class="btn btn-primary" onclick="ExportarExcel('divTablagestion')">
        Descargar Informe
         <!--<a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre.".csv" ?>" style="color:#FFF">Descargar Informe</a>-->
      </button>
    <br><br>
    <div id="divTablagestion">
    <table border='0' cellspacing='0' cellpadding='3' class='table table-striped' id='Tablagestion' style="width:100%;">
      <thead>
        <tr>
            <th><b>#</b></th>
            <th>Usario</th>
            <th>Ciudad</th>
            <th>E-mail</th>
            <th>Teléfono</th>
            <th>Último Inicio de sesión</th>
            <th>Correspondencia Enviada</th>
        </tr>
      </thead>
      <tbody>
<?
      $i = 0;
      $j = 0;

      while($row = $con->FetchAssoc($query)){
  
          $i++;   
          
          $enviad_q = $con->Query("select count(*) as t from notificaciones where user_id = '".$row['user_id']."'");
          $enviado = $con->Result($enviad_q, 0, 't');
          $ultimo_movimiento = 0;

          echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['p_nombre'].' '.$row['p_apellido'].'</td>
                    <td>'.$row['ciudad'].'</td>
                    <td>'.$row['user_id'].'</td>
                    <td>'.$row['telefono'].'</td>
                    <td>'.$row['lastlogin'].'</td>
                    <td>'.$enviado.'</td>
                </tr>';
      }

?>      
      </tbody>
  </table>
      </div>
</div>
<script>
  $(document).ready(function() {
    $('#Tablagestion tr.tblresult:not([th]):odd').addClass('par');
    $('#Tablagestion tr.tblresult:not([th]):even').addClass('impar');  
  }); 
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