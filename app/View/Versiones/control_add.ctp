<div class="versiones form">
<?php echo $this->Form->create('Version'); ?>
	<fieldset>
		<legend><?php echo __('Control Agregar Version'); ?></legend>		
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

		<li><?php echo $this->Html->link(__('List Versiones'), array('action' => 'index')); ?></li>
	</ul>
</div>
