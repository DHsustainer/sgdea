<div class="row" style="margin:0px">
	<div class="col-md-12">
		<input type="text" style="display: none"  id="cajaTexto" value="<?= $attr; ?>"/>
		<div class="searchresults">
<?

		require_once(PLUGINS.DS.'nusoap/nusoap.php');

		 $cliente = new nusoap_client("http://audiosjuridicos.com/ws/GetDataCodes.wsdl", true);
      
	    $error = $cliente->getError();
	    if ($error) {
	        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	    }
	      
	    $result = $cliente->call("SearchInCodes", array("term" => $attr));
	      
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
	            #echo "El libro ID 1 es: ".$result;
	        }
	    }

	
?>
		</div>
	</div>
</div>

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
<style type="text/css">
	.link:hover{
		cursor: pointer;
		text-decoration: underline;
	}
</style>



