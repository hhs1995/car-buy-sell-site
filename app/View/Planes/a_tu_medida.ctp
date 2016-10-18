<?php echo $this->element('form-html5-jquery');
echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp")));?>
<script>
function enviar_consulta(){
	
	$('#response').hide();
	$('.fields-container').hide();
	$('.preloader-ajax-contacto').show();
	
	var nombre_apellido = $('#nombre_apellido').val();
	var telefono = $('#telefono').val();
	var celular = $('#celular').val();
	var email = $('#email').val();
	var horarios = $('#horarios').val();
	var dinero_contas = $('#dinero_contas').val();
	var dinero_mes = $('#dinero_mes').val();	
	var comentarios = $('#comentarios').val();
	var tipo = $('#tipo').val();	
	
	url = '<?php echo Router::url(array('controller'=>'planes','action'=>'enviar_consulta'));?>';
	params = {
		'data[Contacto][nombre_apellido]' : nombre_apellido,
		'data[Contacto][telefono]' : telefono,
		'data[Contacto][celular]' : celular,
		'data[Contacto][email]' : email,		
		'data[Contacto][horarios]' : horarios,		
		'data[Contacto][dinero_contas]' : dinero_contas,		
		'data[Contacto][dinero_mes]' : dinero_mes,		
		'data[Contacto][comentarios]' : comentarios,		
		'data[Contacto][tipo]' : tipo,
	}
	$.post(url, params, function(data){
		$('.preloader-ajax-contacto').hide();
		$('.mensaje-contacto').html(data);
		$('.mensaje-contacto').show();
		$('#conversion-code').html('<iframe style="display: none;" src="<?php echo $this->Html->url(array('controller'=>'app','action'=>'conversion','a_tu_medida')); ?>"/>');
	});
	
	return false;
	
	
}	
</script>
<div class="pages a_tu_medida contacto">
	<div class="banner-central"><?php echo $this->Html->image('tuplanya/banner-tuplanatumedida.png');?></div>
	
	<div id="col-izq" class="columna">
		<p style="font-size:20px;font-weight:bold;margin-top:20px;">Aún no pudiste encontrar lo que buscabas en TuPlanYA?</p>
		<br><p class="texto">Nuestra plataforma de datos y de rastreo de búsqueda, asegura que quien utiliza el sistema de TuPlanYa,
logra satisfacer su necesidad automotriz y financiera en sólo 3 pasos. Si a pesar de haberlo intentado, no pudiste satisfacer la operación que estabas buscando, te pedimos que por favor nos hagas llegar exactamente lo que estás buscando y nuestro equipo de profesionales volverá a vos con la solución que estabas esperando. Contactanos y armamos TuPlanYa a tu medida!</p>
	</div>
	
	<div id="col-der" class="columna">
		<div class="formulario-consulta">
			<h5>Formulario de consulta</h5>
			<?php 
			echo $this->Form->create('contacto',array('onsubmit'=>'enviar_consulta();return false;','id'=>'FormContacto'));
			echo '<div class="mensaje-contacto"></div>';
			echo '<div class="fields-container">';
				echo $this->Form->input('nombre_apellido', array('label'=>false,'placeholder'=>'Apellido y nombre *','required'=>true,'id'=>'nombre_apellido'));
				echo $this->Form->input('telefono', array('label'=>false, 'placeholder'=>'Télefono *','id'=>'telefono','required'=>true));
				echo $this->Form->input('celular', array('label'=>false, 'placeholder'=>'Celular','id'=>'celular'));
				echo $this->Form->input('email', array('label'=>false, 'type'=>'email', 'placeholder'=>'Email *', 'required'=>true,'id'=>'email'));
				echo $this->Form->input('horarios', array('label'=>false, 'id'=>'horarios','placeholder'=>'Horarios de contacto'));
				echo $this->Form->input('dinero_contas', array('label'=>false,'id'=>'dinero_contas','placeholder'=>'¿Con cuánto dinero contas? *','required'=>true));
				echo $this->Form->input('dinero_mes', array('label'=>false,'id'=>'dinero_mes','placeholder'=>'¿Cuánto podés pagar por mes? *','required'=>true));
				echo $this->Form->input('comentarios', array('label'=>false, 'type'=>'textarea', 'placeholder'=>'Contanos cuál es tu idea','id'=>'comentarios'));
				echo $this->Form->input('tipo', array('label'=>false, 'type'=>'hidden', 'value'=>'Plan a tu medida','id'=>'tipo'));
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