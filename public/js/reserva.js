$(".detail2").on('click', function(event){
	event.preventDefault();
	var ruta = $(this).attr('href');
	$.post(ruta, function(data, textStatus, xhr) {
		/*optional stuff to do after success */
		$(".modal-body2").html(data);
	});

	// alert(ruta);
});

	$("table .detail2").on('click', function(event) {
		event.preventDefault();
		$('#modal2').fadeIn();
		$('.background-modal2').fadeTo( 500, .5 );
	});

	$("#modal-close-button2").on('click', function(event){
		$('#modal2, .background-modal2').fadeOut(500);
	});