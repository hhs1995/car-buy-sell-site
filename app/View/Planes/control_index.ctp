<div class="planesnuevos index">
	<h2><?php echo __('Planes'); ?></h2>
 
	<?php echo $this->element('admin/filtro_planes')?>
	</div>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('denominacion'); ?></th>
			<th><?php echo $this->Paginator->sort('modelo_id','Modelo'); ?></th>
			<th><?php echo $this->Paginator->sort('precioPlan','Precio'); ?></th>
			<th><?php echo $this->Paginator->sort('cuotaPura','Cuota Pura'); ?></th>
			<th><?php echo $this->Paginator->sort('estado'); ?></th>
			<th><?php echo $this->Paginator->sort('tipo'); ?></th>
			<th><?php echo $this->Paginator->sort('plantipo_id','Tipo Plan'); ?></th>
			<th><?php echo $this->Paginator->sort('created','Creado'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	
	<?php
	foreach ($Planes as $plan): ?>
	<tr>
		<td><?php echo h($plan['Plan']['id']); ?>&nbsp;</td>
		<td><?php echo h($plan['Plan']['denominacion']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($plan['Modelo']['denominacion'], array('controller' => 'modelos', 'action' => 'edit', $plan['Modelo']['id'])); ?>
		</td>
		<td><?php echo '$'.h($plan['Plan']['precioPlan']); ?>&nbsp;</td>
		<td><?php echo '$'.h($plan['Plan']['cuotaPura']); ?>&nbsp;</td>
		<td><?php echo h($plan['Plan']['estado']); ?>&nbsp;</td>	
		<td><?php echo h($plan['Plan']['tipo']); ?>&nbsp;</td>
		<td><?php echo h($plan['Plantipo']['denominacion']); ?>&nbsp;</td>	
		<td><?php 
		$date = date_create(h($plan['Plan']['created']));
		$fecha = date_format($date,'d-m-Y H:i:s');		
		echo h($fecha); 
		
		
		
		?>&nbsp;</td>	
		<td class="actions">			
			<?php $path = '/control/planes/';?>
			<?php echo $this->Html->link(__('Editar'), $path.'edit/'.$plan['Plan']['id'].'/'.$link); ?>
			<?php echo $this->Form->postLink(__('Borrar'), $path.'delete/'.$plan['Plan']['id'].'/'.$link, null, __('Are you sure you want to delete # %s?', $plan['Plan']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Plan'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('controller' => 'versiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versiones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cuotas'), array('controller' => 'cuotas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cuota'), array('controller' => 'cuotas', 'action' => 'add')); ?> </li>
	</ul>
</div>
