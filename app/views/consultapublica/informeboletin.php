<table class="table table-striped" width="100%">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th width="10%">Radicado</th>
            <th width="30%">Asunto</th>
            <th width="40%">Observacion</th>
            <th width="15%">Fecha de Publicación</th>
        </tr>
    </thead>
    <tbody>
        <?

            $tipo_documento = $c->sql_quote($_REQUEST['tipo_documento']);
            $observacion = $c->sql_quote($_REQUEST['observacion']);
            $f_inicio = $c->sql_quote($_REQUEST['f_inicio']);
            $f_corte = $c->sql_quote($_REQUEST['f_corte']);

            $path = "";
            if($tipo_documento != ""){
                $path .= " and tipo_documento = '$tipo_documento'";
            }
            if($observacion != ""){
                $path .= " and observacion like '%$observacion%'";
            }

            if($f_inicio != ""){
                $path .= " and f_recibido between '$f_inicio' and '$f_corte'";
            }
            
            $str = "select gestion.id from gestion where es_publico = '1' $path order by id desc ";
            
            $qr = $con->Query($str);

        ?>
    <?
        $i = 0;
        while ($row = $con->FetchAssoc($qr)) {
            $i++;  
            $g = new MGestion;
            $g->CreateGestion("id", $row['id']);

            $usuario = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

            switch (TIPO_RADICACION) {
                    case '1':
                        $radicado = $g->GetRadicado();
                        break;
                    case '2':
                        $radicado = $g->GetMin_rad()." <small>(".$g->GetRadicado().")</small>";
                        break;
                    case '3':
                        $radicado = $g->GetRadicado()." <small>(".$g->GetMin_rad().")</small>";
                        break;
                    default:
                        $radicado = $g->GetMin_rad();
                        break;
                }
            $radicado = "<a href='/consultapublica/resultados_radicado/".$g->GetRadicado()."/' class='btn btn-info' style='width:220px' target='_blank'>".$radicado."</a>";

            echo   '<tr>
                        <td>'.$i.'</td>
                        <td>'.$radicado.'</td>
                        <td>'.$g->GetObservacion().'</td>
                        <td>'.$g->GetObservacion2().'</td>
                        <td>'.$g->GetF_recibido().'</td>
                    </tr>';
        }
        if ($i == 0) {
            echo '<tr><td colspan="4"><div class="alert alert-warning">No se encontraron resultados</div></td></tr>';
        }
    ?>
    </tbody>
</table>
<style>
    a.btn-info{
        color:#FFF !important;
    }
</style>