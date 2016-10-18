<?php
$script = "
<script>
function show_form_busqueda_avanzada(){
	
	//$('.flechita-boton').addClass('abierto');
	$('.container-busqueda-avanzada').animate({
		'height':'190px',
		'width' : '100%'
	});
	/*$('.boton-plan-a-medida').animate({
		'top':'207px'
	});*/
	
	$('.link.boton').html('".$this->Html->link('Búsqueda avanzada<span class=\"flechita-boton abierto\"></span>','javascript:void(0)',array('class'=>'texto-busqueda-avanzada','onclick'=>'hide_form_busqueda_avanzada()','escape'=>false))."');
	$('.top-lista .container-busqueda-avanzada').css('margin-bottom','0px')

}

function hide_form_busqueda_avanzada(){
	//$('.flechita-boton').addClass('remove');
	$('.container-busqueda-avanzada').animate({
		'height':'42px',
		'width' : '203px'
	});
	/*$('.boton-plan-a-medida').animate({
		'top':'0px'
	});*/
	
	$('.link.boton').html('".$this->Html->link('Búsqueda avanzada<span class=\"flechita-boton\"></span>','javascript:void(0)',array('class'=>'texto-busqueda-avanzada','onclick'=>'show_form_busqueda_avanzada()','escape'=>false))."');
	$('.top-lista .container-busqueda-avanzada').css('margin-bottom','25px')


}

function cargar_modelos_por_marca(marca_id, selectedValue){
	url = '".Router::url(array('controller'=>'modelos','action'=>'cargarModelosPorMarca','control'=>false))."';
	params = {'data[Modelo][marca_id]' : marca_id}
	$.post(url, params, function(data){
		buffer_combo = '<option value=\'\' selected>Seleccionar...</option>';
		$.each(data, function(index, value){
			if(index == selectedValue){
				buffer_combo += '<option value='+index+' selected>'+value+'</option>'; 
			}else{
				buffer_combo += '<option value='+index+'>'+value+'</option>'; 
			}
		})
		$('#FiltroModeloId').html(buffer_combo);
		if (typeof selectedValue === \"undefined\"){
			$('#FiltroModeloId').trigger('onchange');				
		}
	},'json')
}
</script>";
?>

<?php 
echo $script;
//$this->Html->script($script, null, array('inline'=>false));
/*Hardcodeo el combo del precio final*/
$precios = array(
	'1000-5000' => '$1.000 - $5.000',
	'5000-100000' => '$5.000 - $10.000',
	'10000-15000' => '$10.000 - $15.000',
	'15000-20000' => '$15.000 - $20.000',
	'20000-25000' => '$20.000 - $25.000',
	'25000-30000' => '$25.000 - $30.0000',
	'30000-35000' => '$30.000 - $35.0000',
	'35000-40000' => '$35.000 - $40.0000',
	'40000-450000' => '$40.000 - $45.0000',
	'45000-500000' => '$45.000 - $50.0000',
	'50000-550000' => '$50.000 - $55.0000',
	'55000-600000' => '$55.000 - $60.0000',
	'60000-650000' => '$60.000 - $65.0000',
	'65000-700000' => '$65.000 - $70.0000',	
	'70000-750000' => '$70.000 - $75.0000',
	'75000-800000' => '$75.000 - $80.0000',	
	'80000-850000' => '$80.000 - $85.0000',	
	'85000-900000' => '$85.000 - $90.0000',	
	'90000-950000' => '$90.000 - $95.0000',	
	'95000-100000' => '$95.000 - $100.0000',	
	'100000-105000' => '$100.000 - $105.0000',
	'105000-110000' => '$105.000 - $110.0000',	
	'110000-115000' => '$110.000 - $115.0000',	
	'115000-120000' => '$115.000 - $120.0000',	
	'120000-125000' => '$120.000 - $125.0000',	
	'125000-130000' => '$125.000 - $130.0000',	
	'130000-135000' => '$130.000 - $135.0000',	
	'135000-140000' => '$135.000 - $140.0000',	
	'140000-145000' => '$140.000 - $145.0000',	
	'145000-150000' => '$145.000 - $150.0000'		
);
/*Guardo en una variable los filtros de la Session*/
?>
<div class="container-busqueda-avanzada" style="">	
	<?php
	echo '<div class="boton-busqueda-avanzada">';
		echo '<div class="imagen lupa"></div>';
		echo '<div class="link boton">';
			echo $this->Html->link('Búsqueda avanzada<span class="flechita-boton"></span>','javascript:void(0)',array('class'=>'texto-busqueda-avanzada','onclick'=>'show_form_busqueda_avanzada()','escape'=>false));
		echo '</div>';
	echo '</div>';
	echo $this->Form->create('Filtro',array('url'=>array('controller'=>'planes','action'=>'busqueda')));
		echo '<table>';
			echo '<tr>';
				echo '<td class="texto">Precio Final</td><td>'.$this->Form->input('precioPlan',array('label'=>false,'div'=>false,'options'=>$precios,'empty'=>'Seleccionar...','value'=>(!empty($this->request->data['Filtro']['precioPlan']) ? $this->request->data['Filtro']['precioPlan'] : (!empty($filtroSession['Filtro']['Plan.precioPlan']) ? $filtroSession['Filtro']['Plan.precioPlan'] : '')))).'</td>';
				echo '<td width="20"></td>';
				if (!isset($tipos)){$tipos="";}
				echo '<td class="texto">Tipo de Plan</td><td>'.$this->Form->input('tipo',array('options'=>$tipos,'label'=>false,'div'=>false,'empty'=>'Seleccionar...','value'=>(!empty($this->request->data['Filtro']['tipo']) ? $this->request->data['Filtro']['tipo'] : (!empty($filtroSession['Filtro']['Plan.tipo']) ? $filtroSession['Filtro']['Plan.tipo'] : '')))).'</td>';
				echo '</tr>';		
			echo '<tr><td height="10"></td></tr>';
			echo '<tr>';
				if (!isset($marcas)){$marcas="";}
				echo '<td class="texto">Marca</td><td>'.$this->Form->input('marca_id',array('options'=>$marcas,'onchange'=>'cargar_modelos_por_marca(this.value)','empty'=>'Seleccionar...','label'=>false,'div'=>false,'value'=>(!empty($this->request->data['Filtro']['marca_id']) ? $this->request->data['Filtro']['marca_id'] : (!empty($filtroSession['Filtro']['Modelo.marca_id']) ? $filtroSession['Filtro']['Modelo.marca_id'] : '')))).'</td>';
				echo '<td width="20"></td>';
				if (!isset($modelos)){$modelos="";}
				echo '<td class="texto">Modelo</td><td>'.$this->Form->input('modelo_id',array('options'=>$modelos,'empty'=>'Seleccionar...','label'=>false,'div'=>false,'value'=>(!empty($this->request->data['Filtro']['modelo_id']) ? $this->request->data['Filtro']['modelo_id'] : (!empty($filtroSession['Filtro']['Plan.modelo_id']) ? $filtroSession['Filtro']['Plan.modelo_id'] : '')))).'</td>';

			echo '</tr>';			
		echo '</table>';
		echo '
		<div class="submit">
			<input type="submit" value="Buscar">
			'.$this->Html->image('tuplanya/flechita-derecha.png',array('class'=>'flechita')).'
		</div>';
	echo $this->Form->end();
	?>
</div>