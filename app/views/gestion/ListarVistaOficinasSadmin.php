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


        
    // Mostrar contenido basado en el rol del usuario
    if ($_SESSION['sadmin'] == '1') {
        // Usuario Administrador
        echo "  <div class='col-md-12'>
                    <div class='title'>
                        <h3>Listado de Oficinas</h3>
                    </div>
                </div>";

        
        $code = $_SESSION['seccional'];

        $query = $con->Query("SELECT * FROM seccional ");
        // echo "SELECT * FROM seccional WHERE ciudad = '".$code."'";
        while ($area = $con->FetchAssoc($query)) {
            
            $id_area = $area['id'];

            $nombre = $area['nombre'];
            $enlace = "/navigator/VistaSadmin/" . $id_area . "/";

 
            $str = "SELECT count(*) as t FROM gestion where ciudad = '" . $_SESSION['ciudad'] . "' and oficina = '" . $id_area . "' and version = '" . $_SESSION['active_vista'] . "' and estado_archivo = '" . $_SESSION['typefolder'] . "' $pathfiltro ";
// 
            $qt = $con->Query($str);
            $rqt = $con->Result($qt, '0', "t");
// 
            $cantidad = $f->Zerofill($rqt, 3);
            echo $f->DoFolderAjax($nombre, $enlace, $cantidad, "", "1", $idx);

        }
    }
?>
<script>
    // $("#LoadNavitagionList").append("<li class='active'><a href='/gestion/getareas/0/'>Oficinas</a></li>");
</script>
