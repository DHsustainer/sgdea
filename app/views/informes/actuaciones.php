<?
  $id = $folder; 
  $pid = $proceso;

?>

<div id="cargar_listas_demandas" style="min-height:450px">
  <input type="button" onClick="ExportarExcel('exportar_procesos')" value="Exportar a Excel">
  <br><br>
  <div id="exportar_procesos">
    <style>

      #list_procesos{
        width: 50%;
        float: left;
        min-height: 450px;
        max-height: 600px;
        height: 450px;
        margin-bottom: 50px;
        overflow-y: auto; 
      }
      #list_actuaciones{
        width: 49%;
        float: left;
      }
      #list_actuaciones .title, #list_actuaciones .title{
        line-height: 21px;
        height: 21px;
        background-color: #585858;
      }
      .nomb_actuacion{
        width: 80%;
        float: left;
      }
      .date_actuacion{
        width: 20%;
        float: left;
      }
      ul#lista_procesos {
        list-style: none;
        margin: 0px;
        padding: 0px;
        max-height: 450px;
        border: 1px solid #D9DADE;
        background: #FFF;
      }
      ul#lista_procesos li.titulo{
        
        line-height: 27px;
        height: 27px;
        font-size: 12px;
        border-bottom:1px solid #D9DADE;
        padding-left: 13px;
        background: #FFF;
      }
      ul#lista_procesos li.titulo.active, ul#lista_procesos li.titulo.active:hover{
        
        background: #009CDE URL(<?= ASSETS.DS.'images/white_spot.png'?>) no-repeat;
        background-position: right;
        color: #FFF;
      }

      ul#lista_procesos li.titulo:hover{
        background: #EBEAEF;
        cursor: pointer;

      }
      #list_carga{
        list-style: none;
        background: #fFF;
        height: 450px;
        padding: 0px;
        margin: 0px;
      }
      #list_carga li{
        line-height: 27px;
        min-height: 27px;
        font-size: 12px;
        border-bottom:1px solid #D9DADE;
        padding-left: 5px;
      }
      .listaactuaciones{
        display: none;
      }
    </style>

    <div id='list_procesos' class="scrollable">
