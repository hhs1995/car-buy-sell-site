<div class="planesnuevos view">
<h2><?php  echo __('Planesnuevo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Denominacion'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['denominacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volanta'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['volanta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modelo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($planesnuevo['Modelo']['denominacion'], array('controller' => 'modelos', 'action' => 'view', $planesnuevo['Modelo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['descripcion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tags'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['tags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Precio0km'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['precio0km']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CuotaPura'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['cuotaPura']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['estado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Version'); ?></dt>
		<dd>
			<?php echo $this->Html->link($planesnuevo['Version']['denominacion'], array('controller' => 'versiones', 'action' => 'view', $planesnuevo['Version']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plantipo Id'); ?></dt>
		<dd>
			<?php echo h($planesnuevo['Planesnuevo']['plantipo_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Planesnuevo'), array('action' => 'edit', $planesnuevo['Planesnuevo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Planesnuevo'), array('action' => 'delete', $planesnuevo['Planesnuevo']['id']), null, __('Are you sure you want to delete # %s?', $planesnuevo['Planesnuevo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Planesnuevos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planesnuevo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('controller' => 'versiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versiones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cuotas'), array('controller' => 'cuotas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cuota'), array('controller' => 'cuotas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cuotas'); ?></h3>
	<?php if (!empty($planesnuevo['Cuota'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Planesnuevo Id'); ?></th>
		<th><?php echo __('Texto'); ?></th>
		<th><?php echo __('Orden'); ?></th>
		<th><?php echo __('Valor'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($planesnuevo['Cuota'] as $cuota): ?>
		<tr>
			<td><?php echo $cuota['id']; ?></td>
			<td><?php echo $cuota['planesnuevo_id']; ?></td>
			<td><?php echo $cuota['texto']; ?></td>
			<td><?php echo $cuota['orden']; ?></td>
			<td><?php echo $cuota['valor']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cuotas', 'action' => 'view', $cuota['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cuotas', 'action' => 'edit', $cuota['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cuotas', 'action' => 'delete', $cuota['id']), null, __('Are you sure you want to delete # %s?', $cuota['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cuota'), array('controller' => 'cuotas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
