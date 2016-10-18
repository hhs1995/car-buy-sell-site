<div class="planesusados view">
<h2><?php  echo __('Planesusado'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Denominacion'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['denominacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volanta'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['volanta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modelo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($planesusado['Modelo']['denominacion'], array('controller' => 'modelos', 'action' => 'view', $planesusado['Modelo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['descripcion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tags'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['tags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Precio0km'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['precio0km']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['estado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PrecioPlan'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['precioPlan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CuotaFinal'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['cuotaFinal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CuotaPura'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['cuotaPura']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CuotasCantidad'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['cuotasCantidad']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CuotasPagas'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['cuotasPagas']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Version'); ?></dt>
		<dd>
			<?php echo $this->Html->link($planesusado['Version']['denominacion'], array('controller' => 'versiones', 'action' => 'view', $planesusado['Version']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plantipo Id'); ?></dt>
		<dd>
			<?php echo h($planesusado['Planesusado']['plantipo_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Planesusado'), array('action' => 'edit', $planesusado['Planesusado']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Planesusado'), array('action' => 'delete', $planesusado['Planesusado']['id']), null, __('Are you sure you want to delete # %s?', $planesusado['Planesusado']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Planesusados'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planesusado'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('controller' => 'versiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versiones', 'action' => 'add')); ?> </li>
	</ul>
</div>
