$(document).on("ready", function(){
	var base_url = $("#navbar>ul>li>a#navbar_city_tour").attr('href');
	$("#transporte").on("change", function(){
		$.ajax({
			url: base_url + '/list_vehicles',
			type: 'POST',
			dataType: 'json',
			data: {id_transporte: $(this).val()}
		})
		.done(function(response) {
			$("#vehiculo").empty();
			$.each(response, function(index, val) {
				$("#vehiculo").append("<option value='" + 
					val.id + "'>" + val.tipo + " - " + val.placa + "</option>"
				);
			});

			if($("#vehiculo").val() != null) {
				$.each(response, function(index, value) {
					if($("#vehiculo").val() == value.id) {
						$("#cupos").val(value.cupo_maximo);
					}
				});
			}else{
				$("#cupos").val("");
			}

			$("#vehiculo").on('change', function(event) {
				console.log($("#vehiculo").val());
				if($("#vehiculo").val() != null) {
					$.each(response, function(index, value) {
						if($("#vehiculo").val() == value.id) {
							$("#cupos").val(value.cupo_maximo);
						}
					});
				} else {
					$("#cupos").val("");
				}
			});
		})
		.fail(function() {
			console.log("error");
		})
	});

	$("table .detail").on('click', function(event) {
		event.preventDefault();
		$('#modal').fadeIn();
		$('.background-modal').fadeTo( 500, .5 );
	});

	$("#modal-close-button").on('click', function(event){
		$('#modal, .background-modal').fadeOut(500);
	});
});