<div class="versiones index">
	<h2><?php echo __('Versiones'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('denominacion'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('modelo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted'); ?></th>
			<th><?php echo $this->Paginator->sort('segmento_id'); ?></th>
			<th><?php echo $this->Paginator->sort('transmision'); ?></th>
			<th><?php echo $this->Paginator->sort('combustible'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($versiones as $version): ?>
	<tr>
		<td><?php echo h($version['Version']['id']); ?>&nbsp;</td>
		<td><?php echo h($version['Version']['denominacion']); ?>&nbsp;</td>
		<td><?php echo h($version['Version']['slug']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($version['Modelo']['denominacion'], array('controller' => 'modelos', 'action' => 'view', $version['Modelo']['id'])); ?>
		</td>
		<td><?php echo h($version['Version']['created']); ?>&nbsp;</td>
		<td><?php echo h($version['Version']['modified']); ?>&nbsp;</td>
		<td><?php echo h($version['Version']['deleted']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($version['Segmento']['denominacion'], array('controller' => 'segmentos', 'action' => 'view', $version['Segmento']['id'])); ?>
		</td>
		<td><?php echo h($version['Version']['transmision']); ?>&nbsp;</td>
		<td><?php echo h($version['Version']['combustible']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $version['Version']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $version['Version']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $version['Version']['id']), null, __('Are you sure you want to delete # %s?', $version['Version']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Version'), array('action' => 'add')); ?></li>
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
