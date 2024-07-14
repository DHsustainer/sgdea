<?

   $nombre = "reporte_".$_SESSION['usuario'];

    $vcampos_reporte = $_REQUEST["campos"];
    $campos_reporte = implode(',',$vcampos_reporte);
    $arr_campos = explode(",", $campos_reporte);

    $path = ""; 
    $path .= " fecha_registro between '".$f_inicio."' AND '".$f_corte."' ";
    $path .= " and estado_archivo = '2' ";

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
    if($id_dependencia_raiz != "V" && $id_dependencia_raiz != "" && isset($id_dependencia_raiz)){
        $path .= " AND id_dependencia_raiz = '".$id_dependencia_raiz."'";
    }
    if($tipo_documento != "V" && $tipo_documento != "" && isset($tipo_documento)){
        $path .= " AND tipo_documento = '".$tipo_documento."'";
    }

    $str = "SELECT * FROM gestion WHERE $path";

    $query = $con->Query($str);
?>
<div id="exportardocumento" style="padding:20px;">
    <table class='table table-striped font-12' id='Tablagestion' style="width:100%">
      <thead>
        <tr class='encabezado'>
<?
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Titulo del Expediente</th>";
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Radicado Rapido</th>";
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Fecha de Registro</th>";
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Ciudad</th>";
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Oficina</th>";
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOAREADETRABAJO."</th>";
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Usuario Responsable</th>";
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Serie Documental</th>";
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Sub-Serie documental</th>";
          echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Suscriptor</th>";
?>
        </tr>
      </thead>
      <tbody>
<?
  
      $ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
      $ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");

      $i = 0;
      while($row = $con->FetchAssoc($query)){

        $i++;
      
         $l = new MGestion;
         $l->Creategestion('id', $row[id]);

         $GetTipo_documento      = $c->GetDataFromTable("dependencias", "id", $l->GetTipo_documento(), "nombre", $separador = " ");
         $GetDependencia_destino = $c->GetDataFromTable("areas", "id", $l->GetDependencia_destino(), "nombre", $separador = " ");
         $GetNombre_destino      = $c->GetDataFromTable("usuarios", "a_i", $l->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");
         $GetPrioridad           = $ar[$l->GetPrioridad()];
         $GetEstado_solicitud    = $c->GetDataFromTable("estados_gestion", "id", $l->GetEstado_solicitud(), "nombre", $separador = " ");
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
    
               echo "<td>".$l->GetObservacion()."</td>";
               echo "<td>".$l->GetMin_rad()."</td>";
               echo "<td>".$l->GetF_recibido()."</td>";
               echo "<td>".$GetCiudad."</td>";
               echo "<td>".$GetOficina."</td>";
               echo "<td>".$GetDependencia_destino."</td>";
               echo "<td>".$serie."</td>";
               echo "<td>".$subserie."</td>";
               echo "<td>".$GetNombre_destino."</td>";
               echo "<td>".$GetSuscriptor_id."</td>";
                       
            $archivo_csv .= "\n";

         echo "</tr> ";

      }

      if ($i == "0") {
        echo "<td colspan='10'><div class='alert alert-info'>No hay expedientes en el archivo central!</div></td>";
      }

?>      
      </tbody>
  </table>
</div>