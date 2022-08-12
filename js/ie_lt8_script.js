// JavaScript Document

$(document).ready(function(){
	alert('ie 8 called');
	
	var el = ['ul:abc','ul:bbc'];
	
	$.each(el, function(k, v){
		
		$(v).childern(':last').addClass('last-child');
		
		});
});