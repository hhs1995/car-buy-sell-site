<div class="planesusados index">
	<h2><?php echo __('Planesusados'); ?></h2>
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
			<th><?php echo $this->Paginator->sort('estado'); ?></th>
			<th><?php echo $this->Paginator->sort('tipo'); ?></th>
			<th><?php echo $this->Paginator->sort('precioPlan'); ?></th>
			<th><?php echo $this->Paginator->sort('cuotaFinal'); ?></th>
			<th><?php echo $this->Paginator->sort('cuotaPura'); ?></th>
			<th><?php echo $this->Paginator->sort('cuotasCantidad'); ?></th>
			<th><?php echo $this->Paginator->sort('cuotasPagas'); ?></th>
			<th><?php echo $this->Paginator->sort('version_id'); ?></th>
			<th><?php echo $this->Paginator->sort('plantipo_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($planesusados as $planesusado): ?>
	<tr>
		<td><?php echo h($planesusado['Planesusado']['id']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['denominacion']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['slug']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['volanta']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['created']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($planesusado['Modelo']['denominacion'], array('controller' => 'modelos', 'action' => 'view', $planesusado['Modelo']['id'])); ?>
		</td>
		<td><?php echo h($planesusado['Planesusado']['descripcion']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['tags']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['precio0km']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['estado']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['tipo']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['precioPlan']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['cuotaFinal']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['cuotaPura']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['cuotasCantidad']); ?>&nbsp;</td>
		<td><?php echo h($planesusado['Planesusado']['cuotasPagas']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($planesusado['Version']['denominacion'], array('controller' => 'versiones', 'action' => 'view', $planesusado['Version']['id'])); ?>
		</td>
		<td><?php echo h($planesusado['Planesusado']['plantipo_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $planesusado['Planesusado']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $planesusado['Planesusado']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $planesusado['Planesusado']['id']), null, __('Are you sure you want to delete # %s?', $planesusado['Planesusado']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Planesusado'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('controller' => 'versiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versiones', 'action' => 'add')); ?> </li>
	</ul>
</div>
