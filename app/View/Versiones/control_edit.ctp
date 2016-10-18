<div class="versiones form">
<?php echo $this->Form->create('Version'); ?>
	<fieldset>
		<legend><?php echo __('Control Edit Version'); ?></legend>
	<?php
		echo '<table>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('denominacion',array('size'=>100));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('modelo_id');
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('segmento_id');
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('transmision');
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('combustible');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Version.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Version.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Segmentos'), array('controller' => 'segmentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Segmento'), array('controller' => 'segmentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planesnuevos'), array('controller' => 'planesnuevos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planesnuevo'), array('controller' => 'planesnuevos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planesusados'), array('controller' => 'planesusados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planesusado'), array('controller' => 'planesusados', 'action' => 'add')); ?> </li>
	</ul>
</div>
