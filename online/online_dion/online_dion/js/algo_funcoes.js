
$(document).ready(function(){

	if($(document).width()>768){

		$(document).on("scroll",function(){
			if($(document).scrollTop()>0){
				$(".navalgo").fadeIn();
				$(".btnfixed").slideDown();
				$(".pop_cafarani-sm").show("slide", { direction: "right" }, 1000);
			} else{
				$(".navalgo").fadeOut();
				$(".btnfixed").slideUp();
				$(".pop_cafarani-sm").hide("slide", { direction: "right" }, 1000);
			}
		});
	}

	else{
   	$(".navalgo").fadeIn();
				$(".btnfixed-xs").slideDown();
				$(".btnfixed-2-xs").slideDown();
				$(".pop_cafarani-xs").slideDown();	

	 }

  	return false;
	
});






$('.btnopendrop').click( function(){
	$(this).siblings(".laminadrop").slideDown();
});
$('.btnclosedrop').click( function(){
	$(this).parent(".laminadrop").slideUp();
});


$(document).ready(function() {
	if($(document).width()>765){
	$('#fullpage').fullpage({
		anchors: ['firstPage', 'secondPage', '3rdPage', '4thPage', '5thPage', '6thPage', '7thPage', '8thPage', '9thPage', '10thPage', '11thPage', '12thPage'],
		scrollBar: true,
		scrollOverflow: true,
		responsiveWidth: 991,
		afterResponsive: function(isResponsive){

		}
	});
	}
});

// Yep, that's it!
//$('#scene').parallax();




//Parallax Background
$(document).ready(function(){
		if($(document).width()>991){
			$('div.bgParallax').each(function(){
				var $obj = $(this);

				$(window).scroll(function() {
					var yPos = -($(window).scrollTop() / $obj.data('speed')); 

					var bgpos = '100% '+ yPos + 'px';

					$obj.css('background-position', bgpos );

				});
			});
		}
			
			 else{}
          
          return false;
});