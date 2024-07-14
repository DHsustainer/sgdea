<?

	$city = new MCity;
    $city->CreateCity("code", $_SESSION['ciudad']);

    $of = new MSeccional;
    $of->CreateSeccional("id", $_SESSION['seccional']);
    $oficina = $of->GetNombre();

    $archivo = array("0" => "HISTORICO" ,"2" => "CENTRAL", "3" => "HISTORICO");
?>
<div class="row" style="margin:0px; background: #FFF; margin-top:20px">
	<div class="col-md-12 m-t-30">
		<ol class="breadcrumb default">
		  	<li>ARCHIVO <?= $archivo[$_SESSION['typefolder']] ?></li>
		  	<li><?= $oficina ?></li>
		  	<li><?= $city->GetName() ?></li>
		</ol>
	</div>
	<div class="col-md-12">

<div class="row">
	<div class="col-md-12">		
		<div id="newbloque_formularios" class="m-t-30">
            <ul class="nav nav-tabs" id="formnavigation">
<?

            $MAreas = new MAreas;
            $MAreas->CreateAreas("id", $area);


           	$query = $con->Query("select * from areas");

            while ($row = $con->FetchAssoc($query)) {

            	$idarea = $row['id'];
	
                $ase = "";
        		if ($area == $idarea) {
        			$ase = "class='active'";
        		}
                $nomform = $c->GetDataFromTable("areas", "id", $idarea, "nombre", $separador = " ");

                $nomformmin = $nomform;

                echo '	<li role="presentation" data-toggle="tooltip" data-placement="top" title="'.$nomform.'" '.$ase.'>
                			<a href="/gestion/archivocentral/'.$idarea.'/">'.$nomformmin.'</a>
                		</li>';
                
            }
?>
            </ul>
            <div id="contenedor_formulario" class="scrollable m-t-30">
            	
            	<h3>Informe de Archivo Central:  <?php echo $MAreas->GetNombre(); ?></h3>

				 <table border='0' cellspacing='0' cellpadding='3' class='table table-striped' id='Tablagestion' style="width:100%">
				      <thead>
				        <tr class='encabezado'>
				<?

				            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Asunto")).";";
				            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".ASUNTO."</th>";

				            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2(CAMPORADRAPIDO)).";";
				            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPORADRAPIDO."</th>";

				            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Fecha de Registro")).";";
				            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".FECHA_APERTURA."</th>";

			               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetCiudad."")).";";
			               echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CIUDAD."</th>";
			            
			               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetOficina."")).";";
			               echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".OFICINA."</th>";
			            
			               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetDependencia_destino."")).";";
			               echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".CAMPOAREADETRABAJO."</th>";

				            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Serie Documental")).";";
				            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".SERIE."</th>";

				            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Sub-Serie documental")).";";
				            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".SUB_SERIE."</th>";

				            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Usuario Responsable")).";";
				            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".RESPONSABLE."</th>";


				            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Nombre de Quien Radica")).";";
				            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".SUSCRIPTORCAMPONOMBRE."</th>";

				            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("# Folios")).";";
				            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".FOLIOS."</th>";

				            $archivo_csv .= $f->Reemplazo3($f->Reemplazo2("Estado de Respuesta")).";";
				            echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".ESTADO."</th>";


				         $archivo_csv .= "\n";

				?>
				        </tr>
				      </thead>
				      <tbody>            	
 	 			<?

	 	 			$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");
	      			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación");

					$q_str = "SELECT * from gestion where dependencia_destino = '".$area."' and estado_archivo = '".$idx."' $pathfiltro"; 

					$lits = $con->Query($q_str);

					while ($row = $con->FetchAssoc($lits)) {
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
				    
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetObservacion()."")).";";
				               echo "<td>".$l->GetObservacion()."</td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetMin_rad()."")).";";
				               echo "<td> <a href='/gestion/ver/".$l->GetId()."/'>".$l->GetMin_rad()."</a></td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetFecha_registro()."")).";";
				               echo "<td>".$l->GetFecha_registro()."</td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetCiudad."")).";";
				               echo "<td>".$GetCiudad."</td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetOficina."")).";";
				               echo "<td>".$GetOficina."</td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetDependencia_destino."")).";";
				               echo "<td>".$GetDependencia_destino."</td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($serie)).";";
				               echo "<td>".$serie."</td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($subserie)).";";
				               echo "<td>".$subserie."</td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($GetNombre_destino."")).";";
				               echo "<td>".$GetNombre_destino."</td>";

				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetNombre_radica()."")).";";
				               echo "<td>".$l->GetNombre_radica()."</td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetFolio()."")).";";
				               echo "<td>".$l->GetFolio()."</td>";
				            
				               $archivo_csv .= $f->Reemplazo3($f->Reemplazo2($l->GetEstado_respuesta()."")).";";
				               echo "<td>".$l->GetEstado_respuesta()."</td>";
    
				            $archivo_csv .= "\n";

				         echo "</tr> ";


					}

					$f->fichero_csv($archivo_csv,$nombre);
				?>
							</tbody>
						</table>
		            </div>
		        </div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>