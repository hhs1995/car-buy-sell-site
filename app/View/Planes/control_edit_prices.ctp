<style>
#dynamic {
  position: absolute;
  left: 0px;
  padding-left: 10px;
  width: 98%;
  background-color: white;
  border-bottom: 2px solid black;
}

#dynamic.fixed {
  position: fixed;
  top: 0;
}

.modelo{border: 2px grey solid; padding: 5px; margin: 5px; display: inline-block; vertical-align: top;}

.plan{border: 1px grey solid; padding: 5px; margin: 5px; display: inline-block; vertical-align: top;}
</style>
<script>
	var changedFields = new Array();
	
	$(document).ready(function () {
		var top = $('#dynamic').offset().top - parseFloat($('#dynamic').css('marginTop').replace(/auto/,0));
		$(window).scroll(function () {
			var y = $(this).scrollTop();
			if (y >= top) {
				$('#dynamic').addClass('fixed');
			} else {
				$('#dynamic').removeClass('fixed');
			}
		});
		$('#save').click(function(){
			save();
		});
		$('input').focus(function() {
			$('.modelo').css('border-style','solid');
			$('.plan').css('border-style','solid');
			$(this).parent().closest('.modelo').css('border-style','dashed');
			$(this).parent().closest('.plan').css('border-style','dashed');
		});
		$('input').change(function(){
			if(isNumber($(this).val())){
				changedFields.push([$(this).attr('id'),$(this).val()]);
				$(this).css('border','1px solid green');
			}else{
				$(this).css('border','1px solid red');
				alert('Debe ser un número');
			}
		})
	});
	
	function save(){
		$.post('<?php echo $this->Html->url(array('controller'=>'planes','action'=>'control_edit_prices')); ?>', {data: JSON.stringify(changedFields)}, function(data){
			if(data == 'ok'){
				location.reload(); 
			}else{
				alert('Ocurrió un error al guardar los precios.');
			}
		});
	}
	
	function isNumber(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	}
</script>
<div id="dynamic">
	<h1>Modificar precios</h1>
	<a id="save" href="javascript:void(0);">Guardar Todo</a>
</div>
<div style="height: 40px;"></div>
<?php foreach($marcas as $marca){ ?>
	<h2><?php echo $marca['Marca']['denominacion']; ?></h2>
	<?php foreach($marca['Modelo'] as $modelo){ ?>
		<div class="modelo"><h3><?php echo $modelo['denominacion']; ?></h3>
		<?php foreach($modelo['Plan'] as $plan){ ?>
			<div class="plan"><h4>Plan CODIGO: <?php echo $plan['codigo']; ?><br><?php echo $plan['Plantipo']['denominacion']; ?></h4>
			<?php
				echo 'Precio 0km: '.$this->Form->input('precio0km-'.$plan['id'],array('label'=>'','value'=>$plan['precio0km']));
				echo 'Precio Plan: '.$this->Form->input('precioPlan-'.$plan['id'],array('label'=>'','value'=>$plan['precioPlan']));
				echo 'Cuota Pura: '.$this->Form->input('cuotaPura-'.$plan['id'],array('label'=>'','value'=>$plan['cuotaPura']));
				?><br><h5>Cuotas:</h5><?php
				foreach($plan['Cuota'] as $cuota){
					echo $cuota['texto'].': '.$this->Form->input('cuota-'.$cuota['id'].'-'.$plan['id'],array('label'=>'','value'=>$cuota['valor']));
				}
			?>
			</div>
		<?php } ?>
		</div>
	<?php } ?>
<?php } ?>