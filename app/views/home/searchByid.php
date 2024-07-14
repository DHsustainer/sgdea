<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/agenda.css'/>







<?php if ($_SESSION['usuario'] == ""): ?>



	<style type="text/css">



		#left-bar{



			display: none



		}







		#content, #tools-content, #folders-content{



			left:0px !important;



		}







		#folders-list-content{



			padding-left: 0px;



		}







		.search_result{



			width: 96%;



		}







		#tablat{



			width: 100%;



		}



	</style>



<?php endif ?>



<div id="tools-content">



	<div class="opc-folder blue">



		<div class="ico-content-ps">



			<div class="icon white_contacto search_icon"></div>



			<div class="text-folder">Resultados de busqueda por cédula: "<?= $attr; ?>"</div>



		</div>



		<div class="header-agenda">



			



		</div>



	</div>



</div>



<div id="folders-content">



	<div id="folders-list-content">



		<div class="contact-list_main_2">



<?



	







	$id = $attr;



	$us = $_SESSION["usuario"];











		if($id == ""){



			echo "<div class='da-message error'>Resultados: Debe ingresar algo para buscar</div>";



		}else{



				



			$susc = new MSuscriptores_contactos;



			$susc->CreateSuscriptores_contactos($idbusqueda, $attr);







			if ($susc->GetId() == "") {



				$conss = $con->Query("select * from suscriptores_contactos where nombre like '%".$attr."%'");



?>



					<div id="containerpdf">



						<div id="headerpdf"></div>

						<div class='clear'></div>

						<div class="search_result">

							<div class="header_result">

								<div class="bold">Suscriptores</div>

								<div class="light"> <?= $con->NumRows($conss) ?> Suscriptores encontrados que contienen "<?= $attr; ?>" </div>

							</div>

							<div class="clear"></div>

						</div>



						<div class='clear'></div>



						<div class="row">

							<div class="col-md-6">

								<ul class="list-group">

<?	

						while ($roo = $con->FetchAssoc($conss)) {

?>



							<li class="list-group-item">

							    <?= $roo['nombre']." (".$roo['type'].")" ?>

							    <span class="badge" style="padding:0px; background-color: #FFF">

									<form action="/dashboard/buscar/" method="POST">

										<input name="del-input-buscar" type="hidden" value="id: <?= $roo['id'] ?>">

										<button type="submit" style="padding: 1px 10px;" class="btn btn-primary fa fa-search"></button>

									</form>

							    </span>

						  	</li>



							<!--<tr class="addd" >

								<td align="left" width="80px">

								</td>

							</tr>-->



<?									

						}

?>



								</ul>

							</div>

						</div>



					</div>



					<script>



						$(document).ready(function() {



							$("tr.addd:not([th]):even").addClass("par");



							$("tr.addd:not([th]):odd").addClass("impar");



						})



					</script>



					<style>



						.addd{



							cursor:pinter;



						}



						.addd td:hover{



							text-decoration:underline;



							cursor:pointer;



						}



					</style>



<?



			}else{







				if ($_SESSION['suscriptor_id'] == "") {



					$search = true;



				}else{



					if ($susc->GetId() == $_SESSION['suscriptor_id']) {



						$search = true;



					}else{



						$search = false;



					}



				}







				if ($search) {







					$sx = $con->Query("select * from certificados_generados where fecha = '".date("Y-m-d")."' and identificacion = '".$attr."'");



					$isx = $con->NumRows($sx);







					if ($isx >= "1") {



						$num_Dcto = $con->Result($sx, 0, 'id');



					}else{



						$sx = $con->Query("INSERT INTO certificados_generados (fecha, identificacion) VALUES ('".date("Y-m-d")."','".$attr."')");



						$num_Dcto = $c->GetMaxIdTabla("certificados_generados", "id");



					}











					$s1 = "Select gestion.id from gestion inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id where gestion_suscriptores.id_suscriptor = '".$susc->GetId()."'";



					#echo $s1;



					$q1 = $con->Query($s1);



					



					$type_s = "Radicados";



					$i1 = $con->NumRows($q1);



?>



					<div id="containerpdf">

						<div id="headerpdf"></div>

						<div class='clear'></div>



						<form class="form-inline" action="/consultapublica/resultados_identificacion/" method="POST">

						    <div class="row">

						      	<div class="col-md-12" align="right">

						            <input type="hidden" value="<?= $susc->GetIdentificacion() ?>" class="form-control input-lg" id="id_consulta" name="id_consulta" placeholder="Escriba el Número de Radicado a Consultar">

						        	<button type="submit" id="btn_login" class="btn btn-success btn-lg fullwidth">Generar Certificado</button>

						      	</div>

						    </div>

						</form>

<?



					if ($i1 >= "1") {



						echo "<div class='search_result'>



								<div class='header_result'>";







								$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");



								$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico");



								global $c;



								while ($row = $con->FetchAssoc($q1)) {



									$c->GetVistaExpedienteDefault($row["id"], $path);



									echo "<div class='clear'></div>";







								}



?>



							<!--</tbody>



						</table>-->







<?					



						echo "<div class='clear'></div>



							</div>



							<div class='clear'></div>



						</div>";



					}else{



						echo "<h4>NO REGISTRA INFORMACION</h4>";



					}



?>



						<div class="firma"></div>



						<div class="footerpdf">



							<ul>



							</ul>



						</div>



					</div>



<?			



				}else{



					echo "<div class='alert alert-info'>No se puede mostrar la informacion</div>";



				}



				





			}







		}



