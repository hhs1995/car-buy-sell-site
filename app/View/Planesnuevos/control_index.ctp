<div class="planesnuevos index">
	<h2><?php echo __('Planesnuevos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('denominacion'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('volanta'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('modelo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('descripcion'); ?></th>
			<th><?php echo $this->Paginator->sort('tags'); ?></th>
			<th><?php echo $this->Paginator->sort('precio0km'); ?></th>
			<th><?php echo $this->Paginator->sort('cuotaPura'); ?></th>
			<th><?php echo $this->Paginator->sort('estado'); ?></th>
			<th><?php echo $this->Paginator->sort('version_id'); ?></th>
			<th><?php echo $this->Paginator->sort('plantipo_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($planesnuevos as $planesnuevo): ?>
	<tr>
		<td><?php echo h($planesnuevo['Planesnuevo']['id']); ?>&nbsp;</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['denominacion']); ?>&nbsp;</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['slug']); ?>&nbsp;</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['volanta']); ?>&nbsp;</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['created']); ?>&nbsp;</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($planesnuevo['Modelo']['denominacion'], array('controller' => 'modelos', 'action' => 'view', $planesnuevo['Modelo']['id'])); ?>
		</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['descripcion']); ?>&nbsp;</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['tags']); ?>&nbsp;</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['precio0km']); ?>&nbsp;</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['cuotaPura']); ?>&nbsp;</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['estado']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($planesnuevo['Version']['denominacion'], array('controller' => 'versiones', 'action' => 'view', $planesnuevo['Version']['id'])); ?>
		</td>
		<td><?php echo h($planesnuevo['Planesnuevo']['plantipo_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $planesnuevo['Planesnuevo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $planesnuevo['Planesnuevo']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $planesnuevo['Planesnuevo']['id']), null, __('Are you sure you want to delete # %s?', $planesnuevo['Planesnuevo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Planesnuevo'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('controller' => 'versiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versiones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cuotas'), array('controller' => 'cuotas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cuota'), array('controller' => 'cuotas', 'action' => 'add')); ?> </li>
	</ul>
</div>
