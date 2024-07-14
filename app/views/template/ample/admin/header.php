<?
    include_once(MODELS.DS.'Usuarios_configurar_accesosM.php');

    $me = new MUsuarios;
    $me->CreateUsuarios("user_id", $_SESSION["usuario"]);

    $nombre_usuario = $me->GetP_nombre();

    if ($_SESSION["suscriptor_id"] == "") {
            if ($me->GetProcesos() != "1") {
                echo "<div class='alert alert-warning' role='alert' style='position:absolute; width:100%; z-index:999; text-align:center' id='panel_alerta_update'>Se ha actualizado su SGDEA descubre <a href='https://laws.com.co/notas-de-actualizacion/' class='alert-link' onClick='DisableAlert()' target='_blank'>aqui</a> las novedades de esta actualización <div style='float:right; cursor:pointer' onClick='DisableAlert()' class='alert-link fa fa-close'></div></div>";
            }
    }
?>
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part"  id="header">
        <!-- Logo -->
<?

    global $c;
    global $f;
    $nombre_usuario = $me->GetP_nombre();

    $sus = new MSuscriptores_contactos;
    $sus->CreateSuscriptores_contactos("id", $_SESSION['suscriptor_id']);
    $nombre_usuario = $sus->GetNombre();


    $ls = substr($nombre_usuario, 0, 1);

    $u = new MUsuarios;
    $u->CreateUsuarios("user_id", $_SESSION['usuario']);
    
    $_SESSION['logo_profile'];
  
    

    $sadmin = new MSuper_admin;
    $sadmin->CreateSuper_admin("id", "6");


    $path = ROOT.DS.'plugins/thumbnails/';
    $image_white = $sadmin->Getimage_white();
    $imajotipo   = $sadmin->GetImajotipo();
    $logo_white  = $sadmin->Getlogo_white();
    $text_tipo   = $sadmin->GetFoto_perfil();

    $exists = file_exists( $path.$image_white );
    if (!$exists) { $image_white = 'logo_color.png'; }else{ $image_white = $image_white; }

    $exists = file_exists( $path.$imajotipo );
    if (!$exists) { $imajotipo = 'logo_color.png'; }else{ $imajotipo = $imajotipo; }

    $exists = file_exists( $path.$logo_white );
    if (!$exists) { $logo_white = 'text_color.png'; }else{ $logo_white = $logo_white; }

    $exists = file_exists( $path.$text_tipo );
    if (!$exists) { $text_tipo = 'text_color.png'; }else{ $text_tipo = $text_tipo; }
    
    if ($sadmin->GetFoto_perfil() == "") {
        echo '<div class="light-logo" id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'"></div>';
    }else{
        echo '<!-- Logo -->
        <a class="logo" href="'.HOMEDIR.DS.'dashboard/">
            <!-- Logo icon image, you can use font-icon also -->
            <b>
                <img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$image_white.'" alt="home" style="width:33px" class="dark-logo" />
                <img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$imajotipo.'" alt="home" style="width:33px" class="light-logo" />
            </b>
            <!-- Logo text image you can use text also -->
            <span class="hidden-xs">
            <!--This is dark logo text-->
                <img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$logo_white.'" alt="home" style="width:139px" class="dark-logo" />
            <!--This is light logo text-->
                <img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$text_tipo.'" alt="home" style="width:139px" class="light-logo" />
            </span> 
        </a>';


       # echo '<div class="light-logo" id="del-logo" onClick="window.location.href=\'\'" style="background: URL() no-repeat; background-size: contain !important; "></div>';
        $_SESSION['logo_profile'] = $sadmin->GetFoto_perfil();
    }
?>   
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li class="">
                <a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs">
                    <i class="ti-close ti-menu"></i>
                </a>
            </li>
<?  
if($_SESSION['usuariosuscriptor'] == "0"){
            echo '
            <li class="dropdown" '.$c->Ayuda("6", "tog").' >
                <a class="waves-effect waves-light  hidden-sm hidden-xs" href="/dashboard/" > <i class="mdi mdi-check-circle" ></i>';

            $notificaciones = $me->GetCountNotifications(); 
            if($notificaciones > 0){
                echo '<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>';
            }
            echo '</a>
            </li>';
}
   