<?
    if($pid == ""){
        # TODAS LAS ACTUACIONES
        $q_str_folderx = "select * from folder where user_id = '".$_SESSION["usuario"]."' and estado = 1";
        $query_folderx = $con->Query($q_str_folderx);
        while($row = $con->FetchArray($query_folderx)){
            $id = $row["id"];

            $q_str_folder= "select * from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$id."'";
            $query_folder = $con->Query($q_str_folder);
            $total_rows = $con->NumRows($query_folder);
            echo '<div class="title">Procesos en la carpeta: '.$row["nom"].'</div>';
            echo '<ul id="lista_procesos" class="scrollable">';
            for ($i=0 ; $i<$total_rows ; $i++){

              $q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $i, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."' and est_proceso = 'ACTIVO'";
              $queryx = $con->Query($q_str);
              $pid = $con->Result($queryx, 0, "id");

              $d = new MCaratula;
              $d->CreateCaratula('id', $pid);
              if ($d->GetEst_proceso() == "ACTIVO") {
                $q_str = "select * from actuaciones where user_id = '".$_SESSION['usuario']."' and proceso_id = '".$pid."' order by fecha";
                $query_actuaciones = $con->Query($q_str);
                echo '  <li class="titulo" onClick="ViewList(\''.$d->GetId().'\')" id="ls'.$d->GetId().'">'.$d->GetTit_demanda().'
                          <ul id="pr'.$d->GetId().'" class="listaactuaciones">';

                      $xx = 0;
                      while($rowx = $con->FetchAssoc($query_actuaciones)){
                        $xx++;
                        echo "<li>";
                          echo "<div class='nomb_actuacion'>".$rowx["act"]."</div>";
                          echo "<div class='date_actuacion'>".$rowx["fecha"]."</div>";
                        echo "</li>";
                      } 
                      if($xx == 0){
                        echo "<li><div class='alert alert-info'>No se han registado actuaciones en este proceso</div></li>";
                      }
                echo '    </ul>
                        </li>';
              }
            }
                echo ' </ul>';
        }

    }else{
      if($pid == "*"){
        # TODAS LAS ACTUACIONES DE UNA CARPETA
            $q_str_folder= "select * from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$id."'";
            $query_folder = $con->Query($q_str_folder);
            $total_rows = $con->NumRows($query_folder);
            echo '<script>
                      $("#titlefolder").html("Procesos en la carpeta: "+$("#carpetasagenda option:selected").text());
                  </script>';
            echo '<div class="title" id="titlefolder"></div>';
            echo '<ul id="lista_procesos" class="scrollable">';
            for ($i=0 ; $i<$total_rows ; $i++){

              $q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $i, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."' and est_proceso = 'ACTIVO'";
              $queryx = $con->Query($q_str);
              $pid = $con->Result($queryx, 0, "id");

              $d = new MCaratula;
              $d->CreateCaratula('id', $pid);
              if ($d->GetEst_proceso() == "ACTIVO") {
                $q_str = "select * from actuaciones where user_id = '".$_SESSION['usuario']."' and proceso_id = '".$pid."' order by fecha";
                $query_actuaciones = $con->Query($q_str);
                echo '  <li class="titulo" onClick="ViewList(\''.$d->GetId().'\')" id="ls'.$d->GetId().'">'.$d->GetTit_demanda().'
                          <ul id="pr'.$d->GetId().'" class="listaactuaciones">';

                      $xx = 0;
                      while($rowx = $con->FetchAssoc($query_actuaciones)){
                        $xx++;
                        echo "<li>";
                          echo "<div class='nomb_actuacion'>".$rowx["act"]."</div>";
                          echo "<div class='date_actuacion'>".$rowx["fecha"]."</div>";
                        echo "</li>";
                      } 
                      if($xx == 0){
                        echo "<li><div class='alert alert-info'>No se han registado actuaciones en este proceso</div></li>";
                      }
                echo '    </ul>
                        </li>';
              }
            }
                echo ' </ul>';
      }else{
        #ACTUACIONES DE UN PROCESO EN PARTICULAR
        $pidx = $pid;
          $q_str_folder= "select * from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$id."'";
          $query_folder = $con->Query($q_str_folder);
          $total_rows = $con->NumRows($query_folder);
          echo '<script>
                    $("#titlefolder").html("Procesos en la carpeta: "+$("#carpetasagenda option:selected").text());
                </script>';
          echo '<div class="title" id="titlefolder"></div>';
          echo '<ul id="lista_procesos" class="scrollable">';
          for ($i=0 ; $i<$total_rows ; $i++){

            $q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $i, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."' and est_proceso = 'ACTIVO'";
            $queryx = $con->Query($q_str);
            $pid = $con->Result($queryx, 0, "id");

            $d = new MCaratula;
            $d->CreateCaratula('id', $pid);
            if ($d->GetEst_proceso() == "ACTIVO") {
              $q_str = "select * from actuaciones where user_id = '".$_SESSION['usuario']."' and proceso_id = '".$pid."' order by fecha";
              $query_actuaciones = $con->Query($q_str);
              echo '  <li class="titulo" onClick="ViewList(\''.$d->GetId().'\')" id="ls'.$d->GetId().'">'.$d->GetTit_demanda().'
                        <ul id="pr'.$d->GetId().'" class="listaactuaciones">';

                    $xx = 0;
                    while($rowx = $con->FetchAssoc($query_actuaciones)){
                      $xx++;
                      echo "<li>";
                        echo "<div class='nomb_actuacion'>".$rowx["act"]."</div>";
                        echo "<div class='date_actuacion'>".$rowx["fecha"]."</div>";
                      echo "</li>";
                    } 
                    if($xx == 0){
                      echo "<li><div class='alert alert-info'>No se han registado actuaciones en este proceso</div></li>";
                    }
              echo '    </ul>
                      </li>';
            }
          }
              echo ' </ul>';
              echo '<script>
                      ViewList("'.$pidx.'");
                    </script>';
      }       
      
    } 
?>
      </div>
      <div id="list_actuaciones">
        <div class="title">
          <div class='nomb_actuacion'>Actuacion</div>
          <div class='date_actuacion'>Fecha</div>
        </div>
        <ul id="list_carga">
          <div class="alert alert-info">Seleccione un proceso para ver sus actuaciones</div>
        </ul>

      </div>
    </div>
</div>
<style>
  
  .adddx:hover{
    background-color: #8BA7C9;
    cursor: pointer;
    color:#FFF;

  }
</style>
 <script>
$(document).ready(function() {
  $('#tablaactuaciones tr.adddx:not([th]):odd').addClass('par');
  $('#tablaactuaciones tr.adddx:not([th]):even').addClass('impar');  


  //$('td.addd:eq(1)')            //Obtiene cada celda que contiene Enrique
   //.parent()                   //Obtiene su padre
   //.find('td.addd:eq(1)')           //Encuentra dentro del padre la segunda celda
  // .css("background-color", "#F00");      //Añade la Clase destacado a esa celda
  // .end()                      //Finaliza el find()anterior para poder realizar otro volviendo al padre
   //.find('td:eq(2)')           //Encuentra dentro del padre la tercera celda
   //.addClass('destacado');     //Añade la clase "destacado" a esa celda
  
  //$('tr.adddx:td:eq(2):odd').addClass('impar');

  

  //$("#tablaactuaciones td:eq(1)");

}); 

function ViewList(id){
  var st = $("#pr"+id).html();
  $("#list_carga").html(st);
  $('#lista_procesos li').removeClass('active');
  $("#ls"+id).addClass('active');
}
</script>
