<?php //debug($filters);?>
<script>
$(document).ready(function(){
	$(".datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
	/*Traduccion al espa?ol*/
	    jQuery(function($){
	        $.datepicker.regional['es'] = {
	            closeText: 'Cerrar',
	            prevText: '&#x3c;Ant',
	            nextText: 'Sig&#x3e;',
	            currentText: 'Hoy',
	            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
	            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
	            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
	            'Jul','Ago','Sep','Oct','Nov','Dic'],
	            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
	            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
	            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
	            weekHeader: 'Sm',
	            dateFormat: 'dd/mm/yy',
	            firstDay: 1,
	            isRTL: false,
	            showMonthAfterYear: false,
	            yearSuffix: ''};
	        $.datepicker.setDefaults($.datepicker.regional['es']);
	    });
	    /*Le asignas la traduccion al DP*/
	    $('#datepicker').datepicker($.datepicker.regional['es']);
})

function toggle() {
	var ele = document.getElementById("filter");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    	ele.style.display = "none";
		text.innerHTML = "Mostrar filtros";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Ocultar filtros";
	}
}
</script>
<?php
    if (isset($this->request->params['named']['filter'])) {
        $this->Html->scriptBlock('var filter = 1;', array('inline' => false));
    }
?>

<div class="filter"><a id="displayText" href="javascript:toggle();">Mostrar filtros</a>
<div id="filter" style="display: none">
<?php
    echo $this->Form->create('Filter', array('url'=>array('controller'=>'planes', 'action'=>'control_index')));
?>
	
<!--<div style="float:left; padding-right:20px">
<?php

    $filterDenom = '';
    if (isset($filters['fecha_inicio'])) {
		$filterDenom = $filters['fecha_inicio'];
    }
    echo $this->Form->input('Filter.fecha_inicio', array(
    	'label'=>__('Fecha Inicio', true), 
		'value'=>$filterDenom,
		'class'=>'datepicker'		
    ));
	
	$filterDenom = '';
    if (isset($filters['fecha_final'])) {
		$filterDenom = $filters['fecha_final'];
    }
    echo $this->Form->input('Filter.fecha_final', array(
    	'label'=>__('Fecha Final', true), 
		'value'=>$filterDenom,
		'class'=>'datepicker'		
    ));
    
?>
</div>	-->
	
<div style="float:left; padding-right:20px">
<?php

    $filterDenom = '';
    if (isset($filters['denominacion'])) {
		$filterDenom = $filters['denominacion'];
    }
    echo $this->Form->input('Filter.denominacion', array(
    	'label'=>__('Denominacion', true), 
		'value'=>(!empty($url_conditions['Filter.denominacion']) ? $url_conditions['Filter.denominacion']: ''),
		'size'=>'34'
    ));
    
?>
<?php

    $filterDenom = '';
    if (isset($filters['plantipo_id'])) {
		$filterDenom = $filters['plantipo_id'];
    }
    echo $this->Form->input('Filter.plantipo_id', array(
    	'label'=>__('Plan Tipo', true), 
		'value'=>(!empty($url_conditions['Filter.plantipo_id']) ? $url_conditions['Filter.plantipo_id']: ''),
		'options'=>$planestipos,		
		'empty'=>'Seleccione'
    ));
    
?>
</div>

	<div style="float:left; padding-right:20px">

<?php

    $filterDenom = '';
    if (isset($filters['estado'])) {
		$filterDenom = $filters['estado'];
    }
    echo $this->Form->input('Filter.estado', array(
    	'label'=>__('Estado', true), 
		'value'=>(!empty($url_conditions['Filter.estado']) ? $url_conditions['Filter.estado']: ''),
		'options'=>$estados,		
		'empty'=>'Seleccione'
    ));
    
?>

<?php
	$filterDenom = '';
    if (isset($filters['tipo'])) {
		$filterDenom = $filters['tipo'];
    }
    echo $this->Form->input('Filter.tipo', array(
    	'label'=>__('Tipo', true), 
		'value'=>(!empty($url_conditions['Filter.tipo']) ? $url_conditions['Filter.tipo']: ''),
		'options'=>$tipos,		
		'empty'=>'Seleccione'
    ));
?>
	
</div>

<div style="float:left; padding-right:20px">

<?php

    $filterDenom = '';
    if (isset($filters['modelo_id'])) {
		$filterDenom = $filters['modelo_id'];
    }
    echo $this->Form->input('Filter.modelo_id', array(
    	'label'=>__('Modelo', true), 
		'value'=>(!empty($url_conditions['Filter.modelo_id']) ? $url_conditions['Filter.modelo_id']: ''),
		'id'=>'comboModelos',
		'empty'=>'Seleccione'
    ));
    
?>

</div>
	
<div class="clear"></div>
<?php
	//echo $form->submit('Limpiar filtro', array('style'=>'float:left;width:150px'));
	echo $this->Form->submit('Filtrar', array('style'=>'float:left;width:100px'));
	
	echo $this->Form->hidden('limpiar',array('value' => 'false','id' => 'limpiarFiltro'));
	echo $this->Form->submit('Limpiar filtros',array('type'=>'submit','action' => 'limpiar','onClick' => 'document.getElementById(\'limpiarFiltro\').value = true'));
?>
	<div class="clear"></div>
<?php
    echo $this->Form->end();?>
</div>
</div>