?>







		</div>



	</div>



</div>







<?



  	$sadmin = new MSuper_admin;



    $sadmin->CreateSuper_admin("id", "6");



    $uri = "";



    if ($sadmin->GetFoto_perfil() == "") {



      	$uri = HOMEDIR.DS."app/views/assets/images/logo_expedientes2.png";



    }else{



    	$uri = HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil();



    }



?>



<style type="text/css">



	



	.title_rad{



		float:left;



		font-weight: bold;



		font-size:16px;



		line-height: 20px;



		margin-bottom: 10px;



	}







	.alt_rad{



		float:left;



		font-size:14px;



		line-height: 20px;



		margin-bottom: 10px;



	}







	.title2{



		height: 30px;



		line-height: 30px;



	}



	.width60{ width:57%; float:left; text-align: left }



	.width50{ width:47%; float:left; text-align: left }



	.width30{ width:27%; float:left; text-align: left }



	.width40{ width:37%; float:left; text-align: left }



	.width25{ width:22%; float:left; text-align: left }







	.search_result{



		background-color: #FFF;



		margin: 0 auto;	



		margin-top: 30px;



		margin-bottom: 30px;



		width: 100%;



	}



	.search_result .header_result{



		background-color: #EBEAEF;	



	}







	.th_act{



		padding: 5px;



		padding-left: 25px;



		cursor: pointer;



		text-align: center;



	}







	#headerpdf{



		background: url(<?= $uri; ?>) no-repeat;



		background-size: 180px;



		width: 250px;



		height: 50px;



		float:left;



		display: inline-block;



		cursor: pointer;



	}







	#headerdatacertificadopdf{



		width: 150px;



		float: right;



		font-size: 12px;



		background-color: #f5f5f5;



		padding: 6px;



	}







	#containerpdf{



		width: 95%;



		border: 1px solid #CCC;



		margin: 0 auto;



		margin-top: 10px;



		margin-bottom: 10px;



		padding:10px;



	}







	.row_firma{



		border: 1px solid #000;



		width: 100%;



		padding: 13px;



		text-align: justify;



		font-size: 14px;



		margin-top: 30px;



	}



	.nocosto{



		text-align: left;



		font-size: 13px;



		font-weight: bold;



	}



	.firma{







		height: 60px;







	}



	.validez{







		border-bottom: 1px solid #C00;



		font-size: 12px;



		padding-bottom: 5px;



		width: 80%;



		margin:0 auto;







	}



	.footerpdf li{



		display: inline;



		border-right: 1px solid #D00;



		list-style: circle;



		margin-left: 10px;



		padding-right: 10px;



		font-size: 13px;



	}







	.datacertificado{



		text-align: justify;



		width: 80%;



		margin: 0 auto;



	}



	.list-group-item {

	    padding: 10px 15px;

	    text-align: left;

	}







</style>



