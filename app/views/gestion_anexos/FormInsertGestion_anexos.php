
<div id="form" class="white">
    <form id="upload" method="post" action="/gestion_anexos/cargar/<?=$object->GetId()?>/" enctype="multipart/form-data">
<?

        if (M_PDFA == "1"){
            echo '<div class="alert alert-info mensaje_alerta" style="margin-bottom:0px">'.PDFA.'</div>';
        }

?>
        <div class="row">
            <div class="<?= ($_SESSION['MODULES']['inmaterializacion'] == "0")?"col-md-12":"col-md-6" ?>  col-sm-12 col-xs-12"  <?= $c->Ayuda('329', 'tog') ?>>
                <div id="drop" style="margin-left: auto; margin-right: auto;" class="dropzone  dropify-message <?= $pathw ?> fullwidthblock">

                    <a class="m-b-30 m-t-30">
                        <span class="mdi mdi-cloud-upload cloudicon"></span> 
                        <br>ANEXAR DOCUMENTOS ADJUNTOS AQUÍ<br><br>
                    </a>
                    <div style="display:none">
                        <input type="file" name="upl" multiple />
                    </div>
                    <ul></ul>
                </div>
            </div>
<?php 	
	if ($_SESSION['MODULES']['digitalizacion'] == "0"): 
        $pathw = (trim($_SESSION['MODULES']['inmaterializacion']) == "1")?" ":"fullwidthblock";
        if ($_SESSION['MODULES']['inmaterializacion'] == "1") {
?>
            <div class="col-md-6 hidden-xs hidden-sm">
                <div id="dropdocto text-info " class="dropify-message" <?= $c->Ayuda(78, 'tog') ?>>
                    <div class="m-b-30 text-center">
                        <span class="mdi mdi-file-pdf cloudicon"></span> <br>
                        <a href="/documentos_gestion/nuevo/<?= $object->GetId() ?>/" class="btn btn-info">Producir Documento</a>
                    </div>
                </div>
            </div>
<?
        }
	endif 
?>
        </div>          
    </form>    
</div>

<style>
   
.dropify-message{
    color: #CCC;
}
.dropify-message a{
    font-weight: normal;
    color: #CCC;
    text-align:center;
}
.dropify-message .cloudicon{
    font-size: 50px;
}
#drop {
    text-align: center;
    font-weight: bold;
}

#drop.in {
    z-index: 9999;
    position: fixed;
    width: 100%;
    height: 90%;
    top: 70px;
    left:0px;

    background-color: #373a3d;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;

    background-image: -webkit-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: -o-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    -webkit-background-size: 40px 40px;
    background-size: 40px 40px;

    -webkit-animation: progress-bar-stripes 2s linear infinite;
    -o-animation: progress-bar-stripes 2s linear infinite;
    animation: progress-bar-stripes 2s linear infinite;
}

#drop.hover {
    background-color: #373a3d;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;

    background-image: -webkit-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: -o-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    -webkit-background-size: 40px 40px;
    background-size: 40px 40px;

    -webkit-animation: progress-bar-stripes 2s linear infinite;
    -o-animation: progress-bar-stripes 2s linear infinite;
    animation: progress-bar-stripes 2s linear infinite;

    content: "Arrastre sus documentos aqui";
}

#drop.fade {
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
    opacity: 1;
}
.dropzone{
    border: none;
    cursor:pointer;
    text-align: center;
}
#upload:hover{
    background-color: #373a3d;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;

    background-image: -webkit-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: -o-linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    background-image: linear-gradient(45deg,rgba(0,0,0,.15) 25%,transparent 25%,transparent 50%,rgba(0,0,0,.15) 50%,rgba(0,0,0,.15) 75%,transparent 75%,transparent);
    -webkit-background-size: 40px 40px;
    background-size: 40px 40px;

    -webkit-animation: progress-bar-stripes 2s linear infinite;
    -o-animation: progress-bar-stripes 2s linear infinite;
    animation: progress-bar-stripes 2s linear infinite;

}

#upload{
    background-color: #373a3d; 
    padding: 10px; 
    margin-top:25px
}

#upload ul{
    list-style:none;
    margin-bottom:0px !important;
    padding-left:0px;
}
#upload ul li{
    background-color:#CCC;
    background-image:-webkit-linear-gradient(top, #333639, #303335);
    background-image:-moz-linear-gradient(top, #333639, #303335);
    background-image:linear-gradient(top, #333639, #303335);
    border-top:1px solid #3d4043;
    border-bottom:1px solid #2b2e31;
    padding:15px;
    height: 75px;
    position: relative;
}
#upload ul li input{
    display: none;
}
#upload ul li p{
    width: 70%;
    overflow: hidden;
    white-space: nowrap;
    color: #EEE;
    font-size: 16px;
    font-weight: bold;
    position: absolute;
    left: 100px;
    text-align:left;
}
#upload ul li i{
    font-weight: normal;
    font-style:normal;
    color:#7f7f7f;
    display:block;
}
#upload ul li canvas{
    top: 15px;
    left: 32px;
    position: absolute;
}
#upload ul li span{
    width: 15px;
    height: 12px;
    background: url('<?= HOMEDIR.DS ?>app/views/assets/images/icons.png') no-repeat;
    position: absolute;
    top: 34px;
    right: 33px;
    cursor:pointer;
}
#upload ul li.working span{
    height: 16px;
    background-position: 0 -12px;
}
#upload ul li.error p{
    color:red;
}

.menu-expediente{
    font-size: 30px;
    border-right:1px solid #E5E5E5;
}
.submenu_box{
    background: #f7fafc;
    border:1px solid #E5E5E5;
}

</style>  

<script type="text/javascript">


    $(document).bind('dragover', function (e) {

        var pos = 50;

        var dropZone = $('#drop'),

            timeout = window.dropZoneTimeout;

        if (!timeout) {

            $('#folders-list-content').animate({ scrollTop : 0 }, 'fast');

            dropZone.addClass('in');

        } else {

            clearTimeout(timeout);

        }

        var found = false,

            node = e.target;

        do {

            if (node === dropZone[0]) {

                found = true;

                break;

            }

            node = node.parentNode;

        } while (node != null);

        if (found) {

            dropZone.addClass('hover');

        } else {

            dropZone.removeClass('hover');

        }

        window.dropZoneTimeout = setTimeout(function () {

            window.dropZoneTimeout = null;

            dropZone.removeClass('in hover');

            $('#folders-list-content').animate({ scrollTop : 0 }, 'fast');

        }, 100);

    });

</script>    
<script src="<?=ASSETS?>/js/jquery.knob.js"></script>
<!-- jQuery File Upload Dependencies -->
<script src="<?=ASSETS?>/js/jquery.ui.widget.js"></script>
<script src="<?=ASSETS?>/js/jquery.iframe-transport.js"></script>
<script src="<?=ASSETS?>/js/jquery.fileupload.js"></script>
<!-- Our main JS file -->
<script src="<?=ASSETS?>/js/script.js"></script>	