<?

  $nombre = "reporte_".$_SESSION['usuario'];
  $vcampos_reporte = $_REQUEST["campos"];
  $campos_reporte = implode(',',$vcampos_reporte);
  $arr_campos = explode(",", $campos_reporte);

  $path = "";
  $path .= " n.f_citacion between '".$f_inicio."' AND '".$f_corte."' ";
  if($nombre_destino != "V" && $nombre_destino != "" && isset($nombre_destino)){
      $path .= " AND g.nombre_destino = '".$nombre_destino."'";
  }
  if($ciudad != "V" && $ciudad != "" && isset($ciudad)){
      $path .= " AND g.ciudad = '".$ciudad."'";
  }
  #$path .= " AND oficina = '".$oficina."'";
  if($oficina != "V" && $oficina != "" && isset($oficina)){
      $path .= " AND g.oficina = '".$oficina."'";
  }
  /*
  if($dependencia_destino != "V" && $dependencia_destino != "" && isset($dependencia_destino)){
      $path .= " AND g.dependencia_destino = '".$dependencia_destino."'";
  }
  if($id_dependencia_raiz != "V" && $id_dependencia_raiz != "" && isset($id_dependencia_raiz)){
      $path .= " AND g.id_dependencia_raiz = '".$id_dependencia_raiz."'";
  }
  if($tipo_documento != "V" && $tipo_documento != "" && isset($tipo_documento)){
      $path .= " AND g.tipo_documento = '".$tipo_documento."'";
  }
  */
  if($suscriptor_id != "" && isset($suscriptor_id)){
      $path .= " AND g.suscriptor_id = '".$suscriptor_id."'";
  }

  if($estadoc != "V" && isset($estadoc)){
      $path .= " AND n.is_certificada = '".$estadoc."'";
  }
  
  $str = "SELECT * FROM gestion as g inner join notificaciones as n on n.proceso_id = g.id  WHERE $path";
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
<div id="exportardocumento" style="padding:20px; background-color: #FFF;">
   <br>
      <button class="btn btn-primary" onclick="ExportarExcel('divTablagestion')">
        Descargar Informe
         <!--<a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre.".csv" ?>" style="color:#FFF">Descargar Informe</a>-->
      </button>
    <br><br>
    <div id="divTablagestion">
    <table border='0' cellspacing='0' cellpadding='3' class='table table-striped' id='Tablagestion' style="width:auto">
      <thead>
        <tr>
            <th><b>#</b></th>
            <th>Tipo Notificacion</th>
            <th>Num. Guia</th>
            <th>Fecha</th>
            <th>Demandante </th>
            <th>Num. Radicado </th>
            <th>Juzgado</th>
            <th>Demandado</th>
            <th>Notificado </th>
            <th>Direccion</th>
            <th>Ciudad </th>
            <th>Estado </th>
            <th>Num. Obligacion</th>
            <th>Valor</th>
            <th>Certificado</th>
            
        </tr>
<?
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("#")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Tipo Notificacion")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Num. Guia")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Demandante ")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Num. Radicado ")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Juzgado Radicado ")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Demandado")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Notificado ")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Direccion")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Ciudad ")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Estado ")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Num. Obligacion")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Observacion")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Usuario")).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Valor")).";";
            $archivo_csv .= "\n";
?>
      </thead>
      <tbody>
<?
  
      $ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
      $ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");

      $i = 0;
      $j = 0;

      $estadon = array("0" =>"Pendiente Por Validar","-1" =>"Servicios Anulado por Usuario","1" =>"Servicio Validado Pendiente a Entrega","2" =>"Entrega Efectiva","3" =>"Devolucion");


      while($row = $con->FetchAssoc($query)){
          $i++;   
          $l = new MGestion;
          $l->Creategestion('id', $row[proceso_id]);

          $d = new MSuscriptores_contactos;
          $d->CreateSuscriptores_contactos("id", $row['id_demandado']);
          $dd = new MSuscriptores_contactos_direccion;
          $dd->CreateSuscriptores_contactos_direccion("id_contacto", $row['id_demandado']);

          $remite = $con->Query("SELECT nombre from suscriptores_contactos as sc inner join gestion_suscriptores as gs on gs.id_suscriptor = sc.id where gs.id_gestion = '".$l->GetId()."' and sc.type in ('1', '29') ");

          $dremite = $con->FetchAssoc($remite);

          $demandado = $con->Query("SELECT nombre from suscriptores_contactos as sc inner join gestion_suscriptores as gs on gs.id_suscriptor = sc.id where gs.id_gestion = '".$l->GetId()."' and sc.type = '27' ");

          $ddemandado = $con->FetchAssoc($demandado);
          
          $link = 'https://s.siammservice.com/a/hoja_certificacionc.php?id='.$row['guia_id'];
          $certificado = "";

          if ($row['is_certificada'] != "1") {
            $certificado = '<a href="'.$link.'" class="btn btn-info" target="_blank">Ver Certificado</a>';
          }

          if ($l->GetMin_rad() != "") {
            echo '<tr>
                      <td>'.$i.'</td>
                      <td>'.$l->GetCampot5().'</td>
                      <td>'.$row['guia_id'].'</td>
                      <td>'.$row['f_citacion'].'</td>
                      <td>'.$dremite['nombre'].'</td>
                      <td>'.$row['radicado'].'</td>
                      <td>'.$l->GetCampot1().'</td>
                      <td>'.$ddemandado['nombre'].'</td>
                      <td>'.$d->GetNombre().' </td>
                      <td>'.$row['direccion'].'</td>
                      <td>'.$dd->GetCiudad().'</td>
                      <td>'.$estadon[$row['is_certificada']].'</td>
                      <td>'.$l->GetCampot10().'</td>
                      <td>'.$row['valor'].'</td>
                      <td>'.$certificado.'</td>                      
                  </tr>';
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($i))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($l->GetCampot5()))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($row['guia_id']))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($row['f_citacion']))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($dremite['nombre']))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($row['radicado']))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($l->GetCampot1()))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($ddemandado['nombre']))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($d->GetNombre()))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($dd->GetDireccion()))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($dd->GetCiudad()))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($estadon[$row['is_certificada']]))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($l->GetCampot10()))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($row['valor']))).";";
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(Reemplaxoxy($certificado))).";";
/*
*/            
            $archivo_csv .= "\n";
            
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