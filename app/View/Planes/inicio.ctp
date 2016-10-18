<?php
	echo $this->Html->css(array('coin-slider', null, array('inline'=>false)));
	echo $this->Html->script(array('coin-slider', array('inline'=>false))); 
?>
<?php echo $this->element('setmetatags',array("pagename" => basename(__FILE__, ".ctp"))); ?>

<script language="javascript">

	$(document).ready(function(){
		$('#tab-destacado-nuevos').show();
		$('.item').hover(
			function () {
				$(this).addClass("hover");
			},
			function () {
				$(this).removeClass("hover");
			}
		);
		$("SELECT").selectBox()
	})

	function verTab(tipo){
		$('.tab-menu a').removeClass('actual');
		
		/*Ver Mas Link*/
		var array_tipos = new Array();
		array_tipos['comenzados'] = '199px';
		array_tipos['adjudicados'] = '196px';
		array_tipos['nuevos'] = '164px';	
		$('.tipo-plan').html(tipo);
		$('.ver-mas').css('width',array_tipos[tipo]);
		
		/*Armo la URL cuando paso de pestaña*/
		var link = $('.ver-mas').attr('href');	
		var array_params_link = link.split('/');
		var url = '';
		
		for(var i=0;i < array_params_link.length-1;i++){	
			url += array_params_link[i]+'/'; 
		}
		
		url += tipo;	
		$('.ver-mas').attr('href',url);
		
		$('#tab-'+tipo).addClass('actual');
		$('.tab-destacado').hide();
		$('#tab-destacado-'+tipo).show();
		
		/*Muestro la descripcion correspondiente*/
		$('.descripciones .texto').hide();
		$('.descripciones .'+tipo).show();
	}
</script>

