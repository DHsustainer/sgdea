$(function(){
	jQuery.fn.scrollTo = function(options){
		var settings = jQuery.extend({
			padding: 0
		}, options);

		this.each(function(){
			var section = $(this);
			var idx = section.attr('id');
//SELECTORES DE MENU ACTIVO
			$(".seccion").removeClass("active");
			$("#"+section.attr('id')).addClass("active");

			$.scrollTo( '#'+idx, 800 );
//			$.scrollTo('#'+idx, 800, {offset:{top:-50}});
//SELECTORES DE MENU ACTIVO
//			$("html, body").animate({ scrollBottom: x }, 800);

//TAB!!! (ESCONDER EL ACORDEON)
			$tab = $(".tab-activa");
			if($tab.hasClass("tab-activa")){
				$tab.children().eq(1).slideUp();
				$(".tab-activa").removeClass("tab-activa");
			}
			$(".tab").removeClass("tab-activa");
//TAB!!! (ESCONDER EL ACORDEON)

		});
	} 

});

