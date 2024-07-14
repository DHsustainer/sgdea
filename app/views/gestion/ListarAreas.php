	<div class="panel panel-default block1 m-t-30">
		<div class="panel-wrapper collapse in">
			<div class="panel-body">
			<div class="row m-t-20">
				<div class="col-md-12">
					<ol class="breadcrumb default" id="LoadNavitagionList">
						<li class="active">
							<a href="/gestion/getareas/0/">
								Gestión
							</a>
						</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row p-30" id="formnavigation">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})


	$(document).ready(function() {
		$.ajax({
			url: '/navigator/GetFirstViewNavigation/',
			type: 'GET',
			success: function(data) {
				$('#formnavigation').html(data);
			}
		});
	});

	function LoadAjaxFolder(url){
		$.ajax({
			url: url,
			type: 'GET',
			success: function(data) {
				$('#formnavigation').html(data);
			}
		});
	}

</script>