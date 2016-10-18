<?php //debug($filters);?>
<script>
$(document).ready(function(){
	$(".datepicker" ).datepicker({dateFormat: "dd-mm-yy"});
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
    echo $this->Form->create('Filter', array('url'=>array('controller'=>'contactos', 'action'=>'control_index')));
?>
	
<div style="float:left; padding-right:20px">
<?php

    $filterDenom = '';
    if (isset($filters['fecha_desde'])) {
		$filterDenom = $filters['fecha_desde'];
    }
    echo $this->Form->input('Filter.fecha_desde', array(
    	'label'=>__('Fecha Desde', true), 
		'value'=>(!empty($url_conditions['Filter.fecha_desde']) ? $url_conditions['Filter.fecha_desde']: ''),
		'class'=>'datepicker',
		'size'=>'34'
    ));
    
?>
<?php

    $filterDenom = '';
    if (isset($filters['fecha_hasta'])) {
		$filterDenom = $filters['fecha_hasta'];
    }
    echo $this->Form->input('Filter.fecha_hasta', array(
    	'label'=>__('Fecha Hasta', true), 
		'value'=>(!empty($url_conditions['Filter.fecha_hasta']) ? $url_conditions['Filter.fecha_hasta']: ''),
		'class'=>'datepicker',
		'size'=>'34'
    ));
    
?>
</div>	

<div style="float:left; padding-right:20px">
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