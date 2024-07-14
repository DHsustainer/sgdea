<?

  $nombre = "reporte_".$_SESSION['usuario'];
  $vcampos_reporte = $_REQUEST["campos"];
  $campos_reporte = implode(',',$vcampos_reporte);
  $arr_campos = explode(",", $campos_reporte);

  $path = "";
  $path .= " fecha_registro between '".$f_inicio."' AND '".$f_corte."' ";
  if($ciudad != "V" && $ciudad != "" && isset($ciudad)){
      $path .= " AND ciudad = '".$ciudad."'";
  }
  #$path .= " AND oficina = '".$oficina."'";
  if($oficina != "V" && $oficina != "" && isset($oficina)){
      $path .= " AND oficina = '".$oficina."'";
  }
  if($dependencia_destino != "V" && $dependencia_destino != "" && isset($dependencia_destino)){
      $path .= " AND dependencia_destino = '".$dependencia_destino."'";
  }
  if($nombre_destino != "V" && $nombre_destino != "" && isset($nombre_destino)){
      $path .= " AND nombre_destino = '".$nombre_destino."'";
  }
  if($id_dependencia_raiz != "V" && $id_dependencia_raiz != "" && isset($id_dependencia_raiz)){
      $path .= " AND id_dependencia_raiz = '".$id_dependencia_raiz."'";
  }
  if($tipo_documento != "V" && $tipo_documento != "" && isset($tipo_documento)){
      $path .= " AND tipo_documento = '".$tipo_documento."'";
  }

/*
  $path .= " AND ciudad = '".$ciudad."'";
  $path .= " AND oficina = '".$oficina."'";
  $path .= " AND estado_solicitud = '".$estado_solicitud."'";
  $path .= " AND estado_respuesta = '".$estado_respuesta."'";
  $path .= " AND rweb = '".$rweb."'";
*/
  
  $str = "SELECT * FROM gestion WHERE $path";
  $base = base64_encode($str);
  
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
<div id="exportardocumento" style="padding:20px;">
   <br>
      <button class="btn btn-primary" onclick="ExportarExcel('divTablagestion')">
        Descargar Informe
         <!--<a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre.".csv" ?>" style="color:#FFF">Descargar Informe</a>-->
      </button>
      <a href="/informes/corregirpqr/<?= $base ?>/" target="_blank" class="btn btn-primary">CORREGIR ERRORES</a>
    <br><br>
    <div id="divTablagestion">
    <table border='1' cellspacing='0' cellpadding='3' class='tabla' id='Tablagestion' style="width:auto">
      <thead>
        <tr class='encabezado'>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Número de Radicación</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Fecha de Radicación</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Peticionario</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Tipo de Petición</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Asunto</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Último Tramite Realizado</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Fecha Último Tramite</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Respuesta al Peticionario</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Fecha de Respuesta</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Observaciones</th>
        </tr>
<?
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Número de Radicación")).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Radicación")).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Peticionario")).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Tipo de Petición")).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Asunto")).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Último Tramite Realizado")).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha Último Tramite")).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Respuesta al Peticionario")).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Respuesta")).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Observaciones")).";";
        $archivo_csv .= "\n";
?>
        </tr>
      </thead>
      <tbody>
<?
  
      $ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
      $ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");

      $i = 0;
      $j = 0;

      while($row = $con->FetchAssoc($query)){
          $i++;   
          $l = new MGestion;
          $l->Creategestion('id', $row[id]);

          if ($l->GetMin_rad() != "") {

            $GetTipo_documento      = $c->GetDataFromTable("dependencias", "id", $l->GetTipo_documento(), "nombre", $separador = " ");
            $GetSuscriptor_id       = $c->GetDataFromTable("suscriptores_contactos", "id", $l->GetSuscriptor_id(), "nombre", $separador = " ");
            $subserie = $GetTipo_documento;

            $doc = $con->Query("Select id, nombre, tipologia, fecha from gestion_anexos where gestion_id = '".$l->GetId()."' and estado = '1' order by id desc limit 0, 1");
            $ddoc = $con->FetchAssoc($doc);

            $tip = "";
            $rpet = "";
            $frep = "";

            if ($ddoc['tipologia'] != "0") {
                $tipod = $c->GetDataFromTable("dependencias_tipologias", "id", $ddoc['tipologia'], "tipologia", $separador = " ");
                $nombredoc = $tipod;
            }else{
                $nombredoc = substr($ddoc['nombre'], 0, -4);
            }

            $foo = strtolower($nombredoc);
            $vector = array('respuesta', 'Comunicado', 'Notificacion','Convocatoria', 'Despacho comisorio');
            $val = strpos_array($foo, $vector);

            if ($val == "1") {
                $rpet = $nombredoc;
                $frep = $ddoc['fecha'];
            }

            echo "<tr>";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($l->GetMin_rad()))).";";
            echo "<td>".$l->GetMin_rad()."</td>";
      
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($l->GetF_recibido()))).";";
            echo "<td>".$l->GetF_recibido()."</td>";

            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($GetSuscriptor_id))).";";
            echo "<td>".$GetSuscriptor_id."</td>";

            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($subserie))).";";
            echo "<td>".$subserie."</td>";
            
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($l->GetObservacion()))).";";
            echo "<td>".$l->GetObservacion()."</td>";

            echo "<td>".$nombredoc."</td>";
            echo "<td>".$ddoc['fecha']."</td>";
            echo "<td>".$rpet."</td>";
            echo "<td>".$frep."</td>";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($nombredoc))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($ddoc['fecha']))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($rpet))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($frep))).";";

            if ($l->GetObservacion2() == "<br>--<br>" || $l->GetObservacion2() == "") {
                $archivo_csv .= ";";
            }else{
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy(trim($l->GetObservacion2())))).";";
            }
            
            echo "<td>".$l->GetObservacion2()."</td>";

            $archivo_csv .= "\n";
            echo "</tr>";
          }
      }

      $f->fichero_csv($archivo_csv,$nombre);

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