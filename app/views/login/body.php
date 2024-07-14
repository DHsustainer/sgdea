<?
    $sadmin = new MSuper_admin;
    $sadmin->CreateSuper_admin("id", "6");

    $contenido_email = URL_IMAGES;
    $result = $contenido_email."/images/jpgs/".date("d").".jpg";
?>
<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="<?= HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetImajotipo() ?>">
<title>#TITLE#</title>
<!-- Bootstrap Core CSS -->
<link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/colors/blue.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
  .login-register{
      background: url(<?= $result ?>) no-repeat center center / cover !important;
  }
  .white-box {
      box-shadow: none;
  }
</style>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  #CONTENIDO#
</section>
#FOOTER#
<!-- jQuery -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
