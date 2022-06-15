var shadow;
function showShadow(){
    shadow.show();
}
function hideShadow(){
    shadow.hide();
}
$(function(){
    shadow = $('<div class="modal-backdrop fade in" id="shadow">'
		+'<div id="loading-center-absolute">'
		+'	<div class="object" id="object_one"></div>'
		+'	<div class="object" id="object_two"></div>'
		+'	<div class="object" id="object_three"></div>'
		+'	<div class="object" id="object_four"></div>'
		+'	<div class="object" id="object_five"></div>'
		+'	<div class="object" id="object_six"></div>'
		+'	<div class="object" id="object_seven"></div>'
		+'	<div class="object" id="object_eight"></div>'
		+'</div>'
	+'</div>').appendTo("body");
	//shadow.hide();
})(jQuery);