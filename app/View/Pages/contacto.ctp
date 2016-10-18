<?php 
	echo $this->element('form-html5-jquery');
	echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp")));
?>
<script>
	function enviar_consulta(){
		$('#response').hide();
		$('.fields-container').hide();
		$('.preloader-ajax-contacto').show();
		
		var nombre_apellido = $('#nombre_apellido').val();
		var email = $('#email').val();
		var telefono = $('#telefono').val();
		var empresa = $('#empresa').val();
		var zona = $('#zona').val();	
		var comentarios = $('#comentarios').val();	
		var tipo = $('#tipo').val();	
		
		url = '<?php echo Router::url(array('controller'=>'planes','action'=>'enviar_consulta'));?>';
		params = {
			'data[Contacto][nombre_apellido]' : nombre_apellido,
			'data[Contacto][email]' : email,
			'data[Contacto][telefono]' : telefono,
			'data[Contacto][comentarios]' : comentarios,		
			'data[Contacto][empresa]' : empresa,
			'data[Contacto][zona]' : zona,
			'data[Contacto][tipo]' : tipo,
			'data[Contacto][estado]' : 'nuevo',
		}
		$.post(url, params, function(data){
			$('.preloader-ajax-contacto').hide();
			$('.mensaje-contacto').html(data);
			$('.mensaje-contacto').show();
			$('#conversion-code').html('<iframe style="display: none;" src="<?php echo $this->Html->url(array('controller'=>'app','action'=>'conversion','contacto')); ?>"/>');
		});
		
		return false;
	}	
</script>
<div class="pages contacto">
	<div class="banner-central"><?php echo $this->Html->image('tuplanya/banner-contacto.png');?></div>
	
	<div id="col-izq" class="columna">
		<p class="texto">Por favor, ingresá tus datos en el formulario adjunto. En 48hs hábiles, el equipo de TuPlanYa procesará tu consulta y te contactará para avanzar en tu necesidad. Recordá que <b>nuestra plataforma de datos y de rastreo de búsqueda, asegura que quien utiliza el sistema de TuPlanYa, logra satisfacer su necesidad automotriz y financiera en sólo 3 pasos. Para esto, en breve nos contactaremos con vos. Gracias por elegir operar con TuPlanYa.</b></p>
		<ul class="menu-info">
			<li class="correo">info@tuplanya.com</li>
		<!-- 	<li class="direccion"><div class="texto">Av. Congreso 3550</div><div class="horarios">Lunes a Viernes de 9hs a 18hs - Sábados de 9hs a 13hs</div></li> -->
		</ul>
	</div>
	
	<div id="col-der" class="columna">
		<div class="formulario-consulta">
			<h5>Formulario de consulta</h5>
			<?php 
			echo $this->Form->create('Contacto',array('onsubmit'=>'enviar_consulta();return false;','id'=>'FormContacto'));
			echo '<div class="mensaje-contacto"></div>';
			echo '<div class="fields-container">';
				echo $this->Form->input('nombre_apellido', array('label'=>false,'placeholder'=>'Apellido y Nombre *','required'=>true,'id'=>'nombre_apellido'));
				echo $this->Form->input('telefono', array('label'=>false, 'placeholder'=>'Teléfono','id'=>'telefono'));
				echo $this->Form->input('email', array('label'=>false, 'type'=>'email', 'placeholder'=>'Email *', 'required'=>true,'id'=>'email'));
				echo $this->Form->input('empresa', array('label'=>false, 'id'=>'empresa','placeholder'=>'Empresa'));
				echo $this->Form->input('zona', array('label'=>false,'id'=>'zona','placeholder'=>'Zona'));
				echo $this->Form->input('comentarios', array('label'=>false, 'type'=>'textarea', 'placeholder'=>'Comentarios','id'=>'comentarios'));
				echo $this->Form->input('tipo', array('label'=>false, 'type'=>'hidden', 'value'=>'Contacto','id'=>'tipo'));
				echo $this->Form->submit(__('Consultar'));
			echo '</div>';
			echo '<div class="preloader-ajax-contacto" style="margin:110px auto"></div>';
			echo '<div id="response"></div>';
			echo $this->Form->end(); ?>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div id="conversion-code"></div>