<div class="contactos view">
<h2><?php  echo __('Contacto');?></h2>

<!-- ID y tipo de consulta -->
<h3>
<?php 
	echo h($Contacto['Contacto']['id']);
	echo '&nbsp;/&nbsp;';
	if(!empty($Contacto['Contacto']['tipo']))
	{
		echo h($Contacto['Contacto']['tipo']);
	} 
?>
</h3>

<?php
echo $this->Form->create();
$onchange = 'javascript:changestatuscontacto();';
echo $this->Form->input('estadocontacto',array('label'=>'','class'=>'statusc','options'=>$estadoscontacto,'selected'=>$Contacto['Contacto']['estado'],'onchange' => $onchange));
echo $this->Form->end();
?>

<!-- Fecha de la consulta -->
<?php $Contacto['Contacto']['created'] = date('d-m-Y h:i:s',strtotime($Contacto['Contacto']['created']));?>
<?php echo h($Contacto['Contacto']['created']); ?>
<br>

<!-- Datos del cliente -->
<div class="datos-cliente">

	<!-- Nombre y apellido -->
	<h3><?php echo h($Contacto['Contacto']['nombre_apellido']); ?></h3>
	
	<!-- Provincia -->
	<?php
		if(!empty($Contacto['Contacto']['provincia_id'])){
			echo h($Contacto['Provincia']['denominacion']);
			echo '<br>';
		}
	?>
	
	<!-- mail -->
	<?php 
		if(!empty($Contacto['Contacto']['email'])){
			echo h($Contacto['Contacto']['email']);
			echo '<br>';
		}
	?>
	
	<!-- Teléfonos -->
	<?php echo __('Teléfono/s:'); ?>
	<?php 
		if(!empty($Contacto['Contacto']['telefono'])){
			echo h($Contacto['Contacto']['telefono']); 
		}
		if(!empty($Contacto['Contacto']['celular'])){
			echo '&nbsp;/&nbsp;';
			echo h($Contacto['Contacto']['celular']);
		}
	?>

</div>





<div class="datos-consulta">


<dl>
		
		<?php if(!empty($Contacto['Contacto']['vehiculo'])){?>
			<dt><?php echo __('Vehiculo'); ?></dt>
			<dd>
				<?php echo h($Contacto['Contacto']['vehiculo']); ?>
				&nbsp;
			</dd>
		<?php } ?>
		<?php if(!empty($Contacto['Contacto']['cuotas_pagas'])){?>
			<dt><?php echo __('Cuotas Pagas'); ?></dt>
			<dd>
				<?php echo h($Contacto['Contacto']['cuotas_pagas']); ?>
				&nbsp;
			</dd>
		<?php } ?>
		<?php if(!empty($Contacto['Contacto']['horarios'])){?>
			<dt><?php echo __('Horarios'); ?></dt>
			<dd>
				<?php echo h($Contacto['Contacto']['horarios']); ?>
				&nbsp;
			</dd>
		<?php } ?>
		<?php if(!empty($Contacto['Contacto']['dinero_contas'])){?>
			<dt><?php echo __('¿Con cuánto dinero contas?'); ?></dt>
			<dd>
				<?php echo h($Contacto['Contacto']['dinero_contas']); ?>
				&nbsp;
			</dd>
		<?php } ?>	
		<?php if(!empty($Contacto['Contacto']['dinero_mes'])){?>
			<dt><?php echo __('¿Cuánto dinero podes pagar por mes?'); ?></dt>
			<dd>
				<?php echo h($Contacto['Contacto']['dinero_mes']); ?>
				&nbsp;
			</dd>
		<?php } ?>
		<?php if(!empty($Contacto['Contacto']['plan_id'])){?>
			<dt><?php echo __('Plan'); ?></dt>
			<dd>
				<?php echo h($Contacto['Plan']['denominacion']); ?>
				&nbsp;
			</dd>
		<?php } ?>
		<?php if(!empty($Contacto['Contacto']['comentarios'])){?>
			<dt><?php echo __('Comentarios'); ?></dt>
			<dd>
				<?php echo h($Contacto['Contacto']['comentarios']);?>
				
				&nbsp;
			</dd>
		<?php } ?>					
		
	</dl>


</div><br><br><br><br><br><br><br>
<div style="float:left;">
	<?php $path = '/control/contactos/';?>
	<?php echo '<div class="input link">'.$this->Html->link('Volver',$path.'index/'.$link,array('div'=>array('class'=>'input link'))).'</div>';?>
</div>
<br><br><br>

<h3>Historial</h3>

