<div class="row bg-title">
    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Inicio</h4> </div>
    <!-- 
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Dashboard 1</li>
        </ol>
    </div>
    	/.col-lg-12 -->
</div>
<div class="row">
    <!-- Left sidebar -->
    <div class="col-md-12">
        <div class="white-box">
            <!-- row -->
            <div class="row">
                <div class="col-lg-2 col-md-3  col-sm-12 col-xs-12 inbox-panel">
                    <div> 
                        
                        <a href="/gestion/nuevo/" class="btn btn-custom btn-block waves-effect waves-light">Nuevo <?= CAMPOEXPEDIENTE ?></a>

                        <div class="list-group mail-list m-t-20"> 
                            <a href="/dashboard/" class="list-group-item">Mis <?= CAMPOEXPEDIENTE ?>s</a> 
                            <a href="/dashboard/favoritos/" class="list-group-item ">Favoritos</a> 
                            <a href="/dashboard/archivados/" class="list-group-item active">Cerrados</a> 
                            <a href="/dashboard/boletin/" class="list-group-item">Boletín</a> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12 mail_listing">
                    <div class="inbox-center">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="4">
                                        <h4><?= CAMPOEXPEDIENTE."s Cerrados o Finalizados" ?></h4>
                                    </th>
                                <?

                                    $RegistrosAMostrar = 30;
                                    if(isset($pag)){
                                        $RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
                                        $PagAct=$pag;
                                    }else{
                                        $RegistrosAEmpezar=0;
                                        $PagAct=1;
                                    }   

                                    $qr = $con->Query("select gestion.id from gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id where gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' and estado_archivo = '1' and estado_respuesta = 'cerrado' order by id desc limit $RegistrosAEmpezar, $RegistrosAMostrar");


                                    $querypag = $con->Query("select count(*) as t from gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id where gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' and estado_archivo = '1' and estado_respuesta = 'cerrado'");



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
                                    <th class="hidden-xs" width="150">
                                        <div class="btn-group pull-right navigation_bar">
                                            <?= $pathAnt.$pathSig ?>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
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
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>