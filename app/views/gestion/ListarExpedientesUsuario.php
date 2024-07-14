<?

   $nombre = "reporte_".$_SESSION['usuario'];

    // Variables de filtro de sesión
    $minfilt = "";
    if ($_SESSION['filtro_estado'] != "Todos") {
        $minfilt .= " AND estado_respuesta = '" . $_SESSION['filtro_estado'] . "'";
    }
    if ($_SESSION['filtro_prioridad'] != "Todos") {
        $minfilt .= " AND prioridad = '" . $_SESSION['filtro_prioridad'] . "'";
    }
    $pathfiltro = " AND f_recibido between '" . $_SESSION['filtro_fi'] . "' and '" . $_SESSION['filtro_ff'] . "' $minfilt";

	$usuarioInforme      = $c->GetDataFromTable("usuarios", "a_i", $value, "p_nombre, p_apellido", $separador = " ");

	if ($_SESSION['sadmin'] == '0' && $_SESSION['t_cuenta'] == '0' ) {
		$str = "SELECT * FROM gestion where nombre_destino = '".$value."' and version = '" . $_SESSION['active_vista'] . "' and estado_archivo = '" . $_SESSION['typefolder'] . "' $pathfiltro";
	}else{
		$str = "SELECT * FROM gestion where nombre_destino = '".$value."' and dependencia_destino = '" . $area . "' and ciudad = '" . $_SESSION['ciudad'] . "' and oficina = '" . $seccional . "' and version = '" . $_SESSION['active_vista'] . "' and estado_archivo = '" . $_SESSION['typefolder'] . "' $pathfiltro";
	}
	
    // $str = "SELECT * FROM gestion WHERE $path";

    $query = $con->Query($str);
?>
<div id="exportardocumento" style="padding:20px; overflow-x:auto">
   <br>
      <button class="btn btn-primary">
         <a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre.".csv" ?>" style="color:#FFF">Descargar Informe</a>
      </button>
  <br><br>
    <table border='1' cellspacing='10' cellpadding='3' class='tabla' id='Tablagestion' style="width:auto">
      <thead>
        <tr class='encabezado'>
<?
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Asunto")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:30px'>#</th>";

		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Asunto")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:250px'>Asunto</th>";
		
		
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPORADEXTERNO)).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:200px'>".CAMPORADEXTERNO."</th>";
		
		
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPORADRAPIDO)).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:100px'>".CAMPORADRAPIDO."</th>";
		
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Nombre de Quien Radica")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:300px'>Nombre de Quien Radica</th>";
		
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Registro")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:100px'>Fecha de Registro</th>";

    $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Tiempo desde Apertura")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:100px'>Tiempo desde Apertura</th>";
    
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Estado de Respuesta")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:100px'>Estado de Respuesta</th>";
		
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Respuesta")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:100px'>Fecha de Respuesta</th>";

		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Vencimiento")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:100px'>Fecha de Vencimiento</th>";
			
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Oficina")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:200px'>Oficina</th>";
		
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPOAREADETRABAJO)).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:200px'>".CAMPOAREADETRABAJO."</th>";
		
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Usuario Responsable")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:300px'>Usuario Responsable</th>";
		
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Serie Documental")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:200px'>Serie Documental</th>";
		
		$archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Sub-Serie documental")).";";
		echo "<th class='th_act' style=' padding:3px 5px; font-size: 12px; border-bottom:1px solid #008FC9;min-width:200px'>Sub-Serie documental</th>";
		
		
		
         $archivo_csv .= "\n";
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
         

        // la variable $l->GetFecha_registro() obtiene la fecha de registro del expediente, puedes obtener el tiempo transcurrido desde la apertura del expediente al dia de hoy


        $fecha_registro = $l->GetFecha_registro();
        $fecha_actual = date("Y-m-d H:i:s");

        $tiempoApertura = $f->Diferencia($fecha_actual, $fecha_registro).' días';

        


         echo "<tr class='tblresult'> ";
    
				$archivo_csv .= $f->Reemplazo3($f->Reemplazo2($i)).";";
				echo "<td style='padding:3px 5px'>".$i."</td>";

               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetObservacion()."")).";";
               echo "<td style='padding:3px 5px'>".$l->GetObservacion()."</td>";

            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetRadicado()."")).";";
               echo "<td style='padding:3px 5px'> <a href='/gestion/ver/".$l->GetId()."/'>".$l->GetRadicado()."</a></td>";
            
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetMin_rad()."")).";";
               echo "<td style='padding:3px 5px'> <a href='/gestion/ver/".$l->GetId()."/'>".$l->GetMin_rad()."</a></td>";
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetNombre_radica()."")).";";
               echo "<td style='padding:3px 5px'>".$l->GetNombre_radica()."</td>";
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetFecha_registro()."")).";";
               echo "<td style='padding:3px 5px'>".$l->GetFecha_registro()."</td>";

               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($tiempoApertura."")).";";
               echo "<td style='padding:3px 5px'>".$tiempoApertura."</td>";
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetEstado_respuesta()."")).";";
               echo "<td style='padding:3px 5px'>".$l->GetEstado_respuesta()."</td>";
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetFecha_respuesta()."")).";";
               echo "<td style='padding:3px 5px'>".$l->GetFecha_respuesta()."</td>";
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetFecha_vencimiento()."")).";";
               echo "<td style='padding:3px 5px'>".$l->GetFecha_vencimiento()."</td>";
            
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetOficina."")).";";
               echo "<td style='padding:3px 5px'>".$GetOficina."</td>";
            
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetDependencia_destino."")).";";
               echo "<td style='padding:3px 5px'>".$GetDependencia_destino."</td>";
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetNombre_destino."")).";";
               echo "<td style='padding:3px 5px'>".$GetNombre_destino."</td>";
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($serie)).";";
               echo "<td style='padding:3px 5px'>".$serie."</td>";
            
            
               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($subserie)).";";
               echo "<td style='padding:3px 5px'>".$subserie."</td>";       
            
            
  
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
	
	$("#LoadNavitagionList").append("<li class='active'><?= $usuarioInforme ?></li>");
</script>

