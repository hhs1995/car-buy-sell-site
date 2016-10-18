<?php echo $this->Html->script(array('tiny_mce/tiny_mce'));?>
<?php echo $this->Html->css(array('fixed'));?>
<?php //debug($this->request->data);?>
<script language="javascript">
	$(document).ready(function(){
		<?php if(!empty($this->request->data['Plan']['marca_id'])){?>
				cargar_modelos_por_marca(<?php echo $this->request->data['Plan']['marca_id'];?>,<?php echo $this->request->data['Plan']['modelo_id'];?>);
		<?php } ?>
		
		cuo.init_ordenar()													
		
		$('.radio').click(function(){
			if($(this).attr('id') == 'reservado'){
				$('#vendido').attr('checked',false);
			}else{
				$('#reservado').attr('checked',false);
			}
		});
		
		$('#PlanDenominacion').keyup(function(){
			$('.denominacion').html($(this).val());
		});
		
		$('#PlanCuotasCantidad').keyup(function(){
			$('.cuotas_cantidad').html($(this).val());
		});
		
		$('#PlanCuotasPagas').keyup(function(){
			$('.cuotas_pagas').html($(this).val());
		})
				

	});
	
	tinyMCE.init({
		
		setup : function(ed) {
		  ed.onKeyUp.add(function(ed, e) {
			  var texto = ed.getContent();			  
			  $('.descripcion').html(texto);
		  });
	   },
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",/*imagemanager,filemanager,*/

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline",
		theme_advanced_buttons2 : "link,unlink|,forecolor",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/example.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "/js/template_list.js",
		external_link_list_url : "/js/link_list.js",
		external_image_list_url : "/js/image_list.js",
		media_external_list_url : "/js/media_list.js",
		invalid_elements : "div",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		},
	    
	});
	
	function cargar_modelos_por_marca(marca_id, selectedValue){
		url = '<?php echo Router::url(array('controller'=>'modelos','action'=>'cargarModelosPorMarca','control'=>false));?>';
		params = {'data[Modelo][marca_id]' : marca_id}
		$.post(url, params, function(data){
			buffer_combo = '';
			$.each(data, function(index, value){
				if(index == selectedValue){
					buffer_combo += '<option value='+index+' selected>'+value+'</option>'; 
				}else{
					buffer_combo += '<option value='+index+'>'+value+'</option>'; 
				}
			})
			$('#PlanModeloId').html(buffer_combo);			
		},'json')
	}
	
	function add_cuota(){
				
		plan_id = $('#PlanId').val();
		texto = $('#CuotaTexto').val();
		valor = $('#CuotaValor').val();
		tipo_info = $('#CuotaTipoInfo').val();
		
		if(texto != '' && valor != ''){
			url = '<?php echo Router::url(array('controller'=>'cuotas','action'=>'agregar_por_ajax','control'=>false));?>'
			params = {
						'data[Cuota][planes_id]' : plan_id,
						'data[Cuota][texto]' : texto,
						'data[Cuota][valor]' : valor,
						'data[Cuota][tipos_info]' : tipo_info
					}
			
			$.post(url, params, function(data){
				//alert(data.mensaje);
				if(data.exito == 1){
					$('.cuotas').append('<li id="cuo_el_'+data.cuota['Cuota']['id']+'" class="item-cuota"><label class="texto">'+data.cuota['Cuota']['texto']+' <span class="tipo">('+data.cuota['Cuota']['tipos_info']+')</span></label><span class="valor">'+data.cuota['Cuota']['valor']+'</span><a class="eliminar" onclick="delete_cuota('+data.cuota['Cuota']['id']+')" href="javascript:void(0)">X</a></li>');
					cuo.init_ordenar();
					cuo.grabar_orden();
				}
			},'json')
		}
	}
	
	function delete_cuota(cuota_id){
		if(confirm('Seguro que desea eliminar esta cuota #'+cuota_id+'?')){
			url = '<?php echo Router::url(array('controller'=>'cuotas','action'=>'delete','control'=>false));?>';
			params = {'data[Cuota][id]' : cuota_id}
			$.post(url, params, function(data){
				$('#cuo_el_'+data.id).remove();
				cuo.grabar_orden();
			},'json')
		}
		
		
	}
	
	var cuo = {
		
		init_ordenar: function(){
			$("#listaCuotas").sortable({
				placeholder: 'ui-state-highlight',
				update : function(event, ui){cuo.grabar_orden(event, ui)}
			});
			$("#listaCuotas").disableSelection();		
			$("#listaCuotas li").hover(
			function(){
				$(this).addClass('hover')
			}, 
			function(){
				$(this).removeClass('hover')
			});			
		},
		grabar_orden: function(event, ui){
			var cuotas = $("#listaCuotas").sortable('toArray');
			params = {}
			params.plan = <?php echo $this->request->data['Plan']['id']?>;
			params.cuotas = cuotas.join(',');
			
			url = '<?php echo Router::url(array('controller' => 'cuotas', 'action' => 'grabarOrden','control'=>false))?>',
			$.post(url, params, function(data){
			}, 'json');	
		}

	}
	
	function preview(field){
		alert(field);
	}
		
