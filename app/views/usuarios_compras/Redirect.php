<div class="row m-t-20">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
	 		<h4>Espere un momento mientras es redireccionado al comercio. Si no es redireccionado en unos seguidos haga clic en el botón "Pagar"</h4>

		

<form action="https://checkout.wompi.co/p/" method="GET" id="myForm">
  <!-- OBLIGATORIOS -->
  <input type="hidden" name="public-key" value="<?= $token_id ?>" />
  <input type="hidden" name="currency" value="COP" />
  <input type="hidden" name="amount-in-cents" value="<?= $total ?>00" />
  <input type="hidden" name="reference" value="<?= $token ?>" />
  <!-- OPCIONALES -->
  <input type="hidden" name="redirect-url" value="<?= $url_retorno ?>"/>
  <button type="submit">Pagar</button>
</form>

<script type="text/javascript">
	document.getElementById("myForm").submit();
</script>

		</div>
	</div>
</div>