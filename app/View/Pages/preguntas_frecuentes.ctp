<?php echo $this->element('form-html5-jquery');echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp")));?>
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
	});
	
	return false;
	
	var head_offset = jQuery('.formulario-consulta').offset();
	jQuery(window).scroll(function() {
	    if(jQuery(window).scrollTop() < head_offset.top) {
	    	alert('se va');
	    } else {
	        alert('vuelve');
	    }   
	});
	
}	
</script>
<div class="pages como_funciona">		
	
		<div class="preguntas-frecuentes">
		<div class="titulo-principal"><?php echo __('Preguntas frecuentes',true);?></div>
		<div class="pregunta">
			<div class="titulo">¿Qué es TuPlanYa?</div>
			<p>TuPlanYA es la compañía que nace en Argentina con la misión de conseguir el auto que necesitás, financiado mediante el plan de ahorro. </p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿TuplanYa opera con transparencia y profesionalismo?</div>
			<p>Si. Somos un equipo de profesionales jóvenes con 20 años de experiencia en la <b>industria automotriz</b>, y, en el <b>mercado de la tecnología</b>.  Estamos capacitados para ofrecer lo que estás buscando, acompañando cada paso de la operación con la recomendación necesaria según tu necesidad.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿TuPlanya es una nueva forma de conseguir un auto en la web?</div>
			<p>TuPlanYa  es  la plataforma tecnológica de búsqueda ideal para darte acceso a la oferta automotriz de planes de ahorro, más completa del mercado.  Son nuestros especialistas online quienes personalizan tu necesidad y ayudan a concretar la operación que quieras realizar.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Qué es un Plan de Ahorro de TuPlanYa?</div>
			<p>Es una excelente alternativa que ofrecemos para la adquisición de una variada gama de vehículos, mediante un sistema de Ahorro previo en "Pesos" que consiste en un grupo de personas que ahorran para un fin determinado: alcanzar su 0 Km. Mensualmente cada integrante del grupo abona su cuota, con el fin de formar un fondo para adjudicar unidades del modelo suscripto. Dichas unidades se adjudican mensualmente, en función de los fondos disponibles, ya sea por Sorteo o Licitación.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Cuáles son sus ventajas?</div>
			<p>Tiene la cuota mas baja del mercado. No tiene requisitos de ingreso. No requiere anticipos ni refuerzos. Las cuotas son en PESOS. No tiene intereses bancarios.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Qué es un plan comenzado?</div>
			<p>Estos planes ya tienen cuotas pagas, por lo cual se reduce el plazo del plan y resultan una excelente oportunidad. En TuPlanYa tenemos excelentes ofertas donde ahorraras dinero en la compra de tu nuevo 0KM.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Qué es un plan adjudicado?</div>
			<p>En este tipo de planes podes pedir la unidad inmediatamente, no es necesario esperar al sorteo ni licitar.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Cómo son los Tipos de Entrega?</div>
			<p>Por Licitación: Todos los meses, los integrantes del grupo podrán “licitar” por un auto, es decir, hacer una oferta monetaria para adjudicarse un vehículo. La mejor oferta gana la adjudicación y el dinero ofertado se aplica a la cancelación de la últimas cuotas o bién a cancelar un porcentaje de todas las cuotas a vencer. 

Por Sorteo: Mensualmente se realiza un sorteo con los integrantes del grupo para adjudicarle un vehículo. A medida que pasan los meses, la probabilidad de salir sorteado aumenta, ya que son menos los integrantes remanentes del grupo. 

