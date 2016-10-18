<div class="versiones form">
<?php echo $this->Form->create('Version'); ?>
	<fieldset>
		<legend><?php echo __('Edit Version'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('denominacion');
		echo $this->Form->input('slug');
		echo $this->Form->input('modelo_id');
		echo $this->Form->input('deleted');
		echo $this->Form->input('segmento_id');
		echo $this->Form->input('transmision');
		echo $this->Form->input('combustible');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
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
