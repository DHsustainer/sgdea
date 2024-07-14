<?
    $path = "";
    
    if($tenerencuenta == 'expediente'){
      $path .= " gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."' ";
    }else{
       $path .= " gestion_anexos.fecha between '".$f_inicio."' AND '".$f_corte."' ";
    }

    if($ciudad != "V" && $ciudad != "" && isset($ciudad)){
        $path .= " AND gestion.ciudad = '".$ciudad."'";
    }
    #$path .= " AND oficina = '".$oficina."'";
    if($oficina != "V" && $oficina != "" && isset($oficina)){
        $path .= " AND gestion.oficina = '".$oficina."'";
    }
    if($dependencia_destino != "V" && $dependencia_destino != "" && isset($dependencia_destino)){
        $path .= " AND gestion.dependencia_destino = '".$dependencia_destino."'";
    }
    if($id_dependencia_raiz != "V" && $id_dependencia_raiz != "" && isset($id_dependencia_raiz)){
        $path .= " AND gestion.id_dependencia_raiz = '".$id_dependencia_raiz."'";
    }
    if($tipo_documento != "V" && $tipo_documento != "" && isset($tipo_documento)){
        $path .= " AND gestion.tipo_documento = '".$tipo_documento."'";
    }

    if($tipologia != "V" && $tipologia != "" && isset($tipologia)){
        $path .= " AND gestion_anexos.tipologia = '".$tipologia."'";
    }
    if($estado_respuesta != "V" && $estado_respuesta != "" && isset($estado_respuesta)){

        $path .= " AND estado_respuesta = '".$estado_respuesta."'";
    }

    echo $str = "SELECT gestion_anexos.* FROM gestion_anexos inner join gestion on gestion.id = gestion_anexos.gestion_id WHERE $path  and gestion_anexos.estado = '1' order by nombre";

    $query = $con->Query($str);

    $nombre = "reporte_".$_SESSION['usuario'];
?>
<div style="margin:20px; padding:20px; background: #FFF">  
  <!--<input type="button" onClick="ExportarExcel('exportardocumento')" value="Exportar"> -->
  
  <div id="exportardocumento">
    <h3>INFORME DE DOCUMENTOS CARGADOS</h3>
    <br>
    <button class="btn btn-primary">
       <a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre.".csv" ?>" style="color:#FFF">Descargar Informe</a>
    </button>
    <br><br>
    <table border='1' cellspacing='0' cellpadding='3' class='tabla' id='Tablagestion' style="text-align: center">
      <thead>
        <tr>
          <td>Nombre</td>
          <td width="200px">Tipo Documental</td>
          <td width="100px">Expediente</td>
          <td width="90px">Fecha de Carga</td>
          <td width="200px">Cargado Por</td>
          <td width="100px;">Formato</td>
          <td width="70px">Peso</td>
          <td width="50px">Folios</td>
          <td width="50px">Origen</td>
          <td width="50px">Es Publico?</td>
        </tr>
      </thead>
      <tbody>
<?
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Nombre")).";";
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Tipo Documental")).";";
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Expediente")).";";
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Carga")).";";
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Cargado Por")).";";
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Formato")).";";
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Peso")).";";
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Folios")).";";
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Origen")).";";
      $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Es Publico")).";";
      $archivo_csv .= "\n"; 
  
      while($row = $con->FetchArray($query)){
        $l = new MGestion;
        $l->Creategestion('id', $row['gestion_id']);
        #echo $row['gestion_id']."-";

        #print_r($row);

        $ga = new MGestion_anexos;
        $ga->Creategestion_anexos('id', $row['0']);

        $GetNombre  = $c->GetDataFromTable("usuarios", "user_id", $ga->GetUser_id(), "p_nombre, p_apellido", $separador = " ");
        $GetTipologia    = $c->GetDataFromTable("dependencias_tipologias", "id", $ga->GetTipologia(), "tipologia", $separador = " ");
    
        $peso = round($ga->GetPeso() / 1024);
        $publico = ($ga->GetIs_publico() == "0")?"NO":"SI";
        $Origen = ($ga->GetIn_out() == "0")?"Salida":"Entrada";

        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($ga->GetNombre())).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetTipologia )).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetMin_rad() )).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($ga->GetFecha())).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetNombre)).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($ga->GetTypefile())).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($peso)).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($ga->GetCantidad())).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($ga->GetIn_out())).";";
        $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($publico)).";";
        $archivo_csv .= "\n";

        $url = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$ga->GetGestion_id()."/anexos/".$ga->GetUrl();
        $urle = HOMEDIR.DS.'gestion/ver/'.$l->GetId()."/";
?>            
        <tr id='r<?= $l->GetId() ?>' class='tblresult'> 
          <td><a href="<?= $url ?>" target="_blank"><?= $ga->GetNombre() ?></a></td>
          <td><?= $GetTipologia  ?></td>
          <td><a href="<?= $urle ?>" target="_blank"><?= $l->GetMin_rad() ?></a></td>
          <td><?= $ga->GetFecha() ?></td>
          <td><?= $GetNombre ?></td>
          <td><?= $ga->GetTypefile() ?></td>
          <td><?= $peso ?> Kb</td>
          <td><?= $ga->GetCantidad() ?></td>
          <td><?= $ga->GetIn_out() ?></td>
          <td><?= $publico ?></td>
        </tr>
<?
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
