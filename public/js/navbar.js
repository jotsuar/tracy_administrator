$(document).on("ready",function()
{
	$("#navbar > ul > li").on("click",function(event){
		$(this).children('ul').toggle('slow');
	});

	$("#navbar > ul > li").on("mouseleave",function(event){
		$(this).children('ul').hide('slow');
	});

	$("#content .data").on("click",function(){
		$(location).attr('href',$(this).data('link'));
	});

	$("#form > .message").on("click",function(){
		$(this).fadeOut("slow");
	});
});