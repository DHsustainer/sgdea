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
    <button class="right-side-toggle waves-effect waves-light btn btn-info m-r-20 pull-left dn" id="btn_sidebar">Ver Solicitud</button>
<div class="row">
    <!-- Left sidebar -->
    <div class="col-md-12">
        <div class="white-box">
            <!-- row -->
            <div class="row">
                <div class="col-lg-2 col-md-3  col-sm-12 col-xs-12 inbox-panel">
                    <div> 
                        <?
                        if (INTERFAZCORRESPONDENCIAV2 == "0") {
                        ?>
                            <a href="/gestion/correo/" class="btn btn-custom btn-block waves-effect waves-light">Registar Envío</a>
                        <?
                        }
                        ?>

                        <div class="list-group mail-list m-t-20"> 
                            <a href="/dashboard/" <?= $c->Ayuda('349', 'tog') ?>class="list-group-item active">Mis <?= CAMPOEXPEDIENTE ?>s</a> 
                            <a href="/dashboard/efavoritos/" <?= $c->Ayuda('350', 'tog') ?>class="list-group-item ">Favoritos</a> 
                            <a href="/dashboard/earchivados/" <?= $c->Ayuda('351', 'tog') ?>class="list-group-item ">Cerrados</a> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-12 col-xs-12 mail_listing">
                    <div class="inbox-center">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="4">
                                        <div class="btn-group" <?= $c->Ayuda('348', 'tog') ?>>
                                            <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light m-r-5" data-toggle="dropdown" aria-expanded="false"> Filtrar Por <?= SUSCRIPTORCAMPONOMBRE ?> <b class="caret"></b> </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#fakelink" onClick="AbrirAlerta('*', '1')">TODOS</a></li>
                                            <?
                                            $qr = $con->Query("select count(*) as t, suscriptor_id from gestion where nombre_destino = '".$_SESSION['user_ai']."' and estado_archivo = '1' group by suscriptor_id");

                                            
                                            while ($row = $con->FetchAssoc($qr)) {
                                                $sc = new MSuscriptores_contactos;
                                                $sc->CreateSuscriptores_contactos("id", $row['suscriptor_id']);
                                                echo '<li class="divider"></li>';
                                                echo '<li><a href="#fakelink" onClick="AbrirAlerta(\''.$row['suscriptor_id'].'\', \'1\')">'.$sc->GetNombre().' ('.$row['t'].')</a></li>';

                                            }
                                            ?>
                                                
                                            </ul>
                                        </div>
                                        <div class="btn-group dn">
                                            <button type="button" class="btn btn-default waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-refresh"></i> </button>
                                        </div>
                                    </th>
                                    <th class="hidden-xs" width="150">
                                        <div class="btn-group pull-right navigation_bar"></div>
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
                            <div class="btn-group pull-right navigation_bar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>

<?
    $u = new MUsuarios;
    $u->CreateUsuarios("user_id", $_SESSION['usuario']);
    if ($u->GetFirma() == "firma-de-fidel-10-de-septiembre-de-2009.jpg") {
?>
        <div class="col-lg-3 col-xs-12 dn">
            <div class="white-box">
                <a href="#" id="sa-warning2">Warning message</a> 
            </div>
        </div>
        <script type="text/javascript">
            /*
                setTimeout(function(){
                    $( "#sa-warning2" ).trigger( "click" );
                }, 500);
            */
        </script>
<?
    }
?>
<script type="text/javascript">
	function AbrirAlerta(id, pagina){
		var URL = '/dashboard/f/'+id+'/'+pagina+'/';
        $("#detgraph").html('');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: URL,
            success:function(msg){
                $("#detgraph").html(msg['a']);

                    
                    var id = msg['pag_oficina'];
                    var pagant = parseInt(msg['PagAnt']);
                    var pagsig = parseInt(msg['PagSig']);
                    var pagult = parseInt(msg['PagUlt']);

                    pathAnt = "";
                    pathSig = "";

                    if (pagant == "0") {
                        $pathAnt = '<button type="button" id="navprev" disabled class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>';
                    }else{
                        $pathAnt = '<button type="button" id="navprev" onClick="AbrirAlerta(\''+id+'\', \''+pagant+'\')" class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>';
                    }
                    if (pagsig > pagult) {
                        $pathSig = '<button type="button" id="navnext" disabled class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>';
                    }else{
                        $pathSig = '<button type="button" id="navnext" onClick="AbrirAlerta(\''+id+'\', \''+pagsig+'\')" class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>';
                    }   
                    $(".navigation_bar").html($pathAnt+$pathSig);

            }
        });
	}
    function LoadAlertas(idg){
        $("#btn_sidebar").click();

        var URL = '/dashboard/ald/'+idg+'/U/';
        $("#detail_alerta").html('<svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg>');
        $.ajax({
            type: 'POST',
            url: URL,
            success:function(msg){
                $("#detail_alerta").html(msg);
            }
        });
    }
</script>
<?
	if ($_REQUEST['action'] == 'n') {
		echo '	<script>
					AbrirAlerta("'.$_REQUEST['id'].'", "1")
				</script>';
	}else{
        echo '  <script>
                    AbrirAlerta("*", "1")
                </script>';
    }
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });

</script>
<!-- ============================================================== -->
<!-- start right sidebar -->
<!-- ============================================================== -->
<div class="right-sidebar" style="display: block;">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
        <div class="slimscrollright" style="overflow: hidden; width: auto; height: 100%;">
            <div class="rpanel-title"> RESUMEN DE LA SOLICITUD <span><i class="ti-close right-side-toggle"></i></span></div>
            <div class="r-panel-body" id="detail_alerta">
                
            </div>
        </div>
    </div>
</div>


<!-- ============================================================== -->
<!-- end right sidebar -->
<!-- ============================================================== -->