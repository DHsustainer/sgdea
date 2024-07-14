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

  $str = "SELECT * FROM usuarios WHERE estado = '1' $path order by p_apellido";
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
            <th>Correos<br>Enviados</th>
            <th>Fecha de Registro</th>
            <th>Fecha de Vencimiento</th>
            <th>Último<br>Pago Realizado</th>
            <th></th>
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
                    <td class="'.$color_row.'">'.$enviado.'</td>
                    <td class="'.$color_row.'">'.$row['f_registro'].'</td>
                    <td class="'.$color_row.'">'.$fv.'</td>
                    <td class="'.$color_row.'">'.$ultimo_pago.'</td>
                    <td class="'.$color_row.'" style="text-align:center">
                        <button class="btn btn-warning btn-sm" style="margin-top:5px" onclick="LoadModal(\'large\', \'Historial de Pagos del Usuario\', \'/usuarios_seguimiento/vermovimientosrenovaciones/'.$row['user_id'].'/\')">
                            Detalle de Pagos
                        </button><br>
                    </td>
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

  function LoadModal(modal,  titulo, enlace){

     if (modal == "large") {
        $("#myLargeModalLabel").html(titulo);
     }else{
        $("#myRegularModalLabel").html(titulo);
     }

     $.ajax({
        type: 'POST',
        url: enlace,
        success:function(msg){
            if (modal == "large") {
                $("#myLargeModalBody").html(msg);
                $("#mylargemodalbtn").click();
            }else{
                $("#myRegularModalBody").html(msg);
                $("#myregularmodalbtn").click();
            }
            $('input').attr('autocomplete','off');
         }
     });
  }

  function GuardarSeguimento(){

      var URL = '/usuarios_seguimiento/registrarvencimiento/';
      var str = $("#formusuarios_seguimiento").serialize();

      $.ajax({
          type: 'POST',
          url:  URL,
          data: str,
          success:function(msg){
              alert("Registros Creado");
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

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"></h4> </div>
                    <div class="modal-body" id="myModalBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Button trigger modal -->

        <!-- sample modal content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel"></h4> </div>
                    <div class="modal-body" id="myLargeModalBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div id="myRegularModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myRegularModalLabel"></h4> </div>
                    <div class="modal-body" id="myRegularModalBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <span data-toggle="modal" data-target=".bs-example-modal-lg" id="mylargemodalbtn"></span>
        <span data-toggle="modal" data-target="#myRegularModal"  id="myregularmodalbtn" ></span>