<script>
	var editing = 0;
	var textbuffer;
	
	function showbutton(e) {
		if (editing==0)
		{	
			textbuffer = $('#e_'+e+' span.descripcion').text();
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
		var finaltext = $('#e_'+e+' span.descripcion').text();
		var url = "<?php echo Router::url(array('controller'=>'contactos','action'=>'grabarDescripcion'))?>";
		var params = {'data[Contactohistorial][descripcion]': finaltext, 'data[Contactohistorial][id]': e};
		$.post(url,params,function(data){$('#e_'+e+' span.descripcion').highlight();},'html');
		hide(e);
	}
	
	function cancelar(e)
	{
		$('#e_'+e+' span.descripcion').text(textbuffer);
		hide(e);
	}
	
	function changetipo(e)
	{
		var seleccion = $('#e_'+e+' select.type').val();
		var url = "<?php echo Router::url(array('controller'=>'contactos','action'=>'grabarTipo'))?>";
		var params = {'data[Contactohistorial][tipo]': seleccion, 'data[Contactohistorial][id]': e};
		$.post(url,params,function(data){$('#e_'+e+' select.type').highlight();},'html');
	}
	
		function changestatuscontacto()
	{
		var seleccion = $('select.statusc').val();
		var url = "<?php echo Router::url(array('controller'=>'contactos','action'=>'cambiarstatus'))?>";
		var params = {'data[Contacto][estado]': seleccion, 'data[Contacto][id]': '<?php echo $Contacto["Contacto"]["id"];?>'};
		$.post(url,params,function(data){$('select.statusc').highlight();},'html');
	}
	
	function changeestado(e)
	{
		var seleccion = $('#e_'+e+' select.status').val();
		var url = "<?php echo Router::url(array('controller'=>'contactos','action'=>'grabarEstado'))?>";
		var params = {'data[Contactohistorial][estado]': seleccion, 'data[Contactohistorial][id]': e};
		$.post(url,params,function(data){$('#e_'+e+' select.status').highlight();},'html');
	}
	
	function borrar(e)
	{
    	var answer = confirm("Borrar esta entrada?")
    	if (answer){
     	   var url = "<?php echo Router::url(array('controller'=>'contactos','action'=>'eliminarHistorial'))?>";
			var params = {'data[Contactohistorial][id]': e};
			$.post(url,params,function(data){$('#e_'+e).remove();},'html');
    	}
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
function addRow(data)
{
	var id = data.Contactohistorial['Contactohistorial']['id'];
	var texto = data.Contactohistorial['Contactohistorial']['texto'];
	var tipo = data.Contactohistorial['Contactohistorial']['tipo'];
	var estado = data.Contactohistorial['Contactohistorial']['estado'];
	var created = data.fecha;
	
	var row = 	"<tr class='striped' id='e_" + id +"'><td>"+ id +
	"</td><td width='50%' class='editable'><span class='descripcion' contentEditable='true'"+
	"onmouseover='$(this).addClass("+'"editabletext"'+");'"+
	"onmouseout='$(this).removeClass("+'"editabletext"'+");'"+
	"onclick='showbutton("+id+");' >"+
	texto +"</span><div class='buttons'>"+
	"<a href='javascript:savechanges("+id+")'>Guardar</a>"+
	"<a href='javascript:cancelar("+id+")'>Cancelar</a></div></td>"+
	"<td><select class='type ui-corner-all'></select></td><td><select class='status ui-corner-all'></select></td><td>"+created+"</td>"+
	"<td><a href='javascript:borrar("+id+")'>Eliminar</a></td></tr>";
	
	var idtipo = "tipo"+id;
	var idestado = "estado"+id;	
	
	$('#historial tr.header').after(row);
	
	$("#filter select.inputtipo").find('option').clone().appendTo("#e_"+id+" select.type");
	$("#filter select.inputestado").find('option').clone().appendTo("#e_"+id+" select.status");
	$("#e_"+id+" select.type").val(tipo);
	$("#e_"+id+" select.status").val(estado);
	$("#e_"+id+" select.type").change(function(){changetipo(id);});
	$("#e_"+id+" select.status").change(function(){changeestado(id);});
	
	var currentid = $('#historial tr:nth-child(3)').attr('id');
	
	if ($('#'+currentid).hasClass('striped'))
	{
		$('#e_'+id).removeClass('striped');
	}
	
	
}
</script>




<?php echo $this->element('form_historial'); echo $this->Form->create();?>
<table id="historial" cellpadding="0" cellspacing="0">
	<tr class="header">
			<th>id</th>
			<th>Desripción</th>
			<th>Tipo</th>		
			<th>Estado</th>
			<th>Created</th>
			<th>Acciones</th>		
	</tr>

	<?php
	
		foreach ($Contacto['Contactohistorial'] as $Historial):
			if ($Historial['contacto_id'] == $Contacto['Contacto']['id'])
			{
				echo '<tr id="e_'.$Historial['id'].'">';
				echo '<td>';
				echo $Historial['id'];
				echo '</td>';?>
				
				<td width="50%" class="editable">
					<!-- Texto editable -->
					
				<span class="descripcion" contentEditable="true" onmouseover="$(this).addClass('editabletext');"
				onmouseout="$(this).removeClass('editabletext');" onclick="showbutton(<?php echo $Historial['id'] ?>);">
				<?php echo $Historial['texto']; ?>
				</span>
				
				<div class="buttons">
				<a href="javascript:savechanges(<?php echo $Historial['id']; ?>)">Guardar</a>
				<a href="javascript:cancelar(<?php echo $Historial['id']; ?>)">Cancelar</a>
				</div>
				</td>
				
				
				<?php
				echo '<td>';
				$onchange = 'javascript:changetipo('.$Historial['id'].');';
				echo $this->Form->input('tipo',array('label'=>'','class'=>'type','options'=>$tipos,'selected'=>$Historial['tipo'],'onchange' => $onchange));
				echo '</td>';
				
				echo '<td>';
				$onchange = 'javascript:changeestado('.$Historial['id'].');';
				echo $this->Form->input('estado',array('label'=>'','class'=>'status','options'=>$estados,'selected'=>$Historial['estado'],'onchange' => $onchange));
				echo '</td>';
				
				
				echo '<td>';
				echo $Historial['created'];
				echo '</td>';
				 
				echo '<td>';
				echo '<a href="javascript:borrar('.$Historial['id'].')">Eliminar</a>';
				echo '</td>';
				
				echo '</tr>';
			}
		endforeach;
			
	?>
</table>
<?php echo $this->Form->end();	 ?>
</div>