<div  style="display:none">
<div class="title right">Configurar Sub-Serie</div>
<select style="width:250px; height:35px;" class="form-control" id="id_dependencia_raiz" name="id_dependencia_raiz" onchange="dependencia_item('id_dependencia_raiz','tipo_documento','/dependencias/optiondependencias/')">
	<option>Seleccione una Serie</option>
	<?
		$s = new MDependencias;
		$q = $s->ListarDependencias(" where dependencia = '0'");

		while ($row = $con->FetchAssoc($q)) {
			if ($id != ""){
				if ($dep->GetDependencia() == $row['id']) {
					echo "<option value='".$row['id']."' selected = 'selected'> ".$row['nombre']."</option>";
				}else{
					echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
				}
			}else{
				echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
			}
		}
	?>
</select>
<select style="width:250px; height:35px;" class="form-control" id="tipo_documento" name="tipo_documento">
	<option>Seleccione una Sub-Serie</option>
	<?
		if ($id != ""){

			$s = new MDependencias;
			$q = $s->ListarDependencias(" where dependencia = '".$dep->GetDependencia()."'");

			while ($row = $con->FetchAssoc($q)) {
				if ($dep->GetId() == $row['id']) {
					echo "<option value='".$row['id']."' selected = 'selected'> ".$row['nombre']."</option>";
				}else{
					echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
				}
			}

		}
	?>
</select>
<input type="button" onClick="GetDetailDependencia()" value="Cambiar">	
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default block1 m-t-30">
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div id="LoadDetailDependencia">
						<?
							if ($id != "") {
								include(VIEWS.DS."dependencias/PanelDependencias.php");
							}else{
								echo "<div class='alert alert-info'>Seleccione una Serie y Sub-serie</div>";
							}
						?>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	

.menu-expediente{

	margin-right: 2px;

	margin-left: 1px;

	display: inline-block;

	height: 40px;

	width: 60px;

	background: #1579C4 ;

	text-align: center;

	font-size: 25px;

	line-height: 40px;

}

	.menu-expediente:hover{

		text-decoration: none !important;

	}

	.menu-expediente.activa{

	    background-color: #1263A1;

	    font-weight: normal !important;

	    font-size: 25px !important;

	    color: #FFF;

	}

.menu-expediente a, .menu-expediente a:hover{

	color: #FFF !important;

}

.menu-expediente.anexos{ background-position:  0px 0px; }

.menu-expediente.ver{ background-position:  0px -500px; }

.menu-expediente.documentos{ background-position:  0px -80px; }

.menu-expediente.formularios{ background-position:  0px -120px; }

.menu-expediente.alertas{ background-position:  0px -160px; }

.menu-expediente.suscriptores{ background-position:  0px -200px; }

.menu-expediente.compartir{ background-position:  0px -240px; }

.menu-expediente.electronica{ background-position:  0px -280px; }

.menu-expediente.fisica{ background-position:  0px -320px; }

.menu-expediente.docsnew{ background-position:  0px -360px; }

.menu-expediente.permisosdoc{ background-position:  0px -400px; }

.proces-list-item .blue-tr td{

	padding: 0px;

}

.linkbar .active, .linkbar td:hover{

	background-color: #1263A1;

}

.linkbar td a{

	padding: 5px;

	height: 23px;

	line-height: 23px;

}

.linkbar td a div{

	margin-top: 5px;

}

#upper-menu{

	height: 150px;

}

#upper-menu .item-upper-menu{

	display: inline-block;

	background-color: #fff;

	width: 165px;

	height: 135px;

	margin-right: 5px;

	cursor: pointer;

}

.item-upper-menu .img-upper-menu{

	margin: auto;

	width: 100px;

	height: 100px;

	background: url(../images/icono-herramientas.png) no-repeat;

}

.img-upper-menu.gest{background-position: 0px 0px;}

.img-upper-menu.planti{background-position: -100px 0px;}

.img-upper-menu.usua{background-position: -200px 0px;}

.img-upper-menu.adminis{background-position: -300px 0px;}

.img-upper-menu.grup{background-position: -400px 0px;}

.img-upper-menu.proce{background-position: -500px 0px;}

#upper-menu .item-upper-menu:hover,#upper-menu .item-upper-menu.active{

	background-color: #949494;

}

.item-upper-menu.active .img-upper-menu.gest,.item-upper-menu:hover .img-upper-menu.gest{background-position: 0px -100px;}

.item-upper-menu.active .img-upper-menu.planti,.item-upper-menu:hover .img-upper-menu.planti{background-position: -100px -100px;}

.item-upper-menu.active .img-upper-menu.usua,.item-upper-menu:hover .img-upper-menu.usua{background-position: -200px -100px;}

.item-upper-menu.active .img-upper-menu.adminis,.item-upper-menu:hover .img-upper-menu.adminis{background-position: -300px -100px;}

.item-upper-menu.active .img-upper-menu.grup,.item-upper-menu:hover .img-upper-menu.grup{background-position: -400px -100px;}

.item-upper-menu.active .img-upper-menu.proce,.item-upper-menu:hover .img-upper-menu.proce{background-position: -500px -100px;}

.item-upper-menu .text-upper-menu{

	color: #1579C4;

	text-align: center;

	font-size: 20px;

	font-weight: bold;

}

.item-upper-menu.active .text-upper-menu,.item-upper-menu:hover .text-upper-menu{

	color: #fff;

}


.submenu_box{

	width:100%;

	height:40px;

	line-height:40px;

	clear:both;

	color:#FFF;

	padding: 0px;

	overflow: hidden;

    max-height: 40px;

    margin-left: 0px;

}

	.submenu_box .opcion{

			float:left;

			cursor:pointer;

			display: inline-block;

		}

		.submenu_box .opcion a, .submenu_box .opcion2 a{

				color: #000;

			}

		.submenu_box .opcion.activa{

				background-color: #1263A1;

				font-weight:bold;

				font-size:15px;

				color:#FFF;

			}

			.submenu_box .opcion:hover{

				text-decoration:underline;

				background-color: #1263A1;

			}	

		.submenu_box .opcion2{

				float:left;

				cursor:pointer;

				display: inline-block;

				padding-left: 7px;

				padding-right: 7px;

			}

		.submenu_box .opcion2.activa{

				background-color: #323538;

				font-weight:bold;

				font-size:15px;

				color:#FFF;

			}

			.submenu_box .opcion2:hover{

				text-decoration:underline;

				background-color: #323538;

			}	
		.mini-ico.green-dep {

			cursor: pointer;

			background-position: -200px -353px;

		}

</style>