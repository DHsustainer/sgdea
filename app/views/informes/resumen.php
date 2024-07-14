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
    if($prioridad != "V" && $prioridad != "" && isset($prioridad)){
        $path .= " AND prioridad = '".$prioridad."'";
    }
    if($estado_solicitud != "V" && $estado_solicitud != "" && isset($estado_solicitud)){
        $path .= " AND estado_personalizado = '".$estado_solicitud."'";
    }
    if($estado_respuesta != "V" && $estado_respuesta != "" && isset($estado_respuesta)){

        $path .= " AND estado_respuesta = '".$estado_respuesta."'";
    }
    if($suscriptor_id != "N" && isset($suscriptor_id)){
        
        $path .= " AND suscriptor_id = '".$suscriptor_id."'";

    }
    if($rweb != "V" && $rweb != "" && isset($rweb)){
        $path .= " AND rweb = '".$rweb."'";
    }
    $str = "SELECT * FROM gestion WHERE $path";

    $query = $con->Query($str);
?>
<div id="exportardocumento" style="padding:20px;">
   <br>
      <button class="btn btn-primary">
         <a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre.".csv" ?>" style="color:#FFF">Descargar Informe</a>
      </button>
  <br><br>
    <table border='0' cellspacing='0' cellpadding='3' class='tabla' id='Tablagestion' style="width:auto">
      <thead>
        <tr class='encabezado'>
