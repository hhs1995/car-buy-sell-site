<script>
	$(document).ready(function(){
		reloadHeight();
		window.addEventListener('orientationchange', reloadHeight);
		$('#footer .logo').click(function(){
			if($('#footer').hasClass('show')){
				$('#footer').removeClass('show');
			}else{
				$('#footer').addClass('show');
			}
		});
	});
	
	function reloadHeight(){
		$('#container').css('height',$(window).height());
	}
	
	function showMenu(id){
		var maxHeight = $('#'+id).css('max-height');
		if($('#'+id).css('height') == '0px'){
			$('.bottom .contenedor').css('height',0);
			$('#'+id).animate({height: maxHeight},500);
		}else{
			$('#'+id).animate({height: 0},500);
		}
	}
</script>