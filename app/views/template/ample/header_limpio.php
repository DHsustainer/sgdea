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
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>