Por entrega asegurada: Cada marca tiene distintos plazos de entrega entre la cuota 7 y la cuota 12. Que se harán efectivos de no adjudicar de la unidad por sorteo o licitación.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Cómo se forman los grupos?</div>
			<p>Todas las personas que se suscriben a un plan de ahorro se agrupan en conjuntos cerrados cuyo tamaño es el doble de la cantidad de cuotas del plan suscripto. Por ejemplo si el plan es de 84 cuotas, cada grupo va a estar integrado por 168 personas. Cada mes se entregan dos autos: uno por sorteo y otro por licitación, por lo que es importante que el grupo esté completo. Generalmente los planes se componen de 50, 60 u 84 cuotas.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Hay reglamentación para los Planes de Ahorro en Argentina?</div>
			<p>Existe un resguardo legal que asegura el cumplimiento de las pautas establecidas, es por ello que el sistema fue aprobado y se somete a la fiscalización permanente del control estatal.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Porqué elegir operar con TuPlanYa?</div>
			<p>TuPlanYa ofrece en sólo 3 pasos aquello que estás buscando: sea compra, venta o canje de planes de ahorro, de cualquier marca. Porque tenemos la mejor capacidad en esta industria para conseguir ese auto que estás buscando, al precio que lo podés pagar.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Cómo me suscribo a TuPlanYa, o cómo compro un plan de ahorro?</div>
			<p>Ingresando a <a href="www.tuplanya.com">www.tuplanya.com</a> verás las opciones para comprar un plan de ahorro. Necesitás llenar un breve formulario con 5 datos para que en menos de 24 horas nuestra red de profesionales online se comunique telefónicamente con vos.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿TuPlanYa me permite conseguir un plan de ahorro de cualquier marca de la industria?</div>
			<p>Si. Podés comprar, vender o canjear planes de ahorro en sólo 3 pasos de cualquier marca automotriz.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Qué conceptos componen la cuota mensual que debo abonar? </div>
			<p>Los conceptos que componen tu cuota son: 
CUOTA PURA (es el resultante de dividir en 84 el valor básico de la unidad) + ARANCEL ADMINISTRATIVO + DERECHO DE SUSCRIPCIÓN PRORRATEADO + SELLADO FISCAL PRORRATEADO (en caso de corresponder según juridicción) + SEGURO DE VIDA. Cuando retirás la unidad además de los conceptos mencionados se agrega: SEGURO DE BIEN TIPO.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Cómo se ajustan las cuotas del Plan de Ahorro?</div>
			<p>Las cuotas se ajustan (en caso de corresponder) según variación de precios vigente a la fecha de pago. En caso de producirse una baja en el precio, tu cuota bajará proporcionalmente. En caso de producirse un aumento en el precio tu cuota aumentará proporcionalmente. Los aumentos no afectan a las cuotas ya abonadas.</p>
		</div>
		<div class="pregunta">
			<div class="titulo">¿Cómo me entero cuando debo abonar mis cuotas?</div>
			<p>Recibirás en tu domicilio o lugar que hayas colocado en la solicitud de adhesión el aviso de vencimiento los primeros días de cada mes.</p>
		</div>
		<div class="hace-tu-pregunta"><?php echo $this->Html->link(__('¿No encontraste tu consulta? Hacé tu pregunta y dejanos tus datos',true),array('controller'=>'pages','action'=>'contacto'),array('escape'=>false));?><span class="ver-mas"></span></div>
	</div>
	
	<div class="formulario-consulta">		
		
		<?php 
		echo $this->Form->create('contacto',array('onsubmit'=>'enviar_consulta();return false;','id'=>'FormContacto'));
		echo '<h3>'.__('¿No encontraste tu consulta?',true).'</h3>';
		echo '<div class="mensaje-contacto venta"></div>';
		echo '<div class="fields-container">';
			echo $this->Form->input('nombre', array('label'=>false, 'placeholder'=>'Apellido y nombre *', 'required'=>true,'id'=>'nombre_apellido'));		
			echo $this->Form->input('email', array('label'=>false, 'type'=>'email', 'placeholder'=>'Email *', 'required'=>true,'id'=>'email'));
			echo $this->Form->input('telefono', array('label'=>false, 'placeholder'=>'Cod Área + Teléfono *', 'required'=>true,'id'=>'telefono') );
			echo $this->Form->input('celular', array('label'=>false, 'placeholder'=>'Cod Área + Celular','id'=>'celular'));				
			echo $this->Form->input('vehiculo', array('label'=>false, 'placeholder'=>'Vehículo','id'=>'vehiculo'));
			echo $this->Form->input('cuotas_pagas', array('label'=>false, 'placeholder'=>'Cuotas pagas','id'=>'cuotas_pagas'));
			echo $this->Form->input('comentarios',array('label'=>false, 'type'=>'textarea','placeholder'=>'Comentarios','style'=>'width:505px;','id'=>'comentarios'));
			echo $this->Form->input('tipo', array('label'=>false, 'type'=>'hidden', 'value'=>'Preguntas Frecuentes','id'=>'tipo','id'=>'tipo'));
			echo $this->Form->end(__('Consultar')); 
		echo '</div>';
		echo '<div class="preloader-ajax-contacto" style="margin:130px auto"></div>';
		echo '<div id="response"></div>';
		?>		
	</div>

	
	<div class="clear"></div>	
</div>
