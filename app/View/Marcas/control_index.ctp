<div class="versiones index">
	<h2><?php echo __('Marcas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th>id</th>
		<th>denominacion</th>					
		<th>Nombre del plan</th>	
		<th class="actions">Acciones</th>
	</tr>
	<?php foreach ($Marcas as $marca){ ?>
		<tr>
			<td><?php echo h($marca['Marca']['id']); ?></td>
			<td><?php echo h($marca['Marca']['denominacion']); ?></td>		
			<td><?php echo h($marca['Marca']['nombre_plan']); ?></td>		
			<td class="actions">
				<?php $path = '/control/marcas/';?>
				<?php echo $this->Html->link(__('Editar'), $path.'edit/'.$marca['Marca']['id'].'/'.$link); ?>
			</td>
		</tr>
	<?php } ?>
	</table>
</div>