?>


            <li class="dropdown hidden-sm hidden-xs dn"  <?= $c->Ayuda("9", "tog") ?>>
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="/dashboard/"> <i class="mdi mdi-map-marker"></i>         
                </a>
                <ul class="dropdown-menu dropdown-tasks animated slideInDown">
                    <?php if($_SESSION['MODULES']['multiempresa'] == 1 && count($_SESSION['listempresas']) > 0){ ?>
                            <li>
                            <a href="#">
                                <div>
                                    <p class="par-activitie"> 
                                        <strong>Empresa:</strong>
                                        <span class="pull-right text-muted">
                                            <select  placeholder="Empresa" class="form-control" name="currentempresa2" id="currentempresa2" onchange="ChangeEmpresa2(this.value);" style="width:190px !important; margin-top:-8px;">
                                            <?php
                                                foreach ($_SESSION['listempresas'] as $key => $value) {
                                                    $selectf = '';
                                                    if(HOMEDIR == $value[3]){
                                                         $selectf = 'selected';
                                                    }
                                                    echo '<option value="'.$value[3].'" '.$selectf.'>'.$value[0].'</option>';
                                                }
                                            ?>
                                            </select>
                                        </span>
                                    </p>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="#">
                            <div>
                                <p class="par-activitie"> 
                                    <strong>Ciudad:</strong>
                                    <span class="pull-right text-muted">
                                    <?

                                    if($_SESSION['cambio_ciudad'] == 1){
                                        echo '<select id="currentciudad" onChange="ChangeCiudad()" class="form-control" style="width:190px !important; margin-top:-8px;">';
                                        global $con;
                                        $MUsuarios_configurar_accesos = new MUsuarios_configurar_accesos;
                                        $query = $MUsuarios_configurar_accesos->ListarCiudadesUsuario();
                                        $carea = "N";
                                         while ($row = $con->FetchAssoc($query)) {
                                            if($_SESSION['ciudad'] == $row['code']){
                                                $SESSIONciudad = $row['code'];
                                                echo '<option value="'.$row['code'].'" selected>'.$row['Name'].'</option>';
                                            } else {
                                                echo '<option value="'.$row['code'].'">'.$row['Name'].'</option>';
                                                if($carea == "N"){
                                                    $SESSIONciudad = $row['code'];
                                                    $carea = "S";
                                                }
                                            }                               
                                         }
                                         $_SESSION['ciudad'] = $SESSIONciudad;
                                        echo '</select>';
                                    } else{
                                        $cit = new MCity;
                                        $cit->CreateCity("code", $_SESSION['ciudad']);
                                        echo $cit->GetName();
                                    }           
                                    ?>
                                    </span>
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p class="par-activitie"> 
                                    <strong>Oficina:</strong>
                                    <span class="pull-right text-muted">
                                    <?
                                    if($_SESSION['cambio_ciudad'] == 1){
                                        echo '<select id="currentoficina" onChange="ChangeOficina()" class="form-control" style="width:190px !important; margin-top:-8px;">';
                                        $MUsuarios_configurar_accesos = new MUsuarios_configurar_accesos;
                                        $query = $MUsuarios_configurar_accesos->ListarOficinasUsuario();
                                        $carea = "N";
                                         while ($row = $con->FetchAssoc($query)) {
                                            if($_SESSION['seccional'] == $row['id']){
                                                $SESSIONseccional = $row['id'];
                                                echo '<option value="'.$row['id'].'" selected>'.$row['nombre'].'</option>';
                                            } else {
                                                echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
                                                if($carea == "N"){
                                                    $SESSIONseccional = $row['id'];
                                                    $carea = "S";
                                                }
                                            }   
                                         }
                                         $_SESSION['seccional'] = $SESSIONseccional;
                                        echo '</select>';
                                    } else{
                                        $of = new MSeccional;
                                        $of->CreateSeccional("id", $_SESSION['seccional']);
                                        echo $of->GetNombre();
                                    }
                                    ?>
                                    </span>
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p class="par-activitie"> 
                                    <strong>Area:</strong>
                                    <span class="pull-right text-muted">
                                <?
                                    if($_SESSION['cambio_area'] == 1){
                                        echo '<select id="currentarea" onChange="ChangeArea()" class="form-control" style="width:190px !important; margin-top:-8px;">';
                                        $u = new MUsuarios_configurar_accesos;
                                        $query = $u->ListarAreasUsuarioNew();
                                        $carea = "N";
                                         while ($row = $con->FetchAssoc($query)) {
                                            if($_SESSION['area_principal'] == $row['id']){
                                                $SESSIONarea_principal = $row['id'];
                                                $carea = "S";
                                                echo '<option value="'.$row['id'].'" selected>'.$row['nombre'].'</option>';
                                            } else {
                                                echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
                                                if($carea == "N"){
                                                    $SESSIONarea_principal = $row['id'];
                                                    $carea = "S";
                                                }
                                            }
                                         }
                                         $_SESSION['area_principal'] = $SESSIONarea_principal;
                                        echo '</select>';
                                    } else{
                                        $ar = new MAreas;
                                        $ar->CreateAreas("id", $_SESSION['area_principal']);
                                        echo $ar->GetNombre();
                                    }
                                ?>
                                    </span>
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p class="par-activitie"> 
                                    <strong>Archivo:</strong> 
                                    <span class="pull-right text-muted">
                                        <select id="currentseccional" onChange="ChangeArchivo()" class="form-control" style="width:190px !important; margin-top:-8px;">
                                        <?
                                        if ($_SESSION["typefolder"] == "1") {
                                            if($_SESSION['archivo_gestion'] == '1'){
                                                echo '<option value="1">Archivo Gestión</option>';
                                            }
                                            if($_SESSION['archivo_central'] == '1'){
                                                echo '<option value="2">Archivo Central</option>';
                                            }
                                            if($_SESSION['archivo_historico'] == '1'){
                                                echo '<option value="3">Archivo Histórico</option>';
                                            }
                                        }elseif ($_SESSION["typefolder"] == "2") {                              
                                            if($_SESSION['archivo_central'] == '1'){
                                                echo '<option value="2">Archivo Central</option>';
                                            }
                                            if($_SESSION['archivo_gestion'] == '1'){
                                                echo '<option value="1">Archivo Gestión</option>';
                                            }
                                            if($_SESSION['archivo_historico'] == '1'){
                                                echo '<option value="3">Archivo Histórico</option>';
                                            }
                                        }elseif ($_SESSION['typefolder'] == "3") {
                                            if($_SESSION['archivo_historico'] == '1'){
                                                echo '<option value="3">Archivo Histórico</option>';
                                            }
                                            if($_SESSION['archivo_central'] == '1'){
                                                echo '<option value="2">Archivo Central</option>';
                                            }
                                            if($_SESSION['archivo_gestion'] == '1'){
                                                echo '<option value="1">Archivo Gestión</option>';
                                            }
                                        }else{
                                            if($_SESSION['archivo_gestion'] == '1'){
                                                echo '<option value="1">Archivo Gestión</option>';
                                            }
                                            if($_SESSION['archivo_central'] == '1'){
                                                echo '<option value="2">Archivo Central</option>';
                                            }
                                            if($_SESSION['archivo_historico'] == '1'){
                                                echo '<option value="3">Archivo Histórico</option>';
                                            }
                                        }
                                        ?>
                                        </select>
                                    </span>
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p class="par-activitie"> 
                                    <strong>Usuario:</strong> 
                                    <span class="pull-right text-muted">
                                    <?php 
                                    if($_SESSION['cambio_usuario'] == 1){ 
                                        $MUsuarios_configurar_accesos = new MUsuarios_configurar_accesos;
                                        if($_SESSION["usuario_real_cambio"] != ""){
                                            $query = $MUsuarios_configurar_accesos->ListarUsuarioUsuario($_SESSION["usuario_real_cambio"],$_SESSION["seccional_real_cambio"],$_SESSION["area_principal_real_cambio"]);
                                        } else {
                                            $query = $MUsuarios_configurar_accesos->ListarUsuarioUsuario($_SESSION["usuario"],$_SESSION["seccional"],$_SESSION["area_principal"]);

                                        }
                                        if($con->NumRows($query) > 0){
                                            echo '<select id="currentusuariocambio" onChange="ChangeUsuario()" class="form-control" style="width:190px !important; margin-top:-8px;">';
                                            echo '<option value="">Usuario actual</option>';
                                            while ($row = $con->FetchAssoc($query)){
                                                if($_SESSION['usuario'] == $row['user_id']){

                                                    echo '<option value="'.$row['user_id'].'" selected>'.$row['nombre'].'</option>';
                                                }else{

                                                    echo '<option value="'.$row['user_id'].'">'.$row['nombre'].'</option>';
                                                }
                                            }
                                            if($_SESSION["usuario_real_cambio"] != ""){
                                                echo '<option value="'.$_SESSION["usuario_real_cambio"].'">Volver al usuario inicial</option>';
                                            }
                                            echo '</select>';
                                        }
                                    } 
                                    ?>
                                    </span>
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
<?
    if($_SESSION['usuariosuscriptor'] == "0"){
?>            
            <li class="dropdown hidden-sm hidden-xs" <?= $c->Ayuda("10", "tog") ?>>   
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="mdi mdi-heart"></i></a>
              
                    <ul class="dropdown-menu mailbox animated bounceInDown">
                        <li>
                            <div class="drop-title">CONSUMO RESPONSABLE</div>
                        </li>
                        <li>
                            <a href="#">
                                <div>
                                    <p class="par-activitie">  <strong>Menos Papel:</strong> <span class="pull-right text-muted"><?= $c->GetCalculoPapel("a") ?></span> </p>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p class="par-activitie">  <strong>Menos Resmas:</strong> <span class="pull-right text-muted"><?= $c->GetCalculoPapel("b") ?></span> </p>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p class="par-activitie"> <strong>Más Arboles:</strong> <span class="pull-right text-muted"><?= $c->GetCalculoPapel("c") ?></span> </p>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="/dashboard/VerCalculodeAhorro/"> <strong>VER MÁS DETALLES</strong> <i class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
            </li>
<?
    }
?>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <?
                if($_SESSION['usuariosuscriptor'] == "0"){
            ?>
            <li>
                <input type='hidden' name='geturi' id='geturi' value='<?= $_SERVER['REQUEST_URI'] ?>' />
                <form role="search" class="app-search " id="formbusqueda" action="/dashboard/buscador/" method="POST">
                    <input type="hidden" name="auth_token" value="<?= $f->generateFormToken('loginform')?>" />
                    <input type="text" id="del-input-buscar" name= "del-input-buscar" placeholder="Buscar..." class="form-control" value="<?= $c->sql_quote($_REQUEST["del-input-buscar"]) ?>" > 
                    <a href="javascript:;" onclick="document.getElementById('formbusqueda').submit();"><i class="fa fa-search"></i></a> 
                </form>
            </li>
            <?
            }
            ?>
            <li class="dropdown">

                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> 
                    <img src="<?= HOMEDIR.DS.'app/plugins/thumbnails/'.$me->GetFoto_perfil() ?>"  alt="user-img" width="36" class="img-circle">
                    <b class="hidden-xs"><?= $me->GetP_nombre() ?></b><span class="caret"></span> 
                </a>


                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="<?= HOMEDIR.DS.'app/plugins/thumbnails/'.$me->GetFoto_perfil() ?>" alt="user"></div>
                            <div class="u-text">
                                <h4><?= $me->GetP_nombre() ?></h4>
                                <p class="text-muted"><?= $_SESSION['usuario'] ?></p><a href="/dashboard/profile/" class="btn btn-rounded btn-danger btn-sm">Configurar Cuenta</a></div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= HOMEDIR.DS."login".DS."kill".DS ?>"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>