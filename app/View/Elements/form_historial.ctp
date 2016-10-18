<script>

function toggle() {
	var ele = document.getElementById("filter");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    	ele.style.display = "none";
		text.innerHTML = "Insertar comentario";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Cancelar";
	}
}

function save()
	{
		var finaltext = $('#filter textarea.inputdescripcion').val();
		var tipo = $('#filter select.inputtipo').val();
		var estado = $('#filter select.inputestado').val();

		var url = "<?php echo Router::url(array('controller'=>'contactos','action'=>'guardarDescripcion'))?>";
		var params = {
		'data[Contactohistorial][texto]': finaltext,
		'data[Contactohistorial][tipo]': tipo,
		'data[Contactohistorial][estado]': estado,
		'data[Contactohistorial][contacto_id]': '<?php echo $id; ?>'};
		$.post(url,params,function(data){
			if(data.resultado==1){
				addRow(data);
				$('#filter textarea.inputdescripcion').val(' ');
				$('#filter select.inputtipo').val(' ');
				$('#filter select.inputestado').val(' ');
				toggle();
			}
			else{alert('fallo');}
		},'json');
	}
	
	

</script>
<?php
    if (isset($this->request->params['named']['filter'])) {
        $this->Html->scriptBlock('var filter = 1;', array('inline' => false));
    }
?>
<div class="filter"><a id="displayText" href="javascript:toggle();">Insertar comentario</a>
<div id="filter" style="display: none">

<?php 
echo $this->Form->create();
 echo $this->Form->input('contacto_id',array('type'=>'hidden','value'=>$id));
 echo $this->Form->input('texto',array('class'=>'inputdescripcion','type'=>'textarea','style'=>'width:350px;height:100px;','label'=>'Descripción'));
 echo $this->Form->input('tipoinput',array('type' => 'select','label'=>'Tipo','class'=>'inputtipo','options'=>$tipos));
 echo $this->Form->input('estadoinput',array('type' => 'select','label'=>'Estado','class'=>'inputestado','options'=>$estados));
echo $this->Form->end();
?>
<div class="input link">
<br>
<a href="javascript:save();">Listo</a>
</div>

</div>
</div>