if (!window.attachEvent) {

	Object.prototype.attachEvent = function(event, handler)	{

		this.addEventListener(event.substring(2), handler, false);					

	}

}



function richtextbox(textarea)

{

	function format_button(html, action)

	{

		var button = document.createElement('button');

		button.setAttribute("type", "button");

		button.setAttribute("class","botone");

		button.innerHTML = html;

		button.onclick = function()

		{

			richtextarea.contentWindow.document.execCommand(action, false, null);

		}

		return button;				

	}

	

	function action_button(html, action){

	

		var button = document.createElement('button');

		button.setAttribute("type", "button");

		button.setAttribute("class","botone");

		button.innerHTML = html;

		button.onclick = function()

		{

			richtextarea.contentWindow.document.execCommand(action);

		}

		return button;

		

		

	}



	function AddColor(html, action)

	{

		var li = document.createElement('LI');

		li.innerHTML = html;

		li.onclick = function()

		{

			richtextarea.contentWindow.document.execCommand("ForeColor",false,action);

		}

		return li;				

	}

	

	function AddLight(html, action)

	{

		var li = document.createElement('LI');

		li.innerHTML = html;

		li.onclick = function()

		{

			richtextarea.contentWindow.document.execCommand("BackColor",false,action);

		}

		return li;				

	}	

	

	function AddSize(html, action)

	{

		var li = document.createElement('LI');

		li.innerHTML = html;

		li.onclick = function()

		{

			richtextarea.contentWindow.document.execCommand("FontSize",false,action);

		}

		return li;				

	}



	function AddFont(html, action)

	{

		var li = document.createElement('LI');

			li.innerHTML = html;

			li.onclick = function()

			{

				richtextarea.contentWindow.document.execCommand("fontname",false,action);			

			}

		return li;	

	}

	

	function ocultarOpMenu(){

		document.getElementById("tyFont").style.display = 'none';

		document.getElementById("clFont").style.display = 'none';				

		document.getElementById("tmFont").style.display = 'none';		

		document.getElementById("clStill").style.display = 'none';

		document.getElementById("ApiA").style.display = 'none';		

		document.getElementById("ApiB").style.display = 'none';	

		document.getElementById("ApiC").style.display = 'none';										

		document.getElementById("ApiD").style.display = 'none';										

	}

	

	function opmenu(html, type)

	{

		var button = document.createElement('button');

		button.setAttribute("type", "button");

		button.setAttribute("class","botone");

		button.setAttribute("id",type+"B");

		button.innerHTML = html;

		

		button.onmouseover = function()

		{

//			ocultarOpMenu()

			document.getElementById(type).style.display = 'block';			

		}

		button.onmouseout = function(){

			ocultarOpMenu()

		}

		return button;				

	}

	function align_button(html, action)

	{

		var button = document.createElement('button');

		button.setAttribute("type", "button");

		button.setAttribute("class","botone");

		button.innerHTML = html;

		button.onclick = function()

		{

			richtextarea.contentWindow.document.execCommand(action, false, null);

		}

		return button;				

	}	
	
	function list_button(html, action)

	{

		var button = document.createElement('button');

		button.setAttribute("type", "button");

		button.setAttribute("class","botone");

		button.innerHTML = html;

		button.onclick = function()

		{

			richtextarea.contentWindow.document.execCommand(action, false, null);

		}

		return button;				

	}




    function url_button(html, type) 

    { 

    	var button = document.createElement('button');

		button.setAttribute("type", "button");

		button.setAttribute("class","botone");		

		button.innerHTML = html;

		button.onclick = function()

		{

            if (!document.all) 

            {

                var url = prompt("Enter an url",""); 

                if(!url.match("(^(http|https|ftp|ftps)://)")) 

                { 

                    url="http://"+url; 

                }

                

                if (type == "url")

                {

                    richtextarea.contentWindow.document.execCommand("inserthtml", false, '<a href="' + url + '">' + url + '</a>'); 

                }

                else if (type == "image")

                {

                    richtextarea.contentWindow.document.execCommand("inserthtml", false, '<img src="' + url + '" />'); 

                }

            } 

            else 

            { 

                if (type== "url")

                {

                    richtextarea.contentWindow.document.execCommand("CreateLink",true); 

                }

                else if (type == "image")

                {

                    richtextarea.contentWindow.document.execCommand("InsertImage",true);

                }

            }

        } 

        return button;

    }

	

    function multimedia(html, type) 

    { 

    	var button = document.createElement('button');

		button.setAttribute("type", "button");

		button.setAttribute("class","botone");		

		button.innerHTML = html;

		button.onclick = function()

		{

            if (!document.all) 

            {

                var url = prompt("Enter an url",""); 

                if(!url.match("(^(http|https)://)")) 

                { 

                    url="http://"+url; 

                }

					

				if (type == "youtube")

                {

					url =  url.replace("watch?v=","embed/");

					url =  url.replace("&feature=related","");	

					url =  url.replace("&feature=feedlik","");						

					richtextarea.contentWindow.document.execCommand("inserthtml", false, '<iframe width="560" height="315" src="' + url + '" frameborder="0" allowfullscreen></iframe>')									

                }

				

				else if(type=="swf")

				{

					richtextarea.contentWindow.document.execCommand("inserthtml", false, '<embed src="' + url + '" quality=high width="640px" height="385px" type="application/x-shockwave-flash" allowfullscreen="true" allownetworking="internal" autoplay="false" wmode="transparent"></embed>'); 					

				}

            } 

            else 

            { 

                alert("inserta una URL valida!");

            }

        } 

        return button;

    }

	

    function quotear(html) 

    { 

    	var button = document.createElement('button');

		button.setAttribute("type", "button");

		button.setAttribute("class","botone");		

		button.innerHTML = html;

		button.onclick = function()

		{

            if (!document.all) 

            {

                var cita = prompt("Ingresa tu texto a Citar",""); 

		        richtextarea.contentWindow.document.execCommand("inserthtml", false, '<br /><div style="border:1px dashed #ccc; clear:both; margin-left:7px;">'+ cita +'</div><br />');

            } 

        } 

        return button;

    }	

		

	function set_textbox()

	{

		textarea.value = richtextarea.contentWindow.document.body.innerHTML;

	}

	

	function spacer()

	{

		var sp = document.createElement('span');

		sp.setAttribute("class","spacer");

		

		return sp;

	}	



	function AddEElement(img, action) 

    { 

    	var button = document.createElement('spam');

		button.innerHTML = img;

		button.onclick = function()

		{

          richtextarea.contentWindow.document.execCommand("inserthtml", false, " "+action+" ");

        } 

        return button;

    }

	

			

	function emoticon(img) 

    { 

    	var button = document.createElement('spam');

		button.innerHTML = '<img src="' + img +'"/>';

		button.onclick = function()

		{

          richtextarea.contentWindow.document.execCommand("inserthtml", false, '<img src="'+ img +'" style="margin-left:4px;" />');

        } 

        return button;

    }

	

	function get_richtextbox()

	{

		var richtextarea = document.createElement('iframe');		

		richtextarea.style.width = textarea.style.width;

		richtextarea.style.height = textarea.style.height;

//		richtextarea.contentWindow.document.body.iddocument.body.

		richtextarea.id = "myiframe";

		return richtextarea;

	}

	

	var richtextarea = get_richtextbox();

	

	var bar = document.createElement('div');

	bar.setAttribute("class","barra");	

	textarea.parentNode.appendChild(bar);

	bar.appendChild(format_button('<img src="images/editor-theme/bold.png" title="Negrita">','bold'));

	bar.appendChild(format_button('<img src="images/editor-theme/italic.png" title="Cursiva">','italic'));

	bar.appendChild(format_button('<img src="images/editor-theme/underline.png" title="Subrayar">','underline'));	

	bar.appendChild(spacer());

	bar.appendChild(align_button('<img src="images/editor-theme/align_left.png" title="Alinear a la izquierda">','JustifyLeft'));

	bar.appendChild(align_button('<img src="images/editor-theme/align_center.png" title="Centrar">','JustifyCenter'));

	bar.appendChild(align_button('<img src="images/editor-theme/align_justify.png" title="Justificar">','JustifyFull'));	

	bar.appendChild(align_button('<img src="images/editor-theme/align_right.png" title="Alinear a la derecha">','JustifyRight'));

	bar.appendChild(align_button('<img src="images/editor-theme/indent.png" title="Identar">','indent'));

	bar.appendChild(align_button('<img src="images/editor-theme/outdent.png" title="Identar">','outdent'));

	bar.appendChild(list_button('<img src="images/editor-theme/edit-list-order.png" title="Lista Numerica">','InsertOrderedList'));	
	
	bar.appendChild(list_button('<img src="images/editor-theme/edit-list.png" title="Lista Numerica">','InsertUnorderedList'));		
	
	bar.appendChild(spacer());	

	bar.appendChild(action_button('<img src="images/editor-theme/document-copy.png" title="Copiar">','Copy'));

	bar.appendChild(action_button('<img src="images/editor-theme/scissors-blue.png" title="Cortar">','Cut'));

	bar.appendChild(action_button('<img src="images/editor-theme/clipboard-paste.png" title="Pegar">','Paste'));	

	bar.appendChild(spacer());	

//	bar.appendChild(url_button('<img src="images/editor-theme/insert_link.png" title="Insertar link">', 'url'));	

	bar.appendChild(url_button('<img src="images/editor-theme/image.png" title="Insertar imagen">', 'image'));

//	bar.appendChild(multimedia('<img src="images/editor-theme/youtube.png" title="Insertar video de youtube">', 'youtube'));		

//	bar.appendChild(multimedia('<img src="images/editor-theme/film.png" title="Insertar archivo multimedia">', 'swf'));			

	bar.appendChild(spacer());

	bar.appendChild(quotear('<img src="images/editor-theme/blockquote.png" title="Citar">'));	

//Creando lista de Fuentes

	var LFuentes = document.createElement("UL");	

		LFuentes.appendChild(AddFont("<div style='font-family:\"Arial\"' class='submenu_editor'>&nbsp;Arial</div>", "Arial"));

		LFuentes.appendChild(AddFont("<div style='font-family:\"Courier New\"' class='submenu_editor'>&nbsp;Courrier New</div>", "\"Courier New\""));

		LFuentes.appendChild(AddFont("<div style='font-family:\"Georgia \"' class='submenu_editor'>&nbsp;Georgia</div>", "Georgia"));					

		LFuentes.appendChild(AddFont("<div style='font-family:\"Times New Roman \"' class='submenu_editor'>&nbsp;Times New Roman</div>", "\"Times New Roman\""));

		LFuentes.appendChild(AddFont("<div style='font-family:\"Verdana \"' class='submenu_editor'>&nbsp;Verdana</div>", "Verdana"));

		LFuentes.appendChild(AddFont("<div style='font-family:\"sans-serif \"' class='submenu_editor'>&nbsp;Lucida Sans</div>", "sans-serif"));

		LFuentes.appendChild(AddFont("<div style='font-family:\"Comic Sans MS\"' class='submenu_editor'>&nbsp;Comics Sans MS</div>", "\"Comic Sans MS\""));						

//Creando Contenedor de Fuentes		

	var CFuentes = document.createElement("div");

		CFuentes.setAttribute("class","menu_font");

		CFuentes.setAttribute("id","tyFont");		

		CFuentes.appendChild(LFuentes);		

//Creando Boton de Listado de Fuentes

	bar.appendChild(opmenu('<img src="images/editor-theme/edit.png" title="Tamaño de Fuente">','tyFont'));

	var opMenuTy = document.getElementById("tyFontB");	

		opMenuTy.appendChild(CFuentes);

		

//Creando lista de Colores		

	var LColores = document.createElement("UL");	

		LColores.appendChild(AddColor("<div style='color:#F00' class='submenu_editor'>&nbsp;Rojo</div>", "#FF0000"));

		LColores.appendChild(AddColor("<div style='color:#0F0' class='submenu_editor'>&nbsp;Verde</div>", "#00FF00"));

		LColores.appendChild(AddColor("<div style='color:#00F' class='submenu_editor'>&nbsp;Azul</div>", "#0000FF"));		

		LColores.appendChild(AddColor("<div style='color:#000' class='submenu_editor'>&nbsp;Negro</div>", "#000000"));				

		LColores.appendChild(AddColor("<div style='color:yellow' class='submenu_editor'>&nbsp;Amarillo</div>", "yellow"));				

		LColores.appendChild(AddColor("<div style='color:cyan' class='submenu_editor'>&nbsp;Cyan</div>", "cyan"));				

		LColores.appendChild(AddColor("<div style='color:magenta' class='submenu_editor'>&nbsp;Magenta</div>", "magenta"));										

//Creando Contenedor de Colores

	var CColores = document.createElement("div");

		CColores.setAttribute("class","menu_font");

		CColores.setAttribute("id","clFont");

		CColores.appendChild(LColores);		

//Creando Boton de Listado de Colores

	bar.appendChild(opmenu('<img src="images/editor-theme/text_color.png" title="Cambiar Color de Letra">','clFont'));		

	var opMenuCl = document.getElementById("clFontB");	

		opMenuCl.appendChild(CColores);

		

		

//Creando lista de Stillis		

	var LStills = document.createElement("UL");	

		LStills.appendChild(AddLight("<div style='color:#F00' class='submenu_editor'>&nbsp;Rojo</div>", "red"));

		LStills.appendChild(AddLight("<div style='color:#0F0' class='submenu_editor'>&nbsp;Verde</div>", "#00FF00"));

		LStills.appendChild(AddLight("<div style='color:#00F' class='submenu_editor'>&nbsp;Azul</div>", "blue"));		

		LStills.appendChild(AddLight("<div style='color:#000' class='submenu_editor'>&nbsp;Negro</div>", "black"));				

		LStills.appendChild(AddLight("<div style='color:yellow' class='submenu_editor'>&nbsp;Amarillo</div>", "yellow"));				

		LStills.appendChild(AddLight("<div style='color:cyan' class='submenu_editor'>&nbsp;Cyan</div>", "cyan"));				

		LStills.appendChild(AddLight("<div style='color:magenta' class='submenu_editor'>&nbsp;Magenta</div>", "magenta"));										

//Creando Contenedor de Stillis

	var CStills = document.createElement("div");

		CStills.setAttribute("class","menu_font");

		CStills.setAttribute("id","clStill");

		CStills.appendChild(LStills);		

//Creando Boton de Listado de Stillis

	bar.appendChild(opmenu('<img src="images/editor-theme/highlighter-text.png" title="Fondo del Texto">','clStill'));		

	var opMenuSl = document.getElementById("clStillB");	

		opMenuSl.appendChild(CStills);

		

				

//Creando lista de Tamaños de Fuente

	var LTamano =  document.createElement("UL");	

		LTamano.appendChild(AddSize("<div class='submenu_editor'>&nbsp;Pequeña</div>", "-3%"));

		LTamano.appendChild(AddSize("<div class='submenu_editor'>&nbsp;Normal</div>", "3%"));

		LTamano.appendChild(AddSize("<div class='submenu_editor'>&nbsp;Mediana</div>", "+3%"));

		LTamano.appendChild(AddSize("<div class='submenu_editor'>&nbsp;Grande</div>", "+6%"));

//Creando Contenedor de Tamaños de Fuente

	var CTamano = document.createElement("div");

		CTamano.setAttribute("class","menu_font");

		CTamano.setAttribute("id","tmFont");

		CTamano.appendChild(LTamano);		

//Creando Boton de Listado de Tamaños de Fuente

	bar.appendChild(opmenu('<img src="images/editor-theme/zoom_out.png" title="Tamaño de Fuente">','tmFont'));		

	var opMenuTm = document.getElementById("tmFontB");	

		opMenuTm.appendChild(CTamano);	

		

	bar.appendChild(spacer());			

		

//Creando lista de Tamaños de Fuente

	var LApiA =  document.createElement("UL");	

		LApiA.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Nombre</div>", "::abogado::"));
		LApiA.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Cedula</div>", "::cedulaabogado::"));		
		LApiA.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Universidad</div>", "::universidad::"));
		LApiA.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Tarjeta Profesional</div>", "::tarjetaprofesional::"));				
		LApiA.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Ciudad</div>", "::ciudadabogado::"));		
		LApiA.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Direccion</div>", "::direccionabogado::"));
		LApiA.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Telefono</div>", "::telefono::"));
		LApiA.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;E-Mail</div>", "::email::"));

//Creando Contenedor de Tamaños de Fuente
	var CApiA = document.createElement("div");
		CApiA.setAttribute("class","menu_font");
		CApiA.setAttribute("id","ApiA");
		CApiA.appendChild(LApiA);		
//Creando Boton de Listado de Tamaños de Fuente
	bar.appendChild(opmenu('<img src="images/editor-theme/user-business-boss.png" title="Informacion del Abogado">','ApiA'));		
	var opMenuApiA = document.getElementById("ApiAB");	
		opMenuApiA.appendChild(CApiA);						

/*

CREACION DE ELEMENTOS PARA INFORMACION DE DEMANDANTES DE TIPO PERSONA NATURAL
PARA AÑADIR O ELIMINAR ELEMENTOS SE DEBE AGREGAR AL ELEMENTO (VARIABLE) UN NODO NUEVO
EJ: A LA VARIABLE LApiB (AÑADIR UN NODO) .appendChild() (PASARLE EL ELEMENTO) AddEElement("","");

DONDE
AddEElement("EL TEXTO QUE VERA EL USUARIO","EL CODIGO QUE GENERA");

*/

//Creando lista de Tamaños de Fuente
	var LApiB =  document.createElement("UL");	


		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Nombre del Demandante</div>", "::nombredemandante::"));
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Identificacion Demandante</div>", "::identificaciondemandante::"));
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Expedicion Identificacion</div>", "::expedicionidentificaciondemandante::"));		
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Telefono del Demandante</div>", "::telefonodemandante::"));	
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;E-mail del Demandante</div>", "::emaildemandante::"));			
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Direccion del Demandante</div>", "::direcciondemandante::"));		
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Ciudad del Demandante</div>", "::ciudaddemandante::"));	
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Datos de Demandantes</div>", "::INFORMACIONDEMANDANTES::"));
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Notificar Demandantes</div>", "::demandantesnotificacion::"));
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Representante Legal</div>", "::representantelegaldemandante::"));		
		LApiB.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Direccion del Representante Legal</div>", "::ciudadrepresentantelegaldemandante::"));	
		


//Creando Contenedor de Tamaños de Fuente
	var CApiB = document.createElement("div");
		CApiB.setAttribute("class","menu_font");
		CApiB.setAttribute("id","ApiB");
		CApiB.appendChild(LApiB);		

//Creando Boton de Listado de Tamaños de Fuente
	bar.appendChild(opmenu('<img src="images/editor-theme/user-green.png" title="Informacion de Demandante Natural">','ApiB'));		
	var opMenuApiB = document.getElementById("ApiBB");	
		opMenuApiB.appendChild(CApiB);						


/* CREACION DE ELEMENTOS PARA INFORMACION DE DEMANDANTES DE TIPO DEMANDANTE JURIDICO */
//Creando lista de Tamaños de Fuente
	var LApiC =  document.createElement("UL");	

		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Nombre del Demandado</div>", "::nombredemandado::"));
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Identificacion Demandado</div>", "::identificaciondemandado::"));			
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Expedicion Demandado</div>", "::expedicionidentificaciondemandado::"));	
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Telefono del Demandado</div>", "::telefonodemandado::"));			
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Email del Demandado</div>", "::emaildemandado::"));	
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Direccion Demandado</div>", "::direcciondemandado::"));		
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Ciudad de Demandados</div>", "::ciudaddemandados::"));	
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Datos de Demandados</div>", "::INFORMACIONDEMANDADOS::"));
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Notificar Demandados</div>", "::demandadosnotificacion::"));					
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Representante Legal</div>", "::representantelegal::"));
		LApiC.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Direccion del Representante Legal</div>", "::ciudadrepresentantelegal::"));		
//Creando Contenedor de Tamaños de Fuente
	var CApiC = document.createElement("div");
		CApiC.setAttribute("class","menu_font");
		CApiC.setAttribute("id","ApiC");
		CApiC.appendChild(LApiC);		
//Creando Boton de Listado de Tamaños de Fuente
	bar.appendChild(opmenu('<img src="images/editor-theme/user-red.png" title="Informacion de Demandados">','ApiC'));
	var opMenuApiC = document.getElementById("ApiCB");	
		opMenuApiC.appendChild(CApiC);						




/* CREACION DE ELEMENTOS PARA INFORMACION DE DEMANDANTES DE TIPO DEMANDANTE JURIDICO */
//Creando lista de Tamaños de Fuente
	var LApiD =  document.createElement("UL");	

		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Titulo de Demanda</div>", "::titulo::"));
		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Valor de la Demanda</div>", "::valornumero::"));
		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Valor en Letras de la Demanda </div>", "::valorletras::"));
		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Naturaleza del proceso </div>", "::naturalezaproceso::"));
		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Fecha de Presentacion </div>", "::fechapresentacion::"));
		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Radicado</div>", "::radicado::"));
		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Nombre de Entidad</div>", "::juzgado::"));
		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Direccion de Entidad </div>", "::direccionentidad::"));
		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Telefono Entidad </div>", "::telefonoentidad::"));
		LApiD.appendChild(AddEElement("<div class='submenu_editor'>&nbsp;Ciudad de Entidad </div>", "::ciudadentidad::"));
		
//Creando Contenedor de Tamaños de Fuente
	var CApiD = document.createElement("div");
		CApiD.setAttribute("class","menu_font");
		CApiD.setAttribute("id","ApiD");
		CApiD.appendChild(LApiD);		
//Creando Boton de Listado de Tamaños de Fuente
	bar.appendChild(opmenu('<img src="images/editor-theme/bank.png" title="Informacion de Entidad judicial">','ApiD'));
	var opMenuApiD = document.getElementById("ApiDB");	
		opMenuApiD.appendChild(CApiD);						















	textarea.parentNode.appendChild(richtextarea);

	textarea.style.display = "none";





	richtextarea.contentWindow.document.designMode = "on";

	

//	var textb = document.getElementById("textarea")

	//var t = textb.value;		

	//richtextarea.contentWindow.document.body.innerHTML = t

	

	

	richtextarea.contentWindow.onload = function()	

	{

		richtextarea.contentWindow.document.designMode = "on";

		richtextarea.contentWindow.document.body.innerHTML = textarea.value;

	}

		

	textarea.form.attachEvent('onsubmit', set_textbox);

}

			

function loadTextboxes()

{

	var textareas = document.getElementsByTagName('textarea');

	

	for(var i=0; i < textareas.length; i++)

	{

		if (textareas.item(i).className == "richtextbox")

		{

			richtextbox(textareas.item(i));

		}

	}

}



window.attachEvent('onload',loadTextboxes);