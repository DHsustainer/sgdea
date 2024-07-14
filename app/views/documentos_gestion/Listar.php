<h2>Listado de Documentos Creados sin Exportar</h2>
<div class="row">
    <div class="col-md-12">
        <div class='list-group'>
<?
            

    $i = 0;
    while ($col = $con->FetchAssoc($query)) {
    	$i++;
    	$alow = true;

    	$pdoc = new MDocumentos_gestion_permisos;
		$listado_permisos = $pdoc->ListarDocumentos_gestion_permisos("where id_documento = '".$col['id']."'");

        echo "  <div class='list-group-item' id='".$col['id']." '>
                    <div class='row'>
                        <div class='col-md-11 col-sm-11'>
                            <div class='material-icon-list-demo'>
                                <div class='icons waves-effect'>
                                    <div onClick='window.location.href=\"".HOMEDIR.DS."documentos_gestion/nuevo/".$id."/".$col['id']."/\"'>
                                        <i class='mdi mdi-file-pdf text-danger'></i><span> $col[nombre]</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-1 col-sm-1'>";

                            while ($row = $con->FetchAssoc($listado_permisos)) {
                            	$estado = "Sin Activar";
                            	if ($row[estado] != 1) {
                            		$alow = false;
                            		echo "<span class='mdi mdi-check text-muted icon m-r-5' title='El documento aun no ha sido aprobado por el usuario $row[usuario_permiso]'></span>";
                            	}else{
                            		echo "<span class='mdi mdi-check-all text-succes icon m-r-5' title='El documento ha sido aprobado por el usuario $row[usuario_permiso]'></span>";
                            	}
                            }

                            if ($alow && $_SESSION['usuario'] == $col['user_id']) {
                    			echo " <span onClick='ExportarDocumento(\"".$col['id']."\", \"".$id."\")' class='mdi mdi-export text-info icon waves-effect' title='exportar'></span>";
                            }else{
            					#echo " <span class='mini-ico green-exp' title='exportar'></span>";
                            }
        echo "          </div>
                    </div>
                </div>";
    }

    if ($i <= 0) {
    	echo "<div class='list-group-item'><div class='alert alert-info'>No tiene documentos creados</div></div>";
    }
?>
        </div>
    </div>
</div>