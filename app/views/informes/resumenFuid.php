<?
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
    if($id_dependencia_raiz != "V" && $id_dependencia_raiz != "" && isset($id_dependencia_raiz)){
        $path .= " AND id_dependencia_raiz = '".$id_dependencia_raiz."'";
    }
    if($tipo_documento != "V" && $tipo_documento != "" && isset($tipo_documento)){
        $path .= " AND tipo_documento = '".$tipo_documento."'";
    }

    $str = "SELECT * FROM gestion WHERE $path";

    $query = $con->Query($str);
?>
<div style="margin:20px; padding:20px; background: #FFF">  
  <!--<input type="button" onClick="ExportarExcel('exportardocumento')" value="Exportar"> -->
  
  <div id="exportardocumento">
    <h3 align="center">FORMATO UNICO DE INVENTARIO DOCUMENTAL</h3>

    <div style="with:800px; float:left; margin-bottom: 20px;  margin-top:20px">
      <table  width="800px" cellpadding="10" cellspacing="5">
        <tr>
          <td style="border-bottom: 1px solid #000; height:25px;" width="150px"><b>Entidad Remitente:</b></td>
          <td style="border-bottom: 1px solid #000"></td>
        </tr>
        <tr>
          <td style="border-bottom: 1px solid #000; height:25px;" width="150px"><b>Entidad Productora:</b></td>
          <td style="border-bottom: 1px solid #000"></td>
        </tr>
        <tr>
          <td style="border-bottom: 1px solid #000; height:25px;" width="150px"><b>Unidad Administrativa:</b></td>
          <td style="border-bottom: 1px solid #000"></td>
        </tr>
        <tr>
          <td style="border-bottom: 1px solid #000; height:25px;" width="150px"><b>Oficina Prodcutora:</b></td>
          <td style="border-bottom: 1px solid #000"></td>
        </tr>
        <tr>
          <td style="border-bottom: 1px solid #000; height:25px;" width="150px"><b>Objeto:</b></td>
          <td style="border-bottom: 1px solid #000"></td>
        </tr>
      </table>  
    </div>
    <div style="with:200px; float:left; text-align: center; margin-left:50px; margin-top:30px;" align="center">
      <table border="1" cellpadding="10" cellspacing="0">
        <tr>
          <td style="height:40px" colspan="4">REGISTRO DE ENTRADA</td>
        </tr>
        <tr>
          <td width="50px" style="height:40px">AÑO</td>
          <td width="50px">MES</td>
          <td width="50px">DIA</td>
          <td width="50px">Nº T</td>
        </tr>
        <tr>
          <td style="height:40px">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>

    <table border='1' cellspacing='0' cellpadding='3' class='tabla' id='Tablagestion' style="width:1100px; text-align: center">
      <thead>
        <tr>
          <td rowspan="2">Item</td>
          <td rowspan="2">Código</td>
          <td rowspan="2">Serie</td>
          <td rowspan="2">Sub Serie</td>
          <td rowspan="2">Asunto</td>
          <td colspan="2">Fechas Extremas</td>
          <td colspan="4">Unidad de Conservacion</td>
          <td rowspan="2">Folios</td>
          <td rowspan="2">Soporte</td>
          <td rowspan="2">Frecuecia de Consulta</td>
          <td rowspan="2">Notas</td>
        </tr>


        <tr>
          <td>Inicial</td>
          <td>Final</td>
          <td>Caja</td>
          <td>Carpeta</td>
          <td>Tomo</td>
          <td>Otro</td>
        </tr>
      </thead
    </table>

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
    $GetEstado_solicitud    = $c->GetDataFromTable("estados_gestion", "id", $l->GetEstado_solicitud(), "nombre", $separador = " ");
    $GetSuscriptor_id       = $c->GetDataFromTable("suscriptores_contactos", "id", $l->GetSuscriptor_id(), "nombre", $separador = " ");
    $GetCiudad              = $c->GetDataFromTable("city", "Code", $l->GetCiudad(), "Name", $separador = " ");
    $GetUsuario_registra    = $c->GetDataFromTable("usuarios", "user_id", $l->GetUsuario_registra(), "p_nombre, p_apellido", $separador = " ");
    $GetEstado_archivo      = $ar[$l->GetEstado_archivo()];
    $GetOficina             = $c->GetDataFromTable("seccional", "id", $l->GetOficina(), "nombre", $separador = " ");
    $GetId_dependencia_raiz = $c->GetDataFromTable("dependencias", "id", $l->GetId_dependencia_raiz(), "nombre", $separador = " ");
    

?>            
    <tr id='r<?= $l->GetId() ?>' class='tblresult'> 
      <td width="50px"></td> 
      <td width="50px"><?php echo $l->GetMin_rad(); ?></td> 
      <td width="110px"><?php echo $GetId_dependencia_raiz; ?></td> 
      <td width="110px"><?php echo $GetTipo_documento; ?></td> 
      <td width="150px"><?php echo $l->GetObservacion(); ?></td> 
      <td width="80px"><?php echo $l->GetFecha_registro(); ?></td> 
      <td width="80px"></td> 
      <td width="50px"></td> 
      <td width="50px"></td> 
      <td width="50px"></td>  
      <td width="50px"></td>  
      <td width="50px"><?php echo $l->GetFolio(); ?></td> 
      <td width="70px"></td> 
      <td width="70px"></td> 
      <td width="110px"></td> 
      
      
    </tr>
<?
  }
?>      </tbody>
  </table>

  <div style="with:800px;margin-bottom: 20px;  margin-top:20px">
    
      <div style="width:350px; display:inline-block; margin-bottom: 50px; margin-top:20px;">
          <table border="1" width="350px;">
              <tr>
                <td>Elaborado Por:</td>
                <td colspan="3"></td>
                
              </tr>
              <tr>
                <td>Cargo</td>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td>Firma</td>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td>Lugar</td>
                <td width="78px"></td>
                <td width="78px">Fecha</td>
                <td width="78px"></td>
              </tr>
          </table>
      </div>

  <div style="width:350px; display:inline-block; margin-left:20px; margin-bottom: 50px; margin-top:20px;">
    <table border="1" width="350px;">
          <tr>
            <td>Entregado Por:</td>
            <td colspan="3"></td>
            
          </tr>
          <tr>
            <td>Cargo</td>
            <td colspan="3"></td>
          </tr>
          <tr>
            <td>Firma</td>
            <td colspan="3"></td>
          </tr>
          <tr>
            <td>Lugar</td>
            <td width="78px"></td>
            <td width="78px">Fecha</td>
            <td width="78px"></td>
          </tr>
      </table>
  </div>
  <div style="width:350px; display:inline-block; margin-left:20px; margin-bottom: 50px; margin-top:20px;">
    <table border="1" width="350px;">
          <tr>
            <td>Recibido Por:</td>
            <td colspan="3"></td>
            
          </tr>
          <tr>
            <td>Cargo</td>
            <td colspan="3"></td>
          </tr>
          <tr>
            <td>Firma</td>
            <td colspan="3"></td>
          </tr>
          <tr>
            <td>Lugar</td>
            <td width="78px"></td>
            <td width="78px">Fecha</td>
            <td width="78px"></td>
          </tr>
      </table>
  </div>



  </div>


</div>

  

</div>
<script>
  $(document).ready(function() {
    $('#Tablagestion tr.tblresult:not([th]):odd').addClass('par');
    $('#Tablagestion tr.tblresult:not([th]):even').addClass('impar');  
  }); 
</script>
