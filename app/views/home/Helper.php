<link rel='stylesheet' type='text/css' href='<?= ASSETS ?>/styles/agenda.css'/>
<div id="tools-content">
	<div class="opc-folder blue">
		<div class="ico-content-ps">
			<div class="icon white_contacto search_icon"></div>
			<div class="text-folder">Ayuda en PGD Empresarial</div>
		</div>
		<div class="header-agenda"></div>
	</div><div id="folders-content">
	<div id="folders-list-content">
		<div class="contact-list_main_2">

		<input type="hidden"  id="cajaTexto" value="<?= $term; ?>"/>
<?
		echo '<div class="searchresults">';

		$url = "http://laws.com.co/ws/GetDataCodes.wsdl";
	 	$cliente = new nusoap_client($url, true);
      
	    $error = $cliente->getError();
	    if ($error) {
	        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	    }
	      
	    $result = $cliente->call("SearchInCodes", array("term" => $term));
	      
	    if ($cliente->fault) {
	        echo "<h2>Fault</h2><pre>";
	        echo $result[0];
	        echo "</pre>";
	    }else{
	        $error = $cliente->getError();
	        if ($error) {
	            echo "<h2>Error</h2><pre>" . $error . "</pre>";
	        }
	        else {
	            #echo $result;
	            $x  = explode(",", $result);

	            echo $result;
 	        }
	    }

		echo '</div>';		
	
?>

<script>
/*
jQuery.fn.extend({
    resaltar: function(busqueda, claseCSSbusqueda){
        var regex = new RegExp("(<[^>]*>)|("+ busqueda.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +')', 'ig');
        var nuevoHtml=this.html(this.html().replace(regex, function(a, b, c){
            return (a.charAt(0) == "<") ? a : "<span class=\""+ claseCSSbusqueda +"\">" + c + "</span>";
        }));
        return nuevoHtml;
    }
});


function resaltarTexto(){
	alert("hi!");
    $(".messageresult").resaltar($("#cajaTexto").value(), "destt");
}

	resaltarTexto();
*/
$(document).ready(function(){
	$("#del-input-buscar").val("<?= $_REQUEST['del-input-buscar'] ?>");
});	
	
	function ExpandCollapse(main_el, selector, textenabled, textdisabled){

	if(!$("#"+main_el).hasClass("active")){

        $("#"+main_el).slideDown("fast");
        $("#"+main_el).addClass("active")

        $("#"+selector).html(textdisabled);

    }else{

        $("#"+main_el).slideUp("fast");
        $("#"+main_el).removeClass("active")

        $("#"+selector).html(textenabled);

    }
}
</script>


		</div>
	</div>
</div>


