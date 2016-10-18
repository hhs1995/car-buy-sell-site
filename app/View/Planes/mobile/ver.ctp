<?php 
	echo $this->Html->script(array('jquery.prettyPhoto','thickbox-compressed','share'), array('inline'=>false));
	echo $this->Html->css(array('thickbox','prettyPhoto','jquery-ui-1.9.0.custom/jquery-ui-1.9.0.override'),'stylesheet', array('inline'=>false));
	$tipo = $plan['Plan']['tipo'];
	echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp"),"plantags"=>
	$plan['Plan']['tags'],'nombre'=>$plan['Plan']['denominacion'],'mdescription'=>$plan['Plan']['metadescription']));
	echo $this->element('form-html5-jquery');
?>
<script language="javascript">
	var showingConsulta = false;

	$(document).ready(function(){
		$(function() {
			$( ".tabs" ).tabs();
		});
		elementos = $("a[rel^='prettyPhoto']");	
		elementos.prettyPhoto();
		$('.share-button label').trigger( "click" );
	})

	function enviar_consulta(){
		
		$('#response').hide();
		$('.fields-container').hide();
		$('.preloader-ajax-contacto').show();

		var nombre_apellido = $('#nombre_apellido').val();
		var email = $('#email').val();
		var provincia_id = $('#provincia_id').val();
		var telefono = $('#telefono').val();
		var comentarios = $('#comentarios').val();
		var plan_id = $('#plan_id').val();
		var tipo = $('#tipo').val();
		
		url = '<?php echo Router::url(array('controller'=>'planes','action'=>'enviar_consulta'));?>';
		params = {
			'data[Contacto][nombre_apellido]' : nombre_apellido,
			'data[Contacto][email]' : email,
			'data[Contacto][provincia_id]' : provincia_id,
			'data[Contacto][telefono]' : telefono,
			'data[Contacto][comentarios]' : comentarios,
			'data[Contacto][plan_id]' : plan_id,
			'data[Contacto][tipo]' : tipo,
		}
		$.post(url, params, function(data){
			$('.preloader-ajax-contacto').hide();
			$('.mensaje-contacto').html(data);
			$('.mensaje-contacto').show();
			$('#conversion-code').html(
				'<iframe style="display: none;" src="<?php echo $this->Html->url(array('controller'=>'app','action'=>'conversion',strtolower($plan['Plan']['tipo']))); ?>"/>'
			);
		});
		return false;
	}
	
	function ShowForm(){
		if(!showingConsulta){
			$('.formulario-consulta').animate({left: '22vw'},500);
			$('.btn-contacto').animate({right: '77vw'},500);
			showingConsulta = true;
		}else{
			$('.formulario-consulta').animate({left: '100vw'},500);
			$('.btn-contacto').animate({right: '0vw'},500);
			showingConsulta = false;
		}
	}
</script>

<?php echo $this->Html->link('','javascript:void(0);',array('class'=>'btn-contacto','onClick'=>'ShowForm();')); ?>

