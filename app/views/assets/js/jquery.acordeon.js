$(function(){
	jQuery.fn.acordeon = function(){
		this.each(function(){
			var $acordeon = $(this);
			var n		  = $acordeon.children().size();
			$acordeon.children().on("click", function(){
				var $tab = $(this);

				if($tab.hasClass("tab-activa")){
					$tab.children().eq(1).slideUp();
					$(".tab-activa").removeClass("tab-activa");
					return false;
				}

				for(var i=0; i<n; i++){
					$acordeon.children().eq(i).children().eq(1).slideUp();
				}

				$tab.children().eq(1).slideDown();
				$tab.addClass("tab-activa");
			});

		});
	}
});