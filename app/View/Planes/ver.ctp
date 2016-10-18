<?php 
	echo $this->Html->script(array('jquery.prettyPhoto','thickbox-compressed','share'), array('inline'=>false));
	echo $this->Html->css(array('thickbox','prettyPhoto','jquery-ui-1.9.0.custom/jquery-ui-1.9.0.override'),'stylesheet', array('inline'=>false));
	$tipo = $plan['Plan']['tipo'];
	echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp"),"plantags"=>
	$plan['Plan']['tags'],'nombre'=>$plan['Plan']['denominacion'],'mdescription'=>$plan['Plan']['metadescription']));
	echo $this->element('form-html5-jquery');
?>
<script language="javascript">
	$(document).ready(function(){
		$(function() {
			$( ".tabs" ).tabs();
		});
		elementos = $("a[rel^='prettyPhoto']");	
		elementos.prettyPhoto();
		$('.share-button label').trigger( "click" );
	})
</script>

<div class="plans view">	
	<div class="btn-volver"><?php echo $this->Html->link('<span class="volver">Volver</span>',Controller::referer(),array('class'=>'boton','escape'=>false));?></div>
	<div class="clear"></div>	
	<div class="tab-panel">
		<?php $link_marca = $this->Html->url(array('controller'=>'planes','action'=>'nuevos',$plan['Modelo']['Marca']['id'])); ?>
		<div class="detalle-plan" itemscope itemtype="http://data-vocabulary.org/Product">
			<span itemprop="category" content="Vehículos y recambios"></span>
			<div class="top-info">
				<div class="logo_marca" id="logo_<?php echo $plan['Modelo']['Marca']['denominacion_id'];?>"><div class="img-concesionario"></div></div>
				<h2 class="plan-denominacion">
					<span itemprop="name"><?php echo $plan['Plan']['denominacion']; ?></span>
					<span class="codigo"> Código: <?php echo $plan['Plan']['codigo'];?></span>
				</h2>
				<div class="volanta">
					<span itemprop="description"><a class="link_plan" href="<?php echo $link_marca; ?>"><?php echo h($plan['Modelo']['Marca']['nombre_plan']).'</a> - Plan de ahorro '.str_replace('Plan ','',h($plan['Plantipo']['denominacion'])); ?></span><br>
					<span class="second-line"><a class="link_plan" href="<?php echo $link_marca; ?>">Plan <?php echo $plan['Modelo']['Marca']['denominacion']; ?></a> financiado en <?php echo $plan['Plan']['cuotasCantidad']; ?> cuotas en pesos sin interés</span>
				</div>
				<span itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
					<meta itemprop="currency" content="ARS"/>
					<span itemprop="condition" content="new"></span>
					<span itemprop="availability" content="in_stock"></span>
					<div class="precio">
						<span itemprop="price">
							<?php echo h( $this->Number->format($plan['Plan']['precio_visible'], 
							array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))); ?>
						</span>
						<div class="cuota-desde">Cuota desde</div>
					</div>
					<div class="cuotas-pagas"><?php echo ($plan['Plan']['tipo'] != 'Nuevo' ? 'cuota: '.h($this->Number->format($plan['Plan']['cuota_promedio'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))) : '');?></div>
				</span>
			</div>
			<div class="box-info">
			
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
						'absoluteCachePath' => WWW_ROOT,
					));				
					$thumb = Router::url('/'.$thumb);
				}
				echo $this->Html->meta(array('property'=>'og:image','content'=>$thumb),null,array('inline'=>false));
				?>
				<img style="display:none;" itemprop="image" src="<?php echo $thumb; ?>"></img>
				
				<div class="imagen-plan" style="background-image:url('<?php echo $thumb;?>');background-repeat:no-repeat;">
					<a class="link_plan info-plan" href="<?php echo $link_marca; ?>">Plan <?php echo $plan['Modelo']['Marca']['denominacion'].' '.str_replace('Plan ','',h($plan['Plantipo']['denominacion'])); ?></a>
					<?php echo ($plan['Plan']['vendido'] == 1 ? $this->Html->image('tuplanya/vendido.png',array('class'=>'vendido')) : '');?>
					<?php echo ($plan['Plan']['reservado'] == 1 ? $this->Html->image('tuplanya/reservado.png',array('class'=>'reservado')) : '');?>
					<div class="forma-pago"><?php echo nl2br($plan['Plan']['descripcion']);?></div>
				</div>
				<div id="cuotas-info" class="cuotas-info">
					<div id="div-cuotas">
						<h5>
							<span class="marca-precio"><span itemprop="brand"><?php echo $plan['Modelo']['Marca']['denominacion']; ?></span>
							<?php $valor = str_replace('.00','',$plan['Plan']['precio0km']); $valor_formatted = substr($valor,0,3).'.'.substr($valor,2,3); ?>
							- Valor 0km: $<?php echo $valor_formatted; ?></h5></span>
						<h5><?php echo h($plan['Plantipo']['denominacion']); ?> - <?php echo $plan['Plan']['cuotasCantidad']; ?> Cuotas</h5>
						<?php
						if(!empty($plan['Cuota'])){
							$i = 0;
							foreach($plan['Cuota'] as $cuota){
								echo '
								<div class="cuota-info '.($i % 2 == 0 ? 'par' : 'impar').'"><label>'.$cuota['texto'].':</label>'.
									($i==0?'<div class="valor">'.$this->Number->format($plan['Plan']['precio_visible'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.')).' </div>':'').
									'<div class="valor '.($i==0?'primero':'').'">'.$this->Number->format($cuota['valor'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.')).'</div>
								</div>';
								$i++;
							}
						}					
						?>
					</div>
					<div class='share-button' style="position: absolute; bottom: -37px; left: 70px;"></div>
                    <script>
                        var share = new Share(".share-button", {networks:{pinterest:{enabled:false },email:{enabled:false}}});
                    </script>
				</div>
				<?php echo $this->element('formulario-consulta'); ?>
				<?php echo $this->element('formulario_overlay'); ?>
			</div>
			
			<?php if($plan['Modelo']['Marca']['detalle_plan']!=''){ ?>
			<div class="marca-plan">
				<div class="logo" style="background-image: url(<?php echo $this->webroot; ?>img/tuplanya/marcas-planes/<?php echo $plan['Modelo']['Marca']['logo_plan']; ?>);">				</div>
				<div class="descripcion"><?php echo $plan['Modelo']['Marca']['detalle_plan']; ?></div>
			</div>
			<?php } ?>
			
			<div class="detalles">				
				<div class="tabs">
					<ul class="tab-menu-plan">

						<?php echo (!empty($plan['Modelo']['Foto']) ? '<li id="0"><a href="#tab-fotos"><span>'.__('Fotos',true).'</span></a></li>' : '');?>				   
						<?php echo (!empty($array_ftopciones) ? '<li id="1"><a href="#tab-ficha-tecnica"><span>'.__('Ficha Técnica',true).'</span></a></li>' : '');?> 				
						<?php echo (!empty($array_eqopciones) ? '<li id="2"><a href="#tab-equipamiento"><span>'.__('Equipamiento',true).'</span></a></li>' : '');?>
					
					</ul>
				
					
						<?php if(!empty($plan['Modelo']['Foto'])){?>
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
						<?php }?>										
					
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
														if(!empty($array_ftopciones[$element['Label']['id']])){
															echo '<li><span class="label">'.$element['Label']['denominacion'].':</span> <span class="value">'.(!empty($array_ftopciones[$element['Label']['id']]) ? $array_ftopciones[$element['Label']['id']]['Ftopcion']['denominacion'] : '-').'</span></li>';
														}
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
						?>
					
					
					
						<?php
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
													//debug($array_eqopciones[$key]);
													if($cant_elements > 1){
														$array_1 = array_slice($array_eqopciones[$key],0,round($cant_elements/2));
														$array_2 = array_slice($array_eqopciones[$key],round($cant_elements/2));
													}else{
														$array_1 = $array_eqopciones[$key];
													}
													//debug($array_1);
													//debug($array_2);
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
						}
						?>					
				</div>	
			</div>
			<div style="clear:both"></div>
		</div>
	</div>	
	<?php echo $this->element('banner-atumedida-swf')?>
</div>
<div id="conversion-code"></div>