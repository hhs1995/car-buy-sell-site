<script>
	$(document).ready(function(){
		$('.tabs').tabs("option", "disabled",[1,2]);		
	})
</script>
<div class="modelos form">
<?php echo $this->Form->create('Modelo',array('type'=>'file')); ?>
	
	<fieldset>
		<legend><?php echo __('Control Agregar Modelo'); ?></legend>
		
		 <div class="tabs">
			<ul>
				<li id="0"><a href="#link-info"><span><?php echo __('Info',true); ?></span></a></li>
			   
				<li id="1"><a href="#link-imagenes"><span><?php echo __('Imagenes',true); ?></span></a></li> 
				
				<li id="2"><a href="#link-videos"><span><?php echo __('Videos',true); ?></span></a></li>
			</ul>
	<?php
	echo '<div id="link-info">';
		echo '<table>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('denominacion',array('size'=>100));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('marca_id');		
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('segmento_id',array('options'=>$segmentos,'empty'=>'Seleccione'));		
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('precio0km');
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('link_info',array('size'=>100));		
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';		
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('imagen',array('type'=>'file'));		
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
		echo '</table>';
	echo '</div>';	
		
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Versiones'), array('action' => 'index')); ?></li>
	</ul>
</div>
