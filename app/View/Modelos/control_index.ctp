<div class="versiones index">
	<h2><?php echo __('Modelos'); ?></h2>
	<?php echo $this->element('admin/filtro_modelos')?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('imagen'); ?></th>
			<th><?php echo $this->Paginator->sort('denominacion'); ?></th>						
			<th><?php echo $this->Paginator->sort('marca_id'); ?></th>
			<th><?php echo $this->Paginator->sort('segmento_id'); ?></th>			
			<th><?php echo $this->Paginator->sort('precio0km', 'Precio 0km'); ?></th>			
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php
	foreach ($Modelos as $modelo): ?>
	<tr>
		<td><?php echo h($modelo['Modelo']['id']); ?>&nbsp;</td>
		<td><?php echo '<img src="'.UPLOAD_IMG_URL_MODELOS_PRINCIPAL.$modelo['Modelo']['imagen'].'" style="width:100px;">';?></td>
		<td><?php echo h($modelo['Modelo']['denominacion']); ?>&nbsp;</td>		
		<td>
			<?php echo h($modelo['Marca']['denominacion']);?>
		</td>
		<td><?php echo h($modelo['Segmento']['denominacion']); ?>&nbsp;</td>		
		<td>$<?php echo h($modelo['Modelo']['precio0km']); ?>&nbsp;</td>		
		<td class="actions">
			<?php $path = '/control/modelos/';?>
			<?php echo $this->Html->link(__('Editar'), $path.'edit/'.$modelo['Modelo']['id'].'/'.$link); ?>
			<?php echo $this->Form->postLink(__('Borrar'), $path.'delete/'.$modelo['Modelo']['id'].'/'.$link, null, __('Are you sure you want to delete # %s?', $modelo['Modelo']['id'])); ?>
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
		echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ' - '));
		echo $this->Paginator->next(__(' next') . ' >', array(), null, array('class' => 'next disabled'));
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
