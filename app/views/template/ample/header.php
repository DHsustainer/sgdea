<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part"  id="header">
        <!-- Logo -->
<?
    $me = new MUsuarios;
    $me->CreateUsuarios("user_id", $_SESSION["usuario"]);
   
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
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="mdi mdi-check-circle"></i>
<?  
    $query = $con->Query("select * from alertas_suscriptor where suscriptor_id = '".$_SESSION['suscriptor_id']."'");
    $n = $con->NumRows($query);

    if ($n > 0) {
        echo '      <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>';
    }
?>                    
                </a>
                <ul class="dropdown-menu mailbox animated bounceInDown">
                    <li>
                        <div class="drop-title">Tienes <?= $n ?> Notificaciones</div>
                    </li>
                    <li style="max-height: 500px; overflow: hidden; overflow-y: auto;">
                        <div class="message-center">
                    <?

                        while ($row = $con->FetchArray($query)) {
                            
                            $type = $row['type'];

                            switch ($type) {
                                case 'doc_recha':
                                    $g = new MGestion;
                                    $g->CreateGestion("id", $row['id_gestion']);

                                    $tdoc = $g->GetTipo_documento();

                                    switch ($g->GetEstado_respuesta()) {
                                        case 'Pendiente':
                                            $t = 'p';
                                            break;
                                        case 'Rechazado':
                                            $t = 'r';
                                            break;
                                        case 'En Espera Correccion':
                                            $t = 's';
                                            break;
                                        case 'Abierto':
                                            $t = 'a';
                                            break;      
                                        default:
                                            $t = 'p';
                                            break;
                                    }
                                    break;

                                case 'sol_pausada':
                                    $t = 's';
                                    $g = new MGestion;
                                    $g->CreateGestion("id", $row['id_gestion']);

                                    $tdoc = $g->GetTipo_documento();
                                    break;

                                case 'sol_rechazo':
                                    $t = 'r';
                                    $g = new MGestion;
                                    $g->CreateGestion("id", $row['id_gestion']);

                                    $tdoc = $g->GetTipo_documento();
                                    break;
                                    
                                case 'sol_aceptada':
                                    $t = 'a';
                                    $g = new MGestion;
                                    $g->CreateGestion("id", $row['id_gestion']);

                                    $tdoc = $g->GetTipo_documento();
                                    break;            
                                
                                default:
                                    $t = 'p';
                                    break;
                            }
                            
                            $act = "";
                            if ($row['estado'] == "0") {
                                $act = 'active';
                            }

                            $url = '/dashboard/n/'.$t.'/'.$tdoc.'/';

                            echo '  <a href="'.$url.'" class="'.$act.'">
                                        <div class="mail-contnet">
                                            <span class="mail-desc">'.$row['alerta'].'</span> 
                                            <span class="time">'.$f->nicetime($row['fechahora']).'</span> 
                                        </div>
                                    </a>';
                        }
                    ?>
                            
                        </div>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
                <input type='hidden' name='geturi' id='geturi' value='<?= $_SERVER['REQUEST_URI'] ?>' />
                <form role="search" class="app-search m-r-10" action="/dashboard/buscador/" method="POST">
                    <input type="text" id="del-input-buscar" name= "del-input-buscar" placeholder="Consultar..." class="form-control" value="<?= $c->sql_quote($_REQUEST["del-input-buscar"]) ?>" > <a href=""><i class="fa fa-search"></i></a> 
                </form>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <span width="36" class="btn btn-danger btn-circle"><?= $ls ?></span> <span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-text">
                                <h5><?= $nombre_usuario ?></h5>
                                <p class="text-muted">Id: <?= $sus->Getcod_ingreso() ?></p>

                            </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/dashboard/profileSuscriptor/"><i class="ti-settings"></i> Configurar Cuenta</a></li>
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