<div class='event-body $type-act $line' style='width:95%; height:auto;'>
	<div class='int-event'>
		<div class='foot-event' style='margin-top:10px;'>
			<div class='opc-event' style='position:inherit; float:right'>
				<a class='rea-event opc-link' onClick='closeBox()'>Cerrar</a>
			</div>
		</div>

		<div class='title-event'>Editar evento</div>
		<div class='franja-event'>
			<div class='desc-event' style='width:100%'>
				<form id='FormUpdateevents' method='POST'> 
					<table border='0' width='40%' cellspacing='10'>
						<tr>
							<td width='30%'><strong>Title:</strong></td>
							<td>
								<input type='text' name='title' id='title' maxlength='' value='<? echo $object -> Gettitle(); ?>' />
								<input type='text' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
							</td>
						</tr>
						<tr>
							<td width='30%'><strong>Description:</strong></td>
							<td><textarea name="description" id="description" cols="25" rows="10"><? echo $object -> Getdescription(); ?></textarea></td>
						</tr>
						<tr>
							<td width='30%'><strong>Date:</strong></td>
							<td><input type='text' name='date' id='date' maxlength='' value='<? echo $object -> Getdate(); ?>' /></td>
						</tr>
						<tr>
							<td width='30%'><strong>Time:</strong></td>
							<td><input type='text' name='time' id='time' maxlength='' value='<? echo $object -> Gettime(); ?>' /></td>
						</tr>
						<tr>
							<td width='30%'><strong>Avisar_a:</strong></td>
							<td><input type='text' name='avisar_a' id='avisar_a' maxlength='' value='<? echo $object -> Getavisar_a(); ?>' /></td>
						</tr>
						<tr>
							<td colspan='2' align='center'><input type='button' value='Actualizar' id='updateevent' onClick="UpdateEvent()"/></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>

