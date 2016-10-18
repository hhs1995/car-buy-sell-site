$( '#btnCerrar' ).click(function() {
	$( "#formPopup" ).slideUp(500);
});

function hacerpopup() {
	$( "#formPopup" ).slideDown(500);
}

function minuto(cantidad){
	var segundo = 1000;
	var minutos = 60*segundo;
	var tiempo = cantidad*minutos;
	
	return tiempo;
}

var minutos = minuto(1);

setTimeout(function() {
	hacerpopup();
}, minutos);