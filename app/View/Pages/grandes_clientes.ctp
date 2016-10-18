<?php echo $this->element('form-html5-jquery');echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp")));?>
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
	}
	$.post(url, params, function(data){
		$('.preloader-ajax-contacto').hide();
		$('.mensaje-contacto').html(data);
		$('.mensaje-contacto').show();
		$('#conversion-code').html('<iframe style="display: none;" src="<?php echo $this->Html->url(array('controller'=>'app','action'=>'conversion','grandes_clientes')); ?>"/>');
	});
	
	return false;
	
	
}	
</script>
<div class="pages contacto">
	<div class="banner-central"><?php echo $this->Html->image('tuplanya/banner-grandesclientes.png');?></div>
	
	<div id="col-izq" class="columna">
		<p class="texto">TuPlanYa le ofrece a quienes tengan una cartera de clientes con planes de ahorro agrupados y/o adjudicados, que pueda formar parte del
sistema TuPlanYa de compra/ venta de planes. Cómo funciona? TuPlanYa te ofrece la herramienta para que puedas publicar tu cartera, y de
esta manera facilitar la compra venta de planes de ahorro que tengas. Si es tu caso, sólo tendrías que enviarnos la información del formulario
adjunto, especialmente preparada para colegas de TuPlanYa o concesionarios. Esperamos tu contacto. Tenemos una gran oportunidad para tu
negocio!</p>
		<p style="font-size:20px;font-weight:bold;margin-top:20px;"><?php echo __('¡Formá parte de Tu Plan Ya!',true);?></p>
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
				echo $this->Form->input('email', array('label'=>false, 'type'=>'email', 'placeholder'=>'Email *', 'required'=>true,'id'=>'email'));
				echo $this->Form->input('empresa', array('label'=>false, 'id'=>'empresa','placeholder'=>'Empresa'));
				echo $this->Form->input('zona', array('label'=>false,'id'=>'zona','placeholder'=>'Zona'));
				echo $this->Form->input('comentarios', array('label'=>false, 'type'=>'textarea', 'placeholder'=>'Comentarios','id'=>'comentarios'));
				echo $this->Form->input('tipo', array('label'=>false, 'type'=>'hidden', 'value'=>'Grandes Clientes','id'=>'tipo'));
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