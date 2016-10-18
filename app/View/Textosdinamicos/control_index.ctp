	<div class="versiones index">
	<h2><?php echo __('Textos dinámicos'); ?>
	</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th width="2%"><?php echo $this->Paginator->sort('id'); ?></th>
			<th width="15%"><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th width="33%"><?php echo $this->Paginator->sort('valor'); ?></th>	
			<th width="40%"><?php echo 'Ayuda' ?></th>		
			<th><?php echo $this->Paginator->sort('modified'); ?></th>			
	</tr>
	
	<script type="text/javascript" >


var editing = 0;
	var textbuffer;
	
	function showbutton(e) {
		if (editing==0)
		{	
			textbuffer = $('#e_'+e+' span.descripcion').html();
			$('#e_'+e+' .buttons').show();
			editing = e;
		}
		else if (editing!=e)
		{
			alert('Guarde los cambios anteriores antes de editar otra entrada');
		}
	}
		
	function hide(e)
	{
		$('#e_'+e+' .buttons').hide();
		editing = 0;
	}
		
		
	function savechanges(e)
	{
		var finaltext = $('#e_'+e+' span.descripcion').html();
		var url = "<?php echo Router::url(array('controller'=>'textosdinamicos','action'=>'editar'))?>";
		var params = {'data[Textosdinamico][valor]': finaltext, 'data[Textosdinamico][id]': e};
		
		$.post(url,params,function(data){$('#e_'+e+' span.descripcion').highlight();},'html');
		hide(e);
	}
	
	function cancelar(e)
	{
		$('#e_'+e+' span.descripcion').text(textbuffer);
		hide(e);
	}
	
	jQuery.fn.highlight = function() {
   $(this).each(function() {
        var el = $(this);
        el.before("<div/>")
        el.prev()
            .width(el.width())
            .height(el.height())
            .css({
                "position": "absolute",
                "background-color": "#ffff99",
                "opacity": ".9"   
            })
            .fadeOut(2000);
    });
}		


</script>
	
	<?php
	foreach ($Textosdinamicos as $Textosdinamico): ?>
	<?php $Textosdinamico['Textosdinamico']['created'] = date("d-m-Y H:i:s", strtotime($Textosdinamico['Textosdinamico']['created'])); ?>
	<?php echo '<tr id="e_'.$Textosdinamico['Textosdinamico']['id'].'">'; ?>
		<td><?php echo h($Textosdinamico['Textosdinamico']['id']); ?>&nbsp;</td>
		<td><?php echo h($Textosdinamico['Textosdinamico']['nombre']); ?>&nbsp;</td>		
		<td>
<span class="descripcion" contentEditable="true" 
onmouseover="$(this).addClass('editabletext');" 
onmouseout="$(this).removeClass('editabletext');"
onclick="showbutton(<?php echo $Textosdinamico['Textosdinamico']['id'] ?>);"><?php echo h($Textosdinamico['Textosdinamico']['valor']);?></span>
		
		
				<div class="buttons">
				<a href="javascript:savechanges(<?php echo $Textosdinamico['Textosdinamico']['id']; ?>)">Guardar</a>
				<a href="javascript:cancelar(<?php echo $Textosdinamico['Textosdinamico']['id']	; ?>)">Cancelar</a>
				</div>
		</td>
		<td><?php echo h($Textosdinamico['Textosdinamico']['ayuda']);; ?>&nbsp;</td>
		<td><?php echo h($Textosdinamico['Textosdinamico']['modified']); ?>&nbsp;</td>

		
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
