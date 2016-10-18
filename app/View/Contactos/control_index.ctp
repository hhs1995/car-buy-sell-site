	<div class="versiones index">
	<h2><?php echo __('Contactos'); ?></h2>
	<?php echo $this->element('admin/filtro_contactos')?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre_apellido'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>		
			<th><?php echo $this->Paginator->sort('telefono'); ?></th>
			<th><?php echo $this->Paginator->sort('tipo'); ?></th>
<th><?php echo $this->Paginator->sort('created'); ?></th>		
			<th><?php echo $this->Paginator->sort('estado'); ?></th>			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($Contactos as $contacto): ?>
	<?php $contacto['Contacto']['created'] = date("d-m-Y H:i:s", strtotime($contacto['Contacto']['created'])); ?>
	<tr>
		<td><?php echo h($contacto['Contacto']['id']); ?>&nbsp;</td>
		<td><?php echo h($contacto['Contacto']['nombre_apellido']); ?>&nbsp;</td>		
		<td><?php echo h($contacto['Contacto']['email']);?></td>
		<td><?php echo h($contacto['Contacto']['telefono']); ?>&nbsp;</td>
		
		<td><?php
 		$class = null;
		switch(h($contacto['Contacto']['tipo'])) 
		{
			case 'Canje':
				$class = 'Canje';
				break;
			
			case 'Consulta Plan':
				$class = 'Consulta_Plan';
				break;
				
			case 'Grandes Clientes':
				$class = 'Grandes_Clientes';
				break;
				
			case 'Plan a tu medida':
				$class = 'Plan_a_tu_medida';
				break;
				
			case 'Contacto':
				$class = 'Contacto';
				break;
				
			case 'Venta':
				$class = 'Venta';
				break;
		}
		echo '<FONT class="';
		echo $class;
		echo '">&nbsp&nbsp';
		echo h($contacto['Contacto']['tipo']);
		?>
		&nbsp&nbsp</FONT></td>
	
		<td><?php echo h($contacto['Contacto']['created']); ?>&nbsp;</td>		
		
				<td><?php echo h($contacto['Contacto']['estado']); ?>&nbsp;</td>		
		
				<td class="actions">
			<?php $path = '/control/contactos/';?>
			<?php echo $this->Html->link(__('Ver'), $path.'view/'.$contacto['Contacto']['id'].'/'.$link); ?>
			<?php echo $this->Form->postLink(__('Borrar'), $path.'delete/'.$contacto['Contacto']['id'].'/'.$link, null, __('Are you sure you want to delete # %s?', $contacto['Contacto']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'contactos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'contactos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Segmentos'), array('controller' => 'segmentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Segmento'), array('controller' => 'segmentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planesnuevos'), array('controller' => 'planesnuevos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planesnuevo'), array('controller' => 'planesnuevos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planesusados'), array('controller' => 'planesusados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planesusado'), array('controller' => 'planesusados', 'action' => 'add')); ?> </li>
	</ul>
</div>
