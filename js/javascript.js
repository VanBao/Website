$(document).ready(function () {
	$('#return-to-top').click(function() {      
		$('body,html').animate({
			scrollTop : 0                       
		}, 500);
	});
	$(".quantity").keypress(function (evt) {
    	if($(this).val() < 1){
    		evt.preventDefault();
    		$(this).val(1);
    	}
	});
	$(".criteria>h4").click(function(){
		var currentUL = $(this).parent().children("ul");
		// $(this).css({
		// 	"background-color": "#4da6ff",
		// 	"color" : "#fff"
		// });
		currentUL.slideToggle("slow");
		$(this).children("span:nth-child(2)").toggleClass("glyphicon-chevron-down");
		$(this).children("span:nth-child(2)").toggleClass("glyphicon-chevron-up");
		var arrUL = $(".criteria").children("ul");
		for(var i = 0; i < arrUL.length; i++){
			if(!$(arrUL[i]).is(currentUL.get(0)) 
				&& $(arrUL[i]).is(":visible")){
				$(arrUL[i]).slideUp("slow");
				$(arrUL[i]).prev().children("span:nth-child(2)").addClass("glyphicon-chevron-down");
				$(arrUL[i]).prev().children("span:nth-child(2)").removeClass("glyphicon-chevron-up");
			}
		}
	});
	
});