$(function(){
	var company = {
		url: null,
		data :null,
		clone: null,
		i : 1,
		html: "",
		object : null
	};

	//load vehicles when the company changes
	$(document).on("change", 'div.form-column>fieldset select.company', function(){
		company.url = $(this).attr('data-url');
		company.data = {transport_company_id: $(this).val()};
		company.object = this;
		company.html = "<option value='0'>--SELECCIONE VEHÍCULO--</option>";
		load_ajax('POST', function(response){
			$.each(response, function(key, value){
				company.html += "<option value='" + value.id + "'>" + value.placa + ' - ' + value.tipo + "</option>";
			});
			$(company.object).parent().find('select').eq(1).html(company.html);
		});
	});

	//load the amount of vehicle when the vehicle changes
	$(document).on('change', 'div.form-column select.vehicle', function(){
		company.url = $(this).prev().prev().attr('data-url');
		company.data = {vehicle_id: $(this).val()};
		company.object = this;
		load_ajax('POST', function(response){
			if(response.cupo_maximo === undefined){
				response.cupo_maximo = 0;
			}
			$(company.object).next().next().attr('value', response.cupo_maximo);
		});
	});

	//load the languages of guide when change select  guide
	$(document).on('change', 'fieldset.container-guias select', function(){
		company.url = $(this).attr('data-url');
		company.data = {guide_id: $(this).val()};
		company.object = $(this);
		load_ajax('POST', function(response){
			company.html = "";
			$.each(response, function(key, value){
				company.html += value.nombre.concat(' - ');
			});
			company.html = company.html.substring(0, company.html.length - 2);
			company.object.next().html(company.html);
		});
	});

	//Guias turistivos add DOM
	$(document).on('click', 'fieldset.container-guias a>span.glyphicon-plus-sign', function(){
		var clone = $(this).parents('fieldset.container-guias').clone();
		$(this).removeClass().addClass('glyphicon glyphicon-minus-sign');
		$("#guias-turisticos").append(clone);
	});

	//Guias turisticos remove DOM
	$(document).on('click', 'fieldset.container-guias a>span.glyphicon-minus-sign', function(){
		$(this).parents('fieldset.container-guias').remove();
	});

	//Vehicles add DOM
	$(document).on("click", "fieldset.container-vehicles a>span.glyphicon-plus-sign", function(){
		company.clone = $(this).parents("fieldset.container-vehicles").clone();
		$(this).parents("div.form-column").find('a').find('span').removeClass().addClass('glyphicon glyphicon-minus-sign');
		$(this).parents("div.form-column").append($(company.clone));
	});

	//Vehicles remove
	$(document).on("click", "div.form-column a>span.glyphicon-minus-sign", function(){
		$(this).parents("fieldset.container-vehicles").remove();
	});


	function load_ajax(method, callbak){
		$.ajax({
			url: company.url,
			data: company.data,
			type: method,
			cache: false,
			dataType: 'json'
		}).done(function(response){
			callbak(response)
		}).fail(function(error){
			console.error(error);
		});
	}

	//carga la informacion del los detalles del citytour
	$('table#table-citytours').find('a>span.glyphicon-list-alt').on('click', function(){
		var url_parameter = $(this).parent().attr('href');
		url_parameter = url_parameter.substring(url_parameter.length - 1, url_parameter.length);
		company.data = {};

		company.url = 'http://localhost/tracy/guia/get_guide_with_languages/'.concat(url_parameter);
		load_ajax('GET', function(response){
			company.html = '<thead>';
			if(response.length > 0){
				var languages = "";
				company.html += '<tr><th>Nombre</th>';
				company.html += '<th>Apellido</th>';
				company.html += '<th>Idiomas</th></tr>';
				company.html += '</thead>';
				$.each(response, function(llave, valor){
					languages = "";
					$.each(valor['languages'], function(key, value){
						languages += value.concat(' - ');
					});
					languages = languages.substring(0, languages.length - 2);
					company.html += '<tbody>';
					company.html += '<td>' + valor['nombre'] +'</td>';
					company.html += '<td>' + valor['apellido'] +'</td>';
					company.html += '<td>' + languages +'</td>';
					company.html += '</tbody>';
				});
			} else {
				company.html += '<tr><th>Información</th></tr>';
				company.html += '</thead>';
				company.html += '<tbody>';
				company.html += '<td><h1>No hay datos</h1></td>';
				company.html += '</tbody>';
			}

			$("#table-details-guides").html(company.html);
		});
		
		company.url = 'http://localhost/tracy/transport_company/vehicle/get_vehicles_citytour/'.concat(url_parameter);
		load_ajax('GET', function(response){
			company.html = '';
			if(response.length > 0){
				$.each(response, function(key, value){
					company.html += '<tr>';
					company.html += '<td>' + value.placa + '</td>';
					company.html += '<td>' + value.tipo + '</td>';
					company.html += '<td>' + value.transporte + '</td>';
					company.html += '</tr>';
				});
			} else {
				company.html = "<td colspan='3'><h1>No hay datos</h1></td>"
			}

			$("#table-details-vehicles").find('tbody').html(company.html);
		});
	});
});