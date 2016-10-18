<?php echo $this->Html->script(array('jquery.prettyPhoto','thickbox-compressed'));?>
<?php echo $this->Html->css(array('thickbox','prettyPhoto'));?>

<div class="modelos form">
	<?php echo $this->Form->create('Marca',array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Editar Marca'); ?></legend>
		<div class="tabs">
			<div id="link-info">
				<?php echo $this->Form->hidden('id'); ?>
				<table>
					<tr class="rows">
						<td colspan="2" class="cell cell_1">
							<?php echo $this->Form->input('denominacion',array('size'=>100)); ?>
						</td>
					</tr>
					
					<tr class="rows">
						<td colspan="2" class="cell cell_1">
							<?php echo $this->Form->input('slug'); ?>
						</td>
					</tr>
					
					<tr class="rows">
						<td colspan="2" class="cell cell_1">
							<?php echo $this->Form->input('nombre_plan'); ?>
						</td>
					</tr>
					
					<tr class="rows">
						<td colspan="2" class="cell cell_1">
							<?php echo $this->Form->input('detalle_plan',array('type'=>'textarea')); ?>
						</td>
					</tr>
					
					<tr class="rows">
						<td colspan="2" class="cell cell_1">
							<?php echo $this->Form->input('mails',array('type'=>'textarea','label'=>'Mails concesionario (separar por coma)')); ?>
						</td>
					</tr>
				</table>
				<?php echo $this->Form->end(__('Guardar')); ?>
			</div>
		</div>	
	</fieldset>
</div>