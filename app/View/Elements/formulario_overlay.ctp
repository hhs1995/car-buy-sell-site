<script>
function enviar_consulta(){
	ToggleForm();
	$('.formulario-consulta h5').hide();
	$('.fields-container').hide();
	$('.preloader-ajax-contacto').show();

	var nombre_apellido = $('#nombre_apellido').val();
	var email = $('#email').val();
	var provincia_id = $('#provincia_id').val();
	var telefono = $('#telefono').val();
	var comentarios = $('#formulario_2 #comentarios').val();
	var plan_id = $('#plan_id').val();
	var tipo = $('#tipo').val();
	
	url = '<?php echo Router::url(array('controller'=>'planes','action'=>'enviar_consulta'));?>';
	params = {
		'data[Contacto][nombre_apellido]' : nombre_apellido,
		'data[Contacto][email]' : email,
		'data[Contacto][provincia_id]' : provincia_id,
		'data[Contacto][telefono]' : telefono,
		'data[Contacto][comentarios]' : comentarios,
		'data[Contacto][plan_id]' : plan_id,
		'data[Contacto][tipo]' : tipo,
	}
	$.post(url, params, function(data){
		$('.preloader-ajax-contacto').hide();
		$('.mensaje-contacto').html(data);
		$('.mensaje-contacto').show();
		$('#conversion-code').html(
			'<iframe style="display: none;" src="<?php echo $this->Html->url(array('controller'=>'app','action'=>'conversion',strtolower($plan['Plan']['tipo']))); ?>"/>'
		);
	});
	return false;
}

function ToggleForm(){
	$('.overlay').toggle();
	$('#formulario_2').toggle();
}
</script>
<div class="formulario-overlay">
	<div class="overlay"></div>
	<div class="formulario-consulta" id="formulario_2">
		<?php echo $this->Html->link('CERRAR','javascript:void(0);',array('class'=>'btn-cerrar','onClick'=>'ToggleForm();')); ?>
		<h5>Formulario de consulta</h5>
		<?php 
		echo $this->Form->create('contacto',array('onsubmit'=>'enviar_consulta();return false;','id'=>'FormContacto'));
		echo '<div class="fields-container">';
			echo $this->Form->input('nombre_apellido', array('label'=>false,'placeholder'=>'Apellido y nombre *','required'=>true,'id'=>'nombre_apellido'));
			echo $this->Form->input('email', array('label'=>false, 'type'=>'email', 'placeholder'=>'Email *', 'required'=>true,'id'=>'email'));
			echo $this->Form->input('provincia_id', array('label'=>false, 'options'=>$provincias, 'required'=>true,'id'=>'provincia_id'));
			echo $this->Form->input('telefono', array('label'=>false, 'type'=>'text', 'placeholder'=>'Télefono *', 'required'=>true,'id'=>'telefono') );
			echo $this->Form->input('comentarios', array('label'=>false, 'type'=>'textarea', 'placeholder'=>'Comentarios *', 'required'=>true,'id'=>'comentarios'));
			echo $this->Form->input('plan_id', array('label'=>false, 'type'=>'hidden', 'value'=>$plan['Plan']['id'],'id'=>'plan_id'));
			echo $this->Form->input('tipo', array('label'=>false, 'type'=>'hidden', 'value'=>'Consulta Plan','id'=>'tipo'));
			echo $this->Form->submit(__('Consultar'));
		echo '</div>';
		echo $this->Form->end(); ?>
	</div>
</div>