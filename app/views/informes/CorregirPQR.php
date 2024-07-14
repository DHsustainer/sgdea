<?
  
  $str = base64_decode($str);
  
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
    <div id="divTablagestion">
    <table border='1' cellspacing='0' cellpadding='3' class='tabla' id='Tablagestion' style="width:auto">
      <thead>
        <tr class='encabezado'>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Número de Radicación</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Fecha de Radicación</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Peticionario</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Tipo de Petición</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase'>Asunto</th>
            <th style='font-size: 12px; border-bottom:1px solid #008FC9; color:#000; text-transform:uppercase; width: 550px'>DOCUMENTOS</th>
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

            $listado = $con->Query("select * from dependencias_tipologias WHERE id_dependencia = '".$l->GetTipo_documento()."'");
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
            echo "<td>".$l->GetMin_rad()."</td>";
            echo "<td>".$l->GetF_recibido()."</td>";
            echo "<td>".$GetSuscriptor_id."</td>";

            echo "<td>".$subserie."</td>";
            
            echo "<td>".$l->GetObservacion()."</td>";

            echo "<td>
                    <table border='1' width='540px'>
                        <tr>
                            <th width='400px'>Documento</th>
                            <th width='140px'>Tipo Documental</th>
                        </tr>";
            
            
            $sqlx = $con->Query("Select id, nombre, tipologia, fecha, url from gestion_anexos where gestion_id = '".$l->GetId()."' and estado = '1' order by id desc limit 0, 1");                        
            while ($roox = $con->FetchAssoc($sqlx)) {
              $idb = $roox['id'];

              echo "  <tr>
                        <td> <a href='".HOMEDIR.DS."app/archivos_upload/gestion/".$l->GetId()."/anexos/".$roox['url']."' target='_blank'> ".$roox['nombre']."</a></td>
                        <td>";
              echo '      <select style="width:140px; height:35px;" id="changetypedoc'.$idb.'" onChange="changetypedoc(\''.$idb.'\', \''.$idb.'\', this.value)">
                            <option value="">Seleccione una Tipología</option>';  
                              while ($rl = $con->FetchAssoc($listado)) {
                                if ($rl['id'] == $roox['tipologia']) {
                                  # code...
                                    echo  "<option value='".$rl['id']."' selected='selected'>".$rl['tipologia']."</option>"; 
                                }else{
                                    echo  "<option value='".$rl['id']."'>".$rl['tipologia']."</option>"; 
                                }
                            }
                echo "    </select>
                        </td>
                      </tr>";
            }
            echo "  </table>
            </td>";


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