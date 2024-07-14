<?php
    // Variables de filtro de sesión
    $minfilt = "";
    if ($_SESSION['filtro_estado'] != "Todos") {
        $minfilt .= " AND estado_respuesta = '" . $_SESSION['filtro_estado'] . "'";
    }
    if ($_SESSION['filtro_prioridad'] != "Todos") {
        $minfilt .= " AND prioridad = '" . $_SESSION['filtro_prioridad'] . "'";
    }
    $pathfiltro = " AND f_recibido between '" . $_SESSION['filtro_fi'] . "' and '" . $_SESSION['filtro_ff'] . "' $minfilt";


    $MAreas = new MAreas;
	$MAreas->CReateAreas("id", $value);

    $MSeccional = new MSeccional;
    $MSeccional->CreateSeccional("id", $seccional);
        
    // Mostrar contenido basado en el rol del usuario
    if ($_SESSION['sadmin'] == '1') {
        // Usuario Administrador
        echo "  <div class='col-md-12'>
                    <div class='title'>
                        <h3>Listado de Usuarios del Area ".$MAreas->GetNombre()."</h3>
                    </div>
                </div>";
        

        $q_str = "SELECT u.a_i, concat(p_nombre, ' ', s_nombre, ' ', p_apellido, ' ', s_apellido) as nombre
				FROM `usuarios_configurar_accesos` uc inner join usuarios u on uc.id_tabla = concat(u.a_i,'".$value."','".$seccional."') 
				where  uc.tabla = 'usuario' and u.estado = '1'
				group by  u.a_i"; 

        $q_str = "SELECT count(*) as t, nombre_destino FROM gestion where dependencia_destino = '" . $value . "' and 
                                                                            ciudad = '" . $_SESSION['ciudad'] . "' and oficina = '" . $seccional . "' and version = '" . $_SESSION['active_vista'] . "' and estado_archivo = '" . $_SESSION['typefolder'] . "' $pathfiltro group by nombre_destino";
        
        $query = $con->Query($q_str);

        while ($user = $con->FetchAssoc($query)) {
            
             $userId = $user['nombre_destino'];

            // Obtener la información de la columna usuario de la tabla areas_dependencias
            $l = new MUsuarios;
            $l->CreateUsuarios('a_i', $userId);

            $nombre = $l->GetP_nombre().' '.$l->GetP_apellido();
            $enlace = "/navigator/VistaSimple/" . $userId . "/".$value."/".$seccional."/";

// // //          ciudad = '" . $_SESSION['ciudad'] . "' and oficina = '" . $_SESSION['seccional'] . "' and 
            $str = "SELECT count(*) as t, nombre_destino FROM gestion where nombre_destino = '".$userId."' and dependencia_destino = '" . $value . "' and ciudad = '" . $_SESSION['ciudad'] . "' and oficina = '" . $seccional . "' and version = '" . $_SESSION['active_vista'] . "' and estado_archivo = '" . $_SESSION['typefolder'] . "' $pathfiltro group by nombre_destino";
        
            // echo $str = "SELECT count(*) as t FROM gestion where  and dependencia_destino = '" . $value . "'  and ciudad = '" . $_SESSION['ciudad'] . "' and oficina = '" . $seccional . "'  and version = '" . $_SESSION['active_vista'] . "' and estado_archivo = '" . $_SESSION['typefolder'] . "' $pathfiltro ";

            $qt = $con->Query($str);
            $rqt = $con->Result($qt, '0', "t");

            $cantidad = $f->Zerofill($rqt, 3);
            echo $f->DoFolderAjax($nombre, $enlace, $cantidad, "", "1", $idx);

        }
    }
    $enlaceOficina = "/navigator/VistaSadmin/".$seccional."/";
    $enlaceArea = "/navigator/VistaJefe/" . $value . "/".$seccional."/";

    // (&quot;/navigator/VistaSadmin/27/&quot;
?>
<script>
    $("#LoadNavitagionList").html('');
    $("#LoadNavitagionList").append('<li class=""><a href="/gestion/getareas/0/">Gestión</a></li>');
    $("#LoadNavitagionList").append("<li class=''><a href='#' onclick='LoadAjaxFolder(\"<?= $enlaceOficina?> \")'> <?= $MSeccional->GetNombre() ?> </a></li>");    
    $("#LoadNavitagionList").append("<li class='active'><a href='#' onclick='LoadAjaxFolder(\"<?= $enlaceArea?> \")'> <?= $MAreas->GetNombre() ?> </a></li>");
</script>

