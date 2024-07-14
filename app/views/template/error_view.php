<html>
	<head>
		<title>Error de Sesion</title>
		<style>
			.da-message
			{	
				font-size:15px;
				font-weight: bold;
				border-bottom:1px solid #d2d2d2;
				padding:15px 8px 15px 8px;
				position:relative;
				vertical-align:middle;
				cursor:pointer;
				
				background-color:#f8f8f8;
				background-position:12px 12px;
				background-repeat:no-repeat;
				text-align: center;
			}


				.da-message p, 
				.da-message ul, 
				.da-message ol
				{
					margin:0;
				}

				.da-message ul li, 
				.da-message ol li
				{
					list-style-position:inside;
					list-style-type:inherit;
					margin:0;
				}

				.da-message.error
				{
					background-color:#DC6E53;
					border-color:#DC6E53;
					color:#FFF;
				}

				.da-message.error .da-message-close
				{
					background-position:right bottom;
				}


				.da-message.success
				{
					background-color:#67C295;
					border-color:#67C295;
					color:#FFF;
				}

				.da-message.success .da-message-close
				{
					background-position:left bottom;
				}


				.da-message.warning
				{
					background-color:#F3A343;
					border-color:#F3A343;
					color:#FFF;
				}

				.da-message.warning .da-message-close
				{
					background-position:right top;
				}


				.da-message.info
				{
					background-color:#5CB0DC;
					border-color:#5CB0DC;
					color:#FFF;
				}

				.da-message.info .da-message-close
				{
					background-position:left top;
				}
				.middle{
					margin-top: 20%;
				}

		</style>
	</head>
	<body>
		<div class='da-message error'>Error! Esta sección se encuentra desactivada</div>
	</body>
</html>