<script>
function enviar_consulta(){
	
	$('.fields-container').hide();
	$('.preloader-ajax-contacto').show();
	
	var nombre_apellido = $('#nombre_apellido').val();
	var email = $('#email').val();
	var telefono = $('#telefono').val();
	var celular = $('#celular').val();
	var vehiculo = $('#vehiculo').val();
	var cuotas_pagas = $('#cuotas_pagas').val();
	var mensaje = $('#mensaje').val();
	var tipo = $('#tipo').val();
	
	url = '<?php echo Router::url(array('controller'=>'planes','action'=>'enviar_consulta'));?>';
	params = {
		'data[Contacto][nombre_apellido]' : nombre_apellido,
		'data[Contacto][email]' : email,
		'data[Contacto][telefono]' : telefono,
		'data[Contacto][celular]' : celular,
		'data[Contacto][vehiculo]' : vehiculo,
		'data[Contacto][cuotas_pagas]' : cuotas_pagas,
		'data[Contacto][mensaje]' : mensaje,		
		'data[Contacto][tipo]' : tipo,
	}
	$.post(url, params, function(data){
		$('.preloader-ajax-contacto').hide();
		$('.mensaje-contacto').html(data);
		$('.mensaje-contacto').show();
	});
	
	return false;
	
	
}	
</script>
<div class="planes canje">
	
	<div class="titulo-principal">Vender tu plan es fácil</div>
	
	<div class="formulario-consulta">		
		<?php 
		echo $this->Form->create('contacto',array('onsubmit'=>'enviar_consulta();return false;'));
		echo '<div class="mensaje-contacto venta"></div>';
		echo '<div class="fields-container">';
			echo $this->Form->input('nombre', array('label'=>false, 'placeholder'=>'Apellido y nombre *', 'required'=>true,'id'=>'nombre_apellido'));		
			echo $this->Form->input('email', array('label'=>false, 'type'=>'email', 'placeholder'=>'Email *', 'required'=>true,'id'=>'email'));
			echo $this->Form->input('telefono', array('label'=>false, 'placeholder'=>'Cod Área + Teléfono *', 'required'=>true,'id'=>'telefono') );
			echo $this->Form->input('celular', array('label'=>false, 'placeholder'=>'Cod Área + Celular','id'=>'celular'));				
			echo $this->Form->input('vehiculo', array('label'=>false, 'placeholder'=>'Vehículo','id'=>'vehiculo'));
			echo $this->Form->input('cuotas_pagas', array('label'=>false, 'placeholder'=>'Cuotas pagas','id'=>'cuotas_pagas'));
			echo $this->Form->input('mensaje',array('label'=>false, 'type'=>'textarea','placeholder'=>'Mensaje','style'=>'width:505px;','id'=>'mensaje'));
			echo $this->Form->input('tipo', array('label'=>false, 'type'=>'hidden', 'value'=>'Venta','id'=>'tipo','id'=>'tipo'));
			echo $this->Form->end(__('Consultar')); 
		echo '</div>';
		echo '<div class="preloader-ajax-contacto" style="margin:130px auto"></div>';
		?>		
	</div>
	
	<div class="pasos">
		<h3>Vendé tu plan en tan solo <span class="negrita">3 pasos</span></h3>
		<div class="box">
			<div class="nro">1</div>
			<div class="texto">
				<div class="titulo">Envíanos los datos de Tu Plan Ya actual</div>
				<div class="descripcion">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
			</div>
		</div>		
		<div class="box">
			<div class="nro">2</div>
			<div class="texto">
				<div class="titulo">Contanos qué buscás</div>
				<div class="descripcion">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
			</div>
		</div>		
		<div class="box">
			<div class="nro">3</div>
			<div class="texto">
				<div class="titulo">Te canjeamos TuPlanYa!</div>
				<div class="descripcion">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
			</div>
		</div>		
	</div>
	<div class="clear"></div>
	<?php echo $this->element('banner-grande')?>
</div>
<div class="clear"></div>

<div class="preguntas-frecuentes"></div>