<div class="plan">

	<h2 class="denominacion">
		<span class="nombre"><?php echo $plan['Plan']['denominacion']; ?></span>
		<span class="codigo"> Código: <?php echo $plan['Plan']['codigo']; ?></span>
	</h2>
	
	<div class="volanta">
		<?php echo h($plan['Modelo']['Marca']['nombre_plan']).' - '.h($plan['Plantipo']['denominacion']).'<br>'; ?>
		<?php echo 'Financiado en '.$plan['Plan']['cuotasCantidad'].' cuotas en pesos'; ?>
	</div>
	
	<div class="box">
		<?php
		$thumb = '';
		if(!empty($plan['Modelo']['imagen'])){
			$thumb = $this->Thumbnail->render($plan['Modelo']['imagen'], array(
				'path' => UPLOAD_IMG_PATH_MODELOS_PRINCIPAL,
				'cachePath' => UPLOAD_IMG_HELPER_CACHE.'principal',
				'newWidth' => 415,
				'newHeight' => 315,
				'resizeOption'=>'crop',
				'quality' => '90',
				'absoluteCachePath' => WWW_ROOT
			));				
			$thumb = Router::url('/'.$thumb);
		}
		?>
		<div class="imagen" style="background-image:url('<?php echo $thumb;?>');background-repeat:no-repeat;">
			<div class="logo_marca" id="logo_<?php echo $plan['Modelo']['Marca']['denominacion_id'];?>"><div class="img-concesionario"></div></div>
			<div class="precio">
				<div class="cuota-desde">Cuota desde: </div>
				<span>
					<?php echo h( $this->Number->format($plan['Plan']['precio_visible'], 
					array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))); ?>
				</span>
				<div class="cuotas-pagas"><?php echo ($plan['Plan']['tipo'] != 'Nuevo' ? 'cuota: '.h($this->Number->format($plan['Plan']['cuota_promedio'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))) : '');?></div>
			</div>
			<div class="descripcion"><?php echo nl2br($plan['Plan']['descripcion']);?></div>
		</div>
		<div id="cuotas-info" class="cuotas-info">
			<h5><?php echo h($plan['Plantipo']['denominacion']); ?> - 84 Cuotas</h5>
			<?php
			if(!empty($plan['Cuota'])){
				$i = 0;
				foreach($plan['Cuota'] as $cuota){
					echo '
					<div class="cuota-info '.($i % 2 == 0 ? 'par' : 'impar').'"><label>'.$cuota['texto'].':</label><div class="valor">'.$this->Number->format($cuota['valor'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.')).'</div></div>';
					$i++;
				}
			}					
			?>
		</div>
	</div>
	
	<div class="box">
		<div class="logo" style="background-image: url(<?php echo $this->webroot.'/img/tuplanya/marcas-planes/'.$plan['Modelo']['Marca']['logo_plan']; ?>);">
			<div class="nombre"><?php //echo $plan['Modelo']['Marca']['nombre_plan']; ?></div>
		</div>
		<div class="descripcion"><?php echo $plan['Modelo']['Marca']['detalle_plan']; ?></div>
	</div>
	
	<div class="detalles">				
		<ul class="tab-menu-plan">
			<?php echo (!empty($plan['Modelo']['Foto']) ? '<li id="0"><a href="#tab-fotos"><span>'.__('Fotos',true).'</span></a></li>' : '');?>				   
			<?php echo (!empty($array_ftopciones) ? '<li id="1"><a href="#tab-ficha-tecnica"><span>'.__('Ficha Técnica',true).'</span></a></li>' : '');?> 				
			<?php echo (!empty($array_eqopciones) ? '<li id="2"><a href="#tab-equipamiento"><span>'.__('Equipamiento',true).'</span></a></li>' : '');?>
		</ul>
		<?php if(!empty($plan['Modelo']['Foto'])){ ?>
			<div id="tab-fotos">
				<ul class="fotos">
						<?php 
						$i = 0;
						foreach($plan['Modelo']['Foto'] as $foto){
							$i++;
							$thumb_galeria = '';
							if(!empty($foto['archivo'])){
							$thumb_galeria = $this->Thumbnail->render($foto['archivo'], array(
							  'path' => UPLOAD_IMG_PATH_MODELOS_BIG,
								  'cachePath' => UPLOAD_IMG_HELPER_CACHE.'big',
							  'newWidth' => 200,
							  'newHeight' => 150,
							  'resizeOption'=>'crop',
							  'quality' => '100',
							  'absoluteCachePath' => WWW_ROOT,
							));
							$thumb_galeria = Router::url('/'.$thumb_galeria);
							}
							echo '
							<li class="item-foto'.($i%4 == 0 ? ' last' : '').'">
								<a href="'.UPLOAD_IMG_URL_MODELOS_BIG.$foto['archivo'].'" rel="prettyPhoto['.$plan['Modelo']['id'].']">
								<span class="imagen" style="background:url('.$thumb_galeria.');background-repeat:no-repeat;"></span></a>
							</li>
							';
						}
						?>							
				</ul>
			</div>
			<div class="clear"></div>
		<?php } ?>
		<?php 
		if(!empty($array_ftopciones)){
			echo '<div id="tab-ficha-tecnica">';
			if(!empty($ft_categorias)){
				echo '<div class="caracteristicas">';
				foreach($ft_categorias as $key => $value){
					echo '<div class="columna" id="categoria_'.$key.'">';
					echo '<label class="title">'.$value.'</label>';
					echo '<ul>';
					if(!empty($array_labels[$key])){
						foreach($array_labels[$key] as $element){
							echo '<li><span class="label">'.$element['Label']['denominacion'].':</span> <span class="value">'.(!empty($array_ftopciones[$element['Label']['id']]) ? $array_ftopciones[$element['Label']['id']]['Ftopcion']['denominacion'] : '-').'</span></li>';
						}
					}
					echo '</ul>';
					echo '</div>';
				}	
				echo '</div>';
				echo '<div class="clear"></div>';
			}						
			echo '</div>';
		}
		if(!empty($array_eqopciones)){
			echo '<div id="tab-equipamiento">';
			if(!empty($eq_categorias)){
				echo '<div class="caracteristicas">';
				foreach($eq_categorias as $key => $value){
					$array_1 = array();
					$array_2 = array();
					echo '<div class="categoria" id="categoria_'.$key.'">';
						echo '<label class="title">'.$value.'</label>';										
							if(!empty($array_eqopciones[$key])){
								$cant_elements = count($array_eqopciones[$key]);
								if($cant_elements > 1){
									$array_1 = array_slice($array_eqopciones[$key],0,round($cant_elements/2));
									$array_2 = array_slice($array_eqopciones[$key],round($cant_elements/2));
								}else{
									$array_1 = $array_eqopciones[$key];
								}
								if(!empty($array_1)){
									echo '<ul class="col-1 columna">';
									foreach($array_1 as $element){													
										echo '
										<li>
											<span class="value">'.$element['Eqopcion']['denominacion'].'</span>
										</li>';
									}
									echo '</ul>';													
								}
								
								if(!empty($array_2)){
									echo '<ul class="col-2 columna">';
									foreach($array_2 as $element){													
										echo '
										<li>
											<span class="value">'.$element['Eqopcion']['denominacion'].'</span>
										</li>';
									}
									echo '</ul>';
								}
								echo '<div class="clear"></div>';
							}
						echo '</ul>';
					echo '</div>';
				}	
				echo '</div>';
				echo '<div class="clear"></div>';
			}
			echo '</div>';
		} ?>
	</div>
	
	<div class="formulario-consulta">
		<h5>Formulario de consulta</h5>
		<?php 
		echo $this->Form->create('contacto',array('onsubmit'=>'enviar_consulta();return false;','id'=>'FormContacto'));
		echo '<div class="mensaje-contacto"></div>';
		echo '<div class="fields-container">';
			echo $this->Form->input('nombre_apellido', array('label'=>false,'placeholder'=>'Apellido y nombre *','required'=>true,'id'=>'nombre_apellido'));
			echo $this->Form->input('email', array('label'=>false, 'type'=>'email', 'placeholder'=>'Email *', 'required'=>true,'id'=>'email'));
			echo $this->Form->input('provincia_id', array('label'=>false, 'options'=>$provincias, 'required'=>true,'id'=>'provincia_id'));
			echo $this->Form->input('telefono', array('label'=>false, 'type'=>'text', 'placeholder'=>'Télefono *', 'required'=>true,'id'=>'telefono') );
			echo $this->Form->input('comentarios', array('label'=>false, 'type'=>'textarea', 'placeholder'=>'Comentarios *', 'required'=>true,'id'=>'comentarios'));
			echo $this->Form->input('plan_id', array('label'=>false, 'type'=>'hidden', 'value'=>$plan['Plan']['id'],'id'=>'plan_id'));
			echo $this->Form->input('tipo', array('label'=>false, 'type'=>'hidden', 'value'=>'Consulta Plan','id'=>'tipo'));
			echo $this->Form->submit(__('Consultar'));
		echo '</div>';
		echo '<div class="preloader-ajax-contacto" style="margin:110px auto"></div>';
		echo $this->Form->end(); ?>
	</div>
</div>
<div id="conversion-code"></div>