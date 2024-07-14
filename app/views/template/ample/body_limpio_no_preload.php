
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= HOMEDIR ?>/app/plugins/theme/plugins/images/favicon.png">
    <title>#TITLE#</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/css/colors/megna.css" id="theme" rel="stylesheet">
    <link href="<?= HOMEDIR ?>/app/plugins/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">

    <script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= HOMEDIR ?>/app/plugins/theme/ampleadmin/bootstrap/dist/js/bootstrap.min.js"></script>
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        #HEADER#
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                #CONTENIDO#
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> <?= date('Y') ?> &copy; <?= PROJECTNAME ?> by Laws Leyes Sistematizadas </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <style>
        @media (min-width: 768px){
            .navbar-static-top {
                padding-left: 0px;
            }
            #page-wrapper {
                position: inherit;
                margin: 0px;
            }
        }
    </style>
</body>

</html>