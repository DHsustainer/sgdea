<div id="helper_menu">
	<div class="title_helper">Manual de Usuario</div>
	<div id="logo_helper"></div>

	<div id="header_helper"><?= ucfirst($id) ?></div>
	<ul id="lista_helper">
		<?
			if ($id == "inicio") {
				include(VIEWS.'/ayuda/dashboard.php');
			}
			if ($id == "gestion") {
				include(VIEWS.'/ayuda/gestion.php');
			}
			if ($id == "agenda") {
				include(VIEWS.'/ayuda/agenda.php');
			}
			if ($id == "procesos") {
				include(VIEWS.'/ayuda/procesos.php');
			}
			if ($id == "caratula") {
				include(VIEWS.'/ayuda/caratula.php');
			}
		?>
	</ul>
</div>
<div id="content_menu">
	
</div>

<style>
	
	#helper_menu{
		float: left;
		width: 230px;
		background: #E6E6E6;
		height: 100%;
	}
	#content_menu{
		overflow: none;
		background: RGBA(0,0,0, 0.1);
		height: 100%;
		margin: 0 auto;
	}

	#content_menu img{
		margin-top: 50px;
	}

	.title_helper{
		margin-top: 20px;
		font-size: 20px;
	}
	#logo_helper{
		margin: 0 auto;
		background: url(<?=ASSETS?>/images/logo_expedientes2.png) no-repeat;
		background-size: 170px;
		height: 40px;
		width: 170px;
		margin-top: 17px;
	}

	#header_helper{
		background: #0090DD;
		height: 35px;
		line-height: 35px;
		text-align: center;
		font-size: 20px;
		margin-top: 45px;
		color: #FFF;
	}

	#lista_helper{
		list-style: none;
		padding: 0px;
		margin-top: 0px;
	}

	#lista_helper li{
		height: 30px;
		line-height: 30px;
		color: #4F4F4F;
		padding-left: 15px;
		font-size: 14px;
		text-align: left;
	}
	#lista_helper li:hover{
		background: #F5F5F5;
		cursor: pointer;
	}
	#lista_helper li.active{
		background: #B3B3B5;
		color: #FFF;
	}


</style>