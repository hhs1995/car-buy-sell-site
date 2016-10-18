<script language="javascript">

function enviar_consulta_popup(){
	
	$('#response').hide();
	$('.fields-container.popup').hide();
	$('.preloader-ajax-contacto.popup').show();

	var nombre_apellido = $('#nombre_apellido_popup').val();
	var email = $('#email_popup').val();
	var provincia_id = $('#provincia_id_popup').val();
	var telefono = $('#telefono_popup').val();
	var comentarios = $('#comentarios_popup').val();
	var plan_id = $('#plan_id_popup').val();
	var tipo = $('#tipo_popup').val();
	var origen = $('#origen_popup').val();
	
	url = '<?php echo Router::url(array('controller'=>'planes','action'=>'enviar_consulta'));?>';
	params = {
		'data[Contacto][nombre_apellido]' : nombre_apellido,
		'data[Contacto][email]' : email,
		'data[Contacto][provincia_id]' : provincia_id,
		'data[Contacto][telefono]' : telefono,
		'data[Contacto][comentarios]' : comentarios,
		'data[Contacto][plan_id]' : plan_id,
		'data[Contacto][tipo]' : tipo,
		'data[Contacto][origen]' : origen,
	}
	$.post(url, params, function(data){
		$('.preloader-ajax-contacto.popup').hide();
		$('.mensaje-contacto.popup').html(data);
		$('.mensaje-contacto.popup').show();
	});
	
	return false;
	
	
}

</script>
<div class="form_popup">
	<div id="formPopup" class="formulario-consulta" style="display:none;" >
		<h5>&iquest;Necesitas ayuda?</h5>
		<h6>Consulta asesor<br>oficial online</h6>
		<div id="btnCerrar">
			<span>X</span>
		</div>
		<?php
		$origen = null;
		if($plan['Plan']['id']!==null){
			$origen = 'Plan id '.$plan['Plan']['codigo'].' - '.$plan['Plan']['denominacion'];
		} else {
			if ($this->params['controller'] == 'planes') {
				switch($this->params['action']) {
					case 'inicio':
						$origen = 'Página de inicio';
						break;
					case 'todos':
						$origen = 'Todos los planes';
						break;
					case 'nuevos':
						$origen = 'Planes nuevos';
						break;
					case 'adjudicados':
						$origen = 'Planes adjudicados';
						break;
					case 'comenzados':
						$origen = 'Planes sin adjudicar';
						break;
					case 'busqueda':
						$origen = 'Búsqueda';
						break;
				}
			}
		}
		echo $this->Form->create('contacto',array('onsubmit'=>'enviar_consulta_popup();return false;','id'=>'FormContacto'));
		echo '<div class="mensaje-contacto popup"></div>';
		echo '<div class="fields-container popup">';
			echo $this->Form->input('nombre_apellido', array('label'=>false,'placeholder'=>'Apellido y nombre *','required'=>true,'id'=>'nombre_apellido_popup'));
			echo $this->Form->input('email', array('label'=>false, 'type'=>'email', 'placeholder'=>'Email *', 'required'=>true,'id'=>'email_popup'));
			echo $this->Form->input('provincia_id', array('label'=>false, 'options'=>$provincias, 'required'=>true,'id'=>'provincia_id_popup'));
			echo $this->Form->input('telefono', array('label'=>false, 'type'=>'text', 'placeholder'=>'Telefono *', 'required'=>true,'id'=>'telefono_popup') );
			echo $this->Form->input('comentarios', array('label'=>false, 'type'=>'textarea', 'placeholder'=>'Comentarios *', 'required'=>true,'id'=>'comentarios_popup'));
			echo $this->Form->input('origen', array('label'=>false, 'type'=>'hidden', 'value'=>$origen,'id'=>'origen_popup'));
			echo $this->Form->input('plan_id', array('label'=>false, 'type'=>'hidden', 'value'=>$plan['Plan']['id'],'id'=>'plan_id_popup'));
			echo $this->Form->input('tipo', array('label'=>false, 'type'=>'hidden', 'value'=>'Consulta Popup','id'=>'tipo_popup'));
			echo $this->Form->submit(__('Consultar'));
		echo '</div>';
		echo '<div class="preloader-ajax-contacto popup" style="margin:110px auto"></div>';
		/*echo '<div id="response"></div>';*/
		echo $this->Form->end(); ?>
	</div>
</div>
<?php echo $this->Html->script('popup'); ?>