<?
         if (in_array("coltitulo", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Asunto")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Asunto</th>";
         }
         if (in_array("colrade", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPORADEXTERNO)).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPORADEXTERNO."</th>";
         }
         if (in_array("colradmin", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPORADRAPIDO)).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPORADRAPIDO."</th>";
         }
         if (in_array("colfullrad", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOIDRAD)).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOIDRAD."</th>";
         }
         if (in_array("colfreg", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Registro")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Fecha de Registro</th>";
         }
         if (in_array("colfrec", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Recibido")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Fecha de Recibido</th>";
         }
         if (in_array("colciudad", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Ciudad")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Ciudad</th>";
         }
         if (in_array("coloficina", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Oficina")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Oficina</th>";
         }
         if (in_array("colarea", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOAREADETRABAJO)).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOAREADETRABAJO."</th>";
         }
         if (in_array("colresponsable", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Usuario Responsable")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Usuario Responsable</th>";
         }
         if (in_array("colserie", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Serie Documental")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Serie Documental</th>";
         }
         if (in_array("colsubserie", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Sub-Serie documental")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Sub-Serie documental</th>";
         }
         if (in_array("colnombreradica", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Nombre de Quien Radica")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Nombre de Quien Radica</th>";
         }
         if (in_array("colsuscriptor", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Suscriptor")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Suscriptor</th>";
         }
         if (in_array("colfolios", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("# Folios")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'># Folios</th>";
         }
         if (in_array("colfvencimiento", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Vencimiento")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Fecha de Vencimiento</th>";
         }
         if (in_array("colrespuesta", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Estado de Respuesta")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Estado de Respuesta</th>";
         }
         if (in_array("colfrespuesta", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Respuesta")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Fecha de Respuesta</th>";
         }
         if (in_array("colestado", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Estado del Expediente")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Estado del Expediente</th>";
         }
         if (in_array("colrobservacion", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Observacion")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Observacion</th>";
         }
         if (in_array("coluregistra", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Usuario Que Registra")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Usuario Que Registra</th>";
         }
         if (in_array("colubicacion", $arr_campos)) {
            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Ubicación")).";";
            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Ubicación</th>";
         }
         if (CAMPOT1 != ""){
           if (in_array(CAMPOT1, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT1)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT1."</th>";
           }
         }
         if (CAMPOT2 != ""){
           if (in_array(CAMPOT2, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT2)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT2."</th>";
           }
         }
         if (CAMPOT3 != ""){
           if (in_array(CAMPOT3, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT3)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT3."</th>";
           }
         }
         if (CAMPOT4 != ""){
           if (in_array(CAMPOT4, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT4)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT4."</th>";
           }
         }
         if (CAMPOT5 != ""){
           if (in_array(CAMPOT5, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT5)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT5."</th>";
           }
         }
         if (CAMPOT6 != ""){
           if (in_array(CAMPOT6, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT6)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT6."</th>";
           }
         }
         if (CAMPOT7 != ""){
           if (in_array(CAMPOT7, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT7)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT7."</th>";
           }
         }
          if (CAMPOT8 != ""){
           if (in_array(CAMPOT8, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT8)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT8."</th>";
           }
         }
        if (CAMPOT9 != ""){
           if (in_array(CAMPOT9, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT9)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT9."</th>";
           }
         }
         if (CAMPOT10 != ""){
           if (in_array(CAMPOT10, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT10)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT10."</th>";
           }
         }
          if (CAMPOT11 != ""){
           if (in_array(CAMPOT11, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT11)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT11."</th>";
           }
         }
          if (CAMPOT12 != ""){
           if (in_array(CAMPOT12, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT12)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT12."</th>";
           }
         }
           if (CAMPOT14 != ""){
           if (in_array(CAMPOT14, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT14)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT14."</th>";
           }
        }
        if (CAMPOT15 != ""){
           if (in_array(CAMPOT15, $arr_campos)) {
              $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOT15)).";";
              echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOT15."</th>";
           }
         }
         $archivo_csv .= "\n";
?>
        </tr>
      </thead>
      <tbody>
<?
  
      $ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
      $ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");

      while($row = $con->FetchAssoc($query)){
      
         $l = new MGestion;
         $l->Creategestion('id', $row[id]);

         $GetTipo_documento      = $c->GetDataFromTable("dependencias", "id", $l->GetTipo_documento(), "nombre", $separador = " ");
         $GetDependencia_destino = $c->GetDataFromTable("areas", "id", $l->GetDependencia_destino(), "nombre", $separador = " ");
         $GetNombre_destino      = $c->GetDataFromTable("usuarios", "a_i", $l->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");
         $GetPrioridad           = $ar[$l->GetPrioridad()];
         $GetEstado_solicitud    = $c->GetDataFromTable("estados_gestion", "id", $l->GetEstado_personalizado(), "nombre", $separador = " ");
         $GetSuscriptor_id       = $c->GetDataFromTable("suscriptores_contactos", "id", $l->GetSuscriptor_id(), "nombre", $separador = " ");
         $GetCiudad              = $c->GetDataFromTable("city", "Code", $l->GetCiudad(), "Name", $separador = " ");
         $GetUsuario_registra    = $c->GetDataFromTable("usuarios", "user_id", $l->GetUsuario_registra(), "p_nombre, p_apellido", $separador = " ");
         $GetEstado_archivo      = $ar[$l->GetEstado_archivo()];
         $GetOficina             = $c->GetDataFromTable("seccional", "id", $l->GetOficina(), "nombre", $separador = " ");
         $GetId_dependencia_raiz = $c->GetDataFromTable("dependencias", "id", $l->GetId_dependencia_raiz(), "nombre", $separador = " ");

        $serie = $GetId_dependencia_raiz;
        $subserie = $GetTipo_documento;

         $ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");
         
         echo "<tr class='tblresult'> ";
    
            if (in_array("coltitulo", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetObservacion()."")).";";
               echo "<td>".$l->GetObservacion()."</td>";
            }
            if (in_array("colrade", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetRadicado()."")).";";
               echo "<td> <a href='/gestion/ver/".$l->GetId()."/'>".$l->GetRadicado()."</a></td>";
            }
            if (in_array("colradmin", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetMin_rad()."")).";";
               echo "<td> <a href='/gestion/ver/".$l->GetId()."/'>".$l->GetMin_rad()."</a></td>";
            }
            if (in_array("colfullrad", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetNum_oficio_respuesta()."")).";";
               echo "<td> <a href='/gestion/ver/".$l->GetId()."/'>".$l->GetNum_oficio_respuesta()."</a></td>";
            }
            if (in_array("colfreg", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetFecha_registro()."")).";";
               echo "<td>".$l->GetFecha_registro()."</td>";
            }
            if (in_array("colfrec", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetF_recibido()."")).";";
               echo "<td>".$l->GetF_recibido()."</td>";
            }
            if (in_array("colciudad", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetCiudad."")).";";
               echo "<td>".$GetCiudad."</td>";
            }
            if (in_array("coloficina", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetOficina."")).";";
               echo "<td>".$GetOficina."</td>";
            }
            if (in_array("colarea", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetDependencia_destino."")).";";
               echo "<td>".$GetDependencia_destino."</td>";
            }
            if (in_array("colserie", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($serie)).";";
               echo "<td>".$serie."</td>";
            }
            if (in_array("colsubserie", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($subserie)).";";
               echo "<td>".$subserie."</td>";
            }
            if (in_array("colnombreradica", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetNombre_radica()."")).";";
               echo "<td>".$l->GetNombre_radica()."</td>";
            }
            if (in_array("colresponsable", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetNombre_destino."")).";";
               echo "<td>".$GetNombre_destino."</td>";
            }
            if (in_array("colsuscriptor", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetSuscriptor_id."")).";";
               echo "<td>".$GetSuscriptor_id."</td>";
            }
            if (in_array("colfolios", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetFolio()."")).";";
               echo "<td>".$l->GetFolio()."</td>";
            }
            if (in_array("colfvencimiento", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetFecha_vencimiento()."")).";";
               echo "<td>".$l->GetFecha_vencimiento()."</td>";
            }
            if (in_array("colrespuesta", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetEstado_respuesta()."")).";";
               echo "<td>".$l->GetEstado_respuesta()."</td>";
            }
            if (in_array("colfrespuesta", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetFecha_respuesta()."")).";";
               echo "<td>".$l->GetFecha_respuesta()."</td>";
            }
            if (in_array("colestado", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetEstado_solicitud."")).";";
               echo "<td>".$GetEstado_solicitud."</td>";
            }
            if (in_array("colrobservacion", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetObservacion2()."")).";";
               echo "<td>".$l->GetObservacion2()."</td>";
            }
            if (in_array("coluregistra", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetUsuario_registra."")).";";
               echo "<td>".$GetUsuario_registra."</td>";
            }
            if (in_array("colubicacion", $arr_campos)) {
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->Getestado_archivo())).";";
               echo "<td>".$l->Getestado_archivo()."</td>";
            }
            if (CAMPOT1 != ""){
             if (in_array(CAMPOT1, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot1())).";";
                echo "<td>".$l->GetCampot1()."</td>";
             }
           }
           if (CAMPOT2 != ""){
             if (in_array(CAMPOT2, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot2())).";";
                echo "<td>".$l->GetCampot2()."</td>";
             }
           }
           if (CAMPOT3 != ""){
             if (in_array(CAMPOT3, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot3())).";";
                echo "<td>".$l->GetCampot3()."</td>";
             }
           }
           if (CAMPOT4 != ""){
             if (in_array(CAMPOT4, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot4())).";";
                echo "<td>".$l->GetCampot4()."</td>";
             }
           }
           if (CAMPOT5 != ""){
             if (in_array(CAMPOT5, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot5())).";";
                echo "<td>".$l->GetCampot5()."</td>";
             }
           }       
           if (CAMPOT6 != ""){
             if (in_array(CAMPOT6, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot6())).";";
                echo "<td>".$l->GetCampot6()."</td>";
             }
            } 
            if (CAMPOT7 != ""){
             if (in_array(CAMPOT7, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot7())).";";
                echo "<td>".$l->GetCampot7()."</td>";
             }
            } 
            if (CAMPOT8 != ""){
             if (in_array(CAMPOT8, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot8())).";";
                echo "<td>".$l->GetCampot8()."</td>";
             }
            }
            if (CAMPOT9 != ""){
             if (in_array(CAMPOT9, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot9())).";";
                echo "<td>".$l->GetCampot9()."</td>";
             }
            }
            if (CAMPOT10 != ""){
             if (in_array(CAMPOT10, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot10())).";";
                echo "<td>".$l->GetCampot10()."</td>";
             }
            }
            if (CAMPOT11 != ""){
             if (in_array(CAMPOT11, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot11())).";";
                echo "<td>".$l->GetCampot11()."</td>";
             }
            }
            if (CAMPOT12 != ""){
             if (in_array(CAMPOT12, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot12())).";";
                echo "<td>".$l->GetCampot12()."</td>";
             }
            }
            if (CAMPOT13 != ""){
             if (in_array(CAMPOT13, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot13())).";";
                echo "<td>".$l->GetCampot13()."</td>";
             }
            }
            if (CAMPOT14 != ""){
             if (in_array(CAMPOT14, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot14())).";";
                echo "<td>".$l->GetCampot14()."</td>";
             }
            }
            if (CAMPOT15 != ""){
             if (in_array(CAMPOT15, $arr_campos)) {
                $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetCampot15())).";";
                echo "<td>".$l->GetCampot15()."</td>";
             }
            }     
            $archivo_csv .= "\n";

         echo "</tr> ";

      }

      $f->fichero_csv($archivo_csv,$nombre);

?>      
      </tbody>
  </table>
</div>
<script>
  $(document).ready(function() {
    $('#Tablagestion tr.tblresult:not([th]):odd').addClass('par');
    $('#Tablagestion tr.tblresult:not([th]):even').addClass('impar');  
  }); 
</script>
