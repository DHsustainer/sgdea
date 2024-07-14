$(document).ready(function() {
	$( "#editor" ).keyup(function( event ) {
		$("#descripcion").val($("#editor").html());
	});

	if ($('#editor').hasClass("noeditable")) {
		$('#editor').get(0).contentEditable = "false";
	}else{
		$('#editor').get(0).contentEditable = "true";
	}
	
	var button = $('#upload_button'), interval;
	new AjaxUpload('#upload_button', {
        action: '/app/plugins/uploadsfiles/upload_anexo_correo.php',
		onSubmit : function(file , ext){
			if (! (ext && /^(jpg|png|jpeg|gif|bmp|xls|pdf|doc|docx|xlsx|tiff|mp3|wav)$/.test(ext))){
				// extensiones permitidas
				alert('Error: Solo se permiten archivos de imagen');
				// cancela upload
				return false;
			} else {
				this.disable();
			}
		},
		onComplete: function(file, response){
			this.enable();
			$('#editor').focus();
			
			document.execCommand("insertHTML", false, response);
			$("#descripcion").val($("#editor").html());

		}
	});

});

	function format_button(a,p) {
		$('#editor').focus();
		if (p == null) 
			p = false;
		document.execCommand(a, null, p);
		$("#descripcion").val($("#editor").html());
	}

	function InsertQuote(a,p) {
		$('#editor').focus();
		if (p == null) 
			p = false;
		document.execCommand("insertHTML", false, "<div class='"+a+"'>"+ document.getSelection()+"</div><br>");
		$("#descripcion").val($("#editor").html());
	}

	function AlignImage(a,p) {
		$('#editor').focus();
		if (p == null) 
			p = false;
		document.execCommand("insertHTML", false, "<div class='"+a+"'>"+ getSelectionHtml() +"</div><br>");
		$("#descripcion").val($("#editor").html());
	}

	function format_buttonCSS(a,p) {
		$('#editor').focus();
		if (p == null)
			p = false;
		document.execCommand("insertHTML", false, "<span class='"+a+"'>"+ getSelectionHtml()+"</span>");
		$("#descripcion").val($("#editor").html());
	}
	function format_Heading(a,p) {
		$('#editor').focus();
		if (p == null)
			p = false;
		document.execCommand("insertHTML", false, "<"+a+">"+ getSelectionHtml()+"</"+a+"");
		$("#descripcion").val($("#editor").html());
	}

	function AddHtml(id, p) {
		$('#editor').focus();
		if (p == null) 
			p = false;
		document.execCommand("inserthtml", false, p);		
		$("#descripcion").val($("#editor").html());
		$('#'+id).prop('selectedIndex',0);
	}

	function align_button(a, p){
		$('#editor').focus();
		if (p == null) 
			p = false;
		document.execCommand(a, null, p);
		$("#descripcion").val($("#editor").html());
	}

	function showhtml(){
		if ($("#editor").hasClass("htmlview")) {
			$("#editor").removeClass("htmlview")
			$("#editor").html($("#editor").text());
		}else{
			$("#editor").text($("#editor").html());
			$("#editor").addClass("htmlview");
		}
	}

	function url_button(p){ 
		$('#editor').focus();
		if (p == null) 
			p = false;
//		document.execCommand("insertHTML", false, "<span class='"+a+"'>"+ document.getSelection()+"</span>");
        var url = String(getSelectionHtml()); 

        aTagsRegex = /a href/ig;
        link = url.match(aTagsRegex);
        	if (link != null) {
        			document.execCommand("insertHTML", false, document.getSelection());
        	}else{
		        m = url.match("(^(http|https|ftp|ftps)://)");
		        if(m == null){ 
		        	var url = prompt("Escriba una URL");
		        	if (document.getSelection() == "") {
						document.execCommand("insertHTML", false, "<a href='"+url+"' target='_blank'>"+url+"</a>");
		        	}else{
		        		document.execCommand("insertHTML", false, "<a href='"+url+"' target='_blank'>"+document.getSelection()+"</a>");
		        	}
		        }else{
		        	document.execCommand("insertHTML", false, "<a href='"+url+"' target='_blank'>"+document.getSelection()+"</a>");
		        }
        	}

		$("#descripcion").val($("#editor").html());
    }

    function InsertVideo(p){ 
		$('#editor').focus();
		if (p == null) 
			p = false;

		var url = prompt("Escriba el codigo del video");
		document.execCommand("insertHTML", false, url);
	
		$("#descripcion").val($("#editor").html());

    }

    function InsertImage(){
    	$("#upload_button").submit();
    }

    function DoTable(){
		$('#editor').focus();

		var rows = prompt("Escriba la cantidad de Filas");
		var cols = prompt("Escriba la cantidad de Columnas");

		var nr = parseInt(rows);
		var nc = parseInt(cols);

		var per = 100/nc;
		per = parseInt(per);
		var id = "tbl-"+Math.round(Math.random()*1000);
		var path = "<table border='0' cellpadding='0' cellspacing='0' id='"+id+"'>";
		for (var i = 0; i < nr; i++) {
			path += "<tr>";
				for (var j = 0 ; j < nc; j++) {
					path += "<td width='"+per+"%'>&nbsp;</td>";
				};
			path += "</tr>";
		};
		path += "</table>";


		document.execCommand("insertHTML", false, path);
	
		$("#descripcion").val($("#editor").html());    	
    }

    function AddRowsAfter(){
		var filas = $('#tbl-123 > tbody >tr:first > td').length;
		var path = "<tr>";
			for (var i = 0; i < filas; i++) {
				path += "<td>&nbsp;</td>"; 
			};
		path += "</tr>";
		$("#tbl-123 > tbody > tr:first").after(path);
		

    }
    function AddRowsBefore(){
    	var filas = $('#tbl-123 > tbody >tr:first > td').length;
		var path = "<tr>";
			for (var i = 0; i < filas; i++) {
				path += "<td>&nbsp;</td>"; 
			};
		path += "</tr>";
		$("#tbl-123 > tbody > tr:last").before(path);	
    }

    function AddColsAfter(){
        $('#tbl-123').find('tr').each(function () {
            $(this).find('td').eq(0).after('<td>&nbsp;</td>');
        });
    }
	function AddColsBefore(){
        $('#tbl-123').find('tr').each(function () {
            $(this).find('td').eq(0).before('<td>&nbsp;</td>');
        });
    }
