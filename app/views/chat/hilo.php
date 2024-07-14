<div class="row mcolmesaje">
	<div class="col-md-12  col-mensajes scrollable" id="historychat" >
		<?
			$con->Query("update chat set recd = '1' where from_name = '".$id."' and to_name='".$_SESSION['usuario']."' and recd = '0'");
			$query = $con->Query("select * from chat 
										where 
											(to_name = '".$_SESSION['usuario']."' and from_name = '".$id."') or
											(to_name = '".$id."' and from_name = '".$_SESSION['usuario']."')
												limit 0, 20");
			while ($row = $con->FetchAssoc($query)) {
				$chatp = explode("@@", $c->GetDataFromTable("usuarios", "user_id", $row['from_name'], 'p_nombre, p_apellido, foto_perfil', '@@'));
				if ($row['from_name'] == $_SESSION['usuario']) {

					echo '	<div class="row fila_mensaje_mio">
								<div class="col-md-8 col-md-offset-4" >
									<div class="bloquemensajechat bloquemensajechat_r">
										<div class="personachat">'.strtolower($chatp[0]).'</div>
										<div class="mensajechat">'.$row['message'].'</div>
										<div class="horamensajechat">'.substr($row['sent'], 0, 10).' a las '.substr($row['sent'], 10, 10).'</div>
									</div>
									<div class="avatar_chat"><img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$chatp[2].'"></div>
								</div>
							</div>
							';
				}else{
					echo '	<div class="row fila_mensaje">
								<div class="col-md-8" >
									<div class="avatar_chat"><img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$chatp[2].'"></div>
									<div class="bloquemensajechat">
										<div class="personachat">'.strtolower($chatp[0]).'</div>
										<div class="mensajechat">'.$row['message'].'</div>
										<div class="horamensajechat">'.substr($row['sent'], 0, 10).' a las '.substr($row['sent'], 10, 10).'</div>
									</div>
								</div>
							</div>';
					
				}
			}
		?>
	</div>
</div>

<div class="row col-textarea">
	<div class="col-md-12">
		<input type="hidden" id="idtochatname" value="<?= $c->GetDataFromTable("usuarios", "user_id", $id, 'a_i', '') ?>">
		<input type="hidden" id="tochatname" value="<?= $id ?>">
		<textarea id="inputmessagechat" onkeyup="SendMessage()" name="inputmessagechat" placeholder="Escriba aquí su mensaje..."></textarea>	
	</div>
</div>

<style type="text/css">
	
	.mcolmesaje{
		height: 390px;
		padding: 15px 0px;
	}
	.col-mensajes{
		height: 390px;
		overflow-y: auto;
	}

	.col-textarea{
		height: 80px;
	}

	.col-textarea textarea{
		height: 78px;
		width: 100%;
	}


	.fila_mensaje_mio{
		text-align: right;
		width: 100%;
		clear: both;
		margin-bottom: 10px !important;
		margin-top: 10px;
		
	}
	.fila_mensaje{
		text-align: left;
		width: 100%;
		margin-bottom: 10px !important;
		margin-top: 10px;
		clear: both;
	}
	.avatar_chat{
		width: 45px;
		float: left;
		padding: 5px;
	}
	.avatar_chat img{
		width: 43px;
	    height: 43px;
	    border-radius: 5em;
	}
	.bloquemensajechat{
		float:left;
		width: 400px;
		background: #f7f7f7;
	    border-radius: 0px 8px 8px 8px;
	    padding: 15px !important;
	    
	    margin: 0px 3px 0 20px;
	}
	.bloquemensajechat_r{
		background: #e5f7ff;
		font-weight: normal !important;
		font-family: "Segoe UI";
		border-radius: 8px 0px 8px 8px;

	}
	.personachat{
		font-weight: bolder;
		font-size: 15px;
		text-transform: capitalize;


	}
	.mensajechat{
		line-height: 1.6;
		margin: 0px;
    	padding-top: 3px;
    	font-weight: normal !important;
	}
	.horamensajechat{
		font-size: 11px;
	    opacity: 0.6;
	    font-weight: bold;
	    margin-top: 5px;

	}



</style>

<script type="text/javascript">
	
	//setTimeout((); ('<?= $id ?>', 'NO'), 1000)

	//var refreshIntervalId = setInterval("loadcontactschat();",1000);
	//var refreshIntervalAd = setInterval("loadmessageschat('<?= $id ?>', 'SI');",1000);

	 

</script>