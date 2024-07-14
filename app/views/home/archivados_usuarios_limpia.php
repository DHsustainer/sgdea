<div class="row m-b-30">
    <div class="col-xs-7 m-t-20"></div>
    <div class="col-xs-5 m-t-20">

<?

                $RegistrosAMostrar = 30;
                if(isset($pag)){
                    $RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
                    $PagAct=$pag;
                }else{
                    $RegistrosAEmpezar=0;
                    $PagAct=1;
                }   

                $qr = $con->Query("select gestion.id from gestion where nombre_destino = '".$_SESSION['user_ai']."' and estado_archivo = '1' and estado_respuesta = 'cerrado' order by id desc limit $RegistrosAEmpezar, $RegistrosAMostrar");

                $querypag = $con->Query("select count(*) as t from gestion where nombre_destino = '".$_SESSION['user_ai']."' and estado_archivo = '1' and estado_respuesta = 'cerrado'");


                $NroRegistros = $con->Result($querypag, 0, 't');


                $PagAnt=$PagAct-1;
                $PagSig=$PagAct+1;

                $PagUlt=$NroRegistros/$RegistrosAMostrar;

                $pathAnt = "";
                $pathSig = "";


                if ($PagAnt == "0") {
                    $pathAnt = '<button type="button" id="navprev" disabled class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>';
                }else{
                    $pathAnt = '<button type="button" id="navprev" class="btn btn-default waves-effect"  onclick="window.location.href=\'/dashboard/archivados/'.$PagAnt.'/\'"><i class="fa fa-chevron-left"></i></button>';
                }
                if ($PagSig > $PagUlt) {
                    $pathSig = '<button type="button" id="navnext" disabled class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>';
                }else{
                    $pathSig = '<button type="button" id="navnext" class="btn btn-default waves-effect"  onclick="window.location.href=\'/dashboard/archivados/'.$PagSig.'/\'"><i class="fa fa-chevron-right"></i></button>';
                }   
            ?>
            <div class="btn-group pull-right navigation_bar">
                <?= $pathAnt.$pathSig ?>
            </div>


    </div>
</div>



<div class="inbox-center">
    <table class="table table-hover">
        <tbody>
        <?
            while ($row = $con->FetchAssoc($qr)) {
                $c->GetVistaMailExpediente($row['id']);
            }
            if($NroRegistros == 0){
                echo '<tr>
                        <td colspan="5">
                            <div class="alert alert-info">No hay registros de ingresos de este item</div>
                        </td>
                    </tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-xs-7 m-t-20"></div>
    <div class="col-xs-5 m-t-20">
        <div class="btn-group pull-right navigation_bar">
            <?= $pathAnt.$pathSig ?>
        </div>
    </div>
</div>