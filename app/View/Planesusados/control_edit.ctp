<div class="planesusados form">
<?php echo $this->Form->create('Planesusado'); ?>
	<fieldset>
		<legend><?php echo __('Control Edit Planesusado'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('denominacion');
		echo $this->Form->input('slug');
		echo $this->Form->input('volanta');
		echo $this->Form->input('modelo_id');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('tags');
		echo $this->Form->input('precio0km');
		echo $this->Form->input('estado');
		echo $this->Form->input('tipo');
		echo $this->Form->input('precioPlan');
		echo $this->Form->input('cuotaFinal');
		echo $this->Form->input('cuotaPura');
		echo $this->Form->input('cuotasCantidad');
		echo $this->Form->input('cuotasPagas');
		echo $this->Form->input('version_id');
		echo $this->Form->input('plantipo_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Planesusado.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Planesusado.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Planesusados'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('controller' => 'versiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versiones', 'action' => 'add')); ?> </li>
	</ul>
</div>
