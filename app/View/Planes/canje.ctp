<?php echo $this->element('form-html5-jquery');
echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp")));?>
<script>
function enviar_consulta(){
	
	$('#response').hide();
	$('.fields-container').hide();
	$('.preloader-ajax-contacto').show();
	
	var nombre_apellido = $('#nombre_apellido').val();
	var email = $('#email').val();
	var telefono = $('#telefono').val();
	var celular = $('#celular').val();
	var vehiculo = $('#vehiculo').val();
	var cuotas_pagas = $('#cuotas_pagas').val();
	var comentarios = $('#comentarios').val();
	var tipo = $('#tipo').val();
	
	url = '<?php echo Router::url(array('controller'=>'planes','action'=>'enviar_consulta'));?>';
	params = {
		'data[Contacto][nombre_apellido]' : nombre_apellido,
		'data[Contacto][email]' : email,
		'data[Contacto][telefono]' : telefono,
		'data[Contacto][celular]' : celular,
		'data[Contacto][vehiculo]' : vehiculo,
		'data[Contacto][cuotas_pagas]' : cuotas_pagas,
		'data[Contacto][comentarios]' : comentarios,		
		'data[Contacto][tipo]' : tipo,
	}
	$.post(url, params, function(data){
		$('.preloader-ajax-contacto').hide();
		$('.mensaje-contacto').html(data);
		$('.mensaje-contacto').show();
		$('#conversion-code').html('<iframe style="display: none;" src="<?php echo $this->Html->url(array('controller'=>'app','action'=>'conversion','canje')); ?>"/>');
	});
	
	return false;
	
	
}	
</script>
<div class="planes canje">
	<div class="banner-central"><?php echo $this->Html->image('tuplanya/banner-canjea.png');?></div>
		
	<div class="pasos">
		<h3>Canjeá tu plan en tan solo <span class="negrita">3 pasos</span></h3>
		<div class="box">
			<div class="nro">1</div>
			<div class="texto">
				<div class="titulo">Envianos los datos de tu plan de ahorro actual:</div>
				<div class="descripcion">Necesitamos los siguientes datos: datos del grupo, modelo del auto, tipo de plan (70/30, 100%) , la cantidad de cuotas pagas, y su estado (al día/ adjudicado/ moroso).</div>
			</div>
		</div>		
		<div class="box">
			<div class="nro">2</div>
			<div class="texto">
				<div class="titulo">Contanos qué tipo de canje estás buscando:</div>
				<div class="descripcion">Necesitás canjear por la cuota, por otro modelo de la misma marca, por otra marca o por uno adjudicado?</div>
			</div>
		</div>		
		<div class="box">
			<div class="nro">3</div>
			<div class="texto">
				<div class="titulo">Te canjeamos TuPlanYa!</div>
				<div class="descripcion">De acuerdo a la información que nos envíes, relacionada al tipo de canje que estás necesitando, el equipo de
TuPlanYa se contactará para brindarte varias opciones de canje para que puedas obtener TuPlanYa.</div>
			</div>
		</div>		
	</div>
	
	<div class="formulario-consulta">		
		<?php 
		echo $this->Form->create('contacto',array('onsubmit'=>'enviar_consulta();return false;','id'=>'FormContacto'));
		echo '<div class="mensaje-contacto venta"></div>';
		echo '<div class="fields-container">';
			echo $this->Form->input('nombre', array('label'=>false, 'placeholder'=>'Apellido y nombre *', 'required'=>true,'id'=>'nombre_apellido'));		
			echo $this->Form->input('email', array('label'=>false, 'type'=>'email', 'placeholder'=>'Email *', 'required'=>true,'id'=>'email'));
			echo $this->Form->input('telefono', array('label'=>false, 'placeholder'=>'Cod Área + Teléfono *', 'required'=>true,'id'=>'telefono') );
			echo $this->Form->input('celular', array('label'=>false, 'placeholder'=>'Cod Área + Celular','id'=>'celular'));				
			echo $this->Form->input('vehiculo', array('label'=>false, 'placeholder'=>'Vehículo','id'=>'vehiculo'));
			echo $this->Form->input('cuotas_pagas', array('label'=>false, 'placeholder'=>'Cuotas pagas','id'=>'cuotas_pagas'));
			echo $this->Form->input('comentarios',array('label'=>false, 'type'=>'textarea','placeholder'=>'Comentarios','id'=>'comentarios'));
			echo $this->Form->input('tipo', array('label'=>false, 'type'=>'hidden', 'value'=>'Canje','id'=>'tipo','id'=>'tipo'));
			echo $this->Form->end(__('Consultar')); 
		echo '</div>';
		echo '<div class="preloader-ajax-contacto" style="margin:130px auto"></div>';
		echo '<div id="response"></div>';
		?>
	</div>
	
	<div class="clear"></div>
</div>
<div class="clear"></div>

<div id="conversion-code"></div>