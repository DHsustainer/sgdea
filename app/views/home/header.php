

<div id="del-logo"></div>
<div id="del-buscar">
	<button id="del-button-buscar">Buscar</button>
	<input type="text" id="del-input-buscar" placeholder="asdasdf" />
</div>
<div id="del-right">
	<div id="del-alarmas">
		<div class="icon alerta del-alarma"><span id="alerta"></span></div>
		<div class="icon mensaje blue-low del-alarma"><span id="mensaje"></span></div>
		<div class="icon users blue del-alarma"><span id="users"></span></div>
		<div class="icon engranaje green del-alarma"><span id="engranaje"></span></div>
		<div class="icon cancelar del-alarma"><span id="cancelar"></span></div>
	</div>
	<div id="del-user">
		<div class="icon user"></div>
		<div id="del-user-info">
			<li class="nivel1"><a class="nivel1"><?=$_SESSION[nombre]?></a><span class="opc-arrow"></span>
				<ul class="nivel2">
					<li><a class="nivel2">Configurar</a></li>
					<li><a class="nivel2">Salir</a></li>
				</ul>
			</li>
		</div>
	</div>
</div>