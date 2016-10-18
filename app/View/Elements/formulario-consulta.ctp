<script>
function OpenBigForm(){
	if($('#formulario_1 #comentarios').val()!=''){
		$('#formulario_2 #comentarios').val($('#formulario_1 #comentarios').val());
		ToggleForm();
	}
}
</script>
<div class="formulario-consulta new" id="formulario_1">
	<?php if($plan['Modelo']['marca_id'] == '5' || $plan['Modelo']['marca_id'] == '2'){ ?>
		<?php $class = 'ahorro'; ?>
		<h4>Descuento por internet<br><span class="precio">$<?php echo $plan['Plan']['descuento_internet']; ?></span></h4>
		<h5 class="ahorro">Consultanos ahora por las bonificaciones especiales <b style="font-weight: bold;">TuPlanYa</b></h5>
	<?php }else{ ?>
		<h5>Consultanos por<br>las bonificaciones<br>especiales <b style="font-weight: bold;">TuPlanYa</b></h5>
	<?php }
	echo $this->Form->create('contacto',array('onsubmit'=>'OpenBigForm();return false;','id'=>'FormContacto','class'=>(isset($class)?'ahorro':'')));
	echo '<div class="mensaje-contacto"></div>';
	echo '<div class="fields-container">';
		echo $this->Form->input('comentarios', array('label'=>false, 'type'=>'textarea', 'placeholder'=>'Comentarios *', 'required'=>true,'id'=>'comentarios'));
		echo $this->Form->submit(__('Consultar'));
	echo '</div>';
	echo '<div class="preloader-ajax-contacto" style="margin:110px auto"></div>';
	echo $this->Form->end(); ?>
</div>