<div id="pagina-inicio">

	<p style="position:relative;top:-7px;">Compra, venta y canje de planes de ahorro nuevos, comenzados y adjudicados.</p>

		<div id="slider-ppal">
			<div id="coin-slider">
			<a href="/plan-de-ahorro/71-peugeot-308-active-n">
				<?php echo $this->Html->image("tuplanya/slider-home/img-home-208.jpg");?>
				<span>
				<p class="logo">home-destacado-logo-peugeot.png</p>
				<strong class="title">Nuevo 308</strong><br>
				<b class="subtitle">Plan 70/30. Cuotas desde</b>
				<strong class="price">$1.959</strong>
				<b class="description"><!-- Inmovilizador de motor. Vidrios delanteros manuales. Aire acondicionado. 4 parlantes --></b>
				</span>
			</a>

			<a href="/plan-de-ahorro/26-ford-ecosport-s-1-6l">
				<?php echo $this->Html->image("tuplanya/slider-home/img-home-ecosport.jpg");?>
				<span>
				<p class="logo">home-destacado-logo-ford.png</p>
				<strong class="title">Nueva Ecosport</strong>
				<b class="subtitle">Plan 100%. Cuotas desde</b>
				<strong class="price">$1.627</strong>
				<b class="description"><!-- Inmovilizador de motor. Vidrios delanteros manuales. Aire acondicionado. 4 parlantes --></b>
				</span>
			</a>
				
			<a href="/plan-de-ahorro/91-amarok-startline">
				<?php echo $this->Html->image("tuplanya/slider-home/img-home-amarok.jpg");?>
				<span>
				<p class="logo">home-destacado-logo-volkswagen.png</p>
				<strong class="title">Nueva Amarok</strong>
				<b class="subtitle">Plan 70/30. Cuotas desde</b>
				<strong class="price">$2.831</strong>
				<b class="description"><!-- Inmovilizador de motor. Vidrios delanteros manuales. Aire acondicionado. 4 parlantes --></b>
				</span>
			</a>
				
			<a href="/planes-de-ahorro/nuevos"><?php echo $this->Html->image("tuplanya/slider-home/img-home-comofunciona.jpg"); ?></a>
			</div>
		</div>
	
	<?php echo $this->element('listado-planes-menu-marcas-inicio', array('accion'=>'nuevos'));?>		
	
	<div class="destacados">
	
		<?php echo $this->Html->link('Ver más', array('controller' => 'planes', 'action' => 'nuevos'), array('class'=>'ver-mas','escape'=>false)); ?>
		
		<ul class="tab-menu">
			<li><?php echo $this->Html->link(__('Planes Nuevos'), 'javascript:void(0)', array('onclick'=>'verTab("nuevos")','title'=>'Planes de ahorro automotor nuevos','id'=>'tab-nuevos','class'=> 'actual',)); ?></li>
			<li><?php echo $this->Html->link(__('Planes Adjudicados'), 'javascript:void(0)', array('onclick'=>'verTab("adjudicados")','title'=>'Planes de ahorro automotor adjudicados','id'=>'tab-adjudicados')); ?></li>
			<li><?php echo $this->Html->link(__('Planes Sin adjudicar'), 'javascript:void(0)', array('onclick'=>'verTab("comenzados")','title'=>'Planes de ahorro automotor comenzados','id'=>'tab-comenzados')); ?></li>
		</ul>

		<div class="tab-panel">
		
			<div class="descripciones">
				<div class="adjudicados texto">Estos planes están listos para que elijas el modelo del auto que querés y comiences a disfrutar de tu auto YA! totalmente en pesos y sin interés directo de fábrica.</div>
				<div class="comenzados texto">Estos planes están listos para licitar y participar de los sorteos.  Vos programás la entrega y la cantidad de cuotas que querés financiar!!</div>
				<div class="nuevos texto" style="display:block">Es la forma de comprar tu auto financiado hasta el 100% del auto que elijas sin requisitos, en pesos y sin interés. </div>
			</div>
			
			<div class="listado-planes">
				<?php foreach ($destacados as $tipo=>$planes){ ?>
					<div id="tab-destacado-<?php echo $tipo; ?>" class="tab-destacado">
						<?php 
							if(is_array($planes)){
								foreach ($planes as $tipo=>$plan){
									$thumb = '';
									if(!empty($plan['Modelo']['imagen'])){
										$thumb = $this->Thumbnail->render($plan['Modelo']['imagen'], array(
											'path' => UPLOAD_IMG_PATH_MODELOS_PRINCIPAL,
											'cachePath' => UPLOAD_IMG_HELPER_CACHE.'principal',
											'newWidth' => 300,
											'newHeight' => 220,
											'resizeOption'=>'crop',
											'quality' => '90',
											'absoluteCachePath' => WWW_ROOT,
										));
										$thumb = Router::url('/'.$thumb);
									}
									?>
									<div class="item" style="background-image:url('<?php echo $thumb;?>');">
										<?php echo ($plan['Plan']['vendido'] == 1 ? $this->Html->image('tuplanya/vendido.png',array('class'=>'vendido')) : '');?>
										<?php echo ($plan['Plan']['reservado'] == 1 ? $this->Html->image('tuplanya/reservado.png',array('class'=>'reservado')) : '');?>
										<div class="container"><?php echo $this->Html->link('',array('controller' => 'planes', 'action' => 'ver','id'=>$plan['Plan']['id'],'slug'=>$plan['Plan']['slug']));?></div>
										<h2><?php echo $this->Html->link($plan['Plan']['denominacion'], array('controller' => 'planes', 'action' => 'ver', $plan['Plan']['id'])); ?></h2>
										<div class="volanta"><?php echo strip_tags($plan['Plantipo']['denominacion'],'<strong><span><em>'); ?></div>
										<p class="descripcion"><?php echo strip_tags($plan['Plan']['volanta'],'<strong><span><em>'); ?></p>
										<div class="pie">
											<div class="cuota-desde">Cuota desde</div>
											<?php if($plan['Plan']['tipo'] != 'Nuevo'){ ?>
												<div class="cuotas-pagas"><?php echo $plan['Plan']['cuotasPagas'].'/'.$plan['Plan']['cuotasCantidad'];?></div>
												<div class="cuotas-cantidad"><?php echo __('Cuotas Pagas',true);?></div>
											<?php } ?>
											<div class="precio"><?php echo h( $this->Number->format($plan['Plan']['precio_visible'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))); ?></div>
											<div class="cuota-pura"><?php echo ($plan['Plan']['tipo'] != 'Nuevo' ? 'cuota: '.h($this->Number->format($plan['Plan']['cuota_promedio'], array('places' => 0,'before' => '$ ','escape' => false,'decimals' => ',','thousands' => '.'))) : '');?></div>
										</div>
									</div>
								<?php }
							}
						?>
						</div>
					<?php } ?>
					<div style="clear:both"></div>
				</div>
				<div class="aclaracion" >*Los precios están sujetos a posible variación de la fábrica.</div>
			</div>
		</div>
		<div style="clear:both"></div>
	</div>
</div>