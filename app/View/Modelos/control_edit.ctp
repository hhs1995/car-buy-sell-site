<?php echo $this->Html->script(array('jquery.prettyPhoto','thickbox-compressed'));?>
<?php echo $this->Html->css(array('thickbox','prettyPhoto'));?>
<?php //debug($this->request->data);?>
<script>
var ftopcion_id = '';

	$(document).ready(function(){
		ocultar_addVideo();
		med.init_ordenar()
		vid.init_ordenar();
		
		//load_ftopciones(<?php echo $this->request->data['Modelo']['id'];?>);
		load_eqopciones(<?php echo $this->request->data['Modelo']['id'];?>);
		
		var button = $('#boton_upload'), interval;
		new AjaxUpload(button, {
		action: '<?php echo Router::url(array('controller' => 'fotos', 'action' => 'imageAdd','control'=>false))?>',
		name: 'data[Foto][File]',
		data: { 'data[Foto][modelo_id]': <?php echo $this->request->data['Modelo']['id']?>}, 
		responseType: 'json',
		onChange: function(file, extension){
			$('#loadinglabel').show();	
		},
		onComplete: function(file, response){
			$('#loadinglabel').hide();
			button.text('Agregar Imagen');
			window.clearInterval(interval);
			
			// enable upload button
			this.enable();
			
			if (response.resultado == 'success'){
			// add file to the list
				$('#listaFotos').append('<li id="foto_el_'+response.id+'" class="item_foto"><img src="<?php echo UPLOAD_IMG_URL_MODELOS_BIG?>'+response.filename+'" />'+
				'<ul class="herramientas">'+
					'<li title="Aumentar imagen" class="ui-state-default ui-corner-all"><a href="<?php echo UPLOAD_IMG_URL_MODELOS_BIG?>'+response.filename+'" rel="prettyPhoto[<?php echo $this->request->data['Modelo']['id']?>]"><span class="ui-icon ui-icon-zoomin"></span></a></li>'+
					'<li title="Borrar" class="ui-state-default ui-corner-all"><a href = "javascript:void(0)" onclick="med.del('+response.id+',<?php echo $this->request->data['Modelo']['id']?>)" ><span class="ui-icon ui-icon-close"></span></a></li>'+
				'</ul>'+				
				'</li>');
				med.init_ordenar();
				med.grabar_orden();
			}else{
				alert ('Error al intentar agregar la imagen')
			}
			
		}

		})
		
		/*Ficha Tecnica*/
		$( "#ft_opciones" ).autocomplete({
            source: function( request, response ) {
                label_id = $('#FtopcionLabelId').val();
				$.ajax({
                    url: "<?php echo Router::url(array('controller'=>'ftopciones','action'=>'cargar_opciones_por_label','control'=>false));?>",
                    dataType: "json",					
                    data: {
                        featureClass: "P",
                        style: "full",
                        maxRows: 12,
                        name_startsWith: request.term,
						label : label_id
                    },
                    success: function( data ) {
                        response( $.map( data, function( item ) {
                            return {
                                label: item.label,
                                id: item.value
                            }
                        }));
                    }
                });
            },
            minLength: 1,
			select: function( event, ui ) {
				$('#ftopcion_id').val(ui.item.id);
				$('#ft_opciones').val(ui.item.label);
            },
            
        });		
		/*Fin Ficha Tecnica*/

	});
	
	/*FOTOS - IMAGENES*/
	var med = {

		del : function(id, element_id)
			{
				if(confirm('Seguro que desea eliminar esta foto?')){
					params = new Object();
					params = { 'data[Foto][id]' : id, 'data[Foto][modelo_id]' : element_id}
					url = '<?php echo Router::url(array('controller' => 'fotos', 'action' => 'mediaDelete','control'=>false))?>',
					$.post(url, params, function(data){
						//alert('Imagen borrada');
						$('#foto_el_'+data.id).remove();
						med.grabar_orden();
						
					}, 'json');	
				}
			},
		init_ordenar: function(){
			$("#listaFotos").sortable({
				placeholder: 'ui-state-highlight',
				update : function(event, ui){med.grabar_orden(event, ui)}
			});
			$("#listaFotos").disableSelection();

			$("#listaFotos li.item_foto img").hover(
			function(){
				$(this).addClass('hover')
			}, 
			function(){
				$(this).removeClass('hover')
			});
			
			$("#listaFotos li.item_foto").hover(
			function(){
				$('.herramientas', $(this)).show('fast')
			}, 
			function(){
				$('.herramientas', $(this)).hide('fast')
			});
			elementos = $("a[rel^='prettyPhoto']");
			//alert(elementos.length)
			$('.ppt').remove();
			//$("a[rel^='prettyPhoto']").prettyPhoto();
			$(elementos).prettyPhoto();
		},
		grabar_orden: function(event, ui){
			var imagenes = $("#listaFotos").sortable('toArray');
			params = {}
			params.modelo = <?php echo $this->request->data['Modelo']['id']?>;
			params.imagenes = imagenes.join(',');
			
			url = '<?php echo Router::url(array('controller' => 'fotos', 'action' => 'grabarOrden','control'=>false))?>',
			$.post(url, params, function(data){
			}, 'json');	
		}

	}
	
	/*VIDEOS*/
	var vid = {
		del: function(id, modelo_id)
		{
			params = new Object();
			params = { 'data[Video][id]' : id, 'data[Video][modelo_id]' : modelo_id,}
			url = '<?php echo Router::url(array('controller' => 'videos', 'action' => 'videoDelete','control'=>false))?>'
			if(confirm('Seguro que desea eliminar este video?'))
			{
				$.post(url, params, function(data){
					$('#vid_el_'+data.id).remove();
					vid.grabar_orden();
				}, 'json');	
			}
		},
		save_text: function(id, lang){
				
				params = new Object();
				var text = $('#'+lang+'_photo_texto_'+id).val();
				params = { 'data[Video][id]' : id, 'data[Video][text]' : text}
				url = '<?php echo Router::url(array('controller' => 'videos', 'action' => 'videoEdit','control'=>false))?>'
				$.post(url, params, function(data){
					$('#saved').queue(function(){
						setTimeout(function(){
							$('#saved').dequeue();
						}, 1);
					});
					$('#saved').fadeIn("slow");
					$('#saved').queue(function(){
						setTimeout(function(){
							$('#saved').dequeue();
						}, 2000);
					});
					$('#saved').fadeOut("slow");
				}, 'json');	
			
		
		},
		init_ordenar: function(){
			$("#listaVideos").sortable({
				placeholder: 'ui-state-highlight',
				update : function(event, ui){vid.grabar_orden(event, ui)}
			});
			$("#listaVideos").disableSelection();
			$("#listaVideos li").hover(
			function(){
				$(this).addClass('hover')
			}, 
			function(){
				$(this).removeClass('hover')
			});
			//console.log($("#listaVideos"));
			//elementos = $("a[rel^='prettyPhoto']")
			//alert(elementos.length)
			//$("a[rel^='prettyPhoto']").prettyPhoto();
		},
		grabar_orden: function(event, ui){
			var videos = $("#listaVideos").sortable('toArray');
			//alert(imagenes)
			params = {}
			params.modelo = <?php echo $this->request->data['Modelo']['id'];?>;
			params.videos = videos.join(',');
			
			url = '<?php echo Router::url(array('controller' => 'videos', 'action' => 'grabarOrden','control'=>false))?>',
			$.post(url, params, function(data){
			}, 'json');	
		}

	}
	
	function add_video(id){

		//alert('hola')
		$('.loading-icon').show();
		var url_video = $('#url_video').val();
		var texto = $('#texto_video').val();
		params = {'id' : id, 'url_video' : url_video, 'texto_video' : texto};
		url = '<?php echo Router::url(array('controller' => 'videos', 'action' => 'addVideo','control'=>false));?>' 
		$.post(url, params, function(data){
			//alert(data);
			if(data.resultado == 'Exito')
			{
				alert('El video se ha insertado con exito')
				$('#listaVideos').append(data.mensaje)
			}else{
				alert(data.mensaje)
			}
			$('.loading-icon').hide();
		},'json');
		$('#url_video').val('');
		$('#texto_video').val('');
	}

	function mostrar_addVideo(){
		$('#form_addVideo').show();
	}

	function ocultar_addVideo(){
		$('#form_addVideo').hide();
	}

	function eliminar_video(id){
		if(confirm('Seguro que desea eliminar este deportista?'))
		{
			params = {'id' : id};
			url = '<?php echo Router::url(array('controller' => 'videos', 'action' => 'videoDelete','control'=>false))?>' 
			$.post(url, params, function(data){
				
			},'json');
		}

	}
	
	function cargar_labels_por_categoria(categoria_id, selectedValue){
		
		/*Agarro los IDS de los labels que ya fueron utilizados*/
		str_ids = '';
		cant_labels = ($('.ficha_tecnica_opciones li').length);
		i = 0;
		$('.ficha_tecnica_opciones li').each(function(){			
			i = i*1+1;
			var clase = ($(this).attr('class'));
			array_label = clase.split('_');
			if(i < cant_labels){
				str_ids += array_label[1]+','; 
			}else{
				str_ids += array_label[1];
			}
			
			
		});				
		
		url = '<?php echo Router::url(array('controller'=>'labels','action'=>'cargarLabelsPorCategoria','control'=>false));?>';
		params = {'data[Label][categoria_id]' : categoria_id, 'data[Label][ids]' : str_ids}
		$.post(url, params, function(data){
			buffer_combo = '';
			$.each(data, function(index, value){
				if(index == selectedValue){
					buffer_combo += '<option value='+index+' selected>'+value+'</option>'; 
				}else{
					buffer_combo += '<option value='+index+'>'+value+'</option>'; 
				}
			})
			$('#FtopcionLabelId').html(buffer_combo);			

		},'json')
	}
	
	function modelosftopciones(){
		
		/*Agarro los valores*/
		var cadena = $('#ft_opciones').val();		
		var modelo_id = $('#ModeloId').val();
		var ftopcion_id = $('#ftopcion_id').val();
		var label_id = $('#FtopcionLabelId option:selected').val();		
		
		if(cadena != '' && (typeof label_id != 'undefined' || label_id != '')){					
			/*Si viene sin valor, agrego la opcion a ftopciones*/			
			if(ftopcion_id == ''){				
				url = '<?php echo Router::url(array('controller'=>'ftopciones','action'=>'agregar_ftopcion_ajax','control'=>false));?>';
				params = {'data[Ftopcion][label_id]' : label_id, 'data[Ftopcion][denominacion]' : cadena}
				$.post(url, params, function(data){
					if(data.resultado == 1){
						agregar_modelosftopcion(modelo_id, data.id);
					}else{
						alert('No se ha podido agregar correctamente. Intente nuevamente mas tarde');
					}
				},'json');
				
			}else{
				
				agregar_modelosftopcion(modelo_id, ftopcion_id);
			}

		/*Vacio los campos*/
		$('#ft_opciones').val('');
		$('#ftopcion_id').val('');
		
		}else{
			alert('Debe completar el campo denominacion');
		}
	}
	
	function agregar_modeloseqopciones(){
		
		/*Agarro los valores*/
		modelo_id = $('#ModeloId').val();
		/*Mando todas las eqopciones separadas por ","*/
		var str_eqopciones = '';
		var i = 0;
		var cant = $("#link-equipamiento .checkbox input:checked").length;
		console.log(cant);
		$('#link-equipamiento .checkbox input').each(function(index) {
			if($(this).attr('checked') == true){
				i = i*1+1;
				if(i < cant){
					str_eqopciones += $(this).val()+',';
				}else{
					str_eqopciones += $(this).val();
				}
			}			
		});		
		
		url = '<?php echo Router::url(array('controller'=>'modeloseqopciones','action'=>'agregar_eqopcion_ajax','control'=>false));?>';
		params = {'data[Modeloseqopcion][modelo_id]' : modelo_id, 'data[Modeloseqopcion][eqopciones]' : str_eqopciones}
		
		/*Hago un Post por ajax para agregar la eqopcion*/
		$.post(url, params, function(data){
			if(data.resultado == 1){
				alert('Se ha grabado exitosamente');
			}else{
				alert('No se ha podido agregar la característica');
			}
		},'json');
	}
	
	function delete_modelosftopcion(modelosftopcion_id){
		if(confirm('Seguro que desea eliminar esta caracteristica #'+modelosftopcion_id+'?')){
			url = '<?php echo Router::url(array('controller'=>'modelosftopciones','action'=>'delete','control'=>false));?>';
			params = {'data[Modelosftopcion][id]' : modelosftopcion_id}
			$.post(url, params, function(data){
				$('#ftopcion_'+modelosftopcion_id).remove();
			},'json')
		}	
	}
	
	function load_ftopciones(modelo_id){
		url = '<?php echo Router::url(array('controller'=>'modelosftopciones','action'=>'load_ftopciones','control'=>false));?>';
			params = {'data[Modelosftopcion][modelo_id]' : modelo_id}
			$.post(url, params, function(data){
				
			},'json')
	}
	
	function load_eqopciones(modelo_id){		
		<?php if(!empty($modeloseqopciones)){ ?>
			<?php foreach($modeloseqopciones as $element){?>
				document.getElementById('Eqopciones<?php echo $element['Modeloseqopcion']['eqopcion_id'];?>').checked = 1;
			<?php } ?>
		<?php } ?>
	}
	
	function agregar_modelosftopcion(modelo_id, ftopcion_id){
		url = '<?php echo Router::url(array('controller'=>'modelosftopciones','action'=>'agregar_ftopcion_ajax','control'=>false));?>';
		params = {'data[Modelosftopcion][modelo_id]' : modelo_id, 'data[Modelosftopcion][ftopcion_id]' : ftopcion_id}
		
		/*Hago un Post por ajax para agregar la ftopcion*/
		$.post(url, params, function(data){
			if(data.resultado == 1){
				$('#categoria_'+data.opcion['Label']['categoria_id']+' ul').append('<li id="ftopcion_'+data.id+'" class="label_'+data.opcion['Label']['id']+'"><span class="label">'+data.opcion['Label']['denominacion']+'</span>: <span class="value">'+data.opcion['Ftopcion']['denominacion']+'</span><a class="eliminar" onclick="delete_modelosftopcion('+data.id+')" href="javascript:void(0)">X</a></li>');
				$('#FtopcionLabelId option:selected').remove();
			}else{
				alert('No se ha podido agregar la característica');
			}
		},'json');
	}

	function AddLabel(){
		if($('#FtopcionNewLabel').val()!='' && $('#categorias').val()!=''){
			url = '<?php echo Router::url(array('controller'=>'labels','action'=>'AddLabel','control'=>false));?>';
			params = {'data[Label][denominacion]' : $('#FtopcionNewLabel').val(), 'data[Label][categoria_id]' :$('#categorias').val()}

			$.post(url, params, function(data){
				if(data.resultado == 1){
					cargar_labels_por_categoria($('#categorias').val());
					$('#FtopcionNewLabel').val('');
				}else{
					alert('No se ha podido agregar la característica');
				}
			},'json');
		}
	}
	
	function AddEquipment(category_id){
		if($('#new_equipment-'+category_id).val()!=''){
			url = '<?php echo Router::url(array('controller'=>'modelos','action'=>'AddCategoriaEquipamiento','control'=>false));?>';
			params = {'data[Eqopcion][denominacion]' : $('#new_equipment-'+category_id).val(), 'data[Eqopcion][categoria_id]' : category_id}

			$.post(url, params, function(data){
				if(data.resultado == 1){
					$('#categoria_'+category_id+' ul').append('<li id="eqopcion_'+data.id+'"><div class="checkbox"><input id="Eqopciones'+data.id+
					'" class="ui-corner-all" type="checkbox" value="'+data.id+'" name="data[eqopciones][]"><label for="Eqopciones'+data.id+'">'
					+$('#new_equipment-'+category_id).val()+'</label></div></li>');
					$('#new_equipment-'+category_id).val('');
				}else{
					alert('No se ha podido agregar la característica');
				}
			},'json');
		}
	}
	
