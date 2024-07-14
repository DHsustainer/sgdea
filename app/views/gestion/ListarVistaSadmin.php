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


    $oficina = new MSeccional;
    $oficina->CreateSeccional("id", $value);

        
    // Mostrar contenido basado en el rol del usuario
    if ($_SESSION['sadmin'] == '1') {
        // Usuario Administrador
        echo "  <div class='col-md-12'>
                    <div class='title'>
                        <h3>Listado de Areas</h3>
                    </div>
                </div>";


        $q_str = "
                SELECT a.id, a.nombre 
                FROM `usuarios_configurar_accesos` uc inner join areas a on uc.id_tabla = concat(a.id,'".$value."')
                where uc.tabla = 'area'
                group by a.id, a.nombre";
        
        $query = $con->Query($q_str);


        while ($area = $con->FetchAssoc($query)) {
            
            $id_area = $area['id'];

            // Obtener la información de la columna usuario de la tabla areas_dependencias
            $l = new MAreas;
            $l->Createareas('id', $id_area);

            $nombre = $l->GetNombre();
            $enlace = "/navigator/VistaJefe/" . $id_area . "/".$value."/";

// //          ciudad = '" . $_SESSION['ciudad'] . "' and oficina = '" . $_SESSION['seccional'] . "' and 

            $str = "SELECT count(*) as t FROM gestion where dependencia_destino = '" . $id_area . "' and ciudad = '" . $_SESSION['ciudad'] . "' and oficina = '" . $value . "' and version = '" . $_SESSION['active_vista'] . "' and estado_archivo = '" . $_SESSION['typefolder'] . "' $pathfiltro ";

            $qt = $con->Query($str);
            $rqt = $con->Result($qt, '0', "t");

            $cantidad = $f->Zerofill($rqt, 3);
            echo $f->DoFolderAjax($nombre, $enlace, $cantidad, "", "1", $idx);

        }
    }

    $enlaceOficina = "/navigator/VistaSadmin/".$value."/";
?>
<script>
    $("#LoadNavitagionList").html('');
    $("#LoadNavitagionList").append('<li class="active"><a href="/gestion/getareas/0/">Gestión</a></li>');
    $("#LoadNavitagionList").append("<li class='active'><a href='#' onclick='LoadAjaxFolder(\"<?= $enlaceOficina?> \")'> <?= $oficina->GetNombre() ?> </a></li>");
</script>