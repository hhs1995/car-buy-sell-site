<div class="versiones view">
<h2><?php  echo __('Version'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($version['Version']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Denominacion'); ?></dt>
		<dd>
			<?php echo h($version['Version']['denominacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($version['Version']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modelo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($version['Modelo']['denominacion'], array('controller' => 'modelos', 'action' => 'view', $version['Modelo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($version['Version']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($version['Version']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($version['Version']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Segmento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($version['Segmento']['denominacion'], array('controller' => 'segmentos', 'action' => 'view', $version['Segmento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transmision'); ?></dt>
		<dd>
			<?php echo h($version['Version']['transmision']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Combustible'); ?></dt>
		<dd>
			<?php echo h($version['Version']['combustible']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Version'), array('action' => 'edit', $version['Version']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Version'), array('action' => 'delete', $version['Version']['id']), null, __('Are you sure you want to delete # %s?', $version['Version']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Planesnuevos'); ?></h3>
	<?php if (!empty($version['Planesnuevo'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Denominacion'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Volanta'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Modelo Id'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th><?php echo __('Tags'); ?></th>
		<th><?php echo __('Precio0km'); ?></th>
		<th><?php echo __('CuotaPura'); ?></th>
		<th><?php echo __('Estado'); ?></th>
		<th><?php echo __('Version Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($version['Planesnuevo'] as $planesnuevo): ?>
		<tr>
			<td><?php echo $planesnuevo['id']; ?></td>
			<td><?php echo $planesnuevo['denominacion']; ?></td>
			<td><?php echo $planesnuevo['slug']; ?></td>
			<td><?php echo $planesnuevo['volanta']; ?></td>
			<td><?php echo $planesnuevo['created']; ?></td>
			<td><?php echo $planesnuevo['modified']; ?></td>
			<td><?php echo $planesnuevo['modelo_id']; ?></td>
			<td><?php echo $planesnuevo['descripcion']; ?></td>
			<td><?php echo $planesnuevo['tags']; ?></td>
			<td><?php echo $planesnuevo['precio0km']; ?></td>
			<td><?php echo $planesnuevo['cuotaPura']; ?></td>
			<td><?php echo $planesnuevo['estado']; ?></td>
			<td><?php echo $planesnuevo['version_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'planesnuevos', 'action' => 'view', $planesnuevo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'planesnuevos', 'action' => 'edit', $planesnuevo['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'planesnuevos', 'action' => 'delete', $planesnuevo['id']), null, __('Are you sure you want to delete # %s?', $planesnuevo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Planesnuevo'), array('controller' => 'planesnuevos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Planesusados'); ?></h3>
	<?php if (!empty($version['Planesusado'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Denominacion'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Volanta'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Modelo Id'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th><?php echo __('Tags'); ?></th>
		<th><?php echo __('Precio0km'); ?></th>
		<th><?php echo __('Estado'); ?></th>
		<th><?php echo __('Tipo'); ?></th>
		<th><?php echo __('PrecioPlan'); ?></th>
		<th><?php echo __('CuotaFinal'); ?></th>
		<th><?php echo __('CuotaPura'); ?></th>
		<th><?php echo __('CuotasCantidad'); ?></th>
		<th><?php echo __('CuotasPagas'); ?></th>
		<th><?php echo __('Version Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($version['Planesusado'] as $planesusado): ?>
		<tr>
			<td><?php echo $planesusado['id']; ?></td>
			<td><?php echo $planesusado['denominacion']; ?></td>
			<td><?php echo $planesusado['slug']; ?></td>
			<td><?php echo $planesusado['volanta']; ?></td>
			<td><?php echo $planesusado['created']; ?></td>
			<td><?php echo $planesusado['modified']; ?></td>
			<td><?php echo $planesusado['modelo_id']; ?></td>
			<td><?php echo $planesusado['descripcion']; ?></td>
			<td><?php echo $planesusado['tags']; ?></td>
			<td><?php echo $planesusado['precio0km']; ?></td>
			<td><?php echo $planesusado['estado']; ?></td>
			<td><?php echo $planesusado['tipo']; ?></td>
			<td><?php echo $planesusado['precioPlan']; ?></td>
			<td><?php echo $planesusado['cuotaFinal']; ?></td>
			<td><?php echo $planesusado['cuotaPura']; ?></td>
			<td><?php echo $planesusado['cuotasCantidad']; ?></td>
			<td><?php echo $planesusado['cuotasPagas']; ?></td>
			<td><?php echo $planesusado['version_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'planesusados', 'action' => 'view', $planesusado['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'planesusados', 'action' => 'edit', $planesusado['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'planesusados', 'action' => 'delete', $planesusado['id']), null, __('Are you sure you want to delete # %s?', $planesusado['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Planesusado'), array('controller' => 'planesusados', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