</script>


<div class="plan form">
<?php echo $this->Form->create('Plan'); ?>
	<legend><?php echo __('Editar Plan'); ?></legend>
	<div class="tabs">
	   <ul>
			<li id="0"><a href="#link-info"><span><?php echo __('Info',true); ?></span></a></li>
			
			<li id="1"><a href="#link-cuotas"><span><?php echo __('Cuotas',true); ?></span></a></li>
	   </ul>
	
	<fieldset>

	<?php
		echo '<div id="link-info">';
			echo $this->Form->hidden('id');
			echo '<table>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('denominacion',array('size'=>100));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
					
			echo '<tr class="rows">';
				echo '<td colspan="1" class="cell cell_1">';
					echo '<label for="PlaneVolanta">Volanta</label>';
					echo $this->Form->textarea('volanta',array('style'=>'width:530px;','id'=>'PlanVolanta'));
					echo '&nbsp;';
				echo '</td>';
				echo '<td colspan="1" class="cell cell_1">';
					//echo '<label for="PlaneVolanta">Vista Previa</label>';					
					if(!empty($this->request->data['Modelo']['imagen'])){
						$thumb = $this->Thumbnail->render($this->request->data['Modelo']['imagen'], array(
							'path' => UPLOAD_IMG_PATH_MODELOS_PRINCIPAL,
							'cachePath' => UPLOAD_IMG_HELPER_CACHE.'principal',
							'newWidth' => 300,
							'newHeight' => 220,
							'resizeOption'=>'crop',
							'quality' => '100',
							'absoluteCachePath' => WWW_ROOT,
						));
					$thumb = Router::url('/'.$thumb);
					}
					echo '<div class="listado-planes">';
						echo '<div class="item" ';
						if (isset($thumb)){echo 'style="background-image:url(\''.$thumb.'\');"';};
						echo '>';
							echo ($this->request->data['Plan']['vendido'] == 1 ? $this->Html->image('tuplanya/vendido.png',array('class'=>'vendido')) : '');							
							echo ($this->request->data['Plan']['reservado'] == 1 ? $this->Html->image('tuplanya/reservado.png',array('class'=>'reservado')) : '');
							echo '<h2>'.$this->Html->link($this->request->data['Plan']['denominacion'], 'javascript:void(0)',array('onclick'=>'return false;','class'=>'denominacion')).'</h2>';
							echo '<div class="volanta">'.strip_tags($this->request->data['Plantipo']['denominacion'],'<strong><span><em>').'</div>';
							echo '<p class="descripcion">'.strip_tags($this->request->data['Plan']['volanta'],'<strong><span><em>').'</p>';
							echo '<div class="pie">';
								if($this->request->data['Plan']['tipo'] != 'Nuevo'){ 
									echo '<div class="cuotas-pagas"><span class="cuotas_pagas">'.$this->request->data['Plan']['cuotasPagas'].'</span>/<span class="cuotas_cantidad">'.$this->request->data['Plan']['cuotasCantidad'].'</span></div>';
									echo '<div class="cuotas-cantidad">'.__('Cuotas Pagas',true).'</div>';
								}
								echo '<div class="precio">'.h( $this->Number->format($this->request->data['Plan']['precio_visible'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))).'</div>';
								echo '<div class="cuota-pura">'.($this->request->data['Plan']['tipo'] != 'Nuevo' ? 'cuota: '.h($this->Number->format($this->request->data['Plan']['cuota_promedio'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))) : '').'</div>';
							echo '</div>';						
					echo '</div>';
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('marca_id',array('options'=>$marcas,'empty'=>'Seleccione','onchange'=>'cargar_modelos_por_marca(this.value)'));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('modelo_id',array('empty'=>'Seleccione'));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('descripcion',array('style'=>'width:530px;'));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('tags',array('type'=>'text','size'=>100));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('precioPlan',array('label'=>'Precio Plan'));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('cuotaPura');
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';				
					echo $this->Form->input('cuotasCantidad',array('label'=>'Cantidad de Cuotas'));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';				
					echo $this->Form->input('cuotasPagas',array('label'=>'Cuotas Pagas'));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';				
					echo $this->Form->input('estado',array('options'=>$estados));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';				
					echo $this->Form->input('tipo',array('options'=>$tipos));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('plantipo_id',array('options'=>$plantipo));
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('reservado',array('class'=>'radio', 'id'=>'reservado'));
					echo $this->Form->input('vendido',array('class'=>'radio','id'=>'vendido'));
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('destacado');
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '</table>';
			echo $this->Form->end(__('Guardar'));
		echo '</div>';
		
		echo '<div id="link-cuotas">';
			
			echo '<div class="form-cuotas">';
				echo $this->Form->input('tipo_info',array('name'=>'data[Cuota][tipo_info]','options'=>$tipos_info,'id'=>'CuotaTipoInfo'));
				echo $this->Form->input('texto',array('name'=>'data[Cuota][texto]','id'=>'CuotaTexto'));
				echo $this->Form->input('valor',array('name'=>'data[Cuota][valor]','id'=>'CuotaValor'));
				echo '<div class="input link">'.$this->Html->link('Agregar','javascript:void(0)',array('onclick'=>'add_cuota()','div'=>array('class'=>'input link'))).'</div>';
			echo '</div>';
			
			echo '<div>';
				echo '<ul class="cuotas" id="listaCuotas">';
					
					if(!empty($cuotas)){
						foreach($cuotas as $cuota){
							echo '
							<li id="cuo_el_'.$cuota['Cuota']['id'].'" class="item-cuota">							
								<label class="texto">'.$cuota['Cuota']['texto'].' <span class="tipo">('.$cuota['Cuota']['tipos_info'].')</span></label>								
								<span class="valor">'.$cuota['Cuota']['valor'].'</span>'.
								$this->Html->link('X','javascript:void(0)',array('class'=>'eliminar','onclick'=>'delete_cuota('.$cuota['Cuota']['id'].')')).'
							</li>';
						}
					}elseif(!empty($this->request->data['Cuota']) && is_array($this->request->data['Cuota'])){
						foreach($this->request->data['Cuota'] as $cuota){
							echo '
							<li id="cuo_el_'.$cuota['id'].'" class="item-cuota">							
								<label class="texto">'.$cuota['texto'].' <span class="tipo">('.$cuota['tipos_info'].')</span></label>								
								<span class="valor">'.$cuota['valor'].'</span>'.
								$this->Html->link('X','javascript:void(0)',array('class'=>'eliminar','onclick'=>'delete_cuota('.$cuota['id'].')')).'
							</li>';
						}
					}
				echo '</ul>';
			echo '</div>';
			echo '<div class="clear"></div>';
		echo '</div>';
				
	?>
	</div>
	</fieldset>
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Planesnuevo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Planesnuevo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Planesnuevos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Modelos'), array('controller' => 'modelos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modelo'), array('controller' => 'modelos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versiones'), array('controller' => 'versiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versiones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cuotas'), array('controller' => 'cuotas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cuota'), array('controller' => 'cuotas', 'action' => 'add')); ?> </li>
	</ul>
</div>
