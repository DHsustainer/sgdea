<?
	global $c;
	$fid = 6;

	if ($fid == "") {
	  echo '<div id="logo_login"></div>';
	}else{

	  $sadmin = new MSuper_admin;
	  $sadmin->CreateSuper_admin("id", $fid);

	  if ($sadmin->GetFoto_perfil() == "") {
	    echo '<div id="logo_login"></div>';
	  }else{
	    echo '<div id="logo_login_clientes" style="margin:0 auto; text-align:center">'; 
	    echo '    <img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().'" alt="" width="250px">';
	    echo '</div>';
	  }
	}
?>
<!--<div id="logo-container">
	<div id="del-logo-acuse"></div>
</div>-->

