<?php 
if(NAVEGADOR == 'IE9' || NAVEGADOR == 'IE8' || NAVEGADOR == 'IE7'){
	echo $this->Html->script(array('jquery.html5form-1.5-min'),array('inline'=>false));
	echo "
	<script>
	$(document).ready(function(){
		$('#FormContacto').html5form({
			async : false,
			messages : 'es',
			emptyMessage : 'Los campos con * son obligatorios',
			emailMessage : 'La direccion de email no es correcta, por favor intente nuevamente',			
			colorOff : '#707070',
			colorOn : '#707070',
			allBrowsers: true,
			responseDiv : '#response',
			
		}); 
	});
	</script>";

}
?>