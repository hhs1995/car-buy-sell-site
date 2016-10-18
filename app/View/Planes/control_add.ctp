<?php echo $this->Html->script(array('tiny_mce/tiny_mce'));?>
<?php echo $this->Html->css(array('fixed'));?>
<script language="javascript">
	$(document).ready(function(){
		<?php if(!empty($this->request->data['Plan']['marca_id'])){?>
				cargar_modelos_por_marca(<?php echo $this->request->data['Plan']['marca_id'];?>,<?php echo $this->request->data['Plan']['modelo_id'];?>);
		<?php } ?>
		
		$('.radio').click(function(){
			if($(this).attr('id') == 'reservado'){
				$('#vendido').attr('checked',false);
			}else{
				$('#reservado').attr('checked',false);
			}
		});
		
		$('#PlanDenominacion').keyup(function(){
			$('.denominacion').html($(this).val());
		})
		
	});
	
	tinyMCE.init({
		
		setup : function(ed) {
		  ed.onKeyUp.add(function(ed, e) {
			  var texto = ed.getContent();			  
			  $('.descripcion').html(texto);
		  });
	   },
		
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",/*imagemanager,filemanager,*/

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline",
		theme_advanced_buttons2 : "link,unlink|,forecolor",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/example.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "/js/template_list.js",
		external_link_list_url : "/js/link_list.js",
		external_image_list_url : "/js/image_list.js",
		media_external_list_url : "/js/media_list.js",
		invalid_elements : "div",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		},

	    
	});
	
	function cargar_modelos_por_marca(marca_id, selectedValue){
		url = '<?php echo Router::url(array('controller'=>'modelos','action'=>'cargarModelosPorMarca','control'=>false));?>';
		params = {'data[Modelo][marca_id]' : marca_id}
		$.post(url, params, function(data){
			buffer_combo = '';
			$.each(data, function(index, value){
				if(index == selectedValue){
					buffer_combo += '<option value='+index+' selected>'+value+'</option>'; 
				}else{
					buffer_combo += '<option value='+index+'>'+value+'</option>'; 
				}
			})
			$('#PlanModeloId').html(buffer_combo);
			if (typeof selectedValue === "undefined"){
				$('#PlanModeloId').trigger('onchange');				
			}
		},'json')
	}
	
</script>

<div class="planes form">
<?php echo $this->Form->create('Plan'); ?>
	<fieldset>
		<legend><?php echo __('Control Agregar Plan'); ?></legend>
	<?php
		echo '<table>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('denominacion',array('size'=>100));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
				
		echo '<tr class="rows">';
			echo '<td colspan="1" class="cell cell_1">';
				echo '<label for="PlaneVolanta">Volanta</label>';
				echo $this->Form->textarea('volanta',array('style'=>'width:530px;'));
				echo '&nbsp;';
			echo '</td>';
			echo '<td colspan="1" class="cell cell_1">';
				//echo '<label for="PlaneVolanta">Vista Previa</label>';					
				echo '<div class="listado-planes">';
					echo '<div class="item" style="background-image:url("");">';
						/*echo ($this->request->data['Plan']['vendido'] == 1 ? $this->Html->image('tuplanya/vendido.png',array('class'=>'vendido')) : '');							
						echo ($this->request->data['Plan']['reservado'] == 1 ? $this->Html->image('tuplanya/reservado.png',array('class'=>'reservado')) : '');*/
						echo '<h2>'.$this->Html->link('<span class="denominacion"></span>', 'javascript:void(0)',array('onclick'=>'return false;','escape'=>false)).'</h2>';
						//echo '<div class="volanta">'.strip_tags($this->request->data['Plantipo']['denominacion'],'<strong><span><em>').'</div>';
						echo '<p class="descripcion"></p>';
						echo '<div class="pie">';
							/*if($this->request->data['Plan']['tipo'] != 'Nuevo'){ 
								echo '<div class="cuotas-pagas">'.$this->request->data['Plan']['cuotasPagas'].'/'.$this->request->data['Plan']['cuotasCantidad'].'</div>';
								echo '<div class="cuotas-cantidad">'.__('Cuotas Pagas',true).'</div>';
							}*/
							echo '<div class="precio"></div>';
							echo '<div class="cuota-pura"></div>';
						echo '</div>';						
				echo '</div>';
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('marca_id',array('options'=>$marcas,'empty'=>'Seleccione','onchange'=>'cargar_modelos_por_marca(this.value)'));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('modelo_id',array('empty'=>'Seleccione'));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('descripcion',array('style'=>'width:530px;'));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('tags',array('type'=>'text','size'=>100));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';				
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('precioPlan',array('label'=>'Precio Plan'));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('cuotaPura');
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';				
				echo $this->Form->input('cuotasCantidad',array('label'=>'Cantidad de Cuotas'));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';				
				echo $this->Form->input('cuotasPagas',array('label'=>'Cuotas Pagas'));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';				
				echo $this->Form->input('estado',array('options'=>array('Borrador'=>'Borrador')));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';				
				echo $this->Form->input('tipo',array('options'=>$tipos,'empty'=>'Seleccione'));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('plantipo_id',array('options'=>$plantipo,'empty'=>'Seleccione'));
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('reservado',array('class'=>'radio','id'=>'reservado'));
				echo $this->Form->input('vendido',array('class'=>'vendido radio','id'=>'vendido'));
				//echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '<tr class="rows">';
			echo '<td colspan="2" class="cell cell_1">';
				echo $this->Form->input('destacado');
				echo '&nbsp;';
			echo '</td>';
		echo '</tr>';
		
		echo '</table>';
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Planesnuevos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('controller' => 'versiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versiones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cuotas'), array('controller' => 'cuotas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cuota'), array('controller' => 'cuotas', 'action' => 'add')); ?> </li>
	</ul>
</div>
