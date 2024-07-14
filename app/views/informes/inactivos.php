<?php 
    $usuario = $_SESSION['usuario'];
    $days = $dias;
    $fid = $folder;

    $days = $c->consultarlog() - $days;

    $d = new MCaratula;
    $query = $d->ProcesosInactivosDetalle($days, $fid, $usuario);

    $i = 0;
    while($row = $con->FetchAssoc($query)){
      $i++;
      
      $dx = new MCaratula;
      #print_r($row);
      $id_d = $row["proceso_id"];
      if($id_d != ""){
        $e = new MEvents;
        $e->CreateEvents("id", $row["max"]);
        
        $alog = $c->consultarlog();
        $resta = $e->GetDate() - $alog;
        $fecha = date("Y-m-d");
        $fecha_evento = $f->CalcularFecha($fecha, $resta, "+");
        $fecha_evento = $f->ObtenerFecha($fecha_evento);

        $dx->CreateCaratula('id', $id_d);
        
        if($dx->GetTit_demanda() != ""){
          if($dx->GetEst_proceso() == "ACTIVO"){
            echo "  <div class='bloque_inactivos'>
                  <div><a href='ver_demanda.php?id=".$dx->GetId()."&pro=".$dx->GetProceso_id()."'>".$dx->GetTit_demanda()."</a></div>
                  <div><b>Inactivo desde el:</b> ".$fecha_evento." </div>
                  <div><b>Ultima Actuacion:</b> ".$e->GetTitle()." </div>
                </div>";
          }
        }
      }

    }
    if($i == 0){
      echo "<div class='alert alert-info' style='width:80%'>No tienes procesos sin mover</div>";
    }

?>
<style>

  .bloque_inactivos{
    margin-left: 20px;
    margin-bottom: 7px;
  }
</style>