</script>
<div class="modelos form">
<?php echo $this->Form->create('Modelo',array('type'=>'file')); ?>
	
	<fieldset>
		<legend><?php echo __('Control Agregar Modelo'); ?></legend>
		
		 <div class="tabs">
			<ul>
				<li id="0"><a href="#link-info"><span><?php echo __('Info',true); ?></span></a></li>
			   
				<li id="1"><a href="#link-imagenes"><span><?php echo __('Imagenes',true); ?></span></a></li> 
				
				<li id="2"><a href="#link-videos"><span><?php echo __('Videos',true); ?></span></a></li>
				
				<li id="3"><a href="#link-ficha-tecnica"><span><?php echo __('Ficha Técnica',true); ?></span></a></li>
			
				<li id="4"><a href="#link-equipamiento"><span><?php echo __('Equipamiento',true); ?></span></a></li>
			</ul>
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
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('marca_id');		
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('segmento_id',array('options'=>$segmentos,'empty'=>'Seleccione'));		
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('precio0km');
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('link_info',array('size'=>100));		
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr class="rows">';
				echo '<td colspan="2" class="cell cell_1">';
					echo $this->Form->input('imagen',array('type'=>'file'));		
					echo $this->Form->input('imagen',array('type'=>'hidden'));							
					echo $this->Form->input('imagen_anterior',array('type'=>'hidden','value'=>(!empty($this->request->data['Modelo']['imagen_anterior']) ? $this->request->data['Modelo']['imagen_anterior'] : '')));							
					echo '<div class="preview_image"><img src="'.UPLOAD_IMG_URL_MODELOS_PRINCIPAL.(!empty($this->request->data['Modelo']['imagen']) ? $this->request->data['Modelo']['imagen'] : $this->request->data['Modelo']['imagen_anterior']).'"></div>';
					echo '&nbsp;';
				echo '</td>';
			echo '</tr>';
			
		echo '</table>';
		echo $this->Form->end(__('Guardar'));
	echo '</div>';	
	?>
	
		<div id="link-imagenes">
			<div id="Fotos">
				<div class="actions">
					<ul>
						<li>
							<a href="javascript:void(0)" id="boton_upload" >Agregar Imagen</a>
							<div id="loadinglabel">
								<span>Loading...</span>								
							</div>
							
						</li>
					</ul>
				</div>
				<br>
				<ul id="listaFotos">
					<?php
					if (isset($this->request->data['Foto']) and is_array($this->request->data['Foto'])):
						foreach($this->request->data['Foto'] as $media):
								echo '<li id="foto_el_'.$media['id'].'" class="item_foto">
								<img src="'.UPLOAD_IMG_URL_MODELOS_BIG.$media['archivo'].'" />
								<ul class="herramientas">
									<li title="Aumentar a imagem" class="ui-state-default ui-corner-all"><a href="'.UPLOAD_IMG_URL_MODELOS_BIG.$media['archivo'].'" rel="prettyPhoto['.$this->request->data['Modelo']['id'].']"><span class="ui-icon ui-icon-zoomin"></span></a></li>
									<li title="Borrar" class="ui-state-default ui-corner-all"><a href = "javascript:void(0)" onclick="med.del('.$media['id'].','.$this->request->data['Modelo']['id'].')" ><span class="ui-icon ui-icon-close"></span></a></li>
								</ul>							
								</li>';
						endforeach;						
					endif;
					?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		
		<div id="link-videos">
		<?php 
			echo '
			<div id="Videos">	
				<div class="actions">
					<ul>
						<li>
							<a href="javascript: void(0)" onclick="mostrar_addVideo()" id="boton_upload_video">Agregar video</a>
						</li>
					</ul>
				</div>';
				echo '<div id="form_addVideo">';
					echo $this->Form->input('youtube video', array('id' => 'url_video','size'=>50));
					echo '<a href="javascript: void(0)" onclick="add_video('.$this->request->data['Modelo']['id'].')" id="boton_upload_video">Guardar</a>';
					echo '<div class="loading-icon"></div>';
				echo '</div>';
				
				if(isset($this->request->data['Video']) && is_array($this->request->data['Video'])){
					echo '<ul id="listaVideos">';
						foreach($this->request->data['Video'] as $video){			
							echo '<li id="vid_el_'.$video['id'].'" class="item_video">';
							echo '<div id="img_video">'.$this->element('youtube_image',array('url_video'=> $video['archivo'], 'height'=> 150, 'width'=>150, 'nro_servidor' => 1));
							echo '
							<ul class="herramientas">								
								<li title="Borrar" class="ui-state-default ui-corner-all"><a href = "javascript:void(0)" onclick="vid.del('.$video['id'].','.$this->request->data['Modelo']['id'].')" ><span class="ui-icon ui-icon-close"></span></a></li>
							</ul>						
											
							</li>';
						}					
					echo '</ul>';
				}
			echo '</div>';
			
		echo '</div>';
	
	echo '<div id="link-ficha-tecnica">';
			echo $this->Form->create('Ftopcion');
				echo $this->Form->input('categoria_id',array('type'=>'select','empty'=>'Seleccione','options'=>$ft_categorias,'onchange'=>'cargar_labels_por_categoria(this.value)','id'=>'categorias'));
				echo $this->Form->input('label_id',array('label'=>'Caracteristica','type'=>'select','empty'=>'Seleccione una categoría','multiple'=>true,'div'=>array('class'=>'input select multiple')));
				
				echo '<div class="new_label">';
					echo $this->Form->input('new_label',array('label'=>''));
					echo $this->Html->link('Agregar','javascript:void(0)',array('onClick'=>'AddLabel();'));
				echo '</div>';
				
				echo $this->Form->input('denominacion',array('type'=>'text','id'=>'ft_opciones','label'=>'Valor'));
				echo '<div class="input link">'.$this->Html->link('Agregar','javascript:void(0)',array('onclick'=>'modelosftopciones()')).'</div>';
				echo $this->Form->hidden('ftopcion_id',array('id'=>'ftopcion_id'));
			echo $this->Form->end();
			
			echo '<div class="clear"></div>';
			
			if(!empty($ft_categorias)){
				echo '<div class="caracteristicas">';
					foreach($ft_categorias as $key => $value){
						echo '<div class="columna" id="categoria_'.$key.'">';
							echo '<label>'.$value.'</label>';
							echo '<ul class="ficha_tecnica_opciones">';
								if(!empty($array_ftopciones[$key])){
									foreach($array_ftopciones[$key] as $element){
										echo '<li id="ftopcion_'.$element['Modelosftopcion']['id'].'" class="label_'.$element['Ftopcion']['Label']['id'].'"><span class="label">'.$element['Ftopcion']['Label']['denominacion'].'</span>: <span class="value">'.$element['Ftopcion']['denominacion'].'</span><a class="eliminar" onclick="delete_modelosftopcion('.$element['Modelosftopcion']['id'].')" href="javascript:void(0)">X</a></li>';
									}
								}
							echo '</ul>';
						echo '</div>';
					}	
				echo '</div>';
				echo '<div class="clear"></div>';
			}
				
				
			echo '</div>';
	
	echo '<div id="link-equipamiento">';
		if(!empty($eq_categorias)){
			echo '<div class="caracteristicas">';
				foreach($eq_categorias as $key => $value){
					echo '<div class="columna" id="categoria_'.$key.'">';
						echo '<label>'.$value.'</label>';
						echo '<ul>';
							if(!empty($array_eqopciones[$key])){
								foreach($array_eqopciones[$key] as $element){
									echo '
									<li id="eqopcion_'.$element['Eqopcion']['id'].'">
										<div class="checkbox">
											<input id="Eqopciones'.$element['Eqopcion']['id'].'" class="ui-corner-all" type="checkbox" value="'.$element['Eqopcion']['id'].'" name="data[eqopciones][]">
											<label for="Eqopciones'.$element['Eqopcion']['id'].'">'.$element['Eqopcion']['denominacion'].'</label>
										</div>
									</li>';
								}
							}
						echo '</ul>';
						echo '<div class="new_eq">';
							echo $this->Form->input('new_equipment-'.$key,array('label'=>''));
							echo $this->Html->link('Agregar','javascript:void(0)',array('onClick'=>'AddEquipment('.$key.');'));
						echo '</div>';
					echo '</div>';
				}	
			echo '</div>';
			echo '<div class="clear"></div>';
		}
		echo '<div class="input link">'.$this->Html->link('Guardar','javascript:void(0)',array('onclick'=>'agregar_modeloseqopciones()')).'</div>';
	echo '</div>';
	?>
	</div>	
	</fieldset>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Versiones'), array('action' => 'index')); ?></li>
	</ul>
</div>