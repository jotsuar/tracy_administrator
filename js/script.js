$(document).on("ready",function(){
	
	$("nav>ul>ul.subMenu").hide();

	//Desplegar el submenu de la barra de navegacion
	$("nav>ul>li>a.menu").on("click",function(){
		$("nav>ul>ul.subMenu").slideDown(300);
	});

	//Contraer elsubmenu de la barra de navegacion
	$("nav>ul>ul.subMenu").on("mouseleave",function(){
		$(this).slideUp(300);
	});	

	//boton para mostrar el formulario de consulta(es el boton consultar)
	$("section form>div.groupButton>button.consultar").on("click",function(){
		$(location).attr('href',$(this).data('link'));
	});

	//boton para mostrar el formulario de registro(es el boton volver)
	$("section>div>div.consulta>form>button").on("click",function(){
		$(location).attr('href',$(this).data('link'));
	});

	// var frm_contacto = "section form>div.frm_contacto";
	// var frm = "section form>div.frm";
	// $(frm_contacto).hide();

	//Mostrar con un efecto el formulario de contacto
	// $("section form>div.frm>div.groupButton>button.siguiente").on("click",function(){
	// 	$(frm).hide();
	// 	$(frm_contacto).show("fast");
	// });

	// $("section >form>div.frm_contacto>div.groupButton>button.volver").on("click",function(){
	// 	$(frm_contacto).hide();
	// 	$(frm).show("fast");
	// });
	
	
});
function next(back,next){
	$("#"+back).hide();
	$("#"+next).show('slow');
	}

	function back(back,next){
	$("#"+next).hide();
	$("#"+back).show('slow');
	}