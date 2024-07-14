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
                        
                    <?
                        if(SUSCRIPTORESENABLEDCREAR == "1"){
                    ?>
                        <a href="/gestion/nuevo/" class="btn btn-custom btn-block waves-effect waves-light">Nuevo <?= CAMPOEXPEDIENTE ?></a>
                    <?
                        }
                    ?>

                        <div class="list-group mail-list m-t-20"> 
                            <a href="/dashboard/" class="list-group-item active">Mis <?= CAMPOEXPEDIENTE ?>s</a> 
                            <a href="/dashboard/favoritos/" class="list-group-item ">Favoritos</a> 
                            <a href="/dashboard/archivados/" class="list-group-item">Cerrados</a> 
                            <a href="/dashboard/boletin/" class="list-group-item">Boletín</a> 
                            <!--<h3 class="panel-title m-t-40 m-b-0">Etiquetas</h3>
                            <hr class="m-t-5">
                            <div class="list-group b-0 mail-list">
                                <a href="#" class="list-group-item">
                                    <span class="fa fa-circle text-warning m-r-10"></span>En Pausa
                                </a> 
                                <a href="#" class="list-group-item">
                                    <span class="fa fa-circle text-muted m-r-10"></span>Pendiente
                                </a> 
                                <a href="#" class="list-group-item">
                                    <span class="fa fa-circle text-danger m-r-10"></span>Rechazados
                                </a> 
                                <a href="#" class="list-group-item">
                                    <span class="fa fa-circle text-success m-r-10"></span>Validados
                                </a> 
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12 mail_listing">
                    <div class="inbox-center">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="4">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light m-r-5" data-toggle="dropdown" aria-expanded="false"> Filtrar Por <b class="caret"></b> </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#fakelink" onClick="AbrirAlerta('*', '*', '1')">TODOS</a></li>
                                            <?
                                            $qr = $con->Query("select count(*) as t,  oficina from gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id where gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' and estado_archivo = '1' and estado_respuesta != 'cerrado' group by oficina");

                                            while ($row = $con->FetchAssoc($qr)) {
                                                $sc = new MSeccional;
                                                $sc->CreateSeccional("id", $row['oficina']);
                                                echo '<li class="divider"></li>';
                                                echo '<li><a href="#fakelink" onClick="AbrirAlerta(\''.$sc->GetId().'\', \'*\', \'1\')">'.$sc->GetNombre().' ('.$row['t'].')</a></li>';

                                                $areas = $con->Query("select count(*) as t,  tipo_documento from gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id where gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' and estado_archivo = '1' and estado_respuesta != 'cerrado' and oficina = '".$sc->GetId()."' group by oficina");

                                                while ($rowa = $con->FetchAssoc($areas)) {
                                                    $d = new MDependencias;
                                                    $d->CreateDependencias("id", $rowa['tipo_documento']);
                                                    echo '<li class="p-l-20"><a href="#fakelink"  onClick="AbrirAlerta(\''.$sc->GetId().'\', \''.$d->GetId().'\', \'1\')">'.$d->GetNombre().' ('.$rowa['t'].')</a></li>';
                                                }
                                            }
                                            ?>
                                                
                                            </ul>
                                        </div>
                                        <div class="btn-group dn">
                                            <button type="button" class="btn btn-default waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-refresh"></i> </button>
                                        </div>
                                    </th>
                                    <th class="hidden-xs" width="150">
                                        <div class="btn-group pull-right navigation_bar">
                                            <button type="button" id="navprev" class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" id="navnext" class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="detgraph">
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xs-7 m-t-20"></div>
                        <div class="col-xs-5 m-t-20">
                            <div class="btn-group pull-right navigation_bar">
                                <button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>


<script type="text/javascript">
	function AbrirAlerta(oficina, tipo, pagina){
		var URL = '/dashboard/e/'+oficina+'/'+tipo+'/'+pagina+'/';
        $("#detgraph").html('');
        $.ajax({
            type: 'POST',
            url: URL,
            success:function(msg){
                $("#detgraph").html(msg);
                var oficina = $("#pag_oficina").val();
                var tipo_documento = $("#pag_tipo_documento").val();
                var pagant = parseInt($("#PagAnt").val());
                var pagsig = parseInt($("#PagSig").val());
                var pagult = parseInt($("#PagUlt").val());

                pathAnt = "";
                pathSig = "";

                if (pagant == "0") {
                    $pathAnt = '<button type="button" id="navprev" disabled class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>';
                }else{
                    $pathAnt = '<button type="button" id="navprev" onClick="AbrirAlerta(\''+oficina+'\', \''+tipo_documento+'\', \''+pagant+'\')" class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>';
                }
                if (pagsig > pagult) {
                    $pathSig = '<button type="button" id="navnext" disabled class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>';
                }else{
                    $pathSig = '<button type="button" id="navnext" onClick="AbrirAlerta(\''+oficina+'\', \''+tipo_documento+'\', \''+pagsig+'\')" class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>';
                }   
                $(".navigation_bar").html($pathAnt+$pathSig);
            }
        });
	}
</script>
<?
	if ($_REQUEST['action'] == 'n') {
		echo '	<script>
					AbrirAlerta("'.$_REQUEST['id'].'", "'.$_REQUEST['cn'].'", "1")
				</script>';
	}else{
        echo '  <script>
                    AbrirAlerta("*", "*", "1")
                </script>';
    }
?>