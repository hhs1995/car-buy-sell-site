<div class="planesnuevos form">
<?php echo $this->Form->create('Planesnuevo'); ?>
	<fieldset>
		<legend><?php echo __('Control Edit Planesnuevo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('denominacion');
		echo $this->Form->input('slug');
		echo $this->Form->input('volanta');
		echo $this->Form->input('modelo_id');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('tags');
		echo $this->Form->input('precio0km');
		echo $this->Form->input('cuotaPura');
		echo $this->Form->input('estado');
		echo $this->Form->input('version_id');
		echo $this->Form->input('plantipo_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Planesnuevo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Planesnuevo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Planesnuevos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('controller' => 'versiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versiones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cuotas'), array('controller' => 'cuotas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cuota'), array('controller' => 'cuotas', 'action' => 'add')); ?> </li>
	</ul>
</div>
