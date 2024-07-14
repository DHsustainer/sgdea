<div class="row m-b-30">
    <div class="col-xs-7 m-t-20">
        <div class="btn-group" <?= $c->Ayuda('348', 'tog') ?>>
            <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light m-r-5" data-toggle="dropdown" aria-expanded="false"> Filtrar Por  <?= SUSCRIPTORCAMPONOMBRE ?>  <b class="caret"></b> </button>
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
    </div>
    <div class="col-xs-5 m-t-20">
        <div class="btn-group pull-right navigation_bar"></div>
    </div>
</div>

<div class="inbox-center">
    <table class="table table-hover">
        
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
        echo '  <script>
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
