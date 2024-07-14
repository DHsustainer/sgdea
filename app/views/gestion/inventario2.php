
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Ordenar registros con Ajax y efecto Drag'n Drop</title>
<script src="<?=ASSETS?>/js/jquery.js"></script>
<script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jquery-ui-1.8.12.custom.min.js'></script>

<style type="text/css">

body{ 
	margin:0; 
	padding:0
}
.cabecera{
     background: #4A3C31;
     border-bottom: 5px solid #69AD3C;
     width: 100%;
 }
.cabecera img{ 
     margin:40px 0 0 30px;
 }
.content{
	padding-top:20px;
	width:320px;
	margin:0 auto;
}
ul{
	list-style:none;
	margin:0;
	padding:0
}
ul li{
	display:block;
	background:#F6F6F6;
	border:1px solid #CCC;
	color:#3594C4;
	margin-top:3px;
	height:20px;
	padding:3px;
}
.ui-state-highlight{ background:#FFF0A5; border:1px solid #FED22F}
.msg{
	color:#0C0;
	font:normal 11px Tahoma
}

</style>
<script type="text/javascript">
$(document).ready(function(){
	$("ul#articulos").sortable({ placeholder: "ui-state-highlight",opacity: 0.6, cursor: 'move', update: function() {
		var order = $(this).sortable("serialize");
		$.post("order.php", order, function(respuesta){
			$(".msg").html(respuesta).fadeIn("fast").fadeOut(2500);
		});
	}
	});
});</script>
</head>

<body>

<div class="content">
	<h3>Articulos</h3>
    
	<ul id="articulos">
    				<li id="articulo-4">Medias</li>
						<li id="articulo-5">Sombreros</li>
						<li id="articulo-6">Jeans</li>
						<li id="articulo-1">Zapatos</li>
						<li id="articulo-2">Camisas</li>
						<li id="articulo-3">Guantes</li>
			    </ul>
    <div class="msg"></div>
</div>

</body>
</html>
