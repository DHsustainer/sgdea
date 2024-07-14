
// JavaScript Document
$(document).ready(function(){

	
	//$("#btn_insert_event").live("click", function(){
		
	//}); 


});

function printMonths(see, day,current, pid, id, action){

	var str = 'prm1='+see+'&prm2='+day+'&current='+current+'&pid='+pid+'&folder='+id+'&actionx='+action;
	var URL = "/agenda/getmonths/";
		$.ajax({
			type: 'POST',
			url: URL,
			data: str,
			success: function(msg){	
				$('#prev_month').html(msg);			
			}
		});
}


function closeBox(){
	$("#view_event").animate({ "top": "-10px", "opacity" : '0' }, "fast" );
	$("#view_event").html("");
}

function UpdateEvent(){
	var str = $("#FormUpdateevents").serialize();
	$.ajax({
		type: 'POST',
		url: "/agenda/actualizar/",
		data: str,
		success: function(msg){	
			$('#view_event').html(msg);	
		}
	});	

}

function InsertEvent(){
	if($("#title").val() == ""){
		alert("Debes escribir un título");
		return false;
	}
	if($("#date").val() == ""){
		alert("Debes seleccionar una fecha para evento");
		return false;
	}
	if($("#time").val() == ""){
		alert("Debes escribir una hora para el evento");
		return false;
	}
	else{
		var str = $("#formevents").serialize();
		$.ajax({
			type: "POST",
			url: "/agenda/registrar/",
			data: str,
			success:function(msg){
				result = msg;
				alert(result);
				window.location.reload();
			}
		});			
	}
}
/*
*/