/*
	function getSelectionHtml() {
	    var html = "";
 		if (typeof window.getSelection != "undefined") {
		    var sel = window.getSelection();
		    if (sel.rangeCount) {

		        var Node=sel.focusNode.parentNode.cloneNode(true);
		        //console.log(Node);
		        var container = document.createElement("div");
		        for (var i = 0, len = sel.rangeCount; i < len; ++i) {
		            container.appendChild(sel.getRangeAt(i).cloneContents());
		        }
		        html = container.innerHTML;
		        //
		        Node.innerHTML=html;
		        var co = document.createElement("div");
		        co.appendChild(Node);
		        html=co.innerHTML;

		    }
		} else if (typeof document.selection != "undefined") {
		    if (document.selection.type == "Text") {
		        html = document.selection.createRange().htmlText;
		    }
		}
		return html;
	}

*/

	function getSelectionHtml() {
	    var html = "";
	    if (typeof window.getSelection != "undefined") {
	        var sel = window.getSelection();
	        if (sel.rangeCount) {
	            var container = document.createElement("div");
	            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
	                container.appendChild(sel.getRangeAt(i).cloneContents());
	            }
	            html = container.innerHTML;
	        }
	    } else if (typeof document.selection != "undefined") {
	        if (document.selection.type == "Text") {
	            html = document.selection.createRange().htmlText;
	        }
	    }
	    return html;
	}